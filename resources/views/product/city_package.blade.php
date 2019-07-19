@extends('layout.master')

@section('page-content')

<!-- Related Packages -->
<section class="citypkgarea">
    <div class="container">

        <div class="blog-breadcumbs">
            <ul>
                <li>
                    <a href="/">Home</a>
                </li>
                <li class="breadcumbs-active">
                    <a href="http://newweb.com/{{strtolower($city)}}/package">Health Packages in {{ucfirst($city)}}</a>
                </li>
            </ul>
        </div>

        <!-- Heading area -->
        <div class="city-heading text-center" id="more_consider">

            <h1>Health Packages in {{ucfirst($city)}}</h1>
            <img src="/img/gray-line.jpg" class="underline-img" alt="underline" />
        </div>

        <div class="row scrollpanel">
            <div class="container">
                <div class="col-md-12 product-results" id="product-results">
                    <?php // dd($city_package_details); ?>
                    @foreach($city_package_details as $city_package_detail)
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <?php // dd($city_package_detail); ?>
                        <!-- package list area -->
                        <div class="offer-main">
                            <div class="image-area">
                                <div class="offers"><h3>{{ calPer($city_package_detail['healthian_price'], $city_package_detail['actual_price']) }}% Off</h3></div>
                            </div>
                            <div class="offer-content">
                                <div class="offer-heading">
                                    <h2><a class="orderheading"  href="<?php echo route("product.{$city_package_detail['product_type']}-detail", [   
                                                                    'city'          =>  $city_name,
                                                                    'link_rewrite'  =>  $city_package_detail['link_rewrite'] 
                                                                ]
                                            ) ?>">{!! $city_package_detail['product_name'] !!}</a></h2>

                                    <p></p>
                                </div>

                                <div class="offers-content">
                                    @if(isset($city_package_detail['test_includes']) && (count($city_package_detail['test_includes']) > 0) )
                                    <h5>Includes</h5>
                                    <ul>
                                        @php($j = 0)
                                        @foreach($city_package_detail['test_includes'] as $includes)
                                            <li>
                                                <a href="<?php echo route("product.{$includes['type']}-detail", [   
                                                                    'city'          =>  $city_name,
                                                                    'link_rewrite'  =>  $includes['link_rewrite'] 
                                                                ]
                                                            ) ?>" title="{{$includes['test_name']}}" target="_blank">
                                                    {{$includes['test_name']}}</a></li>
                                                
                                            @php($j++)
                                            @if($j == 3)
                                                @break
                                            @endif
                                        @endforeach
                                    </ul>
                                    @endif
                                    <a link-title="{!! $city_package_detail['product_name'] !!}" href="<?php echo route("product.{$city_package_detail['product_type']}-detail", [   
                                                                    'city'          =>  $city_name,
                                                                    'link_rewrite'  =>  $city_package_detail['link_rewrite'] 
                                                                ]
                                            ) ?>" onclick="pushGaEvent('{{$city_package_detail['product_type']}}', 'Clicked on you may also consider panel | View details', '{{$city_package_detail['product_type']}} | {{$city_package_detail['link_rewrite']}}')" target="_blank" class="know-more">+ Know More</a>


                                    <div class="pricebar">
                                        <p class="slashedprice"> <del><span class="rupeesign">₹</span>{{$city_package_detail['actual_price']}}</del>
                                        </p>
                                        <p class="healthiansprice"> <span class="rupeesign">₹</span> {{$city_package_detail['healthian_price']}}</p>
                                    </div>
                                    <div class="buy-book-btn">  <a class="btn btn-danger bookpackage_btn" onclick="cityPackageBooking('{{$city_package_detail["healthian_price"]}}', '{{$city_package_detail["actual_price"]}}', '{{ preg_replace('/[^A-Za-z0-9\- ]/', '',$city_package_detail["product_name"]) }}', '{{ $city_package_detail["product_id"]}}', '{{ $city_package_detail["gender"] }}')"  href="javascript:void(0);">Book Now <img src="/img/left-icon-sml.png" class="images"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- package list area ends-->
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="home_loader hidden" id="page_loading"> 
            <img src="/img/bx_loader.gif"> 
        </div>
        
    </div>
    @php($page_diff     =   abs($page_limit - $offset))
    @if($page_diff > 0)
        <a link-title="Prev - Citywise package detail" title="prev" href="{{route('product.city-package-list', [
            'city'      =>  $city_name,
            'page_no'   =>  $page_diff/$page_limit
        ])}}" class="hidden"></a>
    @endif
    <a link-title="Next - Citywise package detail" title="next" href="{{route('product.city-package-list', [
        'city'      =>  $city_name,
        'page_no'   =>  abs($page_limit + $offset)/$page_limit
    ])}}" class="hidden"></a>
</section>

