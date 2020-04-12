<form>
    @include('includes.form.errorBag.blade.php')
    <div class="form-group mb-4">
        <input type="text" name="name" class="form-control" placeholder="Név">
    </div>
    <div class="input-group mb-4">
        <select name="group_id" class="browser-default custom-select">
            <option selected disabled>Csoport</option>
            @foreach($groups as $group)
                <option value="{{$group->id}}">{{$group->name}}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <a href="{{route('admin.group')}}" class="input-group-text" data-toggle="tooltip" data-placement="left" title="Csoportok">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>
    <div class="input-group mb-4">
        <select name="type_id" class="browser-default custom-select">
            <option selected disabled>Típus</option>
            @foreach($types as $type)
                <option value="{{$type->id}}">{{$type->name}}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <a href="{{route('admin.deviceType')}}" class="input-group-text" data-toggle="tooltip" data-placement="left" title="Eszköz-típusok">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>
    <div class="input-group mb-4">
        <select name="module_id" class="browser-default custom-select">
            <option selected disabled>Modul</option>
            @foreach($modules as $module)
                <option value="{{$module->id}}">{{$module->name}}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <a href="{{route('admin.modules')}}" class="input-group-text" data-toggle="tooltip" data-placement="left" title="Modulok">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>
    <div class="input-group mb-4">
        <div class="input-group-prepend">
            <select name="protocol_id" class="browser-default custom-select">
                <option selected disabled>Protocol</option>
                @foreach($protocols as $protocol)
                    <option value="{{$protocol->id}}">{{$protocol->name}}</option>
                @endforeach
            </select>
        </div>
        <input type="text" name="address" class="form-control" placeholder="Cím">
    </div>
</form>
