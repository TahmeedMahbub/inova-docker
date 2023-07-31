<?php

/**
 * Created by PhpStorm.
 * User: Ontik Technology 3
 * Date: 27-07-17
 * Time: 18.44
 */

namespace App\Lib;

use App\Models\AccountChart\Account;
use App\Models\Contact\Contact;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Setting\SalesComission;
use App\Models\Branch\Branch;
use App\User;
use App\Models\MoneyOut\StockSerial;
use App\Models\Crm\Zone\Zone;

use App\Models\Inventory\ProductPhase;
use App\Models\Inventory\ProductPhaseItem;
use App\Models\Inventory\ProductPhaseItemAdd;
use DB;

use App\Models\Moneyin\PaymentReceives;
use App\Models\Moneyin\PaymentReceiveEntryModel;

class Report
{
    public $OperatingincomeTotal = null;
    public $CostofGoodTotal      = null;
    public $OperatingExpense     = null;
    public $nonoperatingix       = null;
    public $start                = null;
    public $end                  = null;

    private $branch_id           = 0;
    private $targeted_users      = [];

    public function definedate($start, $end)
    {
        $this->start = date('Y-m-d', strtotime($start));
        $this->end = date('Y-m-d', strtotime($end));
    }

    public function InvoiceCount($id)
    {
        return JournalEntry::where('agent_id', $id)->whereNotNull('invoice_id')->count();
    }

    public function InvoiceAmount($id)
    {
        $sum = 0;
        $invoice = JournalEntry::where('agent_id', $id)->whereNotNull('invoice_id')->get();
        foreach ($invoice as $value) {
            $sum = $sum + $value->invoice->total_amount;
        }

        return $sum;
    }

    public function payable($journal)
    {

        $comiss = 0;
        if ($journal->commission_type == 1) {

            $comiss += ($journal->total_amount * $journal->agentcommissionAmount) / 100;
        } elseif ($journal->commission_type == 2) {
            $comiss += $journal->agentcommissionAmount;
        }
        return $comiss;


        return $comiss;
    }

    public function Paid($id, $start, $end)
    {
        $pay = SalesComission::where('agents_id', $id)->whereBetween('date', array($start, $end))->sum('amount');
        return $pay;
    }

    public function Customer($id)
    {
        return Contact::find($id)['display_name'];
    }

    public function OperatingincomeTotal($id, $branch_id)
    {
        $this->getBranchUsers($branch_id);

        if ($branch_id == 1) {
            if (is_null($this->start) && is_null($this->end)) {

                $debt   = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereYear('assign_date', date('Y'))->get();

                // $debt   = $debt->whereIn('created_by', $this->targeted_users);

                $debt   = $this->collectionAttributeSum($debt);

                $crt    = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereYear('assign_date', date('Y'))->get();

                // $crt    = $crt->whereIn('created_by', $this->targeted_users);
                $crt    = $this->collectionAttributeSum($crt);

                $total  = (int)$debt - $crt;

                $this->OperatingincomeTotal = $this->OperatingincomeTotal + $total;
                return $total;
            } else {

                $debt   = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereBetween('assign_date', array($this->start, $this->end))->get();


                // $debt   = $debt->whereIn('created_by', $this->targeted_users);
                $debt   = $this->collectionAttributeSum($debt);

                $crt    = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereBetween('assign_date', array($this->start, $this->end))->get();

                // $crt    = $crt->whereIn('created_by', $this->targeted_users);
                $crt    = $this->collectionAttributeSum($crt);

                $total  = (float)$debt - $crt;

                $this->OperatingincomeTotal = $this->OperatingincomeTotal + $total;
                return $total;
            }
        } else {
            if (is_null($this->start) && is_null($this->end)) {

                $debt   = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereYear('assign_date', date('Y'))->get();

                $debt   = $debt->whereIn('created_by', $this->targeted_users);

                $debt   = $this->collectionAttributeSum($debt);

                $crt    = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereYear('assign_date', date('Y'))->get();

                $crt    = $crt->whereIn('created_by', $this->targeted_users);
                $crt    = $this->collectionAttributeSum($crt);

                $total  = (int)$debt - $crt;

                $this->OperatingincomeTotal = $this->OperatingincomeTotal + $total;
                return $total;
            } else {

                $debt   = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereBetween('assign_date', array($this->start, $this->end))->get();


                $debt   = $debt->whereIn('created_by', $this->targeted_users);
                $debt   = $this->collectionAttributeSum($debt);

                $crt    = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereBetween('assign_date', array($this->start, $this->end))->get();

                $crt    = $crt->whereIn('created_by', $this->targeted_users);
                $crt    = $this->collectionAttributeSum($crt);

                $total  = (float)$debt - $crt;

                $this->OperatingincomeTotal = $this->OperatingincomeTotal + $total;
                return $total;
            }
        }
    }

