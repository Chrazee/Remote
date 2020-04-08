<div class="row">
    <div class="col-12 mb-2">
        <div class="card rounded teaser">
            <div class="card-body">
                <div class="row h-100">
                    <div class="col-6 align-self-center teaser-left">
                        <h1>{!! $icon !!}</h1>
                    </div>
                    <div class="col-6 align-self-center teaser-right">
                            <h4><strong>{!! $title !!}</strong></h4>
                        @if(isset($subTitle))
                            <h6>
                                @if(is_array($subTitle))
                                    @foreach($subTitle as $t)
                                        {{$t}}
                                        @if(!$loop->last)
                                            <i class="fa fa-chevron-right"></i>
                                        @endif
                                    @endforeach
                                @else
                                    {{$subTitle}}
                                @endif
                            </h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
