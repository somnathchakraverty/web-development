@extends('layout.landing_master')

@section('page-content')

<style>
label.error { color:#e43b3f; float: left;}
.campaign-header .midpanel .content-panel .package-info {font-size: 14px;}
.mand_field_text { display: none;}
.arrowbounce { text-align: center; margin: 0px auto;}
body { background: #f9f9f9 !important;}
.in-media{ background: #f9f9f9;}
.bounce { -moz-animation: bounce 2s infinite; -webkit-animation: bounce 2s infinite; animation: bounce 2s infinite}

@keyframes bounce {
    0%,
    20%,
    50%,
    80%,
    100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-14px);
    }
    60% {
        transform: translateY(-7px);
    }
}

</style>

<!--header section starts here -->
<header class="campaign-header">
    <div class="container-fluid mid-section-campaign">
        <div class="row">
            <div class="col-lg-12">
                <div class="midpanel">
                    <!--logo starts -->
                    <div class="logo-panel">
                        <div class="main-logo"> <img src="/img/campaign/healthians-logo-campaign.png" /></div>
                    </div>
                    <!--logo ends -->
                    <div class="clear"></div>
                    <div class="content-panel">
                        <div class="col-sm-12">
                            <div class="col-sm-5">
                                <div class="package-info">
                                    <div class="yuv-mobile">
                                        <div class="sign">
                                            <h2>“I only trust Healthians for all Health Check ups.”</h2>
                                            <h4>-Yuvraj Singh, <em style="font-style:italic;">Brand Ambassador</em></h4>
                                            <img style="margin-right:10px;" src="/img/campaign/signature.png" /> 
                                        </div>
                                    </div>                            
                                    <h1>                                    
                                        <div class="save-percents">
                                            <div class="mobile-slashed">
                                                <span class="rupeesign" style="font-weight:normal; padding:0px; font-size:16px; padding-right:0px;">₹</span>
                                                <p class="slash" style="font-size:15px !important;">{{ $display_order_price }}</p>
                                            </div>
                                            <span class="savings-percent">Save <span>{{ $display_saving }}</span></span>
                                        </div>                                        
                                        <span>{{ $display_parameter_count }}</span> Health Tests @                                         
                                        <div class="slashedprice" style="color:#fc1340;">
                                            <span class="rupeesign" style="font-weight:normal; padding:0px; font-size:26px; padding-right:2px;">₹</span>
                                            <p class="slash" style="font-size:26px;">{{ $display_order_price }}</p>
                                        </div>                                        
                                        <strong>
                                            <span class="rupeesign" style="font-weight:normal; padding:0px;">₹</span>
                                            <span>{{ $display_healthians_price }}</span> 
                                        </strong>
                                        @if(!empty($display_package_name))
                                            <div class="fs_30">{{ $display_package_name }}</div>
                                        @endif  
                                    </h1>
                                    <p>{{ $display_package }}</p>
                                    <p> + Free Doctor Consultation</p>                                    
                                    <div class="clear"></div>
                                    <div class="form-campaign">
                                        @include('landing_pages.callback_form')
                                        <input type="hidden" name="ga_category" id="ga_category" value="{{$ga_category}}">                              
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7 text-right visible-web">
                                <div class="yuv-msg">
                                    <div class="col-sm-12">
                                        <div class="col-sm-8">
                                            <div class="signature">
                                                <h2>“I only trust Healthians for all Health Check ups.”</h2>
                                                <h4>-Yuvraj Singh, <em style="font-style:italic;">Brand Ambassador</em></h4>
                                                <img style="margin-right:10px;" src="/img/campaign/signature.png" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bouncing-icon">
                                <h2>Why only Healthians?</h2>
                                <div class="arrowbounce bounce"><img src="/img/campaign/bouncing.png" /></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</header>
    <!--header section ends here -->
    <div class="usp-campaign">
        <div class="container-fluid mid-section-campaign">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="home"></div>
                            <h4>FREE SAMPLE PICKUP</h4>
                            <p>Cost free sample pickup from Home or Office. </p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="hands"></div>
                            <h4>HONEST PRICES</h4>
                            <p>Say NO to cuts & commissions.</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="doc"></div>
                            <h4>{{ $display_doc }}</h4>
                            <p>{{ $display_doc_text }}</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="lab"></div>
                            <h4>GUARANTEED ACCURACY</h4>
                            <p>Money back guarantee on accuracy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="healthians-lab">
        <div class="container-fluid mid-section-campaign">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-3">
                        <div class="card-lab"> <img class="lazy" data-src="/img/campaign/lab1.jpg" />
                            <h5>100% CALIBRATION AND RESULTS</h5>
                            <p>We have deep analytical control on all our labs and insist them to follow NABL guidelines.</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card-lab"> <img class="lazy" data-src="/img/campaign/lab2.jpg" />
                            <h5>FULLY AUTOMATED</h5>
                            <p>All of our labs are fully automated, equipped with internationally renowned machines.</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card-lab"> <img class="lazy" data-src="/img/campaign/lab3.jpg" />
                            <h5>LATEST TECHNOLOGY AND EQUIPMENTS</h5>
                            <p>We are at par with the medical tech-driven advances. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card-lab"> <img class="lazy" data-src="/img/campaign/lab4.jpg" />
                            <h5>INTERNATIONAL QUALITY COMPLIANCE</h5>
                            <p>Our labs follow more than 150 international quality operating procedures for sampling.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="our-achievment">
        <div class="container-fluid mid-section-campaign">
            <div class="row">
                <div class="col-sm-12" style="text-align:center;">
                    <h1> 
                        <img class="lazy" data-src="/img/campaign/star.png" /> 
                        <img class="lazy" data-src="/img/campaign/star.png" />&nbsp;&nbsp;Our Achievements&nbsp;&nbsp; 
                        <img class="lazy" data-src="/img/campaign/star.png" /> 
                        <img class="lazy" data-src="/img/campaign/star.png" /> 
                    </h1>
                    <div class="bigstar">
                        <p>National PPTCT Programme </p>
                    </div>
                    <div class="bigstar">
                        <p>Innovative Health care Start-Up </p>
                    </div>
                    <div class="bigstar">
                        <p>Health & Social care Enterprise </p>
                    </div>
                    <div class="bigstar">
                        <p>Healthcare Innovator Programme </p>
                    </div>
                    <div class="bigstar">
                        <p>State Level consultation Memento </p>
                    </div>
                    <div class="bigstar">
                        <p>Enterprise leadership </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="our-trust">
        <div class="container-fluid mid-section-campaign">
            <h1>Trusted by Employees of</h1>
            <ul>            
                <li><img class="lazy" data-src="/img/campaign/logo2.jpg" /></li>
                <li><img class="lazy" data-src="/img/campaign/logo3.jpg" /></li>
                <li><img class="lazy" data-src="/img/campaign/logo4.jpg" /></li>
                <li><img class="lazy" data-src="/img/campaign/logo5.jpg" /></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <div class="in-media">
        <div class="container-fluid mid-section-campaign">
            <h1>In the media</h1>
            <div class="col-sm-12" style="text-align:center;">
                <div class="media-mid middle-media">
                    <a>
                        <div class="media-spritesc05"></div>
                    </a>
                    <a>
                        <div class="media-spritesc02"></div>
                    </a>
                    <a>
                        <div class="media-spritesc01"></div>
                    </a>
                    <a>
                        <div class="media-spritesc06"></div>
                    </a>
                    <a>
                        <div class="media-spritesc03"></div>
                    </a>
                    <a>
                        <div class="media-spritesc04"></div>
                    </a>
                    <a>
                        <div class="media-spritesc07"></div>
                    </a>
                    <a>
                        <div class="media-spritesc08"></div>
                    </a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <!--sticky div mobile -->
    <!--visible div -->
    <div class="sticky-bottom cms-campaign">
        @include('landing_pages.callback_form_mobile')
        <input type="hidden" name="ga_mobile_category" id="ga_mobile_category" value="{{$ga_mobile_category}}">
    </div>
    
   

@endsection

@push('footer-scripts')
<script src="/js/landing_page.js"></script>

<script type="text/javascript">        
    $(document).ready(function() {    
        $(".card")
            .mouseover(function() {
                $(this).find("p").addClass("colorwhite");
                $(this).find("div:eq(0)").css("background-position", '0px -44px');
            })
            .mouseout(function() {
                $(this).find("p").removeClass("colorwhite");
                $(this).find("div:eq(0)").css("background-position", '0px 0px');
            });
    });

</script>
<footer></footer>
@endpush