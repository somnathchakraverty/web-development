@extends('layout.master')

@section('page-content')

    <section class="cart-section padding-section">
	<div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xs-12">
                    <div class="nps_survey_section col-md-12 col-xs-12 col-sm-12 col-lg-12">

                        <div class="nps_survey_title">
                            <h2>We value your feedback</h2>
                            <p>In our continuous effort to serve you better, we are seeking your help with our feedback questionnaires below:</p>
                        </div>

                        
                        <form class="rating-stars" name="save_nps" id="nps_validation_form" method="POST" action="{{url('nps')}}">
                            <input type="hidden" name="booking_id" value="{{$booking_id}}" >
                            <input type="hidden" name="mobile"  value="{{$mobile}}" >
                            <input type="hidden" name="click_source" value="{{$click_source}}" >
                            <input type="hidden" name="source" value="web" >
                            {{csrf_field()}}

                            <div class="npsfeedbackflt" id="QuesHourDiv">
                                
                                <!--Questionaire One-->
                                <div class="questionair_1 questionair">
                                    <input type="hidden" name="rating_val" id="rating_val">
                                    <h6>Question 1 of 4</h6>
                                    <h3>Please rate us on your overall experience</h3>
                                    <ul id="stars">
                                        <li class="star" title="Poor" data-value="1">
                                            <i class="fa fa-star fa-fw"></i>
                                        </li>
                                        <li class="star" title="Fair" data-value="2">
                                            <i class="fa fa-star fa-fw"></i>
                                        </li>
                                        <li class="star" title="Good" data-value="3">
                                            <i class="fa fa-star fa-fw"></i>
                                        </li>
                                        <li class="star" title="Excellent" data-value="4">
                                            <i class="fa fa-star fa-fw"></i>
                                        </li>
                                        <li class="star" title="WOW!!!" data-value="5">
                                            <i class="fa fa-star fa-fw"></i>
                                        </li>
                                    </ul>                          
                                </div>
                                <!--Questionaire One Ends-->

                                <!--Questionaire Two-->
                                <div class="questionair_2 questionair hidden">
                                    <h6>Question 2 of 4</h6>
                                    <h3 id="qus_two_title">What went wrong?</h3>

                                    <div class="category-issues">
                                        <ul>
                                            <li>
                                                <div class="nps_radiotype">
                                                    <input name="odbookingprocess" id="odbookingprocess_radio1" type="radio" value="Order Booking Process" data-cat="1">
                                                    <label class="nps_label" for="odbookingprocess_radio1">
                                                        <center>
                                                            <img src="/img/nps_reason_01.png">
                                                        </center>
                                                        <p>Order Booking Process</p>
                                                    </label> 
                                                </div>
                                            </li>

                                            <li>
                                                <div class="nps_radiotype">
                                                    <input name="odbookingprocess" id="odbookingprocess_radio2" type="radio" value="Sample Collection" data-cat="2">
                                                    <label class="nps_label" for="odbookingprocess_radio2">
                                                        <center>
                                                            <img src="/img/nps_reason_02.png">
                                                        </center>
                                                        <p>Sample Collection</p>
                                                    </label>  
                                                </div>
                                            </li>
                                            <li>
                                                <div class="nps_radiotype">
                                                    <input name="odbookingprocess" id="odbookingprocess_radio3" type="radio" value="Test Reports" data-cat="3">
                                                    <label class="nps_label" for="odbookingprocess_radio3">
                                                        <center>
                                                            <img src="/img/nps_reason_03.png">
                                                        </center>
                                                        <p>Test Reports</p>
                                                    </label>  
                                                </div>
                                            </li>
                                            <li>
                                                <div class="nps_radiotype">
                                                    <input name="odbookingprocess" id="odbookingprocess_radio4" type="radio" value="Test Reports" data-cat="4">
                                                    <label class="nps_label" for="odbookingprocess_radio4">
                                                        <center>
                                                            <img src="/img/nps_reason_04.png">
                                                        </center>
                                                        <p>Doctor Consultation</p>
                                                    </label>
                                                </div>                                                
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--Questionaire Two-->

                                <!--Questionaire Three-->
                                <div class="questionair_bad_3 questionair hidden">
                                    <div class="hidden div_cat" id="bad_cat1">
                                        <h6>Question 3 of 4</h6>
                                        <h5>WHAT WENT WRONG IN ?</h5>
                                        <h3>Order Booking Process</h3>

                                        <div class="category-issue-options">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <div class="optioncheckboxes">
                                                        <h4>Not able to find all the tests?</h4>
                                                        <div class="category-issue-options">
                                                            <ul class="onweb">
                                                                <li>
                                                                    <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                        <input type="checkbox" value="1" id="bad1a1" name="catoption[]" >
                                                                        <label for="bad1a1" onclick="">On website</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                        <input type="checkbox" value="2" id="bad1a2" name="catoption[]" >
                                                                        <label for="bad1a2" onclick="">On Mobile App</label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="optioncheckboxes">
                                                        <h4>Not happy with the representative who booked the tests on your behalf?</h4>
                                                        <div class="category-issue-options">
                                                            <ul class="onweb">
                                                                <li >
                                                                    <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                        <input type="checkbox" value="3" id="bad1a3" name="catoption[]" >
                                                                        <label for="bad1a3" onclick="">Did not communicate the correct pricing or discounts</label>
                                                                    </div>
                                                                </li>
                                                                <li >
                                                                    <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                        <input type="checkbox" value="4" id="bad1a4" name="catoption[]">
                                                                        <label for="bad1a4" onclick="">Poor explanation of the test details</label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="hidden div_cat" id="bad_cat2">
                                        <div class="optioncheckboxes">
                                            <h6>Question 3 of 4</h6>
                                            <h5>WHAT WENT WRONG IN ?</h5>
                                            <h3>Sample collection</h3>

                                            <div class="category-issue-options">
                                                <div class="col-md-12">
                                                    <ul>
                                                        <li>
                                                            <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                <input type="checkbox" value="5" id="bad2a5" name="catoption[]">
                                                                <label for="bad2a5" onclick="">Sample collection agent (Phlebotomist) was not on time</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                <input type="checkbox" value="6" id="bad2a6" name="catoption[]">
                                                                <label for="bad2a6" onclick="">Sample collection was painful</label>
                                                            </div>
                                                        </li>
                                                        <li>

                                                            <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                <input type="checkbox" value="7" id="bad2a7" name="catoption[]">
                                                                <label for="bad2a7" onclick="">Phlebotomist was not properly dressed and lacked hygiene measures</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="hidden div_cat" id="bad_cat3">
                                        <div class="optioncheckboxes">
                                            <h6>Question 3 of 4</h6>
                                            <h5>WHAT WENT WRONG IN ?</h5>
                                            <h3>Reports</h3>
                                            <div class="category-issue-options">
                                                <div class="col-md-12">
                                                    <ul>
                                                        <li>
                                                            <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                <input type="checkbox" value="8" id="bad3a8" name="catoption[]">
                                                                <label for="bad3a8" onclick="">Soft copy of the report was not on time </label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                <input type="checkbox" value="value-12" id="bad3a9" name="catoption[]">
                                                                <label for="bad3a9" onclick="">Report received was not correct</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                <input type="checkbox" value="value-12" id="bad3a10" name="catoption[]">
                                                                <label for="bad3a10" onclick="">Report hardcopy was late</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="hidden div_cat" id="bad_cat4">
                                        <div class="optioncheckboxes">
                                            <h6>Question 3 of 4</h6>
                                            <h5>WHAT WENT WRONG IN ?</h5>
                                            <h3>Doctor Consultation</h3>

                                            <div class="category-issue-options">
                                                <div class="col-md-12">
                                                    <ul>
                                                        <li>
                                                            <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                <input type="checkbox" value="11" id="bad4a11" name="catoption[]">
                                                                <label for="bad4a11" onclick="">Doctor consultation was not provided after raising the request</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                <input type="checkbox" value="bad4a2" id="bad4a12" name="catoption[]">
                                                                <label for="bad4a12" onclick="">Doctor wasn’t able to answer my questions</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Questionaire Three-->
                                
                                
                                <!--Questionaire Three-->
                                <div class="questionair_good_3 questionair hidden">
                                    <div class="hidden div_cat" id="good_cat1">
                                        <h6>Question 3 of 4</h6>
                                        <h5>WHAT WENT WRONG IN ?</h5>
                                        <h3>Order Booking Process</h3>

                                        <div class="category-issue-options">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <div class="optioncheckboxes">
                                                        <h4>Very smooth booking experience using?</h4>
                                                        <div class="category-issue-options">
                                                            <ul class="onweb">
                                                                <li>
                                                                    <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                        <input type="checkbox" value="13" id="good1a1" name="catoption[]">
                                                                        <label for="good1a1" onclick="">Website</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                        <input type="checkbox" value="14" id="good1a2" name="catoption[]">
                                                                        <label for="good1a2" onclick="">Mobile App</label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="optioncheckboxes">
                                                        <h4>Extremely satisfied with the representative booking the health check-up?</h4>
                                                        <div class="category-issue-options">
                                                            <ul class="onweb">
                                                                <li style="width:100%; display:block;">
                                                                    <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                        <input type="checkbox" value="15" id="good1a3" name="catoption[]">
                                                                        <label for="good1a3" onclick="">Explained the tests in detail</label>
                                                                    </div>
                                                                </li>
                                                                <li style="width:100%; display:block;">
                                                                    <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                        <input type="checkbox" value="16" id="good1a4" name="catoption[]">
                                                                        <label for="good1a4" onclick="">Adequately suggested tests as per the medical conditions</label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="hidden div_cat" id="good_cat2">
                                        <div class="optioncheckboxes">
                                            <h6>Question 3 of 4</h6>
                                            <h5>WHAT WENT WRONG IN ?</h5>
                                            <h3>Sample collection</h3>

                                            <div class="category-issue-options">
                                                <div class="col-md-12">
                                                    <ul>
                                                        <li>
                                                            <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                <input type="checkbox" value="17" id="good2a1" name="catoption[]">
                                                                <label for="good2a1" onclick="">Pain free sample collection</label>
                                                            </div>

                                                        </li>

                                                        <li>
                                                            <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                <input type="checkbox" value="18" id="good2a2" name="catoption[]">
                                                                <label for="good2a2" onclick="">Appreciate the whole sample collection experience (well dressed, wearing gloves, showed sealed kit etc.) </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="hidden div_cat" id="good_cat3">
                                        <div class="optioncheckboxes">
                                            <h6>Question 3 of 4</h6>
                                            <h5>WHAT WENT WRONG IN ?</h5>
                                            <h3>Reports</h3>

                                            <div class="category-issue-options">
                                                <div class="col-md-12">
                                                    <ul>
                                                        <li>
                                                            <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                <input type="checkbox" value="19" id="good3a1" name="catoption[]">
                                                                <label for="good3a1" onclick="">Received report on time</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                <input type="checkbox" value="20" id="good3a2" name="catoption[]">
                                                                <label for="good3a2" onclick="">Accuracy of the reports </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="hidden div_cat" id="good_cat4">
                                        <div class="optioncheckboxes">
                                            <h6>Question 3 of 4</h6>
                                            <h5>WHAT WENT WRONG IN ?</h5>
                                            <h3>Doctor Consultation</h3>

                                            <div class="category-issue-options">
                                                <div class="col-md-12">
                                                    <ul>
                                                        <li>
                                                            <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                <input type="checkbox" value="21" id="good4a1" name="catoption[]" >
                                                                <label for="good4a1" onclick="">Detailed doctor’s consultation</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="checkbox npscheckbx checkbox-info checkbox-circle">
                                                                <input type="checkbox" value="22" id="good4a2" name="catoption[]">
                                                                <label for="good4a2" onclick="">Suggestions and measures recommended</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Questionaire Three-->

                                <!--Questionaire Four-->
                                <div class="questionair_4 questionair hidden">
                                    <div class="optioncheckboxes">
                                        <h6>Question 4 of 4</h6>
                                        <h3>Provide feedback on what can be improve?</h3>

                                        <div class="thankyoufeeds">
                                            <div class="share_msg_textarea">
                                            <!-- <h5 style="text-transform: none; margin-bottom: 10px; color: #484848; margin: 0px; padding: 0px 0px 10px 0; font-size: 16px !important; line-height: 18px;">What can be improved ?</h5> -->
                                                <textarea name="improvement_msg" id="improvement_msg" cols="" rows=""  placeholder="Please write your feedback" class="ng-pristine ng-valid ng-touched"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!--Questionaire Four-->
                                <div class="nextprev_opt">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="btn btn-danger" id="prev_qus" data-step="0">Previous</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="btn btn-danger" id="next_qus" data-step="1">Next</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
	</div>
    </section>

