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

Route::group(['prefix' => 'invoice/pdf', 'middleware' => 'auth'], function () {
    Route::get('/contractapplication', 'Pdf\PostController@contractApplication')->name('invoice_pdf_contact_application');
});

Route::group(['prefix' => 'invoice-measurements', 'middleware' => 'auth'], function () {
    Route::get('/measurements', 'PosWebController@measurements')->name('pos_invoice_measurements')->middleware('read_access');
    Route::get('/show/measurements/{id}', 'PosWebController@showMeasurements')->name('pos_invoice_show_measurements')->middleware('read_access');
    Route::get('/create/measurements', 'PosWebController@addMeasurements')->name('pos_invoice_add_measurements')->middleware('create_access');
    Route::post('/store/tempMeasurements', 'PosWebController@addTempMeasurements')->name('pos_invoice_add_temp_measurements')->middleware('create_access');
    Route::post('/update/tempMeasurements', 'PosWebController@updateTempMeasurements')->name('pos_invoice_update_temp_measurements')->middleware('create_access');
    Route::post('/store/measurements', 'PosWebController@storeMeasurements')->name('pos_invoice_store_measurements')->middleware('create_access');
    Route::get('/edit/measurements/{id}', 'PosWebController@editMeasurements')->name('pos_invoice_edit_measurements')->middleware('create_access');
    Route::post('/edit/measurements/{id}', 'PosWebController@updateMeasurements')->name('pos_invoice_update_measurements')->middleware('create_access');
    Route::get('/send/measurements/{id}', 'PosWebController@sendMessage')->name('pos_invoice_send_message')->middleware('create_access');

    Route::post('/create/getMeasurementValue', 'PosWebController@getMeasurementValue')->name('pos_invoice_get_measurement_value')->middleware('create_access');

    Route::get('change-status/{id}', 'PosWebController@changeStatus')->name('pos_invoice_change_measurement_status');
});

Route::group(['prefix' => 'get-pos', 'middleware' => 'auth'], function () {

    Route::get('/', 'PosWebController@index')->name('pos')->middleware('read_access');
    Route::post('/', 'PosWebController@search')->name('invoice_search')->middleware('read_access');
    Route::get('/create', 'PosWebController@create')->name('pos_invoice_create')->middleware('create_access');
    //dfd
    Route::get('/check/serial/{serial}', 'PosWebController@checkSerial')->name('check_serial')->middleware('create_access');
    Route::get('/item-check/serial', 'PosWebController@itemListStockSerial')->name('item_list_stock_serial')->middleware('create_access');
    //checking route

    Route::post('/store', 'PosWebController@store')->name('pos_invoice_store')->middleware('create_access');
    Route::get('/store', 'PosWebController@store')->name('invoice_store_get')->middleware('create_access');
    Route::post('/check/item', 'PosWebController@ajaxcheck')->name('check_item')->middleware('create_access');
    Route::get('/check/customer/credit/{id}', 'PosWebController@ajaxCreditcheck')->name('check_customer_credit')->middleware('create_access');

    Route::get('/receive/payment/details/{id}', 'PosWebController@receiveInvoicePaymentDetails')->name('receive_invoice_payment_details')->middleware('create_access');
    Route::post('/receive/payment', 'PosWebController@receiveInvoicePayment')->name('receive_invoice_payment')->middleware('create_access');

    Route::post('/check/edit', 'PosWebController@ajaxEditcheck')->middleware('create_access');


    Route::post('/ajax/check', 'PosWebController@ajaxInvoicecheck')->middleware('create_access');

    Route::post('/ajax/show/item', 'PosWebController@ajaxShowItem')->name('ajax_show_item')->middleware('create_access');


    Route::post('/ajax/create/stock', 'PosWebController@ajaxCreateStock')->name('ajax_create_stock')->middleware('create_access');



    Route::get('/show/{id}', 'PosWebController@show')->name('pos_invoice_show')->middleware('read_access');

    Route::post('/show/{id}', 'PosWebController@showupload')->name('invoice_show_upload');
    Route::get('/edit/{id}', 'PosWebController@edit')->name('pos_invoice_edit')->middleware('update_access');
    Route::post('/update/{id}', 'PosWebController@update')->name('invoice_update')->middleware('update_access');
    Route::post('/invoice-update/{id}', 'PosWebController@adjustmentupdate')->name('invoice_adjustment_update')->middleware('update_access');
    Route::get('/delete/{id}', 'PosWebController@destroy')->name('invoice_delete')->middleware('delete_access');

    Route::post('/use-credit', 'PosWebController@useCredit')->name('post_use_credit')->middleware('auth');
    Route::post('/use-excess-payment', 'PosWebController@useExcessPayment')->name('post_excess_payment')->middleware('auth');

    Route::get('/delete-credit/{id}', 'AppliedPaymentController@deleteCredit')->name('delete_credit')->middleware('auth');
    Route::get('/delete-excess/{id}', 'AppliedPaymentController@deleteExcess')->name('delete_excess')->middleware('auth');
    Route::get('/invoice-download/{id}', 'PosWebController@download')->middleware('read_access');
    Route::get('/challan/{id}', 'PosWebController@challan')->middleware('read_access');
    Route::post('/challan/update/{id}', 'PosWebController@challanUpdate')->name('invoice_challan_update')->middleware('update_access');


    //shanto route create

    Route::get('/save/{id}', 'PosWebController@saveUpdate')->name('invoice_update_save')->middleware('read_access');
    // Route::get('save2/{id}', 'PosWebController@saveUpdate2')->name('invoice_update_save')->middleware('read_access');
    Route::post('/save/{id}', 'PosWebController@showStock')->name('invoice_update_stock')->middleware('read_access');
    Route::post('/add/{id}', 'PosWebController@addStock')->name('adding_stock')->middleware('read_access');

    Route::get('/sales-return/{id}', 'SalesReturn\WebController@create')->name('sales_return');
    Route::post('/sales-return/update/{id}', 'SalesReturn\WebController@update')->name('sales_return_update');

    Route::get('/item-category-check/{id}', 'PosWebController@itemCaegory')->name('item_category_check');
    Route::get('/item-check', 'PosWebController@itemList')->name('item_list');
    Route::get('/check/item/rate/{id}', 'PosWebController@itemRate')->name('item_rate');
});


