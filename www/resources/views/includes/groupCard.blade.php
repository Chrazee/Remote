<div class="row">
    @foreach($groups as $group)
        <div class="{{ (isset($colSize)) ? $colSize : 'col-6 col-sm-4 col-md-3' }} box">
            <a href="/group/{{$group->id}}">
                <div class="card">
                    <div class="card-body">
                        <h5>{{$group->name}}</h5>
                        <p class="text-muted">
                            {{App\Group::countDevicesFromId($group->id)}}
                            {{Lang::get('common.device')}}
                        </p>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