    public function TotalOperatingincome()
    {
        return $this->OperatingincomeTotal;
    }

    public function CostofGoodTotal($id, $branch_id)
    {
        $this->getBranchUsers($branch_id);

        if ($branch_id == 1) {
            if (is_null($this->start) && is_null($this->end)) {

                $debt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereYear('assign_date', date('Y'))->get();

                // $debt   = $debt->whereIn('created_by', $this->targeted_users);
                $debt   = $this->collectionAttributeSum($debt);

                $crt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereYear('assign_date', date('Y'))->get();

                // $crt    = $crt->whereIn('created_by', $this->targeted_users);
                $crt    = $this->collectionAttributeSum($crt);

                $total = (float)$debt - $crt;

                $this->CostofGoodTotal = $this->CostofGoodTotal + $total;
                return $total;
            } else {

                $debt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereBetween('assign_date', array($this->start, $this->end))->get();

                // $debt   = $debt->whereIn('created_by', $this->targeted_users);
                $debt   = $this->collectionAttributeSum($debt);

                $crt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereBetween('assign_date', array($this->start, $this->end))->get();

                // $crt    = $crt->whereIn('created_by', $this->targeted_users);
                $crt    = $this->collectionAttributeSum($crt);

                $total = (float)$debt - $crt;

                $this->CostofGoodTotal = $this->CostofGoodTotal + $total;
                return $total;
            }
        } else {
            if (is_null($this->start) && is_null($this->end)) {

                $debt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereYear('assign_date', date('Y'))->get();

                $debt   = $debt->whereIn('created_by', $this->targeted_users);
                $debt   = $this->collectionAttributeSum($debt);

                $crt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereYear('assign_date', date('Y'))->get();

                $crt    = $crt->whereIn('created_by', $this->targeted_users);
                $crt    = $this->collectionAttributeSum($crt);

                $total = (float)$debt - $crt;

                $this->CostofGoodTotal = $this->CostofGoodTotal + $total;
                return $total;
            } else {

                $debt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereBetween('assign_date', array($this->start, $this->end))->get();

                $debt   = $debt->whereIn('created_by', $this->targeted_users);
                $debt   = $this->collectionAttributeSum($debt);

                $crt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereBetween('assign_date', array($this->start, $this->end))->get();

                $crt    = $crt->whereIn('created_by', $this->targeted_users);
                $crt    = $this->collectionAttributeSum($crt);

                $total = (float)$debt - $crt;

                $this->CostofGoodTotal = $this->CostofGoodTotal + $total;
                return $total;
            }
        }
    }

    public function TotalCostofGood()
    {
        return $this->CostofGoodTotal;
    }