Route::group(['prefix' => 'api/invoice', 'middleware' => 'auth'], function () {

    Route::get('/get-item-rate/{id}', 'InvoiceApiController@getItemRate')->middleware('auth');
    Route::get('/get-item-rate2/{id}/{contact_id}', 'InvoiceApiController@getItemRate2')->middleware('auth');
    Route::get('/get-invoice-entry/{id}', 'InvoiceApiController@getInvoiceEntry')->middleware('auth');
    Route::get('/get-due-balance/{id}', 'InvoiceApiController@getDueBalance')->middleware('auth');
    Route::get('/get-credit-available/{invoice_id}/{credit_note_id}', 'InvoiceApiController@creditAvailable')->middleware('auth');
});

Route::group(['prefix' => 'pos', 'middleware' => 'auth'], function () {

    Route::get('/', 'Pos\PosInvoicController@index')->name('point_of_sales_index');
    Route::post('/', 'Pos\PosInvoicController@search')->name('point_of_sales_search');
    Route::get('/create', 'Pos\PosInvoicController@create')->name('point_of_sales_create');
    Route::post('/store', 'Pos\PosInvoicController@store')->name('point_of_sales_store');
    Route::get('/edit/{id}', 'Pos\PosInvoicController@edit')->name('point_of_sales_edit');
    Route::get('/show/{id}', 'Pos\PosInvoicController@show')->name('point_of_sales_show');
    Route::post('/update/{id}', 'Pos\PosInvoicController@update')->name('point_of_sales_update');
    Route::get('/delete/{id}', 'Pos\PosInvoicController@destroy')->name('point_of_sales_delete');


    Route::get('/check/serial/{serial}', 'Pos\PosInvoicController@checkSerial')->name('check_serial');
    Route::get('/item-check/serial', 'Pos\PosInvoicController@itemListStockSerial')->name('item_list_stock_serial');
    Route::get('/customer/name/{id}', 'Pos\PosInvoicController@customer')->name('customer_name');
    Route::get('/show-map/{id}', 'Pos\PosInvoicController@showMap')->name('invoice_show2');
});


Route::group(['prefix' => 'sales-return', 'middleware' => 'auth'], function () {
    Route::get('/index', 'SalesReturn\WebController@index')->name('sales_return_index');
    Route::get('/create', 'SalesReturn\WebController@create')->name('sales_return_create');
    Route::post('/store', 'SalesReturn\WebController@store')->name('sales_return_store');
    Route::get('/ajax/invoices/{customer_id}', 'SalesReturn\WebController@ajax_invoice')->name('ajax_invoices');
    Route::get('/ajax/products/{invoice_id}', 'SalesReturn\WebController@ajax_product')->name('ajax_products');
    Route::get('/ajax/quantity/{invoice_id}/{product_id}', 'SalesReturn\WebController@ajax_quantity')->name('ajax_quantity');
});


