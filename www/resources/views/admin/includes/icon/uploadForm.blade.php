@if ($errors->icon->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->icon->all() as $error)
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
<form action="{{route('admin.iconUpload', ['type' => $type])}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-row mb-3">
        <div class="col-12">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="icon">
                <label class="custom-file-label" for="file">{{$fileTpyes}}</label>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-12 text-right">
            <button class="btn btn-md btn-purple m-0 mr-1 px-3 d-inline-block" type="submit">Feltöltés</button>
            <div class="custom-control custom-checkbox d-inline-block">
                <input type="checkbox" class="custom-control-input" id="defaultIcon" name="defaultIcon">
                <label class="custom-control-label" for="defaultIcon" data-toggle="tooltip" data-placement="top" title="Az ikon beállítása alapértelmezetre">Alapértelmezett</label>
            </div>
        </div>
    </div>
</form>
