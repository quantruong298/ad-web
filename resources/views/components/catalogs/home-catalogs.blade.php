@isset($catalogs)
<li class="header-menu">
    <span>Categories</span>
</li>
<li @if($catid==0) class="active-cat" @endif>
    <a  href="javascript:void(0)" onclick="getProducts('/product_items/0')" >
        <i class="fa fa-globe"></i>
        <span>All Categories</span>
        {{--            <span class="badge badge-pill badge-primary">Beta</span>--}}
    </a>
</li>
@foreach($catalogs as $catalog)
    <li @if($catid==$catalog->id) class="active-cat" @endif>
        <a href="javascript:void(0)" onclick="getProducts('/product_items/{{$catalog->id}}')" >
            <i class="fa fa-{{$catalog->name}}"></i>
            <span>{{$catalog->name}}</span>
{{--            <span class="badge badge-pill badge-primary">Beta</span>--}}
        </a>
    </li>
@endforeach
@endisset