<?php

namespace App\Modules\Settings\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class ItemHideShowController extends Controller
{
    public function index()
    {	
    	$hide_show_list_sidebar = DB::table('sidebar_hide_show')->where('type', 1)->get();
    	$count_1                = $hide_show_list_sidebar->count();
    	$hide_show_list_report  = DB::table('sidebar_hide_show')->where('type', 2)->get();
    	$count_2                = $hide_show_list_report->count();
    	$hide_show_list_fields  = DB::table('sidebar_hide_show')->where('type', 3)->get();
    	$count_3                = $hide_show_list_fields->count();

    	return view('settings::itemHideShow.index', compact('hide_show_list_sidebar', 'hide_show_list_report', 'hide_show_list_fields', 'count_1', 'count_2', 'count_3'));
    }

    public function store(Request $request)
    {
    	$data = $request;
		$user = Auth::user()->id;

    	$this->validate($request,[
    	]);

    	DB::beginTransaction();
    	try {
    		
    		if (isset($data['sidebar_id']))
    		{	
    			$sidebar_ids = DB::table('sidebar_hide_show')->delete();

    			$i   = 0;
				foreach($data['sidebar_id'] as $value)
	            {	
	            	if (!empty($value))
	            	{
		                $sidebar_id[] = [
		                    'sidebar_id'        => $data['sidebar_id'][$i],
		                    'type'        		=> $data['type'][$i],
		                    'created_by'        => $user,
		                    'updated_by'        => $user,
		                    'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
		                    'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
		                ];
		            }
		            
	                $i++;

	            }

	                DB::table('sidebar_hide_show')->insert($sidebar_id);

	    			DB::commit();

	                return redirect()->back()
					                ->with('alert.status', 'success')
					                ->with('alert.message', 'Offer Added Successfully!');
	    		}
	    		else
	    		{	
	    			$sidebar_ids = DB::table('sidebar_hide_show')->delete();

	    			DB::commit();

	    			return redirect()->back()
					                ->with('alert.status', 'success')
					                ->with('alert.message', 'Offer Added Successfully!');
	    		}
			
    	}
    	catch (Exception $e) 
    	{
            DB::rollBack();

	        return redirect()->back()
			                ->with('alert.status', 'danger')
			                ->with('alert.message', 'Something Went Wrong!');
    	}	
    }

    public function listAjax()
    {	
    	$hide_show_list_sidebar = DB::table('sidebar_hide_show')->where('type', 1)->get();
    	$hide_show_list_report  = DB::table('sidebar_hide_show')->where('type', 2)->get();
    	$hide_show_list_fields  = DB::table('sidebar_hide_show')->where('type', 3)->get();

    	return response()->json([
             'hide_show_list_sidebar'    =>  $hide_show_list_sidebar,
             'hide_show_list_report'     =>  $hide_show_list_report,
             'hide_show_list_fields'     =>  $hide_show_list_fields,
         ], 201);
    }
}
