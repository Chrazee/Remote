<div class="modal fade right" id="groupCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right modal-notify modal-success" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="heading lead">Csoport létrehozása</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert" id="groupCreateErrorBag" style="display:none">
                    <ul></ul>
                </div>
                <form id="groupCreateForm">
                    <div class="form-group mb-4">
                        <label for="name">Név</label>
                        <input type="text" id="groupCreateName" name="groupCreateName" class="form-control">
                    </div>
                    <div class="form-group mb-4">
                        <label for="description">Leírás</label>
                        <textarea id="groupCreateDesc" name="groupCreateDesc" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="iconRadioDefault">Ikon</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="iconRadioDefault" name="iconRadio" value="-1" checked required>
                            <label class="custom-control-label" for="iconRadioDefault">Alapértelmezett ikon használata</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="iconRadioCustom" name="iconRadio" required>
                            <label class="custom-control-label" for="iconRadioCustom">Saját ikon kiválasztása</label>
                        </div>
                        <div class="collapse collapse-icons">
                            <div class="mt-3">
                                <select id="iconSelect" class="image-picker">
                                    <option value="-1" id="defaultIconOption"></option>

                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-success waves-effect waves-light" id="groupCreateBtn">
                    Létrehozás <i class="fas fa-check ml-1 text-white"></i>
                </button>
                <a type="button" class="btn btn-outline-success waves-effect" data-dismiss="modal">
                    Bezárás
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var modal = "#groupCreateModal";
        var btn = "#groupCreateBtn";
        var errorBag = "#groupCreateErrorBag";
        var btnText = {
            'default': 'Létrehozás <i class="fa fa-check"></i>',
            'beforeSend': 'Folyamatban <i class="fas fa-circle-notch fa-spin"></i>',
            'onError': 'Újrapróbálkozás <i class="fas fa-redo"></i>',
        };
        var iconSelect = "#iconSelect";
        var collapse = modal + " .collapse-icons";

        $(modal).on('show.bs.modal', function(e) {
            $('input:text:visible:first', this).focus();
        });
        $(modal).on('hidden.bs.modal', function () {
            $('#groupCreateForm')[0].reset();
            clearErrorBag(errorBag);
            setIconsToDefault('#groupCreateForm');
            setBtn(btn,false, btnText['default']);
        });

        $(iconSelect).imagepicker();
        $('#iconRadioDefault').click(function() {
            setIconsToDefault('#groupCreateForm');
        });
        $('#iconRadioCustom').click(function() {
            $(collapse).collapse('show');
        });

        $(btn).click(function() {
            $.ajax({
                type: 'POST',
                url: '{{route('admin.groupCreate')}}',
                data: {
                    _token: '{{csrf_token()}}',
                    name: $('#groupCreateName').val(),
                    description: $('#groupCreateDesc').val(),
                    groupId: $('#groupCreateGroupId').val(),
                    iconId: $(iconSelect).val(),
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
