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
Route::post('/admin/map/save', function (Request $request) {

    $file = config_path('maps.php');

    $maps = file_exists($file) ? include $file : [];

    $map       = $request->map;
    $direction = $request->direction;
    $target    = $request->target ?: null;

    // Ensure map exists
    if (!isset($maps[$map])) {
        $maps[$map] = [
            'forward' => null,
            'back'    => null,
            'left'    => null,
            'right'   => null,
        ];
    }

    // Set selected direction
    $maps[$map][$direction] = $target;

    // AUTO reverse link
    if ($target) {

        if (!isset($maps[$target])) {
            $maps[$target] = [
                'forward' => null,
                'back'    => null,
                'left'    => null,
                'right'   => null,
            ];
        }

        $reverse = [
            'forward' => 'back',
            'back'    => 'forward',
            'left'    => 'right',
            'right'   => 'left',
        ];

        $maps[$target][$reverse[$direction]] = $map;
    }

    // SAVE TO FILE
    file_put_contents(
        $file,
        "<?php\n\nreturn " . var_export($maps, true) . ";\n"
    );

    return redirect('/admin/maps')->with('success', 'Map saved!');
});
Route::post('/admin/map/save', function (\Illuminate\Http\Request $request) {

    $file = config_path('maps.php'); // maps.php file in config folder
    $maps = file_exists($file) ? include $file : [];

    $map = $request->map;

    $dirs = ['forward','back','left','right'];

    $maps[$map] ??= [
        'forward'=>null,'back'=>null,'left'=>null,'right'=>null
    ];

    foreach ($dirs as $dir) {
        $val = $request->$dir;
        if ($val) {
            $maps[$map][$dir] = $val; // val is already mapX from hidden input

            // Reverse linking
            $reverse = [
                'forward'=>'back',
                'back'=>'forward',
                'left'=>'right',
                'right'=>'left'
            ];

            $maps[$val] ??= ['forward'=>null,'back'=>null,'left'=>null,'right'=>null];
            $maps[$val][$reverse[$dir]] = $map;
        }
    }

    file_put_contents($file, "<?php\n\nreturn " . var_export($maps,true) . ";\n");

    return back()->with('success','Saved!');
});
