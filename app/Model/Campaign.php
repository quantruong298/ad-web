<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = "campaigns";
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'user_id',
        'status',
        'start_day',
        'end_day',
        'budget',
        'bid_amount',
        'description',
        'product_id',
        'link',
        'banner',
        'file_name',
        'title'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