@endsection

@push('footer-scripts')
    <script type="text/javascript" src="/js/bootbox.js"> </script>

    <script>
        var max_step    =   4;
        var last_step   =   max_step - 1;
        var cur_step    =   1;
        
        $(document).ready(function(){
            $("#prev_qus").addClass('hidden');
            
            // To check device source
            if (isMobile.any()) 
                $("input[name='source']").val('mobile');
        
            $("#next_qus").on('click', function(){
                
                switch(cur_step) {
                    case 1:
                        var rating = $("input[name='rating_val']").val();
                        console.log(rating);
                        if(rating == ''){                      
                            bootbox.alert({
                                message: "Select the rating first",
                                size: 'small'
                            });
                        }else{                            
                            $(".questionair").addClass("hidden");
                            $(".div_cat").addClass("hidden");
                            if(rating <= 3)
                                $("#qus_two_title").text("What went wrong?");
                            else
                                $("#qus_two_title").text("What did you like most?");
                            cur_step    +=  1;
                            $(".questionair_"+cur_step).removeClass("hidden");
                        }
                        // code block
                        break;
                    case 2:
                        var rating              =   $("input[name='rating_val']").val();
                        var odbookingprocess    =   $("input[name='odbookingprocess']:checked").val();
                        var cat_count           =   $("input[name='odbookingprocess']:checked").data('cat');
                        if(odbookingprocess == undefined || odbookingprocess == '' || rating == ''){                      
                            bootbox.alert({
                                message: "Select Booking Process",
                                size: 'small'
                            });
                        }else{     
                            $(".questionair").addClass("hidden");
                            $(".div_cat").addClass("hidden");                       
                            cur_step    +=  1;
                            if(rating <= 3){
                                $(".questionair_bad_"+cur_step).removeClass("hidden");
                                $("#bad_cat"+cat_count).removeClass("hidden");                                
                                $("#qus_two_title").text("What went wrong?");
                            }else{
                                $(".questionair_good_"+cur_step).removeClass("hidden");
                                $("#good_cat"+cat_count).removeClass("hidden");
                                $("#qus_two_title").text("What did you like most?");
                            }
                        }
                        // code block
                        break;
                    case 3:
                        var catoption_count     =   $("input[name='catoption[]']").filter(':checked').length;
                        var sample_feedback     =   $("input[name='catoption[]']").val();
                        console.log(sample_feedback);
                        if(catoption_count  ==  0){
                            bootbox.alert({
                                message: "Select atlest one reason",
                                size: 'small'
                            });
                        }else if(sample_feedback == ''){                      
                            bootbox.alert({
                                message: "Select atlest one feedback",
                                size: 'small'
                            });
                        }else{
                            $(".questionair").addClass("hidden");
                            $(".div_cat").addClass("hidden");
                            cur_step    +=  1;
                            $(this).text("Submit");
                            $(".questionair_"+cur_step).removeClass("hidden");
                        }
                        // code block
                        break;
                    case 4:
                        var improvement_msg =   $("input[name='improvement_msg']").val();
                        var values          =   $("#nps_validation_form").serialize();
                        $.ajax({
                            url     :   "{{url('nps')}}",
                            type    :   "post",
                            data    :   values ,
                            beforeSend: function() {
                                $("#ajax-loader").show();
                            },
                            success: function (response) {
                                $("#ajax-loader").hide();
                                if(response.status){
                                    var htmlAppend      =   "<div class='nextprev_opt'><ul><li><h2>Thank you</h2></li><li><span>Thank you for your feedback. Please rate us on Google play as well</span></li></ul></div>";
                                    $("#QuesHourDiv").html(htmlAppend);
                                }else{
                                    bootbox.alert({
                                        message: response.message,
                                        size: 'small'
                                    });
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                    var htmlAppend      =   "<div class='questionair_1 questionair'><h3>Thank you</h3><p>Thank you for your feedback. Please rate us on Google play as well</p><a href='/' class='btn btn-danger'>Back to Homepage</a></div>";
                                    $("#QuesHourDiv").html(htmlAppend);
                                var jsonResponseText    =   $.parseJSON(jqXHR.responseText);
                                $("#ajax-loader").hide();
                                bootbox.alert({
                                        message :   jsonResponseText.message,
                                        size    :   'small'
                                    });
                                return false;
                            }
                        });           
                        // code block
                        break;
                    default:
                      // code block
                }
                if(cur_step > 1)
                    $("#prev_qus").removeClass('hidden');
                
            });
            
            $("#prev_qus").on('click', function(){
                $("#next_qus").text("Next");
                var rating  =   $("input[name='rating_val']").val();
                switch(cur_step) {
                    case 4:
                        $("textarea[name='improvement_msg']").val('');
                        $(".questionair").addClass("hidden");
                        $(".div_cat").addClass("hidden");                           
                        cur_step    -=  1;
                        var cat_count   =   $("input[name='odbookingprocess']:checked").data('cat');
                        if(rating <= 3){
                            $(".questionair_bad_"+cur_step).removeClass("hidden");
                            $("#bad_cat"+cat_count).removeClass("hidden");                                
                            $("#qus_two_title").text("What went wrong?");
                        }else{
                            $(".questionair_good_"+cur_step).removeClass("hidden");
                            $("#good_cat"+cat_count).removeClass("hidden");
                            $("#qus_two_title").text("What did you like most?");
                        }
                        break;
                    case 3:
                        $(".questionair").addClass("hidden");
                        $(".div_cat").addClass("hidden");  
                        cur_step    -=  1;
                        $(".questionair_"+cur_step).removeClass("hidden");
                        $("input[name='catoption[]']").prop('checked',false); 
                        $("textarea[name='improvement_msg']").val('');
                        break;
                    case 2:
                        $(".questionair").addClass("hidden");
                        $(".div_cat").addClass("hidden");  
                        cur_step    -=  1;
                        $(".questionair_"+cur_step).removeClass("hidden");
                        $("input[name='odbookingprocess']").prop('checked',false); 
                        $("input[name='catoption[]']").prop('checked',false); 
                        $("textarea[name='improvement_msg']").val('');                        
                        $("#prev_qus").addClass('hidden');
                        break;
                    default:
                        $("#prev_qus").addClass('hidden');
                        $("input[name='odbookingprocess']").prop('checked',false); 
                        $("input[name='catoption[]']").prop('checked',false); 
                        $("textarea[name='improvement_msg']").val('');
                        break;
                }   
            });
            
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

