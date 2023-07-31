<?php

namespace App\Modules\Contact\Http\Controllers;


use App\Models\AccountChart\Account;
use App\Models\ManualJournal\JournalEntry;
use DateTime;
use Exception;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

// Models
use App\Models\Branch\Branch;
use App\Models\Contact\Contact;
use App\Models\Contact\ContactZones;
use App\Models\Contact\ContactCategory;
use App\Models\Contact\Agent;
use App\Models\MoneyOut\Bill;
use App\Models\Moneyin\Invoice;
use App\Models\OrganizationProfile\OrganizationProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Response;

class ContactWebController extends Controller
{
    public function index()
    {
        $contacts = [];
        $agents = [];
        $contactCategories = ContactCategory::all();
        $date = new DateTime('now');
        $date->modify('first day of this month');

        $branch_id = session('branch_id');
        $start = $date->format('Y-m-d');
        $date->modify('last day of this month');
        $end = $date->format('Y-m-d');
        $contact_route = route("report_account_api_Contact_Item_Details",['branch'=>$branch_id,'start'=>$start,'end'=>$end,'id'=>'']);
        $contact_transaction = route("report_account_single_contact_details",['branch'=>$branch_id,'start'=>$start,'end'=>$end,'id'=>'new_id']);

        return view('contact::contact.ajax.index', compact('contact_transaction','contact_route', 'contacts', 'contactCategories', 'agents'));
    }

    public function create()
    {
        $recruit                = 0;
        $contact_categories     = ContactCategory::all();
        $user_branch            = Auth::user()->branch_id;
        $branch                 = Branch::find($user_branch);
        $last_contact_id        = Contact::orderBy('id', 'desc')->first();
        $agents                 = Contact::where('contact_category_id', 2)
                                    ->orderBy('id', 'asc')
                                    ->get();


        if($last_contact_id == null){
            $display_name       = $branch->branch_prefix . "-" . str_pad(1, 6, '0', STR_PAD_LEFT);
        }else{
            $display_name       = $branch->branch_prefix . "-" . str_pad($last_contact_id->id + 1, 6, '0', STR_PAD_LEFT);
        }

        return view('contact::contact.create', compact('contact_categories', 'recruit', 'display_name', 'agents'));
    }

    public function create_customer(Request $request)
    {
        $recruit = 1;
        $contact_categories = ContactCategory::all();
        return view('contact::contact.create', compact('contact_categories','recruit'));
    }

