@extends('layout.landing_master')

@section('page-content')
<style type="text/css">
body {margin: 0px !important;}
label.error {text-align: left;color:#e43b3f;font-size: 12px;}
footer {display:none !important;}
body {background:#f8f8f8 !important;}
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
.imagehealthyfamily{min-height:178px;}
.brdtop{ border-top:2px solid #ccc; padding-top:20px;}
.bottom_cta{font-family: 'Crete Round', serif;}
    /*diabetes paytm special*/
.paytm_promopage .paytm_header{ background:url(/img/campaign/diabetes_header_new.jpg) no-repeat center top; background-size:contain; min-height:655px; }
.paytm_promopage .paytm_header .mainlogo{ display: block; max-width: 100%; padding:20px 0px; }
.paytm_promopage .paytm_header .mainlogo .logo{display: inline-block; float:right; margin-top:0px;}

.paytm_promopage .paytm_bannermid{ display:block; margin:50px 0px;}

.paytm_promopage .paytm_bannermid .beatdisease{background:#fff; border-radius:4px; overflow:hidden; -webkit-box-shadow: -3px -9px 125px -42px rgba(0,0,0,0.2);
-moz-box-shadow: -3px -9px 125px -42px rgba(0,0,0,0.2);box-shadow: -3px -9px 125px -42px rgba(0,0,0,0.2);}
.paytm_promopage .paytm_bannermid .beatdisease .titledisease{ padding:30px 50px;}
.paytm_promopage .paytm_bannermid .beatdisease .titledisease h4{ font-size:36px; font-weight:600; margin-bottom:25px; color:#333; font-family: 'Open Sans', sans-serif;}
.paytm_promopage .paytm_bannermid .beatdisease .titledisease ul{ margin:0px; padding:0px; list-style:disc;  font-family: 'Open Sans', sans-serif;}
.paytm_promopage .paytm_bannermid .beatdisease .titledisease ul li{ background:url(/img/campaign/dotcircle.png) no-repeat left 8px; padding-left:30px; display:block; font-size:21px; padding-bottom:10px; font-family: 'Open Sans', sans-serif; font-style:italic; font-weight:600;}
.paytm_promopage .paytm_bannermid .beatdisease .bd_price{ background:#00a0a8; color:#fff;  padding:30px 50px 22px 50px;}
.paytm_promopage .paytm_bannermid .beatdisease .bd_price .bdsave{ font-size:18px;font-family: 'Open Sans', sans-serif;}
.paytm_promopage .paytm_bannermid .beatdisease .bd_price .bdpay{ font-weight:600;font-family: 'Open Sans', sans-serif; font-size:40px; font-style:italic; margin:0px; padding:0px;}

.paytm_promopage .paytm_bannermid .bd_queryform{font-family: 'Open Sans', sans-serif; margin-left:50px;}
.paytm_promopage .paytm_bannermid .bd_queryform h1{ font-size:37px; margin:0px; padding:0px; font-weight:400; margin-bottom:25px;}
.paytm_promopage .paytm_bannermid .bd_queryform ul{ margin:0px; padding:0px; list-style:disc;  font-family: 'Open Sans', sans-serif;}
.paytm_promopage .paytm_bannermid .bd_queryform ul li{ background:url(/img/campaign/dott_small.png) no-repeat left 8px; display:block; font-size:16px; padding-left:20px; padding-bottom:10px; font-family: 'Open Sans', sans-serif;}
.inputformbd{width:100%; margin-bottom:20px;  background: #fff; font-size: 16px; font-family: 'Open Sans', sans-serif; border: 0; height:52px; padding-left:20px; border-radius:5px; color: #000; box-shadow:0 0 20px 4px rgba(0, 0, 0, .1) !important; padding-left:25px !important; }


.usphkserv{width:100%; margin:0px; padding:80px 0px 60px 0px;font-family: 'Open Sans', sans-serif;}
.usphkserv h2{font-size:38px; font-family: 'Open Sans', sans-serif; font-weight:600;}
.usphkserv p{font-size: 18px; line-height:24px; font-family: 'Open Sans', sans-serif;  margin-top:10px; margin-bottom: 30px;}
.usphkserv ul{ margin: 0; padding: 0;  list-style: none;}
.usphkserv ul li{margin: 30px 20px; display: inline-block; vertical-align:top; width: 16%;}
.usphkserv ul li .captions{font-family: 'Open Sans', sans-serif; margin-top:30px; text-align:center; }

.bd_btnlog{display: block; width:170px; height:52px; margin:5px 0px; font-size:21px; line-height:52px; border:1px solid #fff; text-align: center; border: 0; border-radius:50px;  font-family: 'Roboto', sans-serif; font-weight:400; box-shadow:0px 6px 9px 0px rgba(60, 66, 69, 0.1), 0px 2px 6px 0px rgba(60, 66, 69, 0.10), 0px 8px 16px 0px rgba(86, 86, 86, 0.10), -4px 6.928px 16px 0px rgba(86, 86, 86, 0.10);  }
.bd_btnlog{background-color:#ea6810; color: #FFF;display:block; transition:0.5s all ease-in-out;}
.bd_btnlog:hover{background-color: #fff; color: #ea6810;}
/*diabetes paytm special*/


@media (max-width: 768px) and (min-width: 20px) {
/*diabetes paytm special*/
.paytm_promopage .paytm_header{ min-height:205px; background-size:cover;}
.paytm_promopage .paytm_bannermid .beatdisease .titledisease{ padding:22px 28px;}
.paytm_promopage .paytm_bannermid .col-xs-12{ margin:0px; padding:0px;}
.paytm_promopage .paytm_bannermid .beatdisease .titledisease ul li{ padding-left:23px;}
.paytm_promopage .paytm_bannermid .beatdisease .titledisease h4{ font-size:27px; margin-top:0px;}
.paytm_promopage .paytm_bannermid .beatdisease .bd_price .bdpay{ font-size:24px;}
.paytm_promopage .paytm_bannermid .beatdisease .titledisease ul li{ font-size:18px;}
.paytm_promopage .paytm_bannermid .bd_queryform{ margin:10px 10px;}
.paytm_promopage .paytm_bannermid .bd_queryform h1{ font-size:24px; margin:25px 0px; }

.paytm_promopage .paytm_bannermid .bd_queryform h1{ font-size:25px; margin-bottom:15px;margin-top: 40px;}
.bd_btnlog{ width:100%;}
.hkserv_highlight{ padding:0px;}
.hkserv_highlight .container{ margin:0px; padding:0px;}
.hkserv_highlight .col-xs-12{ margin:0px; padding:0px;}
.hkserv_highlight ul li{ width:45%; margin:0px;}
.hkserv_highlight ul li figure{ margin-bottom:15px; text-align:center;}
.imagehealthytext img{ max-width:95%;}
.hkserv_highlight h2{ font-size:24px;}
.hkserv_highlight ul li figure img{ max-width:80%;}

.imagehealthytext img{ max-width:95%;}
.hk_footermain { padding:0px; }
.logo {position: absolute; right: -83px;}
.logo img {width: 52%;}
.paytm_promopage .paytm_header .mainlogo .logo{ margin-top:-4px;}
}
/*diabetes paytm special*/

 </style>
 <!--Embeded Font-->
 <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
 <!--Embeded Font-->
 <div class="paytm_promopage">
    <!--Header Starts here-->
    <section class="paytm_header">
       <!--Logo-->
       <div class="mainlogo">
          <div class="container">
             <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="col-lg-6 col-md-6 col-xs-6">&nbsp;</div>
                <div class="col-lg-6 col-md-6 col-xs-6">
                   <div class="logo"><img src="/img/healthianslogowhite.png"></div>
                </div>
             </div>
          </div>
       </div>
       <!--Logo Ends-->
       <div class="clear"></div>
    </section>
    <!--Header Starts here-->
    <!--Banner Mid-->
    <div class="paytm_bannermid">
       <div class="container">
          <div class="col-lg-12 col-md-12 col-xs-12">
             <!--Beat Diabetes Offer -->			
             <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="beatdisease">
                   <div class="titledisease">
                      <h4>Beat Diabetes Offer</h4>
                      <ul>
                         <li style="font-style:italic;">HbA1c Test</li>
                         <li style="font-style:italic;">Free sample pick-up from your house</li>
                         <li style="font-style:italic;">Free report discussion with a Doctor </li>
                         <li style="font-style:italic;">Free personalised 1 month Diet plan</li>
                         <li style="font-style:italic;">Vaild till 31st March, 2019</li>
                      </ul>
                   </div>
                   <div class="bd_price">
                      <p class="bdsave">You Save : <span class="rupeesign" style="font-weight:normal; padding:0px;">₹</span>249/- </p>
                      <h4 class="bdpay">You Pay : <span class="rupeesign" style="font-weight:normal; padding:0px;">₹</span> 99/-</h4>
                   </div>
                </div>
             </div>
             <!--Beat Diabetes Offer -->
             <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="bd_queryform">
                   <h1>Personalised Diabetes
                      Management Plan for You
                   </h1>
                   <ul>
                      <li>Fill in the <strong>details</strong> below</li>
                      <li>Use the <strong>OTP</strong> on Healthians website</li>
                      <li>Enter your <strong>Unique Promo Code</strong> on the payment page</li>
                      @include('landing_pages.callback_form')
                   </ul>
                </div>
             </div>
          </div>
       </div>
    </div>
    <!--Banner Mid-->
    <!--Keep Health Section-->
    <section class="hkserv_highlight text-center usphkserv">
       <div class="container">
          <h2>Keep your health in check with <span style="color:#007f85;">Healthians</span></h2>
          <p>India’s Largest Health test at Home Service</p>
          <ul>
             <li>
                <figure><img class="lazy" data-src="/img/campaign/hk_samplecollection.png"></figure>
                <p class="captions">Free &amp; On-time
                   Sample Collection
                </p>
             </li>
             <li>
                <figure><img class="lazy" data-src="/img/campaign/hk_fastaccurate.png"></figure>
                <p class="captions">Fast &amp; Accurate
                   Test Reports
                </p>
             </li>
             <li>
                <figure><img class="lazy" data-src="/img/campaign/hk_diet.png"></figure>
                <p class="captions">Free Doctor &amp;
                   Diet Consultation
                </p>
             </li>
             <li>
                <figure><img class="lazy" data-src="/img/campaign/hk_ereports.png"></figure>
                <p class="captions">Smart &amp;
                   Self-explanatory
                   E-reports
                </p>
             </li>
             <li>
                <figure><img class="lazy" data-src="/img/campaign/hk_tracker.png"></figure>
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
@endsection

@push('footer-scripts')
    <script src="/js/landing_page.js"></script>
    <footer></footer>
@endpush