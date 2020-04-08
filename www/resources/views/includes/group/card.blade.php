<div class="row">
    @foreach($groups as $group)
        <div class="col-6 col-sm-4 col-md-3 box">
            <a href="/group/{{$group->id}}">
                <div class="card">
                    <div class="card-body">
                        <img src="{{asset('assets/imgs/icons/')}}/{{$group->icon->name}}" class="img-fluid">
                        <h5>{{$group->name}}</h5>
                        <p class="text-muted">
                            @if($group->devices_count)
                                {{$group->devices_count}}
                            @else
                                0
                            @endif
                            {{Lang::get('device.device')}}
                        </p>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
