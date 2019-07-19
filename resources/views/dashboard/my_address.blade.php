@extends('layout.master')

@section('page-content')
<style>
.pac-container { z-index: 1051 !important; }
</style>

<section class="faimly-friendwraper">

    <div class="fixed-bar">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="asidenavdiv text-left">
                    @include('section.left-dashboard', ['userDetail' => $userDetail])
                </div>	
            </div>

            <!------aside-end -->
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="Family-headingdiv text-left">
                    <h3>Manage Addresses</h3>
                    <a class="btn btn-danger btn_cmncolor_right add_newaddress" data-toggle="modal" data-target="#address_edit" onclick="addAddress();">Add New Address</a>
                </div>
                <div class="Retake-Healthkarmadiv f-div">
                   <!--  <div class="Add-New-Member text-center"></div> -->
                    <div class="alert alert-danger" id="address_list_error_div" style="display:none;"></div>
                    <div id="address_list_div"></div>
                    
                   
                </div>
            </div>	
        </div>
    </div>
</section>

<!-- Add Address Modal -->
<div class="modal fade editaddress_modal" id="address_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">



        <div class="modal-content">
            <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeAddressModal.center-bnt();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="add_address_form" name="add_address_form" method="post">
                <div class="modal-body">
                    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 select-member-option">

                        <div class="col-sm-12 text-center commonpopup_title">
                            <h2 id="add_edit_title"> Add New Address </h2>
                            <img class="lazy-loaded" data-src="/img/underline.png" alt="underline" src="/img/underline.png">
                        </div>

                        <div class="clearfix"></div>
                        

                        
                        
                        {{csrf_field()}}  
                        
                        <div class="alert alert-danger" id="address_error_div" style="display:none;"></div>
                        <div class="alert alert-success" id="address_success_div" style="display:none;"></div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 normal-input">
                            <label>House No. / Flat / Building / Landing *</label>
                            <input autocomplete="off" id="house_number" name="house_number" maxlength="512" placeholder="Enter House Number" required="true" tabindex="1" type="text">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 normal-input">
                            <label>Colony / Area / Sector* 
                                <a href="javascript:void(0);" id="resetLocality" onClick="resetLocality();" style="margin-left: 46px;display:none;" title="Click to reset location">
                                    <span class="glyphicon glyphicon-map-marker"></span> Change Sub-locality
                                </a>
                            </label>
                            <input autocomplete="off" id="locality" name="locality" placeholder="Enter Locality" required="true" tabindex="2" type="text">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 normal-input">
                            <label>Pincode *</label>
                            <input autocomplete="off" id="pincode" maxlength="6" minlength="6" name="pincode" placeholder="Enter Pincode" required="true" tabindex="3" type="text">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 normal-input">
                            <label>City, State</label>
                            <input autocomplete="off" id="city_state" name="city_state" placeholder="Enter your City, State" tabindex="3" type="text" value="" readonly>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="reminds">
                                <div class="checkbox checkbox-info checkbox-circle">
                                    <input id="default_status" name="default_status" type="checkbox" value="default_status"> <label for="checkbox6">Make Default Address</label>
                                </div>
                            </div>
                        </div>
                        <input id="city_id" name="city_id" type="hidden" value="">
                        <input id="locality_id" name="locality_id" type="hidden" value="">
                        <input  id="sub_locality" name="sub_locality" type="hidden" value="">
                        <input id="state_name" name="state_name" type="hidden" value="">
                        <input id="city" name="city" type="hidden" value="">
                        <input  id="state_id" name="state_id" type="hidden" value="">
                        
                        <input  id="lon" name="lon" type="hidden" value="">
                        <input  id="lat" name="lat" type="hidden" value="">
                        <input  id="device_source" name="device_source" type="hidden" value="web">
                        <input id="address_id" name="address_id" type="hidden" value="">
                    </div>
                </div>
                <div class="center-bnt addaddresssavechange">
                    <button type="submit" class="btn btn-danger btn_cmncolor">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('section.getACallBack')
