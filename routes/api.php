<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/user', function (Request $request) {
//    return $request->user();
// })->middleware('auth:api');

// Route::get('/your_url', [function(){
// 	return response()->json(['status' => 'success', 'some_data_1' => 'Some Data 1', 'some_data_2' => 'Some Data 2']);
// }]);




Route::post('/hrms_create_superadmin', 'HrmsApi\SuperadminController@hrms_create_superadmin');

Route::post('/hrms_create_contact', 'HrmsApi\SuperadminController@hrms_create_contact');

Route::post('/hrms_edit_employee', 'HrmsApi\SuperadminController@hrms_edit_employee');

Route::post('/hrms_delete_employee', 'HrmsApi\SuperadminController@hrms_delete_employee');

Route::post('/hrms_change_pass', 'HrmsApi\SuperadminController@hrms_change_pass');


Route::get('/test', 'HrmsApi\SuperadminController@test');