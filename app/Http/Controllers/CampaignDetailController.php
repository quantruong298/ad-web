<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\CampaignDetail;
use App\Enum\CampaignDetailStatus;

class CampaignDetailController extends Controller
{
    public function click(Request $request)
    {
        $now = \Carbon\Carbon::now()->setTimezone('asia/ho_chi_minh')->format('Y-m-d H-i-s');
        return CampaignDetail::create([
            'campaign_id' => $request->id,
            'clicks' => CampaignDetailStatus::ACTIVE,
            'views' => CampaignDetailStatus::INACTIVE,
            'datetime' => $now,
        ]); 
    }

    public function view(Request $request)
    {
        $now = \Carbon\Carbon::now()->setTimezone('asia/ho_chi_minh')->format('Y-m-d H-i-s');
        return CampaignDetail::create([
            'campaign_id' => $request->id,
            'clicks' => CampaignDetailStatus::INACTIVE,
            'views' => CampaignDetailStatus::ACTIVE,
            'datetime' => $now,
        ]);
    }
}
