<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

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

Route::pattern('lang', 'en|ru');

Route::redirect('/', App::getLocale());

Route::group(['prefix' => '{lang}'], function(){

    App::setLocale(Request::segment(1));

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('login','Auth\\LoginController@showLoginForm')->name('login');
    Route::post('login','Auth\\LoginController@store')->name('login.store');
    Route::get('logout','Auth\\LoginController@loggedOut')->name('logout');

    Route::get('register','Auth\\RegisterController@showRegisterForm')->name('register');
    Route::post('register','Auth\\RegisterController@store')->name('register.store');

    Route::get('password/forgot','Auth\\ForgotPasswordController@showEmailForm')->name('password.request');
    Route::post('password/forgot','Auth\\ForgotPasswordController@store')->name('password.email');

    Route::get('password/reset/{token}','Auth\\ResetPasswordController@showPasswordResetForm')->name('reset.password');
    Route::post('password/reset/{token}','Auth\\ResetPasswordController@store')->name('password.update');

    Route::get('verification','Auth\\VerificationController@index')->name('verification');



    Route::middleware('auth')->group(function (){
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    });

});
