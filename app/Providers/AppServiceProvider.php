<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use NumberToWords\NumberToWords;
use App\Models\Template\HeaderTemplate;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Branch\Branch;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {  
        $user_check                 = User::join('branch','branch.id','users.branch_id')
                                           ->select('users.*','branch.branch_name')
                                           ->get();
        $header_template_check      = HeaderTemplate::latest()->first();
        $organization_profile_info  = OrganizationProfile::first();
        $numberToWords              = new NumberToWords();
        $numberTransformer          = $numberToWords->getNumberTransformer('en');
        // dd($header_template_check);
        view()->share('header_template_check',$header_template_check);
        view()->share('organization_profile_info',$organization_profile_info);
        view()->share('user_check',$user_check);
        view()->share('numberTransformer',$numberTransformer);

        // $numberToWords = new NumberToWords();
        // $numberTransformer = $numberToWords->getNumberTransformer('en');
        // view()->share('numberTransformer',$numberTransformer);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
