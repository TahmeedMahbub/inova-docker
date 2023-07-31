<?php

namespace App\Modules\Contact\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\OrganizationProfile\OrganizationProfile;

use App\Models\Branch\Branch;
use App\Models\Contact\Contact;
use DB;

class ContactApiController extends Controller
{
    public function getContact($id)
    {
        $contact = Contact::find($id);

        $category   = DB::table('contact_category')->select('contact_category_name as text', 'id as value')->get();

        return response()->json([
            'contact'   =>  $contact,
            'category'  =>  $category,
        ], 201);
    }

    public function getDisplayName()
    {
        $branch                 = Branch::find(Auth::user()->branch_id);
        $last_contact_id        = Contact::orderBy('id', 'desc')->first();

        if($last_contact_id == null){
            $display_name       = $branch->branch_prefix . "-" . str_pad(1, 6, '0', STR_PAD_LEFT);
        }else{
            $display_name       = $branch->branch_prefix . "-" . str_pad($last_contact_id->id + 1, 6, '0', STR_PAD_LEFT);
        }

        return response()->json([
            'display_name'   =>  $display_name,
        ], 201);
    }

    public function store(Request $request)
    {
      
        $this->validate($request, [
           'display_name'      => 'required|unique:contact',
           'phone_number_1'    => 'required|unique:contact'
       ]);


        DB::beginTransaction();

        try
        {
            $data = $request->all();
            $user_id = Auth::user()->id;
            $user_branch_id = Auth::user()->branch_id;
            $contact = new Contact;

            if($data['contact_category_id'] == 5)
            {
                $account = new Account();
                $account->account_name =$data['display_name'];
                $account->account_code =$data['display_name'];
                $account->account_type_id =5;
                $account->parent_account_type_id =1;
                $account->required_status =1;
                $account->created_by = $user_id;
                $account->updated_by = $user_id;
                $account->save();
            }

            $contact->display_name = $data['display_name'];
            $contact->phone_number_1 = $data['phone_number_1'];
            $contact->contact_category_id = $data['contact_category_id'];

            if($data['contact_category_id'] != 6)
            {
                $contact->account_id = isset($account->id)? $account->id : null;
            }

            $contact->contact_status = 1;
            $contact->branch_id = $user_branch_id;
            $contact->created_by = $user_id;
            $contact->updated_by = $user_id;

            if($contact->save())
            {
                DB::commit();

                return response()->json([
                    'id'                =>  $contact->id,
                    'display_name'      =>  $contact->display_name,
                ], 201);

            }


            DB::rollBack();
            throw new \Exception("Failed to Add");

            return response()->json([
                'msg'                =>  $e->getMessage(),
            ], 201);


        }
        catch (Exception $e)
        {

            DB::rollBack();

            return response()->json([
                    'msg'                =>  $e->getMessage(),
                ], 201);

        }

    }


    public function All()
    {

        $branch_id = session('branch_id');

        $show_all_contact = OrganizationProfile::first();
        $show_all_contact = $show_all_contact->show_all_contact;

        if($show_all_contact == 0){

            if($branch_id == "1"){

                $contacts = Contact::leftjoin("contact_category", "contact.contact_category_id", "contact_category.id")
                                    ->leftjoin('users' , 'users.id', '=', 'contact.created_by')
                                    ->leftjoin('branch' , 'branch.id', '=', 'users.branch_id')
                                    ->select("contact_category.contact_category_name", "contact.first_name as first_name", "contact.last_name as last_name", "contact.display_name as display_name", "contact.present_class as present_class", "contact.email_address", "contact.phone_number_1","branch.branch_name","contact.id")
                                    ->orderBy('contact.updated_by', 'DESC')
                                    ->get();

            }
            else {

                $contacts = Contact::leftjoin("contact_category","contact.contact_category_id","contact_category.id")
                                    ->leftjoin('users' , 'users.id', '=', 'contact.created_by')
                                    ->leftjoin('branch' , 'branch.id', '=', 'users.branch_id')
                                    ->select("contact_category.contact_category_name","contact.first_name as first_name","contact.last_name as last_name","contact.display_name as display_name", "contact.present_class as present_class", "contact.email_address","contact.phone_number_1","branch.branch_name","contact.id")
                                    ->where('users.branch_id', '=', $branch_id)
                                    ->orderBy('contact.updated_by', 'DESC')
                                    ->get();

            }

        }else{

            // $contacts = Contact::leftjoin("contact_category", "contact.contact_category_id", "contact_category.id")
            //                     ->leftjoin('users' , 'users.id', '=', 'contact.created_by')
            //                     ->leftjoin('branch' , 'branch.id', '=', 'users.branch_id')
            //                     ->select("contact_category.contact_category_name", "contact.first_name as first_name", "contact.last_name as last_name", "contact.display_name as display_name", "contact.present_class as present_class", "contact.email_address", "contact.phone_number_1","branch.branch_name","contact.id")
            //                     ->orderBY('contact.present_class', 'DESC')
            //                     ->get();


            if($branch_id == "1"){

                $contacts = Contact::leftjoin("contact_category", "contact.contact_category_id", "contact_category.id")
                                    ->leftjoin('users' , 'users.id', '=', 'contact.created_by')
                                    ->leftjoin('branch' , 'branch.id', '=', 'users.branch_id')
                                    ->select("contact_category.contact_category_name", "contact.first_name as first_name", "contact.last_name as last_name", "contact.display_name as display_name", "contact.present_class as present_class", "contact.email_address", "contact.phone_number_1","branch.branch_name","contact.id")
                                    ->orderBy('contact.updated_by', 'DESC')
                                    ->get();

            }
            else {

                $contacts = Contact::leftjoin("contact_category","contact.contact_category_id","contact_category.id")
                                    ->leftjoin('users' , 'users.id', '=', 'contact.created_by')
                                    ->leftjoin('branch' , 'branch.id', '=', 'users.branch_id')
                                    ->select("contact_category.contact_category_name","contact.first_name as first_name","contact.last_name as last_name","contact.display_name as display_name", "contact.present_class as present_class", "contact.email_address","contact.phone_number_1","branch.branch_name","contact.id")
                                    ->where('users.branch_id', '=', $branch_id)
                                    ->orderBy('contact.updated_by', 'DESC')
                                    ->get();

            }

        }

        return response($contacts);
    }

