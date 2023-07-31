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

Route::group(['prefix' => 'vendor-credit','middleware=>auth'], function () {
    Route::get('/', 'VendorCreditController@index')->name('vendor_credit_index');
    Route::post('/', 'VendorCreditController@search')->name('vendor_credit_search');
    Route::get('/create', 'VendorCreditController@create')->name('vendor_credit_create');
    Route::post('/store', 'VendorCreditController@store')->name('vendor_credit_store');
    Route::get('/edit/{id}', 'VendorCreditController@edit')->name('vendor_credit_edit');
    Route::post('/update/{id}', 'VendorCreditController@update')->name('vendor_credit_update');
    Route::get('/delete/{id}', 'VendorCreditController@delete')->name('vendor_credit_delete');
    Route::get('/show/{id}', 'VendorCreditController@show')->name('vendor_credit_show');
});

Route::group(['prefix' => 'vendor-credit/refund', 'middleware' => 'auth'], function () {

    Route::get('/', 'VendorRefundController@index')->name('vendor_credit_refund')->middleware('read_access');
    Route::get('create/{id}', 'VendorRefundController@create')->name('vendor_credit_refund_create');
    Route::post('store', 'VendorRefundController@store')->name('vendor_credit_refund_store');
    Route::get('show/{id}', 'VendorRefundController@show')->name('vendor_credit_refund_show')->middleware('read_access');
    Route::get('edit/{id}', 'VendorRefundController@edit')->name('vendor_credit_refund_edit')->middleware('update_access');
    Route::post('update/{id}', 'VendorRefundController@update')->name('vendor_credit_refund_update')->middleware('update_access');
    Route::get('delete/{id}', 'VendorRefundController@destroy')->name('vendor_credit_refund_delete')->middleware('delete_access');

});
