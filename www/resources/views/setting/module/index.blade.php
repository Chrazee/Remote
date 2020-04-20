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
            <div class="table-responsive">
                <table class="table table-hover btn-table mb-0">
                    <thead>
                    <tr>
                        <th class="th-lg">{{ucfirst(Lang::get('common.identifier'))}}</th>
                        <th class="th-lg">{{ucfirst(Lang::get('common.name'))}}</th>
                        <th class="th-lg">{{ucfirst(Lang::get('common.directory'))}}</th>
                        <th class="th-lg">{{ucfirst(Lang::get('common.description'))}}</th>
                        <th class="th-lg">{{ucfirst(Lang::get('common.directory_status'))}}</th>
                        <th class="th-lg">{{ucfirst(Lang::get('common.view_file_status'))}}</th>
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
                                @if(Module\Validators\StructureValidator::validateDirectory($module->directory) === true)
                                    <span data-toggle="tooltip" data-placement="top" title="{{ucfirst(Lang::get('common.directory_exists'))}}">
                                        <i class="far fa-check-circle text-success"></i>
                                    </span>
                                @else
                                    <span data-toggle="tooltip" data-placement="top" title="{{ucfirst(Lang::get('common.directory_not_exists'))}}">
                                        <i class="far fa-times-circle text-danger"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if(Module\Validators\StructureValidator::validateView($module->directory) === true)
                                    <span data-toggle="tooltip" data-placement="top" title="{{ucfirst(Lang::get('common.view_file_exists'))}}">
                                        <i class="far fa-check-circle text-success"></i>
                                    </span>
                                @else
                                    <span data-toggle="tooltip" data-placement="top" title="{{ucfirst(Lang::get('common.view_file_not_exists'))}}">
                                        <i class="far fa-times-circle text-danger"></i>
                                    </span>
                                @endif

                            </td>
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
        @endslot
    @endcomponent
@endsection
