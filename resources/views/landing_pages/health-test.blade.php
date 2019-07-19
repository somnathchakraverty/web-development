@extends('layout.landing_master')

@section('page-content')
    <!--header section starts here -->
    <header class="campaign-header-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="midpanel">
                        <!--logo starts -->
                        <div class="logo-panel">
                            <div class="main-logo"><img src="/img/campaign/healthians-logo-campaign.png" /></div>
                            <div class="contactRight">Call us<span> <a id="ht_number" href="tel:999-082-650-0" onclick="pushGaEvent('Health-Test', 'Clicked Telephone No.')" style="text-decoration: none;"><img src="/img/campaign/call_icon.png" class="callImage" />999-082-650-0</span></a></div>
                            <div class="clear"></div>
                        </div>
                        <!--logo ends -->
                        <div class="clear"></div>
                        <div class="content-panel">
                            <div class="col-sm-12">
                                <div class="col-sm-7">
                                    <div class="package-info">
                                        <h1>{!! $display_name !!}</h1>
                                        <h2>{!! $display_order_price !!}</h2>
                                        <img src="{{$display_image}}" />
                                        <div class="infonew">
                                            <ul ng-repeat="item in display_data">
                                                @foreach($display_data as $item)
                                                    <h6>{!! $item['headline'] !!}</h6>
                                                    @foreach($item['data'] as $t)
                                                        <li> {!! $t !!}</li>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5 text-right">
                                    <div class="form-campaign-new">
                                        <h2>Talk to our Health Advisor!</h2>
                                        <p>Fill out the form below and get a call back from our health advisor </p>
                                        @include('landing_pages.callback_form')
                                        <input type="hidden" name="ga_category" id="ga_category" value="{{$ga_category}}">                              
                                    </div>
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
    <!--why healthians -->
    <div class="our-achievment-new">
        <div class="container">
            <div class="row">
                <div class="col-sm-12" style="text-align:center;">
                    <h1 class="mt45">Why only Healthians?</h1>
                    <div class="clear"></div>
                    <div class="col-sm-3">
                        <div class="uspdetail">
                            <div><img class="lazy" data-src="/img/campaign/home_sample_icon.png" /></div>
                            <h4>FREE SAMPLE PICKUP</h4>
                            <p>Cost free sample pickup from Home or Office. </p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="uspdetail">
                            <div><img class="lazy" data-src="/img/campaign/rightprices_icon.png" /></div>
                            <h4>HONEST PRICES</h4>
                            <p>Say NO to cuts & commissions.</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="uspdetail">
                            <div><img class="lazy" data-src="/img/campaign/healthcounselling_icon.png" /></div>
                            <h4>FREE HEALTH COUNSELLING</h4>
                            <p>Professional consultation.</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="uspdetail">
                            <div><img class="lazy" data-src="/img/campaign/accuracy_icon.png" /></div>
                            <h4>GUARANTEED ACCURACY</h4>
                            <p>Money back guarantee on accuracy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--why healthians ends -->
    <div class="our-achievment-new">
        <div class="container">
            <div class="row">
                <div class="col-sm-12" style="text-align:center;">
                    <h1>
                        <img class="lazy" data-src="/img/campaign/star1.png" />
                        <img class="lazy" data-src="/img/campaign/star1.png" />&nbsp;&nbsp;Our Achievements&nbsp;&nbsp;
                        <img class="lazy" data-src="/img/campaign/star1.png" />
                        <img class="lazy" data-src="/img/campaign/star1.png" />
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
    <div class="clear"></div>
    <div class="our-trust">
        <div class="container-fluid">
            <h1 class="mt45"> Trusted by Employees of </h1>
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
        <div class="container-fluid">
            <h1 class="mt45"> In the media </h1>
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
    <!--sticky form -->
    <div class="sticky-bottom cms-campaign">
        @include('landing_pages.callback_form_mobile')
        <input type="hidden" name="ga_mobile_category" id="ga_mobile_category" value="{{$ga_mobile_category}}">
    </div>

@endsection

@push('footer-scripts')
    <script src="/js/landing_page.js"></script>
    <footer></footer>
@endpush