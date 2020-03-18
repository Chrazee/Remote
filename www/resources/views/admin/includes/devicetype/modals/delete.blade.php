<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-danger" role="document">
        <div class="modal-content">
            <div class="checkout-preloader-container d-none">
                <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-red-only">
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
                <p class="heading">Eszköz típus törlése</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <p class="text-center">
                            <i class="fas fa-trash fa-4x"></i>
                        </p>
                    </div>
                    <div class="col-9">
                        <div class="alert error-bag" style="display:none">
                            <ul></ul>
                        </div>
                        <p>Biztosan törlöd az eszköz-típust?</p>
                        <h2>
                            <span class="badge">Azonosító: <span class="id"></span></span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-outline-danger btn-block submit-btn">
                    Törlés <i class="fas fa-trash ml-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var modal = "#modalDelete";
        var errorBag = modal + " .error-bag";
        var btn = modal + " .submit-btn";

        // modal
        $('.actions .delete').click(function() {
            var id = $(this).attr('data-id');
            if(id !== '-1' || id !== '') {
                $(modal).modal("show");
                $(modal + " .id").html(id);
            }
        });
        $(modal).on('hidden.bs.modal', function () {
            clearErrorBag(errorBag);
        });

        // submit
        $(btn).click(function() {
            $.ajax({
                type: 'POST',
                url: '{{route('admin.deviceType.delete')}}',
                data: {
                    _token: '{{csrf_token()}}',
                    id: $(modal + " .id").html(),
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
