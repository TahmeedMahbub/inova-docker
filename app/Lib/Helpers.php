<?php namespace App\Lib;

use DB;
use DateTime;
use App\Models\Tax;
use NumberFormatter;
use App\Models\Setting\Unit;
use App\Models\MoneyOut\Bill;
use App\Models\Inventory\Item;
use App\Models\Company\Company;
use App\Models\Contact\Contact;
use App\Models\Inventory\Stock;
use App\Models\Moneyin\Invoice;
use App\Models\Crm\Status\Status;
use App\Models\Moneyin\CreditNote;
use App\Models\MoneyOut\BillEntry;
use App\Models\AccessLevel\Modules;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\MoneyOut\PaymentMade;
use Illuminate\Support\Facades\Auth;
use App\Models\Moneyin\ExcessPayment;

use App\Models\MoneyOut\VendorCredit;
use App\Models\AccessLevel\AccessLevel;
use App\Models\Inventory\ItemVariation;
use App\Models\Moneyin\CreditNoteEntry;

use App\Models\Moneyin\PaymentReceives;
use App\Models\Moneyin\CreditNotePayment;
use App\Models\MoneyOut\PaymentMadeEntry;
use App\Models\ManualJournal\JournalEntry;
use App\Models\MoneyOut\VendorCreditPayment;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\Recruit_Customer\Recruit_customer;

class Helpers {

    public function getStatusName($id){
        $status = Status::find($id);

        return $status['name'];
    }

    public function getDueBalance($id)
    {
        $paid_amount = 0;
        $total_amount = Invoice::find($id)->total_amount;
        $paid_amount = $this->getPaidAmount($id);

        return ($total_amount - $paid_amount);
    }

    public function getBillDueBalance($id)
    {
        $paid_amount = 0;
        $total_amount = Bill::find($id)->amount;
        $paid_amount = $this->getBillPaidAmount($id);

        return ($total_amount - $paid_amount);
    }

    public function getReference($id)
    {
        $tot=Contact::find($id)->display_name;
        return $tot;
    }

    public function getCustomerName($id)
    {
        return Contact::find($id)->display_name;

    }

    public function getBillAmount_in_word($id)
    {
        $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);

