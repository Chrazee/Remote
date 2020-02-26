@extends('admin.layout.main')

@section('id', 'Adminisztráció')
@section('title', 'Eszköz típus ikonok')

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
    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Új ikon feltöltése</h5>
                @include('admin.includes.icon.uploadForm', [
                    'type' => 'DevicesTypeIcon'
                ])
            </div>
        </div>
    </div>
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ikonok</h5>
                <div class="row text-center text-lg-left">
                @include('admin.includes.icon.iconList', [
                    'icons' => $icons,
                ])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
