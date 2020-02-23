@extends('admin.layout.main')

@section('id', 'Adminisztráció')
@section('title', 'Eszköz típus ikonok')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card rounded teaser">
            <div class="card-body">
                <div class="row h-100">
                    <div class="col-6 align-self-center teaser-left">
                        <h1><i class="fa fa-user-shield"></i></h1>
                    </div>
                    <div class="col-6 align-self-center teaser-right">
                        <h4><strong>@yield('id')</strong></h4>
                        <h6>@yield('title')</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Új ikon feltöltése</h5>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <form action="{{route('adminIconDeviceTypeUpload')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-deep-purple">Feltöltés</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6 mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Alapértelmezett ikon</h5>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <form action="{{route('adminIconDeviceTypeUpload')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-deep-purple">Csere</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ikonok</h5>
                <div class="row text-center text-lg-left">
                    @foreach($icons as $icon)
                        <div class="col-lg-3 col-md-4 col-6 icon-box">
                            <img class="img-fluid img-thumbnail" src="{{asset('assets/imgs/devicetype')}}/{{$icon->name}}" alt="">
                            <div class="icon-box-overlay-element">
                                <div class="text">
                                    <button class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
