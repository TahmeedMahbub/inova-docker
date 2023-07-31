<?php

namespace App\Modules\Invoice\Http\Controllers;

use DB;
use App\User;
use DateTime;
use Carbon\Carbon;
use App\Http\Requests;
use App\Lib\sortBydate;
use App\Lib\TemplateHeader;
use App\Models\Setting\Unit;
use Illuminate\Http\Request;
use App\Models\Branch\Branch;
use App\Models\Contact\Agent;
use App\Models\Inventory\Item;
use App\Models\Contact\Contact;
use App\Models\Inventory\Stock;
use App\Models\Moneyin\Invoice;
use NumberToWords\NumberToWords;
use App\Models\DepoSale\DepoSale;
use App\Models\Moneyin\CreditNote;
use App\Models\Moneyin\InvoiceDue;

use App\Models\Inventory\DepoStock;
use App\Models\VisaStamp\VisaStamp;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

use App\Models\AccountChart\Account;

use App\Models\Moneyin\InvoiceEntry;
use App\Models\MoneyOut\StockSerial;
use App\Models\Recruit\Recruitorder;
use Illuminate\Support\Facades\Auth;
use App\Models\Attributes\Attributes;
use App\Models\ManualJournal\Journal;
use App\Models\Moneyin\ExcessPayment;
use App\Models\Inventory\ItemCategory;
use App\Models\Moneyin\BillOfMaterial;
use App\Models\Inventory\ItemVariation;
use App\Models\Moneyin\PaymentReceives;
use App\Models\Template\HeaderTemplate;
use App\Models\Visa\Ticket\Order\Order;
use App\Models\DepoSale\DepoSaleEntries;

use App\Models\MoneyIn\InvoiceFreeEntry;
use Illuminate\Support\Facades\Redirect;
use App\Models\Inventory\ItemSubCategory;
use App\Models\Inventory\ProductTransfer;
use App\Models\Manpower\Manpower_service;
use App\Models\Moneyin\CreditNotePayment;
use Illuminate\Support\Facades\Validator;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\BillOfMaterialEntry;
use App\Models\DepoSale\DepoSaleFreeEntries;
use App\Models\ManualJournal\JournalEntries;
use App\Modules\Invoice\Http\Response\Payment;
use App\Models\DistributorSale\DistributorSale;
use App\Models\Inventory\ItemAttributeValues;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\OrganizationProfile\OrganizationProfile;
use Attribute;

