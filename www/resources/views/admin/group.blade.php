@extends('layouts.admin', ['title' => $title])

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
                <span class="white-text mx-3">Csoportok</span>
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
                <div class="group-tree-box">
                    <ul class="group-tree">
                        @foreach($parentGroups as $i)
                            <li>
                                <a data-id="{{$i->id}}" data-parent_id="{{$i->parent_id}}" data-user_id="{{$i->user_id}}" data-icon_id="{{$i->icon_id}}" data-name="{{$i->name}}" data-description="{{$i->description}}" data-default_icon_id="{{$defaultIcon->id}}">
                                    <span data-toggle="tooltip" data-placement="top" title="{{$i->description}}">{{$i->name}}</span>
                                    <img class="group-tree-icon" src="{{asset('assets/imgs/icons')}}/{{$i->icon->name}}">
                                </a>
                                @if(count($i->childs))
                                    @include('admin.includes.group.childList',['childs' => $i->childs])
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        /*$(document).mouseup(function(e) {
            var container = $(".group-tree");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                $(".group-tree a").removeClass('group-tree-selected');
                setBtnDisabled('.actions .delete', true);
                setBtnDisabled('.actions .edit', true);
                $('#modalEdit').removeData();
                $('#modalDelete').removeData();
            }
        });*/

        $(".group-tree a").click(function() {
            parseData($(this), "#modalUpdate");
            parseData($(this), "#modalDelete");

            $(".group-tree a").removeClass('group-tree-selected');
            $(this).addClass('group-tree-selected');

            setBtnDisabled('.actions .delete', false);
            setBtnDisabled('.actions .edit', false);
        });
    });
</script>
@include('admin.includes.group.modals.create')
@include('admin.includes.group.modals.update')
@include('admin.includes.group.modals.delete')


@endsection
