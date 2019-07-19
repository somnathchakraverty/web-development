<!--Add New Address New -->
<style>
    .pac-container { z-index: 1051 !important; }
</style>
<div id="addaddress" class="modal fade addnew_address" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" onclick="closeAddressModal()" data-dismiss="modal">&times;</button>
            <div class="col-sm-12 text-center modaltitle">
                <h2> Add New Address </h2>
                <img class="lazy-loaded" data-src="/img/underline.png" alt="underline" src="/img/underline.png">
            </div>
        </div>
        <div class="modal-body text-center">
           <div class="new-member-form col-md-12 mar-top select-member-option">
                <form class="address-cont" id="add_address_form" name="add_address_form" method="post">
                    {{ csrf_field() }} 
                    <div class="alert alert-danger" id="modal_error_div" style="display:none;"></div>
                    <div class="alert alert-success" id="modal_success_div" style="display:none;"></div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 normal-input">
                      <label>Locality * 
                        <a href="javascript:void(0);" id="resetLocality" onClick="resetLocality();" style="margin-left: 46px;display:none;" title="Click to reset location">
                            <span class="glyphicon glyphicon-map-marker"></span> Reset
                        </a>
                      </label>
                      <input id="locality" name="locality" placeholder="Locality" required="true" tabindex="2" type="text" autocomplete="off">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 normal-input">
                        <label>House Number *</label>
                        <input autocomplete="off" id="house_number" name="house_number"  placeholder="House Number" required="" tabindex="1" type="text" autocomplete="off">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 normal-input">
                      <label>Pincode *</label>
                      <input autocomplete="off" id="pincode" maxlength="6" minlength="6" name="pincode" placeholder="Pincode" required="true" tabindex="3" type="text" autocomplete="off">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 normal-input">
                      <label>City, State</label>
                      <input autocomplete="off" id="city_state" name="city_state" placeholder="City, State" tabindex="3" type="text" value="" readonly>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="reminds">
                          <div class="checkbox checkbox-info checkbox-circle">
                              <input id="default_status" name="default_status" type="checkbox" value="default_status">
                              <label for="default_status">Make Default Address </label>
                          </div>
                      </div>
                    </div>
                    <input  id="city_id" name="city_id" type="hidden" value="">
                    <input  id="locality_id" name="locality_id" type="hidden" value="">
                    <input  id="sub_locality" name="sub_locality" type="hidden" value="">
                    <input  id="state_name" name="state_name" type="hidden" value="">
                    <input  id="city" name="city" type="hidden" value="">
                    <input  id="state_id" name="state_id" type="hidden" value="">

                    <input  id="lon" name="lon" type="hidden" value="">
                    <input  id="lat" name="lat" type="hidden" value="">
                    <input  id="device_source" name="device_source" type="hidden" value="web">
                    <input  id="address_id" name="address_id" type="hidden" value="">
                    <span class="clearfix"></span>
                    <div class="col-md-12 text-center mar-bot">
                        <div class="loginbtndiv">
                            <button type="submit" class="btn btn-danger btn_cmncolor">Save</button>
                            <a class="btn btn-default addmember btn_whtcolor" href="#" onclick="closeAddressModal()" data-dismiss="modal">Cancel</a>
                        </div>
                    </div>
                </form>                 
            </div>
        </div><div class="clearfix"></div>
    </div>                               
  </div> 
        <div class="clearfix"></div>
      
      </div> 
  

<!--Add New Address Ends New-->

