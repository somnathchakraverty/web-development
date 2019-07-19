@extends('layout.master')

@section('page-content')

<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700" rel="stylesheet">
<style>
body {font-family: 'Roboto', sans-serif;font-weight: normal;background: #fbfafa !important;}
p {	font-family: 'Roboto', sans-serif;}
/*wellness program*/
header { padding: 0px;border-bottom:none; }
header.masthead{background:#00a0a8; background-size:49px 85px; position:relative;}
.wellness-main{ background:#00a0a8;}
.wellness-main .logomain{ padding:7px 0px;}
.wellness-main .caption_top{font-family: 'Roboto', sans-serif; margin:70px 0px 10px 0px;}
.wellness-main .caption_top h1{font-family: 'Roboto', sans-serif; font-size:36px; color:#fff; margin:0px;}
.wellness-main .caption_top p{font-family: 'Roboto', sans-serif; font-size:18px; color:#fff; line-height: 34px;}
.wellness-main .caption_mid{font-family: 'Roboto', sans-serif; margin:45px 0px 10px 0px;}
.wellness-main .caption_mid h2{font-family: 'Roboto', sans-serif; font-weight:normal; font-size:26px; color:#fff; margin:0px;}
.wellness-main .caption_mid p{font-family: 'Roboto', sans-serif; font-size:21px; color:#fff;}
.wellness-main .introductory{ margin:50px 0px 30px 0px; border:3px solid #fff; position:relative; display:inline-block; width:350px; height:115px;}
.wellness-main .introductory .offertitle{ background: #00a0a8; font-size: 26px; color: #fff; text-transform: uppercase; font-weight: 700; position: absolute; white-space: pre-line; top: -30px;
left: -22px; padding:20px 19px 16px 19px; line-height: 33px;}
.wellness-main .introductory .slashed_price{font-size:26px; padding-left:20px; color:#fff; bottom:0px; padding-bottom: 0px; position:absolute;}
.wellness-main .introductory .slashed_price .slashed{color: #fff; font-size: 27px !important; text-decoration: line-through; font-weight:normal;  display: inline-block;}
.wellness-main .introductory .mrp{position: absolute; font-size: 42px; color: #fffc00; font-weight: 700; right: -42px; bottom: -10px; background: #00a0a8; padding:10px 13px;}
.wellness_contact{ background:#44555b; text-align:center; color:#fff; box-shadow:0 0 10px rgba(0,0,0,.2); padding:35px 0px 50px 0px; width:100% !important; }
.wellness_contact p{ text-transform:uppercase; padding-bottom:16px; font-size: 18px; letter-spacing: 4px; }
.wellness_contact strong{ border-radius:40px; background:#00a0a8; padding:12px 50px; font-size:28px; letter-spacing:4px; border:2px solid #fff;}
.wellness_services{ padding:40px 0px;}
.wellness_services h2{ text-align:center; color:#454545; margin-bottom:3px;}
.wellness_services p{ text-align:center; font-size:16px;}
.well_serv{ margin:45px 0px 10px 0px;}
.iconclass{ text-align:center; margin-bottom:18px;}
.well_serv h3{font-size: 18px; text-align: center; letter-spacing:0.8px; height:45px; margin:0px; padding:0px 16px 35px 16px; line-height:21px;}
.well_serv p{ font-size:16px; padding:0px 5px; text-align:center;}
.wellnessimg{max-width:auto;}
.well_nopadd{}
.size-price{font-size:28px;}
.rupeeIcon{font-weight:normal; padding:0px; font-size:42px; padding-right:4px;}
/*wellness program end*/
@media (max-width: 768px) and (min-width: 20px) {
/*wellness program*/
.wellnessimg{display:block; max-width:100%;}
.wellness-main .caption_top{margin:30px 0px 10px 0px;}
.wellness-main .caption_top h1{font-size:18px !important; font-weight: 700; }
.wellness-main .caption_top p{font-family: 'Roboto', sans-serif; font-size:16px; color:#fff; line-height:24px;}
.wellness-main .introductory{ max-width:90%; height:90px; margin:30px 0px 0px 0px;}
.well_nopadd{padding:0px !important; text-align:center;}
.wellness-main .caption_mid h2{ font-size:20px; font-weight: 700;}
.wellness-main .introductory .offertitle{ text-align:left;font-size: 21px; line-height: 24px; padding:20px 10px 10px 10px;}
.wellness-main .introductory .slashed_price{ font-size:18px;}
.size-price{ font-size:16px;}
.wellness-main .introductory .slashed_price .slashed{ font-size:18px !important;}
.wellness-main .caption_mid{ margin:25px 0px 10px 0px;}
.wellness-main .introductory .mrp{ font-size:34px; padding:0px 17px;}
.wellness_contact strong{padding: 12px 24px;font-size:20px;}
.iconclass{ margin-bottom:12px;}
.feature-item{ margin-bottom:20px;}
.rupeeIcon{ font-size:34px;}
.wellness_contact{ padding:25px 0px 40px 0px;}
.well_serv h3{ height:auto; padding-bottom:10px;}
.separator{ border-bottom:1px solid #ccc; margin-bottom:15px;}
.wellness_services h2 {font-size:26px;}
/*wellness program*/
}
</style>

{!! $content !!}

<!--wellness starts here-->
{{-- <header class="masthead wellness-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 well_nopadd">
                <div class="col-lg-7 col-xs-12 col-xs-12">

                    <div class="logomain"></div>

                    <div class="caption_top">
                        <h1>Healthians Wellness Program</h1>
                        <p>From Diagnosis to Recovery</p>
                    </div>
                    <div class="caption_mid">
                        <h2>India's First Complete Health CARE Program</h2>
                    </div>
                    <div class="introductory">
                        <div class="offertitle">Introductory offer
                        </div>
                        <div class="slashed_price" style="font-weight:normal;">Price : <span class="rupeesign size-price" style="font-weight:normal; padding:0px; padding-right:4px;">₹</span>
                            <p class="slashed">999/</p>
                        </div>
                        <div class="mrp"><span class="rupeesign rupeeIcon">₹</span>499/-</div>
                    </div>
                </div>
                <div class="col-lg-5"><img src="/img/yuvi-wellness.png" class="wellnessimg" /></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</header>

<div class="clear"></div>
<div class="wellness_contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p>For Booking An Order or Any Query</p>
                <strong>999-888-000-5</strong> </div>
        </div>
    </div>
</div>
<div class="container wellness_services">
    <div class="row">
        <div class="col-lg-12">
            <h2 style="text-transform:uppercase; letter-spacing:1px;">What is in here for you?</h2>
            <p>Customized 'POST TEST' Wellness Program for a Healthier YOU!</p>
            <div class="col-lg-12 well_serv">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="feature-item">
                                <div class="iconclass"><img src="/img/wellness_guide_book.png" /></div>
                                <h3>Comprehensive<br />Guide Book</h3>
                                <p class="text-muted">Manage your health better</p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="feature-item">
                                <div class="iconclass"><img src="/img/doc_consultation.png" /></div>
                                <h3>Doctor<br />Consultation</h3>
                                <p class="text-muted">Know your health status better</p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="feature-item">
                                <div class="iconclass"><img src="/img/diet_customize.png" /></div>
                                <h3>Customized Diet<br />Plan for 4 weeks</h3>
                                <p class="text-muted">Post doctor consultation</p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="feature-item">
                                <div class="iconclass"><img src="/img/lifestyle_icon.png" /></div>
                                <h3>Complimentary Follow-up<br /> with Dietician</h3>
                                <p class="text-muted">Clear all your doubts regarding your diet plan</p>
                            </div>
                        </div>
                        <div class="clear" style="height:50px;"></div>
                        <div class="col-lg-3">
                            <div class="feature-item">
                                <div class="iconclass"><img src="/img/health_karma.png" /></div>
                                <h3>Your Health<br />Karma</h3>
                                <p class="text-muted">Score your lifestyle & know your risk areas</p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="feature-item">
                                <div class="iconclass"><img src="/img/lifestyle_icon.png" /></div>
                                <h3>Future Roadmap & <br /> Lifestyle guidance</h3>
                                <p class="text-muted">What you should do & what should be avoided</p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="feature-item">
                                <div class="iconclass"><img src="/img/wisdom_words.png" /></div>
                                <h3>Words of<br />Wisdom</h3>
                                <p class="text-muted">Expert advice on required investigations & consultations</p>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="feature-item">
                                <div class="iconclass"><img src="/img/health_track.png" /></div>
                                <h3>Health<br />Tracker</h3>
                                <p class="text-muted">Keep a track of your basic vitals Weight, BP, Sugar, Medicines etc.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="clear" style="height:30px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

@endsection

@push('footer-scripts')
@endpush