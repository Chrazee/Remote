<div class="modal fade" id="groupDeleteModal" tabindex="-1" role="dialog" aria-hidden="true" data-id="">
    <div class="modal-dialog modal-notify modal-danger" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="heading">Csoport törlése</p>
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
                        <p>Biztosan törlöd a csoportot?</p>
                        <div class="alert error-bag" style="display:none">
                            <ul></ul>
                        </div>
                        <h2>
                            <span class="badge">Azonosító: <span class="group-id"></span></span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger waves-effect waves-light submit-btn">
                    Törlés
                    <i class="fas fa-trash ml-1 text-white"></i>
                </button>
                <button type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">
                    Mégsem
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var modal = "#groupDeleteModal";
        var errorBag = modal + ' .error-bag';
        var btn = modal + ' .submit-btn';
        var btnText = {
            'default': 'Törlés  <i class="fas fa-trash ml-1 text-white"></i>',
            'beforeSend': 'Folyamatban <i class="fas fa-circle-notch fa-spin"></i>',
            'onError': 'Újrapróbálkozás <i class="fas fa-redo"></i>',
        };

        $(modal).on('show.bs.modal', function(e) {
            $(e.currentTarget).attr('data-id', $(e.relatedTarget).data('group-id'));
            $(e.currentTarget).find('.group-id').html($(e.relatedTarget).data('group-id'));
        });
        $(modal).on('hidden.bs.modal', function () {
            clearErrorBag(errorBag);
            setBtn(btn, false, btnText['default']);
        });

        $(btn).click(function () {
            $.ajax({
                type: 'POST',
                url: '{{route('admin.groupDelete')}}',
                data: {
                    _token: '{{csrf_token()}}',
                    id: $(modal).find('.group-id').html()
                },
                beforeSend: function() {
                    setBtn(btn, true, btnText['beforeSend']);
                    clearErrorBag(errorBag);
                },
                success:function(response) {
                    if($.isEmptyObject(response.error)) {
                        printErrorBag(errorBag, response.success, 'success');
                        setTimeout(function() {
                            setBtn(btn, true, btnText['default']);
                            location.reload();
                        }, 1500);
                    } else {
                        setBtn(btn, false, btnText['onError']);
                        printErrorBag(errorBag, response.error, 'danger');
                    }
                },
                error: function(xhr, status, error) {
                    setBtn(btn, false, btnText['onError']);
                    printErrorBag(errorBag, {error: xhr.status + ': ' + xhr.statusText}, 'danger');
                }
            });
        });
    });
</script>
