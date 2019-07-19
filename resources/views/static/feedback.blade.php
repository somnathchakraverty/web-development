@extends('layout.master')

@section('page-content')

<style>
    .feedback-div .error label{ width:100% !important; }
</style>

{!! $content !!}

{{-- <figure class="inner-banner">
    <img alt="banner" src="/img/feedback-banner.jpg">
    <figcaption>
        <div class="container text-center contact-head">
            <h1>Send Us a Feedback</h1>
            <p>We'd love to hear from you</p>
        </div>
    </figcaption>
</figure><!-- Expedient Healthcare=== section start here -->
<section class="Expedientwraper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="Expedient-Healtdiv text-center feed">
                    <h1>Share Your Experience</h1>
                    <img alt="Icon" class="center-block" src="/img/underline.png">
                    <p>
                        We welcome your feedback and suggestions to help us improve further and serve you better. 
                        <br>
                        If you have any query related to our services, please fill out the form
                    </p>
                </div>

                <div class="feedback-div text-center">
                    [feedback_form]                    
                </div>
            </div>
        </div>
    </div>
</section> --}}

@endsection

@push('footer-scripts')

<script>
    var booking_required = false;
	var form_submitted = Boolean('{!! ($form_submit_success) ? true : false !!}');

    $(document).ready(function(){
		$.validator.addMethod("lettersonly", function(value, element) {
			return this.optional(element) || /^[a-z\s]+$/i.test(value);
		});

        if( form_submitted )
        {
            window.location.hash = 'success_message';
        }
	});

    function selectQuery() {
        var issue_type = $("#issue_type").val();
        if(issue_type !== '') {
            var issue_details = issue_type.split("_");
            var issue_type_booking = [1,2,3,4,12,22,23,25,26,27,55,78];
            booking_required = issue_type_booking.includes(parseInt(issue_details[0]));
            console.log("booki", booking_required);
            if(booking_required) {
                $("#booking_div").show();
                $("#booking_div").attr("required", "true");
            }
            else {
                $("#booking_div").hide();
                $("#booking_div").attr("required", "false");
            }
        }
        else {
            $("#booking_div").hide();
            $("#booking_div").attr("required", "false");
        }
    }

    function validateFeedback() {
        

		$('#feedback_form').validate({
			rules: {
				name: {
					required: true,
					lettersonly: true
				},
				email_id: {
					required: true,
					email: true
				},
				contact_no: {
					required: true,
					digits: true,
					minlength: 10,
					maxlength: 10					
				},
				issue_type: {
					required: true
				},
                booking_id : {
                    required: true,
                    digits: true,
                    minlength: 6,
                    maxlength: 15
                },
				message: {
					maxlength: 512	
				}
			},
			messages: {
				name: {
					required : "Please specify your name",
					lettersonly: "Please enter characters only"
				},
				email_id: {
					required: "We need your email to contact you",
					email: "Email address must be in the format of test@domain.com"
				},
				contact_no: {
					required: "We need your mobile no. to contact you",
					digits: "Not a valid 10-digit mobile no.",
					minlength : "Please enter valid 10 digit no.",
					minlength : "Please enter valid 10 digit no."
				},
                booking_id: {
					digits: "Enter booking id in numeric format",
					required: "Booking ID is required !",
                    minlength : "Please enter a valid Booking ID",
                    maxlength : "Please enter a valid Booking ID",
				}
			},
            submitHandler: function (form) {
                if(booking_required) {
                    if($("#booking_id").val() === '') {
                        showStrError("error", "Booking Id is required. Please enter booking Id.");
                        return false;
                    }                    
                }
                form.submit();
            }
		});
	}

    

</script>
<style>
	#tars-widget-fab .convbot-button{ left: 0!important; }
	#tars-widget-fab .callout-message .callout-message-tick{ border-right: 12px solid #fff!important; left: -11px!important;border-left:0!important;}
	#tars-widget-fab{ left: 18px;!important; }
	#tars-widget-fab .callout-message{ left: 74px!important; }
	#tars-cb-widget{ left: 100px!important; }
</style>
<script>(function(){var js,fs,d=document,id="tars-widget-script",b="https://tars-file-upload.s3.amazonaws.com/bulb/";if(!d.getElementById(id)){js=d.createElement("script");js.id=id;js.type="text/javascript";js.src=b+"js/widget.js";fs=d.getElementsByTagName("script")[0];fs.parentNode.insertBefore(js,fs)}})();window.tarsSettings = {"convid":"S18mhD","img":"https://www.healthians.com/img/healthians-bot-icon.png"};</script>
@endpush