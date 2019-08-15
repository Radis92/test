<?php

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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

Route::get('/Dashboard', 'DashboardController@index')->middleware('auth');
Route::get('/karyawan', 'KaryawanController@index')->middleware(['auth', 'checkRole:admin']);
Route::post('/karyawan', 'KaryawanController@create')->middleware(['auth', 'checkRole:admin']);
Route::get('/karyawan/{id}/edit', 'KaryawanController@edit')->middleware(['auth', 'checkRole:admin']);
Route::post('/karyawan/{id}/update', 'KaryawanController@update')->middleware(['auth', 'checkRole:admin']);
Route::get('/karyawan/{id}/delete', 'KaryawanController@delete')->middleware(['auth', 'checkRole:admin']);
Route::get('/karyawan/{id}/profile', 'KaryawanController@profile')->middleware(['auth', 'checkRole:admin']);
Route::post('/karyawan/{id}/addnilai', 'KaryawanController@addnilai')->middleware(['auth', 'checkRole:admin']);
