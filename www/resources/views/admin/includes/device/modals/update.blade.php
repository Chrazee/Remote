@component('admin.components.modalForm')
    @slot('id', 'update')
    @slot('color', 'info')
    @slot('preloaderColor', 'blue')
    @slot('header')
        <p class="heading"><span class="name"></span> módosítása</p>
    @endslot
    @slot('body')
        @include('admin.includes.device.modals.createAndUpdateForm', ['groups' => $groups, 'types' => $types, ['modules' => $modules, 'protocols' => $protocols]])
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
            $(modal + " select[name='group_id']").val($(this).attr('data-group_id'));
            $(modal + " select[name='type_id']").val($(this).attr('data-type_id'));
            $(modal + " select[name='module_id']").val($(this).attr('data-module_id'));
            $(modal + " select[name='protocol_id']").val($(this).attr('data-protocol_id'));
            $(modal + " input[name='address']").val($(this).attr('data-address'));

            $(modal).modal("show");
        });
        $(modal).on('shown.bs.modal', function () {
            $(modal + " input:visible:first").focus();
        });
        $(modal).on('hidden.bs.modal', function () {
            clearErrorBag(errorBag, true);
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
                    name: $(modal + " input[name='name']").val(),
                    group_id: $(modal + " select[name='group_id']").val(),
                    type_id: $(modal + " select[name='type_id']").val(),
                    module_id: $(modal + " select[name='module_id']").val(),
                    protocol_id: $(modal + " select[name='protocol_id']").val(),
                    address: $(modal + " input[name='address']").val(),
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
