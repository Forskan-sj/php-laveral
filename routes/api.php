<?php

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

Route::group(['namespace' => 'admin', 'prefix' => 'admin'], function() {
    Route::group(['prefix' => 'sss'], function() {
        Route::post('test2', 'Controller@test2');
        Route::get('test2', 'Controller@test2');
    });
});

Route::group(['namespace' => 'app', 'prefix' => 'app'], function() {
    Route::group(['prefix' => 'user'], function() {
        Route::get('getUserInfo', 'User@getInfo');
        Route::get('setUserInfo', 'User@setInfo');
    });

    Route::group(['prefix' => 'login'], function() {
        Route::post('checkUser', 'login@checkUser');
        Route::post('setUserInfo', 'login@setInfo');
    });

    Route::group(['prefix' => 'index', 'middleware' => 'Check'], function() {
        Route::post('getCate', 'index@getCate');
    });
});