    public function OperatingExpenseTotal($id, $branch_id)
    {
        $this->getBranchUsers($branch_id);

        if ($branch_id == 1) {
            if (is_null($this->start) && is_null($this->end)) {
                $debt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereYear('assign_date', date('Y'))->get();

                // $debt   = $debt->whereIn('created_by', $this->targeted_users);
                $debt   = $this->collectionAttributeSum($debt);

                $crt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereYear('assign_date', date('Y'))->get();

                // $crt   = $crt->whereIn('created_by', $this->targeted_users);
                $crt   = $this->collectionAttributeSum($crt);

                $total = (float)$debt - $crt;

                $this->OperatingExpense = $this->OperatingExpense + $total;
                return $total;
            } else {
                $debt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereBetween('assign_date', array($this->start, $this->end))->get();

                // $debt   = $debt->whereIn('created_by', $this->targeted_users);
                $debt   = $this->collectionAttributeSum($debt);

                $crt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereBetween('assign_date', array($this->start, $this->end))->get();

                // $crt   = $crt->whereIn('created_by', $this->targeted_users);
                $crt   = $this->collectionAttributeSum($crt);

                $total = (float)$debt - $crt;

                $this->OperatingExpense = $this->OperatingExpense + $total;
                return $total;
            }
        } else {
            if (is_null($this->start) && is_null($this->end)) {
                $debt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereYear('assign_date', date('Y'))->get();

                $debt   = $debt->whereIn('created_by', $this->targeted_users);
                $debt   = $this->collectionAttributeSum($debt);

                $crt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereYear('assign_date', date('Y'))->get();

                $crt   = $crt->whereIn('created_by', $this->targeted_users);
                $crt   = $this->collectionAttributeSum($crt);

                $total = (float)$debt - $crt;

                $this->OperatingExpense = $this->OperatingExpense + $total;
                return $total;
            } else {
                $debt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereBetween('assign_date', array($this->start, $this->end))->get();

                $debt   = $debt->whereIn('created_by', $this->targeted_users);
                $debt   = $this->collectionAttributeSum($debt);

                $crt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereBetween('assign_date', array($this->start, $this->end))->get();

                $crt   = $crt->whereIn('created_by', $this->targeted_users);
                $crt   = $this->collectionAttributeSum($crt);

                $total = (float)$debt - $crt;

                $this->OperatingExpense = $this->OperatingExpense + $total;
                return $total;
            }
        }
    }

    public function TotalOperatingExpense()
    {
        return $this->OperatingExpense;
    }

    public function nonoperatingixTotal($id, $branch_id)
    {
        $this->getBranchUsers($branch_id);

        if ($branch_id == 1) {
            if (is_null($this->start) && is_null($this->end)) {
                $debt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereYear('assign_date', date('Y'))->get();

                // $debt   = $debt->whereIn('created_by', $this->targeted_users);
                $debt   = $this->collectionAttributeSum($debt);

                $crt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereYear('assign_date', date('Y'))->get();

                // $crt   = $crt->whereIn('created_by', $this->targeted_users);
                $crt   = $this->collectionAttributeSum($crt);

                $total = (float)$debt - $crt;

                $this->nonoperatingix = $this->nonoperatingix + $total;
                return $total;
            } else {
                $debt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereBetween('assign_date', array($this->start, $this->end))->get();

                // $debt   = $debt->whereIn('created_by', $this->targeted_users);
                $debt   = $this->collectionAttributeSum($debt);

                $crt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereBetween('assign_date', array($this->start, $this->end))->get();

                // $crt   = $crt->whereIn('created_by', $this->targeted_users);
                $crt   = $this->collectionAttributeSum($crt);

                $total = (float)$debt - $crt;

                $this->nonoperatingix = $this->nonoperatingix + $total;
                return $total;
            }
        } else {
            if (is_null($this->start) && is_null($this->end)) {
                $debt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereYear('assign_date', date('Y'))->get();

                $debt   = $debt->whereIn('created_by', $this->targeted_users);
                $debt   = $this->collectionAttributeSum($debt);

                $crt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereYear('assign_date', date('Y'))->get();

                $crt   = $crt->whereIn('created_by', $this->targeted_users);
                $crt   = $this->collectionAttributeSum($crt);

                $total = (float)$debt - $crt;

                $this->nonoperatingix = $this->nonoperatingix + $total;
                return $total;
            } else {
                $debt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereBetween('assign_date', array($this->start, $this->end))->get();

                $debt   = $debt->whereIn('created_by', $this->targeted_users);
                $debt   = $this->collectionAttributeSum($debt);

                $crt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereBetween('assign_date', array($this->start, $this->end))->get();

                $crt   = $crt->whereIn('created_by', $this->targeted_users);
                $crt   = $this->collectionAttributeSum($crt);

                $total = (float)$debt - $crt;

                $this->nonoperatingix = $this->nonoperatingix + $total;
                return $total;
            }
        }
    }

    public function Totalnonoperatingix()
    {
        return $this->nonoperatingix;
    }

