<form>
    @include('includes.alert.formAlert')
    <div class="form-group mb-4">
        <input type="text" name="name" class="form-control" placeholder="Név">
    </div>
    <div class="form-group mb-4">
        <textarea name="description" class="form-control" rows="3" placeholder="Leírás"></textarea>
    </div>
    <div class="form-group mb-4">
        <select name="parent_id" class="browser-default custom-select">
            <option selected disabled>Szülő csoport</option>
            <option value="-1">Nincs</option>
            <optgroup label="Csoportok">
                @foreach($groups as $group)
                    <option value="{{$group->id}}">{{$group->name}}</option>
                @endforeach
            </optgroup>
        </select>
    </div>
    <div class="form-group mb-4">
        <div class="icon-selector">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input default" id="modalCreate_iconRadioDefault" name="iconSelector" checked="">
                <label class="custom-control-label" for="modalCreate_iconRadioDefault">Alapértelmezett ikon használata</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input custom" id="modalCreate_iconRadioCustom" name="iconSelector" required="">
                <label class="custom-control-label" for="modalCreate_iconRadioCustom">Saját ikon kiválasztása</label>
            </div>
            <div class="collapse collapse-default">
                @include('admin.includes.iconSelector', ['showOnlyDefault' => true, 'icons' => $defaultIcon,])
            </div>
            <div class="collapse collapse-custom">
                @include('admin.includes.iconSelector', [ 'showOnlyDefault' => false, 'icons' => $icons, 'defaultIcon' => $defaultIcon])
            </div>
        </div>
    </div>
</form>
