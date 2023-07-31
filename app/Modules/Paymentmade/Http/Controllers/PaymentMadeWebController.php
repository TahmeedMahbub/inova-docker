<?php

namespace App\Modules\Paymentmade\Http\Controllers;

use App\Lib\sortBydate;
use App\Models\Branch\Branch;
use Validator;
use App\Models\ManualJournal\JournalEntry;
use App\Models\MoneyOut\Bill;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Models\PaymentMode\PaymentMode;
use App\Models\AccountChart\Account;
use App\Models\MoneyOut\PaymentMade;
use App\Models\MoneyOut\PaymentMadeEntry;
use DB;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\User;
use Carbon\Carbon;
use DateTime;

class PaymentMadeWebController extends Controller
{
    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];

    public function index()
    {
        $payment_mades  = [];
        $auth_id        = Auth::id();
        $branch_id      = session('branch_id');
        $branchs        = Branch::orderBy('id','asc')->get();
        $sort           = new sortBydate();

        $current_time   = Carbon::now()->toDayDateTimeString();
        $from_date      = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $to_date        = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');

        if($branch_id == 1)
        {
            $payment_mades  = PaymentMade::orderBy('id','desc')
                                         ->whereBetween('payment_made.payment_date', [$from_date,$to_date])
                                         ->get()
                                         ->toArray();

            $date   = "payment_date";

            try{
                $payment_mades  = $sort->get('\App\Models\MoneyOut\PaymentMade',$date,'Y-m-d',$payment_mades);

                return view('paymentmade::payment_made.index', compact('payment_mades','branchs'));
            }catch(\Exception $exception){

                return view('paymentmade::payment_made.index', compact('payment_mades','branchs'));
            }
        }
        else
        {
            $payment_mades  = PaymentMade::select(DB::raw('payment_made.*'))
                                         ->orderBy('id','desc')
                                         ->whereBetween('payment_made.payment_date', [$from_date,$to_date])
                                         ->join('users','users.id','=','payment_made.created_by')
                                         ->where('users.branch_id',$branch_id)
                                         ->get()
                                         ->toArray();


            $date = "payment_date";

            try{
                $payment_mades = $sort->get('\App\Models\MoneyOut\PaymentMade',$date,'Y-m-d',$payment_mades);

                return view('paymentmade::payment_made.index', compact('payment_mades','branchs'));
            }catch(\Exception $exception){

                return view('paymentmade::payment_made.index', compact('payment_mades','branchs'));
            }
        }

    }

    public function search(Request $request)
    {
        $branchs            = Branch::orderBy('id','asc')->get();
        $branch_id          = $request->branch_id;
        $from_date          = date('Y-m-d',strtotime($request->from_date));
        $to_date            = date('Y-m-d',strtotime($request->to_date));

        $date   = "payment_date";
        $sort   = new sortBydate();

        if(session('branch_id') == 1)
        {
            $branch_id =  $request->branch_id?$request->branch_id:session('branch_id');
        }
        else
        {
            $branch_id = session('branch_id');
        }

        $payment_mades = PaymentMade::select(DB::raw('payment_made.*'))->orderBy('payment_date','desc')
                                      ->whereBetween('payment_made.payment_date', [$from_date,$to_date])
                                      ->join('users','users.id','=','payment_made.created_by')
                                      ->where('branch_id',$branch_id)
                                      ->get()
                                      ->toArray();

        try{
            $payment_mades= $sort->get('\App\Models\MoneyOut\PaymentMade',$date,'d-m-Y',$payment_mades);

            return view('paymentmade::payment_made.index', compact('payment_mades','branchs','branch_id','from_date','to_date'));
         }catch(\Exception $exception){
            return view('paymentmade::payment_made.index', compact('payment_mades','branchs','branch_id','from_date','to_date'));
        }

    }

    public function create()
    {
        $payment_modes = PaymentMode::all();
        $paid_throughs = Account::where('account_type_id', 4)->orwhere('account_type_id', 5)->get();
        return view('paymentmade::payment_made.create', compact('payment_modes','paid_throughs'));
    }

    public function store(Request $request)
    {
        $data       = $request->all();
        $user_id    = Auth::user()->id;
        $branch_id  = Auth::user()->branch_id;

        if($request->account_id == 3)
        {
            $cash_in_hand   = DB::table('journal_entries')->join('account', 'journal_entries.account_name_id', '=', 'account.id')->join('users', 'journal_entries.created_by', '=', 'users.id')
                                                            ->where('journal_entries.debit_credit',0)->where('account.account_type_id',4)
                                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                    return $query->where('users.branch_id', $branch_id);
                                                                })
                                                            ->sum('journal_entries.amount');

            $total_minus    = DB::table('journal_entries')->join('account', 'journal_entries.account_name_id', '=', 'account.id')->join('users', 'journal_entries.created_by', '=', 'users.id')
                                                            ->where('journal_entries.debit_credit',1)->where('account.account_type_id',4)
                                                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                    return $query->where('users.branch_id', $branch_id);
                                                                })
                                                            ->sum('journal_entries.amount');

            $remaining_amount = $total_minus - $cash_in_hand;
        }
        else
        {
            $current_time   = Carbon::now()->toDayDateTimeString();

            $st_month       = Carbon::now()->startOfMonth();    
            $en_month       = Carbon::now()->endOfMonth();

            $start_date     = (new DateTime($current_time))->modify($st_month)->format('Y-m-d');
            $end_time       = (new DateTime($current_time))->modify($en_month)->format('Y-m-d');

            $bank       = JournalEntry::join('account','journal_entries.account_name_id','=','account.id')
                        ->join('users', 'users.id', 'journal_entries.created_by')
                        ->where('account.account_type_id', 5)
                        ->where('journal_entries.account_name_id', $data['account_id'])
                        ->when($branch_id != 1, function ($query) use ($branch_id) {
                            return $query->where('users.branch_id', $branch_id);
                        })
                        ->get()
                        ->sortBy('assign_date');

            $bank_debit        = $bank->where('debit_credit',1)
                ->where('assign_date', '>=', $start_date)
                ->where('assign_date', '<=', $end_time)
                ->sum('amount');

            $bank_credit       = $bank->where('debit_credit',0)
                ->where('assign_date', '>=', $start_date)
                ->where('assign_date', '<=', $end_time)
                ->sum('amount');

            $remaining_amount  = $bank_debit - $bank_credit;

        }

        if($request->account_id == 3 && $remaining_amount - $data['amount'] <= 0)
        {
            return redirect()
                ->route('payment_made')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'You don\'t have enough cash!');
        }
        else if($request->account_id != 3 && $remaining_amount - $data['amount'] <= 0)
        {
            return redirect()
                ->route('payment_made')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'You don\'t have enough amount in your bank!');
        }

        //generating payment made number automatically
        $payment_mades = PaymentMade::all();
        if(count($payment_mades)>0)
        {
            $payment_made   = PaymentMade::orderBy('created_at', 'desc')->first();
            $pm_number      = $payment_made['pm_number'];
            $pm_number      = $pm_number + 1;
        }
        else
        {
            $pm_number = 1;
        }

        $pm_number = str_pad($pm_number, 6, '0', STR_PAD_LEFT);
        //end genereting payment made number automatically

        $used_amount = 0;
        if(isset($data['bill_id']))
        {
            for($i = 0; $i < count($data['bill_id']); $i++)
            {
                if(!$data['bill_amount'][$i])
                    continue;
                $used_amount = $used_amount + $data['bill_amount'][$i];

            }
        }

        $excess_amount = $data['amount'] - $used_amount;
        $payment_made = new PaymentMade;
        $payment_made->amount           = $data['amount'];
        $payment_made->payment_date     = date("Y-m-d" ,strtotime($data['payment_date']));
        $payment_made->pm_number        = $pm_number;
        // $payment_made->payment_mode_id  = $data['payment_mode'];
        $payment_made->reference        = $data['reference'];
        $payment_made->cheque_number    = !empty($data['cheque_number']) ? $data['cheque_number'] : null;
        $payment_made->cheque_issue_date= !empty($data['cheque_number']) ? date("Y-m-d", strtotime($data['issue_date'])) : null;
        $payment_made->customer_note    = $data['note'];
        $payment_made->excess_amount    = $excess_amount;
        $payment_made->account_id       = $data['account_id'];
        $payment_made->vendor_id        = $data['vendor_id'];
        $payment_made->created_by       = $user_id;
        $payment_made->updated_by       = $user_id;

        if($request->hasFile('file1'))
        {
            $file               = $request->file('file1');
            $file_name          = $file->getClientOriginalName();
            $without_extention  = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention     = $file->getClientOriginalExtension();
            $num                = rand(1,500);
            $new_file_name      = $without_extention.$pm_number.'.'.$file_extention;
            $success            = $file->move('uploads/paymentmade',$new_file_name);

            if($success)
            {
                $payment_made->file_url = 'uploads/paymentmade/'.$new_file_name;
            }
        }

        if(isset($data['bank_info']))
        {
            $payment_made->bank_info = $data['bank_info'];
        }

        if(isset($data['invoice_show']))
        {
            $payment_made->invoice_show = "on";
        }

        if($payment_made->save())
        {
            $payment_made     = PaymentMade::orderBy('created_at', 'desc')->first();
            $payment_made_id  = $payment_made['id'];

            $journal_entry = new JournalEntry;
            $journal_entry->note            = $data['note'];
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = $data['amount'];
            $journal_entry->account_name_id = $data['account_id'];
            $journal_entry->jurnal_type     = "payment_made2";
            $journal_entry->payment_made_id = $payment_made_id;
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($data['payment_date']));
            $journal_entry->contact_id      = $data['vendor_id'];
            $journal_entry->save();

            $journal_entry = new JournalEntry;
            $journal_entry->note            = $data['note'];
            $journal_entry->debit_credit    = 1;
            $journal_entry->amount          = $data['amount'];
            $journal_entry->account_name_id = 27;
            $journal_entry->jurnal_type     = "payment_made2";
            $journal_entry->payment_made_id = $payment_made_id;
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($data['payment_date']));
            $journal_entry->contact_id      = $data['vendor_id'];
            $journal_entry->save();


            if(isset($data['bill_id']))
            {
                for($i = 0; $i < count($data['bill_id']); $i++)
                {
                    if(!$data['bill_amount'][$i])
                        continue;
                    $journal_entry = new JournalEntry;
                    $journal_entry->note            = $data['note'];
                    $journal_entry->debit_credit    = 1;
                    $journal_entry->amount          = $data['bill_amount'][$i];
                    $journal_entry->account_name_id = 11;
                    $journal_entry->jurnal_type     = "payment_made1";
                    $journal_entry->payment_made_id = $payment_made_id;
                    $journal_entry->bill_id         = $data['bill_id'][$i];
                    $journal_entry->created_by      = $user_id;
                    $journal_entry->updated_by      = $user_id;
                    $journal_entry->assign_date      = date('Y-m-d',strtotime($data['payment_date']));
                    $journal_entry->contact_id      = $data['vendor_id'];
                    $journal_entry->save();

                    $journal_entry = new JournalEntry;
                    $journal_entry->note            = $data['note'];
                    $journal_entry->debit_credit    = 0;
                    $journal_entry->amount          = $data['bill_amount'][$i];
                    $journal_entry->account_name_id = 27;
                    $journal_entry->jurnal_type     = "payment_made1";
                    $journal_entry->payment_made_id = $payment_made_id;
                    $journal_entry->bill_id         = $data['bill_id'][$i];
                    $journal_entry->created_by      = $user_id;
                    $journal_entry->updated_by      = $user_id;
                    $journal_entry->assign_date      = date('Y-m-d',strtotime($data['payment_date']));
                    $journal_entry->contact_id      = $data['vendor_id'];
                    $journal_entry->save();
                }

                $i = 0;
                $payment_made_entry = [];
                foreach ($data['bill_id'] as $bill_id)
                {
                    if(!$data['bill_amount'][$i])
                    {
                        $i++;
                    }
                    else
                    {

                        $payment_made_entry[] = [
                            'amount'            => $data['bill_amount'][$i],
                            'payment_made_id'   => $payment_made_id,
                            'bill_id'           => $data['bill_id'][$i],
                            'created_by'        => $user_id,
                            'updated_by'        => $user_id,
                            'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        ];
                        $i++;
                    }
                }

                if (DB::table('payment_made_entry')->insert($payment_made_entry))
                {
                    $helper = new \App\Lib\Helpers;
                    $helper->updateDueBiilAfterPaymentMade($data);

                    return redirect()
                        ->route('payment_made')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Payment made added successfully!');
                }
                else
                {
                    $payment_made = PaymentMade::find($payment_made_id);
                    $payment_made->delete();

                    return redirect()
                        ->route('payment_made')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Something went to wrong! please check your input field!!!');
                }
            }

            return redirect()
                ->route('payment_made')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Payment made added successfully!');
        }

        return redirect()
            ->route('payment_made')
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Something went to wrong! please check your input field!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment_made  = PaymentMade::find($id);
        $branch_d      = session('branch_id');
        $this->getBranchUsers($branch_d);
        if($branch_d == 1)
          $payment_mades = PaymentMade::orderBy('payment_date','desc')->take(10)->get()->toArray();
        else
          $payment_mades = PaymentMade::orderBy('payment_date','desc')->whereIn('created_by', $this->targeted_users)->take(10)->get()->toArray();
        $date="payment_date";
        $sort= new sortBydate();
        $payment_mades= $sort->get('\App\Models\MoneyOut\PaymentMade',$date,'Y-m-d',$payment_mades);
        $payment_made_entries   = PaymentMadeEntry::where('payment_made_id', $id)
                                ->join('bill_entry', 'bill_entry.bill_id', '=', 'payment_made_entry.bill_id')
                                ->join('item', 'bill_entry.item_id', '=', 'item.id')
                                ->orderBy('payment_made_entry.created_at','desc')->get();
        $OrganizationProfile = OrganizationProfile::find(1);
        return view('paymentmade::payment_made.show',compact('OrganizationProfile','payment_made','payment_mades','payment_made_entries'));
    }

    public function showupload(Request $request,$id=null)
    {
         //ajax upload

               $pm = PaymentMade::find($id);
                $validator = Validator::make($request->all(),[
                    'file1' => 'required|max:10240',
                ]);
                if($validator->fails())
                {
                    return response("file size not allowed");
                }
           if($request->hasFile('file1'))
           {
                 $file = $request->file('file1');
                 if($pm->file_url)
                 {
                     $delete_path = public_path($pm->file_url);
                     if(file_exists($delete_path))
                     {
                      unlink($delete_path);
                     }

                 }

                 $file_name = $file->getClientOriginalName();
                 $without_extention = substr($pm, 0, strrpos($file_name, "."));
                 $file_extention = $file->getClientOriginalExtension();
                 $num = rand(1, 500);
                 $new_file_name = "paymentmade-" . $pm->pm_number . '.' . $file_extention;
                 $success = $file->move('uploads/paymentmade', $new_file_name);
                 if($success)
                 {
                     $pm->file_url = 'uploads/paymentmade/' . $new_file_name;
                   //$Bank->file_name = $new_file_name;
                     $pm->save();
                     return response("success");
                 }
                 else
                 {
                     return response("success");
                 }
             }
             else
             {
                 return response("file not found");
             }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment_modes = PaymentMode::all();
        $paid_throughs = Account::where('account_type_id', 4)->orwhere('account_type_id', 5)->get();
        $payment_made = PaymentMade::find($id);
        return view('paymentmade::payment_made.edit', compact('payment_modes','paid_throughs','payment_made'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data       = $request->all();
        $user_id    = Auth::user()->id;
        $branch_id  = Auth::user()->branch_id;

        $cash_in_hand   = DB::table('journal_entries')->join('account', 'journal_entries.account_name_id', '=', 'account.id')->join('users', 'journal_entries.created_by', '=', 'users.id')
                                                                ->where('journal_entries.debit_credit',0)->where('account.account_type_id',4)
                                                                ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                        return $query->where('users.branch_id', $branch_id);
                                                                    })
                                                                ->sum('journal_entries.amount');

        $total_minus    = DB::table('journal_entries')->join('account', 'journal_entries.account_name_id', '=', 'account.id')->join('users', 'journal_entries.created_by', '=', 'users.id')
                                                                ->where('journal_entries.debit_credit',1)->where('account.account_type_id',4)
                                                                ->when($branch_id != 1, function ($query) use ($branch_id) {
                                                                        return $query->where('users.branch_id', $branch_id);
                                                                    })
                                                                ->sum('journal_entries.amount');

        $cash_in_hand   = $total_minus - $cash_in_hand;

        if($cash_in_hand - $data['amount'] <= 0 && $request->account_id == 3)
        {
            return redirect()
                ->route('payment_made')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'You don\'t have enough cash!');
        }

        $used_amount = 0;
        if(isset($data['bill_id']))
        {
            for($i = 0; $i < count($data['bill_id']); $i++)
            {
                if(!$data['bill_amount'][$i])
                    continue;
                $used_amount = $used_amount + $data['bill_amount'][$i];

            }
        }

        $excess_amount                  = $data['amount'] - $used_amount;
        $payment_made_entry             = PaymentMadeEntry::where('payment_made_id',$id)->get();
        $helper                         = new \App\Lib\Helpers;

        $helper->updateDueBiilAfterPaymentMadeEdit($payment_made_entry);

        $payment_made                   = PaymentMade::find($id);
        $payment_made->amount           = $data['amount'];
        $payment_made->customer_note    = $data['note'];
        $payment_made->payment_date     = date("Y-m-d" ,strtotime($data['payment_date']));
        $payment_made->cheque_number    = !empty($data['cheque_number']) ? $data['cheque_number'] : null;
        $payment_made->cheque_issue_date= !empty($data['cheque_number']) ? date("Y-m-d", strtotime($data['issue_date'])) : null;
        // $payment_made->payment_mode_id  = $data['payment_mode'];
        $payment_made->reference        = $data['reference'];
        $payment_made->excess_amount    = $excess_amount;
        $payment_made->account_id       = $data['account_id'];
        //$payment_made->vendor_id        = $data['vendor_id'];
        $payment_made->created_by       = $user_id;
        $payment_made->updated_by       = $user_id;

        if($request->hasFile('file1'))
        {
            $file                   = $request->file('file1');
            $file_name              = $file->getClientOriginalName();
            $without_extention      = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention         = $file->getClientOriginalExtension();
            $num                    = rand(1,500);
            $new_file_name          = $without_extention.$payment_made->pm_number.'.'.$file_extention;
            $success                = $file->move('uploads/paymentmade',$new_file_name);

            if($success)
            {
                $payment_made->file_url = 'uploads/paymentmade/'.$new_file_name;
            }
        }

        if(isset($data['bank_info']))
        {
            $payment_made->bank_info = $data['bank_info'];
        }

        if(isset($data['invoice_show']))
        {
            $payment_made->invoice_show = "on";
        }
        else
        {
            $payment_made->invoice_show = "";
        }

        if($payment_made->update())
        {

            if(isset($data['bill_id']))
            {
                $payment_made_entry = PaymentMade::find($id)->paymentMadeEntries();
                if($payment_made_entry->delete())
                {

                }

                $i = 0;
                $payment_made_entry = [];
                foreach ($data['bill_id'] as $bill_id)
                {
                    if($data['bill_amount'][$i] > 0)
                    {
                        $payment_made_entry[] = [
                            'amount'            => $data['bill_amount'][$i],
                            'payment_made_id'   => $id,
                            'bill_id'           => $data['bill_id'][$i],
                            'created_by'        => $user_id,
                            'updated_by'        => $user_id,
                            'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        ];
                        $i++;
                    }
                    else
                    {
                        $i++;
                    }
                }
            }

            //for journal entry transaction...
            $journal_entry = PaymentMade::find($id)->JournalEntry();

            //Update Time

            $created = PaymentMade::find($id);

            $created_by = $created->created_by;
            $created_at = $created->created_at->toDateTimeString();
            $updated_at = \Carbon\Carbon::now()->toDateTimeString();

            if($journal_entry->delete())
            {

            }
            $journal_entry = new JournalEntry;
            $journal_entry->note            = $data['note'];
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = $data['amount'];
            $journal_entry->account_name_id = $data['account_id'];
            $journal_entry->jurnal_type     = "payment_made2";
            $journal_entry->payment_made_id = $id;
            $journal_entry->contact_id      = $data['vendor_id'];
            $journal_entry->created_by      = $created_by;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->created_at      = $created_at;
            $journal_entry->updated_at      = $updated_at;
            $journal_entry->assign_date     = date('Y-m-d',strtotime($data['payment_date']));
            $journal_entry->save();

            $journal_entry = new JournalEntry;
            $journal_entry->note            = $data['note'];
            $journal_entry->debit_credit    = 1;
            $journal_entry->amount          = $data['amount'];
            $journal_entry->account_name_id = 27;
            $journal_entry->jurnal_type     = "payment_made2";
            $journal_entry->payment_made_id = $id;
            $journal_entry->contact_id      = $data['vendor_id'];
            $journal_entry->created_by      = $created_by;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->created_at      = $created_at;
            $journal_entry->updated_at      = $updated_at;
            $journal_entry->assign_date     = date('Y-m-d',strtotime($data['payment_date']));
            $journal_entry->save();

            if(isset($data['bill_id']))
            {
                for($i = 0; $i < count($data['bill_id']); $i++)
                {
                    if($data['bill_amount'][$i]>0)
                    {
                        $journal_entry = new JournalEntry;
                        $journal_entry->note            = $data['note'];
                        $journal_entry->debit_credit    = 1;
                        $journal_entry->amount          = $data['bill_amount'][$i];
                        $journal_entry->account_name_id = 11;
                        $journal_entry->jurnal_type     = "payment_made1";
                        $journal_entry->payment_made_id = $id;
                        $journal_entry->bill_id         = $data['bill_id'][$i];
                        $journal_entry->contact_id      = $data['vendor_id'];
                        $journal_entry->created_by      = $created_by;
                        $journal_entry->updated_by      = $user_id;
                        $journal_entry->created_at      = $created_at;
                        $journal_entry->updated_at      = $updated_at;
                        $journal_entry->assign_date      = date('Y-m-d',strtotime($data['payment_date']));
                        $journal_entry->save();

                        $journal_entry = new JournalEntry;
                        $journal_entry->note            = $data['note'];
                        $journal_entry->debit_credit    = 0;
                        $journal_entry->amount          = $data['bill_amount'][$i];
                        $journal_entry->account_name_id = 27;
                        $journal_entry->jurnal_type     = "payment_made1";
                        $journal_entry->payment_made_id = $id;
                        $journal_entry->bill_id         = $data['bill_id'][$i];
                        $journal_entry->contact_id      = $data['vendor_id'];
                        $journal_entry->created_by      = $created_by;
                        $journal_entry->updated_by      = $user_id;
                        $journal_entry->created_at      = $created_at;
                        $journal_entry->updated_at      = $updated_at;
                        $journal_entry->assign_date      = date('Y-m-d',strtotime($data['payment_date']));
                        $journal_entry->save();
                    }
                }

                if (DB::table('payment_made_entry')->insert($payment_made_entry))
                {
                    $helper = new \App\Lib\Helpers;
                    $helper->updateDueBiilAfterPaymentMade($data);

                    return redirect()
                        ->route('payment_made')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Payment made updated successfully!');
                }
                else
                {

                    return redirect()
                        ->route('payment_made')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Something went to wrong! please check your input field!!!');
                }
            }

            return redirect()
                ->route('payment_made')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Payment made updated successfully!');

            //end journal entry transaction...
        }

        return redirect()
            ->route('payment_made')
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Something went to wrong! please check your input field!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pm_entries = PaymentMadeEntry::where('payment_made_id', $id)->get();
        //return $pr_entries;
        foreach ($pm_entries as $pm_entry)
        {
            $bill = Bill::find($pm_entry['bill_id']);
            $bill->due_amount = $bill['due_amount'] + $pm_entry['amount'];
            $bill->update();
        }

        $payment_made = PaymentMade::find($id);
        if($payment_made->delete())
        {

            if($payment_made->file_url)
            {
                $delete_path = public_path($payment_made->file_url);
                if(file_exists($delete_path))
                {
                    unlink($delete_path);
                }

            }

            return redirect()
                ->route('payment_made')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Payment Made Delete successfully!');
        }
    }

    public function chequeDrawn($id){

        try{
            $payment_made = PaymentMade::find($id);
            $user_id = Auth::user()->id;

            $journal_entry = new JournalEntry;
            $journal_entry->note            = $payment_made['reference'];
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = $payment_made['amount'];
            $journal_entry->account_name_id = $payment_made['account_id'];
            $journal_entry->jurnal_type     = "payment_made2";
            $journal_entry->payment_made_id = $payment_made->id;
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($payment_made['payment_date']));
            $journal_entry->contact_id      = $payment_made['vendor_id'];
            $journal_entry->save();

            $journal_entry = new JournalEntry;
            $journal_entry->note            = $payment_made['reference'];
            $journal_entry->debit_credit    = 1;
            $journal_entry->amount          = $payment_made['amount'];
            $journal_entry->account_name_id = 27;
            $journal_entry->jurnal_type     = "payment_made2";
            $journal_entry->payment_made_id = $payment_made->id;
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($payment_made['payment_date']));
            $journal_entry->contact_id      = $payment_made['vendor_id'];
            $journal_entry->save();

            foreach($payment_made->paymentMadeEntries as $payment_made_entry){
                $journal_entry = new JournalEntry;
                $journal_entry->note            = $payment_made['reference'];
                $journal_entry->debit_credit    = 1;
                $journal_entry->amount          = $payment_made_entry['amount'];
                $journal_entry->account_name_id = 11;
                $journal_entry->jurnal_type     = "payment_made1";
                $journal_entry->payment_made_id = $payment_made->id;
                $journal_entry->bill_id         = $payment_made_entry['bill_id'];
                $journal_entry->created_by      = $user_id;
                $journal_entry->updated_by      = $user_id;
                $journal_entry->assign_date      = date('Y-m-d',strtotime($payment_made['payment_date']));
                $journal_entry->contact_id      = $payment_made['vendor_id'];
                $journal_entry->save();

                $journal_entry = new JournalEntry;
                $journal_entry->note            = $payment_made['reference'];
                $journal_entry->debit_credit    = 0;
                $journal_entry->amount          = $payment_made_entry['amount'];
                $journal_entry->account_name_id = 27;
                $journal_entry->jurnal_type     = "payment_made1";
                $journal_entry->payment_made_id = $payment_made->id;
                $journal_entry->bill_id         = $payment_made_entry['bill_id'];
                $journal_entry->created_by      = $user_id;
                $journal_entry->updated_by      = $user_id;
                $journal_entry->assign_date      = date('Y-m-d',strtotime($payment_made['payment_date']));
                $journal_entry->contact_id      = $payment_made['vendor_id'];
                $journal_entry->save();
            }

            $payment_made->cheque_status = 'drawn';
            $payment_made->update();
            return redirect()
                ->route('payment_made')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Payment Made Cheque Drawn successfully!');
        }catch(\Exception $e){
            return redirect()
                ->route('payment_made')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something went wrong!');
        }
    }

    public function deletePaymentMadeEntry($id)
    {
        $payment_made_id = PaymentMadeEntry::find($id)->payment_made_id;

        $amount = PaymentMadeEntry::find($id)->amount;
        $bill_id = PaymentMadeEntry::find($id)->bill_id;

        $payment_made = PaymentMade::find($payment_made_id);

        $bill = Bill::find($bill_id);
        $bill->due_amount = $bill['due_amount'] + $amount;
        $bill->update();

        $payment_made->excess_amount = $payment_made['excess_amount'] + $amount;
        if($payment_made->update())
        {
            $payment_made_entry = PaymentMadeEntry::find($id);
            if($payment_made_entry->delete())
            {
                JournalEntry::where('jurnal_type', 'payment_made1')
                    ->where('payment_made_id', $payment_made_id)
                    ->where('bill_id', $bill_id)
                    ->delete();
                return redirect()
                    ->route('bill_show', ['id' => $bill_id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Payment made Entry Deleted');
            }
        }

        return redirect()
            ->route('bill_show', ['id' => $bill_id])
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Something went to wrong');
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
