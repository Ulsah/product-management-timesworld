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

Route::get('/user', function (Request $request) {
    return $request->user();
});

// User Routes
Route::post('/getUsers', [App\Http\Controllers\API\UsersController::class, 'index']);
Route::post('/getDocs', [App\Http\Controllers\API\UsersController::class, 'doctors']);
Route::post('/getPatients', [App\Http\Controllers\API\UsersController::class, 'patients']);
Route::post('/updateUser', [App\Http\Controllers\API\UsersController::class, 'update']);
Route::post('/addUser', [App\Http\Controllers\API\UsersController::class, 'store']);

// Appointment Routes
Route::post('/addAppointment', [App\Http\Controllers\API\AppointmentController::class, 'store']);
Route::post('/updateAppointment', [App\Http\Controllers\API\AppointmentController::class, 'update']);
Route::post('/changeAppointment', [App\Http\Controllers\API\AppointmentController::class, 'change']);
Route::post('/getAppointments', [App\Http\Controllers\API\AppointmentController::class, 'index']);
Route::post('/getDocAppointments', [App\Http\Controllers\API\AppointmentController::class, 'indexDoc']);
 