class InvoiceWebController extends Controller
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
        $branch_id      = session('branch_id');
        $invoice_no     = isset($request->invoice_no) ? $request->invoice_no : 0;
        $invoice_no     = str_pad($invoice_no, 6, 0, STR_PAD_LEFT);
        $customers      = Contact::where('contact_category_id', 1)->get();
        $items          = Item::all();
        $auth_id        = Auth::id();
        $sort           = new sortBydate();

        $this->getBranchUsers($branch_id);

        $branchs        = Branch::orderBy('id', 'asc')->get();
        $invoices       = [];
        $current_time   = Carbon::now()->toDayDateTimeString();
        $start          = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end            = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');

        try {
            if ($branch_id == 1) {
                if ($request->due) {
                    $invoices   = Invoice::where('due_amount', '!=', 0)
                        ->when($invoice_no != 0, function ($query) use ($invoice_no) {
                            return $query->where('invoice_number', $invoice_no);
                        })
                        ->where('invoice_type', 0)
                        ->get();
                } else {
                    $invoices   = Invoice::whereBetween('invoices.invoice_date', [$start, $end])
                        ->when($invoice_no != 0, function ($query) use ($invoice_no) {
                            return $query->where('invoice_number', $invoice_no);
                        })
                        ->where('invoice_type', 0)
                        ->get();
                }
            } else {
                $invoices       = Invoice::select(DB::raw('invoices.*'))
                    ->when($invoice_no != 0, function ($query) use ($invoice_no) {
                        return $query->where('invoice_number', $invoice_no);
                    })
                    ->where('invoice_type', 0)
                    ->whereBetween('invoices.invoice_date', [$start, $end])
                    ->get();
                $invoices       = $invoices->whereIn('created_by', $this->targeted_users);
            }


            return view('invoice::invoice.index', compact('invoices', 'branchs', 'customers', 'items'));
        } catch (\Exception $exception) {
            return view('invoice::invoice.index', compact('invoices', 'branchs', 'customers', 'items'));
        }
    }

    public function search(Request $request)
    {
        $branchs        = Branch::orderBy('id', 'asc')->get();
        $branch_id      = $request->branch_id ? $request->branch_id : session('branch_id');
        $items                  = Item::all();

        $this->getBranchUsers($branch_id);

        if (session('branch_id') == 1) {
            $branch_id  =  $request->branch_id ? $request->branch_id : session('branch_id');
        } else {
            $branch_id  = session('branch_id');
        }

        $from_date              = date('Y-m-d', strtotime($request->from_date));
        $to_date                = date('Y-m-d', strtotime($request->to_date));
        $due_amount_from        = $request->due_amount_from;
        $due_amount_to          = $request->due_amount_to;
        $selected_item_id       = $request->item_id;
        $customers              = Contact::where('contact_category_id', 1)->get();
        $selected_customer_id   = $request->customer_id;

        try {
            if ($branch_id == 1) {
                $invoices   = Invoice::query('item_id', 'invoiceEntries')
                    ->whereBetween('invoices.invoice_date', [$from_date, $to_date])
                    ->where('customer_id', $request->customer_id ? $request->customer_id : '!=', 0)
                    ->where('due_amount', '>=', $due_amount_from == '' ? 0 : $due_amount_from)
                    ->when(count(Invoice::all()) > 0, function ($query) use ($due_amount_to) {
                        return $query->where('due_amount', '<=', $due_amount_to == '' ? Invoice::max('due_amount') : $due_amount_to);
                    })
                    ->get();
            } else {
                $invoices   = Invoice::query('item_id', 'invoiceEntries')
                    ->select(DB::raw('invoices.*'))
                    ->where('customer_id', $request->customer_id ? $request->customer_id : '!=', 0)
                    ->where('due_amount', '>=', $due_amount_from == '' ? 0 : $due_amount_from)
                    ->when(count(Invoice::all()) > 0, function ($query) use ($due_amount_to) {
                        return $query->where('due_amount', '<=', $due_amount_to == '' ? Invoice::max('due_amount') : $due_amount_to);
                    })
                    ->whereBetween('invoices.invoice_date', [$from_date, $to_date])
                    ->get();

                $invoices   = $invoices->whereIn('created_by', $this->targeted_users);
            }

            $invoices       = $invoices->orderBy('invoice_date', 'DESC')->get();

            // $sort           = new sortBydate();
            // $invoices       = $sort->get('\App\Models\Moneyin\Invoice', 'invoice_date', 'd-m-Y', $invoice);

            return view('invoice::invoice.index', compact('invoices', 'branchs', 'branch_id', 'from_date', 'to_date', 'customers', 'items', 'selected_item_id', 'selected_customer_id', 'due_amount_from', 'due_amount_to'));
        } catch (\Exception $exception) {
            return view('invoice::invoice.index', compact('invoices', 'branchs', 'branch_id', 'from_date', 'to_date', 'customers', 'items', 'selected_item_id', 'selected_customer_id', 'due_amount_from', 'due_amount_to'));
        }
    }

    public function create()
    {
        $units = Unit::get();
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

        $branches           = Branch::orderBy('id', 'asc')->get();

        $agents             = $customers;
        $account            = Account::all();
        $accounts           = Account::whereIn('account_type_id', [4, 5])->get();

        $invoices           = Invoice::count();
        $attributes         = Attributes::all();
        $item_variations    = ItemVariation::all();

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

        return view('invoice::invoice.create', compact('units', 'customers', 'invoice_number', 'agents', 'account', 'item_category', 'accounts', 'delivery_persons', 'attributes', 'item_variations', 'branches'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $branch_id      = session('branch_id');

        $validatiolist = [
            'branch_id'                 => 'required',
            'customer_id'               => 'required',
            'invoice_date'              => 'required',
            'item_id.*'                 => 'required',
            'quantity_pcs.*'            => 'required',
            'rate.*'                    => 'required',
            'amount.*'                  => 'required',
            'account_id.*'              => 'required',
            'unit_id.*'                 => 'required',
        ];

        $payment                =  new Payment();


        $this->validate($request, $validatiolist);

        try {

            DB::beginTransaction();

            $data                           = $request->all();
            $user_id                        = Auth::user()->id;
            $helper                         = new \App\Lib\Helpers;
            $check_Item_Quantity            = $helper->checkItemQuantity($data);

            if ($check_Item_Quantity) {
                throw new \Exception("Stock is not available for some item. Please add the invoice again!!!");
            }

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
            $invoice->branch_id             = $data['branch_id'];
            $invoice->invoice_type          = 0; // 0 = Depo Sales
            $invoice->invoice_date          = date('Y-m-d', strtotime($data['invoice_date']));
            $invoice->reference             = $data['reference'] == '' ? null : $data['reference'];
            // $invoice->customer_note         = $data['customer_note'];
            $invoice->personal_note         = $data['personal_note'] == '' ? null : $data['personal_note'];
            $invoice->tax_total             = $data['tax_total'] == '' ? 0 : $data['tax_total'];
            $invoice->shipping_charge       = $data['shipping_charge'] == '' ? 0 : $data['shipping_charge'];
            $invoice->adjustment            = $data['adjustment'] == '' ? 0 : $data['adjustment'];
            $invoice->adjustment_type       = $data['adjustment_type'] == '' ? 0 : $data['adjustment_type'];
            $invoice->total_amount          = $data['total_amount'];
            $invoice->item_category_id      = empty($data['item_category_id']) ? null : $data['item_category_id'];
            $invoice->item_sub_category_id  = empty($data['item_sub_category_id']) ? null : $data['item_sub_category_id'];
            $invoice->due_amount            = $data['total_amount'];
            // $invoice->delivery_person       = empty($data['delivery_person_id']) ? null : $data['delivery_person_id'];
            // $invoice->receive_person        = empty($data['receive_person_id']) ? null : $data['receive_person_id'];
            // $invoice->receive_date          = empty($data['receive_date']) ?  null  : date("Y-m-d", strtotime($data['receive_date']));
            // $invoice->no_of_installment     = $data['no_of_installment'];
            // $invoice->day_interval          = $data['time_interval'];
            // $invoice->start_date            = date('Y-m-d', strtotime($data['start_date']));

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

                foreach ($data['item_id'] as $key => $account) {
                    $unit = Unit::where('id', $data['unit_id'][$key])->select('basic_unit_conversion')->first();
                    $quantity = (float)$data['quantity_pcs'][$key] * $unit->basic_unit_conversion;

                    if (!$data['discount'][$key]) {

                        $invoice_entry[] = [
                            'quantity'          => $quantity,
                            'unit_id'                  => $data['unit_id'][$key],
                            'basic_unit_conversion'     => $unit->basic_unit_conversion,
                            'rate'              => $data['rate'][$key],
                            'rate_type'         => $data['rate_type'][$key],
                            'description'       => $data['description'][$key] == '' ? null : $data['description'][$key],
                            'amount'            => $data['amount'][$key],
                            'discount'          => 0,
                            'serial'            => $data['serial'][$key] == '' ? null : $data['serial'][$key],
                            'discount_type'     => 0,
                            'item_id'           => $data['item_id'][$key],
                            'variation_id'      => empty($data['selected_variation'][$key]) ? null : $data['selected_variation'][$key],
                            'invoice_id'        => $invoice_id,
                            'tax_id'            => 1,
                            'account_id'        => $data['account_id'][$key],
                            'created_by'        => $user_id,
                            'updated_by'        => $user_id,
                            'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        ];
                    } else {


                        $invoice_entry[] = [
                            'quantity'                  => $quantity,
                            'unit_id'                   => $data['unit_id'][$key],
                            'basic_unit_conversion'     => $unit->basic_unit_conversion,
                            'rate'              => $data['rate'][$key],
                            'rate_type'         => $data['rate_type'][$key],
                            'description'       => $data['description'][$key],
                            'amount'            => $data['amount'][$key],
                            'discount'          => $data['discount'][$key],
                            'discount_type'     => $data['discount_type'][$key],
                            'item_id'           => $data['item_id'][$key],
                            'variation_id'      => empty($data['selected_variation'][$key]) == '' ? null : $data['selected_variation'][$key],
                            'serial'            => $data['serial'][$key],
                            'invoice_id'        => $invoice_id,
                            'tax_id'            => 1,
                            'account_id'        => $data['account_id'][$key],
                            'created_by'        => $user_id,
                            'updated_by'        => $user_id,
                            'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        ];
                    }

                    if ($data['discount'][$key] == 1) {
                        $data['discount'][$key]   = ($data['discount'][$key] * $data['quantity'][$key] * 100) / $data['rate'][$key];
                    }
                }

                if (DB::table('invoice_entries')->insert($invoice_entry)) {
                    $invoice_entry = InvoiceEntry::where('invoice_id', $invoice_id)->get();

                    foreach ($invoice_entry as $key => $inv_entry) {
                        $depo_stock = new DepoStock;
                        $depo_stock->invoice_entries_id = $inv_entry->id;
                        $depo_stock->depo_id = $data['customer_id'];
                        $depo_stock->item_id = $inv_entry->item_id;
                        $depo_stock->purchase_quantity = $inv_entry->quantity;
                        $depo_stock->created_by = $user_id;
                        $depo_stock->updated_by = $user_id;
                        $depo_stock->created_at = \Carbon\Carbon::now()->toDateTimeString();
                        $depo_stock->updated_at = \Carbon\Carbon::now()->toDateTimeString();
                        $depo_stock->save();
                    }

                    if ($request->submit) {
                        $status                 = $this->insertManualJournalEntries($data, $invoice_id);
                        $status2                = $helper->updateItemAfterCreatingInvoice($data);

                        //payment
                        if ($request->check_payment) {

                            $payment_receive                = $payment->makePaymentReceive($request, $invoice_id);
                            $invoice->payment_recieve_id    = $payment_receive['id'];
                            $invoice->due_amount            = $invoice->due_amount - $request->payment_amount;
                        }

                        if ($request->check_payment_advance) {

                            $payment_receives = PaymentReceives::where('customer_id', $data['customer_id'])
                                ->where('excess_payment', '>', 0)
                                ->orderBy('payment_date', 'asc')
                                ->get();


                            $payment_amount_advance = $request['payment_amount_advance'];

                            for ($i = 0; $payment_amount_advance > 0; $i++) {
                                $usable_amount = $payment_amount_advance >= $payment_receives[$i]['excess_payment'] ? $payment_receives[$i]['excess_payment'] : $payment_amount_advance;
                                $helper->updatePaymentReceiveEntryAfterExcessAmountUse($invoice_id, $payment_receives[$i]['id'], $usable_amount, $user_id);
                                $payment_receives[$i]['excess_payment']    = ($payment_receives[$i]['excess_payment'] - $usable_amount);
                                $payment_receives[$i]->update();
                                $invoice['due_amount']    = $invoice['due_amount'] - $usable_amount;
                                $helper->addOrUpdateJournalEntry($invoice_id, $payment_receives[$i]['id'], $usable_amount, $user_id);
                                $payment_amount_advance = $payment_amount_advance - $usable_amount;
                            }
                        }

                        if ($request->check_payment_vendor_credit) {

                            $credit_notes = CreditNote::where('customer_id', $data['customer_id'])
                                ->where('available_credit', '>', 0)
                                ->orderBy('credit_note_date', 'asc')
                                ->get();

                            $credit_amount_advance = $request['credit_amount_advance'];

                            $credit_note_payment_entry = [];

                            for ($i = 0; $credit_amount_advance > 0; $i++) {
                                $usable_amount = $credit_amount_advance >= $credit_notes[$i]['available_credit'] ? $credit_notes[$i]['available_credit'] : $credit_amount_advance;
                                $credit_notes[$i]['available_credit']    = ($credit_notes[$i]['available_credit'] - $usable_amount);
                                $credit_notes[$i]->update();
                                $invoice['due_amount']    = $invoice['due_amount'] - $usable_amount;
                                $credit_note_payment_entry[] = [
                                    'amount'            => $usable_amount,
                                    'invoice_id'        => $invoice_id,
                                    'credit_note_id'    => $credit_notes[$i]['id'],
                                    'created_by'        => $user_id,
                                    'updated_by'        => $user_id,
                                    'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                                    'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                                ];
                                $credit_amount_advance = $credit_amount_advance - $usable_amount;
                            }

                            DB::table('credit_note_payments')->insert($credit_note_payment_entry);
                        }

                        $invoice->save();

                        if (!$status || !$status2) {
                            throw new \Exception("Invoice Failed to add.");
                        }
                    }
                }
            }

            // due table data insert
            // $due_date   = $request->due_date;
            // $due_amount = $request->amount_val;

            // if ($due_amount) {
            //     foreach ($due_amount as $key => $value) {
            //         if ($value != 0 || ($key == 0 && count($due_amount) == 1)) {
            //             if ($key == 0 && count($due_amount) == 1) {

            //                 $pay_amount               = !empty($request->payment_amount) ? $request->payment_amount : 0;
            //                 $due_invoice              = new InvoiceDue;
            //                 $due_invoice->invoice_id  = $invoice->id;
            //                 $due_invoice->due_date    = date("Y-m-d", strtotime($due_date[$key]));
            //                 $due_invoice->amount      = $data['total_amount'] - $pay_amount;
            //                 $due_invoice->created_by  = Auth::user()->id;
            //                 $due_invoice->updated_by  = Auth::user()->id;
            //                 $due_invoice->save();
            //             } elseif ($value > 0 && count($due_amount) != 1) {

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
            //update stock_seiral and create product transfer
            foreach ($request->serial as $key => $value) {
                $seria = explode(',', $value);
                if (!empty($value)) {
                    foreach ($seria  as $key2 => $value2) {
                        if ($value2 != '') {
                            $stock_serial                        = StockSerial::where('serial', trim($value2))->first();
                            if ($stock_serial) {
                                $stock_serial                        = StockSerial::find($stock_serial['id']);
                                if ($stock_serial &&  ($stock_serial['stock_status'] == 1 || $stock_serial['stock_status'] == 10)) {
                                    $stock_serial->stock_status          = 2;
                                    $stock_serial->invoice_id            = $invoice->id;
                                    $stock_serial->save();
                                    $serial_id_add                       = $this->serialId(date('d-m-Y', strtotime($data['invoice_date'])), Auth::user()->id, 2);
                                    $product_transfer                    = new ProductTransfer;
                                    $product_transfer->transfer_type     = 2;
                                    $product_transfer->status            = 2;
                                    $product_transfer->serial            = $value2;
                                    $product_transfer->serial_id         = $serial_id_add;
                                    $product_transfer->sr_id             = Auth::user()->id;
                                    $product_transfer->invoice_id        = $invoice->id;
                                    $product_transfer->date              = date('d-m-Y', strtotime($data['invoice_date']));
                                    $product_transfer->save();
                                }
                            }
                        }
                    }
                }
            }
            //End update stock_seiral and crete product transfer   

            if (isset($data['offer_details_id'])) {
                foreach ($data['offer_details_id'] as $key => $value) {
                    $invoice_free_entry = new InvoiceFreeEntry();
                    $invoice_free_entry->invoice_id = $invoice->id;
                    $invoice_free_entry->invoice_entry_id = $invoice_entry[$key]['id'];
                    $invoice_free_entry->offer_id = $value;
                    $invoice_free_entry->free_item_id = $data['free_item_id'][$key];
                    $invoice_free_entry->free_item_variation_id = empty($data['selected_free_variation'][$key]) ? null : $data['selected_free_variation'][$key];
                    $invoice_free_entry->free_item_quantity = $data['free_item_quantity'][$key];
                    $invoice_free_entry->offer_amount = $data['offer_amount'][$key];
                    $invoice_free_entry->offer_amount_type = $data['offer_amount_type'][$key];
                    $invoice_free_entry->created_by = $invoice['created_by'];
                    $invoice_free_entry->updated_by = $user_id;
                    $invoice_free_entry->created_at = $invoice['created_at']->toDateTimeString();
                    $invoice_free_entry->updated_at = \Carbon\Carbon::now()->toDateTimeString();
                    $invoice_free_entry->save();
                }
            }
            DB::commit();

            return redirect()
                ->route('invoice')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Invoice Added Successfully!');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()
                ->route('invoice_create')
                ->with('alert.status', 'delete')
                ->with('alert.message', $e->getMessage());
        }
    }

    public function show($id)
    {
        $invoices                           = [];

        try {
            $branch_id      = session('branch_id');
            $branch         = Branch::find($branch_id);

            $this->getBranchUsers($branch_id);

            $invoice                        = Invoice::with('createdBy')->where('id', $id)->first();

            if (!$invoice) {
                return back()->with('alert.status', 'warning')->with('alert.message', 'Invoice not found!');
            }

            $payment_receive_entries        = PaymentReceiveEntryModel::where('invoice_id', $id)->get();
            $credit_receive_entries         = CreditNotePayment::where('invoice_id', $id)->get();
            $excess_receive_entries         = ExcessPayment::where('invoice_id', $id)->get();
            $invoices                       = Invoice::orderBy('invoice_date', 'desc')->take(20)->get()->toArray();
            $sort                           = new sortBydate();


            if ($branch_id == 1) {
                $invoices                    = $sort->get('\App\Models\Moneyin\Invoice', 'invoice_date', 'd-m-Y', $invoices);
            } else {
                $invoices                   = $sort->get('\App\Models\Moneyin\Invoice', 'invoice_date', 'd-m-Y', $invoices);
                $invoices                   = $invoices->whereIn('created_by', $this->targeted_users);
            }

            $invoice_entries                = InvoiceEntry::where('invoice_id', $id)->get();
            $invoice_discount_count         = InvoiceEntry::where([['invoice_id', '=', $id], ['discount', '!=', 0]])->count();

            $sub_total                      = 0;
            $quantity                       = 0;
            $OrganizationProfile            = OrganizationProfile::find(1);
            $due_date                       = DB::table('invoice_due_table')->where('invoice_id', $id)->select('due_date')->first();


            foreach ($invoice_entries as $invoice_entry) {
                $sub_total                  = $sub_total + $invoice_entry->amount;
                $quantity                   = $quantity + $invoice_entry->quantity;
            }

            $long_lat = Invoice::where('id', $id)->first();
            $lat      = $long_lat->latitude;
            $long     = $long_lat->longitude;

            // $payment_method = Invoice::with('paymentReceives')->where('id', $id)->first();

            // dd($invoice);

            $now_date = Carbon::now();

            return view('invoice::invoice.show', compact('lat', 'long', 'invoice', 'due_date', 'invoice_entries', 'sub_total', 'invoices', 'payment_receive_entries', 'credit_receive_entries', 'excess_receive_entries', 'OrganizationProfile', 'invoice_discount_count', 'quantity', 'branch', 'now_date'));
        } catch (\Exception $exception) {

            return back()->with('alert.status', 'delete')->with('alert.message', 'Invoice not found!');
        }
    }

    public function edit(Request $request, $id)
    {
        $branch_id              = session('branch_id');
        $show_all_contact       = OrganizationProfile::first();
        $op                     = OrganizationProfile::findOrFail(1);
        $show_all_contact       = $show_all_contact->show_all_contact;
        $item_category          = ItemCategory::orderBy('item_category_name', 'ASC')->get();
        $due_balance            = InvoiceDue::where('invoice_id', $id)->get();
        $units = Unit::get();

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
        $invoice                = Invoice::findOrFail($id);

        //calculating tax vat in %
        $invoice_shipincaharg   = $invoice->shipping_charge;
        $invoice_adjustment     = $invoice->adjustment;
        $invoice_tax_total      = $invoice->tax_total;
        $invoice_total_amount   = $invoice->total_amount;
        $sub_total              = $invoice_total_amount - $invoice_shipincaharg - $invoice_tax_total;

        $tax                    = $sub_total == 0 ? 0 : (($invoice_tax_total) * 100) / ($sub_total);

        $checkAccess = $this->checkIfUserHasAccess($invoice);

        $branches = Branch::all();
        $attributes = Attributes::all();
        $item_variations = ItemVariation::all();

        if ($checkAccess == 1) {
            return back();
        }

        return view('invoice::invoice.edit', compact('units', 'account', 'customers', 'invoice', 'agents', 'item_category', 'due_balance', 'delivery_persons', 'tax', 'branches', 'attributes', 'item_variations'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validatiolist = [
            'branch_id'            => 'required',
            'customer_id'          => 'required',
            'invoice_date'         => 'required',
            'item_id.*'            => 'required',
            'quantity_pcs.*'       => 'required',
            'rate.*'               => 'required',
            'amount.*'             => 'required',
            'account_id.*'         => 'required',
            'unit_id.*'         => 'required'
        ];

        try {

            DB::beginTransaction();
            // sock serial table update
            $stock_serial_update            = StockSerial::where('invoice_id', $id)->get();

            foreach ($stock_serial_update as $key => $value) {
                $stock_serial_update                        = StockSerial::find($value['id']);
                $stock_serial_update->stock_status          = 1;
                $stock_serial_update->invoice_id            = null;
                $stock_serial_update->save();
                // delete product transpher tabel data 
            }

            ProductTransfer::where('invoice_id', $id)->delete();

            $data                           = $request->all();
            $invoice                        = Invoice::find($id);

            $total_received_payment         = $invoice->total_amount - $invoice->due_amount;

            if ($data['total_amount'] >= $total_received_payment) {

                $invoice->due_amount        = $data['total_amount'] - $total_received_payment;
            } else {

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

            $invoice->branch_id             = $data['branch_id'];
            $invoice->invoice_date          = date("Y-m-d", strtotime($data['invoice_date']));
            $invoice->reference             = $data['reference'] == '' ? null : $data['reference'];
            // $invoice->customer_note         = $data['customer_note'];
            $invoice->personal_note         = $data['personal_note'] == '' ? null : $data['personal_note'];
            $invoice->tax_total             = $data['tax_total'] == '' ? 0 : $data['tax_total'];
            $invoice->shipping_charge       = $data['shipping_charge'] == '' ? 0 : $data['shipping_charge'];
            $invoice->adjustment            = $data['adjustment'] == '' ? 0 : $data['adjustment'];
            $invoice->adjustment_type       = $data['adjustment_type'] == '' ? 0 : $data['adjustment_type'];
            $invoice->total_amount          = $data['total_amount'];
            $invoice->item_category_id      = empty($data['item_category_id']) ? null : $data['item_category_id'];
            $invoice->item_sub_category_id  = empty($data['item_sub_category_id']) ? null : $data['item_sub_category_id'];
            $invoice->due_amount            = $data['total_amount'] - $total_received_payment;
            // $invoice->delivery_person       = empty($data['delivery_person_id']) ? null : $data['delivery_person_id'];
            // $invoice->receive_person        = empty($data['receive_person_id']) ? null : $data['receive_person_id'];
            // $invoice->receive_date          = empty($data['receive_date']) ?  null  : date("Y-m-d", strtotime($data['receive_date']));
            $invoice->save                  = null;
            $invoice->customer_id           = $data['customer_id'];
            $invoice->updated_by            = $user_id;
            $invoice->updated_at            = $updated_at;
            // $invoice->no_of_installment     = $data['no_of_installment'];
            // $invoice->day_interval          = $data['time_interval'];
            // $invoice->start_date            = date("Y-m-d", strtotime($data['start_date']));

            $invoice_entry_update               = [];

            if ($invoice->update()) {

                $invoice_entry                  = Invoice::find($id)->invoiceEntries();
                $invoice_free_entry             = Invoice::find($id)->invoiceFreeEntries();


                if ($invoice_free_entry->count() > 0 && $invoice_free_entry->delete()) {
                    $invoice_entry->delete();
                } else {
                    $invoice_entry->delete();
                }

                $i = 0;
                // 120
                foreach ($data['item_id'] as $account) {
                    $unit = Unit::where('id', $data['unit_id'][$i])->select('basic_unit_conversion')->first();
                    $quantity = (float)$data['quantity_pcs'][$i] * $unit->basic_unit_conversion;
                    $helper = new \App\Lib\Helpers;

                    if (!$data['discount'][$i]) {

                        $invoice_entry_update[] = [

                            'quantity'          => $quantity,
                            'unit_id'                   => $data['unit_id'][$i],
                            'basic_unit_conversion'     =>  $unit->basic_unit_conversion,
                            'rate'                  => $data['rate'][$i],
                            'rate_type'             => $data['rate_type'][$i],
                            'description'           => $data['description'][$i],
                            'amount'                => $data['amount'][$i],
                            'discount'              => 0,
                            'discount_type'         => 0,
                            'item_id'               => $data['item_id'][$i],
                            'variation_id'          => empty($data['selected_variation'][$i]) ? null : $data['selected_variation'][$i],
                            'invoice_id'            => $id,
                            'serial'                => $data['serial'][$i],
                            'tax_id'                => 1,
                            'account_id'            => $data['account_id'][$i],
                            'created_by'            => $created_by,
                            'updated_by'            => $user_id,
                            'created_at'            => $created_at,
                            'updated_at'            => $updated_at,
                        ];
                    } else {

                        $invoice_entry_update[] = [
                            'quantity'          => $quantity,
                            'unit_id'                   => $data['unit_id'][$i],
                            'basic_unit_conversion'     => $unit->basic_unit_conversion,
                            'rate'                  => $data['rate'][$i],
                            'rate_type'             => $data['rate_type'][$i],
                            'description'           => $data['description'][$i],
                            'amount'                => $data['amount'][$i],
                            'discount'              => $data['discount'][$i],
                            'discount_type'         => $data['discount_type'][$i],
                            'item_id'               => $data['item_id'][$i],
                            'variation_id'          => empty($data['selected_variation'][$i]) ? null : $data['selected_variation'][$i],
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

                    if ($data['discount_type'][$i] == 1) {
                        $data['discount'][$i]       = $data['discount'][$i];
                    } else {
                        $data['discount'][$i]       = $data['discount'][$i];
                    }

                    $i++;
                }

                if (DB::table('invoice_entries')->insert($invoice_entry_update)) {

                    $invoice_entries = Invoice::find($id)->invoiceEntries()->get();

                    foreach ($invoice_entries as $key => $invoice_entry) {
                        $depo_stock = new DepoStock;
                        $depo_stock->invoice_entries_id = $invoice_entry->id;
                        $depo_stock->depo_id = $data['customer_id'];
                        $depo_stock->item_id = $invoice_entry->item_id;
                        $depo_stock->purchase_quantity = $invoice_entry->quantity;
                        $depo_stock->created_by = $user_id;
                        $depo_stock->updated_by = $user_id;
                        $depo_stock->created_at = \Carbon\Carbon::now()->toDateTimeString();
                        $depo_stock->updated_at = \Carbon\Carbon::now()->toDateTimeString();
                        $depo_stock->save();
                    }

                    $this->updateManualJournalEntries($data, $id);
                    InvoiceDue::where('invoice_id', $id)->delete();
                    // update Due table
                    $due_date     = $request->due_date;
                    $due_amount   = $request->amount_val;

                    if ($due_amount) {
                        foreach ($due_amount as $key => $value) {
                            if ($value != 0 || ($key == 0 && count($due_amount) == 1)) {

                                if ($key == 0 && count($due_amount) == 1) {

                                    $pay_amount               = !empty($request->payment_amount) ? $request->payment_amount : 0;
                                    $due_invoice              = new InvoiceDue;
                                    $due_invoice->invoice_id  = $invoice->id;
                                    $due_invoice->due_date    = date("Y-m-d", strtotime($due_date[$key]));
                                    $due_invoice->amount      = $data['total_amount'] - $pay_amount;
                                    $due_invoice->created_by  = Auth::user()->id;
                                    $due_invoice->updated_by  = Auth::user()->id;
                                    $due_invoice->save();
                                } elseif ($value > 0 && count($due_amount) != 1) {

                                    $pay_amount               = !empty($request->payment_amount) ? $request->payment_amount : 0;
                                    $due_invoice              = new InvoiceDue;
                                    $due_invoice->invoice_id  = $invoice->id;
                                    $due_invoice->due_date    = date("Y-m-d", strtotime($due_date[$key]));
                                    $due_invoice->amount      = $value;
                                    $due_invoice->created_by  = Auth::user()->id;
                                    $due_invoice->updated_by  = Auth::user()->id;
                                    $due_invoice->save();
                                }
                            }
                        }
                    }

                    foreach ($request->serial as $key => $value) {
                        $seria = explode(',', $value);
                        if (!empty($value)) {
                            foreach ($seria  as $key2 => $value2) {
                                if ($value2 != '') {
                                    $stock_serial                        = StockSerial::where('serial', trim($value2))->first();
                                    if ($stock_serial) {
                                        $stock_serial                        = StockSerial::find($stock_serial['id']);
                                        if ($stock_serial &&  ($stock_serial['stock_status'] == 1 || $stock_serial['stock_status'] == 10)) {
                                            $stock_serial->stock_status          = 2;
                                            $stock_serial->invoice_id            = $invoice->id;
                                            $stock_serial->save();

                                            $serial_id_add = $this->serialId(date('d-m-Y', strtotime($data['invoice_date'])), Auth::user()->id, 2);

                                            $product_transfer                    = new ProductTransfer;
                                            $product_transfer->transfer_type     = 2;
                                            $product_transfer->status            = 2;
                                            $product_transfer->serial            = $value2;
                                            $product_transfer->serial_id         = $serial_id_add;
                                            $product_transfer->sr_id             = Auth::user()->id;
                                            $product_transfer->invoice_id        = $invoice->id;
                                            $product_transfer->date              = date('d-m-Y', strtotime($data['invoice_date']));
                                            $product_transfer->save();
                                        }
                                    }
                                }
                            }
                        }
                    }

                    if (isset($data['offer_details_id'])) {
                        foreach ($data['offer_details_id'] as $key => $value) {
                            $invoice_free_entry = new InvoiceFreeEntry();
                            $invoice_free_entry->invoice_id = $invoice->id;
                            $invoice_free_entry->invoice_entry_id = $invoice_entries[$key]['id'];
                            $invoice_free_entry->offer_id = $value;
                            $invoice_free_entry->free_item_id = $data['free_item_id'][$key];
                            $invoice_free_entry->free_item_variation_id = empty($data['selected_free_variation'][$key]) ? null : $data['selected_free_variation'][$key];
                            $invoice_free_entry->free_item_quantity = $data['free_item_quantity'][$key];
                            $invoice_free_entry->offer_amount = $data['offer_amount'][$key];
                            $invoice_free_entry->offer_amount_type = $data['offer_amount_type'][$key];
                            $invoice_free_entry->created_by = $invoice['created_by'];
                            $invoice_free_entry->updated_by = $user_id;
                            $invoice_free_entry->created_at = $invoice['created_at']->toDateTimeString();
                            $invoice_free_entry->updated_at = \Carbon\Carbon::now()->toDateTimeString();
                            $invoice_free_entry->save();
                        }
                    }

                    //End update stock_seiral and crete product transfer

                    DB::commit();

                    return redirect()
                        ->route('invoice')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Invoice Updated Successfully!');
                }
            }

            DB::rollback();

            return redirect()
                ->route('invoice_edit', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something Went Wrong! Please Try Again!');
        } catch (Exception $e) {
            dd($e);
            DB::rollback();
            return $e->getMessage();
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
        try {
            $invoice    = Invoice::findOrFail($id);
            $branch_id  = session('branch_id');
            $op         = OrganizationProfile::findOrFail(1);

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
                    ->route('invoice')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Money receive used in this invoice. First You have to delete money receive from this invoice.');
            }

            //check credit note is used in this invoice or not
            if ($helper->isCreditNoteInThisInvoice($id)) {
                return redirect()
                    ->route('invoice')
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

            foreach ($invoice->invoiceEntries as $key => $invoice_entry) {
                if(!empty($invoice_entry->variation_id)){
                    $item_variation = ItemVariation::find($invoice_entry->variation_id);
                    $item_variation->total_sales = $item_variation->total_sales - $invoice_entry->quantity;
                    $item_variation->save();
                }else{
                    $item = Item::find($invoice_entry->item_id);
                    $item->total_sales = $item->total_sales - $invoice_entry->quantity;
                    $item->save();
                }
            }

            if ($invoice) {
                if (count($invoice->invoiceFreeEntries) > 0) {
                    $invoice->invoiceFreeEntries()->delete();
                }
                if ($invoice->invoiceEntries()->delete()) {
                    if ($invoice->delete()) {
                        if ($invoice->file_url) {
                            $delete_path = public_path($invoice->file_url);
                            if (file_exists($delete_path)) {
                                $delete = unlink($delete_path);
                            }
                        }
                    } else {
                        return redirect()
                            ->route('invoice')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'Invoice couldn\'t be deleted');
                    }
                } else {
                    return redirect()
                        ->route('invoice')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Invoice Items couldn\'t be deleted');
                }

                return redirect()
                    ->route('invoice')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Invoice deleted successfully!!!');
            }
        } catch (Exception $e) {
            return dd($e);
        }
    }

    //Depo Sales Start

    public function depoSalesIndex(Request $request)
    {
        $branch_id      = session('branch_id');
        $this->getBranchUsers($branch_id);
        $invoice_no     = isset($request->invoice_no) ? $request->invoice_no : 0;
        $invoice_no     = str_pad($invoice_no, 6, 0, STR_PAD_LEFT);
        $customers      = Contact::where('contact_category_id', 6)->get();
        $items          = Item::all();
        $auth_id        = Auth::id();
        $branchs        = Branch::orderBy('id', 'asc')->get();
        $invoices       = [];
        $current_time   = Carbon::now()->toDayDateTimeString();
        $start          = isset($request->from_date) ? $request->from_date : (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end            = isset($request->to_date) ? $request->to_date : (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
        $customer_id    = isset($request->customer_id) ? $request->customer_id : 0;
        $item_id        = isset($request->item_id) ? $request->item_id : 0;

        try {
            if ($branch_id == 1) {
                $invoices   = DepoSale::whereBetween('depo_sales.sales_date', [$start, $end])
                    ->when($invoice_no != 0, function ($query) use ($invoice_no) {
                        return $query->where('sales_number', $invoice_no);
                    })
                    ->when($request->customer_id != 0, function ($query) use ($customer_id) {
                        return $query->where('seller_id', $customer_id);
                    })
                    ->when($request->item_id != 0, function ($query) use ($item_id) {
                        return $query->whereHas('depo_sales_entries', function ($q) use ($item_id) {
                            $q->where('item_id', $item_id);
                        });
                    })
                    ->get();
            } else {
                $invoices   = DepoSale::select(DB::raw('depo_sales.*'))
                    ->when($invoice_no != 0, function ($query) use ($invoice_no) {
                        return $query->where('sales_number', $invoice_no);
                    })
                    ->when($request->customer_id != 0, function ($query) use ($customer_id) {
                        return $query->where('seller_id', $customer_id);
                    })
                    ->when($request->item_id != 0, function ($query) use ($item_id) {
                        return $query->whereHas('depo_sales_entries', function ($q) use ($item_id) {
                            $q->where('item_id', $item_id);
                        });
                    })
                    ->whereBetween('depo_sales.sales_date', [$start, $end])
                    ->get();
                $invoices       = $invoices->whereIn('created_by', $this->targeted_users);
            }


            return view('invoice::depo_sales.index', compact('invoices', 'branchs', 'customers', 'items'));
        } catch (\Exception $exception) {
            return view('invoice::depo_sales.index', compact('invoices', 'branchs', 'customers', 'items'));
        }
    }

    public function depoSalesCreate()
    {

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
            ->where('contact_category_id', 7)
            ->select('contact.*')
            ->get();

        $depos           = Contact::leftjoin('users', 'users.id', '=', 'contact.created_by')
            ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                return $query->where('users.branch_id', '=', $branch_id);
            })
            ->where('contact_category_id', 6)
            ->select('contact.*')
            ->get();

        $invoices           = DepoSale::count();
        $attributes         = Attributes::all();
        $item_variations    = ItemVariation::all();

        if ($invoices > 0) {
            $invoice        = DepoSale::orderBy('id', 'desc')->first();
            $invoice_number = $invoice['invoice_number'];
            $invoice_number = $invoice_number + 1;
        } else {
            $invoice_number = 1;
        }

        $invoice_number     = str_pad($invoice_number, 6, '0', STR_PAD_LEFT);
        $units = Unit::get();

        return view('invoice::depo_sales.create', compact('units', 'customers', 'invoice_number', 'item_category', 'attributes', 'item_variations', 'depos'));
    }

    public function depoSalesStore(Request $request)
    {
        $branch_id      = session('branch_id');

        $validatiolist = [
            'depo_id'                   => 'required',
            'customer_id'               => 'required',
            'invoice_date'              => 'required',
            'item_id.*'                 => 'required',
            'quantity_pcs.*'            => 'required',
            'unit_id.*'            => 'required',
        ];
        $this->validate($request, $validatiolist);
        try {

            DB::beginTransaction();

            $data                           = $request->all();
            $user_id                        = Auth::user()->id;

            $invoices                       = DepoSale::count();

            if ($invoices > 0) {
                $invoice                    = DepoSale::orderBy('id', 'desc')->first();
                $invoice_number             = $invoice['sales_number'];
                $invoice_number             = $invoice_number + 1;
            } else {
                $invoice_number             = 1;
            }

            $invoice_number = str_pad($invoice_number, 6, '0', STR_PAD_LEFT);

            $invoice                        = new DepoSale;
            $invoice->sales_number          = $invoice_number;
            $invoice->branch_id             = Auth::user()->branch_id;
            $invoice->sales_date            = date('Y-m-d', strtotime($data['invoice_date']));
            $invoice->personal_note         = $data['personal_note'] == '' ? null : $data['personal_note'];
            $invoice->seller_id             = empty($data['depo_id']) ? null : $data['depo_id'];
            $invoice->customer_id           = $data['customer_id'];
            $invoice->created_by            = $user_id;
            $invoice->updated_by            = $user_id;
            $invoice->created_at            = \Carbon\Carbon::now()->toDateTimeString();
            $invoice->updated_at            = \Carbon\Carbon::now()->toDateTimeString();

            if ($request->hasFile('file')) {
                $file                       = $request->file('file');
                $file_name                  = $file->getClientOriginalName();
                $without_extention          = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention             = $file->getClientOriginalExtension();
                $num                        = rand(1, 500);
                $new_file_name              = "depo-sales-" . $invoice_number . '.' . $file_extention;
                $success                    = $file->move('uploads/invoice', $new_file_name);

                if ($success) {
                    $invoice->file_url      = 'uploads/invoice/' . $new_file_name;
                    $invoice->file_name     = $new_file_name;
                }
            }

            if ($invoice->save()) {
                $invoice_id                 = $invoice['id'];

                foreach ($data['item_id'] as $key => $account) {
                    $unit = Unit::where('id', $data['unit_id'][$key])->select('basic_unit_conversion')->first();

                    $helper = new \App\Lib\Helpers;

                    $invoice_entry[] = [
                        'quantity'                  => $helper->unitQuantity($data['quantity_pcs'][$key], $unit->basic_unit_conversion),
                        'unit_id'                   => $data['unit_id'][$key],
                        'basic_unit_conversion'     => $unit->basic_unit_conversion,
                        'description'               => $data['description'][$key],
                        'item_id'                   => $data['item_id'][$key],
                        'variation_id'              => empty($data['selected_variation'][$key]) ? null : $data['selected_variation'][$key],
                        'depo_sales_id'             => $invoice_id,
                        'created_by'                => $user_id,
                        'updated_by'                => $user_id,
                        'created_at'                => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at'                => \Carbon\Carbon::now()->toDateTimeString()
                    ];
                    // dd($unit->basic_unit_conversion) ;
                }
                DB::table('depo_sales_entries')->insert($invoice_entry);
            }
            $invoice_entries = DepoSaleEntries::where('depo_sales_id', $invoice_id)->get();

            if (isset($data['offer_details_id'])) {
                foreach ($data['offer_details_id'] as $key => $value) {
                    $invoice_free_entry = new DepoSaleFreeEntries;
                    $invoice_free_entry->depo_sales_id = $invoice_id;
                    $invoice_free_entry->depo_sales_entries_id = $invoice_entries[$key]['id'];
                    $invoice_free_entry->offer_id = $value;
                    $invoice_free_entry->free_item_id = $data['free_item_id'][$key];
                    $invoice_free_entry->free_item_quantity = $data['free_item_quantity'][$key];
                    $invoice_free_entry->created_by = $invoice['created_by'];
                    $invoice_free_entry->updated_by = $user_id;
                    $invoice_free_entry->created_at = $invoice['created_at']->toDateTimeString();
                    $invoice_free_entry->updated_at = \Carbon\Carbon::now()->toDateTimeString();
                    $invoice_free_entry->save();
                }
            }
            DB::commit();

            return redirect()
                ->route('depo_sales')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Invoice Added Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->route('depo_sales_create')
                ->with('alert.status', 'delete')
                ->with('alert.message', $e->getMessage());
        }
    }

    public function depoSalesEdit(Request $request, $id)
    {
        $branch_id              = session('branch_id');
        $show_all_contact       = OrganizationProfile::first();
        $op                     = OrganizationProfile::findOrFail(1);
        $show_all_contact       = $show_all_contact->show_all_contact;
        $item_category          = ItemCategory::orderBy('item_category_name', 'ASC')->get();
        $units                  = Unit::get();

        $customers       = Contact::leftjoin('users', 'users.id', '=', 'contact.created_by')
            ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                return $query->where('users.branch_id', '=', $branch_id);
            })
            ->where('contact_category_id', 7)
            ->select('contact.*')
            ->get();

        $depos           = Contact::leftjoin('users', 'users.id', '=', 'contact.created_by')
            ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                return $query->where('users.branch_id', '=', $branch_id);
            })
            ->where('contact_category_id', 6)
            ->select('contact.*')
            ->get();

        $invoice         = DepoSale::findOrFail($id);

        $checkAccess = $this->checkIfUserHasAccess($invoice);

        $branches = Branch::all();
        $attributes = Attributes::all();
        $item_variations = ItemVariation::all();

        if ($checkAccess == 1) {
            return back();
        }

        return view('invoice::depo_sales.edit', compact('units', 'customers', 'depos', 'invoice', 'item_category', 'branches', 'attributes', 'item_variations'));
    }

    public function depoSalesUpdate(Request $request, $id)
    {
        $validatiolist = [
            'depo_id'                   => 'required',
            'customer_id'               => 'required',
            'invoice_date'              => 'required',
            'item_id.*'                 => 'required',
            'quantity_pcs.*'            => 'required',
            'unit_id.*'            => 'required',
        ];

        try {

            DB::beginTransaction();

            $data                           = $request->all();
            $invoice                        = DepoSale::find($id);
            $user_id                        = Auth::user()->id;
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

            $invoice->sales_date                = date("Y-m-d", strtotime($data['invoice_date']));
            $invoice->reference                 = $data['reference'];
            $invoice->personal_note             = $data['personal_note'];
            $invoice->customer_id               = $data['customer_id'];
            $invoice->seller_id                 = $data['depo_id'];
            $invoice->updated_by                = $user_id;
            $invoice->updated_at                = $updated_at;

            $invoice_entry_update               = [];

            if ($invoice->update()) {

                $invoice_entries                  = DepoSale::find($id)->depoSaleEntries();

                if ($invoice_entries->delete()) {
                }

                foreach ($data['item_id'] as $key => $account) {
                    $unit = Unit::where('id', $data['unit_id'][$key])->select('basic_unit_conversion')->first();
                    $quantity = (float)$data['quantity_pcs'][$key] * $unit->basic_unit_conversion;
                    $invoice_entry_update[] = [
                        'quantity'          => $quantity,
                        'unit_id'                   => $data['unit_id'][$key],
                        'basic_unit_conversion'     => $unit->basic_unit_conversion,
                        'description'       => $data['description'][$key],
                        'item_id'           => $data['item_id'][$key],
                        'variation_id'      => empty($data['selected_variation'][$key]) ? null : $data['selected_variation'][$key],
                        'depo_sales_id'     => $id,
                        'created_by'        => $user_id,
                        'updated_by'        => $user_id,
                        'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at'        => \Carbon\Carbon::now()->toDateTimeString()
                    ];
                }


                if (DB::table('depo_sales_entries')->insert($invoice_entry_update)) {

                    $invoice_entries = DepoSaleEntries::where('depo_sales_id', $id)->get();

                    if (isset($data['offer_details_id'])) {
                        foreach ($data['offer_details_id'] as $key => $value) {
                            $invoice_free_entry                         = new DepoSaleFreeEntries;
                            $invoice_free_entry->depo_sales_id          = $invoice->id;
                            $invoice_free_entry->depo_sales_entries_id  = $invoice_entries[$key]['id'];
                            $invoice_free_entry->offer_id               = $value;
                            $invoice_free_entry->free_item_id           = $data['free_item_id'][$key];
                            $invoice_free_entry->free_item_quantity     = $data['free_item_quantity'][$key];
                            $invoice_free_entry->created_by             = $invoice['created_by'];
                            $invoice_free_entry->updated_by             = $user_id;
                            $invoice_free_entry->created_at             = $invoice['created_at']->toDateTimeString();
                            $invoice_free_entry->updated_at             = \Carbon\Carbon::now()->toDateTimeString();
                            $invoice_free_entry->save();
                        }
                    }

                    DB::commit();

                    return redirect()
                        ->route('depo_sales')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Invoice Updated Successfully!');
                }
            }

            DB::rollback();

            return redirect()
                ->route('depo_sales_edit', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something Went Wrong! Please Try Again!');
        } catch (Exception $e) {

            DB::rollback();
            return $e->getMessage();
        }
    }

    public function depoSalesDestroy($id)
    {
        try {
            $invoice    = DepoSale::findOrFail($id);
            $checkAccess = $this->checkIfUserHasAccess($invoice);

            if ($checkAccess == 1) {
                return back();
            }

            $helper = new \App\Lib\Helpers;

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
                    ->route('depo_sales')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Invoice deleted successfully!!!');
            }
            return redirect()
                ->route('depo_sales')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Invoice not found!!!');
        } catch (\Exception $e) {
            return redirect()
                ->route('depo_sales')
                ->with('alert.status', 'danger')
                ->with('alert.message', " $e->getMessage() ");
        }
    }

    //Depo Sales End

    //Distributor Sales Start

    public function distributorSalesIndex(Request $request)
    {
        $branch_id          = session('branch_id');
        $this->getBranchUsers($branch_id);
        $invoice_no         = isset($request->invoice_no) ? $request->invoice_no : 0;
        $invoice_no         = str_pad($invoice_no, 6, 0, STR_PAD_LEFT);
        $customers          = Contact::where('contact_category_id', 7)->get();
        $auth_id            = Auth::id();
        $branches            = Branch::orderBy('id', 'asc')->get();
        $invoices           = [];
        $sales_amount_from  = isset($request->sales_amount_from) ? $request->sales_amount_from : 0;
        $sales_amount_to    = isset($request->sales_amount_to) ? $request->sales_amount_to : 0;
        $current_time       = Carbon::now()->toDayDateTimeString();
        $start              = isset($request->from_date) ? $request->from_date : (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end                = isset($request->to_date) ? $request->to_date : (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
        $customer_id        = isset($request->customer_id) ? $request->customer_id : 0;

        try {
            if ($branch_id == 1) {
                $invoices   = DistributorSale::whereBetween('distributor_sales.sales_date', [$start, $end])
                    ->when($invoice_no != 0, function ($query) use ($invoice_no) {
                        return $query->where('sales_number', $invoice_no);
                    })
                    ->when($request->customer_id != 0, function ($query) use ($customer_id) {
                        return $query->where('customer_id', $customer_id);
                    })
                    ->when($request->sales_amount_from != 0, function ($query) use ($sales_amount_from) {
                        return $query->where('total_amount', '>=', $sales_amount_from);
                    })
                    ->when($request->sales_amount_to != 0, function ($query) use ($sales_amount_to) {
                        return $query->where('total_amount', '<=', $sales_amount_to);
                    })
                    ->get();
            } else {
                $invoices       = DistributorSale::select(DB::raw('distributor_sales.*'))
                    ->when($invoice_no != 0, function ($query) use ($invoice_no) {
                        return $query->where('sales_number', $invoice_no);
                    })
                    ->when($request->customer_id != 0, function ($query) use ($customer_id) {
                        return $query->where('customer_id', $customer_id);
                    })
                    ->when($request->sales_amount_from != 0, function ($query) use ($sales_amount_from) {
                        return $query->where('total_amount', '>=', $sales_amount_from);
                    })
                    ->when($request->sales_amount_to != 0, function ($query) use ($sales_amount_to) {
                        return $query->where('total_amount', '<=', $sales_amount_to);
                    })
                    ->whereBetween('distributor_sales.sales_date', [$start, $end])
                    ->get();
                $invoices       = $invoices->whereIn('created_by', $this->targeted_users);
            }


            return view('invoice::distributor_sales.index', compact('invoices', 'branches', 'customers'));
        } catch (\Exception $exception) {
            return view('invoice::distributor_sales.index', compact('invoices', 'branches', 'customers'));
        }
    }

    public function distributorSalesCreate()
    {
        $show_all_contact   = OrganizationProfile::first();
        $show_all_contact   = $show_all_contact->show_all_contact;

        $branch_id          = session('branch_id');
        $customers          = Contact::leftjoin('users', 'users.id', '=', 'contact.created_by')
            ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                return $query->where('users.branch_id', '=', $branch_id);
            })
            ->where('contact_category_id', 8)
            ->select('contact.*')
            ->get();

        $distributors           = Contact::leftjoin('users', 'users.id', '=', 'contact.created_by')
            ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                return $query->where('users.branch_id', '=', $branch_id);
            })
            ->where('contact_category_id', 7)
            ->select('contact.*')
            ->get();

        return view('invoice::distributor_sales.create', compact('customers', 'distributors', 'branch_id'));
    }

    public function distributorSalesStore(Request $request)
    {
        $branch_id      = session('branch_id');

        $validatiolist = [
            'distributor_id'            => 'required',
            'customer_id'               => 'required',
            'invoice_date'              => 'required',
            'amount'                    => 'required|numeric',
            'total_amount'              => 'required|numeric',
        ];
        $this->validate($request, $validatiolist);
        try {
            DB::beginTransaction();

            $invoices                       = DistributorSale::count();

            if ($invoices > 0) {
                $invoice                    = DistributorSale::orderBy('id', 'desc')->first();
                $invoice_number             = $invoice['sales_number'];
                $invoice_number             = $invoice_number + 1;
            } else {
                $invoice_number             = 1;
            }

            $invoice_number = str_pad($invoice_number, 6, '0', STR_PAD_LEFT);

            $invoice                        = new DistributorSale;
            $invoice->sales_number          = $invoice_number;
            $invoice->seller_id             = $request['distributor_id'];
            $invoice->customer_id           = $request['customer_id'];
            $invoice->branch_id             = Auth::user()->branch_id;
            $invoice->sales_date            = date('Y-m-d', strtotime($request['invoice_date']));
            $invoice->reference             = empty($request['reference']) ? null : $request['reference'];
            $invoice->description           = empty($request['description']) ? null : $request['description'];
            $invoice->amount                = $request['amount'];
            $invoice->total_amount          = $request['total_amount'];
            $invoice->adjustment            = empty($request['adjustment']) ? null : $request['adjustment'];
            $invoice->adjustment_type       = $request['adjustment_type'];
            $invoice->shipping_charge       = empty($request['shipping_charge']) ? null : $request['shipping_charge'];
            $invoice->tax_total             = empty($request['tax_total']) ? null : $request['tax_total'];
            $invoice->personal_note         = $request['personal_note'] == '' ? null : $request['personal_note'];
            $invoice->created_by            = Auth::user()->id;
            $invoice->updated_by            = Auth::user()->id;

            if ($request->hasFile('file')) {
                $file                       = $request->file('file');
                $file_name                  = $file->getClientOriginalName();
                $without_extention          = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention             = $file->getClientOriginalExtension();
                $num                        = rand(1, 500);
                $new_file_name              = "distributor-sales-" . $invoice_number . '.' . $file_extention;
                $success                    = $file->move('uploads/invoice', $new_file_name);

                if ($success) {
                    $invoice->file_url      = 'uploads/invoice/' . $new_file_name;
                    $invoice->file_name     = $new_file_name;
                }
            }

            $invoice->save();
            DB::commit();

            return redirect()
                ->route('distributor_sales')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Invoice Added Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->route('distributor_sales_create')
                ->with('alert.status', 'delete')
                ->with('alert.message', $e->getMessage());
        }
    }

    public function distributorSalesEdit(Request $request, $id)
    {
        $branch_id              = session('branch_id');
        $show_all_contact       = OrganizationProfile::first();
        $op                     = OrganizationProfile::findOrFail(1);
        $show_all_contact       = $show_all_contact->show_all_contact;

        $customers       = Contact::leftjoin('users', 'users.id', '=', 'contact.created_by')
            ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                return $query->where('users.branch_id', '=', $branch_id);
            })
            ->where('contact_category_id', 8)
            ->select('contact.*')
            ->get();

        $distributors           = Contact::leftjoin('users', 'users.id', '=', 'contact.created_by')
            ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                return $query->where('users.branch_id', '=', $branch_id);
            })
            ->where('contact_category_id', 7)
            ->select('contact.*')
            ->get();

        $invoice         = DistributorSale::findOrFail($id);

        $checkAccess = $this->checkIfUserHasAccess($invoice);

        if ($checkAccess == 1) {
            return back();
        }

        return view('invoice::distributor_sales.edit', compact('customers', 'distributors', 'invoice'));
    }

    public function distributorSalesUpdate(Request $request, $id)
    {
        $validatiolist = [
            'distributor_id'            => 'required',
            'customer_id'               => 'required',
            'invoice_date'              => 'required',
            'amount'                    => 'required|numeric',
            'total_amount'              => 'required|numeric',
        ];
        $this->validate($request, $validatiolist);

        try {

            DB::beginTransaction();
            $invoice                        = DistributorSale::find($id);
            $user_id                        = Auth::user()->id;

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
                $new_file_name              = $request['invoice_number'] . '.' . $file_extention;

                $success                    = $file->move('uploads/invoice', $new_file_name);

                if ($success) {
                    $invoice->file_url      = 'uploads/invoice/' . $new_file_name;
                    $invoice->file_name     = $new_file_name;
                }
            }


            $invoice->seller_id             = $request['distributor_id'];
            $invoice->customer_id           = $request['customer_id'];
            $invoice->sales_date            = date('Y-m-d', strtotime($request['invoice_date']));
            $invoice->reference             = empty($request['reference']) ? null : $request['reference'];
            $invoice->description           = empty($request['description']) ? null : $request['description'];
            $invoice->amount                = $request['amount'];
            $invoice->total_amount          = $request['total_amount'];
            $invoice->adjustment            = empty($request['adjustment']) ? null : $request['adjustment'];
            $invoice->adjustment_type       = $request['adjustment_type'];
            $invoice->shipping_charge       = empty($request['shipping_charge']) ? null : $request['shipping_charge'];
            $invoice->tax_total             = empty($request['tax_total']) ? null : $request['tax_total'];
            $invoice->personal_note         = $request['personal_note'] == '' ? null : $request['personal_note'];
            $invoice->updated_by            = $user_id;
            $invoice->updated_at            = \Carbon\Carbon::now()->toDateTimeString();

            $invoice->update();

            DB::commit();

            return redirect()
                ->route('distributor_sales')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Invoice Updated Successfully!');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', $e->getMessage());
        }
    }

    public function distributorSalesDestroy($id)
    {
        try {
            $invoice    = DistributorSale::findOrFail($id);
            $checkAccess = $this->checkIfUserHasAccess($invoice);

            if ($checkAccess == 1) {
                return back();
            }

            $helper = new \App\Lib\Helpers;

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
                    ->route('distributor_sales')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Invoice deleted successfully!!!');
            }
            return redirect()
                ->route('distributor_sales')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Invoice not found!!!');
        } catch (\Exception $e) {
            return redirect()
                ->route('distributor_sales')
                ->with('alert.status', 'danger')
                ->with('alert.message', " $e->getMessage() ");
        }
    }

    //Distributor Sales End

    public function insertManualJournalEntries($data, $invoice_id)
    {
        $user_id                = Auth::user()->id;

        $i                      = 0;
        $discount               = 0;
        $account_array          = array_fill(1, 200, 0);

        foreach ($data['item_id'] as $account) {
            if ($data['discount'][$i] == "") {
            } else {
                $amount         = $data['quantity_pcs'][$i] * $data['rate'][$i];

                if ($data['discount_type'][$i] == 1) {

                    $discount   = $discount + $data['discount'][$i];
                } else {

                    $discount   = $discount + ($data['discount'][$i] * $amount) / 100;
                }
            }

            $account_array[$data['account_id'][$i]] =  $account_array[$data['account_id'][$i]] + ($data['quantity_pcs'][$i] * $data['rate'][$i]);

            $i++;
        }

        //return $account_array;
        $invoice_id             = $invoice_id;


        //insert total amount as debit
        $journal_entry                  = new JournalEntry;
        $journal_entry->note            = $data['personal_note'] == "" ? null : $data['personal_note'];
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
            $journal_entry->note            = $data['personal_note'] == "" ? null : $data['personal_note'];
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
            $journal_entry->note            = $data['personal_note'] == "" ? null : $data['personal_note'];
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
            $journal_entry->note            = $data['personal_note'] == "" ? null : $data['personal_note'];
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
            $journal_entry->note                = $data['personal_note'] == "" ? null : $data['personal_note'];

            if ($data['adjustment'] < 0) {
                $journal_entry->debit_credit    = 0;
            } else {
                $journal_entry->debit_credit    = 1;
            }

            $journal_entry->amount              = abs($data['adjustment_type'] == 1 ? $data['adjustment'] : $data['adjustment'] * $data['sub_total'] / 100);
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
                    'note'              => $data['personal_note'] == "" ? null : $data['personal_note'],
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

    public function updateManualJournalEntries($data, $id)
    {

        $invoice_entries_delete = Invoice::find($id)->journalEntries();

        if ($invoice_entries_delete->delete()) {
        }

        $user_id = Auth::user()->id;


        $i = 0;
        $discount = 0;
        $account_array = array_fill(1, 100, 0);

        foreach ($data['item_id'] as $key => $account) {

            $amount = $data['quantity_pcs'][$i] * $data['rate'][$i];
            if ($data['discount'][$i] == "") {
                $discount = $discount + (0 * $amount) / 100;
                $discount1 = ($data['discount'][$i] * $amount) / 100;
            } else {
                if ($data['discount_type'][$i] == 1) {
                    $discount = $discount + ($data['discount'][$i]);
                } else {
                    $discount = $discount + ($data['discount'][$i] * $amount) / 100;
                }

                $discount1 = ($data['discount'][$i] * $amount) / 100;
            }

            // $account_array[$data['account_id'][$i]] =  $account_array[$data['account_id'][$i]] + ($data['quantity'][$i]*$data['rate'][$i])-$discount1;
            $account_array[$data['account_id'][$i]] =  $account_array[$data['account_id'][$i]] + ($data['quantity_pcs'][$i] * $data['rate'][$i]);

            $i++;
        }

        $invoice_id = $id;

        //insert total amount as debit
        $journal_entry = new JournalEntry;
        $journal_entry->note            = $data['personal_note'];
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
            $journal_entry->note            = $data['personal_note'];
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
            $journal_entry->note            = $data['personal_note'];
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
            $journal_entry->note            = $data['personal_note'];
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
            $journal_entry->note            = $data['personal_note'];
            if ($data['adjustment'] < 0) {
                $journal_entry->debit_credit    = 0;
            } else {
                $journal_entry->debit_credit    = 1;
            }
            $journal_entry->amount          = abs($data['adjustment_type'] == 1 ? $data['adjustment'] : $data['adjustment'] * $data['sub_total'] / 100);
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
                    'note'              => $data['personal_note'],
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

    public function itemList(Request $request)
    {
        $branch_id              = session('branch_id');
        $organization_profile   = OrganizationProfile::find(1);

        if ($request->invoice_entry_id) {
            $page = $request->has('page') ? $request->get('page') : 1;
            $take = 10;
            $skip = ($page - 1) * $take;

            if ($request->has('search') && strlen($request->get('search')) > 0) {
                if ($branch_id == 1 || $organization_profile->show_all_item == 1) {
                    $items = Item::where('item_name', 'like', '%' . $request->get('search') . '%')
                        ->orWhere('barcode_no', 'like', '%' . $request->get('search') . '%')
                        ->skip($skip)
                        ->take($take)
                        ->get();
                } elseif ($branch_id != 1 || $organization_profile->show_all_item != 1) {
                    $items = Item::where('item_name', 'like', '%' . $request->get('search') . '%')
                        ->orWhere('barcode_no', 'like', '%' . $request->get('search') . '%')
                        ->where('branch_id', $branch_id)
                        ->skip($skip)
                        ->take($take)
                        ->get();
                }
            } else {
                if ($branch_id == 1 || $organization_profile->show_all_item == 1) {
                    $items = Item::skip($skip)
                        ->take($take)
                        ->get();
                } elseif ($branch_id != 1 || $organization_profile->show_all_item != 1) {
                    $items = Item::where('branch_id', $branch_id)
                        ->skip($skip)
                        ->take($take)
                        ->get();
                }
            }

            $items = array_map(function ($item) {
                return [
                    'id'                    => $item['id'],
                    'text'                  => $item['barcode_no'] . ' , ' . $item['item_name'],
                    'item_name'             => $item['item_name'],
                    'barcode_no'            => $item['barcode_no'],
                    'item_sales_rate'       => $item['item_sales_rate'],
                    'item_purchase_rate'    => $item['item_purchase_rate'],
                    'unit_type'             => $item['unit_type'],
                    'carton_size'           => $item['carton_size'],
                    'item_category_id'      => $item['item_category_id'],
                    'item_sub_category_id'  => $item['item_sub_category_id'],
                ];
            }, $items->toArray());

            $data = [
                'results' => $items,
                'pagination' => [
                    'more' => count($items) == $take,
                ],
            ];

            return response()->json($data);
        }

        if ($branch_id == 1 || $organization_profile->show_all_item == 1) {
            $data = Item::with('itemAttributeValues')->get();
        } elseif ($branch_id != 1 || $organization_profile->show_all_item != 1) {
            $data = Item::where('branch_id', $branch_id)->with('itemAttributeValues')->get();
        }

        // $data = Item::where('item_sub_category_id',$id)->get();

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

        $serial_entry       = StockSerial::where('serial', $serial)
            ->where('invoice_id', null)
            ->Where(function ($query) {
                $query->where('stock_status',  1)
                    ->orWhere('stock_status',  10);
            })
            ->first();

        if ($serial_entry) {

            $item_id            = $serial_entry->item_id;
            $item_sales_rate    = $serial_entry->item->item_sales_rate > 0 ? $serial_entry->item->item_sales_rate : 0;
            $item_serial        = $serial;
            $value              = 1;
        } else {

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

    public function itemRate($id)
    {
        $data = Item::where('id', $id)->with('itemAttributeValues')->first();

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

    public function bom(Request $request)
    {
        $bill_of_materials = BillOfMaterial::all();
        // dd($bill_of_materials);
        return view('invoice::bom.index', compact('bill_of_materials'));
    }

    public function bom_create()
    {
        // $units = Unit::get();
        $items = Item::where('item_category_id', '!=', 5)->with('itemAttributeValues')->get();
        $invoices = Invoice::all();
        $units = Unit::all();
        $attributes = Attributes::all();
        $subcategories = ItemSubcategory::where('item_category_id', 5)->get();

        return view('invoice::bom.create', compact('invoices', 'attributes', 'units', 'subcategories', 'items'));
    }

    public function bom_store(Request $request)
    {
        try{
            DB::beginTransaction();
            $dimensions = [];

            if(!empty($request->dimension))
            {
                foreach($request->dimension as $key => $dimension_value)
                {
                    $dimensions[$request->dimension_attribute[$key]] = $dimension_value;
                }
            }
    
    
            $bill_of_material                   = new BillOfMaterial();
            $bill_of_material->invoice_id       = !empty($request->invoice_id) ? $request->invoice_id : null;
            $bill_of_material->item_id          = $request->product_id;
            $bill_of_material->project_name     = !empty($request->project_name) ? $request->project_name : null;
            $bill_of_material->product_size     = count($dimensions) > 0 ? json_encode($dimensions) : null;
            $bill_of_material->date             = date('Y-m-d', strtotime($request->date));
            $bill_of_material->quantity         = !empty($request->quantity) ? $request->quantity : 1;
            $bill_of_material->cho_percent      = !empty($request->cho_percent) ? $request->cho_percent : 0;
            $bill_of_material->foh_percent      = !empty($request->foh_percent) ? $request->foh_percent : 0;
            $bill_of_material->profit_percent   = !empty($request->profit_percent) ? $request->profit_percent : 0;
            $bill_of_material->design_percent   = !empty($request->design_percent) ? $request->design_percent : 0;
            $bill_of_material->sub_total        = !empty($request->subtotal_inp) ? $request->subtotal_inp : 0;
            $bill_of_material->mrp_percent      = !empty($request->mrp) ? $request->mrp : 0;
            $bill_of_material->vat_percent      = !empty($request->vat) ? $request->vat : 0;
            $bill_of_material->status           = "pending";
            $bill_of_material->trade_total      = !empty($request->trade) ? $request->trade : 0;
            $bill_of_material->created_by       = Auth::user()->id;
            $bill_of_material->updated_by       = Auth::user()->id;
            $bill_of_material->save();
    
            foreach($request->sub_category_id as $key => $sub_category_id){
                foreach($request->item[$key] as $key1 => $item_id){
                    // dd($request->all());
                    BillOfMaterialEntry::create([
                        'bill_of_material_id'   => $bill_of_material->id,
                        'item_id'               => $item_id,
                        'sub_category_id'       => $sub_category_id,
                        'quantity'              => $request->qty[$key][$key1],
                        'wastage_percent'       => !empty($request->wastage[$key][$key1]) ? $request->wastage[$key][$key1] : 0,
                        'unit_id'               => !empty($request->unit[$key][$key1]) ? $request->unit[$key][$key1] : null,
                        'unit_price'            => !empty($request->price[$key][$key1]) ? $request->price[$key][$key1] : 0,
                    ]);
                }
            }
            DB::commit();
            return redirect()
                ->route('bom')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Bill Of Material Added Successfully!');
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something went wrong!');
        }

        // foreach($request->material_id as $key1 => $material_id){
        //     preg_match_all("/\d+/", $material_id, $matches);
        //     $subcategory_id = end($matches[0]);
        //     foreach($request["item"][$material_id] as $key2 => $item_id)
        //     {
        //         $bill_of_material_entry                         = new BillOfMaterialEntry();
        //         $bill_of_material_entry->bill_of_material_id    = $bill_of_material->id;
        //         $bill_of_material_entry->item_id                = $item_id;
        //         $bill_of_material_entry->sub_category_id        = $subcategory_id;
        //         $bill_of_material_entry->quantity               = $request["qty"][$material_id][$key2];
        //         $bill_of_material_entry->wastage_percent        = $request["wastage"][$material_id][$key2];
        //         $bill_of_material_entry->unit_id                = 2;
        //         $bill_of_material_entry->unit_price             = $request["price"][$material_id][$key2];
        //         $bill_of_material_entry->save();
        //     }
        // }
    }

    public function bom_show($id)
    {
        $subcategories              = ItemSubcategory::all();
        // dd($subcategories);
        $bill_of_materials          = BillOfMaterial::all();
        $bill_of_material           = $bill_of_materials->where('id', $id)->first();
        $bill_of_material_entries   = BillOfMaterialEntry::where('bill_of_material_id', $id)->orderBy('sub_category_id', 'ASC')->get();
        $subcategory_ids            = BillOfMaterialEntry::where('bill_of_material_id', $id)->groupBy('sub_category_id')->pluck('sub_category_id')->toArray();
        $OrganizationProfile        = OrganizationProfile::first();



        
        // $subcategory = ItemSubCategory::find($subcategory_id);
        





        // dd($subcategory_ids);

        $max_attr = 0;
        $sub_categories = "";
        $loop = 0;
        foreach($subcategory_ids as $key => $subcategory_id)
        {
            $items = Item::where('item_sub_category_id', $subcategory_id)->with('ItemAttributeValues')->get();
            $measurable_attributes = Attributes::whereHas('AttributeValues', function($query) use($items){
                                        return $query->whereHas('ItemAttributeValues', function($qr) use($items){
                                            return $qr->whereIn('item_id', $items->pluck('id')->toArray())->where('item_attribute_values.measurable', 1)->orderBy('attributes.id');
                                        });
                                    })
                                    ->with('attributeValues')
                                    ->get();
                                    
            if($max_attr < count($measurable_attributes)){
                $max_attr = count($measurable_attributes);
                $max_attributes = $measurable_attributes;
            }

            $measurable_attrs[$subcategory_id] = $measurable_attributes;

            $sub_categories .= ($key == 0 ? "" : " & "). $subcategories->where('id', $subcategory_id)->first()->item_sub_category_name;            
        }
        
        return view('invoice::bom.show', compact('id', 'max_attr', 'max_attributes', 'measurable_attrs', 'bill_of_materials', 'bill_of_material_entries', 'sub_categories', 'OrganizationProfile'));
        
    }

    public function bom_edit($id)
    {
        // FOR THIS BOM
        $bill_of_material = BillOfMaterial::find($id);
        $bill_of_material_entries = BillOfMaterialEntry::where('bill_of_material_id', $id)->get();

        
        //FOR ALL DATA
        $units = Unit::where('id', '!=', 1)->get();
        $products = Item::all();
        $items = Item::where('item_category_id', '!=', 5)->with('itemAttributeValues')->get();
        $invoices = Invoice::all();
        $attributes = Attributes::with('attributeValues')->get();
        $subcategories = ItemSubCategory::where('item_category_id', 5)->get();
        $item_attributes = ItemAttributeValues::where('measurable', 1)->get();

        return view('invoice::bom.edit', compact('id', 'invoices', 'attributes', 'item_attributes', 'subcategories', 'items', 'products', 'units', 'bill_of_material', 'bill_of_material_entries'));
    }

    public function bom_update(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $dimensions = [];
            // dd($request->dimension);
            // foreach($request->dimension as $key => $dimension_value)
            // {
            //     $dimensions[$request->dimension_attribute[$key]] = $dimension_value;
            // }

            $bill_of_material = BillOfMaterial::find($id);
            $bill_of_material->invoice_id       = !empty($request->invoice_id) ? $request->invoice_id : null;
            $bill_of_material->item_id          = $request->product_id;
            $bill_of_material->project_name     = !empty($request->project_name) ? $request->project_name : null;
            $bill_of_material->product_size     = count($dimensions) > 0 ? json_encode($dimensions) : null;
            $bill_of_material->date             = date('Y-m-d', strtotime($request->date));
            $bill_of_material->quantity         = !empty($request->quantity) ? $request->quantity : 1;
            $bill_of_material->cho_percent      = !empty($request->cho_percent) ? $request->cho_percent : 0;
            $bill_of_material->foh_percent      = !empty($request->foh_percent) ? $request->foh_percent : 0;
            $bill_of_material->profit_percent   = !empty($request->profit_percent) ? $request->profit_percent : 0;
            $bill_of_material->design_percent   = !empty($request->design_percent) ? $request->design_percent : 0;
            $bill_of_material->sub_total        = !empty($request->subtotal_inp) ? $request->subtotal_inp : 0;
            $bill_of_material->mrp_percent      = !empty($request->mrp) ? $request->mrp : 0;
            $bill_of_material->vat_percent      = !empty($request->vat) ? $request->vat : 0;
            $bill_of_material->status           = "pending";
            $bill_of_material->trade_total      = !empty($request->trade) ? $request->trade : 0;
            $bill_of_material->created_by       = Auth::user()->id;
            $bill_of_material->updated_by       = Auth::user()->id;
            $bill_of_material->save();
            
            
            $bill_of_material_entries = BillOfMaterialEntry::where('bill_of_material_id', $id)->delete();
    
            foreach($request->sub_category_id as $key => $sub_category_id){
                foreach($request->item[$key] as $key1 => $item_id){
                    // dd($request->all());
                    BillOfMaterialEntry::create([
                        'bill_of_material_id'   => $bill_of_material->id,
                        'item_id'               => $item_id,
                        'sub_category_id'       => $sub_category_id,
                        'quantity'              => $request->qty[$key][$key1],
                        'wastage_percent'       => !empty($request->wastage[$key][$key1]) ? $request->wastage[$key][$key1] : 0,
                        'unit_id'               => !empty($request->unit[$key][$key1]) ? $request->unit[$key][$key1] : null,
                        'unit_price'            => !empty($request->price[$key][$key1]) ? $request->price[$key][$key1] : 0,
                    ]);
                }
            }

            DB::commit();
            return redirect()
                ->route('bom')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Bill Of Material Updated Successfully!');
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something went wrong!');
        }
    }

    public function bom_delete($id)
    {        
        $bill_of_material_entries = BillOfMaterialEntry::where('bill_of_material_id', $id)->delete();
        $bill_of_material = BillOfMaterial::find($id);

        if($bill_of_material->delete())
        {
            return redirect()
            ->route('bom')
            ->with('alert.status', 'success')
            ->with('alert.message', 'Bill of Material deleted successfully!!!');
        }
        else
        {
            return redirect()
            ->route('bom')
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Something Wrong! Bill of Material cannot be deleted.');            
        }
    }
}
