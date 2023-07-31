<?php

namespace App\Modules\Invoice\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Inventory\Item;
use App\Models\PriceList\PriceList;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\CreditNote;
use App\Models\Moneyin\PaymentReceives;
use App\Modules\Invoice\Http\Response\Payment;
use App\Models\Moneyin\InvoiceDue;



class InvoiceApiController extends Controller
{
    public function getItemRate($item_id)
    {
        $item_rate          = Item::find($item_id)->item_sales_rate;
        $item_category_id   = Item::find($item_id)->item_category_id;

        return response()->json([
            'item_rate'  =>  $item_rate,
            'item_type'  =>  $item_category_id,
        ], 201);
    }

    public function getItemRate2($item_id, $contact_id)
    {
        $item_rate = Item::find($item_id)->item_sales_rate;

        if (PriceList::where('contact_id', $contact_id)->where('item_id', $item_id)->first()) {
            $item_rate = PriceList::where('contact_id', $contact_id)->where('item_id', $item_id)->first()->sales_rate;
        }

        $item_category_id = Item::find($item_id)->item_category_id;

        return response()->json([
            'item_rate'  =>  $item_rate,
            'item_type'  =>  $item_category_id,
        ], 201);
    }

    public function getInvoiceEntry($invoice_id)
    {
        $invoice_entries    = InvoiceEntry::where('invoice_id', $invoice_id)->get();
        $invoice            = Invoice::find($invoice_id);
        $item               = DB::table('item')->select('item_name as text', 'id as value')->get();
        $tax                = DB::table('tax')->select('tax_name as text', 'id as value')->get();
        $account            = DB::table('account')->select('account_name as text', 'id as value')->get();

        return response()->json([
            'invoice_entries'   =>  $invoice_entries,
            'item'              =>  $item,
            'tax'               =>  $tax,
            'invoice'           =>  $invoice,
            'account'           =>  $account,
        ], 201);
    }

    public function getDueBalance($id)
    {
        $helper             = new \App\Lib\Helpers;

        $invoice            = Invoice::find($id);
        $customer_id        = $invoice->customer_id;
        $use_credits        = $helper->findCredit($id, $customer_id);

        $excess_payments    = PaymentReceives::where('customer_id', $customer_id)->where('excess_payment', '>', 0)->where('excess_payment', '>', 0)->get();

        $paid_amount    = 0;
        $total_amount   = Invoice::find($id)->total_amount;
        $paid_amount    = $helper->getPaidAmount($id);

        $due_balance    = ($total_amount - $paid_amount);

        return response()->json([
            'due_balance'       =>  $due_balance,
            'use_credits'       =>  $use_credits,
            'excess_payments'   =>  $excess_payments,
        ], 201);
    }

    public function creditAvailable($invoice_id, $credit_note_id)
    {
        $credit_use_amount  = DB::table('credit_note_payments')->sum('amount');
        $credit_amount      = CreditNote::find($credit_note_id)->total_credit_note;

        $credit_available   = $credit_amount - $credit_use_amount;
        return response()->json([
            'credit_available'   =>  $credit_available,
        ], 201);
    }

