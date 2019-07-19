@extends('layout.master')

@section('page-content')

<style>
	.text-area textarea {width:100%;}
</style>

{!! $content !!}

 {{-- <figure class="inner-banner">
	<img alt="banner" src="/img/contactus.jpg">
	<figcaption>
		<div class="container">
			<h1>Need to Connect?</h1>
			<p class="visible-xs">Call Us at 999-888-000-5</p>
		</div>
	</figcaption>
</figure>
<!-- Expedient Healthcare=== section start here -->
<section class="Expedientwraper">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="Expedient-Healtdiv">
					<h1>Expedient Healthcare<br>
					Marketing Pvt. Ltd.</h1><img alt="Icon" class="center-block" src="/img/underline.png">
					<div class="Wing-Floordiv">
						<p>A Wing, Floor I, A-26, Omega Center, Sector 34, Info City,<br>
						Gurgaon 122 001, Haryana, India.</p>
					</div>

					<div class="contact-info">
						<div class="cont-d">
							<div class="contact-heading">
								<p>Call </p>
							</div>
							<div class="contact-cont">
								<p>999-888-000-5</p>
							</div>
						</div>

						<div class="cont-d">
							<div class="contact-heading">
								<p>Email </p>
							</div>
							<div class="contact-cont">
								<p>Customer Support<br>
								<span>cs@healthians.com</span></p>
								<p>Become Partner<br>
								<span>partners@healthians.com</span></p>
								<p>Marketing/PR<br>
								<span>marketing@healthians.com</span></p>
								<p>For Corporate Health Camp<br>
								<span>camp@healthians.com</span></p>
								<p>Career<br>
								<span>careers@healthians.com</span></p>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				[contact_us_form]
			</div>
		</div>
	</div>
</section> --}}

<!-- ======map section strt here -->

<section class="map-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<iframe allowfullscreen frameborder="0" height="400" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3508.5688418805466!2d77.0120553150781!3d28.432263982497226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d181ccee9abed%3A0x52c074ac3118ef36!2sHealthians!5e0!3m2!1sen!2sin!4v1545631266901" style="border:0" width="100%"></iframe>
			</div>
		</div>
	</div>
</section>


@endsection

@push('footer-scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$.validator.addMethod("lettersonly", function(value, element) {
			return this.optional(element) || /^[a-z\s]+$/i.test(value);
		});
	});
	function validateContactUs() {
		$('#contact_us').validate({
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
				company: {
					required: true,
					maxlength: 255
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
				}
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