<style>
#email_id-error { color: white !important;}
</style>
<!-- subscribe section start here -->
<div class="subscribe-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-offset-2 col-sm-8 text-center">
				<h3> Subscribe For Healthy Updates </h3>
                <img class="lazy" data-src="/img/underline-wht.png" style="margin-bottom: 30px;" />

                <div id="subscription_error_msg" style="display:none;color:red;"></div>

				<div class="input-group subscriptionarea">
                    <form id="email_subscription_form" name="email_subscription_form" action="{{url('saveEmailSubscription')}}" method="post">
                        {{csrf_field()}}
			            <input type="email" class="form-control subscribeform" id="email_id" name="email_id" autocomplete="off" placeholder="Enter your email ID">
			            <span class="input-group-btn submitnwsltr">
    			            <button class="btn btn-theme subscribebutton" type="submit" onClick="validateEmailSubscription();">Submit</button>
                        </span>
                    </form>
                    <span class="clearfix"></span>
                    <div id='subscription_success_msg' style="display:none;color:#fff; line-height:30px;">
                        Thank you for subscribing with us.
                    </div>
		        </div>
			</div>
		</div>
	</div>
</div>
<!-- footer section start here -->
<footer>
    <div class="footerseodesc">
    <div class="container">
        <div class="col-sm-12 text-center">
                <p class="footcontent">Healthians.com is India’s largest health test @home service offering a wide range of online blood test in more than 30 cities of India. We also offer all kind of pathology tests including blood, urine and other lab tests with free sample collection from home. Users can avail free health Counselling with every booking. All samples are evaluated at our network of NABL labs spread across pan-India. We have our own team of highly skilled phlebotomist who specialize in blood sample collection from home.</p>
            </div>
    </div>
</div>
<!-- Cities offered by healthians -->
<div class="citiesbottom">
            <div class="container">
                <div class="col-sm-12 text-center">
                    <div class="citywisepackage">
                        <h4>Our Presence</h4>
                        <p>
                        @php($n = count($city_details))
                        @php($i = 0)
                        @foreach($city_details as $city_detail)
                            <a href="{{route('product.city-package-list', [   
                                                                    'city'  => str_replace(' ', '_', strtolower($city_detail))
                                                                ]
                                            )}}">
                                {{$city_detail}} 
                            </a> 
                            @php($i++)
                            @if (($i) != $n) 
                                /
                            @endif
                        @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
<!-- Cities offered by healthians -->



<!--Most Popular tests -->
<div class="popular_parameters">
    <div class="container">
        <div class="col-sm-12 text-center">
                <div class="parameterhomelist">
                    <h3>Our Most Popular Tests</h3>
                                <ul>
                                    <li><a href="/{{$select_city_name}}/parameter/random-blood-sugar" target="_blank">Blood Sugar Test</a></li>
                                    <li><a href="/{{$select_city_name}}/profile/complete-hemogram" target="_blank">CBC Test</a></li>
                                    <li><a href="/{{$select_city_name}}/profile/dengue-igg-and-igm-rapid-card" target="_blank">Dengue Test</a></li>
                                    <li><a href="/{{$select_city_name}}/package/full-body-checkup" target="_blank">Full Body Checkup</a></li>
                                    <li><a href="/{{$select_city_name}}/parameter/hepatitis-b-virus-hbv-hbsag-screening-surface-antigen" target="_blank">HBsAg Test</a></li>
                                    <li><a href="/{{$select_city_name}}/parameter/hiv-duo-hiv12" target="_blank">HIV Test</a></li>
                                    <li><a href="/{{$select_city_name}}/profile/lipid-profile" target="_blank">Lipid Profile Test</a></li>
                                    <li><a href="/{{$select_city_name}}/profile/liver-function-test" target="_blank">Liver Function Test</a></li>
                                    <li><a href="/{{$select_city_name}}/package/healthians-pancreatitis-package" target="_blank">Pancreatitis Test</a></li>
                                    <li><a href="/{{$select_city_name}}/package/early-pregnancy-checkup" target="_blank">Pregnancy Test At Home</a></li>
                                    <li><a href="/{{$select_city_name}}/parameter/psa-free-prostate-specific-antigen-free" target="_blank">PSA Test</a></li>
                                    <li><a href="/{{$select_city_name}}/profile/thyroid-profile-total" target="_blank"> Thyroid Test</a></li>
                                    <li><a href="/{{$select_city_name}}/parameter/hepatitis-b-virus-hbv-anti-hbsag-surface-antibody" target="_blank"> Hepatitis B Test </a></li>
                                    <li><a href="/{{$select_city_name}}/package/vitamin-plus-package-1" target="_blank"> Vitamin Test</a></li>
                                    <li><a href="/{{$select_city_name}}/profile/hba1c" target="_blank"> Diabetes Test</a></li>
                                    <li><a href="/{{$select_city_name}}/parameter/ca-125-serum" target="_blank">CA-125 Test</a></li>
                                    <li><a href="/{{$select_city_name}}/profile/iron-studies" target="_blank"> Iron Studies Test</a></li>
                                    <li><a href="/{{$select_city_name}}/profile/kidney-function-test" target="_blank">Kidney Function Test</a></li>
                                    <li><a href="/{{$select_city_name}}/parameter/ra-test-rheumatoid-arthritis-factor-quantitative" target="_blank">Arthritis Test</a></li>
                                    <li><a href="/{{$select_city_name}}/profile/stool-routine-and-microscopic-examination" target="_blank">Stool Test</a></li>
                                    <li><a href="/{{$select_city_name}}/parameter/uric-acid-serum" target="_blank">Uric Acid Test</a></li>                                   
                                </ul>
                            </div>
            </div>
    </div>
