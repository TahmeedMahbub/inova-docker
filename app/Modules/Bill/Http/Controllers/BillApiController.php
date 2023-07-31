<?php

namespace App\Modules\Bill\Http\Controllers;

use App\Models\MoneyOut\PaymentMade;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
Use Auth;

use App\Models\Inventory\Item;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Moneyin\CreditNote;
use App\Models\Moneyin\PaymentReceives;
use App\Models\MoneyOut\Bill;
use App\Models\MoneyOut\BillEntry;
use App\Models\ManualJournal\JournalEntry;
use App\Models\MoneyOut\BillDueTable;

class BillApiController extends Controller
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

    public function getBillEntry($bill_id)
    {
        $bill_entries = BillEntry::where('bill_id',$bill_id)->get();
        $bill = Bill::find($bill_id);
        $item = DB::table('item')->select('item_name as text', 'id as value')->get();
        $tax = DB::table('tax')->select('tax_name as text', 'id as value')->get();
        $account = DB::table('account')->select('account_name as text', 'id as value')->get();

        return response()->json([
            'bill_entries'   =>  $bill_entries,
            'item'           =>  $item,
            'tax'            =>  $tax,
            'bill'           =>  $bill,
            'account'        =>  $account,
        ], 201);

    }

    public function getDueBalance($id)
    {
        $helper = new \App\Lib\Helpers;

        $bill = Bill::find($id);
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

    public function billStore(Request $request)
    { 
      
        $data                          = $request->all();
        $user_id                       = Auth::user()->id;
        $date                          = $data['bill_date'];
        $serial_bill_id                = [];
        foreach($data['owner_id_bill'] as $key=>$vendor_id)
        {
            $bills                          = Bill::count();

            if($bills > 0)
            {
                $bill                       = Bill::orderBy('created_at', 'desc')->first();
                $bill_number                = $bill['bill_number'];
                $bill_number                = $bill_number + 1;
            }
            else
            {
                $bill_number                = 1;
            }

            $bill_number                    = str_pad($bill_number, 6, '0', STR_PAD_LEFT);

            $tax_total                      = 0;

            $total_amount                   = $data['amount_bill'][$key];
            $bill                           = new Bill;
            $bill->order_number             = null;
            $bill->bill_number              = $bill_number;
            $bill->adjustment               = $data['adjustment'];
            $bill->amount                   = $total_amount;
            $bill->due_amount               = $total_amount;
            $bill->bill_date                = $data['bill_date'];
            $bill->note                     = null;
            $bill->total_tax                = $tax_total;
            $bill->vendor_id                = $vendor_id;
            $bill->item_category_id         = null;
            $bill->item_sub_category_id     = null;
            $bill->created_by               = $user_id;
            $bill->updated_by               = $user_id;
            $bill->no_of_installment        = 0;
            $bill->day_interval             = 0;
            $bill->start_date               = null;
            if($bill->save())
            {

                $i                      = 0;
                $bill_entry             = [];
                $bill_id                = $bill['id'];
                    $bill_entry[]           = [

                        'quantity'          => 1,
                        'rate'              => $data['rate_bill'][$key],
                        'amount'            => $data['amount_bill'][$key],
                        'item_id'           => $data['item_id_bill'],
                        'description'       => null,
                        'bill_id'           => $bill_id,
                        'tax_id'            => 1,
                        'account_id'        => $data['bill_account_id'],
                        'created_by'        => $user_id,
                        'updated_by'        => $user_id,
                        'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),

                    ];
                $data_journal[] =[
                                'customer_id' => $vendor_id,
                                'bill_date'   => $data['bill_date'],
                                'adjustment'  => 0,
                ];
                $serial_bill_id []=
                [
                    'serial' =>$data['serial_bill'][$key],
                    'bill_id'=> $bill['id'],
                ] ;
                if(DB::table('bill_entry')->insert($bill_entry))
                {

                    $this->insertBillInJournalEntries($data_journal, $total_amount, $tax_total, $bill_id, $date);
                
                    
                        $due_invoice                  = new BillDueTable;
                        $due_invoice->bill_id         = $bill_id;
                        $due_invoice->due_date        = $data['bill_date'];;
                        $due_invoice->due_amount      =  0;
                        $due_invoice->created_by      = Auth::user()->id;
                        $due_invoice->updated_by      = Auth::user()->id;
                        $due_invoice->save();
                        
                }
            }
        }
        if($bill)
        {
            return $serial_bill_id;
        }
        else{
            return false;
        }

            
    }

    public function insertBillInJournalEntries($data, $total_amount, $total_tax, $bill_id,$date)
    {  
        $user_id                                    = Auth::user()->id;
        $i                                          = 0;


        $account_array                              = array_fill(1, 100, 0);

       

        $journal_entry                              = new JournalEntry;
        $journal_entry->note                        = null;
        $journal_entry->debit_credit                = 0;
        $journal_entry->amount                      = $total_amount;
        $journal_entry->account_name_id             = 11;
        $journal_entry->jurnal_type                 = "bill";
        $journal_entry->bill_id                     = $bill_id;
        $journal_entry->contact_id                  = $data[0]['customer_id'];
        $journal_entry->created_by                  = $user_id;
        $journal_entry->updated_by                  = $user_id;
        $journal_entry->assign_date                 = date('Y-m-d', strtotime($date));

        if($journal_entry->save())
        {

        }
        else
        {
            //delete all journal entry for this invoice...
            $bill                                   = Bill::find($bill_id);
            $bill->delete();

            return false;
        }

        if($total_tax > 0)
        {
            $journal_entry                          = new JournalEntry;
            $journal_entry->note                    = null;
            $journal_entry->debit_credit            = 1;
            $journal_entry->amount                  = $total_tax;
            $journal_entry->account_name_id         = 9;
            $journal_entry->jurnal_type             = "bill";
            $journal_entry->bill_id                 = $bill_id;
            $journal_entry->contact_id              = $data[0]['customer_id'];
            $journal_entry->created_by              = $user_id;
            $journal_entry->updated_by              = $user_id;
            $journal_entry->assign_date             = date('Y-m-d', strtotime($date));

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
                $bill                               = Bill::find($bill_id);
                $bill->delete();

                return false;
            }

        }

        //insert adjustment as credit
        if($data[0]['adjustment'] != 0)
        {
            $journal_entry                      = new JournalEntry;
            $journal_entry->note                = null;

            if($data['adjustment'] > 0)
            {
                $journal_entry->debit_credit    = 1;
            }
            else
            {
                $journal_entry->debit_credit    = 0;
            }

            $journal_entry->amount              = abs($data['adjustment']);
            $journal_entry->account_name_id     = 18;
            $journal_entry->jurnal_type         = "bill";
            $journal_entry->bill_id             = $bill_id;
            $journal_entry->contact_id          = $data[0]['customer_id'];
            $journal_entry->created_by          = $user_id;
            $journal_entry->updated_by          = $user_id;
            $journal_entry->assign_date         = date('Y-m-d', strtotime($date));

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
                $bill                               = Bill::find($bill_id);
                $bill->delete();

                return false;
            }
        }

        $bill_entry                                 = [];

      
                $bill_entry[]           = [
                    'note'              => null,
                    'debit_credit'      => 1,
                    'amount'            => 0,
                    'account_name_id'   => 1,
                    'jurnal_type'       => 'bill',
                    'bill_id'           => $bill_id,
                    'contact_id'        => $data[0]['customer_id'],
                    'created_by'        => $user_id,
                    'updated_by'        => $user_id,
                    'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    'assign_date'       => date('Y-m-d',strtotime($date)),
                ];

       
        if(DB::table('journal_entries')->insert($bill_entry))
        {
            return true;
        }
        else
        {
            //delete all journal entry for this invoice...
            $bill                               = Bill::find($bill_id);
            $bill->delete();

            return false;
        }

        return false;
    }

    public function BillDestroy($id)
    {   
        
            $helper                         = new \App\Lib\Helpers;
         
            //check if payment made is used in this bill or not
                if($helper->isPaymentMadeInThisBill($id))
                {   
                    return false;
                }
               
            //check if payment made is used in this bill or not ends

            $bill                           = Bill::find($id);

            $checkAccess                    = $this->checkIfUserHasAccess($bill);

            if($checkAccess == 1){
                return back();
            }

            $helper->itemBackAfterDeletingBill($id);

            if($bill->delete())
            {

                if($bill->file_url)
                {
                    $delete_path            = public_path($bill->file_url);

                    if(file_exists($delete_path))
                    {
                        $delete             = unlink($delete_path);
                    }

                }

                return true;

            }           
        return false;
    
    }

    public function checkIfUserHasAccess($bill)
    {

        $user_branch    = Auth::user()->branch_id;

        if($bill->createdBy->branch_id != $user_branch && $user_branch != 1){
            return 1;
        }

    }
}
