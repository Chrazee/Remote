@extends('admin.layout.main')

@section('id', 'Adminisztráció')
@section('title', 'Általános beállítások')

@section('content')
<div class="row">
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Oldal</h5>
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
                <form method="post" action="{{route('adminSiteUpdate')}}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="siteName">Oldal neve</label>
                            <input type="text" class="form-control" name="siteName" id="siteName" value="{{$site_name}}" placeholder="Oldal neve">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="siteHomepage">Kezdőoldal</label>
                            <select class="browser-default custom-select" name="siteHomepage" id="siteHomepage">
                                <option value="rooms" {{ $site_homepage == "rooms" ? "selected" : "" }}>Szobák</option>
                                <option value="favourites"  {{ $site_homepage == "favourites" ? "selected" : "" }}>Kedvencek</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="apiKey">API kulcs</label>
                            <input type="text" class="form-control" name="apiKey" id="apiKey" value="{{$api_key}}" placeholder="API kulcs" readonly="">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-deep-purple">Mentés</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
