<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Countries;

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

// Country Routes
Route::post('/addCountry', [App\Http\Controllers\API\CountriesController::class, 'store'])->name('addCountry');
Route::get('/getCountries', [App\Http\Controllers\API\CountriesController::class, 'index'])->name('getCountries');
Route::get('/getAllCountries', [App\Http\Controllers\API\CountriesController::class, 'indexAll'])->name('getAllCountries');
Route::get('/country/{id}', function ($id){
	return Countries::where('id', $id)->first();
});
Route::post('/deleteCountry', [App\Http\Controllers\API\CountriesController::class, 'destroy'])->name('deleteCountry');
 
