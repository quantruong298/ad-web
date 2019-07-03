<?php

namespace App\Http\Controllers;

use App\Helpers\GoogleDrive;
use App\Http\Requests\ProductRequest;
use App\Services\CatalogServices;
use App\Services\ProductServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enum\Paginate;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //User must login and have suitable permission to access Product Manager
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkPDPermission', ['only' => ['edit', 'update', 'destroy']]);
    }

    //Get all products items, OUTPUT: product's index(view) + $products(object)
    public function index()
    {
        $products = self::getProducts();
        return view('layouts.products.index', compact('products'));
    }

    //Get all products items that don't have catalog, INPUT: $request(checkbox's data), OUTPUT: product's list(view) + $products(object)
    public function backup(Request $request)
    {
        if ($request->check==='true') {
            $products = ProductServices::getBackupProducts(Paginate::PRODUCT);
            $view = view('components.products.list-backup', compact('products'));
        } else {
            $products = self::getProducts();
            $view = view('components.products.list', compact('products'));
        }
        return $view;
    }

    //Get all products items for search,INPUT: $request(keyword), OUTPUT: product's list(view) + $products(object)
    public function search(Request $request)
    {
        $products = ProductServices::searchProducts(Paginate::PRODUCT, $request->keyword);
        return view('components.products.list', compact('products'));
    }

    //Show edit form for product, INPUT: product's id, OUTPUT: product's edit(view) + product's information)
    public function edit($pid)
    {
        $product = ProductServices::edit($pid);
        $catalogs = CatalogServices::getAllCatalog();
        return view('components.products.edit-form', ['product' => $product, 'catalogs' => $catalogs]);
    }

    //Show create form for product, OUTPUT: create product's form(view) + $catalogs(object)
    public function create()
    {
        $catalogs = CatalogServices::getAllCatalog();
        return view('components.products.add-form', compact('catalogs'));
    }

    //Store a new product, INPUT: $request(form's data), OUTPUT: product's list(view) + $products(object)
    public function store(ProductRequest $request)
    {
        ProductServices::store(
            $request->name,
            $request->price,
            $request->quantity,
            $request->description,
            $request->image,
            $request->catalog_id,
            Auth::user()->id
        );
        $products = self::getProducts();
        $view = view('components.products.list', compact('products'));
        return response([
            'view' => $view->render()
        ], 200);
    }

    //Update a product, INPUT: $request(form's data), OUTPUT: product's list(view) + $products(object)
    public function update(ProductRequest $request)
    {
        ProductServices::update($request);
        $products = self::getProducts();
        $view = view('components.products.list', compact('products'));
        return response([
            'view' => $view->render()
        ], 200);
    }

    //Delete a product, INPUT: product's id, OUTPUT: product's list(view) + $products(object)
    public function destroy($pid)
    {
        ProductServices::destroy($pid);
        $products = self::getProducts();
        $view = view('components.products.list', compact('products'));
        return response([
            'view' => $view->render()
        ], 200);
    }

    //Get all products from Database, OUTPUT: products(object)
    public static function getProducts()
    {
        return ProductServices::getProducts(Paginate::PRODUCT, 0);
    }
}
