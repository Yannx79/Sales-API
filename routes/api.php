<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->as('api.')->group(function () {
    Route::apiResources([
        'products' => ProductController::class,
        'sales' => SalesController::class,
        'stores' => StoreController::class,
        'users' => UserController::class,
        'times' => TimeController::class // No necesario su logica puede gestionarla sales
    ]);
    // sales
});

Route::get('sales/sales-month', [SalesController::class, 'lastMonth'])->name('api.sales.month');
