@extends('admin.layout.main')

@section('id', 'Adminisztráció')
@section('title', 'Ikonok')

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
        <a href="{{route('adminIconDeviceType')}}">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fa fa-cog"></i>
                    <h5>Eszköz ikonok</h5>
                    <p class="text-muted">Eszköz ikonok kezelése</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 box">
        <a href="{{route('adminIconGroup')}}">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fa fa-map-marked"></i>
                    <h5>Csoport ikonok</h5>
                    <p class="text-muted">Csoport ikonok kezelése</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
