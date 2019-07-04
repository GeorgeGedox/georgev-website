<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::get('/portfolio', 'PortfolioController@index')->name('portfolio');

Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('', 'BlogController@index')->name('index');
    Route::get('/{slug}', 'BlogController@view')->name('view');
});

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    // Auth routes
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    app()->make('router')->resetPassword(); // Adds reset password routes

    // Routes
    Route::middleware('auth')->group(function (){
        Route::get('', 'Dashboard\HomeController@index')->name('index');

        Route::resource('portfolio', 'Dashboard\PortfolioController')->parameters(['portfolio' => 'project']);;
    });
});