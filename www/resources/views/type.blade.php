@extends('layouts.main')

@section('title', 'Szobák')

@section('content')
<div class="row">
    @if (!$validType)
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <h5>{{$error['title']}}</h5>
                    <p>{{$error['message']}}</p>
                </div>
            </div>
    @else
        <div class="col-12">
            <h4>Eszközök</h4>
        </div>
        @foreach($devices as $device)
            <div class="col-6 col-sm-4 col-md-3 box">
                <a href="/device/{{$device->id}}">
                    <div class="card">
                        <div class="card-body">
                            <h5>{{$device->display_name}}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    @endif
</div>
@endsection
