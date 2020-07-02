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
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="group_id">{{ucfirst(Lang::get('common.group'))}}</label>
        <div class="col-sm-10">
            <select class="browser-default custom-select" name="group_id" id="group_id">
                @foreach($groups as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="type_id">{{ucfirst(Lang::get('common.type'))}}</label>
        <div class="col-sm-10">
            <select class="browser-default custom-select" name="type_id" id="type_id">
                @foreach($types as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="module_id">{{ucfirst(Lang::get('common.module'))}}</label>
        <div class="col-sm-10">
            <select class="browser-default custom-select" name="module_id" id="module_id">
                @foreach($modules as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="protocol_id">{{ucfirst(Lang::get('common.protocol'))}}</label>
        <div class="col-sm-10">
            <select class="browser-default custom-select" name="protocol_id" id="protocol_id">
                @foreach($protocols as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="address">{{ucfirst(Lang::get('common.address'))}}</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="address" id="address" placeholder="{{ucfirst(Lang::get('common.address'))}}">
        </div>
    </div>
    @include('includes.addButton')
</form>
<script>
    $(document).ready(function() {
        $('.create-form').ajaxSubmit({
            url: '{{route('settings.device.create')}}',
            redirect: '{{route('settings.devices')}}'
        });
    });
</script>
