<?php

namespace App\Modules\Pointofsales\Http\Controllers;


use App\Modules\Invoice\Http\Response\Payment;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use NumberToWords\NumberToWords;

//Models 
use App\Models\Inventory\Item;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\ItemSubCategory;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Moneyin\Invoice;
use App\Models\Contact\Contact;
use App\Models\Cart\Cart;
use App\Models\Cart\CartEntry;
use App\Models\AccountChart\Account;
use App\Models\Moneyin\CreditNote;
use App\Models\Moneyin\CreditNotePayment;
use App\Models\Moneyin\PaymentReceives;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\ManualJournal\JournalEntry;
use App\Models\OrganizationProfile\OrganizationProfile;

class PosController extends Controller
{
    public function index(Request $request)
    {
		$branch_id              = session('branch_id');
        $organization_profile   = OrganizationProfile::find(1);

		if ($branch_id == 1 || $organization_profile->show_all_item == 1) {
			$categories 	= ItemCategory::select('id', 'item_category_name as title')->get();
			$contacts 		= Contact::orderBy('id', 'DESC')->get();
        }
        elseif ($branch_id != 1 || $organization_profile->show_all_item != 1) {
			$categories 	= ItemCategory::select('id', 'item_category_name as title')
											->where('branch_id', $branch_id)
											->orderBy('id', 'DESC')
											->limit(10)
											->get();
			$contacts 		= Contact::where('branch_id', $branch_id)
									->orderBy('id', 'DESC')
									->get();
        }

		$subcategories 		= ItemSubCategory::leftjoin('item_category', 'item_category.id', 'item_sub_category.item_category_id')
		                                        ->select('item_sub_category.id', 'item_sub_category_name as title', 'item_category_id', 'item_category.branch_id')
		                                        ->where('item_category.branch_id', $branch_id)->get();

		
		foreach ($categories as $category) {
			$category->element_id = 'category';
		}

		foreach ($subcategories as $subcategory) {
			$subcategory->element_id = 'subcategory';
		}

		$all 	= array_merge($categories->toArray(), $subcategories->toArray());
		$title 	= array_column($all, 'title');
		array_multisort($title, SORT_ASC,SORT_NATURAL|SORT_FLAG_CASE, $all);

		$cart_holds 	= Cart::where('created_by', Auth::user()->id)->orderBy('id', 'DESC')->get();

		$recent_items 	= InvoiceEntry::leftJoin('item', 'item.id', 'invoice_entries.item_id')
								->select('item.*')
								->distinct('item.id')
								->orderBy('item.id', 'DESC')
								->where('item.branch_id', $branch_id)
								->get();

        return view('pointofsales::index', compact('all', 'recent_items', 'contacts', 'cart_holds'));
    }

