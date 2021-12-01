<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::resource('brand', 'BrandController');
Route::resource('category', 'CategoryController');
Route::resource('product', 'ProductController');
Route::resource('image', 'ImageController');

Route::get('/', 'ProductController@index');
Route::get('/product/category/{id}', 'ProductController@getProductPerCategory')->name('product.laptop');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/compare', 'ProductController@compareProduct')->name('compareProduct');
Route::get('/forget', 'TransactionController@forgetSession');

Route::middleware(['auth'])->group(function () {
    Route::resource('transaction', 'TransactionController');
    Route::resource('transactionDetail', 'TransactionDetailController');
    Route::resource('role', 'RoleController');

    Route::post('/transaction/showDetail', 'TransactionController@showDetail')->name('transaction.showDetail');
    Route::post('kplaptop', 'ProductController@kumpulanLaptop')->name('kumpulanLaptop');
    Route::post('getlaptop', 'ProductController@getLaptop')->name('getLaptop');
    Route::post('getlaptopdata', 'ProductController@getLaptopData')->name('getLaptopData');

    Route::get('cart', 'ProductController@cart');
    Route::get('add-to-cart/{id}', 'ProductController@addToCart');
    Route::get('showSpec', 'ProductController@showSpec')->name('product.showSpec');
    Route::get('checkout', 'TransactionController@formSubmit');
    Route::get('submit_checkout', 'TransactionController@submitCheckout')->name('submitCheckout');
    Route::get('history', 'TransactionController@show');
    Route::get('showHistory', 'TransactionController@showHistory');
});

Auth::routes();
