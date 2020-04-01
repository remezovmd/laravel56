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


    
    // Маршруты для регистрации, авторизации
    Route::post('/register', 'Api\AuthController@register');
    Route::post('/login', 'Api\AuthController@login')->name('api-login');
    
    // Маршруты доступные только авторизованным пользователям
    Route::middleware('auth:api')->group(function () {
        // Маршрут для выхода
        Route::post('/logout', 'Api\AuthController@logout')->name('api-logout');
        
        // Маршруты для новостей
        Route::get('/articles', 'Api\ArticleController@index');
        Route::get('/articles/{id}', 'Api\ArticleController@show');
        Route::post('/articles', 'Api\ArticleController@store');
        Route::post('/articles/{id}', 'Api\ArticleController@update');
        Route::delete('/articles/{id}', 'Api\ArticleController@destroy');

        // Маршруты для профиля
        Route::get('/profile', 'Api\ProfileController@show');
        Route::post('/profile', 'Api\ProfileController@update');
    });