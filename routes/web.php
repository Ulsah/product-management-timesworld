<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/appointment', function () {
	return view('appointment');
})->name('appointment');

Route::get('/success', function () {
	return view('success');
})->name('success');

Route::get('/{vue_capture?}', function () {
    return view('home');
})->where('vue_capture', '[\/\w\.-]*');

// User Routes
Route::post('/getUsers', [App\Http\Controllers\API\UsersController::class, 'index']);
Route::post('/getDocs', [App\Http\Controllers\API\UsersController::class, 'doctors']);
Route::post('/getPatients', [App\Http\Controllers\API\UsersController::class, 'patients']);
Route::post('/updateUser', [App\Http\Controllers\API\UsersController::class, 'update']);
Route::post('/addUser', [App\Http\Controllers\API\UsersController::class, 'store']);

// Appointment Routes
Route::post('/addAppointment', [App\Http\Controllers\API\AppointmentController::class, 'store'])->name('addAppointment');
Route::post('/updateAppointment', [App\Http\Controllers\API\AppointmentController::class, 'update']);
Route::post('/updateDocAppointment', [App\Http\Controllers\API\AppointmentController::class, 'updateDoc']);
Route::post('/changeAppointment', [App\Http\Controllers\API\AppointmentController::class, 'change']);
Route::post('/getAppointments', [App\Http\Controllers\API\AppointmentController::class, 'index']);
Route::post('/getDocAppointments', [App\Http\Controllers\API\AppointmentController::class, 'indexDoc']);
Route::post('/getPatientAppointments', [App\Http\Controllers\API\AppointmentController::class, 'indexPatient']);

// Reports
Route::post('/getReports', [App\Http\Controllers\API\ReportsController::class, 'index']);
Route::post('/addReport', [App\Http\Controllers\API\ReportsController::class, 'store']);
Route::post('/deleteReport', [App\Http\Controllers\API\ReportsController::class, 'destroy']);

