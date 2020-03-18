@extends('admin.layout.main')

@section('id', 'Adminisztráció')
@section('title', 'Eszköz típus beállítások')

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
                <span class="white-text mx-3">Eszköz típusok</span>
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
                    <table class="table table-hover btn-table img-table mb-0" id="deviceTypesTable">
                        <thead>
                            <tr>
                                <th class="th-lg">Azonosító</th>
                                <th class="th-lg">Típus</th>
                                <th class="th-lg">Megjelenített név</th>
                                <th class="th-lg">Ikon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($deviceTypes))
                                @foreach($deviceTypes as $deviceType)
                                    <tr data-id="{{$deviceType->id}}" data-name="{{$deviceType->name}}" data-display_name="{{$deviceType->display_name}}" data-icon_id="{{$deviceType->icon->id}}" data-default_icon_id="{{$defaultIcon->id}}">
                                        <td>{{$deviceType->id}}</td>
                                        <td>{{$deviceType->name}}</td>
                                        <td>{{$deviceType->display_name}}</td>
                                        <td><img src="{{asset('assets/imgs/icons')}}/{{$deviceType->icon->name}}"></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#deviceTypesTable tbody tr").click(function(e) {
            var id = $(this).attr('data-id');

            $("#deviceTypesTable tbody tr").removeClass('tr-selected');
            $(this).addClass('tr-selected');

            $('.actions .delete').attr('data-id', id);
            $('.actions .delete').attr('data-display_name', $(this).attr('data-display_name'));
            $('.actions .edit').attr('data-id', id);
            $('.actions .edit').attr('data-name', $(this).attr('data-name'));
            $('.actions .edit').attr('data-display_name', $(this).attr('data-display_name'));
            $('.actions .edit').attr('data-icon_id', $(this).attr('data-icon_id'));
            $('.actions .edit').attr('data-default_icon_id', $(this).attr('data-default_icon_id'));

            setBtnDisabled('.actions .delete', false);
            setBtnDisabled('.actions .edit', false);
        });
    });
</script>

@include('admin.includes.devicetype.modals.create')
@include('admin.includes.devicetype.modals.delete')
@include('admin.includes.devicetype.modals.update')

@endsection
