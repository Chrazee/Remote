<div class="row">
    <div class="col-12 mb-3">
        <div class="card rounded teaser">
            <div class="card-body">
                <div class="row h-100">
                    <div class="col-6 align-self-center teaser-left">
                        <h1>{!! $icon !!}</h1>
                    </div>
                    <div class="col-6 align-self-center teaser-right">
                            <h4><strong>{!! $title !!}</strong></h4>
                        @if(isset($subTitle))
                            <span>
                                @include('includes.breadcrumb', ['title' => $subTitle])
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
