<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/map/map1');
});

/*
|--------------------------------------------------------------------------
| MAP VIEW (FRONTEND)
|--------------------------------------------------------------------------
*/
Route::get('/map/{map}', function ($map) {

    $maps = file_exists(config_path('maps.php'))
        ? include config_path('maps.php')
        : [];

    if (!isset($maps[$map])) {
        abort(404);
    }

    return view('map', [
        'map'   => $map,
        'links' => $maps[$map]
    ]);
});

/*
|--------------------------------------------------------------------------
| MAP ADMIN PAGE
|--------------------------------------------------------------------------
*/
Route::get('/admin/maps', function () {
    return view('mapadmin');
});

/*
|--------------------------------------------------------------------------
| MAP ADMIN SAVE (AUTO REVERSE LINK)
|--------------------------------------------------------------------------
*/
// Route::post('/admin/map/save', function (Request $request) {

//     $file = config_path('maps.php');

//     $maps = file_exists($file) ? include $file : [];

//     $map       = $request->map;
//     $direction = $request->direction;
//     $target    = $request->target ?: null;

//     // Ensure map exists
//     if (!isset($maps[$map])) {
//         $maps[$map] = [
//             'forward' => null,
//             'back'    => null,
//             'left'    => null,
//             'right'   => null,
//         ];
//     }

//     // Set selected direction
//     $maps[$map][$direction] = $target;

//     // AUTO reverse link
//     if ($target) {

//         if (!isset($maps[$target])) {
//             $maps[$target] = [
//                 'forward' => null,
//                 'back'    => null,
//                 'left'    => null,
//                 'right'   => null,
//             ];
//         }

//         $reverse = [
//             'forward' => 'back',
//             'back'    => 'forward',
//             'left'    => 'right',
//             'right'   => 'left',
//         ];

//         $maps[$target][$reverse[$direction]] = $map;
//     }

//     // SAVE TO FILE
//     file_put_contents(
//         $file,
//         "<?php\n\nreturn " . var_export($maps, true) . ";\n"
//     );

//     return redirect('/admin/maps')->with('success', 'Map saved!');
// });
Route::post('/admin/map/save', function (Request $request) {

    $file = config_path('maps.php');
    $maps = file_exists($file) ? include $file : [];

    $map = $request->map;
    $mode = $request->mode ?? 'normal';

    $maps[$map] ??= [
        'forward'=>null,'back'=>null,'left'=>null,'right'=>null
    ];

    // ================= NORMAL SAVE =================
    if ($mode === 'normal') {

        foreach (['forward','back','left','right'] as $dir) {
            $val = $request->$dir;
            if ($val) {
                $maps[$map][$dir] = $val;

                $reverse = [
                    'forward'=>'back',
                    'back'=>'forward',
                    'left'=>'right',
                    'right'=>'left'
                ];

                $maps[$val] ??= [
                    'forward'=>null,'back'=>null,'left'=>null,'right'=>null
                ];
                $maps[$val][$reverse[$dir]] = $map;
            }
        }
    }

    // ================= SAVE w/ LR =================
    if ($mode === 'withLR') {
        $target = $request->forward; // example: map2

        if ($target) {
            $maps[$map]['forward'] = $target; // map1.forward = map2

            // ensure map2 exists
            $maps[$target] ??= ['forward'=>null,'back'=>null,'left'=>null,'right'=>null];
            $maps[$target]['back'] = $map; // map2.back = map1

            // auto left/right
            $num = intval(str_replace('map','',$target));
            $left  = 'map'.($num + 1); // map3
            $right = 'map'.($num + 2); // map4
            $maps[$target]['left']  = $left;
            $maps[$target]['right'] = $right;

            // ensure map3/map4 exist
            $maps[$left] ??= ['forward'=>null,'back'=>null,'left'=>null,'right'=>null];
            $maps[$right] ??= ['forward'=>null,'back'=>null,'left'=>null,'right'=>null];

            // link map3/map4 back to map2
            $maps[$left]['right']  = $target;
            $maps[$right]['left']  = $target;

            // auto link map3/map4 to each other (map5)
            $map5 = 'map'.($num + 3);
            $maps[$left]['left']   = $map5;
            $maps[$right]['right'] = $map5;

            $maps[$map5] ??= ['forward'=>null,'back'=>null,'left'=>null,'right'=>null];
            $maps[$map5]['left']  = $right; // map4
            $maps[$map5]['right'] = $left;  // map3
        }
    }

    file_put_contents(
        $file,
        "<?php\n\nreturn " . var_export($maps,true) . ";\n"
    );

    return back()->with('success','Saved!');
});



/*
|--------------------------------------------------------------------------
| ADMIN MAP LINKS (for admin DPAD navigation)
|--------------------------------------------------------------------------
*/
Route::get('/admin/map/links/{map}', function ($map) {

    $maps = file_exists(config_path('maps.php'))
        ? include config_path('maps.php')
        : [];

    if (!isset($maps[$map])) {
        return response()->json([
            'forward' => null,
            'back'    => null,
            'left'    => null,
            'right'   => null,
        ]);
    }

    return response()->json($maps[$map]);
});
