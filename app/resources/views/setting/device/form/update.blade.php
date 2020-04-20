<form class="form update-form" method="post">
    @include('includes.preloader')
    @include('includes.errorBag')
    @include('includes.authorizeFields')
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="name">{{ucfirst(Lang::get('common.name'))}}</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="name" id="name" placeholder="{{ucfirst(Lang::get('common.name'))}}" value="{{$device->name}}" data-original="{{$device->name}}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="group_id">{{ucfirst(Lang::get('common.group'))}}</label>
        <div class="col-sm-10">
            <select class="browser-default custom-select" name="group_id" id="group_id" data-original="{{$device->group->id}}">
                    @foreach($groups as $item)
                        @if($item->id == $device->group->id)
                            <option selected value="{{$item->id}}">{{$item->name}}</option>
                        @else
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endif
                    @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="type_id">{{ucfirst(Lang::get('common.type'))}}</label>
        <div class="col-sm-10">
            <select class="browser-default custom-select" name="type_id" id="type_id" data-original="{{$device->type->id}}">
                @foreach($types as $item)
                    @if($item->id == $device->type->id)
                        <option selected value="{{$item->id}}">{{$item->name}}</option>
                    @else
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="module_id">{{ucfirst(Lang::get('common.module'))}}</label>
        <div class="col-sm-10">
            <select class="browser-default custom-select" name="module_id" id="module_id" data-original="{{$device->module->id}}">
                @foreach($modules as $item)
                    @if($item->id == $device->module->id)
                        <option selected value="{{$item->id}}">{{$item->name}}</option>
                    @else
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="protocol_id">{{ucfirst(Lang::get('common.protocol'))}}</label>
        <div class="col-sm-10">
            <select class="browser-default custom-select" name="protocol_id" id="protocol_id" data-original="{{$device->protocol->id}}">
                @foreach($protocols as $item)
                    @if($item->id == $device->protocol->id)
                        <option selected value="{{$item->id}}">{{$item->name}}</option>
                    @else
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="address">{{ucfirst(Lang::get('common.address'))}}</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="address" id="address" placeholder="{{ucfirst(Lang::get('common.address'))}}" value="{{$device->address}}" data-original="{{$device->address}}">
        </div>
    </div>
    @include('includes.actionButtons')
</form>
<script>
    $(document).ready(function() {
        $('.update-form').ajaxSubmit({
            url: '{{route('settings.device.update', ['id' => $device->id])}}',
            redirect: '{{route('settings.device.show', ['id' => $device->id])}}'
        });
    });
</script>

