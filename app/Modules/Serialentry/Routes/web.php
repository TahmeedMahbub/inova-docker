<?php



Route::group(['prefix' => 'serialentry'], function () {
    Route::get('/', 'SerialEntryController@index')->name('serial_entry');
    Route::get('/create', 'SerialEntryController@create')->name('serial_entry_create');
    Route::get('/bill-select', 'SerialEntryController@create')->name('serial_entry_create');
    Route::post('/product-by-bill', 'SerialEntryController@productByBill')->name('product_by_bill');
    Route::post('/store', 'SerialEntryController@store')->name('serial_entry_store');
    Route::get('/edit/{id}', 'SerialEntryController@edit')->name('serial_entry_edit');
    Route::post('/update', 'SerialEntryController@update')->name('serial_entry_update');
    Route::get('/delete/{id}', 'SerialEntryController@delete')->name('serial_entry_delete');

});
