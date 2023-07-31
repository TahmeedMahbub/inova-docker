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

Route::group(['prefix' => 'inventory', 'middleware' => 'auth'], function () {

    //Inventory Routes
    Route::get('/', 'InventoryWebController@index')->name('inventory')->middleware('read_access');
    Route::get('/create', 'InventoryWebController@create')->name('inventory_create')->middleware('create_access');
    Route::get('/sub-category/{id}', 'InventoryWebController@subCategory')->name('inventory_sub_category_show');
    Route::post('/store', 'InventoryWebController@store')->name('inventory_store')->middleware('create_access');
    Route::get('/show/{id}', 'InventoryWebController@show')->name('inventory_show')->middleware('read_access');
    Route::get('/edit/{id}', 'InventoryWebController@edit')->name('inventory_edit')->middleware('update_access');
    Route::get('/barcode/{id}', 'InventoryWebController@barcode')->name('inventory_barcode')->middleware('update_access');
    Route::post('/barcode/{id}/generate', 'InventoryWebController@barcodeGenerate')->name('inventory_barcode_generate')->middleware('update_access');
    Route::post('/update/{id}', 'InventoryWebController@update')->name('inventory_update')->middleware('update_access');
    Route::get('/delete/{id}', 'InventoryWebController@destroy')->name('inventory_delete')->middleware('delete_access');
    // multi image delete
    Route::get('/multi_file/delete/{id}', 'InventoryWebController@itemMultiFileDestroy')->name('item_multi_file_delete')->middleware('delete_access');

     //api ajax
    Route::get('/api/all/list', 'InventoryWebController@apiAllInventory')->name('inventory_api_all_inventory_list');
    Route::get('/api/all/list/find', 'InventoryWebController@apiFindInventory')->name('inventory_api_seach_inventory_items_key');

    Route::get('/api/all/asset/list', 'InventoryWebController@apiAllAsset')->name('inventory_api_all_asset_list');
    Route::get('/api/all/asset/list/find', 'InventoryWebController@apiFindAsset')->name('inventory_api_seach_asset_items_key');

    //Route for Assets
    Route::get('/asset', 'InventoryWebController@asset_index')->name('asset')->middleware('read_access');
    Route::get('/asset/create', 'InventoryWebController@asset_create')->name('asset_create')->middleware('create_access');
    Route::post('/asset/store', 'InventoryWebController@asset_store')->name('asset_store')->middleware('create_access');
    Route::get('/asset/edit/{id}', 'InventoryWebController@asset_edit')->name('asset_edit')->middleware('update_access');
    Route::post('/asset/update/{id}', 'InventoryWebController@asset_update')->name('asset_update')->middleware('update_access');
    Route::get('/asset/delete/{id}', 'InventoryWebController@asset_destroy')->name('asset_delete')->middleware('delete_access');

    //Route for Damage
    Route::get('/damage', 'InventoryWebController@damage_index')->name('damage')->middleware('read_access');
    Route::get('/damage/create', 'InventoryWebController@damage_create')->name('damage_create')->middleware('create_access');
    Route::post('/damage/store', 'InventoryWebController@damage_store')->name('damage_store')->middleware('create_access');
    Route::get('/damage/edit/{id}', 'InventoryWebController@damage_edit')->name('damage_edit')->middleware('update_access');
    Route::post('/damage/update/{id}', 'InventoryWebController@damage_update')->name('damage_update')->middleware('update_access');
    Route::get('/damage/delete/{id}', 'InventoryWebController@damage_destroy')->name('damage_delete')->middleware('delete_access');

    // item search
    Route::get('/search/{id}', 'InventorySearchController@index')->name('inventory_search')->middleware('read_access');    
    Route::get('/consolidated-view', 'InventoryWebController@consolidatedView')->name('inventory_consolidated_view')->middleware('read_access');

});

