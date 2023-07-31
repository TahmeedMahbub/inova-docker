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

Route::group(['prefix' => 'offer'], function () {
    
    Route::get('/', 'OfferWebController@index')->name('offers')->middleware('read_access');
    Route::get('/create', 'OfferWebController@create')->name('offers_create')->middleware('create_access');
    Route::post('/store', 'OfferWebController@store')->name('offers_store')->middleware('create_access');
    Route::get('/edit/{id}', 'OfferWebController@edit')->name('offers_edit')->middleware('update_access');
    Route::post('/update/{id}', 'OfferWebController@update')->name('offers_update')->middleware('update_access');
    Route::get('/delete/{id}', 'OfferWebController@delete')->name('offers_delete')->middleware('delete_access');
});

// Inventory API routes
Route::group(['prefix' => 'api/offers', 'middleware' => 'auth'], function () {
    Route::get('/get-offer/{id}/{variation_id}', 'OfferWebController@getOffers')->name('get_offers')->middleware('auth');
    Route::get('/get-offer/{id}', 'OfferWebController@getOffers')->name('get_offers')->middleware('auth');
});