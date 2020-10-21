<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('home',function (){
    return view('dashboard');
});

//productos 

use App\Http\Controllers\ProductController;

Route::resource('products',ProductController::class);

//Buscador de productos

use App\Http\Controllers\ProductsSearchController;

Route::get('searching-products',[ProductsSearchController::class,'index'])->name('searching-produts.index')->middleware('auth');