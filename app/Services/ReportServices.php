<?php

namespace App\Services;

use App\Enum\Paginate;
use App\Enum\UserRoles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportServices
{

    //get all reports from database, OUTPUT: object
    public static function getReports()
    {
        if (Auth::user()->role_id == UserRoles::ADMIN)
            $reports = DB::table('campaigns')
                ->join('users', 'campaigns.user_id', '=', 'users.id')
//            ->join('products', 'campaigns.product_id', '=', 'products.id')
                ->leftJoin('campaign_details', 'campaigns.id', '=', 'campaign_details.campaign_id')
                ->groupBy('campaigns.id',
                    'campaigns.name',
                    'campaigns.banner',
                    'campaigns.bid_amount',
                    'users.fullname'
//                'products.name'
                )
                ->select('campaigns.id',
                    'campaigns.name',
                    'campaigns.banner',
                    'users.fullname as uname',
//                'products.name as pname',
                    DB::raw('sum(campaign_details.views) as views'),
                    DB::raw('sum(campaign_details.clicks) as clicks'),
                    DB::raw('sum(campaign_details.views)*campaigns.bid_amount + sum(campaign_details.clicks)*campaigns.bid_amount*1.5 as benefit')
                )
                ->paginate(Paginate::REPORT);
        else {
            $reports = DB::table('campaigns')
                ->join('users', 'campaigns.user_id', '=', 'users.id')
//                ->join('products', 'campaigns.product_id', '=', 'products.id')
                ->leftJoin('campaign_details', 'campaigns.id', '=', 'campaign_details.campaign_id')
                ->groupBy('campaigns.id',
                    'campaigns.name',
                    'campaigns.banner',
                    'campaigns.budget',
                    'campaigns.bid_amount'
//                    'products.name'
                )
                ->select('campaigns.id',
                    'campaigns.name',
                    'campaigns.banner',
                    'campaigns.budget',
//                    'products.name as pname',
                    DB::raw('sum(campaign_details.views) as views'),
                    DB::raw('sum(campaign_details.clicks) as clicks'),
                    DB::raw('sum(campaign_details.views)*campaigns.bid_amount + sum(campaign_details.clicks)*campaigns.bid_amount*1.5 as benefit')
                )->where('users.id', '=', Auth::user()->id)
                ->paginate(Paginate::REPORT);
        }
        return $reports;
    }

    //get all reports for activated campaigns(haven't done yet), OUTPUT: object
    public static function getReportsForActivedCampaigns()
    {
        if (Auth::user()->role_id == UserRoles::ADMIN)
            $reports = DB::table('campaigns')
                ->join('users', 'campaigns.user_id', '=', 'users.id')
//            ->join('products', 'campaigns.product_id', '=', 'products.id')
                ->leftJoin('campaign_details', 'campaigns.id', '=', 'campaign_details.campaign_id')
                ->groupBy('campaigns.id',
                    'campaigns.name',
                    'campaigns.banner',
                    'campaigns.bid_amount',
                    'users.fullname'
//                'products.name'
                )
                ->select('campaigns.id',
                    'campaigns.name',
                    'campaigns.banner',
                    'users.fullname as uname',
//                'products.name as pname',
                    DB::raw('sum(campaign_details.views) as views'),
                    DB::raw('sum(campaign_details.clicks) as clicks'),
                    DB::raw('sum(campaign_details.views)*campaigns.bid_amount + sum(campaign_details.clicks)*campaigns.bid_amount*1.5 as benefit')
                )->where('campaigns.status', '=', 1)
                ->orderBy('bid_amount', 'desc')
                ->limit(6)
                ->paginate(Paginate::REPORT);
        else {
            $reports = DB::table('campaigns')
                ->join('users', 'campaigns.user_id', '=', 'users.id')
//                ->join('products', 'campaigns.product_id', '=', 'products.id')
                ->leftJoin('campaign_details', 'campaigns.id', '=', 'campaign_details.campaign_id')
                ->groupBy('campaigns.id',
                    'campaigns.name',
                    'campaigns.banner'
//                    'products.name'
                )
                ->select('campaigns.id',
                    'campaigns.name',
                    'campaigns.banner',
//                    'products.name as pname',
                    DB::raw('sum(campaign_details.views) as views'),
                    DB::raw('sum(campaign_details.clicks) as clicks')
                )->where('users.id', '=', Auth::user()->id)
                ->where('campaigns.status', '=', 1)
                ->orderBy('bid_amount', 'desc')
                ->limit(6)
                ->paginate(Paginate::REPORT);
        }
        return $reports;
    }

    //get a report from database with campaign' id,INPUT: campaign's id, OUTPUT: object
    public static function getReportByIdForChart($id)
    {
        $report = DB::table('campaign_details')
            ->groupBy('datetime')
            ->select(
                DB::raw('DATE_FORMAT(datetime, "%Y-%m-%d") as datetime'),
                DB::raw('sum(views) as views'),
                DB::raw('sum(clicks) as clicks')
            )
            ->where('campaign_id', '=', $id)->get();
        return $report;
    }

    //get all reports from database for seaching,INPUT:keyword, OUTPUT: object
    public static function searchReports($keyword)
    {
        if (Auth::user()->role_id == UserRoles::ADMIN)
            $reports = DB::table('campaigns')
                ->join('users', 'campaigns.user_id', '=', 'users.id')
//            ->join('products', 'campaigns.product_id', '=', 'products.id')
                ->leftJoin('campaign_details', 'campaigns.id', '=', 'campaign_details.campaign_id')
                ->groupBy('campaigns.id',
                    'campaigns.name',
                    'campaigns.banner',
                    'campaigns.bid_amount',
                    'users.fullname'
//                'products.name'
                )
                ->select('campaigns.id',
                    'campaigns.name',
                    'campaigns.banner',
                    'users.fullname as uname',
//                'products.name as pname',
                    DB::raw('sum(campaign_details.views) as views'),
                    DB::raw('sum(campaign_details.clicks) as clicks'),
                    DB::raw('sum(campaign_details.views)*campaigns.bid_amount + sum(campaign_details.clicks)*campaigns.bid_amount*1.5 as benefit')
                )->where('campaigns.name', 'like', '%' . $keyword . '%')
                ->paginate(Paginate::REPORT);
        else {
            $reports = DB::table('campaigns')
                ->join('users', 'campaigns.user_id', '=', 'users.id')
//                ->join('products', 'campaigns.product_id', '=', 'products.id')
                ->leftJoin('campaign_details', 'campaigns.id', '=', 'campaign_details.campaign_id')
                ->groupBy('campaigns.id',
                    'campaigns.name',
                    'campaigns.banner'
//                    'products.name'
                )
                ->select('campaigns.id',
                    'campaigns.name',
                    'campaigns.banner',
//                    'products.name as pname',
                    DB::raw('sum(campaign_details.views) as views'),
                    DB::raw('sum(campaign_details.clicks) as clicks')
                )->where('users.id', '=', Auth::user()->id)
                ->where('campaigns.name', 'like', '%' . $keyword . '%')
                ->paginate(Paginate::REPORT);
        }
        return $reports;
    }
}
