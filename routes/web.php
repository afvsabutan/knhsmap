<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/map/map1');
});

Route::get('/map/{map}', function ($map) {

    $links = [
        'map1' => ['forward' => null,   'back' => null, 'right' => 'map2',  'left' => 'map3',],
        'map2' => ['forward' => 'map5', 'back' => null, 'right' => 'map4',  'left' => 'map1',],
        'map3' => ['forward' => null,   'back' => 'map11',  'right' => 'map1','left' => 'map4',],
        'map4' => ['forward' => null,   'back' => null, 'right' => 'map3',  'left' => 'map2',],
        'map5' => ['forward' => 'map8',   'back' => 'map2',  'right' => 'map6',  'left' => 'map7',],
        'map6' => ['forward' => null,   'back' => null,  'right' => null,  'left' => 'map5',],
        'map7' => ['forward' => null,   'back' => null,  'right' => 'map5',  'left' => null,],
        'map8' => ['forward' => 'map9',   'back' => 'map5',  'right' => 'map12',  'left' => 'map10',],
        'map9' => ['forward' => 'map16',   'back' => 'map8',  'right' => 'map13',  'left' => 'map14',],
        'map10' => ['forward' => null,   'back' => null,  'right' => 'map8',  'left' => 'map11',],
        'map11' => ['forward' => 'map3',   'back' => 'map15',  'right' => 'map10',  'left' => 'map12',],
        'map12' => ['forward' => null,   'back' => null,  'right' => 'map11',  'left' => 'map8',],
        'map13' => ['forward' => null,   'back' => null,  'right' => 'map15',  'left' => 'map9',],
        'map14' => ['forward' => null,   'back' => null,  'right' => 'map9',  'left' => 'map15',],
        'map15' => ['forward' => 'map11',   'back' => 'map18',  'right' => 'map14',  'left' => 'map13',],
        'map16' => ['forward' => 'map20',   'back' => 'map9',  'right' => 'map19',  'left' => 'map17',],
        'map17' => ['forward' => null,   'back' => null,  'right' => 'map16',  'left' => 'map18',],
        'map18' => ['forward' => 'map15',   'back' => 'map23',  'right' => 'map17',  'left' => 'map19',],
        'map19' => ['forward' => null,   'back' => null,  'right' => 'map18',  'left' => 'map16',],
        'map20' => ['forward' => 'map24',   'back' => 'map16',  'right' => 'map22',  'left' => 'map21',],
        'map21' => ['forward' => null,   'back' => null,  'right' => 'map20',  'left' => 'map23',],
        'map22' => ['forward' => null,   'back' => null,  'right' => 'map23',  'left' => 'map20',],
        'map23' => ['forward' => 'map18',   'back' => 'map27',  'right' => 'map21',  'left' => 'map22',],
        'map24' => ['forward' => null,   'back' => 'map20',  'right' => 'map25',  'left' => 'map26',],
        'map25' => ['forward' => null,   'back' => 'map31',  'right' => 'map27',  'left' => 'map24',],
        'map26' => ['forward' => 'map28',   'back' => null,  'right' => 'map24',  'left' => 'map27',],
        'map27' => ['forward' => 'map23',   'back' => null,  'right' => 'map26',  'left' => 'map25',],
        'map28' => ['forward' => null,   'back' => 'map26',  'right' => 'map29',  'left' => 'map30',],
        'map29' => ['forward' => null,   'back' => null,  'right' => 'map31',  'left' => 'map28',],
        'map30' => ['forward' => null,   'back' => null,  'right' => 'map28',  'left' => 'map31',],
        'map31' => ['forward' => 'map25',   'back' => null,  'right' => 'map30',  'left' => 'map29',],
        'map32' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
        'map' => ['forward' => null,   'back' => null,  'right' => null,  'left' => null,],
    ];

    if (!isset($links[$map])) {
        abort(404);
    }

    return view('map', [
        'map'   => $map,
        'links' => $links[$map]
    ]);
});
