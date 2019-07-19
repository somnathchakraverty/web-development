@extends('layout.master')

@push('header-scripts')

@endpush

@section('page-content')

<!-- banner div start here -->
<div class="bannerdiv">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
          <li data-target="#myCarousel" data-slide-to="3"></li>  
          <li data-target="#myCarousel" data-slide-to="4"></li>         
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">   
             

             <div class="item active">
                <a href="" style="width:100%;margin:0px;margin-top:-2px;">
                    <img src="/img/banners/five-web-banner.jpg" alt="five years of good health">
                </a>
            </div>    

            <div class="item">
                <a href="https://www.healthians.com/package/healthians-full-body-checkup-with-thyroid-and-cbc" style="width:100%;margin:0px;margin-top:-2px;">
                    <img src="/img/banners/Main-banner-1.jpg" alt="Healthians full body checkup with thyroid and cbc">
                </a>
            </div>


       
            <div class="item">
                <a href="https://www.healthians.com/package/healthy-indian-days-special-package" style="width:100%;margin:0px;margin-top:-2px;">
                    <img src="/img/banners/Main-banner-2.jpg" alt="Healthy Indian days cpecial package">
                </a>
            </div>
     
            <div class="item">
                <a href="https://www.healthians.com/healthkarma" style="width:100%;margin:0px;margin-top:-2px;">
                    <img src="/img/banners/Main-banner-3.jpg" alt="Healthkarma">
                </a>
            </div>
            
            <div class="item">
                <a href="https://www.healthians.com/deals" style="width:100%;margin:0px;margin-top:-2px;">
                    <img src="/img/banners/Main-banner-4.jpg" alt="Deals">
                </a>
            </div>
        </div>
    </div>
