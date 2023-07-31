<?php

namespace App\Modules\Creditnote\Http\Controllers;

use DB;
use Auth;
use App\User;
use DateTime;
use Validator;
use Carbon\Carbon;
use App\Models\Tax;
use App\Http\Requests;

// Models...
use App\Lib\sortBydate;
use App\Models\Setting\Unit;
use Illuminate\Http\Request;
use App\Models\Branch\Branch;
use App\Models\Inventory\Item;
use App\Models\Contact\Contact;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\CreditNote;
use App\Http\Controllers\Controller;
use App\Models\AccountChart\Account;
use App\Models\Attributes\Attributes;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\ItemVariation;
use App\Models\Moneyin\CreditNoteEntry;
use App\Models\Moneyin\CreditNoteRefund;
use App\Models\Moneyin\CreditNotePayment;
use App\Models\ManualJournal\JournalEntry;
use App\Models\OrganizationProfile\OrganizationProfile;

class CreditNoteWebController extends Controller
{
    private   $branch_id              = 0;
    protected $increasing_limit       = null;
    private   $targeted_users         = [];

    public function index()
    {
        $branch_id      = session('branch_id');
        $invoices       = Invoice::all();
        $auth_id        = Auth::id();
        $branchs        = Branch::orderBy('id', 'asc')->get();
        $invoices       = [];
        $credit_notes   = [];

        $current_time   = Carbon::now()->toDayDateTimeString();
        $start          = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end            = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');

        if ($branch_id == 1) {
            $credit_notes = CreditNote::orderBy('credit_note_date', 'desc')
                ->whereBetween('credit_notes.credit_note_date', [$start, $end])
                ->get();
        } else {
            $credit_notes = CreditNote::orderBy('credit_notes.credit_note_date', 'desc')
                ->select(DB::raw('credit_notes.*'))
                ->whereBetween('credit_notes.credit_note_date', [$start, $end])
                ->join('users', 'users.id', '=', 'credit_notes.created_by')
                ->where('users.branch_id', $branch_id)
                ->get();
        }

        $date   = "credit_note_date";
        $sort   = new sortBydate();

        try {

            // $credit_notes   = $sort->get('\App\Models\Moneyin\CreditNote',$date,'Y-m-d',$credit_notes);
            return view('creditnote::creditnote.index', compact('credit_notes', 'invoices', 'branchs'));
        } catch (\Exception $exception) {

            return view('creditnote::creditnote.index', compact('credit_notes', 'invoices', 'branchs'));
        }
    }

    public function search(Request $request)
    {
        $invoices      = Invoice::all();
        $auth_id       = Auth::id();
        $branchs       = Branch::orderBy('id', 'asc')->get();
        $branch_id     = $request->branch_id;
        $from_date     = date('Y-m-d', strtotime($request->from_date));
        $to_date       = date('Y-m-d', strtotime($request->to_date));

        if (session('branch_id') == 1) {
            $branch_id =  $request->branch_id ? $request->branch_id : session('branch_id');
        } else {
            $branch_id = session('branch_id');
        }

        $credit_notes = [];

        if ($branch_id == 1) {
            $credit_notes   = CreditNote::orderBy('credit_note_date', 'desc')
                ->select(DB::raw('credit_notes.*'))
                ->whereBetween('credit_notes.credit_note_date', [$from_date, $to_date])
                ->get();
        } else {
            $credit_notes   = CreditNote::orderBy('credit_note_date', 'desc')
                ->select(DB::raw('credit_notes.*'))
                ->whereBetween('credit_notes.credit_note_date', [$from_date, $to_date])
                ->join('users', 'users.id', '=', 'credit_notes.created_by')
                ->where('branch_id', $branch_id)
                ->get();
        }

        $date   = "credit_note_date";
        $sort   = new sortBydate();

        try {
            // $credit_notes = $sort->get('\App\Models\Moneyin\CreditNote',$date,'Y-m-d',$credit_notes);

            return view('creditnote::creditnote.index', compact('credit_notes', 'invoices', 'branchs', 'branch_id', 'from_date', 'to_date'));
        } catch (\Exception $exception) {

            return view('creditnote::creditnote.index', compact('credit_notes', 'invoices', 'branchs', 'branch_id', 'from_date', 'to_date'));
        }
    }

