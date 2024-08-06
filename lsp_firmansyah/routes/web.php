<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jalur', function () {
    return view('jalur');
});

Route::get('/alur', function () {
    return view('alur');
});

Route::get('/biaya', function () {
    return view('biaya');
});

Route::get('/navbar', function () {
    return view('layout/navbar');
});