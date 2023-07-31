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

Route::group(['prefix' => 'product-track', 'middleware' => 'auth'], function () {

    //Product Tracking Routes
    Route::get('/', 'ProductTrackWebController@index')->name('track')->middleware('read_access');
    Route::get('/create', 'ProductTrackWebController@create')->name('track_create')->middleware('create_access');
    Route::get('/bill-of-material/{id}', 'ProductTrackWebController@bomGet')->name('bom_get')->middleware('read_access');
    Route::get('/itemWise/{id}', 'ProductTrackWebController@itemWise')->name('item_get')->middleware('read_access');
    Route::post('/store', 'ProductTrackWebController@store')->name('track_store')->middleware('create_access');
    Route::get('/show/{id}', 'ProductTrackWebController@show')->name('track_show')->middleware('read_access');
    Route::get('/sop/allFile/show/{id}', 'ProductTrackWebController@sopAllFileShow')->name('sop_all_file_show')->middleware('read_access');
    Route::get('/design/allFile/show/{id}', 'ProductTrackWebController@designAllFileShow')->name('design_all_file_show')->middleware('read_access');
    Route::get('/excel/downlaod/{id}', 'ProductTrackWebController@excelFileDownlaod')->name('track_excel_file_download')->middleware('create_access');

    Route::get('/edit/{id}', 'ProductTrackWebController@edit')->name('track_edit')->middleware('update_access');
    Route::post('/update/{id}', 'ProductTrackWebController@update')->name('track_update')->middleware('update_access');
    Route::get('/delete/{id}', 'ProductTrackWebController@destroy')->name('track_delete')->middleware('delete_access');

    //Product Phase Routes
    Route::get('/phase', 'ProductPhaseWebController@index')->name('phase')->middleware('read_access');
    Route::get('/phase/create', 'ProductPhaseWebController@create')->name('phase_create')->middleware('create_access');
    Route::post('/phase/store', 'ProductPhaseWebController@store')->name('phase_store')->middleware('create_access');
    
    Route::get('/phase/raw-material/create/{id}', 'ProductPhaseWebController@rawMaterialCreate')->name('phase_raw_material_create')->middleware('create_access');
    Route::post('/phase/raw-material/store', 'ProductPhaseWebController@rawMaterialStore')->name('phase_raw_material_store')->middleware('create_access');
    Route::get('/phase/raw-material/edit/{id}', 'ProductPhaseWebController@rawMaterialEdit')->name('phase_raw_material_edit')->middleware('update_access');
    Route::post('/phase/raw-material/update/{id}', 'ProductPhaseWebController@rawMaterialUpdate')->name('phase_raw_material_update')->middleware('update_access');
    Route::get('/phase/raw-material/delete/{id}', 'ProductPhaseWebController@rawMaterialDestroy')->name('phase_raw_material_delete')->middleware('delete_access');
    Route::get('/phase/raw-material/show/{id}', 'ProductPhaseWebController@rawMaterialShow')->name('phase_raw_material_show')->middleware('read_access');

    Route::get('/phase/disburse/create/{id}', 'ProductPhaseWebController@disburseCreate')->name('phase_disburse_create')->middleware('create_access');
    Route::post('/phase/disburse/store', 'ProductPhaseWebController@disburseStore')->name('phase_disburse_store')->middleware('create_access');
    Route::get('/phase/disburse/edit/{id}', 'ProductPhaseWebController@disburseEdit')->name('phase_disburse_edit')->middleware('update_access');
    Route::post('/phase/disburse/update/{id}', 'ProductPhaseWebController@disburseUpdate')->name('phase_disburse_update')->middleware('update_access');
    Route::get('/phase/disburse/delete/{id}', 'ProductPhaseWebController@disburseDestroy')->name('phase_disburse_delete')->middleware('delete_access');
    Route::get('/phase/disburse/show/{id}', 'ProductPhaseWebController@disburseShow')->name('phase_disburse_show')->middleware('read_access');

    Route::get('/phase/receive/create/{id}', 'ProductPhaseWebController@receiveCreate')->name('phase_receive_create')->middleware('create_access');
    Route::post('/phase/receive/store', 'ProductPhaseWebController@receiveStore')->name('phase_receive_store')->middleware('create_access');
    Route::get('/phase/receive/edit/{id}', 'ProductPhaseWebController@receiveEdit')->name('phase_receive_edit')->middleware('update_access');
    Route::post('/phase/receive/update/{id}', 'ProductPhaseWebController@receiveUpdate')->name('phase_receive_update')->middleware('update_access');
    Route::get('/phase/receive/delete/{id}', 'ProductPhaseWebController@receiveDestroy')->name('phase_receive_delete')->middleware('delete_access');
    Route::get('/phase/receive/show/{id}', 'ProductPhaseWebController@receiveShow')->name('phase_receive_show')->middleware('read_access');

    Route::get('/phase/edit/{id}', 'ProductPhaseWebController@edit')->name('phase_edit')->middleware('update_access');
    Route::post('/phase/update/{id}', 'ProductPhaseWebController@store')->name('phase_update')->middleware('update_access');
    Route::get('/phase/delete/{id}', 'ProductPhaseWebController@destroy')->name('phase_delete')->middleware('delete_access');

    //Product item Routes
    Route::get('/item/{id}/list', 'ProductItemWebController@index')->name('product_item_list')->middleware('read_access');
    Route::get('/item/{id}/create', 'ProductItemWebController@create')->name('product_item_add')->middleware('create_access');
    Route::get('/item/{id}/show', 'ProductItemWebController@show')->name('product_phase_item_show')->middleware('read_access');



    Route::post('/item/store', 'ProductItemWebController@store')->name('product_item_store')->middleware('create_access');
    Route::get('/item/phase/{id}/edit', 'ProductItemWebController@edit')->name('product_phase_item_edit')->middleware('update_access');
    Route::post('/item/phase/{id}/update', 'ProductItemWebController@update')->name('product_phase_item_update')->middleware('update_access');
    Route::get('/item/phase/{id}/delate', 'ProductItemWebController@destroy')->name('product_phase_item_delete')->middleware('delete_access');

    //ajax get item item_sub_category
    Route::get('item/sub_category/{id}', 'ProductItemWebController@ItemSubCategory');

    //item create
    Route::post('item/create/{id}', 'ProductItemWebController@ItemAdd')->name('item_name_add');
      Route::get('item/create1/{id}', 'ProductItemWebController@ItemAdd1')->name('');

    Route::get('item/phage_id/{id}/{id1}' , 'ProductItemWebController@phaseId');
});

Route::group(['prefix' => 'api/product-track'], function () {
    Route::get('/get-product-phase-item/{id}', 'ProductItemWebController@getProductPhaseItem')->name('get_product_phase_item')->middleware('auth');
});

Route::group(['prefix' => 'api/product-track'], function () {
    Route::get('/get-product/{id}', 'ProductTrackWebController@getProduct')->name('get_product')->middleware('auth');
    Route::get('/item/phase/{phase_id}', 'ProductItemWebController@index_1')->name('product_item_list_1')->middleware('auth');
    Route::post('/update-phase-status', 'ProductTrackWebController@updatePhaseStatus')->name('update_phase_status')->middleware('auth');
    Route::post('/add-stock', 'ProductTrackWebController@addToStock')->name('add_to_stock')->middleware('auth');
});


Route::group(['prefix' => 'api/item'], function () {
    Route::get('/get-item-category-name', 'ProductItemApiController@getItemCategory')->name('item_category_name')->middleware('auth');
    Route::get('/get-item-name/{category_id}', 'ProductItemApiController@getItemName')->name('item_name')->middleware('auth');

});

Route::get('/test',function(){
    return view('producttrack::item.test');
});
