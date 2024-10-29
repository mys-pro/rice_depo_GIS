<?php

use App\Http\Controllers\Ajax\MapController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ImportController;
use App\Http\Controllers\Backend\RiceController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\WarehouseController;
use Illuminate\Support\Facades\Route;

// BEGIN: Auth
Route::get('/', [AuthController::class, 'index'])->name('auth.admin')->middleware('login');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout'); // END: Auth


// BEGIN: Dashboard
Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth'); // END: Dashboard

// BEGIN: AJAX 
Route::group(['prefix' => 'ajax', 'middleware' => 'auth'], function () {
    Route::get('map/getMarker', [MapController::class, 'getMarker'])->name('ajax.map.getMarker');
    Route::get('map/search', [MapController::class, 'search'])->name('ajax.map.search');
}); // END: AJAX

// BEGIN: Warehouse
Route::group(['prefix' => 'warehouse', 'middleware' => 'auth'], function () {
    Route::get('index', [WarehouseController::class, 'index'])->name('warehouse.index');
    Route::get('create', [WarehouseController::class, 'create'])->name('warehouse.create');
    Route::post('store', [WarehouseController::class, 'store'])->name('warehouse.store');
    Route::get('edit/{id}', [WarehouseController::class, 'edit'])->name('warehouse.edit');
    Route::post('update/{id}', [WarehouseController::class, 'update'])->name('warehouse.update');
    Route::get('delete/{id}', [WarehouseController::class, 'delete'])->name('warehouse.delete');
}); // END: Warehouse

// BEGIN: User
Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('index', [UserController::class, 'index'])->name('user.index');
    Route::get('create', [UserController::class, 'create'])->name('user.create');
    Route::post('store', [UserController::class, 'store'])->name('user.store');
    Route::get('detail/{id}', [UserController::class, 'detail'])->name('user.detail');
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('changePass/{id}', [UserController::class, 'changePass'])->name('user.changePass');
    Route::post('updatePass/{id}', [UserController::class, 'updatePass'])->name('user.updatePass');
    Route::get('delete/{id}', [UserController::class, 'delete'])->name('user.delete');
}); // END: User

// BEGIN: Rice
Route::group(['prefix' => 'rice', 'middleware' => 'auth'], function () {
    Route::get('index', [RiceController::class, 'index'])->name('rice.index');
    Route::get('create', [RiceController::class, 'create'])->name('rice.create');
    Route::post('store', [RiceController::class, 'store'])->name('rice.store');
    Route::get('edit/{id}', [RiceController::class, 'edit'])->name('rice.edit');
    Route::post('update/{id}', [RiceController::class, 'update'])->name('rice.update');
    Route::get('delete/{id}', [RiceController::class, 'delete'])->name('rice.delete');
}); // END: Rice

// BEGIN: Customer
Route::group(['prefix' => 'customer', 'middleware' => 'auth'], function () {
    Route::get('index', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
}); // END: Customer

// BEGIN: Import
Route::group(['prefix' => 'import', 'middleware' => 'auth'], function () {
    Route::get('index', [ImportController::class, 'index'])->name('import.index');
    Route::get('create', [ImportController::class, 'create'])->name('import.create');
    Route::post('store', [ImportController::class, 'store'])->name('import.store');
    Route::get('edit/{id}', [ImportController::class, 'edit'])->name('import.edit');
    Route::post('update/{id}', [ImportController::class, 'update'])->name('import.update');
    // Route::get('delete/{id}', [ImportController::class, 'delete'])->name('import.delete');
}); // END: Import