<?php

namespace App\Services;

use App\Enum\UserRoles;
use App\Helpers\GoogleDrive;
use App\Model\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductServices
{
    //get a product from database with product' id,INPUT: product's id, OUTPUT: object
    public static function getProductById($pid)
    {
        return Product::join('catalogs', 'products.catalog_id', '=', 'catalogs.id')
            ->select(
                'products.*',
                'catalogs.name as cname'
            )->where('products.id','=',$pid)->first();
    }

    //get all backup products from database,INPUT: items per page's number, OUTPUT: object
    public static function getBackupProducts($itermsperpage){
        if (Auth::user()->role_id == UserRoles::ADMIN) {
            $products = Product::join('users', 'products.user_id', '=', 'users.id')
                ->select(
                    'products.*',
                    'users.fullname as uname'
                )->where('catalog_id','=',0)
                ->orderBy('id', 'desc')
                ->paginate($itermsperpage);
        } else {
            $products = Product::where('products.user_id', '=', Auth::user()->id)
                ->where('catalog_id','=',0)
                ->orderBy('id', 'desc')
                ->paginate($itermsperpage);
        }
        return $products;
    }

    //get all products from database,INPUT: items per page's number + catalog's id + $dashboard , OUTPUT: object
    public static function getProducts($itermsperpage, $catid, $dashboard = true)
    {
        if ($dashboard) {
            if (Auth::user()->role_id == UserRoles::ADMIN) {
                $products = Product::join('catalogs', 'products.catalog_id', '=', 'catalogs.id')
                    ->join('users', 'products.user_id', '=', 'users.id')
                    ->leftJoin('campaigns', 'products.id', '=', 'campaigns.product_id')
                    ->groupBy(
                        'products.id',
                        'products.name',
                        'products.price',
                        'products.quantity',
                        'products.description',
                        'products.image',
                        'products.file_name',
                        'products.catalog_id',
                        'products.user_id',
                        'catalogs.name',
                        'users.fullname'
                    )
                    ->select(
                        'products.*',
                        'catalogs.name as cname',
                        'users.fullname as uname',
                        DB::raw('count(campaigns.id) as TotalCampaign')
                    )->where('catalog_id','!=',0)
                    ->orderBy('id', 'desc')
                    ->paginate($itermsperpage);
            } else {
                $products = Product::join('catalogs', 'products.catalog_id', '=', 'catalogs.id')
                    ->leftJoin('campaigns', 'products.id', '=', 'campaigns.product_id')
                    ->groupBy(
                        'products.id',
                        'products.name',
                        'products.price',
                        'products.quantity',
                        'products.description',
                        'products.image',
                        'products.file_name',
                        'products.catalog_id',
                        'products.user_id',
                        'catalogs.name'
                    )
                    ->where('products.user_id', '=', Auth::user()->id)
                    ->where('catalog_id','!=',0)
                    ->select(
                        'products.*',
                        'catalogs.name as cname',
                        DB::raw('count(campaigns.id) as TotalCampaign')
                    )->orderBy('id', 'desc')
                    ->paginate($itermsperpage);
            }

        } else {
            if ($catid != 0) $products = Product::where('catalog_id', $catid)->paginate($itermsperpage);
            else $products = Product::where('catalog_id','!=',0)->paginate($itermsperpage);
        }
        return $products;
    }

    //get all products from database for seaching,INPUT: items per page's number + keyword + $dashboard , OUTPUT: object
    public static function searchProducts($itermsperpage, $keyword, $dashboard = true)
    {
        if ($dashboard) {
            if (Auth::user()->role_id == UserRoles::ADMIN) {
                $product = Product::join('catalogs', 'products.catalog_id', '=', 'catalogs.id')
                    ->join('users', 'products.user_id', '=', 'users.id')
                    ->leftJoin('campaigns', 'products.id', '=', 'campaigns.product_id')
                    ->groupBy(
                        'products.id',
                        'products.name',
                        'products.price',
                        'products.quantity',
                        'products.description',
                        'products.image',
                        'products.file_name',
                        'products.catalog_id',
                        'products.user_id',
                        'catalogs.name',
                        'users.fullname'
                    )->where('products.name', 'like', '%' . $keyword . '%')
                    ->select(
                        'products.*',
                        'catalogs.name as cname',
                        'users.fullname as uname',
                        DB::raw('count(campaigns.id) as TotalCampaign')
                    )->orderBy('id', 'desc')
                    ->paginate($itermsperpage);
            } else {
                $product = Product::join('catalogs', 'products.catalog_id', '=', 'catalogs.id')
                    ->leftJoin('campaigns', 'products.id', '=', 'campaigns.product_id')
                    ->groupBy(
                        'products.id',
                        'products.name',
                        'products.price',
                        'products.quantity',
                        'products.description',
                        'products.image',
                        'products.file_name',
                        'products.catalog_id',
                        'products.user_id',
                        'catalogs.name'
                    )->where('products.name', 'like', '%' . $keyword . '%')
                    ->where('products.user_id', '=', Auth::user()->id)
                    ->select(
                        'products.id',
                        'products.name',
                        'products.price',
                        'products.quantity',
                        'products.description',
                        'products.image',
                        'products.file_name',
                        'products.catalog_id',
                        'products.user_id',
                        'catalogs.name as cname',
                        DB::raw('count(campaigns.id) as TotalCampaign')
                    )->orderBy('id', 'desc')
                    ->paginate($itermsperpage);
            }
        } else {
            $product = Product::where('products.name', 'like', '%' . $keyword . '%')->orderBy('id', 'desc')
                ->paginate($itermsperpage);
        }
        return $product;
    }

    //get product's information from database for edit form, INPUT: product's id , OUTPUT: object
    public static function edit($pid)
    {
        $product = Product::on();

        if (Auth::user()->role_id == UserRoles::SHOP) {
            $product = $product->where('user_id', Auth::user()->id);
        }

        return $product->join('users', 'products.user_id', '=', 'users.id')
            ->where('products.id', $pid)
            ->select('products.*',
                'users.fullname as uname'
            )
            ->first();
    }

    //create a product in database, INPUT: product's data, OUTPUT: object
    public static function store($name, $price, $quantity, $description, $image, $catalog_id, $user_id)
    {
        $image = self::uploadImageGD($image);
        Product::create([
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'description' => $description,
            'image' => $image[0]['link_file'],
            'file_name' => $image[0]['file_name'],
            'catalog_id' => $catalog_id,
            'user_id' => $user_id,
        ]);
        return 1;
    }

    //delete a product in database, INPUT: product's id, OUTPUT: object
    public static function destroy($pid)
    {
        self::deleteImageGD(Product::find($pid)->file_name);
        return Product::destroy($pid);
    }

    //update a product in database, INPUT: product's data, OUTPUT: 1
    public static function update($request)
    {
        $product = Product::find($request->pid);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->name = $request->name;
        $product->catalog_id = $request->catalog_id;
        if ($request->image != null) {
            self::deleteImageGD($product->file_name);
            $image = self::uploadImageGD($request->image);
            $product->image = $image[0]['link_file'];
            $product->file_name = $image[0]['file_name'];
        }
        $product->save();
        return 1;
    }

    //change the id of products that don't have catalog anymore, INPUT: catalog's id, OUTPUT: 1
    public static function backupCatalog($cid)
    {
        Product::where('catalog_id', '=', $cid)->update(array('catalog_id' => 0));
        return 1;
    }

    //Delete the image of a product on GoogleDrive, INPUT: product's filename
    public static function deleteImageGD($file_name)
    {
        GoogleDrive::deleteFileFromGoogleDrive($file_name);
    }

    //Upload the image of a product on GoogleDrive, INPUT: product's filename
    public static function uploadImageGD($image)
    {
        return GoogleDrive::uploadFileToGoogleDrive($image);
    }
}
