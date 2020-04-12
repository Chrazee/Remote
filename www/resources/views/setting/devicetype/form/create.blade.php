<form class="form create-form" method="post">
    @include('includes.preloader')
    @include('includes.errorBag')
    @include('includes.authorizeFields')
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="name">{{ucfirst(Lang::get('common.name'))}}</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="name" id="name" placeholder="{{ucfirst(Lang::get('common.name'))}}">
        </div>
    </div>
    @include('includes.addButton')
</form>
<script>
    $(document).ready(function() {
        $('.create-form').ajaxSubmit({
            url: '{{route('settings.devicetype.create')}}',
            redirect: '{{route('settings.devicetypes')}}'
        });
    });
</script>
