<?php

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

use App\Http\Controllers\API\JWTAuthController;
use App\Http\Controllers\API\ProductController;

Route::post('register', [JWTAuthController::class, 'register'])->name('register');
Route::post('login', [JWTAuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth.jwt'], function () {

    Route::post('logout', [JWTAuthController::class, 'logout']);

    Route::get('user', [JWTAuthController::class, 'userProfile']);
});

Route::group(['middleware' => 'auth.jwt',   'prefix' => 'product-type',], function () {
    Route::get('/', [ProductController::class, 'getProductTypes']);
    Route::post('/add', [ProductController::class, 'addProductType']);

    Route::post('/update/{id}', [ProductController::class, 'updateProductType']);
    Route::delete('/delete/{id}', [ProductController::class, 'deleteProductType']);
});


Route::group(['middleware' => 'auth.jwt',   'prefix' => 'product-items',], function () {
    Route::get('/{product_type_id}', [ProductController::class, 'getProductItems']);
    Route::post('{product_type_id}/add', [ProductController::class, 'addProductItems']);
    Route::get('/is-sold/{id}', [ProductController::class, 'productItemSold']);
    Route::post('/update/{id}', [ProductController::class, 'updateProductItem']);
    Route::delete('/delete/{id}', [ProductController::class, 'deleteProductItem']);
});
