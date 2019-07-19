@extends('layout.landing_master')

@push('header-scripts')
<link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

<link href="/css/landing/v1/owl.carousel.min.css" rel="stylesheet">
<link href="/css/landing/v1/owl.theme.min.css" rel="stylesheet">
@endpush

@section('page-content')

<style>
*{margin:0px;padding:0px;}
a { text-decoration: none !important;}
body{font-family:'Open Sans', sans-serif;}
.header{width:100%;float:left;padding:15px 0px;}
.header .mobilno-div{float:right;}
.header .mobilno-div p{font-size:2em;color:#4c4c4c;padding-top:20px;}
.header .mobilno-div p img{padding-right:27px;}
.iconbutton{width:20px;margin-right:5px;}
.img-txtdiv img{height:100px;}
.banner{width:100%;float:left;background-color:#00939c;padding:40px 0px 0px 0px;}
.banner .banner-text{width:100%;float:left;padding-top:40px;}
.banner .banner-text strong{font-size:4em;color:#fff;font-weight:700;line-height:90px;}
.banner .banner-img{width:100%;float:right;margin:0px;padding:0px;}
.banner .banner-img img{width:65%;vertical-align:middle;float:right;}
.fullbody-section{background-color:#00939c;float:left;width:100%;padding:40px 74px 50px;}
.fullbody-section h1{color:#fff;font-size:4.5em;text-align:left;font-weight:bold;margin-top:0px;margin-bottom:0px;}
.fullbody-section span{display:block;}
.fullbody-section h2{color:#fff;text-align:left;font-size:2em;padding-bottom:0px;line-height:40px;margin-bottom:7px;padding-bottom:19px}
.tests-covered{width:100%;float:left;padding:25px 0px}
.tests-covered h2{font-size:2.5em;color:#00a0a8;padding-bottom:20px;}
.tests-covered .input-group .form-control{position:relative;z-index:2;float:left;width:62%;margin-bottom:0;}
.second-callback{padding:20px 0px;}
.card-lvr{width:100%;float:left;padding:40px 0px;background-color:#ededed;margin-top:15px}
.card-lvr .serch-div{width:47%;margin:0px auto;display:block;}
.serch-div .input-group .form-control{margin-top:17px;}
.card-lvr .card-innerbox{padding-top:15px;margin-bottom:30px;}
.serving-inmore{width:100%;float:left;}
.serving-inmore ul{list-style:none;text-align:center;}
.serving-inmore ul li a{color:#fff;}
.serving-inmore ul li:first-child{border-left:none;}
.serving-inmore ul li:last-child{border-right:none;}
.serving-inmore ul li{display:inline-block;margin-bottom:10px;padding-left:5px;padding-right:5px;border-right:1px solid #ccc;}
button.btn.btn-primary.call{border-radius:20px;background:#41368f;color:#fff;}
.input-group h3{text-align:left;color:#41368f;margin-top:0;}
.Our-Offerings{width:100%;float:left;padding:40px 0px;}
.Our-Offerings img{margin:auto;display:block;margin-bottom:40px;}
.Our-Offerings h4{text-align:center;font-size:1.7em;color:#41368f;}
.Our-Offerings .ofr-blok{padding:0px 0px 0px 0px;}
.paddingleft-none{padding-left:0px;}
.paddingright-none{padding-right:0px;}
.Our-Offerings .ofr-blok .sctoeimg-div{min-height:115px;}
.Our-Offerings .ofr-blok .sctoeimg-div img{width:100px;padding-top:20px;}
.Our-Offerings .ofr-blok p{font-size:1em;text-align:center;padding-top:20px;min-height:82px;padding:15px 50px;}
.input-group{position:relative;display:block;border-collapse:separate;}
.fullbody-section .input-group{width:100%;float:right;}
.fullbody-section .input-group .form-control{position:relative;z-index:2;float:left;width:60%;margin-bottom:0;margin-right:20px;height:50px;}
.btn-primary{background:#f37d27;border:none;}
.fullbody-section button.btn.btn-primary.call{border-radius:50px;background:#f37d27;color:#fff;padding:15px 20px;margin-top:20px;border:navajowhite;font-weight:bold;width:100%;text-align:center;display:block;margin:0 auto;margin-top:0px;height:50px;}
button.btn.btn-primary.call{border-radius:50px;background:#f37d27;color:#fff;padding:15px 20px;margin-top:20px;border:navajowhite;font-weight:bold;width:50%;text-align:center;display:block;margin:0 auto;margin-top:15px;height:50px;}
.form-control{height:56px;box-shadow:0px 1px 2px 0px #ccc;}
.form-control::placeholder{text-align:center;}
.modal-content .form-control::placeholder{text-align:left;}
.customer-speak{width:100%;float:left;padding-bottom:20px;background-color:#ededed;}
.customer-speak h4{text-align:center;font-size:1.7em;color:#41368f;padding-bottom:20px;padding-top:20px;}
.testimonial .pic>img{border-radius:50%;width:20%;}
.testimonial{text-align:center;width:50%;margin:0 auto}
.testimonial .fa{color:#666;}
.testimonial .pic{margin-bottom:35px;}
.testimonial .pic>img{border-radius:50%;text-align:center;float:left;}
.star{float:left;padding-left:0px;}
.star small{color:#999;padding:0 0 0 10px;}
.testimonial .testimonial-review{color:#000;font-size:1em;line-height:27px;margin-bottom:14px;position:relative;}
.testimonial .testimonial-review p::before{content:"\f10d";font-family:"Font Awesome 5 Free";font-weight:900;color:#009fa9;font-size:1em;top:15%;left:0;position:absolute;}
.testimonial .testimonial-review p::after{content:"\f10e";font-family:"Font Awesome 5 Free";font-weight:900;color:#009fa9;font-size:1em;bottom:15%;right:10%;position:absolute;}
.testimonial-review>.testimonial-description{font-size:1em;text-align:;color:#666;line-height:24px;padding:20px 20px 0px 20px;;background-color:#ededed;border-radius:10px;margin:0 20px 16px 0;}
.testimonial .testimonial-title{color:#009fa9;font-style:normal;font-size:1em;line-height:22px;text-transform:capitalize;padding:0px;text-align:center;padding-right:5px;display:inline;}
.testimonial-title>small{color:#000;font-style:normal;font-size:1em;line-height:22px;}
.owl-theme .owl-controls .owl-page span{width:9px;height:9px;background:transparent;border:1px solid #000;margin:5px;}
.owl-theme .owl-controls .owl-page.active span,.owl-theme .owl-controls.clickable .owl-page:hover span{background:#000;}
.owl-theme .owl-controls .owl-page span{width:9px;height:9px;background:#ffffff;border:1px solid #009fa9;margin:5px;}
.owl-theme .owl-controls .owl-page.active span,.owl-theme .owl-controls.clickable .owl-page:hover span{filter:Alpha(Opacity=100);opacity:1;background-color:#009fa9;}
.serving-inmore{width:100%;float:left;}
.serving-inmore h5{color:#009fa9;font-size:1.7em;text-align:center;margin-bottom:20px;}
.footerlinks-div{padding:30px 0px;width:100%;float:left;background-color:#00a0a8;}
.footerlinks-div h4{font-size:1.2em;color:#fff;text-align:center;padding-bottom:15px;}
.footerlinks-div img{margin:0 auto;display:block;margin-top:30px;}
.footerlinks-div ul{list-style:none;padding-top:0px;text-align:center;}
.footerlinks-div ul li{display:inline-block;padding-right:10px;border-left:1px solid #fff;padding-left:10px;margin-top:10px;}
.footerlinks-div ul li:first-child{border-left:0px;}
.footerlinks-div ul li a{color:#fff;color:14px;font-size:1em;}
.footerlinks-div p{text-align:center;font-size:1em;line-height:25px;color:#fff;padding-top:20px;}
.copyright-sectiondiv p{padding:10px 0 0;width:100%;float:left;text-align:center;font-size:1em;color:#fff;}
.last-footer{width:100%;float:left;position:relative;background-color:#00a0a8;}
.last-footer p{color:#fff;font-size:1em;text-align:center;padding:10px 0 0;}
.modal-dialog{position:relative;width:30%;margin:0px;margin:0 auto;}
.modal-backdrop.in{filter:alpha(opacity=50);opacity:.8;}
.modal-header{padding:5px 10px !important;border-bottom:none;}
.copyright-sectiondiv{width:100%;float:left;background-color:#73d0d5;}
.national-div{width:100%;float:left;background-color:#2d2d2d;padding:15px 0px}
.national-div img{width:72%;padding-top:22px;}
.left-uldiv{padding:20px 20px 0 0;}
.right-uldiv{padding:20px}
.card-lvr h4{color:#3f3f3f;font-size:1.5em;padding-top:10px;font-weight:600;}
small,.small{font-size:85%;font-weight:600;}
.tests-covered .left-uldiv ul{list-style:none;}
.tests-covered .left-uldiv ul li{line-height:24px;text-transform:capitalize;font-size:2em;padding-bottom:25px;font-weight:600;}
.tests-covered .left-uldiv ul li span{font-weight:bold;}
.tests-covered .left-uldiv ul li span{float:right;color:#00939c;padding-right:40px;}
.tests-covered .right-uldiv ul{list-style:none;padding-left:70px}
.tests-covered .right-uldiv ul li{position:relative;display:block;padding-bottom:40px;padding-top:0px;}
.tests-covered .right-uldiv ul li span{padding-left:0px;text-align:justify;padding-bottom:20px;font-size:2em;font-weight:600;}
.tests-covered .right-uldiv ul li img{vertical-align:middle;width:12%;position:absolute;top:15px;right:0px;}
.border-right{border-right:1px solid #ccc;}
.tests-covered .right-uldiv ul li span::before{content:"\f067";font-family:"Font Awesome 5 Free";font-weight:900;color:#009fa9;font-size:1em;top:0px;left:-46px;position:absolute;}
.second-callback .call-up{padding-top:15px;}
.second-callback .input-group{position:relative;display:block;border-collapse:separate;}
.national-div{padding:40px 0px;}
.national-div img{width:61%;padding-bottom:25px;padding-top:25px;}
.serving-inmore{width:100%;float:left;padding:40px 0px;}
.number{color:#000;text-decoration:none;;}
.customer-speak{padding:40px 0px;}
.testimonial .testimonial-review p::before{content:"\f10d";font-family:"Font Awesome 5 Free";font-weight:900;color:#494949;font-size:1em;top:23%;left:0%;position:absolute;}
.testimonial .testimonial-review p::after{content:"\f10e";font-family:"Font Awesome 5 Free";font-weight:900;color:#494949;font-size:1em;bottom:25%;right:2%;position:absolute;}
.owl-carousel{position:relative;width:100%;-ms-touch-action:pan-y;margin-bottom:30px;}
.serving-inmore h5{padding:0;}
.fullbody-section h1{text-align:center;}
.fullbody-section h2{text-align:center;}
@media only screen and (max-width:560px){.modal-dialog{position:relative;width:95%;}
.fullbody-section .input-group .form-control{width:100%;}
.fullbody-section button.btn.btn-primary.call{margin-top:15px;}
.serving-inmore h5{padding:0 20px;}
.fullbody-section .input-group{width:100%;float:right;}
.img-txtdiv img{height:65px;}
.logo-div .img-responsive{width:65%}
.header{padding:15px 0px;border-bottom:1px solid #00939c;}
.header .mobilno-div p img{padding-right:4px;width:16%;}
.header .mobilno-div p{font-size:1em;}
.testimonial{text-align:center;width:100%;margin:0px}
.banner{padding:15px 0px 15px 15px;width:100%;float:left;border-bottom:1px solid #00939c;border-bottom:1px solid #00939c;}
.banner .banner-img img{width:96%;vertical-align:bottom;float:left;}
.banner .banner-text strong{font-size:1.7em;font-weight:700;line-height:33px;}
.banner .banner-text{width:38%;float:left;padding-top:0px;margin-left:-13px;}
.banner .banner-img{width:58%;}
.fullbody-section{padding-bottom:15px;}
.fullbody-section h1{color:#fff;font-size:1.7em;padding-top:0px;padding-bottom:15px;margin:0px;text-align:center;}
.fullbody-section h2{font-size:1em;color:#fff;text-align:center;padding:0px 0px 15px 0px;margin:0px;line-height:24px;}
.fullbody-section h2 span{display:block;}
.input-group{position:relative;display:block;border-collapse:separate;}
.btn-primary{background:#f37d27;border:none;}
button.btn.btn-primary.call{border-radius:20px;background:#f37d27;color:#fff;padding:10px 20px;margin-top:10px;border:navajowhite;font-weight:bold;width:100%;}
.tests-covered{padding:25px 0px;}
.tests-covered h2{margin-top:0px;font-size:1.6em;color:#00a0a8;}
.tests-covered .left-uldiv ul{list-style:none;}
.tests-covered .left-uldiv ul li{line-height:24px;text-transform:capitalize;font-size:0.9em;padding-bottom:10px;padding-top:0px;}
.tests-covered .left-uldiv ul li span{font-weight:bold;}
.tests-covered .left-uldiv ul li span{float:right;color:#00939c;padding-right:25px;}
.tests-covered .right-uldiv ul{list-style:none;padding-left:15px;}
.tests-covered .right-uldiv ul li{position:relative;display:block;padding-bottom:80px;padding-top:0px;padding-left:5px;}
.tests-covered .right-uldiv ul li span{padding-left:0px;text-align:justify;padding-bottom:20px;font-size:0.9em;width:100px;float:left;}
.tests-covered .right-uldiv ul li img{vertical-align:middle;width:%;position:absolute;top:-1px;right:0px;}
.border-right{border-right:1px solid #ccc;}
.footerlinks-div ul li:first-child{border:none;}
.national-div img{width:72%;padding-bottom:30px;padding-top:23px;}
.tests-covered .right-uldiv ul li span::before{content:"\f067";font-family:"Font Awesome 5 Free";font-weight:900;color:#009fa9;font-size:1em;top:0px;left:-10px;position:absolute;}
.second-callback .call-up{padding-top:15px;}
.second-callback .call-up .input-group .form-control{position:relative;z-index:2;float:left;width:52%;margin-bottom:0;}
.second-callback .input-group{position:relative;display:block;border-collapse:separate;}
button.btn.btn-primary.call{border-radius:50px;padding:15px 20px;}
.second-callback button.btn.btn-primary.call{border-radius:50px;background:#f37d27;color:#fff;padding:15px 20px;margin-top:10px;border:navajowhite;font-weight:bold;width:100%;}
.card-lvr{width:100%;float:left;padding:20px 0px 35px 0px;background-color:#ededed;margin-top:15px}
.card-lvr .card-innerbox{padding-top:15px;margin-bottom:30px;}
.copyright-sectiondiv p{margin:0px;padding:10px;}
.last-footer{padding:10px;}
.last-footer p{padding:0px;margin:0px;font-size:0.9em;}
.testimonial .testimonial-review p::before{content:"\f10d";font-family:"Font Awesome 5 Free";font-weight:900;font-size:1em;top:11%;left:0%;position:absolute;}
.testimonial .testimonial-review p::after{content:"\f10e";font-family:"Font Awesome 5 Free";font-weight:900;font-size:1em;bottom:0%;right:6%;position:absolute;}
.card-lvr h4{padding-top:0;}
.form-control{box-shadow:0px 1px 2px 0px #ccc;}
.left-uldiv{padding:0px}
.right-uldiv{padding:0px}
.tests-covered{margin-bottom:0px;}
.tests-covered .right-uldiv ul li:last-child{padding-bottom:0px;}
.national-div{padding:15px 0px;}
.customer-speak{padding:20px 0px 35px 0px;}
.card-lvr .serch-div{width:100%;padding:0px 15px;float:left;}
.serving-inmore{padding:25px 0px;}
.footerlinks-div{padding:25px 0px;}
.owl-carousel{display:none;position:relative;width:100%;-ms-touch-action:pan-y;padding-bottom:10px;}
.tests-covered .right-uldiv ul li img{width:24%}
.fullbody-section{padding:5px 0px 35px 0px;border-top:1px solid #00939c;margin-top:-1px;}
a { text-decoration: none !important;}
}

label.error {color:#e43b3f; float: left; font-size:10px;font-weight: normal;}
.field-form { line-height: 3;}
.minimal {height: 41px;display: block;width: 100%;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius:0px;-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;-o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;}
.field-button input[type=submit]{background-color: #f37d27; border-color: #f37d27; height: 45px; font-size: 16px;background-image: none;box-shadow:none !important;}
.mand_field_text {display: none;}
.close {opacity:1;}
</style>
<section class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                <div class="logo-div"><img alt="logo" class="img-responsive" src="/img/campaign/logo_landing_blue.png"></div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-6">
                <div class="mobilno-div">
                    <p>
                        <a class="number" href="tel:706 500 95 19"><img alt="phone-icon" src="/img/campaign/phone-icon.png">706 500 9519</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ===banner=====section==== -->
<section class="banner">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="banner-text">
                    <strong>I Trust
			Healthians<br>
			for Health
			Tests</strong>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="banner-img"><img alt="yuvi" src="/img/campaign/yuvi_272727.png"></div>
            </div>
        </div>
    </div>
</section>
<!-- Full-Body ====section===-->
<section class="fullbody-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12  col-sm-12 col-xs-12">
                <h1><b>Full Body Check @ Rs. 999</b></h1>
                <h2>Join 500,000+ happy users in India who<span>trust Healthians!</span></h2>
            </div>
            <div class="col-lg-offset-3 col-lg-6  col-sm-12 col-xs-12">
                <a href="#" data-toggle="modal" data-target="#basicModal">
                    <div class="input-group">
                        <input class="form-control" id="txtSearch" placeholder="Enter 10 digit mobile number" type="text">
                        <div class="input-group-btn">
                            <button class="btn btn-primary call" type="button"> <img class="iconbutton" src="/img/campaign/phone-icon-2.png"> Get Free Call Back</button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!--=============Tests Covered =======-->
<section class="tests-covered">
    <div class="container">
        <h2 class="text-center">Tests Covered in the Package</h2>
        <div class="row">
            <div class="col-sm-6 col-xs-6 border-right">
                <div class="left-uldiv">
                    <ul>
                        <li>Lipid Profile<span>09</span></li>
                        <li>Liver<span>12</span></li>
                        <li>Hemogram<span>24</span></li>
                        <li>Thyroid<span>03</span></li>
                        <li>Kidney<span>11</span></li>
                        <li>Urine<span>14</span></li>
                        <li>Sugar Fasting<span>04</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-xs-6">
                <div class="right-uldiv">
                    <ul>
                        <li><span>Free Doctor<br>
							Consultation</span><img src="/img/campaign/girl.png"></li>
                        <li><span>Free Diet<br>
							Planning</span><img src="/img/campaign/apple.png"></li>
                        <li><span>Free Home<br>
							Sample Collection</span><img src="/img/campaign/sctr.png"></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- second call back -->
<section class="second-callback">
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-3 col-lg-6  col-md-12 col-sm-12 col-xs-12">
                <a href="#" data-toggle="modal" data-target="#basicModal">
                    <div class="input-group">
                        <input class="form-control" id="txtSearch" placeholder="Enter 10 digit mobile number" type="text">
                        <div class="input-group-btn">
                            <button class="btn btn-primary call"><img class="iconbutton" src="/img/campaign/phone-icon-2.png"> Get Free Call Back</button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<section class="card-lvr">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-3 col-xs-12 pading text-center">
                <div class="card-innerbox">
                    <div class="img-txtdiv">
                        <img alt="card-liver" src="/img/campaign/certified.png">
                        <h4>Government Certified Labs</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12 pading text-center">
                <div class="card-innerbox">
                    <div class="img-txtdiv">
                        <img alt="card-liver" src="/img/campaign/same-day.png">
                        <h4>Same Day Accurate Reports</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12 pading text-center">
                <div class="card-innerbox">
                    <div class="img-txtdiv">
                        <img alt="card-liver" src="/img/campaign/money-back.png">
                        <h4>Money Back Guarantee</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12 text-center">
                <div class="card-innerbox">
                    <div class="img-txtdiv">
                        <img alt="card-liver" src="/img/campaign/threesuper-man.png">
                        <h4>In-House Certified Phlebotomists</h4>
                    </div>
                </div>
            </div>
            <div class="serch-div">
                <a href="#" data-toggle="modal" data-target="#basicModal">
                    <div class="input-group">
                        <input class="form-control" id="txtSearch" placeholder="Enter 10 digit mobile number" type="text">
                        <div class="input-group-btn">
                            <button class="btn btn-primary call"><img class="iconbutton" src="/img/campaign/phone-icon-2.png"> Get Free Call Back</button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- Our Offerings==section-start- -->
<section class="national-div">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-6 text-center"><img alt="" src="/img/campaign/one_land.png"></div>
            <div class="col-sm-4 col-xs-6 text-center"><img alt="" src="/img/campaign/two_land.png"></div>
            <div class="col-sm-4 col-xs-6 text-center"><img alt="" src="/img/campaign/three_land.png"></div>
            <div class="col-sm-4 col-xs-6 text-center"><img alt="" src="/img/campaign/four_land.png"></div>
            <div class="col-sm-4 col-xs-6 text-center"><img alt="" src="/img/campaign/five_land.png"></div>
            <div class="col-sm-4 col-xs-6 text-center"><img alt="" src="/img/campaign/six_land.png"></div>
        </div>
    </div>
</section>
<!-- Why Healthians==section===== -->
<section class="customer-speak">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="owl-carousel" id="testimonial-slider">
                    <div class="testimonial">
                        <div class="testimonial-review">
                            <p class="testimonial-description">Delighted by the services experienced. Collected the sample and received the reports on the same day. Hope we receive the same kind of service in future as well.</p>
                        </div>
                        <h4 class="testimonial-title">Amarnath,</h4><small>27 Jan 2019</small>
                    </div>
                    <div class="testimonial">
                        <div class="testimonial-review">
                            <p class="testimonial-description">Just got the first tests done recently and what impressed me the most was the reports. The presentation was very precise and easy to understand. The Smart Report (apart from the detailed report) is by impressive.</p>
                        </div>
                        <h4 class="testimonial-title">Parul Mehra,</h4><small>16 Dec 2018</small>
                    </div>
                    <div class="testimonial">
                        <div class="testimonial-review">
                            <p class="testimonial-description">Healthians is a good app for all pathology tests. Prices too are very reasonable. Sample procedure is good and timely. They always use a sealed sample collection kit. Overall satisfied.</p>
                        </div>
                        <h4 class="testimonial-title">Lakhwinder Aggarwal,</h4><small>23 Dec 2018</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-offset-3 col-lg-6  col-xs-12">
                <a href="#" data-toggle="modal" data-target="#basicModal">
                    <div class="input-group">
                        <input class="form-control" id="txtSearch" placeholder="Enter 10 digit mobile number" type="text">
                        <div class="input-group-btn">
                            <button class="btn btn-primary call"><img class="iconbutton" src="/img/campaign/phone-icon-2.png"> Get Free Call Back</button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- =======Serving in more than 30 cities pan-India======== -->
<!-- =======Serving in more than 30 cities pan-India======== -->
<section class="serving-inmore">
    <div class="container">
        <h5>Serving in more than 30 cities pan-India</h5>
        <div class="row">
            <div class="col-xs-12">
                <ul>
                    @foreach($city_detail as $key => $ct)
                        <li>{{$ct}}</li>
                    @endforeach                    
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- footer-links====== -->
<section class="footerlinks-div">
    <div class="container">
        <div class="row">
            <div class=" col-lg-offset-3 col-lg-6 col-sm-6">
                <ul>
                    <li>
                        <a href="https://www.healthians.com/about-us">About Us</a>
                    </li>
                    <li>
                        <a href="https://blog.healthians.com/">Blog</a>
                    </li>
                    <li>
                        <a href="https://www.healthians.com/healthians-media">Media</a>
                    </li>
                    <li>
                        <a href="https://www.healthians.com/contact-us">Contact Us</a>
                    </li>
                    <li>
                        <a href="https://www.healthians.com/career">Career</a>
                    </li>
                    <li>
                        <a href="https://www.healthians.com/refund-policy">Money Back Policy</a>
                    </li>
                    <li>
                        <a href="https://www.healthians.com/healthians-investors">Investors</a>
                    </li>
                    <li>
                        <a href="https://www.healthians.com/labs">Our Labs</a>
                    </li>
                    <li>
                        <a href="https://www.healthians.com/feedback">Feedback</a>
                    </li>
                    <li>
                        <a href="https://www.healthians.com/deals">Health Deals</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-12 col-sm-12">
                <p>Healthians is India’s largest Health Test at Home service provider that brings health to your door. Our Health Test Packages offers like Full Body Checkup, Blood test, Cholesterol test, Lipid profile test, Liver Function Test, Kidney Function Test, Blood Sugar test, Thyroid test, Haemoglobin test, HIV test, Cancer test etc. Each Health Checkup Package includes FREE Home Sample Collection followed by FREE Doctor consultation for better understanding of your reports. Customized Diet plans & lifestyle changes are also advised to keep your health in track.</p>
            </div>
        </div>
    </div>
</section>
<section class="copyright-sectiondiv">
    <p>2019 &copy; Healthians.com | Legal</p>
</section>
<section class="last-footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>A Wing, Floor I, A-26, Omega Center, Sector 34, Info City, Gurgaon 122 001, Haryana</p>
            </div>
        </div>
    </div>
</section>



<div class="modal fade leadmodalcallback" data-target="basicModal"  id="basicModal" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="top:10%">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                @include('landing_pages.callback_form')
                <input type="hidden" name="ga_category" id="ga_category" value="{{$ga_category}}">
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer-scripts')
    <script type="text/javascript" src="/js/bootstrap.min.js"></script> 
    <script type="text/javascript" src="/js/landing/v1/owl.carousel.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            $("#testimonial-slider").owlCarousel({
                items:2,
                itemsDesktop:[1000,1],
                itemsDesktopSmall:[979,1],
                itemsTablet:[768,1],
                pagination: true,
                autoPlay:true
            });

            $("#addLeadForm").submit(function () { 
                if($("#addLeadForm").valid()) {
                    ajaxCallPromise(saves_api_url, "POST", $('#addLeadForm').serialize()).then(saveLeadSuccessHandler, saveLeadErrorHandler);
                }
                return false;            
            });

            $('#basicModal').on('show.bs.modal', function (event) {
                $("#txtSearch").blur();
                $('#addLeadForm')[0].reset();
                var validator = $("#addLeadForm").validate();
                validator.resetForm();
                
                setTimeout(function(){
                    $('#name').focus();
                    $(this).find('input:first').focus();
                    $(this).find('[autofocus]').focus();
                }, 100);
            });

            $('#basicModal').on('hide.bs.modal', function (e) {
                $('#basicModal').removeClass('fade');
            });
        });
    </script>
    <script src="/js/landing_page.js"></script>
    <footer></footer>
@endpush