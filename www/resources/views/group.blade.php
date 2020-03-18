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
                    <h4>Alcsoportok</h4>
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
                                        <a href="{{Request::url()}}/type/{{$device->deviceTypeId}}">
                                            <div class="card">
                                                <div class="card-body">
                                                    <img src="{{asset('assets/imgs/icons')}}/{{$device->iconName}}" class="img-fluid">
                                                    <h5>{{$device->deviceTypeName}}</h5>
                                                    <p class="text-muted">
                                                        {{$device->devices->count()}} eszköz
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @if($device->devices->count())
                                        <div class="col-12">
                                            @foreach($device->devices  as $d)
                                                <a href="/device/{{$d->id}}">
                                                    <div class="card box-devices">
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
