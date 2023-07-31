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

Route::group(['prefix' => 'attributes', 'middleware' => 'auth'], function () {

    //Attributes Routes
    Route::get('/', 'AttributesWebController@index')->name('attributes')->middleware('read_access');
    Route::get('/create', 'AttributesWebController@create')->name('attribute_create')->middleware('create_access');
    Route::post('/store', 'AttributesWebController@store')->name('attribute_store')->middleware('create_access');
    Route::get('/edit/{id}', 'AttributesWebController@edit')->name('attribute_edit')->middleware('update_access');
    Route::post('/update/{id}', 'AttributesWebController@update')->name('attribute_update')->middleware('update_access');
    Route::get('/delete/{id}', 'AttributesWebController@delete')->name('attribute_delete')->middleware('delete_access');
});

//API Routes

Route::group(['prefix' => 'api/attributes', 'middleware' => 'auth'], function () {

    Route::get('/attribute-check', 'AttributesWebController@attributeList')->name('attribute_list')->middleware('auth');
    Route::post('/update-attribute-status', 'AttributesWebController@updateAttributeStatus')->name('update_attribute_status')->middleware('auth');
    Route::post('/store', 'AttributesWebController@attributeStore')->name('store_attribute')->middleware('auth');
    Route::get('/attribute-value-list/{id}', 'AttributesWebController@attributeValueList')->name('attribute_value_list')->middleware('auth');
    Route::get('/attribute-and-value-list', 'AttributesWebController@attributeWithValueList')->name('attribute_and_value_list')->middleware('auth');
    Route::post('/dynamic-attribute-value-check-store/{id}', 'AttributesWebController@dynamicAttributeValueCheckStore')->name('dynamic_attribute_value_check_store')->middleware('auth');
});
