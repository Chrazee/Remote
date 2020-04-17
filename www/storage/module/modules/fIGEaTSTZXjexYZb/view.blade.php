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
        $().makeRequest({
            autoUpdateTime: 3200,
            responseHandler: function(response) {
                $.each(response.data, function(index, value) {
                    $('.data.' + index).html(value);
                });
            },
        });
    });
</script>
