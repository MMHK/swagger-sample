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

Route::group([
    'namespace' => 'Api',
    'middleware' => [
        'format.result'
    ]
], function (){

    Route::get('now', 'SampleController@now')
        ->name('api.now');

    Route::get('query', 'SampleController@query')
        ->name('api.query');

    Route::get('path/{key}/{value}', 'SampleController@path')
        ->name('api.path');

    Route::get('header', 'SampleController@header')
        ->name('api.header');

    Route::get('header', 'SampleController@header')
        ->name('api.header');
    Route::get('array', 'SampleController@Array')
        ->name('api.array');
    Route::post('post', 'SampleController@post')
        ->name('api.post');
    Route::post('file', 'SampleController@file')
        ->name('api.file');
    Route::post('json/post', 'SampleController@jsonPost')
        ->name('api.json.post');
});
