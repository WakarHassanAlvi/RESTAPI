<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
    Operator Routes
*/
Route::post('/operators', 'OperatorController@store');
Route::put('/operators/{id}', 'OperatorController@update');
Route::get('/operators/{id}', 'OperatorController@show');
Route::get('/operators', 'OperatorController@index');

/*
    Brand Routes
*/
Route::post('/brands', 'BrandController@store');
Route::put('/brands/{id}', 'BrandController@update');
Route::get('/brands/{id}', 'BrandController@show');
Route::get('/brands', 'BrandController@index');
