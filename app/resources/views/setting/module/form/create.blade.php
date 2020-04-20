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
        <label class="col-sm-2 col-form-label" for="view_file">{{ucfirst(Lang::get('common.upload_view_file'))}} ({{env('MODULE_VIEW_EXTENSION')}})</label>
        <div class="col-sm-10">
            <input type="file" class="form-control-file" id="view_file" name="view_file">
        </div>
    </div>
    @include('includes.addButton')
</form>

<script>
    $(document).ready(function() {
        $('.create-form').ajaxSubmit({
            url: '{{route('settings.module.create')}}',
            redirect: '{{route('settings.modules')}}',
            withFile: true,
        });
    });
</script>
