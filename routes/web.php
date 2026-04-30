<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsSearchController;
use App\Http\Controllers\ProductInPurchaseController;
use App\Http\Controllers\{ClientController, CurrentUserController, ImpersonationController, InventoryController, PDFController, ProductBarcodeController, ProductStockController, ProductValidation, RolesPermissionsController, SaleToClientController, TicketController, TransactionProductsController, UserController, WarehouseController};
use App\Http\Controllers\{PurchaseController, ProductInSaleController, RoleController};
use App\Http\Controllers\InventoryContextController;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'context.inventory']);

Route::get('home', function () {
    return view('dashboard');
})->middleware(['auth', 'context.inventory']);
/**
 * SKU check
 */
Route::get('products/sku-exists', [ProductValidation::class, 'skuAvailability'])->middleware('auth', 'context.inventory');

//productos


Route::resource('products', ProductController::class)->middleware(['auth', 'context.inventory']);

//productos en venta

Route::post('sales/{product}/products', [ProductInSaleController::class, 'store'])->middleware('auth', 'context.inventory');
Route::put('sales/{product}/products', [ProductInSaleController::class, 'update'])->middleware('auth', 'context.inventory');
Route::delete('sales/{product}/products', [ProductInSaleController::class, 'destroy'])->middleware('auth', 'context.inventory');

//Buscador de productos

Route::get('searching-products', [ProductsSearchController::class, 'index'])->name('searching-produts.index')->middleware('auth', 'context.inventory');


// compras

Route::resource('purchases', PurchaseController::class)->middleware('auth', 'context.inventory');

//Productos en compra

Route::put('products-in-purchases/{product}', [ProductInPurchaseController::class, 'update'])->middleware('auth', 'context.inventory');
Route::delete('products-in-purchases/{product}', [ProductInPurchaseController::class, 'destroy'])->middleware('auth', 'context.inventory');

//clientes


Route::resource('clients', ClientController::class)->middleware('auth', 'context.inventory');

//sales to client

Route::post('sales-to-clients', [SaleToClientController::class, 'store'])->middleware('auth', 'context.inventory');
//categories

Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('auth', 'context.inventory');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store')->middleware('auth', 'context.inventory');
Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('auth', 'context.inventory');
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('auth', 'context.inventory');
Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update')->middleware('auth', 'context.inventory');
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('auth', 'context.inventory');

//ventas

Route::get('sales', [SaleController::class, 'index'])->middleware('auth', 'context.inventory');
Route::get('sales/create', [SaleController::class, 'create'])->name('sales.create')->middleware('auth', 'context.inventory');
Route::post('sales/{sale}', [SaleController::class, 'store'])->name('sales.store')->middleware('auth', 'context.inventory');
Route::delete('sales/{sale}', [SaleController::class, 'destroy'])->middleware('auth', 'context.inventory');

//ROLES

Route::get('roles/create', [RoleController::class, 'create'])->middleware('auth');
Route::get('roles', [RoleController::class, 'index'])->middleware('auth');
Route::post('roles', [RoleController::class, 'store'])->middleware('auth');
Route::get('roles/{role}', [RoleController::class, 'show'])->middleware('auth');

//ROLES PERMISSIONS
Route::delete('roles/{role}/permissions', [RolesPermissionsController::class, 'destroy'])->middleware('auth');
Route::post('roles/{role}/permissions', [RolesPermissionsController::class, 'store'])->middleware('auth');

//users
Route::get('users', [UserController::class, 'index'])->middleware('auth',);
Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware('auth');
Route::put('users/{user}', [UserController::class, 'update'])->middleware('auth');

//inventories
Route::resource('inventories', InventoryController::class)->middleware('auth', 'context.inventory')
    ->except(['update', 'edit']);;
Route::get('warehouses', [WarehouseController::class, 'index'])->middleware('auth');
Route::delete('warehouses/{inventory}', [WarehouseController::class, 'destroy'])->middleware('auth');
Route::get('warehouses/{inventory}/edit', [WarehouseController::class, 'edit'])->middleware('auth');
Route::put('warehouses/{inventory}', [WarehouseController::class, 'update'])->middleware('auth');

//errors
Route::get('/403', function () {
    return view('errors.403');
});

//impersionations

Route::post('/impersonations', [ImpersonationController::class, 'store'])->middleware('auth');
Route::delete('/impersonations', [ImpersonationController::class, 'destroy'])->middleware('auth');

//obtener usuario loggueado

Route::get('/current-user', CurrentUserController::class);

/**
 * tickets
 */
Route::get('pdf-tickets/{sale}', PDFController::class)->middleware('auth');
Route::put('tickets/{ticket}', [TicketController::class, 'update'])->middleware('auth');
Route::get('tickets/{ticket}/edit', [TicketController::class, 'edit'])->middleware('auth');


/**
 * transaction
 */
Route::get('transaction-products', [TransactionProductsController::class, 'index']);

/**
 * Barcode
 */


Route::get('barcode/{product:sku}', [ProductBarcodeController::class, 'show'])->middleware('auth');

/**
 * Select inventory
 */
Route::middleware(['auth'])->group(function () {
    Route::get('select-inventory', [InventoryContextController::class, 'show'])->name('select-inventory');
    Route::post('select-inventory', [InventoryContextController::class, 'store'])->name('select.inventory.store');
});

/**
 * Product stock
 */
Route::get('products-stock', [ProductStockController::class, 'index'])->middleware('auth');
Route::get('products/{product}/stock', [ProductStockController::class, 'show'])->middleware('auth');
