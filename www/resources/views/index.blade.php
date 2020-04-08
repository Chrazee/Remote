@extends('layouts.main', ['title' => $title])

@section('content')

    @include('includes.tesaser', ['icon' => '<i class="fas fa-home"></i>', 'title' => $title, 'subTitle' => $deviceCount .  ' ' . Lang::get('device.device')])

    @include('includes.group.card',['groups' => $groups])


@endsection
