@extends('layouts.admin')

@section('title', $title)

@section('content')

@include('includes.tesaser', ['icon' => '<i class="far fa-file-image"></i>', 'title' => $site_name_admin, 'subTitle' => $title])

<div class="row">
    <div class="col-md-6 box">
        <a href="{{route('admin.iconDeviceType')}}">
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
        <a href="{{route('admin.iconGroup')}}">
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
