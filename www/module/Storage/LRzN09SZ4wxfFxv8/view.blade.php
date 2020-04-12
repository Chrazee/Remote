@extends('modules.layout.module')
@section('dataContent')
    <div class="row h-100">
        <div class="col-8 align-self-center">
            <h3 class="d-inline-block align-middle">{{$device->display_name}}</h3>
        </div>
        <div class="col-4 align-self-center">
            <div class="float-right">
                <button type="button" class="btn btn-primary" value="refresh" id="refresh"><i class="fa fa-sync"></i></button>
            </div>
        </div>
    </div>
    <hr>

    <div id="error"></div>
    <div id="elements">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Hőmérséklet<span class="badge badge-primary badge-pill"><span id="tempC"></span> C&deg; (<span id="tempF"></span> F&deg;)</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Páratartalom <span class="badge badge-primary badge-pill"><span id="hum"></span> %</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Hő index <span class="badge badge-primary badge-pill"><span id="heatIndexC"></span> C&deg; (<span id="heatIndexF"></span> F&deg;)</span>
            </li>
        </ul>
    </div>
@endsection
