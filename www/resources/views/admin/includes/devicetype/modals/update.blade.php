@component('admin.components.modalForm')
    @slot('id', 'update')
    @slot('color', 'info')
    @slot('preloaderColor', 'blue')
    @slot('header')
        <p class="heading"><span class="name"></span> módosítása</p>
    @endslot
    @slot('body')
        @include('admin.includes.devicetype.modals.createAndUpdateForm', ['defaultIcon' => $defaultIcon, '$cons' => $icons, 'iconSelectorPrefix' => 'update'])
    @endslot
    @slot('footer')
        <button type="button" class="btn btn-outline-primary btn-block actions submit">
            Módosítás <i class="fas fa-check ml-1"></i>
        </button>
    @endslot
@endcomponent

<script>
    $(document).ready(function() {
        var modal = "#modalUpdate";
        var form = modal + " form";
        var errorBag = modal + " .error-bag";
        var btn = modal + " .actions.submit";
        var refreshTime = 1500;

        // modal
        $('.actions .edit').click(function() {
            $(modal).attr('data-id', $(this).attr('data-id'));
            $(modal + " input[name='name']").val($(this).attr('data-name'));
            $(modal + " .name").html($(this).attr('data-name'));
            $(modal + " input[name='name']").val($(this).attr('data-name'));

            iconSelectorById(modal, $(this).attr('data-icon_id'), $(this).attr('data-default_icon_id'));

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
                url: '{{route('admin.deviceType.update')}}',
                data: {
                    _token: '{{csrf_token()}}',
                    user_id: '{{Auth::user()->id}}',
                    id: $(modal).attr('data-id'),
                    name: $(modal + " input[name='name']").val(),
                    display_name: $(modal + " input[name='display_name']").val(),
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
