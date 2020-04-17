@extends('layouts.main')

@section('content')
    <div class="row">
        @if ($group->child->count() > 0)
            <div class="col-12">
                <h4>{{ucfirst(Lang::get('common.sub_groups'))}}</h4>
                    @include('includes.groupCard', ['groups' => $group->child])
            </div>
        @endif
        <div class="col-12">
            <h4>{{ucfirst(Lang::get('common.devices'))}}</h4>
        </div>
        <div class="col-12">
            <div class="row">
                @php
                    $devices_count = false;
                @endphp
                @foreach($types as $type)
                    @if($type->devices->count() > 0)
                        @php
                            $devices_count = true;
                        @endphp
                        <div class="col-6 col-sm-4 col-md-3 box">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <a href="{{Request::url()}}/type/{{$type->id}}">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5>{{$type->name}}</h5>
                                                <p class="text-muted">
                                                    {{$type->devices->count()}} {{Lang::get('common.device')}}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    @foreach($type->devices  as $device)
                                        <a href="{{route('device', ['id' => $device->id])}}">
                                            <div class="card box-devices">
                                                <div class="card-body">
                                                    {{$device->name}}
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                @if(!$devices_count)
                    <div class="col-12">
                        <a href="{{route('settings.devices')}}" class="btn btn-outline-secondary ml-0"><i class="fa fa-plus"></i> {{Lang::get('common.add')}}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
