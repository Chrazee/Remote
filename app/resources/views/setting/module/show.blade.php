@extends('layouts.main')

@section('content')
    @component('components.dataTable')
        @slot('title')
            @include('includes.breadcrumb', ['title' => $title])
        @endslot
        @slot('actions')
            <a href="{{route('settings.module.add')}}" title="{{ucfirst(Lang::get('common.create_new'))}}" data-toggle="tooltip" data-placement="top" type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
                <i class="fas fa-plus mt-0"></i>
            </a>
        @endslot
        @slot('body')
            @include('setting.module.form.update')
        @endslot
    @endcomponent

    @component('components.confirmDelete')
        @slot('title',  $module->name)
        @slot('id', $module->id)
        @slot('url', route('settings.module.delete', $module->id))
        @slot('redirect', route('settings.modules'))
    @endcomponent
@endsection
