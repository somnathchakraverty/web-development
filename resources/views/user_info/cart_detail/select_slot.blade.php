@extends('layout.master')

@section('page-content')
    <style>.datepicker { color: #080808 !important;z-index: 999999;}
.datepicker-days .table-condensed{ width:100%; }</style>
    @include('section.addAddressForm')
    <!-- book your test -->
    <section class="cart-section">
        <div class="container">
            <div class="row">
                <form action="{{ url('before-checkout') }}" id="checkout_form" name="checkout_form" method="post">
                </form>
                @php( $accordian_array = \Config('constants.collapse_array'))
                @php($i = 1)
                @foreach($cartdetail['customer_detail'] as $customer)
                    @if(count($customer['deals']) == 0)
                        @continue
                    @endif
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="selectSlot cart-checkbox">
                            <div class="cart-div">
                                <div class="step-div cart-sec cadiv">
                                    <h2>{{ $customer['customer_name'] }}, {{ $customer['relation'] }}</h2>
                                    <h3> 
                                    @if($customer['customer_gender'] == 'M')
                                        Male
                                    @elseif($customer['customer_gender'] == 'F')
                                        Female
                                    @else
                                        {{ $customer['customer_gender'] }}
                                    @endif, {{ $customer['customer_age'] }} years</h3>
                                </div>
                            </div>
                        </div>
                        @foreach($customer['deals'] as $deal)
                            <div class="cart-block cart-width cart-cont padd30">
                                <div class="cart-left">
                                    <h4>{{ $deal['name'] }}</h4>
                                    <p>Parameters Included: {{ $deal['parameterCount'] }}</p>	
                                </div>
                                <div class="cart-right">
                                    <div class="price">Healthians Price: <strike><span class="rupeesign">₹</span> {{ $deal['actual_price'] }}</strike></div>
                                    <h5>Limited Time Offer: <span class="rupeesign">₹</span> {{ $deal['healthians_price'] }}/-</h5>
                                    <div class="discount">Save {{ calPer($deal['healthians_price'], $deal['actual_price']) }}%</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="clearfix"></div>
                    @php($i += 1)
                @endforeach
                    
                <div class="col-md-12 col-lg-12 col-xs-12 pickslotaddress">

                    <!-- member form -->
                    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 mar-top select-member-option picklocation_slots">
                        <div class="add-address-box">
                                <h2>Pick Location & Time</h2>
                        </div>
                        <div class="address-content slot-selection">
                            <h4>{{ ucfirst($userinfo['name']) }}</h4>
                                <ul>
                                    <li>
                                        <a href="mailto:{{ $userinfo['email'] }}" target="_blank">{{ $userinfo['email'] }}</a>
                                    </li>
                                    <li>
                                        @if(isset($userinfo['countryCode']))
                                            <a class="ht_mobile_numer" href="tel:+{{ $userinfo['countryCode'] }}{{ $userinfo['mobile'] }}" target="_blank">+ {{ $userinfo['countryCode'] }}{{ $userinfo['mobile'] }}</a>
                                        @else
                                            <a class="ht_mobile_numer" href="tel:{{ $userinfo['mobile'] }}" target="_blank">{{ $userinfo['mobile'] }}</a>
                                        @endif
                                    </li>
                                </ul>

                                @if(count($addressLists) > 0)
                                    <div id="address_grid" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 filladdress">
                                @else
                                    <div id="address_grid" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 filladdress hidden">
                                @endif
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 addleftslot">
                                        <div class="address-area defaultaddress" id="default_address_area">

                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 addleftslot">
                                        <div id="view-arrow" class="address-area viewslotopt" >
                                            <h5>View Saved Address</h5>
                                            <div id="check-dropdown">
                                                @php( $accordian_array = \Config('constants.collapse_array'))
                                                @php($i = 1)
                                                @foreach($addressLists as $addressList)
                                                    <div class="radiopull">
                                                        @if($addressList['default_status'] == '1')
                                                            <?php $default_address = $addressList; ?>
                                                        @elseif($i == 1)
                                                            <?php $default_address = $addressList; ?>
                                                        @endif
                                                        
                                                        <input class="pick_address"  id="radio-n-{{$i}}" data-localityid="{{ $addressList['locality_id'] }}" data-cityname="{{ $addressList['city'] }}" value="{{$addressList['id']}}" name="selected_address_dropdown"  type="radio"> 
                                                        <label for="radio-n-{{$i}}">
                                                            <h6>House no.: <span>{{ $addressList['house_number'] }} {{ $addressList['sub_locality'] }} {{ $addressList['city'] }} {{ $addressList['state_name'] }} - {{ $addressList['pincode'] }}</span></h6>
                                                        </label>
                                                    </div>
                                                @php($i += 1)
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 filladdress">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 normal-input" onClick="dob_click();">
                                        <label>Collection Date</label>
                                        <!-- <input autocomplete="off" autofocus="" name="user-age" placeholder="Collection Date" required="" tabindex="1" type="text"> -->
                                        <div class="collectionslotdate">
                                        <input type="text" name="collection_date" readonly class="span2" data-date-format="mm/dd/yy" id="dp2" placeholder="Select Collection Date" autocomplete="off">
                                    </div>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 normal-input">
                                        <label>Collection Time</label>
                                        <select name="collection_time" id="collection_time">
                                            <option value="" selected>Select Collection Time</option>
                                        </select>
                                    </div>
                                </div>
                                    <input type="hidden" name="order_price" value="{{$cartdetail['total_price']}}">
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                 </div>
                <span class="clearfix"></span>
                 <div class="col-md-12 col-lg-12 col-xs-12 addsavecheckoutbtn">
                    <ul>
                         <li>
                            <a id="add-btn"  data-toggle="modal" data-target="#addaddress" class="btn btn-default addmember" onclick="pushGaEvent('Checkout', 'Click on Add new Address', '{{session()->get('auth_'.auth()->user()->id)['user_id']}}')">Add Address</a>
                            <a id="save-btn" href="javascript:void(0)" class="btn btn-default addmember">Save Address</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="btn btn-danger" id="check_out" onclick="pushGaEvent('Checkout', 'Click on Continue', '{{session()->get('auth_'.auth()->user()->id)['user_id']}}')">Checkout</a>
                        </li>
                       
                    </ul>
                 </div>
            </div>
        </div>
    </section>
    <!-- subscribe section start here -->

@endsection
@push('footer-scripts')
    <link href="/css/t2/bootstrap-datepicker.min.css" rel="stylesheet">
    <script src="/js/moment.min.js" defer></script>
    <script src="/js/bootstrap-datepicker.min.js" defer></script>
    <script type="text/javascript" src="/js/bootbox.js"> </script>
    
    <script type="text/javascript">
        // To check device source
        if (isMobile.any()) {
            $("#device_source").val('mobile');
        }
        else {
            $(".ht_mobile_numer").attr("href", "javascript:void(0)");
            $(".ht_mobile_numer").removeAttr("target");
            $("#device_source").val('web');
        }
        
        
        $("#check_out").click(function(e){

            if (typeof(fbq) !== 'undefined') {
                var fb_data = <?php echo json_encode($cartdetail['fb_pixel']) ?>;
                fbq('track', 'InitiateCheckout', fb_data);
            }

            var slot_id         =   $("select[name='collection_time'] option:selected").val();
            var collection_date =   $("input[name='collection_date']").val();
            
            if(collection_date == '' || collection_date == undefined){
                showStrError('error', 'Collection date field is required');
                return false;
            }
            
            if(slot_id == '' || slot_id == 'null' || slot_id == undefined){
                showStrError('error', 'Collection time field is required');
                return false;
            }

            if( $("#selected_address").is(":checked") === false )
            {
                showStrError('error', 'Address is required, please select address');
                return false;
            }

            var selected_city_name = $("#selected_address").data("cityname");
            var city_name = getCookie('sLocation');

            if(selected_city_name.toLowerCase() !== city_name.toLowerCase()) {
                showStrError('error', 'Sample Collection is not available at this address, since you selected '+city_name+'. Please choose an address in same city.');
                return false;
            }

            var slot_detail =   $("select[name='collection_time'] option:selected").text();
            localStorage.setItem('collection_time', slot_detail);
            $('<input />').attr('type', 'hidden')
                    .attr('name', "slot_id")
                    .attr('value', slot_id)
                    .appendTo('#checkout_form');
            $('<input />').attr('type', 'hidden')
                    .attr('name', "address_id")
                    .attr('value', $("#selected_address").val())
                    .appendTo('#checkout_form');
            $('<input />').attr('type', 'hidden')
                    .attr('name', "collection_date")
                    .attr('value', $("input[name='collection_date']").val())
                    .appendTo('#checkout_form');
            $('<input />').attr('type', 'hidden')
                    .attr('name', "_token")
                    .attr('value', "{{csrf_token()}}")
                    .appendTo('#checkout_form');      
            $('<input />').attr('type', 'hidden')
                    .attr('name', "device_source")
                    .attr('value', $("#device_source").val())
                    .appendTo('#checkout_form');    
            $("#checkout_form").submit();
        }); 

        function getSlotTimeByDate(){
            var date_obj = $('#dp2').datepicker('getDate');
            
            $('.datepicker').hide();
            //            var date_obj = new Date(ev.date);
            var day = ("0" + (date_obj.getDate())).slice(-2);
            var monthIndex = ("0" + (date_obj.getMonth() + 1)).slice(-2);
            var year = date_obj.getFullYear();
            var date = year+'-'+monthIndex+'-'+day;
            var locality_id = $("#selected_address").data("localityid");
            var device_source;
            if( locality_id == null || locality_id === undefined){
                showStrError('warning', 'select Address first');
                return false;
            }

            var selected_city_name = $("#selected_address").data("cityname");
            var city_name = getCookie('sLocation');

            if(selected_city_name.toLowerCase() !== city_name.toLowerCase()) {
                $("#dp2").val("");
                showStrError('error', 'Sample Collection is not available at this address, since you selected '+city_name+'. Please choose an address in same city.');
                
                return false;
            }

            // To check device source
            if (isMobile.any()) 
                device_source   =   'mobile';            
            else 
                device_source   =   'web';
            
            var order_price = $("input[name='order_price']").val();
            var values  = { 'locality_id' : locality_id, 'collection_date': date, 'order_price' : order_price, 'source' : device_source};
            // console.log(device_source);
            $.ajax({
                url: "{{url('slot-picker')}}",
                type: 'get',
                data: values ,
                dataType: "json",
                beforeSend: function() {
                    $("#ajax-loader").show();
                },
                success: function (response) {
                    $("#ajax-loader").hide();
                    if(response.status){
                        var error_html = "<option value='null' selected>Collection Time</option>";
                        $.each(response.data, function(i, item) {
                            if(item.isavailable == '1')
                                error_html += "<option value='"+item.slot_id+"'>"+item.start_time+' - '+item.end_time+"</option>";
                        });
                        $("#collection_time").html(error_html);
                    }else{
                        var error_html = "<option value='null' selected>Slot Not Available</option>";
                        $("#collection_time").html(error_html);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var jsonResponseText = $.parseJSON(jqXHR.responseText);
                    showStrError('error', jsonResponseText.message);
                    $("#ajax-loader").hide();
                    var error_html = "<option value='null' selected>Slot Not Available</option>";
                    pushGaEvent('Timeslot Selection', 'Got "No Time Slot Avaliable" message');
                    $("#collection_time").html(error_html);
                }
            });
        }
        
        function dob_click() {
            $("#dp2").focus();
        }

        $(document).ready(function() {
            
            var default_address = <?php echo json_encode($default_address); ?>;
            if(default_address !== null){
                $(".radiopull input[value='" + default_address.id + "']").prop('checked', true);
                var default_add_html = '<div class="checkbox checkbox-info checkbox-circle"><input checked id="selected_address" data-localityid="'+default_address.locality_id+'" data-cityname="'+default_address.city+'" value="'+default_address.id+'" type="checkbox">';
                    default_add_html += '<label for="address-n-2" id="default-address-detail">';
                    default_add_html += '<h6>House no.: <span>'+default_address.house_number+' ' +default_address.sub_locality+' ' + default_address.city +' ' + default_address.state_name +' - ' +default_address.pincode +'</span></h6></label></div>';
                $('#default_address_area').html(default_add_html);
            }else{
                var default_add_html = '<div class="checkbox checkbox-info checkbox-circle"><input checked id="selected_address" data-localityid="" value="" type="checkbox">';
                    default_add_html += '<label for="address-n-2" id="default-address-detail"></label></div>';
                $('#default_address_area').html(default_add_html);
                $("#dp2").prop("disabled", true);
                $('#add-btn').trigger("click");
            }
            var cur_date     =   new Date();
            var end_date     =   new Date();

            end_date.setDate(end_date.getDate() + 6);
            var datepicker_option = {
                    yearRange       :   '2019:2022',
                    format          :   "dd-mm-yyyy",
                    startDate       :   cur_date, 
                    endDate         :   end_date,
                    autoclose       :   true,
                    clearBtn        :   true,
                    todayHighlight  :   true
                };
            $('#dp2').datepicker(datepicker_option).on('changeDate', getSlotTimeByDate);
               
            $("#dp2").keydown(function(event) {event.preventDefault();});
            
            $(document).on('click', '.pick_address', function() {
                $("#selected_address").val($(this).val());
                $("#selected_address").data('localityid', $(this).data('localityid'));
                $("#selected_address").data('cityname', $(this).data('cityname'));
                $('#default-address-detail').html($(this).next().html());
                var jsDate = $('#dp2').datepicker('getDate');
                
                setTimeout(function() {   
                    $("#view-arrow").trigger("click");
                }, 200);
                
                if (jsDate != 'Invalid Date') { 
                    // console.log(jsDate instanceof Date);
                    if(jsDate instanceof Date){
                        getSlotTimeByDate(jsDate);
                    }
                }
            }); 
            
            $('#btn2').click(function(e){
                e.stopPropagation();
                $('#dp2').datepicker('update', '03/17/12');
            }); 

            $('#add-btn').click(function(){
//                $('#member-areasec').fadeIn();
//                $('#add-btn').css('display', 'none');
//                $('#save-btn').css('display', 'block');
            });
            $('#view-arrow').click(function(){
                $('#check-dropdown').slideToggle();
            });
        });
    </script>
@endpush