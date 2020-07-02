@extends('layouts.main')

@section('content')

    @component('components.dataTable')
        @slot('title')
            @include('includes.breadcrumb', ['title' => $title])
        @endslot
        @slot('actions')
            <a href="{{route('settings.devicetype.add')}}" title="{{ucfirst(Lang::get('common.create_new'))}}" data-toggle="tooltip" data-placement="top" type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
                <i class="fas fa-plus mt-0"></i>
            </a>
        @endslot
        @slot('body')
            @include('setting.devicetype.form.update')
        @endslot
    @endcomponent

    @component('components.confirmDelete')
        @slot('title', $deviceType->name)
        @slot('id', $deviceType->id)
        @slot('url', route('settings.devicetype.delete', $deviceType->id))
        @slot('redirect', route('settings.devicetypes'))
    @endcomponent
@endsection
