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
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    //Customer Module
    Route::resource('customer', 'CustomerController'); 
    Route::any('/customer/edit/{id}','CustomerController@create')->name('customer.edit');
    Route::any('/customer/delete/{id}','CustomerController@destroy')->name('customer.delete');

    //Product Module
    Route::resource('product', 'ProductController'); 
    Route::any('/product/edit/{id}','ProductController@create')->name('product.edit');
    Route::any('/product/delete/{id}','ProductController@destroy')->name('product.delete');

    //Order Module
    Route::resource('order', 'OrderController'); 
    Route::any('/order/edit/{id}','OrderController@create')->name('order.edit');
    Route::any('/order/delete/{id}','OrderController@destroy')->name('order.delete');
    Route::any('/order/date-list/delete', 'OrderController@DeleteProductItemData')->name('productitemdata.delete');
    Route::any('/order/view/{id}','OrderController@show')->name('order.view');

});