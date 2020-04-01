@extends('layouts.main')

@section('title', 'Főoldal')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card rounded teaser">
            <div class="card-body">
                <div class="row h-100">
                    <div class="col-6 align-self-center teaser-left">
                        <h1><i class="fa fa-home"></i></h1>
                    </div>
                    <div class="col-6 align-self-center teaser-right">
                        <h4><strong>Csoportok</strong></h4>
                        <h6>{{$deviceCount}} eszköz</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.group.card',['groups' => $groups])

</div>
@endsection
