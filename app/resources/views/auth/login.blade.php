<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{$site['site_name']}} - {{Lang::get('auth.login')}}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="">
        <link rel="stylesheet" href="{{asset('assets/mdbootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/mdbootstrap/css/mdb.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/animate/css/animate.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css/site.css')}}">
        <script src="{{asset('assets/mdbootstrap/js/jquery-3.4.1.min.js')}}"></script>
        <script src="{{asset('assets/site/js/common.js')}}"></script>
    </head>
    <body>
        <div class="container h-100">
            <div class="row h-100 align-items-center min-vh-100 m-0 py-5 d-flex flex-column justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-center">
                            <img src="{{asset('assets/imgs/remote_white.svg')}}" class="logo">
                        </div>
                        <div class="card-body">
                            <form class="login-form form">
                                @include('includes.preloader')
                                @include('includes.errorBag')
                                {{{csrf_field()}}}
                                <div class="md-form pb-1">
                                    <i class="fa fa-user prefix"></i>
                                    <input type="text" id="username" name="username" class="form-control" autofocus>
                                    <label for="username">{{ucfirst(Lang::get('common.username'))}}</label>
                                </div>
                                <div class="md-form">
                                    <i class="fa fa-key prefix"></i>
                                    <input type="password" id="password" name="password" class="form-control">
                                    <label for="password">{{ucfirst(Lang::get('common.password'))}}</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-3 actions submit">{{ucfirst(Lang::get('auth.login'))}}</button>
                                </div>
                            </form>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('.login-form').ajaxSubmit({
                    url: '{{route('login.validate')}}',
                    redirect: '{{route('index')}}'
                });
            });
        </script>
        <script src="{{asset('assets/mdbootstrap/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/mdbootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/mdbootstrap/js/mdb.min.js')}}"></script>
    </body>
</html>
