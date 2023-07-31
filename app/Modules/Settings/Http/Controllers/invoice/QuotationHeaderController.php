<?php

namespace App\Modules\Settings\Http\Controllers\invoice;

use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Template\HeaderTemplate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class QuotationHeaderController extends Controller
{
    public function edit()
    {

        $profile_info = OrganizationProfile::first();
        $quotation_info = json_decode($profile_info->quotation_header);
        
        return view('settings::quotation_header.edit', compact('quotation_info'));
    }

    public function update(Request $request)
    {
        
        $quotation_header = json_encode(array(
                                "heading"           =>$request->heading,
                                "table_head"        =>$request->table_head,
                                "terms_conditions"  =>$request->terms_conditions,
                                "left_notation"     =>$request->left_notation,
                                "right_notation"    =>$request->right_notation,
                                )
                            );
        
        $profile_info = OrganizationProfile::first();

        $profile_info->quotation_header  = $quotation_header;

        if($profile_info->save())
        {
            return redirect()
                ->route('quotation_header')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Template Header Type Updated Successfully!');
        } else {
            return redirect()
                ->route('quotation_header')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Template Header Type cannot update!');
        }
    }
}