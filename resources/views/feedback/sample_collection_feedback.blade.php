@extends('layout.master')

@section('page-content')

<style>
.your-feedback.text-center {padding: 20px;background-color: #1a9ca6;}
.text-center{text-align: center;}
.text-white {color: #fff;}
.your-feedback.text-center p{padding-top: 15px;color: #ffffff;font-size: 14px;}
.your-feedback.text-center h1{font-weight: 600;font-family: 'Open Sans',sans-serif;font-size: 28px;}
.sample-collector.text-center { padding: 20px;box-shadow: 0 6px 10px rgba(148, 148, 148, 0.3);}
.sample-collector.text-center h2 {color: #1a2332;font-size: 25px; margin-bottom: 32px;}
.sample-collector.text-center p {padding: 0px;margin: 0px;color: #7f7f7f;font-size: 14px;font-weight: 600;}
.tab-content {padding-top: 30px;padding-bottom: 30px;}
.tab-content a#btnNext{ border-radius: 20px;background: #e6e6e6;border: none;border: 1px solid #CCC; color: #000000}
.sample-collector.text-center h2 {padding: 0px 155px;}
.img-circle {border-radius: 50%;background: #ccc; box-shadow: 0 2px 1px #ccc;}
.star-rating.sample-collection span.fa.fa-star.checked { color: #e6e6e6; font-size: 2.4em;background: #f5f5f5;border-radius: 50%;width: 56px; height: 56px;}
.sample-collector.text-center.sample-collector-section {padding-top: 90px;padding-bottom: 90px;}

.star-rating.sample-collection	span.fa.fa-star.checked:hover{color: #fac917;}
.star-rating.sample-collection .fa-star:before{position: relative;top: 12px;}
.your-feedback-section.text-center {background: #ccc;}
.your-feedback-section.text-center h1 {color: #fff;font-weight: 600; font-family: 'Open Sans',sans-serif;font-size: 28px;}
.your-feedback-section.text-center { background: #00a0a8;padding-top: 120px; padding-bottom: 120px;}
.your-feedback-section.text-center p{color: #fff;}
.sample-collections.sample-checkmark {position: relative;padding-left: 35px;margin-bottom: 12px;cursor: pointer;-webkit-user-select: none;-moz-user-select: none;
		-ms-user-select: none;user-select: none;}

.sample-collections.sample-checkmark input {position: absolute;opacity: 0;cursor: pointer;height: 0;width: 0;}
.sample-collections.sample-checkmark	.checkmark-btn { position: absolute;top: 12px;left: 13px;height: 18px;width: 18px;background-color: #fff!important;border-radius: 50%;border:1px solid #959595;}
.sample-collections.sample-checkmark:hover input ~ .checkmark-btn {background-color: #ccc;}
.sample-collections.sample-checkmark	.checkmark-btn:after {content: "";position: absolute;display: none;}
.sample-collections.sample-checkmark input:checked ~ .checkmark-btn:after {display: block;}
.sample-collections .checkmark-btn:after {top: 2px;left: 2px;width: 12px;height: 12px;border-radius: 50%;background: #FF9800;}
label.sample-collections.btn-default {min-width: 110px;height: 46px;line-height: 43px;text-align: center;background-color: #ffffff;
		border: 1px solid #f27d27;color: #f27d27;border-radius: 25px;font-size: 15px;margin-left: 23px;padding-right: 32px;
	box-shadow: 0 0 12px 0 rgba(35,47,53,.38);}
.hidden_quest {display: none;}
.btn-next {display: inline-block !important;border-radius: 20px;background: #e6e6e6; border: none;border: 1px solid #CCC;color: #000000;}
.btn-primary:hover {background-color: #1a9ca6;border-color: transparent;}
/*media only screen max-width 768px*/
@media (max-width: 768px){
.wrapper.text-center.dressed-section {display: inline-flex;padding-top: 64px}
label.sample-collections.btn-default{margin-left: 8px;}
.sample-collector.text-center.sample-collector-section{padding-top: 50px;padding-bottom: 50px}
.sample-collector.text-center h2 {padding: 0px 25px;}

}
/*media only screen max-width 600px*/
@media only screen and (max-width: 600px){
.sample-collector.text-center h2{font-size: 16px;}
.img-dressed {position: absolute;margin-top: 127px;}
.img-bag {position: relative;left: 137px;}
.sample-collector.text-center.sample-collector-section{padding-top: 32px; padding-bottom: 32px;}
}
/*media only screen max-width 500px;		*/
@media only screen and (max-width: 500px){
    .wrapper.text-center.dressed-section {display: inline-flex;padding-top: 4px}

.sample-collector.text-center h2{padding: 0px; font-size: 16px;}
 .star-rating.sample-collection span.fa.fa-star.checked{color: #e6e6e6;font-size: 2.4em;background: #f5f5f5; border-radius: 50%;width: 53px;height: 56px;font-size: 33px;}
 .your-feedback-section.text-center h1{font-size: 20px;}
label.sample-collections.btn-default{margin-top: 17px;margin-bottom: 17px; }
.your-feedback.text-center h1 {font-size: 22px}
.your-feedback.text-center p {padding-top: 0px}
.sample-collector.text-center{padding: 11px}
.sample-collector.text-center h2{margin-bottom: 26px;}
.img-dressed {position: absolute;margin-top: 110px;left: 47px;top: 5px;}
 .img-bag {position: relative;left: 84px;top: 30px; left: 77px}
 .img-circle{width: 121px}
 .tab-content{padding-top: 58px}
 .sample-collector.text-center.sample-collector-section {padding-top: 30px; padding-bottom: 30px;}
 .cart-section{padding: 2px 0px;}
}
/*media only screen max-width 320px;*/
@media only screen and (max-width: 320px){
    .img-dressed{left: 15px; }
    .your-feedback.text-center h1{font-size: 20px;}
    .your-feedback.text-center p{font-size: 12px;}
}


</style>
<section class="cart-section padding-section">
    <div class="feedback-section">
        <div class="container">
            <div class="your-feedback text-center">
                <h1 class="text-white">We value your feedback</h1>
                <p class="text-white">In our continuous effort to serve you better, we are seeking your help with our feedback questionnaires below:</p>
            </div>
            <form class="rating-stars" name="sample_collection_form" id="sample_collection_form" method="POST">
                <input type="hidden" name="booking_id" value="{{$booking_id}}" >
                <input type="hidden" name="mobile"  value="{{$mobile}}" >
                <input type="hidden" name="click_source" value="{{$click_source}}" >
                <input type="hidden" name="source" id="source" value="web" >
                {{csrf_field()}}

                <div class="questionair_1 sample-collector text-center sample-collector-section" id="q1_div">
                    <p>Question 1  of 5</p>
                    <h2>Did the sample collector reach within the given time slot ?</h2>        
                    <label class="sample-collections  sample-checkmark  btn-default">Yes
                        <input type="radio" id="reach_time_1" name="reach_time" value="y" onClick="clickRadio(1);" required>
                        <span class="checkmark-btn"></span>
                    </label>
                    <label class="sample-collections sample-checkmark btn-default">No
                        <input type="radio" id="reach_time_2" name="reach_time" value="n" onClick="clickRadio(1);" required>
                        <span class="checkmark-btn"></span>
                    </label>
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <a class="btn btn-primary btn-next hidden_quest" name="next_q1" id="next_q1" onClick="showNext();">Next</a>
                        </div>
                    </div>
                </div>
                <div class="questionair_2 sample-collector text-center hidden_quest" id="q2_div">
                    <p>Question 2 of 5</p>
                    <h2>Was the sample collector properly dressed and was carrying  Healthians’ bag ? </h2>
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="img-dressed">
                                <img src="img/phlebo_image.png"  class="img-circle" alt="img-dressed">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <center>
                                 <div class="wrapper text-center  dressed-section">
                                <label class="sample-collections sample-checkmark  btn-default">Yes
                                    <input type="radio" id="properly_dressed_1" name="properly_dressed" value="y" onClick="clickRadio(2);">
                                    <span class="checkmark-btn"></span>
                                </label>
                                <label class="sample-collections  sample-checkmark btn-default">No
                                    <input type="radio" id="properly_dressed_2" name="properly_dressed" value="n" onClick="clickRadio(2);">
                                    <span class="checkmark-btn"></span>
                                </label>
                            </div>
                            </center>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="img-bag">
                                <img src="img/phlebo_bag.png" class="img-circle" alt="">  
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <a class="btn btn-primary btn-next" name="prev_q2" id="prev_q2" onClick="showPrevious();">Back</a>
                            <a class="btn btn-primary btn-next hidden_quest" name="next_q2" id="next_q2" onClick="showNext();">Next</a>
                        </div>
                    </div>
                </div>
                <div class="questionair_3 sample-collector text-center hidden_quest" id="q3_div">
                    <p>Question 3 of 5</p>
                    <h2>Were you duly informed about the sealed kit before the sample collection? </h2>
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="img-dressed">
                                <img src="img/bag_kit.jpg"  class="img-circle" alt="img-dressed">
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <center>
                                <div class="wrapper text-center  dressed-section">
                                    <label class="sample-collections sample-checkmark  btn-default">Yes
                                        <input type="radio" id="sealed_kit_1" name="sealed_kit" value="y" onClick="clickRadio(3)">
                                        <span class="checkmark-btn"></span>
                                    </label>
                                    <label class="sample-collections sample-checkmark  btn-default">No
                                        <input type="radio" id="sealed_kit_2" name="sealed_kit" value="n" onClick="clickRadio(3)">
                                        <span class="checkmark-btn"></span>
                                    </label>
                                </div>
                            </center>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="img-bag">
                                <img src="img/smart-prik.jpg" class="img-circle" alt="img-bag">  
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <a class="btn btn-primary btn-next" name="prev_q3" id="prev_q3" onClick="showPrevious();">Back</a>
                            <a class="btn btn-primary btn-next hidden_quest" name="next_q3" id="next_q3" onClick="showNext();">Next</a>
                        </div>
                    </div>
                </div>
                <div class="questionair_4 sample-collector text-center sample-collector-section hidden_quest" id="q4_div">
                    <p>Question 4 of 5</p>
                    <h2>Did the sample collector show you the technical & quality process video?</h2>
                    <center>
                        <div class="wrapper text-center">
                            <label class="sample-collections sample-checkmark btn-default">Yes
                                <input type="radio" id="tech_video_1" name="tech_video" value="y" onClick="clickRadio(4)">
                                <span class="checkmark-btn"></span>
                            </label>
                            <label class="sample-collections  sample-checkmark btn-default">No
                                <input type="radio" id="tech_video_2" name="tech_video" value="n" onClick="clickRadio(4)">
                                <span class="checkmark-btn"></span>
                            </label>
                        </div>
                    </center>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <a class="btn btn-primary btn-next" name="prev_q4" id="prev_q4" onClick="showPrevious();">Back</a>
                            <a class="btn btn-primary btn-next hidden_quest" name="next_q4" id="next_q4" onClick="showNext();">Next</a>
                        </div>
                    </div>
                </div>
                <div class="questionair_5 sample-collector text-center sample-collector-section hidden_quest" id="q5_div">
                    <p>Question 5 of 5</p>
                    <h2>Please rate us on your overall experience. </h2>
                    <div class="star-rating sample-collection">   
                        <input type="hidden" name="rating_val" id="rating_val"> 
                        <ul id="stars">
                            <li class="star" title="Poor" data-value="1" onClick="clickRadio(5)">
                                <i class="fa fa-star fa-fw"></i>
                            </li>
                            <li class="star" title="Fair" data-value="2" onClick="clickRadio(5)">
                                <i class="fa fa-star fa-fw"></i>
                            </li>
                            <li class="star" title="Good" data-value="3" onClick="clickRadio(5)">
                                <i class="fa fa-star fa-fw"></i>
                            </li>
                            <li class="star" title="Excellent" data-value="4" onClick="clickRadio(5)">
                                <i class="fa fa-star fa-fw"></i>
                            </li>
                            <li class="star" title="WOW!!!" data-value="5" onClick="clickRadio(5)">
                                <i class="fa fa-star fa-fw"></i>
                            </li>
                        </ul> 
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <a class="btn btn-primary btn-next" id="btnNext" onClick="showPrevious();">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection

@push('footer-scripts')

<script>
    var current        = 1;
    var max_question    = 5;
    var save_sample_collection_feedback  = "{{url('saveSampleCollectionFeedback')}}";  
    
    if (isMobile.any()) {
        $('#source').val("mobile");
    }
    else {
        $('#source').val("web");
    }

    function clickRadio(ques) {
        current = ques;
        if(ques === 5) {
            submit_feedback();
        }
        else {
            $('#q'+ques+'_div').fadeOut("slow");

            setTimeout(function(){
                var nextquest = parseInt(ques)+1;
                $('#q'+nextquest+'_div').fadeIn("slow");                
                current = nextquest;
                $('#next_q'+ques).css('display', 'block');       
            }, 500);
        }
    }

    function showPrevious() {
        var prev_ques = parseInt(current)-1;
        var cur_quest = parseInt(current);

        $('#q'+cur_quest+'_div').fadeOut("slow");
        
        setTimeout(function(){
            $('#q'+prev_ques+'_div').fadeIn("slow");
        }, 500);
        
        current = prev_ques;    
    }

    function showNext() {
        var next_ques = parseInt(current)+1;
        var cur_quest = parseInt(current);
        $('#q'+cur_quest+'_div').fadeOut("slow");

        setTimeout(function(){
            $('#q'+next_ques+'_div').fadeIn("slow");
        }, 500);

        current = next_ques;      
    }

    function sampleCollectionSaveSuccess(response) {
        $("#ajax-loader").hide();
        var ratinfo = $("#rating_val").val();

        if(response) {
            if(response.status) { 
                $('#sample_collection_form')[0].reset();               
                showStrError("success", response.message);
                
                setTimeout(function() {
                    if(parseInt(ratinfo) <=4) {
                        window.location.href = "/feedback";
                    }
                    else {
                        if (isMobile.any()) {
                            if (isMobile.iOS()) {
                                window.location.href = 'https://itunes.apple.com/in/app/healthians/id1453011241?mt=8';
                            }
                            else {
                                window.location.href = 'https://play.google.com/store/apps/details?id=com.healthians.main.healthians';
                            }                            
                        }
                        else {
                            window.location.href = "https://www.google.co.in/search?q=healthians&rlz=1C1CHZL_enIN755IN755&oq=healthians&aqs=chrome..69i57j69i60l5.2969j0j1&sourceid=chrome&ie=UTF-8#lrd=0x390d181ccee9abed:0x52c074ac3118ef36,3";
                        }
                    }
                }, 3000);
            }
            else {
                showStrError("error", response.message);
            }
        }  
    }

    function sampleCollectionSaveError(response) {
        $("#ajax-loader").hide();
        var errorData = response.responseJSON;

        showStrError("error", errorData.message);
    }

    function submit_feedback() {
        setTimeout(function(){
            var formData = $('#sample_collection_form').serialize();
            ajaxCallPromise(save_sample_collection_feedback, "POST", formData).then(sampleCollectionSaveSuccess, sampleCollectionSaveError);
        }, 500);
    }

    $(document).ready(function(){
        /* 1. Visualizing things on Hover - See next part for action on click */
        $('#stars li').on('mouseover', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e){
                if (e < onStar) {
                    $(this).addClass('hover');
                }
                else {
                    $(this).removeClass('hover');
                }
            });
        }).on('mouseout', function(){
            $(this).parent().children('li.star').each(function(e){
                $(this).removeClass('hover');
            });
        });

        /* 2. Action to perform on click */
        $('#stars li').on('click', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            $("input[name='rating_val']").val(ratingValue);
        });
    });  

</script>
@endpush