    public function store(Request $request, $module_id=null)
    {
        // dd($request->all());
        if ($request->contact_category_id == 1) {
            $this->validate($request, [
               'display_name'      => 'required|unique:contact',
               'phone_number_1'    => 'required',
               'contact_code'    => 'required'
            ]);
        }
        else{
            $this->validate($request, [
                'display_name'      => 'required|unique:contact',
                'phone_number_1'    => 'required',
             ]);
        }

        
        DB::beginTransaction();

        try
        {
            $data           = $request->all();

            if ($module_id == 1)
            {
                $data['email_address'] = $request->email;
            }

            $user_id        = Auth::user()->id;
            $user_branch_id = Auth::user()->branch_id;
            $user_branch    = Auth::user()->branch_id;
            $branch         = Branch::find($user_branch);

            $contact        = new Contact;

            if($request->hasFile('profile_picture'))
            {
                $file               = $request->file('profile_picture');
                $file_name          = $file->getClientOriginalName();
                $without_extention  = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention     = $file->getClientOriginalExtension();
                $num                = rand(1,500);
                $new_file_name      = $without_extention.$num.'.'.$file_extention;
                $success            = $file->move('uploads/contact',$new_file_name);

                if($success)
                {
                    $contact->profile_pic_url = 'uploads/contact/'.$new_file_name;
                }
            }

            if($data['contact_category_id']==5)
            {
                $account                            = new Account();
                $account->account_name              = $data['display_name'];
                $account->account_code              = $data['display_name'];
                $account->account_type_id           = 5;
                $account->parent_account_type_id    = 1;
                $account->required_status           = 1;
                $account->created_by                = $user_id;
                $account->updated_by                = $user_id;
                $account->save();
            }

            $contact->code                    = $request->contact_category_id == 1 ? $data['contact_code'] : '';
            $contact->first_name              = isset($data['first_name']) ? $data['first_name'] : '';
            $contact->last_name               = isset($data['last_name']) ? $data['last_name'] : '';
            $contact->display_name            = $data['display_name'];
            $contact->company_name            = isset($data['company_name']) ? $data['company_name'] : '';
            $contact->email_address           = $data['email_address'];
            $contact->phone_number_1          = $data['phone_number_1'];
            $contact->phone_number_2          = isset($data['phone_number_2']) ? $data['phone_number_2'] : '';
            $contact->phone_number_3          = isset($data['phone_number_3']) ? $data['phone_number_3'] : '';
            $contact->billing_address         = isset($data['billing_address']) ? $data['billing_address'] : '';
            $contact->shipping_address        = isset($data['shipping_address']) ? $data['shipping_address'] : '';
            $contact->about                   = isset($data['about']) ? $data['about'] : '';
            $contact->contact_category_id     = $data['contact_category_id'];
            $contact->fb_id                   = isset($data['fb_id']) ? $data['fb_id'] : '';
            
            if (isset($data['agent']) && $data['agent'] != null && $data['agent'] > 0) 
            {
                $contact->agent_id            = $data['agent'];
            }
            else{
                $contact->agent_id            = null;
            }



            if($data['contact_category_id']!=6)
            {
                $contact->account_id = isset($account->id)?$account->id:null;
            }

            $contact->contact_status    = 1;
            $contact->branch_id         = $user_branch_id;
            $contact->created_by        = $user_id;
            $contact->updated_by        = $user_id;

            if($contact->save())
            {   
                // foreach ($data['zone_id'] as $key => $value)
                // {
                //     $zone = new ContactZones;
                //     $zone->contact_id       = $contact->id;
                //     $zone->zone_id          = $value;
                //     $zone->created_by       = $user_id;
                //     $zone->updated_by       = $user_id;
                //     $zone->save();
                // }

                if ($module_id == 1)
                {   
                    DB::commit();
                    
                    return true;
                    
                }
                else{

                    DB::commit();
                    return redirect()
                            ->route('contact')
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'Conatact Added Successfully!');
                }
                    
            }

        }
        catch (Exception $e)
        {
            DB::rollBack();

            return redirect()
                    ->route('contact')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Something Went Wrong!');

                
        }
    }

    public function show($id)
    {
        $contact = Contact::find($id);

        $checkAccess = $this->checkIfUserHasAccess($contact);

        if($checkAccess == 1){
            return back();
        }

        $contact_category = $contact->contactCategory->contact_category_name;
        return view('contact::contact.view', compact('contact', 'contact_category'));
    }

    public function showAgent($id)
    {
        $contact = Contact::find($id);
        $contact_category = "Agent";
        return view('contact::contact.view', compact('contact', 'contact_category'));
    }

    public function edit($id)
    {
        $contact        = Contact::find($id);
        $checkAccess    = $this->checkIfUserHasAccess($contact);
        $agents         = Contact::where('contact_category_id', 2)
                            ->orderBy('id', 'asc')
                            ->get();

        if($checkAccess == 1){
            return back();
        }

        $contact_id             = $id;
        $contact_categories     = ContactCategory::all();
        $contact_category_id    = Contact::find($id)->contactCategory->id;

        return view('contact::contact.edit', compact('contact', 'contact_categories', 'contact_category_id', 'contact_id', 'agents'));
    }

    public function editAgent($id)
    {
        $contact = Contact::find($id);
        $contact_id = $id;
        $contact_categories = ContactCategory::all();
        $contact_category_id = 6;
        return view('contact::contact.edit', compact('contact', 'contact_categories', 'contact_category_id', 'contact_id'));
    }

    public function update(Request $request, $id, $module_id=null)
    {
        $contact = Contact::find($id);

        if($request->contact_category_id == 1 && $contact->code != $request->contact_code){
            $this->validate($request, [
                'display_name'      => 'required|unique:contact, "display_name",' . $id,
                'phone_number_1'    => 'required',
                'contact_code'      => 'required',
            ]);
        }else{
            $this->validate($request, [    
                'display_name'      => 'required|unique:contact, "display_name",' . $id,
                'phone_number_1'    => 'required',
            ]);
        }

        $data           = $request->all();

        if ($module_id == 1)
        {
            $data['email_address'] = $request->email;
        }

        $created_by     = $contact->created_by;
        $user_id        = Auth::user()->id;

        if($contact['contact_category_id'] == 5){

            $contact->contact_category_id = 5;
        }
        else{

            $contact->contact_category_id = $data['contact_category_id'];
        }

        DB::beginTransaction();

        try
        {

            if($request->hasFile('profile_picture'))
            {
                if($contact->profile_pic_url)
                {
                    $delete_path = public_path($contact->profile_pic_url);
                    $delete = unlink($delete_path);
                }
                $file = $request->file('profile_picture');
                $file_name = $file->getClientOriginalName();
                $without_extention = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention = $file->getClientOriginalExtension();
                $num = rand(1,500);
                $new_file_name = $without_extention.$num.'.'.$file_extention;
                $success = $file->move('uploads/contact',$new_file_name);
                if($success)
                {
                    $contact->profile_pic_url = 'uploads/contact/'.$new_file_name;
                }
            }

            if($contact->account_id)
            {
                $account                            = Account::find($contact->account_id);
                $account->account_name              = $data['display_name'];
                $account->account_code              = $data['display_name'];
                $account->account_type_id           = 5;
                $account->parent_account_type_id    = 1;
                $account->updated_by                = $user_id;
                $account->save();
            }

            $contact->code                    = $request->contact_category_id == 1 ? $data['contact_code'] : '';
            $contact->first_name              = isset($data['first_name']) ? $data['first_name'] : '';
            $contact->last_name               = isset($data['last_name']) ? $data['last_name'] : '';
            $contact->display_name            = $data['display_name'];
            $contact->company_name            = isset($data['company_name']) ? $data['company_name'] : '';
            $contact->email_address           = $data['email_address'];
            $contact->phone_number_1          = $data['phone_number_1'];
            $contact->phone_number_2          = isset($data['phone_number_2']) ? $data['phone_number_2'] : '';
            $contact->phone_number_3          = isset($data['phone_number_3']) ? $data['phone_number_3'] : '';
            $contact->billing_address         = isset($data['billing_address']) ? $data['billing_address'] : '';
            $contact->shipping_address        = isset($data['shipping_address']) ? $data['shipping_address'] : '';
            $contact->about                   = isset($data['about']) ? $data['about'] : '';
            $contact->contact_category_id     = $data['contact_category_id'];
            $contact->fb_id                   = isset($data['fb_id']) ? $data['fb_id'] : '';

            if (isset($data['agent']) && $data['agent'] != null && $data['agent'] > 0) 
            {
                $contact->agent_id            = $data['agent'];
            }
            else{
                $contact->agent_id            = null;
            }



            if($contact->save())
            {   
                // $zone_find   = ContactZones::where('contact_id', $id)->delete();

                // if(!empty($data['zone_id']))
                // {
                //     foreach ($data['zone_id'] as $key => $value)
                //     {
                //         $zone = new ContactZones;
                //         $zone->contact_id       = $contact->id;
                //         $zone->zone_id          = $value;
                //         $zone->created_by       = $user_id;
                //         $zone->updated_by       = $user_id;
                //         $zone->save();
                //     }
                // }
                
                if ($module_id == 1)
                {   
                    DB::commit();

                    return true;
                    
                }
                else{
                    DB::commit();
                    
                    return redirect()
                            ->route('contact')
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'Contact Updated Successfully!');
                }

                // return redirect()
                // ->route('contact', ['id' => $id])
                // ->with('alert.status', 'success')
                // ->with('alert.message', 'Contact Updated Successfully!');
            }
            else
            {
                throw new \Exception();

            }

        }
        catch (\Exception $e)
        {
            DB::rollBack();
            
            return redirect()
                        ->route('contact', ['id' => $id])
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Sorry, something went wrong! Data cannot be Updated.');

        }
    }

    public function destroy($id)
    {

        DB::beginTransaction();

        try
        {
            $contact = Contact::find($id);

            $contact_user = Contact::join('users', 'users.contact_id', 'contact.id')->where('contact.id', $id)->get();

            if ($contact_user->count() != 0)
            {
                return redirect()
                        ->route('contact')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'You Can Not Delete This Contact!');
            }

            $checkAccess = $this->checkIfUserHasAccess($contact);

            if($checkAccess == 1){
                return back();
            }


            $account_journal    = 0;
            $journal            = JournalEntry::where('contact_id', $contact->id)->count();

            if($contact->contact_category_id == 5){

                $account_journal = JournalEntry::where('account_name_id', $contact->account_id)->count();

            }


            if($journal || $account_journal){

                DB::rollBack();

                return redirect()
                  ->route('contact')
                  ->with('alert.status', 'danger')
                  ->with('alert.message', 'Sorry, contact cannot be Deleted.
                    Because this contact contain transactions. Remove all transactions for this contact to delete contact');

            }else{

                try{

                    if($contact->profile_pic_url)
                    {
                        $delete_path        = public_path($contact->profile_pic_url);
                        $delete             = unlink($delete_path);
                    }

                    if($contact->contact_category_id == 5){

                        Account::find($contact->account_id)->delete();

                    }

                    $contact->delete();

                    DB::commit();

                    return redirect()
                        ->route('contact')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Contact Deleted Successfully!');

                }
                catch (\Exception $e){

                    DB::rollBack();

                    return redirect()
                        ->route('contact')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Sorry, contact cannot be Deleted. Something wrong try again ');
                }

            }

        }
        catch(Exception $e)
        {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function destroyAgent($id)
    {
        try
        {
            $agent = Agent::find($id);

            if($agent->profile_pic_url)
            {
                $delete_path = public_path($agent->profile_pic_url);
                $delete = unlink($delete_path);
            }

            if ($agent->delete())
            {
                return redirect()
                ->route('contact')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Agent Deleted successfully!');
            }
            else
            {
                return redirect()
                ->route('contact')
                ->with('alert.status', 'alert')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be Deleted.');
            }
        }
        catch (Exception $e)
        {
            return redirect()
            ->route('contact')
            ->with('alert.status', 'alert')
            ->with('alert.message', 'Sorry, something went wrong! Data cannot be Deleted.');
        }
    }

    public function pdf()
    {
        return back();

        $OrganizationProfile = OrganizationProfile::first();
        $contacts = Contact::all();

        return view('contact::contact.pdf', compact('contacts', 'OrganizationProfile'));
    }

    public function checkIfUserHasAccess($contact)
    {

        $user_branch    = Auth::user()->branch_id;

        if($contact->createdBy->branch_id != $user_branch && $user_branch != 1){
            return 1;
        }
    }

    public function displayName($name)
    {
        $name= trim($name, ' ');
        $branch_id = Auth::user()->branch_id;
        $find      = Contact::where('branch_id',$branch_id)->select('display_name')->get();
        foreach($find as $value)
        {
          $dis_name = trim($value->display_name , ' ');
        $value->display_name == $name ? $data = $name.'already exit' : $data ='';
        }
        return response($data);
    }

    public function displayNamePer($name,$id)
    {
        $name       = trim($name, ' ');
        $branch_id  = Auth::user()->branch_id;
        $find       = Contact::where('branch_id',$branch_id)->select('display_name')->get();

        foreach($find as $value)
        {  
            $dis_name = trim($value->display_name , ' ');
            if($value != $id)
                $dis_name==$name ? $data = $name.'already exit' : $data ='';
            else

            $data ='';
        }

        return response($data);
    }
}
