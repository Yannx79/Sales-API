<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lang', function () {
    return __('auth.failed');
});

Route::get('/lang/en', function () {
    App::setLocale('en');
    return __('auth.failed');
});

Route::get('/lang/pass', function () {
    return __('auth.throttle', ['seconds' => 4]);
});

Route::get('/lang/pass/en', function () {
    App::setLocale('en');
    return __('auth.throttle', ['seconds' => 4]);
});

Route::get('/lang/greeting', function () {
    return __('greeting');
});

Route::get('/lang/greeting/en', function () {
    App::setLocale('en');
    return __('greeting');
});
