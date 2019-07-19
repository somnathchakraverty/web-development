
<?php $is_loggedin = "false"; ?>
<div class="modal fade getcallback_modal" id="getACallBackModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="margin:0px; padding:10px 0px;">
                <button type="button" class="close" data-dismiss="modal" onclick="fireEvent()">&times;</button>
                
            </div>
            <div class="modal-body text-center" style="margin:0px; padding:0px;">
                <div class="col-md-12 mar-top select-member-option">
                    <div class="alert alert-danger hidden" id="error-msg">
                        <span></span>
                    </div>

                    <div class="gplayreview">
                        <div class="userrate"><img src="/img/user-rate.png"></div>
                        <blockquote><p>Good service in a cost effective manner. Doctor consultation was very good, she explained my test report one by one in detail and suggested for having healthy diet and exercise. The person who collected the sample was also very good, he came on time, collected the sample with cleanliness and in a good manner. Overall nice experience. Keep up the good work healthians team!</p></blockquote>

                        <center>-Kumari Nutan, 10/01/19, Google Play Store</center>

                    </div>

                    <form action="{{url('callBackLead')}}" class="address-cont" id="getACallBackModal_form" name="add_address_form" method="post">

                        <div class="col-sm-12 text-center modaltitle_callback">
                  <h2> Free call back from our Health Advisor </h2>
                    
                </div>
                <div class="col-lg-12 col-xs-12 col-md-12">
                        <div class="alert alert-danger" id="error_div" style="display:none;"></div>
                        <div class="alert alert-success" id="success_div" style="display:none;"></div>
                    
                        {{csrf_field()}}                        

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 normal-input">
                            <label>Name *</label>
                            @if(isset($name))
                                <?php $is_loggedin = "true"; ?>
                                <input autocomplete="off" id="gacb_name" value="{{$name}}" name="gacb_name" maxlength="512" placeholder="Enter full name" required="true" tabindex="1" type="text" readonly>
                            @else
                                <input autocomplete="off" id="gacb_name" name="gacb_name" maxlength="512" placeholder="Enter full name" required="true" tabindex="1" type="text">
                            @endif
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 normal-input">
                            <label>Mobile Number *</label>
                            @if(isset($mobile))
                                <input autocomplete="off" id="gacb_mobile" value="{{$mobile}}"  name="gacb_mobile" maxlength="512" placeholder="Enter 10-digit mobile no." required="true"  minlength="10" maxlength="10" tabindex="1" type="text" readonly>
                            @else
                                <input autocomplete="off" id="gacb_mobile"  name="gacb_mobile" maxlength="512" placeholder="Enter 10-digit mobile no." required="true" tabindex="1"  minlength="10" maxlength="10"  type="text">
                            @endif
                        </div>                        
                        <div class="modal-footer-popup">
                            <button type="submit" class="btn btn-danger btn_cmncolor" onClick="validateGetCallBackForm();">Get A Call Back Now</button>
                        </div>

                        <input type="hidden" name="utm_id" id="utm_id" value="">
                        <input type="hidden" name="source" value="web">
                    </div>
                    </form>
                </div>
            </div><div class="clearfix"></div>
        </div>                               
    </div> 
    <div class="clearfix"></div>      
