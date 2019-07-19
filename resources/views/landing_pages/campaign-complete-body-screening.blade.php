@extends('layout.landing_master')

@push('header-scripts')
<link href="/css/t2/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Ubuntu:300,300i,400,400i,500,500i,700,700i|Hind:400" rel="stylesheet">
@endpush

@section('page-content')
<style>
.mand_field_text {display: none;}
.close {opacity:1;}
label.error {font-size: 12px !important;}
.field-form {margin: 15px 0px 22px 0px;display: block;width: 100%;font-size: 16px!important;color: #555;background-color: #fff;background-image: none;border-radius: 0px;font-family: 'Lato', sans-serif;}
.field-button { margin: 0px;}
.minimal {height: 41px;display: block;width: 100%;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius:0px;-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;-o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;}
#landing_desktop{ box-shadow:-2px 3px 4px -1px rgba(0,0,0,.18); display:inline-block;  border: 1px solid #e1530d; display:inline-block; background:#e1530d; background-image: -ms-linear-gradient(top, #ff7632 0%, #e1530d 100%); background-image: -moz-linear-gradient(top, #ff7632 0%, #00888E 100%); background-image: -o-linear-gradient(top, #ff7632 0%, #e1530d 100%);background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #e1530d), color-stop(100, #e1530d));background-image: -webkit-linear-gradient(top, #ff7632 0%, #e1530d 100%); background-image: linear-gradient(to bottom, #ff7632 0%, #e1530d 100%);color:#fff; font-size:18px; border-radius:20px; letter-spacing:0.4px;font-family: 'Lato', sans-serif; padding:9px 25px; font-weight:700; text-transform:uppercase;}
.anchorLink { text-decoration: none !important; }
/*complete screening package*/
.healthcheck_top_header{ box-shadow:0px 2px 4px #CCC; background:#fff;}
.healthcheck_top_header .fluid-container{ max-width:90%; margin:0px auto;}
.healthcheck_top_header .call_us{ line-height:24px; margin-top:15px;font-family: 'Lato', sans-serif; float:right;font-size:18px; color:#df1e3d; display:inline-block;}
.healthcheck_top_header .call_us span{ color:#616161; font-size:42px; font-weight:700;}
.healthcheck_top_header .call_us p{font-family: 'Lato', sans-serif; margin:0px; padding:0px 0px 9px 0px;text-align:right;}
.healthcheck_top_header .top_logo{display:inline-block;padding: 7px 0px 15px 0px;}
.healthcheck_top_header .topcall_us{ margin-top:0px; display:inline-block; float:right; width:58%; vertical-align:top;}

.expandedcities{ font-size:16px; max-width:1200px; margin:0px auto;padding: 0px 10px 0px 10px;}
.expandedcities div{font-family: 'Lato', sans-serif; color:#535353; font-size:22px; padding:15px 0px; text-align:center;}

.healthcheck_page_header{ background:url(/img/campaign/web_family_banner.jpg) no-repeat center top; height:592px;position:relative;}
.healthcheck_page_header .midwrapper{ width:1200px; margin:0px auto;}
.healthcheck_page_header .midwrapper .header_caption{font-family: 'Lato', sans-serif; color:#fff; padding:35px 40px; display:inline-block;}
.healthcheck_page_header .midwrapper .header_caption h4{ font-family: 'Lato', sans-serif;font-size:32px;text-transform:uppercase; margin:0px; letter-spacing:1px; }
.healthcheck_page_header .midwrapper .header_caption h3{font-family: 'Lato', sans-serif; margin:0px;font-size:43px;text-transform:uppercase; font-weight:700;}
.healthcheck_page_header .midwrapper .formBlocks{ float:right; margin:70px 0px 0px 0px;font-size:32px; color:#fff;}
.healthcheck_page_header .midwrapper .formBlocks h1{font-size:32px; color:#fff;font-family: 'Lato', sans-serif; padding:20px 0px 15px 0px; margin:0px;}
.healthcheck_page_header .midwrapper .formBlocks h1 span{font-size:40px; color:#fff; }
.healthcheck_page_header .midwrapper .formBlocks h1 span .fa-inr{ font-size:12px; font-weight:normal;}
.healthcheck_page_header .midwrapper .formBlocks .formcontainer{ background:rgba(0,103,108,0.9);padding:0px 15px 10px 30px; border-radius:20px 0px 0px 20px; }
.healthcheck_page_header .midwrapper .formBlocks .formcontainer .mainFormBlock{ margin-right:0px;}
.healthcheck_page_header .midwrapper .formBlocks .formcontainer .mainFormBlock ul{ margin:0px; padding:0px; list-style:none;}
.healthcheck_page_header .midwrapper .formBlocks .formcontainer .mainFormBlock ul li{ display:block; width:90%;}
.healthcheck_page_header .midwrapper .formBlocks .formcontainer .mainFormBlock ul li .form-field{ margin:5px 0 15px;}
.healthcheck_page_header .midwrapper .formBlocks .formcontainer .mainFormBlock ul li .form-field input{display: block; width: 100%; height:38px; font-size: 16px!important; padding:7px 12px 7px 12px;
color: #555; background-color: #fff;background-image: none;border: 1px solid #fff; border-radius:0px;font-family: 'Lato', sans-serif;}
.healthcheck_page_header .midwrapper .formBlocks .formcontainer .mainFormBlock ul li .form-ctabtn{margin:15px 0 10px;}
.healthcheck_page_header .midwrapper .formBlocks .formcontainer .mainFormBlock ul li .form-ctabtn .ctabutton{ box-shadow:-2px 3px 4px -1px rgba(0,0,0,.18); display:inline-block;  border: 1px solid #e1530d; display:inline-block; background:#e1530d; background-image: -ms-linear-gradient(top, #ff7632 0%, #e1530d 100%); background-image: -moz-linear-gradient(top, #ff7632 0%, #00888E 100%); background-image: -o-linear-gradient(top, #ff7632 0%, #e1530d 100%);background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #e1530d), color-stop(100, #e1530d));background-image: -webkit-linear-gradient(top, #ff7632 0%, #e1530d 100%); background-image: linear-gradient(to bottom, #ff7632 0%, #e1530d 100%);color:#fff; font-size:18px; border-radius:20px; letter-spacing:0.4px;font-family: 'Lato', sans-serif; padding:9px 25px; font-weight:700; text-transform:uppercase;}
.healthcheck_page_header .midwrapper .formBlocks .formcontainer .mainFormBlock ul li .form-ctabtn .ctabutton:hover{}

.healthcheck_productpanel{ width:auto; display:block; padding:30px 0px;}
.healthcheck_productpanel .container{width: 1200px; margin:0px auto; padding:0px;}
.healthcheck_productpanel .producttitle{ margin:0px auto; padding-bottom:75px; text-align:center;position:relative;}
.healthcheck_productpanel .producttitle::before{ border-top:4px solid #3f3f3f; content:""; position:absolute; top:18px; z-index:-1;width:725px; margin:0px auto; left:0px; right:0px;}
.healthcheck_productpanel .producttitle h2{display:inline; font-family: 'Lato', sans-serif; background: #00676c; border-radius:30px; font-size:30px; padding:10px 45px; color:#fff;}
.healthcheck_productpanel .productThumb{ background:#fff; border:1px solid #1d3047; -webkit-box-shadow: 0px 0px 30px -44px rgba(0,0,0,1);-moz-box-shadow: 0px 0px 30px -44px rgba(0,0,0,1);
box-shadow: 0px 0px 30px -44px rgba(0,0,0,1); border-radius:15px; overflow:hidden; min-height:410px; -webkit-box-shadow: 0px -1px 63px -22px rgba(0,0,0,0.75);
-moz-box-shadow: 0px -1px 63px -22px rgba(0,0,0,0.75);
box-shadow: 0px -1px 63px -22px rgba(0,0,0,0.75);}
.healthcheck_productpanel .productThumb h4{font-family: 'Lato', sans-serif;background:#00676c;letter-spacing:0px;color:#fff;font-size:26px;min-height:90px;text-align:center;padding:10px 18px;display:flex;justify-content:center;align-items:center;margin:0px;} 
.healthcheck_productpanel .productThumb .testBrief{ padding:15px 15px 25px 15px;}
.healthcheck_productpanel .productThumb .testBrief .testInclude{ font-size:21px;font-family: 'Lato', sans-serif; color:#353535; margin:0px; padding:0px;}
.healthcheck_productpanel .productThumb .testBrief .fastingTime{ font-size:14px;font-family: 'Lato', sans-serif; letter-spacing:-0.25px; color:#353535; margin:0px; padding:0px;}
.healthcheck_productpanel .productThumb .testParameter{ font-size:14px;font-family: 'Lato', sans-serif; display:inline-block; min-height:135px;}
.healthcheck_productpanel .productThumb .testParameter ul{ margin:0px; padding:0px 16px;}
.healthcheck_productpanel .productThumb .testParameter ul li{ font-size:15px; font-weight:500; display:inline-block; letter-spacing:-0.60px; width:49%; padding-right:9px; background:url(/img/campaign/dotted_circle_black.png) no-repeat left 4px; line-height:17px;font-family: 'Lato', sans-serif; padding-bottom:6px; padding-left:12px;vertical-align:top;}
.healthcheck_productpanel .productThumb .pricingsection{ padding:20px 15px 20px 15px;}
.healthcheck_productpanel .productThumb .pricingsection .leftPrice{ font-family: 'Lato', sans-serif;display:inline-block; max-width:48%;}
.healthcheck_productpanel .productThumb .pricingsection .leftPrice span{ color:#333; font-size:20px; letter-spacing:-0.9px;}
.healthcheck_productpanel .productThumb .pricingsection .mainPrice{font-size: 38px;line-height:29px;}
.healthcheck_productpanel .productThumb .pricingsection .mainPrice span{ font-size:36px;}
.healthcheck_productpanel .productThumb .pricingsection .rightBook{ text-align:right; margin:8px 0px 15px 0px; display:inline-block; float:right;width:50%;}
.healthcheck_productpanel .productThumb .pricingsection .rightBook a{ white-space:nowrap;box-shadow:-2px 3px 4px -1px rgba(0,0,0,.18); display:inline-block;  border: 1px solid #e1530d; display:inline-block; background:#e1530d; background-image: -ms-linear-gradient(top, #ff7632 0%, #e1530d 100%); background-image: -moz-linear-gradient(top, #ff7632 0%, #00888E 100%); background-image: -o-linear-gradient(top, #ff7632 0%, #e1530d 100%);background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #e1530d), color-stop(100, #e1530d));background-image: -webkit-linear-gradient(top, #ff7632 0%, #e1530d 100%); background-image: linear-gradient(to bottom, #ff7632 0%, #e1530d 100%);color:#fff; font-size:18px; text-transform:uppercase; border-radius:30px; letter-spacing:0.4px;font-family: 'Lato', sans-serif; padding:10px 24px;}
.healthcheck_productpanel .productThumb .pricingsection .rightBook a{ letter-spacing:0px;}
.proThumb{display: inline-block; vertical-align: top; margin-right:15px; margin-bottom:40px; width:365px; margin-left:15px;}
.healthcheck_page_header .midwrapper .formBlocks ul li .form-field select{ font-family: 'Lato', sans-serif;background:url(/assets/images/campaign/bg-select.png) repeat-x center top #f2f2f2; width:330px; color:#a4a2a2; border:1px solid #fff; font-size:16px; padding:8px 10px;}
.healthcheck_page_header .midwrapper .formBlocks ul li .form-field select{-webkit-appearance: none; -moz-appearance: none; appearance: none;}
.healthcheck_page_header .midwrapper .formBlocks ul li .form-field select.minimal {font-size:16px; background:#fff; padding:7px 12px; background-image:url(/assets/images/campaign/arrow-bottom.png); background-position:95% center;  background-repeat: no-repeat; box-shadow:inset 0px 0px 10px rgba(160,160,160,0.4) !important; vertical-align:top; width:100%;}
.healthcheck_page_header .midwrapper .formBlocks ul li .form-field.minimal:focus { background-image:url(/assets/images/campaign/arrow-top.png); background-position:95% center; background-repeat: no-repeat; border-color:#00a0a8; outline: 0;}
.healthcheck_page_header .midwrapper .formBlocks ul li .form-field:-moz-focusring {color: transparent;text-shadow: 0 0 0 #000;}
/*complete screening package ends*/
.footerlinks-div {padding: 30px 0;width: 100%;float: left;background: #f7f7f7;}
.footerlinks-div h4 {font-size: 20px;color: #009fa9;text-align: center;padding-bottom: 15px;}
.footerlinks-div img {margin: 30px auto 0;display: block;}
.footerlinks-div ul {list-style: none;padding-top: 0;text-align: center}
.footerlinks-div ul li {display: inline-block;padding-right: 10px; border-left: 1px solid #888;padding-left: 10px;margin-top: 10px;}
ul li:first-child { border-left: none;}
.footerlinks-div ul li a {color: #717171;font-size: 14px;font-size: 16px;}
.copyright-sectiondiv p, .footerlinks-div p, .last-footer p {font-size: 14px;text-align: center;}
.footerlinks-div p {line-height: 25px;color: #414143;padding-top: 20px}
.copyright-sectiondiv p {padding: 10px;background-color: #009fa8;width: 100%;float: left;color: #fff}
.border-right {border-right: none}
.last-footer {width: 100%;float: left;position: relative}
.last-footer p {color: #414143}

@media only screen and (max-width: 480px) {
/*complete screening*/
.healthcheck_top_header .fluid-container{ max-width:95%; box-shadow:none;}
.healthcheck_page_header{background-size: cover; max-width:95%; margin:0px auto; height:100%;     background-size: 100%;}
.healthcheck_page_header .midwrapper{ max-width:100%;}
.proThumb{ max-width:100%; margin-right:0px; margin-bottom:20px; margin-left:0px;}
.healthcheck_top_header .top_logo{ display:inline-block; float:none; width:40%;}
.healthcheck_top_header .top_logo img{ max-width:100%;}
.healthcheck_top_header .topcall_us{ float:none; display:inline-block; margin-top:0px;}
.healthcheck_top_header .call_us p { margin: 0px; padding: 0px 0px 5px 0px; text-align: right; display: block; width: 100%;}
.healthcheck_page_header .midwrapper .header_caption{ display:block; padding:10px;}
.healthcheck_page_header .midwrapper .header_caption h4{ font-size:16px; text-align:center;}
.healthcheck_page_header .midwrapper .header_caption h3{ font-size:24px; text-align:center;}
.healthcheck_page_header .midwrapper .formBlocks{ float:none; margin:105px 0px 0px 0px;}
.healthcheck_page_header .midwrapper .formBlocks .formcontainer{ border-radius:0px; padding:10px 0px;}
.expandedcities {font-size: 13px;  padding: 15px 10px;}
.healthcheck_productpanel .productThumb .pricingsection .leftPrice span{ font-size:14px;}
.healthcheck_productpanel .productThumb .pricingsection .mainPrice span{ font-size:24px;}
.call_us{ display:block; float:none;}
.call_us p{text-align: right;font-size:13px;display:inline-block;line-height:12px; width:30%;margin-left:14%;}
.healthcheck_top_header .call_us span{ font-size:20px; font-family: 'Lato', sans-serif; line-height: 25px; padding-left: 8px; vertical-align:top; text-align:left;display:inline-block;}
.healthcheck_page_header .midwrapper .formBlocks h1{ padding:0px; font-size:24px; text-align:center;}
.healthcheck_page_header .midwrapper .formBlocks h1 span{ padding:0px; font-size:30px; text-align:center;}
.healthcheck_productpanel .productThumb{border-radius:25px;min-height:auto;}
	
.healthcheck_productpanel{ max-width:95%; margin:0px auto; padding:10px 0px;}
.healthcheck_productpanel .productThumb .testParameter{ min-height:135px;}
.healthcheck_productpanel .productThumb .testParameter ul li{width: 49%; font-size: 14px; vertical-align: top; line-height:18px; padding-bottom:6px;}
.healthcheck_productpanel .productThumb h4{ font-size:22px; min-height:70px;}
.healthcheck_productpanel .container{ width:100%;}
	
.healthcheck_page_header .midwrapper .formBlocks .formcontainer .mainFormBlock{ padding:10px 20px;}
.healthcheck_page_header .midwrapper .formBlocks .formcontainer .mainFormBlock ul li .form-ctabtn{ text-align:center;}
.healthcheck_productpanel .productThumb .pricingsection .leftPrice{ max-width:45%;}
.healthcheck_productpanel .productThumb .pricingsection .rightBook{ max-width:55%;}
.healthcheck_productpanel .productThumb .pricingsection .rightBook a{padding:10px 24px; font-size:24px; white-space: nowrap;}
.healthcheck_productpanel .productThumb .pricingsection .mainPrice{ font-size:36px;}
.healthcheck_productpanel .productThumb .pricingsection .leftPrice .mrpTest{ font-size:16px;}
.healthcheck_productpanel .producttitle::before{ position:relative;}
.healthcheck_productpanel .producttitle h2{ font-size:22px; padding:18px 0px; color:#333; background:none; border:none;}
.healthcheck_productpanel .producttitle{    padding-bottom: 20px; padding-top: 10px;}
.healthcheck_page_header .midwrapper .formBlocks ul li .form-field select{ width:100%;}

.finalstatistic .blockScore .scorerightcontent{display:block; width:100%;}
.healthcheck_productpanel .productThumb .pricingsection .rightBook a{padding:10px 24px; font-size:18px;}
/*complete screening ends*/
}
.basicModal {z-index: 9999 !important;}
@media (max-width: 768px) and (min-width: 20px) {
    .field-form input {
        height: 37px;
    }
    .field-form input.user-icon {background : url(/img/campaign/user-icon.png) no-repeat 16px 9px !important;}
    .field-form input.mob-icon {background: url(/img/campaign/mob-icon.png) no-repeat 16px 9px !important;}
}
</style>

<!--Top Header -->
<div class="healthcheck_top_header">
    <div class="fluid-container">
        <a name="myAnchor" id="myAnchor">
            <div class="top_logo"> <a href="javascript:void(0);"><img src="/img/healthians_logo.png"></a>
            </div>
        </a>
        <div class="topcall_us">
            <a class="call_us" href="javascript:void(0);" style="text-decoration: none;">
                <p>Talk our Health advisors</p>
                <span>999 888 000 5</span>
            </a>
        </div>
    </div>
    <div class="clear"></div>
</div>


<!-- Page Header -->
<header class="healthcheck_page_header">
    <div class="midwrapper">
        <div class="header_caption">
            <h4>A Happy Family Begins with</h4>
            <h3>A Healthy Family.</h3>
        </div>
        <div class="formBlocks">
            <div class="formcontainer" id="getaQuote">
                <h1>Complete Body Screening <br>
                <span>Starting @ <span class="fontrupee">₹</span>949</span></h1>
                <div class="clear"></div>
                <div class="mainFormBlock">
                    @include('landing_pages.callback_form')
                    <input type="hidden" name="ga_category" id="ga_category" value="{{$ga_category}}">
                </div>
            </div>
        </div>
    </div>
</header>

<!--Cities -->
<div class="expandedcities">
    <p>{!! $city_html !!}</p>
</div>
    
<div class="clear"></div>

<div class="healthcheck_productpanel" id="healthcheck_productpanel">
    <div class="container" id="pkg_cont">
        
    </div>
</div>

<section class="footerlinks-div">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-4">
                <a href="javascript:void(0);">
                    <img class="btm-logo-site" style="max-width:100%;" src="https://cdn1.healthians.com/assets/images/healthians_logo.png">
                </a> 
            </div>
            <div class="col-lg-8 col-sm-12">
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


@endsection

@push('footer-scripts')
	
    <script type="text/javascript">
        function bookNow(clicked_pkg) {
            if($("#message").length == 0) {
                $("#addLeadForm").append('<input type="hidden" name="message" id="message" value="Customer search for '+clicked_pkg+'" />');
            }
            else {
                $("#message").val('Customer search for '+clicked_pkg);
            }
            
            $('#name').animate({
                scrollTop: 0
            },50);

            $("#name").focus();
        }

        function popularPkgSuccessHandler(response) {
            $("#ajax-loader").hide();
            var pkg_list_html = '';
            if(response.status) {
                if(response.data.length > 0) {
                    pkg_list_html = '<div class="producttitle">\
                                    <h2>Our Health Checkup Packages</h2>\
                                </div>\
                                <div class="clear"></div>';
                    response.data.forEach(function(item){
                        pkg_list_html += '<div class="proThumb">\
                            <div class="productThumb">';
                        
                        pkg_list_html += '<h4>'+item.product_name+'</h4>';
                        pkg_list_html += '<div class="testBrief">';
                        pkg_list_html += '<p class="testInclude">Tests Included : '+item.test_count+'</p>';
                        pkg_list_html += '<p class="fastingTime">Fasting Time: ';
                        
                        if(item.fasting_time > 0) {
                            pkg_list_html += item.fasting_time + ' Hours &nbsp;&nbsp;&nbsp;';
                        }

                        if(item.fasting_time == 0) {
                            pkg_list_html += 'Not required &nbsp;&nbsp;&nbsp;';
                        }
                        
                        pkg_list_html += '| &nbsp;&nbsp;&nbsp;Reporting Time: '+ item.reporting_time +' Hours</p>';
                        pkg_list_html += '</div>';

                        if(item.test_includes.length > 0) {
                            pkg_list_html += '<div class="testParameter"><ul>';
                            var temp_count = 0;
                            item.test_includes.forEach(function(inc){
                                if(temp_count < 6) {
                                    pkg_list_html += '<li>'+inc.test_name+'</li>';
                                }                              
                                temp_count += 1;
                            });                                   
                            
                            pkg_list_html += '</ul></div>';
                        }
                        pkg_list_html += '<div class="clear"></div>';
                        pkg_list_html += '<div class="pricingsection"><div class="leftPrice"><span class="mrpTest">Price: <strike>';
                        pkg_list_html += '<span class="fontrupee">₹</span>'+item.actual_price;
                        pkg_list_html += '</strike></span><div class="mainPrice">';
                        pkg_list_html += '<span class="fontrupee">₹</span>'+item.healthian_price;
                        pkg_list_html += '</div>\
                                    </div>\
                                    <div class="rightBook"><a href="javascript:void(0)" onClick="bookNow(\''+item.product_name+'\');" rel="" id="anchor1" class="anchorLink">Get a call</a></div>\
                                </div>\
                                <div class="clear"></div>\
                            </div>\
                        </div>';
                    });
                }
                else {
                    $("#healthcheck_productpanel").hide();
                }
            }
            else {
                $("#healthcheck_productpanel").hide();
            }

            $("#pkg_cont").html(pkg_list_html);
        }

        function popularPkgErrorHandler(response) {
            $("#ajax-loader").hide();
            $("#healthcheck_productpanel").hide();
        }

        $(document).ready(function(){
            $("#city option").each(function(){
                if ($(this).text().toLowerCase() == "gurgaon") {
                    $(this).attr("selected","selected");
                    getPopularPackage();
                }                    
            });

            $("#city").change(function(){
                getPopularPackage();
            });
        });
    </script>
    <script src="/js/landing_page.js"></script>
    <footer></footer>
@endpush