<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', 'Auth\AuthenticatedSessionController@create');
    Route::post('/login', 'Auth\AuthenticatedSessionController@store')
        ->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', 'Auth\AuthenticatedSessionController@destroy')
        ->name('logout');
});
