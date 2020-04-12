<form>
    @include('includes.form.errorBag.blade.php')
    <div class="form-group mb-4">
        <input type="text" name="name" class="form-control" placeholder="Név">
    </div>
    <div class="form-group mb-4">
        <div class="icon-selector">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input default" id="modal{{ucfirst($iconSelectorPrefix)}}_iconRadioDefault" name="iconSelector" checked="">
                <label class="custom-control-label" for="modal{{ucfirst($iconSelectorPrefix)}}_iconRadioDefault">Alapértelmezett ikon használata</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input custom" id="modal{{ucfirst($iconSelectorPrefix)}}_iconRadioCustom" name="iconSelector" required="">
                <label class="custom-control-label" for="modal{{ucfirst($iconSelectorPrefix)}}_iconRadioCustom">Saját ikon kiválasztása</label>
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
