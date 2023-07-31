<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'point-of-sales', 'middleware' => 'auth'], function () {
    Route::get('/', 'PosController@index')->name('point_of_sales')->middleware('read_access');
    Route::get('/ajax', 'PosController@ajax')->name('point_of_sales_ajax')->middleware('read_access');
    Route::post('/ajax/add-customer', 'PosController@ajaxAddCustomer')->name('ajax_add_customer')->middleware('create_access');
    Route::get('/checkout', 'PosController@checkout')->name('checkout')->middleware('read_access');
    Route::get('/ajax/checkout', 'PosController@ajaxCheckout')->name('ajax_checkout')->middleware('read_access');
});
