<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apis\UserController;
use App\Http\Controllers\apis\ProductController;

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

Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
    Route::get('index', [ProductController::class, 'index'])->name('index');
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::post('store', [ProductController::class, 'store'])->name('store');
    Route::post('update', [ProductController::class, 'update'])->name('update');
    Route::delete('{id}/destroy', [ProductController::class, 'destroy'])->name('destroy');
});


Route::group(['prefix' => 'auth'], function () {
    // guest
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);

    Route::group(['middleware' => 'ApiAuth'], function () {
        // auth
        Route::post('send-code', [UserController::class, 'sendCode']);
        Route::post('verify-code', [UserController::class, 'verifyCode']);
    });



    Route::group(['middleware' => 'ApiVerified'], function () {
        // verified
        Route::post('logout', [UserController::class, 'logout']);
        Route::get('profile', [UserController::class, 'profile']);
        Route::post('update-profile',[UserController::class,'updateProfile']);
    });
});
