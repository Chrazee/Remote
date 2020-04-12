@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card card-cascade wider">
                <div class="view view-cascade gradient-card-header bg-primary narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                    <h6 class="white-text mx-3 mb-0">
                        @include('includes.breadcrumb', ['title' => $title])
                    </h6>
                    <div class="actions">
                        <a href="{{route('settings.group.add')}}" title="{{ucfirst(Lang::get('common.create_new'))}}" data-toggle="tooltip" data-placement="top" type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
                            <i class="fas fa-plus mt-0"></i>
                        </a>
                    </div>
                </div>
                <div class="px-4 py-2">
                    @include('setting.group.form.update')
                </div>
            </div>
        </div>
    </div>
    @component('components.confirmDelete')
        @slot('title',  $group->name)
        @slot('id', $group->id)
        @slot('url', route('settings.group.delete', $group->id))
        @slot('redirect', route('settings.groups'))
    @endcomponent
@endsection