    public function findByName(Request $request)
    {

        $show_all_contact = OrganizationProfile::first();
        $show_all_contact = $show_all_contact->show_all_contact;
        $branch_id        = session('branch_id');

        
        if($branch_id == 1)
        {

            $contacts = Contact::leftjoin("contact_category","contact.contact_category_id","contact_category.id")
                        ->leftjoin('users' , 'users.id', '=', 'contact.created_by')
                        ->leftjoin('branch' , 'branch.id', '=', 'users.branch_id')
                        ->where('contact.display_name',"like","%$request->name%")
                        ->select("contact_category.contact_category_name","contact.first_name","contact.last_name","contact.display_name", "contact.present_class as present_class", "contact.email_address","contact.phone_number_1","branch.branch_name","contact.id")
                        ->get();

        }
        else
        {

            $contacts = Contact::leftjoin("contact_category","contact.contact_category_id","contact_category.id")
                        ->leftjoin('users' , 'users.id', '=', 'contact.created_by')
                        ->leftjoin('branch' , 'branch.id', '=', 'users.branch_id')
                        ->where('contact.display_name',"like","%$request->name%")
                        ->where('users.branch_id', '=', $branch_id)
                        ->select("contact_category.contact_category_name","contact.first_name","contact.last_name","contact.display_name", "contact.present_class as present_class", "contact.email_address","contact.phone_number_1","branch.branch_name","contact.id", "users.branch_id")
                        ->get();


        }

       

        return response($contacts);
    }

    public function syncAllContacts()
    {
        $user = Auth::user();
        $count = 0;
        $graphqlEndpoint = env("graphql_endpoint");

        $query = 'query {
                    customers {
                        id,
                        name,
                        user {
                            username
                        },
                        photo,
                        phone,
                        addresses{
                            id,
                            label,
                            phone,
                            addressLine,
                            zipCode,
                            city {
                                name
                            }
                        }
                    }
                }';

        $client = new Client();

        try {
            $response = $client->get($graphqlEndpoint, [
                'json' => ['query' => $query],
            ]);
            $data = json_decode($response->getBody(), true);
            
            $customers = $data['data']['customers'];
            foreach ($customers as $customer) {
                $contact = Contact::where('ecom_id', $customer['id'])->orWhere('ecom_username', $customer['user']['username'])->first();
                if(empty($contact))
                {
                    $contact = new Contact;
                    $contact->code              = "ecom-".$customer['id'];
                    $contact->ecom_id           = $customer['id'];
                    $contact->ecom_username     = $customer['user']['username'];
                    $contact->profile_pic_url   = $customer['name'];
                    $contact->display_name      = $customer['user']['username'];
                    $contact->phone_number_1    = $customer['phone'];
                    $contact->billing_address   = !empty($customer['addresses']) ? $customer['addresses'][0]['addressLine'].", ".$customer['addresses'][0]['city']['name']."-".$customer['addresses'][0]['zipCode'] : "";
                    $contact->contact_category_id = 1; // CATEGORY IS CUSTOMER BY DEFAULT
                    $contact->contact_status    = 1; 
                    $contact->branch_id         = $user->branch_id;
                    $contact->created_by        = $user->id;
                    $contact->updated_by        = $user->id;
                    $contact->created_at        = \Carbon\Carbon::now()->toDateTimeString();
                    $contact->updated_at        = \Carbon\Carbon::now()->toDateTimeString();
                    $contact->save();

                    $count++;
                }
            }
            
            return redirect()
            ->route('contact')
            ->with('alert.status', 'success')
            ->with('alert.message', $count.' Customers Synced from Ecommerce.');

            return response()->json(['data' => $data], 200);
        } catch (\Exception $e) {
            return redirect()
            ->route('contact')
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Facing Problem Syncing Customers from Ecommerce! Problem: '.$e);
        }
    }
}
