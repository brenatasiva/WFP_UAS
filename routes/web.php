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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('brand', 'BrandController');
Route::resource('category', 'CategoryController');
Route::resource('product', 'ProductController');
Route::resource('image', 'ImageController');

Route::middleware(['auth'])->group(function () {
    Route::resource('transaction', 'TransactionController');
    Route::resource('transactionDetail', 'TransactionDetailController');
    Route::resource('role', 'RoleController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
