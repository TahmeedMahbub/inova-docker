<?php

namespace App\Modules\Billsubmit\Http\Controllers;

use App\Models\MoneyOut\PaymentMade;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use App\Models\Inventory\Item;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Moneyin\CreditNote;
use App\Models\Moneyin\PaymentReceives;
use App\Models\MoneyOut\Bill;
use App\Models\MoneyOut\BillEntry;
//For currency start
use App\Models\Setting\Currency\SettingCurrency;
use App\Models\Setting\Currency\SettingCurrencyRate;
use App\User;
//For currency end

//bill submit start
use App\Models\BillSubmit\BillSubmit;
use App\Models\BillSubmit\BillSubmitEntry;
use App\Models\BillSubmit\BillSubmitPax;
//bill submit end

class BillSubmitApiController extends Controller
{
    public function getItemRate($item_id)
    {
        $item_rate = Item::find($item_id)->item_purchase_rate;
        $item_category_id = Item::find($item_id)->item_category_id;
        return response()->json([
            'item_rate'   =>  $item_rate,
            'item_type'  =>  $item_category_id,
        ], 201);
    }

    public function getBillEntry($bill_id, $currencyId)
    {
        $bill_entries   = BillSubmitEntry::where('bill_id',$bill_id)->get();
        $bill           = BillSubmit::find($bill_id);
        $item           = DB::table('item')->select('item_name as text', 'id as value')->get();
        $tax            = DB::table('tax')->select('tax_name as text', 'id as value')->get();
        $account        = DB::table('account')->select('account_name as text', 'id as value')->get();

        //finding currency data start
        if ($currencyId != null) 
        {
           $setting_currency_rate          = SettingCurrencyRate::where('currency_id', $currencyId)
                                                                ->orderBy('created_at', 'ASE')
                                                                ->first();
        }
            $conversion_rate                = isset($setting_currency_rate->conversion_rate) ? $setting_currency_rate->conversion_rate : 1;                                                  
            
        //finding currency data end

        return response()->json([
            'bill_entries'      =>  $bill_entries,
            'item'              =>  $item,
            'tax'               =>  $tax,
            'bill'              =>  $bill,
            'account'           =>  $account,
            'conversion_rate'   =>  $conversion_rate,

        ], 201);

    }

    public function getDueBalance($id)
    {
        $helper = new \App\Lib\Helpers;

        $bill = BillSubmit::find($id);
        $vendor_id = $bill->vendor_id;

        $excess_payments = PaymentMade::where('vendor_id', $vendor_id)->where('excess_amount', '>', 0)->get();

        $paid_amount = 0;
        $total_amount = Bill::find($id)->amount;
        $paid_amount = $helper->getBillPaidAmount($id);

        $due_balance = ($total_amount - $paid_amount);

        return response()->json([
            'due_balance'       =>  $due_balance,
            'excess_payments'   =>  $excess_payments,
        ], 201);
    }
}

