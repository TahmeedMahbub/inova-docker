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


Route::group(['prefix' => 'report','middleware'=>'auth'], function () {


        Route::get('/', 'ReportWebController@index')->name('report')->middleware('read_access');
        Route::get('account/transactions', 'ReportWebController@accountTransactions')->name('report_account_transactions')->middleware('read_access');
        Route::post('account/transactions', 'ReportWebController@accountTransactionsSearch')->name('report_account_transactions_search')->middleware('read_access');
        Route::get('account/transactions/{id}', 'ReportWebController@accountTransactionsAccountSearch')->name('report_account_transactions_account_search')->middleware('read_access');
        Route::get('account/general/ledger', 'ReportWebController@accountGeneralLedger')->name('report_account_general_ledger_search')->middleware('read_access');
        Route::post('account/general/ledger', 'ReportWebController@accountGeneralLedgerSearch')->name('report_account_general_ledger_search')->middleware('read_access');
        Route::get('account/general/ledger/list/api', 'ReportApiController@genaralLedger')->name('report_account_general_ledger_list_api');

        Route::get('account/journal', 'ReportWebController@accountJournal')->name('report_account_journal_search')->middleware('read_access');
        Route::post('account/journal', 'ReportWebController@accountJournalSearch')->name('report_account_journal_search')->middleware('read_access');
        Route::get('account/trial/balance', 'ReportWebController@accountTrialBalance')->name('report_account_trial_balance_search')->middleware('read_access');
        Route::post('account/trial/balance', 'ReportWebController@accountTrialBalanceSearch')->name('report_account_trial_balance_search')->middleware('read_access');
        Route::get('account/profitandloss', 'ReportWebController@ProfitAndLoss')->name('report_account_ProfitAndLoss')->middleware('read_access');
        Route::post('account/profitandloss', 'ReportWebController@ProfitAndLossbyfilter')->name('report_account_ProfitAndLoss_by_filter')->middleware('read_access');
        Route::get('account/profit/loss', 'ReportWebController@ProfitLoss')->name('report_account_profit_loss')->middleware('read_access');
        Route::get('account/cash/flow/statement', 'ReportWebController@CashFlowStatement')->name('report_account_cash_flow_statement')->middleware('read_access');
        Route::get('account/balance/sheet', 'ReportWebController@BalanceSheet')->name('report_account_balance_sheet')->middleware('read_access');
        Route::get('account/balance/and/sheet', 'ReportWebController@BalanceAndSheet')->name('report_account_balance_and_sheet')->middleware('read_access');
        Route::post('account/balance/and/sheet', 'ReportWebController@BalanceAndSheetbyfilter')->name('report_account_balance_and_sheet_filter')->middleware('read_access');
        Route::get('account/customer', 'ReportWebController@customer')->name('report_account_customer')->middleware('read_access');
        Route::get('account/customer/category/filter/{id}', 'ReportWebController@customerCategory')->name('report_account_customer_category_filter')->middleware('read_access');
        Route::get('account/customer/category/filter/{start}/{end}/{id}', 'ReportWebController@customerCategoryDate')->name('report_account_customer_category_filter')->middleware('read_access');


        Route::post('account/customer', 'ReportWebController@customerSearch')->name('report_account_customer_search')->middleware('read_access');
        Route::get('account/customer/{id}', 'ReportWebController@customerDetails')->name('report_account_customer_id')->middleware('read_access');
        Route::post('account/customer/{id}', 'ReportWebController@customerDetailsSearch')->name('report_account_customer_id_search')->middleware('read_access');
        Route::get('account/item', 'ReportWebController@item')->name('report_account_item')->middleware('read_access');
        Route::get('account/item/filter', 'ReportWebController@filter_item')->name('report_account_item_filter');
        Route::get('account/item/{id}/{branch_id}/{start}/{end}', 'ReportWebController@itemDetails')->name('report_account_item_details')->middleware('read_access');

    //contact
        Route::get('account/list', 'ReportContactController@index')->name('report_account_contact_list')->middleware('read_access');
        Route::post('account/list', 'ReportContactController@indexSearch')->name('report_account_contact_list_search')->middleware('read_access');
        Route::post('account/alpha/list', 'ReportContactController@AlpahabetSearch')->name('report_account_contact_list_alpha_search');
        Route::get('account/api/alpha/search/list', 'ReportContactController@apiAlphaSearch')->name('report_account_contact_api_list_alpha_search');
        Route::get('account/contact/filter/list', 'ReportContactController@contactBySearch')->name('report_account_contact_list_contact_by_search');
        Route::get('api/account/contact/name/list', 'ReportContactController@apiContactName')->name('report_account_contact_list_apiContactName_by_search');

        Route::get('account/details/report/{id}/{branch}/{start}/{end}', 'ReportContactController@ContactDetails')->name('report_account_single_contact_details')->middleware('read_access');
        Route::post('account/details/report/{id}', 'ReportContactController@ContactDetailsSearch')->name('report_account_single_contact_details_by_date')->middleware('read_access');

    //contactwise
        Route::get('accounts/contactwise/item', 'ContactWiseItemController@index')->name('report_account_contact_wise_item_all');
        Route::get('api/accounts/contactwise/item/list', 'ContactWiseItemController@apiContactItemList')->name('report_account_api_Contact_Item_List');

        Route::post('accounts/contactwise/item', 'ContactWiseItemController@filter')->name('report_account_contact_wise_item_filter');
        Route::get('accounts/contactwise/item/date', 'ContactWiseItemController@dateFilter')->name('report_account_contact_wise_item_filter_date_api');
        Route::get('accounts/contactwise/item/alpa', 'ContactWiseItemController@alpaFilter')->name('report_account_contact_wise_item_filter_alpa_api');
        Route::get('accounts/contactwise/item/alpa/name', 'ContactWiseItemController@alpaNameFilter')->name('report_account_contactwise_api_list_alpha_search');
        Route::get('accounts/contactwise/item/alpa/name/api/search', 'ContactWiseItemController@apiContactName')->name('report_account_contactwise_api_list_alpha_name_search');
    //contactwise front filter

    // contactwise details
        Route::get('accounts/contactwise/item/details', 'ContactWiseItemController@apiContactItemDetails')->name('report_account_api_Contact_Item_Details');
        Route::post('accounts/contactwise/item/details', 'ContactWiseItemController@apiContactItemDetailsFilter')->name('report_account_api_Contact_Item_Details_filter');
        Route::get('accounts/contactwise/item/details/show/{id}/{branch}/{start}/{end}', 'ContactWiseItemController@apiContactItemDetailsShow')->name('report_account_api_Contact_Item_Details_show');

        Route::get('cashbook', 'ReportWebController@cashbook')->name('report_cashbook')->middleware('read_access');
        Route::post('cashbook', 'ReportWebController@cashbooksearch')->name('report_cashbook_search')->middleware('read_access');


        Route::post('sales/agent', 'SalesCommissionReportController@filterbydate')->name('reportSalesdateby_agent')->middleware('read_access');
        Route::get('sales/agent', 'SalesCommissionReportController@index')->name('report_Sales_by_agent')->middleware('read_access');
        Route::get('sales/agent/details/{id}/{start}/{end}', 'SalesCommissionReportController@details')->name('report_Sales_by_agent_details')->middleware('read_access');
        Route::post('sales/agent/details', 'SalesCommissionReportController@detailsbydate')->name('report_Sales_by_agent_detailsbydate')->middleware('read_access');


        //Contact Wise Report
        Route::get('contact/wise/item', 'ContactWiseReportController@index')->name('report_contact_wise')->middleware('read_access');
        Route::post('contact/wise/item', 'ContactWiseReportController@index')->name('report_contact_wise')->middleware('read_access');
        Route::get('contact/wise/item/details/{id}/{start}/{end}', 'ContactWiseReportController@details')->name('show_details_contact_wise_report')->middleware('read_access');
        Route::post('contact/wise/item/details/{id}/{start}/{end}', 'ContactWiseReportController@details')->name('show_details_contact_wise_report')->middleware('read_access');

        //Purchase By Vendor
        Route::get('vendor', 'PurchaseByVendorController@index')->name('report_purchase_by_vendor')->middleware('read_access');
        Route::post('vendor', 'PurchaseByVendorController@index')->name('report_purchase_by_vendor')->middleware('read_access');
        Route::get('vendor/details/{id}/{start}/{end}', 'PurchaseByVendorController@details')->name('show_details_purchase_by_vendor_report')->middleware('read_access');
        Route::post('vendor/details/{id}/{start}/{end}', 'PurchaseByVendorController@details')->name('show_details_purchase_by_vendor_report')->middleware('read_access');



        Route::get('stock', 'Stock\PostController@index')->name('report_stock_index_item')->middleware('read_access');
        Route::post('stock', 'Stock\PostController@filter')->name('report_stock_index_item_filter')->middleware('read_access');
        Route::get('stock/details/{id}/{start}/{end}', 'Stock\PostController@details')->name('report_stock_details_item')->middleware('read_access');
        Route::post('stock/details/{id}/{start}/{end}', 'Stock\PostController@details')->name('report_stock_details_item')->middleware('read_access');


    // incomestatement visa
        Route::get('recruit/incomestatement', 'IncomeStatementController@index')->name('account_report_incomestatement_visa_index');
        Route::get('incomestatement/visa/api/datalist', 'IncomeStatementController@apiIndexDatalist')->name('api_index_data_account_report_incomestatement_visa_index');

        Route::get('incomestatement/visa/account/details/{start}/{end}/{id}/{group}', 'IncomeStatementController@accountDetails')->name('index_data_account_report_account_details_all');
        Route::get('incomestatement/visa/account/details/{id}/{group}', 'IncomeStatementController@accountDetailsFilter')->name('deatils_data_account_report_account_details_filter');

        Route::get('incomestatement/visa/account/details/api/{start}/{end}/{id}', 'IncomeStatementController@apiAccountDetails')->name('Api_index_data_account_report_account_details_all');
        Route::post('recruit/incomestatement', 'IncomeStatementController@indexFilter')->name('account_report_incomestatement_visa_index_filter');

    // total transaction
        Route::get('totaltransaction/index', 'TotalTransectionController@index')->name('account_report_total_transaction_index_data');
        Route::post('totaltransaction/index', 'TotalTransectionController@filter')->name('account_report_total_transaction_index_data_filter');

    //Expense Reports
        Route::get('expense/ledger', 'ReportExpenseController@expenseLedger')->name('expenseLedger');
        Route::post('expense/ledger', 'ReportExpenseController@expenseLedgerFilter')->name('expenseLedgerFilter');

        Route::get('expense/api/alpha/search/list', 'ReportExpenseController@apiAlphaSearch')->name('report_account_expense_api_list_alpha_search');

    //Sales Ledger
        Route::get('account/sales/ledger', 'ReportWebController@accountSalesLedger')->name('report_account_sales_ledger')->middleware('read_access');
        Route::post('account/sales/ledger', 'ReportWebController@accountSalesLedgerSearch')->name('report_account_sales_ledger_search')->middleware('read_access');
        Route::post('account/branch/ajax/{id}', 'ReportWebController@reportSearchAjaxBranch')->name('report_branch_search')->middleware('read_access');
        Route::post('account/class/ajax/{id}/{branch_id}', 'ReportWebController@accountSalesLedgerAjaxSearch')->name('report_class_search')->middleware('read_access');
        Route::post('account/batch/ajax/{id}/{branch_id}/{batch_id}', 'ReportWebController@batchWiseStudent')->name('report_batch_search')->middleware('read_access');
        // Route::post('account/sales/ledger/ajax/{id}', 'ReportWebController@accountSalesLedgerAjaxSearch')->name('report_class_search')->middleware('read_access');
    //Purchase Ledger
        Route::get('account/purchase/ledger', 'ReportWebController@accountPurchaseLedger')->name('report_account_purchase_ledger')->middleware('read_access');
        Route::post('account/purchase/ledger', 'ReportWebController@accountPurchaseLedgerSearch')->name('report_account_purchase_ledger_search')->middleware('read_access');
    //Received Ledeger
        Route::get('account/received/ledger', 'ReportWebController@accountReceivedLedger')->name('report_account_received_ledger')->middleware('read_access');
        Route::post('account/received/ledger', 'ReportWebController@accountReceivedLedgerSearch')->name('report_account_received_ledger_search')->middleware('read_access');
    //Payment Ledger
        Route::get('account/payment/ledger', 'ReportWebController@accountPaymentLedger')->name('report_account_payment_ledger')->middleware('read_access');
        Route::post('account/payment/ledger', 'ReportWebController@accountPaymentLedgerSearch')->name('report_account_payment_ledger_search')->middleware('read_access');
    //Profit Ledger
        Route::get('account/profite/ledger','ProfitReportController@index')->name('report_account_profit_ledger')->middleware('read_access');
        Route::post('account/profite/ledger','ProfitReportController@profiteSearch')->name('report_account_profit_ledger_search')->middleware('read_access');

        //invoise wise route

        Route::get('paiment-receive-break-down/index/{form}/{to}/{id}', 'InvoiceWiseReportController@index')->name('paiment_receive_break_down');
        //bill wise
         Route::get('paiment-receive-break-down/bill/{form}/{to}/{id}', 'InvoiceWiseReportController@bill')->name('paiment_receive_break_down_bill');
         //Estimate Reports
        Route::get('estimate/report', 'EstimateReportController@estimateReport')->name('estimate_report');
        Route::post('estimate/report', 'EstimateReportController@estimateReportFilter')->name('estimate_report_filter');
        
        //Project report

          Route::get('project/', 'ProjectController@index')->name('project_index');
          Route::post('project/product-wise-view', 'ProjectController@product')->name('project_product_wise_view');
          Route::get('product/', 'ProductStatusReportController@index')->name('product_status');
          Route::get('product/status', 'ProductStatusReportController@indexStatus')->name('product_status_report');
          //trail balance 
          
          Route::get('trail-balance', 'TrialBalanceController@index')->name('trail_balance_report');
});
