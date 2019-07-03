<?php

namespace App\Exports;

use App\Enum\UserRoles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportsExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        if (Auth::user()->role_id == UserRoles::ADMIN) {
            $reports = DB::table('campaigns')
                ->join('users', 'campaigns.user_id', '=', 'users.id')
                ->leftJoin('campaign_details', 'campaigns.id', '=', 'campaign_details.campaign_id')
                ->groupBy('campaigns.id',
                    'campaigns.name',
                    'campaigns.banner',
                    'campaigns.bid_amount',
                    'users.fullname'
                )
                ->select('campaigns.id',
                    'campaigns.name',
                    'campaigns.banner',
                    'users.fullname as uname',
                    DB::raw('sum(campaign_details.views) as views'),
                    DB::raw('sum(campaign_details.clicks) as clicks'),
                    DB::raw('sum(campaign_details.views)*campaigns.bid_amount + sum(campaign_details.clicks)*campaigns.bid_amount*1.5 as benefit')
                )
                ->get();
        } else {
            $reports = DB::table('campaigns')
                ->join('users', 'campaigns.user_id', '=', 'users.id')
                ->leftJoin('campaign_details', 'campaigns.id', '=', 'campaign_details.campaign_id')
                ->groupBy('campaigns.id',
                    'campaigns.name',
                    'campaigns.banner',
                    'campaigns.budget',
                    'campaigns.bid_amount'
                )
                ->select('campaigns.id',
                    'campaigns.name',
                    'campaigns.banner',
                    'campaigns.budget',
                    DB::raw('sum(campaign_details.views) as views'),
                    DB::raw('sum(campaign_details.clicks) as clicks'),
                    DB::raw('sum(campaign_details.views)*campaigns.bid_amount + sum(campaign_details.clicks)*campaigns.bid_amount*1.5 as benefit')
                )->where('users.id', '=', Auth::user()->id)
                ->get();
        }
        return $reports;
    }

    public function headings(): array
    {
        if (Auth::user()->role_id == UserRoles::ADMIN) {
            return [
                'ID',
                'Name',
                'Image',
                'User',
                'View',
                'Click',
                'Benefit',
            ];
        } else {
            return [
                'ID',
                'Name',
                'Image',
                'View',
                'Click',
                'Budget',
                'Spend'
            ];
        }
    }
}
