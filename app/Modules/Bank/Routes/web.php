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

Route::group(['prefix' => 'bank', 'middleware' => 'auth'], function () {

    Route::get('/deposit', 'HomeController@deposit')->name('bank_deposit')->middleware('read_access');
    Route::get('/withdraw', 'HomeController@withdraw')->name('bank_withdraw')->middleware('read_access');

    Route::post('/deposit/search', 'HomeController@searchDeposit')->name('deposit_search');
    Route::post('/withdraw/search', 'HomeController@searchWithdraw')->name('withdraw_search');


    Route::get('create/{id}', 'HomeController@create')->name('bank_create')->middleware('create_access');

    Route::post('store', 'HomeController@store')->name('bank_store')->middleware('create_access');
    Route::get('show/{id}', 'HomeController@show')->name('bank_show')->middleware('read_access');
    Route::post('show/{id}', 'HomeController@showupload')->name('bank_show_upload');
    Route::get('edit/{id}', 'HomeController@edit')->name('bank_edit')->middleware('read_access');
    Route::post('update/{id}', 'HomeController@update')->name('bank_update')->middleware('update_access');
    Route::get('delete/{id}', 'HomeController@destroy')->name('bank_delete')->middleware('delete_access');

    // report
    Route::get('/report', 'HomeController@report')->name('bank_report')->middleware('read_access');
    Route::post('/report', 'HomeController@bankreportfilter')->name('bank_report_filter')->middleware('read_access');
    Route::get('/report/{id}/{branch_id}/{start}/{end}', 'HomeController@reportDetails')->name('bank_report_details')->middleware('read_access');
    Route::post('/report/{id}/{branch_id}', 'HomeController@processfilterForm')->name('bank_report_form')->middleware('read_access');
});

Route::group(['prefix' => 'cheque-book', 'middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@chequeBook')->name('cheque_book')->middleware('read_access');
    Route::get('/create', 'HomeController@createChequeBook')->name('cheque_book_create')->middleware('create_access');
    Route::post('/store', 'HomeController@storeChequeBook')->name('cheque_book_store')->middleware('create_access');
    Route::get('/edit/{id}', 'HomeController@editChequeBook')->name('cheque_book_edit')->middleware('update_access');
    Route::post('/update/{id}', 'HomeController@updateChequeBook')->name('cheque_book_update')->middleware('update_access');
    Route::get('delete/{id}', 'HomeController@destroyChequeBook')->name('cheque_book_delete')->middleware('delete_access');
    Route::get('/get-cheque-number/{id}', 'HomeController@getChequeNumber')->name('get_cheque_number');
    Route::get('/available-cheque-number/{id}', 'HomeController@availableChequeNumber')->name('available_cheque_number');
});
