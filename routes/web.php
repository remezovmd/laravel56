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
    return view('auth.login');
});

Auth::routes();

// Маршруты доступные только авторизованным пользователям
Route::middleware('auth:web')->group(function () {
    // Маршруты для профиля
    Route::any('/profile-show', 'ProfileController@index')->name('profile-show');
    Route::post('/profile-update', 'ProfileController@update')->name('profile-update');

    // Маршруты для новостей
    Route::get('/articles-view', function() {
        return view ('articles-view');
    })->name('articles-view');

    Route::get('/articles', 'Api\ArticleController@index');
    Route::get('/articles/{id}', 'Api\ArticleController@show');
    Route::post('/articles', 'Api\ArticleController@store');
    Route::patch('/articles/{id}', 'Api\ArticleController@update');
    Route::delete('/articles/{id}', 'Api\ArticleController@destroy');
});

