@extends('layouts.main')

@section('content')
    @component('components.dataTable')
        @slot('title')
            @include('includes.breadcrumb', ['title' => $title])
        @endslot
        @slot('actions')
        @endslot
        @slot('body')
            @include('setting.devicetype.form.create')
        @endslot
    @endcomponent
@endsection
