<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Главная страница, можно перенаправить на список товаров
Route::get('/', function () {
    return redirect()->route('products.index');
});

// Маршруты для управления товарами [cite: 3]
Route::resource('products', ProductController::class);

// Маршруты для управления заказами [cite: 4]
Route::resource('orders', OrderController::class);

// Добавляем специфичный маршрут для изменения статуса заказа [cite: 7]
Route::patch('orders/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');
