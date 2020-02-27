<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>SmartHome - @yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <link rel="icon" href="}">
        <link rel="stylesheet" href="{{asset('assets/mdbootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/mdbootstrap/css/mdb.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css/site.css')}}">
        <script src="{{asset('assets/mdbootstrap/js/jquery-3.4.1.min.js')}}"></script>
        <script src="{{asset('assets/jqueryvalidation/js/validate-1.19.1.min.js')}}"></script>
    </head>
    <body>
        <nav class="navbar justify-content-between flex-nowrap flex-row" id="navbar-top">
            <div class="container-fluid">
                <!--<a href="/" class="navbar-brand float-left"><img src="{{asset('assets/imgs/logo.svg')}}"></a>-->
                @if(Request::segment(1) == "")
                    <a href="/" class="navbar-brand float-left">
                        <b>Otthonom</b>
                    </a>
                @else
                    <a href="javascript:window.history.back();" class="navbar-brand float-left">
                        <b><i class="fa fa-arrow-left"></i></b>
                    </a>
                    @if (!empty($currentRoom))
                        <b>{{$currentRoom->name}}</b>
                    @elseif(!empty($currentType))
                        <b>{{$currentType->display_name}}</b>
                    @endif
                @endif
                <ul class="nav navbar-nav flex-row float-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="topnavDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="topnavDropdown">
                            <a class="dropdown-item" href="/admin"><i class="fa fa-user-shield"></i> Admin</a>
                            <a class="dropdown-item" href="/logout"><i class="fa fa-power-off"></i> Kijelentkezés</a>
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
                <li class="nav-item active">
                    <a class="nav-link" href="/" data-toggle="tooltip" data-placement="top" title="Otthon">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/favourites" data-toggle="tooltip" data-placement="top" title="Kedvencek">
                        <i class="far fa-heart"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/settings" data-toggle="tooltip" data-placement="top" title="Beállítások">
                        <i class="fas fa-cog"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <script src="{{asset('assets/mdbootstrap/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/mdbootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/mdbootstrap/js/mdb.min.js')}}"></script>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        </script>
        <script src="{{asset('assets/site/js/common.js')}}"></script>
    </body>
</html>
