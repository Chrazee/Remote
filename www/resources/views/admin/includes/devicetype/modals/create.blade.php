@component('admin.components.modalForm')
    @slot('id', 'create')
    @slot('color', 'info')
    @slot('preloaderColor', 'blue')
    @slot('header')
        <p class="heading">Új eszköz-típus hozzáadása</p>
    @endslot
    @slot('body')
        @include('admin.includes.devicetype.modals.createAndUpdateForm', ['defaultIcon' => $defaultIcon, '$cons' => $icons, 'iconSelectorPrefix' => 'create'])
    @endslot
    @slot('footer')
        <button type="button" class="btn btn-outline-primary btn-block actions submit">
            Létrehozás <i class="fas fa-check ml-1"></i>
        </button>
    @endslot
@endcomponent

<script>
    $(document).ready(function() {
        var modal = "#modalCreate";
        var form = modal + " form";
        var errorBag = modal + " .error-bag";
        var btn = modal + " .actions.submit";
        var refreshTime = 1500;

        // modal
        $('.actions .create').click(function() {
            $(modal).modal("show");
        });
        $(modal).on('shown.bs.modal', function () {
            $(modal + " input:visible:first").focus();
        });
        $(modal).on('hidden.bs.modal', function () {
            clearErrorBag(errorBag, true);
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
                    user_id: '{{Auth::user()->id}}',
                    name: $(modal + " input[name='name']").val(),
                    icon_id: iconSelectorValue(modal),
                },
                beforeSend: function() {
                    showModalPreloader(modal);
                    setBtnDisabled(btn);
                    clearErrorBag(errorBag, true);
                },
                success:function(response) {
                    hideModalPreloader(modal);
                    setFormInputDisabled(form, true);
                    setBtnDisabled(btn, true);
                    printErrorBag(errorBag, 'success', response.message, null);
                    setTimeout(function() {
                        location.reload();
                    }, refreshTime);
                },
                error: function(xhr, status, error) {
                    hideModalPreloader(modal);
                    setBtnDisabled(btn, false);
                    printErrorBag(errorBag, 'danger', xhr.responseJSON.message, xhr.responseJSON.errors);
                }
            });
        });
    });
</script>
