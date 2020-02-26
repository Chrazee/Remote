@foreach($icons as $icon)
    <div class="col-lg-3 col-md-4 col-6 icon-box">
        <img class="img-fluid img-thumbnail" src="{{asset('assets/imgs/icons')}}/{{$icon->name}}">
        <div class="icon-box-visible-element">
            @if($icon->default)
                <span class="btn btn-blue-grey btn-sm" data-toggle="tooltip" data-placement="top" title="Alapértelmezett ikon">
                    <i class="fa fa-check"></i>
                </span>
            @endif
        </div>
        <div class="icon-box-overlay-element">
            @if(!$icon->default)
                <span class="btn btn-blue btn-sm icon-btn-default" data-toggle="tooltip" data-placement="top" title="Beállítás alapértelmezettként">
                    <i class="fa fa-check"></i>
                </span>
            @endif
            <span class="btn btn-danger btn-sm icon-btn-delete" data-toggle="tooltip" data-placement="top" title="Ikon törlése">
                <i class="fa fa-times"></i>
            </span>
        </div>
    </div>
@endforeach
