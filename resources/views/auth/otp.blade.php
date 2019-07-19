@extends('layout.master')

@section('page-content')

<!-- ---welcome to healtains div start here-------- -->
    <section class="Wlcm-Healthians">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2>Welcome to Healthians!</h2>
                    <p>Please enter your Mobile Number to proceed</p>
                    <img src="/img/underline.png" class="underline" alt="" >
                </div>
            </div>
            <!-- box section start here -->
            <div class="row">
                <div class="login-outer">
                    <div class="col-sm-12 login-wraper">
                        <!-- ---left box div start here-- -->
                        <div class="left-boxdiv text-center">
                            <div id="owl-demo1">
                                <div class="item"><img src="/img/boxicon.png" alt="">
                                    <div><strong>Customized</strong>
                                    <p>Real Time Packages</p></div>
                                </div>

                                <div class="item"><img src="/img/cost-effective.png" alt="">
                                    <div> <strong>Cost Effective</strong>
                                    <p>Honest Price Guaranteed</p></div>
                                </div>
                                <div class="item"><img src="/img/Convenient.png" alt="">
                                    <div> <strong>Convenient</strong>
                                    <p>Free Home Sample Collection</p></div>
                                </div>
                                <div class="item"><img src="/img/timer.png" alt="Owl Image">
                                    <div><strong>Carefree</strong>
                                    <p>Accurate Results on Time</p></div>
                                </div>
                                <div class="item"><img src="/img/complete.png" alt="Owl Image">
                                    <div><strong>Complete</strong>
                                    <p>Pro-active Wellness Support</p></div>
                                </div>
                            </div>
                        </div>
                        <!-- ---right box div start here-- -->
                        <div class="right-boxdiv">
                            <h3>Login with Mobile</h3>
                            <div class="underlineblue">
                            </div>

                            <!-- ---location btn-div start here-- -->
                            <div class="verifycode-div text-center">
                                <img src="/img/confirmotp.png" alt="">	
                                <p>Please enter verification code (OTP) sent to </p>
                                <strong>+{{$countryCode}} {{$mobile_number}} </strong>
                                <p class="success hidden" id="otp-success">OTP has been sent to your above mobile number. </p>
                                <input type="hidden" value="{{$mobile_number}}" name="mobile_number">
                                <input name="otp" type="hidden" class="inline_input" maxlength="1">
                                <input name="template" value="{{$template}}" type="hidden" class="inline_input" maxlength="1">
                                <input name="countryCode" value="{{$countryCode}}" type="hidden" class="inline_input" maxlength="1">
                            </div>
                            <!-- otp input boxes div -->
                            <div class="otpinputboxes">
                                <div class="confirmation_code split_input large_bottom_margin" data-multi-input-code="true">
                                    
                                    <!--New OTP Section -->
                                    <div class="newOTPwrap">
                                         <input type="text" id="pincode-input2"> 
                                         <br> 
                                    </div>

                                    <div class="clear"></div>
                                    <div class="col-md-12 otppagearea">
                                        <div class="col-md-8">
                                            <p class="error hidden" id="otp-error" style="font-size:11px;">Wrong OTP applied</p>
                                            <p id="timer_detail"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <strong class="text-right">
                                                <a href="javascript:void(0);" id="resend_code" class="link-otp hidden">Resend OTP</a>
                                            </strong>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <!--New OTP Section -->
                                    <label id="otp-error-msg" class="error hidden" for="otp">We need your mobile no. to contact you</label>
                                </div>
                                <!-- ---view detail btn-div start here-- -->

                                <div class="loginbtndiv">
                                      <a href="javascript:void(0);" data-url="{{url('otp')}}" class="btn btn-danger" id="login_button"> Login <img src="/img/left-icon.png" width="20px;"> </a>
                                      <p>By proceeding, you agree with our <span class="textdanger"><a href="{{ url('terms-condition') }}" target="_blank"  class="link-otp">Terms of Service</a></span>
                                      & <span class="textdanger"><a href="{{ url('terms-condition') }}" target="_blank" class="link-otp">Privacy Policy</a></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </section>
@endsection
@push('footer-scripts')


<script src="https://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
<!--Bootstrap OTP Input 6 Fields  -->

