@extends('layout.master')

@section('page-content')

    <!-- stiky header -->
    {{-- <section class="product-stiky-header" id="myHeader">
        <div class="container productdetailstyle">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">                   

                    <div class="alert alert-danger hidden" id="error-msg">
                        <span></span>
                    </div>
                    <form action="{{url('callBackLead')}}" id="get_a_call_back" name="get_a_call_back" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Name*">
                        </div>
                        <div class="form-group">
                            <input type="tel" id="contact_no" name="contact_no" minlength="10" maxlength="10" class="form-control form-second" placeholder="Mobile Number">
                        </div>
                        <input type="hidden" name="utm_id" id="utm_id" value="">
                        <input type="hidden" name="source" value="web">                        
                        <button type="submit" class="btn btn-danger get-btn" onClick="validateGetCallBack();">Get A Call Back</button>

                    </form>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <ul>
                        <li>Free Sample Pickup</li>
                        <li>Free Health Counselling</li>
                        <li>NABL Accredited Labs</li>
                    </ul>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Product Detail -->
    <section class="cart-section">
        <div class="container">
            <div class="blog-breadcumbs">
                <ul>
                    <li>
                        <a href="/">Home</a>
                    </li>
                    @if($logged_user['ptype'] == 'package')
                    <li>
                        <a href="{{route('product.city-package-list', ['city'   =>  $city_name])}}">Health Packages in {{ucfirst($city)}}</a>
                    </li>
                    @endif
                    <li class="breadcumbs-active">
                        <a href="javascript:void(0);" >{!! $product_detail['name'] !!}</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="cart-div deal_detail">
                        <div class="step-div cart-sec">
                            <div class="col-md-6">
                                <h1 id="product_name">{!! $product_detail['name'] !!}</h1>
                                <p class="parameterinc"> Parameters Included: <b>{{ $product_detail['parameter_included'] }}</b></p>
                            </div>

                            <div class="col-md-6 text-right hpriceright">
                                @if($product_detail['mrp'] > 0)
                                    <div class="price">Healthians Price: <span class="rupeesign">₹</span> <strike>{{ $product_detail['mrp'] }}</strike></div>
                                    <h2 class="ltoffer">Limited Time Offer: <span class="rupeesign">₹</span> {{ $product_detail['healthians_price'] }}/-</h2>
                                    <div class="discount">Save {{ calPer($product_detail['healthians_price'], $product_detail['mrp']) }}%</div>
                                @endif
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="pro-content-area prodcontentarea">
                            <div class="col-md-6">
                                <p class="metaFooterToggleLink">
                                    {!! $product_detail['description'] !!} 
                                    <span class="moreellipses">...&nbsp;</span>&nbsp;&nbsp;
                                    <a href="javascript:void(0)" class="morelink">Read more ></a>
                                </p>
                                {{-- <p class="usecode">To book this package for 2 people, <span>USE CODE OP1999</span></p> --}}

                            </div>
                            <div class="col-md-6">
                                <h4 class="black">Recommended for</h4>	
                                <div class="recommend">
                                    <?php 
                                        $gender = preg_replace("/\s/", '', $product_detail['gender']);
                                        $gender = explode(',', $gender);
                                    ?>

                                    @if(in_array("Male",$gender))
                                        <span><img src="/img/male.png"> Male</span>
                                    @endif
                                    @if(in_array("Female",$gender))
                                        <span><img src="/img/female.png"> Female</span>
                                    @endif
                                    @if(is_array($product_detail['age_group']))
                                        @if(array_key_exists(0,$product_detail['age_group']))
                                            <span><img src="/img/calender-icon.png"> {{ $product_detail['age_group'][0] }} Years</span>	
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 contentproduct">
                                <div class="metafooterstyle">
                                    <p class="metaFooterLink hidden"> 
                                        {!! $product_detail['meta_footer'] !!} 
                                        <span></span>&nbsp;&nbsp;<a href="javascript:void(0)" class="lesslink">Read less</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="gray-band">
                          	  <span><img src="/img/reporttime_icon.png"> Reporting Time: <b>{{ $product_detail['reporting_time'] }} Hours</b></span>	  <span><img src="/img/fasting_icon.png"> Fasting Time: <b>{{ $product_detail['fasting_time'] }} Hours</b></span>

                            <div class="right-button"><a href="javascript:void(0);" class="btn btn-default" id="view_precautions">View more precautions<span class="caret"></span></a></div>
                        </div>
                        <span class="clearfix"></span>
                        @if($product_detail['healthians_price'] > 0)
                            <div class="col-md-12 detailbtm_book mobextraspc">
                                <ul>
                                    <li>
                                        <a class="btn btn-danger booknow-package" data-testid="{{ $product_detail['testId'] }}" href="javascript:void(0);" onclick="pushGaEvent('{{$product_detail['deal_type']}}', 'Clicked on Book Now', 'Bottom book - {{$product_detail['name']}}')">Book Now <img src="/img/left-icon-sml.png" class="images"></a>
                                    </li>
                                    <li>
                                        <a data-toggle="modal" data-target="#getACallBackModal" class="btn btn-default getcallbackprdtl" onclick="pushGaEvent('{{$product_detail['deal_type']}}', 'Click on Get a Call Back', '{{$product_detail['name']}}')">Get a Call Back</a>
                                    </li>
                                </ul>
                                <div class="payathome">You can also pay at home</div>
                                
                            </div>	
                        @endif
                    </div>

                    <!-- Test Details -->
                    @if($product_detail['parameter_included'] > 1)
                        <div class="detail-div">
                            <h3 class="title">Test Details (Parameters included : {{ $product_detail['parameter_included'] }})</h3>
                            <div class="green-band">
                                <div class="col-md-5 col-xs-6" style="padding:0px;">Profile/Parameter	</div>
                                <div class="col-md-7 col-xs-6">No. of Parameters</div>
                            </div>  		
                            <div class="accordion-option">

                            </div>
                            <div class="clearfix"></div>
                            <div class="panel-group accordionpanel" id="accordion" role="tablist" aria-multiselectable="true">
                              
                                @php( $accordian_array = \Config('constants.collapse_array'))
                                @php( $i = 0 )
                                @foreach($product_detail['tests'] as $test)
                                  <div class="panel panel-default">
                                      <div class="panel-heading" role="tab" id="heading{{$accordian_array[$i]}}">
                                          <h4 class="panel-title">
                                              @if(isset($test['tests']))
                                                <a role="button" onclick="pushGaEvent('{{$product_detail['deal_type']}}', 'Clicked on accordian', '{{$test['name']}}')" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$accordian_array[$i]}}" aria-expanded="false" aria-controls="collapse{{$accordian_array[$i]}}">
                                                    <div class="col-width">{{ $test['name'] }}</div>
                                                    @if(isset($test['tests']))
                                                        <div class="col-width">{{ count($test['tests']) }}</div>
                                                    @else
                                                        <div class="col-width">1</div>
                                                    @endif
                                                </a>
                                              @else
                                              <a href="<?php echo route("product.{$test['deal_type']}-detail", [   
                                                                    'city'          =>  $city_name,
                                                                    'link_rewrite'  =>  $test['link_rewrite'] 
                                                                ]
                                            ) ?>">
                                                <span onclick="pushGaEvent('{{$product_detail['deal_type']}}', 'Clicked on accordian', '{{$test['name']}}')" >
                                                    <div class="col-width">{{ $test['name'] }}</div>
                                                    <div class="col-width">1</div>
                                                </span>
                                              </a>
                                              @endif
                                          </h4>
                                      </div>
                                      @if(isset($test['tests']))
                                          <div id="collapse{{$accordian_array[$i]}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$accordian_array[$i]}}">
                                              <div class="panel-body parameterlist">
                                                  @foreach($test['tests'] as $parameter)
                                                    <a href="<?php echo route("product.{$parameter['deal_type']}-detail", [   
                                                                    'city'          =>  $city_name,
                                                                    'link_rewrite'  =>  $parameter['link_rewrite'] 
                                                                ]
                                                            ) ?>">
                                                        <p>{{ $parameter['name'] }}</p>
                                                    </a>
                                                  @endforeach
                                              </div>
                                          </div>
                                      @endif
                                  </div>
                                  @php( $i++ )
                                @endforeach

                            </div>
                            @if($product_detail['healthians_price'] > 0)
                                <div class="col-md-12 detailbtm_book">
                                    <ul>
                                        <li><a class="btn btn-danger booknow-package" href="javascript:void(0);" data-testid="{{ $product_detail['testId'] }}" data-profile="{{ $product_detail['deal_type'] }}" data-link="{{$product_detail['link_rewrite']}}" onclick="pushGaEvent('{{$product_detail['deal_type']}}', 'Clicked on Book Now', 'Bottom book - {{$product_detail['name']}}')" >Book Now <img src="/img/left-icon-sml.png" class=""></a></li>

                                        <li><a data-toggle="modal" data-target="#getACallBackModal" class="btn btn-default getcallbackprdtl" onclick="pushGaEvent('{{$product_detail['deal_type']}}', 'Click on Get a Call Back', '{{$product_detail['name']}}')">Get a Call Back</a></li>

                                    </ul>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Related Packages -->
    <section class="riskcontent related-area">
        <div class="container">
            <!-- Heading area -->
            <div class="blog-heading text-center" id="more_consider">
                    <h2>Other Health Checkup Packages</h2>
                    <img src="/img/gray-line.jpg" class="underline-img" alt="underline" />
            </div>

            <div class="row">
                <div id="blog-inner" class="owl-carousel">                    
                    @foreach($popular_package_details as $popular_package_detail)
                        <div class="related-package">
                            <div class="offer-main">
                                <div class="offers">
                                    <h3>{{ number_format((($popular_package_detail['actual_price'] - $popular_package_detail['healthian_price']) / $popular_package_detail['actual_price'] ) * 100,0)}}% Off</h3>
                                </div>

                                <div class="offer-content">
                                    <div class="offer-heading">
                                        <h4><a href="<?php echo route("product.{$popular_package_detail['product_type']}-detail", [   
                                                                    'city'          =>  $city_name,
                                                                    'link_rewrite'  =>  $popular_package_detail['link_rewrite'] 
                                                                ]
                                                            ) ?>">{{ $popular_package_detail['product_name'] }}</a></h4>
                                    </div>
                                    <div class="offers-content">
                                        @if(isset($popular_package_detail['test_includes']) && (count($popular_package_detail['test_includes']) > 0) )
                                            <h5>Includes</h5>
                                            <ul>
                                                @php($j = 0)
                                                @foreach($popular_package_detail['test_includes'] as $includes)
                                                    <li>
                                                        @if(isset($includes['link_rewrite']))
                                                            <a href="<?php echo route("product.{$includes['type']}-detail", [   
                                                                    'city'          =>  $city_name,
                                                                    'link_rewrite'  =>  $includes['link_rewrite'] 
                                                                ]
                                                            ) ?>" title="{{$includes['test_name']}}" target="_blank">{{$includes['test_name']}}</a>
                                                        @else
                                                            {{$includes['test_name']}}
                                                        @endif
                                                    </li>
                                                    @php($j++)
                                                    @if($j == 3)
                                                        @break
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endif
                                        <a href="<?php echo route("product.{$popular_package_detail['product_type']}-detail", [   
                                                                    'city'          =>  $city_name,
                                                                    'link_rewrite'  =>  $popular_package_detail['link_rewrite'] 
                                                                ]
                                                            ) ?>" onclick="pushGaEvent('{{$popular_package_detail['product_type']}}', 'Clicked on you may also consider panel | View details', '{{$popular_package_detail['product_type']}} | {{$popular_package_detail['link_rewrite']}}')" class="know-more">+ Know More</a>
                                        <!-- <div class="ruree">
                                            <del>{{$popular_package_detail['actual_price']}}/-</del> {{$popular_package_detail['healthian_price']}}/-
                                        </div> -->
                                        <div class="pricebar">
                                            <p class="slashedprice"><del><span class="rupeesign">₹</span>{{$popular_package_detail['actual_price']}}</del></p>

                                            <p class="healthiansprice"> <span class="rupeesign">₹</span>{{$popular_package_detail['healthian_price']}} </p>
                                        </div>

                                        <div class="detailbtm-like youmaylike">
                                            <a class="btn btn-danger bookpackage_btn booknow-package" data-testid="{{ $popular_package_detail['product_id'] }}"  href="javascript:void(0);">Book Now</a>

                                            <a class="btn btn-danger getcallback_yml"  data-toggle="modal" data-target="#getACallBackModal" >Get a Call Back</a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @include('section.getACallBack', $logged_user)
