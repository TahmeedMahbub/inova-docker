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

Route::group(['prefix' => 'billsubmit' , 'middleware' => 'auth'], function () {
    Route::get('/', 'BillSubmitWebController@index')->name('bill_submit')->middleware('read_access');
    Route::post('/', 'BillSubmitWebController@search')->name('bill_search_submit')->middleware('read_access');
    Route::get('create', 'BillSubmitWebController@create')->name('bill_submit_create')->middleware('create_access');
    Route::post('store', 'BillSubmitWebController@store')->name('bill_submit_store')->middleware('create_access');
    Route::get('show/{id}', 'BillSubmitWebController@show')->name('bill_submit_show')->middleware('read_access');
    Route::post('show/{id}', 'BillSubmitWebController@showupload')->name('bill_submit_show_upload');
    Route::get('edit/{id}', 'BillSubmitWebController@edit')->name('bill_submit_edit')->middleware('update_access');


    Route::post('update/{id}', 'BillSubmitWebController@update')->name('bill_submit_update')->middleware('update_access');
    //Route::get('mark/update/{id}', 'BillWebController@markupdate')->name('bill_update_mark')->middleware('update_access');
    Route::get('delete/{id}', 'BillSubmitWebController@destroy')->name('bill_submit_delete')->middleware('delete_access');

    //Route::post('use-bill-excess-payment', 'BillWebController@useExcessPayment')->name('post_bill_excess_payment')->middleware('auth');

    //pending bill submit route
    Route::get('/pending', 'PendingBillController@index')->name('bill_submit_pending_bill')->middleware('read_access');
    Route::post('/pending/search', 'PendingBillController@search')->name('bill_search_pending_bill')->middleware('read_access');
    Route::get('/pendingBill/approval/{id}', 'PendingBillController@show')->name('pending_bill_approval')->middleware('read_access');
    Route::post('/pendingBill/update/{id}', 'PendingBillController@update')->name('pending_bill_update')->middleware('read_access');

    //rejected bill submit route
    Route::get('/rejected', 'RejectedBillController@index')->name('bill_submit_rejected_bill')->middleware('read_access');
    Route::post('/rejected/search', 'RejectedBillController@search')->name('bill_search_rejected_bill')->middleware('read_access');
    Route::get('/rejectBill/approval/{id}', 'RejectedBillController@show')->name('rejected_bill_approval')->middleware('read_access');
    Route::post('/rejectBill/update/{id}', 'RejectedBillController@update')->name('rejected_bill_update')->middleware('read_access');


});

Route::group(['prefix' => 'api/billsubmit', 'middleware' => 'auth'], function () {

    Route::get('/get-item-rate/{id}', 'BillSubmitApiController@getItemRate')->middleware('auth');
    Route::get('/get-bill-submit-entry/{id}/{currencyId}', 'BillSubmitApiController@getBillEntry')->middleware('auth');
    Route::get('/get-due-balance/{id}', 'BillSubmitApiController@getDueBalance')->middleware('auth');

});
