<div class="modal fade confirm-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-danger" role="document">
        <div class="modal-content">
            <form class="confirm-delete-form form" method="post">
                @include('includes.preloader')
                @include('includes.authorizeFields')
                <input type="hidden" name="id" value="{{$id}}">
                <div class="modal-header">
                    <p class="heading">{{$title}}</p>
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
                                <span class="badge">{{ucfirst(Lang::get('common.identifier'))}}: {{$id}}</span>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-danger btn-block">
                        {{Lang::get('common.yes_delete')}}
                    </button>
                </div>
            </form>
            <script>
                $(document).ready(function() {
                    $('.confirm-delete-form').ajaxSubmit({
                        url: '{{$url}}',
                        redirect: '{{$redirect}}'
                    });
                });
            </script>
        </div>
    </div>
</div>
