@extends('admin.layout.main')

@section('id', 'Adminisztráció')
@section('title', 'Csoport Ikonok')

@section('content')
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Új ikon feltöltése</h5>
                    @include('admin.includes.icon.uploadForm', [
                        'type' => 'GroupsIcon'
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
                            'iconType' => 'group'
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
