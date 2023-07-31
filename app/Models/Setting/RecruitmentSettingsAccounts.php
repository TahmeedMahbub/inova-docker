<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class RecruitmentSettingsAccounts extends Model
{
   protected $table="recruitment_settings_accounts";

   public function account()
    {
        return $this->belongsTo('App\Models\AccountChart\Account', 'account_id');
    }
}
