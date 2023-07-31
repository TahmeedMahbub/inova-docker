<?php



Route::group(['prefix' => 'recurring-invoices','middleware'=>'auth'], function () {
    Route::get('/', 'RecurringInvoiceWebController@index')->name('recurring_invoices_index');
    Route::post('/', 'RecurringInvoiceWebController@search')->name('recurring_invoices_index');
    Route::get('/create', 'RecurringInvoiceWebController@create')->name('recurring_invoices_create');
    Route::post('/store', 'RecurringInvoiceWebController@store')->name('recurring_invoices_store');
    Route::get('/edit/{id}', 'RecurringInvoiceWebController@edit')->name('recurring_invoices_edit');
    Route::get('/show/{id}', 'RecurringInvoiceWebController@show')->name('recurring_invoices_show');
    Route::post('/update/{id}', 'RecurringInvoiceWebController@update')->name('recurring_invoices_update');
    Route::get('/delete/{id}', 'RecurringInvoiceWebController@destroy')->name('recurring_invoices_delete');
   
});
