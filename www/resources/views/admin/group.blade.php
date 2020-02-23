@extends('admin.layout.main')

@section('id', 'Adminisztráció')
@section('title', 'Csoport beállítások')

@section('content')
    <select class="browser-default custom-select">
        <option value="-1">Nincs</option>
        @foreach($parentGroups as $parentGroup)
            <option value="{{$parentGroup->id}}">{{$parentGroup->name}}</option>
            @if(count($parentGroup->childs))
                @include('admin.includes.group.childSelect',['childs' => $parentGroup->childs])
            @endif
        @endforeach
    </select>

    <ul>
        @foreach($parentGroups as $parentGroup)
            <li>
                {{ $parentGroup->name }}
                @if(count($parentGroup->childs))
                    @include('admin.includes.group.childList',['childs' => $parentGroup->childs])
                @endif
            </li>
        @endforeach
    </ul>

<div class="row">
    <div class="col-12">
        <div class="card rounded teaser">
            <div class="card-body">
                <div class="row h-100">
                    <div class="col-6 align-self-center teaser-left">
                        <h1><i class="fa fa-user-shield"></i></h1>
                    </div>
                    <div class="col-6 align-self-center teaser-right">
                        <h4><strong>@yield('id')</strong></h4>
                        <h6>@yield('title')</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">

                <div class="row h-100 mb-2">
                    <div class="col-6 text-left align-self-center">
                        <h5 class="card-title mb-0">Összes csoport</h5>
                    </div>
                    <div class="col-6 text-right align-self-center">
                        <a class="btn btn-sm btn-success" id="createNewGroupBtn" data-toggle="modal" data-target="#groupCreate">
                            <i class="fa fa-plus"></i> Létrehoz
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
                                    <td>
                                        {{$group->id}}
                                    </td>
                                    <td>
                                        {{$group->name}}
                                    </td>
                                    <td>
                                        <span title="{{$group->description}}" data-toggle="tooltip" data-placement="left">
                                            {{ str_limit($group->description, 40, '...') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="btn btn-sm btn-info actionEdit" data-toggle="modal" data-target="#groupEdit"
                                              data-group-id="{{$group->id}}" data-group-name="{{$group->name}}" data-group-description="{{$group->description}}">
                                            <a title="{{$group->name}} szerkesztése" data-toggle="tooltip" data-placement="left">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </span>
                                        <span class="btn btn-sm btn-danger actionDelete" data-toggle="modal" data-target="#groupDelete" {{$group->id}}>
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

<div class="modal fade right" id="groupEdit" tabindex="-1" role="dialog" aria-labelledby="groupEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="groupEditLabel"><span id="groupEditTitle"></span> (<span id="groupEditId"></span>) módosítása</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <form id="groupEditForm">
                    <div class="form-group mb-5">
                        <label for="name">Név</label>
                        <input type="text" id="name" name="name" class="form-control" required autofocus>
                    </div>
                    <div class="form-group mb-5">
                        <label for="description">Leírás</label>
                        <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group mb-5">
                        <label for="description">Szülő csoport</label>
                        <select class="browser-default custom-select">
                            <option value="-1" selected>Nincs</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Bezárás <i class="fas fa-times"></i>
                </button>
                <button type="submit" class="btn btn-primary" id="groupEditBtn">
                    <span id="groupEditBtnText">
                        Mentés <i class="fa fa-check"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#groupEdit').on('show.bs.modal', function(e) {
        $(e.currentTarget).find('#groupEditId').html($(e.relatedTarget).data('group-id'));
        $(e.currentTarget).find('#groupEditTitle').html($(e.relatedTarget).data('group-name'));
        $(e.currentTarget).find('#name').val($(e.relatedTarget).data('group-name'));
        $(e.currentTarget).find('#description').val($(e.relatedTarget).data('group-description'));
    });

    $("#groupEditBtn").click(function(e) {
        e.preventDefault();

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: '/admin/group/update',
            data: {
                id:$('#groupEditId').html(),
                name:$('#groupEditForm').find('input[name="name"]').val(),
                description:$('#groupEditForm').find('textarea[name="description"]').val()
            },
            beforeSend: function() {
                $("#groupEditBtn").attr("disabled", "disabled");
                $("#groupEditBtnText").html('Folyamatban... <i class="fas fa-paper-plane"></i>');
                $(".print-error-msg").html("<ul></ul>");
                $(".print-error-msg").css("display:none");
            },
            success:function(response) {
                $("#groupEditBtn").removeAttr("disabled");

                if($.isEmptyObject(response.error)) {
                    printErrorMsg(response.success);
                    $("#groupEditBtnText").html('Mentés <i class="fa fa-check"></i>');
                    $(".print-error-msg").removeClass('alert-danger');
                    $(".print-error-msg").addClass('alert-success');
                    setTimeout(function() {$('#groupEdit').modal('hide');}, 1500);
                    location.reload();

                } else {
                    printErrorMsg(response.error);
                    $("#groupEditBtnText").html('Újrapróbálkozás <i class="fas fa-redo"></i>');
                    $(".print-error-msg").removeClass('alert-success');
                    $(".print-error-msg").addClass('alert-danger');
                }
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                printErrorMsg({error: errorMessage});
                $("#groupEditBtn").removeAttr("disabled");
                $("#groupEditBtnText").html('Újrapróbálkozás <i class="fas fa-redo"></i>');
            }
        });
    });

    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").fadeIn(1000);
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }
</script>

<div class="modal fade right" id="groupCreate" tabindex="-1" role="dialog" aria-labelledby="groupCreateLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="groupCreateLabel">Csoport hozzáadása</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <form id="groupCreateForm">
                    <div class="form-group mb-5">
                        <label for="name">Név</label>
                        <input type="text" id="name" name="name" class="form-control" required autofocus>
                    </div>
                    <div class="form-group mb-5">
                        <label for="description">Leírás</label>
                        <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group mb-5">
                        <label for="description">Szülő csoport</label>
                        <select class="browser-default custom-select">
                            <option value="-1" selected>Nincs</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Bezárás <i class="fas fa-times"></i>
                </button>
                <button type="submit" class="btn btn-primary" id="groupEditBtn">
                    <span id="groupEditBtnText">
                        Létrehoz <i class="fa fa-check"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
   /* var distance = $('#createNewGroupBtn').offset().top;

    $(window).scroll(function() {
        if ( $(this).scrollTop() >= distance ) {
            $('#createNewGroupBtn').addClass('btn-fixed-top');
        } else {
            $('#createNewGroupBtn').removeClass('btn-fixed-top');
        }
    }); */
</script>
@endsection
