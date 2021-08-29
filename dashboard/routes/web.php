<?php

use App\Http\Controllers\backend\indexController;
use Illuminate\Support\Facades\Route;
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

Route::get('/', [indexController::class,'index']);
Route::get('products/all',[ProductController::class,'index'])->name('products.index');
Route::get('products/create',[ProductController::class,'create'])->name('products.create');
Route::get('products/edit/{id}',[ProductController::class,'edit'])->name('products.edit');
Route::post('products/store',[ProductController::class,'store'])->name('products.store');
