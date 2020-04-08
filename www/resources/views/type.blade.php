@extends('layouts.main', ['title' => $title])

@section('content')
    @if (!$validType)
        @alert(['type' => 'warning', 'align' => 'center', 'title' => $error['title'], 'message' => $error['message']])
        @endalert
    @else
        <div class="row">
            <div class="col-12">
                <h4>{{ucfirst(Lang::get('device.devices'))}}</h4>
            </div>
        </div>
        @include('includes.device.card', ['devices' => $deviceType->devices])
    @endif
@endsection
