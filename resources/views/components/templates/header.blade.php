@php($check = \App\Helpers\CommonFunction::checkRoute())
<header>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" @if(\Request::is('/')) href="javascript:void(0)" @else href="/"@endif>
                <img src="{{ asset('img/logo.png') }}" class="logo img-fluid" alt="Responsive image">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="input-group search justify-content-center">
                    @if(!$check)
                        <input type="text" class="form-control" placeholder="Search this website">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    @endif
                </div>
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a href="" class="nav-link" data-toggle="modal"
                               data-target="#modalForm">{{ __('Login/Sign up') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown"><img src="{{ asset('img/avatar.png') }}" class="avatar"
                                                           alt="Responsive image"></li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->fullname }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    {{ __('Dashboard') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <nav class="menu navbar navbar-expand-lg navbar-dark default-color">
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent-333"
                aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent-333">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Coupon Code</a>
                </li>
            </ul>
        </div>
    </nav>
    @component('components.auths.login-register')
    @endcomponent
    @if(!$check)
        @component('components.templates.slider', ['sliders' => $sliders])
        @endcomponent
    @endif
</header>