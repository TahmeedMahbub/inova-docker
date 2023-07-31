<?php

namespace App\Modules\Pos\Http\Controllers\SalesReturn;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;

//Models
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Moneyin\InvoiceReturnEntry;
use App\Models\Inventory\Item;
use App\Models\Inventory\Stock;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\Contact\Contact;
use App\Models\Moneyin\CreditNote;
use App\Models\Moneyin\CreditNoteEntry;
use App\User;

use App\Models\Moneyin\CreditNotePayment;
use App\Models\Moneyin\CreditNoteRefund;
use App\Models\AccountChart\Account;
use App\Models\PaymentMode\PaymentMode;

class WebController extends Controller
{
    public function index()
    {
        $invoice = Invoice::find($id);
        $invoice_entries = InvoiceEntry::where('invoice_id',$id)->get();
        return view('pos::sales_return.index' , compact('invoice' , 'invoice_entries'));
    }

    public function create()
    {
        $user       = Auth::id();
        $user       = User::find($user);
        
        $customers = Contact::where('branch_id', $user->branch_id)->get();
        return view('pos::sales_return.create' , compact('customers'));
    }

    public function store(Request $request)
    {
        if ($request->quantity > $request->max_quantity || $request->quantity <= 0) return back();

        if(!($request->invoice_id > 0 && $request->product_id > 0)) return back();

        DB::beginTransaction();

        if(count(CreditNote::all()) > 0)
        {
            $credit_note_number = (int)(CreditNote::all()->last()->credit_note_number) + 1;
        }else
        {
            $credit_note_number = 1;
        }

        try{

            $find_invoice                        = Invoice::find($request->invoice_id);

            $credit_total_amount                 = InvoiceEntry::where('item_id', $request->product_id)->where('invoice_id', $find_invoice ->id)->first();

            // Adjustment
            if ($find_invoice->adjustment != 0) {
                $credit_total_amount->amount += ($credit_total_amount->amount / ($find_invoice->total_amount - $find_invoice->adjustment) * $find_invoice->adjustment);
            }

            $credit_rate                         = ($credit_total_amount->amount / $credit_total_amount->quantity);
            $credit_total_amount                 = ($credit_total_amount->amount / $credit_total_amount->quantity) * $request->quantity;

            $credit_note_number                  = str_pad($credit_note_number, 6, '0', STR_PAD_LEFT);
            $user_id                             = Auth::user()->id;

            $credit_note                         = new CreditNote;
            $credit_note->customer_id            = $find_invoice->customer_id;
            $credit_note->invoice_id             = $find_invoice->id;
            $credit_note->credit_note_number     = $credit_note_number;
            $credit_note->reference              = '';
            $credit_note->credit_note_date       = date("Y-m-d");
            $credit_note->shiping_charge         = 0;
            $credit_note->adjustment             = 0;
            $credit_note->total_credit_note      = $credit_total_amount;
            $credit_note->available_credit       = $credit_total_amount;
            $credit_note->customer_note          = '';
            $credit_note->terms_and_condition    = '';
            $credit_note->tax_total              = 0;
            $credit_note->created_by             = $user_id;
            $credit_note->updated_by             = $user_id;
            $credit_note->save();

            $credit_note_entry                   = new CreditNoteEntry;
            $credit_note_entry->item_id          = $request->product_id;
            $credit_note_entry->description      = '';
            $credit_note_entry->account_id       = 16;
            $credit_note_entry->quantity         = $request->quantity;
            $credit_note_entry->rate             = $credit_rate;
            $credit_note_entry->discount         = 0;
            $credit_note_entry->tax_id           = 1;
            $credit_note_entry->amount           = $credit_total_amount;
            $credit_note_entry->credit_note_id   = $credit_note->id;
            $credit_note_entry->created_by       = $user_id;
            $credit_note_entry->updated_by       = $user_id;
            $credit_note_entry->save();


            $journal_entry                          = new JournalEntry;
            $journal_entry->amount                  = $credit_total_amount;
            $journal_entry->debit_credit            = 0;
            $journal_entry->account_name_id         = 5;
            $journal_entry->jurnal_type             = 11;
            $journal_entry->credit_note_id          = $credit_note->id;
            $journal_entry->contact_id              = $credit_note->customer_id;
            $journal_entry->created_by              = $user_id;
            $journal_entry->updated_by              = $user_id;
            $journal_entry->assign_date             = date("Y-m-d");
            $journal_entry->save();


            $journal_entry                          = new JournalEntry;
            $journal_entry->amount                  = $credit_total_amount;
            $journal_entry->debit_credit            = 1;
            $journal_entry->account_name_id         = 16;
            $journal_entry->jurnal_type             = 11;
            $journal_entry->credit_note_id          = $credit_note->id;
            $journal_entry->contact_id              = $credit_note->customer_id;
            $journal_entry->created_by              = $user_id;
            $journal_entry->updated_by              = $user_id;
            $journal_entry->assign_date             = date("Y-m-d");
            $journal_entry->save();

            $item                                   = Item::find($request->product_id);
            $item->total_purchases                  = $item['total_purchases'] + $request->quantity;
            $item->update();
            
            $stock                                  = new Stock;
            $stock->total                           = $request->quantity;
            $stock->date                            = $credit_note->credit_note_date;
            $stock->item_category_id                = $item->item_category_id;
            $stock->item_id                         = $request->product_id;
            $stock->credit_note_id                  = $credit_note->id;
            $stock->branch_id                       = Auth::user()->branch_id;
            $stock->created_by                      = $user_id;
            $stock->updated_by                      = $user_id;
            $stock->save();
            
            //Add Cash Refund
                if($request->submit != "Sales Return"){

                    $credit_note                            = $credit_note;
                    $credit_note_refund_data['amount']      = $credit_note->total_credit_note;
            
                    if($credit_note_refund_data['amount'] > $credit_note->total_credit_note)
                    {
                        $credit_note_amount = $credit_note->total_credit_note;
                    }
                    else
                    {
                        $credit_note_amount = $credit_note_refund_data['amount'];
                    }
            
                    $user_id = Auth::user()->id;
            
                    $credit_note_refund = new CreditNoteRefund;
                    
                    $credit_note_refund->amount          = $credit_note_amount;
                    $credit_note_refund->date            = date("Y-m-d");
                    $credit_note_refund->reference       = ' ';
                    $credit_note_refund->account_id      = 3;
                    $credit_note_refund->credit_note_id  = $credit_note->id;
                    $credit_note_refund->created_by      = $user_id;
                    $credit_note_refund->updated_by      = $user_id;
            
                    if($credit_note_refund->save())
                    {
            
                        $credit_note_refunds_id = $credit_note_refund->id;
            
                        $journal_entry = new JournalEntry;
                        $journal_entry->amount                 = $credit_note_amount;
                        $journal_entry->debit_credit           = 1;
                        $journal_entry->account_name_id        = 5;
                        $journal_entry->jurnal_type            = 12;
                        $journal_entry->credit_note_id         = $credit_note->id;
                        $journal_entry->credit_note_refunds_id = $credit_note_refunds_id;
                        $journal_entry->contact_id             = $credit_note->customer_id;
                        $journal_entry->created_by             = $user_id;
                        $journal_entry->updated_by             = $user_id;
                        $journal_entry->assign_date = date("Y-m-d");
                        $journal_entry->save();
            
                        $journal_entry = new JournalEntry;
                        $journal_entry->amount                 = $credit_note_amount;
                        $journal_entry->debit_credit           = 0;
                        $journal_entry->account_name_id        = 3;
                        $journal_entry->jurnal_type            = 12;
                        $journal_entry->credit_note_id         = $credit_note->id;
                        $journal_entry->credit_note_refunds_id = $credit_note_refunds_id;
                        $journal_entry->contact_id             = $credit_note->customer_id;
                        $journal_entry->created_by             = $user_id;
                        $journal_entry->updated_by             = $user_id;
                        $journal_entry->assign_date = date("Y-m-d");
                        $journal_entry->save();
            
                        $credit_note->available_credit = ($credit_note->available_credit - $credit_note_amount);
            
                        $credit_note->update();
                    }
                }
            //Add Cash Refund Ends

            DB::commit();

            return redirect()
                ->route('sales_return_create', ['customer_id' => $credit_note->customer_id])
                ->with('alert.status', 'success')
                ->with('alert.message', 'Sales Return Added Successfully!');

        }catch(\Exception $e){

            DB::rollback();
            dd($e->getMessage());
            return back();

        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $user = Auth::id();
        //dd(count($input['invoice_entries_id']));

        try{
            DB::beginTransaction();
            $count = count($input['invoice_entries_id']);
            $total_discount   = 0;

            for($i=0; $i<$count; $i++)
            {
                $discount = 0;

                if($input['returned_quantity'][$i] != Null){
                    
                    $insert = new InvoiceReturnEntry;

                    $insert->invoice_entries_id = $input['invoice_entries_id'][$i];
                    $insert->returned_quantity  = $input['returned_quantity'][$i];
                    $insert->created_by         = $user;
                    $insert->updated_by         = $user;

                    $insert->save();

                    //Invoice Entries
                    $invoice_entry = InvoiceEntry::find($input['invoice_entries_id'][$i]);

                    $quantity = ($invoice_entry->quantity - $input['returned_quantity'][$i]);

                    if($invoice_entry->discount_type == 1){
                        $discount = $invoice_entry->discount;
                        $amount = (($invoice_entry->rate * $quantity) - $invoice_entry->discount);
                    }
                    elseif($invoice_entry->discount_type == 0){
                        $discount = (($invoice_entry->rate * $quantity * $invoice_entry->discount)/100);
                        $amount = (($invoice_entry->rate * $quantity) - $discount);

                    }
                    else{
                        $amount = ($invoice_entry->rate * $quantity);
                    }
                    $invoice_entry->amount      = $amount;
                    $invoice_entry->quantity    = $quantity;
                    $invoice_entry->updated_by  = $user;

                    $invoice_entry->update();


                    //Item
                    $item = Item::find($invoice_entry->item_id);

                    $item->total_sales  -= $input['returned_quantity'][$i];

                    $item->update();

                }
                else{
                    $invoice_entry = InvoiceEntry::find($input['invoice_entries_id'][$i]);

                    $quantity = $invoice_entry->quantity;

                    if($invoice_entry->discount_type == 1){
                        $discount = $invoice_entry->discount;
                    }
                    elseif($invoice_entry->discount_type == 0){
                        $discount = (($invoice_entry->rate * $quantity * $invoice_entry->discount)/100);

                    }
                    else{
                        $amount = ($invoice_entry->rate * $quantity);
                    }
                }

                $total_discount += $discount;
                
            }

            //journal

            $journal = JournalEntry::where(['invoice_id' => $id,'account_name_id' => 21,'debit_credit' => 1])->first();

            if($journal){
                $journal->amount = $total_discount;
                
                $journal->update();
            }

            //Journal Entries

            $invoice_entry = DB::select( DB::raw("(SELECT account_id as account_id, SUM(quantity*rate) as amount FROM invoice_entries WHERE invoice_id=$id GROUP BY account_id)"));

            for($i=0;$i<count($invoice_entry);$i++){
                $journal_entries = JournalEntry::where(['invoice_id' => $id,'account_name_id' => $invoice_entry[$i]->account_id])->first();

                $journal_entries->amount        = $invoice_entry[$i]->amount;
                $journal_entries->updated_by    = $user;

                $journal_entries->update();
            }

            //Payment Receive Entry

            $payment_receive = PaymentReceiveEntryModel::where('invoice_id' , $id)->sum('amount');

            //Invoice

            $invoice = Invoice::find($id);
            $invoice_entries_amount = InvoiceEntry::where('invoice_id',$id)->sum('amount');

            $adjustment = $invoice->adjustment;
            $shipping_charge = $invoice->shipping_charge;
            $pr_adjustment = $invoice->pr_adjustment;
            $total_amount = $invoice->total_amount;
            $tax_total = $invoice->tax_total;

            $tax_main = ($tax_total * 100)/($total_amount - $tax_total);
            $tax = ($invoice_entries_amount * $tax_main)/100;

            $main_amount = ($invoice_entries_amount + $adjustment + $shipping_charge + $pr_adjustment + $tax);

            $invoice->total_amount      = $main_amount;
            $invoice->due_amount        = ($main_amount - $payment_receive);
            $invoice->tax_total         = $tax;
            $invoice->updated_by        = $user;

            $invoice->update();



            //journal Tax

            $journal = JournalEntry::where(['invoice_id' => $id,'account_name_id' => 9,'debit_credit' => 0])->first();

            if($journal){
                $journal->amount = $tax;
                
                $journal->update();
            }

            //journal Amount

            //journal Tax

            $journal = JournalEntry::where(['invoice_id' => $id,'account_name_id' => 5,'debit_credit' => 1])->first();

            if($journal){
                $journal->amount = $main_amount;
                
                $journal->update();
            }

            DB::commit();

            return Redirect::route('pos')
                            ->with(['alert.message' => 'Sales Return updated successfully','alert.status' => 'success']);
        }
        catch(\Exception $e){
            DB::rollback();
            $mesg = $e->getMessage();
            return redirect()
                ->route('pos')
                ->with('alert.status', 'delete')
                ->with('alert.message', " $mesg");
        }
    }

    public function destroy($id)
    {
        //
    }

    public function ajax_invoice($customer_id) {
        $invoices = Invoice::where('customer_id', $customer_id)->where('due_amount', 0)->get();

        foreach($invoices as $invoice){
            $invoice->invoice_date = date('d-m-Y', strtotime($invoice->invoice_date));
        }

        return json_encode($invoices);
    }

    public function ajax_product($invoice_id) {
        $products = InvoiceEntry::where('invoice_id', $invoice_id)
                    ->leftjoin('item', 'item.id', 'invoice_entries.item_id')
                    ->select('item.*')
                    ->get();

        return json_encode($products);
    }

    public function ajax_quantity($invoice_id, $product_id) {
        $sold_quantity = InvoiceEntry::where('invoice_id', $invoice_id)
                        ->where('item_id', $product_id)
                        ->selectRaw('SUM(quantity) as quantity')
                        ->first()->quantity;

        $return_quantity = CreditNote::where('invoice_id', $invoice_id)
                    ->leftjoin('credit_note_entries', 'credit_note_entries.credit_note_id', 'credit_notes.id')
                    ->where('credit_note_entries.item_id', $product_id)
                    ->selectRaw('SUM(credit_note_entries.quantity) as quantity')
                    ->first()->quantity;

        return ($sold_quantity ?? 0) - ($return_quantity ?? 0);
    }
}
