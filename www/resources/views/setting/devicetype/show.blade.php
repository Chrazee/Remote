@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card card-cascade wider">
                <div class="view view-cascade gradient-card-header bg-primary narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                    <h6 class="white-text mx-3 mb-0">
                        <a href="{{route('settings')}}">{{ucfirst(Lang::get('common.settings'))}}</a>&nbsp;/
                        <a href="{{route('settings.devicetypes')}}">{{ucfirst(Lang::get('common.devicetypes'))}}</a>&nbsp;/
                        {{$deviceType->name}}
                    </h6>
                    <div class="actions">
                        <a href="{{route('settings.devicetype.add')}}" title="{{ucfirst(Lang::get('common.create_new'))}}" data-toggle="tooltip" data-placement="top" type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
                            <i class="fas fa-plus mt-0"></i>
                        </a>
                    </div>
                </div>
                <div class="px-4 py-2">
                    @include('setting.devicetype.form.update')
                </div>
            </div>
        </div>
    </div>
    @component('components.confirmDelete')
        @slot('title', $deviceType->name)
        @slot('id', $deviceType->id)
        @slot('url', route('settings.devicetype.delete', $deviceType->id))
        @slot('redirect', route('settings.devicetypes'))
    @endcomponent
@endsection
