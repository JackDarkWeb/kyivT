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

use Illuminate\Support\Facades\App;
use Stichoza\GoogleTranslate\GoogleTranslate;

Route::pattern('language', 'en|ru');

Route::redirect('/', 'en');

Route::group(['prefix' => '{language}'], function(){

    App::setLocale(Request::segment(1));

    Auth::routes();

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');



});

