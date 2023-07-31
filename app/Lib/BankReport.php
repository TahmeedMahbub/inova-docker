<?php
/**
 * Created by PhpStorm.
 * User: Ontik Technology 3
 * Date: 05-08-17
 * Time: 16.31
 */

namespace App\Lib;


use App\Models\Contact\Contact;
use App\Models\ManualJournal\JournalEntry;
use App\User;

class BankReport
{

    protected $totaldeposit = null;
    protected $totalwithdraw = null;
    protected $start = null;
    protected $end = null;
      
    protected $branch_id       = 1;
    protected $targeted_users  = [];
    
    public function setDate($start=null, $end=null, $branch_id=1)
    {
       $this->start =   $start;
       $this->end =   date('Y-m-d', strtotime($end . ' +0 day'));
       $this->branch_id = $branch_id;
    }
    
    public function deposit($account_id=null)
    {
        $this->getBranchUsers($this->branch_id);
        
        if(is_null($account_id)){
            return 0;
        }
        
        $dep = JournalEntry::where('debit_credit',1)->where('account_name_id',$account_id)->whereBetween('assign_date',array($this->start,$this->end))->get();
        
        if($this->branch_id != 1){
            $dep  = $dep->whereIn('created_by', $this->targeted_users);
        }
        
        $dep = $this->collectionAttributeSum($dep);
        
        return $dep;
    }
    
    public function deposit_openning_balance($account_id = null)
    {
        $this->getBranchUsers($this->branch_id);
        
        if(is_null($account_id)){
            return 0;
        }

        $dep = JournalEntry::where('debit_credit', 1)->where('account_name_id', $account_id)->whereDate('assign_date', '<', $this->start)->get();
      
        if($this->branch_id != 1){
            $dep  = $dep->whereIn('created_by', $this->targeted_users);
        }
        
        $dep = $this->collectionAttributeSum($dep);
          
        return $dep;
    } 

    public function withdraw($account_id=null)
    {
        $this->getBranchUsers($this->branch_id);
        
        if(is_null($account_id)){
            return 0;
        }
        
        $withdraw =JournalEntry::where('debit_credit',0)->where('account_name_id',$account_id)->whereBetween('assign_date',array($this->start,$this->end))->get();
        
        if($this->branch_id != 1){
            $withdraw  = $withdraw->whereIn('created_by', $this->targeted_users);
        }
        
        $withdraw = $this->collectionAttributeSum($withdraw);
        
        return $withdraw;
    }
    
    public function withdraw_openning_balance($account_id=null)
    {
        $this->getBranchUsers($this->branch_id);
        
        if(is_null($account_id)){
            return 0;
        }
        
        $withdraw = JournalEntry::where('debit_credit',0)->where('account_name_id',$account_id)->whereDate('assign_date','<',$this->start)->get();
        
        if($this->branch_id != 1){
            $withdraw  = $withdraw->whereIn('created_by', $this->targeted_users);
        }
        
        $withdraw = $this->collectionAttributeSum($withdraw);
        
        return $withdraw;
    }
    
    public function contact($id= null)
    {
       $name= Contact::where('account_id',$id)->first();
       $name = isset($name->display_name)?$name->display_name:'No Name';
       return $name;
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
      
        if(count($data) > 0){

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