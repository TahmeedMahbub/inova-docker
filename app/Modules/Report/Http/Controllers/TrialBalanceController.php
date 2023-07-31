<?php

namespace App\Modules\Report\Http\Controllers;

use App\Models\Damage\DamageItem;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Contact\Contact;
use Carbon\Carbon;
use DateTime;
use DB;
use App\Models\AccountChart\Account;
use App\Models\ManualJournal\JournalEntry;

class TrialBalanceController extends Controller
{
    public function index()
    {   $dabit_credit           = [];
        $OrganizationProfile    = OrganizationProfile::find(1);

        $current_time           = Carbon::now()->toDayDateTimeString();
        $start                  = isset($_GET['start']) ? date('Y-m-d', strtotime($_GET['start'])) : (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end                    = isset($_GET['end']) ? date('Y-m-d', strtotime($_GET['end'])) : (new DateTime($current_time))->modify('-0 day')->format('Y-m-d');
        $parent_account         = DB::table('parent_account_type')->get();
         foreach( $parent_account as $key=>$val)

         {
          $dabit_credit[$val->account_name] = JournalEntry::join('account','journal_entries.account_name_id', 'account.id')
                                                          ->selectRaw(DB::raw("SUM( ( CASE WHEN journal_entries.debit_credit = 1 THEN journal_entries.amount ELSE 0 END ) ) AS debit_amount,
                                                           SUM( ( CASE WHEN journal_entries.debit_credit = 0 THEN journal_entries.amount ELSE 0 END ) ) AS credit_amount,account.account_name,account.id as account_id"))
                                                          ->where("account.parent_account_type_id",$val->id)
                                                          ->whereBetween('journal_entries.assign_date',[$start,$end])
                                                          ->groupBy('journal_entries.account_name_id')
                                                          ->get();

          }


          return view("report::trail_balance",compact('OrganizationProfile', 'start', 'end','dabit_credit'));
    }

}