@endsection
@push('footer-scripts')

    <script>
        setTimeout(function(){ 
            if(typeof(clevertap) !== 'undefined') {
                clevertap.notifications.push({
                    "titleText"         :'Would you like to receive Push Notifications?',
                    "bodyText"          :'We promise to only send you relevant content and give you updates on your transactions',
                    "okButtonText"      :'Sign me up!',
                    "rejectButtonText"  :'No thanks',
                    "okButtonColor"     :'#00a0a8'
                });
            }
        },3000);
    </script>

    <script type="text/javascript">
        
        // on load event fire
        pushGaEvent("{{$product_detail['deal_type']}}", "SEO Page", "{{$product_detail['name']}}")
        
        var selectedProductDetail = <?php echo json_encode($popular_package_details); ?>;
        var curProduct = <?php echo json_encode($product_detail); ?>;
        selectedProductDetail.push( curProduct);
        $(document).ready(function(){
            
            // Configure/customize these variables.
            var showChar = 0;  // How many characters are shown by default
            var ellipsestext = "...";
            var moretext = "Read more >";
            var lesstext = "Read less";
            
            var content = $('.metaFooterLink').html();

            $(".morelink").click(function(){
                $('.metaFooterLink').removeClass('hidden');
                $('.moreellipses').addClass('hidden');
                $('.lesslink').removeClass('hidden');
                $('.morelink').addClass('hidden');
                return false;
            });
            
            $(".lesslink").click(function(){
                $('.metaFooterLink').addClass('hidden');
                $('.moreellipses').removeClass('hidden');
                $('.morelink').removeClass('hidden');
                $('.lesslink').addClass('hidden');
                return false;
            });
            
            if (typeof(fbq) !== 'undefined') {               
                var fbData=[];
                fbData['content_ids']       =   ["{{$product_detail['deal_type']}}_{{$product_detail['id']}}"];
                fbData['contents']          =   [{'id': "{{$product_detail['deal_type']}}_{{$product_detail['id']}}" , 'quantity': 1, 'item_price': "{{$product_detail['healthians_price']}}" }];
                fbData['content_type']      =   'product';
                fbData['content_category']  =   'SEO Pages - {{$city}}';
                fbData['value']             =   "{{$product_detail['healthians_price']}}";
                fbData['currency']          =   'INR';
                fbData['content_name']      =   "{{$product_detail['name']}}";

                fbq('track', 'ViewContent', fbData);
            }
            
            var $regexname=/^([a-zA-Z]{3,16})$/;
            $('#name').on('keypress keydown keyup',function(){
                if (!$(this).val().match($regexname)) {
                    // there is a mismatch, hence show the error message
                    $('.emsg').removeClass('hidden');
                    $('.emsg').show();
                }
                else{
                   // else, do not display message
                   $('.emsg').addClass('hidden');
                }
            });
            
            
            $('input[name="contact_no"]').keyup(function(e) {
                if (/\D/g.test(this.value))
                {
                  // Filter non-digits from input value.
                  this.value = this.value.replace(/\D/g, '');
                }
            });
            $('body').on('click', '.booknow-package', function() {
                var testId = $(this).data('testid');
                console.log(testId);
                var selectProduct = selectedProductDetail.filter(function (sproduct) { return sproduct.testId == testId });
                console.log(selectProduct);
                if(selectProduct.length > 0  && selectProduct[0].hasOwnProperty('testId')){
                    var productDetail = selectProduct[0];
                    if(productDetail.hasOwnProperty('healthians_price'))
                        productDetail.healthian_price = productDetail.healthians_price;
                    if(productDetail.hasOwnProperty('mrp'))
                        productDetail.actual_price = productDetail.mrp;
                    if(productDetail.hasOwnProperty('name'))
                        productDetail.display_name = productDetail.name;
                    getBookingDetail(productDetail);
                }else{
                    var selectProduct = selectedProductDetail.filter(function (sproduct) { return sproduct.product_id == testId });
                    if(selectProduct.length > 0 && selectProduct[0].hasOwnProperty('product_id')){
                        var productDetail = selectProduct[0];
                        if(productDetail.hasOwnProperty('product_name'))
                            productDetail.display_name = productDetail.product_name;
                        if(productDetail.hasOwnProperty('product_id'))
                            productDetail.testId = productDetail.product_id;
                        getBookingDetail(productDetail);
                    }
                }
                
            });

            $.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            });
            $("#view_precautions").click(function() {
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#more_consider").offset().top
                }, 2000);
            });
            if(getUrlVars()['vendor_code'] != undefined)
                localStorage.vendor_code = getUrlVars()['vendor_code'];
            var utm_id = (localStorage.getItem('vendor_code') === null) ? 'seoPageLead' : localStorage.vendor_code ;
            $("#utm_id").val(utm_id);
        });
                
        
        function validateGetCallBack() {
            $('#get_a_call_back').validate({
                rules: {
                    name: {
                        required: true,
                        lettersonly: true
                    },
                    contact_no: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10					
                    }
                },
                messages: {
                    name: {
                        required : "Please specify your name",
                        lettersonly: "Please enter characters only"
                    },
                    contact_no: {
                        required: "We need your mobile no. to contact you",
                        digits: "Not a valid 10-digit mobile no.",
                        minlength : "Please enter valid 10 digit no.",
                        minlength : "Please enter valid 10 digit no."
                    }
                },
                //submit handler
                submitHandler: function(form)
                {
                    var url = $("#get_a_call_back").attr('action');
                    

                    /* Get from elements values */
                    var values = $('#get_a_call_back').serialize();

                    values = setUrlVars(values);
                    if((getUrlVars()['vendor_code'] == undefined) && ( localStorage.getItem("vendor_code") != null)) {
                        values += "&vendor_code="+localStorage.vendor_code;
                    }
                        
                                        
                    $.ajax({
                        url: url,
                        type: "post",
                        data: values ,
                        beforeSend: function() {
                            $("#ajax-loader").show();
                        },
                        success: function (response) {

                            if(response.status && response.new_lead) {

                                pushGaEvent('SEO Page - Lead Form', 'Lead Captured', $("input[name='contact_no']").val());

                                if(response.hasOwnProperty("data")) {
                                    if(response.data !== '') {
                                        if(getUrlVars()['publisher_id'] != undefined) {
                                            pushGaEvent(localStorage.vendor_code, 'Vendor Publisher Pixel', getUrlVars()['publisher_id']);
                                            localStorage.removeItem('vendor_code');
                                        }
                                        else {
                                            pushGaEvent(localStorage.vendor_code, 'Vendor Pixel', response.lead_id);
                                            localStorage.removeItem('vendor_code');
                                        }                                        
                                        $("footer").append(response.data);                                        
                                    }                                    
                                }

                                if (typeof(fbq) !== 'undefined') {
                                    var searchLength = Object.keys(favorite).length;         
                                    var fbData = [{"page": 'SEO Page', 'lead_id': response.lead_id, 'name': $("#name").val()}];
                                    fbq('track', 'Lead', fbData);
                                }
                                
                                var url = window.location.toString(); 
                            }
                            showStrError("success", "Lead captured successfully");
                            
                            var validator = $( "#get_a_call_back" ).validate();
                            validator.resetForm();
                            $('#get_a_call_back').trigger("reset");
                            $("#ajax-loader").hide();
                            return false;
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            var jsonResponseText = $.parseJSON(jqXHR.responseText);
                            var error_html = '<ul>';
                            $.each(jsonResponseText, function(i, item) {
                                error_html += '<li>'+item+'</li>';
                            });
                            error_html += '</ul>';
                            pushGaEvent('Call To Book Pop up', 'Validation Fail', $("input[name='contact_no']").val());
                           $("#error-msg").html(error_html);
                           $("#error-msg").removeClass("hidden");
                           $("#ajax-loader").hide();
                           return false;
                        }
                    });
                    console.log(url);
                    return false;
                }
            });
	}
        
    </script>
@endpush