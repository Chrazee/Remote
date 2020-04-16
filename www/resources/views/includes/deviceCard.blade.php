<div class="row">
    @foreach($devices as $device)
        <div class="col-6 col-sm-4 col-md-3 box">
            <a href="/device/{{$device->id}}">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-0">{{$device->name}}</h5>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
