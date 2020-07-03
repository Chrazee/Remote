<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{$site['site_name']}} :: @include('includes.title', ['title' => $title])</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="">
        <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}"></script>
    </head>
    <body>
        @guest
            @yield('content')
        @else
            <nav class="navbar navbar-light bg-white shadow" id="navbar-top">
                <div class="w-100 d-flex justify-content-between align-items-center">
                    @if(Request::segment(1) != "")
                        <a href="javascript:window.history.back();" class="navbar-brand float-left">
                            <b><i class="fa fa-arrow-left"></i></b>
                        </a>
                    @endif
                    <a class="navbar-brand" href="{{route('index')}}">
                        <img class="logo" src="{{asset('images/logo_black.svg')}}" title="{{$site['site_name']}} " alt="{{$site['site_name']}} ">
                    </a>
                    <div class="dropdown">
                        <button type="button" class="btn btn-primary btn-floating btn-sm shadow-none" id="topnavDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                            <i class="fas fa-ellipsis-v" aria-hidden="true"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="topnavDropdown">
                            <a class="dropdown-item" href="{{route('settings.account')}}"><i class="far fa-user-circle"></i> {{Auth::user()->username}}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('logout')}}"><i class="fa fa-power-off"></i> {{ucfirst(Lang::get('common.logout'))}}</a>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container-fluid" id="content">
                @yield('content')
            </div>

            <nav class="navbar navbar-light fixed-bottom justify-content-between flex-nowrap flex-row shadow-lg" id="navbar-bottom">
                <ul class="nav navbar-nav flex-row mx-auto">
                    <li class="nav-item">
                        <a class="nav-link @if(Route::current()->getName() == 'index')active @endif" href="{{route('index')}}" data-toggle="tooltip" data-placement="top" title="{{ucfirst(Lang::get('common.homepage'))}}">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Route::current()->getName() == 'favorites')active @endif" href="{{route('favorites')}}" data-toggle="tooltip" data-placement="top" title="{{ucfirst(Lang::get('common.favorites'))}}">
                            <i class="far fa-heart"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  @if(strpos(Route::current()->getName(), 'settings') !== false)active @endif" href="{{route('settings')}}" data-toggle="tooltip" data-placement="top" title="{{ucfirst(Lang::get('common.settings'))}}">
                            <i class="fas fa-cog"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        @endguest
    </body>
</html>
