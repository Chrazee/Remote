@extends('layouts.main')

@section('content')

    @include('includes.tesaser', ['icon' => '<i class="fas fa-home"></i>', 'title' => $title, 'subTitle' => $deviceCount .  ' ' . Lang::get('common.device')])

    @include('includes.groupCard',['groups' => $groups])

@endsection
