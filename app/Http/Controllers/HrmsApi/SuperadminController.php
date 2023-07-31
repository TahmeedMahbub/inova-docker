<?php

namespace App\Http\Controllers\HrmsApi;

use App\User;
use Illuminate\Http\Request;
use App\Models\Contact\Contact;
use App\Models\AccessLevel\Role;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SuperadminController extends Controller
{
    public function hrms_create_superadmin(Request $request){
        
        $contact_category_id = 3;
        $superadmin = User::where('role_id', 1)->first();

        if(!$superadmin){
            return response()->json(['status' => 'failed', 'message' => 'There is no SuperAdmin in AMS']);
        }

        // USERS TABLE VALIDATION + OTHERS
        Validator::make($request->all()[0], [
            'first_name'                => 'required|string|min:6|max:255',
            'last_name'                 => 'nullable|string|min:6|max:255',
            'user_name'                 => 'required|string|min:6|max:255',
            'email'                     => 'required|email|string|max:255|unique:users,email',
            'password'                  => 'required|string|min:8|confirmed',
            'finger_id'                 => 'required|numeric|min:0|max:4000000000|unique:users,finger_print_id',
            'branch_id'                 => 'required|numeric|integer|exists:branch,branch_id',
            'role_id'                   => 'required|numeric|integer|exists:role,role_id',
            'phone'                     => 'required|string|numeric',
        ], [
            'phone.required' => 'Contact number is required.',
            'phone.string'   => 'Contact number should be a string.',
            'phone.numeric'  => 'Contact number should have numeric characters only.',
            'finger_id.unique'  => 'Fingerprint has to be unique.'
        ]);

        // CONTACT TABLE VALIDATION - OTHERS
        Validator::make($request->all()[0], [
            'email'                     => 'required|email|string|max:255|unique:contact,email_address',
            'finger_id'                 => 'required|numeric|min:0|max:4000000000|unique:contact,finger_print_id',
            'phone'                     => 'required|numeric|integer',

        ], [
            'phone.required' => 'Contact number is required.',
            'phone.numeric'  => 'Contact number should have numeric characters only.',
            'finger_id.unique'  => 'Fingerprint has to be unique.'
        ]);

        // return response()->json(['status' => 'success', 'data' => $request->all()[0]]);

        $data = $request->all()[0];
        DB::beginTransaction();

        try {
            $contact                       = new Contact;
            $contact->first_name           = $data['first_name'];
            $contact->last_name            = isset($data['last_name']) ? $data['last_name'] : null;
            $contact->display_name         = $data['user_name'];
            $contact->email_address        = $data['email'];
            $contact->finger_print_id      = $data['finger_id'];
            $contact->branch_id            = $data['branch_id'];
            $contact->phone_number_1       = $data['phone'];
            $contact->phone_number_2       = isset($data['personal_phone']) ? $data['personal_phone'] : null;
            $contact->created_by           = $superadmin->id;
            $contact->updated_by           = $superadmin->id;
            $contact->contact_category_id  = $contact_category_id;
            $contact->save();

            $user                       = new User;
            $user->name                 = $data['user_name'];
            $user->email                = $data['email'];
            $user->password             = bcrypt($data['password']);
            $user->contact_id           = $contact->id;
            $user->finger_print_id      = $data['finger_id'];
            $user->branch_id            = $data['branch_id'];
            $user->phone                = $data['phone'];
            $user->activated            = 1;
            $user->role_id              = $data['role_id'];
            $user->created_by           = $superadmin->id;
            $user->updated_by           = $superadmin->id;
            $user->save();            
            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Superadmin added successfully!']);

        } catch (\Exception $e) {
            DB::rollback();
            // return $e->getMessage();
            $bug = $e->getMessage();
            return response()->json(['status' => 'failed', 'message' => 'Something went wrong adding superadmin! Please try again. Reason: ' . $bug]);
        }
    }
    
    public function hrms_create_contact(Request $request){
        // first_name, last_name, profile_pic_url, display_name(user Name), finger_print_id, email_address, phone_number_1

        
        $superadmin = User::where('role_id', 1)->first();

        if(!$superadmin){
            return response()->json(['status' => 'failed', 'message' => 'There is no SuperAdmin in AMS']);
        }

        $contact_category_id = 3;

        Validator::make($request->all()[0], [
            'first_name'                => 'required|string|min:6|max:255',
            'last_name'                 => 'nullable|string|min:6|max:255',
            'user_name'                 => 'required|string|min:6|max:255',
            'email'                     => 'required|email|string|max:255|unique:contact,email_address',
            'finger_id'                 => 'required|numeric|min:0|max:4000000000|unique:contact,finger_print_id',
            'branch_id'                 => 'required|numeric|integer|exists:branch,branch_id',
            'phone'                     => 'required|numeric|integer',
            'personal_phone'            => 'nullable|numeric|integer',

        ], [
            'phone.required' => 'Contact number is required.',
            'phone.numeric'  => 'Contact number should have numeric characters only.',
            'finger_id.unique'  => 'Fingerprint has to be unique.'
        ]);

        $data = $request->all()[0];
        // return response()->json(['status' => 'failed', 'message' => $data]);

        DB::beginTransaction();
        try {
        // return response()->json(['status' => 'success', 'message' => $superadmin_role_id]);
            $contact                       = new Contact;
            $contact->first_name           = $data['first_name'];
            $contact->last_name            = isset($data['last_name']) ? $data['last_name'] : null;
            $contact->display_name         = $data['user_name'];
            $contact->email_address        = $data['email'];
            $contact->finger_print_id      = $data['finger_id'];
            $contact->branch_id            = $data['branch_id'];
            $contact->phone_number_1       = $data['phone'];
            $contact->phone_number_2       = isset($data['personal_phone']) ? $data['personal_phone'] : null;
            $contact->created_by           = $superadmin->id;
            $contact->updated_by           = $superadmin->id;
            $contact->contact_category_id  = $contact_category_id;
            $contact->save();
            
            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Contact added successfully!']);

        } catch (\Exception $e) {
            DB::rollback();
            $bug = $e->getMessage();
            return response()->json(['status' => 'failed', 'message' => 'Something went wrong adding employee in contact! Please try again. Reason: ' . $bug]);
        }
    }

    public function hrms_edit_employee(Request $request)
    {//1
        $data = $request->all()[0];
        Validator::make($request->all()[0], [
            'first_name'                => 'required|string|min:6|max:255',
            'last_name'                 => 'nullable|string|min:6|max:255',
            'user_name'                 => 'required|string|min:6|max:255',
            'branch_id'                 => 'required|numeric|integer|exists:branch,branch_id',
            'phone'                     => 'required|numeric|integer',

        ], [
            'phone.required' => 'Contact number is required.',
            'phone.numeric'  => 'Contact number should have numeric characters only.',
        ]);
//2
        DB::beginTransaction();

            if($data['role_status'] == "EmployeeToAdmin") // ADD USER
            {
                $superadmin = User::where('role_id', 1)->first();
        
                if(!$superadmin){
                    return response()->json(['status' => 'failed', 'message' => 'There is no SuperAdmin in AMS']);
                }

                Validator::make($request->all()[0], [
                    'first_name'                => 'required|string|min:6|max:255',
                    'last_name'                 => 'nullable|string|min:6|max:255',
                    'user_name'                 => 'required|string|min:6|max:255',
                    'email'                     => 'required|email|string|max:255|unique:users,email',
                    'finger_id'                 => 'required|numeric|min:0|max:4000000000|unique:users,finger_print_id',
                    'branch_id'                 => 'required|numeric|integer|exists:branch,branch_id',
                    'role_id'                   => 'required|numeric|integer|exists:role,role_id',
                    'phone'                     => 'required|string|numeric',
                ], [
                    'phone.required' => 'Contact number is required.',
                    'phone.string'   => 'Contact number should be a string.',
                    'phone.numeric'  => 'Contact number should have numeric characters only.',
                    'finger_id.unique'  => 'Fingerprint has to be unique.'
                ]);
                return response()->json(['status' => 'failed', 'message' => 'a2']);

                $contact = Contact::where('finger_print_id', $data["old_finger_id"])->first();
                
                $user                       = new User;
                $user->name                 = $data['user_name'];
                $user->email                = $data['email'];
                // $user->password             = bcrypt($data['password']);
                $user->contact_id           = $contact->id;
                $user->finger_print_id      = $data['finger_id'];
                $user->branch_id            = $data['branch_id'];
                $user->phone                = $data['phone'];
                $user->activated            = 1;
                $user->role_id              = $data['role_id'];
                $user->created_by           = $superadmin->id;
                $user->updated_by           = $superadmin->id;
                $user->save();            
                DB::commit();
            }
            else if($data['role_status'] == "AdminToEmployee") // DELETE USER
            {
                $user = User::where('finger_print_id', $data["old_finger_id"])->first();

                if(!$user){
                    return response()->json(['status' => 'failed', 'message' => 'There is no user using this fingerprint id in AMS']);
                }

                $user->delete();
            }
            else if($data['role_status'] == "Admin")
            {
                $user = User::where('finger_print_id', $data['old_finger_id'])->first();

                if(!$user){
                    return response()->json(['status' => 'failed', 'message' => 'There is no user using this fingerprint id in AMS']);
                }

                $user->name                 = $data['user_name'];
                $user->email                = $data['email'];
                // $user->password             = bcrypt($data['password']);
                $user->finger_print_id      = $data['finger_id'];
                $user->branch_id            = $data['branch_id'];
                $user->phone                = $data['phone'];

                $user->save();
            }

            $contact = Contact::where('finger_print_id', $data["old_finger_id"])->first();

            if($data['email'] != $contact->email_address){
                Validator::make($request->all()[0], [
                    'email'          => 'required|email|string|max:255|unique:contact,email_address'
                ], [
                    'email.unique' => 'Email Already Exists!'
                ]);
            }
            if($data['old_finger_id'] != $contact->finger_print_id){
                Validator::make($request->all()[0], [
                    'finger_id'         => 'required|numeric|min:0|max:4000000000|unique:contact,finger_print_id'
                ], [
                    'finger_id.unique'  => 'Fingerprint has to be unique.'
                ]);
            }

            $contact->first_name           = $data['first_name'];
            $contact->last_name            = isset($data['last_name']) ? $data['last_name'] : null;
            $contact->display_name         = $data['user_name'];
            $contact->email_address        = $data['email'];
            $contact->finger_print_id      = $data['finger_id'];
            $contact->branch_id            = $data['branch_id'];
            $contact->phone_number_1       = $data['phone'];
            $contact->phone_number_2       = isset($data['personal_phone']) ? $data['personal_phone'] : null;
            $contact->save();


        try {                
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Contact edited successfully!']);

        } catch (\Exception $e) {
            DB::rollback();
            $bug = $e->getMessage();
            return response()->json(['status' => 'failed', 'message' => 'Something went wrong editing employee in contact! Please try again. Reason: ' . $bug]);
        }

    }
    

    public function hrms_delete_employee(Request $request)
    {
        DB::beginTransaction();

        try {
            $contact = Contact::where('finger_print_id', $request->finger_id)->first();
            
            if($request->role_id == 1)
            {
                $user = User::where('finger_print_id', $request->finger_id)->first();
                if(!empty($user)){
                    $user->delete();
                }
            }            
            if(!empty($contact)){
                $contact->delete();
            }
            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Employee deleted successfully!']);

        } catch (\Exception $e) {
            DB::rollback();
            $bug = $e->getMessage();
            return response()->json(['status' => 'failed', 'message' => 'Something went wrong deleting employee! Please try again. Reason: ' . $bug]);
        }
    }

    public function hrms_change_pass(Request $request)
    {
        $data = $request->all()[0];
        $user = User::where('finger_print_id', $data['finger_id'])->first();
        if($user)
        {
            if(Hash::check($data['oldPassword'], $user->password))
            {
                $user->password = Hash::make($data['password']);
                if($user->save())
                {
                    return response()->json(['status' => 'success', 'message' => 'Password Changed From AMS!']);
                }
                else
                {
                    return response()->json(['status' => 'failed', 'message' => 'Password Could not be changed From Accounting Software!']);
                }
            }
            else
            {
                return response()->json(['status' => 'failed', 'message' => 'Old Password Not Matched in Accounting Software!']);
            }
        } 
        else 
        {
            return response()->json(['status' => 'failed', 'message' => 'User Not Found in Accounting Software!']);
        }
    }

    public function test()
    {dd(env('DB_DATABASE'));
        return response()->json(['status' => 'success', 'message' => 'Successfully Connected with Test ']);
    }

}
