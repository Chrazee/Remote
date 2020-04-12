<div class="row">
    <div class="col-12 mt-4">
        <div class="card card-cascade wider">
            <div class="view view-cascade gradient-card-header bg-primary narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                <div class="actions">
                </div>
                <span class="white-text mx-3">{{$title}}</span>
                <div class="actions">
                    <a href="{{$route_create}}" title="{{ucfirst(Lang::get('common.create_new'))}}" data-toggle="tooltip" data-placement="top" type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
                        <i class="fas fa-plus mt-0"></i>
                    </a>
                </div>
            </div>
            <div class="px-4 py-2">
                <form class="form update-form" method="post" action="{{$form_action}}">
                    @include('includes.preloader')
                    @include('includes.errorBag')
                    {{ csrf_field() }}
                    {!!$form_fields !!}
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-outline-primary btn-rounded btn-md px-3 action-save" disabled>
                                <i class="fas fa-check"></i> {{Lang::get('common.save')}}
                            </button>
                            <button type="button" class="btn btn-outline-grey btn-rounded btn-md px-3"  data-toggle="modal" data-target=".confirm-delete">
                                <i class="fas fa-trash-alt"></i> {{Lang::get('common.delete')}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal fade confirm-delete" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-notify modal-danger" role="document">
                    <div class="modal-content">
                        <form class="confirm-delete-form form" method="post" action="{{$confirmDelete_action}}">
                            @include('includes.preloader')
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$confirmDelete_id}}">
                            <div class="modal-header">
                                <p class="heading">{{$confirmDelete_title}}</p>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="white-text">×</span>
                                </button>
                            </div>
                            <div class="modal-body mx-3">
                                <div class="row">
                                    <div class="col-3">
                                        <p class="text-center">
                                            <i class="fas fa-trash fa-4x"></i>
                                        </p>
                                    </div>
                                    <div class="col-9">
                                        @include('includes.errorBag')
                                        <p>{{ucfirst(Lang::get('common.are_you_sure_you_want_to_delete'))}}</p>
                                        <h2>
                                            <span class="badge">{{ucfirst(Lang::get('common.identifier'))}}: {{$confirmDelete_id}}</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="submit" class="btn btn-outline-danger btn-block">
                                    {{Lang::get('common.yes_delete')}}
                                </button>
                            </div>
                        <form>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $('.update-form').ajaxSubmit({
                        url: '{{$form_action}}',
                        redirect: '{{$form_redirect}}'
                    });

                    $('.confirm-delete-form').ajaxSubmit({
                        url: '{{$confirmDelete_action}}',
                        redirect: '{{$confirmDelete_redirect}}'
                    });
                });
            </script>
        </div>
    </div>
</div>
