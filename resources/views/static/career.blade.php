@extends('layout.master')

@section('page-content')

<style>
    .work-us label { text-decoration: none;}
    label.error { color: #ff0000 !important;}
    .clear { clear: both;}
</style>

{!! $content !!}

{{-- <figure class="inner-banner">
    <img src="/img/career-banner-gray.jpg" alt="banner">
    <figcaption>
        <div class="container">
            <h1>Take Off to <br>A Healthy Career</h1>
            <p>Career @ Healthians</p>
        </div>
    </figcaption>
</figure>
<!-- career area -->
<section class="meet-us career-page">
    <div class="container">
        <h2>Life @ Healthians</h2>
        <img class="center-block" src="/img/underline.png" alt="Icon">
        <div class="career">
            <p>Robust people practices, a vibrant work culture and an environment that is friendly to learning and individual growth within the organization are what make Healthians a great place to work! <br>
            Our employee centric practices ensure the highest standards of fairness, equality, and honesty for all and our vision is to institutionalize a nurturing environment that enables both individual and organizational growth for each person working here.</p>
            <p>At Healthians, you will gain exposure to work with skilled professionals and develop your knowledge through focused learning & development initiatives. Healthians actively encourages balancing personal life and professional commitments by providing flexible work schedules and industry leading employee benefit programs. <br>
            The fact that we develop our own best practices is one of the single biggest differentiating factors for us. Healthians prides itself on being an equal opportunity employer and its practices are a true reflection of its ethics and ethos. </p>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="carer-group">
                    <div class="group-img">
                        <img src="/img/group-img1.jpg" alt="image">
                    </div>
                    <div class="group-text">
                        <h3>Fun @ Work</h3>
                        <p>
                            Healthians’s work environment is collegial and abuzz with round-the-year events. We continuously engage our people through an array of activities and events such as Diwali Celebration, New Year’s eve, Valentine’s special and a day with Family @ Healthians. That is not all; you can also enjoy each and every festival in its own special way with Healthians family. From music to games, you will find unlimited fun across our teams.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="carer-group">
                    <div class="group-img">
                        <img src="/img/group-img2.jpg" alt="image">
                    </div>
                    <div class="group-text">
                        <h3>Talent Development</h3>
                        <p>As an organization, we continuously believe in learning and ensuring the growth of our people. There is great emphasis on making our people upbeat and in-control of the new developments. We follow an extremely focused approach in our learning & development initiatives and make sure that we are taking constructive measures towards enhancing and developing the professional and personal growth of the individuals through internal and external training programs. Together, we believe we can do the best! So, join us to be a part of it all.</p>
                        <a href="#" class="know-more">+ Read More</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="practice-area">
            <h2>People Practices</h2>
            <img class="center-block" src="/img/underline.png" alt="Icon">
            <p>We are committed towards making Healhians a ‘great place to work for’ through our various initiatives. <br>
            The following programs will help you understand the ethos of the organization:</p>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="carer-group">
                        <div class="group-img">
                            <img src="/img/practice1.jpg" alt="image">
                        </div>
                        <div class="group-text">
                            <h3>Talent Acquisition</h3>
                            <p>At Healthians, recruitment at various levels is done through a competency model which focuses on behavior, skills and credentials. Through this process, Healthians ensures that the selected candidate is the right person not only in</p>
                            <a href="#" class="know-more">+ Read More</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="carer-group">
                        <div class="group-img">
                            <img src="/img/practice2.jpg" alt="image">
                        </div>
                        <div class="group-text">
                            <h3>Talent Development</h3>
                            <p>Changing job requirements and fluctuating industry trends make it imperative that companies keep their people up-to-date with the latest skill sets and market information. Healthians continuously </p>
                            <a href="#" class="know-more">+ Read More</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="carer-group">
                        <div class="group-img">
                            <img src="/img/practice3.jpg" alt="image">
                        </div>
                        <div class="group-text">
                            <h3>Talent Management</h3>
                            <p>We continuously provide career development and growth opportunities to our people through rigorous mentoring and coaching which effectively propels employees to achieve greater heights in performance and enhance their</p>
                            <a href="#" class="know-more">+ Read More</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="carer-group">
                        <div class="group-img">
                            <img src="/img/practice4.jpg" alt="image">
                        </div>
                        <div class="group-text">
                            <h3>Talent Engagement</h3>
                            <p>By making our work environment open and invigorating, we give our people the opportunity to reinvent themselves and strive for higher grounds. The company encourages job rotation and internal selection at lateral levels to provide</p>
                            <a href="#" class="know-more">+ Read More</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="carer-group">
                        <div class="group-img">
                            <img src="/img/practice5.jpg" alt="image">
                        </div>
                        <div class="group-text">
                            <h3>Talent Recognition</h3>
                            <p>Reward and recognition program appreciates and recognizes outstanding performance and achievements by employees through a series of rewards. Not only that; Healthians is known for its strong alumni network, strong cultural </p>
                            <a href="#" class="know-more">+ Read More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="opportunity-area">
                <h2>Opportunities @ Healthians</h2>
                <img class="center-block" src="/img/underline.png" alt="Icon">
                <div class="opportunity-para">
                    <p>Opportunity to work with a leading brand in Health Care Industry <br>
                    We are looking for talented professionals to fill in the below mentioned opportunities.
                    Interested candidates may mail their resumes to <a href="mailto:careers@healthians.com">careers@healthians.com</a>.</p>
                    <p>Please remember to mention the job title in the subject line.<br>
                    For more information on the opportunities, please write to us at  <a href="mailto:hr@healthians.com">hr@healthians.com</a></p>
                </div>
            </div>

            <div class="work-us">
                <h4>Work with Us</h4>
                [career_form]
            </div>
        </div>
    </div>
</section> --}}

@endsection

@push('footer-scripts')
<script src="/js/additional-methods.min.js"></script>

<script type="text/javascript">
    var form_submitted = Boolean('{!! ($form_submit_success || $form_submit_error) ? true : false !!}')
    $(document).ready(function(){
		$.validator.addMethod("lettersonlywithspace", function(value, element) {
			return this.optional(element) || /^[a-z\s]+$/i.test(value);
		});

		if( form_submitted )
        {
            window.location.hash = 'form_message';
        }
	});

	function validateCareerForm() {
		$('#career_form').validate({
			rules: {
				name: {
					required: true,
					lettersonlywithspace: true,
                    maxlength: 255	
				},
				email_id: {
					required: true,
					email: true,
                    maxlength: 255
				},
				contact_no: {
					required: true,
					digits: true,
					minlength: 10,
					maxlength: 10					
				},
                post_applied : {
                    required: true,
                    maxlength: 100
                },
                experience : {
                    required: true,
                    number: true,
                    maxlength: 2
                },
                current_organization : {
                    required: true,
                    maxlength: 255
                },
                current_designation : {
                    required : true,
                    maxlength: 255
                },
                notice_period : {
                    required: true,
                    maxlength : 100,
                },
				address: {
					required: true,
					maxlength: 512	
				},
                resume: {
					extension: "docx|doc|pdf"
				}
			},
			messages: {
				name: {
					required : "Please specify your name",
					lettersonlywithspace: "Please enter characters only"
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
                post_applied: {
                    required : "Please select Job Profile"
                },
                experience: {
                    required : "Please enter total experience (in years)",
                    number : "Please enter valid experience in numeric value"
                },
                current_organization: {
                    required : "Please enter Current Organization"
                },
                current_designation: {
                    required : "Please enter Current Designation"
                },
                notice_period: {
                    required : "Please select notice period"
                },
                address: {
                    required : "Please enter address"
                },
                resume: {
					extension: "Please upload resume in doc, docx and pdf format only."
				}
			}
		});
	}
</script>
@endpush