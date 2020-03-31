<div class="row">
    <div class="col-12">
        <div class="card device-card">
            <div class="checkout-preloader-container d-none">
                <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-blue-only">
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
                <div class="error-layer d-none">
                    <button class="btn btn-md btn-outline-indigo btn-rounded refresh">Újrapróbálkozás</button>
                </div>
                <div class="preloader-text text-blue">Adatok lekérése</div>
            </div>
            <div class="card-body">
                @yield('dataContent')
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var baseElement = '.device-card';
        var data = {
            _token: '{{csrf_token()}}',
            device: '{!! serialize($device->toArray()) !!}',
            directory: '{{$directory}}',
            action: 'get',
            parameters: JSON.stringify({})
        };

        request(data);

        $(baseElement + ' .refresh').click(function() {
            request(data);
        });

        // get data
        function request(data) {
            $.ajax({
                type: 'POST',
                url: '{{route('device.request')}}',
                data: data,
                beforeSend: function() {
                    showPreloader(baseElement, 'Adatok lekérése');
                },
                success:function(response) {
                    setTimeout(function() {
                        if($.isEmptyObject(response.api_error)) {
                            console.log('NOT_API_ERROR');
                            if(response.status === true) {
                                console.log('STATUS TRUE');
                                hidePreloader(baseElement);
                                console.log(response.data);
                            } else {
                                console.log('STATUS_FALSE');
                                showPreloader(baseElement, response.message, true);
                            }
                        } else {
                            console.log('API_ERROR');
                            showPreloader(baseElement, response.api_error.header, true);
                        }
                    }, 500);
                },
                error: function(xhr, status, error) {
                    showPreloader(baseElement, xhr.status + ': ' + xhr.responseJSON.message, true);
                }
            });
        }

        function setPreloaderText(inElement, text) {
            $(inElement + " .checkout-preloader-container .preloader-text").html(text);
        }

        function enablePreloaderSpinner(inElement)  {
            $(inElement + " .checkout-preloader-container .preloader-wrapper").removeClass("d-none");
            $(inElement + " .checkout-preloader-container .preloader-wrapper").addClass("active");
        }
        function disablePreloaderSpinner(inElement)  {
            $(inElement + " .checkout-preloader-container .preloader-wrapper").addClass("d-none");
            $(inElement + " .checkout-preloader-container .preloader-wrapper").removeClass("active");
        }

        function showPreloaderErrorLayer(inElement) {
            $(inElement + " .checkout-preloader-container .error-layer").removeClass("d-none");
        }
        function hidePreloaderErrorLayer(inElement) {
            $(inElement + " .checkout-preloader-container .error-layer").addClass("d-none");
        }

        function showPreloader(inElement, text = null, onError = false) {
            $(inElement + " .checkout-preloader-container").removeClass('d-none');
            enablePreloaderSpinner(inElement);
            hidePreloaderErrorLayer(inElement);

            if (text != null) {
                setPreloaderText(inElement, text);
            } else {
                setPreloaderText(inElement, '');
            }

            if(onError) {
                disablePreloaderSpinner(inElement);
                showPreloaderErrorLayer(inElement);
            } else {
                enablePreloaderSpinner(inElement);
                hidePreloaderErrorLayer(inElement);
            }
        }

        function hidePreloader(inElement) {
            $(inElement + " .checkout-preloader-container").addClass('d-none');
            setPreloaderText(inElement, '');
            hidePreloaderErrorLayer(inElement);
            disablePreloaderSpinner();
        }

    });
</script>
