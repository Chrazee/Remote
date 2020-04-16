<div class="row h-100">
    <div class="col-8 align-self-center">
        <h3 class="d-inline-block align-middle">Data</h3>
    </div>
    <div class="col-4 align-self-center">
        <div class="float-right">
            <button type="button" class="btn btn-primary refresh"><i class="fa fa-sync"></i></button>
        </div>
    </div>
</div>
<hr>
<div>
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Temperature<span class="badge badge-primary badge-pill">
                <span class="data temperature_c"></span> C&deg; (<span class="data temperature_f"></span> F&deg;)
            </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Humidity <span class="badge badge-primary badge-pill">
                <span class="data humidity"></span> %
            </span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Heat index <span class="badge badge-primary badge-pill">
                <span class="data heat_index_c"></span> C&deg; (<span class="data heat_index_f"></span> F&deg;)
            </span>
        </li>
    </ul>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var erroBag = $('.error-bag').errorBag();
        var data = JSON.parse('{!! $data !!}');
        var autoUpdate = false;

        function request(data, beforeSend = true) {
            $.ajax({
                type: 'POST',
                url: '{{route('device.request')}}',
                data: data,
                dataType: 'json',
                beforeSend: function() {
                    if(beforeSend) {
                        erroBag.data('errorBag').clear();
                        $('.module-overlay').show();
                        $('.module-overlay').find('.process-text').show();
                        $('.module-overlay').find('.try-again').hide();
                    }
                },
                success:function(response) {
                    if(response.status === true) {
                        $('.module-overlay').hide();
                        $.each(response.data, function(index, value) {
                            $('.data.' + index).html(value);
                        });
                        autoUpdate = true;
                    } else {
                        erroBag.data('errorBag').print('danger', response.message, response.errors);
                        $('.module-overlay').find('.process-text').hide();
                        $('.module-overlay').find('.try-again').show();
                        autoUpdate = false;
                    }
                },
                error: function(xhr,) {
                    erroBag.data('errorBag').print('danger', xhr.responseJSON.message, xhr.responseJSON.errors);
                    $('.module-overlay').find('.process-text').hide();
                    $('.module-overlay').find('.try-again').show();
                    autoUpdate = false;
                }
            });
        }

        setInterval(function(){
            if(autoUpdate) {
                request(data, false);
            }
        }, 3000);

        request(data, true);

        $('.refresh').click(function() {
            autoUpdate = false;
            request(data);
        });
    });
</script>
