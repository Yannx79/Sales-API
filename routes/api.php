<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->as('api.')->group(function () {
    Route::prefix('sales')->as('sales.')->group(function () {
        Route::get('sales-month', [SalesController::class, 'lastMonth'])->name('month');
        Route::get('best-selling-category', [SalesController::class, 'bestSellingCategory'])->name('.best-selling-category');
        Route::get('store-more-sales', [SalesController::class, 'storeMoreSales'])->name('store-more-sales');
        Route::get('sales-year/{year}', [SalesController::class, 'salesYear'])->name('sales-year');
        Route::get('sales-month-year/{year}/{month}', [SalesController::class, 'salesMonthYear'])->name('sales-month-year');
    });
    Route::apiResources([
        'products' => ProductController::class,
        'sales' => SalesController::class,
        'stores' => StoreController::class,
        'users' => UserController::class,
        'times' => TimeController::class // No necesario su logica puede gestionarla sales
    ]);
    // sales
    // testing language
});
