<div class="container">
    <div class="row">
    <div class="col-md-12 d-flex flex-row justify-content-center align-items-center" id="queue-numbers">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateQueueNumbers() {
            $.ajax({
                url: "get_queue_numbers.php",
                type: "GET",
                success: function(response) {
                    $("#queue-numbers").html(response);
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                }
            });
            
        }
        
        $(document).ready(function() {
            updateQueueNumbers(); // Call the function once when the page loads
            
            setInterval(function() {
                updateQueueNumbers(); // Call the function every 5 seconds
            }, 1000);
        });
        
    </script>
    </div>  
        
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center" id="serving-field">
            <div class="card col-sm-8 shadow">
                <div class="card-header">
                    <h5 class="card-title text-center">Now Serving</h5>
                </div>
                <div class="card-body">
                    <div class="fs-1  my-2 fw-bold text-center"><span id="queue">-----</span></div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center" id="action-field">
            <div class="w-100 row row-cols-sm-1 row-cols-md-2 row-cols-xl-3">
                <div class="col">
                    <button id="next_queue" class="btn btn-flat btn-primary rounded-0 btn-lg"><i class="fa fa-forward"></i> Next</button>
                </div>
                <div class="col">
                    <button id="notify" class="btn btn-flat btn-secondary rounded-0 btn-lg"><i class="fa fa-bullhorn"></i> Notify</button>
                </div>
            </div>
        </div>


        <!-- lIVE -->
        <div class="col-md-12 d-flex flex-row justify-content-center align-items-center" id="queue-numberslive">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateQueueNumberslive() {
            $.ajax({
                url: "get_queue_numberslive.php",
                type: "GET",
                success: function(response) {
                    $("#queue-numberslive").html(response);
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                }
            });
            
        }
        
        $(document).ready(function() {
            updateQueueNumberslive(); // Call the function once when the page loads
            
            setInterval(function() {
                updateQueueNumberslive(); // Call the function every 5 seconds
            }, 1000);
        });
        
    </script>
    </div>     
        
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center" id="serving-fieldlive">
            <div class="card col-sm-8 shadow">
                <div class="card-header">
                    <h5 class="card-title text-center">Now Serving</h5>
                </div>
                <div class="card-body">
                    <div class="fs-1  my-2 fw-bold text-center"><span id="queuelive">-----</span></div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center" id="action-fieldlive">
            <div class="w-100 row row-cols-sm-1 row-cols-md-2 row-cols-xl-3">
                <div class="col">
                    <button id="next_queuelive" class="btn btn-flat btn-primary rounded-0 btn-lg"><i class="fa fa-forward"></i> Next</button>
                </div>
                <div class="col">
                    <button id="notifylive" class="btn btn-flat btn-secondary rounded-0 btn-lg"><i class="fa fa-bullhorn"></i> Notify</button>
                </div>
            </div>
        </div>       
    
<!-- LIVE END -->

<!-- SA -->
<div class="col-md-12 d-flex flex-row justify-content-center align-items-center" id="queue-numbers_sa">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateQueueNumbers_sa() {
            $.ajax({
                url: "get_queue_numbers_sa.php",
                type: "GET",
                success: function(response) {
                    $("#queue-numbers_sa").html(response);
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                }
            });
            
        }
        
        $(document).ready(function() {
            updateQueueNumbers_sa(); // Call the function once when the page loads
            
            setInterval(function() {
                updateQueueNumbers_sa(); // Call the function every 5 seconds
            }, 1000);
        });
        
    </script>
    </div>        

        
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center" id="serving-field_sa">
            <div class="card col-sm-8 shadow">
                <div class="card-header">
                    <h5 class="card-title text-center">Now Serving</h5>
                </div>
                <div class="card-body">
                    <div class="fs-1  my-2 fw-bold text-center"><span id="queue_sa">-----</span></div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center" id="action-field_sa">
            <div class="w-100 row row-cols-sm-1 row-cols-md-2 row-cols-xl-3">
                <div class="col">
                    <button id="next_queue_sa" class="btn btn-flat btn-primary rounded-0 btn-lg"><i class="fa fa-forward"></i> Next</button>
                </div>
                <div class="col">
                    <button id="notify_sa" class="btn btn-flat btn-secondary rounded-0 btn-lg"><i class="fa fa-bullhorn"></i> Notify</button>
                </div>
            </div>
        </div>       
    </div>
</div>
<!-- SA END -->

