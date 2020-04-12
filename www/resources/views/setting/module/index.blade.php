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
                        <a href="{{route('settings.module.add')}}" title="{{ucfirst(Lang::get('common.create_new'))}}" data-toggle="tooltip" data-placement="top" type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
                            <i class="fas fa-plus mt-0"></i>
                        </a>
                    </div>
                </div>
                <div class="px-4 py-2">
                    <div class="table-responsive">
                        <table class="table table-hover btn-table mb-0">
                            <thead>
                                <tr>
                                    <th class="th-lg">{{ucfirst(Lang::get('common.identifier'))}}</th>
                                    <th class="th-lg">{{ucfirst(Lang::get('common.name'))}}</th>
                                    <th class="th-lg">{{ucfirst(Lang::get('common.directory'))}}</th>
                                    <th class="th-lg">{{ucfirst(Lang::get('common.description'))}}</th>
                                    <th class="th-lg">{{ucfirst(Lang::get('common.actions'))}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($modules as $module)
                                <tr>
                                    <td>{{$module->id}}</td>
                                    <td>{{$module->name}}</td>
                                    <td>{{$module->directory}}</td>
                                    <td>{{$module->description}}</td>
                                    <td>
                                        <a href="{{route('settings.module.show', ['id' => $module->id])}}" data-toggle="tooltip" data-placement="top" title="{{ucfirst(Lang::get('common.jump_to'))}}: {{$module->name}}">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