@endsection
@push('footer-scripts')
<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "Home",
        "item": "https://www.healthians.com"
      },{
        "@type": "ListItem",
        "position": 2,
        "name": "Health Packages in {{$city_name}}",
        "item": "https://www.healthians.com/{{$city_name}}/package"
      }]
    }
</script>

<script type="text/javascript">
    var city_name   =   "{{$city_name}}";
    var div_length  =   $("#product-results div.col-md-4").length;
    var page_limit  =   {{$page_limit}};
    var limit       =   page_limit;
    var p_start     =   2;
    var action      =   'inactive';
    var counter     =   0;
    if(page_limit   >   div_length )
        limit       =   div_length;
    $(document).ready(function(){
 
        function load_package_data(start)
        {
            $.ajax({
                url     :   "{{route('product.city-package-list', [
                                'city'      =>  $city_name
                            ])}}?page_no="+p_start,
                method  :   "GET",
                cache   :   false,
                beforeSend: function() {
                    $("#page_loading").removeClass("hidden");
                },
                success :   function(data)
                {                    
                    var results = $("#product-results");
                    var product_listings = data.product_detail_list;
                    var html_detail = '';
                    $.each(product_listings, function(key, value) {
                        console.log(value);
                        html_detail     +=  '<div class="col-md-4 col-sm-4 col-xs-12"><div class="offer-main"><div class="image-area"><div class="offers"><h3>';
                        var percentage  =   ((value.actual_price - value.healthian_price) / value.actual_price * 100).toFixed(0);
                        html_detail     +=  percentage + ' % Off</h3></div></div><div class="offer-content"><div class="offer-heading"><h2><a href="/'+value.product_type+'/'+city_name+'/'+value.link_rewrite+'" target="_blank">' + value.product_name + '</a></h2></div><div class="offers-content">';
                        if (value.test_includes.length > 0){
                            html_detail +=  '<h5>Includes</h5><ul>';
                            var j = 0;
                            $.each(value.test_includes, function(test_key, test_value) {
                                if(test_value.hasOwnProperty('link_rewrite'))
                                    html_detail +=  '<li><a href="/'+city_name+'/'+test_value.type+'/'+test_value.link_rewrite+'" target="_blank">' + test_value.test_name + '</a></li>';
                                else
                                    html_detail +=  '<li>' + test_value.test_name + '</li>';
                                j++;
                                if (j == 3)
                                    return false;
                            });
                            html_detail +=  '</ul>';
                        }
                        var onclickChanges  =   "cityPackageBooking('"+value.healthian_price+"','"+value.actual_price+"','"+value.product_name.replace(/[^a-z0-9\s]/gi, '')+"','"+value.product_id+"', '"+value.gender+"')";
                        html_detail +=  '<a title="'+value.product_name+'" href="/' + city_name + '/' + value.product_type + '/' + value.link_rewrite + '" target="_blank" class="know-more">+ Know More</a>';
                        html_detail +=  '<div class="pricebar"><p class="slashedprice"> <del><span class="rupeesign">₹</span>' + value.actual_price + '</del></p>';
                        html_detail +=  '<p class="healthiansprice"> <span class="rupeesign">₹</span>' + value.healthian_price + '</p></div>';
                        html_detail +=  '<div class="buy-book-btn">  <a class="btn btn-danger bookpackage_btn" onclick="'+onclickChanges+'" href="javascript:void(0);">Book Now <img src="/img/left-icon-sml.png" class="images"></a>';
                        html_detail +=  '</div></div></div></div></div>';
                    });
                    results.append(html_detail);
                    if(data == '')
                    {
                        $('#load_data_message').html("<button type='button' class='btn btn-info'>No Data Found</button>");
                        action = 'inactive';
                    }
                    else
                    {
                        $('#load_data_message').html("<button type='button' class='btn btn-warning'>Please Wait....</button>");
                        action = "inactive";
                    }
                    p_start   +=   1;
                    $("#page_loading").addClass("hidden");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var jsonResponseText = $.parseJSON(jqXHR.responseText);
                    $("#page_loading").addClass("hidden");
                }
            });
        }
        /*
        if(action == 'inactive'){
            action = 'active';
            load_package_data(start);
        }
        */
        $(window).scroll(function(){
            if($(window).scrollTop() + $(window).height() > $("#product-results").height() && action == 'inactive' && counter < 212)
            {
                counter++;
                action  =   'active';
                setTimeout(function(){
                    load_package_data(p_start);
                }, 1000);
            }
        });
    });
    function cityPackageBooking(healthian_price, mrp, name, product_id, gender){
        productDetail   =   {};
        productDetail.healthian_price   =   healthian_price;
        productDetail.actual_price      =   mrp;
        productDetail.display_name      =   name;
        productDetail.testId            =   product_id;
        productDetail.gender            =   gender;
        getBookingDetail(productDetail);
    }
</script>
@endpush