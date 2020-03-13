@foreach($icons as $icon)
    <div class="col-lg-3 col-md-4 col-6 icon-box">
        <img class="img-fluid img-thumbnail" src="{{asset('assets/imgs/icons')}}/{{$icon->name}}">
        <div class="icon-box-visible-element">
            @if($icon->default)
                <span class="btn btn-blue-grey btn-sm" data-toggle="tooltip" data-placement="top" title="Alapértelmezett ikon">
                    <i class="fa fa-check"></i>
                </span>
            @endif
        </div>
        <div class="icon-box-overlay-element">
            @if(!$icon->default)
                <span class="btn btn-blue btn-sm" data-toggle="modal" data-target="#iconDefaultModal" data-icon-id-default="{{$icon->id}}">
                    <a title="Beállítás alapértelmezettként" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-check"></i>
                    </a>
                </span>
                <span class="btn btn-danger btn-sm" data-toggle="modal" data-target="#iconDeleteModal" data-icon-id="{{$icon->id}}">
                    <a title="Ikon törlése" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-trash"></i>
                    </a>
                </span>
            @endif
        </div>
    </div>
@endforeach

<div class="modal fade" id="iconDeleteModal" tabindex="-1" role="dialog" aria-labelledby="iconDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-danger" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="heading">Ikon törlése</p>
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
                        <div class="alert" id="iconDeleteErrorBag" style="display:none">
                            <ul></ul>
                        </div>
                        <p>Amennyiben az ikon használatban van és törlése kerül, akkor az alapértelmezett ikon kerül a helyére.</p>
                        <h2>
                            <span class="badge">Azonosító: <span id="iconId"></span></span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger waves-effect waves-light" id="iconDeleteBtn">
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
    var iconDeleteModal = "#iconDeleteModal";
    var iconDeleteBtn = "#iconDeleteBtn";
    var iconDeleteErrorBag = "#iconDeleteErrorBag";
    var iconDeleteBtnText = {
        'default': 'Törlés <i class="fa fa-trash"></i>',
        'beforeSend': 'Folyamatban <i class="fas fa-paper-plane"></i>',
        'onError': 'Újrapróbálkozás <i class="fas fa-redo"></i>',
    };

    $(iconDeleteModal).on('show.bs.modal', function(e) {
        $(e.currentTarget).find('#iconId').html($(e.relatedTarget).data('icon-id'));
    });

    $(iconDeleteModal).on('hidden.bs.modal', function () {
        clearErrorBag(iconDeleteErrorBag);
        setBtnText(iconDeleteBtn, iconDeleteBtnText['default']);
    });

    $(iconDeleteBtn).click(function() {
        $.ajax({
            type: 'POST',
            url: '{{route('admin.iconDelete')}}',
            data: {
                _token: '{{csrf_token()}}',
                id: $('#iconId').html(),
                type: '{{$iconType}}'
            },
            beforeSend: function() {
                setBtn(iconDeleteBtn, true, iconDeleteBtnText['beforeSend']);
                clearErrorBag(iconDeleteErrorBag);
            },
            success:function(response) {
                setBtnDisabled(iconDeleteBtn, false);
                if($.isEmptyObject(response.error)) {
                    setBtnText(iconDeleteBtn, iconDeleteBtnText['default']);
                    printErrorBag(iconDeleteErrorBag, response.success, 'success');
                    setTimeout(function() {
                        $(iconDeleteModal).modal('hide');
                    }, 5000);
                    location.reload();
                } else {
                    setBtnText(iconDeleteBtn, iconDeleteBtnText['onError']);
                    printErrorBag(iconDeleteErrorBag, response.error, 'danger');
                }
            },
            error: function(xhr, status, error) {
                setBtn(iconDeleteBtn, false, iconDeleteBtnText['onError']);
                printErrorBag(iconDeleteErrorBag, {error: xhr.status + ': ' + xhr.statusText}, 'danger');
            }
        });
    });
</script>

<div class="modal fade" id="iconDefaultModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <p></p>
                        <p class="text-center">
                            <i class="fas fa-circle-notch fa-spin fa-4x"></i>
                        </p>
                    </div>
                    <div class="col-9">
                        <div class="alert" id="iconDefaulterrorBag" style="display:none">
                            <ul></ul>
                        </div>
                        <p>Beállítás alapértelmezettként</p>
                        <h2>
                            <span class="badge">Azonosító: <span id="iconDefaultId"></span></span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var iconDefaultModal = "#iconDefaultModal";
    var iconDefaultErrorBag = "#iconDefaulterrorBag";

    $(iconDefaultModal).on('show.bs.modal', function(e) {
        $(e.currentTarget).find('#iconDefaultId').html($(e.relatedTarget).data('icon-id-default'));
        $.ajax({
            type: 'POST',
            url: '{{route('admin.iconDefault')}}',
            data: {
                _token: '{{csrf_token()}}',
                id: $('#iconDefaultId').html(),
                type: '{{$iconType}}'
            },
            success:function(response) {
                if($.isEmptyObject(response.error)) {
                    printErrorBag(iconDefaultErrorBag, response.success, 'success');
                    location.reload();
                } else {
                    printErrorBag(iconDefaultErrorBag, response.error, 'danger');
                }
            },
            error: function(xhr, status, error) {
                printErrorBag(iconDefaultErrorBag, {error: xhr.status + ': ' + xhr.statusText}, 'danger');
            }
        });
    });

    $(iconDefaultModal).on('hidden.bs.modal', function () {
        clearErrorBag(iconDefaulterrorBag);
    });
</script>
