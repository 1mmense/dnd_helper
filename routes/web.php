<?php

use App\Http\Controllers\EffectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/tracker', function () {
    return view('tracker');
});

Route::controller(EffectController::class)->group(function () {
    Route::get('/effects', 'index');
    Route::get('/effects/create', 'create');
    Route::get('/effects/{effect}', 'show');
    Route::get('/effects/{effect}/edit', 'edit');

    Route::patch('/effects/{effect}', 'update');
    Route::delete('/effects/{effect}', 'destroy');
    Route::post('/effects', 'store');
});
