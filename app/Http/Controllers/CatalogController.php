<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatalogRequest;
use App\Model\Catalog;
use App\Services\CatalogServices;

class CatalogController extends Controller
{
    //User must login and has role ADMIN to access Catalog Manager
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    //Get all catalog items, OUTPUT: catalog's index(view) + $catalogs(object)
    public function index()
    {
        $catalogs = self::getCatalogs();
        return view('layouts.catalogs.index', compact('catalogs'));
    }
    //Store a new catalog, INPUT: $request(form's data), OUTPUT: catalog's list(view) + $catalogs(object)
    public function store(CatalogRequest $request)
    {
        CatalogServices::store($request->name);
        $catalogs = self::getCatalogs();
        $view = view('components.catalogs.list', compact('catalogs'));
        return response([
            'view' => $view->render()
        ], 200);
    }
    //Show edit form for catalog, INPUT: catalog's id, OUTPUT: catalog's edit(view) + catalog's information)
    public function edit($cid)
    {
        $catalog = CatalogServices::edit($cid);
        return view('components.catalogs.edit-form',compact('catalog'));
    }

    //Update a catalog, INPUT: $request(form's data), OUTPUT: catalog's list(view) + $catalogs(object)
    public function update(CatalogRequest $request)
    {
        CatalogServices::update($request);
        $catalogs = self::getCatalogs();
        $view = view('components.catalogs.list', compact('catalogs'));
        return response([
            'view' => $view->render()
        ], 200);
    }

    //Delete a catalog, INPUT: catalog's id, OUTPUT: catalog's list(view) + $catalogs(object)
    public function destroy($cid)
    {
        CatalogServices::destroy($cid);
        $catalogs = self::getCatalogs();
        $view = view('components.catalogs.list', compact('catalogs'));
        return response([
            'view' => $view->render()
        ], 200);
    }

    //Get all catalogs from Database, OUTPUT: catalogs(object)
    public static function getCatalogs(){
        return CatalogServices::getAllCatalog();
    }

}
