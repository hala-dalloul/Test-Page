<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication Routes
Route::get('/login', 'AuthController@showLogin')->name('login');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout')->name('logout');

// Protected Routes (Require Authentication)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard', 'DashboardController@index');

    // Patient Routes
    Route::resource('patients', 'PatientController');

    // Appointment Routes
    Route::resource('appointments', 'AppointmentController');

    // Staff Routes
    Route::resource('staff', 'StaffController');
    Route::get('staff/{id}/schedule', 'StaffController@schedule')->name('staff.schedule');
    Route::put('staff/{id}/schedule', 'StaffController@updateSchedule')->name('staff.updateSchedule');

    // Profile Routes
    Route::get('/profile', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');
});