    public function netprofit($branch_id)
    {
        $operatingincome = Account::where('account_type_id', 15)->get();
        foreach ($operatingincome as $item) {
            $this->OperatingincomeTotal($item->id, $branch_id);
        }

        $costofgoods = Account::where('account_type_id', 18)->get();
        foreach ($costofgoods as $item) {
            $this->CostofGoodTotal($item->id, $branch_id);
        }

        $operatingExpense = Account::where('account_type_id', 17)->get();
        foreach ($operatingExpense as $item) {
            $this->OperatingExpenseTotal($item->id, $branch_id);
        }

        $nonoperatingix = Account::whereIn('account_type_id', array(16, 19))->get();
        foreach ($nonoperatingix as $item) {
            $this->nonoperatingixTotal($item->id, $branch_id);
        }

        return $this->TotalOperatingincome() - $this->TotalCostofGood() - $this->TotalOperatingExpense() + $this->Totalnonoperatingix();
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

    public function collectionAttributeSum($data)
    {
        $summed_value = 0;

        if (count($data) > 0) {

            foreach ($data as $tmp_data) {
                $summed_value = (float)$summed_value + (float)$tmp_data['amount'];
            }

            return $summed_value;
        } else {
            return 0;
        }
    }

    public function IMEI($item_id)
    {
        $imei_number = StockSerial::where('item_id', $item_id)->first();

        return $imei_number['serial'];
    }

    public function zone($zone_id)
    {
        // dd($zone_id);
        $zone = Zone::find($zone_id);

        return $zone['name'];
    }

    public function PhaseWiseItem($product_phase_id, $raw_material_id)
    {
        $data = ProductPhaseItem::join('product_phase_item_add', 'product_phase_item_add.product_phase_item_id', 'product_phase_item.id')
            ->join('item', 'item.id', 'product_phase_item_add.item_id')
            ->when($raw_material_id != 0, function ($query) use ($raw_material_id) {
                return $query->orWhere('item.id', $raw_material_id);
            })
            ->where('product_phase_item.product_phase_id', $product_phase_id)
            ->selectRaw('product_phase_item_add.*, item.item_name as item_name, item.item_purchase_rate as item_purchase_rate, product_phase_item.date as date, product_phase_item.issued_number as rmi')
            ->get();

        return $data;
    }

    public function PhaseWiseDateRmi($product_phase_id, $product_id)
    {
        $data = ProductPhaseItem::where('product_phase_item.product_phase_id', $product_phase_id)
            ->where('product_phase_item.product_id', $product_id)
            ->selectRaw('product_phase_item.*')
            ->first();

        return $data;
    }

    public function totalReceivable($invoice_id, $product_serial)
    {
        $data = Invoice::join('invoice_entries', 'invoice_entries.invoice_id', 'invoices.id')
            ->where('invoices.id', $invoice_id)
            ->selectRaw('invoice_entries.*')
            ->get();

        foreach ($data as $key => $value) {
            $exp_serial = explode(',', $value->serial);

            foreach ($exp_serial as $key1 => $value1) {
                if ($value1 == $product_serial) {
                    $result = $value->rate;
                }
            }
        }

        $result = isset($result) ? $result : 0;

        return $result;
    }

    public function customerName($invoice_id, $product_serial)
    {
        $data = Invoice::join('contact', 'contact.id', 'invoices.customer_id')
            ->where('invoices.id', $invoice_id)
            ->selectRaw('contact.display_name as display_name')
            ->first();

        $result = isset($data) ? $data->display_name : '';

        return $result;
    }

    public function CustomerNameShow($customer_id)
    {
        $data = Contact::find($customer_id);

        $result = isset($data) ? $data->display_name : '';

        return $result;
    }

    public function totalCollection($sr_id, $start, $end)
    {
        $data               = Invoice::where(DB::Raw('STR_TO_DATE(invoices.invoice_date, "%d-%m-%Y")'), '>=', $start)
            ->where(DB::Raw('STR_TO_DATE(invoices.invoice_date, "%d-%m-%Y")'), '<=', $end)
            ->leftjoin('payment_receives_entries', 'payment_receives_entries.invoice_id', 'invoices.id')
            ->where('invoices.created_by', $sr_id)
            ->groupBy('invoices.customer_id')
            ->selectRaw('invoices.customer_id as customer_id, SUM(invoices.total_amount) as total_sold, SUM(payment_receives_entries.amount) as total_collection')
            ->get()
            ->toArray();


        return $data;
    }
}
