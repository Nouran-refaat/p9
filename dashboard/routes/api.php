<?php

use App\Http\Controllers\apis\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'products','as'=>'products.'], function () {
    Route::get('index', [ProductController::class, 'index'])->name('index');
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::post('store', [ProductController::class, 'store'])->name('store');
    Route::post('update', [ProductController::class, 'update'])->name('update');
    Route::delete('{id}/destroy', [ProductController::class, 'destroy'])->name('destroy');
});
