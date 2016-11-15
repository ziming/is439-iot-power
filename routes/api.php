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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::group(['middleware' => 'cors'], function () {
    Route::get('/smart-bins', 'Api\SmartBinsController@index');
    Route::get('/smart-bins/{id}', 'Api\SmartBinsController@show');

    Route::get('/power-sensors', 'Api\PowerSensorsController@index');
    Route::get('/power-sensors/{id}', 'Api\PowerSensorsController@show');

    Route::get('/power-sensors/{power_sensor_id}/logs', 'Api\PowerSensorLogsController@show');
    Route::get('/power-sensors/{power_sensor_id}/wh-logs', 'Api\PowerSensorLogsController@showBywH');

    Route::get('/power-sensor-logs', 'Api\PowerSensorLogsController@index');
    Route::get('/power-sensor-logs/latest', 'Api\PowerSensorLogsController@latest');

    Route::get('/power-sensor-wh-logs', 'Api\PowerSensorLogsController@indexBywH');

});