Route::group(['prefix' => 'inventory/category', 'middleware' => 'auth'], function () {

    Route::get('/', 'CategoryWebController@index')->name('inventory_category')->middleware('read_access');
    Route::get('/create', 'CategoryWebController@create')->name('inventory_category_create')->middleware('create_access');
    Route::post('/store', 'CategoryWebController@store')->name('inventory_category_store')->middleware('create_access');
    Route::get('/edit/{id}', 'CategoryWebController@edit')->name('inventory_category_edit')->middleware('update_access');
    Route::post('/update/{id}', 'CategoryWebController@update')->name('inventory_category_update')->middleware('update_access');
    Route::get('/delete/{id}', 'CategoryWebController@destroy')->name('inventory_category_delete')->middleware('delete_access');
});

Route::group(['prefix' => 'inventory/subcategory', 'middleware' => 'auth'], function () {
    Route::get('/', 'SubCategoryWebController@index')->name('inventory_sub_category');
    Route::get('/create', 'SubCategoryWebController@add')->name('inventory_sub_category_add');
    Route::post('/store', 'SubCategoryWebController@store')->name('inventory_sub_category_store');
    Route::get('/edit/{id}', 'SubCategoryWebController@edit')->name('inventory_sub_category_edit');
    Route::post('/update/{id}', 'SubCategoryWebController@update')->name('inventory_sub_category_update');
    Route::get('/delete/{id}', 'SubCategoryWebController@destroy')->name('inventory_sub_category_delete');
});

//Stock Transfer Routes
    Route::group(['prefix' => 'stock-transfer'], function () {
        Route::get('/', 'StockTransferWebController@index')->name('stock_transfer')->middleware('read_access');
        Route::get('/create', 'StockTransferWebController@create')->name('stock_transfer_create')->middleware('create_access');
        Route::post('/store', 'StockTransferWebController@store')->name('stock_transfer_store')->middleware('create_access');
        Route::get('/edit/{id}', 'StockTransferWebController@edit')->name('stock_transfer_edit')->middleware('update_access');
        Route::post('/update/{id}', 'StockTransferWebController@update')->name('stock_transfer_update')->middleware('update_access');
        Route::get('/delete/{id}', 'StockTransferWebController@destroy')->name('stock_transfer_delete')->middleware('delete_access');
    });

     //Excel import and export
        Route::get('/excel/import', 'InventoryWebController@excel_import')->name('import_excel')->middleware('create_access');
        Route::post('/excel/upload', 'InventoryWebController@excel_upload')->name('upload_excel')->middleware('create_access');
        Route::get('excel/demo/{name}', 'InventoryWebController@excel_demo')->name('demo_excel')->middleware('create_access');
    // End Excel import and export

    //Bulk Edit starts
        Route::get('/inventory-bulk-edit', 'InventoryWebController@bulk_edit')->name('bulk_edit')->middleware('update_access');
        Route::post('/inventory-bulk-edit', 'InventoryWebController@bulk_edit_update')->name('bulk_edit_update')->middleware('update_access');
        Route::get('/inventory-bulk-edit_single', 'InventoryWebController@bulk_edit_update_single')->name('bulk_edit_update_single')->middleware('update_access');
    //Bulk Edit ends

    // Inventory API routes

    

Route::group(['prefix' => 'api/inventory', 'middleware' => 'auth'], function () {
    Route::get('/rafid-test', 'InventoryWebController@rafidTest')->name('rafid-test')->middleware('auth');
    Route::get('/sync/all-products', 'InventoryWebController@syncAllProducts')->name('sync-all-products')->middleware('auth');
    Route::get('/check-variation/{id}', 'InventoryWebController@checkVariation')->name('check-variation')->middleware('auth');
    Route::get('/get-item/{id}', 'InventoryWebController@getItem')->name('get-item')->middleware('auth');
    Route::get('/get-other-items/{id}', 'InventoryWebController@getOtherItems')->name('get-other-items')->middleware('auth');
});
