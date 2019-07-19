@extends('layout.master')

@section('page-content')
<link href="/css/t2/healthkarma.css" rel="stylesheet">

<div class="healthkarma_main">
    <section class="">
        <div class="container" id="healthkarma_form_div" style="display: block;">

            <h2 class="text-center">Please enter your details</h2>
            <img class="center-block underline-img" src="/img/underline.png" alt="">

            <!-- Form start here -->            
            <div class="col-md-12 col-xs-12 col-md-12">
                
        <div class="hltkarma_group">
            <form>
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                    <div class="col-md-6 hk_usersignup">
                        @if(empty($customer_detail['name']))
                            <input name="huserName" id="huserName" type="text" maxlength="255" class="hk-user-icon" placeholder="Full Name"  tabindex="1" autofocus required autocomplete="off"> 
                        @else
                            <input name="huserName" id="huserName" type="text" maxlength="255" value="{{$customer_detail['name']}}" class="hk-user-icon" placeholder="Full Name"  tabindex="1" autofocus required autocomplete="off"> 
                        @endif

                    </div>


                    <div class="col-md-6 hk_usersignup">
                        @if(empty($customer_detail['mobile']))
                            <input name="huserphone" id="huserphone" autocomplete="off" maxlength="10" type="text" class="hk-user-mob" placeholder="Mobile"  tabindex="2"  required> 
                        @else
                            <input name="huserphone" id="huserphone" autocomplete="off" value="{{$customer_detail['mobile']}}" maxlength="10" type="text" class="hk-user-mob" placeholder="Mobile"  tabindex="2"  required> 
                        @endif
                    </div>
                    <div class="col-md-6 hk_usersignup">
                        @if(empty($customer_detail['email']))
                            <input name="healthkarma_email" id="healthkarma_email" maxlength="255" type="email" class="hk-user-email" placeholder="Email"  tabindex="3"  required autocomplete="off"> 
                        @else
                            <input name="healthkarma_email" id="healthkarma_email" value="{{$customer_detail['email']}}" maxlength="255" type="email" class="hk-user-email" placeholder="Email"  tabindex="3"  required autocomplete="off"> 
                        @endif
                    </div>

                    <div class="col-md-6 hk_usersignup">
                        @if(empty($customer_detail['age']))
                            <input id="userAge" name="userAge" maxlength="3" type="text" class="hk-user-age" placeholder="Age (Years)"  tabindex="4"  required autocomplete="off"> 
                        @else
                            <input id="userAge" name="userAge" maxlength="3" type="text" value="{{$customer_detail['age']}}" class="hk-user-age" placeholder="Age (Years)"  tabindex="4"  required autocomplete="off"> 
                        @endif
                    </div>
                    
                    <div class="col-md-6 hk_usersignup">
                        @if(empty($customer_detail['weight']))
                            <input id="userweight" name="userweight" maxlength="3" type="text" class="hk-user-weight" placeholder="Weight (kg.)"  tabindex="5" autofocus="" required="" autocomplete="off"> <!-- <span class="hgt">kg.</span> -->
                        @else
                            <input id="userweight" name="userweight" maxlength="3" type="text" value="{{$customer_detail['weight']}}" class="hk-user-weight" placeholder="Weight (kg.)"  tabindex="5" autofocus="" required="" autocomplete="off">
                        @endif
                    </div>
                    <div class="col-md-6 hk_usersignup">

                        <select class="hk-user-height-select" tabindex="6" id="userheight" name="userheight">
                            <option value="">Select Height (ft./in.)</option>
                            <option value="147.32">4'10</option>
                            <option value="149.86">4'11</option>
                            <option value="152.40">5'0</option>
                            <option value="155.4">5'1</option>
                            <option value="157.48">5'2</option>
                            <option value="160.02">5'3</option>
                            <option value="162.56">5'4</option>
                            <option value="165.10">5'5</option>
                            <option value="167.64">5'6</option>
                            <option value="170.18">5'7</option>
                            <option value="172.72">5'8</option>
                            <option value="175.26">5'9</option>
                            <option value="177.80">5'10</option>
                            <option value="180.34">5'11</option>
                            <option value="182.88">6'0</option>
                            <option value="185.42">6'1</option>
                            <option value="187.96">6'2</option>
                            <option value="190.50">6'3</option>
                            <option value="193.04">6'4</option>
                            <option value="195.58">6'5</option>
                            <option value="198.12">6'6</option>
                            <option value="200.66">6'7</option>
                            <option value="203.20">6'8</option>
                            <option value="205.74">6'9</option>
                            <option value="208.28">6'10</option>
                            <option value="210.82">6'11</option>
                            <option value="213.36">7'0</option>
                        </select>

                        <!-- <span class="heightlabel">(ft/inch)</span> -->
                    </div>
                    
                    <div class="col-md-6 hk_gendermyfamily">
                            <div class="hk_genderOptions">
                                <div class="genderopts">
                                    <ul>
                                        <li><input id="checkbox6" type="radio" name="husergender" value="m" required>
                                    <label for="checkbox6">Male </label>
                                </li>
                                <li>
                                    <input id="checkbox7" type="radio" name="husergender" value="f" required style="height: 0px;">
                                    <label for="checkbox7">Female </label>
                                </li>

                                    </ul>
                                </div>
                            </div>
                            
                        </div>


                <div class="col-md-12 text-center">
                    <div class="continuewrap">
                        <a href="javascript:void(0);" class="btn btn-danger" onClick="getNewQuestionList();"> Continue <img src="/img/left-icon.png" width="20px;"> </a>
                    </div>
                </div>


            </form>
            <div class="clearfix"></div>
        </div>
            </div>
            <!-- Form start here -->


          

        </div>

        <div class="container" id="healthkarma_question_div" style="display: none;">
            <h2 class="head_karma">Health Karma</h2>
            <img class="center-block underline-img" src="img/underline.png" alt="Icon">
        
            <div class="hk_formDetailBlock_p2" style="margin-top: 0px;">
                <section class="questionaireBlock">
                    <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="question_indicators" id="healthkarma_question_indicator">
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="" id="healthkarma_question_list">                        
                        </div>                
                    </div>
                </section>
            </div>
        </div>

        <div class="container" id="healthkarma_result_div" style="display: none;">
            <h2 class="head_karma">Health Karma's Result</h2>
            <img class="center-block underline-img" src="img/underline.png" alt="Icon">
            <div class="progress-bar">
                <div class="health-usear">
                    <h4><span id="c_name"></span>, here's your life style score</h4>
                    <div class="health-score">
                        <h5>100% Complete
                        <span></span>
                        </h5>
                    </div>
                </div>
                
                <div class="score-img">
                    <div class="hb-circle"><p class="hbvaluedata"><span id="h_score"></span><span class="smallvalue">/100</span></p></div>
                </div>
            </div>
            <h3>Your Probable Risk</h3>
            <div class="progress-bar">
                <div class="paragraph-area" id="risk_data" style="">
                </div>
                <div class="score-value">
                    <h5 id="peer_score">45%</h5>
                    <span>Peers are healthier than you</span>
                    

                </div>
            </div>
            <h3 id="recomm_head">Higly Recommended Test For You</h3>
            <div class="progress-bar" id="recomm_div">
                <div id="recommend_data"></div>
                <div class="hk_booknwmain">
                    <a href="javascript:void(0);" class="btn btn-danger" onClick="recommend_search();">
                        Book Now 
                    <img src="/img/left-icon-sml.png" class="">
                </a>
                </div>
            </div>
            
            <div class="center-bnt">
                <a href="javascript:void(0);" class="btn btn-danger" onClick="clickToCall();"><i class="fa fa-phone" aria-hidden="true"></i> Talk to our Health Advisor</a>
                <a href="javascript:void(0);" class="btn btn-default addmember" onClick="retakeHealthKarma();">Retake Health Karma</a>
            </div>
        </div>
    </section>
    <div class="clear"></div>
