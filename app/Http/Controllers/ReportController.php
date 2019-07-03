<?php

namespace App\Http\Controllers;

use App\Exports\ReportsExport;
use App\Services\ReportServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    //User must login to access Manager
    public function __construct()
    {
        $this->middleware('auth');
        //this->middleware('checkPDPermission', ['only' => ['edit', 'update', 'destroy']]);
    }

    //Get all reports items, OUTPUT: report's index(view) + $reports(object)
    public function index()
    {
        $reports = self::getReports();
        return view('layouts.reports.index', compact('reports'));
    }

    //Get all reports items for search,INPUT: $request(keyword), OUTPUT: report's list(view) + $reports(object)
    public function search(Request $request)
    {
        $reports = ReportServices::searchReports($request->keyword);
        return view('components.reports.list', compact('reports'));
    }

    //Get all report items for active campaigns(haven't done yet)
    public function activec(Request $request)
    {
        if ($request->check === 'true') {
            $reports = ReportServices::getReportsForActivedCampaigns();
            $view = view('components.reports.list', compact('reports'));
        } else {
            $reports = self::getReports();
            $view = view('components.reports.list', compact('reports'));
        }
        return $view;
    }


    //Get report information for chart, INPUT: report's id, OUTPUT: $report(object)
    public function show($id)
    {
        $report = ReportServices::getReportByIdForChart($id);
        return view('components.charts.index', compact('report'));
    }

    //Export a report, OUTPUT: auto download file xlsx for report
    public function export()
    {
        return Excel::download(new \App\Exports\ReportsExport(), 'export.xlsx');
    }

    //Get all reports from Database, OUTPUT: reports(object)
    public static function getReports()
    {
        return ReportServices::getReports();
    }
}
