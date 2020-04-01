<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{$site['site_name']}} - Bejelentkezés</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="">
        <link rel="stylesheet" href="{{asset('assets/mdbootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/mdbootstrap/css/mdb.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/animate/css/animate.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css/site.css')}}">
    </head>
    <body>
        <div class="container h-100">
            <div class="row h-100 align-items-center min-vh-100 m-0 py-5 d-flex flex-column justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-secondary text-center">
                            <img src="{{asset('assets/imgs/logo.svg')}}">
                        </div>
                        <div class="card-body">
                            <form id="loginForm">
                                <div class="alert error-bag" style="display:none">
                                    <div class="alert-header">
                                        <span class="icon"></span>
                                        <span class="justify-content-center align-self-center">
                                            <span class="title"></span>
                                        </span>
                                    </div>
                                    <div class="alert-content">
                                        <ul class="errors"></ul>
                                    </div>
                                </div>
                                <div class="md-form pb-1">
                                    <i class="fa fa-user prefix"></i>
                                    <input type="text" id="username" name="username" class="form-control" autofocus>
                                    <label for="username">Felhasználónév</label>
                                </div>
                                <div class="md-form">
                                    <i class="fa fa-key prefix"></i>
                                    <input type="password" id="password" name="password" class="form-control">
                                    <label for="password">Jelszó</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-3 actions submit">Bejelentkezés</button>
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
        <script src="{{asset('assets/site/js/common.js')}}"></script>
        <script>
            $(document).ready(function() {
                var loginForm = '#loginForm';
                var errorBag = loginForm + " .error-bag";
                var btn = loginForm + " .actions.submit";

                $('body').keypress(function(event) {
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    if(keycode == '13') {
                        $(loginForm).submit();
                    }
                });

                $(loginForm).submit(function(e) {
                    e.preventDefault();

                    $.ajax({
                        type: 'POST',
                        url: '{{route('login.validate')}}',
                        data: {
                            _token: '{{csrf_token()}}',
                            username: $(loginForm + " input[name='username']").val(),
                            password:  $(loginForm + " input[name='password']").val(),
                        },
                        dataType: 'json',
                        cache: false,
                        beforeSend: function() {
                            setBtnDisabled(btn, true);
                            clearErrorBag(errorBag, true);
                        },
                        success:function(response) {
                            setBtnDisabled(btn, true);
                            setBtn(btn, true, response.redirect);
                            printErrorBag(errorBag, 'success', response.message, null);
                            setTimeout(function() {
                                location.reload('{{route('index')}}');
                            }, 2000);
                        },
                        error: function(xhr, status, error) {
                            setBtnDisabled(btn, false);
                            printErrorBag(errorBag, 'danger', xhr.responseJSON.message, xhr.responseJSON.errors);
                        }
                    });
                    $(loginForm + " input:visible:first").focus();
                });
            });
        </script>
    </body>
</html>
