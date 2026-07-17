<?php

use App\Http\Controllers\BestiaryController;
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

Route::controller(BestiaryController::class)->group(function () {
    Route::get('/bestiary/templates', 'index');
    Route::get('/bestiary/templates/create', 'create');
    Route::get('/bestiary/templates/{template}', 'show');
    Route::get('/bestiary/templates/{template}/edit', 'edit');

    Route::patch('/bestiary/templates/{template}', 'update');
    Route::delete('/bestiary/templates/{template}', 'destroy');
    Route::post('/bestiary/templates', 'store');
});