    public function invoiceStore(Request $request)
    {



        if ($request->check_payment) {
            $validatiolist["payment_account"]       = "required";
            $validatiolist["payment_amount"]        = "required||numeric";
        }

        $payment                =  new Payment();

        $data                           = $request->all();
        $user_id                        = Auth::user()->id;

        $invoices                       = Invoice::count();

        if ($invoices > 0) {
            $invoice                    = Invoice::orderBy('created_at', 'desc')->first();
            $invoice_number             = $invoice['invoice_number'];
            $invoice_number             = $invoice_number + 1;
        } else {
            $invoice_number             = 1;
        }

        $invoice_number = str_pad($invoice_number, 6, '0', STR_PAD_LEFT);
        $invoice                        = new Invoice;
        $invoice->invoice_number        = $invoice_number;
        $invoice->invoice_date          = $data['invoice_date'];
        $invoice->reference             = empty($data['reference']) ? null : $data['reference'];
        $invoice->customer_note         = null;
        $invoice->personal_note         = !empty($data['personal_note']) ? $data['personal_note'] : null;
        $invoice->tax_total             = !empty($data['tax_total']) ? $data['tax_total'] : null;
        $invoice->shipping_charge       = !empty($data['shipping_charge']) ? $data['shipping_charge'] : null;
        $invoice->adjustment            = !empty($data['adjustment']) ? $data['adjustment'] : null;
        $invoice->total_amount          = $data['total_amount'];
        $invoice->item_category_id      = empty($data['item_category_id']) ? null : $data['item_category_id'];
        $invoice->item_sub_category_id  = empty($data['item_sub_category_id']) ? null : $data['item_sub_category_id'];
        $invoice->due_amount            = $data['total_amount'];
        $invoice->delivery_person       = empty($data['delivery_person_id']) ? null : $data['delivery_person_id'];
        $invoice->receive_person        = empty($data['receive_person_id']) ? null : $data['receive_person_id'];
        $invoice->receive_date          = empty($data['receive_date']) ?  null  : date("Y-m-d", strtotime($data['receive_date']));
        $invoice->no_of_installment     = empty($data['no_of_installment']) ? null : $data['no_of_installment'];
        $invoice->day_interval          = empty($data['time_interval']) ? null : $data['time_interval'];
        $invoice->start_date            = empty($data['start_date']) ? null : $data['start_date'];

        if ($request->save) {
            $invoice->save              = 1;
        }

        $invoice->customer_id           = $data['customer_id'];
        $invoice->created_by            = $user_id;
        $invoice->updated_by            = $user_id;

        if ($request->hasFile('file')) {
            $file                       = $request->file('file');
            $file_name                  = $file->getClientOriginalName();
            $without_extention          = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention             = $file->getClientOriginalExtension();
            $num                        = rand(1, 500);
            $new_file_name              = "invoice-" . $invoice_number . '.' . $file_extention;
            $success                    = $file->move('uploads/invoice', $new_file_name);

            if ($success) {
                $invoice->file_url      = 'uploads/invoice/' . $new_file_name;
                $invoice->file_name     = $new_file_name;
            }
        }

        if ($data['commission_type'] && $data['agent_id'] && $data['agentcommissionAmount']) {
            $invoice->agents_id                 = $data['agent_id'];
            $invoice->agentcommissionAmount     = $data['agentcommissionAmount'];
            $invoice->commission_type           = $data['commission_type'];
        } else {
            $invoice->agents_id                 = empty($data['agent_id']) ? null : $data['agent_id'];
        }

        if ($invoice->save()) {
            $invoice_id                 = $invoice['id'];

            $invoice_entry[] = [
                'quantity'          => 1,
                'rate'              => $data['total_amount'],
                'description'       => $data['description'],
                'amount'            => $data['total_amount'],
                'discount'          => 0,
                'serial'            => '',
                'discount_type'     => 0,
                'item_id'           => $data['item_name'],
                'invoice_id'        => $invoice_id,
                'tax_id'            => 1,
                'account_id'        => $data['invoice_account_id'],
                'created_by'        => $user_id,
                'updated_by'        => $user_id,
                'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
            ];


            if (DB::table('invoice_entries')->insert($invoice_entry)) {
                $status                 = $this->insertManualJournalEntries($data, $data['agentcommissionAmount'], $invoice_id);

                $due_invoice              = new InvoiceDue;
                $due_invoice->invoice_id  = $invoice_id;
                $due_invoice->due_date    = $data['invoice_date'];;
                $due_invoice->amount      = 0;
                $due_invoice->created_by  = Auth::user()->id;
                $due_invoice->updated_by  = Auth::user()->id;
                $due_invoice->save();
            }
            if ($due_invoice && $invoice) {
                return $invoice_id;
            } else {
                return 0;
            }
        }
    }

