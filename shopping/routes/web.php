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




Route::get('/home', function () {
    return view('home');
});
Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@loginAdmin')->name('admin.login');
    Route::post('/login', 'AdminController@postloginAdmin')->name('admin.port-login');
    Route::get('/logout','AdminController@logoutAdmin')->name('admin.logout');
    Route::prefix('categories')->group(function () {
        Route::get('/', 'CategoryController@index')->name('categories.index')->middleware('can:category-list');
        Route::get('/create', 'CategoryController@create')->name('categories.create')->middleware('can:category-add');
        Route::post('/store', 'CategoryController@store')->name('categories.store');
        Route::get('/edit/{id}', 'CategoryController@edit')->name('categories.edit')->middleware('can:category-edit');
        Route::get('/delete/{id}', 'CategoryController@delete')->name('categories.delete')->middleware('can:category-delete');
        Route::post('/update/{id}', 'CategoryController@update')->name('categories.update');
    });
    Route::prefix('menus')->group(function () {
        Route::get('/', 'MenuController@index')->name('menus.index')->middleware('can:menu-list');
        Route::get('/create', 'MenuController@create')->name('menus.create')->middleware('can:menu-add');
        Route::get('/edit/{id}','MenuController@edit')->name('menus.edit')->middleware('can:menu-edit');
        Route::post('/update/{id}', 'MenuController@update')->name('menus.update');
        Route::get('/delete/{id}','MenuController@delete')->name('menus.delete')->middleware('can:menu-delete');
    });
    Route::prefix('products')->group(function () {
        Route::get('/', 'ProductController@index')->name('products.index')->middleware('can:product-list');
        Route::get('/create','ProductController@create')->name('products.create')->middleware('can:product-add');
        Route::post('/store','ProductController@store')->name('products.store');
        Route::get('/edit/{id}','ProductController@edit')->name('products.edit')->middleware('can:product-edit,id');
        Route::post('/update/{id}','ProductController@update')->name('products.update');
        Route::get('/delete/{id}','ProductController@delete')->name('products.delete')->middleware('can:product-delete');
    });
    Route::prefix('sliders')->group(function(){
        Route::get('/','SliderController@index')->name('sliders.index')->middleware('can:slider-list');
        Route::get('/create','SliderController@create')->name('sliders.create')->middleware('can:slider-add');
        Route::post('/store','SliderController@store')->name('sliders.store');
        Route::get('/edit/{id}','SliderController@edit')->name('sliders.edit')->middleware('can:slider-edit');
        Route::post('/update/{id}','SliderController@update')->name('sliders.update');
        Route::get('/delete/{id}','SliderController@delete')->name('sliders.delete')->middleware('can:slider-delete');
    });
    Route::prefix('settings')->group(function (){
        Route::get('/','AdminSettingController@index')->name('settings.index')->middleware('can:setting-list');
        Route::get('/create','AdminSettingController@create')->name('settings.create')->middleware('can:setting-add');
        Route::post('/store','AdminSettingController@store')->name('settings.store');
        Route::get('/edit/{id}','AdminSettingController@edit')->name('settings.edit')->middleware('can:setting-edit');
        Route::post('/update/{id}','AdminSettingController@update')->name('settings.update');
        Route::get('/delete/{id}','AdminSettingController@delete')->name('settings.delete')->middleware('can:setting-delete');
    });
    Route::prefix('users')->group(function (){
        Route::get('/','AdminUserSettingController@index')->name('users.index')->middleware('can:user-list');
        Route::get('/create','AdminUserSettingController@create')->name('users.create')->middleware('can:user-add');
        Route::post('/store','AdminUserSettingController@store')->name('users.store');
        Route::get('/edit/{id}','AdminUserSettingController@edit')->name('users.edit')->middleware('can:user-edit');
        Route::post('/update/{id}','AdminUserSettingController@update')->name('users.update');
        Route::get('/delete/{id}','AdminUserSettingController@delete')->name('users.delete')->middleware('can:user-delete');
    });
//    Route::prefix('roles')->group(function (){
//        Route::get('/','AdminRoleController@index')->name('roles.index')->middleware('can:role-list');
//        Route::get('/create','AdminRoleController@create')->name('roles.create')->middleware('can:role-add');
//        Route::post('/store','AdminRoleController@store')->name('roles.store');
//        Route::get('/edit/{id}','AdminRoleController@edit')->name('roles.edit')->middleware('can:role-edit');
//        Route::post('/update/{id}','AdminRoleController@update')->name('roles.update');
//        Route::post('/delete/{id}','AdminRoleController@delete')->name('roles.delete')->middleware('can:role-delete');
//    });
//    Route::prefix('users')->group(function (){
//        Route::get('/','AdminUserSettingController@index')->name('users.index');
//        Route::get('/create','AdminUserSettingController@create')->name('users.create');
//        Route::post('/store','AdminUserSettingController@store')->name('users.store');
//        Route::get('/edit/{id}','AdminUserSettingController@edit')->name('users.edit');
//        Route::post('/update/{id}','AdminUserSettingController@update')->name('users.update');
//        Route::get('/delete/{id}','AdminUserSettingController@delete')->name('users.delete');
//    });
    Route::prefix('roles')->group(function (){
        Route::get('/','AdminRoleController@index')->name('roles.index');
        Route::get('/create','AdminRoleController@create')->name('roles.create');
        Route::post('/store','AdminRoleController@store')->name('roles.store');
        Route::get('/edit/{id}','AdminRoleController@edit')->name('roles.edit');
        Route::post('/update/{id}','AdminRoleController@update')->name('roles.update');
        Route::post('/delete/{id}','AdminRoleController@update')->name('roles.delete');
    });
});

