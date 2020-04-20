@extends('layouts.main')

@section('content')
    @include('includes.tesaser', ['icon' => '<i class="fas fa-layer-group"></i>', 'title' => $deviceType->name, 'subTitle' => $title])
    <div class="row">
        <div class="col-12">
            <h4>{{ucfirst(Lang::get('common.devices'))}}</h4>
        </div>
    </div>
    @include('includes.deviceCard', ['devices' => $deviceType->devices])
@endsection
