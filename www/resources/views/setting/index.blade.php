@extends('layouts.main', ['title' => $title])

@section('content')

    @include('includes.tesaser', ['icon' => '<i class="fas fa-cogs"></i>', 'title' => ucfirst(Lang::get('common.settings'))])

    <div class="row">
        <div class="col-md-12 box">
            <a href="{{route('settings.account')}}">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="far fa-user-circle"></i>
                        <h5>{{ucfirst(Lang::get('common.account'))}}</h5>
                        <p class="text-muted">{{ucfirst(Lang::get('common.account_settings'))}}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-12 box">
            <a href="{{route('settings.groups')}}">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa fa-map-marked"></i>
                        <h5>{{ucfirst(Lang::get('common.groups'))}}</h5>
                        <p class="text-muted">{{ucfirst(Lang::get('common.group_settings'))}}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 box">
            <a href="{{route('settings.devices')}}">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa fa-microchip"></i>
                        <h5>{{ucfirst(Lang::get('common.devices'))}}</h5>
                        <p class="text-muted">{{ucfirst(Lang::get('common.device_settings'))}}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 box">
            <a href="{{route('settings.devicetypes')}}">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa fa-microchip"></i>
                        <h5>{{ucfirst(Lang::get('common.devicetypes'))}}</h5>
                        <p class="text-muted">{{ucfirst(Lang::get('common.devicetype_settings'))}}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-12 box">
            <a href="{{route('settings.modules')}}">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa fa-cube"></i>
                        <h5>{{ucfirst(Lang::get('common.modules'))}}</h5>
                        <p class="text-muted">{{ucfirst(Lang::get('common.module_settings'))}}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