        return $f->format(Bill::find($id)->amount);

    }

    public function conveyanceBillAmount_in_word($amount)
    {
        $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);

        return $f->format($amount);

    }

    public function getBillAmount($id)
    {
        return Bill::find($id)->amount;

    }

    public function getCustomerAddress($id)
    {

        $d = Recruit_customer::where('pax_id',$id)->first();
        if(isset($d->addressEN)){
            return (string) $d->addressEN;
        }else{
            return null;
        }

    }

    public function getCustomerNumber($id)
    {
        $number= Contact::find($id);
        if(isset($number->phone_number_1)){
            return (string)$number->phone_number_1;
        }else{
            return null;
        }


    }

    public function number($number)
    {
        $search_array= array("এক", "দুই", "তিন", "চার", "পাচ", "ছই", "সাত", "আট", "নই", "০");
        $replace_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $en_number = str_replace( $replace_array,$search_array , $number);

        return $en_number;
    }

    function bn2enNumber ($number)
    {
        $search_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $replace_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $en_number = str_replace($replace_array,$search_array, $number);

        return $en_number;
    }

    public function englishNumberToBanglaConvert()
    {

    }

    public function englishtobangla(){

        $currentDate = date("F j, Y");
        $engDATE = array(1,2,3,4,5,6,7,8,9,0,January,February,March,April,May,June,July,August,September,October,November,December,Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday);
        $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার','
         বুধবার','বৃহস্পতিবার','শুক্রবার'
        );
        $convertedDATE = str_replace($engDATE, $bangDATE, $currentDate);
        return $convertedDATE;
    }

    public function getCompanyname($id)
    {
        return Company::find($id)->name;

    }

    public function getPaymentStatus($id)
    {
        $paid_amount = 0;
        $total = Invoice::find($id);
        $total_amount = Invoice::find($id)->total_amount;
        $paid_amount = $this->getPaidAmount($id);

        if ($total->save==1){
            return "Draft";
        }

        if(($total_amount - $paid_amount) == $total_amount)
        {
            return "Due to Pay";
        }
        if($total_amount == $paid_amount)
        {
            return "Paid";
        }

        return "Partially Paid";
    }

    public function dueDate($id)
    {
        $today = date("Y-m-d");
        $expire = Invoice::find($id)->payment_date;
        $today_time = strtotime($today);
        $expire_time = strtotime($expire);

        //        if ($expire_time < $today_time)
        //        {
        //            return "Over Date";
        //        }
        return $expire;
    }

    public function billDueDate($id)
    {
        $today = date("Y-m-d");
        $expire = Bill::find($id)->due_date;
        $today_time = strtotime($today);
        $expire_time = strtotime($expire);

        if ($expire_time < $today_time)
        {
            return "Over Date";
        }
        return $expire;
    }

    public function getPaidAmount($id) {
        $payment_amount = DB::table('payment_receives_entries')->where('invoice_id', $id)->sum('amount');
        $credit_amount = DB::table('credit_note_payments')->where('invoice_id', $id)->sum('amount');

        $paid_amount = ($payment_amount + $credit_amount);
        return $paid_amount;
    }

    public function getBillPaidAmount($id) {
        $paid_amount = DB::table('payment_made_entry')->where('bill_id', $id)->sum('amount');
        return $paid_amount;
    }


    public function creditAvailable($credit_note_id, $invoice_id)
    {
        $credit_use_amount = DB::table('credit_note_payments')->sum('amount');
        $credit_amount = CreditNote::find(5)->total_credit_note;

        $credit_available = $credit_amount - $credit_use_amount;
        return $credit_available;
    }

    public function findCredit($invoice_id, $customer_id)
    {
        $use_credits = CreditNote::where('customer_id', $customer_id)->where('available_credit', '>', 0)->get();
        return $use_credits;
    }

    public function checkItemQuantity($data)
    {

        foreach ($data['item_id'] as $key => $item)
        {
            $stock              = (Item::find($item)->total_purchases - Item::find($item)->total_sales);
            if($data['quantity_pcs'][$key] > $stock) return false;
        }

        return false;

    }

    public function checkItemStock($data)
    {

        $quantity=0;
        $stock=0;
        foreach ($data->invoiceEntries as $item)
        {

            if($item->item->item_category_id == 2)
            {
                continue;
            }

            $stock = ($item->item->total_purchases - $item->item->total_sales);

            $quantity=$data->invoiceEntries->sum('quantity');

        }

        if($quantity > $stock){
            return true;
        }else{
            return false;
        }

    }

    public function updateItemAfterCreatingInvoice2($data)
    {
        $i = 0;
        foreach ($data->invoiceEntries as $item)
        {

        //            if($item->item->item_category_id == 2)
        //            {
        //                continue;
        //            }
            if(isset($item->item->id)){
                $total_sale = ($item->item->total_sales + $item->quantity);
                $update_item=  Item::find($item->item->id);
                $update_item->total_sales = $total_sale;
                $update_item->save();
            }

            $i++;

        }

        return true;
    }

    public function updateItemAfterCreatingInvoice($data)
    {
        $i = 0;

        foreach ($data['item_id'] as $item)
        {
            if(!empty($data['selected_variation'][$i])){
                $item_variation = ItemVariation::find($data['selected_variation'][$i]);
                $item_variation->total_sales = $item_variation['total_sales'] + $data['quantity_pcs'][$i];
                $item_variation->update();
            }else{
                $item = Item::find($item);
                $item->total_sales = $item['total_sales'] + $data['quantity_pcs'][$i];
                $item->update();
            }
            $i++;
        }

        return true;
    }

      public function updateItemAfterCreatingInvoice3($data)
    {
     

       
            $item = Item::find($data['item_id']);

            $item->total_sales = $item['total_sales'] +1;
            $item->update();
            

        
    }



    public function updateItemAfterUpdatingInvoice($data)
    {

        $this->deleteItemAfterCreatingInvoice($data);

        $i = 0;
        foreach ($data['item_id'] as $item)
        {
            if(!empty($data['selected_variation'][$i])){
                $item_variation                 = ItemVariation::find($data['selected_variation'][$i]);
                $item_variation->total_sales    = $item_variation['total_sales'] + $data['quantity_pcs'][$i];
                $item_variation->update();
            }else{
                $item                           = Item::find($item);
                $item->total_sales              = $item['total_sales'] + $data['quantity_pcs'][$i];
                $item->update();
            }
            $i++;
        }

    }

    public function deleteItemAfterCreatingInvoice($data)
    {
        $invoice_items = InvoiceEntry::where('invoice_id', $data['invoice_id'])->get();
        foreach ($invoice_items as $invoice_item)
        {

            if(!empty($invoice_item['variation_id'])){
                $item_variation                 = ItemVariation::find($invoice_item['variation_id']);
                $item_variation->total_sales    = $item_variation['total_sales'] - $invoice_item['quantity'];
                $item_variation->update();
            }else{
                $item                           = Item::find($invoice_item['item_id']);
                $item->total_sales              = $item['total_sales'] - $invoice_item['quantity'];
                $item->update();
            }
        }
    }


    public function updateItemAfterCreatingBill($data, $bill_id, $user_id)
    {
        $i                          = 0;

        foreach($data['item_id'] as $item)
        {
            $item                   = Item::find($item);
            $basic_unit_conversion  = Unit::find($data['unit_id'][$i])->basic_unit_conversion;

            $item->total_purchases  = $item['total_purchases'] + $data['quantity_pcs'][$i] * $basic_unit_conversion;
            $item->total_stock      = $item['total_stock'] + $data['quantity_pcs'][$i] * $basic_unit_conversion;
            
            $item->update();
            $i++;
        }

        //insert item in stock after creation bill
        $this->addStockFromBill($data, $bill_id, $user_id);

        return true;

    }

    public function addStockFromBill($data, $bill_id, $user_id)
    {
        $i                      = 0;

        foreach ($data['item_id'] as $item)
        {
            $stock                      = new Stock;
            $stock->total               = $data['quantity_pcs'][$i];
            $stock->date                = date('Y-m-d', strtotime($data['bill_date']));
            $stock->item_category_id    = Item::find($data['item_id'][$i])->itemCategory->id;
            $stock->item_id             = $data['item_id'][$i];
            $stock->bill_id             = $bill_id;
            $stock->branch_id           = session('branch_id');
            $stock->created_by          = $user_id;
            $stock->updated_by          = $user_id;
            
            $stock->save();
            $i++;
        }

    }

    public function updateItemAfterUpdatingBill($data, $user_id)
    {

        $this->deleteOldItemBeforeUpdatingBill($data);

        $this->deleteOldStockBeforeUpdatingBill($data);

        $i                          = 0;

        foreach ($data['item_id'] as $item)
        {
            $unit                   = Unit::find($data['unit_id'][$i]);
            $item                   = Item::find($item);
            
            $item->total_purchases  = $item['total_purchases'] + ($data['quantity_pcs'][$i] * $unit->basic_unit_conversion);
            $item->total_stock      = $item['total_stock'] + ($data['quantity_pcs'][$i] * $unit->basic_unit_conversion);
            
            $item->update();
            $i++;
            
        }
        
        //insert item in stock after creation bill
        $this->addStockFromBill($data, $data['bill_id'], $user_id);

    }

    public function deleteOldItemBeforeUpdatingBill($data)
    {
        $bill_items = BillEntry::where('bill_id', $data['bill_id'])->get();
        foreach ($bill_items as $bill_item)
        {
            $item = Item::find($bill_item['item_id']);
            $item->total_purchases  = $item['total_purchases'] - $bill_item['quantity'];
            $item->total_stock      = $item['total_stock'] - $bill_item['quantity'];
            $item->update();
        }
    }

    public function deleteOldStockBeforeUpdatingBill($data)
    {
        $stocks = Bill::find($data['bill_id'])->stocks();
        $stocks->delete();
    }

    public function itemBackAfterDeletingBill($bill_id)
    {
        $bill_entries = BillEntry::where('bill_id', $bill_id)->get();

        foreach ($bill_entries as $bill_entry)
        {
            $item = Item::find($bill_entry->item_id);
            $item->total_purchases = $item['total_purchases'] - $bill_entry->quantity;
            $item->update();
        }
    }




    //for credit note
    public function updateItemAfterCreatingCreditNote($data, $credit_note_id, $user_id)
    {
        $i = 0;
        foreach ($data['item_id'] as $item)
        {
            if(!empty($data['selected_variation'][$i])){
                $item_variation = ItemVariation::find($data['selected_variation'][$i]);
                $item_variation->total_sale_return = $item_variation['total_sale_return'] + $data['quantity_pcs'][$i];
                $item_variation->update();
            }else{
                $item = Item::find($item);
                $item->total_sale_return = $item['total_sale_return'] + $data['quantity_pcs'][$i];
                $item->update();
            }
            $i++;
        }

        //insert item in stock after creation bill
        $this->addStockFromCreditNote($data, $credit_note_id, $user_id);

        return true;
    }
  //for credit note
    public function updateItemAfterCreatingCreditNoteProductTransfer($data, $credit_note_id, $user_id,$date)
    {
       
            $item = Item::find($data['item_id']);
            $item->total_purchases = $item['total_purchases'] + $data['quantity_pcs'];
            $item->update();
           

        //insert item in stock after creation bill
        $this->addStockFromCreditNoteProductTransfer($data, $credit_note_id, $user_id,$date);

        return true;
    }

    public function addStockFromCreditNote($data, $credit_note_id, $user_id)
    {
        $i = 0;
        foreach ($data['item_id'] as $item)
        {
            $stock = new Stock;
            $stock->total = $data['quantity_pcs'][$i];
            $stock->date = date('Y-m-d', strtotime($data['credit_note_date']));
            $stock->item_category_id = Item::find($data['item_id'][$i])->itemCategory->id;
            $stock->item_id = $data['item_id'][$i];
            $stock->credit_note_id = $credit_note_id;
            $stock->branch_id = session('branch_id');
            $stock->created_by = $user_id;
            $stock->updated_by = $user_id;
            $stock->save();
            $i++;
        }

    }
    public function addStockFromCreditNoteProductTransfer($data, $credit_note_id, $user_id,$date)
    {
        
            $stock                      = new Stock;
            $stock->total               = $data['quantity_pcs'];
            $stock->date                = date("Y-m-d", strtotime($date));
            $stock->item_category_id    = Item::find($data['item_id'])->itemCategory->id;
            $stock->item_id             = $data['item_id'];
            $stock->credit_note_id      = $credit_note_id;
            $stock->branch_id           = session('branch_id');
            $stock->created_by          = $user_id;
            $stock->updated_by          = $user_id;
            $stock->save();
      
    }

    public function updateItemAfterUpdatingCreditNote($data, $user_id, $credit_note_id)
    {
        if (isset($data['item_id']))
        {
            $this->deleteOldItemBeforeUpdatingCreditNote($data, $credit_note_id);

            $this->deleteOldStockBeforeUpdatingCreditNote($data, $credit_note_id);

            $i = 0;
            foreach ($data['item_id'] as $item)
            {
                if(!empty($data['selected_variation'][$i])){
                    $item_variation = ItemVariation::find($data['selected_variation'][$i]);
                    $item_variation->total_sale_return = $item_variation['total_sale_return'] + $data['quantity_pcs'][$i];
                    $item_variation->update();
                }else{
                    $item = Item::find($item);
                    $item->total_sale_return = $item['total_sale_return'] + $data['quantity_pcs'][$i];
                    $item->update();
                }
                $i++;
            }

            //insert item in stock after creation bill
            $this->addStockFromCreditNote($data, $credit_note_id, $user_id);
        }
    }

    public function deleteOldItemBeforeUpdatingCreditNote($data, $credit_note_id)
    {
        $credit_note_items = CreditNoteEntry::where('credit_note_id', $credit_note_id)->get();
        foreach ($credit_note_items as $credit_note_item)
        {
            if(!empty($credit_note_item['variation_id'])){
                $item_variation = ItemVariation::find($credit_note_item['variation_id']);
                $item_variation->total_sale_return = $item_variation['total_sale_return'] - $credit_note_item['quantity'];
                $item_variation->update();
            }else{
                $item = Item::find($credit_note_item['item_id']);
                $item->total_sale_return = $item['total_sale_return'] - $credit_note_item['quantity'];
                $item->update();
            }
        }
    }

    public function deleteOldStockBeforeUpdatingCreditNote($data, $credit_note_id)
    {
        $stocks = CreditNote::find($credit_note_id)->stocks();
        $stocks->delete();
    }

    public function itemBackAfterDeletingCreditNote($credit_note_id)
    {
        $credit_note_entries = CreditNoteEntry::where('credit_note_id', $credit_note_id)->get();

        foreach ($credit_note_entries as $credit_note_entry)
        {
            if(!empty($credit_note_entry->variation_id)){
                $item_variation = ItemVariation::find($credit_note_entry->variation_id);
                $item_variation->total_sale_return = $item_variation['total_sale_return'] - $credit_note_entry->quantity;
                $item_variation->update();
            }else{
                $item = Item::find($credit_note_entry->item_id);
                $item->total_sale_return = $item['total_sale_return'] - $credit_note_entry->quantity;
                $item->update();
            }
        }
    }

    public function updatePaymentReceiveEntryAfterExcessAmountUse($invoice_id, $payment_receive_id, $amount, $user_id)
    {
        $payment_receive_entry = PaymentReceiveEntryModel::where('payment_receives_id', $payment_receive_id)->where('invoice_id', $invoice_id)->first();
        if($payment_receive_entry)
        {
            $payment_receive_entry->amount = $payment_receive_entry['amount'] + $amount;
            $payment_receive_entry->update();
        }
        else
        {
            $payment_receive_entry = new PaymentReceiveEntryModel;
            $payment_receive_entry->amount              = $amount;
            $payment_receive_entry->payment_receives_id = $payment_receive_id;
            $payment_receive_entry->invoice_id          = $invoice_id;
            $payment_receive_entry->created_by          = $user_id;
            $payment_receive_entry->updated_by          = $user_id;
            $payment_receive_entry->save();
        }
    }

    public function updatePaymentMadeEntryAfterExcessAmountUse($bill_id, $payment_made_id, $amount, $user_id)
    {
        $payment_made_entry = PaymentMadeEntry::where('payment_made_id', $payment_made_id)->where('bill_id', $bill_id)->first();
        if($payment_made_entry)
        {
            $payment_made_entry->amount = $payment_made_entry['amount'] + $amount;
            $payment_made_entry->update();
        }
        else
        {
            $payment_made_entry = new PaymentMadeEntry;
            $payment_made_entry->amount              = $amount;
            $payment_made_entry->payment_made_id     = $payment_made_id;
            $payment_made_entry->bill_id             = $bill_id;
            $payment_made_entry->created_by          = $user_id;
            $payment_made_entry->updated_by          = $user_id;
            $payment_made_entry->save();
        }
    }

    public function addOrUpdateJournalEntry($invoice_id, $payment_receive_id, $amount, $user_id)
    {
        $excess_payment = JournalEntry::where('payment_receives_id', $payment_receive_id)->where('invoice_id', $invoice_id)->first();
        $contact_id = PaymentReceives::find($payment_receive_id)->customer_id;
        if($excess_payment)
        {
            //$excess_payment->amount = $excess_payment['amount'] + $amount;
            $update_amount = $excess_payment['amount'] + $amount;
            JournalEntry::where('payment_receives_id', $payment_receive_id)->where('invoice_id', $invoice_id)
                ->update([
                    'amount' => $update_amount,
                ]);
            //$excess_payment->update();
        }
        else
        {
            $excess_payment = new JournalEntry;
            $excess_payment->amount              = $amount;
            $excess_payment->debit_credit        = 0;
            $excess_payment->account_name_id     = 5;
            $excess_payment->jurnal_type         = 'payment_receive1';
            $excess_payment->contact_id          = $contact_id;
            $excess_payment->payment_receives_id = $payment_receive_id;
            $excess_payment->invoice_id          = $invoice_id;
            $excess_payment->created_by          = $user_id;
            $excess_payment->updated_by          = $user_id;
            $excess_payment->assign_date         = \Carbon\Carbon::now()->toDateTimeString();
            $excess_payment->save();

            $excess_payment = new JournalEntry;
            $excess_payment->amount              = $amount;
            $excess_payment->debit_credit        = 1;
            $excess_payment->account_name_id     = 10;
            $excess_payment->jurnal_type         = 'payment_receive1';
            $excess_payment->contact_id          = $contact_id;
            $excess_payment->payment_receives_id = $payment_receive_id;
            $excess_payment->invoice_id          = $invoice_id;
            $excess_payment->created_by          = $user_id;
            $excess_payment->updated_by          = $user_id;
            $excess_payment->assign_date         = \Carbon\Carbon::now()->toDateTimeString();
            $excess_payment->save();
        }
    }

    public function vendor($expenseId)
    {
        //$expenseId
        $results = DB::select( DB::raw("SELECT contact.display_name FROM `expense` JOIN contact ON contact.id = expense.vendor_id WHERE expense.id = :expenseid limit 1"), array(
            'expenseid' => $expenseId,
        ));

        $converttojson=json_encode($results);
        $explode = explode(":",$converttojson);

        if(isset($explode[1])){
            return trim($explode[1],'"}]');
        }

    }

    public function addOrUpdateJournalEntryAfterUsingExcessAmountInBill($bill_id, $payment_made_id, $amount, $user_id)
    {
        $excess_payment = JournalEntry::where('payment_made_id', $payment_made_id)->where('bill_id', $bill_id)->first();
        $vendor_id = PaymentMade::find($payment_made_id)->vendor_id;
        $payment_made_entry_id = PaymentMadeEntry::where(['payment_made_id' => $payment_made_id,'bill_id' => $bill_id])->first()->id;

        if($excess_payment)
        {
            //$excess_payment->amount = $excess_payment['amount'] + $amount;
            $update_amount = $excess_payment['amount'] + $amount;
            JournalEntry::where('payment_made_id', $payment_made_id)->where('bill_id', $bill_id)
                ->update([
                    'amount' => $update_amount,
                ]);
            //$excess_payment->update();
        }
        else
        {
            $excess_payment = new JournalEntry;
            $excess_payment->amount              = $amount;
            $excess_payment->debit_credit        = 0;
            $excess_payment->account_name_id     = 27;
            $excess_payment->jurnal_type         = 'payment_made1';
            $excess_payment->contact_id          = $vendor_id;
            $excess_payment->payment_made_id     = $payment_made_id;
            $excess_payment->bill_id             = $bill_id;
            $excess_payment->payment_made_entry_id = isset($payment_made_entry_id)?$payment_made_entry_id:Null;
            $excess_payment->assign_date         = \Carbon\Carbon::now()->toDateTimeString();
            $excess_payment->created_by          = $user_id;
            $excess_payment->updated_by          = $user_id;
            $excess_payment->save();

            $excess_payment = new JournalEntry;
            $excess_payment->amount              = $amount;
            $excess_payment->debit_credit        = 1;
            $excess_payment->account_name_id     = 11;
            $excess_payment->jurnal_type         = 'payment_made1';
            $excess_payment->contact_id          = $vendor_id;
            $excess_payment->payment_made_id     = $payment_made_id;
            $excess_payment->bill_id             = $bill_id;
            $excess_payment->payment_made_entry_id = isset($payment_made_entry_id)?$payment_made_entry_id:Null;
            $excess_payment->assign_date         = \Carbon\Carbon::now()->toDateTimeString();
            $excess_payment->created_by          = $user_id;
            $excess_payment->updated_by          = $user_id;
            $excess_payment->save();
        }
    }

    // public function addOrUpdateJournalEntryAfterUsingVendorCreditInBill($bill_id, $vendor_credit_id, $amount, $user_id)
    // {
        
    // }


    public function itemBackAfterDeleteInvoice($item_id, $variation_id, $item_number)
    {
        $item = Item::find($item_id);
        $item->total_sales = $item['total_sales'] - $item_number;
        $item->update();
    }

    public function paymentReceiveBackAfterDeleteInvoice($payment_receives_id, $amount)
    {
        $payment_receive = PaymentReceives::find($payment_receives_id);
        $payment_receive->excess_payment = $payment_receive['excess_payment'] + $amount;
        $payment_receive->update();
    }

    public function paymentMadeBackAfterDeleteBill($payment_made_id, $amount)
    {
        $payment_made = PaymentMade::find($payment_made_id);
        $payment_made->excess_amount = $payment_made['excess_amount'] + $amount;
        $payment_made->update();
    }

    public function creditNoteBackAfterDeleteInvoice($credit_note_id, $amount)
    {
        $credit_note = CreditNote::find($credit_note_id);
        $credit_note->available_credit = $credit_note['available_credit'] + $amount;
        $credit_note->update();
    }


    public function calculateTotalTax($tax_type, $tax, $amount)
    {
        $total_tax = 0;
        for($i = 0; $i < count($tax); $i++)
        {
            $tax_amount = Tax::find($tax[$i])->amount_percentage;
            if($tax_type == 1)
            {
                $total_tax = $total_tax + ($tax_amount*$amount[$i]/100);
            }
            else
            {
                $total_tax = $total_tax + ($tax_amount*$amount[$i]/110);
            }
        }
        return $total_tax;
    }

    public function totalAmount($amount)
    {
        $total_amount = 0;
        for($i = 0; $i < count($amount); $i++)
        {
            $total_amount = $total_amount + $amount[$i];
        }
        return $total_amount;
    }


    public function updateDueBiilAfterPaymentMade($data)
    {
        $i = 0;
        foreach ($data['bill_id'] as $bill_id)
        {
            if (!$data['bill_amount'][$i] || $data['bill_amount'][$i] < 0)
            {
                $i++;
            }
            else
            {
                $this->updateDue($data['bill_id'][$i], $data['bill_amount'][$i]);
                $i++;
            }
        }
    }

    public function updateDueBiilAfterPaymentMadeEdit($payment_made_entry)
    {
        for($i = 0; $i < count($payment_made_entry); $i++)
        {
            $bill = Bill::find($payment_made_entry[$i]['bill_id']);
            $bill->due_amount = $bill['due_amount'] + $payment_made_entry[$i]['amount'];
            $bill->update();
        }
    }

    public function updateDue($bill_id, $amount)
    {
        $bill = Bill::find($bill_id);
        $bill->due_amount = $bill['due_amount'] - $amount;
        $bill->update();
    }

    public function isPaymentMadeInThisBill($bill_id)
    {
        $payment_mades = PaymentMadeEntry::where('bill_id', $bill_id)->get();

        if(count($payment_mades) > 0)
            return true;

        return false;
    }







    public function updateDueInvoiceAfterPaymentReceive($data)
    {
        $i = 0;
        $amount=0;

        foreach ($data['invoice_id'] as $invoice_id)
        {
            //manually setting the data to not messing up with the following codes

            $data['vat_adjust_des'][$i]         = 0;
            $data['tax_adjust_des'][$i]         = 0;
            $data['other_adjust_des'][$i]       = 0;

            //manually setting the data to not messing up with the following codes ends

            if ((!$data['invoice_amount'][$i] || $data['invoice_amount'][$i] < 0) && !$data["vat_adjust_des"][$i] && !$data["tax_adjust_des"][$i] && !$data["other_adjust_des"][$i])
            {
                $i++;
            }
            else
            {
                $invoice_amount     = isset($data['invoice_amount'][$i]) ? floatval($data['invoice_amount'][$i]) : 0;
                $vat_adjustment     = isset($data["vat_adjust_des"][$i]) ? floatval($data["vat_adjust_des"][$i]) : 0;
                $tax_adjustment     = isset($data["tax_adjust_des"][$i]) ? floatval($data["tax_adjust_des"][$i]) : 0;
                $others_adjustment  = isset($data["other_adjust_des"][$i]) ? floatval($data["other_adjust_des"][$i]) : 0;

                $amount =  $invoice_amount + $vat_adjustment + $tax_adjustment + $others_adjustment;
                $this->updateDueInvoice($data['invoice_id'][$i], $amount);
                $i++;
            }

            $amount = 0;
        }
    }

    public function updateInvoiceAdjustmentsAfterPaymentReceiveEdit($payment_receive_entry, $data)
    {
        $i          = 0;
        $j          = 0;
        $amount     = 0;

        foreach ($data['invoice_id'] as $invoice_id)
        {
            $pre_vat_adjustment    = 0;
            $pre_tax_adjustment    = 0;
            $pre_other_adjustment  = 0;

            //manually setting the data to not messing up with the following codes

            $data['vat_adjust_des'][$i]         = 0;
            $data['tax_adjust_des'][$i]         = 0;
            $data['other_adjust_des'][$i]       = 0;

            //manually setting the data to not messing up with the following codes ends

            for($j = 0; $j < count($payment_receive_entry); $j++){

                if($data['invoice_id'][$i] == $payment_receive_entry[$j]['invoice_id']){

                    $pre_vat_adjustment    = isset($payment_receive_entry[$j]['vat_adjustment'])? $payment_receive_entry[$j]['vat_adjustment'] : 0;
                    $pre_tax_adjustment    = isset($payment_receive_entry[$j]['tax_adjustment'])? $payment_receive_entry[$j]['tax_adjustment'] : 0;
                    $pre_other_adjustment  = isset($payment_receive_entry[$j]['others_adjustment'])? $payment_receive_entry[$j]['others_adjustment'] : 0;
                }
            }

            $invoice = Invoice::find($data['invoice_id'][$i]);

            $invoice->vat_adjustment        = ($invoice->vat_adjustment > 0) ? $invoice->vat_adjustment : (0 - $pre_vat_adjustment + ($data['vat_adjust_des'][$i] > 0)? $data['vat_adjust_des'][$i] : 0);
            $invoice->tax_adjustment        = ($invoice->tax_adjustment > 0) ? $invoice->tax_adjustment : (0 - $pre_tax_adjustment + ($data['tax_adjust_des'][$i] > 0) ? $data['tax_adjust_des'][$i] : 0);
            $invoice->others_adjustment     = ($invoice->others_adjustment > 0) ? $invoice->others_adjustment : (0 - $pre_other_adjustment + ($data['other_adjust_des'][$i] > 0) ? $data['other_adjust_des'][$i] : 0);

            $invoice->update();

            $i++;
        }

        return true;
    }

    public function updateJournalEntriesAdjustmentsAfterPaymentReceiveEdit($payment_receive_entry, $data)
    {
        $user_id =  Auth::id();
        $i = 0;
        $j = 0;
        $amount=0;

        if(isset($data['invoice_id'])) {

            foreach ($data['invoice_id'] as $invoice_id)
            {
                $pre_vat_adjustment_data    = 0;
                $pre_tax_adjustment_data    = 0;
                $pre_other_adjustment_data  = 0;

                //manually setting the data to not messing up with the following codes

                    $data['vat_adjust_des'][$i]         = 0;
                    $data['tax_adjust_des'][$i]         = 0;
                    $data['other_adjust_des'][$i]       = 0;

                //manually setting the data to not messing up with the following codes ends

                for($j = 0; $j < count($payment_receive_entry); $j++){

                    if($data['invoice_id'][$i] == $payment_receive_entry[$j]['invoice_id']){

                        $pre_vat_adjustment_data    = isset($payment_receive_entry[$j]['vat_adjustment'])? $payment_receive_entry[$j]['vat_adjustment'] : 0;
                        $pre_tax_adjustment_data    = isset($payment_receive_entry[$j]['tax_adjustment'])? $payment_receive_entry[$j]['tax_adjustment'] : 0;
                        $pre_other_adjustment_data  = isset($payment_receive_entry[$j]['others_adjustment'])? $payment_receive_entry[$j]['others_adjustment'] : 0;
                    }
                }

                $vat_adjustment_data    = !empty($data['vat_adjust_des'][$i]) ? floatval($data['vat_adjust_des'][$i]) : floatval(0);
                $tax_adjustment_data    = !empty($data['tax_adjust_des'][$i]) ? floatval($data['tax_adjust_des'][$i]) : floatval(0);
                $other_adjustment_data  = !empty($data['other_adjust_des'][$i]) ? floatval($data['other_adjust_des'][$i]) : floatval(0);


                if((!empty($data['vat_adjust_des'][$i]) || !empty($data['tax_adjust_des'][$i])))
                {
                    if((floatval($data['vat_adjust_des'][$i]) + floatval($data['tax_adjust_des'][$i])) > 0)
                    {
                        $oldjournal= JournalEntry::where("invoice_id", $data['invoice_id'][$i])->where("jurnal_type","invoice")->where("account_name_id",9)->where("debit_credit",1)->latest()->first();

                        if($oldjournal)
                        {
                            if(($oldjournal->amount - $pre_vat_adjustment_data - $pre_tax_adjustment_data + $vat_adjustment_data + $tax_adjustment_data) > 0){
                                $oldjournal->amount = $oldjournal->amount - $pre_vat_adjustment_data - $pre_tax_adjustment_data + $vat_adjustment_data + $tax_adjustment_data;
                                $oldjournal->assign_date = date("Y-m-d", strtotime($data['payment_date']));
                                $oldjournal->updated_by = $user_id;
                                $oldjournal->save();
                            }
                        }
                        else
                        {
                            if(($vat_adjustment_data + $tax_adjustment_data) > 0){
                                $journal_entry = new JournalEntry;
                                $journal_entry->debit_credit = 1;
                                $journal_entry->amount  = $vat_adjustment_data + $tax_adjustment_data;
                                $journal_entry->account_name_id  = 9;
                                $journal_entry->jurnal_type  = "invoice";
                                $journal_entry->invoice_id  = $data['invoice_id'][$i];

                                $journal_entry->created_by = $user_id;
                                $journal_entry->updated_by = $user_id;
                                $journal_entry->assign_date = date("Y-m-d", strtotime($data['payment_date']));
                                $journal_entry->contact_id  = $data['customer_id'];
                                $journal_entry->note = $data['note'];
                                $journal_entry->save();
                            }
                        }

                    }

                }

                if(!empty($data['other_adjust_des'][$i]))
                {
                    if($data['other_adjust_des'][$i]>0)
                    {
                        $oldjournal= JournalEntry::where("invoice_id",$data['invoice_id'][$i])->where("jurnal_type","invoice")->where("account_name_id",18)->where("debit_credit",1)->latest()->first();

                        if($oldjournal)
                        {
                            if(($oldjournal->amount - $pre_other_adjustment_data + $other_adjustment_data) > 0){
                                $oldjournal->amount = $oldjournal->amount - $pre_other_adjustment_data + $other_adjustment_data;
                                $oldjournal->assign_date = date("Y-m-d", strtotime($data['payment_date']));
                                $oldjournal->updated_by = $user_id;
                                $oldjournal->save();
                            }
                        }else{
                            if($other_adjustment_data > 0){
                                $journal_entry = new JournalEntry;
                                $journal_entry->debit_credit = 1;
                                $journal_entry->amount  = $other_adjustment_data;
                                $journal_entry->account_name_id  = 18;
                                $journal_entry->jurnal_type  = "invoice";
                                $journal_entry->invoice_id  = $data['invoice_id'][$i];

                                $journal_entry->created_by = $user_id;
                                $journal_entry->updated_by = $user_id;
                                $journal_entry->assign_date = date("Y-m-d", strtotime($data['payment_date']));
                                $journal_entry->contact_id  = $data['customer_id'];
                                $journal_entry->note = $data['note'];
                                $journal_entry->save();
                            }
                        }

                    }

                }

                $oldjournal= JournalEntry::where("invoice_id",$data['invoice_id'][$i])->where("jurnal_type","invoice")->where("account_name_id",5)->where("debit_credit",0)->latest()->first();

                if($oldjournal){
                    if(($oldjournal->amount - $pre_other_adjustment_data - $pre_vat_adjustment_data - $pre_tax_adjustment_data + $other_adjustment_data + $vat_adjustment_data + $tax_adjustment_data) > 0){
                        $oldjournal->amount = $oldjournal->amount - $pre_other_adjustment_data - $pre_vat_adjustment_data - $pre_tax_adjustment_data + $other_adjustment_data + $vat_adjustment_data + $tax_adjustment_data;
                        $oldjournal->assign_date = date("Y-m-d", strtotime($data['payment_date']));
                        $oldjournal->updated_by = $user_id;
                        $oldjournal->save();
                    }
                }else{
                    if(($other_adjustment_data + $vat_adjustment_data + $tax_adjustment_data) > 0){
                        $journal_entry = new JournalEntry;
                        $journal_entry->debit_credit = 0;
                        $journal_entry->amount  = $other_adjustment_data + $vat_adjustment_data + $tax_adjustment_data;
                        $journal_entry->account_name_id  = 5;
                        $journal_entry->jurnal_type  = "invoice";
                        $journal_entry->invoice_id  = $data['invoice_id'][$i];

                        $journal_entry->created_by = $user_id;
                        $journal_entry->updated_by = $user_id;
                        $journal_entry->assign_date = date("Y-m-d", strtotime($data['payment_date']));
                        $journal_entry->contact_id  = $data['customer_id'];
                        $journal_entry->note = $data['note'];
                        $journal_entry->save();
                    }
                }

                $i++;

            }

        }

        return true;
    }

    public function updateDueInvoiceAfterPaymentReceiveEdit($payment_receive_entry,$request=null)
    {

        for($i = 0; $i < count($payment_receive_entry); $i++)
        {
            $invoice = Invoice::find($payment_receive_entry[$i]['invoice_id']);
            $invoice->due_amount = $invoice['due_amount'] + $payment_receive_entry[$i]['vat_adjustment'] + $payment_receive_entry[$i]['tax_adjustment'] + $payment_receive_entry[$i]['others_adjustment'] + $payment_receive_entry[$i]['amount'];
            $invoice->update();
        }
    }

    public function 
    updateDueInvoice($invoice_id, $amount)
    {
        $invoice = Invoice::find($invoice_id);
        $invoice->due_amount = $invoice['due_amount'] - $amount;
        $invoice->update();
    }


    public function updatePaymentReceiveAdjustmentInvoiceAfterPaymentReceiveEdit($data)
    {
        if(isset($data['payment_receive_adjustment']))
        {
            for($i = 0; $i < count($data['payment_receive_adjustment']); $i++)
            {
                if(!$data['payment_receive_adjustment'][$i])
                    $data['payment_receive_adjustment'][$i] = 0;

                //give previous adjustment
                $invoice = Invoice::find($data['invoice_id'][$i]);
                $invoice->total_amount = $invoice['total_amount'] + $invoice['pr_adjustment'];
                $invoice->due_amount = $invoice['due_amount'] + $invoice['pr_adjustment'];
                $invoice->update();

                //eliminating present adjustment
                $invoice->total_amount = $invoice['total_amount'] - $data['payment_receive_adjustment'][$i];
                $invoice->due_amount = $invoice['due_amount'] - $data['payment_receive_adjustment'][$i];
                $invoice->pr_adjustment = $data['payment_receive_adjustment'][$i];
                $invoice->pr_note = $data['payment_receive_note'][$i];
                $invoice->update();

            }
        }
    }

    public function isPaymentReceiveInThisInvoice($invoice_id)
    {
        $payment_receives = PaymentReceiveEntryModel::where('invoice_id', $invoice_id)->get();
       
        if(count($payment_receives) > 0)
        {
            return true;
        }
        else{
           
            return false;    
        }
       
    }

    public function isCreditNoteInThisInvoice($invoice_id)
    {   
       
        $credit_notes = CreditNotePayment::where('invoice_id', $invoice_id)->get();
        if(count($credit_notes) > 0)
        {
            return true;

        } 
        {   
           return false;
        }
    }

    public function isVendorCreditInThisBill($bill_id)
    {   
       
        $vendor_credit = VendorCredit::where('bill_id', $bill_id)->get();
        if(count($vendor_credit) > 0)
        {
            return true;
        } 
        {   
           return false;
        }
    }

    public function isVendorCreditUsedInThisBill($bill_id)
    {   
       
        $vendor_credit = VendorCreditPayment::where('bill_id', $bill_id)->get();
        if(count($vendor_credit) > 0)
        {
            return true;
        } 
        {   
           return false;
        }
    }

    public function isFeatureEnabled($feature)
    {
        $result = OrganizationProfile::first()->$feature;
        return $result;
    }
    
    public function unitQuantity($quantity,$basic_unit_conversion)
    {
       
        $quantity = (float)$quantity* $basic_unit_conversion;
 
        return $quantity;
    }

    public function not_in_array_r($needle, $haystack)
    {
        foreach ($haystack as $key => $item) {
            if (in_array(!$needle, $item)) {
                return true;
            }
        }
        return false;
    }

    public function hasModuleAccess($prefixes)
    {
        $has_access = false;
        foreach ($prefixes as $key => $prefix) {
            $module             = Modules::where('module_prefix', $prefix)->first();
            if ($module) {
                $user_access_level  = AccessLevel::where('module_id', $module->id)
                    ->where('role_id', Auth::user()->role_id)
                    ->first();
                if ($user_access_level && ($user_access_level->create == 1 || $user_access_level->read == 1 || $user_access_level->update == 1 || $user_access_level->delete == 1)) {
                    $has_access = true;
                    break;
                }
            }
        }
        return $has_access;
    }

}