	public function ajax(Request $request)
	{
		if ($request->ajax()) 
		{
			$branch_id              = session('branch_id');
			$organization_profile   = OrganizationProfile::find(1);

			if ($request->button_id == 'recent') 
			{
				// if ($branch_id == 1 || $organization_profile->show_all_item == 1) {
				// 	$data = InvoiceEntry::leftJoin('item', 'item.id', 'invoice_entries.item_id')
				// 						->select('item.*')
				// 						->distinct('item.id')
				// 						->orderBy('item.id', 'DESC')
				// 						->get();
				// }
				// elseif ($branch_id != 1 || $organization_profile->show_all_item != 1) {
					$data = InvoiceEntry::leftJoin('item', 'item.id', 'invoice_entries.item_id')
										->select('item.*')
										->where('item.branch_id', $branch_id)
										->distinct('item.id')
										->orderBy('item.id', 'DESC')
										->get();
        		// }

				return array('view' => view('pointofsales::items', compact('data'))->render());
			}
			elseif ($request->button_id == 'top') 
			{
				// if ($branch_id == 1 || $organization_profile->show_all_item == 1) {
				// 	$data = InvoiceEntry::leftJoin('item', 'item.id', 'invoice_entries.item_id')
				// 							->selectRaw('sum(invoice_entries.quantity) as sum, invoice_entries.item_id, item.*')
				// 							->groupBy('invoice_entries.item_id')
				// 							->orderBy('sum', 'desc')
				// 							->take(5)
				// 							->get();
				// }
				// elseif ($branch_id != 1 || $organization_profile->show_all_item != 1) {
					$data = InvoiceEntry::leftJoin('item', 'item.id', 'invoice_entries.item_id')
											->selectRaw('sum(invoice_entries.quantity) as sum, invoice_entries.item_id, item.*')
											->where('item.branch_id', $branch_id)
											->groupBy('invoice_entries.item_id')
											->orderBy('sum', 'desc')
											->take(5)
											->get();
        		// }

				return array('view' => view('pointofsales::items', compact('data'))->render());
			}
			elseif ($request->button_id == 'all') 
			{
				// if ($branch_id == 1 || $organization_profile->show_all_item == 1) {
				// 	$data = Item::orderBy('id', 'DESC')->get();
				// }
				// elseif ($branch_id != 1 || $organization_profile->show_all_item != 1) {
					$data = Item::where('branch_id', Auth::user()->branch_id)->get();
        		// }

				return array('view' => view('pointofsales::items', compact('data'))->render());
			}
			elseif (strpos($request->button_id, 'category') === 0) 
			{
				$category_id 	= explode('_', $request->button_id);
				$data 			= Item::where('item_category_id', $category_id[1])->get();

				return array('view' => view('pointofsales::items', compact('data'))->render());
			}
			elseif (strpos($request->button_id, 'subcategory') === 0) 
			{
				$subcategory_id = explode('_', $request->button_id);
				$data 			= Item::where('item_sub_category_id', $subcategory_id[1])->get();

				return array('view' => view('pointofsales::items', compact('data'))->render());
			}
			elseif ($request->button_id == 'search') 
			{
				if($request->item_data != null)
				{
					// if ($branch_id == 1 || $organization_profile->show_all_item == 1) {
					// 	$data = Item::where('item_name', 'like', '%' . $request->item_data . '%')
					// 				->orWhere('item.barcode_no', $request->item_data)
					// 				->get();
					// }
					// elseif ($branch_id != 1 || $organization_profile->show_all_item != 1) {	
					    
						$data = Item::where('item_name', 'like', '%' . $request->item_data . '%')
									->where('branch_id', Auth::user()->branch_id)
									->get();
					// }
				}
				else
				{
					// if ($branch_id == 1 || $organization_profile->show_all_item == 1) {	
					// 	$data = Item::orderBy('id', 'DESC')->get();
					// }
					// elseif ($branch_id != 1 || $organization_profile->show_all_item != 1) {	
						$data = Item::where('branch_id', Auth::user()->branch_id)
									->orderBy('id', 'DESC')
									->get();
					// }
				}

				return array('view' => view('pointofsales::items', compact('data'))->render());
			}
			elseif ($request->button_id == 'getItemForBarcode')
			{
				$data = Item::where('barcode_no', $request->barcode_no)
								->where('branch_id', $branch_id)
								->first();

				if (!$data) 
				{
					return array('status' => 'error', 'msg' => "Warning, Item not found!");
				}
				else {
					$data->item_image_url = $data->item_image_url != null ?
							asset($data->item_image_url) : asset('img/1.jpg');
							
					return array('status' => 'success', 'item' => $data);
				}
			}
			elseif ($request->button_id == 'getItemData')
			{
				$data = Item::findOrFail($request->item_id);

				return array('view' => view('pointofsales::offcanvas', compact('data'))->render());
			}
			elseif ($request->button_id == 'storeCart')
			{
				try 
				{
					DB::beginTransaction();

					if ($request->item_data['cart_id'] != null)
						$cart 				= Cart::findOrFail($request->item_data['cart_id']);
					else
						$cart 				= new Cart;

					$cart->subtotal 		= (double)$request->item_data['sub_total'];
					$cart->discount 		= (double)$request->item_data['discount'];
					$cart->discount_type 	= $request->item_data['discount_type'] == 'money' ? 1 : 0;
					$cart->tax 				= (double)$request->item_data['tax'];
					$cart->tax_amount 		= (double)$request->item_data['tax_amount'];
					$cart->shipping 		= (double)$request->item_data['shipping'];
					$cart->total 			= (double)$request->item_data['total'];
					$cart->user_id 			= $request->item_data['customer_id'];
					$cart->created_by 		= Auth::user()->id;
					$cart->updated_by 		= Auth::user()->id;
					$cart->save();

					foreach ($request->item_data['cart'] as $key => $value) 
					{
						if (isset($value['cart_entry_id']) && strlen($value['cart_entry_id']))
							$cart_entry 			= CartEntry::findOrFail($value['cart_entry_id']);
						else
							$cart_entry 			= new CartEntry;
						
						$cart_entry->item_id 		= (int)$value['item_id'];
						$cart_entry->cart_id 		= $cart->id;
						$cart_entry->quantity 		= (int)$value['quantity'];
						$cart_entry->rate 			= (double)$value['rate'];
						$cart_entry->discount 		= (double)$value['discount'] > 0 ? 
															(double)$value['discount'] : null;
						$cart_entry->discount_type 	= (int)$value['discount'] > 0 ? 
															($value['discount_type'] == 'money' ? 1 : 0) : null;
						$cart_entry->total 			= (double)$value['total'];
						$cart_entry->created_by 	= Auth::user()->id;
						$cart_entry->updated_by 	= Auth::user()->id;
						$cart_entry->save();
					}

					DB::commit();

					if ($request->item_data['cart_id'] != null)
						return array('status' => 'success', 'msg' => 'Success, Cart updated successfully!');
							
					else
						return array('status' => 'success', 'msg' => 'Success, Cart saved successfully!');


				} catch (\Throwable $th) {
					DB::rollback();
					dd($th);
					return array('status' => 'error', 'msg' => 'Warning, Something went wrong please try again!');
				}
			}
			elseif ($request->button_id == 'loadCartData')
			{
				$data 		= Cart::findOrFail($request->cart_id);
				$contact 	= Contact::findOrFail($data->user_id);

				foreach ($data->cartItems as $key => $value) {
					$value->item_image 		= $value->item_image_url != null ?
												$value->item_image_url : asset('img/1.jpg');
					$value->item_name 		= $value->item->item_name;
					$value->item_sales_rate = $value->item->item_sales_rate;
				}

				return array('view' => view('pointofsales::main_cart', compact('data'))->render(), 
								'customer' => $contact, 'cart' => $data, 'cart_entries' => $data->cartItems);
			}
			elseif ($request->button_id == 'removeCartItem')
			{
				$data = CartEntry::where('item_id', $request->item_id)
									->where('cart_id', $request->cart_id)
									->first();
				
				if ($data) 
				{
					$cart 				= Cart::findOrFail($request->cart_id);
					$cart->subtotal 	= $cart->subtotal - $data->total;
					$cart->total 		= ($cart->subtotal - $cart->discount) + $cart->tax_amount + $cart->shipping;
					$cart->save();

					$data->delete();

					$count_items = CartEntry::where('cart_id', $request->cart_id)->count();
					
					if ($count_items == 0) {
						$cart->delete();
					}

					$cart_holds = Cart::orderBy('id', 'DESC')->get();

					return array('status' => 'success', 'msg' => 'Success, 
							Deleted successfully!', 'action' => 'item_removed',
							'view' => view('pointofsales::cart_hold', compact('cart_holds'))->render());
				}else{
					return array('status' => 'error', 'msg' => 'Error, Something went wrong!', 
							'action' => 'something_went_wrong');
				}
			}
			elseif ($request->button_id == 'deleteCart')
			{
				$cart = Cart::findOrFail($request->cart_id);

				$cart_entries = CartEntry::where('cart_id', $request->cart_id)->get();

				foreach ($cart_entries as $key => $value) {
					$value->delete();
				}

				$cart->delete();

				return array('status' => 'success', 'msg' => 'Success, Cart was deleted successfully!');
			}
			elseif ($request->button_id == 'cartCheckout')
			{
				try 
				{
					DB::beginTransaction();

					if ($request->item_data['cart_id'] != null)
						$cart 				= Cart::findOrFail($request->item_data['cart_id']);
					else
						$cart 				= new Cart;

					$cart->subtotal 		= (double)$request->item_data['sub_total'];
					$cart->discount 		= (double)$request->item_data['discount'];
					$cart->discount_type 	= $request->item_data['discount_type'] == 'money' ? 1 : 0;
					$cart->tax 				= (double)$request->item_data['tax'];
					$cart->tax_amount 		= (double)$request->item_data['tax_amount'];
					$cart->shipping 		= (double)$request->item_data['shipping'];
					$cart->total 			= (double)$request->item_data['total'];
					$cart->user_id 			= $request->item_data['customer_id'];
					$cart->created_by 		= Auth::user()->id;
					$cart->updated_by 		= Auth::user()->id;
					$cart->save();

					foreach ($request->item_data['cart'] as $key => $value) 
					{
						if (isset($value['cart_entry_id']) && strlen($value['cart_entry_id']))
							$cart_entry 			= CartEntry::findOrFail($value['cart_entry_id']);
						else
							$cart_entry 			= new CartEntry;
						
						$cart_entry->item_id 		= (int)$value['item_id'];
						$cart_entry->cart_id 		= $cart->id;
						$cart_entry->quantity 		= (int)$value['quantity'];
						$cart_entry->rate 			= (double)$value['rate'];
						$cart_entry->discount 		= (double)$value['discount'] > 0 ? 
															(double)$value['discount'] : null;
						$cart_entry->discount_type 	= (int)$value['discount'] > 0 ? 
															($value['discount_type'] == 'money' ? 1 : 0) : null;
						$cart_entry->total 			= (double)$value['total'];
						$cart_entry->created_by 	= Auth::user()->id;
						$cart_entry->updated_by 	= Auth::user()->id;
						$cart_entry->save();
					}

					DB::commit();

					Session::put('cart_id', $cart->id);
							
					return array('status' => 'success', 'msg' => 'Cart saved, Taking you to the checkout page');


				} catch (\Throwable $th) {
					DB::rollback();
					return array('status' => 'error', 'msg' => 'Warning, Something went wrong please try again!');
				}
			}
			else
			{
				$data = 'Error, Something went wrong with your request!';

				return array('view' => view('pointofsales::items', compact('data'))->render());
			}
		}
	}

