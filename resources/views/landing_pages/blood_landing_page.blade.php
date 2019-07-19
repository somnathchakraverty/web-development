@extends('layout.landing_master')

@push('header-scripts')
<link href="/css/t2/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<link href="/css/landing/v2/owl.carousel.min.css" rel="stylesheet">
<link href="/css/landing/v2/owl.theme.min.css" rel="stylesheet">
@endpush

@section('page-content')
<style>
.news-packagesdiv .owl-carousel .owl-stage-outer{width:97%!important}.banner_mobile{display:none}.banner,.banner-section,.home-based,.serch-div{width:100%;float:left}.btn,.form-control{border-radius:0}*{margin:0;padding:0}body{font-family:Poppins,sans-serif}.btn-primary{color:#fff}.leadmodalcallback{margin:auto}.leadmodalcallback .modal-dialog{max-width:560px;margin:auto}.btn-primary.active,.btn-primary.focus,.btn-primary:active,.btn-primary:focus,.btn-primary:hover,.open>.dropdown-toggle.btn-primary{color:#fff;background-color:#009fa9;border-color:#009fa9}.pading{padding-bottom:30px}.banner-section{padding:0 0 20px}.banner img{width:100%}.home-based h1{color:#f37d27;font-size:30px;font-weight:500;padding-bottom:0}.home-based h2{color:#00a0a8;font-size:40px;font-weight:500;padding-bottom:28px}.home-based h3{color:#3f3f3f;font-size:46px;font-weight:500}.home-based p{font-size:36px;color:#848484}.serch-div{background-color:#f6f6f6;padding:10px;margin-bottom:10px}.btn-primary{background-color:#f37d27;border-color:#f37d27;height:45px}.brdr-btm{border-bottom:1px solid #ccc}.input-group .form-control,.input-group-addon,.input-group-btn{display:table-cell;height:45px}.serch-section p{font-size:15px;color:#3f3f3f;text-align:right;width:70%;float:right}.why-preventive{width:100%;float:left}.why-preventive h3{font-size:26px;color:#009fa9;text-align:center;margin-bottom:30px;margin-top:50px}.why-preventive img{margin:15px auto 20px;display:block}.why-preventive p{color:#3f3f3f;font-size:16px;text-align:center;line-height:24px;padding-bottom:20px}.card-lvr{width:100%;float:left}.form-control{height:40px}.serch-section{padding:20px 10px}.card-lvr .card-innerbox{background-color:#f8f8f8;width:100%;float:left;padding:30px;border-radius:4px;box-shadow:0 2px 4px 4px #f2f2f2}.card-innerbox .img-txtdiv{width:100%;float:left;padding-bottom:15px;min-height:75px}.card-innerbox .img-txtdiv img{float:left;margin-right:20px;height:50px;width:50px}.card-innerbox .img-txtdiv h4{padding-left:0;color:#009fa9;font-size:22px;font-weight:500;margin-top:4px}.card-innerbox .img-txtdiv h4 span{padding-left:4px;color:#f37d27;padding-bottom:5px}.card-innerbox ul{padding-left:20px;margin-bottom:20px}.card-innerbox ul li{font-size:16px;color:#3f3f3f;line-height:30px}.card-innerbox p{font-size:16px;color:#3f3f3f;line-height:24px;min-height:80px;float:left}.news-packagesdiv{width:100%;float:left;padding:60px 0}.news-packagesdiv .demo{background:linear-gradient(to right,#fcc,#d3d3d3)}.news-packagesdiv .post-slide{margin:0 17px;padding-right:0}.news-packagesdiv .post-slide .post-img{overflow:hidden}.news-packagesdiv .post-slide .post-img img{width:100%;height:auto;transform:scale(1);transition:all 1s ease-in-out 0}.news-packagesdiv .post-slide:hover .post-img img{transform:scale(1.08)}.news-packagesdiv .post-slide .post-content{background:#f9f9f9;padding:20px 24px 20px;border-radius:9px;box-shadow:0 2px 4px 4px #f2f2f2}.news-packagesdiv .post-slide .post-title{font-size:17px;font-weight:600;margin-top:0;min-height:48px;text-transform:capitalize}.news-packagesdiv .post-slide h4{font-size:17px;color:#f27d27}.news-packagesdiv .post-slide .post-title a{display:inline-block;color:#373737;transition:all .3s ease 0;font-size:21px}.news-packagesdiv .post-slide h5{color:#52b3bb;font-size:26px;font-weight:600;padding-top:14px}.owl-theme .owl-controls .owl-buttons div{color:#f27d27;display:inline-block;font-size:42px;background-color:transparent}.owl-controls .owl-prev{position:absolute;left:-40px;top:38%}.owl-controls .owl-next{position:absolute;right:-40px;top:38%}.news-packagesdiv .post-slide h5 del{padding-right:3px;font-size:19px;font-weight:600}.news-packagesdiv .post-slide .post-title a:hover{color:#3d3030;text-decoration:none}.news-packagesdiv .post-slide .post-description{font-size:15px;color:#676767;line-height:24px;margin-bottom:14px}.news-packagesdiv .post-slide .post-bar{padding-left:12px;margin-bottom:5px;min-height:85px}.news-packagesdiv .post-slide .post-bar li{color:#676767;padding:2px 0}.news-packagesdiv .post-slide .post-bar li i{margin-right:5px}.news-packagesdiv .post-slide .post-bar li a{display:block;font-size:14px;color:#373737;transition:all .3s ease 0}.news-packagesdiv .post-slide .post-bar li a:after{content:","}.news-packagesdiv .post-slide .post-bar li a:last-child:after{content:""}.news-packagesdiv .post-slide .post-bar li a:hover{color:#3d3030;text-decoration:none}.news-packagesdiv .post-slide .btn-primary{display:inline-block;padding:0 32px;font-size:14px;color:#fff;background:#f27d27;border-radius:25px;text-transform:capitalize;border:none;height:40px;line-height:40px;margin-top:18px}.news-packagesdiv .post-slide .read-more:hover{background:#333;text-decoration:none}.preventive-blooddiv{width:100%;float:left;padding:30px 0}.preventive-blooddiv h4{color:#009fa9;font-size:26px;line-height:50px}.preventive-blooddiv p{color:#3f3f3f;font-size:16px;text-align:center}.Our-Offerings{width:100%;float:left;background-color:#f8f8f8;padding:40px 0}.Our-Offerings img{margin:auto auto 30px;display:block}.Our-Offerings h4{text-align:center;font-size:26px;color:#009fa9}.Our-Offerings .ofr-blok{padding:0}.paddingleft-none{padding-left:0}.paddingright-none{padding-right:0}.Our-Offerings .ofr-blok .sctoeimg-div{min-height:70px}.Our-Offerings .ofr-blok .sctoeimg-div img{width:100px;padding-top:20px}.Our-Offerings .ofr-blok p{font-size:16px;text-align:center;min-height:82px;padding:0 40px}.why-healthiansdsec{width:100%;float:left;padding:40px 0}.why-healthiansdsec h4{font-size:26px;color:#009fa9;text-align:center;margin-bottom:15px}.why-healthiansdsec .under{display:block;margin:20px auto}.why-healthiansdsec .img-thumbdiv h5{font-size:15px;color:#fff;text-align:center;padding:15px;margin-top:0}.why-healthiansdsec .img-thumbdiv img{width:100%}.why-healthiansdsec .thumb-txtdiv{width:100%;background-color:#009fa9;border-bottom-left-radius:4px;border-bottom-right-radius:4px}.match-heightdiv{min-height:202px;padding-bottom:15px}.customer-speak{width:100%;float:left}.customer-speak h4{text-align:center;font-size:26px;color:#009fa9;padding-bottom:20px}.customer-speak img{margin:0 auto 30px;display:block}.testimonial .pic>img{width:20%;border-radius:50%;text-align:center;float:left}.testimonial{text-align:center}.testimonial .fa{color:#666}.testimonial .pic{margin-bottom:35px}.star{float:left;padding-left:0}.star small{color:#999;padding:0 0 0 10px}.testimonial .testimonial-review{color:#000;font-size:16px;line-height:27px;margin-bottom:14px}.testimonial-review>.testimonial-description{font-size:14px;float:left;text-align:left;color:#666;line-height:24px}.testimonial .testimonial-title{color:#000;font-style:normal;font-size:15px;line-height:22px;text-transform:capitalize;padding:0;text-align:left}.testimonial-title>small{color:#000;font-style:normal;font-size:14px;line-height:22px}.owl-theme .owl-controls .owl-page span{width:9px;height:9px;background:#009fa9;border:1px solid #009fa9;margin:5px}.border-bottom,.modal-header{border-bottom:none}.owl-theme .owl-controls .owl-page.active span,.owl-theme .owl-controls.clickable .owl-page:hover span{filter:Alpha(Opacity=100);opacity:1;background-color:#009fa9}.serving-inmore{width:100%;float:left;background-color:#f8f8f8;padding:30px 0}.serving-inmore h5{font-size:26px;color:#009fa9;text-align:center;padding-bottom:15px}.serving-inmore img{display:block;margin:0 auto}.serving-inmore ul{list-style:none;padding-top:20px;text-align:center}.serving-inmore ul li{display:inline-block;border-left:1px solid #888;text-transform:capitalize;margin-bottom:10px;padding-left:5px}.serving-inmore ul li:first-child{border-left:none}.serving-inmore li a{color:#666;font-size:16px;padding-right:5px;display:inline-block}.footerlinks-div{padding:30px 0;width:100%;float:left}.footerlinks-div h4{font-size:20px;color:#009fa9;text-align:center;padding-bottom:15px}.footerlinks-div img{margin:30px auto 0;display:block}.footerlinks-div ul{list-style:none;padding-top:0;text-align:center}.footerlinks-div ul li{display:inline-block;padding-right:10px;border-left:1px solid #888;padding-left:10px;margin-top:10px}ul li:first-child{border-left:none}.footerlinks-div ul li a{color:#717171;font-size:14px;font-size:16px}.copyright-sectiondiv p,.footerlinks-div p,.last-footer p{font-size:14px;text-align:center}.footerlinks-div p{line-height:25px;color:#414143;padding-top:20px}.copyright-sectiondiv p{padding:10px;background-color:#009fa8;width:100%;float:left;color:#fff}.border-right{border-right:none}.last-footer{width:100%;float:left;position:relative}.last-footer p{color:#414143}.modal-dialog{position:relative;width:auto;margin:0}.modal-backdrop.in{filter:alpha(opacity=50);opacity:.8}.fixedform-div{background-color:#009fa9;position:fixed;z-index:99999;left:0;right:0;bottom:0;padding:30px}.fixedform-div a{text-decoration:none}.modal-header{padding:5px 10px!important}.owl-nav{position:absolute;top:40%;width:100%}.owl-carousel .owl-nav button.owl-prev{font-size:70px;left:0}.owl-carousel .owl-nav button.owl-prev span{position:absolute;left:0;color:#f27d27}.owl-carousel .owl-nav button.owl-next{font-size:70px;right:0}.owl-carousel .owl-nav button.owl-next span{position:absolute;right:0;color:#f27d27}.owl-dots{width:100%;z-index:99999999999;color:#000;margin:0 auto 20px;left:50%;text-align:center}.owl-carousel button.owl-dot{background:#05c7d4;color:inherit;border:none;padding:0!important;font:inherit;width:10px;height:10px;border-radius:50%;margin-right:10px}.owl-dot.active{background-color:#009fa9!important}@media only screen and (max-width:480px){.last-footer{width:100%;float:left;position:relative}.preventive-blooddiv h4{color:#009fa9;font-size:26px;line-height:36px}.news-packagesdiv .post-slide .post-title a{font-size:19px}.home-based h1{color:#f37d27;font-size:24px;font-weight:500;padding-bottom:0}.banner-section{padding:30px 0}.home-based h2{color:#00a0a8;font-size:30px;font-weight:500;padding-top:20px;padding-bottom:0}.home-based h3{color:#3f3f3f;font-size:18px;margin-bottom:0}.home-based p{font-size:14px;line-height:26px}.serch-section p{font-size:16px;color:#3f3f3f;font-weight:500}.why-preventive h3{font-size:20px;margin-top:0;margin-bottom:12px}.card-lvr .card-innerbox{box-shadow:0 2px 4px 2px #f2f2f2;height:auto}.Our-Offerings h4{font-size:20px;padding-bottom:10px}.why-healthiansdsec h4{font-size:20px}.footerlinks-div ul li a{color:#717171;color:14px;font-size:14px}.customer-speak h4{text-align:center;font-size:20px}.serving-inmore h5{font-size:16px}.Our-Offerings img{margin:0 auto;display:block}.fixedform-div{display:block;padding:15px}.brdr-btm{border-bottom:none}.owl-controls .owl-prev{position:absolute;left:-20px}.owl-controls .owl-next{position:absolute;right:-20px}}@media only screen and (max-width:414px){.card-innerbox ul li{font-size:13px;line-height:16px;padding-bottom:5px}.form-control{font-size:13px}.card-innerbox p{line-height:17px}.owl-stage{padding-left:0!important}.card-innerbox .img-txtdiv{width:100%;float:left;padding-bottom:15px;min-height:50px}.card-innerbox ul{padding-left:10px;float:left;min-height:80px;margin-bottom:10px}.last-footer p{color:#999;font-size:12px;text-align:center}.last-footer{width:100%;float:left;position:relative}.why-healthiansdsec{width:100%;float:left;padding:40px 0 20px}.card-innerbox .img-txtdiv h4{padding-left:0;color:#009fa9;text-align:center;font-size:14px;font-weight:500;margin-top:0;margin-bottom:0}.card-innerbox ul li{font-size:13px;line-height:19px}.card-innerbox p{font-size:13px;color:#3f3f3f;line-height:22px;min-height:90px;float:left}.home-based h1{color:#f37d27;font-size:20px;text-align:center}.home-based h2{color:#00a0a8;font-size:24px;text-align:center;margin-top:0}.why-healthiansdsec .img-thumbdiv h5{font-size:16px;line-height:20px}.border-right{border-right:1px solid #7ccbd0}.border-bottom{border-bottom:1px solid #7ccbd0;margin-top:30px}.serch-section p{font-size:12px;color:#3f3f3f;text-align:center;width:auto;float:none}.card-innerbox .img-txtdiv img{float:none;height:36px;width:32px;width:auto;margin:auto;margin-bottom:10px}.footerlinks-div img,.why-preventive img{margin-bottom:20px}.testimonial .testimonial-title{padding-left:0}.Our-Offerings .ofr-blok p{font-size:14px;text-align:center;min-height:82px;padding:10px}.why-preventive p{color:#3f3f3f;font-size:14px;text-align:center;line-height:24px;padding-bottom:20px}.serving-inmore li a{color:#666;font-size:12px;padding-right:5px;display:inline-block}.Our-Offerings{width:100%;float:left;background-color:#f8f8f8;padding:40px 0 10px}.why-healthiansdsec .under{display:block;margin:0 auto 30px}.owl-controls .owl-prev{position:absolute;left:-20px}.owl-controls .owl-next{position:absolute;right:-20px}.preventive-blooddiv h4{color:#009fa9;font-size:20px;line-height:30px}.preventive-blooddiv p{color:#3f3f3f;font-size:14px;text-align:center;line-height:26px;margin-top:30px}.news-packagesdiv{width:100%;float:left;padding:0}}@media only screen and (max-width:360px){.owl-controls .owl-prev{position:absolute;left:-20px}.owl-controls .owl-next{position:absolute;right:-20px}.card-innerbox .img-txtdiv{width:100%;float:left;padding-bottom:15px;min-height:50px}.card-innerbox ul{padding-left:10px;float:left;min-height:80px;margin-bottom:10px}.last-footer p{color:#999;font-size:12px;text-align:center; padding-bottom:130px;}.preventive-blooddiv h4{color:#009fa9;font-size:20px;line-height:28px}.last-footer{width:100%;float:left;position:relative}.why-healthiansdsec{width:100%;float:left;padding:40px 0 20px}.card-innerbox .img-txtdiv h4{padding-left:0;color:#009fa9;font-size:14px;min-height:34px;font-weight:500;margin-top:0}.card-innerbox ul li{font-size:10px;line-height:18px}.card-innerbox p{font-size:10px;color:#3f3f3f;line-height:18px;min-height:50px;float:left}.home-based h1{color:#f37d27;font-size:20px}.home-based h2{color:#00a0a8;font-size:24px}.why-healthiansdsec .img-thumbdiv h5{font-size:14px}.border-right{border-right:1px solid #7ccbd0}.border-bottom{border-bottom:1px solid #7ccbd0}.serch-section p{font-size:12px;color:#3f3f3f;text-align:center;width:auto;float:none}.card-innerbox .img-txtdiv img{float:left;margin-right:12px;height:30px;margin-bottom:10px;width:auto}.testimonial .testimonial-title{padding-left:0}.Our-Offerings .ofr-blok p{font-size:12px;text-align:center;min-height:82px;padding:10px}.why-preventive p{color:#3f3f3f;font-size:14px;text-align:center;line-height:24px;padding-bottom:20px}.serving-inmore li a{color:#666;font-size:12px;padding-right:5px;display:inline-block}.Our-Offerings{width:100%;float:left;background-color:#f8f8f8;padding:40px 0 10px}.why-healthiansdsec .under{display:block;margin:0 auto 30px}.news-packagesdiv{width:100%;float:left;padding:0}.preventive-blooddiv p{color:#3f3f3f;font-size:14px;text-align:center;line-height:24px;margin-top:15px}.owl-carousel .owl-stage{position:relative;-ms-touch-action:pan-Y;touch-action:manipulation;-moz-backface-visibility:hidden;padding-left:0!important}.news-packagesdiv .post-slide .post-content{background:#f9f9f9;padding:20px}.owl-nav{position:absolute;top:30%;width:100%}}


label.error {color:#e43b3f; float: left; font-size:10px;font-weight: normal;}
.field-form { line-height: 3;}
.minimal {height: 41px;display: block;width: 100%;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius:0px;-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;-o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;}
.field-button input[type=submit]{background-color: #f37d27; border-color: #f37d27; height: 45px; font-size: 16px;background-image: none;box-shadow:none !important;}
.mand_field_text {display: none;}
.close {opacity:1;}
.fixedmobdata{ display:none; }
@media only screen and (max-width: 480px) {
    .banner-section {padding:0;}
    .card-lvr .card-innerbox{ padding:15px; height:324px; }
    .banner_mobile{ display:block; }
    .serch-div{ display:none; }
    .banner_mobile img{max-width:100%;}
    .heladvisor{ display:none; }
    .news-packagesdiv .post-slide{ padding-right:0px; }
    .banner-section .banner{ display:none;}
    .serch-section .text-center{ font-size:14px; padding:12px 20px; line-height:20px; }
    .home-based h2{ padding-top:5px; }
    .serch-section{ padding:0px 0px 15px 0px; }
    .news-packagesdiv .post-slide .post-content{ min-height:370px; }
    .news-packagesdiv .post-slide{ margin:0 12px; padding-bottom:15px; }
    .news-packagesdiv .post-slide h4{ font-size:15px; }
    .fixedmobdata{position: fixed;  background-color: #fff5ed; padding: 10px;
    margin-bottom:0px;bottom:0px;  display: block; -webkit-box-shadow: 0px -4px 5px -5px rgba(0,0,0,0.5);
-moz-box-shadow: 0px -4px 5px -5px rgba(0,0,0,0.5);box-shadow: 0px -4px 5px -5px rgba(0,0,0,0.5); bottom: 0px; width: 100%; z-index: 999; border-radius:0px; min-height: 50px;bottom:0px;}
    .fixedmobdata .input-group{ display:block; }
    .fixedmobdata .input-group .form-control{width:100%; margin-bottom:10px; text-align:center;}
    .fixedmobdata button{background-color: #f37d27;  border-color: #f37d27; height: 45px; font-size: 16px;
    background-image: none; width:100%; box-shadow: none !important;}
}
.basicModal {z-index: 9999 !important;}
.owl-nav{top: 32%;}
</style>


<div class="fixedmobdata">
    <a href="#" data-toggle="modal" data-target="#basicModal" data-whatever="@number">
    <div class="input-group">
                            <input class="form-control" id="txtSearch" placeholder="Enter your 10 digit mobile no" type="text">
                            <div class="input-group-btn">
                                <button class="btn btn-primary" type="button">Get a free call</button>
                            </div>
                        </div>
                    </a>
     
 </div>

<!-- baneer-section------- -->
<section class="banner-section">
        <div class="banner"><img alt="banner-blogimg" src="/img/campaign/new_landing_banner.jpg"></div>
        <div class="banner_mobile"><img alt="banner-blogimg" src="/img/campaign/bloodtest_mobile.jpg"></div>
     </section>
     <section class="home-based">
        <div class="container brdr-btm">
           <div class="row">
              <div class="col-lg-6 col-sm-12 col-xs-12">
                 <h1>Home Based Sample Collection</h1>
                 <h2>Full Body Blood Test @ ₹999</h2>
              </div>
              <div class="col-lg-6 col-sm-12 col-xs-12  serch-section">
                 <div class="serch-div">
                    <a href="#" data-toggle="modal" data-target="#basicModal">
                       <div class="input-group">
                          <input class="form-control" id="txtSearch" placeholder="Enter your 10 digit mobile number" type="text">
                          <div class="input-group-btn">
                             <button class="btn btn-primary" type="button">Get a free call</button>
                          </div>
                       </div>
                    </a>
                 </div>
                 <p class="text-center">60-70% of the diseases are preventable with timely Health checkups - World Health Organisation (WHO) 
                    
                </p>
              </div>
           </div>
        </div>
     </section>
     <section class="news-packagesdiv">
        <div class="container">
           <div class="row">
              <div class="col-md-12">
                 <div id="news-slider" class="owl-carousel">
                    <div class="post-slide">
                       <div class="post-content">
                          <h3 class="post-title">Basic Arthritis Package</h3>
                          <h4>Includes: 61</h4>
                          <ul class="post-bar">
                             <li><a href="javascript:void(0);">Lipid Profile</a></li>
                             <li><a href="javascript:void(0);">RA test Rheumatoid Arthritis factor</a></li>
                             <li><a href="javascript:void(0);">Thyroid Profile</a></li>
                             </li>
                          </ul>
                          <a href="#" onclick="bookNow('Basic Arthritis Package');" data-toggle="modal" data-target="#basicModal" class="btn btn-primary">Book Now</a>
                          <h5>  <del>₹4005</del> ₹999</h5>
                       </div>
                    </div>
                    <div class="post-slide">
                       <div class="post-content">
                          <h3 class="post-title">Basic Heart Care</h3>
                          <h4>Includes: 57</h4>
                          <ul class="post-bar">
                             <li><a href="javascript:void(0);">Lipid Profile</a></li>
                             <li><a href="javascript:void(0);">Liver Function Test</a></li>
                             <li><a href="javascript:void(0);">Kidney Function Test</a></li>
                             
                          </ul>
                          <a href="#" onclick="bookNow('Basic Heart Care');" data-toggle="modal" data-target="#basicModal" class="btn btn-primary">Book Now</a>
                          <h5>  <del>₹2880</del> ₹899</h5>
                       </div>
                    </div>
                    <div class="post-slide">
                       <div class="post-content">
                            <h3 class="post-title">                                
                                Healthians Full Body Checkup with Thyroid & CBC                                 
                            </h3>
                            <h4>Includes: 74</h4>
                            <ul class="post-bar">
                                <li><a href="javascript:void(0);">Thyroid Profile-Total (T3, T4 & TSH Ultra-sensitive)</a></li>
                                <li><a href="javascript:void(0);">Urine Routine & Microscopy</a></li>
                                <li><a href="javascript:void(0);">Blood Glucose Fasting</a></li>
                                
                          </ul>
                          <a href="#" onclick="bookNow('Healthians Full Body Checkup with Thyroid & CBC');" data-toggle="modal" data-target="#basicModal" class="btn btn-primary">Book Now</a>
                          <h5>  <del>₹2700</del> ₹1199</h5>
                       </div>
                    </div>
                    <div class="post-slide">
                       <div class="post-content">
                            <h3 class="post-title">
                                Healthians Diabetic <br>Extended checkups
                            </h3>
                            <h4>Includes: 76</h4>
                            <ul class="post-bar">
                                <li><a href="javascript:void(0);">HbA1c</a></li>
                                <li><a href="javascript:void(0);">Blood Glucose Fasting</a></li>
                                <li> <a href="javascript:void(0);">Complete Hemogram</a></li>                                
                            </ul>
                            <a href="#" data-toggle="modal" data-target="#basicModal" class="btn btn-primary" onclick="bookNow('Healthians Diabetic Extended checkups');">Book Now</a>
                            <h5> <del>₹4330</del> ₹1499</h5>
                       </div>
                    </div>

                    <div class="post-slide">
                        <div class="post-content">
                            <h3 class="post-title">                                
                                Healthians Full Body Checkup with Vitamin D & CBC                               
                            </h3>
                            <h4>Includes: 72</h4>
                            <ul class="post-bar">
                                <li><a href="javascript:void(0);">Kidney Function Test</a></li>
                                <li><a href="javascript:void(0);">Urine Routine & Microscopy</a></li>
                                <li><a href="javascript:void(0);">Vitamin D Total-25 Hydroxy</a></li>                                
                            </ul>
                            <a href="#" data-toggle="modal" data-target="#basicModal" class="btn btn-primary" onclick="bookNow('Healthians Full Body Checkup with Vitamin D & CBC');">Book Now</a>
                            <h5> <del>₹3700</del> ₹1499</h5>
                        </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </section>
     <section class="preventive-blooddiv">
        <div class="container">
           <div class="row">
              <div class="col-sm-12 text-center">
                 <h4>Why Preventive Blood Tests are Needed?</h4>
                 <img src="/img/campaign/undr-line-img.png" alt="undr-line-img">
                 <p>At home blood tests will help you know the functioning of your major body organs. These tests will help you identify and rule out issues like obesity, menstrual problems &amp; infections.</p>
              </div>
           </div>
        </div>
     </section>
     <section class="card-lvr">
        <div class="container">
           <div class="row">
              <div class="col-lg-4 col-sm-6 col-xs-6 pading">
                 <div class="card-innerbox">
                    <div class="img-txtdiv">
                       <img alt="card-liver" class="img-responsive" src="/img/campaign/card-liver.png">
                       <h4>Liver<span>(12)</span></h4>
                    </div>
                    <ul>
                       <li>Proteins, Serum</li>
                       <li>SGOT/AST</li>
                       <li>SGPT/ALT</li>
                    </ul>
                    <p>Liver test ensures healthy metabolic and excretory process.</p>
                 </div>
              </div>
              <div class="col-lg-4 col-sm-6 col-xs-6 pading">
                 <div class="card-innerbox">
                    <div class="img-txtdiv">
                       <img alt="card-liver" class="img-responsive" src="/img/campaign/kidney.png">
                       <h4>Kidney<span>(11)</span></h4>
                    </div>
                    <ul>
                       <li>Urea, Serum</li>
                       <li>Calcium Total, Serum</li>
                       <li>Creatinine, Serum</li>
                    </ul>
                    <p>Healthy kidneys keep blood clean by filtering out wastes.</p>
                 </div>
              </div>
              <div class="col-lg-4 col-sm-6 col-xs-6 pading">
                 <div class="card-innerbox">
                    <div class="img-txtdiv">
                       <img alt="card-liver" class="img-responsive" src="/img/campaign/urine.png">
                       <h4>Urine R/M<span>(14)</span></h4>
                    </div>
                    <ul>
                       <li>pH Urine</li>
                       <li> Sugar</li>
                       <li>Albumin</li>
                    </ul>
                    <p>Urine test can help in diagnosis of a wide range of diseases.</p>
                 </div>
              </div>
              <div class="col-lg-4 col-sm-6 col-xs-6 pading">
                 <div class="card-innerbox">
                    <div class="img-txtdiv">
                       <img alt="card-liver" class="img-responsive" src="/img/campaign/Hemogram.png">
                       <h4>Complete Hemogram<span>(24)</span></h4>
                    </div>
                    <ul>
                       <li>Hemoglobin Hb</li>
                       <li>Neutrophils</li>
                       <li>Eosinophils</li>
                    </ul>
                    <p>Testing several components of blood will help in evaluation of overall health.</p>
                 </div>
              </div>
              <div class="col-lg-4 col-sm-6 col-xs-6 pading">
                 <div class="card-innerbox">
                    <div class="img-txtdiv">
                       <img alt="card-liver" class="img-responsive" src="/img/campaign/typiod.png">
                       <h4>Thyroid<span>(03)</span></h4>
                    </div>
                    <ul>
                       <li>T3, Total Tri Iodothyronine</li>
                       <li>T4, Total Thyroxine</li>
                       <li>TSH Ultra-sensitive</li>
                    </ul>
                    <p>Thyroid test helps in the examination of body’s metabolism.</p>
                 </div>
              </div>
              <div class="col-lg-4 col-sm-6 col-xs-6 pading">
                 <div class="card-innerbox">
                    <div class="img-txtdiv">
                       <img alt="card-liver" class="img-responsive" src="/img/campaign/lipid.png">
                       <h4>Lipid<span>(09)</span></h4>
                    </div>
                    <ul>
                       <li>Cholesterol-Total, Serum</li>
                       <li>HDL Cholesterol Direct</li>
                       <li>LDL Cholesterol -Direct</li>
                    </ul>
                    <p>Abnormal cholesterol levels can be evaluated with Lipid test.</p>
                 </div>
              </div>
           </div>
        </div>
     </section>
     <!-- Our Offerings==section-start- -->
     <section class="Our-Offerings">
        <div class="container">
           <h4>Our Offerings</h4>
           <img src="/img/campaign/undr-line-img.png">
           <div class="row">
              <div class="col-lg-3 col-sm-6 col-xs-6 paddingright-none ">
                 <div class="ofr-blok border-right border-bottom">
                    <div class="sctoeimg-div">
                       <img alt="scooter.png" src="/img/campaign/scooter.png">
                    </div>
                    <p>Free Sample Collection from Home & Office</p>
                 </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-xs-6 paddingleft-none">
                 <div class="ofr-blok border-bottom">
                    <div class="sctoeimg-div">
                       <img alt="scooter.png" src="/img/campaign/free-doctor.png">
                    </div>
                    <p>Free Doctor & Diet Consultation</p>
                 </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-xs-6 paddingright-none">
                 <div class="ofr-blok border-right">
                    <div class="sctoeimg-div">
                       <img alt="same-day.png" src="/img/campaign/same-day.png">
                    </div>
                    <p>Same day accurate reports & money back guarantee</p>
                 </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-xs-6 paddingleft-none">
                 <div class="ofr-blok">
                    <div class="sctoeimg-div">
                       <img alt="quality.png" src="/img/campaign/quality.png">
                    </div>
                    <p>NABL + ISO + DMLT Certified</p>
                 </div>
              </div>
           </div>
        </div>
     </section>
     <section class="why-healthiansdsec">
        <div class="container">
           <h4>Why Healthians</h4>
           <img alt="undr-line-img" src="/img/campaign/undr-line-img.png" class="under">
           <div class="row">
              <div class="col-lg-3 col-sm-6 col-xs-6 match-heightdiv">
                 <div class="img-thumbdiv">
                    <img alt="5lac" src="/img/campaign/5lac.jpg">
                    <div class="thumb-txtdiv">
                       <h5>5 Lacs Families Tested</h5>
                    </div>
                 </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-xs-6 match-heightdiv">
                 <div class="img-thumbdiv">
                    <img alt="fullbody" src="/img/campaign/fullbody.jpg">
                    <div class="thumb-txtdiv">
                       <h5>NABL + ISO Certified Labs</h5>
                    </div>
                 </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-xs-6  match-heightdiv">
                 <div class="img-thumbdiv">
                    <img alt="indiamap" src="/img/campaign/indiamap.jpg">
                    <div class="thumb-txtdiv">
                       <h5>In More Than 30 Cities of India</h5>
                    </div>
                 </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-xs-6 match-heightdiv">
                 <div class="img-thumbdiv">
                    <img alt="5award" src="/img/campaign/5award.jpg">
                    <div class="thumb-txtdiv">
                       <h5>Widely Recognised</h5>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </section>
     <section class="customer-speak">
        <div class="container">
           <h4>Customer Speak</h4>
           <img alt="undr-line-img" src="/img/campaign/undr-line-img.png">
           <div class="row">
            <div class="col-xs-12">
                <div class="owl-carousel" id="testimonial-slider">
                    <div class="testimonial">
                        <h4 class="testimonial-title">Amarnath</h4>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <small>Jan 27, 2019</small>
                        </div>
                        <div class="testimonial-review">
                            <p class="testimonial-description">Delighted by the services experienced. Collected the sample and received the reports on the same day. Hope we receive the same kind of service in future as well.</p>
                        </div>
                    </div>
                    <div class="testimonial">
                        <h4 class="testimonial-title">Parul Mehra</h4>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <small>16 December, 2018</small>
                        </div>
                        <div class="testimonial-review">
                            <p class="testimonial-description">Just got the first tests done recently and what impressed me the most was the reports. The presentation was very precise and easy to understand. The Smart Report (apart from the detailed report) is by impressive.</p>
                        </div>
                    </div>
                    <div class="testimonial">
                        <h4 class="testimonial-title">Lakhwinder Aggarwal</h4>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <small>23 December, 2018</small>
                        </div>
                        <div class="testimonial-review">
                            <p class="testimonial-description">Healthians is a good app for all pathology tests. Prices too are very reasonable. Sample procedure is good and timely. They always use a sealed sample collection kit. Overall satisfied.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
     </section>
     <section class="serving-inmore">
        <div class="container">
           <h5>Serving in more than 30 cities Pan-India</h5>
           <img alt="undr-line-img" src="/img/campaign/undr-line-img.png">
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
     <section class="footerlinks-div">
        <div class="container">
           <div class="row">
              <div class="col-lg-6 col-xs-12 heladvisor">
                 <h4>Talk to our Health Advisor	</h4>
                 <a href="#" data-toggle="modal" data-target="#basicModal" data-whatever="@counter">
                    <form action="/hms/accommodations" method="get">
                       <div class="input-group">
                          <input class="form-control" id="txtSearch" placeholder="Enter your 10 digit mobile number" type="text">
                          <div class="input-group-btn">
                             <button type="button" class="btn btn-primary">Get a free call</button>
                          </div>
                       </div>
                    </form>
                 </a>
                 <img alt="undr-line-img" src="/img/campaign/undr-line-img.png" class="hidden-lg">
              </div>
              <div class="col-lg-6 col-sm-6">
                 <ul>
                    <li><a href="https://www.healthians.com/about-us">About Us </a></li>
                    <li><a href="https://blog.healthians.com/">Blog</a></li>
                    <li><a href="https://www.healthians.com/healthians-media">Media</a></li>
                    <li><a href="https://www.healthians.com/contact-us">Contact Us</a></li>
                    <li><a href="https://www.healthians.com/career">Career</a></li>
                    <li><a href="https://www.healthians.com/refund-policy">Money Back Policy</a></li>
                    <li><a href="https://www.healthians.com/healthians-investors">Investors</a></li>
                    <li><a href="https://www.healthians.com/labs">Our Labs</a></li>
                    <li><a href="https://www.healthians.com/feedback">Feedback</a></li>
                    <li><a href="https://www.healthians.com/deals">Health Deals</a></li>
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

<div class="modal fade leadmodalcallback" id="basicModal" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="top:30%" data-focus="true">
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
    <script type="text/javascript" src="/js/landing/v2/owl.carousel.min.js"></script>
	
    <script type="text/javascript">
        $(document).ready(function(){
            
            if($(window) .width() < 560)
	            $("#testimonial-slider").owlCarousel({
	                items:1,
	                itemsDesktop:[1000,1],
	                itemsDesktopSmall:[979,1],
	                itemsTablet:[768,1],
	                pagination: true,
	                autoPlay:true
	            });
	        else
	        	$("#testimonial-slider").owlCarousel({
	                items:2,
	                itemsDesktop:[1000,1],
	                itemsDesktopSmall:[979,1],
	                itemsTablet:[768,1],
	                pagination: true,
	                autoPlay:true
	            });

            var owl = $('#news-slider').owlCarousel({
                stagePadding: 30,
                loop:false,
                margin:0,
                nav:true,
                dots:false,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:3
                    }
                }
            });            

            $("#addLeadForm").submit(function () { 
                if($("#addLeadForm").valid()) {
                    ajaxCallPromise(saves_api_url, "POST", $('#addLeadForm').serialize()).then(saveLeadSuccessHandler, saveLeadErrorHandler);
                }
                return false;            
            });
        });
  
        $('#basicModal').on('show.bs.modal', function (event) {
            $("#txtSearch").blur();
            var button = $(event.relatedTarget);
            var recipient = button.data('whatever');
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

        function bookNow(clicked_pkg) {
            setTimeout(function(){
                if($("#message").length == 0) {
                    $("#addLeadForm").append('<input type="hidden" name="message" id="message" value="Customer search for '+clicked_pkg+'" />');
                }
                else {
                    $("#message").val('Customer search for '+clicked_pkg);
                }                
            },500);
            
        }
    </script>
    <script src="/js/landing_page.js"></script>
    <footer></footer>
@endpush