<?php

namespace App\Modules\Bill\Http\Controllers;

use DB;
use App\User;
use DateTime;
use Validator;
use Carbon\Carbon;
use Dompdf\Exception;
use App\Http\Requests;
use App\Lib\sortBydate;
use App\Models\Cms\site;
use App\Models\Visa\Visa;
use App\Models\Setting\Unit;
use Illuminate\Http\Request;
use App\Models\Branch\Branch;
use App\Models\MoneyOut\Bill;
use App\Models\Inventory\Item;

use App\Models\Contact\Contact;
use App\Models\Inventory\Stock;
use App\Models\Moneyin\Invoice;
use App\Models\MoneyOut\Expense;
use App\Models\Moneyin\CreditNote;

use App\Models\MoneyOut\BillEntry;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\AccountChart\Account;
use App\Models\MoneyOut\PaymentMade;
use App\Models\Recruit\Recruitorder;
use Illuminate\Support\Facades\Auth;
use App\Models\Attributes\Attributes;
use App\Models\ManualJournal\Journal;
use App\Models\Moneyin\ExcessPayment;
use App\Models\MoneyOut\BillDueTable;
use App\Models\MoneyOut\VendorCredit;
use App\Models\Flightnew\Confirmation;
use App\Models\Inventory\ItemCategory;
use App\Models\MoneyOut\BillFreeEntry;
use App\Models\Inventory\ItemVariation;
use App\Models\Moneyin\PaymentReceives;
use App\Models\Visa\Ticket\Order\Order;
use App\Models\Inventory\ItemSubCategory;
use App\Models\Manpower\Manpower_service;
use App\Models\Moneyin\CreditNotePayment;
use App\Models\MoneyOut\PaymentMadeEntry;
use App\Models\Attributes\AttributeValues;
use App\Models\ManualJournal\JournalEntry;
use App\Models\MoneyOut\VendorCreditEntry;
use App\Modules\Bill\Http\Response\Payment;
use App\Models\MoneyOut\VendorCreditPayment;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\Inventory\ItemVariationAttributeValues;
use App\Models\OrganizationProfile\OrganizationProfile;