<script type="text/javascript" src="/js/bootstrap-pincode-input.js"></script>

    <script type="text/javascript">
        var timeLeft = 30;
        var elem = document.getElementById('timer_detail');

        var timerId;

        function countdown() {
            if (timeLeft == -1) {
                clearInterval(timerId);
                timeLeft = 30;
                $("#timer_detail").addClass("hidden");
                $("#resend_code").removeClass("hidden");
                elem.innerHTML = 'Get OTP again in ' +timeLeft + ' seconds';
            } else {
                elem.innerHTML = 'Get OTP again in ' +timeLeft + ' seconds';
                timeLeft--;
            }
        }
        
        function otpSuccessMsg(){            
            $( "#otp-success" ).removeClass( "hidden", 1000, callback());  // Add Class 
            function callback() {
                setTimeout(function() {
                    $( "#otp-success" ).addClass( "hidden" );  // Remove Class after delay of 2sec
                }, 2000 );
            }
            timerId = setInterval(countdown, 1000);
            $("#timer_detail").removeClass("hidden");
            $("#resend_code").addClass("hidden");
        }
        
        otpSuccessMsg();
        $("#otp-success").removeClass('hidden');
        $("#resend_code").click(function() {
            var mobile = $("input[name='mobile_number']").val();
            var template = $("input[name='template']").val();
            var countryCode = $("input[name='countryCode']").val();
            $('#pincode-input2').pincodeInput().data('plugin_pincodeInput').clear();
            $("#otp-error").addClass('hidden');
            if((mobile !== null && mobile !== undefined) || (mobile !== null && mobile !== undefined) || (mobile !== null && mobile !== undefined)){
                var values = { 'mobile_number' : mobile, 'template' : template, 'countryCode' : countryCode, '_token' : '{{csrf_token()}}' };
                console.log(values);
                $("#otp-error").addClass('hidden');
                $.ajax({
                    url: "{{url('login')}}",
                    type: "post",
                    data: values ,
                    beforeSend: function() {
                        $("#ajax-loader").show();
                    },
                    success: function (response) {
                        if(response.status){
                            
                            otpSuccessMsg();
                        }else{
                            $("#otp-error").removeClass('hidden');
                            $("#otp-error").text(response.error);
                        }       
                        $("#ajax-loader").hide();     
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var jsonResponseText = $.parseJSON(jqXHR.responseText);
                        
                        $("#otp-error").removeClass('hidden');
                        $("#otp-error").text(jsonResponseText);
                        $("#ajax-loader").hide();
                    }
                });
            }
        });
        
        $('#login_button').click(function() {
            var url = $(this).data('url');
            var otp = $('input[name="otp"]').val();
            var mobile = $("input[name='mobile_number']").val();
            var countryCode = $("input[name='countryCode']").val();
            if(mobile.length != 10){
                $("#otp-error").removeClass('hidden');
                $("#otp-error").text("Mobile number is missing");
            }
            if((otp.toString().length == 6) && (mobile.length == 10)){
                var mobile = $("input[name='mobile_number']").val();
                var source  =   'web';
                if (isMobile.any()) {
                    source  =   'mobile';
                }

                var values = { 'mobileNumber' : mobile, 'otp' : otp, 'source' : source, 'device_source': source , 'countryCode': countryCode, '_token' : '{{csrf_token()}}' };
                
                $.ajax({
                    url: url,
                    type: "post",
                    data: values ,
                    beforeSend: function() {
                        $("#ajax-loader").show();
                    },
                    success: function (response) {
                        if(response.status){
                            if(response.hasOwnProperty("data")) {
                                if(typeof(clevertap) !== 'undefined') {
                                    clevertap.profile.push({
                                        "Site": {
                                            "Name"      : response.data.name,
                                            "Identity"  : response.data.user_id,
                                            "Email"     : response.data.email,
                                            "Phone"     : "+"+countryCode+response.data.mobile,
                                            "MSG-email" : true,
                                            "MSG-push"  : true
                                        }
                                    });
                                }
                            }
                            console.log(response);
                            window.location.href = response.url;
                        }else{
                            $("#otp-error").removeClass('hidden');
                            $("#otp-error").text("Incorrect OTP. Please re-enter the correct OTP");
                            $('#pincode-input2').pincodeInput().data('plugin_pincodeInput').clear();
                            $('#pincode-input2').pincodeInput().data('plugin_pincodeInput').focus();
                        }
                        $("#ajax-loader").hide();
                        return false;
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var jsonResponseText = $.parseJSON(jqXHR.responseText);
                        
                        $("#otp-error").removeClass('hidden');
                        $("#otp-error").text(jsonResponseText);
                        $("#ajax-loader").hide();
                        return false;
                    }
                });
            }else{
                $("#otp-error").removeClass('hidden');
                $("#otp-error").text("Please enter the OTP sent via SMS to login");
            }
        });

        $(document).ready(function() {            
            // enter keyd
            $('input').bind("keydown", function(e) {
                var otp = $('input[name="otp"]').val();
                console.log(otp);
                if(e.keyCode==13 && (otp.toString().length == 6)){
                     $('#login_button').trigger('click');
                }
            });
            
            $('#pincode-input2').pincodeInput({hidedigits:false,inputs:6,complete:function(value, e, errorElement){
                $("input[name='otp']").val(value);                
            }});
        
            $('#pincode-input2').pincodeInput().data('plugin_pincodeInput').focus();
        });        
    </script>
    
    <!--Bootstrap OTP Input 6 Fields Ends  -->

@endpush