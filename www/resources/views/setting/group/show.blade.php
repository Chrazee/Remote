@extends('layouts.main')

@section('content')
    @component('components.dataTable')
        @slot('title')
            @include('includes.breadcrumb', ['title' => $title])
        @endslot
        @slot('actions')
            <a href="{{route('settings.group.add')}}" title="{{ucfirst(Lang::get('common.create_new'))}}" data-toggle="tooltip" data-placement="top" type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
                <i class="fas fa-plus mt-0"></i>
            </a>
        @endslot
        @slot('body')
            @include('setting.group.form.update')
        @endslot
    @endcomponent

    @component('components.confirmDelete')
        @slot('title',  $group->name)
        @slot('id', $group->id)
        @slot('url', route('settings.group.delete', $group->id))
        @slot('redirect', route('settings.groups'))
    @endcomponent
@endsection
