<?php

namespace App\Lib;

use App\Models\Crm\Followup\Followup;
use App\Models\Crm\Dailylog\Dailylog;
/**
 * 
 */
class CrmDashboard
{
	public function totlaLeads($id)
    {
		$total_leads        = Dailylog::join('follow_up', 'follow_up.daily_log_id', 'dailylog.id')
                                        ->join('status', 'status.id', 'follow_up.status_id')
                                        ->where('dailylog.created_by',$id)
                                        ->selectRaw('dailylog.id as id,status.name as status_name, count(status.name) as total_name')
                                        ->groupBy('follow_up.id')
                                        ->orderBy('follow_up.created_at', 'DESC')
                                        ->get();

        $total_leads_uniq   = $total_leads->unique('id');

        $total_lead         = [];
        foreach ($total_leads_uniq as $key => $value)
        {
            $total_lead[$value->status_name] = $total_leads_uniq->where('status_name', $value->status_name)->sum('total_name');
        }

		return $total_lead;
    }
}