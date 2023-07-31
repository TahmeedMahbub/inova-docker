<?php

namespace App\Modules\Vendorcredit\Http\Controllers;

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
use App\Models\MoneyOut\Bill;
use App\Models\Inventory\Item;
use App\Models\Contact\Contact;
use App\Models\Moneyin\Invoice;
use App\Http\Controllers\Controller;
use App\Models\AccountChart\Account;
use App\Models\Attributes\Attributes;
use App\Models\MoneyOut\VendorCredit;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\ItemVariation;
use App\Models\ManualJournal\JournalEntry;
use App\Models\MoneyOut\VendorCreditEntry;
use App\Models\OrganizationProfile\OrganizationProfile;

class VendorCreditController extends Controller
{
    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];

    public function index()
    {
        $current_time    = Carbon::now()->toDayDateTimeString();
        $start           = isset($_GET['from_date']) ? date('Y-m-d', strtotime($_GET['from_date'])) : (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end             = isset($_GET['to_date']) ? date('Y-m-d', strtotime($_GET['to_date'])) : (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
        $branch          = isset($_GET['branch_id']) ? $_GET['branch_id'] : 1;
        $user            = User::where('branch_id', $branch)->get();

        $branch_all      = [];
        foreach ($user as $value) {
            $branch_all[] = $value->id;
        }

        $branch_id      = session('branch_id');

        $this->getBranchUsers($branch_id);

        if ($branch_id == 1) {
            $vendor_credit     =  VendorCredit::whereBetween('vendor_credit_date', [$start, $end])
                ->when($branch != 1, function ($query) use ($branch_all) {
                    return $query->whereIn('created_by', $branch_all);
                })
                ->get();
        } else {

            $vendor_credit      =  VendorCredit::whereBetween('vendor_credit_date', [$start, $end])
                ->whereIn('created_by', $this->targeted_users)
                ->get();
        }

        $branchs              = Branch::orderBy('id', 'asc')->get();

        return view('vendorcredit::vendorcredit.index', compact('vendor_credit', 'branch_id', 'branchs'));
    }

    public function create()
    {
        $branch_id          = session('branch_id');
        $show_all_contact   = OrganizationProfile::find(1);
        $customers          = Contact::leftjoin('users', 'users.id', '=', 'contact.created_by')
            ->where('contact.contact_category_id', 4)
            ->when($branch_id != 1 && $show_all_contact->show_all_contact == 0, function ($query) use ($branch_id) {
                return $query->where('users.branch_id', '=', $branch_id);
            })
            ->select('contact.*')
            ->get();
        $item_category      = ItemCategory::when($branch_id != 1, function ($query) use ($branch_id) {
            return $query->where('branch_id', '=', $branch_id);
        })
            ->orderBy('item_category_name', 'ASC')
            ->get();

        $account            = Account::all();
        $accounts           = Account::whereIn('account_type_id', [4, 5])->get();
        $bills              = Bill::all();
        $vendor_credit_no  = VendorCredit::orderBy('id', 'DESC')->first();

        if (!empty($vendor_credit_no))

            $vendor_credit_no   =  $vendor_credit_no['vendor_credit_no'] + 1;

        else
            $vendor_credit_no   =    1;

        $vendor_credit_no   =  str_pad($vendor_credit_no, 6, '0', STR_PAD_LEFT);

        $attributes                     = Attributes::all();
        $item_variations                = ItemVariation::all();
        $units = Unit::get();

        return view('vendorcredit::vendorcredit.create', compact('units', 'customers', 'item_category', 'account', 'accounts', 'bills', 'vendor_credit_no', 'attributes', 'item_variations'));
    }

    public function store(Request $request)
    {
        $branch_id      = session('branch_id');

        $this->validate($request, [
            'vendor_name'         => 'required',
            'item_id.*'            => 'required',
            'quantity.*'           => 'required',
            'rate.*'               => 'required',
            'amount.*'             => 'required',
            'account_id'           => 'required',
        ]);

        DB::beginTransaction();

        try {
            $vendor_credit_data = $request->all();
            $user_id            = Auth::user()->id;
            $vendor_credit      = new VendorCredit;

            if ($request->hasFile('file1')) {
                $file                   = $request->file('file1');
                $file_name              = $file->getClientOriginalName();
                $without_extention      = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention         = $file->getClientOriginalExtension();
                $num                    = rand(1, 500);
                $new_file_name          = $without_extention . $request->vendor_credit_no . '.' . $file_extention;
                $success                = $file->move('uploads/vendor_credit', $new_file_name);

                if ($success) {
                    $vendor_credit->file_url     = 'uploads/vendor_credit/' . $new_file_name;
                    $vendor_credit->file_name    = $new_file_name;
                }
            }

            $vendor_credit->vendor_name            = $vendor_credit_data['vendor_name'];
            $vendor_credit->bill_id                = empty($vendor_credit_data['bill_no']) ? null : $vendor_credit_data['bill_no'];
            $vendor_credit->vendor_credit_no       = $vendor_credit_data['vendor_credit_no'];
            $vendor_credit->vendor_credit_date     = date("Y-m-d", strtotime($vendor_credit_data['vendor_credit_date']));
            $vendor_credit->presonal_note          = $vendor_credit_data['personal_note'];
            $vendor_credit->customer_note          = $vendor_credit_data['customer_note'];
            $vendor_credit->note                   = $vendor_credit_data['note'];
            $vendor_credit->total                  = $vendor_credit_data['total'];
            $vendor_credit->sub_total              = $vendor_credit_data['sub_total'];
            $vendor_credit->vat_tax                = $vendor_credit_data['vat_tax'];
            $vendor_credit->adjustment             = $vendor_credit_data['adjustment'];
            $vendor_credit->created_by             = $user_id;
            $vendor_credit->updated_by             = $user_id;
            $vendor_credit->save();

            if ($vendor_credit) {
                foreach ($request->rate as $key => $value) {
                    $unit = Unit::where('id', $request->unit_id[$key])->select('basic_unit_conversion')->first();
                    $quantity = (float)$request->quantity_pcs[$key] * $unit->basic_unit_conversion;

                    $vendor_credit_enty                        = new VendorCreditEntry;
                    $vendor_credit_enty->quantity              =  $quantity;
                    $vendor_credit_enty->unit_id               = $request->unit_id[$key];
                    $vendor_credit_enty->basic_unit_conversion = $unit->basic_unit_conversion;
                    $vendor_credit_enty->rate                  = $request->rate[$key];
                    $vendor_credit_enty->amount                = $request->amount[$key];
                    $vendor_credit_enty->item_id               = $request->item_id[$key];
                    $vendor_credit_enty->variation_id          = !empty($request->selected_variation[$key]) ? $request->selected_variation[$key] : null;
                    $vendor_credit_enty->description           = $request->description[$key];
                    $vendor_credit_enty->vendor_credit_id      = $vendor_credit->id;
                    $vendor_credit_enty->tax_id                = 1;
                    $vendor_credit_enty->account_id            = $request->account_id[$key];
                    $vendor_credit_enty->created_by            = $user_id;
                    $vendor_credit_enty->updated_by            = $user_id;
                    $vendor_credit_enty->created_at            = \Carbon\Carbon::now()->toDateTimeString();
                    $vendor_credit_enty->updated_at            = \Carbon\Carbon::now()->toDateTimeString();
                    $vendor_credit_enty->save();
                }

                if ($vendor_credit_enty) {
                    $length       = count($vendor_credit_data['rate']);
                    $rate         = $vendor_credit_data['rate'];
                    $quantity     = $vendor_credit_data['quantity_pcs'];
                    $total_amount = 0;

                    for ($i = 0; $i < $length; $i++) {
                        $current_amount = $quantity[$i] * $rate[$i];
                        $total_amount   = $total_amount + $current_amount;
                    }

                    $journal_entry                          = new JournalEntry;
                    $journal_entry->amount                  = $vendor_credit_data['total'];
                    $journal_entry->debit_credit            = 1;
                    $journal_entry->account_name_id         = 11;
                    $journal_entry->jurnal_type             = 'vendor_credit';
                    $journal_entry->vendor_credit_id       = $vendor_credit->id;
                    $journal_entry->contact_id              = $vendor_credit_data['vendor_name'];
                    $journal_entry->created_by              = $user_id;
                    $journal_entry->updated_by              = $user_id;
                    $journal_entry->assign_date             = date("Y-m-d", strtotime($vendor_credit_data['vendor_credit_date']));
                    $journal_entry->save();

                    if ($vendor_credit_data['vat_tax'] > 0) {
                        $journal_entry                        = new JournalEntry;
                        $journal_entry->amount                = $vendor_credit_data['vat_tax'];
                        $journal_entry->debit_credit          = 0;
                        $journal_entry->account_name_id       = 9;
                        $journal_entry->jurnal_type           = 'vendor_credit';
                        $journal_entry->vendor_credit_id     = $vendor_credit->id;
                        $journal_entry->contact_id            = $vendor_credit_data['vendor_name'];
                        $journal_entry->created_by            = $user_id;
                        $journal_entry->updated_by            = $user_id;
                        $journal_entry->assign_date           = date("Y-m-d", strtotime($vendor_credit_data['vendor_credit_date']));
                        $journal_entry->save();
                    }

                    if ($vendor_credit_data['adjustment'] > 0) {
                        $journal_entry                      = new JournalEntry;
                        $journal_entry->amount              = abs($vendor_credit_data['adjustment']);
                        $journal_entry->debit_credit        = 0;
                        $journal_entry->account_name_id     = 18;
                        $journal_entry->jurnal_type         = 'vendor_credit';
                        $journal_entry->vendor_credit_id   = $vendor_credit->id;
                        $journal_entry->contact_id          = $vendor_credit_data['vendor_name'];
                        $journal_entry->created_by          = $user_id;
                        $journal_entry->updated_by          = $user_id;
                        $journal_entry->assign_date         = date("Y-m-d", strtotime($vendor_credit_data['vendor_credit_date']));
                        $journal_entry->save();
                    }

                    if ($vendor_credit_data['adjustment'] < 0) {
                        $journal_entry                      = new JournalEntry;
                        $journal_entry->amount              = abs($vendor_credit_data['adjustment']);
                        $journal_entry->debit_credit        = 1;
                        $journal_entry->account_name_id     = 18;
                        $journal_entry->jurnal_type         = 'vendor_credit';
                        $journal_entry->vendor_credit_id   = $vendor_credit->id;
                        $journal_entry->contact_id          = $vendor_credit_data['vendor_name'];
                        $journal_entry->created_by          = $user_id;
                        $journal_entry->updated_by          = $user_id;
                        $journal_entry->assign_date             = date("Y-m-d", strtotime($vendor_credit_data['vendor_credit_date']));
                        $journal_entry->save();
                    }


                    $rate           = $vendor_credit_data['rate'];
                    $quantity       = $vendor_credit_data['quantity_pcs'];
                    $account_id     = $vendor_credit_data['account_id'];
                    $current_amount = 0;

                    for ($i = 0; $i < $length; $i++) {
                        $current_amount      = $quantity[$i] * $rate[$i];
                        $current_account_id  = $account_id[$i];

                        $journal_entry                     = new JournalEntry;
                        $journal_entry->amount             = $current_amount;
                        $journal_entry->debit_credit       = 0;
                        $journal_entry->account_name_id    = $current_account_id;
                        $journal_entry->jurnal_type        = 'vendor_credit';
                        $journal_entry->vendor_credit_id  = $vendor_credit->id;
                        $journal_entry->contact_id         = $vendor_credit_data['vendor_name'];
                        $journal_entry->created_by         = $user_id;
                        $journal_entry->updated_by         = $user_id;
                        $journal_entry->assign_date        = date("Y-m-d", strtotime($vendor_credit_data['vendor_credit_date']));
                        $journal_entry->save();
                    }

                    foreach ($vendor_credit_data['item_id'] as $key => $item) {
                        $basic_unit_conversion = Unit::find($request->unit_id[$key])->basic_unit_conversion;
                        if(!empty($request->selected_variation[$key])){
                            $item_variation                         = ItemVariation::find($request->selected_variation[$key]);
                            $item_variation->total_purchase_return  = $item_variation['total_purchase_return'] + $request->quantity_pcs[$key] * $basic_unit_conversion;
                            $item_variation->total_stock  = $item_variation['total_stock'] - $request->quantity_pcs[$key] * $basic_unit_conversion;
                            $item_variation->save();
                        }else{
                            $item                                   = Item::find($item);
                            $item->total_purchase_return            = $item['total_purchase_return'] + $request->quantity_pcs[$key] * $basic_unit_conversion;
                            $item->total_stock                      = $item['total_stock'] - $request->quantity_pcs[$key] * $basic_unit_conversion;
                            $item->save();
                        }
                        $i++;
                    }
                }
            }
            DB::commit();
            return redirect()
                ->route('vendor_credit_index')
                ->with('alert.status', 'success')
                ->with('alert.message', 'vendor Credit note added Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something went wrong! Can`t added data!');
        }
    }

    public function edit($id)
    {
        $vendor_credit       = VendorCredit::findOrFail($id);
        $branch_id           = session('branch_id');
        $show_all_contact    = OrganizationProfile::first();
        $show_all_contact    = $show_all_contact->show_all_contact;
        $OrganizationProfile = OrganizationProfile::find(1);

        // $this->getBranchUsers($branch_id);
        // $customers = Contact::all()->sortBy('display_name');

        $customers           = Contact::leftjoin('users', 'users.id', '=', 'contact.created_by')
            ->where('contact.contact_category_id', 4)
            ->when($branch_id != 1 && $show_all_contact == 0, function ($query) use ($branch_id) {
                return $query->where('users.branch_id', '=', $branch_id);
            })
            ->select('contact.*')
            ->get();

        $item_category       = ItemCategory::when($branch_id != 1, function ($query) use ($branch_id) {
            return $query->where('branch_id', '=', $branch_id);
        })
            ->orderBy('item_category_name', 'ASC')
            ->get();

        $account                 = Account::all();
        $accounts                = Account::whereIn('account_type_id', [4, 5])->get();
        $bills                   = Bill::all();
        $vendor_credit_entry     = VendorCreditEntry::where('vendor_credit_id', $vendor_credit->id)->with('item')->get();
        $sub_total               = $vendor_credit->sub_total;
        $tax                     = $sub_total == 0 ? 0 : (($vendor_credit->vat_tax) * 100) / ($sub_total);

        $attributes              = Attributes::all();
        $item_variations         = ItemVariation::all();
        $units = Unit::get();

        return view('vendorcredit::vendorcredit.edit', compact('units', 'customers', 'item_category', 'account', 'accounts', 'id', 'bills', 'vendor_credit', 'vendor_credit_entry', 'tax', 'attributes', 'item_variations'));
    }

    public function show($id)
    {
        $vendor_credits   = [];
        $vendor_credit    = VendorCredit::find($id);
        $bill              = Bill::all();
        $items             = Item::all();
        $taxes             = Tax::all();
        $branch_id         = session('branch_id');

        $this->getBranchUsers($branch_id);

        if ($branch_id == 1)

            $vendor_credits = VendorCredit::orderBy('vendor_credit_date', 'desc')->take(10)->get()->toArray();

        else

            $vendor_credits = VendorCredit::orderBy('vendor_credit_date', 'desc')->whereIn('created_by', $this->targeted_users)->take(10)->get()->toArray();


        $date           = "vendor_credit_date";
        $sort           = new sortBydate();
        $vendor_credits   = $sort->get('\App\Models\MoneyOut\VendorCredit', $date, 'Y-m-d', $vendor_credits);


        $vendor_credit_entries  = VendorCreditEntry::where('vendor_credit_id', $id)->get();
        $sub_total            = 0;
        $OrganizationProfile  = OrganizationProfile::find(1);

        foreach ($vendor_credit_entries as $vendor_credit_entry) {
            $sub_total = $sub_total + $vendor_credit_entry->amount;
        }

        return view('vendorcredit::vendorcredit.show', compact('vendor_credits', 'bill', 'OrganizationProfile', 'vendor_credit', 'sub_total', 'vendor_credit_entries'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'vendor_name'          => 'required',
            'item_id.*'            => 'required',
            'quantity.*'           => 'required',
            'rate.*'               => 'required',
            'amount.*'             => 'required',
            'account_id'           => 'required'
        ]);

        DB::beginTransaction();

        try {

            $vendor_credit_data = $request->all();
            $vendor_credit      = VendorCredit::findorfail($id);

            // total_purchase_return update from item table
            foreach ($vendor_credit->vendorCreditEntries as $key => $vendor_credit_entry) {
                $basic_unit_conversion = Unit::find($vendor_credit_entry->unit_id)->basic_unit_conversion;
                if(!empty($vendor_credit_entry->variation_id)){
                    $item_variation                         = ItemVariation::find($vendor_credit_entry->variation_id);
                    $item_variation->total_purchase_return  = $item_variation['total_purchase_return'] - $vendor_credit_entry['quantity'];
                    $item_variation->total_stock            = $item_variation['total_stock'] + $vendor_credit_entry['quantity'];
                    $item_variation->save();                    
                }else{
                    $item                           = Item::find($vendor_credit_entry->item_id);
                    $item->total_purchase_return    = $item['total_purchase_return'] - $vendor_credit_entry['quantity'];
                    $item->total_stock              = $item['total_stock'] + $vendor_credit_entry['quantity'];
                    $item->save();
                }
            }

            foreach ($request->item_id as $key => $value) {
                $basic_unit_conversion = Unit::find($request->unit_id[$key])->basic_unit_conversion;
                if(!empty($request->selected_variation[$key])){
                    $item_variation                         = ItemVariation::find($request->selected_variation[$key]);
                    $item_variation->total_purchase_return  = $item_variation['total_purchase_return'] + $request->quantity_pcs[$key] * $basic_unit_conversion;
                    $item_variation->total_stock            = $item_variation['total_stock'] - $request->quantity_pcs[$key] * $basic_unit_conversion;
                    $item_variation->save();
                }else{
                    $item                                   = Item::find($request->item_id[$key]);
                    $item->total_purchase_return            = $item['total_purchase_return'] + $request->quantity_pcs[$key] * $basic_unit_conversion;
                    $item->total_stock                      = $item['total_stock'] - $request->quantity_pcs[$key] * $basic_unit_conversion;
                    $item->save();
                }
            }

            $user_id            = Auth::user()->id;

            if ($request->hasFile('file1')) {
                $file                       = $request->file('file1');

                if ($vendor_credit->file_url) {
                    $delete_path            = public_path($vendor_credit->file_url);

                    if (file_exists($delete_path)) {
                        $delete             = unlink($delete_path);
                    }
                }

                $file_name                  = $file->getClientOriginalName();
                $without_extention          = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention             = $file->getClientOriginalExtension();
                $num                        = rand(1, 500);
                $new_file_name              = $without_extention . $request->bill_number . '.' . $file_extention;

                $success                    = $file->move('uploads/vendor_credit', $new_file_name);

                if ($success) {
                    $vendor_credit->file_url         = 'uploads/vendor_credit/' . $new_file_name;
                    $vendor_credit->file_name        = $new_file_name;
                }
            }

            $vendor_credit->vendor_name            = $vendor_credit_data['vendor_name'];
            $vendor_credit->bill_id                = empty($vendor_credit_data['bill_no']) ? null : $vendor_credit_data['bill_no'];
            $vendor_credit->vendor_credit_no       = $vendor_credit_data['vendor_credit_no'];
            $vendor_credit->vendor_credit_date     = date("Y-m-d", strtotime($vendor_credit_data['vendor_credit_date']));
            $vendor_credit->presonal_note          = $vendor_credit_data['personal_note'];
            $vendor_credit->customer_note          = $vendor_credit_data['customer_note'];
            $vendor_credit->note                   = $vendor_credit_data['note'];
            $vendor_credit->category               = $vendor_credit->category;
            $vendor_credit->sub_category           = $vendor_credit->sub_category;
            $vendor_credit->total                  = $vendor_credit_data['total'];
            $vendor_credit->sub_total              = $vendor_credit_data['sub_total'];
            $vendor_credit->vat_tax                = $vendor_credit_data['vat_tax'];
            $vendor_credit->adjustment             = $vendor_credit_data['adjustment'];
            $vendor_credit->created_by             = $user_id;
            $vendor_credit->updated_by             = $user_id;
            $vendor_credit->save();

            if ($vendor_credit) {
                $vendor_credit_entry_delete = VendorCreditEntry::where('vendor_credit_id', $id)->delete();
                if ($vendor_credit_entry_delete) {
                    foreach ($request->rate as $key => $value) {
                        $unit = Unit::where('id', $request->unit_id[$key])->select('basic_unit_conversion')->first();
                        $quantity = (float)$request->quantity_pcs[$key] * $unit->basic_unit_conversion;

                        $vendor_credit_enty                        = new VendorCreditEntry;
                        $vendor_credit_enty->quantity              =  $quantity;
                        $vendor_credit_enty->unit_id               = $request->unit_id[$key];
                        $vendor_credit_enty->basic_unit_conversion = $unit->basic_unit_conversion;
                        $vendor_credit_enty->rate                  = $request->rate[$key];
                        $vendor_credit_enty->amount                = $request->amount[$key];
                        $vendor_credit_enty->item_id               = $request->item_id[$key];
                        $vendor_credit_enty->variation_id          = !empty($request->selected_variation[$key]) ? $request->selected_variation[$key] : null;
                        $vendor_credit_enty->description           = $request->description[$key];
                        $vendor_credit_enty->vendor_credit_id      = $vendor_credit->id;
                        $vendor_credit_enty->tax_id                = 1;
                        $vendor_credit_enty->account_id            = $request->account_id[$key];
                        $vendor_credit_enty->created_by            = $user_id;
                        $vendor_credit_enty->updated_by            = $user_id;
                        $vendor_credit_enty->created_at            = \Carbon\Carbon::now()->toDateTimeString();
                        $vendor_credit_enty->updated_at            = \Carbon\Carbon::now()->toDateTimeString();
                        $vendor_credit_enty->save();
                    }
                }
            }

            if ($vendor_credit_enty) {
                $journal_entry_delete = JournalEntry::where('vendor_credit_id', $id)->delete();

                if ($journal_entry_delete) {
                    $length       = count($vendor_credit_data['rate']);
                    $rate         = $vendor_credit_data['rate'];
                    $quantity     = $vendor_credit_data['quantity_pcs'];
                    $total_amount = 0;

                    for ($i = 0; $i < $length; $i++) {
                        $current_amount = $quantity[$i] * $rate[$i];
                        $total_amount   = $total_amount + $current_amount;
                    }

                    $journal_entry                          = new JournalEntry;
                    $journal_entry->amount                  = $vendor_credit_data['total'];
                    $journal_entry->debit_credit            = 1;
                    $journal_entry->account_name_id         = 11;
                    $journal_entry->jurnal_type             = 'vendor_credit';
                    $journal_entry->vendor_credit_id       = $vendor_credit->id;
                    $journal_entry->contact_id              = $vendor_credit_data['vendor_name'];
                    $journal_entry->created_by              = $user_id;
                    $journal_entry->updated_by              = $user_id;
                    $journal_entry->assign_date             = date("Y-m-d", strtotime($vendor_credit_data['vendor_credit_date']));
                    $journal_entry->save();

                    if ($vendor_credit_data['vat_tax'] > 0) {
                        $journal_entry                      = new JournalEntry;
                        $journal_entry->amount              = $vendor_credit_data['vat_tax'];
                        $journal_entry->debit_credit        = 0;
                        $journal_entry->account_name_id     = 9;
                        $journal_entry->jurnal_type         = 'vendor_credit';
                        $journal_entry->vendor_credit_id   = $vendor_credit->id;
                        $journal_entry->contact_id          = $vendor_credit_data['vendor_name'];
                        $journal_entry->created_by          = $user_id;
                        $journal_entry->updated_by          = $user_id;
                        $journal_entry->assign_date         = date("Y-m-d", strtotime($vendor_credit_data['vendor_credit_date']));
                        $journal_entry->save();
                    }

                    if ($vendor_credit_data['adjustment'] > 0) {
                        $journal_entry                      = new JournalEntry;
                        $journal_entry->amount              = abs($vendor_credit_data['adjustment']);
                        $journal_entry->debit_credit        = 0;
                        $journal_entry->account_name_id     = 18;
                        $journal_entry->jurnal_type         = 'vendor_credit';
                        $journal_entry->vendor_credit_id   = $vendor_credit->id;
                        $journal_entry->contact_id          = $vendor_credit_data['vendor_name'];
                        $journal_entry->created_by          = $user_id;
                        $journal_entry->updated_by          = $user_id;
                        $journal_entry->assign_date         = date("Y-m-d", strtotime($vendor_credit_data['vendor_credit_date']));
                        $journal_entry->save();
                    }

                    if ($vendor_credit_data['adjustment'] < 0) {
                        $journal_entry                      = new JournalEntry;
                        $journal_entry->amount              = abs($vendor_credit_data['adjustment']);
                        $journal_entry->debit_credit        = 1;
                        $journal_entry->account_name_id     = 18;
                        $journal_entry->jurnal_type         = 'vendor_credit';
                        $journal_entry->vendor_credit_id   = $vendor_credit->id;
                        $journal_entry->contact_id          = $vendor_credit_data['vendor_name'];
                        $journal_entry->created_by          = $user_id;
                        $journal_entry->updated_by          = $user_id;
                        $journal_entry->assign_date         = date("Y-m-d", strtotime($vendor_credit_data['vendor_credit_date']));
                        $journal_entry->save();
                    }

                    $rate           = $vendor_credit_data['rate'];
                    $quantity       = $vendor_credit_data['quantity_pcs'];
                    $account_id     = $vendor_credit_data['account_id'];
                    $current_amount = 0;

                    for ($i = 0; $i < $length; $i++) {
                        $current_amount      = $quantity[$i] * $rate[$i];
                        $current_account_id  = $account_id[$i];

                        $journal_entry                     = new JournalEntry;
                        $journal_entry->amount             = $current_amount;
                        $journal_entry->debit_credit       = 0;
                        $journal_entry->account_name_id    = $current_account_id;
                        $journal_entry->jurnal_type        = 'vendor_credit';
                        $journal_entry->vendor_credit_id  = $vendor_credit->id;
                        $journal_entry->contact_id         = $vendor_credit_data['vendor_name'];
                        $journal_entry->created_by         = $user_id;
                        $journal_entry->updated_by         = $user_id;
                        $journal_entry->assign_date        = date("Y-m-d", strtotime($vendor_credit_data['vendor_credit_date']));
                        $journal_entry->save();
                    }
                }
            }

            DB::commit();
            return redirect()
                ->route('vendor_credit_index')
                ->with('alert.status', 'success')
                ->with('alert.message', 'vendor Credit note udatated Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something went wrong! Can`t added data!');
        }
    }

    public function delete($id)
    {
        $vendor_credit_delete = VendorCredit::where('id', $id)->first();
        $branch_id            = session('branch_id');
        $OrganizationProfile  = OrganizationProfile::find(1);

        $old_quantity     = VendorCreditEntry::where('vendor_credit_id', $id)->get();

        foreach ($old_quantity as $key => $value) {
            if(!empty($value->variation_id)){
                $item_variation                         = ItemVariation::find($value->variation_id);
                $item_variation->total_purchase_return  = $item_variation['total_purchase_return'] - $value->quantity;
                $item_variation->total_stock            = $item_variation['total_stock'] + $value->quantity;
                $item_variation->save();
            }else{
                $item                                   = Item::find($value->item_id);
                $item->total_purchase_return            = $item['total_purchase_return'] - $value->quantity;
                $item->total_stock                      = $item['total_stock'] + $value->quantity;
                $item->save();                
            }
        }

        try {
            $vendor_credit_delete = VendorCredit::where('id', $id)->delete();

            if ($vendor_credit_delete) {
                $vendor_credit_entry_delete  = VendorCreditEntry::where('vendor_credit_id', $id)->delete();

                if ($vendor_credit_entry_delete) {
                    $journal_entry_delete = JournalEntry::where('vendor_credit_id', $id)->delete();
                }
            }

            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Data deleted Successfully ');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something went wrong! Data  Can`t deleted!');
        }
    }

    public function getBranchUsers($branch_id)
    {
        $tmp_targeted_users      = [];
        $this->targeted_users    = [];
        $this->branch_id         = $branch_id;

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
