<form class="form update-form" method="post">
    @include('includes.preloader')
    @include('includes.errorBag')
    @include('includes.authorizeFields')
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="name">{{ucfirst(Lang::get('common.name'))}}</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="name" id="name" placeholder="{{ucfirst(Lang::get('common.name'))}}" value="{{$group->name}}" data-original="{{$group->name}}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="description">{{ucfirst(Lang::get('common.name'))}}</label>
        <div class="col-sm-10">
            <textarea name="description" class="form-control" id="description" rows="3" placeholder="{{ucfirst(Lang::get('common.description'))}}" data-original="{{$group->description}}">{{$group->description}}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label" for="parent_id">{{ucfirst(Lang::get('common.parent_group'))}}</label>
        <div class="col-sm-10">
            <select name="parent_id" class="browser-default custom-select" id="parent_id"  data-original="{{ ($group->parent != null) ? $group->parent->id : $group->parent_id }}">
                <option value="-1">{{ucfirst(Lang::get('common.none'))}}</option>
                <optgroup label="{{ucfirst(Lang::get('common.groups'))}}">
                    @foreach($groups as $item)
                        @if($group->parent != null && $group->parent->id == $item->id)
                            <option selected value="{{$item->id}}">{{$item->name}}</option>
                        @else
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endif
                    @endforeach
                </optgroup>
            </select>
        </div>
    </div>
    @include('includes.actionButtons')
</form>
<script>
    $(document).ready(function() {
        $('.update-form').ajaxSubmit({
            url: '{{route('settings.group.update', ['id' => $group->id])}}',
            redirect: '{{route('settings.group.show', ['id' => $group->id])}}'
        });
    });
</script>

