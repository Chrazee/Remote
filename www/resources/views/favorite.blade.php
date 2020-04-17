@extends('layouts.main')

@section('content')

    @if(!$favorite)
        @alert(['type' => 'warning', 'align' => 'center', 'title' => Lang::get('common.favorite_not_set_title'), 'message' => Lang::get('common.favorite_not_set_message')])
        @endalert
    @else
        @include('includes.tesaser', ['icon' => '<i class="far fa-heart"></i>', 'title' => $title])

        @if($devices != null)
            @include('includes.deviceCard', ['devices' => $devices])
        @else
            @alert(['type' => 'warning', 'align' => 'center', 'title' => Lang::get('common.favorite_not_found_title'), 'message' => Lang::get('common.favorite_not_found_message')])
            @endalert
        @endif
    @endif


@endsection
