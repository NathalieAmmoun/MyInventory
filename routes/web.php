<?php

use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\HomeController;
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
    Log::error('Hello');
    return view('welcome');

});




Route::group(['middleware' => 'auth', 'prefix' => '/dashboard',], function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');


    Route::group(['prefix' => '/product-types',], function () {
        Route::post('/add', [ProductController::class, 'addProductType']);
        Route::post('/update/{id}', [ProductController::class, 'updateProductType']);
        Route::get('/delete/{id}', [ProductController::class, 'deleteProductType']);
    });


    Route::group([ 'prefix' => 'product-items',], function () {
        Route::any('/{product_type_id}', [HomeController::class, 'productItems']);
        Route::post('{product_type_id}/add', [ProductController::class, 'addProductItems']);
        Route::get('/is-sold/{id}', [ProductController::class, 'productItemSold']);
        Route::post('/update/{id}', [ProductController::class, 'updateProductItem']);
        Route::get('/delete/{id}', [ProductController::class, 'deleteProductItem']);
    });
});
require __DIR__ . '/auth.php';