	public function ajaxAddCustomer(Request $request)
	{
		if ($request->ajax()) 
		{
			$branch_id              = session('branch_id');
			$organization_profile   = OrganizationProfile::find(1);

			try 
			{
				$customer 						= new Contact;

				$customer->display_name 			= $request->customer_name;
				$customer->phone_number_1 		= $request->customer_phone;
				$customer->contact_category_id  = 1;
				$customer->branch_id  			= Auth::user()->branch->id;
				$customer->created_by  			= Auth::user()->id;
				$customer->updated_by  			= Auth::user()->id;
				$customer->save();

				if ($branch_id == 1 || $organization_profile->show_all_item == 1) {
					$customers = Contact::orderBy('id', 'DESC')->get();
				}
				elseif ($branch_id != 1 || $organization_profile->show_all_item != 1) {	
					$customers = Contact::where('branch_id', $branch_id)
										->orderBy('id', 'DESC')->get();
				}

				return array('status' => 'success', 'view' => view('pointofsales::select_customer', 
					compact('customer', 'customers'))->render());
			} 
			catch (\Throwable $th) 
			{
				return array('status' => 'error');
			}
		}
	}

	public function checkout(Request $request)
	{
		if (!Session::has('cart_id')) {
			return redirect()->back();
		}
		
		$cart_id 			= Session::get('cart_id');
		$cart 				= Cart::findOrFail($cart_id);

		$cash 				= Account::where('account_type_id', 4)->get();
		$banks 				= Account::where('account_type_id', 5)->get();
		$available_credit 	= CreditNote::where('customer_id', $cart->user_id)->sum('available_credit');
		$excess_payment 	= PaymentReceives::where('customer_id', $cart->user_id)->sum('excess_payment');

		$data = array(
			'cash' 				=> $cash,
			'banks' 			=> $banks,
			'available_credit' 	=> $available_credit,
			'excess_payment' 	=> $excess_payment
		);

		return view('pointofsales::checkout', compact('cart', 'data'));
	}