    public function create()
    {
        $sort                = new sortBydate();
        $invoices            = [];
        $branch_id           = session('branch_id');
        $show_all_contact    = OrganizationProfile::first();
        $show_all_contact    = $show_all_contact->show_all_contact;
        $this->getBranchUsers($branch_id);
        // $customers = Contact::all()->sortBy('display_name');
        $customers          = Contact::leftjoin('users', 'users.id', '=', 'contact.created_by')
            ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                return $query->where('users.branch_id', '=', $branch_id);
            })
            ->select('contact.*')
            ->get();
        $item_category      = ItemCategory::when($branch_id != 1, function ($query) use ($branch_id) {
            return $query->where('branch_id', '=', $branch_id);
        })
            ->orderBy('item_category_name', 'ASC')
            ->get();

        if (count(CreditNote::all()) > 0) {
            $credit_note_number = (int)(CreditNote::all()->last()->credit_note_number) + 1;
        } else {
            $credit_note_number = 1;
        }

        if ($branch_id == 1) {
            $invoices                    = Invoice::all();
        } else {

            $invoices                   = Invoice::whereIn('created_by', $this->targeted_users)->get();
        }
        $credit_note_number = str_pad($credit_note_number, 6, '0', STR_PAD_LEFT);
        $account            = Account::all();
        $accounts           = Account::whereIn('account_type_id', [4, 5])->get();

        $attributes                     = Attributes::all();
        $item_variations                = ItemVariation::all();
        $units = Unit::get();

        return view('creditnote::creditnote.create', compact('units', 'customers', 'credit_note_number', 'invoices', 'item_category', 'account', 'accounts', 'attributes', 'item_variations'));
    }

    public function store(Request $request)
    {
        $branch_id      = session('branch_id');
        $credit_note_data = $request->all();

        DB::beginTransaction();

        if (count(CreditNote::all()) > 0) {
            $credit_note_number = (int)(CreditNote::all()->last()->credit_note_number) + 1;
        } else {
            $credit_note_number = 1;
        }

        $credit_note_number = str_pad($credit_note_number, 6, '0', STR_PAD_LEFT);

        $user_id = Auth::user()->id;

        $credit_note = new CreditNote;
        $credit_note->customer_id            = $credit_note_data['customer_id'];
        $credit_note->invoice_id             = empty($credit_note_data['inv_id']) ? null : $credit_note_data['inv_id'];
        $credit_note->credit_note_number     = $credit_note_number;
        $credit_note->reference              = $credit_note_data['reference'];
        $credit_note->credit_note_date       = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
        $credit_note->shiping_charge         = $credit_note_data['shipping_charge'];
        $credit_note->adjustment             = $credit_note_data['adjustment'];
        $credit_note->total_credit_note      = $credit_note_data['total'];
        $credit_note->available_credit       = $credit_note_data['total'];
        $credit_note->customer_note          = $credit_note_data['customer_note'];
        $credit_note->terms_and_condition    = $credit_note_data['terms_and_condition'];
        $credit_note->tax_total              = $credit_note_data['tax_total'];
        $credit_note->created_by             = $user_id;
        $credit_note->updated_by             = $user_id;

        if ($request->hasFile('file1')) {
            $file = $request->file('file1');
            if ($credit_note->file_url) {
                $delete_path = public_path($credit_note->file_url);
                if (file_exists($delete_path)) {
                    $delete = unlink($delete_path);
                }
            }
            $file_name = $file->getClientOriginalName();
            $without_extention = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention = $file->getClientOriginalExtension();
            $num = rand(1, 500);
            $new_file_name = "creditnote-" . $credit_note_data['credit_note_number'] . '.' . $file_extention;
            $success = $file->move('uploads/creditnote', $new_file_name);
            if ($success) {
                $credit_note->file_url = 'uploads/creditnote/' . $new_file_name;
            } else {
                $credit_note->file_url = null;
            }
        }

        if ($credit_note->save()) {

            $helper = new \App\Lib\Helpers;

            $credit_note_entries_array = [];
            // 120
            $item_id            = $credit_note_data['item_id'];
            $selected_variation = !empty($credit_note_data['selected_variation']) ? $credit_note_data['selected_variation'] : null;
            $description        = $credit_note_data['description'];
            $account_id         = $credit_note_data['account_id'];
            $unit_id            = $credit_note_data['unit_id'];
            $quantity           = $credit_note_data['quantity_pcs'];
            $rate               = $credit_note_data['rate'];
            $discount           = $credit_note_data['discount'];
            $tax_id             = $credit_note_data['tax_id'];
            $amount             = $credit_note_data['amount'];

            // return $account_id;

            $length = count($item_id);

            $credit_note_id = $credit_note->id;

            for ($i = 0; $i < $length; $i++) {
                $helper = new \App\Lib\Helpers;
                $unit = Unit::where('id', $unit_id[$i])->select('basic_unit_conversion')->first();

                $credit_note_entries_array[] = [
                    'item_id'           => $item_id[$i],
                    'variation_id'      => !empty($selected_variation[$i]) ? $selected_variation[$i] : null,
                    'description'       => $description[$i],
                    'account_id'        => $account_id[$i],
                    'quantity'           => $helper->unitQuantity($request->quantity_pcs[$i], $unit->basic_unit_conversion),
                    'unit_id'            => $unit_id[$i],
                    'basic_unit_conversion'  => $unit->basic_unit_conversion,
                    'rate'              => $rate[$i],
                    'discount'          => $discount[$i],
                    'tax_id'            => $tax_id[$i],
                    'amount'            => $amount[$i],
                    'credit_note_id'    => $credit_note_id,
                    'created_by'        => $user_id,
                    'updated_by'        => $user_id,
                    'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at'        => \Carbon\Carbon::now()->toDateTimeString()
                ];
            }

            $save = DB::table('credit_note_entries')->insert($credit_note_entries_array);

            if ($save) {
                $length = count($credit_note_data['discount']);
                $discount = $credit_note_data['discount'];
                $rate = $credit_note_data['rate'];
                $quantity = $credit_note_data['quantity_pcs'];
                $total_amount = 0;
                $total_discount = 0;

                for ($i = 0; $i < $length; $i++) {

                    if ($discount[$i] > 0) {

                        $current_amount = $quantity[$i] * $rate[$i];
                        $discount_value = ($discount[$i] * $current_amount) / 100;

                        $total_discount = $total_discount + $discount_value;
                    }
                }

                $journal_entry = new JournalEntry;
                $journal_entry->amount = $credit_note_data['total'];
                $journal_entry->debit_credit = 0;
                $journal_entry->account_name_id = 5;
                $journal_entry->jurnal_type = 11;
                $journal_entry->credit_note_id = $credit_note_id;
                $journal_entry->contact_id = $credit_note_data['customer_id'];
                $journal_entry->created_by = $user_id;
                $journal_entry->updated_by = $user_id;
                $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                $journal_entry->save();

                if ($credit_note_data['tax_total'] > 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = $credit_note_data['tax_total'];
                    $journal_entry->debit_credit = 1;
                    $journal_entry->account_name_id = 9;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }

                if ($total_discount > 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = $total_discount;
                    $journal_entry->debit_credit = 0;
                    $journal_entry->account_name_id = 21;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }


                if ($credit_note_data['shipping_charge'] > 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = $credit_note_data['shipping_charge'];
                    $journal_entry->debit_credit = 1;
                    $journal_entry->account_name_id = 20;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }

                if ($credit_note_data['adjustment'] > 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = abs($credit_note_data['adjustment']);
                    $journal_entry->debit_credit = 1;
                    $journal_entry->account_name_id = 18;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                } else if ($credit_note_data['adjustment'] < 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = abs($credit_note_data['adjustment']);
                    $journal_entry->debit_credit = 0;
                    $journal_entry->account_name_id = 18;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }

                $length = count($credit_note_data['discount']);
                $rate = $credit_note_data['rate'];
                $quantity = $credit_note_data['quantity_pcs'];
                $account_id = $credit_note_data['account_id'];
                $current_amount = 0;

                for ($i = 0; $i < $length; $i++) {
                    $current_amount = $quantity[$i] * $rate[$i];
                    $current_account_id = $account_id[$i];

                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = $current_amount;
                    $journal_entry->debit_credit = 1;
                    $journal_entry->account_name_id = $current_account_id;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }

                $helper = new \App\Lib\Helpers;
                $status = $helper->updateItemAfterCreatingCreditNote($credit_note_data, $credit_note_id, $user_id);


                //Add Cash Refund
                if ($request->submit == "Refund") {

                    $credit_note                            = $credit_note;
                    $credit_note_refund_data['amount']      = $credit_note->total_credit_note;

                    if ($credit_note_refund_data['amount'] > $credit_note->total_credit_note) {
                        $credit_note_amount = $credit_note->total_credit_note;
                    } else {
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

                    if ($credit_note_refund->save()) {

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
                    ->route('credit_note')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Credit note added successfully!');
            }
        }

        DB::rollback();
    }

    public function show($id)
    {
        $credit_notes   = [];
        $credit_note    = CreditNote::find($id);
        $invoices       = Invoice::all();
        $items          = Item::all();
        $taxes          = Tax::all();
        $branch_id      = session('branch_id');
        $this->getBranchUsers($branch_id);
        if ($branch_id == 1)

            $credit_notes = CreditNote::orderBy('credit_note_date', 'desc')->take(10)->get()->toArray();

        else
            $credit_notes = CreditNote::orderBy('credit_note_date', 'desc')->whereIn('created_by', $this->targeted_users)->take(10)->get()->toArray();

        $date = "credit_note_date";
        $sort = new sortBydate();
        $credit_notes = $sort->get('\App\Models\Moneyin\CreditNote', $date, 'Y-m-d', $credit_notes);


        $credit_note_entries = CreditNoteEntry::where('credit_note_id', $id)->get();
        $sub_total = 0;
        $OrganizationProfile = OrganizationProfile::find(1);
        foreach ($credit_note_entries as $credit_note_entry) {
            $sub_total = $sub_total + $credit_note_entry->amount;
        }

        return view('creditnote::creditnote.show', compact('credit_note', 'invoices', 'credit_notes', 'OrganizationProfile', 'credit_note', 'sub_total', 'credit_note_entries'));
    }

    public function showupload(Request $request, $id = null)
    {
        $credit = CreditNote::find($id);

        $validator = Validator::make($request->all(), [
            'file1' => 'required|max:10240',
        ]);
        if ($validator->fails()) {
            return response("file size not allowed");
        }
        if ($request->hasFile('file1')) {
            $file = $request->file('file1');

            if ($credit->file_url) {
                $delete_path = public_path($credit->file_url);
                if (file_exists($delete_path)) {
                    $delete = unlink($delete_path);
                }
            }

            $file_name = $file->getClientOriginalName();
            $without_extention = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention = $file->getClientOriginalExtension();
            $num = rand(1, 500);
            $new_file_name = "creditnote-" . $credit->credit_note_number . '.' . $file_extention;

            $success = $file->move('uploads/creditnote', $new_file_name);

            if ($success) {
                $credit->file_url = 'uploads/creditnote/' . $new_file_name;


                $credit->save();
                return response("success");
            } else {
                return response("success");
            }
        } else {
            return response("file not found");
        }
    }

    public function edit($id)
    {
        $branch_id           = session('branch_id');
        $credit_note         = CreditNote::findOrFail($id);
        $OrganizationProfile = OrganizationProfile::findOrFail(1);
        $sort                = new sortBydate();
        $invoices            = [];
        $show_all_contact    = OrganizationProfile::first();
        $show_all_contact    = $show_all_contact->show_all_contact;
        $this->getBranchUsers($branch_id);

        // $customers = Contact::all()->sortBy('display_name');

        $customers          = Contact::leftjoin('users', 'users.id', '=', 'contact.created_by')
            ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                return $query->where('users.branch_id', '=', $branch_id);
            })
            ->select('contact.*')
            ->get();

        $item_category      = ItemCategory::when($branch_id != 1, function ($query) use ($branch_id) {
            return $query->where('branch_id', '=', $branch_id);
        })
            ->orderBy('item_category_name', 'ASC')
            ->get();

        $credit_note_entry          = CreditNoteEntry::where('credit_note_id', $id)->with('item')->get();
        $account                    = Account::all();
        $credit_note_shipincaharg   = $credit_note->shiping_charge;
        $credit_note_adjustment     = $credit_note->adjustment;
        $credit_note_tax_total      = $credit_note->tax_total;
        $credit_note_total_amount   = $credit_note->total_credit_note;
        $sub_total                  = $credit_note_total_amount - $credit_note_shipincaharg  - $credit_note_tax_total;

        $tax                        = $sub_total == 0 ? 0 : (($credit_note_tax_total) * 100) / ($sub_total);

        $credit_note_number   = $credit_note->credit_note_number;
        if ($branch_id == 1) {
            $invoices                    = Invoice::all();
        } else {

            if ($branch_id == 1) {
                $invoices                    = Invoice::all();
            } else {

                $invoices                   = Invoice::whereIn('created_by', $this->targeted_users)->get();
            }
        }

        $units = Unit::get();

        $attributes                     = Attributes::all();
        $item_variations                = ItemVariation::all();

        return view('creditnote::creditnote.edit', compact('units', 'customers', 'credit_note_number', 'credit_note', 'invoices', 'item_category', 'credit_note_entry', 'account', 'tax', 'attributes', 'item_variations'));
    }

    public function update(Request $request, $id)
    {
        $credit_note_data       = $request->all();
        $user_id                = Auth::user()->id;

        DB::beginTransaction();

        $helper = new \App\Lib\Helpers;
        $helper->updateItemAfterUpdatingCreditNote($credit_note_data, $user_id, $id);

        $credit_note                         = CreditNote::find($id);
        $credit_note->customer_id            = $credit_note_data['customer_id'];
        $credit_note->invoice_id             = empty($credit_note_data['inv_id']) ? null : $credit_note_data['inv_id'];
        $credit_note->credit_note_number     = $credit_note_data['credit_note_number'];
        $credit_note->reference              = $credit_note_data['reference'];
        $credit_note->credit_note_date       = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
        $credit_note->shiping_charge         = $credit_note_data['shipping_charge'];
        $credit_note->adjustment             = $credit_note_data['adjustment'];
        $credit_note->total_credit_note      = $credit_note_data['total'];
        $credit_note->customer_note          = $credit_note_data['customer_note'];
        $credit_note->tax_total              = $credit_note_data['tax_total'];
        $credit_note->terms_and_condition    = $credit_note_data['terms_and_condition'];
        $credit_note->created_by             = $user_id;
        $credit_note->updated_by             = $user_id;

        if ($request->hasFile('file1')) {
            $file = $request->file('file1');
            if ($credit_note->file_url) {
                $delete_path = public_path($credit_note->file_url);
                if (file_exists($delete_path)) {
                    $delete = unlink($delete_path);
                }
            }
            $file_name = $file->getClientOriginalName();
            $without_extention = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention = $file->getClientOriginalExtension();
            $num = rand(1, 500);
            $new_file_name = "creditnote-" . $credit_note->credit_note_number . '.' . $file_extention;
            $success = $file->move('uploads/creditnote', $new_file_name);
            if ($success) {
                $credit_note->file_url = 'uploads/creditnote/' . $new_file_name;
            } else {
                $credit_note->file_url = null;
            }
        }

        if ($credit_note->update()) {
            $credit_note_entries_array = [];

            $item_id        = $credit_note_data['item_id'];
            $variation_id   = !empty($credit_note_data['selected_variation']) ? $credit_note_data['selected_variation'] : null;
            $description    = $credit_note_data['description'];
            $account_id     = $credit_note_data['account_id'];
            $unit_id        = $credit_note_data['unit_id'];
            $quantity       = $credit_note_data['quantity_pcs'];
            $rate           = $credit_note_data['rate'];
            $discount       = $credit_note_data['discount'];
            $tax_id         = $credit_note_data['tax_id'];
            $amount         = $credit_note_data['amount'];

            // return $account_id;

            $length = count($item_id);

            //            $credit_note_id = CreditNote::all()->last()->id;

            $credit_note_id = $id;
            // 120
            for ($i = 0; $i < $length; $i++) {
                $unit = Unit::where('id', $unit_id[$i])->select('basic_unit_conversion')->first();
                $credit_note_entries_array[] = [
                    'item_id'        => $item_id[$i],
                    'variation_id'   => !empty($variation_id[$i]) ? $variation_id[$i] : null,
                    'description'    => $description[$i],
                    'account_id'     => $account_id[$i],
                    'quantity'           => $helper->unitQuantity($request->quantity_pcs[$i], $unit->basic_unit_conversion),
                    'unit_id'            => $unit_id[$i],
                    'basic_unit_conversion'  => $unit->basic_unit_conversion,
                    'rate'           => $rate[$i],
                    'discount'       => $discount[$i],
                    'tax_id'         => $tax_id[$i],
                    'amount'         => $amount[$i],
                    'credit_note_id' => $credit_note_id,
                    'created_by'     => $user_id,
                    'updated_by'     => $user_id,
                    'created_at'     => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at'     => \Carbon\Carbon::now()->toDateTimeString()
                ];
            }


            $credit_note_entries = CreditNoteEntry::where('credit_note_id', $credit_note_id)->pluck('id')->toArray();

            if (count($credit_note_entries)) {
                CreditNoteEntry::destroy($credit_note_entries);
            }

            $save = DB::table('credit_note_entries')->insert($credit_note_entries_array);

            if ($save) {

                $journal_entries = JournalEntry::where('credit_note_id', $credit_note_id)->where('jurnal_type', 11)->pluck('id')->toArray();

                if (count($journal_entries)) {
                    JournalEntry::destroy($journal_entries);
                }

                $length = count($credit_note_data['discount']);
                $discount = $credit_note_data['discount'];
                $rate = $credit_note_data['rate'];
                $quantity = $credit_note_data['quantity_pcs'];
                $total_amount = 0;
                $total_discount = 0;

                for ($i = 0; $i < $length; $i++) {

                    if ($discount[$i] > 0) {

                        $current_amount = $quantity[$i] * $rate[$i];
                        $discount_value = ($discount[$i] * $current_amount) / 100;

                        $total_discount = $total_discount + $discount_value;
                    }
                }

                $journal_entry = new JournalEntry;
                $journal_entry->amount              = $credit_note_data['total'];
                $journal_entry->debit_credit        = 0;
                $journal_entry->account_name_id     = 5;
                $journal_entry->jurnal_type         = 11;
                $journal_entry->credit_note_id      = $credit_note_id;
                $journal_entry->contact_id          = $credit_note_data['customer_id'];
                $journal_entry->created_by          = $user_id;
                $journal_entry->updated_by          = $user_id;
                $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                $journal_entry->save();

                if ($credit_note_data['tax_total'] > 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount              = $credit_note_data['tax_total'];
                    $journal_entry->debit_credit        = 1;
                    $journal_entry->account_name_id     = 9;
                    $journal_entry->jurnal_type         = 11;
                    $journal_entry->credit_note_id      = $credit_note_id;
                    $journal_entry->contact_id          = $credit_note_data['customer_id'];
                    $journal_entry->created_by          = $user_id;
                    $journal_entry->updated_by          = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }


                if ($total_discount > 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount              = $total_discount;
                    $journal_entry->debit_credit        = 0;
                    $journal_entry->account_name_id     = 21;
                    $journal_entry->jurnal_type         = 11;
                    $journal_entry->credit_note_id      = $credit_note_id;
                    $journal_entry->contact_id          = $credit_note_data['customer_id'];
                    $journal_entry->created_by          = $user_id;
                    $journal_entry->updated_by          = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }


                if ($credit_note_data['shipping_charge'] > 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = $credit_note_data['shipping_charge'];
                    $journal_entry->debit_credit = 1;
                    $journal_entry->account_name_id = 20;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }

                if ($credit_note_data['adjustment'] > 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = abs($credit_note_data['adjustment']);
                    $journal_entry->debit_credit = 1;
                    $journal_entry->account_name_id = 18;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                } else if ($credit_note_data['adjustment'] < 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = abs($credit_note_data['adjustment']);
                    $journal_entry->debit_credit = 0;
                    $journal_entry->account_name_id = 18;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }

                $length = count($credit_note_data['discount']);
                $rate = $credit_note_data['rate'];
                $quantity = $credit_note_data['quantity_pcs'];
                $account_id = $credit_note_data['account_id'];
                $current_amount = 0;

                for ($i = 0; $i < $length; $i++) {
                    $current_amount = $quantity[$i] * $rate[$i];
                    $current_account_id = $account_id[$i];

                    $journal_entry = new JournalEntry;
                    $journal_entry->amount              = $current_amount;
                    $journal_entry->debit_credit        = 1;
                    $journal_entry->account_name_id     = $current_account_id;
                    $journal_entry->jurnal_type         = 11;
                    $journal_entry->credit_note_id      = $credit_note_id;
                    $journal_entry->contact_id          = $credit_note_data['customer_id'];
                    $journal_entry->created_by          = $user_id;
                    $journal_entry->updated_by          = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }

                DB::commit();

                return redirect()
                    ->route('credit_note')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Credit note updated successfully!');
            } else {
                DB::rollback();

                return redirect()
                    ->route('credit_note_edit', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Something went wrong! Cannot update data!');
            }

            DB::rollback();
        }

        DB::rollback();
    }

    public function destroy($id)
    {

        DB::beginTransaction();

        $helper = new \App\Lib\Helpers;
        $helper->itemBackAfterDeletingCreditNote($id);

        $credit_note         = CreditNote::findOrFail($id);
        $branch_id           = session('branch_id');
        $OrganizationProfile = OrganizationProfile::findOrFail(1);

        $credit_note_refunds    = CreditNoteRefund::where('credit_note_id', $credit_note->id)->count();
        $credit_note_payments   = CreditNotePayment::where('credit_note_id', $credit_note->id)->count();

        if ($credit_note_refunds == 0 && $credit_note_payments == 0) {
            if ($credit_note->file_url) {
                $delete_path = public_path($credit_note->file_url);

                if (file_exists($delete_path)) {
                    $delete = unlink($delete_path);
                }
            }

            $credit_note->delete();

            DB::commit();

            return redirect()
                ->route('credit_note')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Data deleted Successfully!');
        } else if (CreditNotePayment::where('credit_note_id', $credit_note->id)->count() > 0) {
            DB::rollback();

            return redirect()
                ->route('credit_note')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Credit note has been used. Delete used credit notes from invoice first!');
        } else if (CreditNoteRefund::where('credit_note_id', $credit_note->id)->count() > 0) {
            DB::rollback();

            return redirect()
                ->route('credit_note')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Credit note has been refunded. Cannot delete!');
        } else {
            DB::rollback();

            return redirect()
                ->route('credit_note')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something went wrong! Cannot delete data!');
        }

        DB::rollback();
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
}
