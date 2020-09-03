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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/stores/{store}', 'StoreController@index')->name('store');
Route::get('/store/create', 'StoreController@create')->name('store.create')->middleware('administration');
Route::post('/store/save', 'StoreController@save')->name('store.save')->middleware('administration');

Route::get('/items/create', 'ItemController@create')->name('item.create')->middleware('administration');
Route::post('/items/save', 'ItemController@save')->name('item.save')->middleware('administration');
Route::get('/items/view/{item}', 'ItemController@viewItem')->name('item.view');

Route::get('/cart', 'CartController@index')->name('cart')->middleware('auth');
Route::get('/cart/add/{item}', 'CartController@addItem')->name('cart.addItem');
Route::get('/cart/remove/{item}', 'CartController@removeItem')->name('cart.removeItem');
Route::get('/errors/forbidden', 'ErrorsController@forbidden')->name('errors.forbidden');

Route::get('/configuration', 'ConfigurationController@configuration')->name('configuration')->middleware('administration');

Route::get('/users/edit', 'UserController@index')->name('user.list')->middleware('administration');

Route::get('/orders', 'OrderController@index')->name('orders')->middleware('administration');
Route::post('/orders/send', 'OrderController@send')->name('orders.send')->middleware('auth');

Route::get('/categories/view/{category}', 'CategoryController@index')->name('categories.view');
Route::get('/categories/create', 'CategoryController@create')->name('categories.create')->middleware('auth');
Route::post('/categories/save', 'CategoryController@save')->name('categories.save')->middleware('auth');
