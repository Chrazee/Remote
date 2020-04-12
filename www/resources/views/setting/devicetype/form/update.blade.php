<form class="form update-form" method="post">
    @include('includes.preloader')
    @include('includes.errorBag')
    @include('includes.authorizeFields')
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="name">{{ucfirst(Lang::get('common.name'))}}</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="name" id="name" placeholder="{{ucfirst(Lang::get('common.name'))}}" value="{{$deviceType->name}}" data-original="{{$deviceType->name}}">
        </div>
    </div>
    @include('includes.actionButtons')
</form>
<script>
    $(document).ready(function() {
        $('.update-form').ajaxSubmit({
            url: '{{route('settings.devicetype.update', ['id' => $deviceType->id])}}',
            redirect: '{{route('settings.devicetype.show', ['id' => $deviceType->id])}}'
        });
    });
</script>

