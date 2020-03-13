<div class="modal fade right" id="groupEditModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="heading lead"><span id="groupEditTitle"></span> (<span id="groupEditId"></span>) módosítása</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert" id="dataLoadErrorBag" style="display:none">
                    <ul></ul>
                </div>
                <div id="dataLoad" class="h-100" style="display:none">
                    <div class="text-center d-flex align-items-center justify-content-center h-100">
                        <div class="d-flex flex-column">
                        <i class="fas fa-circle-notch fa-spin fa-4x mb-2"></i>
                        <p><i>Adatok betöltése...</i></p>
                        </div>
                    </div>
                </div>
                <form id="groupEditForm">
                    <div class="alert" id="groupEditErrorBag" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="form-group mb-4">
                        <label for="groupEditName">Név</label>
                        <input type="text" id="groupEditName" name="groupEditName" class="form-control">
                    </div>
                    <div class="form-group mb-4">
                        <label for="groupEditDesc">Leírás</label>
                        <textarea id="groupEditDesc" name="groupEditDesc" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="groupEditGroups">Szülő csoport</label>
                        <select class="browser-default custom-select" id="groupEditGroups" name="groupEditGroups">
                            <option value="-1" selected>Nincs</option>
                            <optgroup label="Csoportok">
                                @foreach($groups as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="iconRadioDefault">Ikon</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="groupEditIconRadioDefault" name="groupEditIconRadio" value="-1" checked required>
                            <label class="custom-control-label" for="groupEditIconRadioDefault">Alapértelmezett ikon használata</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="groupEditIconRadioCustom" name="groupEditIconRadio" required>
                            <label class="custom-control-label" for="groupEditIconRadioCustom">Saját ikon kiválasztása</label>
                        </div>
                        <div class="collapse collapse-icons" id="groupEditIconCollapse">
                            <div class="mt-3">
                                <select id="groupEditIconSelect" class="image-picker">
                                    <option value="-1" id="groupEditDefaultIconOption"></option>
                                    @foreach($icons as $icon)
                                        <option data-img-src="{{asset('assets/imgs/icons')}}/{{$icon->name}}" value="{{$icon->id}}">{{$icon->id}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-info waves-effect waves-light" id="groupEditBtn" disabled>
                    Mentés <i class="fas fa-check ml-1 text-white"></i>
                </button>
                <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">
                    Bezárás
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var modal = "#groupEditModal";
        var form = "#groupEditForm";
        var dataLoadErrorBag = "#dataLoadErrorBag";
        var submitBtn = "#groupEditBtn";

        $('#groupEditIconRadioDefault').click(function() {
            setIconsToDefault('#groupEditForm');
        });
        $('#groupEditIconRadioCustom').click(function() {
            $('#groupEditModal .collapse-icons').collapse('show');
        });

        $(modal).on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('group-id');
            $(e.currentTarget).find('#groupEditTitle').html($(e.relatedTarget).data('group-name'));
            $(e.currentTarget).find('#groupEditId').html(id);

            $.ajax({
                type: 'POST',
                url: '{{route('admin.groupGet')}}',
                data: {
                    _token: '{{csrf_token()}}',
                    id: id,
                },
                beforeSend: function() {
                    $(form).hide();
                    $('#dataLoad').show();
                    clearErrorBag(dataLoadErrorBag);
                    setBtnDisabled(submitBtn, true);
                },
                success:function(response) {
                    setTimeout(function() {
                        if($.isEmptyObject(response.error)) {
                            $(form).fadeIn(500);
                            $('#dataLoad').hide();
                            setBtnDisabled(submitBtn, false);
                            $('#groupEditName').val(response.success.group.name);
                            $('#groupEditDesc').val(response.success.group.description);

                            if(response.success.group.parent_id != "-1") {
                                $('#groupEditGroups').val(response.success.group.parent_id);
                            }

                            if(response.success.defaultIcon) {
                                $('#groupEditIconRadioDefault').prop("checked", true);
                                $('#groupEditIconRadioCustom').prop("checked", false);
                            } else {
                                $('#groupEditIconRadioDefault').prop("checked", false);
                                $('#groupEditIconRadioCustom').prop("checked", true);
                                $('#groupEditModal .collapse-icons').collapse('show');
                                $('#groupEditIconSelect').val(response.success.group.icon_id);
                            }
                            $('#groupEditIconSelect').imagepicker();
                        } else {
                            printErrorBag(dataLoadErrorBag, response.error, 'danger');
                            $(form).hide();
                            $('#dataLoad').hide();
                            setBtnDisabled(submitBtn, true);
                        }
                    }, 250);
                },
                error: function(xhr, status, error) {
                    printErrorBag(dataLoadErrorBag, {error: xhr.status + ': ' + xhr.statusText}, 'danger');
                    $(form).hide();
                    $('#dataLoad').hide();
                    setBtnDisabled(submitBtn, true);
                }
            });
        });
        $('#groupEditModal').on('hidden.bs.modal', function () {
            $('#groupEditForm')[0].reset();
        });

        var errorBag = "#groupEditErrorBag";
        var btnText = {
            'default': 'Létrehozás <i class="fa fa-check"></i>',
            'beforeSend': 'Folyamatban <i class="fas fa-circle-notch fa-spin"></i>',
            'onError': 'Újrapróbálkozás <i class="fas fa-redo"></i>',
        };

        $(submitBtn).click(function() {
            $.ajax({
                type: 'POST',
                url: '{{route('admin.groupUpdate')}}',
                data: {
                    _token: '{{csrf_token()}}',
                    id: $('#groupEditId').html(),
                    name: $('#groupEditName').val(),
                    description: $('#groupEditDesc').val(),
                    groupId: $('#groupEditGroups').val(),
                    iconId: $('#groupEditIconSelect').val(),
                },
                beforeSend: function() {
                    setBtn(submitBtn, true, btnText['beforeSend']);
                    clearErrorBag(errorBag);
                },
                success:function(response) {
                    if($.isEmptyObject(response.error)) {
                        printErrorBag(errorBag, response.success, 'success');
                        setTimeout(function() {
                            setBtn(submitBtn, true, btnText['default']);
                            location.reload();
                        }, 1500);
                    } else {
                        setBtn(submitBtn, false, btnText['onError']);
                        printErrorBag(errorBag, response.error, 'danger');
                    }
                },
                error: function(xhr, status, error) {
                    setBtn(submitBtn, false, btnText['onError']);
                    printErrorBag(errorBag, {error: xhr.status + ': ' + xhr.statusText}, 'danger');
                }
            });
        });
    });
</script>