@endsection
@push('footer-scripts')            
    <script>
        var autocomplete;

        var getaddress_api_url      = "{{url('getAddressList')}}";
        var add_address_api_url     = "{{url('saveNewAddress')}}";    
        var update_address_api_url  = "{{url('updateAddress')}}";

        $(document).ready(function(){
            $.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            });

            $("#city_state").on("click", function() {
                showStrError("info", "Don't worry, we will auto populate this field for you.");
            });
        });

        // get address list - Start
        function processAddressListHandler(response) {
            var address_list_html = '';

            if(response) {
                if(Array.isArray(response)) {
                    if(response.length > 0) {
                        response.forEach(function(item){
                            address_list_html += '<div class="add-box" id="address_'+item.id+'">\
                            <div class="row">\
                            <div class="col-sm-8">\
                                <div class="address">\
                                    <strong>House No. / Flat : </strong>\
                                    <span>';

                                        if(item.house_number !== '') {
                                            address_list_html += item.house_number;
                                            if(item.landmark !== '') {
                                                address_list_html += ' ,'+item.landmark;
                                            }
                                        }
                                        else {
                                            address_list_html += "N/A";
                                        }
                                                                                    
                            address_list_html += '</span>\
                                </div>\
                                <div class="address">\
                                    <strong>Address :  </strong>\
                                    <span>';
                                    if(item.sub_locality) {
                                        address_list_html += item.sub_locality;
                                    }
                                    else {
                                        address_list_html += "N/A";
                                    }
                                        
                            address_list_html += '</span>\
                                </div>\
                                <div class="address">\
                                    <strong>Pincode : </strong>\
                                    <span>';
                                    if(item.pincode) {
                                        address_list_html += item.pincode;
                                    }
                                    else {
                                        address_list_html += "N/A";
                                    }
                                        
                            address_list_html += '</span>\
                                </div>\
                            </div>\
                            <div class="col-sm-4 text-center btnrdiv">';

                                if(item.default_status == 1) {
                                    address_list_html += '<div class="default-address"> \
                                        <img src="/img/home-icon.png"> Default Address\
                                    </div>\
                                    <div class="edit-address">\
                                        <a class="editico" data-toggle="modal" data-target="#address_edit" onclick="editAddress(\''+item.id+'\');">\
                                            <img src="/img/edit-icon.png">\
                                        </a>\
                                    </div>';
                                }                                        
                                else {
                                    address_list_html += '<div class="edit-address">\
                                        <a class="delico" onclick="deleteAddress(\''+item.id+'\');">\
                                            <img src="/img/del-icon.png">\
                                        </a>\
                                        <a class="editico" onclick="editAddress(\''+item.id+'\');" data-toggle="modal" data-target="#address_edit">\
                                            <img src="/img/edit-icon.png">\
                                        </a>\
                                    </div>';
                                }                  
                                
                                
                            address_list_html += '</div>\
                                                </div>\
                                            </div>';
                                                        
                        });

                        $("#address_list_div").html(address_list_html);
                    }
                    else {
                        $("#address_list_div").html('<h4><label class="alert alert-info">No Address Found..!!</label></h4>');
                    }
                }
                else {
                    $("#address_list_div").html('<h4><label class="alert alert-info">No Address Found..!!</label></h4>');
                }
                $("#ajax-loader").hide();
            }
            else {
                $("#ajax-loader").hide();
                //here write no address found code
            } 
        }

        function errorAddressListHandler(response) {          
            $("#ajax-loader").hide();
            var errorData = response.responseJSON;
            
            showStrError("error", errorData.message);
        }

        function getAddressList() {
            $("#address_list_div").html("");
            ajaxCallPromise(getaddress_api_url, "GET", null).then(processAddressListHandler, errorAddressListHandler);
        }
        
        getAddressList();

        // get address list - END

        // close address modal
        function closeAddressModal() {
            $('#address_edit').modal('hide');
            $("#address_id").val("");
            $("#house_number").val("");
            $('#add_address_form')[0].reset();
            resetLocality();
        }

        /* Add Address Code - Start */
        // click on add address button
        function addAddress() {
            $("#address_id").val("");
            $("#add_edit_title").text("Add New Address");
            $('#add_address_form')[0].reset();
            $("#default_status").removeAttr("disabled");
            var validator = $( "#add_address_form" ).validate();
            validator.resetForm();
            resetLocality();
        }
        
        function addAddressSuccessHandler(response) {
            $("#ajax-loader").hide();
            if(response) {
                if(response.status) {
                    getAddressList();
                    $('#add_address_form')[0].reset();
                    resetLocality();

                    showStrError("success", response.message);
                    closeAddressModal();
                }
                else {
                    if(response.message === 'Address Already Exist.') {
                        resetLocality();
                    }
                    
                    showStrError("error", response.message);
                }
            }  
        }

        function addAddressErrorHandler(response) {
            $("#ajax-loader").hide();
            var errorData = response.responseJSON;
            
            showStrError("error", errorData.message);
            
            if(errorData.message === 'Address Already Exist.') {
                resetLocality();
            }
        }

        /* Add Address Code - End */
        
        /* Edit Address Code - Start */

        function autoPopulateEditAddress(response) {
            $("#ajax-loader").hide();

            if(response) {
                if(Array.isArray(response)) {
                    if(response.length > 0) {
                        var address_id = $("#address_id").val();

                        response.forEach(function(item){
                            if(item.id == address_id) {
                                $("#address_id").val(address_id);
                                $("#city_state").val(item.city + ', ' + item.state_name);                                
                                $("#city_id").val(item.city_id);
                                $("#city").val(item.city);
                                $("#locality_id").val(item.locality_id);
                                $("#locality").val(item.sub_locality);
                                $("#sub_locality").val(item.sub_locality);
                                $("#state_name").val(item.state_name);
                                $("#state_id").val(item.state_id);
                                $("#lon").val(item.long);
                                $("#lat").val(item.lat);
                                $("#house_number").val(item.house_number);
                                $("#pincode").val(item.pincode);

                                $("#locality").prop("readonly", true);
                                $("#locality").css("border-bottom", "none");
                                $("#resetLocality").show();
                                
                                if(parseInt(item.default_status) == 1) {                                        
                                    $("#default_status").prop('checked', true);
                                    $("#default_status").attr("disabled", true);
                                }
                                else {
                                    $("#default_status").removeAttr("disabled");
                                    $("#default_status").prop('checked', false);
                                }
                            }                                
                        });
                    }
                }
            }
            else {
                $('#address_edit').modal('hide');
            }
        }
        
        // click on edit address button
        function editAddress(address_id) {
            $("#add_edit_title").text("Edit Address");
            $('#add_address_form')[0].reset();
            $("#address_id").val("");
            $("#address_id").val(address_id);
            

            ajaxCallPromise(getaddress_api_url, "GET", null).then(autoPopulateEditAddress, addAddressErrorHandler);
            var validator = $( "#add_address_form" ).validate();
            validator.resetForm();
        }

        function editAddressSuccessHandler(response) {
            $("#ajax-loader").hide();
            if(response) {
                if(response.status) {
                    getAddressList();
                    
                    showStrError("success", response.message);
                    closeAddressModal();
                }
                else {
                    showStrError("error", response.message);
                }
            }  
        }

        function editAddressErrorHandler(response) {
            $("#ajax-loader").hide();
            var errorData = response.responseJSON;

            showStrError("error", errorData.message);
        }

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
                    showStrError('error', "Please select the desired locality from the list");
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
                            }
                            else {
                                showStrError("error", response.message);
                                
                                resetLocality();                         
                            }
                        }
                        $("#ajax-loader").hide();
                    }
                });
            });
        }

        setTimeout(initAutocomplete, 2000);

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
        }

        // To check device source
        if (isMobile.any()) {
            $("#device_source").val('mobile');
        }
        else {
            $("#device_source").val('web');
        }

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
            submitHandler: function (form) {
                var sub_locality = $("#sub_locality").val();
                var locality_id = $("#locality_id").val();
                var city_id = $("#city_id").val();

                if(sub_locality == ''|| locality_id == '' || city_id == '') {
                    showStrError("error", "Please select locality using google dropdown.");
                    resetLocality();
                }
                else {
                    var address_id = $("#address_id").val();

                    if(address_id == '') {
                        ajaxCallPromise(add_address_api_url, "POST", $('#add_address_form').serialize()).then(addAddressSuccessHandler, addAddressErrorHandler);
                    }
                    else {
                        ajaxCallPromise(update_address_api_url, "POST", $('#add_address_form').serialize()).then(editAddressSuccessHandler, editAddressErrorHandler);
                    }
                }
            }
        });

        // this function delete address
        function deleteAddress(address_id) {
            var delete_api_url = "{{url('deleteAddress')}}/" + address_id;
            ajaxCall(delete_api_url, "GET", {}, function(response){
                if(response.status) {
                    $("#address_"+address_id).hide('slow');
                }
                else {
                    showStrError("error", response.message);
                }
                $("#ajax-loader").hide();
            });
        }

    </script>
@endpush