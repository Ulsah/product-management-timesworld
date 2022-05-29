<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

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

Route::get('/user', function (Request $request) {
    return $request->user();
});

// Product Routes
Route::post('/addProduct', [App\Http\Controllers\API\ProductController::class, 'store']);
Route::get('/getProducts', [App\Http\Controllers\API\ProductController::class, 'index']);
Route::post('/editProduct', [App\Http\Controllers\API\ProductController::class, 'update']);
Route::get('/product/{id}', function ($id){
	return Product::where('id', $id)->first();
});
Route::post('/deleteProduct', [App\Http\Controllers\API\ProductController::class, 'destroy']);
 