	public function ajaxCheckout(Request $request)
	{
		if ($request->ajax()) 
		{
			try 
			{
				DB::beginTransaction();

				//get cart data starts
					$cart_id 						= Session::get('cart_id');
					$cart 							= Cart::findOrFail($cart_id);

					$after_discount = 0;

					if ($cart->discount_type == 1) 
					{
						$after_discount = $cart->subtotal - $cart->discount;
					} 
					else 
					{
						$after_discount = $cart->subtotal * ((100 - $cart->discount) / 100);
					}

					$after_discount = $cart->subtotal - $after_discount;
				//get cart data ends

				//insert data into invoice table starts
					$invoices                       = Invoice::count();

					if($invoices > 0)
					{
						$invoice                    = Invoice::orderBy('id', 'desc')->first();
						$invoice_number             = $invoice['invoice_number'];
						$invoice_number             = $invoice_number + 1;
					}
					else
					{
						$invoice_number             = 1;
					}

					$invoice_number 				= str_pad($invoice_number, 6, '0', STR_PAD_LEFT);

					$invoice 						= new Invoice;

					$invoice->invoice_number 		= $invoice_number;
					$invoice->invoice_date   		= date('Y-m-d');
					$invoice->tax_total 			= $cart->tax_amount;
					$invoice->shipping_charge 		= $cart->shipping;
					$invoice->adjustment_type 		= 0;
					$invoice->adjustment 			= -$after_discount;
					$invoice->total_amount 			= $cart->total;
					
					if($request->return_amount > 0){
					    $invoice->due_amount 			= 0; 
					}else{
					    $invoice->due_amount 			= $cart->total - $request->total_paid; 
					}
					
					$invoice->return_amount 		= $request->return_amount; 
					$invoice->customer_id 			= $cart->user_id; 
					$invoice->created_by 			= Auth::user()->id; 
					$invoice->updated_by 			= Auth::user()->id; 
					$invoice->save();
				//insert data into invoice table ends

				//insert data into invoice_entries table & update total sales in item table starts
					$this->insertIntoInvoiceEntry($cart, $invoice);
				//insert data into invoice_entries table & update total sales in item table ends

				//insert invoice into jurnal entry table starts
					$this->insertIntoJournalEntry($cart, $invoice);
				//insert invoice into jurnal entry table ends

				//insert into payment_receives & payment_receives_entries table starts
					if ($request->payments) 
					{
					    $key                = 0;
						$adjusted_amount 	= 0;
						$payment_receives 	= PaymentReceives::orderBy('id', 'desc')->first();

						foreach ($request->payments as $key => $value) 
						{
							$payment_receive 		= new PaymentReceives;
							$payment_receive_entry 	= new PaymentReceiveEntryModel;


							if ($cart->total > $adjusted_amount) 
							{							
								if (isset($payment_receives)) {
									$pr                    = $payment_receives;
									$pr_number             = (int)$pr->pr_number;
									$pr_number             = $pr_number + 1;
								}
								else{
									$pr_number = 1;
								}

								$pr_number 				= str_pad($pr_number, 6, '0', STR_PAD_LEFT);

								if (($cart->total - $adjusted_amount) >= $value['tendered_amount']) {
								    $final_amount 					= $value['tendered_amount'];
									$adjusted_amount 				+= $value['tendered_amount'];
								}
								else{
									$final_amount 					= ($cart->total - $adjusted_amount);
									$adjusted_amount 				+= ($cart->total - $adjusted_amount);
								}

								//check if payment type is credit
								if ($value['button_type'] == 'credit') 
								{
									$final_credit_amount 	= 0;
									$credit_notes 			= CreditNote::where('customer_id', $cart->user_id)
																		->where('available_credit', '>', 0)
																		->get();

									foreach ($credit_notes as $key => $value) 
									{
										$credit_adjustment_amount = 0;

										while ($final_amount > $credit_adjustment_amount) 
										{
											if (($final_amount - $credit_adjustment_amount) >= $value->available_credit) {
											    $final_credit_amount 			= $value->available_credit;
												$credit_adjustment_amount 		+= $value->available_credit;
											}
											else{
											    $final_credit_amount 			= ($final_amount - $credit_adjustment_amount);
												$credit_adjustment_amount 		+= ($final_amount - $credit_adjustment_amount);
											}
											
											
											if ($final_credit_amount > 0) 
											{
												$credit_note 					= CreditNote::findOrFail($value->id);
												
												$credit_note->available_credit 	-= $final_credit_amount;
												$credit_note->save();

												//insert into credit note payment table starts
													$this->insertIntoCreditNotePayment($final_credit_amount, $credit_note, $invoice);
												//insert into credit note payment table ends
											}
										}
									}
								}
								else
								{
									$payment_receive->payment_date 		= date('Y-m-d');
									$payment_receive->amount 			= $final_amount;
									$payment_receive->pr_number 		= $pr_number;
									$payment_receive->invoice_show 		= 'on';
									$payment_receive->payment_mode_id 	= 1;
									$payment_receive->account_id 		= $value['id'];
									$payment_receive->customer_id 		= $cart->user_id;
									$payment_receive->created_by 		= Auth::user()->id;
									$payment_receive->updated_by 		= Auth::user()->id;
									$payment_receive->save();

									$payment_receives 					= $payment_receive;

									$payment_receive_entry->payment_receives_id 	= $payment_receive->id;
									$payment_receive_entry->amount 					= $final_amount;
									$payment_receive_entry->invoice_id 				= $invoice->id;
									$payment_receive_entry->created_by 				= Auth::user()->id;
									$payment_receive_entry->updated_by 				= Auth::user()->id;
									$payment_receive_entry->save();

									
									//insert payment_receives into jurnal entry starts
										$this->insertPaymentReceivesIntoJurnalEntry($payment_receive, $invoice);
									//insert payment_receives into jurnal entry ends
								}
							}
						}
					}
				//insert into payment_receives & payment_receives_entries table ends

				//delete cart information & sessrion after successfull checkout starts
					$this->deleteCart($cart);
				//delete cart information & sessrion after successfull checkout ends	

				DB::commit();

				return array('status' => 'success', 'msg' => 'Checkout Successful, Taking you to the main page...', 
								'route' => route('point_of_sales'));
			} 
			catch (\Throwable $th) 
			{
				DB::rollback();
                dd($e->getMessage());
				return array('status' => 'success', 'msg' => 'Something went wrong, Please try again...');
			}
		}
	}