</div>


<!-- USP starts  -->
<div class="hk_uspbottom">
<div class="container">
            
            <h2 class="text-center">Discover Your Score Today</h2>
            <img class="center-block mar-bot" src="/img/underline.png" alt="Icon">
        
            <div class="col-md-12">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="about-icon-area">
                    <div class="about-icon">
                        <img src="/img/lifestyle.jpg">
                    </div>
                    <div class="hkaboutpage-content">
                        <h4>Tell us about your Lifestyle</h4>
                        <p>Fill in your lifestyle choices to evaluate your health.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="about-icon-area aboutpage-content-new">
                    <div class="about-icon">
                        <img src="/img/health-score.jpg">
                    </div>
                    <div class="hkaboutpage-content">
                        <h4>Get your Health Score</h4>
                        <p>Know your health risks and where you stand among your Peers.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="about-icon-area aboutpage-content-new">
                    <div class="about-icon">
                        <img src="/img/corrective-action.jpg">
                    </div>
                    <div class="hkaboutpage-content">
                        <h4>Take Corrective Actions</h4>
                        <p>Get recommended tests on the basis of your health risks.</p>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
        <!-- USP ends -->

 @endsection


@push('footer-scripts')
<script>
    var getHealthKarmaQuestion_api_url  = "{{url('getHealthKarmaQuestion')}}";
    var saveHealthKarma_api_url  = "{{url('saveHealthKarma')}}";
    var clickToCall_api_url  = "{{url('clickToCall')}}";

    <?php if(!empty($customer_detail)) {?>
        var gender  =   "{{strtolower($customer_detail['gender'])}}";
        var height  =   "{{$customer_detail['height']}}";
        $(document).ready(function(){
            $("input[name=husergender][value='"+gender+"']").prop("checked",true);
            $('#userheight').val(height);
        });
    <?php }?>
    
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>
<script src="/js/healthkarma_new.js"></script>    

@endpush