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
    return redirect(route('swagger.ui'));
});

Route::get('swagger', 'SwaggerController@ui')
    ->name('swagger.ui');
Route::get('swagger/json', 'SwaggerController@json')
    ->name('swagger.json');


