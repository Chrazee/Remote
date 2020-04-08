@extends('layouts.admin', ['title' => $title])

@section('content')

    @include('includes.tesaser', ['icon' => '<i class="far fa-file-image"></i>', 'title' => $site_name_admin, 'subTitle' => $title])

<div class="row">
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
                    'iconType' => 'devicetype'
                ])
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
