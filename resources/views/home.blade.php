@php($check = \App\Helpers\CommonFunction::checkRoute())
@extends('layouts.app')
@section('content')
@if(!$check)
@component('components.templates.header', ['sliders' => $sliders])
@endcomponent
@else
@component('components.templates.header')
@endcomponent
@endif

<div class="page-body">
    @component('components.templates.sidebar')
    @endcomponent
    <main class="py-4" style="flex-grow: 25">

        <div class="container" xmlns="">
            @if(!$check)
            <div class="list-product">
            </div>
            @else
            <div class="row">
                @yield('data-table')
            </div>
            @endif
        </div>
    </main>
</div>
@component('components.templates.footer')
@endcomponent
@endsection