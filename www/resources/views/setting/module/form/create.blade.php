<form class="form create-form" method="post" enctype="multipart/form-data">
    @include('includes.preloader')
    @include('includes.errorBag')
    @include('includes.authorizeFields')
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="name">{{ucfirst(Lang::get('common.name'))}}</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="name" id="name" placeholder="{{ucfirst(Lang::get('common.name'))}}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="description">{{ucfirst(Lang::get('common.description'))}}</label>
        <div class="col-sm-10">
            <textarea name="description" class="form-control" id="description" rows="3" placeholder="{{ucfirst(Lang::get('common.description'))}}"></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="controller_file">{{ucfirst(Lang::get('common.upload_controller_file'))}}</label>
        <div class="col-sm-10">
            <input type="file" class="form-control-file" id="controller_file" name="controller_file">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="view_file">{{ucfirst(Lang::get('common.upload_view_file'))}}</label>
        <div class="col-sm-10">
            <input type="file" class="form-control-file" id="view_file" name="view_file">
        </div>
    </div>
    @include('includes.addButton')
</form>

<script>
    var form = $('.create-form');
    form.find('.error-bag').errorBag(); // attach errorBag plugin

    form.on( "submit", function(event) {
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: '{{route('settings.module.create')}}',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function() {
                $(form).find(".preloader-container").removeClass('d-none');
                $(form).find('.error-bag').data('errorBag').clear();
                $(form).find(":input").prop("disabled", true);
            },
            success:function(response) {
                $(form).find(".preloader-container").addClass('d-none');
                $(form).find('.error-bag').data('errorBag').print('success', response.message);
                $(form).find(":input").prop("disabled", true);
                setTimeout(function() {
                    window.location.replace('{{route('settings.modules')}}');
                }, 2000);
            },
            error: function(xhr) {
                setTimeout(function() {
                    $(form).find(".preloader-container").addClass('d-none');
                    $(form).find('.error-bag').data('errorBag').print('danger', xhr.responseJSON.message, xhr.responseJSON.errors);
                    $(form).find(":input").prop("disabled", false);
                }, 800);
            }
        });
    });
</script>
