<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::get('/projects', 'ProjectsController@index')->name('projects');
Route::get('/contact', 'ContactController@index')->name('contact');

Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('', 'BlogController@index')->name('index');
    Route::get('/{slug}', 'BlogController@view')->name('view');
});

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    // Auth routes
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::resetPassword(); // Adds reset password routes

    // Routes
    Route::middleware('auth')->group(function (){
        // Home
        Route::get('', 'Dashboard\HomeController@index')->name('index');

        // Profile
        Route::get('/profile', 'Dashboard\ProfileController@edit')->name('profile.edit');
        Route::patch('/profile', 'Dashboard\ProfileController@update')->name('profile.update');
        Route::patch('/profile/password', 'Dashboard\ProfileController@passwordUpdate')->name('profile.password');

        // Projects
        Route::resource('projects', 'Dashboard\ProjectsController');

        // Blog
        Route::resource('blog', 'Dashboard\BlogController')->parameter('blog', 'post');

        // Settings
        Route::prefix('settings')->name('settings.')->group(function (){
            // General
            Route::get('/general', 'Dashboard\Settings\GeneralController@index')->name('general.index');
            Route::post('/general/maintenance', 'Dashboard\Settings\GeneralController@maintenance')->name('general.maintenance');
            Route::post('/general/seo', 'Dashboard\Settings\GeneralController@seo')->name('general.seo');
            Route::post('/general/social', 'Dashboard\Settings\GeneralController@social')->name('general.social');

            Route::post('/general/dribbble', 'Dashboard\Settings\GeneralController@dribbble')->name('general.dribbble');
            Route::get('/general/dribbble', 'Dashboard\Settings\GeneralController@dribbbleAuth')->name('general.dribbble-auth');
            Route::put('/general/dribbble', 'Dashboard\Settings\GeneralController@dribbbleReset')->name('general.dribbble-reset');
        });
    });
});