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
                <p class="heading"><span class="name"></span> módosítása</p>
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
                        <input type="text" name="name" class="form-control" placeholder="Név">
                    </div>
                    <div class="form-group mb-4">
                        <textarea name="description" class="form-control" rows="3" placeholder="Leírás"></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <select name="parent_id" class="browser-default custom-select">
                            <option selected disabled>Szülő csoport</option>
                            <option value="-1">Nincs</option>
                            <optgroup label="Csoportok">
                                @foreach($groups as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <div class="icon-selector">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input default" id="modalUpdate_iconRadioDefault" name="iconSelector" checked="">
                                <label class="custom-control-label" for="modalUpdate_iconRadioDefault">Alapértelmezett ikon használata</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input custom" id="modalUpdate_iconRadioCustom" name="iconSelector">
                                <label class="custom-control-label" for="modalUpdate_iconRadioCustom">Saját ikon kiválasztása</label>
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
            $(modal + " .name").html( $(modal).attr('data-name'));
            $(modal + " input[name='name']").val($(modal).attr('data-name'));
            $(modal + " input[name='description']").val($(modal).attr('data-description'));
            $(modal + " select[name='parent_id']").val($(modal).attr('data-parent_id'));
            iconSelectorById(modal, $(modal).attr('data-icon_id'), $(modal).attr('data-default_icon_id'));
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
            alert($(modal + " input[name='name']").val());
            $.ajax({
                type: 'POST',
                url: '{{route('admin.group.update')}}',
                data: {
                    _token: '{{csrf_token()}}',
                    user_id: '{{Auth::user()->id}}',
                    id:  $(modal).attr('data-id'),
                    name: $(modal + " input[name='name']").val(),
                    description: $(modal + " textarea[name='description']").val(),
                    parent_id: $(modal + " select[name='parent_id']").val(),
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
