<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row h-100">
                    <div class="col-8 align-self-center">
                        <h3 class="d-inline-block align-middle">{{$device->display_name}}</h3>
                    </div>
                    <div class="col-4 align-self-center">
                        <div class="float-right">
                             <button type="button" class="btn btn-primary" value="refresh" id="refresh"><i class="fa fa-sync"></i></button>
                        </div>
                    </div>
                </div>
                <hr>
                
                <div id="error"></div>
                <div id="elements">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Hőmérséklet<span class="badge badge-primary badge-pill"><span id="tempC"></span> C&deg; (<span id="tempF"></span> F&deg;)</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Páratartalom <span class="badge badge-primary badge-pill"><span id="hum"></span> %</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Hő index <span class="badge badge-primary badge-pill"><span id="heatIndexC"></span> C&deg; (<span id="heatIndexF"></span> F&deg;)</span>
                        </li>
                    </ul>
                </div>

                
               
                <script type="text/javascript">   
                    function refreshData() {
                        $.ajax({
                            type: 'POST',
                            url: '/module/sensor/getData',
                            data:{id:{{$device->id}}},
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function() {
                                $("#refresh").attr("disabled", "disabled");
                                $("#error").hide();
                                $("#error").html("");
                            },
                            success:function(response) {
                                if(response.status) {
                                    $("#elements").show();
                                    $("#tempC").html(response.temperature[0]);
                                    $("#tempF").html(response.temperature[1]);
                                    $("#hum").html(response.humidity);
                                    $("#heatIndexC").html(response.heatIndex[0]);
                                    $("#heatIndexF").html(response.heatIndex[1]);
                                } else {
                                    $("#error").show();
                                    $("#error").html(response.message);
                                    $("#elements").hide();
                                }
                                $("#refresh").removeAttr("disabled");
                            }
                        });
                    }
                    
                    $(document).ready(function() {
                        refreshData();
                    });
                    
                    $("#refresh").click(function(e) {
                        refreshData();
                    });

                    setInterval(refreshData, 5000);
                </script>
            </div>
        </div>
    </div>
</div>