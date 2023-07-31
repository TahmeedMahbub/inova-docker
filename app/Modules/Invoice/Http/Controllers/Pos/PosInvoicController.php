<?php

namespace App\Modules\Invoice\Http\Controllers\Pos;

use App\Lib\sortBydate;
use App\Lib\TemplateHeader;
use App\Models\AccountChart\Account;
use App\Models\Branch\Branch;
use App\Models\Inventory\Item;
use App\Models\Inventory\Stock;
use App\Models\Inventory\ProductTransfer;
use App\Models\Inventory\ImeiInvoice;
use App\Models\MoneyOut\StockSerial;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Moneyin\InvoiceDue;
use App\Models\Recruit\Recruitorder;
use App\Models\Template\HeaderTemplate;
use App\Models\Visa\Ticket\Order\Order;
use App\Models\VisaStamp\VisaStamp;
use App\Modules\Invoice\Http\Response\Payment;
use DateTime;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

use DB;

use App\Models\Moneyin\Invoice;
use App\Models\Contact\Contact;
use App\Models\ManualJournal\Journal;
use App\Models\ManualJournal\JournalEntries;
use App\Models\Moneyin\ExcessPayment;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\Moneyin\PaymentReceives;
use App\Models\Moneyin\CreditNotePayment;
use App\Models\Moneyin\CreditNote;
use App\Models\Contact\Agent;
use App\Models\OrganizationProfile\OrganizationProfile;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use NumberToWords\NumberToWords;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\ItemSubCategory;
use App\User;

