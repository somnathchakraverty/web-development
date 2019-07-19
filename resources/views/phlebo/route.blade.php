@extends('layout.master')

@push('header-scripts')
    <style type="text/css">
        .backtohome {
            display: inline-block !important;
            margin-top: 22px !important;
        }
        .phlebo_location .midphlebo .contentphlebo h4 {
            font-size: 18px;
            color: #505656;
            line-height: 24px;
        }
        .callphlebo {
            background: #00a0a8;
            color: #fff;
            letter-spacing: 0.5px;
            padding: 14px 15px;
            font-size: 18px;
            transition: all 0.3s ease 0s;
            line-height: 1.2;
            outline: 0 none;
            text-align: center;
            display: block;
            border: 1px solid #00a0a8;
            margin: 15px 0px;
            border-radius: 3px;
        }
        .phlebo_location .midphlebo .contentphlebo a.backtohome {
            background: #919ba1;
            padding: 14px 30px;
            margin-top: 20px;
            color: #fff;
            border-radius: 30px;
            font-size: 15px;
            font-family: 'GothamNarrow-Book';
        }
        .phlebo_location .midphlebo {
             width: auto;
            margin: 30px auto;
            -webkit-box-shadow: 0px 0px 11px -2px rgba(0,0,0,0.16);
            -moz-box-shadow: 0px 0px 11px -2px rgba(0,0,0,0.16);
            box-shadow: 0px 0px 11px -2px rgba(0,0,0,0.16);
            background: #fff;
            border-radius: 3px;
            overflow: hidden;
            min-height: 430px;
        }
        .phlebo_location .midphlebo .contentphlebo {
            padding: 30px 60px;
            text-align: center;
        }
        .phlebo_location .midphlebo .contentphlebo h4 {
            font-size: 18px;
            color: #505656;
            line-height: 24px;
        }
        .phlebo_location .midphlebo .contentphlebo h4 {
            font-size: 26px;
            margin: 0px;
            padding: 10px 0px 12px 0px;
           font-family: Lato,sans-serif;
            color: #00a0a8;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"> </script>
    <!-- Firebase App is always required and must be first -->
    <script src="https://www.gstatic.com/firebasejs/5.3.0/firebase-app.js"></script>

    <script src="https://www.gstatic.com/firebasejs/5.3.0/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-functions.js"></script>
@endpush

@section('page-content')
    
    <div class="clear"></div>

    <div id="pmap_datasuccess" class="pmap_datasuccess" style="text-align: center;min-height:300px;">
        Please Wait <img src="/img/load_wait.gif" style="margin-left:1%">
    </div>


    <!--Phelbo Locaion -->
    <div class="phlebo_location" id="pmap_dataerror" style="display:none;">
        <div class="midphlebo">
            <div class="contentphlebo">
                <img src="/img/phlebo_icon.png" />
                <h4 id="final_message">This link has expired !!!</h4>
                <a href="/" class="backtohome">Back to Home</a>
            </div>

        </div>
    </div>
    <!--Phloebo Location Ends -->


    <div class="ContentWrap" id="main_map" style="display:none;margin-top:0px;margin-bottom:0px;">
       <!--  <b>ETA </b> : <span id="display_eta"></span> -->

       <div class="col-xs-12 col-md-12 col-lg-12 phleboeta" style="margin-top:10px;">
            <div class="col-xs-12 col-md-9 col-lg-9 etaleft">
                <div id="dvMap" style="width:100%; height: 600px"></div>     

                <input type="hidden" value="" id="phlebo_map_order_id">
                <input type="hidden" value="" id="phlebo_map_lat">
                <input type="hidden" value="" id="phlebo_map_long">
                <input type="hidden" value="" id="phlebo_map_phlebo_name">
                <input type="hidden" value="1" id="phlebo_update_check">
                <input type="hidden" value="1" id="display_route">
                <input type="hidden" value="" id="last_marker_lat">
                <input type="hidden" value="" id="last_marker_long">
                <input type="hidden" value="" id="last_marker_time">
                <input type="hidden" value="1" id="animate_marker">
                <input type="hidden" value="" id="phlebo_map_sample_collection_time">
            </div>
            <div class="col-xs-12 col-md-3 col-lg-3 etaright">
                <table cellpadding="0" cellspacing="0" border="0" class="tablestyleeta">
                <tr>
                    <td width="40%">
                        <h5 class="etalabel"><b>Phlebo Name</b></h5>
                    </td>
                    <td width="60%">
                        <h5 class="etalabel"><span id="serving_phlebo_name"></span></h5>
                    </td>
                </tr>
                <tr id="showETADisplay" style="display:none;">
                    <td>
                        <h5 class="etalabel"><b id="display_eta_headline">ETA </b></h5>
                    </td>
                    <td>
                        <h5 class="etalabel"><span id="display_eta_time"></span></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="etalabel"><b>Booking ID</b></h5>
                    </td>
                    <td>
                        <h5 class="etalabel"><span id="display_order_id"></span></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="etalabel"><b>Sample Collection Time </b></h5>
                    </td>
                    <td>
                        <h5 class="etalabel"><span id="display_sample_collection_time"></span></h5>
                    </td>
                </tr>
                </table>

                <a id="call_to_phlebo" href="javascript:void(0);" onClick="callToPhlebo();" class="callphlebo" href="tel:{{ \Config::get('constants.ht_number') }}"><img src="/img/campaign/call-icon-phlebo.png" class="img_call">Call to Phlebo</a>
            </div>
        </div>

    </div>
@endsection
@push('footer-scripts')
<!-- Add additional services that you want to use -->


<script type="text/javascript">
    
    var crm_url     =   '{{$crm_api}}';
    var api_url     =   '{{$ht_api}}';
    
    var markers;
    var last_marker = '';
    var last_home_marker = '';
    var last_heading = '';
    var last_time;
    var bike_marker;
    var home_marker = '';
    var new_booking_assigned;
    var directionsDisplay;

    var delete_marker_flag=1;
    var stop_map_processing = 0;

    var config = {
        apiKey: "AIzaSyBCQfwLUNcke1Ent8-G-eBxPBDwFnxiH1g",
        authDomain: "phlebo-app.firebaseapp.com",
        databaseURL: "https://phlebo-app.firebaseio.com"
    };

    function initializeFirebaseApp() {
        firebase.initializeApp(config);
    }

    setTimeout(function () {
        initializeFirebaseApp();
    }, 1000);

    var isMobile = {
        Android: function() {
                return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
                return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
                return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
                return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    if (isMobile.any()) {
        $("#dvMap").css('height',"375");
    }
    else {
        $("#dvMap").css('height',"600");
    }

    function callToPhlebo(){
        var source      =   "web";
        var order_id    =   GetURLParameter('booking_id');
        var user_id     =   GetURLParameter('user_id');
        
        if (isMobile.any()) {
            source      =   'mobile';
        }
        
        var urlRequest  =   api_url+'webv1/web_api/callToPhlebo';

        $.ajax({
            url: urlRequest,
            data: JSON.stringify({booking_id: order_id, user_id: user_id, source: source}),
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                if(data.status){
                    alert("You are getting connected to your assigned phlebo. You will receive a callback in a few minutes.");
                }else{
                    alert("There must be issue with the operator.</h6> <p> Our phlebo will connect you shortly.");
                }
            },
            error:  function(jqXHR, textStatus, errorThrown) {
                alert("There must be issue with the operator. Our phlebo will connect you shortly.");
                return false;
            }
        });
    }
    
    function GetURLParameter(sParam) {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++)
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam)
            {
                return decodeURIComponent(sParameterName[1]);
            }
        }
    }

    function camelCase (str) {
        if ((str===null) || (str==='')){
            return false;
        }
        else {
            str = str.toString();
        }
       
        return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
    }

    function savePhleboTrackingLinkDetails(link_status) {
        var order_id = GetURLParameter('booking_id');
        var user_id = GetURLParameter('user_id');
        var source  =   'web';
        
        if (isMobile.any()) {
            var source  =   'mobile';
        }

        var link_url    =   window.location.href;

        var urlRequest  =   crm_url+'webv1/commonservice/savePhleboTrackingLinkDetails';

        $.ajax({
            url: urlRequest,
            data: JSON.stringify({booking_id: order_id, user_id: user_id, source: source, link_status: link_status, link_url: link_url}),
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                
            }
        });
    }

    function getMarkerData(phlebo_id) {
        
    
        if(typeof firebase !== 'undefined') {
            if(typeof firebase.database !== 'undefined') {
                try { 
                    var database = firebase.database();
                } 
                catch(err) { 
                    if(err.code == 'app/no-app') { 
                        initializeFirebaseApp();
                        console.log("initializeApp again"); 
                        
                        setTimeout(function () {
                            getMarkerData(phlebo_id);
                        }, 2000);
                        return false;
                    } 
                }
            }
            else {
                setTimeout(function () {
                    getMarkerData(phlebo_id);
                }, 2000);

                return false;
            }
        }
        else {
            setTimeout(function () {
                getMarkerData(phlebo_id);
            }, 2000);

            return false;
        }

        console.log("phlebo_id", phlebo_id);

        var starCountRef = firebase.database().ref(phlebo_id);

        var order_id = GetURLParameter('booking_id');

        starCountRef.on('value', function(snapshot) {
            var phlebo_data = snapshot.val();

            if(phlebo_data !== '' && typeof phlebo_data === 'object') {
                
                markers = phlebo_data;
                console.log("markers", markers);
                var temp_marker_data = phlebo_data;
                
                if(order_id == temp_marker_data.orderId) {
                    if (temp_marker_data.deliveryStatus == '5' || temp_marker_data.deliveryStatus == '6'){
                        stop_map_processing = 0;
                    }
                    else {
                        $("#dvMap").html("");
                        $("#dvMap").hide();
                        $("#main_map").hide();
                        $("#pmap_dataerror").show();

                        if(temp_marker_data.deliveryStatus == '7') {
                            stop_map_processing = 1;
                            $("#final_message").html("Dear Customer, <br>your sample has been collected. We will notify you through SMS/email on the progress of the report.");
                        }
                    }
                }
                else {
                    $("#dvMap").html("");
                    $("#dvMap").hide();
                    $("#main_map").hide();
                    $("#pmap_dataerror").show();
                    $("#final_message").html("Dear Customer, <br> Phlebo is busy with other booking. Please check after sometime. Kindly bear with us.");
                    console.log("booking id empty");
                    savePhleboTrackingLinkDetails('Not OK. Phlebo is busy with other booking');
                    stop_map_processing = 1;
                }

                if (temp_marker_data.orderId == 'null' || temp_marker_data.orderId == '' || temp_marker_data.orderId == null) {
                   
                    $("#phlebo_map_phlebo_name").val('');
                    $("#phlebo_map_order_id").text('');
                    $("#phlebo_map_lat").val('');
                    $("#phlebo_map_long").val('');
                }

                $("#serving_phlebo_name").text(camelCase(temp_marker_data.phleboName));
                $("#phlebo_update_check").val(1);
            }
            else {
                $("#phlebo_update_check").val(0);
                $("#dvMap").html("");
                $("#dvMap").hide();
                $("#pmap_dataerror").show();
                $("#main_map").hide();
                stop_map_processing = 1;

                savePhleboTrackingLinkDetails('Not OK. Firebase Data not present');

                $("#final_message").html("Dear Customer,<br> Due to network issues we are currently unable to display the required information. <br> Kindly bear with us, we will keep you posted.");
            }

            console.log("snapshot", snapshot.val());
            //updateStarCount(postElement, snapshot.val());
        });
    }

    function addMinutes(time, minsToAdd) {
        function D(J){ return (J<10? '0':'') + J};
          
        var piece = time.split(':');
          
        var mins = piece[0]*60 + +piece[1] + +minsToAdd;

        return D(mins%(24*60)/60 | 0) + ':' + D(mins%60) + ':00';  
    }

    


    function getOrderDetails() {
        var order_id = GetURLParameter('booking_id');
        var user_id = GetURLParameter('user_id');
        if (order_id > 0) {
            $("#serving").show();
            $("#not_serving").hide();
            var urlRequest = crm_url+'webv1/commonservice/getPhleboOrderDetails';

            $.ajax({
                url: urlRequest,
                data: JSON.stringify({booking_id: order_id, user_id: user_id}),
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    if(data.data) {

                        if(data.data.delivery_status == '5' || data.data.delivery_status == '6') {
                            var sample_date = new Date(data.data.sample_date);

                            // Get today's date
                            var dt = new Date();

                            var currentTime = new Date();
                            var currentOffset = currentTime.getTimezoneOffset();
                            var ISTOffset = 330;   // IST offset UTC +5:30
                            var ISTTime = new Date(currentTime.getTime() + (ISTOffset + currentOffset)*60000);


                            // call setHours to take the time out of the comparison
                            if(sample_date.setHours(0,0,0,0) == dt.setHours(0,0,0,0)) {

                                if((data.data.start_time !== null) && (data.data.end_time !== '')) {
                                    var startTime = addMinutes(data.data.start_time, '-60');
                                    var endTime = addMinutes(data.data.end_time, '120');
                                }
                                else {
                                    var sct = data.data.sample_collection_time.split(" ");
                                    var startTime = addMinutes(sct[1], '-60');
                                    var endTime = addMinutes(sct[1], '120');
                                }

                                var s =  startTime.split(':');
                                var dt1 = new Date(dt.getFullYear(), dt.getMonth(), dt.getDate(), parseInt(s[0]), parseInt(s[1]), parseInt(s[2]));

                                var e =  endTime.split(':');
                                var dt2 = new Date(dt.getFullYear(), dt.getMonth(), dt.getDate(),parseInt(e[0]), parseInt(e[1]), parseInt(e[2]));

                                console.log("ISTTime", ISTTime);

                                if(dt >= dt1 && dt <= dt2) {
                                    console.log("lie in time range");
                                    var sm_time = moment(data.data.sample_collection_time).format("Do MMM YYYY, h:mm:ss a");
                                    $('#display_order_id').text(data.data.order_id);

                                    $("#phlebo_map_delivery_status").val(data.data.delivery_status);
                                    $("#phlebo_map_sample_collection_time").val(data.data.sample_collection_time);
                                    $("#display_sample_collection_time").text(sm_time);
                                    $("#phlebo_map_phlebo_name").val(camelCase(data.data.sample_colletor_name));
                                    $("#phlebo_map_lat").val(data.data.loc_lat);
                                    $("#phlebo_map_long").val(data.data.loc_long);

                                    getMarkerDataInterval = getMarkerData(data.data.phlebo_id);                                    
                                    
                                    $("#pmap_dataerror").hide();  

                                    savePhleboTrackingLinkDetails('OK. Link open in valid time range');   
                                }
                                else if(ISTTime >= dt1 && ISTTime <= dt2 ) {
                                    $('#display_order_id').text(data.data.order_id);

                                    var sm_time = moment(data.data.sample_collection_time).format("Do MMM YYYY, h:mm:ss a");

                                    $("#phlebo_map_delivery_status").val(data.data.delivery_status);
                                    $("#phlebo_map_sample_collection_time").val(data.data.sample_collection_time);
                                    $("#display_sample_collection_time").text(sm_time);
                                    $("#phlebo_map_phlebo_name").val(camelCase(data.data.sample_colletor_name));
                                    $("#phlebo_map_lat").val(data.data.loc_lat);
                                    $("#phlebo_map_long").val(data.data.loc_long);

                                    getMarkerDataInterval = getMarkerData(data.data.phlebo_id); 

                                    $("#pmap_dataerror").hide();   

                                    savePhleboTrackingLinkDetails('OK. Link open in valid time range');
                                }
                                else {
                                    $("#dvMap").hide();
                                    $("#pmap_dataerror").show();
                                    $("#main_map").hide();

                                    savePhleboTrackingLinkDetails('Not OK. Link open in Expire time range');

                                    if(dt < dt1) {
                                        $("#final_message").html("Dear Customer,<br> The required information will be available from <b>"+startTime+"</b> to <b>"+endTime+"</b>. <br>Please revisit during the mentioned time slot.");
                                    }
                                    else if(ISTTime < dt1) {
                                        $("#final_message").html("Dear Customer,<br> The required information will be available from <b>"+startTime+"</b> to <b>"+endTime+"</b>. <br>Please revisit during the mentioned time slot.");
                                    }
                                    console.log("Expire time range");
                                }
                                                  
                            }  
                            else {
                                $("#dvMap").hide();
                                $("#pmap_dataerror").show();
                                $("#main_map").hide();
                                $("#final_message").html("Dear Customer,<br> The required information will be unavailable.");
                                console.log("Not a sample Collection date");

                                savePhleboTrackingLinkDetails('Not OK. Link open in Expire Date. Not a sample Collection date');
                            }                      
                        }
                        else {
                            $("#dvMap").hide();
                            $("#pmap_dataerror").show();
                            $("#main_map").hide();

                            if(data.data.delivery_status == '7') {
                                $("#final_message").html("Dear Customer, <br>Your sample has been collected. <br>We will notify you through SMS/email on the progress of the report.");

                                savePhleboTrackingLinkDetails('Not OK. Sample already collected.');
                            }
                            else {
                                savePhleboTrackingLinkDetails('Not OK. Not valid delivery status');
                            }                            

                            console.log("Not valid status");
                        }
                    }
                    else {
                        savePhleboTrackingLinkDetails('Not OK. API Data not found.');

                        $("#dvMap").hide();
                        $("#pmap_dataerror").show();
                        $("#main_map").hide();
                    }
                    
                    $("#pmap_datasuccess").hide();
                },
                error: function(err_data) {
                    savePhleboTrackingLinkDetails('Not OK. API Error.');
                    $("#dvMap").hide();
                    $("#pmap_dataerror").show();
                    $("#main_map").hide();
                    $("#pmap_datasuccess").hide();
                }
            });
        }
        else {
            $("#serving").hide();
            $("#not_serving").show();
        }
    }

    $(document).ready(function () {

        getOrderDetails();
        last_marker="";
        $("#serving").hide();
        $("#serving_phlebo_name").text('');

        var init_check  = 0;

        function startMap() {
            console.log("startMap", markers);
            try {
                if(typeof markers !== "undefined") {
                    var mapOptions = {
                        center: new google.maps.LatLng(markers.latitude, markers.longitude),
                        zoom: 15,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);

                    var infoWindow = new google.maps.InfoWindow();
                    var lat_lng = new Array();
                    var latlngbounds = new google.maps.LatLngBounds();

                    directionsDisplay = new google.maps.DirectionsRenderer();
                    //plotmarkerhome = setInterval(function () {}, 1000);
    
                    $("#pmap_datasuccess").hide();
                    $("#main_map").show();

                    drawPathOnMapInterval = setInterval(function () {
                        if(stop_map_processing == 0) {

                            var phlebo_home_lat = $("#phlebo_map_lat").val();
                            var phlebo_home_long = $("#phlebo_map_long").val();

                            var eta='';

                            if(phlebo_home_lat != "" && phlebo_home_long != "") {
                                
                                var timeToReachHome = 0;
                                var google_api_key = 'AIzaSyAKAyLYOKQElRqwi6Kzd4IveWjXoD5WBSI';
                                var eta_url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins="+markers.latitude+","+markers.longitude+"&destinations="+phlebo_home_lat+"%2C"+phlebo_home_long+"&key="+google_api_key;
                                var timeToReachHome = 0;

                                var origin1 = {"lat": parseFloat(markers.latitude), "lng": parseFloat(markers.longitude)};
                                var destinationB = {"lat": parseFloat(phlebo_home_lat), "lng": parseFloat(phlebo_home_long)};


                                var service = new google.maps.DistanceMatrixService;
                                service.getDistanceMatrix({
                                    origins: [origin1],
                                    destinations: [destinationB],
                                    travelMode: 'DRIVING',
                                    unitSystem: google.maps.UnitSystem.METRIC,
                                    avoidHighways: false,
                                    avoidTolls: false
                                }, function(response, status) {
                                    if (status === 'OK') {
                                        var data1 = response;                    
                                        if(data1['rows'][0]['elements'][0]['status'] === "OK") {
                                            timeToReachHome = data1['rows'][0]['elements'][0]['duration']['value'] /60;
                                            eta = data1['rows'][0]['elements'][0]['duration']['text'];
                                            console.log("lat_long_duration", timeToReachHome);
                                            drawPathOnMap(map, markers, infoWindow, lat_lng, latlngbounds, eta, timeToReachHome);
                                        }
                                        else {
                                            drawPathOnMap(map, markers, infoWindow, lat_lng, latlngbounds, eta, 0);
                                        }
                                    }
                                    else {
                                        var home_phlebo_distance = distance(markers.latitude,markers.longitude ,phlebo_home_lat,phlebo_home_long);
                                        var km =  parseFloat((home_phlebo_distance/1000).toFixed(2));    
                                        timeToReachHome = ((home_phlebo_distance/1000) /  speed) * 60;
                                        console.log("ajax timeToReachHome", timeToReachHome);

                                        var hr = Math.floor( timeToReachHome / 60);
                                        var minut = Math.floor(timeToReachHome % 60);
                                        
                                        if(timeToReachHome <= 45) {
                                            if(hr > 1) {
                                                eta = " "+hr+" hours ";
                                            }
                                            else if(hr > 0) {
                                                eta = " "+hr+" hour ";
                                            }

                                            if(minut > 1) {
                                                eta = eta + "" +  minut + " minutes ";
                                            }
                                            else if(minut > 0) {
                                                eta = eta + "" +  minut + " minutes ";
                                            }

                                            drawPathOnMap(map, markers, infoWindow, lat_lng, latlngbounds, eta, timeToReachHome);
                                        }
                                        else {
                                            drawPathOnMap(map, markers, infoWindow, lat_lng, latlngbounds, eta, 0);
                                        }
                                    }
                                });
                            }                            
                        }                        
                    }, 2000);
                }
                else {
                    setTimeout(function () {
                        startMap();
                    }, 2000);
                }                
            }
            catch(err) {

                if($("#phlebo_update_check").val()==0) {
                    $("#display_last_status_id").html('<b class="blinking" style="color:red;">Unable to fetch PLoT data</b>');
                }
                else {
                    $("#serving").hide();
                    $("#not_serving").hide();
                    $("#display_last_status_id").html('<b class="blinking" style="color:red;">Unable to fetch PLoT data</b>');
                }
                $("#battery_status_id").hide();
            }
        }

        setTimeout(function () {
            startMap();
        }, 4000);
    });


    function deleteMarker(mark) {
        mark.setMap(null);
        mark = null;
    }

    function drawPathOnMap(map, markers, infoWindow, lat_lng, latlngbounds, eta, timeToReachHome) {
        var last_marker_lat =  $("#last_marker_lat").val();
        var last_marker_long =  $("#last_marker_long").val();
        var last_marker_time =  $("#last_marker_time").val();
        var marker;
        var ph_reach = false;

        var bike = "M37.482,21.821c0,0-3.993-0.655-4.259-0.48c-0.266,0.175,0.438-1.128,0.438-1.128s3.202,0.507,4.008,0.425C37.67,20.637,37.813,21.466,37.482,21.821z,M10.938,19.359c0,0,3.979-0.732,4.17-0.987c0.191-0.254-0.031,1.21-0.031,1.21s-3.184,0.605-3.917,0.955C11.16,20.537,10.746,19.805,10.938,19.359z,M16.254,57.245c0,0,9.232,7.386,16.81-0.7v9.297L16.572,66.35L16.254,57.245z,M17.603,58.794v7.417h14.04v-7.481c0,0-0.381,0.987-0.987,1.177v3.535H18.716v-3.885C18.716,59.558,17.634,59.049,17.603,58.794z,M16.36,45.083c0,0-5.243-3.884-5.306-4.563c0,0,1.511,11.55,5.457,17.274c3.946,5.723,11.459,4.926,14.611,2.093c0,0,3.248-2.293,3.947-7.769c0,0,2.611-5.54,3.121-11.271c0.509-5.731-0.032-0.127-0.032-0.127l-4.775,4.107l-0.892,1.464l-2.133,9.105l-6.303,1.592l-2.707-3.598l-2.26-5.221L16.36,45.083z ,M32.877,70.457v6.871c0,0,7.828-0.089,5.03-15.132c0,0-0.959-5.14-5.009-4.839L32.877,70.457z,M16.562,64.042l-0.229-6.416c0,0-6.797,3.004-4.802,14.678c0,0,1.104,5.009,5.009,4.839L16.562,64.042z,M26.769,5.86V3.619C26.769,2.173,25.596,1,24.15,1c-1.447,0-2.619,1.173-2.619,2.619V5.86H26.769z,M16.063,38.797l-0.337-17.301c0,0,7.723-3.074,16.829-0.179l0.048,18.56l-1.576-0.418c0,0,0.594-8.546-2.419-10.245c0,0-6.686-3.606-9.678,3.731l-0.807,6.75L16.063,38.797z,M8.152,27.207c0,0,0.366,5.014,2.594,6.956c0,0,3.884,4.426,6.94,4.936c0,0,3.725,5.921,6.941,6.208c3.215,0.287,6.208-2.516,6.653-5.89c0,0,7.386-2.483,8.533-6.59c0,0,1.878-4.234,1.592-5.762l3.646-0.348c0,0-0.304,9.804-8.008,15.248c0,0-2.961,2.992-3.789,3.693c0,0-0.828,6.399-1.337,9.328c0,0-0.127,2.547-2.388,2.61c0,0-5.508,2.166-11.111-0.859c0,0-0.923-0.064-0.892-2.006c0,0-1.082-8.022-1.273-9.232c0,0-0.764-0.765-1.337-1.051c0,0-7.354-6.017-9.041-11.079c0,0-1.795-4.526-1.455-6.402c0,0,3.021-0.232,3.782,0.171,M18.313,34.287c0,0,0.149-8.3,6.898-8.108c0,0,6.473-0.531,5.964,8.022L18.313,34.287z,M41.406,27.099c0,0,0.167-1.308,0.099-1.394l3.04-0.551c0,0,1.193-0.009,0.507,1.597c-0.686,1.605,0,0,0,0l-3.688,0.326,M8.152,27.207c0,0-0.507-1.722-0.439-1.809L4.929,25.35c0,0-1.193-0.009-0.508,1.616c0.686,1.624,0,0,0,0L8.152,27.207,M27.312,13.791V7.654c0-1.73-1.403-3.134-3.133-3.134s-3.134,1.403-3.134,3.134v6.137H27.312z,M35.611,23.192c0,0-3.109-9.047-11.85-8.415c0,0-8.265-0.299-11.522,8.124C12.239,22.9,22.961,19.762,35.611,23.192z,M19.708,12.063c0,0,4.234,2.472,9.105,0.021c0,0,1.083,4.563-4.075,4.435C24.739,16.52,18.96,17.512,19.708,12.063z,M35.081,82.978c0,1.203-0.975,2.178-2.177,2.178H17.009c-1.203,0-2.177-0.975-2.177-2.178V67.084c0-1.203,0.974-2.177,2.177-2.177h15.894c1.203,0,2.177,0.975,2.177,2.177V82.978z,M41.634,25.954c0,0-0.032-1.337-1.561-1.942c0,0-2.324-0.159-0.892-1.497c0,0,0.797,0.224,0.542-1.528c0,0,0.191-1.688,1.336-1.242c0,0,2.134,0.096,3.279,0.764c0,0,1.401,0.032,0.86,1.592c0.001,0-0.573,0.669-0.637,1.369c0,0-0.095,1.656,0.096,2.069L41.634,25.954z,M7.667,25.396c0,0-0.144-1.33,1.292-2.13c0,0,2.282-0.463,0.687-1.601c0,0-0.759,0.326-0.738-1.443c0,0-0.411-1.647-1.488-1.056c0,0-2.101,0.376-3.15,1.188c0,0-1.385,0.216-0.643,1.692c0,0,0.656,0.587,0.811,1.273c0,0,0.313,1.629,0.177,2.065L7.667,25.396z,M3.432,21.062c0,0-2.098,0.132-2.056,1.449c0,0,0.042,1.379,1.868,0.934c0,0,0.702-0.198,0.988-0.643c0,0-0.087-0.16-0.263-0.382C3.698,22.076,3.309,21.558,3.432,21.062z,M8.772,19.852c0,0,0.933-0.143,1.273-0.271c0,0-0.324-1.104-1.64-0.828c0,0-2.584,0.801-3.667,0.971c0,0-1.539,0.907-1.491,0.127c0,0-0.047-0.318,0.833-0.594c0,0,4.372-1.81,5.667-1.104c0,0,1.115,0.744,1.316,1.55c0,0,0.987,1.581-0.435,2.026c0,0-0.294,0.294-0.989-0.052c0,0-0.752,0.267-0.732-1.158C8.912,20.199,8.791,19.845,8.772,19.852z,M45.376,22.755c0,0,2.02,0.585,2.424-0.668c0,0,0.427-1.313-1.442-1.51c0,0-0.727-0.051-1.147,0.271c0,0,0.028,0.18,0.119,0.449C45.469,21.712,45.66,22.33,45.376,22.755z,M39.739,20.248c0,0-0.944-0.029-1.298-0.114c0,0,0.188-1.135,1.528-1.021c0,0,2.662,0.481,3.757,0.519c0,0,1.638,0.713,1.496-0.055c0,0,0.009-0.322-0.899-0.489c0,0-4.56-1.265-5.759-0.408c0,0-1.016,0.873-1.118,1.698c0,0-0.788,1.689,0.678,1.958c0,0,0.328,0.256,0.976-0.171c0,0,0.78,0.173,0.587-1.238C39.643,20.609,39.72,20.242,39.739,20.248z,M23.519,78.667c-0.01-0.017-0.022-0.035-0.038-0.053c-0.003-0.005-0.008-0.01-0.012-0.013c-0.026-0.028-0.055-0.051-0.088-0.071l-0.011-0.006l-0.01-0.005c-0.01-0.006-0.022-0.011-0.037-0.016l-0.02-0.007c-0.008-0.003-0.017-0.006-0.026-0.009c-0.011-0.003-0.023-0.006-0.034-0.007c-0.006-0.001-0.011-0.002-0.018-0.003c-0.001,0-0.096-0.02-0.307,0.009c-0.111,0.015-0.264-0.034-0.347-0.063c-0.064-0.023-0.125-0.053-0.181-0.088c-0.068-0.044-0.129-0.095-0.181-0.149c-0.02-0.021-0.041-0.039-0.06-0.055c-0.008-0.006-0.016-0.012-0.026-0.018c-0.014-0.01-0.027-0.02-0.04-0.026c-0.012-0.007-0.025-0.014-0.038-0.02c-0.011-0.006-0.022-0.01-0.042-0.016c-0.014-0.005-0.028-0.01-0.039-0.012l-0.016-0.003l-0.009,0c-0.1-0.017-0.202,0.01-0.284,0.074c-0.041,0.032-0.074,0.068-0.102,0.11l-0.045,0.069c-0.138,0.208-0.173,0.548,0.004,0.757c0.048,0.057,0.112,0.118,0.173,0.172l-0.083,0.236c-0.06,0.171,0.042,0.345,0.244,0.415l0.484,0.171c0.184,0.064,0.343-0.009,0.405-0.187l0.091-0.259c0.007,0,0.014,0,0.02,0c0.016,0.002,0.038,0.005,0.068,0.003c0.016,0,0.031,0,0.048-0.001c0,0,0.059-0.006,0.077-0.008l0.004,0.001l0.041-0.007c0.04-0.006,0.077-0.017,0.116-0.034c0.009-0.004,0.017-0.008,0.028-0.014c0.027-0.014,0.051-0.027,0.076-0.045l0.022-0.018c0.024-0.019,0.045-0.038,0.068-0.062c0.004-0.005,0.008-0.01,0.012-0.013c0.097-0.11,0.158-0.251,0.166-0.384l0.005-0.09c0.005-0.085-0.012-0.165-0.049-0.235L23.519,78.667z,M20.576,73.661c0.008-0.033,0.016-0.068,0.026-0.1c0.028-0.102,0.063-0.198,0.107-0.292c0.006-0.016,0.012-0.03,0.019-0.043l0.024-0.049c0.005-0.012,0.016-0.029,0.025-0.045c0.009-0.017,0.018-0.033,0.024-0.043c0.016-0.026,0.031-0.053,0.048-0.078c0.019-0.028,0.039-0.056,0.057-0.082c0.075-0.103,0.158-0.192,0.252-0.267c0.021-0.019,0.042-0.035,0.064-0.051c0.043-0.031,0.091-0.06,0.141-0.083c0.024-0.012,0.05-0.024,0.075-0.035c0.026-0.01,0.052-0.019,0.079-0.027c0.071-0.022,0.147-0.039,0.226-0.049l0.042-0.005c0.042-0.004,0.088-0.006,0.13-0.007c0.023,0,0.047-0.001,0.07-0.001c0.034,0,0.066,0.001,0.1,0.004l0.013,0.001c0.018,0.001,0.036,0.001,0.052,0.003c0.035,0.004,0.07,0.01,0.105,0.016c0,0,0.044,0.006,0.053,0.008c0.055,0.012,0.103,0.024,0.148,0.038c0.017,0.006,0.035,0.012,0.051,0.017c0.031,0.012,0.063,0.023,0.093,0.038c0.111,0.047,0.211,0.112,0.296,0.187c0.082-0.167,0.211-0.294,0.411-0.318c0.078-0.01,0.155,0,0.232,0.027c-0.016-0.031-0.033-0.061-0.051-0.091c-0.113-0.19-0.275-0.367-0.472-0.511c-0.068-0.05-0.14-0.096-0.213-0.137c-0.111-0.063-0.23-0.117-0.354-0.161c-0.132-0.045-0.271-0.081-0.413-0.105c-0.08-0.013-0.167-0.022-0.265-0.029l-0.024-0.002c-0.009,0-0.037,0-0.037,0c-0.199-0.006-0.396,0.011-0.58,0.052c-0.024,0.005-0.049,0.011-0.074,0.019l-0.003,0.001l-0.001-0.001l-0.008,0.001l-0.009-0.003l-0.063,0.025l-0.079,0.026l-0.094,0.036c-0.108,0.043-0.209,0.094-0.31,0.154c-0.051,0.031-0.104,0.065-0.161,0.106l-0.009,0.007c-0.112,0.082-0.221,0.176-0.324,0.281l-0.006,0.007c-0.06,0.061-0.112,0.12-0.16,0.181l-0.006,0.008c-0.041,0.051-0.083,0.107-0.127,0.173l-0.026,0.038c-0.046,0.071-0.083,0.13-0.115,0.188c-0.028,0.05-0.055,0.102-0.08,0.153c-0.167,0.345-0.275,0.74-0.31,1.143c-0.039,0.406-0.008,0.839,0.092,1.29c0.023,0.103,0.05,0.204,0.077,0.299c0.029,0.1,0.061,0.198,0.096,0.292c0.034,0.094,0.072,0.188,0.11,0.277c0.039,0.091,0.08,0.18,0.125,0.268l0.06,0.119l0.064,0.12c0.043,0.083,0.088,0.161,0.133,0.239c0.078,0.134,0.163,0.269,0.275,0.441c0.047,0.068,0.095,0.137,0.141,0.202c0.091,0.128,0.187,0.254,0.284,0.376c0.047,0.06,0.094,0.117,0.141,0.173c0.08,0.094,0.158,0.183,0.234,0.266l0.045,0.051l0.131,0.137c0.015,0.014,0.027,0.027,0.041,0.041c0.019-0.143,0.069-0.278,0.14-0.385l0.046-0.069c0.039-0.06,0.085-0.109,0.141-0.153c0.088-0.069,0.191-0.11,0.299-0.117c-0.073-0.124-0.143-0.246-0.21-0.369c-0.146-0.264-0.275-0.51-0.396-0.757c-0.033-0.066-0.065-0.134-0.098-0.203c-0.032-0.07-0.065-0.14-0.097-0.213c-0.032-0.069-0.064-0.14-0.093-0.21l-0.045-0.105l-0.048-0.123c-0.118-0.284-0.208-0.581-0.269-0.879c-0.023-0.125-0.052-0.29-0.065-0.454c-0.006-0.077-0.009-0.153-0.01-0.227c0-0.074,0-0.149,0.004-0.22C20.524,73.937,20.545,73.793,20.576,73.661z,M24.08,73.435c-0.033-0.265-0.311-0.753-0.594-0.853c-0.054-0.018-0.106-0.02-0.157-0.014c-0.412,0.05-0.406,0.811-0.382,1.01c0.029,0.238,0.185,0.42,0.397,0.525l0,0c0.079,0,0.16,0.026,0.243,0.017C23.9,74.081,24.121,73.771,24.08,73.435z,M28.57,74.536c-0.042-0.109-0.089-0.211-0.147-0.315l-0.043-0.075l-0.05-0.075l-0.035-0.063l-0.011-0.004l-0.006-0.007c-0.015-0.021-0.03-0.042-0.042-0.057c-0.132-0.164-0.284-0.308-0.454-0.431c-0.08-0.056-0.161-0.109-0.245-0.156c-0.126-0.071-0.256-0.129-0.388-0.175c-0.124-0.043-0.25-0.077-0.375-0.098c-0.288-0.049-0.578-0.035-0.837,0.042c-0.035,0.009-0.07,0.022-0.101,0.033c-0.034,0.013-0.065,0.026-0.099,0.041c0.013,0.004,0.026,0.009,0.039,0.015c0.061,0.026,0.113,0.063,0.158,0.108c0.094,0.097,0.177,0.257,0.12,0.506c0.144-0.005,0.295,0.017,0.445,0.069c0.016,0.006,0.033,0.012,0.051,0.02c0.205,0.079,0.405,0.214,0.569,0.381c0.176,0.176,0.286,0.37,0.326,0.584c0.024,0.113,0.035,0.233,0.029,0.359c-0.004,0.062-0.008,0.127-0.018,0.191c-0.003,0.013-0.005,0.03-0.009,0.049c-0.003,0.02-0.007,0.039-0.01,0.057l-0.005,0.021c-0.005,0.021-0.01,0.045-0.018,0.076c-0.019,0.073-0.043,0.149-0.075,0.23c-0.035,0.088-0.077,0.177-0.127,0.269c-0.021,0.039-0.042,0.077-0.065,0.113l-0.016,0.026c-0.024,0.039-0.05,0.078-0.075,0.114c-0.085,0.118-0.182,0.235-0.286,0.347c-0.112,0.12-0.239,0.231-0.333,0.313c-0.06,0.049-0.121,0.098-0.182,0.144c-0.183,0.138-0.378,0.264-0.582,0.376l-0.108,0.062l-0.105,0.057c-0.033,0.017-0.065,0.035-0.099,0.053c-0.035,0.017-0.069,0.034-0.106,0.053c-0.147,0.076-0.281,0.142-0.413,0.202c-0.247,0.116-0.502,0.228-0.782,0.342c-0.14,0.058-0.283,0.114-0.431,0.17c0.019,0.023,0.035,0.045,0.049,0.069l0.012,0.022c0.056,0.104,0.08,0.216,0.073,0.336l-0.005,0.089c-0.009,0.15-0.068,0.305-0.164,0.436c0.089-0.009,0.183-0.021,0.279-0.034l0.081-0.01l0.057-0.009c0.113-0.019,0.23-0.036,0.352-0.062c0.308-0.062,0.615-0.139,0.915-0.233c0.19-0.061,0.346-0.115,0.488-0.169c0.083-0.032,0.167-0.066,0.253-0.103l0.129-0.057l0.12-0.053c0.174-0.081,0.35-0.174,0.522-0.278c0.165-0.1,0.334-0.218,0.506-0.354c0.357-0.287,0.653-0.606,0.876-0.946c0.168-0.252,0.302-0.525,0.396-0.809l0.004-0.011c0.013-0.044,0.027-0.087,0.039-0.131l0.017-0.063c0.008-0.028,0.014-0.057,0.021-0.084c0.012-0.051,0.022-0.103,0.032-0.156c0.026-0.152,0.039-0.31,0.041-0.468c0.001-0.193-0.018-0.379-0.055-0.556C28.642,74.755,28.61,74.644,28.57,74.536z,M25.483,74.458c0.144-0.141,0.622-0.727,0.332-1.024c-0.036-0.037-0.081-0.064-0.133-0.083c-0.283-0.1-0.804,0.105-0.995,0.291c-0.115,0.113-0.184,0.259-0.193,0.413c-0.011,0.163,0.043,0.313,0.152,0.425c0.058,0.059,0.127,0.104,0.206,0.13C25.063,74.686,25.312,74.625,25.483,74.458z,M31.769,70.099c-0.688,0-1.259,0.509-1.356,1.17c-2.416,0.36-4.684-0.828-6.202-1.624l-0.149-0.077c-1.569-0.821-2.889-0.943-4.154-0.386c-0.863,0.379-1.627,1.078-2.157,1.968c-0.568,0.956-0.852,2.097-0.816,3.298l0.003,0c0.021,0.802,0.183,1.654,0.512,2.533l0.005-0.003c0.143,0.36,0.316,0.711,0.518,1.051c0.399,0.672,1.534,1.875,2.678,2.38h0c0.338,0.149,0.642,0.247,0.923,0.239c0.375-0.011,0.691-0.141,0.934-0.407c-0.076,0.007-0.157,0-0.239-0.029l-0.483-0.17c-0.018-0.005-0.035-0.012-0.051-0.019c-0.113-0.051-0.199-0.129-0.257-0.221c-0.144-0.007-0.313-0.052-0.504-0.136c-0.845-0.372-1.853-1.364-2.264-2.055c-0.176-0.295-0.326-0.602-0.45-0.917l0.004-0.002c-0.65-1.725-0.575-3.327-0.048-4.563c0.465-1.067,1.248-1.815,2.038-2.163c1.007-0.444,2.09-0.329,3.411,0.361l0.147,0.077c1.623,0.85,4.048,2.122,6.746,1.709c0.231,0.432,0.66,0.726,1.21,0.726c0.757,0,1.371-0.614,1.371-1.371C33.14,70.713,32.525,70.099,31.769,70.099z M31.769,72.139c-0.369,0-0.668-0.299-0.668-0.668c0-0.37,0.299-0.669,0.668-0.669c0.37,0,0.669,0.3,0.669,0.669C32.438,71.84,32.139,72.139,31.769,72.139z";

        var data = markers;
        new_booking_assigned=0;

        // // condition to check last orderId and current Order Id changed or not
        if(parseInt($("#phlebo_map_order_id").val()) != parseInt(data.orderId)) {

            if(last_home_marker != "") {
                last_home_marker.setMap(null);
                last_home_marker = "";
            }

            $("#phlebo_map_order_id").val(data.orderId);
            //getorder details runs only if last orderid and current orderId changes
            getOrderDetails();   

            setTimeout(function(){
                plothomeMarker(map, lat_lng, infoWindow);
                $("#display_route").val(1);
            },1000);

            new_booking_assigned=1;
        }

        var myLatlng = new google.maps.LatLng((data.latitude).toString(), (data.longitude).toString());

        $("#last_marker_lat").val(data.latitude);
        $("#last_marker_long").val(data.longitude);
        $("#last_marker_time").val(data.dateTime);

        if(data.latitude != last_marker_lat &&  data.longitude != last_marker_long && last_marker_lat != "" && last_marker_long != "") {
            // $("#display_route").val(1);
        }

        var dt = new Date();
        var currentTime = new Date();
        var currentOffset = currentTime.getTimezoneOffset();
        var ISTOffset = 330;   // IST offset UTC +5:30
        var ISTTime = new Date(currentTime.getTime() + (ISTOffset + currentOffset)*60000);

        var phlebo_time = new Date(data.dateTime);
        var ten_mint = 10 * 60 * 1000;

        var late_flag = false;
        var late_message = " last location was updated more than 10 minutes ago.";

        if((ISTTime - phlebo_time) > ten_mint) {
            late_flag = true; 
        }
        else {
            late_flag = false; 
        }

        var speed =  20;  // default speed taken 20km/hr

        var phlebo_home_lat = $("#phlebo_map_lat").val();
        var phlebo_home_long = $("#phlebo_map_long").val();

        if(phlebo_home_lat != "" && phlebo_home_long != "") {            
            if(eta == '') {
                var timeToReachHome = 0;
                var home_phlebo_distance = distance(data.latitude,data.longitude ,phlebo_home_lat,phlebo_home_long);
                var km =  parseFloat((home_phlebo_distance/1000).toFixed(2));    
                timeToReachHome = ((home_phlebo_distance/1000) /  speed) * 60;
                console.log("eta timeToReachHome", timeToReachHome);

                var hr = Math.floor( timeToReachHome / 60);
                var minut = Math.floor(timeToReachHome % 60);
                
                if(timeToReachHome <= 45) {
                    if(hr > 1) {
                        eta = " "+hr+" hours ";
                    }
                    else if(hr > 0) {
                        eta = " "+hr+" hour ";
                    }

                    if(minut > 1) {
                        eta = eta + "" +  minut + " minutes ";
                    }
                    else if(minut > 0) {
                        eta = eta + "" +  minut + " minutes ";
                    }
                }
            }
           
            if(data.deliveryStatus === '6') {
                eta = "has reached your location"
                $("#display_eta_time").html(eta);
            }
            else {
                if(parseInt(timeToReachHome) == 0) {
                    ph_reach = true;
                    $("#showETADisplay").show();
                    $("#display_eta_time").html('Phlebo has reached your location.');
                    $("#display_eta_headline").html('Phlebo Status');
                }
                else {
                    $("#display_eta_time").html(eta);
                }
            }
            console.log("eta", eta);
        }

        lat_lng.push(myLatlng);

        if (data.type == "home") {
            data.icon = 'home.png';
        }
        else if (data.type == "location") {
            data.icon = 'phlebo_icon.png';
        }      

        var icon = {
            path: bike,
            scale: .4,
            strokeColor: 'white',
            strokeWeight: .10,
            fillOpacity: 1,
            //  fillColor: '#404040',
            fillColor : '#00a0a8',
            offset: '5%',
            anchor: new google.maps.Point(10, 25)
        };

        if(data.deliveryStatus === '6') {
            var icon = {
                url: 'https://www.healthians.com/assets/images/location-map-phlebo.png',
                scale: .9,
                strokeColor: 'white',
                strokeWeight: .10,
                fillOpacity: 1,
                //  fillColor: '#404040',
                fillColor : '#E94B36',
                offset: '15%',
                anchor: new google.maps.Point(10, 25)
            };
        }

        if(ph_reach) {
            var icon = {
                url: 'https://www.healthians.com/assets/images/location-map-phlebo.png',
                scale: .9,
                strokeColor: 'white',
                strokeWeight: .10,
                fillOpacity: 1,
                //  fillColor: '#404040',
                fillColor : '#E94B36',
                offset: '15%',
                anchor: new google.maps.Point(10, 25)
            };
        }


        var display_title = camelCase(data.phleboName);
        //eta = Math.random();

        if(data.deliveryStatus === '6') {
            display_title = display_title + ' has reached your location.';
            $("#showETADisplay").show();
            $("#display_eta_time").html('Phlebo has reached your location.');
            $("#display_eta_headline").html('Phlebo Status');

        }
        else {
            if(ph_reach) {
                display_title = display_title + ' has reached your location.';
                $("#showETADisplay").show();
                $("#display_eta_time").html('Phlebo has reached your location.');
                $("#display_eta_headline").html('Phlebo Status');
            }
            else {
                $("#display_eta_headline").html('ETA');
                if(late_flag) {
                    display_title = display_title + ' ' + late_message;

                    $("#showETADisplay").show();
                    $("#display_eta_time").html(display_title);

                }
                else {
                    if(eta !== undefined) {
                        if(eta !== '') {
                            display_title = display_title + ' will reach your location in ' + eta
                            $("#showETADisplay").show();
                            $("#display_eta_time").html(eta);
                        }                       
                    }
                }
            }
            
        }                

        if(last_marker=='') {
            destination=null;
            position=myLatlng;             
            
            bike_marker = new google.maps.Marker({
                position: position,
                map: map,
                title: display_title,
                visible: true,
                icon: icon
            });
            $("#animate_marker").val(0);
        }
        else {
            position=last_marker;
            bike_marker.setTitle(display_title);
        }

        if (myLatlng.equals(last_marker)) {
            if (last_heading != '') {
                icon.rotation = last_heading;
                bike_marker.setIcon(icon);
            }
        } else {
            if (last_marker != '') {
                var heading = google.maps.geometry.spherical.computeHeading(last_marker, myLatlng);
                last_heading = heading;
                icon.rotation = heading;
                bike_marker.setIcon(icon);
            }
        }

        if(last_marker != '') {
            frames = [];
            for (var percent = 0; percent < 1; percent += 0.01) {
                var fromLat=last_marker.lat();
                fromLng=last_marker.lng();

                curLat = fromLat + percent * (data.latitude - fromLat);
                curLng = fromLng + percent * (data.longitude - fromLng);
                frames.push(new google.maps.LatLng(curLat, curLng));
            }
            animate(bike_marker, frames, 0,20);
        }

        last_marker = myLatlng;

        (function (bike_marker, data) {
            google.maps.event.addListener(bike_marker, "click", function (e) {

                var phlebo_status;
                if (data.deliveryStatus == 5) {
                    phlebo_status = "In Transit";

                    if(late_flag) {
                        var phlebo_info = "<b>" + camelCase(data.phleboName) + "</b>  " + late_message;
                    }
                    else {
                        if(eta !== undefined) {
                            if(eta !== '') {
                                var phlebo_info = "<b>Name</b> : " + camelCase(data.phleboName) + "<br> <b>ETA</b> : " + eta + " <br>";
                            }
                            else {
                                var phlebo_info = "<b>Name</b> : " + camelCase(data.phleboName);
                            }                                
                        }
                        else {
                            var phlebo_info = "<b>Name</b> : " + camelCase(data.phleboName);
                        }
                    }

                }
                else if (data.deliveryStatus == 6) {
                    phlebo_status = "Reached at Customer Location";
                    var phlebo_info = "<b>" + camelCase(data.phleboName) + "</b> has reached your location.";
                }
                if (data.orderId < 0 || data.orderId == '' || data.orderId == 'null' || data.orderId == null) {
                    phlebo_status = "No booking assigned";
                }                                      

                infoWindow.setContent(phlebo_info);
                infoWindow.open(map, bike_marker);
            });

        })(bike_marker, data);
      

        map.setCenter(myLatlng);
       
        //***********ROUTING****************//

        //Initialize the Path Array
        var path = new google.maps.MVCArray();

        //Initialize the Direction Service
        var home_lat =  parseFloat($("#phlebo_map_lat").val());
        var home_long =   parseFloat($("#phlebo_map_long").val());

        if(parseInt($("#phlebo_map_order_id").val()) > 0 && $("#display_route").val() == 1 && home_lat > 0 && home_long > 0) {
         
            cur_lat=(data.latitude).toString();
            cur_long=(data.longitude).toString();

            $("#display_route").val(0);

            var service = new google.maps.DirectionsService();

            //call 1 st after 3 seconds
            setTimeout(function () {
                drawDrivingRouteOnMap(cur_lat,cur_long,service,map);
            }, 3000);
        }

        setTimeout(function () {
            if(delete_marker_flag==1) {
                delete_marker_flag = 0;
            }
        }, 1200);

        map.panTo(bike_marker.getPosition());
    }

    function plothomeMarker(map, lat_lng, infoWindow) {
        var phlebo_home_lat = $("#phlebo_map_lat").val();
        var phlebo_home_long = $("#phlebo_map_long").val();

        var myLatlng1 = new google.maps.LatLng((phlebo_home_lat).toString(), (phlebo_home_long).toString());
        lat_lng.push(myLatlng1);
        home_marker = new google.maps.Marker({
            position: myLatlng1,
            map: map,
            icon: 'https://www.healthians.com/assets/images/marker_home.png'
        });
        last_home_marker = home_marker;

        google.maps.event.addListener(home_marker, "click", function (e) {
            // var home_info = "<b>Booking Id</b> :" + $("#phlebo_map_order_id").val() + "<br>" +
            //     "<b>Name</b> : " + $("#phlebo_map_billing_cust_name").val() + "<br>" +
            //     "<b>Address</b> : " + $("#phlebo_map_billing_cust_address").val() + " <br>" +
            //     "<b>Sample Collection Time</b> :" + $("#phlebo_map_sample_collection_time").val();

            var sm_time = moment($("#phlebo_map_sample_collection_time").val()).format("Do MMM YYYY, h:mm:ss a");

            var home_info = "<b>Booking ID</b> :" + $("#phlebo_map_order_id").val() + "<br>" +
                "<b>Sample Collection Time</b> :" + sm_time;

            infoWindow.setContent(home_info);
            infoWindow.open(map, home_marker);
        });
    }

    function  displayRoute(lat_lng,path,service,poly,map) {
        for (var i = 0; i < lat_lng.length; i++) {
            if ((i + 1) < lat_lng.length) {
                var src = lat_lng[i];
                var des = lat_lng[i + 1];
                // path.push(src);
                poly.setPath(path);
                service.route({
                    origin: src,
                    destination: des,
                    travelMode: google.maps.DirectionsTravelMode.DRIVING
                }, function (result, status) {
                    if (status == google.maps.DirectionsStatus.OK) {

                        $("#display_route").val(0);
                        for (var i = 0, len = result.routes[0].overview_path.length; i < len; i++) {
                            path.push(result.routes[0].overview_path[i]);
                        }
                    }
                });
            }
        }
    }


    function drawDrivingRouteOnMap(current_lat,current_long,directionsService,map){
        $("#display_route").val(0);
        var phlebo_home_lat = $("#phlebo_map_lat").val();
        var phlebo_home_long = $("#phlebo_map_long").val();
        directionsDisplay.setOptions({suppressMarkers: true});
        directionsDisplay.setMap(map);

        var start = new google.maps.LatLng(current_lat, current_long);
        var end = new google.maps.LatLng(phlebo_home_lat, phlebo_home_long);
   
        var bounds = new google.maps.LatLngBounds();
        bounds.extend(start);
        bounds.extend(end);
        map.fitBounds(bounds);
        var request = {
            origin: start,
            destination: end,
            travelMode: google.maps.TravelMode.DRIVING
        };
        directionsService.route(request, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            } else {
               
            }
        });
    }

    function distance(lat1,lon1,lat2,lon2) {
        var R = 6371; // km (change this constant to get miles)
        var dLat = (lat2-lat1) * Math.PI / 180;
        var dLon = (lon2-lon1) * Math.PI / 180;
        var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(lat1 * Math.PI / 180 ) * Math.cos(lat2 * Math.PI / 180 ) *
            Math.sin(dLon/2) * Math.sin(dLon/2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        var d = R * c;
        return Math.round(d*1000);  // meters
    }

    function animate(bike_marker, latlngs, index, wait) {

        bike_marker.setPosition(latlngs[index]);
        if(index != latlngs.length-1) {
            // call the next "frame" of the animation
            setTimeout(function() {
                animate(bike_marker, latlngs, index+1, wait);
            }, wait);
        }
        else {
            // assign new route
            bike_marker.position = bike_marker.destination;
        }
    }

</script>
@endpush


<style>
    .serving h5{ margin-top:7px !important; margin-bottom:7px !important;}
    @-webkit-keyframes blinker {
        from {opacity: 1.0;}
        to {opacity: 0.0;}
    }
    .blinking{

    }
</style>

<div class="clear"></div>


<style type="text/css">
.zopim {
    display: none !important;
}
</style>