class BillWebController extends Controller
{
    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];
    public function index(Request $request)
    {
        $auth_id                = Auth::id();
        $branch_id              = session('branch_id');
        $branchs                = Branch::orderBy('id', 'asc')->get();
        $sort                   = new sortBydate();
        $condition              = "YEAR(str_to_date(bill_date, '%Y-%m-%d')) = YEAR(CURDATE()) AND MONTH(str_to_date(bill_date, '%Y-%m-%d')) = MONTH(CURDATE())";
        $bills                  = [];
        $date                   = "bill_date";
        $items                  = Item::get();
        $current_time           = Carbon::now()->toDayDateTimeString();
        $start                  = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end                    = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
        $vendors                = Contact::where('contact_category_id', 4)->get();

        if ($branch_id == 1) {
            if ($request->due) {
                $bills          = Bill::where('due_amount', '!=', 0)->selectRaw('bill.*')->get()->toArray();
            } else {
                $bills          = Bill::whereBetween('bill.bill_date', [$start, $end])->selectRaw('bill.*')->get()->toArray();
            }

            try {

                $bills           = $sort->get('\App\Models\MoneyOut\Bill', $date, 'Y-m-d', $bills);

                return view('bill::bill.index', compact('bills', 'branchs', 'items', 'vendors'));
            } catch (\Exception $exception) {

                dd($exception->getMessage());
            }
        } else {
            $bills              = Bill::whereBetween('bill.bill_date', [$start, $end])
                ->join('users', 'users.id', '=', 'bill.created_by')
                ->where('users.branch_id', $branch_id)
                ->selectRaw('bill.*')
                ->get()
                ->toArray();

            $date               = "bill_date";

            try {

                $bills          = $sort->get('\App\Models\MoneyOut\Bill', $date, 'Y-m-d', $bills);


                return view('bill::bill.index', compact('bills', 'branchs', 'items', 'vendors'));
            } catch (\Exception $exception) {

                $exception->getMessage();
            }
        }
    }

    public function search(Request $request)
    {
        $branchs                    = Branch::orderBy('id', 'asc')->get();
        $branch_id                  = $request->branch_id;
        $items                      = Item::get();
        if (session('branch_id') == 1) {
            $branch_id              = $request->branch_id ? $request->branch_id : session('branch_id');
        } else {
            $branch_id              = session('branch_id');
        }

        $from_date                  = date('Y-m-d', strtotime($request->from_date));
        $to_date                    = date('Y-m-d', strtotime($request->to_date));
        $due_amount_from            = $request->due_amount_from;
        $due_amount_to              = $request->due_amount_to;
        $selected_item_id           = $request->item_id;
        $vendors                    = Contact::where('contact_category_id', 4)->get();
        $selected_vendor_id         = $request->vendor_id;

        if ($branch_id == 1) {
            if ($request->site_id != null) {
                $bills = Bill::where('vendor_id', $request->vendor_id ? $request->vendor_id : '!=', 0)
                    ->select(DB::raw('bill.*'))
                    ->dateFilter('bill_date', $from_date, $to_date)
                    ->where('bill.cms_site_id', '=', $request->site_id)
                    ->where('due_amount', '>=', $due_amount_from == '' ? 0 : $due_amount_from)
                    ->when(Bill::count() > 0, function ($query) use ($due_amount_to) {
                        return $query->where('due_amount', '<=', $due_amount_to == '' ? Bill::max('due_amount') : $due_amount_to);
                    })
                    ->selectRaw('bill.*')
                    ->get()->toArray();
            } else {
                $bills = Bill::query('item_id', 'billEntries')
                    ->dateFilter('bill_date', $from_date, $to_date)
                    ->where('due_amount', '>=', $due_amount_from == '' ? 0 : $due_amount_from)
                    ->when(Bill::count() > 0, function ($query) use ($due_amount_to) {
                        return $query->where('due_amount', '<=', $due_amount_to == '' ? Bill::max('due_amount') : $due_amount_to);
                    })
                    ->where('vendor_id', $request->vendor_id ? $request->vendor_id : '!=', 0)
                    ->searchFromRelation('billEntries', 'item_id');
            }
        } else {
            if ($request->site_id != null) {
                $bills = Bill::dateFilter('bill_date', $from_date, $to_date)
                    ->where('vendor_id', $request->vendor_id ? $request->vendor_id : '!=', 0)
                    ->where('due_amount', '>=', $due_amount_from == '' ? 0 : $due_amount_from)
                    ->when(Bill::count() > 0, function ($query) use ($due_amount_to) {
                        return $query->where('due_amount', '<=', $due_amount_to == '' ? Bill::max('due_amount') : $due_amount_to);
                    })
                    ->select(DB::raw('bill.*'))
                    ->join('users', 'users.id', '=', 'bill.created_by')
                    ->where('branch_id', $branch_id)
                    ->where('bill.cms_site_id', '=', $request->site_id)
                    ->selectRaw('bill.*');
            } else {

                $bills = Bill::query('item_id', 'billEntries')
                    ->dateFilter('bill_date', $from_date, $to_date)
                    ->where('vendor_id', $request->vendor_id ? $request->vendor_id : '!=', 0)
                    ->where('due_amount', '>=', $due_amount_from == '' ? 0 : $due_amount_from)
                    ->when(Bill::count() > 0, function ($query) use ($due_amount_to) {
                        return $query->where('due_amount', '<=', $due_amount_to == '' ? Bill::max('due_amount') : $due_amount_to);
                    })
                    ->searchFromRelation('billEntries', 'item_id')
                    ->where('branch_id', $branch_id);
            }
        }

        try {
            $bills = $bills->orderBy('bill_date', 'DESC')->get();
            return view('bill::bill.index', compact('bills', 'branchs', 'branch_id', 'from_date', 'to_date', 'due_amount_from', 'due_amount_to', 'items', 'vendors', 'selected_vendor_id', 'selected_item_id'));
        } catch (\Exception $exception) {

            dd($exception->getMessage());
        }
    }

    public function create()
    {
        $Organization_profile           = OrganizationProfile::first();
        $show_all_contact               = $Organization_profile->show_all_contact;
        $branches                        = Branch::all();
        $branch_id                      = session('branch_id');
        $item_category                  = ItemCategory::when($branch_id != 1, function ($query) use ($branch_id) {
            return $query->where('branch_id', '=', $branch_id);
        })
            ->orderBy('item_category_name', 'ASC')
            ->get();


        $vendors                      = Contact::leftjoin('users', 'users.id', '=', 'contact.created_by')
            ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                return $query->where('users.branch_id', '=', $branch_id);
            })
            ->select('contact.*')
            ->where('contact_category_id', 4)
            ->get();

        $bills                          = Bill::all();

        if (count($bills) > 0) {
            $bill           = Bill::orderBy('created_at', 'desc')->first();
            $bill_number    = $bill['bill_number'];
            $bill_number    = $bill_number + 1;
        } else {
            $bill_number    = 1;
        }

        $bill_number                    = str_pad($bill_number, 6, '0', STR_PAD_LEFT);
        $account                        = Account::whereIn('account_type_id', [4, 5])->get();
        $accounts                       = Account::all();
        $attributes                     = Attributes::all();
        $item_variations                = ItemVariation::all();
        $units = Unit::get();
        $projects                       = Contact::where('contact_category_id', 10)->get();


        return view('bill::bill.create', compact('units', 'account', 'vendors', 'bill_number', 'item_category', 'accounts', 'branches', 'attributes', 'item_variations', 'projects'));
    }

    public function store(Request $request)
    {

        $data       = $request->all();
        $user_id    = Auth::user()->id;
        $branch_id  = Auth::user()->branch_id;

        if($request->payment_account == 3)
        {
            $cash_in_hand   = DB::table('journal_entries')
                            ->join('account', 'journal_entries.account_name_id', '=', 'account.id')
                            ->join('users', 'journal_entries.created_by', '=', 'users.id')
                            ->where('journal_entries.debit_credit',0)->where('account.account_type_id',4)
                            ->when($branch_id != 1, function ($query) use ($branch_id) {
                                    return $query->where('users.branch_id', $branch_id);
                                })
                            ->sum('journal_entries.amount');

            $total_minus    = DB::table('journal_entries')
                            ->join('account', 'journal_entries.account_name_id', '=', 'account.id')
                            ->join('users', 'journal_entries.created_by', '=', 'users.id')
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
                        ->where('journal_entries.account_name_id', $data['payment_account'])
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

        $data['payment_amount'] = !empty($data['payment_amount']) ? $data['payment_amount'] : 0;
        if($request->payment_account == 3 && $remaining_amount - $data['payment_amount'] <= 0)
        {
            return redirect()
                ->route('bill')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'You don\'t have enough cash!');
        }
        else if($request->payment_account != 3 && $remaining_amount - $data['payment_amount'] <= 0)
        {
            return redirect()
                ->route('bill')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'You don\'t have enough amount in your bank!');
        }

        $branch_id      = session('branch_id');

        DB::beginTransaction();
        try {

            $this->validate($request, [
                'vendor_id'            => 'required',
                'bill_date'            => 'required',
                //'due_date'             => 'required',
                'item_id.*'            => 'required',
                'quantity_pcs.*'       => 'required',
                'rate.*'               => 'required',
                'amount.*'             => 'required',
                'account_id.*'         => 'required',
                'unit_id.*'            => 'required',
            ]);

            $data                           = $request->all();
            $user_id                        = Auth::user()->id;
            $helper                         = new \App\Lib\Helpers;

            $bills                          = Bill::count();

            if ($bills > 0) {
                $bill                       = Bill::orderBy('created_at', 'desc')->first();
                $bill_number                = $bill['bill_number'];
                $bill_number                = $bill_number + 1;
            } else {
                $bill_number                = 1;
            }

            $bill_number                    = str_pad($bill_number, 6, '0', STR_PAD_LEFT);


            $bill                       = new Bill;

            if ($request->hasFile('file1')) {
                $file                   = $request->file('file1');
                $file_name              = $file->getClientOriginalName();
                $without_extention      = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention         = $file->getClientOriginalExtension();
                $num                    = rand(1, 500);
                $new_file_name          = $without_extention . $request->bill_number . '.' . $file_extention;
                $success                = $file->move('uploads/bill', $new_file_name);

                if ($success) {
                    $bill->file_url     = 'uploads/bill/' . $new_file_name;
                    $bill->file_name    = $new_file_name;
                }
            }

            $bill->bill_number              = $bill_number;
            $bill->branch_id                = $data['branch_id'];
            $bill->vendor_id                = $data['vendor_id'];
            $bill->order_number             = $data['order_number'];
            $bill->bill_date                = date("Y-m-d", strtotime($data['bill_date']));
            $bill->adjustment               = $data['adjustment'];
            $bill->adjustment_type          = $data['adjustment_type'];
            $bill->project_contact_id       = $data['project_contact_id'] ?? null;
            $bill->amount                   = $data['total_amount'];
            $bill->due_amount               = $bill['amount'];
            $bill->note                     = $data['general_note'];
            // $bill->personal_note            = $data['personal_note'];
            // $bill->vendor_note              = $data['vendor_note'];
            $bill->total_tax                = $data['tax_total'];
            $bill->created_by               = $user_id;
            $bill->updated_by               = $user_id;


            if ($bill->save()) {

                $i                      = 0;
                $bill_entry             = [];
                $bill_id                = $bill['id'];

                //payment made
                if ($request->check_payment && $request->check_payment == "on" && !empty($request->payment_amount) && $request->payment_amount > 0) {
                    $payment            = new Payment();
                    $newpayment         = $payment->makePaymentMade($request, $bill_id);
                    $bill->due_amount   = $bill['amount'] - ($newpayment['amount'] == '' ? 0 : $newpayment['amount']);
                }

                if ($request->check_payment_advance && $request->check_payment_advance == "on" && !empty($request->payment_amount_advance) && $request->payment_amount_advance > 0) {
                    $payment_mades = PaymentMade::where('vendor_id', $request['vendor_id'])
                        ->where('excess_amount', '>', 0)
                        ->orderBy('payment_date', 'asc')
                        ->get();
                    $payment_amount_advance = $request['payment_amount_advance'];

                    foreach ($payment_mades as $key => $paymentMade) {

                        $usable_amount = $payment_amount_advance >= $paymentMade->excess_amount ? $paymentMade->excess_amount : $payment_amount_advance;

                        if ($payment_amount_advance > 0) {
                            $helper->updatePaymentMadeEntryAfterExcessAmountUse($bill['id'], $paymentMade->id, $usable_amount, $user_id);
                            $paymentMade->excess_amount = ($paymentMade['excess_amount'] - $usable_amount);

                            $bill->due_amount = $bill['due_amount'] - $usable_amount;
                            $helper->addOrUpdateJournalEntryAfterUsingExcessAmountInBill($bill->id, $paymentMade->id, $usable_amount, $user_id);
                            $payment_amount_advance = $payment_amount_advance - $usable_amount;
                            $paymentMade->update();
                        } else {
                            break;
                        }
                    }
                }

                if ($request->check_payment_vendor_credit && $request->check_payment_vendor_credit == "on" && !empty($request->credit_amount_advance) && $request->credit_amount_advance > 0) {
                    $vendor_credits = VendorCredit::where('vendor_name', $request['vendor_id'])
                        ->where('sub_total', '>', 0)
                        ->orderBy('vendor_credit_date', 'asc')
                        ->get();
                    $vendor_credit_amount = $request['credit_amount_advance'];
                    foreach ($vendor_credits as $key => $vendor_credit) {

                        $usable_amount = $vendor_credit_amount >= $vendor_credit->sub_total ? $vendor_credit->sub_total : $vendor_credit_amount;

                        if ($vendor_credit_amount > 0) {

                            $vendor_credit_payment             = new VendorCreditPayment();
                            $vendor_credit_payment->vendor_credit_id = $vendor_credit->id;
                            $vendor_credit_payment->bill_id    = $bill->id;
                            $vendor_credit_payment->amount     = $usable_amount;
                            $vendor_credit_payment->created_by = $user_id;
                            $vendor_credit_payment->updated_by = $user_id;
                            $vendor_credit_payment->created_at = \Carbon\Carbon::now()->toDateTimeString();
                            $vendor_credit_payment->updated_at = \Carbon\Carbon::now()->toDateTimeString();
                            $vendor_credit_payment->save();
                            $vendor_credit->sub_total          = ($vendor_credit->sub_total - $usable_amount);
                            $bill->due_amount                  = $bill['due_amount'] - $usable_amount;
                            $vendor_credit_amount              = $vendor_credit_amount - $usable_amount;
                            $vendor_credit->update();

                            // $helper->addOrUpdateJournalEntryAfterUsingVendorCreditInBill($bill->id, $vendor_credit->id, $usable_amount, $user_id);

                        } else {
                            break;
                        }
                    }
                }
                //end payment made

                $bill->save();

                foreach ($data['item_id'] as $item) {

                    $unit = Unit::where('id', $data['unit_id'][$i])->select('basic_unit_conversion')->first();
                    $quantity = (float)$data['quantity_pcs'][$i] * $unit->basic_unit_conversion;

                    $bill_entry[]           = [

                        'item_id'                   => $data['item_id'][$i],
                        'variation_id'              => empty($data['selected_variation'][$i]) ? null : $data['selected_variation'][$i],
                        'description'               => $data['description'][$i] ?? null,
                        'account_id'                => $data['account_id'][$i],
                        'quantity'                  => $quantity,
                        'unit_id'                   => $data['unit_id'][$i],
                        'basic_unit_conversion'     => $unit->basic_unit_conversion,
                        'rate'                      => $data['rate'][$i],
                        'rate_type'                 => $data['rate_type'][$i],
                        'discount'                  => $data['discount'][$i] ?? null,
                        'discount_type'             => $data['discount_type'][$i],
                        'amount'                    => $data['amount'][$i],
                        'depreciation'              => $data['depreciation_rate'][$i] ?? null,
                        'bill_id'                   => $bill_id,
                        'tax_id'                    => 1,
                        'created_by'                => $user_id,
                        'updated_by'                => $user_id,
                        'created_at'                => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at'                => \Carbon\Carbon::now()->toDateTimeString(),

                    ];

                    $i++;
                }

                if (DB::table('bill_entry')->insert($bill_entry)) {

                    $bill_entry = BillEntry::where('bill_id', $bill->id)->get();

                    $this->insertBillInJournalEntries($data, $data['total_amount'], $data['tax_total'], $bill_id);
                    $helper->updateItemAfterCreatingBill($data, $bill_id, $user_id);
                    // $due_date    = $request->due_date;
                    // $due_amount  = $request->total_due;

                    // if ($due_amount) {
                    //     foreach ($due_amount as $key => $value) {
                    //         if (($key == 0 && count($due_amount) == 1) || $value != 0) {
                    //             $pay_amount                   = !empty($request->payment_amount) ? $request->payment_amount : 0;
                    //             $due_invoice                  = new BillDueTable;
                    //             $due_invoice->bill_id         = $bill_id;
                    //             $due_invoice->due_date        = date("Y-m-d", strtotime($due_date[$key]));
                    //             $due_invoice->due_amount      = $value ? $value : $data['total_amount'] - $pay_amount;
                    //             $due_invoice->created_by      = Auth::user()->id;
                    //             $due_invoice->updated_by      = Auth::user()->id;
                    //             $due_invoice->save();
                    //         }
                    //     }
                    // }
                    if (isset($data['offer_details_id'])) {
                        foreach ($data['offer_details_id'] as $key => $value) {
                            $bill_free_entry = new BillFreeEntry();
                            $bill_free_entry->bill_id = $bill->id;
                            $bill_free_entry->bill_entry_id = $bill_entry[$key]['id'];
                            $bill_free_entry->offer_id = $value;
                            $bill_free_entry->free_item_id = $data['free_item_id'][$key] == '' ? null : $data['free_item_id'][$key];
                            $bill_free_entry->free_item_variation_id = empty($data['selected_free_variation'][$key]) ? null : $data['selected_free_variation'][$key];
                            $bill_free_entry->free_item_quantity = $data['free_item_quantity'][$key] == '' || $data['free_item_quantity'][$key] == 0 ? null : $data['free_item_quantity'][$key];
                            $bill_free_entry->offer_amount = $data['offer_amount'][$key] == '' || $data['offer_amount'][$key] == 0 ? null : $data['offer_amount'][$key];
                            $bill_free_entry->offer_amount_type = $data['offer_amount_type'][$key] == '' ? null : $data['offer_amount_type'][$key];
                            $bill_free_entry->created_by = $user_id;
                            $bill_free_entry->updated_by = $user_id;
                            $bill_free_entry->created_at = \Carbon\Carbon::now()->toDateTimeString();
                            $bill_free_entry->updated_at = \Carbon\Carbon::now()->toDateTimeString();
                            $bill_free_entry->save();
                        }
                    }

                    DB::commit();

                    return redirect()->route('bill')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Bill is Added Successfully');
                }
            }

            DB::rollback();
            throw new \Exception("Bill Creation Failed");
        } catch (\Exception $ex) {

            DB::rollback();
            $msg                    = $ex->getMessage();
            dd($ex);

            return redirect()->route('bill')
                ->with('alert.status', 'danger')
                ->with('alert.message', "Fail : $msg");
        }
    }

    public function show($id)
    {
        $bill                           = Bill::find($id);
        $branch_id                      = session('branch_id');
        $this->getBranchUsers($branch_id);
        if (!$bill) {
            return back()->with('alert.status', 'warning')->with('alert.message', 'Bill not found!');
        }

        $checkAccess                    = $this->checkIfUserHasAccess($bill);

        if ($checkAccess == 1) {
            return back();
        }

        $bills                          = Bill::orderBy('id', 'desc')->take(20)->get()->toArray();
        $date                           = "bill_date";
        $sort                           = new sortBydate();


        $sort                           = new sortBydate();
        if ($branch_id == 1) {
            $bills                    = $sort->get('\App\Models\MoneyOut\Bill', 'bill_date', 'd-m-Y', $bills);
        } else {
            $bills                   = $sort->get('\App\Models\MoneyOut\Bill', 'bill_date', 'd-m-Y', $bills);
            $bills                   = $bills->whereIn('created_by', $this->targeted_users);
        }
        $bill_entries                   = BillEntry::where('bill_id', $id)->get();
        $payment_made_entries           = PaymentMadeEntry::where('bill_id', $id)->get();
        $OrganizationProfile            = OrganizationProfile::find(1);
        $due_date                       = DB::table('bill_due_table')->where('bill_id', $id)->select('due_date')->first();
        $sub_total                      = 0;

        foreach ($bill_entries as $bill_entry) {
            $sub_total                  = $sub_total + $bill_entry->amount;
        }

        $vendor_credit_payments = VendorCreditPayment::where('bill_id', $id)->get();

        return view('bill::bill.show', compact('OrganizationProfile', 'bill', 'bills', 'bill_entries', 'sub_total', 'payment_made_entries', 'due_date', 'vendor_credit_payments'));
    }

    public function edit($id)
    {
        $OrganizationProfile    = OrganizationProfile::find(1);
        $show_all_contact       = $OrganizationProfile->show_all_contact;
        $branches               = Branch::all();
        $branch_id              = session('branch_id');
        $item_category          = ItemCategory::orderBy('item_category_name', 'ASC')->get();
        $bill                   = Bill::findOrFail($id);
        $vendors                = Contact::leftjoin('users', 'users.id', '=', 'contact.created_by')
            ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                return $query->where('users.branch_id', '=', $branch_id);
            })
            ->select('contact.*')
            ->get();

        $account                        = Account::whereIn('account_type_id', [4, 5])->get();
        $accounts                       = Account::all();
        $due_balance                    = BillDueTable::where('bill_id', $id)->get();
        $attributes                     = Attributes::all();
        $item_variations                = ItemVariation::all();
        $units = Unit::get();
        $projects                       = Contact::where('contact_category_id', 10)->get();

        if (!$bill) {
            return back()->with('alert.status', 'warning')->with('alert.message', 'Bill not found!');
        }

        $checkAccess                    = $this->checkIfUserHasAccess($bill);

        if ($checkAccess == 1) {
            return back();
        }

        return view('bill::bill.edit', compact('units', 'vendors', 'bill', 'item_category', 'account', 'accounts', 'due_balance', 'branches', 'attributes', 'item_variations', 'projects'));
    }

    public function update(Request $request, $id)
    {

        DB::beginTransaction();
        try {

            $this->validate($request, [
                'vendor_id'            => 'required',
                'bill_date'            => 'required',
                //'due_date'             => 'required',
                'item_id.*'            => 'required',
                'quantity_pcs.*'       => 'required',
                'rate.*'               => 'required',
                'amount.*'             => 'required',
                'account_id.*'         => 'required',
                'unit_id.*'         => 'required',
            ]);

            $data                           = $request->all();
            $user_id                        = Auth::user()->id;
            $helper                         = new \App\Lib\Helpers;
            $bill                           = Bill::find($id);

            $helper->updateItemAfterUpdatingBill($data, $user_id);

            $tax_total                      = $data['tax_total'];
            $total_amount                   = $data['total_amount'];

            $total_paid_amount              = $bill->amount - $bill->due_amount;

            if ($data['total_amount'] >= $total_paid_amount) {

                $bill->due_amount           = $data['total_amount'] - $total_paid_amount;
            } else {

                return redirect()
                    ->route('bill_edit', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry! Bill Total Amount cannot be smaller than Total Paid Amount.');
            }

            if ($request->hasFile('file1')) {
                $file                       = $request->file('file1');

                if ($bill->file_url) {
                    $delete_path            = public_path($bill->file_url);

                    if (file_exists($delete_path)) {
                        $delete             = unlink($delete_path);
                    }
                }

                $file_name                  = $file->getClientOriginalName();
                $without_extention          = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention             = $file->getClientOriginalExtension();
                $num                        = rand(1, 500);
                $new_file_name              = $without_extention . $request->bill_number . '.' . $file_extention;

                $success                    = $file->move('uploads/bill', $new_file_name);

                if ($success) {
                    $bill->file_url         = 'uploads/bill/' . $new_file_name;
                    $bill->file_name        = $new_file_name;
                }
            }

            // $bill->order_number             = $data['order_number'];
            $bill->branch_id                = $data['branch_id'];
            $bill->vendor_id                = $data['vendor_id'];
            $bill->order_number             = $data['order_number'];
            $bill->bill_date                = date("Y-m-d", strtotime($data['bill_date']));
            $bill->adjustment               = $data['adjustment'];
            $bill->adjustment_type          = $data['adjustment_type'];
            $bill->amount                   = $total_amount;
            $bill->note                     = $data['general_note'];
            $bill->total_tax                = $tax_total;
            $bill->updated_by               = $user_id;
            $bill_entry_update              = [];
            // $bill->no_of_installment        = $data['no_of_installment'];
            // $bill->day_interval             = $data['time_interval'];
            // $bill->start_date               = date("Y-m-d", strtotime($data['start_date']));


            if ($bill->update()) {
                $bill_entry                 = Bill::find($id)->billEntries();
                
                $created                    = Bill::find($id);
                
                $created_by                 = $created->created_by;
                $created_at                 = $created->created_at->toDateTimeString();
                $updated_at                 = \Carbon\Carbon::now()->toDateTimeString();
                
                if (count($bill->billFreeEntries) > 0) $bill->billFreeEntries()->delete();
                
                $bill_entry->delete();

                $i                          = 0;

                foreach ($data['item_id'] as $account) {
                    $unit = Unit::where('id', $data['unit_id'][$i])->select('basic_unit_conversion')->first();
                    $quantity = (float)$data['quantity_pcs'][$i] * $unit->basic_unit_conversion;


                    $bill_entry_update[]    = [

                        'item_id'           => $data['item_id'][$i],
                        'variation_id'      => empty($data['selected_variation'][$i]) ? null : $data['selected_variation'][$i],
                        'description'       => $data['description'][$i] ?? null,
                        'account_id'        => $data['account_id'][$i],
                        'quantity'          => $quantity,
                        'unit_id'                   => $data['unit_id'][$i],
                        'basic_unit_conversion'     => $unit->basic_unit_conversion,
                        'rate'              => $data['rate'][$i],
                        'rate_type'         => $data['rate_type'][$i],
                        'discount'          => $data['discount'][$i] ?? null,
                        'discount_type'     => $data['discount_type'][$i],
                        'amount'            => $data['amount'][$i],
                        'depreciation'      => $data['depreciation_rate'][$i] ?? null,
                        'bill_id'           => $id,
                        'tax_id'            => 1,
                        'created_by'        => $created_by,
                        'updated_by'        => $user_id,
                        'created_at'        => $created_at,
                        'updated_at'        => $updated_at,

                    ];



                    $i++;
                }

                if (DB::table('bill_entry')->insert($bill_entry_update)) {
                    $helper->updateItemAfterCreatingBill($data, $id, $user_id);

                    $bill_entry = BillEntry::where('bill_id', $bill->id)->get();

                    if (isset($data['offer_details_id'])) {
                        foreach ($data['offer_details_id'] as $key => $value) {
                            $bill_free_entry = new BillFreeEntry();
                            $bill_free_entry->bill_id = $bill->id;
                            $bill_free_entry->bill_entry_id = $bill_entry[$key]['id'];
                            $bill_free_entry->offer_id = $value;
                            $bill_free_entry->free_item_id = $data['free_item_id'][$key];
                            $bill_free_entry->free_item_variation_id = empty($data['selected_free_variation'][$key]) ? null : $data['selected_free_variation'][$key];
                            $bill_free_entry->free_item_quantity = $data['free_item_quantity'][$key];
                            $bill_free_entry->offer_amount = $data['offer_amount'][$key];
                            $bill_free_entry->offer_amount_type = $data['offer_amount_type'][$key];
                            $bill_free_entry->created_by = $created_by;
                            $bill_free_entry->updated_by = $user_id;
                            $bill_free_entry->created_at = $created_at;
                            $bill_free_entry->updated_at = $updated_at;
                            $bill_free_entry->save();
                        }
                    }

                    if (isset($data['submit'])) {

                        $this->updateBillInJournalEntries($data, $total_amount, $tax_total, $id);
                    }

                    // $due_date       = $request->due_date;
                    // $due_amount     = $request->amount_val;

                    BillDueTable::where('bill_id', $id)->delete();

                    // if ($due_amount) {
                    //     foreach ($due_amount as $key => $value) {
                    //         if ($value != 0 ||  ($key == 0 && count($due_amount) == 1)) {
                    //             $pay_amount                   = !empty($request->payment_amount) ? $request->payment_amount : 0;
                    //             $due_invoice                  = new BillDueTable;
                    //             $due_invoice->bill_id         = $id;
                    //             $due_invoice->due_date        = date("Y-m-d", strtotime($due_date[$key]));
                    //             $due_invoice->due_amount      = $value ?  $value : $total_amount - $pay_amount;
                    //             $due_invoice->created_by      = Auth::user()->id;
                    //             $due_invoice->updated_by      = Auth::user()->id;
                    //             $due_invoice->save();
                    //         }
                    //     }
                    // }

                    DB::commit();

                    return redirect()
                        ->route('bill')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Bill Updated Successfully!');
                }
            }

            DB::rollback();

            return redirect()
                ->route('bill_edit', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something went wrong! Please try again!');
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $helper                         = new \App\Lib\Helpers;

            //check if payment made, vendor credit created, vendor credit is used in this bill or not
            if ($helper->isPaymentMadeInThisBill($id)) {
                return redirect()
                    ->route('bill')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Payment made is used in this bill. First You have to delete payment made from this bill.');
            }
            if ($helper->isVendorCreditInThisBill($id)) {
                return redirect()
                    ->route('bill')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Vendor credit is attached in this bill. First You have to delete purchase return attached to this bill.');
            }
            if ($helper->isVendorCreditUsedInThisBill($id)) {
                return redirect()
                    ->route('bill')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Vendor credit is used in this bill. First You have to delete vendor credit used in this bill.');
            }
            //check if payment made, vendor credit created, vendor credit is used in this bill or not ends

            $bill                   = Bill::findOrFail($id);
            $branch_id              = session('branch_id');
            $OrganizationProfile    = OrganizationProfile::find(1);

            $checkAccess                    = $this->checkIfUserHasAccess($bill);

            if ($checkAccess == 1) {
                return back();
            }

            // $helper->itemBackAfterDeletingBill($id);

            // Using cascade doesn't initiate the trigger in mysql
            if (count($bill->billFreeEntries) > 0) $bill->billFreeEntries()->delete();
            if (count($bill->billEntries) > 0) $bill->billEntries()->delete();
            if ($bill->delete()) {

                if ($bill->file_url) {
                    $delete_path            = public_path($bill->file_url);

                    if (file_exists($delete_path)) {
                        $delete             = unlink($delete_path);
                    }
                }

                DB::commit();

                return redirect()
                    ->route('bill')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Bill Deleted Successfully!!!');
            }

            DB::rollback();

            return redirect()
                ->route('bill')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something went wrong. Please Try Again.');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function deleteCredit($id)
    {
        //return $id;
        $vendor_credit_payment = VendorCreditPayment::find($id);

        $bill_id = $vendor_credit_payment->bill->id;
        $amount = $vendor_credit_payment->amount;
        $this->updateDueAmountInBillAfterVendorCreditPaymentDeleteFromBill($bill_id, $amount);

        $vendor_credit_id = $vendor_credit_payment->vendor_credit_id;
        $vendor_credit = VendorCredit::find($vendor_credit_id);
        $vendor_credit->sub_total = $vendor_credit['sub_total'] + $amount;
        if ($vendor_credit->update()) {
            if ($vendor_credit_payment->delete()) {
                return redirect()
                    ->route('bill_show', ['url' => $bill_id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Vendor credit deleted successfully!');
            }
        }
    }

    public function download($attachment)
    {
        $download_link = public_path('uploads/bill/' . $attachment);
        return response()->download($download_link);
    }

    public function insertBillInJournalEntries($data, $total_amount, $total_tax, $bill_id)
    {
        $user_id                                    = Auth::user()->id;
        $i                                          = 0;
        $discount                                   = 0;
        $account_array                              = array_fill(1, 200, 0);

        foreach ($data['item_id'] as $item_id) {
            $amount                                 = $data['quantity_pcs'][$i] * $data['rate'][$i];
            if ($data['discount'][$i] == "") {
                $discount = $discount + (0 * $amount) / 100;
            } else {
                if ($data['discount_type'][$i] == 1) {
                    $discount = $discount + ($data['discount'][$i]);
                } else {
                    $discount = $discount + ($data['discount'][$i] * $amount) / 100;
                }
            }
            $account_array[$data['account_id'][$i]] =  $account_array[$data['account_id'][$i]] + $amount;
            $i++;
        }

        $journal_entry                              = new JournalEntry;
        $journal_entry->note                        = $data['general_note'];
        $journal_entry->debit_credit                = 0;
        $journal_entry->amount                      = $total_amount;
        $journal_entry->account_name_id             = 11;
        $journal_entry->jurnal_type                 = "bill";
        $journal_entry->bill_id                     = $bill_id;
        $journal_entry->contact_id                  = $data['vendor_id'];
        $journal_entry->created_by                  = $user_id;
        $journal_entry->updated_by                  = $user_id;
        $journal_entry->assign_date                 = date('Y-m-d', strtotime($data['bill_date']));

        if ($journal_entry->save()) {
        } else {
            //delete all journal entry for this invoice...
            $bill                                   = Bill::find($bill_id);
            $bill->delete();

            return false;
        }

        if ($discount > 0) {
            $journal_entry = new JournalEntry;
            $journal_entry->note                    = $data['general_note'];
            $journal_entry->debit_credit            = 0;
            $journal_entry->amount                  = $discount;
            $journal_entry->account_name_id         = 31;
            $journal_entry->jurnal_type             = "bill";
            $journal_entry->bill_id                 = $bill_id;
            $journal_entry->contact_id              = $data['vendor_id'];
            $journal_entry->created_by              = $user_id;
            $journal_entry->updated_by              = $user_id;
            $journal_entry->assign_date             = date('Y-m-d', strtotime($data['bill_date']));

            if ($journal_entry->save()) {
            } else {
                //delete all journal entry for this invoice...
            }
        }

        if ($total_tax > 0) {
            $journal_entry                          = new JournalEntry;
            $journal_entry->note                    = $data['general_note'];
            $journal_entry->debit_credit            = 1;
            $journal_entry->amount                  = $total_tax;
            $journal_entry->account_name_id         = 9;
            $journal_entry->jurnal_type             = "bill";
            $journal_entry->bill_id                 = $bill_id;
            $journal_entry->contact_id              = $data['vendor_id'];
            $journal_entry->created_by              = $user_id;
            $journal_entry->updated_by              = $user_id;
            $journal_entry->assign_date             = date('Y-m-d', strtotime($data['bill_date']));

            if ($journal_entry->save()) {
            } else {
                //delete all journal entry for this invoice...
                $bill                               = Bill::find($bill_id);
                $bill->delete();

                return false;
            }
        }

        //insert adjustment as credit
        if ($data['adjustment'] != 0) {
            $journal_entry                      = new JournalEntry;
            $journal_entry->note                = $data['general_note'];

            if ($data['adjustment'] < 0) {
                $journal_entry->debit_credit    = 1;
            } else {
                $journal_entry->debit_credit    = 0;
            }
            $journal_entry->amount              = abs($data['adjustment_type'] == 1 ? $data['adjustment'] : $data['adjustment'] * $data['sub_total'] / 100);
            $journal_entry->account_name_id     = 18;
            $journal_entry->jurnal_type         = "bill";
            $journal_entry->bill_id             = $bill_id;
            $journal_entry->contact_id          = $data['vendor_id'];
            $journal_entry->created_by          = $user_id;
            $journal_entry->updated_by          = $user_id;
            $journal_entry->assign_date         = date('Y-m-d', strtotime($data['bill_date']));

            if ($journal_entry->save()) {
            } else {
                //delete all journal entry for this invoice...
                $bill                               = Bill::find($bill_id);
                $bill->delete();

                return false;
            }
        }

        $bill_entry                                 = [];

        for ($j = 1; $j < count($account_array) - 2; $j++) {

            if ($account_array[$j] != 0) {
                $bill_entry[]           = [
                    'note'              => $data['general_note'],
                    'debit_credit'      => 1,
                    'amount'            => $account_array[$j],
                    'account_name_id'   => $j,
                    'jurnal_type'       => 'bill',
                    'bill_id'           => $bill_id,
                    'contact_id'        => $data['vendor_id'],
                    'created_by'        => $user_id,
                    'updated_by'        => $user_id,
                    'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    'assign_date'       => date('Y-m-d', strtotime($data['bill_date'])),
                ];
            }
        }

        if (DB::table('journal_entries')->insert($bill_entry)) {
            return true;
        } else {
            //delete all journal entry for this invoice...
            $bill                               = Bill::find($bill_id);
            $bill->delete();

            return false;
        }

        return false;
    }

    public function updateBillInJournalEntries($data, $total_amount, $total_tax, $bill_id)
    {

        $bill_entries_delete                        = Bill::find($bill_id)->journalEntries();

        $created                                    = Bill::find($bill_id);

        $created_by                                 = $created->created_by;
        $created_at                                 = $created->created_at->toDateTimeString();
        $updated_at                                 = \Carbon\Carbon::now()->toDateTimeString();

        if ($bill_entries_delete->delete()) {
        }

        $user_id                                    = Auth::user()->id;
        $i                                          = 0;
        $discount                                   = 0;
        $account_array                              = array_fill(1, 200, 0);

        foreach ($data['item_id'] as $account) {
            $amount                                 = $data['quantity_pcs'][$i] * $data['rate'][$i];

            if ($data['discount'][$i] == "") {
                $discount = $discount + (0 * $amount) / 100;
            } else {
                if ($data['discount_type'][$i] == 1) {
                    $discount = $discount + ($data['discount'][$i]);
                } else {
                    $discount = $discount + ($data['discount'][$i] * $amount) / 100;
                }
            }

            $account_array[$data['account_id'][$i]] =  $account_array[$data['account_id'][$i]] + $amount;
            $i++;
        }

        //insert total amount as debit
        $journal_entry                              = new JournalEntry;
        $journal_entry->note                        = $data['general_note'];
        $journal_entry->debit_credit                = 0;
        $journal_entry->amount                      = $total_amount;
        $journal_entry->account_name_id             = 11;
        $journal_entry->jurnal_type                 = "bill";
        $journal_entry->bill_id                     = $bill_id;
        $journal_entry->contact_id                  = $data['vendor_id'];
        $journal_entry->created_by                  = $created_by;
        $journal_entry->updated_by                  = $user_id;
        $journal_entry->created_at                  = $created_at;
        $journal_entry->updated_at                  = $updated_at;
        $journal_entry->assign_date                 = date('Y-m-d', strtotime($data['bill_date']));

        if ($journal_entry->save()) {
        } else {
            return false;
        }

        if ($discount > 0) {
            $journal_entry = new JournalEntry;
            $journal_entry->note            = $data['general_note'];
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = $discount;
            $journal_entry->account_name_id = 31;
            $journal_entry->jurnal_type     = "bill";
            $journal_entry->bill_id         = $bill_id;
            $journal_entry->contact_id      = $data['vendor_id'];
            $journal_entry->created_by      = $created_by;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date     = date('Y-m-d', strtotime($data['bill_date']));

            if ($journal_entry->save()) {
            } else {
                //delete all journal entry for this invoice...
            }
        }

        //insert tax total as debit
        if ($total_tax > 0) {
            $journal_entry                          = new JournalEntry;
            $journal_entry->note                    = $data['general_note'];
            $journal_entry->debit_credit            = 1;
            $journal_entry->amount                  = $total_tax;
            $journal_entry->account_name_id         = 9;
            $journal_entry->jurnal_type             = "bill";
            $journal_entry->bill_id                 = $bill_id;
            $journal_entry->contact_id              = $data['vendor_id'];
            $journal_entry->created_by              = $created_by;
            $journal_entry->updated_by              = $user_id;
            $journal_entry->created_at              = $created_at;
            $journal_entry->updated_at              = $updated_at;
            $journal_entry->assign_date             = date('Y-m-d', strtotime($data['bill_date']));

            if ($journal_entry->save()) {
            } else {
                //delete all journal entry for this invoice...
                $bill                               = Bill::find($bill_id);
                $bill->delete();

                return false;
            }
        }

        if ($data['adjustment'] != 0) {
            $journal_entry                  = new JournalEntry;
            $journal_entry->note            = $data['general_note'];

            if ($data['adjustment'] < 0) {
                $journal_entry->debit_credit    = 1;
            } else {
                $journal_entry->debit_credit    = 0;
            }
            $journal_entry->amount          = abs($data['adjustment_type'] == 1 ? $data['adjustment'] : $data['adjustment'] * $data['sub_total'] / 100);
            $journal_entry->account_name_id = 18;
            $journal_entry->jurnal_type     = "bill";
            $journal_entry->bill_id         = $bill_id;
            $journal_entry->contact_id      = $data['vendor_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d', strtotime($data['bill_date']));

            if ($journal_entry->save()) {
            } else {
                //delete all journal entry for this invoice...
            }
        }

        //return $account_array;

        $bill_entry                             = [];

        for ($j = 1; $j < count($account_array) - 2; $j++) {

            if ($account_array[$j] != 0) {
                $bill_entry[]           = [
                    'note'              => $data['general_note'],
                    'debit_credit'      => 1,
                    'amount'            => $account_array[$j],
                    'account_name_id'   => $j,
                    'jurnal_type'       => 'bill',
                    'bill_id'           => $bill_id,
                    'contact_id'        => $data['vendor_id'],
                    'created_by'        => $created_by,
                    'updated_by'        => $user_id,
                    'created_at'        => $created_at,
                    'updated_at'        => $updated_at,
                    'assign_date'       => date('Y-m-d', strtotime($data['bill_date'])),
                ];
            }
        }

        if (DB::table('journal_entries')->insert($bill_entry)) {
            return true;
        } else {
            return false;
        }

        return false;
    }

    public function useExcessPayment(Request $request)
    {
        $data = $request->all();
        //return $data;
        $user_id = Auth::user()->id;
        $helper = new \App\Lib\Helpers;
        $i = 0;
        foreach ($data['excess_payment_amount'] as $excess_payment_amount) {
            if ($excess_payment_amount && $excess_payment_amount > 0) {
                $helper->updatePaymentMadeEntryAfterExcessAmountUse($data['bill_id'], $data['payment_made_id'][$i], $excess_payment_amount, $user_id);

                $payment_made = PaymentMade::find($data['payment_made_id'][$i]);
                $payment_made->excess_amount = ($payment_made['excess_amount'] - $excess_payment_amount);
                $payment_made->update();

                $bill = Bill::find($data['bill_id']);
                $bill->due_amount = $bill['due_amount'] - $excess_payment_amount;
                $bill->update();
            }
            $i++;
        }


        $i = 0;
        foreach ($data['excess_payment_amount'] as $excess_payment_amount) {
            if ($excess_payment_amount) {
                $helper->addOrUpdateJournalEntryAfterUsingExcessAmountInBill($data['bill_id'], $data['payment_made_id'][$i], $excess_payment_amount, $user_id);
            }
            $i++;
        }

        return redirect()
            ->route('bill_show', ['id' => $data['bill_id']])
            ->with('alert.status', 'success')
            ->with('alert.message', 'Excess notes used successfully!');
    }

    public function checkIfUserHasAccess($bill)
    {

        $user_branch    = Auth::user()->branch_id;

        if ($bill->createdBy->branch_id != $user_branch && $user_branch != 1) {
            return 1;
        }
    }

    public function itemCaegory($id)
    {
        $data = ItemSubCategory::where('item_category_id', $id)->get();

        return response($data);
    }

    public function itemList($id)
    {
        $data = Item::where('item_sub_category_id', $id)->get();

        return response($data);
    }

    public function itemRate($id)
    {
        $data = Item::where('id', $id)
                    ->with(['ItemAttributeValues' => function($q){
                        $q->where('item_attribute_values.measurable', 1);
                        }])
                    ->with('Unit')
                    ->first();
        // $data->merge(['unit_name' => $data->Unit->unit_name]);
        //                 dd($data);
        return response($data);
    }

    public function getBranchUsers($branch_id)
    {
        $tmp_targeted_users      = [];
        $this->targeted_users    = [];

        $this->branch_id = $branch_id;

        $branch_users = User::where('branch_id', $this->branch_id)->get();

        if (isset($branch_users)) {
            foreach ($branch_users as $users) {
                $tmp_targeted_users[] = $users->id;
            }
        } else {
            $tmp_targeted_users = [];
        }

        $this->targeted_users = $tmp_targeted_users;
    }

    // public function getExcessPayment($vendor_id)
    // {
    //     $excess_payment_amount = PaymentMade::where('vendor_id', $vendor_id)->sum('excess_amount');
    //     return response($excess_payment_amount);
    // }

    // public function getVendorCredit($vendor_id)
    // {
    //     $available_vendor_credit = VendorCredit::where('vendor_name', $vendor_id)->sum('sub_total');
    //     return $available_vendor_credit;
    // }

    public function updateDueAmountInBillAfterVendorCreditPaymentDeleteFromBill($bill_id, $amount)
    {
        $bill = Bill::find($bill_id);
        $bill->due_amount = $bill['due_amount'] + $amount;
        $bill->update();
    }
}
