@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card card-cascade wider">
                <div class="view view-cascade gradient-card-header bg-primary narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                    <h6 class="white-text mx-3 mb-0 py-2">
                        @include('includes.breadcrumb', ['title' => $title])
                    </h6>
                </div>
                <div class="px-4 py-2">
                    @include('setting.module.form.create')
                </div>
            </div>
        </div>
    </div>
@endsection
