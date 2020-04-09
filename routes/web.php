<?php

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

Route::get('/', function () {
    return redirect()->route('user.welcome');
});

Auth::routes();

//=========== User Verify Account ==========
Route::get('/verify/token/{token}', 'Auth\RegisterController@verifyUser');

Route::prefix('user')->group(function (){
    //=========== Authentication for Users ============
    Route::get('/login','Auth\LoginController@showLoginForm')->name('user.login');
    Route::post('/login','Auth\LoginController@login')->name('user.login.submit');
    Route::get('/reset-password','Auth\ForgotPasswordController@showLinkRequestForm')->name('user.reset.password');
    Route::post('/reset-password','Auth\ForgotPasswordController@sendResetLinkEmail')->name('user.reset.post');

    Route::get('/password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('user.password.reset');
    Route::post('/password/reset','Auth\ResetPasswordController@reset')->name('user.password.reset.post');

    Route::get('/register','Auth\RegisterController@showRegistrationForm')->name('user.register');
    Route::post('/register','Auth\RegisterController@register')->name('user.register.submit');
    Route::get('logout', 'Auth\LoginController@userLogout')->name('user.logout');

    //============ Dashboard ==========
    Route::get('/', 'HomeController@index')->name('user.welcome');

    //*****================= user profile management ======================****
    Route::get('/profile', 'ProfileController@index')->name('user.profile');
    Route::post('/profile/change-password', 'ProfileController@changePassword')->name('user.change.password');
    Route::post('/profile/change-bio', 'ProfileController@updateBio')->name('user.change.bio');
    Route::post('/profile/change-detail', 'ProfileController@updateDetail')->name('user.change.detail');

    //****=========== Farmer Roles ==========**********
    Route::get('/add-farm', 'FarmController@create')->name('user.add.farm');
    Route::post('/add-farm', 'FarmController@store')->name('user.store.farm');
    Route::get('/view-farm', 'FarmController@index')->name('user.view.farm');

});

Route::prefix('admin')->group(function (){

});

Route::get('/home', 'HomeController@index')->name('home');
