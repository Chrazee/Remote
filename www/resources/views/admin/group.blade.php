@extends('admin.layout.main')

@section('id', 'Adminisztráció')
@section('title', 'Csoport beállítások')

@section('content')
<!--<ul>
    @foreach($parentGroups as $parentGroup)
        <li>
            {{ $parentGroup->name }}
            @if(count($parentGroup->childs))
                @include('admin.includes.group.childList',['childs' => $parentGroup->childs])
            @endif
        </li>
    @endforeach
</ul>-->

<div class="row">
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <div class="row h-100 mb-2">
                    <div class="col-6 text-left align-self-center">
                        <h5 class="card-title mb-0">Összes csoport</h5>
                    </div>
                    <div class="col-6 text-right align-self-center">
                        <a class="btn btn-sm btn-success" id="createNewGroupBtn" data-toggle="modal" data-target="#groupCreateModal">
                            <i class="fa fa-plus"></i>
                            Létrehoz
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover btn-table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Azonosító</th>
                                <th>Név</th>
                                <th>Leírás</th>
                                <th>Műveletek</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (!empty($groups))
                            @foreach($groups as $group)
                                <tr>
                                    <td>{{$group->id}}</td>
                                    <td>{{$group->name}}</td>
                                    <td>
                                        <span title="{{$group->description}}" data-toggle="tooltip" data-placement="left">
                                            {{ str_limit($group->description, 40, '...') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="btn btn-sm btn-info" data-toggle="modal" data-target="#groupEditModal"
                                              data-group-id="{{$group->id}}"
                                              data-group-name="{{$group->name}}">
                                            <a title="{{$group->name}} szerkesztése" data-toggle="tooltip" data-placement="left">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </span>
                                        <span class="btn btn-sm btn-danger" data-toggle="modal" data-target="#groupDeleteModal"
                                              data-group-id="{{$group->id}}">
                                            <a title="{{$group->name}} törlése" data-toggle="tooltip" data-placement="left">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">
                                    <div class="text-center">
                                        <p>Nincs megjeleníthető adat</p>
                                        <a href="/admin/group/create" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i> Csoport létrehozása</a>
                                    </div>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.includes.group.editGroupModal')
@include('admin.includes.group.createGroupModal')
@include('admin.includes.group.deleteGroupModal')
@endsection
