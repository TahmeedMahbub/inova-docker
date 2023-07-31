<?php

namespace App\Modules\Paymentreceive\Http\Controllers;

use App\Lib\sortBydate;
use App\Models\Branch\Branch;
use Dompdf\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Moneyin\PaymentReceives;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\Moneyin\Invoice;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Contact\Contact;
use App\Models\PaymentMode\PaymentMode;
use App\Models\AccountChart\Account;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Recruit\Recruitorder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;
use Session;
use App\User;

class PaymentReceivedWebController extends Controller
{   
    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];

    public function index()
    {
        $auth_id            = Auth::id();
        $branch_id          = session('branch_id');
        $branchs            = Branch::orderBy('id','asc')->get();
        $invoices           = [];
        $paymentreceives    = [];

        $current_time       = Carbon::now()->toDayDateTimeString();
        $from_date          = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $to_date            = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');

        if($branch_id == 1)
        {
            $paymentreceives = PaymentReceives::orderBy('pr_number', 'desc')
                                                ->whereBetween('payment_receives.payment_date', [$from_date,$to_date])
                                                ->get();
        }
        else
        {
            $paymentreceives = PaymentReceives::select(DB::raw('payment_receives.*'))
                                                ->whereBetween('payment_receives.payment_date', [$from_date,$to_date])
                                                ->join('users','users.id','=','payment_receives.created_by')
                                                ->where('users.branch_id',$branch_id)
                                                ->get();
        }

        $date               = "payment_date";
        $sort               = new sortBydate();

        // $paymentreceives    = $sort->get('\App\Models\Moneyin\PaymentReceives',$date,'Y-m-d',$paymentreceives);
        // $invoice            = Invoice::all();
        
        return view('paymentreceive::payment_receive.index',compact('paymentreceives','branchs'));
    }

    public function search(Request $request)
    {
        $auth_id        = Auth::id();
        $branchs        = Branch::orderBy('id','asc')->get();
        $branch_id      =  $request->branch_id;

        if(session('branch_id')==1)
        {
            $branch_id =  $request->branch_id?$request->branch_id:session('branch_id');
        }
        else
        {
            $branch_id = session('branch_id');
        }

        $from_date          = date('Y-m-d',strtotime($request->from_date));
        $to_date            = date('Y-m-d',strtotime($request->to_date));
        $invoices           = [];
        $paymentreceives    = [];

        if($branch_id == 1){
            $paymentreceives    = PaymentReceives::select(DB::raw('payment_receives.*'))
                                                ->orderBy('pr_number', 'desc')
                                                ->whereBetween('payment_receives.payment_date', [$from_date,$to_date])
                                                ->get()
                                                ->toArray();
        }else{
            $paymentreceives    = PaymentReceives::select(DB::raw('payment_receives.*'))
                                                ->whereBetween('payment_receives.payment_date', [$from_date,$to_date])
                                                ->join('users','users.id','=','payment_receives.created_by')
                                                ->where('branch_id',$branch_id)
                                                ->get()
                                                ->toArray();
        }

        $date       = "payment_date";
        $sort       = new sortBydate();
        $invoice    = Invoice::all();

        try{
            $paymentreceives    = $sort->get('\App\Models\Moneyin\PaymentReceives',$date,'Y-m-d',$paymentreceives);

            return view('paymentreceive::payment_receive.index',compact('paymentreceives','invoice','branchs','branch_id','from_date','to_date'));
        }catch (\Exception $exception){

            return view('paymentreceive::payment_receive.index',compact('paymentreceives','invoice','branchs','branch_id','from_date','to_date'));
        }
    }

    public function createCheck()
    {
        return view('paymentreceive::payment_receive.check');
    }

    public function create()
    {
        $show_all_contact   = OrganizationProfile::first();
        $show_all_contact   = $show_all_contact->show_all_contact;
        $branch_id          = session('branch_id');
        $paid_receives      = Account::where('account_type_id',4)->get()->sortBy('account_name');
        $agents             = Contact::leftjoin('users' , 'users.id', '=', 'contact.created_by')
                                        ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                                                return $query->where('users.branch_id', '=', $branch_id);
                                            })
                                        ->select('contact.*')
                                        ->get()
                                        ->sortBy('display_name');

        return view('paymentreceive::payment_receive.create', compact('paid_receives', 'agents'));
    }

    public function store(Request $request)
    {
        $data       = $request->all();
        $user_id    = Auth::user()->id;
        
        if(isset($data['invoice_id'])){
            foreach($data['invoice_id'] as $key => $tmpInvoice){

                if($data['invoice_amount'][$key] > 0){
                    $data['invoice_amount'][$key] = $data['invoice_amount'][$key];
                }else{
                    $data['invoice_amount'][$key] = 0;
                }

            }
        }

        //generating payment receive number automatically
        $payment_receives = PaymentReceives::all();

        DB::beginTransaction();

        if(count($payment_receives)>0)
        {
            $payment_receive    = PaymentReceives::orderBy('created_at', 'desc')->first();
            $pr_number          = $payment_receive['pr_number'];
            $pr_number          = $pr_number + 1;
        }
        else
        {
            $pr_number = 1;
        }

        $pr_number = str_pad($pr_number, 6, '0', STR_PAD_LEFT);
        //end genereting payment receive number automatically

        $used_amount = 0;
        if(isset($data['invoice_id']))
        {
            for($i = 0; $i < count($data['invoice_id']); $i++)
            {
                if(!$data['invoice_amount'][$i])
                    continue;
                $used_amount = $used_amount + $data['invoice_amount'][$i];

            }
        }

        $excess_amount                     = $data['amount'] + $data['vat_adjust'] + $data['tax_adjust'] + $data['other_adjust'] - $used_amount;

        $payment_receive                   = new PaymentReceives;
        $payment_receive->amount           = $data['amount'];
        // $payment_receive->bp_amount        = $data['bp_amount'];
        $payment_receive->vat_adjustment   = $data['vat_adjust'];
        $payment_receive->tax_adjustment   = $data['tax_adjust'];
        $payment_receive->others_adjustment= $data['other_adjust'];
        $payment_receive->payment_date     = date("Y-m-d", strtotime($data['payment_date']));
        $payment_receive->pr_number        = $pr_number;
        $payment_receive->note             = $data['note'];
        // $payment_receive->payment_mode_id  = $data['payment_mode'];
        $payment_receive->reference        = $data['reference'];
        $payment_receive->excess_payment   = $excess_amount;
        $payment_receive->account_id       = $data['account_id'];
        $payment_receive->customer_id      = $data['customer_id'];
        $payment_receive->created_by       = $user_id;
        $payment_receive->updated_by       = $user_id;

        if($request->hasFile('file1')){

            $file = $request->file('file1');

            if($payment_receive->file_url){

                $delete_path = public_path($payment_receive->file_url);

                if(file_exists($delete_path)){

                    $delete = unlink($delete_path);
                }
            }

            $file_name                  = $file->getClientOriginalName();
            $without_extention          = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention             = $file->getClientOriginalExtension();
            $num                        = rand(1, 500);
            $new_file_name              = "payment-". $payment_receive->pr_number.'.'.$file_extention;
            $success                    = $file->move('uploads/payment', $new_file_name);

            if($success){

                $payment_receive->file_url = 'uploads/payment/' . $new_file_name;
            }else{

                $payment_receive->file_url = null;
            }

        }

        if(isset($data['bank_info']))
        {
            $payment_receive->bank_info = $data['bank_info'];
        }

        if(isset($data['invoice_show']))
        {
            $payment_receive->invoice_show = "on";
        }

        if($payment_receive->save())
        {
            $payment_receive_id  = $payment_receive->id;
        
            $journal_entry                      = new JournalEntry;
            $journal_entry->note                = $data['note'];
            $journal_entry->debit_credit        = 1;
            $journal_entry->amount              = $data['amount'];
            $journal_entry->account_name_id     = $data['account_id'];
            $journal_entry->jurnal_type         = "payment_receive2";
            $journal_entry->payment_receives_id = $payment_receive_id;
            $journal_entry->created_by          = $user_id;
            $journal_entry->updated_by          = $user_id;
            $journal_entry->assign_date         = date("Y-m-d", strtotime($data['payment_date']));
            $journal_entry->contact_id          = $data['customer_id'];
            $journal_entry->save();

            $journal_entry                      = new JournalEntry;
            $journal_entry->note                = $data['note'];
            $journal_entry->debit_credit        = 0;
            $journal_entry->amount              = $data['amount'];
            $journal_entry->account_name_id     = 10;
            $journal_entry->jurnal_type         = "payment_receive2";
            $journal_entry->payment_receives_id = $payment_receive_id;
            $journal_entry->created_by          = $user_id;
            $journal_entry->updated_by          = $user_id;
            $journal_entry->assign_date         = date("Y-m-d", strtotime($data['payment_date']));
            $journal_entry->contact_id          = $data['customer_id'];
            $journal_entry->save();


            if(isset($data['invoice_id']))
            {

                for($i = 0; $i < count($data['invoice_id']); $i++)
                {


                    $invoice                    = Invoice::find($data['invoice_id'][$i]);

                    $invoice->vat_adjustment    = $invoice->vat_adjustment + floatval($data['vat_adjust_des'][$i]);
                    $invoice->tax_adjustment    = $invoice->tax_adjustment + floatval($data['tax_adjust_des'][$i]);
                    $invoice->others_adjustment = $invoice->others_adjustment + floatval($data['other_adjust_des'][$i]);

                    $invoice->due_amount        = $invoice['due_amount']-($data['invoice_amount'][$i]);


                    $invoice->update();

                    $vat_adjustment_data    = !empty($data['vat_adjust_des'][$i]) ? floatval($data['vat_adjust_des'][$i]) : floatval(0);
                    $tax_adjustment_data    = !empty($data['tax_adjust_des'][$i]) ? floatval($data['tax_adjust_des'][$i]) : floatval(0);
                    $other_adjustment_data  = !empty($data['other_adjust_des'][$i]) ? floatval($data['other_adjust_des'][$i]) : floatval(0);

                    if((!empty($data['vat_adjust_des'][$i]) || !empty($data['tax_adjust_des'][$i])))
                    {
                        if((floatval($data['vat_adjust_des'][$i])+floatval($data['tax_adjust_des'][$i]))>0)
                        {
                            $oldjournal     = JournalEntry::where("invoice_id",$data['invoice_id'][$i])->where("jurnal_type","invoice")->where("account_name_id",9)->where("debit_credit",1)->latest()->first();

                            if($oldjournal)
                            {
                                if(($oldjournal->amount + $vat_adjustment_data + $tax_adjustment_data) > 0)
                                {
                                    $oldjournal->amount         = $oldjournal->amount + $vat_adjustment_data + $tax_adjustment_data;
                                    $oldjournal->assign_date    = date("Y-m-d", strtotime($data['payment_date']));
                                    $oldjournal->updated_by     = $user_id;
                                    $oldjournal->save();     
                                }
                            }
                            else
                            {
                                if(($vat_adjustment_data + $tax_adjustment_data) > 0)
                                {
                                    $journal_entry                  = new JournalEntry;
                                    $journal_entry->debit_credit    = 1;
                                    $journal_entry->amount          = $vat_adjustment_data + $tax_adjustment_data;
                                    $journal_entry->account_name_id = 9;
                                    $journal_entry->jurnal_type     = "invoice";
                                    $journal_entry->invoice_id      = $data['invoice_id'][$i];

                                    $journal_entry->created_by      = $user_id;
                                    $journal_entry->updated_by      = $user_id;
                                    $journal_entry->assign_date     = date("Y-m-d", strtotime($data['payment_date']));
                                    $journal_entry->contact_id      = $data['customer_id'];
                                    $journal_entry->note            = $data['note'];
                                    $journal_entry->save();
                                }
                            }

                        }

                    }

                    if(!empty($data['other_adjust_des'][$i]))
                    {
                        if($data['other_adjust_des'][$i]>0)
                        {
                            $oldjournal     = JournalEntry::where("invoice_id",$data['invoice_id'][$i])->where("jurnal_type","invoice")->where("account_name_id",18)->where("debit_credit",1)->latest()->first();

                            if($oldjournal)
                            {
                                if(($oldjournal->amount + $other_adjustment_data) > 0)
                                {
                                    $oldjournal->amount         = $oldjournal->amount + $other_adjustment_data;
                                    $oldjournal->assign_date    = date("Y-m-d", strtotime($data['payment_date']));
                                    $oldjournal->updated_by     = $user_id;
                                    $oldjournal->save();
                                }
                                
                            }else{
                                if($other_adjustment_data > 0)
                                {
                                    $journal_entry                      = new JournalEntry;
                                    $journal_entry->debit_credit        = 1;
                                    $journal_entry->amount              = $other_adjustment_data;
                                    $journal_entry->account_name_id     = 18;
                                    $journal_entry->jurnal_type         = "invoice";
                                    $journal_entry->invoice_id          = $data['invoice_id'][$i];

                                    $journal_entry->created_by          = $user_id;
                                    $journal_entry->updated_by          = $user_id;
                                    $journal_entry->assign_date         = date("Y-m-d", strtotime($data['payment_date']));
                                    $journal_entry->contact_id          = $data['customer_id'];
                                    $journal_entry->note                = $data['note'];
                                    $journal_entry->save();
                                }
                            }

                        }

                    }

                    $oldjournal= JournalEntry::where("invoice_id",$data['invoice_id'][$i])->where("jurnal_type","invoice")->where("account_name_id",5)->where("debit_credit",0)->latest()->first();

                    if($oldjournal){
                        if(($oldjournal->amount + $other_adjustment_data + $vat_adjustment_data + $tax_adjustment_data) > 0){
                            $oldjournal->amount = $oldjournal->amount + $other_adjustment_data + $vat_adjustment_data + $tax_adjustment_data;
                            $oldjournal->assign_date = date("Y-m-d", strtotime($data['payment_date']));
                            $oldjournal->updated_by = $user_id;
                            $oldjournal->save();
                        }
                    }else{
                        if(($other_adjustment_data + $vat_adjustment_data + $tax_adjustment_data) > 0){
                            $journal_entry = new JournalEntry;
                            $journal_entry->debit_credit = 0;
                            $journal_entry->amount  = $other_adjustment_data + $vat_adjustment_data + $tax_adjustment_data;
                            $journal_entry->account_name_id  = 5;
                            $journal_entry->jurnal_type  = "invoice";
                            $journal_entry->invoice_id  = $data['invoice_id'][$i];

                            $journal_entry->created_by = $user_id;
                            $journal_entry->updated_by = $user_id;
                            $journal_entry->assign_date = date("Y-m-d", strtotime($data['payment_date']));
                            $journal_entry->contact_id  = $data['customer_id'];
                            $journal_entry->note = $data['note'];
                            $journal_entry->save();
                        }
                    }


                }
            }


            if(isset($data['invoice_id']))
            {
                for($i = 0; $i < count($data['invoice_id']); $i++)
                {
                    if(!$data['invoice_amount'][$i])
                        continue;
                    $journal_entry = new JournalEntry;
                    $journal_entry->note                = $data['note'];
                    $journal_entry->debit_credit        = 0;
                    $journal_entry->amount              = $data['invoice_amount'][$i];
                    $journal_entry->account_name_id     = 5;
                    $journal_entry->jurnal_type         = "payment_receive1";
                    $journal_entry->payment_receives_id = $payment_receive_id;
                    $journal_entry->invoice_id          = $data['invoice_id'][$i];
                    $journal_entry->created_by          = $user_id;
                    $journal_entry->updated_by          = $user_id;
                    $journal_entry->assign_date          = date("Y-m-d", strtotime($data['payment_date']));
                    $journal_entry->contact_id          = $data['customer_id'];
                    $journal_entry->save();

                    $journal_entry = new JournalEntry;
                    $journal_entry->note                = $data['note'];
                    $journal_entry->debit_credit        = 1;
                    $journal_entry->amount              = $data['invoice_amount'][$i];
                    $journal_entry->account_name_id     = 10;
                    $journal_entry->jurnal_type         = "payment_receive1";
                    $journal_entry->payment_receives_id = $payment_receive_id;
                    $journal_entry->invoice_id          = $data['invoice_id'][$i];
                    $journal_entry->created_by          = $user_id;
                    $journal_entry->updated_by          = $user_id;
                    $journal_entry->assign_date          = date("Y-m-d", strtotime($data['payment_date']));
                    $journal_entry->contact_id          = $data['customer_id'];
                    $journal_entry->save();
                }

                $i = 0;
                $payment_receive_entry = [];

                foreach ($data['invoice_id'] as $bill_id)
                {

                    $vat_adjustment_data        = !empty($data['vat_adjust_des'][$i]) ? floatval($data['vat_adjust_des'][$i]) : floatval(0);
                    $tax_adjustment_data        = !empty($data['tax_adjust_des'][$i]) ? floatval($data['tax_adjust_des'][$i]) : floatval(0);
                    $other_adjustment_data      = !empty($data['other_adjust_des'][$i]) ? floatval($data['other_adjust_des'][$i]) : floatval(0);

                    if(!$data['invoice_amount'][$i] && $vat_adjustment_data == 0 && $tax_adjustment_data == 0 && $other_adjustment_data == 0)
                    {
                        $i++;
                    }
                    else
                    {

                        $payment_receive_entry[] = [
                            'amount'                => isset($data['invoice_amount'][$i])? $data['invoice_amount'][$i] : 0,
                            'vat_adjustment'        => $vat_adjustment_data,
                            'tax_adjustment'        => $tax_adjustment_data,
                            'others_adjustment'     => $other_adjustment_data,
                            'payment_receives_id'   => $payment_receive_id,
                            'invoice_id'            => $data['invoice_id'][$i],
                            'created_by'            => $user_id,
                            'updated_by'            => $user_id,
                            'created_at'            => \Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at'            => \Carbon\Carbon::now()->toDateTimeString(),
                        ];
                        $i++;
                    }
                }

                if(DB::table('payment_receives_entries')->insert($payment_receive_entry))
                {
                    $helper = new \App\Lib\Helpers;
                    //  $helper->updateDueInvoiceAfterPaymentReceive($data);

                    DB::commit();

                    return redirect()
                        ->route('payment_received')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Payment receive added successfully!');
                }
                else
                {
                    DB::rollback();

                    return redirect()
                        ->route('payment_received')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Something went wrong! please check your input field!!!');
                }
            }

            DB::commit();

            return redirect()
                ->route('payment_received')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Payment receive added successfully!');
        }

        DB::rollback();

        return redirect()
            ->route('payment_receive')
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Something went wrong! please check your input field!!!');
    }

    public function show($id)
    {
        //Authintication 
        $auth_branch   =   Session('branch_id');
        $this->getBranchUsers($auth_branch);
        $check         = PaymentReceives::join('users', 'users.id', 'payment_receives.created_by')
                                ->where('payment_receives.id',$id)
                                ->selectRaw('users.branch_id as branch_id')
                                ->first();
        if($auth_branch != 1)
        {
            if($auth_branch != $check->branch_id)
            {  
                return redirect()
                           ->route('payment_received')
                           ->with('alert.status', 'danger')
                           ->with('alert.message', 'You have not enough permissions to access !');
            }
        }
        // end 

        if ($auth_branch == 1)
        {
            $paymentreceives    = PaymentReceives::orderBy('payment_date','desc')->take(10)->get();
        }
        else
        {
            $paymentreceives    = PaymentReceives::orderBy('id','desc')->take(10)->get();
            $paymentreceives    = $paymentreceives->whereIn('created_by', $this->targeted_users);
        }
        
        $paymentreceive         = PaymentReceives::find($id);
        $invoice                = Invoice::orderBy('payment_date','asc')->get();
        $OrganizationProfile    = OrganizationProfile::find(1);

        return view('paymentreceive::payment_receive.show',compact('paymentreceives','invoice', 'paymentreceive','OrganizationProfile'));
    }
    
    public function showupload(Request $request,$id=null)
    {
        $paymentreceive = PaymentReceives::find($id);
        $validator = Validator::make($request->all(),[
            'file1' => 'required|max:10240',
        ]);
        if($validator->fails())
        {
            return response("file size not allowed");
        }
        if($request->hasFile('file1')) {
            $file = $request->file('file1');

            if ($paymentreceive->file_url) {
                $delete_path = public_path($paymentreceive->file_url);
                if(file_exists($delete_path)){
                    $delete = unlink($delete_path);
                }

            }

            $file_name = $file->getClientOriginalName();
            $without_extention = substr($paymentreceive, 0, strrpos($file_name, "."));
            $file_extention = $file->getClientOriginalExtension();
            $num = rand(1, 500);
            $new_file_name = "payment-".$paymentreceive->pr_number.'.'.$file_extention;

            $success = $file->move('uploads/payment', $new_file_name);

            if ($success) {
                $paymentreceive->file_url = 'uploads/payment/' . $new_file_name;
                //$Bank->file_name = $new_file_name;

                $paymentreceive->save();
                return response("success");
            }else{
                return response("success");
            }
        }else{
            return response("file not found");
        }
    }

    public function edit($id)
    {   
        $show_all_contact   = OrganizationProfile::first();
        $show_all_contact   = $show_all_contact->show_all_contact;
        $branch_id          = session('branch_id');

        //Authintication 
        $auth_branch   = Session('branch_id');
        $check         = PaymentReceives::join('users', 'users.id', 'payment_receives.created_by')
                                ->where('payment_receives.id',$id)
                                ->selectRaw('users.branch_id as branch_id')
                                ->first();
        if($auth_branch != 1)
        {
            if($auth_branch != $check->branch_id)
            {  
                return redirect()
                       ->route('payment_received')
                       ->with('alert.status', 'danger')
                       ->with('alert.message', 'You have not enough permissions to access !');
            }
        }
        // end  

        $payment_receive    = PaymentReceives::find($id);
        $customer_id        = $payment_receive->customer_id;
        $invoices           = Invoice::where('customer_id',$customer_id)->get();
        $payment_modes      = PaymentMode::all();
        $deposite           = Account::where('account_type_id',4)->get()->sortBy('account_name');
        $agents             = Contact::leftjoin('users' , 'users.id', '=', 'contact.created_by')
                                        ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                                                return $query->where('users.branch_id', '=', $branch_id);
                                            })
                                        ->select('contact.*')
                                        ->get()
                                        ->sortBy('display_name');

        return view('paymentreceive::payment_receive.edit',compact('invoices','deposite','payment_receive', 'customer_id', 'agents', 'payment_modes'));
    }

    public function update(Request $request, $id)
    {
        //Authintication 
        $auth_branch    =   Session('branch_id');
        $check          = PaymentReceives::join('users', 'users.id', 'payment_receives.created_by')
                                ->where('payment_receives.id',$id)
                                ->selectRaw('users.branch_id as branch_id')
                                ->first();
        if($auth_branch != 1)
        {
            if($auth_branch != $check->branch_id)
            {  
            return redirect()
               ->route('payment-received')
               ->with('alert.status', 'danger')
               ->with('alert.message', 'You have not enough permissions to access !');
            }
        }
        // end 

        $data           = $request->all();
        $user_id        = Auth::user()->id;
        $used_amount    = 0;

        DB::beginTransaction();

        if(isset($data['invoice_id']))
        {
            for($i = 0; $i < count($data['invoice_id']); $i++)
            {
                if(!$data['invoice_amount'][$i])
                    continue;
                $used_amount = $used_amount + $data['invoice_amount'][$i];

            }
        }

        $excess_amount              = $data['amount'] + $data['vat_adjust'] + $data['tax_adjust'] + $data['other_adjust'] - $used_amount;
        $payment_receive_entry      = PaymentReceiveEntryModel::where('payment_receives_id', $id)->get();
        $helper                     = new \App\Lib\Helpers;

        if(isset($request['invoice_id'])){
            $helper->updateDueInvoiceAfterPaymentReceiveEdit($payment_receive_entry, $request);
            $helper->updateDueInvoiceAfterPaymentReceive($data);
            $helper->updateJournalEntriesAdjustmentsAfterPaymentReceiveEdit($payment_receive_entry, $data);
            $helper->updateInvoiceAdjustmentsAfterPaymentReceiveEdit($payment_receive_entry, $data);
        }
        //$helper->updatePaymentReceiveAdjustmentInvoiceAfterPaymentReceiveEdit($data);

        $payment_receive                   = PaymentReceives::find($id);
        $payment_receive->amount           = $data['amount'];
        $payment_receive->note           = $data['note'];
        // $payment_receive->bp_amount        = $data['bp_amount'];
        $payment_receive->vat_adjustment   = $data['vat_adjust'];
        $payment_receive->tax_adjustment   = $data['tax_adjust'];
        $payment_receive->others_adjustment= $data['other_adjust'];
        $payment_receive->payment_date     = date("Y-m-d", strtotime($data['payment_date']));
        // $payment_receive->payment_mode_id  = $data['payment_mode'];
        $payment_receive->reference        = $data['reference'];
        $payment_receive->excess_payment   = $excess_amount;
        $payment_receive->account_id       = $data['account_id'];
        $payment_receive->customer_id      = $data['customer_id'];
        $payment_receive->created_by       = $user_id;
        $payment_receive->updated_by       = $user_id;

        if($request->hasFile('file1')){

            $file                          = $request->file('file1');

            if($payment_receive->file_url){

                $delete_path               = public_path($payment_receive->file_url);

                if(file_exists($delete_path)){

                    $delete                = unlink($delete_path);
                }
            }

            $file_name                     = $file->getClientOriginalName();
            $without_extention             = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention                = $file->getClientOriginalExtension();
            $num                           = rand(1, 500);
            $new_file_name                 = "payment-".$payment_receive->pr_number.'.'.$file_extention;
            $success                       = $file->move('uploads/payment', $new_file_name);

            if($success){

                $payment_receive->file_url = 'uploads/payment/' . $new_file_name;
            }else{

                $payment_receive->file_url = null;
            }
        }

        if(isset($data['bank_info']))
        {
            $payment_receive->bank_info    = $data['bank_info'];
        }

        if(isset($data['invoice_show']))
        {
            $payment_receive->invoice_show = "on";
        }
        else {
            $payment_receive->invoice_show = "";
        }

        if($payment_receive->update())
        {

            if(isset($data['invoice_id']))
            {
                $payment_receive_entry    = PaymentReceives::find($id)->PaymentReceiveEntryData();

                //Update Time

                $created                = PaymentReceives::find($id);

                $created_by             = $created->created_by;
                $created_at             = $created->created_at->toDateTimeString();
                $updated_at             = \Carbon\Carbon::now()->toDateTimeString();

                if($payment_receive_entry->delete())
                {

                }

                $i                      = 0;
                $payment_receive_entry  = [];

                foreach ($data['invoice_id'] as $invoice_id)
                {
                    $vat_adjustment_data        = !empty($data['vat_adjust_des'][$i]) ? floatval($data['vat_adjust_des'][$i]) : floatval(0);
                    $tax_adjustment_data        = !empty($data['tax_adjust_des'][$i]) ? floatval($data['tax_adjust_des'][$i]) : floatval(0);
                    $other_adjustment_data      = !empty($data['other_adjust_des'][$i]) ? floatval($data['other_adjust_des'][$i]) : floatval(0);

                    if(!$data['invoice_amount'][$i] && $vat_adjustment_data == 0 && $tax_adjustment_data == 0 && $other_adjustment_data == 0)
                    {
                        $i++;
                    }
                    else
                    {
                        $payment_receive_entry[]    = [
                            'amount'                => isset($data['invoice_amount'][$i]) ? $data['invoice_amount'][$i] : 0,
                            'vat_adjustment'        => $vat_adjustment_data,
                            'tax_adjustment'        => $tax_adjustment_data,
                            'others_adjustment'     => $other_adjustment_data,
                            'payment_receives_id'   => $id,
                            'invoice_id'            => $data['invoice_id'][$i],
                            'created_by'            => $created_by,
                            'updated_by'            => $user_id,
                            'created_at'            => $created_at,
                            'updated_at'            => $updated_at,
                        ];

                        $i++;
                    }
                }
            }

            //for journal entry transaction...
            $journal_entry  = PaymentReceives::find($id)->JournalEntry();

            //Update Time

            $created        = PaymentReceives::find($id);

            $created_by     = $created->created_by;
            $created_at     = $created->created_at->toDateTimeString();
            $updated_at     = \Carbon\Carbon::now()->toDateTimeString();

            if($journal_entry->delete())
            {

            }
            
            $journal_entry                      = new JournalEntry;
            $journal_entry->note                = $data['note'];
            $journal_entry->debit_credit        = 1;
            $journal_entry->amount              = $data['amount'];
            $journal_entry->account_name_id     = $data['account_id'];
            $journal_entry->jurnal_type         = "payment_receive2";
            $journal_entry->payment_receives_id = $id;
            $journal_entry->contact_id          = $data['customer_id'];
            $journal_entry->created_by          = $created_by;
            $journal_entry->updated_by          = $user_id;
            $journal_entry->created_at          = $created_at;
            $journal_entry->updated_at          = $updated_at;
            $journal_entry->assign_date         = date("Y-m-d", strtotime($data['payment_date']));
            $journal_entry->save();

            $journal_entry                      = new JournalEntry;
            $journal_entry->note                = $data['note'];
            $journal_entry->debit_credit        = 0;
            $journal_entry->amount              = $data['amount'];
            $journal_entry->account_name_id     = 10;
            $journal_entry->jurnal_type         = "payment_receive2";
            $journal_entry->payment_receives_id = $id;
            $journal_entry->contact_id          = $data['customer_id'];
            $journal_entry->created_by          = $created_by;
            $journal_entry->updated_by          = $user_id;
            $journal_entry->created_at          = $created_at;
            $journal_entry->updated_at          = $updated_at;
            $journal_entry->assign_date         = date("Y-m-d", strtotime($data['payment_date']));
            $journal_entry->save();

            if(isset($data['invoice_id']))
            {
                for($i = 0; $i < count($data['invoice_id']); $i++)
                {
                    if($data['invoice_amount'][$i] > 0)
                    {
                        $journal_entry                      = new JournalEntry;
                        $journal_entry->note                = $data['note'];
                        $journal_entry->debit_credit        = 0;
                        $journal_entry->amount              = $data['invoice_amount'][$i];
                        $journal_entry->account_name_id     = 5;
                        $journal_entry->jurnal_type         = "payment_receive1";
                        $journal_entry->payment_receives_id = $id;
                        $journal_entry->contact_id          = $data['customer_id'];
                        $journal_entry->invoice_id          = $data['invoice_id'][$i];
                        $journal_entry->created_by          = $created_by;
                        $journal_entry->updated_by          = $user_id;
                        $journal_entry->created_at          = $created_at;
                        $journal_entry->updated_at          = $updated_at;
                        $journal_entry->assign_date         = date("Y-m-d", strtotime($data['payment_date']));
                        $journal_entry->save();

                        $journal_entry                      = new JournalEntry;
                        $journal_entry->note                = $data['note'];
                        $journal_entry->debit_credit        = 1;
                        $journal_entry->amount              = $data['invoice_amount'][$i];
                        $journal_entry->account_name_id     = 10;
                        $journal_entry->jurnal_type         = "payment_receive1";
                        $journal_entry->payment_receives_id = $id;
                        $journal_entry->contact_id          = $data['customer_id'];
                        $journal_entry->invoice_id          = $data['invoice_id'][$i];
                        $journal_entry->created_by          = $created_by;
                        $journal_entry->updated_by          = $user_id;
                        $journal_entry->created_at          = $created_at;
                        $journal_entry->updated_at          = $updated_at;
                        $journal_entry->assign_date         = date("Y-m-d", strtotime($data['payment_date']));
                        $journal_entry->save();
                    }
                }

                if (DB::table('payment_receives_entries')->insert($payment_receive_entry))
                {
                    DB::commit();

                    return redirect()
                        ->route('payment_received')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Payment receive updated successfully!');
                }
                else
                {
                    DB::rollback();

                    return redirect()
                        ->route('payment_received')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Something went wrong! please check your input field!!!');
                }
            }

            DB::commit();

            return redirect()
                ->route('payment_received')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Payment receive updated successfully!');

            //end journal entry transaction...
        }

        DB::rollback();

        return redirect()
            ->route('payment_received')
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Something went wrong! please check your input field!!!');
    }    

    public function drawCheque($id){
        try{
            
            DB::beginTransaction();

            $payment_receive                    = PaymentReceives::find($id);
        
            $journal_entry                      = new JournalEntry;
            $journal_entry->note                = $payment_receive['note'];
            $journal_entry->debit_credit        = 1;
            $journal_entry->amount              = $payment_receive['amount'];
            $journal_entry->account_name_id     = $payment_receive['account_id'];
            $journal_entry->jurnal_type         = "payment_receive2";
            $journal_entry->payment_receives_id = $payment_receive->id;
            $journal_entry->created_by          = Auth::user()->id;
            $journal_entry->updated_by          = Auth::user()->id;
            $journal_entry->assign_date         = date("Y-m-d", strtotime($payment_receive['payment_date']));
            $journal_entry->contact_id          = $payment_receive['customer_id'];
            $journal_entry->save();
    
            $journal_entry                      = new JournalEntry;
            $journal_entry->note                = $payment_receive['note'];
            $journal_entry->debit_credit        = 0;
            $journal_entry->amount              = $payment_receive['amount'];
            $journal_entry->account_name_id     = 10;
            $journal_entry->jurnal_type         = "payment_receive2";
            $journal_entry->payment_receives_id = $payment_receive->id;
            $journal_entry->created_by          = Auth::user()->id;
            $journal_entry->updated_by          = Auth::user()->id;
            $journal_entry->assign_date         = date("Y-m-d", strtotime($payment_receive['payment_date']));
            $journal_entry->contact_id          = $payment_receive['customer_id'];
            $journal_entry->save();
    
            foreach($payment_receive->PaymentReceiveEntryData as $key => $payment_receive_entry){
    
                $vat_adjustment_data    = !empty($payment_receive_entry['vat_adjustment']) ? floatval($payment_receive_entry['vat_adjustment']) : floatval(0);
                $tax_adjustment_data    = !empty($payment_receive_entry['tax_adjustment']) ? floatval($payment_receive_entry['tax_adjustment']) : floatval(0);
                $other_adjustment_data  = !empty($payment_receive_entry['others_adjustment']) ? floatval($payment_receive_entry['others_adjustment']) : floatval(0);
    
                if((!empty($payment_receive_entry['vat_adjustment']) || !empty($payment_receive_entry['tax_adjustment'])))
                {
                    if((floatval($payment_receive_entry['vat_adjustment'])+floatval($payment_receive_entry['tax_adjustment']))>0)
                    {
                        $oldjournal     = JournalEntry::where("invoice_id",$payment_receive_entry['invoice_id'])->where("jurnal_type","invoice")->where("account_name_id",9)->where("debit_credit",1)->latest()->first();
    
                        if($oldjournal)
                        {
                            if(($oldjournal->amount + $vat_adjustment_data + $tax_adjustment_data) > 0)
                            {
                                $oldjournal->amount         = $oldjournal->amount + $vat_adjustment_data + $tax_adjustment_data;
                                $oldjournal->assign_date    = date("Y-m-d", strtotime($payment_receive['payment_date']));
                                $oldjournal->updated_by     = Auth::user()->id;
                                $oldjournal->save();     
                            }
                        }
                        else
                        {
                            if(($vat_adjustment_data + $tax_adjustment_data) > 0)
                            {
                                $journal_entry                  = new JournalEntry;
                                $journal_entry->debit_credit    = 1;
                                $journal_entry->amount          = $vat_adjustment_data + $tax_adjustment_data;
                                $journal_entry->account_name_id = 9;
                                $journal_entry->jurnal_type     = "invoice";
                                $journal_entry->invoice_id      = $payment_receive_entry['invoice_id'];
    
                                $journal_entry->created_by      = Auth::user()->id;
                                $journal_entry->updated_by      = Auth::user()->id;
                                $journal_entry->assign_date     = date("Y-m-d", strtotime($payment_receive['payment_date']));
                                $journal_entry->contact_id      = $payment_receive['customer_id'];
                                $journal_entry->note            = $payment_receive['note'];
                                $journal_entry->save();
                            }
                        }
    
                    }
    
                }
    
                if(!empty($payment_receive_entry['others_adjustment']))
                {
                    if($payment_receive_entry['others_adjustment']>0)
                    {
                        $oldjournal     = JournalEntry::where("invoice_id",$payment_receive_entry['invoice_id'])->where("jurnal_type","invoice")->where("account_name_id",18)->where("debit_credit",1)->latest()->first();
    
                        if($oldjournal)
                        {
                            if(($oldjournal->amount + $other_adjustment_data) > 0)
                            {
                                $oldjournal->amount         = $oldjournal->amount + $other_adjustment_data;
                                $oldjournal->assign_date    = date("Y-m-d", strtotime($payment_receive['payment_date']));
                                $oldjournal->updated_by     = Auth::user()->id;
                                $oldjournal->save();
                            }
                            
                        }else{
                            if($other_adjustment_data > 0)
                            {
                                $journal_entry                      = new JournalEntry;
                                $journal_entry->debit_credit        = 1;
                                $journal_entry->amount              = $other_adjustment_data;
                                $journal_entry->account_name_id     = 18;
                                $journal_entry->jurnal_type         = "invoice";
                                $journal_entry->invoice_id          = $payment_receive_entry['invoice_id'];
    
                                $journal_entry->created_by          = Auth::user()->id;
                                $journal_entry->updated_by          = Auth::user()->id;
                                $journal_entry->assign_date         = date("Y-m-d", strtotime($payment_receive['payment_date']));
                                $journal_entry->contact_id          = $payment_receive['customer_id'];
                                $journal_entry->note                = $payment_receive['note'];
                                $journal_entry->save();
                            }
                        }
    
                    }
    
                }
    
                $oldjournal= JournalEntry::where("invoice_id",$payment_receive_entry['invoice_id'])->where("jurnal_type","invoice")->where("account_name_id",5)->where("debit_credit",0)->latest()->first();
    
                if($oldjournal){
                    if(($oldjournal->amount + $other_adjustment_data + $vat_adjustment_data + $tax_adjustment_data) > 0){
                        $oldjournal->amount = $oldjournal->amount + $other_adjustment_data + $vat_adjustment_data + $tax_adjustment_data;
                        $oldjournal->assign_date = date("Y-m-d", strtotime($payment_receive['payment_date']));
                        $oldjournal->updated_by = Auth::user()->id;
                        $oldjournal->save();
                    }
                }else{
                    if(($other_adjustment_data + $vat_adjustment_data + $tax_adjustment_data) > 0){
                        $journal_entry = new JournalEntry;
                        $journal_entry->debit_credit = 0;
                        $journal_entry->amount  = $other_adjustment_data + $vat_adjustment_data + $tax_adjustment_data;
                        $journal_entry->account_name_id  = 5;
                        $journal_entry->jurnal_type  = "invoice";
                        $journal_entry->invoice_id  = $payment_receive_entry['invoice_id'];
    
                        $journal_entry->created_by = Auth::user()->id;
                        $journal_entry->updated_by = Auth::user()->id;
                        $journal_entry->assign_date = date("Y-m-d", strtotime($payment_receive['payment_date']));
                        $journal_entry->contact_id  = $payment_receive['customer_id'];
                        $journal_entry->note = $payment_receive['note'];
                        $journal_entry->save();
                    }
                }
    
    
            }
    
    
            foreach($payment_receive->PaymentReceiveEntryData as $key => $payment_receive_entry){
                if($payment_receive_entry['amount'] == 0)
                    continue;
                $journal_entry = new JournalEntry;
                $journal_entry->note                = $payment_receive['note'];
                $journal_entry->debit_credit        = 0;
                $journal_entry->amount              = $payment_receive_entry['amount'];
                $journal_entry->account_name_id     = 5;
                $journal_entry->jurnal_type         = "payment_receive1";
                $journal_entry->payment_receives_id = $payment_receive->id;
                $journal_entry->invoice_id          = $payment_receive_entry['invoice_id'];
                $journal_entry->created_by          = Auth::user()->id;
                $journal_entry->updated_by          = Auth::user()->id;
                $journal_entry->assign_date          = date("Y-m-d", strtotime($payment_receive['payment_date']));
                $journal_entry->contact_id          = $payment_receive['customer_id'];
                $journal_entry->save();
    
                $journal_entry = new JournalEntry;
                $journal_entry->note                = $payment_receive['note'];
                $journal_entry->debit_credit        = 1;
                $journal_entry->amount              = $payment_receive_entry['amount'];
                $journal_entry->account_name_id     = 10;
                $journal_entry->jurnal_type         = "payment_receive1";
                $journal_entry->payment_receives_id = $payment_receive->id;
                $journal_entry->invoice_id          = $payment_receive_entry['invoice_id'];
                $journal_entry->created_by          = Auth::user()->id;
                $journal_entry->updated_by          = Auth::user()->id;
                $journal_entry->assign_date          = date("Y-m-d", strtotime($payment_receive['payment_date']));
                $journal_entry->contact_id          = $payment_receive['customer_id'];
                $journal_entry->save();
            }

            $payment_receive->cheque_status = 'drawn';
            $payment_receive->update();
    
            DB::commit();
    
            return redirect()
                ->back()
                ->with('alert.status', 'success')
                ->with('alert.message', 'Cheque Draw added successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something went wrong! please refresh the page and try again!!!');
        }
    }

    public function download($id)
    {
        $data = PaymentReceives::find($id);
        $download_url = $data->file_url;
        $download_link = public_path($download_url);
        return response()->download($download_link);
    }

    public function destroy($id)
    { 
        //Authintication 
        $auth_branch   =   Session('branch_id');

        DB::beginTransaction();

        $check         = PaymentReceives::join('users', 'users.id', 'payment_receives.created_by')
                            ->where('payment_receives.id',$id)
                            ->selectRaw('users.branch_id as branch_id')
                            ->first();

        if($auth_branch != 1)
        {
            if($auth_branch != $check->branch_id)
            {  
            return redirect()
               ->route('payment_received')
               ->with('alert.status', 'danger')
               ->with('alert.message', 'You have not enough permissions to access !');
            }
        }
        // end 

        $pr_entries                 = PaymentReceiveEntryModel::where('payment_receives_id', $id)->get();
        
        //return $pr_entries;
        foreach ($pr_entries as $pr_entry)
        {
            $vat_adjustment             = isset($pr_entry['vat_adjustment']) ? $pr_entry['vat_adjustment'] : 0;
            $tax_adjustment             = isset($pr_entry['tax_adjustment']) ? $pr_entry['tax_adjustment'] : 0;
            $others_adjustment          = isset($pr_entry['others_adjustment']) ? $pr_entry['others_adjustment'] : 0;

            $invoice                    = Invoice::find($pr_entry['invoice_id']);
            $invoice->due_amount        = $invoice['due_amount'] + $pr_entry['amount'] + $vat_adjustment + $tax_adjustment + $others_adjustment ;
            $invoice->vat_adjustment    = $invoice['vat_adjustment'] - $vat_adjustment;
            $invoice->tax_adjustment    = $invoice['tax_adjustment'] - $tax_adjustment;
            $invoice->others_adjustment = $invoice['others_adjustment'] - $others_adjustment;

            $invoice->update();

            //vat, tax journal entry minus
            $oldjournal1 = JournalEntry::where("invoice_id", $pr_entry['invoice_id'])->where("jurnal_type", "invoice")->where("account_name_id", 9)->where("debit_credit", 1)->latest()->first();

            if($oldjournal1)
            {
                $oldjournal1->amount = $oldjournal1->amount - $vat_adjustment - $tax_adjustment;
                $oldjournal1->update();
            }

            //other adjustment journal entry minus
            $oldjournal2 = JournalEntry::where("invoice_id", $pr_entry['invoice_id'])->where("jurnal_type", "invoice")->where("account_name_id", 18)->where("debit_credit", 1)->latest()->first();

            if($oldjournal2)
            {
                $oldjournal2->amount = $oldjournal2->amount - $others_adjustment;
                $oldjournal2->update();
            }

            //account receivable journal entry minus
            $oldjournal3 = JournalEntry::where("invoice_id", $pr_entry['invoice_id'])->where("jurnal_type", "invoice")->where("account_name_id", 5)->where("debit_credit", 0)->latest()->first();

            if($oldjournal3)
            {
                $oldjournal3->amount = $oldjournal3->amount - $others_adjustment - $vat_adjustment - $tax_adjustment;
                $oldjournal3->update();
            }
        }

        $PaymentReceive             = PaymentReceives::find($id);

        if($PaymentReceive->file_url)
        {
            $delete_path            = public_path($PaymentReceive->file_url);

            if(file_exists($delete_path))
            {
                $delete             = unlink($delete_path);
            }
        }

        if($PaymentReceive->delete())
        {
            if($PaymentReceive->file_url){

                $delete_path        = public_path($PaymentReceive->file_url);

                if(file_exists($delete_path))
                {
                    $delete         = unlink($delete_path);
                }
            }

            DB::commit();

            return redirect()
                ->route('payment_received')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Payment Receive Deleted Successfully!');
        }

        DB::rollback();
    }

    public function deletePaymentReceiveEntry($id)
    {
        $payment_receive_id = PaymentReceiveEntryModel::find($id)->payment_receives_id;

        $amount = PaymentReceiveEntryModel::find($id)->amount;
        $invoice_id = PaymentReceiveEntryModel::find($id)->invoice_id;

        $this->updateDueAmountInInvoiceAfterPaymentReceiveEntryDeleteFromInvoice($invoice_id, $amount);

        $payment_receive = PaymentReceives::find($payment_receive_id);
        $payment_receive->excess_payment = $payment_receive['excess_payment'] + $amount;
        if($payment_receive->update())
        {
            $payment_receive_entry = PaymentReceiveEntryModel::find($id);
            if($payment_receive_entry->delete())
            {
                JournalEntry::where('jurnal_type', 'payment_receive1')
                    ->where('payment_receives_id', $payment_receive_id)
                    ->where('invoice_id', $invoice_id)
                    ->delete();
                return redirect()
                    ->route('invoice_show', ['id' => $invoice_id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Payment Receive Entry Deleted');
            }
        }

        return redirect()
            ->route('invoice_show', ['id' => $invoice_id])
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Something went to wrong');
    }

    public function updateDueAmountInInvoiceAfterPaymentReceiveEntryDeleteFromInvoice($invoice_id, $amount)
    {
        $invoice = Invoice::find($invoice_id);
        $invoice->due_amount = $invoice['due_amount'] + $amount;
        $invoice->update();
    }

    public function autosuggest()
    {
        $recruit = Recruitorder::where('status' , 1)->get();

        return Response::json($recruit);
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

        }else{

            $tmp_targeted_users = [];

        }

        $this->targeted_users = $tmp_targeted_users;
    }
}
