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

Route::get('/','HomeController@index')->name('home');
Route::get('/category/{slug}/{id}','CategoryController@index')->name('category.products');
Route::get('/product/add_to_card/{id}','ProductController@addToCart')->name('addToCart');
Route::get('/product/cart','ProductController@showCart')->name('Cart.index');

