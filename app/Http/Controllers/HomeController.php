<?php

namespace App\Http\Controllers;

use App\Enum\CampaignStatus;
use App\Model\Catalog;
use App\Services\CatalogServices;
use App\Services\ProductServices;
use Illuminate\Http\Request;
use App\Enum\Paginate;
use App\Model\Campaign;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    //Get products by catalog's id , INPUT: catalogs's id, OUTPUT: home-product's list(view) + home-catalog's list(view) + $products,$catalogs(objects)
    public function getProducts($catid)
    {
        $products = ProductServices::getProducts(Paginate::HOME_PRODUCT, $catid, false);
        $catalogs = CatalogServices::getAllCatalog();
        $pview = view('components.products.home-products', ['products' => $products]);
        $cview = view('components.catalogs.home-catalogs', ['catalogs' => $catalogs, 'catid' => $catid]);
        return response([
            'pview' => $pview->render(),
            'cview' => $cview->render(),
        ], 200);
    }

    //Get product's detail, INPUT: product's id, OUTPUT: $product(object)
    public function show($pid)
    {
        $product = ProductServices::getProductById($pid);
        return view('components.products.home-product-detail', compact('product'));
    }

    //Get all catalogs, OUTPUT: home-catalogs's list(view) + $catalogs(object)
    public function getAllCatalog()
    {
        $catalogs = CatalogServices::getAllCatalog();
        return view('components.catalogs.home-catalogs', [
            'catalogs' => $catalogs
        ]);
    }

    //Choose campaign which allowed to show in sliders, OUTPUT: sliders(object)
    public function index()
    {
        $now = \Carbon\Carbon::now()->setTimezone('asia/ho_chi_minh')->format('Y-m-d H-i-s');
        $sliders = Campaign::where('start_day', '<=', $now)
            ->where('end_day', '>=', $now)
            ->where('status', '=', CampaignStatus::ACTIVE)
            ->orderBy('bid_amount', 'desc')
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return view('home', compact('sliders'));
    }

    public function  dashboard()
    {
        return view('home');
    }
}
