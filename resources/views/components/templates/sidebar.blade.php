@php($check = \App\Helpers\CommonFunction::checkRoute())
<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
        <div class="sidebar-menu">
            @if(!$check)
                <ul class="list-catalog">
                    @component('components.catalogs.home-catalogs')
                    @endcomponent
                </ul>
            @else
                <ul>
                    <li class="header-menu">
                        <span>Manager</span>
                    </li>
                    @if(Auth::user()->role_id == \App\Enum\UserRoles::ADMIN)
                        <li>
                            <a href="{{ route('user') }}">
                                <i class="fa fa-user"></i>
                                <span>User</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('catalog.index') }}">
                                <i class="fa fa-list-ul "></i>
                                <span>Catalog</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('product.index') }}">
                            <i class="fa fa-cubes"></i>
                            <span>Product</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('campaign.index') }}">
                            <i class="fa fa-book"></i>
                            <span>Campaign</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('report.index')}}">
                            <i class=" fa fa-map"></i>
                            <span>Reporting</span>
                        </a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>