	public function insertIntoInvoiceEntry($cart, $invoice)
	{
		foreach ($cart->cartItems as $key => $value) 
		{
			$after_discount = 0;

			if ($value->discount > 0) 
			{
				$after_discount = $value->discount;
			} 

			//insert into invoice enntry starts
				$invoice_entry 					= new InvoiceEntry;

				$invoice_entry->quantity 		= $value->quantity;
				$invoice_entry->amount 			= $value->total;
				$invoice_entry->discount 		= $after_discount;
				$invoice_entry->discount_type 	= $value->discount_type ?? 0;
				$invoice_entry->rate 			= $value->rate;
				$invoice_entry->item_id 		= $value->item_id;
				$invoice_entry->invoice_id 		= $invoice->id;
				$invoice_entry->tax_id 			= 1;
				$invoice_entry->account_id 		= 16;
				$invoice_entry->created_by 		= Auth::user()->id; 
				$invoice_entry->updated_by 		= Auth::user()->id; 
				$invoice_entry->save();
			//insert into invoice enntry ends

			//update total sales in item table starts
				$item 							= Item::findOrFail($value->item_id);

				$item->total_sales 				= $item->total_sales + $value->quantity;
				$item->save();
			//update total sales in item table ends

			//insert invoice enntry data into jurnal entry starts
				$journal_entry                    	= new JournalEntry;

				$journal_entry->debit_credit      	= 0;
				$journal_entry->amount            	= ($value->rate * $value->quantity);
				$journal_entry->account_name_id   	= 16;
				$journal_entry->jurnal_type       	= 'invoice';
				$journal_entry->invoice_id        	= $invoice->id;
				$journal_entry->contact_id        	= $invoice->customer_id;
				$journal_entry->created_by        	= Auth::user()->id;
				$journal_entry->updated_by        	= Auth::user()->id;
				$journal_entry->created_at        	= \Carbon\Carbon::now()->toDateTimeString();
				$journal_entry->updated_at        	= \Carbon\Carbon::now()->toDateTimeString();
				$journal_entry->assign_date       	= date('Y-m-d', strtotime($invoice->invoice_date));
				$journal_entry->save();
			//insert invoice enntry data into jurnal entry ends
		}
	}

