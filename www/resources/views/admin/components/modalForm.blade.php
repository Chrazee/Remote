<div class="modal fade" id="modal{{ucfirst($id)}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-{{$color}}" role="document">
        <div class="modal-content">
            <div class="checkout-preloader-container d-none">
                <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-{{$preloaderColor}}-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-header">
                {!! $header !!}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">×</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                {!! $body !!}
            </div>
            <div class="modal-footer d-flex justify-content-center">
                {!! $footer !!}
            </div>
        </div>
    </div>
</div>
