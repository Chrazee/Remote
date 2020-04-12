<form class="form update-form" method="post">
    @include('includes.preloader')
    @include('includes.errorBag')
    @include('includes.authorizeFields')
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="name">{{ucfirst(Lang::get('common.name'))}}</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="name" id="name" placeholder="{{ucfirst(Lang::get('common.name'))}}" value="{{$module->name}}" data-original="{{$module->name}}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="description">{{ucfirst(Lang::get('common.description'))}}</label>
        <div class="col-sm-10">
            <textarea name="description" class="form-control" id="description" rows="3" placeholder="{{ucfirst(Lang::get('common.description'))}}" data-original="{{$module->description}}">{{$module->description}}</textarea>
        </div>
    </div>
    @include('includes.actionButtons')
</form>
<script>
    $(document).ready(function() {
        $('.update-form').ajaxSubmit({
            url: '{{route('settings.module.update', ['id' => $module->id])}}',
            redirect: '{{route('settings.module.show', ['id' => $module->id])}}'
        });
    });
</script>

