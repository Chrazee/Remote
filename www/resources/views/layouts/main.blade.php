<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{$site['site_name']}} :: @include('includes.title', ['title' => $title])</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <link rel="icon" href="">
        <link rel="stylesheet" href="{{asset('assets/mdbootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/mdbootstrap/css/mdb.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css/site.css')}}">
        <script src="{{asset('assets/mdbootstrap/js/jquery-3.4.1.min.js')}}"></script>
        <script src="{{asset('assets/site/js/common.js')}}"></script>
    </head>
    <body>
    <nav class="navbar justify-content-between flex-nowrap flex-row" id="navbar-top">
            <div class="container-fluid">
                @if(Request::segment(1) == "")
                    <a href="{{route('index')}}" class="navbar-brand float-left">
                        <img class="logo" src="{{asset('assets/imgs/remote.svg')}}" title="{{$site['site_name']}} " alt="{{$site['site_name']}} ">
                    </a>
                @else
                    <a href="javascript:window.history.back();" class="navbar-brand float-left">
                        <b><i class="fa fa-arrow-left"></i></b>
                    </a>
                    <a href="{{route('index')}}">
                        <img class="logo" src="{{asset('assets/imgs/remote.svg')}}" title="{{$site['site_name']}} " alt="{{$site['site_name']}} ">
                    </a>
                @endif
                <ul class="nav navbar-nav flex-row float-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="topnavDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="topnavDropdown">
                            @if(Auth::user()->admin == 1)
                                <a class="dropdown-item" href="{{route('admin')}}"><i class="fa fa-user-shield"></i> {{ucfirst(Lang::get('common.admin'))}}</a>
                            @endif
                            <a class="dropdown-item" href="{{route('settings.account')}}"><i class="far fa-user-circle"></i> {{ucfirst(Lang::get('common.account'))}}</a>
                            <a class="dropdown-item" href="{{route('logout')}}"><i class="fa fa-power-off"></i> {{ucfirst(Lang::get('common.logout'))}}</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid" id="content">
            @yield('content')
        </div>

        <nav class="navbar fixed-bottom justify-content-between flex-nowrap flex-row z-depth-1" id="navbar-bottom">
            <ul class="nav navbar-nav flex-row mx-auto">
                <li class="nav-item">
                    <a class="nav-link @if(Route::current()->getName() == 'index')active @endif" href="{{route('index')}}" data-toggle="tooltip" data-placement="top" title="{{ucfirst(Lang::get('index.homepage'))}}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::current()->getName() == 'favorites')active @endif" href="{{route('favorites')}}" data-toggle="tooltip" data-placement="top" title="{{ucfirst(Lang::get('favorite.favorites'))}}">
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

        <script src="{{asset('assets/mdbootstrap/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/mdbootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/mdbootstrap/js/mdb.min.js')}}"></script>
    </body>
</html>
