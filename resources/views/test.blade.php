<?php
    $route_name = \Request::route()->getName();

    $array = [
        'dashboard',
        'user',
        'user.create',
        'user.delete',
        'user.edit',
        'test'
    ]
?>

@if(in_array($route_name, $array))
    {{ $route_name }}
    @else
    {{ $route_name}}
@endif
