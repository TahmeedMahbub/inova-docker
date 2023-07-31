<?php

namespace App\Modules\Settings\Http\Controllers\branch;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

// use App\Http\Requests;
use App\Models\Branch\Branch;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\OrganizationProfile\OrganizationProfile;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
   public function __construct(OrganizationProfile $op)
   {
      $this->op = $op->first();
   }
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $branchs = Branch::with('Users')->get();
      return view('settings::branch.index', compact('branchs'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      // dd('You Can Not Create Branch');
      return view('settings::branch.create');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $this->validate($request, [
         'branch_name' => 'required|unique:branch',
         'location' => 'required',
      ]);

      DB::beginTransaction();

      try {
         $user_id = Auth::user()->id;
         $branch  = new Branch();
         $branch->branch_name = $request->branch_name;
         $branch->location = $request->location;
         $branch->branch_prefix = $request->prefix;
         $branch->branch_description = $request->branch_description;
         $branch->created_by = $user_id;
         $branch->updated_by = $user_id;
         $branch->save();
         
         if($this->op->hrms == 1){
            $client = new Client();         
            $http_request = $client->post(env('HRMS_URL').'/api/ams_create_branch', [
                  'form_params' => [
                     'branch_name' => $branch->branch_name,
                     'branch_id'   => $branch->id
                  ]
            ]);
   
            $response = json_decode($http_request->getBody());
   
            if($http_request->getStatusCode() == 200 && $response->status == 'success'){
   
               DB::commit();
               return redirect()
                  ->route('branch_create')
                  ->with('alert.status', 'success')
                  ->with('alert.message', 'Branch created successfully!');
            }
            else{
               DB::rollback();
               return redirect()
                  ->route('branch_create')
                  ->with('alert.status', 'danger')
                  ->with('alert.message', 'Sorry something went wrong! Please try again!');
            }
         }else{
            DB::commit();
            return redirect()
               ->route('branch_create')
               ->with('alert.status', 'success')
               ->with('alert.message', 'Branch created successfully!');
         }
      } catch (\Exception $e) {
         DB::rollback();
         return redirect()
            ->route('branch_create')
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry something went wrong! Please try again!');
      }
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      $branch = Branch::find($id);
      return view('settings::branch.edit', compact('branch'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
      $this->validate($request, [
         'branch_name' => 'required|unique:branch,branch_name,'.$id,
         'location' => 'required',
      ]);

      $branch = Branch::findOrFail($id);

      DB::beginTransaction();

      try{
         $user_id                    = Auth::user()->id;
         $branch->branch_name        = $request->branch_name;
         $branch->location           = $request->location;
         $branch->branch_prefix      = $request->prefix;
         $branch->branch_description = $request->branch_description;
         $branch->updated_by         = $user_id;
         $branch->save();

         if($this->op->hrms == 1){
            $client = new Client();
            
            $http_request = $client->post(env('HRMS_URL').'/api/ams_update_branch', [
                  'form_params' => [
                     'branch_name' => $branch->branch_name,
                     'branch_id'   => $branch->id
                  ]
            ]);
   
            $response = json_decode($http_request->getBody());
   
            if($http_request->getStatusCode() == 200 && $response->status == 'success'){
   
               DB::commit();
               return redirect()
                  ->route('branch_edit', $id)
                  ->with('alert.status', 'success')
                  ->with('alert.message', 'Branch edited successfully!');
            }
            else{
               DB::rollback();
               return redirect()
                  ->route('branch')
                  ->with('alert.status', 'danger')
                  ->with('alert.message', 'Sorry something went wrong! Please try again');
            }
         }else{
            DB::commit();
            return redirect()
               ->route('branch_edit', $id)
               ->with('alert.status', 'success')
               ->with('alert.message', 'Branch edited successfully!');
         }
      } catch (\Exception $ex){

         return redirect()
            ->route('branch_edit',$id)
            ->with('alert.status', 'danger')
            ->with('alert.message', 'Sorry something went wrong! Please try again');

      }
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      $branch = Branch::with('Users')->find($id);
      if($branch->Users()->count()){
      return redirect()
         ->route('branch')
               ->with('alert.status', 'danger')
               ->with('alert.message', 'There are some users exist on this branch! Please try again');
      }
      else
      {
         DB::beginTransaction();

         try {

            Branch::where('id', $id)->delete();

            if($this->op->hrms == 1){
               $client = new Client();
   
               $http_request = $client->post(env('HRMS_URL').'/api/ams_delete_branch', [
                     'form_params' => [
                        'branch_id' => $id
                     ]
               ]);
   
               $response = json_decode($http_request->getBody());
   
               if($http_request->getStatusCode() == 200 && $response->status == 'success'){
   
                  DB::commit();
   
                  return redirect()
                           ->route('branch')
                           ->with('alert.status', 'success')
                           ->with('alert.message', 'Branch deleted successfully!');
               }
               else{
                  return redirect()
                     ->route('branch')
                     ->with('alert.status', 'danger')
                     ->with('alert.message', 'Sorry something went wrong! Please try again');
               }
            }else{
               DB::commit();
               return redirect()
                  ->route('branch')
                  ->with('alert.status', 'success')
                  ->with('alert.message', 'Branch deleted successfully!');
            }
         } catch (\Exception $e) {
            dd($e);
            return redirect()
               ->route('branch')
               ->with('alert.status', 'danger')
               ->with('alert.message', 'Sorry something went wrong! Please try again');
         }
      }
   }
}
