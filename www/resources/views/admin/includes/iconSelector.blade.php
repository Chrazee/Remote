@if ($showOnlyDefault)
    <select class="image-picker">
            <option data-img-src="{{asset('assets/imgs/icons')}}/{{$icons->name}}" value="{{$icons->id}}">{{$icons->id}}</option>
    </select>
@else
    <select class="image-picker">
        <option value="{{$defaultIcon->id}}"></option>
        @foreach($icons as $icon)
            <option data-img-src="{{asset('assets/imgs/icons')}}/{{$icon->name}}" value="{{$icon->id}}">{{$icon->id}}</option>
        @endforeach
    </select>
@endif
