@extends('admin.layout.main')

@section('id', 'Adminisztráció')
@section('title', 'Főoldal')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card rounded teaser">
            <div class="card-body">
                <div class="row h-100">
                    <div class="col-6 align-self-center teaser-left">
                        <h1><i class="fa fa-user-shield"></i></h1>
                    </div>
                    <div class="col-6 align-self-center teaser-right">
                        <h4><strong>@yield('id')</strong></h4>
                        <h6>@yield('title')</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 box">
        <a href="{{route('adminGeneral')}}">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fa fa-cog"></i>
                    <h5>Általános</h5>
                    <p class="text-muted">Általános beállítások</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 box">
        <a href="{{route('adminGroup')}}">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fa fa-map-marked"></i>
                    <h5>Csoportok</h5>
                    <p class="text-muted">Csoport beállítások</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 box">
        <a href="{{route('adminDevices')}}">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fa fa-microchip"></i>
                    <h5>Eszközök</h5>
                    <p class="text-muted">Eszköz beállítások</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 box">
        <a href="{{route('adminModules')}}">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fa fa-cube"></i>
                    <h5>Modulok</h5>
                    <p class="text-muted">Modul beállítások</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-12 box">
        <a href="{{route('adminIcons')}}">
            <div class="card text-center">
                <div class="card-body">
                    <i class="far fa-file-image"></i>
                    <h5>Ikonok</h5>
                    <p class="text-muted">Ikon beállítások</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
