@extends('layouts.main')

@section('id', 'group')
@section('title', 'Csoportok')
@section('content')
    <div class="row">
        @if (!$validGroup)
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <h5>{{$error['title']}}</h5>
                    <p>{{$error['message']}}</p>
                </div>
            </div>
        @else
            @if (count($subGroups) > 0)
                <div class="col-12">
                    <h4>Alszobák</h4>
                    <div class="row">
                        @include('includes.group.card', ['groups' => $subGroups])
                    </div>
                </div>
            @endif

            <div class="col-12">
                <h4>Eszközök</h4>
            </div>
            @if (count($devices) > 0)
                <div class="col-12">
                    <div class="row">
                        @foreach($devices as $device)
                            <div class="col-6 col-sm-4 col-md-3 box">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <a href="{{Request::url()}}/type/{{$device->type}}">
                                            <div class="card">
                                                <div class="card-body">
                                                    @if (empty($device->icon))
                                                        <img src="{{asset('assets/imgs/devicetype')}}/not_set.svg" class="img-fluid">
                                                    @else
                                                        <img src="{{asset('assets/imgs/devicetype')}}/{{$device->icon}}" class="img-fluid">
                                                    @endif
                                                    <h5>{{$device->display_name}}</h5>
                                                    <p class="text-muted">
                                                        @if (empty($device->devices))
                                                            0
                                                        @else
                                                            {{$device->devices}}
                                                        @endif
                                                        eszköz
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @if(true))
                                        <div class="col-12">
                                            @foreach($group->devices  as $d)
                                                <a href="/device/{{$d->id}}">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            {{$d->display_name}}
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="col-12">
                    <a href="#" class="btn btn-outline-secondary"><i class="fa fa-plus"></i> Eszköz hozzáadása</a>
                </div>
            @endif
        @endif
    </div>
@endsection
