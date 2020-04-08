@extends('layouts.admin', ['title' => $title])

@section('content')

@include('includes.tesaser', ['icon' => '<i class="fa fa-cog"></i>', 'title' => $site_name_admin, 'subTitle' => $title])

<div class="row">
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Oldal</h5>
                <form id="generalForm">
                    @include('includes.alert.formAlert')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="site_name">Oldal neve</label>
                            <input type="text" class="form-control" name="site_name" id="site_name" value="{{$site['site_name']}}" placeholder="Oldal neve">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary ml-0 actions submit">Mentés</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        var form = '#generalForm';
        var errorBag = form + " .error-bag";
        var btn = form + " .actions.submit";
        var refreshTime = 1000;

        $(form).submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '{{route('admin.general.update')}}',
                data: {
                    _token: '{{csrf_token()}}',
                    site_name: $(form + " input[name='site_name']").val(),
                },
                dataType: 'json',
                cache: false,
                beforeSend: function() {
                    setBtnDisabled(btn, true);
                    clearErrorBag(errorBag, true);
                },
                success:function(response) {
                    setFormInputDisabled(form, true);
                    setBtnDisabled(btn, true);
                    printErrorBag(errorBag, 'success', response.message, null);
                    setTimeout(function() {
                        location.reload();
                    }, refreshTime);
                },
                error: function(xhr, status, error) {
                    setBtnDisabled(btn, false);
                    printErrorBag(errorBag, 'danger', xhr.responseJSON.message, xhr.responseJSON.errors);
                }
            });
            $(form + " input:visible:first").focus();
        });
    });
</script>

@endsection
