@component('admin.components.modalForm')
    @slot('id', 'delete')
    @slot('color', 'danger')
    @slot('preloaderColor', 'red')
    @slot('header')
        <p class="heading"><span class="name"></span> törlése</p>
    @endslot
    @slot('body')
        <div class="row">
            <div class="col-3">
                <p class="text-center">
                    <i class="fas fa-trash fa-4x"></i>
                </p>
            </div>
            <div class="col-9">
                @include('includes.form.errorBag.blade.php')
                <p>Biztosan törlöd az eszközt?</p>
                <h2>
                    <span class="badge">Azonosító: <span class="id"></span></span>
                </h2>
            </div>
        </div>
    @endslot
    @slot('footer')
        <button type="button" class="btn btn-outline-danger btn-block actions submit">
            Törlés <i class="fas fa-trash ml-1"></i>
        </button>
    @endslot
@endcomponent

<script>
    $(document).ready(function() {
        var modal = "#modalDelete";
        var errorBag = modal + " .error-bag";
        var btn = modal + " .actions.submit";
        var refreshTime = 1500;

        // modal
        $('.actions .delete').click(function() {
            $(modal).modal("show");
            $(modal + " .id").html($(this).attr('data-id'));
            $(modal + " .display_name").html( $(this).attr('data-display_name'));
        });
        $(modal).on('hidden.bs.modal', function () {
            clearErrorBag(errorBag, true);
        });

        // submit
        $(btn).click(function() {
            $.ajax({
                type: 'POST',
                url: '{{route('admin.device.delete')}}',
                data: {
                    _token: '{{csrf_token()}}',
                    id: $(modal + " .id").html(),
                },
                beforeSend: function() {
                    showModalPreloader(modal);
                    setBtnDisabled(btn);
                    clearErrorBag(errorBag, true);
                },
                success:function(response) {
                    hideModalPreloader(modal);
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
