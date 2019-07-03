<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $guarded = [];
    public function catalog()
    {
        return $this->hasOne('App\Model\Catalog', 'catalog_id', 'id');
    }
}
