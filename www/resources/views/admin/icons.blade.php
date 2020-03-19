@extends('admin.layout.main')

@section('id', 'Adminisztráció')
@section('title', 'Ikonok')

@section('content')
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