</div>

    <div class="search-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-1 col-lg-10 col-sm-12 text-center">
                    <div class="input-group selecttextmenu">
                        <select class="js-select2" name="search_value" multiple="multiple" id="searchHome"></select>
                        </select>
                        <span class="input-group-btn another">
                            <button class="btn btn-theme mob" type="button" onclick="searchHomePage();"><i class="fa fa-search"></i> <span>Search</span> </button>
                        </span>
                    </div>
                    @if(isset($propular_test_detail) && isset($propular_package_detail))
                    <div id="popular_package" style="display: none">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 pp_package">
                                <div class="testtitle">Popular Test</div>
                                <div class="tests hp_popular">
                                    <ul class="popular_test">
                                        @foreach($propular_test_detail as $test)
                                            <li class="test t_option_{{ $test['product_id'] }}" data-id="{{ $test['product_id'] }}"  data-value="{{ $test['product_name'] }}"> {{ $test['product_name'] }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 pp_package">
                                <div class="testtitle">Popular Packages</div>
                                <div class="tests hp_popular">
                                    <ul class="popular_test">
                                        @foreach($propular_package_detail as $test)
                                            <li class="test t_option_{{ $test['product_id'] }}" data-id="{{ $test['product_id'] }}"  data-value="{{ $test['product_name'] }}"> {{ $test['product_name'] }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- special offer area -->
    <div class="special-offer" onclick="pushGaEvent('HomePage', 'Explored Most Popular Package Slider')">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center marbottom" id="special-offer-heading">
                    <h1>Health Checkup Packages</h1>
                    <img class="lazy" data-src="/img/underline.png" class="underline" alt="underline" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                <div id="special-offer" class="owl-carousel">
                        @foreach ($popular_package_data as $popular_package_detail)
                            <div class="offer-main">
                                <div class="offers">
                                    <h3>{{ number_format((($popular_package_detail['actual_price'] - $popular_package_detail['healthian_price']) / $popular_package_detail['actual_price'] ) * 100,0)}}% Off</h3>
                                </div>
                                <div class="offer-content">
                                    <div class="offer-heading">
                                        <h2><a href="<?php echo route("product.{$popular_package_detail['product_type']}-detail", [   
                                                                    'city'          =>  $city_name_url,
                                                                    'link_rewrite'  =>  $popular_package_detail['link_rewrite'] 
                                                                ]
                                                            ) ?>" class="know-more">{{$popular_package_detail['product_name']}}</a></h2>
                                    </div>
                                    <div class="offers-content">
                                        @if(isset($popular_package_detail['test_includes']) && (count($popular_package_detail['test_includes']) > 0))
                                            <h5>
                                                Includes : <b> {{$popular_package_detail['test_count']}}
                                                @if ($popular_package_detail['test_count'] == 1)
                                                    Parameter
                                                @endif
                                                @if ($popular_package_detail['test_count'] > 1)
                                                    Parameters
                                                @endif
                                                </b>
                                            </h5>
                                            <ul class="parameter_min">
                                                @foreach ($popular_package_detail['test_includes'] as $key1 => $test1)
                                                    @if ($key1 < 3)
                                                        <li>
                                                        @if(isset($test1['link_rewrite']))
                                                            <a href="<?php echo route("product.{$test1['type']}-detail", [   
                                                                    'city'          =>  $city_name_url,
                                                                    'link_rewrite'  =>  $test1['link_rewrite'] 
                                                                ]
                                                            ) ?>" title="{{$test1['test_name']}}" target="_blank">{{$test1['test_name']}}</a>
                                                        @else
                                                            {{$test1['test_name']}}
                                                        @endif
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endif
                                        <a href="<?php echo route("product.{$popular_package_detail['product_type']}-detail", [   
                                                                    'city'          =>  $city_name_url,
                                                                    'link_rewrite'  =>  $popular_package_detail['link_rewrite'] 
                                                                ]
                                                            ) ?>" title="{{$popular_package_detail['product_name']}}" class="know-more-opt">+ Know More</a>
                                        <!-- <div class="ruree">
                                            <del>{{$popular_package_detail['actual_price']}}/-</del> {{$popular_package_detail['healthian_price']}}/-
                                        </div> -->

                                        <div class="pricebar">
                                            <p class="slashedprice"><del><span class="rupeesign">₹</span>{{$popular_package_detail['actual_price']}}</del></p>

                                            <p class="healthiansprice"> <span class="rupeesign">₹</span>{{$popular_package_detail['healthian_price']}} </p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="/most-selling" class="btn btn-danger" title="Health Checkup Packages"> View All <img class="lazy" data-src="/img/left-icon-sml.png"></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Step Towards A Healtheier You 
    <div class="getcloser-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2> Step Towards A Healthier You! </h2>
                    <img src="/img/underline.png" class="underline" alt="underline" />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="getcloserdiv">
                        <h4> Book Your <br> <b> Test </b></h4>
                        <img class="right-icon" src="/img/other-icon1.png" />
                        <p> Book the tests your doctors have prescribed <br>
                        for you or your family </p>
                        <a href="#" class="btn btn-danger"> 
                            <span> Book Now </span> <img src="/img/left-icon.png">
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="getcloserdiv">
                        <h4> Your Health Karma is<br> <b> 100% Complete </b></h4>
                        <img class="right-icon" src="/img/heart-icon.png" />
                        <p><b>34%</b> peers are healththeir then you. Click to retake your health karma. </p>
                        <a href="#" class="btn btn-danger"> 
                            <span> Click Here </span> <img src="/img/left-icon.png">
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="getcloserdiv">
                        <h4> Your HCash Balance is <br> <b> 200/- </b></h4>
                        <img class="right-icon" src="/img/leg-icon.png" />
                        <p> Redeem your balance and <br> book your tests </p>
                        <a href="#" class="btn btn-danger"> 
                            <span> Click Here  </span> <img src="/img/left-icon.png">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->
    <!-- Risk Area start here -->
    <div class="popular-section" id="actual_risk_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center marbottom">
                    <h2> Health Risk </h2>
                    <img class="lazy" data-src="/img/underline.png" class="underline" alt="underline" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="home_loader" id="teams-slider3-load"> 
                        <img src="/img/bx_loader.gif">
                    </div>
                    <div id="teams-slider3" class="owl-carousel" data-apiurl="{{url('getRiskSlider')}}">    
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="{{ url('risk-area-list') }}" class="btn btn-danger" title="Health Risk"> View All <img class="lazy" data-src="/img/left-icon-sml.png"></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Habit section start here -->
    <div class="commonrisk-section rish-area" id="actual_habit_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center marbottom">
                    <h2> Habits </h2>
                    <img class="lazy" data-src="/img/underline.png" class="underline" alt="underline" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="home_loader" id="teams-slider5-load"> 
                        <img src="/img/bx_loader.gif">
                    </div>
                    <div id="teams-slider5" class="owl-carousel" data-apiurl="{{url('getHabitSlider')}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="{{ url('habits-list') }}" class="btn btn-danger" title="Unhealthy Habits"> View All <img class="lazy" data-src="/img/left-icon-sml.png"></a>
                </div>
            </div>
        </div>
    </div>
    <!-- recomendation area -->
    {{-- <div class="commonrisk-section" id="actual_popular_subscription">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center marbottom">
                    <h3> Popular Subscriptions </h3>
                    <img class="lazy" data-src="/img/underline.png" class="underline" alt="Underline" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div id="recomendation" class="owl-carousel" data-apiurl="{{url('getSubscriptionSlider')}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="/subscriptionList" class="btn btn-danger"> View All <img class="lazy" data-src="/img/left-icon-sml.png"></a>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- yourhealth section start here -->
    <div class="yourhealth-section" id="blog_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center marbottom">
                    <h2> Health Tips & Articles </h2>
                    <img class="lazy" data-src="/img/underline.png" class="underline" alt="underline" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12" id="blog_slider" data-apiurl="{{url('getBlogSlider')}}">
                    <div class="home_loader" id="teams-slider5-load"> 
                        <img src="/img/bx_loader.gif">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="{{$healthians_blog_url}}" class="btn btn-danger" title="Health Tips"> View All <img class="lazy" data-src="/img/left-icon-sml.png"></a>
                </div>
            </div>
        </div>
    </div>
    <!-- downloadapp section start here -->
    <div class="downloadapp-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 pull-right text-center">
                    <h3> Download Our App Now </h3>
                    <img class="lazy" data-src="/img/underline.png" class="underline" alt="underline" />
                    <p>Tracking health status made easy with the app. Now available on both Google Play Store and App Store. Book health tests and access your smart reports and health trackers anytime anywhere.</p>
                    <a style="margin-left:0px;" target="_blank" href="https://play.google.com/store/apps/details?id=com.healthians.main.healthians&hl=en_IN">
                        <img class="lazy" data-src="/img/google_play.png" alt="" style="max-width: 190px;" /></a>

                    <a style="margin-left:0px;" target="_blank" href="https://itunes.apple.com/in/app/healthians/id1453011241?mt=8">
                        <img class="lazy" data-src="/img/appstore.png" alt="img-appstore" style="max-width: 190px;"  alt="" /></a>
                </div>
            </div>
        </div>
    </div>


     


    <!-- why choose us -->
    <div class="choose-us">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center marbottom">
                    <h3> Why Choose Healthians </h3>
                    <img class="lazy" data-src="/img/underline.png" class="underline" alt="Image" />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                    <div class="choose-icon">
                        <div class="icon-area">
                            <span>01</span>
                            <img class="lazy" data-src="/img/icon1.png" alt="Free & On-time">

                        </div>
                        <div class="icon-content">
                            <p>Free & On-time <br> Sample Collection</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                    <div class="choose-icon">
                        <div class="icon-area">
                            <span>02</span>
                            <img class="lazy" data-src="/img/icon2.png" alt="Free-doctor-diet-consultation">

                        </div>
                        <div class="icon-content">
                            <p>Free Doctor & <br> Diet Consultation</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                    <div class="choose-icon">
                        <div class="icon-area">
                            <span>03</span>
                            <img class="lazy" data-src="/img/icon3.png" alt="test-reports">

                        </div>
                        <div class="icon-content">
                            <p>Fast & Accurate <br> Test Reports</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                    <div class="choose-icon">
                        <div class="icon-area">
                            <span>04</span>
                            <img class="lazy" data-src="/img/icon4.png" alt="cities-states">
                        </div>
                        <div class="icon-content">
                            <p>21 Cities & <br>6 States</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                    <div class="choose-icon">
                        <div class="icon-area">
                            <span>05</span>
                            <img class="lazy" data-src="/img/icon5.png" alt="largest-fleet">

                        </div>
                        <div class="icon-content">
                            <p>Largest Fleet <br> of Phlebotomist</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                    <div class="choose-icon">
                        <div class="icon-area">
                            <span>06</span>
                            <img class="lazy" data-src="/img/icon6.png" alt="happy-families">

                        </div>
                        <div class="icon-content">
                            <p>4,50,000 <br> Happy Families</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- why choose us -->


    <!-- smart report -->

    <div class="smartreportsection">
        <div class="container">
            <div class="row">

                <div class="col-md-11 col-xs-12 col-lg-11 text-center smarttext">

                    <div class="col-md-6 col-xs-12 col-lg-6">

                        <div class="col-sm-12 text-left marbottom">
                    <h3>Introducing Smart Reports </h3>
                    <img class="lazy" data-src="/img/underline.png" class="underline" alt="underline-img" />
                </div>


                <div class="contentsmartreport">

                    <h5>Now understanding lab<br>
reports got easier</h5>

                <h6>Consolidated Health<br>
History Report</h6>
                </div>

                    </div>


                    <div class="col-md-4 col-xs-12 col-lg-4">

                      <div class="smartimage">  <img class="lazy" data-src="/img/smart-report-area.png" alt="img-smart-report"></div>

                    </div>



                </div>


            </div>
        </div>

    </div>

    <!-- smart report ends -->

    <!-- video media -->
    <div class="media-video">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center marbottom">
                    <h3> As covered on Aaj Tak
 </h3>
                    <img class="lazy" data-src="/img/underline.png" class="underline" alt="Image" />
                </div>
            </div>


            <div class="col-md-12 col-xs-12 col-lg-12 youtubemedia">

                 <div class="col-md-6 col-xs-12 col-lg-6">
                    <div class="mediayoutb">
                        <a href="#youtubemodal1" class="" data-toggle="modal">
                    <img class="lazy" data-src="/img/youtube_medianews2.jpg" src="/img/youtube_medianews2.jpg">
                        <p>Healthians experience featured on Aajtak news channel</a></p>
                    </div>
                 </div>



                 <div class="col-md-6 col-xs-12 col-lg-6">
                    <div class="mediayoutb">
                        <a href="#youtubemodal2" class="" data-toggle="modal">
                            <img class="lazy" data-src="/img/youtube_medianews1.jpg" src="/img/youtube_medianews1.jpg">
                        <p>Healthians on Aajtak news channel</a></p>
                    </div>
                 </div>



            </div>

        <!--Modal Youtube 1-->
            <div id="youtubemodal1" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-header">
                            <button type="button" class="closeyt" data-dismiss="modal" aria-hidden="true">&times;</button>                                
                        </div>
                        <div class="modal-content">                            
                            <div class="modal-body">
                <iframe id="youtube" width="100%" height="450" frameborder="0" allowfullscreen src="https://www.youtube.com/embed/x7_A0Mfy4qg?autoplay=1?rel=0"></iframe>
                            </div>
                           
                        </div>
                    </div>
            </div>
        <!--Modal Youtube 1-->


        <!--Modal Youtube 2-->
            <div id="youtubemodal2" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-header">
                            <button type="button" class="closeyt" data-dismiss="modal" aria-hidden="true">&times;</button>                                
                        </div>
                        <div class="modal-content">                            
                            <div class="modal-body">
                <iframe id="youtube" width="100%" height="450" frameborder="0" allowfullscreen src="https://www.youtube.com/embed/c7DRsyjJfXY?autoplay=1?rel=0"></iframe>
                            </div>
                           
                        </div>
                    </div>
            </div>
        <!--Modal Youtube 2-->




        </div>
        <div class="clearfix"></div>
    </div>

    <!-- video media -->







    

    <!--Our Doctors--->
            <div class="doctorhomepanel">
                <div class="container">
                    <div class="col-sm-12 col-md-12 col-xs-12 text-center marbottom">
                        <h3>Meet our Doctors & Dieticians</h3>
                        <img class="lazy" data-src="/img/underline.png" class="underline" alt="underline" />
                    </div>
                    <div class="col-sm-12 col-md-12 col-xs-12">
                        <div class="doctormain">
                            <span class="doctor_1"></span>
                            <span class="doctor_2"></span>
                            <span class="doctor_3"></span>
                            <span class="doctor_4"></span>
                            <span class="doctor_5"></span>
                            <span class="doctor_6"></span>
                            <span class="doctor_7"></span>
                            <span class="doctor_8"></span>
                            <span class="doctor_9"></span>
                        </div>
                    </div>
                </div>
            </div>
    <!--Our Doctors ends--->

            <div class="clearfix"></div>





     

        <!--Customer Speak-->

<div class="customerspeak">
   <div class="container">
      <div class="col-sm-12 text-center marbottom">
         <h3> Customer Speak </h3>
         <img class="lazy" data-src="/img/underline.png" class="underline" alt="underline" />
      </div>
      <div class="customerblock">
         <div id="home-patient-testimonials" class="owl-carousel">
           
            <!-- Review 1 -->
            <div class="offer-main">
               <div class="g_playreview">
                  <h6>Kulbir Singh Marya</h6>
                  <div class="starrate"> <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     
                  </div>
                  <span class="reviewdate">(3rd March 2019)</span>
                  <p>In my 40 year of experience with diagnostic labs, yours is the best till date.</p>
               </div>
            </div>
            <!-- Review 1 -->
            <!-- Review 2 -->
            <div class="offer-main midactive">
               <div class="g_playreview">
                  <h6>Sanjay Rai</h6>
                  <div class="starrate"> 
                    <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                                      </div>
                  <span class="reviewdate">(3rd March 2019)</span>
                  <p>Extremely professional and time efficient! Recommended for all health lovers.</p>
               </div>
            </div>
            <!-- Review 2 -->
            <!-- Review 3-->
            <div class="offer-main">
               <div class="g_playreview">
                  <h6>Gulab Singh</h6>
                  <div class="starrate"> 
                    <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     
                  </div>
                  <span class="reviewdate">(3rd March 2019)</span>
                  <p>Professional and kind sample collector. A pain free experience!</p>
               </div>
            </div>
            <!-- Review 3-->
            <!-- Review 4-->
            <div class="offer-main">
               <div class="g_playreview">
                  <h6>Mukesh</h6>
                  <div class="starrate"> 
                    <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>

                  </div>
                  <span class="reviewdate">(3rd March 2019)</span>
                  <p>Really happy with the service. Job was done in a professional manner.</p>
               </div>
            </div>
            <!-- Review 4-->
            <!-- Review 5-->
            <div class="offer-main">
               <div class="g_playreview">
                  <h6>Rawinder Singh</h6>
                  <div class="starrate"> 
                    <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>

                  </div>
                  <span class="reviewdate">(1st March 2019)</span>
                  <p>Good job while collecting the sample.</p>
               </div>
            </div>
            <!-- Review 5-->
            <!-- Review 6-->
            <div class="offer-main">
               <div class="g_playreview">
                  <h6>Yashi Punia</h6>
                  <div class="starrate"> 
                    <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>

                  </div>
                  <span class="reviewdate">(10th March 2019)</span>
                  <p>Excellent experience with Healthians. The team is very cooperative.</p>
               </div>
            </div>
            <!-- Review 6-->
            <!-- Review 7-->
            <div class="offer-main">
               <div class="g_playreview">
                  <h6>Sonia Jaswal</h6>
                  <div class="starrate"> 
                    <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>

                  </div>
                  <span class="reviewdate">(10th March 2019)</span>
                  <p>It was wonderful experience with Healthians. Team is very cooperative.</p>
               </div>
            </div>
            <!-- Review 7-->
            <!-- Review 8-->
            <div class="offer-main">
               <div class="g_playreview">
                  <h6>Anil Rautela</h6>
                  <div class="starrate"> 
                    <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>

                  </div>
                  <span class="reviewdate">(9th March 2019)</span>
                  <p>First and a superb experience with Healthians. Keep up the good work!</p>
               </div>
            </div>
            <!-- Review 8-->
            <!-- Review 9-->
            <div class="offer-main">
               <div class="g_playreview">
                  <h6>Alok Kumar Behera</h6>
                  <div class="starrate"> 
                    <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>

                  </div>
                  <span class="reviewdate">(9th March 2019)</span>
                  <p>Well mannered  English speaking representatives which made my experience easy.</p>
               </div>
            </div>
            <!-- Review 9-->
            <!-- Review 10-->
            <div class="offer-main">
               <div class="g_playreview">
                  <h6>Harjinder Kaur</h6>
                  <div class="starrate"> 
                    <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>

                  </div>
                  <span class="reviewdate">(8th March 2019)</span>
                  <p>Explained everything in great detail. Good service and the team is very polite!</p>
               </div>
            </div>
            <!-- Review 10-->
            <!-- Review 11-->
            <div class="offer-main">
               <div class="g_playreview">
                  <h6>Dhiruji</h6>
                  <div class="starrate"> 
                    <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>

                  </div>
                  <span class="reviewdate">(15th March 2019)</span>
                  <p>Very satisfied with the sample collection procedure. Representative was quite professional and skillful.</p>
               </div>
            </div>
            <!-- Review 11-->

            <!-- Review 12-->
            <div class="offer-main">
               <div class="g_playreview">
                  <h6>Amit Mangla</h6>
                  <div class="starrate"> 
                    <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>

                  </div>
                  <span class="reviewdate">(15th March 2019)</span>
                  <p>Very much appreciate the efforts made by HEALTHIANS</p>
               </div>
            </div>
            <!-- Review 12-->

            
            <!-- Review 13-->
            <div class="offer-main">
               <div class="g_playreview">
                  <h6>Pooja</h6>
                  <div class="starrate"> 
                    <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>

                  </div>
                  <span class="reviewdate">(14th March 2019)</span>
                  <p>Excellent experience with the phlebotomist. He was well educated, and good at his job.</p>
               </div>
            </div>
            <!-- Review 13-->
            <!-- Review 14-->
            <div class="offer-main">
               <div class="g_playreview">
                  <h6>Lucky</h6>
                  <div class="starrate"> 
                    <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>

                  </div>
                  <span class="reviewdate">(12th March 2019)</span>
                  <p>Knowledgeable representative and pain free blood collection. Explained me well about the needed test.</p>
               </div>
            </div>
            <!-- Review 14-->
            <!-- Review 15-->
            <div class="offer-main">
               <div class="g_playreview">
                  <h6>Saran Jeet Singh</h6>
                  <div class="starrate"> 
                    <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>
                     <span class="glyphicon glyphicon-star"></span>

                  </div>
                  <span class="reviewdate">(12th March 2019)</span>
                  <p>Five star for well behaved phlebo.</p>
               </div>
            </div>
            <!-- Review 15-->
            


         </div>
      </div>
   </div>
   <div class="clearfix"></div>
</div>
    
    
        <!--Customer Speak-->

            <!--Most Popular tests -->
            <div class="popular_parameters">
                
                </div>
            <!--Most popular tests -->




@endsection

@push('footer-scripts')
<script type="text/javascript">
    var search_values = [];

    var select2;

    function gaEventHabitRisk(name){
        pushGaEvent("Browse By Habit", "Click on Habit", name);
    }

    function gaEventCommonRisk(name){
        pushGaEvent("Browse By Habit", "Click on Habit", name);
    }

    /* Search - Home Page */
    function searchHomePage() {
        var favorite = {};

        var content_ids   = [];
        var content_name  = [];

        $("select[name='search_value']").find("option:selected").each(function(){
            var pkg_id      =   $(this).val();
            var pkg_value   =   $(this).text();
            content_ids.push(pkg_id);
            content_name.push(pkg_value.trim());
            favorite[pkg_id] = pkg_value.trim();
        });

        var city_name = getCookie('sLocation');
        var city_detail = "{{$city_name}}";

        if(city_name !== '') {
            city_name   =   city_name.replace(/ /g,"_");
            city_detail =   city_name.toLowerCase();
        }

        /* Exception case : city not present in cookie and not set in backend */
        if(city_detail === '') {
            city_detail = 'gurgaon';
        }

        if(Object.keys(favorite).length !== 0 && favorite.constructor === Object) {
            var esc = encodeURIComponent;
            var search_query = Object.keys(favorite)
                .map(function(k) {
                    return 'f[' + escape(k) + ']' + '=' + escape(favorite[k]);
                }).join('&');

            if (typeof(fbq) !== 'undefined') {
                var searchLength = Object.keys(favorite).length;
                var content_type = 'product';
                var fbData = [];
                fbData['content_ids']   = content_ids;
                fbData['content_type']  = content_type;
                fbData['content_name']  = content_name;
                fbData['content_category'] = 'Search > Home Page';
                fbq('track', 'Search', fbData);
            }

            window.location = document.location.origin + '/' + city_detail + '/orderbook' + '?' + search_query;
        }
        else {
            showStrError("warning", "Search field can't be blank");
            console.log("Home Page : Search empty");
        }
    }

    var select2 = $(".js-select2").select2({
        allowClear: false,
        enable: true,
        tags: true,
        ajax: {
          url: "{{$packageSuggestionURL}}",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              keyword: params.term,
              page: params.page,
              resource_type:'web'
            };
          },
          processResults: function (data, params) {
            params.page = params.page || 1;

            var  select2Data =  $.map(data.data, function (obj) 
            {   
                obj.text = obj.text || obj.product_name;
                obj.id = obj.id || obj.product_id;
                return obj;
            });
            return {
              results: select2Data
              
            };
          },
          cache: true
        },
        placeholder: 'Find your Package/Test',
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 1,
        templateResult: formatRepo,
        templateSelection: formatRepoSelection
    });

    function formatRepo (repo) {
        if (repo.loading) {
          return 'Searching..';
        }

        if( typeof repo.product_id != 'undefined' && typeof repo.actual_price != 'undefined' )
        {
            var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" ;
            markup  +=   "<span data-id="+repo.product_id+" value="+repo.product_id+" onclick='pushGaEvent(\"Search\", \"Selected One of Popular Tests\", \""+repo.product_name+"\")' data-value='"+repo.product_name+"'><span style='float:left;'> "+repo.product_name+ "</span><span style='float:right;'><span class='rupeesign' style='padding-right:2px;'>₹</span><strike style='margin-right: 15px;'>"+repo.actual_price+ "</strike><span class='rupeesign' style='padding-right:2px;'>₹</span>"+repo.healthian_price+ "</span></span>";


            markup +=   "</div></div>";
            return markup;
        }

        return '';
    }

    function formatRepoSelection (repo) {
      return repo.full_name || repo.text;
    }

    $(document).ready(function() {

        var interval = setInterval(function () {
            if ($("#actual_risk_area").isInViewport() || $("#actual_habit_area").isInViewport()) {
                var risk_api_url = $("#teams-slider3").data('apiurl');
                var risk_slider_setting = {
                    'items' : 3,
                    'autoPlay': true
                };
                getSliderAJAXData(risk_api_url, "teams-slider3", risk_slider_setting, true);

                var habit_api_url = $("#teams-slider5").data('apiurl');
                var habit_slider_setting = {
                    'items' : 3,
                    'autoPlay': true
                };
                getSliderAJAXData(habit_api_url, "teams-slider5", habit_slider_setting, true);

                clearInterval(interval);
            }
        }, 500);

        var interval2 = setInterval(function () {
            if ($("#blog_section").isInViewport()) {
                var api_url = $("#blog_slider").data('apiurl');
                getSliderAJAXData(api_url, 'blog_slider', {}, false);
                clearInterval(interval2);
            }
        }, 500);

        function matchCustom(params, data) {
            /*If there are no search terms, return all of the data*/
            if ($.trim(params.term) === '') {
                return data;
            }

            /*Do not display the item if there is no 'text' property*/
            if (typeof data.text === 'undefined') {
                return null;
            }
            if (data.text.indexOf(params.term) > -1) {
                var modifiedData = $.extend({}, data, true);
                modifiedData.text += ' (matched)';

                return modifiedData;
            }

            return null;
        }

        $(".tests .test").click(function(){
            var id = $(this).attr('data-id');
            var text = $(this).attr('data-value');

            if( $(this).hasClass('active') )
            {
                var wanted_option = $('#searchHome option[value="'+ $(this).data('id') +'"]');
                wanted_option.prop('selected', false);

                $('#searchHome').trigger('change.select2');
            }
            else
            {
                var option = new Option(text, id, true, true);
                select2.append(option).trigger('change');
            }

            $(this).toggleClass('active');
        });

        select2.on('select2:unselecting', function (e) {
            var removed_option = e.params.args.data.id;
            var test_class = '.t_option_'+removed_option;

            $(test_class).removeClass('active');
        });

        select2.on('select2:select', function (e) {
            console.log(e);
            var removed_option = e.params.data.id;
            var test_class = '.t_option_'+removed_option;

            $(test_class).addClass('active');
        });

        select2.on('select2.change',function(e){
            console.log(e);
        });

        $(document).on('focus','.select2-search__field',function(){
            $("#popular_package").clearQueue();
            $("#popular_package").slideDown();
        });

        $(document).on('click','body',function(e){
            var has_focus = $(".select2-search__field").is(":focus");
            if(!has_focus && !$(e.target).closest('#popular_package').length && !$(e.target).closest('.select2-search__field').length) {
                $("#popular_package").clearQueue().stop( true, true );
                $("#popular_package").slideUp();
            }
        });

        $(document).on('focus','.select2-search__field',function(){
           if( $(window).scrollTop() < 100 && isMobile.any())
           {
               window.scrollTo({
                   top: ( $(this).offset().top - 10),
                   left: 0,
                   behavior: 'smooth'
               });
           }
        });
    });

    function getSliderAJAXData(api_url, element_id, slider_setting, carousel_active) {
        $.ajax({
            url: api_url,
            type: "GET",
            success: function (data) {
                var response_data = data;
                $("#"+element_id).html(response_data.html_data);

                setTimeout(function(){
                    if(carousel_active) {
                        $("#"+element_id+'-load').hide();
                        enableCarousel(slider_setting, element_id);
                    }
                },100);
            }
        });
    }

    function enableCarousel(slider_setting, element_id) {
        $("#"+element_id).owlCarousel({
            navigation : true,
            pagination : false,
            items : slider_setting.items,
            infinite: true,
            itemsDesktop:[1199,3],
            itemsDesktopSmall:[980,2],
            itemsMobile : [600,1],
            autoPlay:true,
            loop:1,
            navigationText : ["",""]
        });
    }
</script>
<!-- Patient Feedback -->
<script>
    $(document).ready(function() {
        var item_count  =   3;
    $("#home-patient-testimonials").owlCarousel({
        center: true,
        navigation : false,
        pagination : true,
        items : item_count,
        itemsDesktop:[1199,3],
        itemsDesktopSmall:[980,2],
        itemsMobile : [600,1],
        autoPlay:true,
        loop: true,
        autoplay: true,
        animateOut: 'fadeOut',
        afterMove: function (elem) {

          var current = this.currentItem;
          var next  =   current + Math.ceil(item_count/2);
          $("#home-patient-testimonials .owl-wrapper div").removeClass('midactive');
          $("#home-patient-testimonials .owl-wrapper div:nth-child("+next+")").addClass('midactive');
        }
    });

     function bannerCarouselHasBeenInitialized()
    {
        console.log("vvv");
        var that = this;
        var owlDiv = $("#home-patient-testimonials");
        console.log("ttt"+that);
    }
});
</script>
<!-- Patient Feedback -->

<!-- <script type="text/javascript" src="/js/v2/index.js"></script> -->
{{-- <script type="text/javascript" src="{{mix('/js/v2/index.js')}}"></script>  --}}


@endpush