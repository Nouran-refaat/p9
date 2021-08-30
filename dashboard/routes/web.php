<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\backend\indexController;
use App\Http\Controllers\backend\ProductController;

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

Route::get('/', [indexController::class, 'index'])->name('index');

Route::group(['prefix' => 'dashboard','middleware'=>'verified'], function () {
    Route::get('/', [indexController::class, 'dashboard'])->name('dashboard');
    Route::group(['prefix' => 'products','as'=>'products.'], function () {
        Route::get('all', [ProductController::class, 'index'])->name('index');
        Route::get('create', [ProductController::class, 'create'])->name('create')->middleware('password.confirm');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::post('store', [ProductController::class, 'store'])->name('store');
        Route::put('update/{product_id}', [ProductController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [ProductController::class, 'destroy'])->name('destroy');
    });
});



Auth::routes(['verify' => true,'register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
