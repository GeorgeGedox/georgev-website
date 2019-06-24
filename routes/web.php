<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::get('/portfolio', 'PortfolioController@index')->name('portfolio');

Route::prefix('blog')->name('blog.')->group(function (){
    Route::get('', 'BlogController@index')->name('index');
    Route::get('/{slug}', 'BlogController@view')->name('view');
});