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

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', 'DashboardWebController@index')->name('dashboard')->middleware('auth');
    Route::get('/todayreminder', 'DashboardWebController@todayreminder')->name('dashboard_todayreminder')->middleware('auth');
    Route::post('/reminder', 'ReminderWebController@index')->name('dashboard_reminder')->middleware('auth');
    Route::get('/all', 'ReminderWebController@All')->name('dashboard_reminder_all')->middleware('auth');
    Route::get('/delete/{id}', 'ReminderWebController@destroy')->name('dashboard_reminder_destroy')->middleware('auth');
    Route::get('/api/overduereceivable', 'DashboardApiController@overDueReceivable')->name('dashboard_overDueReceivable_api')->middleware('auth');
    Route::get('/api/overduereceivable/invoiceshow/{id}', 'DashboardApiController@overDueReceivableInvoiceShow')->name('dashboard_overDueReceivable_invoice_show_api')->middleware('auth');
    Route::get('/api/reorder/list', 'DashboardApiController@reOrder')->name('dashboard_reorder_list_api')->middleware('auth');
    Route::get('/api/overdue/payable/list', 'DashboardApiController@overduePayable')->name('dashboard_overduePayable_list_api')->middleware('auth');

	Route::post('/position','DashboardWebController@position')->name('deshboard_position');
    Route::get('/sales/product/{id}/{form_date}/{end_date}','DashboardWebController@salesProduct')->name('sales_by_product');
    Route::get('/income/expense/{id}/{form_date}/{end_date}','DashboardWebController@incomeExpense')->name('income_and_expense');
    Route::get('/top/expense/account/{id}/{form_date}/{end_date}','DashboardWebController@topExpenseAccount')->name('top_expense_account');
    Route::get('/top/vendor/expense/{id}/{form_date}/{end_date}','DashboardWebController@topVendorExpense')->name('top_vendor_expense');
    Route::get('/expense/count/{id}/{form_date}/{end_date}','DashboardWebController@expenseCount')->name('expense_dashboard');
    Route::get('/revenue/count/{id}/{form_date}/{end_date}','DashboardWebController@revenueCount')->name('revenue_dashboard');
    Route::get('/sales/yearly','DashboardWebController@yearlySales')->name('sales_dashboard');
    Route::get('/receivable/recived/{id}/{form_date}/{end_date}','DashboardWebController@receivableRecived')->name('receivable_and_received');
    Route::get('/payable/paid/{id}/{form_date}/{end_date}','DashboardWebController@payablePaid')->name('payable_and_paid');
    Route::get('/accout/payable/receivable','DashboardWebController@accoutPR')->name('dashboard_ap_ar');
    Route::get('/sales/summary','DashboardWebController@salesSummary')->name('sales_summary');
    Route::get('/cash/flow/dash','DashboardWebController@cashflow')->name('cash_flow_dash');
    Route::get('/customer/sales/{id}/{form_date}/{end_date}','DashboardWebController@customerSales')->name('top_customer_sales_account');
});
