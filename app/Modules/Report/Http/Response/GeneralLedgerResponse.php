<?php
/**
 * Created by PhpStorm.
 * User: ontik
 * Date: 12/11/2017
 * Time: 10:52 AM
 */

namespace App\Modules\Report\Http\Response;

use App\User;
use Illuminate\Support\Facades\DB;
use App\Models\ManualJournal\JournalEntry;
use Response;
class GeneralLedgerResponse
{
    private $branch_id              = 0;
    protected $increasing_limit     = null;
    private $targeted_users         = [];

    public function All($end,$start, $branchId)
    {    
        $account        = JournalEntry::join('account', 'account.id', 'journal_entries.account_name_id')
                                        ->groupBy('account.id')
                                        ->get();

        if ($branchId == 0)
        {
            $branch_id      = session('branch_id');
        }else{
            $branch_id      = $branchId;
        }

        $data            = [];
        $i               = 0;

        $this->getBranchUsers($branch_id);

        try
        {
            $input_to_date      = date("Y-m-d",strtotime($end));
            $input_from_date    = date("Y-m-d",strtotime($start));

            if ($branch_id == 1)
            { 
                foreach($account as $key => $value)
                {
                    $data_debit    = JournalEntry::join('account', 'account.id', 'journal_entries.account_name_id')
                                                    ->where('journal_entries.account_name_id', $value->id)
                                                    ->Where('journal_entries.debit_credit', 1)
                                                    ->where('journal_entries.assign_date', '<=',$input_to_date)
                                                    ->where('journal_entries.assign_date', '>=',$input_from_date)
                                                    ->selectRaw('journal_entries.account_name_id as id, SUM(journal_entries.amount) as debit, account.account_name as name')
                                                    ->groupBy('journal_entries.account_name_id')
                                                    ->first();

                    $data_credit    = JournalEntry::join('account', 'account.id', 'journal_entries.account_name_id')
                                                    ->where('journal_entries.account_name_id', $value->id)
                                                    ->Where('journal_entries.debit_credit', 0)
                                                    ->where('journal_entries.assign_date', '<=',$input_to_date)
                                                    ->where('journal_entries.assign_date', '>=',$input_from_date)
                                                    ->selectRaw('journal_entries.account_name_id as id, SUM(journal_entries.amount) as credit, account.account_name as name')
                                                    ->groupBy('journal_entries.account_name_id')
                                                    ->first();

                    $opening_dr_cr  = JournalEntry::join('account', 'account.id', 'journal_entries.account_name_id')
                                                    ->where('journal_entries.account_name_id', $value->id)
                                                    ->where('journal_entries.assign_date', '<=',$input_from_date)
                                                    ->selectRaw('journal_entries.account_name_id as id, SUM(journal_entries.amount) as opening_balance_amount, account.account_name as name')
                                                    ->groupBy('journal_entries.account_name_id')
                                                    ->first();
                
                    $data[$i]['id']              = $value->id;  
                    $data[$i]['account_name']    = $value->account_name;  
                    $data[$i]['debit']           = !empty($data_debit) ? $data_debit['debit'] :0 ;  
                    $data[$i]['credit']          = !empty($data_credit) ? $data_credit['credit'] : 0;   
                    $data[$i]['opening_balance'] = !empty($opening_dr_cr) ? $opening_dr_cr['opening_balance_amount'] : 0 ;  
                    $data[$i]['balance']         = $data[$i]['debit'] +   $data[$i]['opening_balance'] -  $data[$i]['credit'];
                    $i++; 
                }                     
            }
            else
            {
                foreach($account as $key => $value)
                {
                    $data_debit    = JournalEntry::join('account', 'account.id', 'journal_entries.account_name_id')
                                                    ->where('journal_entries.account_name_id', $value->id)
                                                    ->Where('journal_entries.debit_credit', 1)
                                                    ->where('journal_entries.assign_date', '<=',$input_to_date)
                                                    ->where('journal_entries.assign_date', '>=',$input_from_date)
                                                    ->whereIn('created_by', $this->targeted_users)
                                                    ->selectRaw('journal_entries.account_name_id as id, SUM(journal_entries.amount) as debit, account.account_name as name')
                                                    ->groupBy('journal_entries.account_name_id')
                                                    ->first();

                    $data_credit    = JournalEntry::join('account', 'account.id', 'journal_entries.account_name_id')
                                                    ->where('journal_entries.account_name_id', $value->id)
                                                    ->Where('journal_entries.debit_credit', 0)
                                                    ->where('journal_entries.assign_date', '<=',$input_to_date)
                                                    ->where('journal_entries.assign_date', '>=',$input_from_date)
                                                    ->whereIn('created_by', $this->targeted_users)
                                                    ->selectRaw('journal_entries.account_name_id as id, SUM(journal_entries.amount) as credit, account.account_name as name')
                                                    ->groupBy('journal_entries.account_name_id')
                                                    ->first();

                    $opening_dr_cr  = JournalEntry::join('account', 'account.id', 'journal_entries.account_name_id')
                                                    ->where('journal_entries.account_name_id', $value->id)
                                                    ->where('journal_entries.assign_date', '<=',$input_from_date)
                                                    ->whereIn('created_by', $this->targeted_users)
                                                    ->selectRaw('journal_entries.account_name_id as id, SUM(journal_entries.amount) as opening_balance_amount, account.account_name as name')
                                                    ->groupBy('journal_entries.account_name_id')
                                                    ->first();
                
                    $data[$i]['id']              = $value->id;  
                    $data[$i]['account_name']    = $value->account_name;  
                    $data[$i]['debit']           = !empty($data_debit) ? $data_debit['debit'] :0 ;  
                    $data[$i]['credit']          = !empty($data_credit) ? $data_credit['credit'] : 0;   
                    $data[$i]['opening_balance'] = !empty($opening_dr_cr) ? $opening_dr_cr['opening_balance_amount'] : 0 ;  
                    $data[$i]['balance']         = $data[$i]['debit'] +   $data[$i]['opening_balance'] -  $data[$i]['credit'];
                    $i++; 
                }
            }
         
          return Response($data);
          
        }
        catch(\Exception $exception){
            return [];
        }
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