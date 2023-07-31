<?php

namespace App\Modules\Bill\Http\Response;

use Illuminate\Http\Request;
use App\Models\AccountChart\Account;
use App\Models\MoneyOut\PaymentMade;
use Illuminate\Support\Facades\Auth;
use App\Models\MoneyOut\PaymentMadeEntry;
use App\Models\ManualJournal\JournalEntry;


/**
 * Created by Rayhan.
 * User: Ontik
 * Date: 11/12/2017
 * Time: 12:20 PM
 */

class Payment
{

	protected $paymentAmount                  = 0;

	public function makePaymentMade($request, $bill_id)
	{

		if (!$request instanceof Request) {
			return null;
		}

		if (!$request->check_payment) {
			return null;
		}

		$newpr_number                         = PaymentMade::max("pm_number") + 1;
		$authid                               = Auth::id();

		$newpaymentmade                       = new PaymentMade();

		$newpaymentmade->payment_date         = date("Y-m-d", strtotime($request['bill_date']));
		$newpaymentmade->pm_number            = str_pad($newpr_number, "6", 0, STR_PAD_LEFT);
		$newpaymentmade->bank_info            = $request['payment_deposit_details'];
		$newpaymentmade->reference            = '';
		$newpaymentmade->amount               = $request['payment_amount'];
		$newpaymentmade->account_id           = $request['payment_account'];
		$newpaymentmade->vendor_id            = $request['vendor_id'];
		$newpaymentmade->created_by           = $authid;
		$newpaymentmade->updated_by           = $authid;
		$newpaymentmade->excess_amount        = 0;
		$newpaymentmade->payment_mode_id      = 1;
		if (Account::find($request->payment_account)->account_type_id == 5 && !empty($request->cheque_number) && !empty($request->issue_date)){
			$newpaymentmade->cheque_number        = $request['cheque_number'];
			$newpaymentmade->cheque_issue_date    = date("Y-m-d", strtotime($request['issue_date']));
			$newpaymentmade->cheque_status        = 'unpresented';
		}

		if (!$newpaymentmade->save()) {
			throw new \Exception("Failed to add Payment Made.");
		}

		return $this->makePaymentMadeEntry($request, $newpaymentmade, $bill_id);
	}

	public function makePaymentMadeEntry($request, $paymentmade = null, $bill_id = null)
	{

		if (is_null($paymentmade) || is_null($bill_id)) {
			throw new \Exception("payment made entry creation fail. need required data");
		}

		if (!$paymentmade instanceof PaymentMade) {
			throw new \Exception("payment made entry creation fail");
		}


		$authid                                  = Auth::id();

		$paymentMade_entry                       = new PaymentMadeEntry();

		$paymentMade_entry->amount               = $paymentmade['amount'];
		$paymentMade_entry->payment_made_id      = $paymentmade['id'];
		$paymentMade_entry->bill_id              = $bill_id;
		$paymentMade_entry->created_by           = $authid;
		$paymentMade_entry->updated_by           = $authid;

		if (!$paymentMade_entry->save()) {
			throw new \Exception("payment made entry creation fail");
		}
		if (Account::find($request->payment_account)->account_type_id == 5 && !empty($request->cheque_number) && !empty($request->issue_date)){}
		else{
			$this->journalEntry($request, $bill_id, $paymentmade['id']);
		}

		return $paymentmade;
	}

	public function journalEntry($request, $bill_id, $payment_bill_id)
	{

		if (!$request instanceof Request) {
			return null;
		}

		if (!$request->check_payment) {
			return null;
		}

		$amount                                 = $request['payment_amount'];

		$authid                                 = Auth::id();
		$entries                                = [];

		//row1
		$entries[]                              = array(

			"debit_credit"                      => 0,
			"amount"                            => $amount,
			"account_name_id"                   => 27,
			"jurnal_type"                       => "payment_made1",
			"bill_id"                           => $bill_id,
			"payment_made_id"                   => $payment_bill_id,
			"contact_id"                        => $request['vendor_id'],
			"created_by"                        => $authid,
			"updated_by"                        => $authid,
			"created_at"                        => date("Y-m-d H:i:s"),
			"updated_at"                        => date("Y-m-d H:i:s"),
			"assign_date"                       => date("Y-m-d H:i:s", strtotime($request['bill_date'])),

		);

		//row2
		$entries[]                              = array(

			"debit_credit"                     => 1,
			"amount"                           => $amount,
			"account_name_id"                  => 11,
			"jurnal_type"                      => "payment_made1",
			"bill_id"                          => $bill_id,
			"payment_made_id"                  => $payment_bill_id,
			"contact_id"                       => $request['vendor_id'],
			"created_by"                       => $authid,
			"updated_by"                       => $authid,
			"created_at"                       => date("Y-m-d H:i:s"),
			"updated_at"                       => date("Y-m-d H:i:s"),
			"assign_date"                      => date("Y-m-d H:i:s", strtotime($request['bill_date'])),

		);

		//row3
		$entries[]                              = array(

			"debit_credit"                     => 1,
			"amount"                           => $amount,
			"account_name_id"                  => 27,
			"jurnal_type"                      => "payment_made2",
			"bill_id"                          => null,
			"payment_made_id"                  => $payment_bill_id,
			"contact_id"                       => $request['vendor_id'],
			"created_by"                       => $authid,
			"updated_by"                       => $authid,
			"created_at"                       => date("Y-m-d H:i:s"),
			"updated_at"                       => date("Y-m-d H:i:s"),
			"assign_date"                      => date("Y-m-d H:i:s", strtotime($request['bill_date'])),

		);

		//row 4
		$entries[]                              = array(

			"debit_credit"                     => 0,
			"amount"                           => $amount,
			"account_name_id"                  => $request['payment_account'],
			"jurnal_type"                      => "payment_made2",
			"bill_id"                          => null,
			"payment_made_id"                  => $payment_bill_id,
			"contact_id"                       => $request['vendor_id'],
			"created_by"                       => $authid,
			"updated_by"                       => $authid,
			"created_at"                       => date("Y-m-d H:i:s"),
			"updated_at"                       => date("Y-m-d H:i:s"),
			"assign_date"                      => date("Y-m-d H:i:s", strtotime($request['bill_date'])),

		);

		if (!JournalEntry::insert($entries)) {
			throw new \Exception("journal entry creation fail");
		}

		return true;
	}
}
