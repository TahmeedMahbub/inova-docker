<?php

namespace App\Modules\Settings\Http\Controllers;

use DB;
// use App\Http\Requests;
use App\User;
// use Illuminate\Support\Facades\File;
use Exception;
use GuzzleHttp\Client;

//Create Table
// use Artisan;
// use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Schema\Blueprint;

use Illuminate\Http\Request;
//Models
use App\Models\Branch\Branch;
use App\Models\Contact\Contact;
use App\Models\AccessLevel\Role;
// use App\Models\AccessLevel\Modules;
// use App\Models\AccessLevel\AccessLevel;
use App\Http\Controllers\Controller;
use App\Models\OrganizationProfile\OrganizationProfile;
use Illuminate\Support\Facades\Auth;
// use App\Models\Crm\Zone\Zone;
// use App\Models\Contact\ContactZones;
// use App\Modules\Contact\Http\Controllers\ContactWebController;

class UserWebController extends Controller
{

    public function __construct(OrganizationProfile $op)
    {
        $this->op = $op->first();
    }

    public function index()
    {
        $id     =  Auth::user()->id;

        $users  = User::whereNotIn('id', [$id])->get();

        return view('settings::users.index', compact('users'));
    }

    public function create()
    {
        $branches   = Branch::all();
        $roles      = Role::all();
        $contacts   = Contact::where('contact_category_id', 1)->get();
        
        return view('settings::users.create', compact('branches', 'roles' , 'contacts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'display_name'              => 'required|string|min:6|max:255',
            'contact'                   => 'nullable|string|min:6|max:255',
            'email'                     => 'required|email|string|max:255|unique:users',
            'password'                  => 'required|string|min:8|confirmed',
            'password_confirmation'     => 'required|string|min:8',
            'role_id'                   => 'required|numeric|integer|exists:roles,id',
            'branch_id'                 => 'nullable|numeric|integer|exists:branch,id',
            'phone_number_1'            => 'required|string|numeric',
            'finger_print_id'           => 'required|numeric|min:0|max:4000000000|unique:users',
        ], [
            'phone_number_1.required' => 'Contact number is required.',
            'phone_number_1.string'   => 'Contact number should be a string.',
            'phone_number_1.numeric'  => 'Contact number should have numeric characters only.',
            'finger_print_id.unique'  => 'Fingerprint has to be unique.'
        ]);

        $superadmin_role_id = Role::where('name', 'Super Admin')->pluck('id')[0];

        if($request->role_id == $superadmin_role_id){

            DB::beginTransaction();
            
            try {
                $user                       = new User;
                $user->name                 = $request->display_name;
                $user->contact_id           = empty($request->contact_id) ? null : $request->contact_id;
                $user->note                 = $request->note;
                $user->email                = $request->email;
                $user->password             = bcrypt($request->password);
                $user->finger_print_id      = $request->finger_print_id;
                $user->role_id              = $request->role_id;
                $user->branch_id            = $request->branch_id;
                $user->phone                = $request->phone_number_1;
                $user->activated            = 1;
                $user->created_by           = Auth::user()->id;
                $user->updated_by           = Auth::user()->id;
                if($request->hasFile('profile_picture')){
                    $image          = $request->file('profile_picture');
                    $original_name  = $image->getClientOriginalName();
                    $image_name     = substr($original_name, 0, strrpos($original_name, "."));
                    $extension      = $image->getClientOriginalExtension();
                    $token          = sha1(time());
                    $new_image_name = $image_name.'_'.$token.'.'.$extension;
                    $path           = 'uploads/users';
                    $image->move($path,$new_image_name);
                    $user->image    = $new_image_name;
                }
                $user->save();

                if($this->op->hrms == 1){
                    $client = new Client();
    
                    $http_request = $client->post(env('HRMS_URL').'/api/ams_create_superadmin', [
                        'form_params' => [
                            $request->except('_token')
                        ]
                    ]);
    
                    $response = json_decode($http_request->getBody());
    
                    if($http_request->getStatusCode() == 200 && $response->status == 'success'){
                            // $contact_save = (new ContactWebController)->store($request, $module_id = 1);
    
                            // if ($contact_save)
                            // {
                            //     $contact                    = Contact::orderBy('created_at', 'DESC')->first();
                            //     $user_update                = User::find($user->id);
                            //     $user_update->contact_id    = $contact['id'];
                            //     $user_update->save();
                            // }
    
                        DB::commit();
                        return redirect()
                                ->route('user')
                                ->with('alert.status', 'success')
                                ->with('alert.message', 'Superadmin Added Successfully!');
    
                    }
                    else{
                        DB::rollback();
                        return redirect()
                            ->route('user')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'Sorry, something went wrong! Please try again.');
                    }
                }
                else{
                    DB::commit();
                    return redirect()
                            ->route('user')
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'Superadmin Added Successfully!');
                }
            }
            catch (\Exception $e) {
                DB::rollback();
                $error_message = $e->getMessage();

                return redirect()
                    ->route('user')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'API request failed! Please try again. Reason:' . $error_message);
            }
        }
        else{
            DB::beginTransaction();

            try{
                $user                       = new User;
                $user->name                 = $request->display_name;
                $user->contact_id           = empty($request->contact_id) ? null : $request->contact_id;
                $user->note                 = $request->note;
                $user->email                = $request->email;
                $user->password             = bcrypt($request->password);
                $user->finger_print_id      = $request->finger_print_id;
                $user->role_id              = $request->role_id;
                $user->branch_id            = $request->branch_id;
                $user->phone                = $request->phone_number_1;
                $user->activated            = 1;
                $user->created_by           = Auth::user()->id;
                $user->updated_by           = Auth::user()->id;

                if($request->hasFile('profile_picture')){
                    $image          = $request->file('profile_picture');
                    $original_name  = $image->getClientOriginalName();
                    $image_name     = substr($original_name, 0, strrpos($original_name, "."));
                    $extension      = $image->getClientOriginalExtension();
                    $token          = sha1(time());
                    $new_image_name = $image_name.'_'.$token.'.'.$extension;
                    $path           = 'uploads/users';
                    $image->move($path,$new_image_name);
                    $user->image    = $new_image_name;
                }
                $user->save();
                    // $contact_save = (new ContactWebController)->store($request, $module_id = 1);

                    // if ($contact_save)
                    // {
                    //     $contact                    = Contact::orderBy('created_at', 'DESC')->first();
                    //     $user_update                = User::find($user->id);
                    //     $user_update->contact_id    = $contact['id'];
                    //     $user_update->save();
                    // }

                DB::commit();

                return redirect()
                        ->route('user')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'User Added Successfully!');
            }catch (\Exception $ex){
                        return redirect()
                        ->route('branch_create')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Sorry something went wrong! Please try again.');
            }
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $branches   = Branch::all();
        $roles      = Role::all();
        $contacts   = Contact::where('contact_category_id', 1)->get();
        $user       = User::find($id);

        return view('settings::users.edit', compact('branches', 'roles', 'user' , 'contacts'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'display_name'              => 'required|string|min:6|max:255',
            'email'                     => 'required|email|string|max:255|unique:users,email,'.$id,
            'role_id'                   => 'required|numeric|integer|exists:roles,id',
            'contact'                   => 'nullable|string|min:6|max:255',
            'branch_id'                 => 'nullable|numeric|integer|exists:branch,id',
            'phone_number_1'            => 'required|string|numeric',
            'finger_print_id'           => 'required|numeric|min:0|max:4000000000',
        ], [
            'phone_number_1.required' => 'Contact number is required.',
            'phone_number_1.string'   => 'Contact number should be a string.',
            'phone_number_1.numeric'  => 'Contact number should have numeric characters only.',
        ]);

        $edited_user = User::FindOrFail($id);

        $superadmin_role_id = Role::where('name', 'Super Admin')->pluck('id')[0];

        if($edited_user->finger_print_id != $request->finger_print_id){
            $this->validate($request, [
                'finger_print_id' => 'unique:users,finger_print_id,'.$edited_user->id
            ], [
                'finger_print_id' => 'Fingerprint ID has to be unique.'
            ]);

            $new_request = $request->except('_token');
            $new_request['old_fingerprint'] = $edited_user->finger_print_id;
        }
        else{
            $new_request = $request->except('_token');
        }

        if($request->role_id == $superadmin_role_id){

            DB::beginTransaction();

            try
            {
                $user_id    = Auth::user()->id;

                $user                   = User::find($id);
                $user->name             = $request->display_name;
                $user->contact_id       = empty($request->contact_id) ? null : $request->contact_id;
                $user->finger_print_id  = $request->finger_print_id;
                $user->email            = $request->email;
                $user->role_id          = $request->role_id;
                $user->branch_id        = $request->branch_id;
                $user->note             = $request->note;
                $user->activated        = 1;
                $user->phone            = $request->phone_number_1;
                $user->updated_by       = $user_id;

                if($request->hasFile('profile_picture'))
                {
                    $image          = $request->file('profile_picture');
                    $original_name  = $image->getClientOriginalName();
                    $image_name     = substr($original_name, 0, strrpos($original_name, "."));
                    $extension      = $image->getClientOriginalExtension();
                    $token          = sha1(time());
                    $new_image_name = $image_name.'_'.$token.'.'.$extension;
                    $path           = 'uploads/users';
                    $success        = $image->move($path,$new_image_name);
                    $user->image    = $new_image_name;
                }
                $user->save();

                if($this->op->hrms == 1){
                    $client = new Client();
    
                    $http_request = $client->post(env('HRMS_URL').'/api/ams_update_superadmin', [
                        'form_params' => [
                            $new_request
                        ]
                    ]);
    
                    $response = json_decode($http_request->getBody());
    
                    if($http_request->getStatusCode() == 200 && $response->status == 'success'){
    
                        DB::commit();
    
                        return redirect()
                                ->route('user')
                                ->with('alert.status', 'success')
                                ->with('alert.message', 'User Updated Successfully!');
                    }
                    else{
                        DB::rollBack();
    
                        return redirect()
                                ->route('user')
                                ->with('alert.status', 'danger')
                                ->with('alert.message', 'Sorry, something went wrong! Please try again.');
                    }
                }else{
                    DB::commit();    
                    return redirect()
                            ->route('user')
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'User Updated Successfully!');
                }
            }
            catch (Exception $e)
            {
                DB::rollBack();

                return redirect()
                        ->route('user')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Sorry, something went wrong! Please try again. Reason: '.$e->getMessage());
            }
        }
        else{
            DB::beginTransaction();

            try
            {
                $user_id    = Auth::user()->id;

                $user             = User::find($id);
                $user->name       = $request->display_name;
                $user->contact_id = empty($request->contact_id) ? null : $request->contact_id;
                $user->email      = $request->email;
                $user->role_id    = $request->role_id;
                $user->branch_id  = $request->branch_id;
                $user->note       = $request->note;
                $user->activated  = 1;
                $user->phone      = $request->phone_number_1;
                $user->updated_by = $user_id;

                if($request->hasFile('profile_picture'))
                {
                    $image          = $request->file('profile_picture');
                    $original_name  = $image->getClientOriginalName();
                    $image_name     = substr($original_name, 0, strrpos($original_name, "."));
                    $extension      = $image->getClientOriginalExtension();
                    $token          = sha1(time());
                    $new_image_name = $image_name.'_'.$token.'.'.$extension;
                    $path           = 'uploads/users';
                    $success        = $image->move($path,$new_image_name);
                    $user->image    = $new_image_name;
                }
                $user->save();

                DB::commit();

                return redirect()
                        ->route('user')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'User Updated Successfully!');
            }
            catch (Exception $e)
            {
                DB::rollBack();

                return redirect()
                        ->route('user')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Sorry, something went wrong! Please try again. Reason: '.$e->getMessage());
            }
        }
    }

    public function destroy($id)
    {
        dd("You can not Delete Users.");
        // $collection = DB::select("
        //     SELECT 
        //       TABLE_SCHEMA, 
        //       TABLE_NAME, 
        //       COLUMN_NAME, 
        //       REFERENCED_TABLE_SCHEMA, 
        //       REFERENCED_TABLE_NAME, 
        //       REFERENCED_COLUMN_NAME
        //     FROM 
        //       INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
        //     WHERE 
        //       REFERENCED_TABLE_NAME='users' and TABLE_SCHEMA='account_management' 

        // ");
        // foreach ($collection as $key => $value)
        // {
        //     $item = DB::table($collection[$key]->TABLE_NAME)->where('user_id', $id)->first();
        //     if ($item) {
        //         return redirect()->back()->with(array('alert.message' => 'User Has Information on '.$collection[$key]->TABLE_NAME.' Table','alert.status' => 'danger'));
        //     }

        // }
        // $user = User::find($id);

        // $auth_user_type = Auth::user()->type;

        // if ($auth_user_type == 0 && $user->type == 0)
        // {
        //     return redirect()->back()
        //         ->with('alert.status', 'warning')
        //         ->with('alert.message', 'You don\'t have enough permission to perform this operation!');
        // }
        // else
        // {
        //     if($user->delete())
        //     {
        //         return redirect()
        //             ->route('user')
        //             ->with('alert.status', 'success')
        //             ->with('alert.message', 'User Deleted Successfully!');
        //     }
        //     else
        //     {
        //         return redirect()
        //             ->route('user')
        //             ->with('alert.status', 'danger')
        //             ->with('alert.message', 'Sorry! Cannot delete user!');
        //     }
        // }
    }

    public function password($id)
    {
        return view('settings::users.password', compact('id'));
    }

    public function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

        $user_data = $request->all();

        $user = User::find($id);

        $user->password = bcrypt($request->password);

        if($user->update())
        {
            return redirect()
                ->route('user_password', ['id' => $id])
                ->with('alert.status', 'success')
                ->with('alert.message', 'User Password Changed Successfully!');
        }
        else
        {
            return redirect()
                ->route('user_password', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something went wrong! Cannot change password!');
        }
    }

    public function userRole($id)
    {
        $roles = Role::all();
        $user = User::find($id);

        return view('settings::users.role', compact('id', 'roles', 'user'));
    }

    public function updateUserRole(Request $request, $id)
    {
        $this->validate($request, [
            'role_id' => 'required',
        ]);

        $user_data = $request->all();

        $user = User::find($id);

        $user->role_id = $request->role_id;

        if($user->update())
        {
            return redirect()
                ->route('user_role', ['id' => $id])
                ->with('alert.status', 'success')
                ->with('alert.message', 'User Role Updated Successfully!');
        }
        else
        {
            return redirect()
                ->route('user_role', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something went wrong! Cannot update role!');
        }
    }
}
