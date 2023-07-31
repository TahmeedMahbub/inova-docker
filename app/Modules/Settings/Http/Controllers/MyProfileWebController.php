<?php

namespace App\Modules\Settings\Http\Controllers;

use File;
use Hash;
use App\User;
use App\Http\Requests;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyProfileWebController extends Controller
{
    public function edit()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        return view('settings::my_profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_data = $request->all();
        $user = User::find($user_id);

        $user->name = $user_data['name'];
        $user->contact = $user_data['contact'];
        $user->note = $user_data['note'];
        $user->email = $user_data['email'];
        $user->created_by = $user_id;
        $user->updated_by = $user_id;

        if($request->hasFile('image'))
        {
            $deletable = 'uploads/users/' . $user->image;

            if(File::delete($deletable))
            {
                $image = $request->file('image');

                $original_name = $image->getClientOriginalName();
                $image_name = substr($original_name, 0, strrpos($original_name, "."));
                $extension = $image->getClientOriginalExtension();
                $token = sha1(time());
                $new_image_name = $image_name.'_'.$token.'.'.$extension;
                $path = 'uploads/users';

                $success = $image->move($path,$new_image_name);

                if($success)
                {
                    $user->image = $new_image_name;

                    if($user->update())
                    {
                        return redirect()
                            ->route('my_profile')
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'User Updated Successfully!');
                    }
                    else
                    {
                        return redirect()
                            ->route('my_profile')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'Sorry, something went wrong! Data cannot be updated.');
                    }
                }
                else
                {
                    if($user->update())
                    {
                        return redirect()
                            ->route('my_profile')
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'User Added Successfully!');
                    }
                    else
                    {
                        return redirect()
                            ->route('my_profile')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'Sorry, something went wrong! Data cannot be updated.');
                    }
                }
            }
            else
            {
                $image = $request->file('image');

                $original_name = $image->getClientOriginalName();
                $image_name = substr($original_name, 0, strrpos($original_name, "."));
                $extension = $image->getClientOriginalExtension();
                $token = sha1(time());
                $new_image_name = $image_name.'_'.$token.'.'.$extension;
                $path = 'uploads/users';

                $success = $image->move($path,$new_image_name);

                if($success)
                {
                    $user->image = $new_image_name;

                    if($user->update())
                    {
                        return redirect()
                            ->route('my_profile')
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'User Updated Successfully!');
                    }
                    else
                    {
                        return redirect()
                            ->route('my_profile')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'Sorry, something went wrong! Data cannot be updated.');
                    }
                }
                else
                {
                    if($user->update())
                    {
                        return redirect()
                            ->route('my_profile')
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'User Added Successfully!');
                    }
                    else
                    {
                        return redirect()
                            ->route('my_profile')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'Sorry, something went wrong! Data cannot be updated.');
                    }
                }
            }
        }
        else
        {
            if($user->update())
            {
                return redirect()
                    ->route('my_profile')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'User Added Successfully!');
            }
            else
            {
                return redirect()
                    ->route('my_profile')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be updated.');
            }
        }


    }

    public function password()
    {
        return view('settings::my_profile.password');
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

        $user_data = $request->all();
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $old_password = $user_data['old_password'];
        $new_password = bcrypt($user_data['password']);
        $request->merge(['finger_print_id' => $user->finger_print_id]);
        // dd($request['finger_print_id']);
        if(Hash::check($old_password,$user->password))
        {
            $user->password = $new_password;

            if($user->update())
            {



                
                $client = new Client();
    
                $http_request = $client->post(env('HRMS_URL').'/api/ams_change_pass', [
                    'form_params' => [
                        $request->only('old_password', 'password', 'finger_print_id')
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





                return redirect()
                    ->route('my_profile_password')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Account Password Updated Successfully!');
            }
            else
            {
                return redirect()
                    ->route('my_profile_password')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Something went wrong! Password cannot updated!');
            }
        }
        else
        {
            return redirect()
                ->route('my_profile_password')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Incorrect old password!');
        }



        $check_password = 1;
    }
}
