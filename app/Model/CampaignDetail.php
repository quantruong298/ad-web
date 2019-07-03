<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CampaignDetail extends Model
{
    protected $table = "campaign_details";
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
       'campaign_id',
       'clicks',
       'views',
       'datetime'
    ];
}