</div> 
@push('footer-scripts')            
    <script type="text/javascript">
        var is_loggedin = <?php echo $is_loggedin ?>;
        var ptype   =   null;
        <?php if(isset($ptype)){ ?>
            ptype   =    "{{$ptype}}";            
        <?php } ?>
        function fireEvent(){            
            if(ptype !== null){
                if (isMobile.any()) 
                   pushGaEvent(ptype+ " - Mobile Call To Book Pop up", "Mobile - Call To Book Pop up - Close");
                else
                   pushGaEvent(ptype + " - Call To Book Pop up", "Call To Book Pop up - Close");
            }else{
                if (isMobile.any()) 
                   pushGaEvent("Mobile Call To Book Pop up", "Mobile - Call To Book Pop up - Close");
                else
                   pushGaEvent("Call To Book Pop up", "Call To Book Pop up - Close");
            }
        }
        /* Get a call back Code - Start */
        function callBackSuccessHandler(response) {
            $("#ajax-loader").hide();
            if(response) {
                if(response.status){
                    if(!response.hasOwnProperty("new_lead")) {
                        $("footer").append(response.data);
                        if(is_loggedin == "false")
                            $('#getACallBackModal_form')[0].reset();
                        localStorage.removeItem('vendor_code');
//                        var url = window.location.toString();
//                                $("#lead_success_msg").removeClass('hidden');
//                                window.location.href = url.split(/[?#]/)[0];

//                            if(typeof scope.stateParms.publisher_id !== 'undefined') {
//                                $analytics.eventTrack('Vendor Publisher Pixel', {
//                                    category: $location.search().vendor_code,
//                                    label: scope.stateParms.publisher_id
//                                });                                        
//                            }
//                            else {
//                                $analytics.eventTrack('Vendor Pixel', {
//                                    category: $location.search().vendor_code,
//                                    label: lead_id                                      
//                                });
//                            }
                    }else if(response.hasOwnProperty("new_lead")){
                        localStorage.removeItem('vendor_code');
                        var url = window.location.toString();

//                                $("#lead_success_msg").removeClass('hidden');
//                                window.location.href = url.split(/[?#]/)[0];
                    }
                    if (isMobile.any()){
                        if(ptype !== null)
                            pushGaEvent(ptype + ' - Mobile Call To Book Pop up', 'Lead Captured', $("input[name='gacb_mobile']").val());
                        else
                            pushGaEvent('Mobile Call To Book Pop up', 'Lead Captured', $("input[name='gacb_mobile']").val());
                    }else{
                        if(ptype !== null)
                            pushGaEvent(ptype + ' - Call To Book Pop up', 'Lead Captured', $("input[name='gacb_mobile']").val());
                        else
                            pushGaEvent('Call To Book Pop up', 'Lead Captured', $("input[name='gacb_mobile']").val());
                    }
                    $("#success_div").show();
                    $("#success_div").html(response.message);
                    setTimeout(function() {
                        $("#success_div").hide();
                        $("#success_div").html("");  
                        $('#getACallBackModal').modal('hide');
                    }, 6000);
//                    
                }
                else {
                    pushGaEvent('Call To Book Pop up', 'Validation Fail', $("input[name='gacb_mobile']").val());
                    $("#error_div").show();
                    $("#error_div").html(response.message);
                    setTimeout(function() {
                        $("#error_div").hide();
                        $("#error_div").html("");
                    }, 8000);
                }
            }  
        }
        
        function callBackErrorHandler(response) {
            $("#ajax-loader").hide();
            var errorData = response.responseJSON;

            $("#error_div").show();
            $("#error_div").html(errorData.message);

            setTimeout(function() {
                $("#error_div").hide();
                $("#error_div").html("");
            }, 8000);
        }
        
        // To check device source
        if (isMobile.any()) {
            $("input[name='source']").val('mobile');
        }
        else {
            $("input[name='source']").val('web');
        }
        
        $(document).ready(function(){
            $('#getACallBackModal').on('hidden.bs.modal', function() {
                var validator = $( "#getACallBackModal_form" ).validate();
                validator.resetForm();
                $('#getACallBackModal_form').trigger("reset");
            });
            var utm_id = (localStorage.getItem('vendor_code') === null) ? 'seoPageLead' : localStorage.vendor_code ;
            $("input[name='utm_id']").val(utm_id);
        });
        
        $('input[name="gacb_mobile"]').keyup(function(e) {
            if (/\D/g.test(this.value))
            {
              // Filter non-digits from input value.
              this.value = this.value.replace(/\D/g, '');
            }
        });
        
        function validateGetCallBackForm() {
            $('#getACallBackModal_form').validate({
                rules: {
                    gacb_name: {
                        required: true
                    },
                    gacb_mobile: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10					
                    }
                },
                messages: {
                    gacb_name: {
                        required : "Please specify your name"
                    },
                    gacb_mobile: {
                        required: "We need your mobile no. to contact you",
                        digits: "Not a valid 10-digit mobile no.",
                        minlength : "Please enter valid 10 digit no.",
                        minlength : "Please enter valid 10 digit no."
                    }
                },
                //submit handler
                submitHandler: function(form)
                {
                    var get_a_call_back_url = $("#getACallBackModal_form").attr('action');                    

                    /* Get from elements values */
                    var values = $('#getACallBackModal_form').serialize() + '&name=' + $("input[name='gacb_name']").val() +'&contact_no=' + $("input[name='gacb_mobile']").val();

                    values = setUrlVars(values);
                    if((getUrlVars()['vendor_code'] == undefined) && ( localStorage.getItem("vendor_code") != null))
                        values += "&vendor_code="+localStorage.vendor_code;
                    
                    ajaxCallPromise(get_a_call_back_url, "POST", values).then(callBackSuccessHandler, callBackErrorHandler);
                    
                    return false;
                }
            });
	}
    </script>
@endpush
        