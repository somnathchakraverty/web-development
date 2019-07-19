@extends('layout.master')

@section('page-content')

{!! $content !!}

{{-- <style type="text/css">
footer{ display:none !important;}
body{  background:#fff !important; color:#333;}
header { display: none; }
.subscribe-section { display: none; }
.hkm_promopage{ width:100%; }
.hkm_promopage .hkm_header{ background:url(/img/campaign/banner_yuvraj.jpg) no-repeat center top; font-family: 'Open Sans', sans-serif;background-size:contain; min-height:728px; }
.hkm_promopage .hkm_header .mainlogo{ display: block; max-width: 100%; padding:20px 0px; }
.hkm_promopage .hkm_header .mainlogo .logo{display: inline-block; margin-top:0px; }
.hkm_promopage .hkm_header .mainlogo .call_us{display: block; background: url(/img/campaign/callicon.png) no-repeat left center; font-size:26px; color: #fff;
max-width: 223px; float: right; padding-left: 23px; font-family: 'Crete Round', serif; }
.hkm_promopage .hkm_header .mainlogo .call_us a{ text-decoration:none; color:#fff;}
.mobilemedia{ display:none;}
.hkm_promopage .hkm_header .bannermid{display: block; font-family: 'Crete Round', serif; max-width: 100%; padding:5px 0px; }
.hkm_promopage .hkm_header .bannermid .promo-slogan{ color:#3a3a3a; margin-top:110px; }
.hkm_promopage .hkm_header .bannermid .promo-slogan h3{font-family: 'Crete Round', serif; font-size: 43px; margin:0px; padding:0px;}
.hkm_promopage .hkm_header .bannermid .promo-slogan h2{font-family: 'Crete Round', serif; font-size:95px; color:#007f85; margin:0px; padding:0px;}
.hkm_promopage .hkm_header .bannermid .promo-slogan p{font-family: 'Open Sans', sans-serif; font-weight:600; max-width:350px; color:#3a3a3a; margin:20px 0px; font-size:27px;}
.get_healthkarma{ display:block; margin-top:40px; }
.get_healthkarma a{ background:#f17c25; border:1px solid #f17c25; transition:0.4s all; color:#fff; font-size:22px; text-decoration:none; border-radius:30px; padding:10px 30px; }
.get_healthkarma a:hover{ background:#fff; color: #f17c25; }
.hkm_promopage .hkm_header .servicehighlights{ width:100%; margin:0px; padding:95px 0px 20px 0px;}
.hkm_promopage .hkm_header .servicehighlights ul{ margin:0px; padding:0px; list-style:none; }
.hkm_promopage .hkm_header .servicehighlights ul li{ list-style:none; display:inline-block; margin-right:15px; border-right:2px solid #007f85;padding-right:8px; max-width:320px; }
.hkm_promopage .hkm_header .servicehighlights ul li span{ float: left; font-size:35px; color:#007f85; }
.hkm_promopage .hkm_header .servicehighlights ul li p{float: left; font-size: 19px; font-family: 'Open Sans', sans-serif;  line-height:20px;  padding-left:9px; color: #3c3c3c; letter-spacing:-0.4px; margin: 6px 0 0 0; max-width:139px;}
.hkm_promopage .hkm_header .servicehighlights ul li:nth-child(4){border-right:none;}
.accuracydoorstep{  width:100%; margin:0px; padding:20px 0px 20px 0px;}
.accuracydoorstep .qualitylabservice{ margin-top:140px; }
.accuracydoorstep .qualitylabservice h2{ color:#404040; font-size:36px; font-family: 'Crete Round', serif; }
.accuracydoorstep .qualitylabservice h4{ color:#006b70; font-size:18px; line-height:25px; padding:14px 0px; }
.accuracydoorstep .qualitylabservice p{font-size:14px; line-height:25px; font-family: 'Open Sans', sans-serif; margin:15px 0px;  }
.hkserv_highlight{width:100%; margin:0px; padding:80px 0px 60px 0px;}
.hkserv_highlight h2{font-size:38px; font-family: 'Crete Round', serif;}
.hkserv_highlight p{font-size: 18px; line-height:24px; font-family: 'Open Sans', sans-serif;  margin-top:10px; margin-bottom: 30px;}
.hkserv_highlight ul{ margin: 0; padding: 0;  list-style: none;}
.hkserv_highlight ul li{margin: 30px 20px; display: inline-block; vertical-align:top; width: 16%;}
.hkserv_highlight ul li .captions{font-family: 'Crete Round', serif; margin-top:30px; text-align:center; }
.hk_healthy{ background:url(/img/campaign/healthy-years-banner.jpg) no-repeat left top; background-size:contain; min-height:610px;}
.imagehealthytext{ margin:60px 0px 20px 0px;}
.hk_introducing{width:100%; margin:0px; padding:80px 0px 40px 0px;}
.hk_introducing h2{font-size:38px; font-family: 'Crete Round', serif;}
.hk_introducing p{font-size: 22px; line-height:28px; color:#599fa6; padding: 0px 37px; font-family: 'Crete Round', serif;  margin-top:10px; margin-bottom: 30px;}
.hk_introducing .midintros{ background:url(/img/campaign/bg_karma.png) no-repeat center top; min-height:520px; }
.hk_introducing .midintros .hk_mainpanel{ max-width:100%; padding:96px 15px 20px 15px; }
.hk_introducing .midintros .hk_mainpanel h4{ color: #fff; font-size: 40px; font-family: 'Crete Round', serif; }
.hk_introducing .midintros .hk_mainpanel h5{ color: #fff; font-size: 25px; font-family: 'Open Sans', sans-serif; }
.hk_introducing .midintros .hk_mainpanel p{ color: #fff; padding-left:20px; font-size: 18px; margin-top:0px; margin-bottom:15px; font-family: 'Crete Round', serif; }
.hk_introducing .midintros .hk_mainpanel hr{ border: none; border-bottom:1px solid #fff; margin:0px auto;  padding:0px; }
.hk_introducing .midintros .hk_mainpanel h3{ color: #fff; font-size: 28px; line-height: 50px; margin:0px; font-family: 'Crete Round', serif; margin-bottom:20px; }
.hk_introducing .midintros .hk_mainpanel ul{ margin:0px; padding:0px; list-style:disc; }
.hk_introducing .midintros .hk_mainpanel ul li{display: inline-block; text-align: left; width: 240px; list-style: disc;padding-right:50px; vertical-align:top; }
.hk_introducing .midintros .hk_mainpanel ul li span{ font-family: 'Crete Round', serif; color: #fff; font-size: 22px; height: 70px;
 display: block; background:url(/img/campaign/bulleticon.png) no-repeat left 12px; padding-left:20px;}
.subtext{ color: #fff; font-size: 16px !important; line-height:22px !important; margin-top:0px; margin-bottom:15px; font-family: 'Open Sans', sans-serif !important; }
.hk_footermain{ background: #fff; padding: 40px 0;  margin: 0px 0 0;}
.hk_footermain .btm-link{ float:right; margin-top:18px; }
.hk_footermain ul.btm-link li{display: inline-block; font-family: 'Open Sans', sans-serif;   color: #3c3c3c;  border-right: 1px solid #49484a;
    margin: 0; padding: 0 11px;  }
.hk_footermain ul.btm-link li a{ text-decoration:none;font-size:15px; font-weight:600; }
.hk_footermain .btm-txt{ margin-top:20px;font-family: 'Open Sans', sans-serif;}
.hk_footermain .btm-txt p{font-family: 'Open Sans', sans-serif;  }
.hk_footermain .copy{font-family: 'Open Sans', sans-serif;}
.imagehealthyfamily{min-height:178px;}
.brdtop{ border-top:2px solid #ccc; padding-top:20px;}
.bottom_cta{font-family: 'Crete Round', serif;}
.call_us a {font-size: 26px !important; }
 
@media (max-width: 768px) and (min-width: 20px) {
.hkm_promopage{ background:#fff;}
.hkserv_highlight ul li .captions{ margin:0px; padding:0px; text-align: center;}
.hkm_promopage .hkm_header{ background-size:contain; background:url(/img/campaign/banner_yuvraj_mob.jpg) no-repeat center top;}
.hkm_promopage .hkm_header .mainlogo .logo{ margin-top:0px;}
.hkm_promopage .hkm_header .mainlogo .logo img{ max-width:78%;}
.hkm_promopage .hkm_header .mainlogo .container{ margin:0px; padding:0px;}
.hkm_promopage .hkm_header .mainlogo .col-xs-12{ margin:0px; padding:0px;}
.hkm_promopage .hkm_header .bannermid .promo-slogan{ width:90%; margin:30px auto 0px auto;}
.hkm_promopage .hkm_header .bannermid{background:url(/img/campaign/mobile-standalone-yuv.jpg) no-repeat center right; min-height:565px;}
.hkserv_highlight ul li{ width:45%; margin:0px;}
.hkserv_highlight p{font-size: 15px; margin-bottom:10px; line-height:20px;}
.hk_introducing{ padding:5px 0px 40px 0px;}
.hkm_promopage .hkm_header .bannermid .promo-slogan h2{    font-size: 54px;}
.hkserv_highlight h2{ font-size:24px;}
.hkserv_highlight ul li figure img{ max-width:80%;}
.hkm_promopage .hkm_header .bannermid .promo-slogan h3{font-size:28px;}
.bannermid .container{ margin:0px; padding:0px;}
.bannermid .col-xs-12{ margin:0px; padding:0px;}
.hkm_promopage .hkm_header .mainlogo{ margin:0px; padding:10px 0px;}
.hkm_promopage .hkm_header .mainlogo .call_us{ color:#007f85; padding-left:8px; font-size:1.1em; background: url(/img/campaign/dark_callicon.png) no-repeat left center;}
.hkm_promopage .hkm_header .mainlogo .call_us a{color:#007f85;font-size:1em !important;}
.get_healthkarma{ margin-top:20px;}
.get_healthkarma a{ padding: 7px 20px;font-size: 14px;} 
.hkm_promopage .hkm_header .bannermid .promo-slogan p{ max-width:70%; font-size:16px; margin:0px;}
.mobilemedia{ background:url(/img/campaign/mobile-standalone-yuv.jpg) no-repeat center right;}
.hkm_promopage .hkm_header .servicehighlights{ margin:0px; padding:0px;}
.hkm_promopage .hkm_header .servicehighlights ul li{vertical-align: top; text-align: center; margin-bottom: 20px; width: 49%; margin-right: 0px;padding-left: 3%; padding-right: 0px;}
.hkm_promopage .hkm_header .servicehighlights ul li span{ font-size:1.8em; display:block;}
.hkm_promopage .hkm_header .servicehighlights ul li p{ margin:0px;font-size:15px; max-width:100%; text-align:left; padding-left:0px; line-height: 16px; display:block; float:none; clear:both;}
.hkm_promopage .hkm_header .servicehighlights .container{margin:0px; padding:0px;}
.hkm_promopage .hkm_header .servicehighlights ul li:nth-child(2){ border-right:0px;}
.hkm_promopage .hkm_header .servicehighlights ul li:nth-child(4){ border-right:0px;}
.labtrusted img{ max-width:80%;}
.accuracydoorstep .container{ margin:0px; padding:0px;}
.accuracydoorstep .col-xs-12{ margin:0px; padding:0px;}
.labtrusted{ text-align:center;}
.accuracydoorstep .qualitylabservice{ margin-top:0px; margin:0px auto; max-width:90%;}
.accuracydoorstep .qualitylabservice h2{font-size:26px;}
.accuracydoorstep .qualitylabservice h4{ padding:2px 0px;}
.hkserv_highlight{ padding:0px;}
.hkserv_highlight .container{ margin:0px; padding:0px;}
.hkserv_highlight .col-xs-12{ margin:0px; padding:0px;}
.hkserv_highlight ul li figure{ margin-bottom:15px; text-align:center;}
.imagehealthytext img{ max-width:95%;}
.hk_healthy{ min-height:510px; margin:50px 0px 5px 0px;}
.hk_introducing h2{font-size: 35px; font-family: 'Crete Round', serif; padding: 0px 60px;}
.hk_introducing .midintros .hk_mainpanel{ padding:74px 0px 20px 0px;}
.hk_introducing .midintros .hk_mainpanel h4{ font-size:28px; margin:0px;}
.hk_introducing .midintros .hk_mainpanel h5{ font-size:20px;}
.hk_introducing .midintros .hk_mainpanel h3{ margin:0px; font-size:22px;}
.hk_introducing p{ margin-bottom:0px;}
.hk_introducing .midintros .hk_mainpanel ul{ margin:30px 10px;}
.hk_introducing .midintros{ background:url(/img/campaign/bg-free-access.jpg) no-repeat center top;}
.hk_introducing .midintros .hk_mainpanel ul li{ width:100%; padding-right:0%;}
.hk_introducing .midintros .hk_mainpanel ul li span{font-size:17px; line-height:25px; line-height:24px; height:28px;}
.bottom_cta a{ font-size:20px;}
.hk_footermain ul.btm-link li{ padding:0px;}
.hk_footermain .btm-link li a{ padding:0px 6px;}
.imagehealthytext{ margin:48px 0px 20px 0px;}
.bottom_cta{ margin-top:40px;}
.subtext{font-size:14px !important }
.accuracydoorstep .qualitylabservice p { font-size: 12px; }
}
</style>

 <link href="https://fonts.googleapis.com/css?family=Crete+Round:400,400i" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">

 <div class="hkm_promopage">
    <section class="hkm_header">
       <div class="mainlogo">
          <div class="container">
             <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="col-lg-6 col-md-6 col-xs-6">
                   <div class="logo"><img src="/img/campaign/main_logo.png"></div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-6">
                   <div class="call_us"><a href="tel:08033999933">080 33 99 99 33</a></div>
                </div>
             </div>
          </div>
       </div>
       <div class="bannermid">
          <div class="container">
             <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="col-lg-8 col-md-8 col-xs-12 pull-left">
                   <div class="promo-slogan">
                      <h3>Bengaluru, Get</h3>
                      <h2>Healthier!</h2>
                      <p>Check how your lifestyle is
                         impacting your health
                      </p>
                      <div class="get_healthkarma"><a href="/healthkarma" target="_blank">Calculate Your Health Karma</a></div>
                   </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12 pull-left">
                   <div class="mobilemedia">
                   </div>
                </div>
             </div>
          </div>
       </div>
       <div class="servicehighlights">
          <div class="container">
             <div class="col-lg-12">
                <div class="objectservice">
                   <ul>
                      <li>
                         <div class="objectitem">
                            <span>500K</span>
                            <p>satisfied customers</p>
                         </div>
                      </li>
                      <li>
                         <div class="objectitem">
                            <span>5.5 Million</span>
                            <p>accurate tests done</p>
                         </div>
                      </li>
                      <li>
                         <div class="objectitem">
                            <span>4.3</span>
                            <p>rated by our customers</p>
                         </div>
                      </li>
                      <li>
                         <div class="objectitem">
                            <p>making India healthier since</p>
                            <span>2015</span>
                         </div>
                      </li>
                   </ul>
                </div>
             </div>
          </div>
       </div>
       <div class="clear"></div>
    </section>
    <section class="accuracydoorstep">
       <div class="container">
          <div class="col-lg-12 col-md-12 col-xs-12">
             <div class="col-lg-7 col-md-7 col-xs-12">
                <div class="labtrusted"><img src="/img/campaign/lab-trust.png"></div>
             </div>
             <div class="col-lg-5 col-md-5 col-xs-12">
                <div class="qualitylabservice">
                   <h2>Accuracy at your doorstep</h2>
                   <h4>From Delhi to Bangalore,<br>1000’s track their health everyday with Healthians.</h4>
                   {!! $city_html !!}
                </div>
             </div>
          </div>
       </div>
    </section>
    <section class="hkserv_highlight text-center">
       <div class="container">
          <h2>Keep your health in check with <span style="color:#007f85;">Healthians</span></h2>
          <p>India’s Largest Health test at Home Service</p>
          <ul>
             <li>
                <figure><img src="/img/campaign/hk_samplecollection.png"></figure>
                <p class="captions">Free &amp; On-time
                   Sample Collection
                </p>
             </li>
             <li>
                <figure><img src="/img/campaign/hk_fastaccurate.png"></figure>
                <p class="captions">Fast &amp; Accurate
                   Test Reports
                </p>
             </li>
             <li>
                <figure><img src="/img/campaign/hk_diet.png"></figure>
                <p class="captions">Free Doctor &amp;
                   Diet Consultation
                </p>
             </li>
             <li>
                <figure><img src="/img/campaign/hk_ereports.png"></figure>
                <p class="captions">Smart &amp;
                   Self-explanatory
                   E-reports
                </p>
             </li>
             <li>
                <figure><img src="/img/campaign/hk_tracker.png"></figure>
                <p class="captions">Personal
                   Health Tracker
                </p>
             </li>
          </ul>
       </div>
    </section>
    <section class="hk_healthy text-center">
       <div class="container">
          <div class="col-lg-12 col-md-12 col-xs-12">
             <div class="col-lg-7 col-md-7 col-xs-12">
                <div class="imagehealthyfamily">&nbsp;</div>
             </div>
             <div class="col-lg-5 col-md-5 col-xs-12">
                <div class="imagehealthytext"><img src="/img/campaign/healthy-years-text.png"></div>
             </div>
          </div>
       </div>
    </section>
    <section class="hk_introducing text-center">
       <h2>Introducing Health Karma</h2>
       <p>Free health evaluation based on your lifestyle</p>
       <div class="clear"></div>
       <div class="midintros">
          <div class="container">
             <div class="hk_mainpanel">
                <h4>So, how does this work?</h4>
                <h5>You tell us about your lifestyle</h5>
                <p>12 MCQ’s & 3 minutes is all it takes</p>
                <hr style="max-width: 480px;">
                <h3>& We give you free access to</h3>
                <div class="clear"></div>
                <ul>
                   <li>
                      <span>Your lifestyle score</span>
                      <p class="subtext">Build on intelligent algorithms</p>
                   </li>
                   <li>
                      <span>Your personal lifestyle tracker</span>
                      <p class="subtext">Foreknowledge of health trends & risk areas</p>
                   </li>
                   <li>
                      <span>Recommended diagnostic tests</span>
                      <p class="subtext">Based
                         on your health risks
                      </p>
                   </li>
                   <li>
                      <span>Expert dietary & lifestyle advice</span>
                      <p class="subtext">To help you take corrective actions</p>
                   </li>
                </ul>
             </div>
          </div>
       </div>
       <div class="get_healthkarma bottom_cta"><a href="/healthkarma" target="_blank">Calculate Your Health Karma</a></div>
    </section>
    <div class="clear"></div>
 </div>
 <div class="hk_footermain">
    <div class="container brdtop">
       <div class="row">
          <div class="col-sm-2"> <a href=""><img class="btm-logo-site" style="max-width:100%;" src="https://cdn1.healthians.com/img/healthians_logo.png" lazy-img="https://cdn1.healthians.com/img/healthians_logo.png"></a> </div>
          <div class="col-sm-10">
             <ul class="btm-link" style="font-size:18px; text-transform:uppercase; color:#555;">
                <li><a href="/about-us" target="_blank" style="color:#49484a;">About Us</a></li>
                <li><a href="/deals" target="_blank" style="color:#49484a;">Health Deals</a></li>
                <li><a href="http://blog.healthians.com/" style="color:#49484a;" target="_blank">Health Blog</a></li>
                <li><a href="/feedback" style="color:#49484a;" target="_blank">Feedback/Complaints</a></li>
                <li><a href="/contact-us" style="color:#49484a;" target="_blank">Contact Us</a></li>
             </ul>
          </div>
       </div>
       <div class="btm-txt">
          <p style="text-align:center; color:#3c3c3c;"> Healthians is ‘India’s largest health test @ home service’ provider, offering a wide range of online blood test in Delhi NCR and 27 other cities. We also offer all kind of pathology tests including blood, urine and other lab tests with free sample collection from home. Users can avail free health counselling with every booking. All samples are evaluated at our network of NABL labs spread across Delhi NCR and other cities. We have our own team of highly skilled phlebotomist who specialize in blood sample collection from home.<br><br> For all blood test at home including <a style="color:#3c3c3c;" href="/parameter/chikungunya-dna-detection-by-pcr-blood" target="_blank">Chikungunya test</a>, <a style="color:#3c3c3c;" href="/package/healthians-dengue-profile" target="_blank">dengue test in Delhi</a>, <a href="/profile/complete-hemogram" target="_blank" style="color:#3c3c3c;">Complete Hemogram (CBC)</a>, <a href="/parameter/random-blood-sugar" target="_blank" style="color:#3c3c3c;">Blood sugar</a>, <a href="/profile/liver-function-test" target="_blank" style="color:#3c3c3c;">Liver function test (LFT)</a>, <a href="/profile/kidney-function-test" target="_blank" style="color:#3c3c3c;">Kidney function test (KFT)</a>, <a style="color:#3c3c3c;" href="/profile/lipid-profile" target="_blank">Lipid profile</a>, <a style="color:#3c3c3c;" href="/parameter/dengue-ns1-antigen-detection-elisa" target="_blank">Dengue (NS1 and antigen)</a>, <a style="color:#3c3c3c;" href="/parameter/chikungunya-igm-antibody" target="_blank">Chikungunya (PCR and IgM antibody)</a>, <a style="color:#3c3c3c;" href="/profile/thyroid-profile-total" target="_blank">Thyroid</a>, <a href="/parameter/typhi-dot-igm" target="_blank" style="color:#3c3c3c;">Typhoid</a>, <a href="/profile/hba1c" target="_blank" style="color:#3c3c3c;">HbA1c</a>, <a style="color:#3c3c3c;" href="/parameter/glucose" target="_blank">Glucose</a>, <a style="color:#3c3c3c;" href="/parameter/iron-serum" target="_blank">Iron Serum</a>, <a href="/package/healthians-pancreatitis-package" target="_blank" style="color:#3c3c3c;">Pancreatic profile</a>, <a href="/profile/electrolytes-profile" target="_blank" style="color:#3c3c3c;">Electrolytes profile</a>, <a href="/package/vitamin-plus-package" target="_blank" style="color:#3c3c3c;">Vitamins profile</a> and <a href="/package/healthians-full-body-checkup" style="color:#3c3c3c;">full body checkups</a>, all you need to do is to give us a miss call. With 1 click booking and same day online reports, lab test at home was never so convenient! </p>
       </div>
       <div class="copy" style="font-size:14px; color:#3c3c3c; text-align:center;">2018 @ Healthians.com | <a style="color:#3c3c3c;" target="_blank" href="/terms-condition">Legal</a> </div>
    </div>
 </div> --}}

@endsection

@push('footer-scripts')
@endpush