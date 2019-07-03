<?php

namespace App\Helpers;


class CommonFunction
{
    public static function checkRoute()
    {
        $route_name = \Request::route()->getName();
        $array = [
            'dashboard',
            'user',
            'user.create',
            'user.delete',
            'user.edit',
            'product.index',
            'product.search',
            'product.create',
            'product.delete',
            'product.edit',
            'catalog.index',
            'catalog.create',
            'catalog.delete',
            'catalog.edit',
            'campaign.index',
            'campaign.delete',
            'campaign.update',
            'campaign.store',
            'report.index',
        ];
        return in_array($route_name, $array);
    }
}