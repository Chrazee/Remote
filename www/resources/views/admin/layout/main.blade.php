<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{$site_name}} - @yield('id') :: @yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <link rel="icon" href="">
        <link rel="stylesheet" href="{{asset('assets/mdbootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/mdbootstrap/css/mdb.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css/site.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css/admin.css')}}">
        <script src="{{asset('assets/mdbootstrap/js/jquery-3.4.1.min.js')}}"></script>
        <script src="{{asset('assets/jqueryvalidation/js/validate-1.19.1.min.js')}}"></script>
    </head>
    <body>
        <nav class="navbar justify-content-between flex-nowrap flex-row navbar-dark bg-dark">
            <div class="container-fluid">
                <a href="/" class="navbar-brand float-left"><img src="{{asset('assets/imgs/logo.svg')}}"></a>
                <ul class="nav navbar-nav flex-row float-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="topnavDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="topnavDropdown">
                            <a class="dropdown-item" href="/admin"><i class="fa fa-chevron-left"></i> Vissza a felületre</a>
                            <a class="dropdown-item" href="/logout"><i class="fa fa-power-off"></i> Kijelentkezés</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid" id="content">
            @yield('content')
        </div>

        <script src="{{asset('assets/mdbootstrap/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/mdbootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/mdbootstrap/js/mdb.min.js')}}"></script>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });

            $('.carousel').carousel({
                touch: true
            });
        </script>
        <script src="{{asset('assets/site/js/common.js')}}"></script>
    </body>
</html>
