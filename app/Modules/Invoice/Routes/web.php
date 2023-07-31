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
Route::group(['prefix' => 'invoice', 'middleware' => 'auth'], function () {

    //Depo Sale Routes
    Route::get('/', 'InvoiceWebController@index')->name('invoice')->middleware('read_access');
    Route::post('/', 'InvoiceWebController@search')->name('invoice_search')->middleware('read_access');
    Route::get('/create', 'InvoiceWebController@create')->name('invoice_create')->middleware('create_access');
    Route::post('/store', 'InvoiceWebController@store')->name('invoice_store')->middleware('create_access');
    Route::get('/edit/{id}', 'InvoiceWebController@edit')->name('invoice_edit')->middleware('update_access');
    Route::post('/update/{id}', 'InvoiceWebController@update')->name('invoice_update')->middleware('update_access');
    Route::get('/delete/{id}', 'InvoiceWebController@destroy')->name('invoice_delete')->middleware('delete_access');
    Route::get('/show/{id}', 'InvoiceWebController@show')->name('invoice_show')->middleware('read_access');

    //Depo Sale Routes
    Route::get('/depo-sales', 'InvoiceWebController@depoSalesIndex')->name('depo_sales')->middleware('read_access');
    Route::post('/depo-sales', 'InvoiceWebController@depoSalesIndex')->name('depo_sales_search')->middleware('read_access');
    Route::get('/depo-sales/create', 'InvoiceWebController@depoSalesCreate')->name('depo_sales_create')->middleware('create_access');
    Route::post('depo-sales/store', 'InvoiceWebController@depoSalesStore')->name('depo_sales_store')->middleware('create_access');
    Route::get('/depo-sales/edit/{id}', 'InvoiceWebController@depoSalesEdit')->name('depo_sales_edit')->middleware('update_access');
    Route::post('/depo-sales/update/{id}', 'InvoiceWebController@depoSalesupdate')->name('depo_sales_update')->middleware('update_access');
    Route::get('/depo-sales/delete/{id}', 'InvoiceWebController@depoSalesDestroy')->name('depo_sales_delete')->middleware('delete_access');

    //Distributor Sale Routes
    Route::get('/distributor-sales', 'InvoiceWebController@distributorSalesIndex')->name('distributor_sales')->middleware('read_access');
    Route::post('/distributor-sales', 'InvoiceWebController@distributorSalesIndex')->name('distributor_sales_search')->middleware('read_access');
    Route::get('/distributor-sales/create', 'InvoiceWebController@distributorSalesCreate')->name('distributor_sales_create')->middleware('create_access');
    Route::post('distributor-sales/store', 'InvoiceWebController@distributorSalesStore')->name('distributor_sales_store')->middleware('create_access');
    Route::get('/distributor-sales/edit/{id}', 'InvoiceWebController@distributorSalesEdit')->name('distributor_sales_edit')->middleware('update_access');
    Route::post('/distributor-sales/update/{id}', 'InvoiceWebController@distributorSalesupdate')->name('distributor_sales_update')->middleware('update_access');
    Route::get('/distributor-sales/delete/{id}', 'InvoiceWebController@distributorSalesDestroy')->name('distributor_sales_delete')->middleware('delete_access');



    Route::get('/check/serial/{serial}', 'InvoiceWebController@checkSerial')->name('check_serial')->middleware('create_access');
    Route::get('/item-check/serial', 'InvoiceWebController@itemListStockSerial')->name('item_list_stock_serial')->middleware('create_access');
    Route::post('/check/item', 'InvoiceWebController@ajaxcheck')->name('check_item')->middleware('create_access');


    Route::post('/check/edit', 'InvoiceWebController@ajaxEditcheck')->middleware('create_access');


    Route::post('/ajax/check', 'InvoiceWebController@ajaxInvoicecheck')->middleware('create_access');

    Route::post('/ajax/show/item', 'InvoiceWebController@ajaxShowItem')->name('ajax_show_item')->middleware('create_access');


    Route::post('/ajax/create/stock', 'InvoiceWebController@ajaxCreateStock')->name('ajax_create_stock')->middleware('create_access');




    Route::post('/show/{id}', 'InvoiceWebController@showupload')->name('invoice_show_upload');
    Route::post('/invoice-update/{id}', 'InvoiceWebController@adjustmentupdate')->name('invoice_adjustment_update')->middleware('update_access');

    Route::post('/use-credit', 'InvoiceWebController@useCredit')->name('post_use_credit')->middleware('auth');
    Route::post('/use-excess-payment', 'InvoiceWebController@useExcessPayment')->name('post_excess_payment')->middleware('auth');

    Route::get('/delete-credit/{id}', 'AppliedPaymentController@deleteCredit')->name('delete_credit')->middleware('auth');
    Route::get('/delete-excess/{id}', 'AppliedPaymentController@deleteExcess')->name('delete_excess')->middleware('auth');
    Route::get('/invoice-download/{id}', 'InvoiceWebController@download')->middleware('read_access');
    Route::get('/challan/{id}', 'InvoiceWebController@challan')->middleware('read_access');
    Route::post('/challan/update/{id}', 'InvoiceWebController@challanUpdate')->name('invoice_challan_update')->middleware('update_access');


    //shanto route create

    Route::get('/save/{id}', 'InvoiceWebController@saveUpdate')->name('invoice_update_save')->middleware('read_access');
    // Route::get('save2/{id}', 'InvoiceWebController@saveUpdate2')->name('invoice_update_save')->middleware('read_access');
    Route::post('/save/{id}', 'InvoiceWebController@showStock')->name('invoice_update_stock')->middleware('read_access');
    Route::post('/add/{id}', 'InvoiceWebController@addStock')->name('adding_stock')->middleware('read_access');

    Route::get('/sales-return/{id}', 'SalesReturn\WebController@create')->name('sales_return');
    Route::post('/sales-return/update/{id}', 'SalesReturn\WebController@update')->name('sales_return_update');

    Route::get('/item-category-check/{id}', 'InvoiceWebController@itemCaegory')->name('item_category_check');
    Route::get('/item-check', 'InvoiceWebController@itemList')->name('item_list');
    Route::get('/check/item/rate/{id}', 'InvoiceWebController@itemRate')->name('item_rate');
});

