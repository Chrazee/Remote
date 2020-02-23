<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row h-100">
                    <div class="col-8 align-self-center">
                        <h3 class="d-inline-block align-middle">{{$device->display_name}}</h3>
                    </div>
                    <div class="col-4 align-self-center">
                        <div class="switch float-right">
                            <input type="checkbox" class="switch-lg" value="0" id="switch" checked="">
                            <label for="switch" id="swtichLabel">Ki</label>
                        </div>
                    </div>
                </div>
                <hr>
                <button type="button" class="btn btn-primary" value="refresh" id="refresh"><i class="fa fa-sync"></i></button>
                <script type="text/javascript">
                    function getStatus() {
                        $.ajax({
                            type: 'POST',
                            url: '/module/switch/refresh',
                            data:{id:{{$device->id}}},
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function() {
                                $("#switch").attr("disabled", "disabled");
                            },
                            success:function(response) {
                                console.log(response);
                                if(response.status) {
                                    if(response.response == "on") {
                                        $("#swtichLabel").html("Ki");
                                        $("#switch").val(0);
                                    } else {
                                        $("#swtichLabel").html("Be");
                                        $("#switch").val(1);
                                    }
                                    $("#switch").removeAttr("disabled");
                                } else {
                                    alert(response.message);
                                }
                            }
                        });
                    }
                    
                    $(document).ready(function() {
                        getStatus();
                    });
                    
                    $("#switch").click(function(e) {
                        var btn =  $("#switch");
                        var label = $("#swtichLabel");
                        $.ajax({
                            type: 'POST',
                            url: '/module/switch/',
                            data:{id:{{$device->id}}, status:btn.val()},
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function() {
                                $("#switch").attr("disabled", "disabled");
                            },
                            success:function(response) {
                                if(response.status) {
                                    
                                } else {
                                    alert(response.message);
                                    $(btn).removeAttr("disabled");
                                }
                                console.log(response);
                                res = response.res;
                                
                                if(res == 'alreadyOn') {
                                    alert("A kapcsoló már be van kapcsolva!");
                                    $(btn).removeAttr("disabled");
                                    $(btn).attr("value", "0");
                                    $(label).html("Ki");
                                    //$(btn).removeClass("btn-light-green");
                                    //$(btn).addClass("btn-blue-grey");
                                } else if(res == 'switchedToOn') {
                                    $(btn).removeAttr("disabled");
                                    $(btn).attr("value", "0");
                                    $(label).html("Ki");
                                    //$(btn).removeClass("btn-light-green");
                                    //$(btn).addClass("btn-blue-grey");
                                } else if(res == 'alreadyOff') {
                                    alert("A kapcsoló már ki van kapcsolva!");
                                    $(btn).removeAttr("disabled");
                                    $(btn).attr("value", "1");
                                    $(label).html("Be");
                                    //$(btn).removeClass("btn-blue-grey");
                                    //$(btn).addClass("btn-light-green");
                                } else if(res == 'switchedToOff') {
                                    $(btn).removeAttr("disabled");
                                    $(btn).attr("value", "1");
                                    $(label).html("Be");
                                    //$(btn).removeClass("btn-blue-grey");
                                    //$(btn).addClass("btn-light-green");
                                } else if(res == 'wrongKey') {
                                    alert("Helytelen kulcs a kontrollerhez. A kontroller nem használható!");
                                    $(btn).removeAttr("disabled");
                                } else if(res == 'unknownStatusValue') {
                                    alert("Ismeretlen érték küldés a kontrollerhez!");
                                    $(btn).removeAttr("disabled");
                                } else {
                                    alert("Ismeretlen hiba");
                                    $(btn).removeAttr("disabled");
                                }
                            }
                        });
                    });
                </script>
                
                <script type="text/javascript">
                    $("#refresh").click(function(e) {
                        var switchBtn = "#switch"; 
                        var refreshBtn = "#refresh";

                        $.ajax({
                            type: "POST",
                            url: '/module/switch/refresh/',
                            data: {id: {{$device->id}}},
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function() {
                                $(switchBtn).attr("disabled", "disabled");
                                $(refreshBtn).attr("disabled", "disabled");
                            },
                            success: function(response) {
                                res = response.res;
                                if(res == 'on') {
                                    $(switchBtn).removeAttr("disabled");
                                    $(switchBtn).attr("value", "0");
                                    $(switchBtn).html("Ki");
                                    alert("Sikeres frissítés.\nA kapcsoló állapota: Bekapcsolva");
                                } else if(res == 'off') {
                                    $(switchBtn).removeAttr("disabled");
                                    $(switchBtn).attr("value", "1");
                                    $(switchBtn).html("Be");
                                    alert("Sikeres frissítés.\nA kapcsoló állapota: Kikapcsolva");
                                }else if(res == '404') {
                                    $(switchBtn).removeAttr("disabled");
                                    alert("Érvénytelen kérés");
                                } else {
                                    alert("A kapcsoló nem elérhető!");
                                    $(id).removeAttr("disabled");
                                }
                                $(refreshBtn).removeAttr("disabled");
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>