@push('footer-scripts')
    <script type="text/javascript">
        var autocomplete;

        var getaddress_api_url = "{{url('getAddressList')}}";
        
        $(document).ready(function(){
            
            $('#locality').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                // console.log(e.keyCode);
                // console.log(e.which);
                if (keyCode === 13) { 
                  e.preventDefault();
                  return false;
                }
            });


            $.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            });

            $('#addaddress').on('hidden.bs.modal', function() {
                var validator = $( "#add_address_form" ).validate();
                validator.resetForm();
                $('#add_address_form').trigger("reset");
            });
            
            $("#city_state").on("click", function() {
                showStrError("info", "Don't worry, we will auto populate this field for you.");
            });
            
            // To add/edit address form submittion
            $('#add_address_form').validate({
                rules: {
                    house_number: {
                        required: true,
                    },
                    locality: {
                        required: true
                    },
                    pincode : {
                        required: true,
                        digits: true,
                        maxlength: 6	
                    }
                },
                messages: {
                    house_number: {
                        required : "Please specify House No."
                    },
                    locality: {
                        required: "Please select the desired locality from the list."
                    },
                    pincode: {
                        required: "Please enter pincode",
                        digits  : "Enter valid 6-digit pincode",
                        maxlength : "Please enter valid 6 digit no.",
                        minlength : "Please enter valid 6 digit no."
                    }
                },
                invalidHandler: function(form, validator) {
                    for (var i=0;i<validator.errorList.length;i++){
                        pushGaEvent('Confirm Address', 'Validation Faliure on Address Form Submit', 'Customer '+validator.errorList[i].element.name);
                    }    
                },
                submitHandler: function (form) {
                    var sub_locality = $("#sub_locality").val();
                    var locality_id = $("#locality_id").val();
                    var city_id = $("#city_id").val();

                    if(sub_locality == ''|| locality_id == '' || city_id == '') {
                        $("#modal_error_div").show();
                        $("#modal_error_div").html("Please select locality using google dropdown.");

                        setTimeout(function() {
                            $("#modal_error_div").hide();
                            $("#modal_error_div").html("");
                        }, 8000);

                        resetLocality();
                    }
                    else {
                        var address_id = $("#address_id").val();

                        if(address_id == '') {
                            var api_url = "{{url('saveNewAddress')}}";
                        }
                        else {
                            var api_url = "{{url('updateAddress')}}";
                        }                    

                        ajaxCall(api_url, "POST", $('#add_address_form').serialize(), function(response){
                            $("#ajax-loader").hide();
                            if(response) {
                                if(response.status) {
                                    getAddressList(response.data.address_id);
                                    $('#add_address_form')[0].reset();
                                    resetLocality();

                                    $("#modal_success_div").show();
                                    $("#modal_success_div").html(response.message);
                                    setTimeout(function() {
                                        $("#modal_success_div").hide();
                                        $("#modal_success_div").html("");
                                        closeAddressModal()
                                    }, 8000);
                                }
                                else {
                                    if(response.message === 'Address Already Exist.') {
                                        resetLocality();
                                    }
                                    pushGaEvent('Confirm Address', 'Validation Faliure on Address Form Submit', 'Address Already Exist');
                                    
                                    $("#modal_error_div").show();
                                    $("#modal_error_div").html(response.message);
                                    setTimeout(function() {
                                        $("#modal_error_div").hide();
                                        $("#modal_error_div").html("");
                                    }, 8000);
                                }
                            }                       
                        });
                    }
                }
            });
        });
        
        // Google Autocomplete
        function initAutocomplete() {
            var options = {
                types                   : [],
                componentRestrictions   : { 
                    country : "in" 
                }
            };

            autocomplete = new google.maps.places.Autocomplete((document.getElementById('locality')),options);
            autocomplete.addListener('place_changed', function() {

                $("#city_state").val("");                                
                $("#city_id").val("");
                $("#city").val("");
                $("#locality_id").val("");
                $("#sub_locality").val("");
                $("#state_name").val("");
                $("#state_id").val("");
                $("#lon").val("");
                $("#lat").val("");
                $("#locality").prop("readonly", true);
                $("#locality").css("border-bottom", "none");
                $("#resetLocality").show();

                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("Please select the desired locality from the list");

                    resetLocality();
                    return;
                }
                var sub_lat     = place.geometry.location.lat();
                var sub_long    = place.geometry.location.lng();

                if (place.address_components) {
                    $.each(place.address_components, function(){
                        if(this.types[0] == "postal_code"){
                            $("#pincode").val(this.short_name);
                        }
                    });
                }

                var requestData = {
                    "lat"       : sub_lat,
                    "long"      : sub_long,
                    '_token'    : '{{csrf_token()}}'
                };

                $.ajax({
                    url         : "{{url('getLocalityID')}}",
                    type        : "POST",
                    data        : JSON.stringify(requestData),
                    dataType    : "json",
                    contentType : 'application/json',
                    beforeSend  : function() {
                        $("#ajax-loader").show();
                    },
                    success     : function (response) {
                        if(response) {
                            if(response.status) {
                                var response_data = response.data;
                                var city_name = response_data.city_name;
                                var state_name = response_data.state_name;

                                $("#city_state").val(city_name + ', ' + state_name);                                
                                $("#city_id").val(response_data.city_id);
                                $("#city").val(response_data.city_name);
                                $("#locality_id").val(response_data.locality_id);
                                $("#sub_locality").val(place.formatted_address);
                                $("#state_name").val(response_data.state_name);
                                $("#state_id").val(response_data.state_id);

                                $("#lon").val(sub_long);
                                $("#lat").val(sub_lat);
                                $("#dp2").prop("disabled", false);
                            }
                            else {
                                $("#modal_error_div").show();
                                $("#modal_error_div").html(response.message);
                                resetLocality();

                                setTimeout(function() {
                                    $("#modal_error_div").hide();
                                    $("#modal_error_div").html("");
                                }, 6000);  
                            }
                        }
                        $("#ajax-loader").hide();
                    }
                });
            });
        }
        
        // To reset locality
        function resetLocality() {
            $("#resetLocality").hide();
            $("#city_state").val("");                                
            $("#city_id").val("");
            $("#city").val("");
            $("#locality_id").val("");
            $("#sub_locality").val("");
            $("#state_name").val("");
            $("#state_id").val("");
            $("#lon").val("");
            $("#lat").val("");            
            $("#locality").val("");
            $("#locality").prop("readonly", false);
            $("#locality").css("border-bottom", "1px solid #717171");
            $("#locality").focus();
            $("#pincode").val("");
            pushGaEvent('Checkout', 'Click on reset location');
            
        }
        
        // close address modal
        function closeAddressModal() {
            $('#address_edit').modal('hide');
            $("#address_id").val("");
            $("#house_number").val("");
            $('#add_address_form')[0].reset();
            resetLocality();
        }
        
        // get address list
        function getAddressList(address_id) {
            
            $("#check-dropdown").html("");
            var address_list_html = '';
            var i   =   0;
            var selected_id;
            ajaxCall(getaddress_api_url, "GET", {'_token':'{{csrf_token()}}'}, function(response) {
                
                if(response) {
                    if(Array.isArray(response)) {
                        if(response.length > 0) {
                            var selected_address = default_data = null ;
                            response.forEach(function(item){                                
                                address_list_html += '<div class="radiopull">';
                                if(item.id == address_id){
                                    $("#selected_address").val(item.id);
                                    $("#selected_address").data('localityid', item.locality_id);
                                    $("#selected_address").data('cityname', item.city);
                                    default_data = '<h6>House no.: <span>'+ item.house_number +' '+ item.sub_locality + ' '+ item.city + ' ' + item.state_name +' - '+ item.pincode +'</span></h6>';
                                    $("#default-address-detail").html(default_data);
                                    selected_id = "radio-n-"+i;
                                }
                                
                                address_list_html += '<input class="pick_address" id="radio-n-'+i+'" data-localityid="'+ item.locality_id +'" data-cityname="'+ item.city +'" value="'+ item.id +'" name="selected_address_dropdown" type="radio">';
                                
                                address_list_html += '<label for="radio-n-'+i+'" class="pick-address-detail">';
                                address_list_html += '<h6>House no.: <span>'+ item.house_number +' '+ item.sub_locality + ' '+ item.city + ' ' + item.state_name +' - '+ item.pincode +'</span></h6>';
                                address_list_html += '</label>';
                                address_list_html += '</div>';
                                i   +=  1;
                                
                            });
                            $("#address_grid").removeClass("hidden");
                            $("#check-dropdown").html(address_list_html);
                            $("#"+selected_id).prop("checked", true);
                        }
                    }
                    $("#ajax-loader").hide();
                    getSlotTimeByDate();
                }
                else {
                    $("#ajax-loader").hide();
                    //here write no address found code
                }                
            });
        }

        setTimeout(initAutocomplete, 2000);
        // close address modal
        function closeAddressModal() {
            $('#addaddress').modal('hide');
            $('#add_address_form').trigger("reset");
            resetLocality();
        }
        
    </script>
@endpush