@extends('layouts.main')

@section('id', 'device')
@section('title', 'Készülék')

@section('content')
@if ($validDevice)
    <div class="row">
        <div class="col-12 mb-3">
            <div class="card rounded teaser">
                <div class="card-body">
                    <div class="row h-100">
                        <div class="col-6 align-self-center teaser-left">
                            <h1><i class="fa fa-microchip"></i></h1>
                        </div>
                        <div class="col-6 align-self-center teaser-right">
                            <h4><strong>{{$device->display_name}}</strong></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($validModulePath)
        @include($modulePath)
    @else
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <h5>{{$error['title']}}</h5>
                    <p>{{$error['message']}}</p>
                </div>
            </div>
        </div>
    @endif
@else
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info text-center">
                <h5>{{$error['title']}}</h5>
                <p>{{$error['message']}}</p>
            </div>
        </div>
    </div>
@endif
@endsection