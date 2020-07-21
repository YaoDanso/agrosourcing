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

Route::get('/', 'WebsiteController@home')->name('web.home');
Route::get('/about', 'WebsiteController@about')->name('web.about');
Route::get('/sourcemap', 'WebsiteController@sourcemap')->name('web.sourcemap');
Route::get('/upcycling', 'WebsiteController@upcycling')->name('web.upcycling');
Route::get('/research', 'WebsiteController@research')->name('web.research');
Route::get('/contact', 'WebsiteController@contact')->name('web.contact');

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

    Route::get('/mark-as-read', 'HomeController@markAsRead')->name('user.mark.notify');
    Route::get('/notifications', 'HomeController@notifications')->name('user.notifications');


    //============= Truckers ============
    Route::get('/create-trucker', 'TruckerController@create')->name('user.add.trucker');
    Route::get('/view-truckers', 'TruckerController@index')->name('user.view.trucker');
    Route::post('/create-trucker', 'TruckerController@store')->name('user.store.trucker');
});

Route::prefix('admin')->group(function (){
    Route::get('/','AdminController@home')->name('admin.dashboard');
    Route::get('/login','Auth\AdminLoginController@userLogin')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@userLogout')->name('admin.logout');

    //======== Product =======
    Route::get('/add-product', 'AdminController@addProduct')->name('admin.add.product');
    Route::post('/add-product', 'AdminController@storeProduct')->name('admin.store.product');
    Route::get('/view-products', 'AdminController@viewProduct')->name('admin.view.product');
    Route::get('/show-products/{product}', 'AdminController@showProduct')->name('admin.show.product');
    Route::get('/hide-products/{product}', 'AdminController@hideProduct')->name('admin.hide.product');
    //======== Warehouse =======
    Route::get('/add-warehouse', 'AdminController@addWarehouse')->name('admin.add.warehouse');
    Route::post('/add-warehouse', 'AdminController@storeWarehouse')->name('admin.store.warehouse');
    Route::get('/view-warehouse', 'AdminController@viewWarehouse')->name('admin.view.warehouse');
    Route::get('/show-warehouse/{warehouse}', 'AdminController@showWarehouse')->name('admin.show.warehouse');
    Route::get('/hide-warehouse/{warehouse}', 'AdminController@hideWarehouse')->name('admin.hide.warehouse');
    //======== Farm =======
    Route::get('/add-farm', 'AdminController@addFarm')->name('admin.add.farm');
    Route::post('/add-farm', 'AdminController@storeFarm')->name('admin.store.farm');
    Route::get('/view-farm', 'AdminController@viewFarm')->name('admin.view.farm');
    Route::get('/show-farm/{farm}', 'AdminController@showFarm')->name('admin.show.farm');
    Route::get('/hide-farm/{farm}', 'AdminController@hideFarm')->name('admin.hide.farm');

    //========== Users============
    Route::get('/users', 'AdminController@viewUsers')->name('admin.view.users');
    Route::get('/suspend-user/{id}', 'AdminController@suspendUser')->name('admin.suspend.user');
    Route::get('/unsuspend-user/{id}', 'AdminController@unsuspendUser')->name('admin.unsuspend.user');
    Route::get('/approve-user/{id}', 'AdminController@approveUser')->name('admin.approve.user');

    //=========== Admin Notification
    Route::get('mark-as-read','AdminController@markAsRead')->name('admin.notification.read');

    //====== Roles =========
    Route::get('roles','AdminController@roles')->name('admin.roles');
    Route::post('role','AdminController@role')->name('admin.roles.submit');
    Route::get('role/{role}','AdminController@roleDelete')->name('admin.roles.delete');


    //============== Waste ============
    Route::get('waste-management','AdminController@addWaste')->name('admin.add.waste');
    Route::post('waste-management','AdminController@postWaste')->name('admin.post.waste');
    Route::get('waste-management/{waste}','AdminController@wasteDelete')->name('admin.delete.waste');

    //============= Crop ============
    Route::get('crop','AdminController@addCrop')->name('admin.add.crop');
    Route::post('crop','AdminController@postCrop')->name('admin.post.crop');
    Route::get('delete-crop/{crop}','AdminController@cropDelete')->name('admin.delete.crop');

    //=========== Truck =========
    Route::resource('trucks','TruckController');
    Route::get('delete-truck/{truck}','Truckcontroller@deleteTruck')->name('admin.truck.delete');
    Route::get('view-truckers','AdminController@viewTruckers')->name('admin.trucker.view');
});

Route::get('/home', 'HomeController@index')->name('home');
