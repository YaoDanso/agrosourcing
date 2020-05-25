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

    //========= AGGREGATOR ===========
    Route::get('/add-warehouse','WarehouseController@create')->name('user.add.warehouse');
    Route::post('/add-warehouse','WarehouseController@store')->name('user.store.warehouse');
    Route::get('/view-warehouse','WarehouseController@index')->name('user.view.warehouse');

    //========= PRODUCT ===========
    Route::get('/add-product','ProductController@create')->name('user.add.product');
    Route::post('/add-product','ProductController@store')->name('user.store.product');
    Route::get('/view-product','ProductController@index')->name('user.view.product');

    //=========== OrderList ============
    Route::get('/products','HomeController@orderList')->name('user.view.orderList');
    Route::get('/checkout','HomeController@billing')->name('user.view.billing');
    Route::post('/checkout','HomeController@checkout')->name('user.checkout');
    Route::get('/view-cart','HomeController@cart')->name('user.view.cart');
    Route::get('/remove-cart/{id}','HomeController@removeCart')->name('user.remove.cart');
    Route::get('/product/{id}/order/{type}','HomeController@orderListDetail')->name('user.view.orderList.detail');
    Route::get('/add/{id}/{type}','HomeController@addToCart')->name('user.add.cart');

    //============= User Map ============
    Route::get('/access/map','HomeController@accessMap')->name('user.map');
});

Route::prefix('admin')->group(function (){
    Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
});

Route::get('/home', 'HomeController@index')->name('home');