//BILL OF MATERIAL // ADD MIDDLEWARES
Route::group(['prefix' => 'bill-of-material', 'middleware' => 'auth'], function () {    
    Route::get('/', 'InvoiceWebController@bom')->name('bom')->middleware('read_access');
    Route::get('/create', 'InvoiceWebController@bom_create')->name('bomCreate')->middleware('create_access');
    Route::post('/store', 'InvoiceWebController@bom_store')->name('bomStore')->middleware('create_access');
    Route::get('/show/{id}', 'InvoiceWebController@bom_show')->name('bomShow')->middleware('read_access');
    Route::get('/edit/{id}', 'InvoiceWebController@bom_edit')->name('bomEdit')->middleware('update_access');
    Route::post('/update/{id}', 'InvoiceWebController@bom_update')->name('bomUpdate')->middleware('update_access');
    Route::get('/delete/{id}', 'InvoiceWebController@bom_delete')->name('bom_delete')->middleware('delete_access');
    
});

Route::group(['prefix' => 'api/invoice', 'middleware' => 'auth'], function () {

    Route::get('/sync/all-invoices', 'InvoiceApiController@syncAllInvoices')->middleware('auth');
    Route::get('/get-item-rate/{id}', 'InvoiceApiController@getItemRate')->middleware('auth');
    Route::get('/get-item-rate2/{id}/{contact_id}', 'InvoiceApiController@getItemRate2')->middleware('auth');
    Route::get('/get-invoice-entry/{id}', 'InvoiceApiController@getInvoiceEntry')->middleware('auth');
    Route::get('/get-due-balance/{id}', 'InvoiceApiController@getDueBalance')->middleware('auth');
    Route::get('/get-credit-available/{invoice_id}/{credit_note_id}', 'InvoiceApiController@creditAvailable')->middleware('auth');
    Route::get('/get-item-by-subcategory/{subcategory_id}', 'InvoiceApiController@getItemBySubcategory')->name('get_item_by_subcategory')->middleware('auth');
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
