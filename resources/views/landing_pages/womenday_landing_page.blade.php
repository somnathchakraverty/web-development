@extends('layout.landing_master')

@push('header-scripts')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css" rel="stylesheet">
@endpush

@section('page-content')
<style>
*{margin: 0px; padding: 0px;}body{font-family: 'Open Sans', sans-serif;}.btn-primary{color: #fff; background-color: #337ab7; border-color: #2e6da4;}.leadmodalcallback{margin:auto;}.leadmodalcallback .modal-dialog{max-width:560px; margin:auto;}.btn-primary:focus,.btn-primary.focus{color: #fff; background-color: #009fa9; border-color: #009fa9;}.btn-primary:hover{color: #fff; background-color: #009fa9; border-color: #009fa9;}.btn-primary:active,.btn-primary.active,.open > .dropdown-toggle.btn-primary{color: #fff; background-color: #009fa9; border-color: #009fa9;}.modal-body button.btn.btn-primary.btn-block{background: #3F51B5; color: #fff;}.pading{padding-bottom: 30px}.logo img{width: 254px;}h1{color: #31247c; margin-bottom: 40px; margin-top: 40px;}.bg{background-image: url("../img/campaign/header-healthiance-dashboard.jpg"); background-repeat: no-repeat; background-size: cover;}.banner-section h1{font-size: 42px; margin-top: 42px; font-weight:400; width: 50%; color: #ffffff;}.banner-section p{font-size: 30px}.banner-section p{font-size: 30px; width: 63%; padding: 30px 0; font-weight: 300;}.banner-section{width: 100%; color: #ffffff; min-height: 800px; padding: 30px 0px;}.banner{width: 100%; float: left;}.banner img{width: 100%;}.home-based{width: 100%; float: left;}.home-based h1{color: #f37d27; font-size: 30px; font-weight: 500; padding-bottom: 0px;}.home-based h2{color: #00a0a8; font-size: 40px; font-weight: 500; padding-bottom: 28px;}.home-based h3{color: #3f3f3f; font-size: 46px; font-weight: 500;}.home-based p{font-size: 36px; color: #848484}.serch-div{width: 300px; float: left; margin-bottom: 10px;}.btn-primary{background-color: #ffffff; border-color: #ffffff; height: 45px; color: #4535ae; font-size: 20px; font-weight: 600;}.btn-primary:hover{background-color: #ffffff; color: #000}.brdr-btm{border-bottom: 1px solid #ccc;}.input-group .form-control, .input-group-addon, .input-group-btn{display: table-cell; height: 45px; float: left; margin-top: 10px;}.modal-body .input-group-btn{float: none;}img.icon{width: 27px;}a.book{float: right; background: #31247c; padding: 5px 10px; border-radius: 10px; color: #fff; margin-top: -37px;}.serch-section p{font-size:15px; color: #3f3f3f; text-align: right; width: 70%; float: right;}.why-preventive{width: 100%; float: left;}.why-preventive h3{font-size: 26px; color: #41368f; text-align: center; margin-bottom:10px; margin-top: 50px;}.why-preventive img{margin: 15px auto; display: block; margin-bottom: 20px;}.why-preventive p{color: #3f3f3f; font-size: 16px; text-align: center; line-height: 24px; padding-bottom: 20px;}/*---liver---card----section---start----*/.card-lvr{width: 100%; float: left;}.form-control{border-radius: 0px; height: 40px;}.btn{border-radius: 0px;}.serch-section{padding: 20px 10px;}.card-lvr .card-innerbox{background-color: #f8f8f8; width: 100%; float: left; padding: 15px 10px; border-radius: 4px; box-shadow: 0px 2px 4px 4px #f2f2f2; min-height:214px;}.card-innerbox .img-txtdiv{width: 100%; float: left; padding-bottom: 15px; min-height: 75px;}.card-innerbox .img-txtdiv img{width: 60px; display: inline-block;}.card-innerbox .img-txtdiv h4{padding-left:0px; color: #41368f; font-size: 22px; font-weight: 500; margin-top: 0px;}.card-innerbox .img-txtdiv h4 span{padding-left: 10px; color: #f37d27;}.card-innerbox ul{padding-left: 20px; margin-bottom: 20px;}.card-innerbox ul li{font-size: 16px; color: #3f3f3f; line-height: 30px;}.card-innerbox p{font-size: 16px; color: #3f3f3f; line-height: 24px; min-height: 80px; float: left;}/*------------our--offering----section---*/a.btn.btn-primary.call{border-radius: 20px; background: #41368f; color: #fff;}.input-group h3{text-align: left; color: #41368f;margin-top: 0;}.Our-Offerings{width: 100%; float: left; padding: 40px 0px;}.Our-Offerings img{margin: auto; display: block; margin-bottom:0px;}.Our-Offerings h4{text-align: center; font-size: 26px; color: #41368f;}.Our-Offerings .ofr-blok{padding: 0px 0px 0px 0px;}.paddingleft-none{padding-left:0px;}.paddingright-none{padding-right: 0px;}.Our-Offerings .ofr-blok .sctoeimg-div{min-height: 115px;}.Our-Offerings .ofr-blok .sctoeimg-div img{width: 100px;padding-top: 20px;}.Our-Offerings .ofr-blok p{font-size: 16px; text-align: center; padding-top: 20px; min-height: 82px; padding: 15px 50px;}/*--why-healthiansdse---------------*/.why-healthiansdsec{width: 100%; float: left; padding: 40px 0px;}.why-healthiansdsec h4{font-size: 26px; color: #009fa9; text-align: center; padding-bottom: 15px;}.why-healthiansdsec .under{display: block; margin: 20px auto;}.why-healthiansdsec .img-thumbdiv h5{font-size: 15px; color: #fff; text-align: center; ; padding:15px; margin-top: 0px;}.why-healthiansdsec .img-thumbdiv img{width: 100%;}.why-healthiansdsec .thumb-txtdiv{width: 100%; background-color: #009fa9; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px;}.match-heightdiv{min-height: 202px; padding-bottom: 15px;}/*--------media---for--mobile=-----*/.testimonial-review > .testimonial-description:before{width: 0; width: 0; height: 0; content: ""; border-left: 10px solid transparent; border-right: 10px solid transparent; border-top: 10px solid #fff; position: absolute; bottom: 55px;}.customer-speak{width: 100%; float: left; padding-bottom: 20px; background-color: #f8f8f8;}.customer-speak h4{text-align: center; font-size: 26px; color: #41368f; padding-bottom: 20px; padding-top: 20px;}.customer-speak img{margin: 0 auto; display: block; margin-bottom: 30px;}.testimonial .pic > img{border-radius: 50%; width: 20%;}.testimonial{text-align: center;}.testimonial .fa{color: #666;}.testimonial .pic{margin-bottom: 35px;}.testimonial .pic>img{border-radius: 50%; text-align: center;float: left;}.star{float: left;padding-left:0px;}.star small{color: #999; padding: 0 0 0 10px;}.testimonial .testimonial-review{color: #000; font-size: 16px; line-height: 27px; margin-bottom: 14px;}.testimonial-review > .testimonial-description{font-size: 14px; float: left; text-align: left; color: #666; line-height: 24px; padding: 20px; background: #fff; border-radius: 10px; margin: 0 20px 16px 0;}small, .small{font-size: 85%; float: left;}.testimonial .testimonial-title{color: #41368f; font-style: normal; font-size: 15px; line-height: 22px; text-transform: capitalize; padding: 0px; text-align: left; padding-left:0px;}.testimonial-title>small{color: #000; font-style: normal; font-size: 14px; line-height: 22px;}.owl-theme .owl-controls .owl-page span{width: 9px; height: 9px; background: transparent; border: 1px solid #000; margin: 5px;}.owl-theme .owl-controls .owl-page.active span, .owl-theme .owl-controls.clickable .owl-page:hover span{background: #000;}.owl-theme .owl-controls .owl-page span{width: 9px; height: 9px; background: #3F51B5 ; border: 1px solid #3F51B5; margin: 5px;}.owl-theme .owl-controls .owl-page.active span,.owl-theme .owl-controls.clickable .owl-page:hover span{filter:Alpha(Opacity=100); opacity:1;background-color: #3F51B5;}/*----------serving-inmore-----------------*/.serving-inmore{width: 100%; float: left; padding: 30px 0px;}.serving-inmore h5{font-size: 26px; color: #41368f; text-align: center; padding-bottom: 15px;}.serving-inmore img{display: block; margin: 0 auto}.serving-inmore ul{list-style: none; padding-top: 20px; text-align: center;}.serving-inmore ul li{display: inline-block; border-left: 1px solid #888; margin-bottom: 10px; padding-left: 5px;}.serving-inmore ul li:first-child{border-left: none;}.serving-inmore li a{color: #666; font-size: 16px; padding-right: 5px; display: inline-block;}/*------------footerlinks-div---------*/.footerlinks-div{padding: 30px 0px; width: 100%; float: left;}.footerlinks-div h4{font-size: 20px;color: #009fa9;text-align: center;padding-bottom: 15px;}.footerlinks-div img{margin: 0 auto; display: block; margin-top: 30px;}.footerlinks-div ul{list-style: none; padding-top: 0px; text-align: center;}.footerlinks-div ul li{display: inline-block; padding-right: 10px; border-left: 1px solid #888; padding-left: 10px; margin-top: 10px;}ul li:first-child{border-left: none;}.footerlinks-div ul li a{color: #717171; color: 14px; font-size: 16px;}.footerlinks-div p{text-align: center; font-size: 14px; line-height: 25px; color: #414143; padding-top: 20px;}/*copyright-sectiondi------section---*/.copyright-sectiondiv p{padding: 10px; background-color: #41368f; width: 100%; float: left; text-align: center; font-size: 14px; color: #fff;}.border-right{border-right: none;}.border-bottom{border-bottom: none;}/*-----------last-footer------------*/.last-footer{width: 100%; float: left; position: relative;}.last-footer p{color: #414143; font-size: 14px; text-align: center;}.modal-dialog{position: relative; width: auto; margin: 0px;}.modal-backdrop.in{filter: alpha(opacity=50); opacity: .8 ;}.fixedform-div{background-color: #009fa9; position:fixed; z-index: 99999;left: 0; right:0; bottom: 0;padding: 30px;}.fixedform-div a{text-decoration: none;}.modal-header{padding: 5px 10px !important; border-bottom: none;}/*Accordion*/.customized-Packages{float: left; width: 100%;padding: 50px 0px;}.customized-Packages h1{font-size: 26px; color: #41368f; font-size: 20px;}.acordian-section{float: left; width: 100%;}.acordian-section .panel-title > a{font-size: 14px; color: #373737;}.acordian-section .panel-title a h3{font-size: 12px; color: #373737; margin-top: 8px;}.acordian-section .panel-title a h3 span{color: #281b81; font-size: 12px;}.acordian-section .panel-body ul{list-style: none;}.acordian-section .panel-body ul li{border-bottom: 1px solid #ccc; padding: 10px 0px; color: #4b4b4b;}.panel-default > .panel-heading + .panel-collapse > .panel-body{background-color: #f9f9f9; border-left: 3px solid #4d429b;}.acordian-section .panel-body ul li span{float: right;}.acordian-section .panel{margin-bottom: 10px;}.acordian-section .panel-default > .panel-heading{border-radius: 0px; border-left:3px solid #4d429b;}.panel-title{margin-top: 0; margin-bottom: 0; font-size: 20px; color: #000;}.acordian-section .panel-title>a, .panel-title>a:active{display:block; padding:15px; color:#4738af; font-size:16px; font-weight:bold; text-transform:uppercase; letter-spacing:1px; word-spacing:3px; text-decoration:none;}.acordian-section.myaccount ul li a:active, a:focus{font-size: 16px; color: #4738af;}.acordian-section .panel-heading a:before{font-family: 'FontAwesome'; content: "\f067 "; float: right; transition: all 0.5s;}.acordian-section .panel-heading.active a:before{font-family: 'FontAwesome'; content: "\f068 ";}.panel-heading h3{color: #000; font-size: 16px; margin-top: 10px;}.panel-heading h3 span{color: #31247c;}a:hover{text-decoration: none;}@media only screen and (max-width: 480px){.testimonial-review > .testimonial-description{margin: 0 0px 16px 0;}.last-footer{width: 100%; float: left; position: relative;}.input-group h3{text-align: center; color: #41368f;}.serch-div .input-group-btn{position: relative; font-size: 0; white-space: nowrap; float: left; width: 100%; margin:5px 0 0 0;}img.icon{width: 15px;}.btn-primary{background-color: #ffffff; border-color: #ffffff; height: 45px; color: #311fa5; padding: 10px 20px 10px 14px; font-size: 18px; font-weight: 600; border-radius: 4px;}.bg{background-image: url("../img/campaign/mobile-header.jpg"); background-repeat: no-repeat; background-size: cover;}.banner-section{min-height: 512px;}.banner-section h1{font-size: 26px; margin-top: 118px; font-weight:600; line-height:28px; width: 77%; margin-bottom:0px;}.banner-section p{font-size: 14px; width:100%; padding: 10px 0px 0px 0px; font-weight: 100;}.logo img{width: 140px;}.home-based h1{color: #f37d27; font-size: 24px; font-weight: 500; padding-bottom: 0px;}.banner-section{padding:20px 10px;}.home-based h2{color: #00a0a8; font-size: 30px; font-weight: 500; padding-top: 20px; padding-bottom: 0px;}.home-based h3{color: #3f3f3f; font-size: 18px; margin-bottom: 0px;}.home-based p{font-size: 14px; line-height: 26px;}.serch-section p{font-size: 16px; color: #3f3f3f; font-weight: 500;}.why-preventive h3{font-size: 20px; margin-top: 0px; margin-bottom: 12px;}.card-lvr .card-innerbox{box-shadow: 0px 2px 4px 2px #f2f2f2; height: auto;}.Our-Offerings h4{font-size: 20px; padding-bottom: 10px;}.why-healthiansdsec h4{font-size: 20px;}.footerlinks-div ul li a{color: #717171; color: 14px; font-size: 14px;}.customer-speak h4{text-align: center; font-size: 20px; padding-top: 15px; padding-bottom: 0;}.serving-inmore h5{font-size: 20px;}.Our-Offerings img{margin: 0 auto; display: block; margin-bottom:10px}.fixedform-div{display:block; padding: 15px;}.brdr-btm{border-bottom: none;}}@media only screen and (max-width: 414px){.card-innerbox .img-txtdiv h4{padding-left:0px; color: #009fa9; font-size: 12px; font-weight: 500; margin-top: 0px;}.card-innerbox .img-txtdiv{width: 100%; float: left; padding-bottom: 15px; min-height: 50px;}.card-innerbox ul{padding-left: 10px; float: left; min-height: 80px; margin-bottom: 10px;}.last-footer p{color: #999; font-size: 12px; text-align: center;}.last-footer{width: 100%; float: left; position: relative;}.why-healthiansdsec{width: 100%; float: left; padding: 40px 0px 20px 0px;}.card-innerbox .img-txtdiv h4{padding-left: 0; color: #41368f; text-align: center; font-size: 22px; font-weight: 500; margin-top: 0px; margin-bottom: 0px;}.card-innerbox ul li{font-size: 12px;line-height: 24px;}.card-innerbox p{font-size: 13px; color: #3f3f3f; line-height: 22px;min-height: auto; float: left;}.card-lvr .card-innerbox{min-height: auto;}.home-based h1{color: #f37d27; font-size: 20px;}.home-based h2{color: #00a0a8; font-size: 24px;}.why-healthiansdsec .img-thumbdiv h5{font-size: 16px;line-height: 20px;}.input-group-btn{margin-bottom: 22px; padding: 10px 20px; font-size: 16px; width: 100%; text-align: center;}.serch-section p{font-size: 12px; color: #3f3f3f; text-align: center; width: auto; float: none;}.card-innerbox .img-txtdiv img{width: 20%; margin-right: 12px; height: 30px; width: auto;}.why-preventive img{margin-bottom: 20px;}.footerlinks-div img{margin-bottom: 20px;}.Our-Offerings .ofr-blok p{font-size: 14px; text-align: center; padding-top: 20px; min-height: 82px; padding: 10px;}.why-preventive p{color: #3f3f3f; font-size: 14px; text-align: center; line-height: 24px; padding-bottom: 20px;}.serving-inmore li a{color: #666; font-size: 12px; padding-right: 5px; display: inline-block;}.Our-Offerings{width: 100%; float: left; padding: 40px 0px 10px 0px;}.why-healthiansdsec .under{display: block; margin: 0px auto; margin-top: 20px; margin-bottom: 20px; margin-bottom: 30px; margin-top: 0px;}}@media only screen and (max-width: 360px){.card-innerbox .img-txtdiv h4{padding-left:0px; color: #009fa9; font-size: 12px; font-weight: 500; margin-top: 0px;}.card-innerbox .img-txtdiv{width: 100%; float: left; padding-bottom: 15px; min-height: 50px;}.card-innerbox ul{padding-left: 10px; float: left; min-height: 80px; margin-bottom: 10px;}.last-footer p{color: #999; font-size: 12px; text-align: center;}.last-footer{width: 100%; float: left; position: relative;}.why-healthiansdsec{width: 100%; float: left; padding: 40px 0px 20px 0px;}.card-innerbox .img-txtdiv h4{padding-left: 30px; color: #009fa9; font-size: 12px; font-weight: 500; margin-top: 0px;}.card-innerbox ul li{font-size: 10px;line-height: 24px;}.card-innerbox p{font-size: 10px; color: #3f3f3f; line-height: 18px; min-height: 75px; float: left;}.home-based h1{color: #f37d27; font-size: 20px;}.home-based h2{color: #00a0a8; font-size: 24px;}.why-healthiansdsec .img-thumbdiv h5{font-size: 12px;}.border-right{border-right: 1px solid #7ccbd0;}.border-bottom{border-bottom: 1px solid #7ccbd0;}.serch-section p{font-size: 12px; color: #3f3f3f; text-align: center; width: auto; float: none;}.card-innerbox .img-txtdiv img{float: left; width: 20%; margin-right: 12px; height: 30px; width: auto;}.testimonial .testimonial-title{padding-left: 80px;}.Our-Offerings .ofr-blok p{font-size: 12px; text-align: center; padding-top: 20px; min-height: 82px; padding: 10px;}.why-preventive p{color: #3f3f3f; font-size: 14px; text-align: center; line-height: 24px; padding-bottom: 20px;}.serving-inmore li a{color: #666; font-size: 12px; padding-right: 5px; display: inline-block;}.Our-Offerings{width: 100%; float: left; background-color: #f8f8f8; padding: 40px 0px 10px 0px;}.why-healthiansdsec .under{display: block; margin: 0px auto; margin-top: 20px; margin-bottom: 20px; margin-bottom: 30px; margin-top: 0px;}}
label.error {
    color: #e43b3f;
    float: left;
    font-size: 10px;
    font-weight: normal;
    padding-top:5px;
}
.minimal {
    height: 41px;
    display: block;
    width: 100%;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 0px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.panel-title a{ text-decoration:none; }
.field-button input[type=submit]{background-color: #3F51B5; border-color: #3F51B5; height: 45px;
    font-size: 16px; background-image: none; box-shadow: none !important;}
    .mand_field_text{ display:none; }
    .call_nw{width:92px; text-align:center; font-size:14px; color:#fff !important; height:28px;}
    a.book{padding:5px 0px !important;font-size:14px !important; color:#fff !important;}
    .call_nw a{ text-decoration:none; font-size:14px !important; color:#fff !important; padding:0px !important; }
    .call_nw a:active{ text-decoration:none; font-size:14px !important; color:#fff; padding:0px !important; }
    @media only screen and (max-width: 480px) {
    	.input-group-btn{ padding:10px 0px; text-align:left; }
    	.textcentr{ text-align:center !important; }
    	#txtSearch{ text-align:center; }
    	.input-group{ display:block; }
    }
    .panel-heading a{ color:#4d429b; }
</style>

    <!-- baneer-section------- -->
    <section class="banner-section bg">
	<div class="container">
 	 <div class="logo"><img alt="Logo" src="/img/campaign/logo.png"></div>
            <h1>Adding 10 healthy  years to every women's life</h1>      
            <p>As the time passes, we understand the different issues occur at different stages. Offering women specific customized packages for all age groups​. </p>

            <div class="serch-div">
                <a href="#" data-toggle="modal" data-target="#basicModal" data-whatever="@number">
                    <div class="input-group">
                        <input class="form-control" style="text-align:left;" id="txtSearch" placeholder="Enter 10 digit mobile number" type="text">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit"><img alt="get-a-call-back" class="icon" src="/img/campaign/call-icon.png"> Get a Free Call</button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
	

    <!-- -acordian----section----------- -->
    <section class="acordian-section">
        <div class="container">

            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h1>Customized Packages For You</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="wrapper center-block">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                               <div class="panel-heading active" role="tab" id="headingOne">
                                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                     <h4 class="panel-title">
                                        Women’s Day Special
                                        <h3>Tests: 65 | <span>&#x20B9;1499</span></h3>
                                     </h4>
                                  </a>
                               </div>
                               <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                  <div class="panel-body">
                                     <ul>
                                        <li>Lipid Profile 
                                           <span>9</span>
                                        </li>
                                        <li>
                                           Liver Function Test<span>12</span>
                                        </li>
                                        <li>RA Test Rheumatoid Arthritis Factor<span>1</span>	</li>
                                        <li>Complete Hemogram<span>24</span></li>
                                        <li>Thyroid Profile-Total (T3, T4 & TSH Ultra-Sensitive) <span>3</span></li>
                                        <li>Iron Studies <span>3</span> </li>
                                        <li>Kidney Function Test<span>11</span> </li>
                                        <li>HbA1c <span>2</span></li>
                                        <li>Blood Glucose Fasting <span>1</span></li>
                                        <div class="accord">
                                           <h3>Tests: 65  |&#x20B9; 1499</h3>
                                           <a href="#" class="book call_nw" data-toggle="modal" data-target="#basicModal" data-whatever="@number">Call Now</a>
                                        </div>
                                     </ul>
                                  </div>
                               </div>
                            </div>
                            <div class="panel panel-default">
                               <div class="panel-heading " role="tab" id="headingtwo">
                                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                                     <h4 class="panel-title">
                                        One Plus One Women's Day Special: 
                                        <h3>Tests: 65 | <span>&#x20B9;2499</span></h3>
                                     </h4>
                                  </a>
                               </div>
                               <div id="collapsetwo" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingtwo">
                                  <div class="panel-body">
                                     <ul>
                                        <li>
                                           Lipid Profile <span>9</span>
                                        </li>
                                        <li>
                                           Liver Function Test <span>12</span>
                                        </li>
                                        <li>Complete Hemogram <span>24</span></li>
                                        <li>Thyroid Profile-Total (T3, T4 & TSH Ultra-Sensitive) <span>3</span></li>
                                        <li>Iron Studies <span>3</span></li>
                                        <li>Kidney Function Test <span>11</span> </li>
                                        <li>HbA1c<span>2</span></li>
                                        <li>Blood Glucose Fasting <span>1</span></li>
                                     </ul>
                                     <div class="accord">
                                        <h3>Tests: 65  |&#x20B9; 2499</h3>
                                        <a href="#" class="book call_nw" data-toggle="modal" data-target="#basicModal" data-whatever="@number">Call Now</a>
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <div class="panel panel-default">
                               <div class="panel-heading " role="tab" id="headingthree">
                                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsethree" aria-expanded="true" aria-controls="collapsethree">
                                     <h4 class="panel-title">
                                        Women's Day Special (Advanced)
                                        <h3>Tests: 85 | <span>&#x20B9; 3333</span></h3>
                                     </h4>
                                  </a>
                               </div>
                               <div id="collapsethree" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingthree">
                                  <div class="panel-body">
                                     <ul>
                                        <li>
                                           Lipid Profile <span>1</span>
                                        </li>
                                        <li>	Liver Function Test <span>12</span></li>
                                        <li>Complete Hemogram <span>12</span>	</li>
                                        <li>	Iron Studies <span>3</span></li>
                                        <li>	Thyroid Profile-Total (T3, T4 & TSH Ultra-Sensitive) <span>3</span></li>
                                        <li>	Kidney Function Test <span>11</span> </li>
                                        <li>	Urine Routine and Microscopy 	<span>14</span> </li>
                                        <li>	HbA1c<span>2</span></li>
                                        <li>	RA Test Rheumatoid Arthritis Factor, Quantitative<span>1</span></li>
                                        <li>	CA-125, Serum <span>1</span></li>
                                        <li>	Calcium Total, Serum <span>1</span></li>
                                        <li>	CRP (C Reactive Protein) Quantitative, Serum<span>1</span></li>
                                        <li>Blood Glucose Fasting <span>1</span></li>
                                        <li>Vitamin D Total-25 Hydroxy<span>1</span></li>
                                        <li>Vitamin B12 Cyanocobalamin <span>1</span></li>
                                     </ul>
                                     <div class="accord">
                                        <h3>Tests: 85  |&#x20B9;3333</h3>
                                        <a href="#" class="book call_nw" data-toggle="modal" data-target="#basicModal" data-whatever="@number">Call Now</a>
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <div class="panel panel-default">
                               <div class="panel-heading " role="tab" id="headingfour">
                                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="true" aria-controls="collapsefour">
                                     <h4 class="panel-title">
                                        One Plus One Women's Day Special (Advanced)
                                        <h3>Tests: 85  | <span>&#x20B9;4999</span></h3>
                                     </h4>
                                  </a>
                               </div>
                               <div id="collapsefour" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingfour">
                                  <div class="panel-body">
                                     <ul>
                                        <li> 	Lipid Profile <span>9</span></li>
                                        <li>	Liver Function Test <span>12</span></li>
                                        <li>Complete Hemogram <span>24</span>	</li>
                                        <li>	Iron Studies <span>3</span></li>
                                        <li>	Thyroid Profile-Total (T3, T4 & TSH Ultra-Sensitive) <span>3</span></li>
                                        <li>	Kidney Function Test <span>11</span> </li>
                                        <li>	Urine Routine and Microscopy 	<span>14</span> </li>
                                        <li>	HbA1c<span>2</span></li>
                                        <li>	RA Test Rheumatoid Arthritis Factor, Quantitative<span>1</span></li>
                                        <li>	CA-125, Serum <span>1</span></li>
                                        <li>CRP (C Reactive Protein) Quantitative, Serum <span>1</span></li>
                                        <li>Blood Glucose Fasting<span>1</span></li>
                                        <li>Vitamin D Total-25 Hydroxy<span>1</span></li>
                                        <li>Vitamin B12 Cyanocobalamin<span>1</span></li>
                                     </ul>
                                     <div class="accord">
                                        <h3>Tests: 85  |&#x20B9;4999</h3>
                                        <a href="#" class="book call_nw" data-toggle="modal" data-target="#basicModal" data-whatever="@number">Call Now</a>
                                     </div>
                                  </div>
                               </div>
                            </div>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
    </section>
    <!-- --------why-preventive----------------section -->
    <section class="why-preventive">
       <div class="container">
          <div class="row">
             <div class="col-sm-12 col-xs-12">
                <h3>Why Preventive Blood Tests are Needed?</h3>
                <p>At home blood tests will help you know the
                   functioning of your major body organs. These tests will help you identify and rule out issues like obesity, menstrual problems & infections.
                </p>
             </div>
          </div>
       </div>
    </section>
    <!-- =====card==section==== -->
    <section class="card-lvr">
       <div class="container">
          <div class="row">
             <div class="col-lg-4 col-sm-6 col-xs-12 pading text-center">
                <div class="card-innerbox">
                   <div class="img-txtdiv">
                      <h4><img alt="card-liver" class="img-responsive" src="/img/campaign/one.png"> PCOD/PCOS</h4>
                   </div>
                   <p> Due to unhealthy lifestyle, every woman is prone to PCOS. Identify its symptoms with the help of blood test to prevent further complications.</p>
                </div>
             </div>
             <div class="col-lg-4 col-sm-6 col-xs-12 pading text-center">
                <div class="card-innerbox">
                   <div class="img-txtdiv">
                      <h4><img alt="card-liver" class="img-responsive" src="/img/campaign/two.png"> Thyroid</h4>
                   </div>
                   <p>Risk of Thyroid is higher in women. With the help of T3, T4 and TSH test, monitor the functioning of Thyroid Gland which is responsible for the body’s metabolism.</p>
                </div>
             </div>
             <div class="col-lg-4 col-sm-6 col-xs-12 pading text-center">
                <div class="card-innerbox">
                   <div class="img-txtdiv">
                      <h4><img alt="card-liver" class="img-responsive" src="/img/campaign/three.png"> Breast Cancer</h4>
                   </div>
                   <p>With increasing age, the risk of developing breast cancer also increases. Cancer marker tests can help in the detection of potential risk.</p>
                </div>
             </div>
             <div class="col-lg-4 col-sm-6 col-xs-12 pading text-center">
                <div class="card-innerbox">
                   <div class="img-txtdiv">
                      <h4><img alt="card-liver" class="img-responsive" src="/img/campaign/four.png"> Ovarian Cancer</h4>
                   </div>
                   <p>With the help of cancer makers, detecting ovarian cancer is possible which otherwise goes undetected in its early stage.</p>
                </div>
             </div>
             <div class="col-lg-4 col-sm-6 col-xs-12 pading text-center">
                <div class="card-innerbox">
                   <div class="img-txtdiv">
                      <h4><img alt="card-liver" class="img-responsive" src="/img/campaign/five.png"> Diabetes</h4>
                   </div>
                   <p>With the help of Diabetes Test, manage your diabetes and prevent any organ damage which is often the result of high sugar levels.</p>
                </div>
             </div>
             <div class="col-lg-4 col-sm-6 col-xs-12 pading text-center">
                <div class="card-innerbox">
                   <div class="img-txtdiv">
                      <h4><img alt="card-liver" class="img-responsive" src="/img/campaign/six.png"> Vitamin D</h4>
                   </div>
                   <p>Deficiency of Vitamin D is extremely common in women. With the help of Vitamin D test, monitor your bone health.</p>
                </div>
             </div>
          </div>
       </div>
    </section>
    <!-- Our Offerings==section-start- -->
    <!-- Our Offerings==section-start- -->
    <section class="Our-Offerings">
       <div class="container">
          <h4>Our Offerings</h4>
          <div class="row">
             <div class="col-lg-3 col-sm-6 col-xs-6 paddingright-none ">
                <div class="ofr-blok border-right border-bottom">
                   <div class="sctoeimg-div">
                      <img alt="scooter.png" src="/img/campaign/scooter.png">
                   </div>
                   <p>Free Home
                      Sample Collection
                   </p>
                </div>
             </div>
             <div class="col-lg-3 col-sm-6 col-xs-6 paddingleft-none">
                <div class="ofr-blok border-bottom">
                   <div class="sctoeimg-div">
                      <img alt="scooter.png" src="/img/campaign/certified.png">
                   </div>
                   <p>Government
                      Certified Labs
                   </p>
                </div>
             </div>
             <div class="col-lg-3 col-sm-6 col-xs-6 paddingright-none">
                <div class="ofr-blok border-right">
                   <div class="sctoeimg-div">
                      <img alt="same-day.png" src="/img/campaign/same-day.png">
                   </div>
                   <p>Same Day
                      Accurate Reports
                   </p>
                </div>
             </div>
             <div class="col-lg-3 col-sm-6 col-xs-6 paddingleft-none">
                <div class="ofr-blok">
                   <div class="sctoeimg-div">
                      <img alt="quality.png" src="/img/campaign/money-back.png">
                   </div>
                   <p>Money Back
                      Guarantee
                   </p>
                </div>
             </div>
          </div>
       </div>
    </section>
    <!-- Why Healthians==section===== -->
    <section class="customer-speak">
       <div class="container">
          <h4>Trusted by 5.5m Lives</h4>
          <div class="row">
             <div class="col-xs-12">
                <div class="owl-carousel" id="testimonial-slider">
                   <div class="testimonial">
                      <div class="testimonial-review">
                         <p class="testimonial-description">Delighted by the services experienced. Collected the sample and received the reports on the same day. Hope we receive the same kind of service in future as well.</p>
                      </div>
                      <h4 class="testimonial-title">Amarnath</h4>
                      <small>Jan 27, 2019</small>
                   </div>
                   <div class="testimonial">
                      <div class="testimonial-review">
                         <p class="testimonial-description">Just got the first tests done recently and what impressed me the most was the reports. The presentation was very precise and easy to understand. The Smart Report (apart from the detailed report) is by impressive.</p>
                      </div>
                      <h4 class="testimonial-title">Parul Mehra</h4>
                      <small>16 December, 2018</small>
                   </div>
                   <div class="testimonial">
                      <div class="testimonial-review">
                         <p class="testimonial-description">Healthians is a good app for all pathology tests. Prices too are very reasonable. Sample procedure is good and timely. They always use a sealed sample collection kit. Overall satisfied.</p>
                      </div>
                      <h4 class="testimonial-title">Lakhwinder Aggarwal</h4>
                      <small>23 December, 2018</small> 
                   </div>
                </div>
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
             <div class="col-lg-6 col-xs-12 textcentr">
                <form action="/hms/accommodations" method="get">
                   <div class="input-group" href="#" data-toggle="modal" data-target="#basicModal" data-whatever="@counter">
                      <h3>Talk to Our Health Advisor</h3>
                      <input class="form-control" id="txtSearch" placeholder="Enter your 10 digit mobile number" type="text">
                      <div class="input-group-btn textcentr">
                         <a class="btn btn-primary call">Get a Free Call</a>
                      </div>
                   </div>
                </form>
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
        
    
<div class="modal fade leadmodalcallback" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="top:30%">
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
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
        $('.panel-collapse').on('show.bs.collapse', function () {
            $(this).siblings('.panel-heading').addClass('active');
        });

        $('.panel-collapse').on('hide.bs.collapse', function () {
            $(this).siblings('.panel-heading').removeClass('active');
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