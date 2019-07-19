@extends('layout.landing_master')

@section('page-content')

<style type="text/css">
/*hdfc special*/
.rupeesign{font-family:'Hind',sans-serif;}
.brand_promopage .brand_header{ background:url(/img/campaign/hdfc_banner.jpg) no-repeat center top; background-size:contain; min-height:728px; }
.brand_promopage .brand_header .mainlogo{ display: block; max-width: 100%; padding:20px 0px; }
.brand_promopage .brand_header .mainlogo .logo{display: inline-block; float:right; margin-top:0px;}

.brand_promopage .brand_bannermid{ display:block; margin:10px 0px;}

.brand_promopage .brand_bannermid .beatdisease{background:#fff; border-radius:4px; -webkit-box-shadow: -3px -9px 125px -42px rgba(0,0,0,0.2);
-moz-box-shadow: -3px -9px 125px -42px rgba(0,0,0,0.2);box-shadow: -3px -9px 125px -42px rgba(0,0,0,0.2);}
.brand_promopage .brand_bannermid .beatdisease .titledisease{ padding:7px 0px;}
.brand_promopage .brand_bannermid .beatdisease .titledisease h4{ text-indent:22px; font-size:25px; border-bottom:1px solid #00a0a8; font-weight:600; margin-bottom:15px; color:#333; padding-bottom:15px; font-family: 'Open Sans', sans-serif;}
.brand_promopage .brand_bannermid .beatdisease .titledisease ul{ margin:0px; padding:0px; list-style:disc;  font-family: 'Open Sans', sans-serif;}
.brand_promopage .brand_bannermid .beatdisease .titledisease ul li{ background:url(/img/campaign/dotcircle.png) no-repeat left 8px; padding-left:5px; display:block; font-size:20px; padding-bottom:10px; font-family: 'Open Sans', sans-serif; font-style:italic; font-weight:600;}
.brand_promopage .brand_bannermid .beatdisease .bd_price{ position:relative; background:#00a0a8; color:#fff;  padding:14px 0px 12px 30px;}
.brand_promopage .brand_bannermid .beatdisease .bd_price .bdsave{ display:inline-block; font-size:24px; margin-bottom:0px; font-weight:600;font-family: 'Open Sans', sans-serif;}
.brand_promopage .brand_bannermid .beatdisease .bd_price .bdpay{ font-weight:700;font-family: 'Open Sans', sans-serif; font-size:30px; font-style:italic; margin:0px;     line-height: 23px;    padding: 0px 0px 0px 121px;}

.brand_promopage .brand_bannermid .bd_queryform{font-family: 'Open Sans', sans-serif; margin-left:50px;}
.brand_promopage .brand_bannermid .bd_queryform h1{ font-size:37px; margin:0px; padding:0px; font-weight:400; margin-bottom:25px;}
.brand_promopage .brand_bannermid .bd_queryform ul{ margin:0px; padding:0px; list-style:disc;  font-family: 'Open Sans', sans-serif;}
.brand_promopage .brand_bannermid .bd_queryform ul li{ background:url(/img/campaign/dott_small.png) no-repeat left 8px; display:block; font-size:16px; padding-left:20px; padding-bottom:10px; font-family: 'Open Sans', sans-serif;}
.inputformbd{width:100%; margin-bottom:20px;  background: #fff; font-size: 16px; font-family: 'Open Sans', sans-serif; border: 0; height:52px; padding-left:20px; border-radius:5px; color: #000; box-shadow:0 0 20px 4px rgba(0, 0, 0, .1) !important; padding-left:25px !important; }
.hdfcpackage{ text-align:center; margin:0px 20px; }
.taglinebrand{ font-size:18px; position:absolute; right:-11px; border-radius:30px 0px 0px 30px; margin:9px 0px; margin-left:40px; display:inline-block; font-style:italic; float:right; background:#e87712; padding:8px 30px 8px 24px;  }
.givemisscall{ font-size:22px; letter-spacing:1px; margin-bottom:50px; }
.givemisscall strong{ color:#00a0a8; }
.usphkserv{width:100%; margin:0px; padding:80px 0px 60px 0px;font-family: 'Open Sans', sans-serif;}
.usphkserv h2{font-size:38px; font-family: 'Open Sans', sans-serif; font-weight:600;}
.usphkserv p{font-size: 18px; line-height:24px; font-family: 'Open Sans', sans-serif;  margin-top:10px; margin-bottom: 30px;}
.usphkserv ul{ margin: 0; padding: 0;  list-style: none;}
.usphkserv ul li{margin: 30px 20px; display: inline-block; vertical-align:top; width: 16%;}
.usphkserv ul li .captions{font-family: 'Open Sans', sans-serif; margin-top:30px; text-align:center; }

/*hdfc special*/
label.error {text-align: left;color:#e43b3f;font-size: 12px;}
footer{ display:none !important;}
body{  background:#f8f8f8 !important; font-family:'Open Sans', sans-serif !important;}
p{font-family:'Open Sans', sans-serif !important;}
.tncsection{ margin-top:30px;  margin-bottom:10px; background:#f1f1f1; padding:20px 15px;clear: both;float: left;width: 100%;margin-bottom: 40px;}
.zopim {display: none !important;}
.mand_field_text {display: none;}
.field-button input[type=submit] { background-color:#ea6810 !important;}
.field-form input.user-icon,.field-form input.mob-icon{background-color: #fff !important;}
#landing_desktop{outline: none;display: block; height:52px; margin:5px 0px; font-size:21px; border:1px solid #fff; text-align: center; border: 0; border-radius:50px;  font-family: 'Roboto', sans-serif; font-weight:400; box-shadow:0px 6px 9px 0px rgba(60, 66, 69, 0.1), 0px 2px 6px 0px rgba(60, 66, 69, 0.10), 0px 8px 16px 0px rgba(86, 86, 86, 0.10), -4px 6.928px 16px 0px rgba(86, 86, 86, 0.10);  }
#landing_desktop{background-image: none;background-color:#ea6810 !important; color: #FFF;display:block; transition:0.5s all ease-in-out;}
.field-button input[type=submit]:hover{background-color: #fff; color: #ea6810;}
.minimal {height: 41px;display: block;width: 100%;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius:0px;-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;-o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;}
.hk_footermain{ background: #fff; padding: 40px 0;  margin: 0px 0 0;}
.hk_footermain .btm-link{ float:right; margin-top:18px; }
.hk_footermain ul.btm-link li{display: inline-block; font-family: 'Open Sans', sans-serif;   color: #3c3c3c;  border-right: 1px solid #49484a;
    margin: 0; padding: 0 11px;  }
.hk_footermain ul.btm-link li a{ text-decoration:none;font-size:15px; font-weight:600; }
.hk_footermain .btm-txt{ margin-top:20px;font-family: 'Open Sans', sans-serif;}
.hk_footermain .btm-txt p{font-family: 'Open Sans', sans-serif;  }
.hk_footermain .copy{font-family: 'Open Sans', sans-serif;}
.brand_bannermid a {text-decoration: none !important; color:#333;}
@media (max-width: 768px) and (min-width: 20px) {
    /*hdfc special*/
.brand_promopage .brand_header{ min-height:205px; background-size:cover;}
.brand_promopage .brand_header .beatdisease .titledisease{ padding:22px 28px;}
.brand_promopage .brand_header .col-xs-12{ margin:0px; padding:0px;}
.brand_promopage .brand_bannermid{ margin-top:30px; }
.brand_promopage .brand_bannermid .beatdisease .titledisease h4{ text-align:center; }
.brand_promopage .brand_header .beatdisease .titledisease ul li{ padding-left:23px;}
.brand_promopage .brand_header .beatdisease .titledisease h4{ font-size:27px; margin-top:0px;}
.brand_promopage .brand_header .beatdisease .bd_price .bdpay{ font-size:28px;}
.brand_promopage .brand_header .beatdisease .titledisease ul li{ font-size:18px;}
.brand_promopage .brand_header .bd_queryform{ margin:10px 10px;}
.brand_promopage .brand_header .bd_queryform h1{ font-size:25px; margin-bottom:15px;margin-top: 40px;}
.bd_btnlog{ width:100%;}
.brand_bannermid .container{ margin:0px; padding:0px; }
.taglinebrand{ float:none; position:relative; margin-left:0px; right:0px; display:block; }
.brand_promopage .brand_bannermid .bd_queryform{ margin-left:0px; }
.brand_promopage .brand_bannermid .bd_queryform h1{ font-size:24px; margin:25px 0px; }
.givemisscall{ font-size:18px; }
.hkserv_highlight h2{font-size: 25px;}
.field-form input{ height:45px;margin-bottom: 20px; }
.brand_promopage .brand_bannermid .beatdisease .titledisease ul li {text-align: left;}

/*hdfc special*/
/*Bengaluru Health Karma*/
.hkm_promopage{ background:#fff;}
.hkserv_highlight ul li .captions{ margin:0px; padding:0px; text-align: center;}
.hkm_promopage .hkm_header{ background-size:contain; background:url(/assets/images/campaign/banner_yuvraj_mob.jpg) no-repeat center top;}
.hkm_promopage .hkm_header .mainlogo .logo{ margin-top:0px;}
.hkm_promopage .hkm_header .mainlogo .logo img{ max-width:78%;}
.hkm_promopage .hkm_header .mainlogo .container{ margin:0px; padding:0px;}
.hkm_promopage .hkm_header .mainlogo .col-xs-12{ margin:0px; padding:0px;}
.hkm_promopage .hkm_header .bannermid .promo-slogan{ width:90%; margin:30px auto 0px auto;}
.hkm_promopage .hkm_header .bannermid{background:url(/assets/images/campaign/mobile-standalone-yuv.jpg) no-repeat center right; min-height:565px;}
.hkserv_highlight ul li{ width:45%; margin:0px;}
.hkserv_highlight p{font-size: 16px; margin-bottom:10px; line-height:20px;}
.hk_introducing{ padding:20px 0px 40px 0px;}
.hkm_promopage .hkm_header .bannermid .promo-slogan h2{    font-size: 54px;}
.hkserv_highlight h2{ font-size:24px;}
.hkserv_highlight ul li figure img{ max-width:80%;}
.hkm_promopage .hkm_header .bannermid .promo-slogan h3{font-size:28px;}
.bannermid .container{ margin:0px; padding:0px;}
.bannermid .col-xs-12{ margin:0px; padding:0px;}
.hkm_promopage .hkm_header .mainlogo{ margin:0px; padding:10px 0px;}
.hkm_promopage .hkm_header .mainlogo .call_us{ color:#007f85; padding-left:18px; font-size:1.1em; background: url(/assets/images/campaign/dark_callicon.png) no-repeat left center;}
.hkm_promopage .hkm_header .mainlogo .call_us a{color:#007f85;}
.get_healthkarma{ margin-top:20px;}
.get_healthkarma a{ padding: 7px 20px;font-size: 14px;} 
.hkm_promopage .hkm_header .bannermid .promo-slogan p{ max-width:70%; font-size:16px; margin:0px;}
.mobilemedia{ background:url(/assets/images/campaign/mobile-standalone-yuv.jpg) no-repeat center right;}
.hkm_promopage .hkm_header .servicehighlights{ margin:0px; padding:0px;}
.hkm_promopage .hkm_header .servicehighlights ul li{vertical-align: top; text-align: center; margin-bottom: 20px; width: 49%; margin-right: 0px;
    padding-left: 4%; padding-right: 0px;}
.hkm_promopage .hkm_header .servicehighlights ul li span{ font-size:2em; display:block;}
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

.hkserv_highlight ul li figure{ margin-bottom:15px; text-align:center;}
.imagehealthytext img{ max-width:95%;}
.hk_healthy{ min-height:550px; margin:50px 0px 20px 0px;}

.bottom_cta a{ font-size:20px;padding: 12px 28px;}
.hk_footermain ul.btm-link li{ padding:0px;}
.hk_footermain .btm-link li a{ padding:0px 6px;}

.imagehealthytext{ margin:76px 0px 20px 0px;}
.bottom_cta{ margin-top:40px;}
.tncsection {margin-top:5px;}
/*Bengaluru Health Karma*/
}


 </style>
 <!--Embeded Font-->
 <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
 <!--Embeded Font-->
 <div class="brand_promopage">
    <!--Header Starts here-->
    <section class="brand_header">
       <!--Logo-->
       <div class="mainlogo">
          <div class="container">
             <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="col-lg-6 col-md-6 col-xs-6">&nbsp;</div>
                <div class="col-lg-6 col-md-6 col-xs-6">
                   <div class="logo"></div>
                </div>
             </div>
          </div>
       </div>
       <!--Logo Ends-->
       <div class="clear"></div>
    </section>
    <!--Header Starts here-->
    <!--Banner Mid-->
    <div class="brand_bannermid">
       <div class="container">
          <div class="col-lg-12 col-md-12 col-xs-12">
             <!--Beat Diabetes Offer -->			
             <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="beatdisease">
                   <div class="titledisease">
                      <h4><a href="package/healthians-full-body-checkup-with-thyroid-and-cbc" target="_blank">Full Body Checkup with Thyroid & CBC</a></h4>
                      <table cellpadding="0" cellspacing="0" border="0" class="hdfcpackage" align="center">
                         <tr>
                            <td width="60%" style="text-align:left; padding-left:10px;">Lipid, Liver, Complete Hemogram,Thyroid, Urine, Blood Sugar, Kidney</td>
                            <td width="40%">
                               <ul style="list-style:none;">
                                  <li style="list-style:none; background:none !important;">Tests Included: 74</li>
                               </ul>
                            </td>
                         </tr>
                      </table>
                   </div>
                   <div class="bd_price">
                      <div class="bdsave">
                         Our Price : <span style='color:red;text-decoration:line-through'>
                         <span style='color:white'><span class="rupeesign" style="font-weight:normal; padding:0px;">₹</span>
                         <strong style="color:#fff;"> 2700 </strong></span>
                         </span>
                         <h4 class="bdpay">FREE</h4>
                      </div>
                      <div class="taglinebrand">Package for the Winner</div>
                   </div>
                </div>
                <br><br>
                <div class="beatdisease">
                   <div class="titledisease">
                      <h4><a href="package/healthians-hardostfit-package" target="_blank">Healthians HarDostFit Package</a></h4>
                      <table cellpadding="0" cellspacing="0" border="0" class="hdfcpackage" align="center">
                         <tr>
                            <td width="60%" style="text-align:left; padding-left:10px;">Lipid, Liver, Complete Hemogram
                               Thyroid, Urine, Blood Sugar, Iron,
                               HbA1c, Calcium Total, Kidney 
                            </td>
                            <td width="40%">
                               <ul style="list-style:none;">
                                  <li style="list-style:none; background:none !important;">Tests Included: 80</li>
                               </ul>
                            </td>
                         </tr>
                      </table>
                   </div>
                   <div class="bd_price">
                      <div class="bdsave">
                         Our Price : <span style='color:red;text-decoration:line-through'>
                         <span style='color:white'><span class="rupeesign" style="font-weight:normal; padding:0px;">₹</span><strong style="color:#fff;"> 5780 </strong></span>
                         </span>
                         <h4 class="bdpay"> <span class="rupeesign" style="font-weight:normal; padding:0px;">₹</span>999</h4>
                      </div>
                      <div class="taglinebrand">Package for Participants</div>
                   </div>
                </div>
             </div>
             <!--Beat Diabetes Offer -->
             <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="bd_queryform">
                   <h1>To Redeem offer</h1>
                   <ul>
                      <li>Fill in the <strong>details</strong> below</li>
                      <li>Use the <strong>OTP</strong> on Healthians website</li>
                      <li>Enter your <strong>Unique Promo Code</strong> on the payment page</li>
                      @include('landing_pages.callback_form')
                      <p class="givemisscall">Give a missed call @ <strong>987 029 311 0</strong></p>
                   </ul>
                </div>
             </div>
          </div>
       </div>
    </div>
    <!--Banner Mid-->
    <div class="clear"></div>
    <div class="tncsection">
       <div class="col-lg-12 col-md-12 col-xs-12">
          <div class="container">
             <table width="100%" border="0" cellspacing="6" cellpadding="6">
                <tr>
                   <td width="18%" valign="top">
                      <h4>Terms & Conditions</h4>
                   </td>
                   <td valign="top" width="82%">
                      <p style="">1.  Validity 31st March 2019  |  2. Valid for one-time use only  |  3. This coupon code is valid for Delhi NCR users only.  |  4. Standard Healthians website
                         T&C would apply.  |  5. To get the discount, apply code on Healthians website or via application at payment page.  |  6. For details email us: fitness@healthians.com
                      </p>
                   </td>
                </tr>
             </table>
          </div>
       </div>
       <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <!--Keep Health Section-->
    <section class="hkserv_highlight text-center usphkserv">
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
    <!--Keep Health Section-->
    <div class="clear"></div>
 </div>
 <div class="hk_footermain">
    <div class="container brdtop">
       <div class="row">
          <div class="col-sm-2"> <a href=""><img class="btm-logo-site" style="max-width:100%;" class="lazy" data-src="/img/healthians_logo.png"></a> </div>
          <div class="col-sm-10">
             <ul class="btm-link" style="font-size:18px; text-transform:uppercase; color:#555;">
                <li><a href="/about-us" target="_blank" style="color:#49484a;">About Us</a></li>
                <li><a href="/deals" target="_blank" style="color:#49484a;">Health Deals</a></li>
                <li><a href="https://blog.healthians.com/" style="color:#49484a;" target="_blank">Health Blog</a></li>
                <li><a href="/feedback" style="color:#49484a;" target="_blank">Feedback/Complaints</a></li>
                <li><a href="/contact-us" style="color:#49484a;" target="_blank">Contact Us</a></li>
             </ul>
          </div>
       </div>
       <div class="btm-txt">
          <p style="text-align:center; color:#3c3c3c;"> Healthians is India’s largest health test @ home service’ provider, offering a wide range of online blood test in Delhi NCR and 27 other cities. We also offer all kind of pathology tests including blood, urine and other lab tests with free sample collection from home. Users can avail free health counselling with every booking. All samples are evaluated at our network of NABL labs spread across Delhi NCR and other cities. We have our own team of highly skilled phlebotomist who specialize in blood sample collection from home.<br><br> For all blood test at home including <a style="color:#3c3c3c;" href="/parameter/chikungunya-dna-detection-by-pcr-blood" target="_blank">Chikungunya test</a>, <a style="color:#3c3c3c;" href="/package/healthians-dengue-profile" target="_blank">dengue test in Delhi</a>, <a href="/profile/complete-hemogram" target="_blank" style="color:#3c3c3c;">Complete Hemogram (CBC)</a>, <a href="/parameter/random-blood-sugar" target="_blank" style="color:#3c3c3c;">Blood sugar</a>, <a href="/profile/liver-function-test" target="_blank" style="color:#3c3c3c;">Liver function test (LFT)</a>, <a href="/profile/kidney-function-test" target="_blank" style="color:#3c3c3c;">Kidney function test (KFT)</a>, <a style="color:#3c3c3c;" href="/profile/lipid-profile" target="_blank">Lipid profile</a>, <a style="color:#3c3c3c;" href="/parameter/dengue-ns1-antigen-detection-elisa" target="_blank">Dengue (NS1 and antigen)</a>, <a style="color:#3c3c3c;" href="/parameter/chikungunya-igm-antibody" target="_blank">Chikungunya (PCR and IgM antibody)</a>, <a style="color:#3c3c3c;" href="/profile/thyroid-profile-total" target="_blank">Thyroid</a>, <a href="/parameter/typhi-dot-igm" target="_blank" style="color:#3c3c3c;">Typhoid</a>, <a href="/profile/hba1c" target="_blank" style="color:#3c3c3c;">HbA1c</a>, <a style="color:#3c3c3c;" href="/parameter/glucose" target="_blank">Glucose</a>, <a style="color:#3c3c3c;" href="/parameter/iron-serum" target="_blank">Iron Serum</a>, <a href="/package/healthians-pancreatitis-package" target="_blank" style="color:#3c3c3c;">Pancreatic profile</a>, <a href="/profile/electrolytes-profile" target="_blank" style="color:#3c3c3c;">Electrolytes profile</a>, <a href="/package/vitamin-plus-package" target="_blank" style="color:#3c3c3c;">Vitamins profile</a> and <a href="/package/healthians-full-body-checkup" style="color:#3c3c3c;">full body checkups</a>, all you need to do is to give us a miss call. With 1 click booking and same day online reports, lab test at home was never so convenient! </p>
       </div>
       <div class="copy" style="font-size:14px; color:#3c3c3c; text-align:center;">2019 @ Healthians.com | <a style="color:#3c3c3c;" target="_blank" href="/terms-condition">Legal</a> </div>
    </div>
 </div>

 <style type="text/css">
    .zopim {
    display: none !important;
    }
 </style>

@endsection

@push('footer-scripts')
    <script src="/js/landing_page.js"></script>
    <footer></footer>
@endpush