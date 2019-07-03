<?php

namespace App\Services;

use App\Model\Catalog;

class CatalogServices
{

    //get all catalogs from database with id>0, OUTPUT: object
    public static function getAllCatalog()
    {
        return Catalog::where('id', '>', 0)->get();
    }

    //store new catalog to database,INPUT: name for catalogs, OUTPUT:1
    public static function store($name)
    {
        Catalog::create(['name' => $name]);
        return 1;
    }

    //get catalog form database with catalog's id,INPUT: catalog's id, OUTPUT:object
    public static function edit($cid)
    {
        return Catalog::find($cid);
    }

    //delete catalog form database with catalog's id and change the id of all product that belong to this catalog to 0 ,INPUT: catalog's id, OUTPUT:object
    public static function destroy($cid)
    {
        ProductServices::backupCatalog($cid);
        return Catalog::destroy($cid);
    }

    //update catalog in database,INPUT: update's data, OUTPUT:object
    public static function update($request)
    {
        $product = Catalog::find($request->id);
        $product->name = $request->name;
        $product->save();
        return 1;
    }
}
