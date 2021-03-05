<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsSearchController;
use App\Http\Controllers\ProductInPurchaseController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\{PurchaseController, ProductInSaleController};


Route::get('/', function () {
    session()->flush();
    return view('dashboard');
})->middleware('auth');

Route::get('home', function () {
    return view('dashboard');
});

//productos 


Route::resource('products', ProductController::class)->middleware('auth');

//productos en venta 

Route::post('sales/{product}/products', [ProductInSaleController::class, 'store'])->middleware('auth');
Route::put('sales/{product}/products', [ProductInSaleController::class, 'update'])->middleware('auth');
Route::delete('sales/{product}/products', [ProductInSaleController::class, 'destroy'])->middleware('auth');

//Buscador de productos

Route::get('searching-products', [ProductsSearchController::class, 'index'])->name('searching-produts.index')->middleware('auth');


// compras 

Route::resource('purchases', PurchaseController::class)->middleware('auth');

//Productos en compra

Route::put('products-in-purchases/{product}', [ProductInPurchaseController::class, 'update'])->middleware('auth');
Route::delete('products-in-purchases/{product}', [ProductInPurchaseController::class, 'destroy'])->middleware('auth');

//clientes 


Route::resource('clients', ClientController::class)->middleware('auth');

//categories 


Route::post('categories', [CategoryController::class, 'store'])->name('categories.store')->middleware('auth');

Route::get('categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('auth');

//ventas

Route::get('sales/create', [SaleController::class, 'create'])->name('sales.create')->middleware('auth');
Route::post('sales/{sale}', [SaleController::class, 'store'])->name('sales.store')->middleware('auth');
