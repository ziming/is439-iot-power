<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use ConsoleTVs\Charts\Charts;

Route::get('/', function () {

    $chart1 = Charts::create('line', 'highcharts')
        ->setTitle('My nice chart')
        ->setLabels(['First', 'Second', 'Third'])
        ->setValues([5, 10, 20])
        ->setDimensions(1000, 500)
        ->setResponsive(true);

    return view('welcome', compact('chart1', 'chart2'));
});