</div>
<!--Most Popular tests -->
<div class="clearfix"></div>
    <div class="container footermidbtm">
        <div class="midbtmbar">
            <div class="col-sm-3 col-xs-12">
               <img class="lazy logosize" data-src="/img/footer-logo.png" class="img-responsive" />
                <h4> Awards & Recognitions </h4>
                <img class="lazy" data-src="/img/other-logos.png" />
            </div>
            <div class="col-sm-5 footermid">
                <ul>
                    <li><a href="/about-us" class="{{ request()->is('about-us') ? 'active' : '' }}" onclick="pushGaEvent('Footer', 'Clicked Footer Link', 'About us')"> About Us </a></li>
                    <li><a href="{{config('constants.healthians_blog_url')}}" onclick="pushGaEvent('Footer', 'Clicked Footer Link', 'Blog')"> Blog </a></li>
                    <li><a href="/healthians-media" class="{{ request()->is('healthians-media') ? 'active' : '' }}" onclick="pushGaEvent('Footer', 'Clicked Footer Link', 'Media')"> Media </a></li>
                    <li><a href="/contact-us" class="{{ request()->is('contact-us') ? 'active' : '' }}" onclick="pushGaEvent('Footer', 'Clicked Footer Link', 'Contact Us')"> Contact Us </a></li>
                    <li><a href="/career" class="{{ request()->is('career') ? 'active' : '' }}" onclick="pushGaEvent('Footer', 'Clicked Footer Link', 'Career')"> Career </a></li>

                    <li><a href="/refund-policy" class="{{ request()->is('refund-policy') ? 'active' : '' }}" onclick="pushGaEvent('Footer', 'Clicked Footer Link', 'Money back policy')"> Money Back Policy </a></li>
                    <li><a href="/healthians-investors" class="{{ request()->is('healthians-investors') ? 'active' : '' }}" onclick="pushGaEvent('Footer', 'Clicked Footer Link', 'Investors')"> Investors </a></li>
                    <li><a href="/feedback" class="{{ request()->is('feedback') ? 'active' : '' }}" onclick="pushGaEvent('Footer', 'Clicked feedback', 'Money back policy')"> Feedback/Complaints </a></li>
                    <li><a href="/labs" class="{{ request()->is('labs') ? 'active' : '' }}" onclick="pushGaEvent('Footer', 'Clicked Footer Link', 'Labs')"> Our Labs </a></li>

                    <!-- <li><a href="/img/notice-general-meeting.pdf" target="_blank">Notice to General Meeting</a></li> -->


                    <li><a href="/deals" class="{{ request()->is('deals') ? 'active' : '' }}" onclick="pushGaEvent('Footer', 'Clicked Footer Link', 'Deals'); pushGaEvent('HomePage', 'Our Deals - Top', 'Deals');"> Health Deals</a></li>
                </ul>
            </div>
            <div class="col-sm-4 footerright">
                <h4> Follow Us</h4>
                <ul class="follow-icon">
                    <li><a href="https://www.facebook.com/Healthians?ref=hl" onclick="pushGaEvent('Footer', 'Clicked Social Media Link', 'Facebook')" target="_blank"> <i class="fa fa-facebook"></i> </a></li>
                    <li><a href="https://twitter.com/healthians" onclick="pushGaEvent('Footer', 'Clicked Social Media Link', 'Twitter')" target="_blank"> <i class="fa fa-twitter"></i> </a></li>
                    <li><a href="https://www.linkedin.com/company/healthians-com?trk=company_name" onclick="pushGaEvent('Footer', 'Clicked Social Media Link', 'Linked-In')" target="_blank"> <i class="fa fa-linkedin" target="_blank"></i> </a></li>
                    <li><a href="https://www.youtube.com/user/Healthians" onclick="pushGaEvent('Footer', 'Clicked Social Media Link', 'Youtube')" target="_blank"> <i class="fa fa-youtube" target="_blank"></i> </a></li>

                    <li><a href="https://www.instagram.com/healthians/?utm_source=ig_profile_share&igshid=qc3h7c2udi3n" target="_blank"> <i class="fa fa-instagram" target="_blank"></i> </a></li>

                    

                </ul>
                <div class="otherlinks">
                    <ul>
                        {{-- <li><a href="javascript:void(0);" target="_blank"> Sitemap </a></li> 
                        <li><a href="/feedback" target="_blank"> Feedback </a></li> --}}
                        {{-- <li><a href="javascript:void(0);"> Employee Login </a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
       
    </div>
    <div class="footer-btm">
        <p> {{ now()->year }} &copy; Healthians.com &nbsp; | <a href="/terms-condition" target="_blank">Legal</a>
        <a href='/statutory-compliance'>&nbsp; | &nbsp;&nbsp; Statutory Compliance </a>
         </p>
    </div>
</footer>

<script>

function validateEmailSubscription() {
    pushGaEvent('Footer', 'Entered Subscribed Form');
    $('#email_subscription_form').validate({
        rules: {
            email_id: {
                required: true,
                email: true,
                maxlength: 255
            }
        },
        messages: {
            email_id: {
                required: "We need your email to contact you",
                email: "Email address must be in the format of test@domain.com"
            }
        },
        submitHandler: function(form) {
            var url = $("#email_subscription_form").attr('action');

            /* Get from elements values */
            var values = $('#email_subscription_form').serialize();

            $.ajax({
                url: url,
                type: "post",
                data: values ,
                beforeSend: function() {
                    $("#ajax-loader").show();
                },
                success: function (response) {
                    pushGaEvent('Footer', 'Subscribed Sucessfully');
                    if(response.status) {
                        $("#subscription_success_msg").show();
                        $("#subscription_error_msg").hide();
                        $("#subscription_success_msg").html(response.message);
                        $('#email_subscription_form')[0].reset();
                        setTimeout(function(){
                            $("#subscription_success_msg").hide();
                        },5000);
                    }
                    else {
                        $("#subscription_error_msg").html('');
                        $("#subscription_error_msg").html(response.message);
                        $("#subscription_error_msg").show();
                        $("#subscription_success_msg").hide();
                        setTimeout(function(){
                            $("#subscription_error_msg").hide();
                        },5000);
                    }
                    $("#ajax-loader").hide();
                    return false;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var jsonResponseText = $.parseJSON(jqXHR.responseText);
                    var error_html = '';
                    pushGaEvent('Footer', 'Failed Email Validation in Subscription Form');
                    if(typeof jsonResponseText === 'object') {
                        error_html += '<ul>';

                        $.each(jsonResponseText, function(i, item) {
                            error_html += '<li style="text-align: left;">'+item+'</li>';
                        });
                        error_html += '</ul>';
                    }
                    else {
                        error_html = jsonResponseText;
                    }
                    $("#subscription_error_msg").html('');
                    $("#subscription_error_msg").html(error_html);
                    $("#subscription_error_msg").show();
                    $("#ajax-loader").hide();
                    return false;
                }
            });
            return false;
        }
    });
}
</script>