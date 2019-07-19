@extends('layout.landing_master')

@push('header-scripts')
<link href="/css/t2/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<link href="/css/landing/v1/owl.carousel.min.css" rel="stylesheet">
<link href="/css/landing/v1/owl.theme.min.css" rel="stylesheet">
@endpush

@section('page-content')
<style>
.banner,.banner-section,.home-based,.serch-div{width:100%;float:left}.banner_mb{display:none;}.btn,.form-control{border-radius:0}*{margin:0;padding:0}body{font-family:Poppins,sans-serif}.btn-primary{color:#fff}.leadmodalcallback{margin:auto}.leadmodalcallback .modal-dialog{max-width:560px;margin:auto}.btn-primary.active,.btn-primary.focus,.btn-primary:active,.btn-primary:focus,.btn-primary:hover,.open>.dropdown-toggle.btn-primary{color:#fff;background-color:#009fa9;border-color:#009fa9}.pading{padding-bottom:30px}.banner-section{padding:0 0 20px}.banner img{width:100%}.home-based h1{color:#f37d27;font-size:30px;margin-bottom:0px;font-weight:500;padding-bottom:0}.home-based h2{color:#00a0a8;font-size:40px;font-weight:500;padding-bottom:18px}.home-based h3{color:#3f3f3f;font-size:46px;font-weight:500}.home-based p{font-size:36px;color:#848484}.serch-div{background-color:#f6f6f6;padding:10px;margin-bottom:10px}.btn-primary{background-color:#f37d27;border-color:#f37d27;height:45px}.brdr-btm{border-bottom:1px solid #ccc}.input-group .form-control,.input-group-addon,.input-group-btn{display:table-cell;height:45px}.serch-section p{font-size:15px;color:#3f3f3f;text-align:right;width:70%;float:right}.why-preventive{width:100%;float:left}.why-preventive h3{font-size:26px;color:#009fa9;text-align:center;margin-bottom:30px;margin-top:50px}.why-preventive img{margin:15px auto 20px;display:block}.why-preventive p{color:#3f3f3f;font-size:16px;text-align:center;line-height:24px;padding-bottom:20px}.card-lvr{width:100%;float:left}.form-control{height:40px}.serch-section{padding:20px 10px}.card-lvr .card-innerbox{background-color:#f8f8f8;width:100%;float:left;padding:15px 30px;border-radius:4px;box-shadow:0 2px 4px 4px #f2f2f2}.card-innerbox .img-txtdiv{width:100%;float:left;padding-bottom:15px;min-height:75px}.card-innerbox .img-txtdiv img{float:left;margin-right:20px;height:50px;width:auto}.card-innerbox .img-txtdiv h4{padding-left:30px;color:#009fa9;font-size:22px;font-weight:500;margin-top:0}.card-innerbox .img-txtdiv h4 span{padding-left:4px;color:#f37d27}.card-innerbox ul{padding-left:20px;margin-bottom:10px; margin-top:1px;float:left;}.card-innerbox ul li{font-size:16px;color:#3f3f3f;line-height:21px; padding-bottom:3px;}.card-innerbox p{font-size:16px;color:#3f3f3f;line-height:24px;min-height:80px;float:left}.Our-Offerings{width:100%;float:left;background-color:#f8f8f8;padding:40px 0}.Our-Offerings img{margin:auto auto 0px;display:block}.Our-Offerings h4{text-align:center;font-size:26px;color:#009fa9}.Our-Offerings .ofr-blok{padding:0}.paddingleft-none{padding-left:0}.paddingright-none{padding-right:0}.Our-Offerings .ofr-blok .sctoeimg-div{min-height:110px}.Our-Offerings .ofr-blok .sctoeimg-div img{width:100px;padding-top:20px}.Our-Offerings .ofr-blok p{font-size:16px;text-align:center;min-height:82px;padding:10px 50px}.why-healthiansdsec{width:100%;float:left;padding:40px 0}.why-healthiansdsec h4{font-size:26px;color:#009fa9;text-align:center;padding-bottom:15px}.why-healthiansdsec .under{display:block;margin:20px auto}.why-healthiansdsec .img-thumbdiv h5{font-size:14px;color:#fff;text-align:center;padding:15px 18px;margin-top:0}.why-healthiansdsec .img-thumbdiv img{width:100%}.why-healthiansdsec .thumb-txtdiv{width:100%;background-color:#009fa9;border-bottom-left-radius:4px;border-bottom-right-radius:4px}.match-heightdiv{min-height:202px;padding-bottom:15px}.customer-speak{width:100%;float:left}.customer-speak h4{text-align:center;font-size:26px;color:#009fa9;padding-bottom:20px}.customer-speak img{margin:0 auto 30px;display:block}.testimonial .pic>img{width:20%;border-radius:50%;text-align:center;float:left}.testimonial{text-align:center}.testimonial .fa{color:#666}.testimonial .pic{margin-bottom:35px}.star{float:left;padding-left:0}.star small{color:#999;padding:0 0 0 10px}.testimonial .testimonial-review{color:#000;font-size:16px;line-height:27px;margin-bottom:14px}.testimonial-review>.testimonial-description{font-size:14px;float:left;text-align:left;color:#666;line-height:24px}.testimonial .testimonial-title{color:#000;font-style:normal;font-size:15px;line-height:22px;text-transform:capitalize;padding:0;text-align:left}.testimonial-title>small{color:#000;font-style:normal;font-size:14px;line-height:22px}.owl-theme .owl-controls .owl-page span{width:9px;height:9px;background:#009fa9;border:1px solid #009fa9;margin:5px}.border-bottom,.modal-header{border-bottom:none}.owl-theme .owl-controls .owl-page.active span,.owl-theme .owl-controls.clickable .owl-page:hover span{filter:Alpha(Opacity=100);opacity:1;background-color:#009fa9}.serving-inmore{width:100%;float:left;background-color:#f8f8f8;padding:30px 0}.serving-inmore h5{font-size:26px;color:#009fa9;text-align:center;padding-bottom:15px}.serving-inmore img{display:block;margin:0 auto}.serving-inmore ul{list-style:none;padding-top:20px;text-align:center}.serving-inmore ul li{display:inline-block;text-transform:capitalize;border-left:1px solid #888;margin-bottom:10px;padding-left:5px}.serving-inmore ul li:first-child{border-left:none}.serving-inmore li a{color:#666;font-size:16px;padding-right:5px;display:inline-block}.footerlinks-div{padding:30px 0;width:100%;float:left}.footerlinks-div h4{font-size:20px;color:#009fa9;text-align:center;padding-bottom:15px}.footerlinks-div img{margin:30px auto 0;display:block}.footerlinks-div ul{list-style:none;padding-top:0;text-align:center}.footerlinks-div ul li{display:inline-block;padding-right:10px;border-left:1px solid #888;padding-left:10px;margin-top:10px}ul li:first-child{border-left:none}.footerlinks-div ul li a{color:#717171;color:14px;font-size:16px}.copyright-sectiondiv p,.footerlinks-div p,.last-footer p{font-size:14px;text-align:center}.footerlinks-div p{line-height:25px;color:#414143;padding-top:20px}.copyright-sectiondiv p{padding:10px;background-color:#009fa8;width:100%;float:left;color:#fff}.border-right{border-right:none}.last-footer{width:100%;float:left;position:relative}.last-footer p{color:#414143}.modal-dialog{position:relative;width:auto;margin:0}.modal-backdrop.in{filter:alpha(opacity=50);opacity:.8}.fixedform-div{background-color:#009fa9;position:fixed;z-index:99999;left:0;right:0;bottom:0;padding:30px}.fixedform-div a{text-decoration:none}.modal-header{padding:5px 10px!important}@media only screen and (max-width:480px){.card-innerbox .img-txtdiv h4{font-size:16px;}.card-innerbox ul li{ font-size:14px;    line-height: 20px;}.card-innerbox p{ line-height: 19px;font-size:13px;}.card-innerbox ul li{font-size:13px; line-height:19px;}.serch-section p{width:100%; float:none;}.last-footer{width:100%;float:left;position:relative}.home-based h1{color:#f37d27;font-size:24px;font-weight:500;padding-bottom:0}.banner-section{padding:30px 0}.home-based h2{color:#00a0a8;font-size:30px;font-weight:500;padding-top:0px;padding-bottom:0}.home-based h3{color:#3f3f3f;font-size:18px;margin-bottom:0}.home-based p{font-size:14px;line-height:20px;}.serch-section p{font-size:16px;color:#3f3f3f;font-weight:500}.why-preventive h3{font-size:20px;margin-top:0;margin-bottom:12px}.card-lvr .card-innerbox{box-shadow:0 2px 4px 2px #f2f2f2;height:auto}.Our-Offerings h4{font-size:20px;padding-bottom:10px}.why-healthiansdsec h4{font-size:20px}.footerlinks-div ul li a{color:#717171;color:14px;font-size:14px}.customer-speak h4{text-align:center;font-size:20px}.serving-inmore h5{font-size:16px}.Our-Offerings img{margin:0 auto 0px;display:block}.fixedform-div{display:block;padding:15px}.brdr-btm{border-bottom:none}}@media only screen and (max-width:414px){.card-innerbox .img-txtdiv{width:100%;float:left;padding-bottom:15px;min-height:50px}.card-innerbox ul{padding-left:10px;float:left;min-height:65px;margin-bottom:10px}.last-footer p{color:#999;font-size:12px;text-align:center}.last-footer{width:100%;float:left;position:relative}.why-healthiansdsec{width:100%;float:left;padding:40px 0 20px}.card-innerbox .img-txtdiv h4{padding-left:30px;color:#009fa9;font-size:16px;font-weight:500;margin-top:0;margin-bottom:0}.card-innerbox ul li{font-size:12px;line-height:15px; margin-bottom:0px; padding-bottom:4px;}.card-innerbox p{font-size:12px;color:#3f3f3f;line-height:17px;min-height:74px;float:left}.home-based h1{color:#f37d27;font-size:20px}.home-based h2{color:#00a0a8;font-size:24px}.why-healthiansdsec .img-thumbdiv h5{font-size:16px;line-height:18px;}.border-right{border-right:1px solid #7ccbd0}.border-bottom{border-bottom:1px solid #7ccbd0}.serch-section p{font-size:12px;color:#3f3f3f;text-align:center;width:auto;float:none}.card-innerbox .img-txtdiv img{float:left;margin-right:12px;height:30px;width:auto}.footerlinks-div img,.why-preventive img{margin-bottom:20px}.testimonial .testimonial-title{padding-left:0px}.Our-Offerings .ofr-blok p{font-size:14px;text-align:center;min-height:82px;padding:10px}.why-preventive p{color:#3f3f3f;font-size:14px;text-align:center;line-height:24px;padding-bottom:20px}.serving-inmore li a{color:#666;font-size:12px;padding-right:5px;display:inline-block}.Our-Offerings{width:100%;float:left;background-color:#f8f8f8;padding:40px 0 10px; margin-top:20px;}.why-healthiansdsec .under{display:block;margin:0 auto 30px}}@media only screen and (max-width:360px){.card-innerbox .img-txtdiv{width:100%;float:left;padding-bottom:15px;min-height:50px}.card-innerbox ul{padding-left:10px;float:left;min-height:60px;margin-bottom:10px}.last-footer p{color:#999;font-size:12px;text-align:center}.last-footer{width:100%;float:left;position:relative}.why-healthiansdsec{width:100%;float:left;padding:40px 0 20px}.card-innerbox .img-txtdiv h4{padding-left:30px;color:#009fa9;font-size:14px;font-weight:500;margin-top:0}.card-innerbox ul li{font-size:12px;line-height:16px; padding-bottom:2px;}.card-innerbox p{font-size:12px;color:#3f3f3f;line-height:17px;min-height:75px;float:left}.home-based h1{color:#f37d27;font-size:20px}.home-based h2{color:#00a0a8;font-size:24px}.why-healthiansdsec .img-thumbdiv h5{font-size:12px}.border-right{border-right:1px solid #7ccbd0}.border-bottom{border-bottom:1px solid #7ccbd0}.serch-section p{font-size:12px;color:#3f3f3f;text-align:center;width:auto;float:none}.card-innerbox .img-txtdiv img{float:left;margin-right:12px;height:30px;width:auto}.testimonial .testimonial-title{padding-left:0px}.Our-Offerings .ofr-blok p{font-size:12px;text-align:center;min-height:82px;padding:10px}.why-preventive p{color:#3f3f3f;font-size:14px;text-align:center;line-height:24px;padding-bottom:20px}.serving-inmore li a{color:#666;font-size:12px;padding-right:5px;display:inline-block}.Our-Offerings{width:100%;float:left;background-color:#f8f8f8;padding:40px 0 10px}.why-healthiansdsec .under{display:block;margin:0 auto 30px}}
label.error {color:#e43b3f; float: left; font-size:10px;font-weight: normal;}
.field-form { line-height: 3;}
.minimal {height: 41px;display: block;width: 100%;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius:0px;-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;-o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;}
.field-button input[type=submit]{background-color: #f37d27; border-color: #f37d27; height: 45px; font-size: 16px;background-image: none;box-shadow:none !important;}
.mand_field_text {display: none;}
.close {opacity:1;} 
.webpara{font-size:22px !important; margin:0px;}
 .valpara{font-size:18px !important;}

.banner-section .banner{display:block;}
@media only screen and (max-width: 520px) {
    .banner-section {padding:0;}
    .banner-section .banner{display:none;}
    .why-healthiansdsec .img-thumbdiv h5{ padding:15px 24px; }
    .card-innerbox .img-txtdiv h4{ padding-left:0px; text-align:center; min-height:34px; }
    .card-innerbox .img-txtdiv img{float: none; margin-right: 20px; height: 36px; width: 32px; text-align: center;
    margin: auto; margin-bottom: 10px;}
    .webpara{font-size:18px !important; margin:0px;}
 .valpara{font-size:15px !important;}
    .serch-section p{ text-align:center; }    
    .card-lvr .card-innerbox{ padding:15px 10px; height:324px; }
    .Our-Offerings .ofr-blok .sctoeimg-div{ min-height:98px; }
    .banner_mb{ display:block; }
    .banner_mb img{max-width:100%;}
    .Our-Offerings .ofr-blok p{font-size:13px; text-align: center; min-height:82px; padding: 10px 21px;}
}


</style>

<section class="banner-section">
    <div class="banner"><img alt="banner-blogimg" src="/img/campaign/fullbody_banner.jpg"></div>
    <div class="banner_mb"><img alt="banner-blogimg" src="/img/campaign/banner-blogimg.jpg"></div>

</section>
<section class="home-based">
    <div class="container brdr-btm">
       <div class="row">
            <div class="col-lg-6 col-sm-12 col-xs-12">
                <h1>Home Based Sample Collection</h1>
                <h2>Full Body Checkup @ ₹999</h2>
                <h3 class="webpara">74 Parameters</h3>
                <p class="valpara">Thyroid, Lipid, Liver, Hemogram, Kidney, Urine R/M, Blood Glucose Fasting</p>
            </div>
            <div class="col-lg-6 col-sm-12 col-xs-12  serch-section">
                <div class="serch-div">
                    <a href="javaScript:void(0);" data-toggle="modal" data-target="#basicModal" data-whatever="@number">
                        <div class="input-group">
                            <input class="form-control" id="txtSearch" placeholder="Enter your 10 digit mobile no" type="text">
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
<section class="why-preventive">
    <div class="container">
        <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h3>Why Preventive Checkup?</h3>
                    <img alt="undr-line-img" src="/img/campaign/undr-line-img.png">
                    <p>Full Body Checkup at home will help you know the functioning of your major body organs. This health test will help you identify and rule out issues like obesity, menstrual problems & infections.</p>
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
        <br>
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
 <!-- Why Healthians==section===== -->
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
 <!-- coustomer==speak -->
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
 <!-- =======Serving in more than 30 cities pan-India======== -->
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
 <!-- footer-links====== -->
 <section class="footerlinks-div">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <a href="javaScript:void(0);" data-toggle="modal" data-target="#basicModal" data-whatever="@counter">
                    <div class="input-group">
                        <input class="form-control" id="txtSearch2" placeholder="Enter your 10 digit mobile no." type="text">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary">Get a free call</button>
                        </div>
                    </div>
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

<div class="modal fade leadmodalcallback" id="basicModal" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="top:30%">
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
    <script src="/js/bootstrap.min.js"></script> 
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
    </script>
    <script src="/js/landing_page.js"></script>
    <footer></footer>
@endpush