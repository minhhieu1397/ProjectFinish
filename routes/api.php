<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::post('admin/store', 'AdminAPI\AdminController@store');
Route::get('/admin/view', 'AdminAPI\AdminController@view');
Route::put('/admin/update/{id}', 'AdminAPI\AdminController@update');
Route::delete('/admin/destroy/{id}', 'AdminAPI\AdminController@destroy');

Route::get('/place/view', 'AdminAPI\PlaceController@view');
Route::post('/place/store', 'AdminAPI\PlaceController@store');
Route::put('/place/update/{id}', 'AdminAPI\PlaceController@update');
Route::delete('/place/delete/{id}', 'AdminAPI\PlaceController@destroy');

Route::post('/tour/store', 'AdminAPI\TourController@store');
Route::get('/tour/viewTour', 'AdminAPI\TourController@view');
Route::delete('/tour/delete/{id}', 'AdminAPI\TourController@destroy');
Route::put('/tour/update/{id}', 'AdminAPI\TourController@update');

Route::post('/program/store', 'AdminAPI\ProgramController@store');
Route::delete('/program/delete/{id}', 'AdminAPI\ProgramController@destroy');
Route::get('/program/view/{id}', 'AdminAPI\ProgramController@view');
Route::put('/program/update/{id}', 'AdminAPI\ProgramController@update');

Route::post('/detail/store', 'AdminAPI\DetailController@store');
Route::get('/detail/view/{id}', 'AdminAPI\DetailController@view');

Route::post('/reserve/store', 'AdminAPI\ReserveController@store');
Route::get('/getAllReserve/{tour_id}', 'AdminAPI\ReserveController@getAll');
Route::put('/setStatus/{id}', 'AdminAPI\ReserveController@setStatus');

Route::apiResource('/program', 'Admin\API\ProgramController');
Route::apiResource('/tour', 'Admin\API\TourController');
Route::apiResource('/detail', 'Admin\API\DetailController');
Route::apiResource('/space', 'Admin\API\SpaceController');
Route::apiResource('/JWT', 'Admin\API\TestJwtController');
Route::apiResource('/login', 'Admin\API\LoginController');
Route::apiResource('/checkJwt', 'Admin\API\checkJwtController');
Route::apiResource('/image', 'Admin\API\ImageController');
Route::get('/tourhighlight', 'Admin\API\HightLightTourController@showTourHighLight');
Route::put('/setTourHot/{id}', 'Admin\API\HightLightTourController@setTourHot');
Route::post('get', 'Admin\API\TestController@get');

Route::post('/searchSpace', 'Tour\API\SpaceController@search');


Route::put('/setAmount/{id}', 'Admin\API\SetAmountController@setAmount');
Route::post('/createUser', 'User\API\UserController@register');
Route::post('/loginUser', 'User\API\UserController@login');



Route::get('/current_admin', function() {
    return Auth::guard('admin')->user();
});