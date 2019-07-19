@extends('layout.master')

@section('page-content')
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
                                        <div>
                                            <strong>Customized</strong>
                                            <p>Real Time Packages</p>
                                        </div>
                                    </div>

                                    <div class="item"><img src="/img/cost-effective.png" alt="">
                                        <div> <strong>Cost Effective</strong>
                                        <p>Honest Price Guaranteed</p></div>
                                    </div>
                                    <div class="item"><img src="/img/Convenient.png" alt="">
                                        <div> <strong> Convenient</strong>
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
                                <h3>Login/Sign Up with Mobile</h3>
                                <div class="underlineblue"></div>
                                <form action="{{url('login')}}" id="login_form" name="login_form" method="post">
                                    {{csrf_field()}}

                                    <!-- ---location btn-div start here-- -->
                                    <div class="countrycode_select">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" id='selected_country_code'><img src="{{ $india_country['image_path'] }}"> + {{ $india_country['countries_isd_code'] }}
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdowncountry">
                                            @foreach($country_list as $country)
                                                <li><a href="javascript:void(0);" class='country_code_href' data-img='{{ $country['image_path'] }}' data-id='{{ $country['countries_isd_code'] }}'><img src="{{$country['image_path']}}"> + {{ $country['countries_isd_code'] }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    </div>                                  
                                    <!-- ---location btn-div start here-- -->

                                    <input type="hidden" name="template" value="login">
                                    <input type="hidden" name="countryCode" value="{{ $india_country['countries_isd_code'] }}">
                                    <!-- ---mobile no btn-div start here-- -->
                                    <div class="mob-input">
                                        <input type="text" name="mobile_number" autocomplete="off" id="mobile_number" placeholder="Enter your Mobile Number" minlength="10" maxlength="10" required>
                                    </div>   
                                    <!-- ---view detail btn-div start here-- -->
                                    <div class="loginbtndiv">
                                        <button onClick="validateLoginDetail();" class="hidden" id="login_button">Button</button>
                                        <a href="javascript:void(0);" class="btn btn-danger" id="submit_login"> Login <img src="/img/left-icon.png" width="20px;"> </a>
                                    </div>
                                </form>
                               <!-- ---signup btn-div start here-- -->
                                <!-- <div class="login-sign">
                                    <a href="javascript:void(0);" class="btn btn-danger"> Sign up </a>
                                </div> -->
                               <div class="clearfix"></div>
                                <!-- ---Or Sign Up With start here-- -->
                                
                                <!-- <div class="orsignup text-center">
                                    Or Sign Up with
                                </div> -->
                                
                                <!-- ---face book----and google + start here-- -->
                                <!-- <div class="fb-mailbtndiv">
                                    <a href="javascript:void(0);" class="btn btn-dangerfb"><img src="/img/fb.png"> Connect with Facebook </a><span><a href="javascript:void(0);" class="btn btn-dangergplus"> <img src="/img/g+.png"> Connect with Google </a></span>
                                </div> -->
                                <br><br>
                                <p class="proceed">By proceeding, you agree with our <span class="textdanger"><a href="{{ url('terms-condition') }}" target="_blank" class="link-otp">Terms of Service</a></span> & <span class="textdanger"><a href="{{ url('terms-condition') }}" target="_blank"  class="link-otp">Privacy Policy</a></span></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </section>
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        
        $("input[name='mobile_number']").focus();
        
        $('input[name="mobile_number"]').on("cut copy paste",function(e) {
            e.preventDefault();
        });
        
        $('input[name="mobile_number"]').keypress(function(e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && (e.which != 13)) {
                var validator = $( "#login_form" ).validate();
                validator.resetForm();
                $(".mobile_error").remove();
                //display error message
                $( 'input[name="mobile_number"]' ).after( "<label for='mobile_number' class='mobile_error error'>Digits Only</label>" );
                $(".mobile_error").show().fadeOut(400,  function(){ $(".mobile_error").remove(); });
                return false;
            }
        });
        
        $('#submit_login').click(function() {
            $('#login_button').trigger('click');
        });
        $(".country_code_href").click(function(){
            var html = '<img src="'+ $(this).data('img') +'">+ '+ $(this).data('id') +'<span class="caret"></span>';
            $("#selected_country_code").html(html);
            $("input[name='countryCode']").val($(this).data('id'));
        });
        function validateLoginDetail() {
            $('#login_form').validate({
                rules: {
                    mobile_number: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10					
                    }
                },
                messages: {
                    mobile_number: {
                        required    :   "Please enter a valid 10 digit mobile number",
                        digits      :   "Not a valid 10-digit mobile number",
                        minlength   :   "Please enter a valid 10 digit mobile number",
                        minlength   :   "Please enter a valid 10 digit mobile number"
                    }
                },
                //submit handler
                submitHandler: function(form)
                {
                    form.submit();
                    return false;
                }
            });
	}
    </script>
@endpush