<!--  -->
<script>
    var websocket = new WebSocket("ws://<?php echo $_SERVER['SERVER_NAME'] ?>:2306/finalpresentation/php-sockets.php"); 
    websocket.onopen = function(event) { 
    console.log('socket is open!')
		}
    websocket.onclose = function(event){
    console.log('socket has been closed!')
    var websocket = new WebSocket("ws://<?php echo $_SERVER['SERVER_NAME'] ?>:2306/finalpresentation/php-sockets.php"); 
    };
    var in_queue = {};
    function _resize_elements(){
        var window_height = $(window).height()
        var nav_height = $('#topNavBar').height()
        var container_height = window_height - nav_height
        $('#serving-field,#action-field').height(container_height - 200)
    }
    function get_queue(){
        $.ajax({
            url:'./../Actions.php?a=next_queue',
            dataType:'json',
            error:err=>console.log(err),
            success:function(resp){
                if(resp.status){
                    if(Object.keys(resp.data).length > 0){
                        in_queue = resp.data
                    }else{
                        in_queue = {}
                        alert("No Queue Available")
                    }
                }else{
                    alert('An error occured')
                }
                queue();
            }
        })

    }
    function queue(){
        $('#queue').text(in_queue.queue || "-----")
        websocket.send(JSON.stringify({type:'queue',cashier_id:'<?php echo $_SESSION['cashier_id'] ?>',qid:in_queue.queue_id}))
    }
    _resize_elements();
    $(function(){
        $(window).resize(function(){
            _resize_elements()
        })
        $('#next_queue').click(function(){
            get_queue()
        })
        $('#notify').click(function(){
            if(!!in_queue.queue){
                queue()
            }else{
                alert("No Queue Available")
            }
        })
    })
    

</script>
<!--  -->

<!-- LIVE -->
<script>
    var websocket = new WebSocket("ws://<?php echo $_SERVER['SERVER_NAME'] ?>:2306/finalpresentation/php-sockets.php"); 
    websocket.onopen = function(event) { 
    console.log('socket is open!')
		}
    websocket.onclose = function(event){
    console.log('socket has been closed!')
    var websocket = new WebSocket("ws://<?php echo $_SERVER['SERVER_NAME'] ?>:2306/finalpresentation/php-sockets.php"); 
    };
    var in_queuelive = {};
    function _resize_elements(){
        var window_height = $(window).height()
        var nav_height = $('#topNavBar').height()
        var container_height = window_height - nav_height
        $('#serving-fieldlive,#action-fieldlive').height(container_height - 200)
    }
    function get_queuelive(){
        $.ajax({
            url:'./../Actions.php?a=next_queuelive',
            dataType:'json',
            error:err=>console.log(err),
            success:function(resp){
                if(resp.status){
                    if(Object.keys(resp.data).length > 0){
                        in_queuelive = resp.data
                    }else{
                        in_queuelive = {}
                        alert("No Queue Available")
                    }
                }else{
                    alert('An error occured')
                }
                queuelive();
            }
        })
    }
    function queuelive(){
        $('#queuelive').text(in_queuelive.queue || "-----")
        websocket.send(JSON.stringify({type:'queue',cashier_id:'<?php echo $_SESSION['cashier_id'] ?>',qid:in_queuelive.queue_id}))
    }
    _resize_elements();
    $(function(){
        $(window).resize(function(){
            _resize_elements()
        })
        $('#next_queuelive').click(function(){
            get_queuelive()
        })
        $('#notifylive').click(function(){
            if(!!in_queuelive.queue){
                queuelive()
            }else{
                alert("No Queue Available")
            }
        })
    }) 
</script>
<!-- LIVE END -->

<!-- SA -->
<script>
    var websocket = new WebSocket("ws://<?php echo $_SERVER['SERVER_NAME'] ?>:2306/finalpresentation/php-sockets.php"); 
    websocket.onopen = function(event) { 
    console.log('socket is open!')
		}
    websocket.onclose = function(event){
    console.log('socket has been closed!')
    var websocket = new WebSocket("ws://<?php echo $_SERVER['SERVER_NAME'] ?>:2306/finalpresentation/php-sockets.php"); 
    };
    var in_queue_sa = {};
    function _resize_elements(){
        var window_height = $(window).height()
        var nav_height = $('#topNavBar').height()
        var container_height = window_height - nav_height
        $('#serving-field_sa,#action-field_sa').height(container_height - 200)
    }
    function get_queue_sa(){
        $.ajax({
            url:'./../Actions.php?a=next_queue_sa',
            dataType:'json',
            error:err=>console.log(err),
            success:function(resp){
                if(resp.status){
                    if(Object.keys(resp.data).length > 0){
                        in_queue_sa = resp.data
                    }else{
                        in_queue_sa = {}
                        alert("No Queue Available")
                    }
                }else{
                    alert('An error occured')
                }
                queue_sa();
            }
        })
    }
    function queue_sa(){
        $('#queue_sa').text(in_queue_sa.queue || "-----")
        websocket.send(JSON.stringify({type:'queue',cashier_id:'<?php echo $_SESSION['cashier_id'] ?>',qid:in_queue_sa.queue_id}))
    }
    _resize_elements();
    $(function(){
        $(window).resize(function(){
            _resize_elements()
        })
        $('#next_queue_sa').click(function(){
            get_queue_sa()
        })
        $('#notify_sa').click(function(){
            if(!!in_queue_sa.queue){
                queue_sa()
            }else{
                alert("No Queue Available")
            }
        })
    }) 
</script>
<!-- SA END -->
