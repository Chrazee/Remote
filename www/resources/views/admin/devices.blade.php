@extends('layouts.admin')

@section('id', 'Adminisztráció')
@section('title', 'Eszköz beállítások')

@section('content')

<div class="row">
    <div class="col-12 mt-4">
        <div class="card card-cascade narrower">
            <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center sticky">
                <div class="actions">
                    <button title="Új hozzáadása" data-toggle="tooltip" data-placement="top" type="button" class="btn btn-outline-white btn-rounded btn-sm px-2 create">
                        <i class="fas fa-plus mt-0"></i>
                    </button>
                </div>
                <span class="white-text mx-3">Eszközök</span>
                <div class="actions">
                    <button title="Módosítás" data-toggle="tooltip" data-placement="top" type="button" class="btn btn-outline-white btn-rounded btn-sm px-2 edit" disabled>
                        <i class="fas fa-pencil-alt mt-0"></i>
                    </button>
                    <button title="Törlés" data-toggle="tooltip" data-placement="top" type="button" class="btn btn-outline-white btn-rounded btn-sm px-2 delete" disabled>
                        <i class="far fa-trash-alt mt-0"></i>
                    </button>
                </div>
            </div>
            <div class="px-4">
                <div class="table-responsive">
                    <table class="table table-hover btn-table img-table mb-0" id="devicesTable">
                        <thead>
                            <tr>
                                <th class="th-lg">Azonosító</th>
                                <th class="th-lg">Név</th>
                                <th class="th-lg">Csoport</th>
                                <th class="th-lg">Típus</th>
                                <th class="th-lg">IP cím</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devices as $device)
                                <tr data-id="{{$device->id}}" data-display_name="{{$device->display_name}}" data-group_id="{{$device->group->id}}" data-type_id="{{$device->type->id}}" data-ip="{{$device->ip}}">
                                    <td><a href="{{route('device', $device->id)}}">{{$device->id}}</a></td>
                                    <td>{{$device->display_name}}</td>
                                    <td>{{$device->group->name}}</td>
                                    <td>{{$device->type->display_name}} ({{$device->type->name}})</td>
                                    <td>{{$device->ip}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#devicesTable tbody tr").click(function(e) {
            var id = $(this).attr('data-id');

            $("#devicesTable tbody tr").removeClass('tr-selected');
            $(this).addClass('tr-selected');

            $('.actions .delete').attr('data-id', id);
            $('.actions .delete').attr('data-display_name', $(this).attr('data-display_name'));
            $('.actions .edit').attr('data-id', id);
            $('.actions .edit').attr('data-display_name', $(this).attr('data-display_name'));
            $('.actions .edit').attr('data-group_id', $(this).attr('data-group_id'));
            $('.actions .edit').attr('data-type_id', $(this).attr('data-type_id'));
            $('.actions .edit').attr('data-ip', $(this).attr('data-ip'));

            setBtnDisabled('.actions .delete', false);
            setBtnDisabled('.actions .edit', false);
        });
    });
</script>

@include('admin.includes.device.modals.create')
@include('admin.includes.device.modals.delete')
@include('admin.includes.device.modals.update')

@endsection
