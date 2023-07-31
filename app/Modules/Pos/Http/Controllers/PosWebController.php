<?php

namespace App\Modules\Pos\Http\Controllers;

use App\Lib\sortBydate;
use App\Lib\TemplateHeader;
use App\Models\AccountChart\Account;
use App\Models\Branch\Branch;
use App\Models\Inventory\Item;
use App\Models\Inventory\Stock;
use App\Models\Inventory\ProductTransfer;
use App\Models\Manpower\Manpower_service;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Moneyin\InvoiceEntryMeasurement;
use App\Models\Moneyin\TempInvoiceEntryMeasurement;
use App\Models\Moneyin\InvoiceDue;
use App\Models\MoneyOut\StockSerial;
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

use Illuminate\Support\Facades\DB;
use Exception;
use App\Lib\ICOMBD;

use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoicesMeasurements;
use App\Models\Contact\Contact;
use App\Models\Contact\ContactBodyMeasurements;
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
use Carbon\Carbon;

class PosWebController extends Controller
{
    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];

    public function __construct()
    {
        // (new ICOMBD)->regular('');
        $this->increasing_limit = DB::statement('SET SESSION group_concat_max_len = 100000000000');
    }

    public function index(Request $request)
    {
        $branch_id      = session('branch_id');
        $invoice_no     = isset($request->invoice_no) ? $request->invoice_no : 0;
        if (strpos($invoice_no, 'INV-') !== false) $invoice_no = substr($invoice_no, 4);
        $invoice_no     = str_pad($invoice_no, 6, 0, STR_PAD_LEFT);

        $customer_name  = isset($request->customer_name) ? $request->customer_name : '';
        $customer_phone = isset($request->customer_phone) ? $request->customer_phone : '';

        $customers          = [];
        $customers_tmp   = Contact::where('display_name', 'LIKE', '%' . $customer_name . '%')
            ->where('phone_number_1', 'LIKE', '%' . $customer_phone . '%')
            ->get();
        foreach ($customers_tmp as $key => $value) {
            $customers[] = $value->id;
        }

        $auth_id        = Auth::id();
        $sort           = new sortBydate();

        $this->getBranchUsers($branch_id);

        $branchs        = Branch::orderBy('id', 'asc')->get();
        $invoices       = [];
        $current_time   = Carbon::now()->toDayDateTimeString();
        // $start          = (new DateTime($current_time))->modify('-3 day')->format('Y-m-d');
        // $end            = (new DateTime($current_time))->modify('+30 day')->format('Y-m-d');

        try {
            if ($branch_id == 1) {
                if ($request->due) {
                    $invoices   = Invoice::where('due_amount', '!=', 0)
                        ->when($invoice_no != 0, function ($query) use ($invoice_no) {
                            return $query->where('invoice_number', $invoice_no);
                        })
                        ->when(count($customers) > 0, function ($query) use ($customers) {
                            return $query->whereIn('customer_id', $customers);
                        })
                        ->get();
                } else {
                    $invoices   = Invoice::when(Auth::user()->type != 0, function ($data) {
                        return $data->where('invoices.created_by', Auth::user()->id);
                    })
                        // ->whereBetween('invoices.invoice_date', [$start, $end])
                        ->when($invoice_no != 0, function ($query) use ($invoice_no) {
                            return $query->where('invoice_number', $invoice_no);
                        })
                        ->when(count($customers) > 0, function ($query) use ($customers) {
                            return $query->whereIn('customer_id', $customers);
                        })
                        ->get();
                }
            } else {
                $invoices       = Invoice::select(DB::raw('invoices.*'))
                    ->when($invoice_no != 0, function ($query) use ($invoice_no) {
                        return $query->where('invoice_number', $invoice_no);
                    })
                    ->when(count($customers) > 0, function ($query) use ($customers) {
                        return $query->whereIn('customer_id', $customers);
                    })
                    // ->whereBetween('invoices.invoice_date', [$start, $end])
                    ->get();
                $invoices       = $invoices->whereIn('created_by', $this->targeted_users);
            }

            $invoices = $invoices->sortByDesc('id');

            $due_invoices = Invoice::where('due_amount', '>', 0)->get();

            foreach ($due_invoices as $due_invoice) {
                $due_invoice->name = 'INV-' . $due_invoice->invoice_number . ', ' . $due_invoice->customer->phone_number_1 . ', ' . $due_invoice->customer->display_name;
            }

            $accounts     = Account::whereIn('account_type_id', [4, 5])->get();

            return view('pos::invoice.index', compact('invoices', 'branchs', 'due_invoices', 'accounts'));
        } catch (\Exception $exception) {
            return view('pos::invoice.index', compact('invoices', 'branchs'));
        }
    }

    public function search(Request $request)
    {
        $branchs        = Branch::orderBy('id', 'asc')->get();
        $branch_id      = $request->branch_id ? $request->branch_id : session('branch_id');

        $this->getBranchUsers($branch_id);

        if (session('branch_id') == 1) {
            $branch_id  =  $request->branch_id ? $request->branch_id : session('branch_id');
        } else {
            $branch_id  = session('branch_id');
        }

        $from_date      = date('Y-m-d', strtotime($request->from_date));
        $to_date        = date('Y-m-d', strtotime($request->to_date));
        // $invoices       = [];

        try {
            if ($branch_id == 1) {
                $invoices   = Invoice::when(Auth::user()->type != 0, function ($data) {
                    return $data->where('invoices.created_by', Auth::user()->id);
                })
                    ->whereBetween('invoices.invoice_date', [$from_date, $to_date])
                    ->get();
            } else {
                $invoices   = Invoice::select(DB::raw('invoices.*'))
                    ->whereBetween('invoices.invoice_date', [$from_date, $to_date])
                    ->get();

                $invoices   = $invoices->whereIn('created_by', $this->targeted_users);
            }

            // $sort           = new sortBydate();
            // $invoices       = $sort->get('\App\Models\Moneyin\Invoice', 'invoice_date', 'd-m-Y', $invoices);

            return view('pos::invoice.index', compact('invoices', 'branchs', 'branch_id', 'from_date', 'to_date'));
        } catch (\Exception $exception) {
            return view('pos::invoice.index', compact('invoices', 'branchs', 'branch_id', 'from_date', 'to_date'));
        }
    }

    public function create(Request $request)
    {
        $OrganizationProfile            = OrganizationProfile::find(1);
        $show_all_contact   = OrganizationProfile::first();
        $show_all_contact   = $show_all_contact->show_all_contact;

        $branch_id          = session('branch_id');
        $item_category      = ItemCategory::when($branch_id != 1, function ($query) use ($branch_id) {
            return $query->where('branch_id', '=', $branch_id);
        })
            ->orderBy('item_category_name', 'ASC')
            ->get();

        $customers          = Contact::leftjoin('users', 'users.id', '=', 'contact.created_by')
            ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                return $query->where('users.branch_id', '=', $branch_id);
            })
            ->select('contact.*')
            ->get();

        $agents             = $customers;
        $account            = Account::all();
        $accounts           = Account::whereIn('account_type_id', [4, 5])->get();

        $invoices           = Invoice::count();

        $delivery_persons   = Contact::leftjoin('users', 'users.id', '=', 'contact.created_by')
            ->where('contact_category_id', 3)
            ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                return $query->where('users.branch_id', '=', $branch_id);
            })
            ->get()
            ->sortBy('display_name');

        if ($invoices > 0) {
            $invoice        = Invoice::orderBy('id', 'desc')->first();
            $invoice_number = $invoice['invoice_number'];
            $invoice_number = $invoice_number + 1;
        } else {
            $invoice_number = 1;
        }

        $invoice_number     = str_pad($invoice_number, 6, '0', STR_PAD_LEFT);

        $customer_id        = isset($request->customer_id) ? $request->customer_id : null;

        return view('pos::invoice.create', compact(
            'customers',
            'invoice_number',
            'agents',
            'account',
            'item_category',
            'accounts',
            'delivery_persons',
            'OrganizationProfile',
            'customer_id'
        ));
    }

    public function store(Request $request)
    {
        $branch_id      = session('branch_id');

        if ($request->get('from_measurement') == 1) {

            $request->customer_id               = $request->get('customer_id');
            $request->invoice_date              = $request->get('invoice_date');
            $request->temp_order_number         = $request->get('temp_order_number');
            $request->order_number              = $request->get('order_number');
            $request->new_item_serial           = $request->get('new_item_serial');
            $request->from_measurement          = $request->get('from_measurement');
            $request->adjustment                = $request->get('adjustment');
            $request->shipping_charge           = $request->get('shipping_charge');
            $request->payment_amount            = $request->get('payment_amount');
            $request->return_amount             = $request->get('return_amount');
            $request->payment_account           = $request->get('payment_account');
            $request->payment_account_bank      = 0;
            $request->submit                    = $request->get('submit');
            $request->sub_total                 = $request->get('sub_total');
            $request->total_amount              = $request->get('total_amount');
            $request->tax_total                 = $request->get('tax_total');
            $request->personal_note             = $request->get('personal_note');
            $request->customer_note             = $request->get('customer_note');
            $request->no_of_installment         = $request->get('no_of_installment');
            $request->time_interval             = $request->get('time_interval');
            $request->start_date                = $request->get('start_date');
            $request->due_date                  = $request->get('due_date');
            $request->amount_val                = $request->get('amount_val');
            $request->item_id                   = $request->get('item_id');
            $request->serial                    = $request->get('serial');
            $request->description               = $request->get('description');
            $request->quantity                  = $request->get('quantity');
            $request->rate                      = $request->get('rate');
            $request->discount                  = $request->get('discount');
            $request->discount_type             = $request->get('discount_type');
            $request->amount                    = $request->get('amount');
            $request->account_id                = $request->get('account_id');
            $request->stock                     = $request->get('stock');
            // $request->tailoring_customer_delivery = $request->get('tailoring_customer_delivery');
            // $request->send_to_master            = $request->get('send_to_master');
            // $request->receive_from_master       = $request->get('receive_from_master');
            // $request->master                    = $request->get('master');
            // $request->additional_note           = $request->get('additional_note');
        }

        $validatiolist = [
            'customer_id'          => 'required',
            'invoice_date'         => 'required',
            'item_id.*'            => 'required',
            'quantity.*'           => 'required',
            'rate.*'               => 'required',
            'amount.*'             => 'required',
            'account_id'           => 'required',
        ];

        $cash_paid = 0;
        $bank_paid = 0;

        if (isset($request->payment_amount) && $request->payment_amount > 0) {
            $request->check_payment = 1;
            $cash_paid = 1;
        }

        if (isset($request->payment_amount_bank) && $request->payment_amount_bank > 0 && isset($request->payment_account)) {
            $request->check_payment = 1;
            $bank_paid = 1;
        }

        // if($request->check_payment)
        // {
        //     $validatiolist["payment_account"]       = "required";
        //     $validatiolist["payment_amount"]        = "required||numeric";
        // }

        $payment                =  new Payment();

        if (!isset($request->from_measurement)) {
            $this->validate($request, $validatiolist);
        }

        try {

            DB::beginTransaction();

            if (isset($request->from_measurement)) {
                $data                           = (array) $request;
            } else {
                $data                           = $request->all();
            }

            $user_id                        = Auth::user()->id;
            $helper                         = new \App\Lib\Helpers;

            if ($data['return_amount'] > 0) {
                $data['payment_amount_bank']    = $data['payment_amount_bank'] > 0 ? $data['payment_amount_bank'] : 0;
                $data['payment_amount']         = $data['total_amount'] - $data['payment_amount_bank'];
                $request['payment_amount']      = $data['payment_amount'];
            }

            //  $check_Item_Quantity            = $helper->checkItemQuantity($data);

            //  if(!$check_Item_Quantity)
            //  {
            //    throw new \Exception("Quantity is not available for some item. Please add the invoice again!!!");
            //  }

            $invoices                       = Invoice::count();

            if ($invoices > 0) {
                $invoice                    = Invoice::orderBy('id', 'desc')->first();
                $invoice_number             = $invoice['invoice_number'];
                $invoice_number             = $invoice_number + 1;
            } else {
                $invoice_number             = 1;
            }

            $invoice_number = str_pad($invoice_number, 6, '0', STR_PAD_LEFT);

            $invoice                        = new Invoice;
            $invoice->invoice_number        = $invoice_number;
            $invoice->invoice_date          = date('Y-m-d', strtotime($data['invoice_date']));

            if (isset($request->order_number) && $request->order_number > 0) {
                $invoice->tailoring_order_number    = $request->order_number;
            }

            $invoice->reference             = isset($data['reference']) ? $data['reference'] : '';
            $invoice->customer_note         = $data['customer_note'];
            $invoice->personal_note         = $data['personal_note'];
            $invoice->tax_total             = $data['tax_total'];
            $invoice->shipping_charge       = $data['shipping_charge'];
            $invoice->adjustment            = $data['adjustment'];
            $invoice->adjustment_type       = isset($data['adjustment_type']) ? $data['adjustment_type'] : 0;
            $invoice->total_amount          = $data['total_amount'];
            $invoice->item_category_id      = empty($data['item_category_id']) ? null : $data['item_category_id'];
            $invoice->item_sub_category_id  = empty($data['item_sub_category_id']) ? null : $data['item_sub_category_id'];
            $invoice->due_amount            = $data['total_amount'];
            $invoice->delivery_person       = empty($data['delivery_person_id']) ? null : $data['delivery_person_id'];
            $invoice->receive_person        = empty($data['receive_person_id']) ? null : $data['receive_person_id'];
            $invoice->receive_date          = empty($data['receive_date']) ?  null  : date("Y-m-d", strtotime($data['receive_date']));
            $invoice->no_of_installment     = $data['no_of_installment'];
            $invoice->day_interval          = $data['time_interval'];
            $invoice->start_date            = date('Y-m-d', strtotime($data['start_date']));
            // $invoice->tailoring_customer_delivery = date('Y-m-d', strtotime($data['tailoring_customer_delivery'] ?? date('Y-m-d')));
            // $invoice->status                = 2;

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

            if ($invoice->save()) {
                $invoice_id                 = $invoice['id'];
                $i                          = 0;

                foreach ($data['item_id'] as $account) {
                    if (!$data['discount'][$i]) {
                        $invoice_entry[] = [
                            'quantity'          => $data['quantity'][$i],
                            'rate'              => $data['rate'][$i],
                            'description'       => $data['description'][$i],
                            'amount'            => $data['amount'][$i],
                            'discount'          => 0,
                            //  'serial'            => $data['serial'][$i],
                            'discount_type'     => 0,
                            'item_id'           => $data['item_id'][$i],
                            'invoice_id'        => $invoice_id,
                            'tax_id'            => 1,
                            'account_id'        => $data['account_id'][$i],
                            'created_by'        => $user_id,
                            'updated_by'        => $user_id,
                            'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                            'serial'            => $data['serial'][$i],
                            // 'send_master_date'    => isset($data['send_to_master'][$i]) && !empty($data['send_to_master'][$i]) ? date('Y-m-d', strtotime($data['send_to_master'][$i])) : null,
                            // 'receive_master_date'    => isset($data['receive_from_master'][$i]) && !empty($data['receive_from_master'][$i]) ? date('Y-m-d', strtotime($data['send_to_master'][$i])) : null,
                            // 'master_id'            => isset($data['master'][$i]) && !empty($data['master'][$i]) ? $data['master'][$i] : null,
                            // 'additional_note'   => isset($data['additional_note'][$i]) && !empty($data['additional_note'][$i]) ? $data['additional_note'][$i] : null
                        ];
                    } else {


                        $invoice_entry[] = [
                            'quantity'          => $data['quantity'][$i],
                            'rate'              => $data['rate'][$i],
                            'description'       => $data['description'][$i],
                            'amount'            => $data['amount'][$i],
                            'discount'          => $data['discount'][$i],
                            'discount_type'     => $data['discount_type'][$i],
                            'item_id'           => $data['item_id'][$i],
                            //  'serial'            => $data['serial'][$i],
                            'invoice_id'        => $invoice_id,
                            'tax_id'            => 1,
                            'account_id'        => $data['account_id'][$i],
                            'created_by'        => $user_id,
                            'updated_by'        => $user_id,
                            'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                            'serial'            => $data['serial'][$i],
                            // 'send_master_date'    => isset($data['send_to_master'][$i]) && !empty($data['send_to_master'][$i]) ? date('Y-m-d', strtotime($data['send_to_master'][$i])) : null,
                            // 'receive_master_date'    => isset($data['receive_from_master'][$i]) && !empty($data['receive_from_master'][$i]) ? date('Y-m-d', strtotime($data['send_to_master'][$i])) : null,
                            // 'master_id'            => isset($data['master'][$i]) && !empty($data['master'][$i]) ? $data['master'][$i] : null,
                            // 'additional_note'   => isset($data['additional_note'][$i]) && !empty($data['additional_note'][$i]) ? $data['additional_note'][$i] : null
                        ];
                    }

                    if ($data['discount'][$i] == 1) {
                        $data['discount'][$i]   = ($data['discount'][$i] * $data['quantity'][$i] * 100) / $data['rate'][$i];
                    }

                    $i++;
                }

                if (DB::table('invoice_entries')->insert($invoice_entry)) {
                    if ($request->get('from_measurement') == 1) {
                        $entries = DB::table('invoice_entries')->where('invoice_id', $invoice_id)->get();
                        foreach ($entries as $key => $entry) {
                            $temps = TempInvoiceEntryMeasurement::where('order_number', $request->temp_order_number)->where('serial', $key)->get();
                            foreach ($temps as $temp) {
                                $invoice_entry_measurement = new InvoiceEntryMeasurement;
                                $invoice_entry_measurement->invoice_entries_id = $entry->id;
                                $invoice_entry_measurement->body_measurements_id = $temp->body_measurements_id;
                                $invoice_entry_measurement->value = $temp->value;
                                $invoice_entry_measurement->serial = $temp->serial;
                                $invoice_entry_measurement->save();
                            }
                        }

                        TempInvoiceEntryMeasurement::where('order_number', $request->temp_order_number)->delete();
                    }

                    if ($request->submit) {
                        $status                 = $this->insertManualJournalEntries($data, $invoice_id);
                        $status2                = $helper->updateItemAfterCreatingInvoice($data);

                        //payment
                        if ($request->check_payment && $bank_paid == 1 && $data['payment_amount_bank'] > 0) {

                            $temp_cash_paid                 = $data['payment_amount'];
                            $request['payment_amount']      = $data['payment_amount_bank'];

                            $payment_receive                = $payment->makePaymentReceive($request, $invoice_id);
                            $invoice->payment_recieve_id    = $payment_receive['id'];
                            $invoice->due_amount            = $invoice->due_amount - $data['payment_amount_bank'];
                            $invoice->return_amount         = $data['return_amount'];
                            $invoice->save();

                            $request['payment_amount']        = $temp_cash_paid;
                        }

                        if ($request->check_payment && $cash_paid == 1) {

                            $request['payment_account']       = 3;

                            $payment_receive                = $payment->makePaymentReceive($request, $invoice_id);
                            $invoice->payment_recieve_id    = $payment_receive['id'];
                            $invoice->due_amount            = $invoice->due_amount - $data['payment_amount'];
                            $invoice->return_amount         = $data['return_amount'];
                            $invoice->save();
                        }

                        //Use Credit Entry
                        if (isset($data['customer_credit']) && $data['customer_credit'] > 0) {
                            $available_credit_notes = CreditNote::where('available_credit', '>', 0)->where('customer_id', $invoice->customer_id)->get();
                            $target_amount          = $invoice->due_amount;

                            foreach ($available_credit_notes as $available_credit_note_tmp) {

                                $alloc_amount = 0;

                                if ($target_amount > 0) {

                                    if ($target_amount >= $available_credit_note_tmp['available_credit']) {
                                        $alloc_amount      = $available_credit_note_tmp['available_credit'];
                                    } else {
                                        $alloc_amount      = $target_amount;
                                    }

                                    $available_credit_note_tmp['available_credit'] = $available_credit_note_tmp['available_credit'] - $alloc_amount;
                                    $available_credit_note_tmp->save();

                                    $target_amount = $target_amount - $alloc_amount;

                                    $credit_note_payments                   = new CreditNotePayment;
                                    $credit_note_payments->amount           = $alloc_amount;
                                    $credit_note_payments->invoice_id       = $invoice->id;
                                    $credit_note_payments->credit_note_id   = $available_credit_note_tmp->id;
                                    $credit_note_payments->created_by       = Auth::user()->id;
                                    $credit_note_payments->updated_by       = Auth::user()->id;
                                    $credit_note_payments->save();

                                    $invoice->due_amount                    -= $alloc_amount;
                                    $invoice->update();
                                }
                            }
                        }
                        //Use Credit Entry Ends

                        if (!$status || !$status2) {
                            throw new \Exception("Invoice Failed to add.");
                        }
                    }
                }
            }

            // due table data insert
            // $due_date                   = $request->due_date;
            // $due_amount                 = $invoice->due_amount;
            // $request->payment_amount    = $request->payment_amount + $request->payment_amount_bank;

            // if($due_amount)
            // {
            //     foreach($due_amount as $key => $value)
            //     {
            //         if($value != 0 || ($key == 0 && count($due_amount) == 1 ))
            //         {  
            //             if($key == 0 && count($due_amount) == 1){

            //                 $pay_amount               = !empty($request->payment_amount) ? $request->payment_amount : 0;
            //                 $due_invoice              = new InvoiceDue;
            //                 $due_invoice->invoice_id  = $invoice->id;
            //                 $due_invoice->due_date    = date("Y-m-d", strtotime($due_date[$key]));
            //                 $due_invoice->amount      = $data['total_amount'] - $pay_amount;
            //                 $due_invoice->created_by  = Auth::user()->id;
            //                 $due_invoice->updated_by  = Auth::user()->id;
            //                 $due_invoice->save();

            //             }else if($value > 0 && count($due_amount) != 1){

            //                 $pay_amount               = !empty($request->payment_amount) ? $request->payment_amount : 0;
            //                 $due_invoice              = new InvoiceDue;
            //                 $due_invoice->invoice_id  = $invoice->id;
            //                 $due_invoice->due_date    = date("Y-m-d", strtotime($due_date[$key]));
            //                 $due_invoice->amount      = $value;
            //                 $due_invoice->created_by  = Auth::user()->id;
            //                 $due_invoice->updated_by  = Auth::user()->id;
            //                 $due_invoice->save();

            //             }

            //         }
            //     }
            // }
            DB::commit();

            $has_tailor_product = InvoiceEntry::leftjoin('item', 'item.id', 'invoice_entries.item_id')
                ->leftjoin('item_category', 'item_category.id', 'item.item_category_id')
                ->where('invoice_entries.invoice_id', $invoice->id)
                ->where('item.item_category_id', 3)
                ->selectRaw('item.*')
                ->count();

            // if($has_tailor_product > 0){

            //     return redirect()
            //         ->route('invoice_edit_measurements', ['id' => $invoice->id, 'return_to_invoice' => $invoice->id])
            //         ->with('alert.status', 'success')
            //         ->with('alert.message', 'Invoice Added Successfully!');

            // }

            if (isset($data['from_measurement']) && $data['from_measurement'] == 1) {
                return $invoice;
            }

            $customer_phone = $invoice->customer->phone_number_1 ?? null;
            if ($has_tailor_product == 0 && isset($customer_phone)) {
                (new ICOMBD)->regular($customer_phone);
            }

            return redirect()
                ->route('pos_invoice_show', ['id' => $invoice->id])
                ->with('alert.status', 'success')
                ->with('alert.message', 'Invoice Added Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            if (isset($data['from_measurement']) && $data['from_measurement'] == 1) {
                return false;
            }

            $mesg = $e->getMessage();
            return redirect()
                ->route('pos')
                ->with('alert.status', 'delete')
                ->with('alert.message', " $mesg");
        }
    }

    public function show(Request $request, $id)
    {
        $invoices                           = [];
        $auto_print                         = isset($request->auto_print) ? $request->auto_print : 1;

        try {
            $branch_id      = session('branch_id');

            $this->getBranchUsers($branch_id);

            $invoice                        = Invoice::find($id);
            if (!$invoice) {
                return back()->with('alert.status', 'warning')->with('alert.message', 'Invoice not found!');
            }

            $payment_receive_entries        = PaymentReceiveEntryModel::where('invoice_id', $id)->get();
            $credit_receive_entries         = CreditNotePayment::where('invoice_id', $id)->get();
            $excess_receive_entries         = ExcessPayment::where('invoice_id', $id)->get();
            $invoices                       = Invoice::when(Auth::user()->type != 0, function ($data) {
                return $data->where('invoices.created_by', Auth::user()->id);
            })
                ->orderBy('invoice_date', 'desc')->take(20)->get()->toArray();
            // dd($invoice);
            $sort                           = new sortBydate();


            if ($branch_id == 1) {
                $invoices                   = $sort->get('\App\Models\Moneyin\Invoice', 'invoice_date', 'd-m-Y', $invoices);
            } else {
                $invoices                   = $sort->get('\App\Models\Moneyin\Invoice', 'invoice_date', 'd-m-Y', $invoices);
                $invoices                   = $invoices->whereIn('created_by', $this->targeted_users);
            }

            $invoice_entries                = InvoiceEntry::where('invoice_id', $id)->get();
            $invoice_discount_count         = InvoiceEntry::where([['invoice_id', '=', $id], ['discount', '!=', 0]])->count();

            $sub_total                      = 0;
            $OrganizationProfile            = OrganizationProfile::find(1);
            $due_date                       = DB::table('invoice_due_table')->where('invoice_id', $id)->select('due_date')->first();


            foreach ($invoice_entries as $invoice_entry) {
                $sub_total                  = $sub_total + $invoice_entry->amount;
            }

            $long_lat = Invoice::where('id', $id)->first();
            $lat      = $long_lat->latitude;
            $long     = $long_lat->longitude;

            $has_tailor_product = InvoiceEntry::leftjoin('item', 'item.id', 'invoice_entries.item_id')
                ->leftjoin('item_category', 'item_category.id', 'item.item_category_id')
                ->where('invoice_entries.invoice_id', $invoice->id)
                ->where('item.item_category_id', 3)
                ->selectRaw('item.*')
                ->count();

            // if($has_tailor_product > 0){

            //     return view('invoice::invoice.show_tailor', compact('lat','long','invoice', 'due_date', 'invoice_entries', 'sub_total', 'invoices', 
            //         'payment_receive_entries', 'credit_receive_entries', 'excess_receive_entries', 'OrganizationProfile', 'invoice_discount_count'));

            // }

            $fabrics_due = Invoice::where('customer_id', $invoice->customer_id)->sum('due_amount');

            return view('pos::invoice.show', compact(
                'lat',
                'long',
                'invoice',
                'due_date',
                'invoice_entries',
                'sub_total',
                'invoices',
                'payment_receive_entries',
                'credit_receive_entries',
                'excess_receive_entries',
                'OrganizationProfile',
                'invoice_discount_count',
                'auto_print',
                'fabrics_due'
            ));
        } catch (\Exception $exception) {
            dd($exception);
            return back()->with('alert.status', 'delete')->with('alert.message', 'Invoice not found!');
        }
    }

    public function edit(Request $request, $id)
    {
        $invoice                = Invoice::findOrFail($id);
        $branch_id              = session('branch_id');
        $OrganizationProfile    = OrganizationProfile::find(1);

        $show_all_contact       = OrganizationProfile::first();
        $show_all_contact       = $show_all_contact->show_all_contact;
        $invoice_entry          = InvoiceEntry::where('invoice_id', $id)->get();
        $item_category          = ItemCategory::orderBy('item_category_name', 'ASC')->get();
        $due_balance            = InvoiceDue::where('invoice_id', $id)->get();

        $delivery_persons       = Contact::leftjoin('users', 'users.id', '=', 'contact.created_by')
            ->where('contact_category_id', 3)
            ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                return $query->where('users.branch_id', '=', $branch_id);
            })
            ->get()
            ->sortBy('display_name');

        $account                = Account::all();

        $customers              = Contact::leftjoin('users', 'users.id', '=', 'contact.created_by')
            ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                return $query->where('users.branch_id', '=', $branch_id);
            })
            ->select('contact.*')
            ->get();

        $agents                 = $customers;
        //calculating tax vat in %
        $invoice_shipincaharg   = $invoice->shipping_charge;
        $invoice_adjustment     = $invoice->adjustment;
        $invoice_tax_total      = $invoice->tax_total;
        $invoice_total_amount   = $invoice->total_amount;
        $sub_total              = InvoiceEntry::where('invoice_id', $invoice->id)->sum('amount');

        if ($sub_total + $invoice_adjustment != 0)
            $tax                    = round( $sub_total == 0 ? 0 : (($invoice_tax_total) * 100) / ($sub_total + $invoice_adjustment));
        else $tax = 0;

        $checkAccess = $this->checkIfUserHasAccess($invoice);

        if ($checkAccess == 1) {
            return back();
        }

        if ($OrganizationProfile->show_all_item == 1 || $branch_id == 1) {
            $all_inventories        = Item::all();
        }
        else{
            $all_inventories        = Item::where('branch_id', $branch_id)->get();
        }


        return view('pos::invoice.edit', compact(
            'account',
            'customers',
            'invoice',
            'agents',
            'item_category',
            'invoice_entry',
            'due_balance',
            'delivery_persons',
            'tax',
            'sub_total',
            'all_inventories',
            'OrganizationProfile'
        ));
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
            'account_id'           => 'required'
        ];

        try {

            DB::beginTransaction();

            $data                           = $request->all();
            $invoice                        = Invoice::find($id);

            $cash_paid = 0;
            $bank_paid = 0;

            if (isset($request->payment_amount) && $request->payment_amount > 0) {
                $request->check_payment = 1;
                $cash_paid = 1;
            }

            if (isset($request->payment_amount_bank) && $request->payment_amount_bank > 0 && isset($request->payment_account)) {
                $request->check_payment = 1;
                $bank_paid = 1;
            }

            // if($request->check_payment)
            // {
            //     $validatiolist["payment_account"]       = "required";
            //     $validatiolist["payment_amount"]        = "required||numeric";
            // }

            $total_received_payment         = $invoice->total_amount - $invoice->due_amount;

            if ($data['total_amount'] >= $total_received_payment) {

                $invoice->due_amount        = $data['total_amount'] - $total_received_payment;
            } else {

                return redirect()
                    ->route('pos_invoice_edit', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry! Invoice Total Amount cannot be smaller than Total Received Payment.');
            }

            $user_id                        = Auth::user()->id;

            $helper                         = new \App\Lib\Helpers;
            $helper->updateItemAfterUpdatingInvoice($data);

            if (!isset($data['return_amount'])) {
                $data['return_amount'] = 0;
            }

            if ($data['return_amount'] > 0) {
                $data['payment_amount_bank']    = $data['payment_amount_bank'] > 0 ? $data['payment_amount_bank'] : 0;
                $data['payment_amount']         = $data['total_amount'] - $data['payment_amount_bank'];
                $request['payment_amount']      = $data['payment_amount'];
            }

            //Update
            $created_by                     = $invoice->created_by;
            $created_at                     = $invoice->created_at->toDateTimeString();
            $updated_at                     = \Carbon\Carbon::now()->toDateTimeString();

            if ($request->hasFile('file')) {

                $file                       = $request->file('file');

                if ($invoice->file_url) {
                    $delete_path            = public_path($invoice->file_url);
                    $delete                 = unlink($delete_path);
                }

                $file_name                  = $file->getClientOriginalName();
                $without_extention          = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention             = $file->getClientOriginalExtension();
                $num                        = rand(1, 500);
                $new_file_name              = $data['invoice_number'] . '.' . $file_extention;

                $success                    = $file->move('uploads/invoice', $new_file_name);

                if ($success) {
                    $invoice->file_url      = 'uploads/invoice/' . $new_file_name;
                    $invoice->file_name     = $new_file_name;
                }
            }

            $invoice->invoice_date          = date("Y-m-d", strtotime($data['invoice_date']));
            $invoice->reference             = isset($data['reference']) ? $data['reference'] : '';
            $invoice->customer_note         = $data['customer_note'];
            $invoice->personal_note         = $data['personal_note'];
            $invoice->tax_total             = $data['tax_total'];
            $invoice->shipping_charge       = $data['shipping_charge'];
            $invoice->adjustment            = $data['adjustment'];
            $invoice->adjustment_type       = $data['adjustment_type'];
            $invoice->total_amount          = $data['total_amount'];
            $invoice->fabrics_due           = $data['fabrics_due'];
            $invoice->extra_design_charge   = $data['extra_design_charge'];
            $invoice->item_category_id      = empty($data['item_category_id']) ? null : $data['item_category_id'];
            $invoice->item_sub_category_id  = empty($data['item_sub_category_id']) ? null : $data['item_sub_category_id'];
            $invoice->due_amount            = $data['total_amount'] - $total_received_payment;
            $invoice->delivery_person       = empty($data['delivery_person_id']) ? null : $data['delivery_person_id'];
            $invoice->receive_person        = empty($data['receive_person_id']) ? null : $data['receive_person_id'];
            $invoice->receive_date          = empty($data['receive_date']) ?  null  : date("Y-m-d", strtotime($data['receive_date']));

            $invoice->save                  = null;
            $invoice->customer_id           = $data['customer_id'];
            $invoice->updated_by            = $user_id;
            $invoice->updated_at            = $updated_at;
            $invoice->no_of_installment     = $data['no_of_installment'];
            $invoice->day_interval          = $data['time_interval'];
            $invoice->start_date            = date("Y-m-d", strtotime($data['start_date']));

            $invoice_entry_update               = [];

            if ($invoice->update()) {

                $i = 0;
                $notToDelete = [];

                foreach ($data['item_id'] as $account) {

                    $invoice_entry          = InvoiceEntry::where('invoice_id', $id)
                        ->where('item_id', $data['item_id'][$i])
                        ->where('serial', $data['serial'][$i])
                        ->first();

                    if (!$invoice_entry) {
                        $invoice_entry = new InvoiceEntry;
                        $invoice_entry->quantity = $data['quantity'][$i];
                        $invoice_entry->rate = $data['rate'][$i];
                        $invoice_entry->description = $data['description'][$i];
                        $invoice_entry->amount = $data['amount'][$i];
                        $invoice_entry->item_id = $data['item_id'][$i];
                        $invoice_entry->invoice_id = $id;
                        $invoice_entry->serial = $data['serial'][$i];
                        $invoice_entry->tax_id = 1;
                        $invoice_entry->account_id = $data['account_id'][$i];
                        $invoice_entry->created_by = $created_by;
                        $invoice_entry->updated_by = $user_id;
                        $invoice_entry->created_at = $created_at;
                        $invoice_entry->updated_at = $updated_at;

                        if (!$data['discount'][$i]) {
                            $invoice_entry->discount = 0;
                            $invoice_entry->discount_type = 0;
                        } else {
                            $invoice_entry->discount = $data['discount'][$i];
                            $invoice_entry->discount_type = $data['discount_type'][$i];
                        }

                        $invoice_entry->save();
                        $notToDelete[]          = $invoice_entry->id;
                    } else {
                        $invoice_entry->quantity = $data['quantity'][$i];
                        $invoice_entry->rate = $data['rate'][$i];
                        $invoice_entry->description = $data['description'][$i];
                        $invoice_entry->amount = $data['amount'][$i];
                        $invoice_entry->item_id = $data['item_id'][$i];
                        $invoice_entry->invoice_id = $id;
                        $invoice_entry->serial = $data['serial'][$i];
                        $invoice_entry->tax_id = 1;
                        $invoice_entry->account_id = $data['account_id'][$i];
                        $invoice_entry->updated_by = $user_id;
                        $invoice_entry->updated_at = $updated_at;

                        if (!$data['discount'][$i]) {
                            $invoice_entry->discount = 0;
                            $invoice_entry->discount_type = 0;
                        } else {
                            $invoice_entry->discount = $data['discount'][$i];
                            $invoice_entry->discount_type = $data['discount_type'][$i];
                        }

                        $invoice_entry->save();
                        $notToDelete[]          = $invoice_entry->id;
                    }


                    if ($data['discount_type'][$i] == 1) {
                        $data['discount'][$i]       = $data['discount'][$i];
                    } else {
                        $data['discount'][$i]       = $data['discount'][$i];
                    }

                    $i++;
                }

                // InvoiceEntry::whereNotIn('id', $notToDelete)->delete();

                if (true) {

                    $redirect_to_show = 0;

                    //Payment Receive
                    if ($invoice->total_amount == $invoice->due_amount) {

                        $redirect_to_show = 1;

                        if ($request->check_payment && $bank_paid == 1 && $data['payment_amount_bank'] > 0) {

                            $temp_cash_paid                 = $data['payment_amount'];
                            $request['payment_amount']      = $data['payment_amount_bank'];

                            $invoice_id                     = $invoice['id'];
                            $payment                        =  new Payment();
                            $payment_receive                = $payment->makePaymentReceive($request, $invoice_id);
                            $invoice->payment_recieve_id    = $payment_receive['id'];
                            $invoice->due_amount            = $invoice->due_amount - $data['payment_amount_bank'];
                            $invoice->return_amount         = $data['return_amount'];
                            $invoice->save();

                            $request['payment_amount']      = $temp_cash_paid;
                        }

                        if ($request->check_payment && $cash_paid == 1) {

                            $request['payment_account']     = 3;

                            $invoice_id                     = $invoice['id'];
                            $payment                        =  new Payment();
                            $payment_receive                = $payment->makePaymentReceive($request, $invoice_id);
                            $invoice->payment_recieve_id    = $payment_receive['id'];
                            $invoice->due_amount            = $invoice->due_amount - $data['payment_amount'];
                            $invoice->return_amount         = $data['return_amount'];
                            $invoice->save();
                        }
                    }
                    //Payment Receive Ends

                    //Use Credit Entry
                    if (isset($data['customer_credit']) && $data['customer_credit'] > 0) {
                        $available_credit_notes = CreditNote::where('available_credit', '>', 0)->where('customer_id', $invoice->customer_id)->get();
                        $target_amount          = $invoice->due_amount;

                        foreach ($available_credit_notes as $available_credit_note_tmp) {

                            $alloc_amount = 0;

                            if ($target_amount > 0) {

                                if ($target_amount >= $available_credit_note_tmp['available_credit']) {
                                    $alloc_amount      = $available_credit_note_tmp['available_credit'];
                                } else {
                                    $alloc_amount      = $target_amount;
                                }

                                $available_credit_note_tmp['available_credit'] = $available_credit_note_tmp['available_credit'] - $alloc_amount;
                                $available_credit_note_tmp->save();

                                $target_amount = $target_amount - $alloc_amount;

                                $credit_note_payments                   = new CreditNotePayment;
                                $credit_note_payments->amount           = $alloc_amount;
                                $credit_note_payments->invoice_id       = $invoice->id;
                                $credit_note_payments->credit_note_id   = $available_credit_note_tmp->id;
                                $credit_note_payments->created_by       = Auth::user()->id;
                                $credit_note_payments->updated_by       = Auth::user()->id;
                                $credit_note_payments->save();

                                $invoice->due_amount                    -= $alloc_amount;
                                $invoice->update();
                            }
                        }
                    }
                    //Use Credit Entry Ends

                    $this->updateManualJournalEntries($data, $id);
                    InvoiceDue::where('invoice_id', $id)->delete();

                    // update Due table
                    // $due_date                   = $request->due_date;
                    // $due_amount                 = $request->amount_val;
                    // $request->payment_amount    = $request->payment_amount + $request->payment_amount_bank;

                    // if($due_amount)
                    // {
                    //     foreach($due_amount as $key=>$value)
                    //     {
                    //         if($value !=0 || ($key == 0 && count($due_amount) ==1  ))
                    //         {   

                    //             if($key == 0 && count($due_amount) ==1){

                    //                 $pay_amount               = !empty($request->payment_amount) ? $request->payment_amount : 0;
                    //                 $due_invoice              = new InvoiceDue;
                    //                 $due_invoice->invoice_id  = $invoice->id;
                    //                 $due_invoice->due_date    = date("Y-m-d", strtotime($due_date[$key]));
                    //                 $due_invoice->amount      = $data['total_amount'] - $pay_amount;
                    //                 $due_invoice->created_by  = Auth::user()->id;
                    //                 $due_invoice->updated_by  = Auth::user()->id;
                    //                 $due_invoice->save();

                    //             }elseif($value > 0 && count($due_amount) !=1){

                    //                 $pay_amount               = !empty($request->payment_amount) ? $request->payment_amount : 0;
                    //                 $due_invoice              = new InvoiceDue;
                    //                 $due_invoice->invoice_id  = $invoice->id;
                    //                 $due_invoice->due_date    = date("Y-m-d", strtotime($due_date[$key]));
                    //                 $due_invoice->amount      = $value;
                    //                 $due_invoice->created_by  = Auth::user()->id;
                    //                 $due_invoice->updated_by  = Auth::user()->id;
                    //                 $due_invoice->save();

                    //             }


                    //         }
                    //     }
                    // }

                    DB::commit();

                    if ($redirect_to_show == 1) {
                        return redirect()
                            ->route('pos_invoice_show', ['id' => $id])
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'Invoice Updated Successfully!');
                    }

                    return redirect()
                        ->route('pos')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Invoice Updated Successfully!');
                }
            }

            DB::rollback();

            return redirect()
                ->route('pos_invoice_edit', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something Went Wrong! Please Try Again!');
        } catch (Exception $e) {

            DB::rollback();
            return redirect()
                ->route('pos_invoice_edit', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something Went Wrong! Please Try Again!');
        }
    }

    public function challan($id)
    {
        $branch_id                          = session('branch_id');
        $this->getBranchUsers($branch_id);

        $invoice                            = Invoice::find($id);
        $payment_receive_entries            = PaymentReceiveEntryModel::where('invoice_id', $id)->get();
        $credit_receive_entries             = CreditNotePayment::where('invoice_id', $id)->get();
        $excess_receive_entries             = ExcessPayment::where('invoice_id', $id)->get();

        $invoices                           = Invoice::all();

        if ($branch_id != 1) {
            $invoices                       = $invoices->whereIn('created_by', $this->targeted_users);
        }

        $invoice_entries                    = InvoiceEntry::where('invoice_id', $id)->get();
        $sub_total                          = 0;
        $OrganizationProfile                = OrganizationProfile::find(1);

        foreach ($invoice_entries as $invoice_entry) {
            $sub_total = $sub_total + $invoice_entry->amount;
        }

        return view('invoice::invoice.challan', compact('invoice', 'invoice_entries', 'sub_total', 'invoices', 'payment_receive_entries', 'credit_receive_entries', 'excess_receive_entries', 'OrganizationProfile'));
    }

    public function destroy($id)
    {
        $invoice                = Invoice::findOrFail($id);
        $branch_id              = session('branch_id');
        $OrganizationProfile    = OrganizationProfile::find(1);

        $checkAccess = $this->checkIfUserHasAccess($invoice);

        if ($checkAccess == 1) {
            return back();
        }
        // sock serial table update
        $stock_serial_update            = StockSerial::where('invoice_id', $id)->get();
        foreach ($stock_serial_update as $key => $value) {
            $stock_serial_update                        = StockSerial::find($value['id']);
            $stock_serial_update->stock_status          = 1;
            $stock_serial_update->invoice_id            = null;
            $stock_serial_update->save();
        }
        // delete product transpher tabel data 
        ProductTransfer::where('invoice_id', $id)->delete();

        $helper = new \App\Lib\Helpers;

        //check payment receive is used in this invoice or not
        if ($helper->isPaymentReceiveInThisInvoice($id)) {

            return redirect()
                ->route('pos')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Payment receive used in this invoice. First You have to delete payment receive from this invoice.');
        }

        //check credit note is used in this invoice or not
        if ($helper->isCreditNoteInThisInvoice($id)) {
            return redirect()
                ->route('pos')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Credit note used in this invoice. First You have to delete credit note from this invoice.');
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

            return redirect()
                ->route('pos')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Invoice deleted successfully!!!');
        }
    }

    public function insertManualJournalEntries($data, $invoice_id)
    {

        $user_id                = Auth::user()->id;

        $i                      = 0;
        $discount               = 0;
        $account_array          = array_fill(1, 100, 0);

        foreach ($data['item_id'] as $account) {
            if ($data['discount'][$i] == "") {
            } else {
                $amount         = ceil($data['quantity'][$i] * $data['rate'][$i]);

                if ($data['discount_type'][$i] == 1) {

                    $discount   = $discount + $data['discount'][$i];
                } else {

                    $discount   = $discount + ($data['discount'][$i] * $amount) / 100;
                }
            }

            $account_array[$data['account_id'][$i]] =  $account_array[$data['account_id'][$i]] + ceil($data['quantity'][$i] * $data['rate'][$i]);

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
            $journal_entry->note                = $data['customer_note'];

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
                    'note'              => $data['customer_note'],
                    'debit_credit'      => 0,
                    'amount'            => ceil($account_array[$j]),
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

    public function updateManualJournalEntries($data, $id)
    {

        $invoice_entries_delete = Invoice::find($id)->journalEntries();

        if ($invoice_entries_delete->delete()) {
        }

        $user_id = Auth::user()->id;


        $i = 0;
        $discount = 0;
        $account_array = array_fill(1, 100, 0);

        foreach ($data['item_id'] as $account) {

            if ($data['discount'][$i] == "") {
                $amount = ceil($data['quantity'][$i] * $data['rate'][$i]);
                $discount = $discount + (0 * $amount) / 100;
                $discount1 = ($data['discount'][$i] * $amount) / 100;
            } else {
                $amount = ceil($data['quantity'][$i] * $data['rate'][$i]);

                if ($data['discount_type'][$i] == 1) {
                    $discount = $discount + ($data['discount'][$i] * $data['quantity'][$i]);
                } else {
                    $discount = $discount + ($data['discount'][$i] * $amount) / 100;
                }

                $discount1 = ($data['discount'][$i] * $amount) / 100;
            }

            // $account_array[$data['account_id'][$i]] =  $account_array[$data['account_id'][$i]] + ($data['quantity'][$i]*$data['rate'][$i])-$discount1;
            $account_array[$data['account_id'][$i]] =  $account_array[$data['account_id'][$i]] + ceil($data['quantity'][$i] * $data['rate'][$i]);

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
        $journal_entry->assign_date      = date('Y-m-d', strtotime($data['invoice_date']));

        if ($journal_entry->save()) {
        } else {
            //delete all journal entry for this invoice...
        }

        //insert discount as credit
        if ($discount > 0) {
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
            $journal_entry->assign_date      = date('Y-m-d', strtotime($data['invoice_date']));

            if ($journal_entry->save()) {
            } else {
                //delete all journal entry for this invoice...
            }
        }


        //insert tax total as debit
        if ($data['tax_total'] > 0) {
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
            $journal_entry->assign_date      = date('Y-m-d', strtotime($data['invoice_date']));

            if ($journal_entry->save()) {
            } else {
                //delete all journal entry for this invoice...
            }
        }


        //insert shipping charge as credit
        if ($data['shipping_charge'] > 0) {
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
            $journal_entry->assign_date      = date('Y-m-d', strtotime($data['invoice_date']));

            if ($journal_entry->save()) {
            } else {
                //delete all journal entry for this invoice...
            }
        }


        //insert adjustment as credit
        if ($data['adjustment'] != 0) {
            $journal_entry = new JournalEntry;
            $journal_entry->note            = $data['customer_note'];
            if ($data['adjustment'] > 0) {
                $journal_entry->debit_credit    = 0;
            } else {
                $journal_entry->debit_credit    = 1;
            }
            $journal_entry->amount          = abs($data['adjustment']);
            $journal_entry->account_name_id = 18;
            $journal_entry->jurnal_type     = "invoice";
            $journal_entry->invoice_id      = $invoice_id;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d', strtotime($data['invoice_date']));

            if ($journal_entry->save()) {
            } else {
                //delete all journal entry for this invoice...
            }
        }


        //return $account_array;

        $invoice_entry = [];
        for ($j = 1; $j < count($account_array) - 2; $j++) {
            if ($account_array[$j] != 0) {
                $invoice_entry[] = [
                    'note'              => $data['customer_note'],
                    'debit_credit'      => 0,
                    'amount'            => ceil($account_array[$j]),
                    'account_name_id'   => $j,
                    'jurnal_type'       => 'invoice',
                    'invoice_id'        => $invoice_id,
                    'contact_id'        => $data['customer_id'],
                    'created_by'        => $user_id,
                    'updated_by'        => $user_id,
                    'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    'assign_date'      => date('Y-m-d', strtotime($data['invoice_date'])),
                ];
            }
        }

        if (DB::table('journal_entries')->insert($invoice_entry)) {
            return "successfull...";
        } else {
            //delete all journal entry for this invoice...
        }

        return "error";
    }

    public function useCredit(Request $request)
    {
        $data = $request->all();
        $i = 0;
        foreach ($data['credit_amount'] as $credit_amount) {
            if ($credit_amount) {
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
        for ($i = 0; $i < count($data['credit_amount']); $i++) {
            if (!$data['credit_amount'][$i]) {
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

        if (DB::table('credit_note_payments')->insert($credit_note_payment_entry)) {
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

    public function useExcessPayment(Request $request)
    {
        $data       = $request->all();
        $user_id    = Auth::user()->id;
        $helper     = new \App\Lib\Helpers;

        $i = 0;
        foreach ($data['excess_payment_amount'] as $excess_payment_amount) {
            if ($excess_payment_amount) {
                $helper->updatePaymentReceiveEntryAfterExcessAmountUse($data['invoice_id'], $data['payment_receive_id'][$i], $excess_payment_amount, $user_id);

                $payment_receive                    = PaymentReceives::find($data['payment_receive_id'][$i]);
                $payment_receive->excess_payment    = ($payment_receive['excess_payment'] - $excess_payment_amount);
                $payment_receive->update();

                $invoice                = Invoice::find($data['invoice_id']);
                $invoice->due_amount    = $invoice['due_amount'] - $excess_payment_amount;
                $invoice->update();
            }
            $i++;
        }


        $i = 0;
        foreach ($data['excess_payment_amount'] as $excess_payment_amount) {
            if ($excess_payment_amount) {
                $helper->addOrUpdateJournalEntry($data['invoice_id'], $data['payment_receive_id'][$i], $excess_payment_amount, $user_id);
            }
            $i++;
        }

        return redirect()
            ->route('invoice_show', ['id' => $data['invoice_id']])
            ->with('alert.status', 'success')
            ->with('alert.message', 'Excess notes used successfully!');
    }

    public function download($attachment)
    {
        $download_link = public_path('uploads/invoice/' . $attachment);
        return response()->download($download_link);
    }

    public function checkIfUserHasAccess($invoice)
    {

        $user_branch    = Auth::user()->branch_id;

        if ($invoice->createdBy->branch_id != $user_branch && $user_branch != 1) {
            return 1;
        }
    }

    public function itemCaegory($id)
    {
        $data = ItemSubCategory::where('item_category_id', $id)->get();

        return response($data);
    }

    public function itemList()
    {
        // $data = Item::where('item_sub_category_id',$id)->get();
        $data = Item::orderBy('id', 'DESC')->selectRaw('id, item_name, barcode')->get();

        foreach ($data as $data_tmp) {
            $data_tmp->barcode      = str_pad($data_tmp->id, 6, "0", STR_PAD_LEFT);
            $data_tmp->item_name    = $data_tmp->barcode . ', ' . $data_tmp->item_name;
        }

        return response($data);
    }

    public function itemListStockSerial()
    {
        $data = Item::select('id', 'item_name', 'barcode_no')->get();

        foreach ($data as $data_tmp) {
            $data_tmp->item_name = str_pad($data_tmp->id, '6', '0', STR_PAD_LEFT) . ', ' . $data_tmp->item_name;
        }

        return response($data);
    }

    public function checkSerial($serial)
    {
        $item_id            = 0;
        $item_name          = '';
        $item_serial        = "";
        $item_sales_rate    = 0;
        $message            = "";
        $value              = 0;
        $item_stock         = 0;

        //  $serial_entry       = StockSerial::where('serial', $serial)
        //                                    ->where('invoice_id', null)
        //                                    ->Where(function ($query) {
        //                                         $query->where('stock_status',  1)
        //                                               ->orWhere('stock_status',  10);
        //                                     })
        //                                    ->first();

        $get_item_id        = isset($serial) ? ltrim($serial, '0') : 0;

        if ($get_item_id > 0) {
            $serial_entry   = Item::where('id', $get_item_id)->first();
        }

        if (isset($serial_entry)) {

            $item_id            = $serial_entry->id;
            $item_name          = $serial_entry->item_name;
            $item_sales_rate    = $serial_entry->item_sales_rate > 0 ? $serial_entry->item_sales_rate : 0;
            $item_serial        = $serial;
            $item_stock         = $serial_entry->total_purchases - $serial_entry->total_sales;
            $value              = 1;
        } else {

            $message            = "Serial was not found or already sold. Please try again.";
        }

        return response()->json([
            'item_id'           =>  $item_id,
            'item_name'         =>  $item_name,
            'item_serial'       =>  $item_serial,
            'item_sales_rate'   =>  $item_sales_rate,
            'item_stock'        =>  $item_stock,
            'message'           =>  $message,
            'value'             =>  $value,
        ], 201);
    }

    public function ajaxCreditcheck($id)
    {
        $available_credits = CreditNote::where('customer_id', $id)->sum('available_credit');

        return $available_credits;
    }

    public function itemRate($id)
    {
        $data = Item::where('id', $id)->first();

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

    public function serialId($date, $sr_name, $transfer_type)
    {
        $serial_id            = ProductTransfer::orderBy('serial_id', 'DESC')->select('serial_id')->first();
        $serial_id_duplicate  = ProductTransfer::orderBy('serial_id', 'DESC')
            ->select('serial_id')
            ->where('transfer_type', $transfer_type)
            ->where('date', date('d-m-Y', strtotime($date)))
            ->where('sr_id', $sr_name)
            ->first();
        if (!empty($serial_id_duplicate))
            return   $serial_id_add  = $serial_id['serial_id'];
        if (!empty($serial_id))
            return  $serial_id_add = $serial_id['serial_id'] + 1;
        else
            return $serial_id_add = 1;
    }

    public function measurements()
    {

        $data = InvoiceEntry::leftjoin('invoices', 'invoices.id', 'invoice_entries.invoice_id')
            ->leftjoin('item', 'item.id', 'invoice_entries.item_id')
            ->leftjoin('item_category', 'item_category.id', 'item.item_category_id')
            ->where('item.item_category_id', 3)
            // ->where('invoices.tailoring_order_number', '>', 0)
            ->groupBy('invoices.id')
            ->orderBy('invoices.id', 'DESC')
            ->selectRaw('invoices.*, item.item_name as item_name, invoice_entries.quantity as item_quantity, group_concat(item.item_name) as item_names, group_concat(invoice_entries.quantity) as item_quantities')
            ->get();

        foreach ($data as $invoice) {
            $display_name               = Contact::find($invoice->customer_id);
            $invoice->customer          = $display_name['display_name'];
            $invoice->phone_number_1    = $display_name['phone_number_1'];
        }

        return view('pos::invoice_measurements.index', compact('data'));
    }

    public function showMeasurements($id)
    {
        $invoice            = Invoice::find($id);
        $measurements       = InvoicesMeasurements::where('invoices_id', $id)->orderBy('item_id', 'ASC')->get();
        // $body_measurements  = BodyMeasurements::get();

        // foreach ($body_measurements as $body_measurement) {
        //     $body_measurement->value =  ContactBodyMeasurements::where('body_measurements_id', $body_measurement->id)
        //         ->where('contact_id', $invoice->customer_id)
        //         ->first();
        //     $body_measurement->value =  isset($body_measurement->value) ? $body_measurement->value['value'] : '';
        // }

        $tailoring_products = InvoiceEntry::leftjoin('item', 'item.id', 'invoice_entries.item_id')
            ->leftjoin('item_category', 'item_category.id', 'item.item_category_id')
            ->where('invoice_entries.invoice_id', $id)
            ->where('item.item_category_id', 3)
            ->selectRaw('item.*, invoice_entries.quantity as quantity, invoice_entries.id as invoice_entry_id')
            ->orderBy('item.id', 'ASC')
            ->get();

        foreach ($tailoring_products as $tailoring_product_tmp) {

            $measurement_field_arr          = [];
            $measurement_design_field_arr   = [];
            $measurement_value              = [];
            $measurement_design_value       = [];
            $measurement_fields             = InventoryBodyMeasurements::where('item_id', $tailoring_product_tmp->id)->where('design', 0)->get();
            $measurement_design_fields      = InventoryBodyMeasurements::where('item_id', $tailoring_product_tmp->id)->where('design', 1)->get();

            foreach ($measurement_fields as $measurement_field) {

                $find_measurement       = InvoiceEntryMeasurement::where('invoice_entries_id', $tailoring_product_tmp->invoice_entry_id)
                    ->where('body_measurements_id', $measurement_field->body_measurements_id)
                    ->first();

                $find_measurement_value = isset($find_measurement) ? $find_measurement->value : '';

                $measurement_field_arr[]    = $measurement_field;
                $measurement_value[]        = $find_measurement_value;
            }


            foreach ($measurement_design_fields as $measurement_design_field) {

                $find_measurement       = InvoiceEntryMeasurement::where('invoice_entries_id', $tailoring_product_tmp->invoice_entry_id)
                    ->where('body_measurements_id', $measurement_design_field->body_measurements_id)
                    ->first();

                $find_measurement_value = isset($find_measurement) ? $find_measurement->value : '';

                $measurement_design_field_arr[]    = $measurement_design_field;
                $measurement_design_value[]        = $find_measurement_value;
            }

            $single_measurement         = InvoicesMeasurements::where('invoices_id', $id)
                ->where('item_id', $tailoring_product_tmp->id)
                ->where('raw_material_id', $tailoring_product_tmp->id)
                ->first();

            $tailoring_product_tmp->extra_note                  = isset($single_measurement) ? $single_measurement->note : '';
            $tailoring_product_tmp->measurement_fields          = $measurement_fields;
            $tailoring_product_tmp->measurement_design_fields   = $measurement_design_fields;
            $tailoring_product_tmp->measurement_field           = $measurement_field_arr;
            $tailoring_product_tmp->measurement_design_field    = $measurement_design_field_arr;
            $tailoring_product_tmp->measurement_value_prefix    = preg_replace("/[.0-9]/", "", $measurement_value);
            $tailoring_product_tmp->measurement_value           = $measurement_value;
            $tailoring_product_tmp->measurement_design_value    = $measurement_design_value;
            $tailoring_product_tmp->invoice_master              = Contact::where('id', $tailoring_product_tmp->invoice_master_id)->first();
        }
        // return $tailoring_products;

        // foreach ($tailoring_products as $key => $tailoring_product) {
        //     $measurement_values = [];
        //     foreach ($tailoring_product->measurement_value as $key => $measurement_value) {
        //         $measurement_values[] = preg_replace("/[^0-9]/", "", $measurement_value);
        //     }
        // }

        return view('pos::invoice_measurements.show', compact('invoice', 'measurements', 'tailoring_products'));
    }

    public function getMeasurementValue(Request $request)
    {

        $items                = Item::where('item_category_id', 3)->orderBy('id', 'DESC')->get();

        foreach ($items as $item) {

            $item->name       = $item->item_name;
            $item->item_name  = str_pad($item->id, 6, "0", STR_PAD_LEFT) . ', ' . $item->item_name;

            $item->body_measurements = InventoryBodyMeasurements::where('item_id', $item->id)->orderBy('serial')->get();

            foreach ($item->body_measurements as $key => $body_measurement) {
                $body_measurement = BodyMeasurements::find($body_measurement->body_measurements_id);
                $latest_value = InvoiceEntryMeasurement::where('body_measurements_id', $body_measurement->id)
                    ->join('invoice_entries', 'invoice_entries.id', 'invoice_entries_measurements.invoice_entries_id')
                    ->join('invoices', 'invoices.id', 'invoice_entries.invoice_id')
                    ->where('invoices.customer_id', $request->user_id)
                    ->orderby('invoice_entries_measurements.id', 'DESC')
                    ->first();

                if ($latest_value) $body_measurement->value = $latest_value->value;
                else $body_measurement->value = '';
                $item->body_measurements[$key] = $body_measurement;
            }


            $item->invoice_entries = InvoiceEntry::join('invoices', 'invoices.id', 'invoice_entries.invoice_id')
                ->where('invoice_entries.item_id', $item->id)
                ->where('invoices.customer_id', $request->user_id)
                ->select('invoice_entries.*')
                ->get();

            foreach ($item->invoice_entries as $index => $entry) {
                $measurements = [];
                foreach ($item->body_measurements as $body_measurement) {
                    $measurements[$body_measurement->id] = InvoiceEntryMeasurement::where('body_measurements_id', $body_measurement->id)
                        ->where('invoice_entries_id', $entry->id)
                        ->join('body_measurements', 'body_measurements.id', 'invoice_entries_measurements.body_measurements_id')
                        ->select('body_measurements.en_title', 'invoice_entries_measurements.value')
                        ->first();
                }

                $item->invoice_entries[$index]->measurements = $measurements;
            }
        }

        return $items;
    }

    public function addMeasurements()
    {

        $items              = Item::where('item_category_id', 3)->orderBy('id', 'DESC')->with('inventoryBodyMeasurements')->get();

        $customers          = Contact::orderBy('id', 'DESC')->get();
        $masters            = Contact::where('contact_category_id', 6)->get();

        foreach ($items as $item) {
            $item->name     = $item->item_name;
            $item->item_name = str_pad($item->id, 6, "0", STR_PAD_LEFT) . ', ' . $item->item_name;

            // $item->body_measurements = InventoryBodyMeasurements::where('item_id', $item->id)->orderBy('serial')->get();
            // foreach($item->body_measurements as $key => $body_measurement) {
            //     $body_measurement = BodyMeasurements::find($body_measurement->body_measurements_id);

            //     $item->body_measurements[$key] = $body_measurement;
            // }
        }

        $order_number       = Invoice::where('tailoring_order_number', '>', 0)->orderBy('id', 'DESC')->first();

        if (isset($order_number)) $order_number = $order_number['tailoring_order_number'] + 1;
        else $order_number = 1;

        return view('invoice::invoice_measurements.create', compact('items', 'customers', 'masters', 'order_number'));
    }

    public function addTempMeasurements(Request $request)
    {
        DB::beginTransaction();

        try {
            TempInvoiceEntryMeasurement::where('order_number', $request->order_number)->where('serial', $request->serial)->delete();

            foreach ($request->measurement as $id => $checkbox) {
                if (!empty($request->measurement[$id])) {
                    $temp = new TempInvoiceEntryMeasurement;
                    $temp->order_number = $request->order_number;
                    $temp->serial = $request->serial;
                    $temp->body_measurements_id = $id;
                    $temp->value = $request->measurement[$id];

                    if (
                        !(strlen($request->measurement[$id]) > 0)
                        && isset($request->measurement_checkbox[$id])
                    ) {
                        $temp->value = 'checked';
                    }

                    $temp->save();
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return 'fail';
        }

        return 'success';
    }

    public function updateTempMeasurements(Request $request)
    {
        DB::beginTransaction();

        try {
            $invoice_entry_measurement = InvoiceEntryMeasurement::where('invoice_entries_id', $request->invoice_entries_id)->where('serial', $request->serial)->delete();

            foreach ($request->measurement as $key => $checkbox) {
                if (!empty($request->measurement[$key])) {
                    $invoice_entry_measurement = new InvoiceEntryMeasurement;
                    $invoice_entry_measurement->invoice_entries_id = $request->invoice_entries_id;
                    $invoice_entry_measurement->body_measurements_id = $key;
                    $invoice_entry_measurement->serial = $request->serial;
                    $invoice_entry_measurement->value = $request->measurement[$key];

                    if (
                        !(strlen($request->measurement[$key]) > 0)
                        && isset($request->measurement_checkbox[$key])
                    ) {
                        $invoice_entry_measurement->value = 'checked';
                    }

                    $invoice_entry_measurement->save();
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return 'fail';
        }

        return 'success';
    }

    public function storeMeasurements(Request $request)
    {
        $validatiolist = [
            'customer_id'          => 'required',
        ];

        $order_number       = Invoice::where('tailoring_order_number', $request->order_number)->first();

        if (isset($order_number)) {
            return back()->with('alert.status', 'danger')->with('alert.message', 'Order Number Must be Unique!');
        }

        $this->validate($request, $validatiolist);

        //Generating request for invoice add
        $invoice_request                    = new \Illuminate\Http\Request();

        $total_amount                       = 0;
        $item_id              = [];
        $serial               = [];
        $description          = [];
        $quantity             = [];
        $rate                 = [];
        $discount             = [];
        $discount_type        = [];
        $amount               = [];
        $account_id           = [];
        $stock                = [];
        $due_date             = [];
        $amount_val           = [];
        $send_to_master       = [];
        $receive_from_master  = [];
        $master               = [];
        $additional_note      = [];

        foreach ($request->product as $key => $tmp) {
            $item                    = Item::find($tmp);

            $item_id[]               = $tmp;
            $serial[]                = $key;
            $description[]           = '';
            $quantity[]              = $request->quantity[$key];
            $rate[]                  = $item->item_sales_rate;
            $discount[]              = 0;
            $discount_type[]         = 1;
            $amount[]                = $item->item_sales_rate * $request->quantity[$key];
            $account_id[]            = 16;
            $stock[]                 = '';
            $send_to_master[]        = $request->send_to_master_date[$key];
            $receive_from_master[]   = $request->receive_from_master_date[$key];
            $master[]                = $request->master[$key];
            $additional_note[]       = $request->additional_note[$key];

            $total_amount           += ($item->item_sales_rate * $request->quantity[$key]);
        }

        $due_date[0]               = date('d-m-Y');
        $amount_val[0]             = '';

        $invoice_request->request->add([
            'customer_id'               => $request->customer_id,
            'invoice_date'              => date('d-m-Y'),
            'temp_order_number'         => $request->temp_order_number,
            'order_number'              => $request->order_number,
            'new_item_serial'           => "",
            'from_measurement'          => 1,
            'adjustment'                => 0,
            'shipping_charge'           => 0,
            'payment_amount'            => '',
            'return_amount'             => 0,
            'payment_account'           => 3,
            'submit'                    => 'submit',
            'sub_total'                 => $total_amount,
            'total_amount'              => $total_amount,
            'tax_total'                 => 0,
            'personal_note'             => '',
            'customer_note'             => '',
            'no_of_installment'         => '',
            'time_interval'             => '',
            'start_date'                => date('d-m-Y'),
            'due_date'                  => $due_date,
            'amount_val'                => $amount_val,
            'item_id'                   => $item_id,
            'serial'                    => $serial,
            'description'               => $description,
            'quantity'                  => $quantity,
            'rate'                      => $rate,
            'discount'                  => $discount,
            'discount_type'             => $discount_type,
            'amount'                    => $amount,
            'account_id'                => $account_id,
            'stock'                     => $stock,
            'tailoring_customer_delivery' => $request->delivery_date,
            'send_to_master'            => $send_to_master,
            'receive_from_master'       => $receive_from_master,
            'master'                    => $master,
            'additional_note'           => $additional_note,
            'status'                    => 2
        ]);
        //Generating request for invoice add ends

        $invoice    = $this->store($invoice_request);

        if (isset($invoice->id)) {
            return redirect()->route('invoice_edit', $invoice->id);
        } else {
            return back();
        }
    }

    public function editMeasurements($id, Request $request)
    {

        $invoice            = Invoice::find($id);
        $measurements       = InvoicesMeasurements::where('invoices_id', $id)
            ->orderBy('item_id', 'ASC')
            ->whereColumn('item_id', '!=', 'raw_material_id')
            ->get();

        $invoice_entries = InvoiceEntry::join('item', 'item.id', 'invoice_entries.item_id')
            ->where('invoice_id', $id)
            ->select('invoice_entries.*', 'item.item_name')
            ->get();

        // foreach ($invoice_entries as $key => $entry) {
        //     $entry->body_measurements = InventoryBodyMeasurements::where('item_id', $entry->item_id)->orderBy('serial')->get();
        //     foreach ($entry->body_measurements as $key2 => $body_measurement) {
        //         $body_measurement = BodyMeasurements::find($body_measurement->body_measurements_id);
        //         $latest_value = InvoiceEntryMeasurement::where('body_measurements_id', $body_measurement->id)->where('invoice_entries_id', $entry->id)->where('serial', $key)->first();

        //         if ($latest_value) $body_measurement->value = $latest_value->value;
        //         else $body_measurement->value = '';

        //         $entry->body_measurements[$key2] = $body_measurement;
        //     }
        // }

        // $body_measurements  = BodyMeasurements::orderby('id', 'ASC')->get();

        // foreach ($body_measurements as $body_measurement) {
        //     $body_measurement->value =  ContactBodyMeasurements::where('body_measurements_id', $body_measurement->id)
        //         ->where('contact_id', $invoice->customer_id)
        //         ->first();
        //     $body_measurement->value =  isset($body_measurement->value) ? $body_measurement->value['value'] : '';
        // }

        $tailoring_products = InvoiceEntry::leftjoin('item', 'item.id', 'invoice_entries.item_id')
            ->leftjoin('item_category', 'item_category.id', 'item.item_category_id')
            ->where('invoice_entries.invoice_id', $id)
            ->where('item.item_category_id', 3)
            ->selectRaw('item.*')
            ->orderBy('item.id', 'ASC')
            ->get();

        $required_body_measurements = [];
        $excluded_items             = [];
        foreach ($tailoring_products as $tailoring_product_tmp) {

            $measurement_fields     = InventoryBodyMeasurements::where('item_id', $tailoring_product_tmp->id)->orderBy('body_measurements_id', 'ASC')->get();

            foreach ($measurement_fields as $measurement_field) {
                $required_body_measurements[]   = $measurement_field->body_measurements_id;

                foreach ($body_measurements as $body_measurement) {
                    if ($body_measurement->id == $measurement_field->body_measurements_id) {
                        $body_measurement->item_id      = $tailoring_product_tmp->id;
                        $body_measurement->item_name    = $tailoring_product_tmp->item_name;
                    }
                }
            }

            $extra_note                         = InvoicesMeasurements::where('invoices_id', $id)
                ->where('item_id', $tailoring_product_tmp->id)
                ->where('raw_material_id', $tailoring_product_tmp->id)
                ->first();
            $tailoring_product_tmp->extra_note  = isset($extra_note) ? $extra_note['note'] : '';

            $excluded_items[]                   = $tailoring_product_tmp->id;
        }

        $items              = Item::whereNotIn('id', $excluded_items)->get();
        $return_to_invoice  = isset($request->return_to_invoice) ? $request->return_to_invoice : 0;
        $contacts           = Contact::where('contact_category_id', 6)->get();

        // $body_measurements  = $body_measurements->where('item_id', '>', 0);
        // $body_measurements  = $body_measurements->sortBy('item_id');

        $new_body_measurements = [];
        foreach ($tailoring_products as $tailoring_product_tmp) {
            $tmp_measuremnts            = $body_measurements->where('item_id', $tailoring_product_tmp->id)->sortBy('id');

            foreach ($tmp_measuremnts as $tmp_measuremnts_tmp) {
                $new_body_measurements[] = $tmp_measuremnts_tmp;
            }
        }

        return view('pos::invoice_measurements.edit', compact(
            'invoice',
            'measurements',
            'new_body_measurements',
            'tailoring_products',
            'items',
            'return_to_invoice',
            'required_body_measurements',
            'contacts',
            'invoice_entries'
        ));
    }

    public function updateMeasurements(Request $request)
    {
        $invoice    = Invoice::find($request->invoice_id);
        $customer   = Contact::find($invoice->customer_id);

        if (
            is_null($invoice->tailoring_customer_delivery) ||
            (isset($invoice->tailoring_customer_delivery) && $invoice->tailoring_customer_delivery != date('Y-m-d', strtotime($request->cusotmer_delivery)))
        ) {
            $customer_phone = $invoice->customer->phone_number_1 ?? null;
            if (isset($customer_phone)) {

                $order_number = 'TO-' . $invoice->tailoring_order_number;

                (new ICOMBD)->tailor($customer_phone, date('d M Y', strtotime($request->cusotmer_delivery)), $order_number);
            }
        }

        try {
            DB::beginTransaction();

            foreach ($request->product_id as $i => $value) {
                $invoice_entry = InvoiceEntry::find($i);
                $invoice_entry->send_master_date = isset($request->send_to_master_date[$i]) && !empty($request->send_to_master_date[$i]) ? date('Y-m-d', strtotime($request->send_to_master_date[$i])) : null;
                $invoice_entry->receive_master_date = isset($request->receive_from_master_date[$i]) && !empty($request->receive_from_master_date[$i]) ? date('Y-m-d', strtotime($request->receive_from_master_date[$i])) : null;
                $invoice_entry->master_id = isset($request->master[$i]) && !empty($request->master[$i]) ? $request->master[$i] : null;
                $invoice_entry->additional_note = isset($request->additional_notes[$i]) && !empty($request->additional_notes[$i]) ? $request->additional_notes[$i] : null;
                $invoice_entry->save();
            }

            if (isset($request->measurement)) {
                $body_measurements                      = ContactBodyMeasurements::where('contact_id', $customer->id)->delete();

                foreach ($request->measurement as $key => $single_measurement) {

                    if (strlen($single_measurement) > 0 || isset($request->measurement_checkbox[$key])) {
                        $body_measurements                          = new ContactBodyMeasurements();
                        $body_measurements->contact_id              = $customer->id;
                        $body_measurements->body_measurements_id    = $key;
                        $body_measurements->value                   = $single_measurement;

                        if (!(strlen($single_measurement) > 0) && isset($request->measurement_checkbox[$key])) {
                            $body_measurements->value                 = 'checked';
                        }

                        $body_measurements->created_by              = Auth::user()->id;
                        $body_measurements->updated_by              = Auth::user()->id;
                        $body_measurements->save();
                    }
                }
            }

            $tailoring_products = InvoiceEntry::leftjoin('item', 'item.id', 'invoice_entries.item_id')
                ->leftjoin('item_category', 'item_category.id', 'item.item_category_id')
                ->where('invoice_entries.invoice_id', $invoice->id)
                ->where('item.item_category_id', 3)
                ->selectRaw('item.*')
                ->orderBy('item.id', 'ASC')
                ->get();

            foreach ($tailoring_products as $key => $tailoring_product_tmp) {
                $single_measurement                     = InvoicesMeasurements::where('invoices_id', $invoice->id)
                    ->where('item_id', $tailoring_product_tmp->id)
                    ->where('raw_material_id', $tailoring_product_tmp->id)
                    ->first();
                if (!isset($single_measurement)) {
                    $single_measurement                 = new InvoicesMeasurements();
                }

                $single_measurement->invoices_id        = $invoice->id;
                $single_measurement->item_id            = $tailoring_product_tmp->id;
                $single_measurement->raw_material_id    = $tailoring_product_tmp->id;
                $single_measurement->save();
            }

            DB::commit();

            if (isset($request->return_to_invoice) && $request->return_to_invoice > 0) {

                return redirect()
                    ->route('invoice_edit', ['id' => $request->return_to_invoice])
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Measurements Updated Successfully.');
            } else {

                return redirect()
                    ->route('invoice_measurements')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Measurements Updated Successfully.');
            }
        } catch (Exception $e) {

            DB::rollback();
            return $e->getMessage();
        }
    }

    public function sendMessage($id)
    {
        $invoice = Invoice::find($id);

        DB::beginTransaction();

        try {

            $invoice->update([
                'status' => 1
            ]);

            $items = [];
            foreach ($invoice->invoiceEntries as $key => $entry) {
                if ($entry->item->item_category_id == 3) $items[] = ucwords(strtolower($entry->item->item_name));
            }

            $customer_phone = $invoice->customer->phone_number_1 ?? null;
            if (isset($customer_phone)) {

                $order_number = 'TO-' . $invoice->tailoring_order_number;

                (new ICOMBD)->ready($customer_phone, $items, $order_number);
            }

            DB::commit();
            return redirect()
                ->route('invoice_measurements')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Message Sent to Customer Successfully.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', $e->getMessage());
        }
    }

    public function receiveInvoicePaymentDetails($id)
    {

        $invoice            = Invoice::find($id);
        $available_credits  = CreditNote::where('customer_id', $invoice->customer_id)->sum('available_credit');

        $payable_amount     =  ($invoice->due_amount > $available_credits) ? ($invoice->due_amount - $available_credits) : 0;

        return response()->json([
            'total_invoice_amount'          =>  $invoice->total_amount,
            'due_amount'                    =>  $invoice->due_amount,
            'customer_credit'               =>  $available_credits,
            'payable_amount'                =>  $payable_amount,
        ], 201);
    }

    public function receiveInvoicePayment(Request $request)
    {
        $invoice                        = Invoice::findOrFail($request['due_invoice_id']);

        $invoice_id                     = $invoice->id;

        $request->check_payment         = 1;
        $request['invoice_date']        = date('Y-m-d');
        $request['payment_deposit_details'] = '';
        $request['payment_amount']      = $request['paid_amount'] - $request['return_amount'];
        $request['payment_account']     = $request['account_id'];
        $request['customer_id']         = $invoice->customer_id;

        $data                   = $request->all();

        DB::beginTransaction();

        //payment
        if ($request->paid_amount > 0) {
            $payment                        =  new Payment();
            $payment_receive                = $payment->makePaymentReceive($request, $invoice_id);
            $invoice->due_amount            = $invoice->due_amount - $data['payment_amount'];
            $invoice->return_amount         = $data['return_amount'];
            $invoice->save();
        }

        //Use Credit Entry
        if (isset($data['customer_credit']) && $data['customer_credit'] > 0) {
            $available_credit_notes = CreditNote::where('available_credit', '>', 0)->where('customer_id', $invoice->customer_id)->get();
            $target_amount          = $invoice->due_amount;

            foreach ($available_credit_notes as $available_credit_note_tmp) {

                $alloc_amount = 0;

                if ($target_amount > 0) {

                    if ($target_amount >= $available_credit_note_tmp['available_credit']) {
                        $alloc_amount      = $available_credit_note_tmp['available_credit'];
                    } else {
                        $alloc_amount      = $target_amount;
                    }

                    $available_credit_note_tmp['available_credit'] = $available_credit_note_tmp['available_credit'] - $alloc_amount;
                    $available_credit_note_tmp->save();

                    $target_amount = $target_amount - $alloc_amount;

                    $credit_note_payments                   = new CreditNotePayment;
                    $credit_note_payments->amount           = $alloc_amount;
                    $credit_note_payments->invoice_id       = $invoice->id;
                    $credit_note_payments->credit_note_id   = $available_credit_note_tmp->id;
                    $credit_note_payments->created_by       = Auth::user()->id;
                    $credit_note_payments->updated_by       = Auth::user()->id;
                    $credit_note_payments->save();

                    $invoice->due_amount                    -= $alloc_amount;
                    $invoice->update();
                }
            }
        }
        //Use Credit Entry Ends

        try {
            DB::commit();
            return redirect()
                ->route('pos_invoice_show', ['id' => $invoice->id])
                ->with('alert.status', 'success')
                ->with('alert.message', 'Successfully Received Payment!');
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    }

    public function changeStatus(Request $request, $id)
    {
        Invoice::where('id', $id)->update(['status' => $request->status]);
        return 'Status updated';
    }
}
