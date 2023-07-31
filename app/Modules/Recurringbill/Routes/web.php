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

Route::group(['prefix' => 'recurring-bill','middleware'=>'auth'], function () {
    Route::get('/', 'RecurringBillController@index')->name('recurring_bill_index');
    Route::get('/create', 'RecurringBillController@create')->name('recurring_bill_create');
    Route::post('/store', 'RecurringBillController@store')->name('recurring_bill_store');
    Route::get('/edit/{id}', 'RecurringBillController@edit')->name('recurring_bill_edit');
    Route::get('/show/{id}', 'RecurringBillController@show')->name('recurring_bill_show');
    Route::post('/update/{id}', 'RecurringBillController@update')->name('recurring_bill_update');
    Route::get('/delete/{id}', 'RecurringBillController@destroy')->name('recurring_bill_delete');
});