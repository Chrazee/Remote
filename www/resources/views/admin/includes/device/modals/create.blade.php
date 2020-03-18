<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
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
                <p class="heading">Új eszköz-típus hozzáadása</p>
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
                        <input type="text" name="name" class="form-control" placeholder="Típus">
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" name="display_name" class="form-control" placeholder="Megjelenített név">
                    </div>
                    <div class="form-group mb-4">
                        <div class="icon-selector">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input default" id="modalCreate_iconRadioDefault" name="iconSelector" checked="">
                                <label class="custom-control-label" for="modalCreate_iconRadioDefault">Alapértelmezett ikon használata</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input custom" id="modalCreate_iconRadioCustom" name="iconSelector" required="">
                                <label class="custom-control-label" for="modalCreate_iconRadioCustom">Saját ikon kiválasztása</label>
                            </div>
                            <div class="collapse collapse-default">
                                @include('admin.includes.iconSelector', ['showOnlyDefault' => true, 'icons' => $defaultIcon,])
                            </div>
                            <div class="collapse collapse-custom">
                                @include('admin.includes.iconSelector', [ 'showOnlyDefault' => false, 'icons' => $icons, 'defaultIcon' => $defaultIcon])
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-outline-primary btn-block submit-btn">
                    Létrehozás <i class="fas fa-check ml-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var modal = "#modalCreate";
        var errorBag = modal + " .error-bag";
        var btn = modal + " .submit-btn";

        // modal
        $('.actions .create').click(function() {
            $(modal).modal("show");
        });
        $(modal).on('shown.bs.modal', function () {
            $(modal + " input:visible:first").focus();
        });
        $(modal).on('hidden.bs.modal', function () {
            clearErrorBag(errorBag);
        });

        // initialize icon selector
        iconSelector(modal);

        // submit
        $(btn).click(function() {
            $.ajax({
                type: 'POST',
                url: '{{route('admin.deviceType.create')}}',
                data: {
                    _token: '{{csrf_token()}}',
                    name: $(modal + " input[name='name']").val(),
                    display_name: $(modal + " input[name='display_name']").val(),
                    icon_id: iconSelectorValue(modal),
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