	public function insertIntoJournalEntry($cart, $invoice)
	{
		//insert total amount as debit starts
			$journal_entry                  = new JournalEntry;
			$journal_entry->debit_credit    = 1;
			$journal_entry->amount          = $invoice->total_amount;
			$journal_entry->account_name_id = 5;
			$journal_entry->jurnal_type     = "invoice";
			$journal_entry->invoice_id      = $invoice->id;
			$journal_entry->contact_id      = $invoice->customer_id;
			$journal_entry->created_by      = Auth::user()->id;
			$journal_entry->updated_by      = Auth::user()->id;
			$journal_entry->assign_date     = date('Y-m-d', strtotime($invoice->invoice_date));
			$journal_entry->save();
		//insert total amount as debit ends

		$discount 	= 0;

		foreach ($cart->cartItems as $key => $value) 
		{
			//sum of discount starts
				if ($value->discount_type == 1) 
				{
					$discount 		+= $value->discount;
				} 
				else 
				{
					$after_discount 	= $value->total * ((100 - $value->discount) / 100);
					$after_discount 	= $value->total - $after_discount;
					$discount 			+= $after_discount;
				}
			//sum of discount ends
		}
		
		//insert discount as credit starts
			if($discount > 0)
			{
				$journal_entry                  = new JournalEntry;
				$journal_entry->debit_credit    = 1;
				$journal_entry->amount          = $discount;
				$journal_entry->account_name_id = 21;
				$journal_entry->jurnal_type     = "invoice";
				$journal_entry->invoice_id      = $invoice->id;
				$journal_entry->contact_id      = $cart->user_id;
				$journal_entry->created_by      = Auth::user()->id;
				$journal_entry->updated_by      = Auth::user()->id;
				$journal_entry->assign_date     = date('Y-m-d', strtotime($invoice->invoice_date));
				$journal_entry->save();
			}
		//insert discount as credit ends

		//insert tax total as credit starts
			if($cart->tax_amount > 0)
			{
				$journal_entry                  = new JournalEntry;
				$journal_entry->debit_credit    = 0;
				$journal_entry->amount          = $cart->tax_amount;
				$journal_entry->account_name_id = 9;
				$journal_entry->jurnal_type     = "invoice";
				$journal_entry->invoice_id      = $invoice->id;
				$journal_entry->contact_id      = $cart->user_id;
				$journal_entry->created_by      = Auth::user()->id;
				$journal_entry->updated_by      = Auth::user()->id;
				$journal_entry->assign_date     = date('Y-m-d', strtotime($invoice->invoice_date));
				$journal_entry->save();
			}
		//insert tax total as credit ends

        //insert shipping charge as credit starts
			if($cart->shipping > 0)
			{
				$journal_entry                  = new JournalEntry;
				$journal_entry->debit_credit    = 0;
				$journal_entry->amount          = $cart->shipping;
				$journal_entry->account_name_id = 20;
				$journal_entry->jurnal_type     = "invoice";
				$journal_entry->invoice_id      = $invoice->id;
				$journal_entry->contact_id      = $cart->user_id;
				$journal_entry->created_by      = Auth::user()->id;
				$journal_entry->updated_by      = Auth::user()->id;
				$journal_entry->assign_date     = date('Y-m-d', strtotime($invoice->invoice_date));
				$journal_entry->save();
			}
        //insert shipping charge as credit ends

		//insert adjustment as credit starts
			if($invoice->adjustment != 0)
			{
				$journal_entry                      = new JournalEntry;

				if($invoice->adjustment > 0)
				{
					$journal_entry->debit_credit    = 0;
				}
				else
				{
					$journal_entry->debit_credit    = 1;
				}

				$journal_entry->amount              = abs($invoice->adjustment);
				$journal_entry->account_name_id     = 18;
				$journal_entry->jurnal_type         = "invoice";
				$journal_entry->invoice_id          = $invoice->id;
				$journal_entry->contact_id          = $cart->user_id;
				$journal_entry->created_by          = Auth::user()->id;
				$journal_entry->updated_by          = Auth::user()->id;
				$journal_entry->assign_date         = date('Y-m-d', strtotime($invoice->invoice_date));
				$journal_entry->save();
			}
		//insert adjustment as credit ends
	}

