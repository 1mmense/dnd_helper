<?php

use App\Models\Creature;
use App\Models\Effect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/tracker', function () {
    // $creatures = Creature::all();
    // $effects   = Effect::all();

    // return view('tracker', [
    //     'creatures' => $creatures,
    //     'effects'   => $effects,
    // ]);

    return view('tracker');
});

// Route::livewire('/live-tracker', function () {
//     return view('live-tracker');
// });

// Route::livewire('/tracker', 'tracker');