    public function insertManualJournalEntries($data, $agent_commission_amount, $invoice_id)
    {

        $user_id                = Auth::user()->id;

        $i                      = 0;
        $discount               = 0;
        $account_array          = array_fill(1, 100, 0);

        foreach ($data['item_id'] as $account) {
            if ($data['discount'] == "") {
            } else {
                $amount         = 1 *  $data['total_amount'];

                if ($data['discount_type'][$i] == 1) {

                    $discount   = $discount + $data['discount'][$i];
                } else {

                    $discount   = $discount + ($data['discount'] * $amount) / 100;
                }
            }

            $account_array[$data['invoice_account_id']] =  $account_array[$data['invoice_account_id']] + (1 *  $data['total_amount']);

            $i++;
        }

        // return $account_array;
        $invoice_id             = $invoice_id;


        //for agent commission manual journal entry
        if ($data['commission_type'] && $data['agent_id'] && $data['agentcommissionAmount']) {
            $journal_entry                  = new JournalEntry;
            $journal_entry->note            = null;
            $journal_entry->debit_credit    = 1;

            if ($data['commission_type'] == 1) {
                $journal_entry->amount      = $agent_commission_amount;
            } else {
                $journal_entry->amount      = $data['agentcommissionAmount'];
            }

            $journal_entry->account_name_id = 30;
            $journal_entry->jurnal_type     = "sales_commission";
            $journal_entry->invoice_id      = $invoice_id;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->agent_id        = empty($data['agent_id']) ?  null :  $data['agent_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date     = date('Y-m-d', strtotime($data['invoice_date']));
            $journal_entry->save();

            $journal_entry                  = new JournalEntry;
            $journal_entry->note            = null;
            $journal_entry->debit_credit    = 0;

            if ($data['commission_type'] == 1) {
                $journal_entry->amount      = $agent_commission_amount;
            } else {
                $journal_entry->amount      = $data['agentcommissionAmount'];
            }

            $journal_entry->account_name_id = 11;
            $journal_entry->jurnal_type     = "sales_commission";
            $journal_entry->invoice_id      = $invoice_id;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->agent_id        = empty($data['agent_id']) ? null : $data['agent_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date     = date('Y-m-d', strtotime($data['invoice_date']));
            $journal_entry->save();
        }

        //insert total amount as debit
        $journal_entry                  = new JournalEntry;
        $journal_entry->note            = null;
        $journal_entry->debit_credit    = 1;
        $journal_entry->amount          = $data['total_amount'];
        $journal_entry->account_name_id = 5;
        $journal_entry->jurnal_type     = "invoice";
        $journal_entry->invoice_id      = $invoice_id;
        $journal_entry->contact_id      = $data['customer_id'];
        $journal_entry->created_by      = $user_id;
        $journal_entry->updated_by      = $user_id;
        $journal_entry->assign_date     = date('Y-m-d', strtotime($data['invoice_date']));

        if ($journal_entry->save()) {
        } else {
            //delete all journal entry for this invoice...
            $invoice                    = Invoice::find($invoice_id);
            $invoice->delete();
            return false;
        }

        //insert discount as credit
        if ($discount > 0) {
            $journal_entry                  = new JournalEntry;
            $journal_entry->note            = null;
            $journal_entry->debit_credit    = 1;
            $journal_entry->amount          = $discount;
            $journal_entry->account_name_id = 21;
            $journal_entry->jurnal_type     = "invoice";
            $journal_entry->invoice_id      = $invoice_id;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date     = date('Y-m-d', strtotime($data['invoice_date']));

            if ($journal_entry->save()) {
            } else {
                //delete all journal entry for this invoice...
                $invoice                   = Invoice::find($invoice_id);
                $invoice->delete();
                return false;
            }
        }


        //insert tax total as credit
        if ($data['tax_total'] > 0) {
            $journal_entry                  = new JournalEntry;
            $journal_entry->note            = null;
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = $data['tax_total'];
            $journal_entry->account_name_id = 9;
            $journal_entry->jurnal_type     = "invoice";
            $journal_entry->invoice_id      = $invoice_id;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date     = date('Y-m-d', strtotime($data['invoice_date']));

            if ($journal_entry->save()) {
            } else {
                //delete all journal entry for this invoice...
                $invoice                   = Invoice::find($invoice_id);
                $invoice->delete();
                return false;
            }
        }

        //insert shipping charge as credit
        if ($data['shipping_charge'] > 0) {
            $journal_entry                  = new JournalEntry;
            $journal_entry->note            = null;
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = $data['shipping_charge'];
            $journal_entry->account_name_id = 20;
            $journal_entry->jurnal_type     = "invoice";
            $journal_entry->invoice_id      = $invoice_id;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date     = date('Y-m-d', strtotime($data['invoice_date']));

            if ($journal_entry->save()) {
            } else {
                //delete all journal entry for this invoice...
                $invoice                   = Invoice::find($invoice_id);
                $invoice->delete();
                return false;
            }
        }


        //insert adjustment as credit
        if ($data['adjustment'] != 0) {
            $journal_entry                      = new JournalEntry;
            $journal_entry->note                = null;

            if ($data['adjustment'] > 0) {
                $journal_entry->debit_credit    = 0;
            } else {
                $journal_entry->debit_credit    = 1;
            }

            $journal_entry->amount              = abs($data['adjustment']);
            $journal_entry->account_name_id     = 18;
            $journal_entry->jurnal_type         = "invoice";
            $journal_entry->invoice_id          = $invoice_id;
            $journal_entry->contact_id          = $data['customer_id'];
            $journal_entry->created_by          = $user_id;
            $journal_entry->updated_by          = $user_id;
            $journal_entry->assign_date         = date('Y-m-d', strtotime($data['invoice_date']));

            if ($journal_entry->save()) {
            } else {
                //delete all journal entry for this invoice...
                $invoice                        = Invoice::find($invoice_id);
                $invoice->delete();

                return false;
            }
        }


        //return $account_array;
        $invoice_entry                          = [];

        for ($j = 1; $j < count($account_array) - 2; $j++) {

            if ($account_array[$j] != 0) {
                $invoice_entry[] = [
                    'note'              => null,
                    'debit_credit'      => 0,
                    'amount'            => $account_array[$j],
                    'account_name_id'   => $j,
                    'jurnal_type'       => 'invoice',
                    'invoice_id'        => $invoice_id,
                    'contact_id'        => $data['customer_id'],
                    'created_by'        => $user_id,
                    'updated_by'        => $user_id,
                    'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    'assign_date'       => date('Y-m-d', strtotime($data['invoice_date'])),
                ];
            }
        }

        if (DB::table('journal_entries')->insert($invoice_entry)) {
            return true;
        } else {
            //delete all journal entry for this invoice...
            $invoice                = Invoice::find($invoice_id);
            $invoice->delete();

            return false;
        }

        return false;
    }

    public function InvoiceDestroy($id)
    {

        $invoice = Invoice::find($id);

        $checkAccess = $this->checkIfUserHasAccess($invoice);

        if ($checkAccess == 1) {
            return back();
        }

        $helper = new \App\Lib\Helpers;

        //check payment receive is used in this invoice or not
        if ($helper->isPaymentReceiveInThisInvoice($id)) {

            return false;
        }

        //check credit note is used in this invoice or not
        if ($helper->isCreditNoteInThisInvoice($id)) {
            return false;
        }



        $payment_amount = DB::table('payment_receives_entries')
            ->where('invoice_id', $id)
            ->groupBy('payment_receives_id')
            ->selectRaw('sum(amount) as amount, payment_receives_id')
            ->get();

        foreach ($payment_amount as $value) {
            $helper->paymentReceiveBackAfterDeleteInvoice($value->payment_receives_id, $value->amount);
        }


        $credit_note = DB::table('credit_note_payments')
            ->where('invoice_id', $id)
            ->groupBy('credit_note_id')
            ->selectRaw('sum(amount) as amount, credit_note_id')
            ->get();

        foreach ($credit_note as $value) {
            $helper->creditNoteBackAfterDeleteInvoice($value->credit_note_id, $value->amount);
        }


        $items = InvoiceEntry::where('invoice_id', $id)->get();
        foreach ($items as $item) {
            $helper->itemBackAfterDeleteInvoice($item->item_id, $item->quantity);
        }

        if ($invoice) {
            if ($invoice->delete()) {
                if ($invoice->file_url) {
                    $delete_path = public_path($invoice->file_url);
                    if (file_exists($delete_path)) {
                        $delete = unlink($delete_path);
                    }
                }
            }

            return true;
        }
    }

    public function checkIfUserHasAccess($invoice)
    {

        $user_branch    = Auth::user()->branch_id;

        if ($invoice->createdBy->branch_id != $user_branch && $user_branch != 1) {
            return 1;
        }
    }
}
