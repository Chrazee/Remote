<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>SmartHome - Bejelentkezés</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="">
        <link rel="stylesheet" href="{{asset('assets/mdbootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/mdbootstrap/css/mdb.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css/site.css')}}">
    </head>
    <body>
        @if(isset(Auth::user()->email))
            <script>window.location="/";</script>
        @endif
   
        <div class="container h-100">
            <div class="row h-100 align-items-center min-vh-100 m-0 d-flex flex-column justify-content-center">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-header bg-secondary text-center">
                            <img src="{{asset('assets/imgs/logo.svg')}}">
                        </div>
                        <div class="card-body">
                            <small class="text-danger inputError"></small>
                            <div id="error"></div>
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                </div>
                            @endif
                            <form id="loginForm" method="post" action="{{ url('/login/checklogin') }}">
                                {{ csrf_field() }}
                                <!--<div class="md-form pb-1">
                                    <i class="fa fa-user prefix"></i>
                                    <input type="text" id="username" name="username" class="form-control" autofocus>
                                    <label for="username">Felhasználónév</label>
                                </div>-->
                                <div class="md-form pb-1">
                                    <i class="fa fa-envelope prefix"></i>
                                    <input type="email" id="email" name="email" class="form-control" autofocus>
                                    <label for="email">Email</label>
                                </div>
                                <div class="md-form">
                                    <i class="fa fa-key prefix"></i>
                                    <input type="password" id="password" name="password" class="form-control">
                                    <label for="password">Jelszó</label>
                                </div>
                                <div class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="rembemberme">
                                        <label class="custom-control-label" for="rembemberme"><small>Emlékezz rám</small></label>
                                    </div>
                                    <button type="submit" id="login" name="login" class="btn btn-indigo mt-3">Bejelentkezés</button>
                                </div>
                            </form>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="{{asset('assets/mdbootstrap/js/jquery-3.4.1.min.js')}}"></script>
        <script src="{{asset('assets/mdbootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/mdbootstrap/js/mdb.min.js')}}"></script>
        <script src="{{asset('assets/jqueryvalidation/js/validate-1.19.1.min.js')}}"></script>
        <!--<script>
            $('document').ready(function()
            {
                $("#loginForm").validate({
                    rules: {
                        password: {
                            required: true,
                        },
                        username: {
                            required: true,
                        },
                    },
                    messages: {
                        username: {
                            required: "A felhasználónév megadása kötelező"
                        },
                        password: {
                            required: "A jelszó megadása kötelező"
                        },
                    },
                    errorElement : 'div',
                    errorLabelContainer: '.inputError',
                    submitHandler: submitForm 
                }); 
            });

            function submitForm() {
                var data = $("#loginForm").serialize();
                $.ajax({
                    type : 'POST',
                    url : 'inc/ajax/login/submitLogin.php',
                    data : data,
                    beforeSend: function() {
                        $("#error").fadeOut();
                        $("#loginBtn").html('<i class="fas fa-spinner fa-pulse"></i> folyamatban');
                    },
                    success : function(response) {
                        if(response =="ok") {
                            $("#loginBtn").html('<i class="fas fa-spinner fa-pulse"></i> sikeres belépés');
                            setTimeout('window.location.href = "index.php";',2000);
                        } else {
                            $("#error").fadeIn(1000, function(){
                                $("#error").html('<div class="alert alert-danger"><i class="fas fa-info-circle"></i> </span>'+response+'</div>');
                                $("#loginBtn").html('Belépés');
                            });
                        }
                    }
                });
                return false;
            }
    </script>-->
    </body>
</html>