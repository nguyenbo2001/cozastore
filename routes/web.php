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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/products', 'ProductController@index')->name('products');


Route::get('/modal-product/{product}', 'ProductController@modalProduct')->name('modalProduct');

Route::get('/load-more/{current_page}', 'ProductController@loadMore')->name('loadMoreProduct');

Route::post('/product-add-cart/{product}', 'ProductController@addCart')->name('productAddCart');