<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
        <div class="modal-content">
            <div class="checkout-preloader-container d-none">
                <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-header">
                <p class="heading"><span class="display_name"></span> módosítása</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">×</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="alert error-bag" style="display:none">
                    <ul></ul>
                </div>
                <form>
                    <div class="form-group mb-4">
                        <input type="text" name="display_name" class="form-control" placeholder="Név">
                    </div>
                    <div class="form-group mb-4">
                        <select name="group_id" class="browser-default custom-select">
                            <option selected disabled>Csoport</option>
                            @foreach($groups as $group)
                                <option value="{{$group->id}}">{{$group->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <select name="type_id" class="browser-default custom-select">
                            <option selected disabled>Típus</option>
                            @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->display_name}} ({{$type->name}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <input type="number" name="ip" class="form-control" placeholder="IP cím">
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-outline-primary btn-block submit-btn">
                    Módosítás <i class="fas fa-check ml-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var modal = "#modalUpdate";
        var errorBag = modal + " .error-bag";
        var btn = modal + " .submit-btn";

        // modal
        $('.actions .edit').click(function() {
            $(modal).attr('data-id', $(this).attr('data-id'));
            $(modal + " input[name='display_name']").val($(this).attr('data-display_name'));
            $(modal + " .display_name").html($(this).attr('data-display_name'));
            $(modal + " select[name='group_id']").val($(this).attr('data-group_id'));
            $(modal + " select[name='type_id']").val($(this).attr('data-type_id'));
            $(modal + " input[name='ip']").val($(this).attr('data-ip'));

            $(modal).modal("show");
        });
        $(modal).on('shown.bs.modal', function () {
            $(modal + " input:visible:first").focus();
        });
        $(modal).on('hidden.bs.modal', function () {
            clearErrorBag(errorBag);
        });

        // submit
        $(btn).click(function() {
            $.ajax({
                type: 'POST',
                url: '{{route('admin.device.update')}}',
                data: {
                    _token: '{{csrf_token()}}',
                    user_id: '{{Auth::user()->id}}',
                    id:  $(modal).attr('data-id'),
                    display_name: $(modal + " input[name='display_name']").val(),
                    group_id: $(modal + " select[name='group_id']").val(),
                    type_id: $(modal + " select[name='type_id']").val(),
                    ip: $(modal + " input[name='ip']").val(),
                },
                beforeSend: function() {
                    showModalPreloader(modal);
                    setBtnDisabled(btn);
                    clearErrorBag(errorBag);
                },
                success:function(response) {
                    setTimeout(function() {
                        hideModalPreloader(modal);
                        setBtnDisabled(btn, false);
                        if($.isEmptyObject(response.error)) {
                            printErrorBag(errorBag, response.success, 'success');
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            printErrorBag(errorBag, response.error, 'danger');
                        }
                    }, 500);
                },
                error: function(xhr, status, error) {
                    hideModalPreloader(modal);
                    setBtnDisabled(btn, false);
                    printErrorBag(errorBag, {error: xhr.status + ': ' + xhr.statusText}, 'danger');
                }
            });
        });
    });
</script>
