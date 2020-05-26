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

Route::apiResource('/admin', 'Admin\API\AdminController');
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
Route::post('/reserve', 'Admin\API\ReserveController@store');
Route::post('/searchSpace', 'Tour\API\SpaceController@search');
Route::get('/current_admin', function() {
    return Auth::guard('admin')->user();
});