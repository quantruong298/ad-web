<?php

namespace App\Http\Controllers;

use App\Enum\Paginate;
use App\Enum\UserRoles;
use App\Helpers\DateTime;
use App\Helpers\GoogleDrive;
use App\Http\Requests\CampaignRequest;
use App\Model\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Boolean;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the list campaign.
     *
     * @param $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $campaigns = $this->getCampaignList($request->keyword);
            $view = view('components.campaigns.list', compact('campaigns'));
            return $view->render();
        } else {
            $campaigns = $this->getCampaignList();
            return view('layouts.campaigns.index', compact('campaigns'));
        }
    }

    /**
     * Create new user.
     *
     * @param array $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function storeCampaign(CampaignRequest $request)
    {
        ($request->file != 'undefined') ? $file = GoogleDrive::uploadFileToGoogleDrive($request->file) : $file = "https://images.pexels.com/photos/67636/rose-blue-flower-rose-blooms-67636.jpeg?auto=format%2Ccompress&cs=tinysrgb&dpr=1&w=500";
        $start_datetime = DateTime::handlerDateTime($request->startday);
        $end_datetime = DateTime::handlerDateTime($request->endday);

        Campaign::create([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'status' => $request->status,
            'start_day' => $start_datetime,
            'end_day' => $end_datetime,
            'budget' => $request->budget,
            'bid_amount' => $request->bid,
            'description' => $request->description,
            'title' => $request->title,
            'link' => $request->finalurl,
            'banner' => $file[0]['link_file'],
            'file_name' => $file[0]['file_name'],
        ]);

        $campaigns = $this->getCampaignList();
        $view = view('components.campaigns.list', compact('campaigns'));

        return response([
            'message' => 'Stored success.',
            'view' => $view->render(),
        ], 200);
    }

    /**
     * Delete campaign.
     *
     * @param array $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteCampaign(Request $request)
    {
        $check = $this->checkCampaignOfUser($request->id);

        if ($check) {
            $file_name = Campaign::where('id', $request->id)->select('file_name')->first()->toArray();
            GoogleDrive::deleteFileFromGoogleDrive($file_name['file_name']);
            Campaign::where('id', $request->id)->delete();
            $campaigns = $this->getCampaignList();
            $view = view('components.campaigns.list', compact('campaigns'));

            return response([
                'status' => 'success',
                'message' => 'Deleted success.',
                'view' => $view->render()
            ], 200);
        } else {
            return response([
                'status' => 'fail',
                'message' => 'Deleted fail.',
            ], 200);
        }
    }

    /**
     * Update a campaign
     *
     * @param $request
     * @return \App\Model\Campaign
     */
    public function updateCampaign(CampaignRequest $request)
    {
        $check = $this->checkCampaignOfUser($request->id);

        if ($check) {
            if ($request->file != 'undefined') {
                $file_name = Campaign::where('id', $request->id)->select('file_name')->first()->toArray();
                GoogleDrive::deleteFileFromGoogleDrive($file_name['file_name']);

                $file = GoogleDrive::uploadFileToGoogleDrive($request->file);

                $result = Campaign::where('id', $request->id)->update([
                    'name' => $request->name,
                    'status' => $request->status,
                    'end_day' => $request->endday,
                    'budget' => $request->budget,
                    'bid_amount' => $request->bid,
                    'title' => $request->title,
                    'description' => $request->description,
                    'link' => $request->finalurl,
                    'banner' => $file[0]['link_file'],
                    'file_name' => $file[0]['file_name'],
                ]);
            } else {
                $result = Campaign::where('id', $request->id)->update([
                    'name' => $request->name,
                    'status' => $request->status,
                    'end_day' => $request->endday,
                    'budget' => $request->budget,
                    'bid_amount' => $request->bid,
                    'title' => $request->title,
                    'description' => $request->description,
                    'link' => $request->finalurl,
                ]);
            }

            if ($result) {
                $campaigns = $this->getCampaignList();
                $view = view('components.campaigns.list', compact('campaigns'));
                return response([
                    'status' => 'success',
                    'message' => 'Updated success.',
                    'view' => $view->render()
                ], 200);
            } else {
                return response([
                    'status' => 'fail',
                    'message' => 'Updated fail.',
                ], 200);
            }
        }
    }

    /**
     * Get a list campaign
     *
     * @param $keyword
     * @return \App\Model\Campaign
     */
    public function getCampaignList($keyword = null)
    {
        $results = Campaign::join('users', 'users.id', '=', 'campaigns.user_id')
            ->where(function ($q) {
                if (Auth::user()->role_id == UserRoles::SHOP) {
                    $q->where('users.id', Auth::user()->id);
                }
            });

        if ($keyword != '') {
            $results = $results->where('campaigns.name', 'LIKE', "%" . $keyword . "%");
        }

        return $results = $results->select('campaigns.*')
            ->orderBy('id', 'desc')
            ->paginate(Paginate::CAMPAIGN)
            ->withPath(route('campaign.index'));
    }

    /**
     * Get a list campaign by id
     *
     * @param $request ->id
     * @return \App\User
     */
    public function getInfoCampaignById(Request $request)
    {
        $check = $this->checkCampaignOfUser($request->id);
        if ($check) {
            return $result = Campaign::where('campaigns.id', $request->id)
                ->select(
                    '*',
                    DB::raw('DATE_FORMAT(start_day, "%Y-%m-%d\T%H:%i:%s") as start_day'),
                    DB::raw('DATE_FORMAT(end_day, "%Y-%m-%d\T%H:%i:%s") as end_day')
                )
                ->get();
        }
    }

    /**
     * Check campaign of user
     *
     * @param $id
     * @return Boolean
     */
    public function checkCampaignOfUser($id)
    {
        $array_campaign_id = Campaign::join('users', 'users.id', '=', 'campaigns.user_id')
            ->where(function ($q) {
                if (Auth::user()->role_id == UserRoles::SHOP) {
                    $q->where('users.id', Auth::user()->id);
                }
            })
            ->pluck('campaigns.id')
            ->toArray();

        return in_array($id, $array_campaign_id);
    }
}
