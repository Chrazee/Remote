@extends('layouts.main')

@section('content')
    @if (!empty($error))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <h5>{{$error['title']}}</h5>
                    <p>{{$error['message']}}</p>
                </div>
            </div>
        </div>
    @else
        @include('includes.tesaser', ['icon' => '<i class="fas fa-microchip"></i>', 'title' => $deviceName])

        <div class="row">
            <div class="col-12 mb-3">
                @component('components.module')
                    @slot('data', $data)
                    @slot('module')
                        @include($view)
                    @endslot
                @endcomponent
            </div>
        </div>
    @endif
@endsection

