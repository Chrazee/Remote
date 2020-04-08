@extends('layouts.main', ['title' => $title])

@section('content')
    @if (!empty($error))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <h5>{{$error['title']}}</h5>
                    <p>{{$error['message']}}</p>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12 mb-3">
                <div class="card rounded teaser">
                    <div class="card-body">
                        <div class="row h-100">
                            <div class="col-6 align-self-center teaser-left">
                                <h1><i class="fa fa-microchip"></i></h1>
                            </div>
                            <div class="col-6 align-self-center teaser-right">
                                <h4><strong>{{$device->name}}</strong></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                @include($view)
            </div>
        </div>
    @endif
@endsection

