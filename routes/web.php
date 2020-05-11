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

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('admins', 'AdminController');
Route::get('/Admin', 'Admin\LoginAdminController@login')->name('admin.login');
Route::get('/Admin/home', 'Admin\AdminController@index')->name('admins.index');
Route::get('/Admin/admin', 'Admin\AdminController@getAdmin');
Route::get('/Admin/{path}', 'Admin\LoginAdminController@login');
// Route::get('/', 'Tour\TourController@index');

Route::get('/', 'Tour\TourController@index');
Route::get('/{path}', 'Tour\TourController@index');
Route::get('/Detail/{path}', 'Tour\TourController@index');

