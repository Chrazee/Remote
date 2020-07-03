@extends('layouts.main', ['title' => ucfirst(Lang::get('common.login'))])

@section('content')
    <div class="container h-100">
        <div class="row h-100 align-items-center min-vh-100 m-0 py-5 d-flex flex-column justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-center">
                        <img src="{{asset('images/logo_white.svg')}}" class="logo">
                    </div>
                    <div class="card-body">
                        <form class="login-form form">
                            @include('includes.preloader')
                            @include('includes.errorBag')
                            {{{csrf_field()}}}
                            <div class="form-group pb-1">
                                <label for="username"><i class="fa fa-user"></i> {{ucfirst(Lang::get('common.username'))}}</label>
                                <input type="text" id="username" name="username" class="form-control" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="fa fa-key prefix"></i> {{ucfirst(Lang::get('common.password'))}}</label>
                                <input type="password" id="password" name="password" class="form-control">
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
@endsection