	public function insertPaymentReceivesIntoJurnalEntry($payment_receive, $invoice)
	{
		$journal_entry                      = new JournalEntry;
		$journal_entry->debit_credit        = 1;
		$journal_entry->amount              = $payment_receive->amount;
		$journal_entry->account_name_id     = $payment_receive->account_id;
		$journal_entry->jurnal_type         = "payment_receive2";
		$journal_entry->payment_receives_id = $payment_receive->id;
		$journal_entry->created_by          = Auth::user()->id;
		$journal_entry->updated_by          = Auth::user()->id;
		$journal_entry->assign_date         = $payment_receive->payment_date;
		$journal_entry->contact_id          = $payment_receive->customer_id;
		$journal_entry->save();

		$journal_entry                      = new JournalEntry;
		$journal_entry->debit_credit        = 0;
		$journal_entry->amount              = $payment_receive->amount;
		$journal_entry->account_name_id     = 10;
		$journal_entry->jurnal_type         = "payment_receive2";
		$journal_entry->payment_receives_id = $payment_receive->id;
		$journal_entry->created_by          = Auth::user()->id;
		$journal_entry->updated_by          = Auth::user()->id;
		$journal_entry->assign_date         = $payment_receive->payment_date;
		$journal_entry->contact_id          = $payment_receive->customer_id;
		$journal_entry->save();

		$journal_entry 						= new JournalEntry;
		$journal_entry->debit_credit        = 0;
		$journal_entry->amount              = $payment_receive->amount;
		$journal_entry->account_name_id     = 5;
		$journal_entry->jurnal_type         = "payment_receive1";
		$journal_entry->payment_receives_id = $payment_receive->id;
		$journal_entry->invoice_id          = $invoice->id;
		$journal_entry->created_by          = Auth::user()->id;
		$journal_entry->updated_by          = Auth::user()->id;
		$journal_entry->assign_date         = $payment_receive->payment_date;
		$journal_entry->contact_id          = $payment_receive->customer_id;
		$journal_entry->save();

		$journal_entry 						= new JournalEntry;
		$journal_entry->debit_credit        = 1;
		$journal_entry->amount              = $payment_receive->amount;
		$journal_entry->account_name_id     = 10;
		$journal_entry->jurnal_type         = "payment_receive1";
		$journal_entry->payment_receives_id = $payment_receive->id;
		$journal_entry->invoice_id          = $invoice->id;
		$journal_entry->created_by          = Auth::user()->id;
		$journal_entry->updated_by          = Auth::user()->id;
		$journal_entry->assign_date         = $payment_receive->payment_date;
		$journal_entry->contact_id          = $payment_receive->customer_id;
		$journal_entry->save();
	}

	public function insertIntoCreditNotePayment($final_amount, $credit_note, $invoice)
	{
		$credit_note_payment 					= new CreditNotePayment;

		$credit_note_payment->amount            = $final_amount;
		$credit_note_payment->invoice_id        = $invoice->id;
		$credit_note_payment->credit_note_id    = $credit_note->id;
		$credit_note_payment->created_by        = Auth::user()->id;
		$credit_note_payment->updated_by        = Auth::user()->id;
		$credit_note_payment->created_at        = \Carbon\Carbon::now()->toDateTimeString();
		$credit_note_payment->updated_at        = \Carbon\Carbon::now()->toDateTimeString();
		$credit_note_payment->save();
	}

	public function deleteCart($cart)
	{
		if($cart->deleteCartItems()){
			$cart->delete();
		}

		//delete cart from session
		Session::forget('cart_id');
	}
}