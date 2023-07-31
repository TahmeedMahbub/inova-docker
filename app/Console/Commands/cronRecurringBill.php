<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MoneyOut\Bill;
use App\Models\MoneyOut\BillEntry;
use App\Models\MoneyOut\RecurringBill;
use App\Models\MoneyOut\RecurringBillEntry;
use Carbon\Carbon;

class cronRecurringBill extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recurring:bill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $recurring_bills                           =  RecurringBill::all();
        $start_date                                = Carbon::parse()->format('Y-m-d');
        foreach($recurring_bills as $key=>$recurring_bill )
        {    
            $add_day  = ' + '.$recurring_bill['day_interval']. ' days';
       
            $update_start_date = date('Y-m-d', strtotime($recurring_bill['start_date']. $add_day));

            if(($recurring_bill['instance'] == 0 ||  $recurring_bill['cron'] <= $recurring_bill['instance']) && $recurring_bill['start_date'] == $start_date )
            {
                $bills                          = Bill::count();
                if($bills > 0)
                {
                    $bill                       = Bill::orderBy('created_at', 'desc')->first();
                    $bill_number                = $bill['bill_number'];
                    $bill_number                = $bill_number + 1;
                }
                else
                {
                    $bill_number                = 1;
                }
        
                $bill_number                    = str_pad($bill_number, 6, '0', STR_PAD_LEFT);

                $bill                            = new Bill;
                $bill->order_number             = $recurring_bill['order_number'];
                $bill->bill_number              = $bill_number;
                $bill->adjustment               = $recurring_bill['adjustment'];
                $bill->amount                   = $recurring_bill['amount'];
                $bill->due_amount               = $recurring_bill['amount'];;
                $bill->bill_date                = date("Y-m-d", strtotime($recurring_bill['bill_date']));
                $bill->note                     = $recurring_bill['customer_note'];
                $bill->total_tax                = $recurring_bill['total_tax'];
                $bill->vendor_id                = $recurring_bill['customer_id'];
                $bill->item_category_id         = $recurring_bill['item_category_id'];
                $bill->item_sub_category_id     = $recurring_bill['item_sub_category_id'];
                $bill->created_by               = $recurring_bill['created_by'];
                $bill->updated_by               = $recurring_bill['updated_by'];
                $bill->no_of_installment        = null;
                $bill->day_interval             = null;
                $bill->start_date               = null;
                
                if($bill->save())
                {
                    $ecurring_bill_enties    = RecurringBillEntry::where('recurring_bill_id', $recurring_bill['id'])->get();

                    foreach($ecurring_bill_enties as $key2=>$recurring_bill_entry)
                    {   
                        $bill_entry_insert  = new BillEntry;  
                        $bill_entry_insert->quantity          = $recurring_bill_entry['quantity'];
                        $bill_entry_insert->rate              = $recurring_bill_entry['rate'];
                        $bill_entry_insert->amount            = $recurring_bill_entry['amount'];
                        $bill_entry_insert->item_id           = $recurring_bill_entry['item_id'];
                        $bill_entry_insert->description       = $recurring_bill_entry['description'];
                        $bill_entry_insert->bill_id           = $bill->id;
                        $bill_entry_insert->tax_id            = 1;
                        $bill_entry_insert->account_id        = $recurring_bill_entry['account_id'];
                        $bill_entry_insert->created_by        = $recurring_bill_entry['created_by'];
                        $bill_entry_insert->updated_by        = $recurring_bill_entry['updated_by'];
                        $bill_entry_insert->save();
                       
                    }
                }
                if($recurring_bill['instance'] != 0)
                {
                    $updadte_recurring_bill                                =  RecurringBill::find($recurring_bill['id']);
                    $updadte_recurring_bill->cron                          =  $updadte_recurring_bill['cron'] + 1 ;
                    $updadte_recurring_bill->start_date                    =  date('Y-m-d', strtotime($update_start_date));
                    $updadte_recurring_bill->save();
                }
                else
                {
                    $updadte_recurring_bill                                =  RecurringBill::find($recurring_bill['id']);
                    $updadte_recurring_bill->start_date                    =  date('Y-m-d', strtotime($update_start_date));
                    $updadte_recurring_bill->save(); 
                }
           } 
        }
        
    }
}
