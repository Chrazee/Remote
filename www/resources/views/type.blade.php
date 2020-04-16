@extends('layouts.main', ['title' => $title])

@section('content')
    <div class="row">
        <div class="col-12">
            <h4>{{ucfirst(Lang::get('device.devices'))}}</h4>
        </div>
    </div>
    @include('includes.deviceCard', ['devices' => $deviceType->devices])
@endsection