class PosInvoicController extends Controller
{

    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];

    public function __construct()
    {

      $this->increasing_limit = DB::statement('SET SESSION group_concat_max_len = 100000000000');
    }

    public function index(Request $request)
    {
        $invoice        = isset($request->invoice_no) ? str_pad($request->invoice_no, 6, '0', STR_PAD_LEFT) :0 ;
        $auth_id        = Auth::id();
        $sort           = new sortBydate();
        $branch_id      = session('branch_id');

        $this->getBranchUsers($branch_id);

        $branchs        = Branch::orderBy('id','asc')->get();
        $invoices       = [];
        $condition      = "YEAR(str_to_date(invoice_date,'%d-%m-%Y')) = YEAR(CURDATE()) AND MONTH(str_to_date(invoice_date,'%d-%m-%Y')) = MONTH(CURDATE())";

        try{
            if($branch_id == 1)
            {
                if($request->due)
                {
                    $invoices   = Invoice::where('due_amount','!=',0)
                                            ->when($invoice != 0, function ($query) use ($invoice){
                                                    return $query->where('invoices.invoice_number', $invoice);
                                                    })
                                            ->get();
                }
                else
                {
                    $invoices   = Invoice::whereRaw($condition)
                                            ->when($invoice != 0, function ($query) use ($invoice){
                                                return $query->where('invoices.invoice_number', $invoice);
                                                })
                                            ->get();
                }
            }
            else
            {
                $invoices       = Invoice::select(DB::raw('invoices.*'))
                                            ->whereRaw($condition)->get();
                $invoices       = $invoices->when($invoice != 0, function ($query) use ($invoice){
                                               return $query->where('invoices.invoice_number', $invoice);
                                            })
                                            ->whereIn('created_by', $this->targeted_users);
            }

            return view('invoice::Pos.index',compact('invoices','branchs'));

        }
        catch (\Exception $exception)
        {
            return view('invoice::Pos.index',compact('invoices','branchs'));
        }
    }
    public function showMap($id)
    {
        $invoice = Invoice::where('id',$id)->first();
        $lat     = $invoice->latitude;
        $long    = $invoice->longitude; 
        return view('invoice::Pos.map',compact('invoices','branchs','lat','long'));
    }

    public function search(Request $request)
    {
        $branchs        = Branch::orderBy('id','asc')->get();
        $branch_id      = $request->branch_id ? $request->branch_id : session('branch_id');

        $this->getBranchUsers($branch_id);
        $from_date      =  date('Y-m-d',strtotime($request->from_date));
        $to_date        =  date('Y-m-d',strtotime($request->to_date));
        $condition      = "str_to_date(invoice_date, '%d-%m-%Y') between '$from_date' and '$to_date'";
        $invoices       = [];

        try{
            if($branch_id == 1)
            {
                $invoices    = Invoice::whereRaw($condition)
                                        ->where('item_category_id',null)
                                        ->where('item_sub_category_id',null)
                                        ->get();
            }
            else
            {
                $invoices   = Invoice::select(DB::raw('invoices.*'))
                                        ->where('item_category_id',null)
                                        ->where('item_sub_category_id',null)
                                        ->whereRaw($condition)
                                        ->get();
                $invoices   = $invoices->whereIn('created_by', $this->targeted_users);

            }

            $sort           = new sortBydate();

            // $invoices       = $sort->get('\App\Models\Moneyin\Invoice','invoice_date','d-m-Y',$invoic);

            return view('invoice::Pos.index',compact('invoices','branchs','branch_id','from_date','to_date'));

       }
       catch (\Exception $exception)
       {
           return view('invoice::Pos.index',compact('invoices','branchs','branch_id','from_date','to_date'));
       }
    }

    public function create()
    {

        $branch_id          = session('branch_id');
        $item_category      = ItemCategory::orderBy('item_category_name', 'ASC')
                                            ->get();

        $customers          = Contact::leftjoin('users' , 'users.id', '=', 'contact.created_by')
                                        // ->when($branch_id != 1, function ($query) use ($branch_id) {
                                        //         return $query->where('users.branch_id', '=', $branch_id);
                                        //     })
                                        ->select('contact.*')
                                        ->get();

        $agents             = $customers;
        $account            = Account::all();
        $accounts           = Account::whereIn('id',[4,5])->get();

        $invoices           = Invoice::count();

        $delivery_persons   = Contact::leftjoin('users' , 'users.id', '=', 'contact.created_by')
                                        ->where('contact_category_id', 3)
                                        ->when($branch_id != 1, function ($query) use ($branch_id)
                                        {
                                            return $query->where('users.branch_id', '=', $branch_id);
                                        })
                                        ->get()
                                        ->sortBy('display_name');

        if($invoices > 0)
        {
            $invoice        = Invoice::orderBy('created_at', 'desc')->first();
            $invoice_number = $invoice['invoice_number'];
            $invoice_number = $invoice_number + 1;
        }
        else
        {
            $invoice_number = 1;
        }
        $product            = Item::all();
        $invoice_number     = str_pad($invoice_number, 6, '0', STR_PAD_LEFT);

        return view('invoice::Pos.create', compact('customers', 'invoice_number', 'agents','account', 'item_category', 'accounts', 'delivery_persons', 'product'));
    }

    public function store(Request $request)
    {   
        $validatiolist = [
            'customer_id'          => 'required',
            'invoice_date'         => 'required',
            'item_id.*'            => 'required',
            'quantity.*'           => 'required',
            'rate.*'               => 'required',
            'amount.*'             => 'required',
            'account_id'           => 'required',
         ];

        if($request->check_payment)
        {
            $validatiolist["payment_account"]       = "required";
            $validatiolist["payment_amount"]        = "required||numeric";

        }

        $payment                =  new Payment();

        $this->validate($request, $validatiolist);

        try
        {
            DB::beginTransaction();

            $data                           = $request->all();
            $user_id                        = Auth::user()->id;
            $helper                         = new \App\Lib\Helpers;
            $check_Item_Quantity            = $helper->checkItemQuantity($data);
            if(!$check_Item_Quantity)
            {
               throw new \Exception("Quantity is not available for some item. Please add the invoice again!!!");
            }

            $invoices                       = Invoice::count();

            if($invoices > 0)
            {   
                $invoice                    = Invoice::orderBy('created_at', 'desc')->first();
                $invoice_number             = $invoice['invoice_number'];
                $invoice_number             = $invoice_number + 1;

            }
            else
            {
                $invoice_number             = 1;
            }

            $invoice_number = str_pad($invoice_number, 6, '0', STR_PAD_LEFT);
            $invoice                        = new Invoice;
            $invoice->invoice_number        = $invoice_number;
            $invoice->invoice_date          = $data['invoice_date'];
            $invoice->reference             = $data['reference'];
            $invoice->customer_note         = $data['customer_note'];
            $invoice->personal_note         = $data['personal_note'];
            $invoice->tax_total             = $data['tax_total'];
            $invoice->shipping_charge       = $data['shipping_charge'];
            $invoice->adjustment            = $data['adjustment'];
            $invoice->total_amount          = $data['total_amount'];
            $invoice->item_category_id      = empty($data['item_category_id']) ? null : $data['item_category_id'];
            $invoice->item_sub_category_id  = empty($data['item_sub_category_id']) ? null : $data['item_sub_category_id'];
            $invoice->due_amount            = $data['total_amount'];
            $invoice->delivery_person       = empty($data['delivery_person_id']) ? null : $data['delivery_person_id'];
            $invoice->receive_person        = empty($data['receive_person_id']) ? null : $data['receive_person_id'];
            $invoice->receive_date          = empty($data['receive_date']) ?  null  : date("Y-m-d", strtotime($data['receive_date']));
            $invoice->latitude              = $data['lat'];
            $invoice->longitude             = $data['long'];

            if($request->save)
            {
                $invoice->save              = 1;
            }

            $invoice->customer_id           = $data['customer_id'];
            $invoice->created_by            = $user_id;
            $invoice->updated_by            = $user_id;

            if($request->hasFile('file'))
            {
                $file                       = $request->file('file');
                $file_name                  = $file->getClientOriginalName();
                $without_extention          = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention             = $file->getClientOriginalExtension();
                $num                        = rand(1, 500);
                $new_file_name              = "invoice-".$invoice_number. '.' . $file_extention;
                $success                    = $file->move('uploads/invoice', $new_file_name);

                if($success)
                {
                    $invoice->file_url      = 'uploads/invoice/' . $new_file_name;
                    $invoice->file_name     = $new_file_name;
                }

            }

             //imei no string to array 
            $ime_no         = explode(',', $request->ime_no);
            $item_id_imei   = explode(',' ,$request->item_ime);

            if($invoice->save())
            {
                $invoice_id                 = $invoice['id'];
                foreach ($request->item_id as $key => $value) 
                {
                    $invoice_entry                    = new InvoiceEntry;
                    $invoice_entry->quantity          = $request->quantity[$key];
                    $invoice_entry->rate              = $request->rate[$key];
                    $invoice_entry->description       = $request->description[$key];
                    $invoice_entry->amount            = $request->amount[$key];
                    $invoice_entry->serial            = $request->serial[$key];
                    $invoice_entry->discount          = $request->discount[$key];
                    $invoice_entry->discount_type     = $request->discount_type[$key];
                    $invoice_entry->item_id           = $request->item_id[$key];
                    $invoice_entry->invoice_id        = $invoice->id;
                    $invoice_entry->tax_id            = 1;
                    $invoice_entry->account_id        = $request->account_id[$key];
                    $invoice_entry->created_by        = $user_id;
                    $invoice_entry->updated_by        = $user_id;
                    $invoice_entry->created_at        = \Carbon\Carbon::now()->toDateTimeString();
                    $invoice_entry->updated_at        = \Carbon\Carbon::now()->toDateTimeString();
                    $invoice_entry->save();
                    
                    if($invoice_entry)
                    {
                       
                    } 
                   
                }
                //update stock_seiral and crete product transfer
                foreach($request->serial as $key=>$value)
                {
                    $seria = explode(',', $value);
                    if(!empty($value))
                    {   
                        foreach ($seria  as $key2 => $value2) 
                        { 
                            if($value2 != '')
                            {  
                                $stock_serial                        = StockSerial::where('serial',trim($value2))->first(); 
                                if($stock_serial)
                                {
                                    $stock_serial                        = StockSerial::find($stock_serial['id']);
                                    if($stock_serial)
                                    {
                                        $stock_serial->stock_status          = 2; 
                                        $stock_serial->invoice_id            = $invoice->id; 
                                        $stock_serial->save();
    
                                        $serial_id_add = $this->serialId(date('d-m-Y',strtotime($data['invoice_date'])), Auth::user()->id, 2);
    
                                        $product_transfer                    = new ProductTransfer;
                                        $product_transfer->transfer_type     = 2;
                                        $product_transfer->status            = 2;
                                        $product_transfer->serial            = $value2;
                                        $product_transfer->serial_id         = $serial_id_add;
                                        $product_transfer->sr_id             = Auth::user()->id;
                                        $product_transfer->invoice_id        = $invoice->id;
                                        $product_transfer->date              = date('d-m-Y',strtotime($data['invoice_date']));
                                        $product_transfer->save();                    
                                    }  
                                }
                            }
                        }
                    }
                }

               //End update stock_seiral and crete product transfer    
                if($request->submit)
                {   
                    $status                 = $this->insertManualJournalEntries($data, $invoice_id);
                    $status2                = $helper->updateItemAfterCreatingInvoice($data);
                     //payment
                    if($request->check_payment) {
                        $payment_receive                = $payment->makePaymentReceive($request, $invoice_id);
                        $invoice->payment_recieve_id    = $payment_receive['id'];
                        $invoice->due_amount            = $invoice->due_amount - $request->payment_amount;
                        $invoice->save();
                    }

                    if(!$status || !$status2)
                    {
                        throw new \Exception("Invoice Failed to add.");
                    }

                }
            }

            DB::commit();

            return redirect()
                        ->route('point_of_sales_index')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Invoice Added Successfully!');

        }
        catch(\Exception $e)
        {   
             DB::rollback();
             $mesg = $e->getMessage();
             return redirect()
                        ->route('point_of_sales_index')
                        ->with('alert.status', 'delete')
                        ->with('alert.message', " $mesg");
        }
    }

    public function show($id)
    {
        $invoices                           = [];
           
        try{
            $branch_id      = session('branch_id');
            $this->getBranchUsers($branch_id);

            $invoice                        = Invoice::find($id);

            if(!$invoice)
            {
                return back()->with('alert.status', 'warning')->with('alert.message', 'Invoice not found!');
            }

            $payment_receive_entries        = PaymentReceiveEntryModel::where('invoice_id', $id)->get();
            $credit_receive_entries         = CreditNotePayment::where('invoice_id', $id)->get();
            $excess_receive_entries         = ExcessPayment::where('invoice_id', $id)->get();
            $invoices                       = Invoice::orderBy('invoice_date', 'desc')->take(20)->get()->toArray();
            
            $sort                           = new sortBydate();


            if ($branch_id == 1)
            {
               $invoices                    = $sort->get('\App\Models\Moneyin\Invoice', 'invoice_date', 'd-m-Y', $invoices);
            }
            else
            {
                $invoices                   = $sort->get('\App\Models\Moneyin\Invoice', 'invoice_date', 'd-m-Y', $invoices);
                $invoices                   = $invoices->whereIn('created_by', $this->targeted_users);

            }

            $invoice_entries                = InvoiceEntry::where('invoice_id', $id)->get();
            $invoice_discount_count         = InvoiceEntry::where([['invoice_id', '=', $id], ['discount', '!=', 0]])->count();

            $sub_total                      = 0;
            $OrganizationProfile            = OrganizationProfile::find(1);
            $due_date                       = DB::table('invoice_due_table')->where('invoice_id',$id)->select('due_date')->first();


            foreach ($invoice_entries as $invoice_entry)
            {
                $sub_total                  = $sub_total + $invoice_entry->amount;
            }
            
            $long_lat = Invoice::where('id',$id)->first();
            $lat      = $long_lat->latitude;
            $long     = $long_lat->longitude; 
            return view('invoice::Pos.show', compact('lat','long','invoice', 'due_date', 'invoice_entries', 'sub_total', 'invoices', 'payment_receive_entries', 'credit_receive_entries', 'excess_receive_entries', 'OrganizationProfile', 'invoice_discount_count'));

        }

        catch (\Exception $exception){

            return back()->with('alert.status', 'delete')->with('alert.message', 'Invoice not found!');

        }
    }

    public function edit(Request $request,$id)
    {

        $show_all_contact       = OrganizationProfile::first();
        $show_all_contact       = $show_all_contact->show_all_contact;
        $invoice_entry          = InvoiceEntry::where('invoice_id', $id)->get();
        $item_category          = ItemCategory::orderBy('item_category_name', 'ASC')->get();
        $branch_id              = session('branch_id');
        $due_balance            = InvoiceDue::where('invoice_id', $id)->get();
        $delivery_persons       = Contact::leftjoin('users' , 'users.id', '=', 'contact.created_by')
                                            ->where('contact_category_id', 3)
                                            ->when($branch_id != 1, function ($query) use ($branch_id)
                                            {
                                                return $query->where('users.branch_id', '=', $branch_id);
                                            })
                                            ->get()
                                            ->sortBy('display_name');

        $account              = Account::all();

        $accounts             = Account::whereIn('id',[4,5])->get();
        $product              = Item::all();

        $customers              = Contact::leftjoin('users' , 'users.id', '=', 'contact.created_by')
                                        ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                return $query->where('users.branch_id', '=', $branch_id);
                                            })
                                        ->select('contact.*')
                                        ->get();

        $agents                 = $customers;
        $invoice                = Invoice::find($id);

          //calculating tax vat in %
        $invoice_shipincaharg   = $invoice->shipping_charge;
        $invoice_adjustment     = $invoice->adjustment;
        $invoice_tax_total      = $invoice->tax_total;
        $invoice_total_amount   = $invoice->total_amount;
        $sub_total              = $invoice_total_amount -$invoice_shipincaharg  -$invoice_tax_total ;

        $tax                    = $sub_total == 0 ? 0 : ($invoice_tax_total *100)/($sub_total);

        $checkAccess = $this->checkIfUserHasAccess($invoice);

        if($checkAccess == 1){
            return back();
        }

        return view('invoice::Pos.edit', compact('accounts','product','account','customers', 'invoice', 'agents', 'item_category', 'invoice_entry', 'due_balance', 'delivery_persons', 'tax'));

    }

    public function update(Request $request, $id)
    {

      $validatiolist = [
          'customer_id'          => 'required',
          'invoice_date'         => 'required',
          'item_id.*'            => 'required',
          'quantity.*'           => 'required',
          'rate.*'               => 'required',
          'amount.*'             => 'required',
          'account_id'           => 'required',

      ];

        try{

            DB::beginTransaction();
             // sock serial table update
            $stock_serial_update            = StockSerial::where('invoice_id',$id)->get();
            foreach($stock_serial_update as $key=>$value)
            {  
              $stock_serial_update                        = StockSerial::find($value['id']);   
              $stock_serial_update->stock_status          = 3 ;   
              $stock_serial_update->invoice_id            = null ;   
              $stock_serial_update->save();

            }
            // delete product transpher tabel data 
            ProductTransfer::where('invoice_id',$id)->delete();   
            $data                           = $request->all();


            $invoice                        = Invoice::find($id);

            $total_received_payment         = $invoice->total_amount - $invoice->due_amount;

            if($data['total_amount'] >= $total_received_payment){

                $invoice->due_amount        = $data['total_amount'] - $total_received_payment;

            }else{

                return redirect()
                    ->route('invoice_edit', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry! Invoice Total Amount cannot be smaller than Total Received Payment.');
            }



            $user_id                        = Auth::user()->id;

            $helper                         = new \App\Lib\Helpers;
            $helper->updateItemAfterUpdatingInvoice($data);

            //Update
            $created_by                     = $invoice->created_by;
            $created_at                     = $invoice->created_at;
            $updated_at                     = \Carbon\Carbon::now()->toDateTimeString();

            if($request->hasFile('file'))
            {

                $file                       = $request->file('file');

                if ($invoice->file_url) {
                    $delete_path            = public_path($invoice->file_url);
                    $delete                 = unlink($delete_path);
                }

                $file_name                  = $file->getClientOriginalName();
                $without_extention          = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention             = $file->getClientOriginalExtension();
                $num                        = rand(1, 500);
                $new_file_name              = $data['invoice_number']. '.' . $file_extention;

                $success                    = $file->move('uploads/invoice', $new_file_name);

                if ($success) {
                    $invoice->file_url      = 'uploads/invoice/' . $new_file_name;
                    $invoice->file_name     = $new_file_name;
                }

            }

            $invoice->invoice_date          = date("d-m-Y", strtotime($data['invoice_date']));

            $invoice->reference             = $data['reference'];
            $invoice->customer_note         = $data['customer_note'];
            $invoice->personal_note         = $data['personal_note'];
            $invoice->tax_total             = $data['tax_total'];
            $invoice->shipping_charge       = $data['shipping_charge'];
            $invoice->adjustment            = $data['adjustment'];
            $invoice->total_amount          = $data['total_amount'];
            $invoice->item_category_id      = empty($data['item_category_id']) ? null : $data['item_category_id'];
            $invoice->item_sub_category_id  = empty($data['item_sub_category_id']) ? null : $data['item_sub_category_id'];
            $invoice->due_amount            = $data['total_amount'] - $total_received_payment;
            $invoice->delivery_person       = empty($data['delivery_person_id']) ? null : $data['delivery_person_id'] ;
            $invoice->receive_person        = empty($data['receive_person_id']) ? null : $data['receive_person_id'];
            $invoice->receive_date          = empty($data['receive_date']) ?  null  : date("Y-m-d", strtotime($data['receive_date']));


            $invoice->save                  = null;
            $invoice->customer_id           = $data['customer_id'];
            $invoice->updated_by            = $user_id;
            $invoice->updated_at            = $updated_at;

            $invoice_entry_update               = [];

            if($invoice->update()){

                $invoice_entry                  = Invoice::find($id)->invoiceEntries();

                if($invoice_entry->delete()) {

                }

                $i = 0;

                foreach($data['item_id'] as $account) {

                    if(!$data['discount'][$i]) {

                        $invoice_entry_update[] = [
                            'quantity'              => $data['quantity'][$i],
                            'rate'                  => $data['rate'][$i],
                            'description'           => null,
                            'amount'                => $data['amount'][$i],
                            'discount'              => 0,
                            'discount_type'         => 0,
                            'item_id'               => $data['item_id'][$i],
                            'invoice_id'            => $id,
                            'tax_id'                => 1,
                            'serial'                => $data['serial'][$i],
                            'account_id'            => $data['account_id'][$i],
                            'created_by'            => $created_by,
                            'updated_by'            => $user_id,
                            'created_at'            => $created_at,
                            'updated_at'            => $updated_at,
                        ];

                    }else {

                        $invoice_entry_update[] = [
                            'quantity'              => $data['quantity'][$i],
                            'rate'                  => $data['rate'][$i],
                            'description'           => $data['description'][$i],
                            'amount'                => $data['amount'][$i],
                            'discount'              => $data['discount'][$i],
                            'discount_type'         => $data['discount_type'][$i],
                            'item_id'               => $data['item_id'][$i],
                            'invoice_id'            => $id,
                            'serial'                => $data['serial'][$i],
                            'tax_id'                => 1,
                            'account_id'            => $data['account_id'][$i],
                            'created_by'            => $created_by,
                            'updated_by'            => $user_id,
                            'created_at'            => $created_at,
                            'updated_at'            => $updated_at,
                        ];

                    }

                    if($data['discount_type'][$i] == 1) {
                        $data['discount'][$i]       = $data['discount'][$i];
                    }else{
                        $data['discount'][$i]       = $data['discount'][$i];
                    }

                    $i++;

                } 
                 //update stock serial
                foreach($request->serial as $key=>$value)
                {
                    $seria = explode(',', $value);
                    if(!empty($value))
                    {   
                        foreach ($seria  as $key2 => $value2) 
                        { 
                          if($value2 != '')
                          {  
                            $stock_serial                        = StockSerial::where('serial',trim($value2))->first();
                            if($stock_serial)
                            {
                                $stock_serial                        = StockSerial::find($stock_serial['id']);
                                if($stock_serial &&  $stock_serial['stock_status'] == 3 )
                                {
                                    $stock_serial->stock_status          = 2; 
                                    $stock_serial->invoice_id            = $id; 
                                    $stock_serial->save();
    
                                    $serial_id_add = $this->serialId(date('d-m-Y',strtotime($data['invoice_date'])), Auth::user()->id, 2);
    
                                    $product_transfer                    = new ProductTransfer;
                                    $product_transfer->transfer_type     = 2;
                                    $product_transfer->status            = 2;
                                    $product_transfer->serial            = $value2;
                                    $product_transfer->serial_id         = $serial_id_add;
                                    $product_transfer->sr_id             = Auth::user()->id;
                                    $product_transfer->invoice_id        = $invoice->id;
                                    $product_transfer->date              = date('d-m-Y',strtotime($data['invoice_date']));
                                    $product_transfer->save();
                                }   
                            }
                          }
                        }
                    }
                }
            //End update stock_seiral and crete product transfer

                if(DB::table('invoice_entries')->insert($invoice_entry_update)){

                    $this->updateManualJournalEntries($data, $id, $data['agentcommissionAmount']);

                    DB::commit();

                    return redirect()
                        ->route('point_of_sales_index')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Invoice Updated Successfully!');

                }

            }

            DB::rollback();

            return redirect()
                ->route('point_of_sales_edit', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something Went Wrong! Please Try Again!');

        }
        catch (Exception $e) {

            DB::rollback();
            return $e->getMessage();

        }

    }

    public function challan($id)
    {
        $invoice                 = Invoice::find($id);
        $payment_receive_entries = PaymentReceiveEntryModel::where('invoice_id', $id)->get();
        $credit_receive_entries  = CreditNotePayment::where('invoice_id', $id)->get();
        $excess_receive_entries  = ExcessPayment::where('invoice_id', $id)->get();
        $invoices                = Invoice::all();
        $invoice_entries         = InvoiceEntry::where('invoice_id', $id)->get();
        $sub_total               = 0;
        $OrganizationProfile     = OrganizationProfile::find(1);
        foreach ($invoice_entries as $invoice_entry)
        {
            $sub_total = $sub_total + $invoice_entry->amount;
        }

        return view('invoice::invoice.challan', compact('invoice', 'invoice_entries', 'sub_total','invoices','payment_receive_entries','credit_receive_entries','excess_receive_entries','OrganizationProfile'));
    }

    public function destroy($id)
    {  

        try
        {
            $invoice = Invoice::find($id);
           
            $checkAccess = $this->checkIfUserHasAccess($invoice);
            if($checkAccess == 1){
                return back();
            }

            // sock serial table update
                $stock_serial_update            = StockSerial::where('invoice_id',$id)->get();
                if ($stock_serial_update)
                {
                    foreach($stock_serial_update as $key=>$value)
                    {
                    $stock_serial_update                        = StockSerial::find($value['id']);   
                    $stock_serial_update->stock_status          = 3 ;   
                    $stock_serial_update->invoice_id            = null ;   
                    $stock_serial_update->save();

                    // delete product transpher tabel data 
                    $product_transfer_delete  = ProductTransfer::where('serial', $value['serial'])->where('invoice_id',$id)->delete(); 
                    
                    }
                }    
                
                
                
            $helper = new \App\Lib\Helpers;

            //check payment receive is used in this invoice or not
            if($helper->isPaymentReceiveInThisInvoice($id))
            {  
                return redirect()
                            ->route('point_of_sales_index')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'Payment receive used in this invoice. First You have to delete payment receive from this invoice.');
            }
           
            //check credit note is used in this invoice or not
            if($helper->isCreditNoteInThisInvoice($id))
            {
               
                return redirect()
                            ->route('point_of_sales_index')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'Credit note used in this invoice. First You have to delete credit note from this invoice.');
            }


            $payment_amount = DB::table('payment_receives_entries')
                                ->where('invoice_id', $id)
                                ->groupBy('payment_receives_id')
                                ->selectRaw('sum(amount) as amount, payment_receives_id')
                                ->get();

            foreach ($payment_amount as $value)
            {
                $helper->paymentReceiveBackAfterDeleteInvoice($value->payment_receives_id, $value->amount);
            }


            $credit_note = DB::table('credit_note_payments')
                                ->where('invoice_id', $id)
                                ->groupBy('credit_note_id')
                                ->selectRaw('sum(amount) as amount, credit_note_id')
                                ->get();

            foreach ($credit_note as $value)
            {
                $helper->creditNoteBackAfterDeleteInvoice($value->credit_note_id, $value->amount);
            }


            $items = InvoiceEntry::where('invoice_id', $id)->get();
            foreach ($items as $item)
            {
                $helper->itemBackAfterDeleteInvoice($item->item_id, $item->quantity);
            }

            if($invoice)
            {

                if($invoice->delete())
                {
                
                    if ($invoice->file_url)
                    {
                        $delete_path = public_path($invoice->file_url);
                        if(file_exists($delete_path)){
                            $delete = unlink($delete_path);
                        }

                    }
                }

                return redirect()
                                ->route('point_of_sales_index')
                                ->with('alert.status', 'danger')
                                ->with('alert.message', 'Invoice deleted successfully!!!');
            }
        }
        catch (Exception $e)
        {
            return $e;
        }    
    }

    public function insertManualJournalEntries($data, $invoice_id)
    {
      
        $user_id                = Auth::user()->id;

        $i                      = 0;
        $discount               = 0;
        $account_array          = array_fill(1, 100, 0);

        foreach ($data['item_id'] as $account)
        {
            if($data['discount'][$i] == "")
            {

            }
            else
            {
                $amount         = $data['quantity'][$i] * $data['rate'][$i];

                if($data['discount_type'][$i] == 1){

                    $discount   = $discount + $data['discount'][$i];

                }else{

                    $discount   = $discount + ($data['discount'][$i] * $amount) / 100;

                }

            }

            $account_array[$data['account_id'][$i]] =  $account_array[$data['account_id'][$i]] + ($data['quantity'][$i] * $data['rate'][$i]);

            $i++;

        }

        //return $account_array;
        $invoice_id             = $invoice_id;

        //insert total amount as debit
        $journal_entry                  = new JournalEntry;
        $journal_entry->note            = $data['customer_note'];
        $journal_entry->debit_credit    = 1;
        $journal_entry->amount          = $data['total_amount'];
        $journal_entry->account_name_id = 5;
        $journal_entry->jurnal_type     = "invoice";
        $journal_entry->invoice_id      = $invoice_id;
        $journal_entry->contact_id      = $data['customer_id'];
        $journal_entry->created_by      = $user_id;
        $journal_entry->updated_by      = $user_id;
        $journal_entry->assign_date     = date('Y-m-d', strtotime($data['invoice_date']));

        if($journal_entry->save())
        {

        }
        else
        {
            //delete all journal entry for this invoice...
            $invoice                    = Invoice::find($invoice_id);
            $invoice->delete();
            return false;
        }

        //insert discount as credit
        if($discount > 0)
        {
            $journal_entry                  = new JournalEntry;
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->debit_credit    = 1;
            $journal_entry->amount          = $discount;
            $journal_entry->account_name_id = 21;
            $journal_entry->jurnal_type     = "invoice";
            $journal_entry->invoice_id      = $invoice_id;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date     = date('Y-m-d', strtotime($data['invoice_date']));

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
                $invoice                   = Invoice::find($invoice_id);
                $invoice->delete();
                return false;
            }
        }

        //insert tax total as credit
        if($data['tax_total'] > 0)
        {
            $journal_entry                  = new JournalEntry;
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = $data['tax_total'];
            $journal_entry->account_name_id = 9;
            $journal_entry->jurnal_type     = "invoice";
            $journal_entry->invoice_id      = $invoice_id;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date     = date('Y-m-d', strtotime($data['invoice_date']));

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
                $invoice                   = Invoice::find($invoice_id);
                $invoice->delete();
                return false;
            }
        }

        //insert shipping charge as credit
        if($data['shipping_charge'] > 0)
        {
            $journal_entry                  = new JournalEntry;
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = $data['shipping_charge'];
            $journal_entry->account_name_id = 20;
            $journal_entry->jurnal_type     = "invoice";
            $journal_entry->invoice_id      = $invoice_id;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date     = date('Y-m-d', strtotime($data['invoice_date']));

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
                $invoice                   = Invoice::find($invoice_id);
                $invoice->delete();
                return false;
            }
        }
        //insert adjustment as credit
        if($data['adjustment'] != 0)
        {
            $journal_entry                      = new JournalEntry;
            $journal_entry->note                = $data['customer_note'];

            if($data['adjustment'] > 0)
            {
                $journal_entry->debit_credit    = 0;
            }
            else
            {
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

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
                $invoice                        = Invoice::find($invoice_id);
                $invoice->delete();

                return false;
            }
        }

        //return $account_array;
        $invoice_entry                          = [];

        for($j = 1; $j<count($account_array)-2; $j++) {

            if($account_array[$j] != 0)
            {
                $invoice_entry[] = [
                    'note'              => $data['customer_note'],
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

        if(DB::table('journal_entries')->insert($invoice_entry))
        {
            return true;
        }
        else
        {
            //delete all journal entry for this invoice...
            $invoice                = Invoice::find($invoice_id);
            $invoice->delete();

            return false;
        }

            return false;

    }

    public function updateManualJournalEntries($data, $id)
    {

        $invoice_entries_delete = Invoice::find($id)->journalEntries();

        if($invoice_entries_delete->delete())
        {

        }

        $user_id = Auth::user()->id;
        $i = 0;
        $discount = 0;
        $account_array = array_fill(1, 100, 0);

        foreach ($data['item_id'] as $account)
        {

            if($data['discount'][$i] == "")
            {
                $amount = $data['quantity'][$i]*$data['rate'][$i];
                $discount = $discount + (0*$amount)/100;
                $discount1 = ($data['discount'][$i]*$amount)/100;
            }
            else
            {
                $amount = $data['quantity'][$i]*$data['rate'][$i];

                if($data['discount_type'][$i] == 1){
                    $discount = $discount+($data['discount'][$i] * $data['quantity'][$i]);
                }else{
                    $discount = $discount + ($data['discount'][$i]*$amount)/100;
                }

                $discount1 = ($data['discount'][$i]*$amount)/100;
            }

            // $account_array[$data['account_id'][$i]] =  $account_array[$data['account_id'][$i]] + ($data['quantity'][$i]*$data['rate'][$i])-$discount1;
            $account_array[$data['account_id'][$i]] =  $account_array[$data['account_id'][$i]] + ($data['quantity'][$i]*$data['rate'][$i]);

            $i++;
        }

        $invoice_id = $id;

        //insert total amount as debit
        $journal_entry = new JournalEntry;
        $journal_entry->note            = $data['customer_note'];
        $journal_entry->debit_credit    = 1;
        $journal_entry->amount          = $data['total_amount'];
        $journal_entry->account_name_id = 5;
        $journal_entry->jurnal_type     = "invoice";
        $journal_entry->invoice_id      = $invoice_id;
        $journal_entry->contact_id      = $data['customer_id'];
        $journal_entry->created_by      = $user_id;
        $journal_entry->updated_by      = $user_id;
        $journal_entry->assign_date      = date('Y-m-d',strtotime($data['invoice_date']));

        if($journal_entry->save())
        {

        }
        else
        {
            //delete all journal entry for this invoice...
        }

        //insert discount as credit
        if($discount>0)
        {
            $journal_entry = new JournalEntry;
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->debit_credit    = 1;
            $journal_entry->amount          = $discount;
            $journal_entry->account_name_id = 21;
            $journal_entry->jurnal_type     = "invoice";
            $journal_entry->invoice_id      = $invoice_id;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($data['invoice_date']));

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
            }
        }

        //insert tax total as debit
        if($data['tax_total']>0)
        {
            $journal_entry = new JournalEntry;
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = $data['tax_total'];
            $journal_entry->account_name_id = 9;
            $journal_entry->jurnal_type     = "invoice";
            $journal_entry->invoice_id      = $invoice_id;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($data['invoice_date']));

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
            }
        }
        //insert shipping charge as credit
        if($data['shipping_charge']>0)
        {
            $journal_entry = new JournalEntry;
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = $data['shipping_charge'];
            $journal_entry->account_name_id = 20;
            $journal_entry->jurnal_type     = "invoice";
            $journal_entry->invoice_id      = $invoice_id;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($data['invoice_date']));

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
            }
        }

        //insert adjustment as credit
        if($data['adjustment'] != 0)
        {
            $journal_entry = new JournalEntry;
            $journal_entry->note            = $data['customer_note'];
            if($data['adjustment']>0)
            {
                $journal_entry->debit_credit    = 0;
            }
            else
            {
                $journal_entry->debit_credit    = 1;
            }
            $journal_entry->amount          = abs($data['adjustment']);
            $journal_entry->account_name_id = 18;
            $journal_entry->jurnal_type     = "invoice";
            $journal_entry->invoice_id      = $invoice_id;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($data['invoice_date']));

            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
            }
        }

        //return $account_array;
        $invoice_entry = [];
        for($j = 1; $j<count($account_array)-2; $j++) {
            if ($account_array[$j] != 0)
            {
                $invoice_entry[] = [
                    'note'              => $data['customer_note'],
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
                    'assign_date'      =>date('Y-m-d',strtotime($data['invoice_date'])),
                ];

            }
        }

        if (DB::table('journal_entries')->insert($invoice_entry))
        {
            return "successfull...";
        }
        else
        {
        //delete all journal entry for this invoice...
        }

        return "error";

    }

    public function useCredit(Request $request)
    {
        $data = $request->all();
        $i = 0;
        foreach ($data['credit_amount'] as $credit_amount)
        {
            if($credit_amount)
            {
                $credit_note = CreditNote::find($data['credit_note_id'][$i]);
                $credit_note->available_credit = ($credit_note['available_credit'] - $credit_amount);
                $credit_note->update();

                $invoice = Invoice::find($data['invoice_id']);
                $invoice->due_amount = $invoice['due_amount'] - $credit_amount;
                $invoice->update();

            }
            $i++;
        }
        $user_id = Auth::user()->id;

        $credit_note_payment_entry = [];
        for($i = 0; $i < count($data['credit_amount']); $i++) {
            if (!$data['credit_amount'][$i])
            {
                continue;
            }

            $credit_note_payment_entry[] = [
                'amount'            => $data['credit_amount'][$i],
                'invoice_id'        => $data['invoice_id'],
                'credit_note_id'    => $data['credit_note_id'][$i],
                'created_by'        => $user_id,
                'updated_by'        => $user_id,
                'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
            ];
        }

        if (DB::table('credit_note_payments')->insert($credit_note_payment_entry))
        {
            return redirect()
                            ->route('invoice_show', ['id' => $data['invoice_id']])
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'Credit notes used successfully!');
        }

            return redirect()
                            ->route('invoice_show', ['id' => $data['invoice_id']])
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'Something went to wrong! please check your input field!!!');

    }


    public function checkIfUserHasAccess($invoice)
    {

        $user_branch    = Auth::user()->branch_id;
        if($invoice->createdBy->branch_id != $user_branch && $user_branch != 1){
            return 1;
        }

    }

    public function itemCaegory($id)
    {
        $data = ItemSubCategory::where('item_category_id',$id)->get();
        return response($data);
    }

    public function itemList($id)
    {
        $data = Item::where('item_sub_category_id',$id)->get();
        return response($data);
    }

    public function itemRate($id)
    {
      $data = Item::where('id',$id)->first();

      return response($data);
    }
    public function itemListStockSerial()
   {
        $data = Item::select('id', 'item_name', 'barcode_no')->get();
        return response($data);
   }

   public function checkSerial($serial)
   {
        $item_id            = 0;
        $item_serial        = "";
        $item_sales_rate    = 0;
        $message            = "";
        $value              = 0;
        $user_type          = Auth::user()->type;
        $user_id            = Auth::user()->id;
 

        $item               = Item::where('barcode_no',$serial)->first();
       
        $serial_entry       = StockSerial::where('stock_serial.serial', $serial)
                                            ->join('product_transfers', 'stock_serial.serial','product_transfers.serial' )
                                            ->where('product_transfers.status',3)
                                            ->where('product_transfers.sr_id', $user_id)
                                            ->where('stock_serial.invoice_id', null)
                                            ->where('stock_serial.stock_status',3)
                                            ->first();

        if($item)
       {
            $item_id            = $item->id;
            $item_sales_rate    = $item->item_sales_rate > 0 ? $item->item_sales_rate : 0;
            $item_serial        = $serial;
            $value              = 0;
        }
        elseif($serial_entry)
       {
           $item_id            = $serial_entry->item_id;
           $item_sales_rate    = $serial_entry->item->item_sales_rate > 0 ? $serial_entry->item->item_sales_rate : 0;
           $item_serial        = $serial;
           $value              = 1;
       }
       else
       {
           $message            = "Serial was not found or already sold. Please try again.";
       }

       return response()->json([
           'item_id'           =>  $item_id,
           'item_serial'       =>  $item_serial,
           'item_sales_rate'   =>  $item_sales_rate,
           'message'           =>  $message,
           'value'             =>  $value,
       ], 201);
   }

  public function customer($bar_code)
  {
    $bar_code  = str_pad($bar_code,6,'0',STR_PAD_LEFT);
    $customer = Contact::where('barcode_no',$bar_code)->selectRaw('display_name, id')->first();
    return response($customer);
  }
    public function getBranchUsers($branch_id)
    {
        $tmp_targeted_users      = [];
        $this->targeted_users    = [];

        $this->branch_id = $branch_id;

        $branch_users = User::where('branch_id', $this->branch_id)->get();

        if(isset($branch_users)){

            foreach($branch_users as $users){
                $tmp_targeted_users[] = $users->id;
            }

        }else
        {

            $tmp_targeted_users = [];

        }

        $this->targeted_users = $tmp_targeted_users;
    }

    public function serialId($date, $sr_name, $transfer_type)
    {
        $serial_id            = ProductTransfer::orderBy('serial_id','DESC')->select('serial_id')->first();
        $serial_id_duplicate  = ProductTransfer::orderBy('serial_id','DESC')
                                                ->select('serial_id')
                                                ->where('transfer_type', $transfer_type)
                                                ->where('date', date('d-m-Y',strtotime($date)))
                                                ->where('sr_id',$sr_name)
                                                ->first();
        if(!empty($serial_id_duplicate))
            return   $serial_id_add  = $serial_id['serial_id'];
        if(!empty($serial_id))
            return  $serial_id_add = $serial_id['serial_id'] + 1;
        else
            return $serial_id_add = 1;
    }

}
