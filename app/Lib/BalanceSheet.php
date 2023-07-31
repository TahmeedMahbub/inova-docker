<?php
/**
 * Created by PhpStorm.
 * User: Ontik Technology 3
 * Date: 07-08-17
 * Time: 17.43
 */

namespace App\Lib;


use App\Models\ManualJournal\JournalEntry;
use App\User;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;

class BalanceSheet
{

    protected $start        = null;
    protected $end          = null;
    private $branch_id      = 0;
    private $targeted_users = [];

    public function setDate($start,$end)
    {
     $this->start = date('Y-m-d',strtotime($start.'-0 day'));

     $this->end = date('Y-m-d',strtotime($end.'+0 day'));
    }

    public function current_asset($branch_id)
    {
        $this->getBranchUsers($branch_id);
        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                    ->select( DB::raw('account.id'))
                                    ->where('account.account_type_id',2)
                                    ->groupBy('journal_entries.account_name_id')
                                    ->get();
                                     

        $assets         = [];
        $account_name   = '';

        if($branch_id == 1)
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                          ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                          ->where('journal_entries.account_name_id',$item->id)
                                          ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                          ->where('journal_entries.debit_credit',1)
                                          ->get();

                if ($debits != null)
                {
                    // $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debits);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                          ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                          ->where('journal_entries.account_name_id',$item->id)
                                          ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                          ->where('journal_entries.debit_credit',0)
                                          ->get();

                if ($credits != null)
                {
                    // $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credits);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $debit - $credit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }else
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                          ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                          ->where('journal_entries.account_name_id',$item->id)
                                          ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                          ->where('journal_entries.debit_credit',1)
                                          ->get();

                if ($debits != null)
                {
                    $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debit);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                          ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                          ->where('journal_entries.account_name_id',$item->id)
                                          ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                          ->where('journal_entries.debit_credit',0)
                                          ->get();

                if ($credits != null)
                {
                    $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credit);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $debit - $credit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }

        return $assets;
    }

    public function others_asset($branch_id)
    {
        $this->getBranchUsers($branch_id);
        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                    ->select( DB::raw('account.id'))
                                    ->where('account.account_type_id',1)
                                    ->groupBy('journal_entries.account_name_id')
                                    ->get();

        $assets         = [];
        $account_name   = '';

        if($branch_id == 1)
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',1)
                                      ->get();

                if ($debits != null)
                {
                    // $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debits);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',0)
                                      ->get();

                if ($credits != null)
                {
                    // $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credits);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $debit - $credit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }else
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',1)
                                      ->get();

                if ($debits != null)
                {
                    $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debit);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',0)
                                      ->get();

                if ($credits != null)
                {
                    $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credit);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $debit - $credit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }

        return $assets;
    }

    public function others_current_asset($branch_id)
    {

        $this->getBranchUsers($branch_id);
        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                    ->select( DB::raw('account.id'))
                                    ->where('account.parent_account_type_id', 1)
                                    ->where('account.account_type_id', '!=', 1)
                                    ->where('account.account_type_id', '!=', 2)
                                    ->where('account.account_type_id', '!=', 4)
                                    ->where('account.account_type_id', '!=', 5)
                                    ->where('account.account_type_id', '!=', 6)
                                    ->where('account.account_type_id', '!=', 7)
                                    ->groupBy('journal_entries.account_name_id')
                                    ->get();

        $assets         = [];
        $account_name   = '';

        if($branch_id == 1)
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',1)
                                      ->get();

                if ($debits != null)
                {
                    // $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debits);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',0)
                                      ->get();

                if ($credits != null)
                {
                    // $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credits);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $debit - $credit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }else
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',1)
                                      ->get();

                if ($debits != null)
                {
                    $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debit);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',0)
                                      ->get();

                if ($credits != null)
                {
                    $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credit);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $debit - $credit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }

        return $assets;
    }

    public function cash($branch_id)
    {
        $this->getBranchUsers($branch_id);
        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                    ->select( DB::raw('account.id'))
                                    ->where('account.account_type_id',4)
                                    ->groupBy('journal_entries.account_name_id')
                                    ->get();

        $assets         = [];
        $account_name   = '';

        if($branch_id == 1)
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                          ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                          ->where('journal_entries.account_name_id',$item->id)
                                          ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                          ->where('journal_entries.debit_credit',1)
                                          ->get();


                if ($debits != null)
                {
                    // $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debits);
                }
         
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                          ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                          ->where('journal_entries.account_name_id',$item->id)
                                          ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                          ->where('journal_entries.debit_credit',0)
                                          ->get();
   
                if ($credits != null)
                {
                    // $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credits);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $debit - $credit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }else
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',1)
                                      ->get();

                if ($debits != null)
                {
                    $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debit);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',0)
                                      ->get();

                if ($credits != null)
                {
                    $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credit);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $debit - $credit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }

       return $assets;
    }

    public function bank($branch_id)
    {

        $this->getBranchUsers($branch_id);
        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                    ->select( DB::raw('account.id'))
                                    ->where('account.account_type_id',5)
                                    ->groupBy('journal_entries.account_name_id')
                                    ->get();

        $assets = [];
        $account_name= '';

        if($branch_id == 1)
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',1)
                                      ->get();

                if ($debits != null)
                {
                    // $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debits);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',0)
                                      ->get();

                if ($credits != null)
                {
                    // $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credits);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $debit - $credit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }else
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',1)
                                      ->get();

                if ($debits != null)
                {
                    $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debit);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',0)
                                      ->get();

                if ($credits != null)
                {
                    $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credit);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $debit - $credit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }

        return $assets;
    }

    public function stock($branch_id)
    {

        $this->getBranchUsers($branch_id);
        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                    ->select( DB::raw('account.id'))
                                    ->where('account.account_type_id',7)
                                    ->groupBy('journal_entries.account_name_id')
                                    ->get();

        $assets = [];
        $account_name= '';

        if($branch_id == 1)
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',1)
                                      ->get();

                if ($debits != null)
                {
                    // $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debits);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',0)
                                      ->get();

                if ($credits != null)
                {
                    // $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credits);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $debit - $credit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }else
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',1)
                                      ->get();

                if ($debits != null)
                {
                    $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debit);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',0)
                                      ->get();

                if ($credits != null)
                {
                    $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credit);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $debit - $credit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }

        return $assets;
    }

    public function FixedAsset($branch_id)
    {

        $this->getBranchUsers($branch_id);
        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                    ->select( DB::raw('account.id'))
                                    ->where('account.account_type_id',6)
                                    ->groupBy('journal_entries.account_name_id')
                                    ->get();

        $assets         = [];
        $account_name   = '';

        if($branch_id == 1)
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',1)
                                      ->get();

                if ($debits != null)
                {
                    // $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debits);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',0)
                                      ->get();

                if ($credits != null)
                {
                    // $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credits);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $debit - $credit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }else
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',1)
                                      ->get();

                if ($debits != null)
                {
                    $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debit);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',0)
                                      ->get();

                if ($credits != null)
                {
                    $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credit);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $debit - $credit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }

        return $assets;
    }

    public function currentLibilities($branch_id)
    {

        $this->getBranchUsers($branch_id);
        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                    ->select( DB::raw('account.id'))
                                    ->where('account.parent_account_type_id', 2)
                                    ->where('account.account_type_id', '!=', 11)
                                    ->groupBy('journal_entries.account_name_id')
                                    ->get();

        $assets = [];
        $account_name= '';

        if($branch_id == 1)
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',1)
                                      ->get();

                if ($debits != null)
                {
                    // $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debits);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',0)
                                      ->get();

                if ($credits != null)
                {
                    // $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credits);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $credit - $debit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }else
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start, $this->end))
                                      ->where('journal_entries.debit_credit',1)
                                      ->get();

                if ($debits != null)
                {
                    $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debit);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start, $this->end))
                                      ->where('journal_entries.debit_credit',0)
                                      ->get();

                if ($credits != null)
                {
                    $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credit);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $credit - $debit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }

        return $assets;
    }

    public function longTermLibilities($branch_id)
    {
        $this->getBranchUsers($branch_id);
        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                    ->select( DB::raw('account.id'))
                                    ->where('account.account_type_id',11)
                                    ->groupBy('journal_entries.account_name_id')
                                    ->get();

        $assets = [];
        $account_name= '';

        if($branch_id == 1)
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',1)
                                      ->get();

                if ($debits != null)
                {
                    // $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debits);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',0)
                                      ->get();

                if ($credits != null)
                {
                    // $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credits);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $credit - $debit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }else
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',1)
                                      ->get();

                if ($debits != null)
                {
                    $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debit);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',0)
                                      ->get();

                if ($credits != null)
                {
                    $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credit);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $credit - $debit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }

        return $assets;
    }
    
    public function currentYearEarning($branch_id)
    {
        $this->getBranchUsers($branch_id);
        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                    ->select( DB::raw('account.id'))
                                    ->where('account.account_type_id',14)
                                    ->groupBy('journal_entries.account_name_id')
                                    ->get();


        $assets         = [];
        $account_name   = '';

        if($branch_id == 1)
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                          ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                          ->where('journal_entries.account_name_id',$item->id)
                                          ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                          ->where('journal_entries.debit_credit',1)
                                          ->get();

                if ($debits != null)
                {
                    // $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debits);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',0)
                                      ->get();

                if ($credits != null)
                {
                    // $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credits);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $debit - $credit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }else
        {
            foreach ($accounts as $key => $item)
            {

                $debits  = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',1)
                                      ->get();

                if ($debits != null)
                {
                    $debit  = $debits->whereIn('created_by', $this->targeted_users);
                    $debit  = $this->collectionAttributeSum($debit);
                }
              
                $credits = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                                      ->selectRaw("journal_entries.amount as amount, journal_entries.created_by as created_by ,account.account_name as account_name")
                                      ->where('journal_entries.account_name_id',$item->id)
                                      ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                                      ->where('journal_entries.debit_credit',0)
                                      ->get();

                if ($credits != null)
                {
                    $credit  = $credits->whereIn('created_by', $this->targeted_users);
                    $credit  = $this->collectionAttributeSum($credit);
                }
                 
                if(isset($credits[0]['account_name'])){
                    $account_name = $credits[0]['account_name'];
                }elseif(isset($debits[0]['account_name'])){
                    $account_name = $debits[0]['account_name'];
                }

                if(isset($credit)){
                    $credit = $credit;

                }else{
                    $credit = 0;
                }

                if(isset($debit)){
                    $debit  = $debit;

                }else{
                    $debit  = 0;
                }

                $total      = $debit - $credit;

                if(!is_null($total) && !empty($total) ){
                    $assets[$key]['id']     = $item->id;
                    $assets[$key]['name']   = $account_name;
                    $assets[$key]['total']  = $total;
                }
            }

        }

        return $assets;
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

    public function collectionAttributeSum($data)
    {
        $summed_value = 0;
        if($data){

            foreach($data as $tmp_data){
                $summed_value = (double)$summed_value + (double)$tmp_data['amount'];
            }

            return $summed_value;

        }
        else{
            return 0;
        }
    }

}