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


Route::resource('products', ProductController::class);

//productos en venta 

Route::post('sales/{product}/products', [ProductInSaleController::class, 'store']);
Route::put('sales/{product}/products', [ProductInSaleController::class, 'update']);
Route::delete('sales/{product}/products', [ProductInSaleController::class, 'destroy']);

//Buscador de productos

Route::get('searching-products', [ProductsSearchController::class, 'index'])->name('searching-produts.index')->middleware('auth');


// compras 

Route::resource('purchases', PurchaseController::class);

//Productos en compra

Route::put('products-in-purchases/{product}', [ProductInPurchaseController::class, 'update']);
Route::delete('products-in-purchases/{product}', [ProductInPurchaseController::class, 'destroy']);

//clientes 


Route::resource('clients', ClientController::class);

//categories 


Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');

Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');

//ventas

Route::get('sales/create', [SaleController::class, 'create'])->name('sales.create');
Route::post('sales/{sale}', [SaleController::class, 'store'])->name('sales.store');
