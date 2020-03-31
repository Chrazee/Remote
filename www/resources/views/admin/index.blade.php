@extends('layouts.admin')

@section('id', 'Adminisztráció')
@section('title', 'Főoldal')

@section('content')
<div class="row">
    <div class="col-md-6 box">
        <a href="{{route('admin.general')}}">
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
        <a href="{{route('admin.group')}}">
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
        <a href="{{route('admin.devices')}}">
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
        <a href="{{route('admin.deviceType')}}">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fa fa-microchip"></i>
                    <h5>Eszköz típusok</h5>
                    <p class="text-muted">Eszköz típus beállítások</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 box">
        <a href="{{route('admin.modules')}}">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fa fa-cube"></i>
                    <h5>Modulok</h5>
                    <p class="text-muted">Modul beállítások</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 box">
        <a href="{{route('admin.icons')}}">
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
