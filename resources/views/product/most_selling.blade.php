@extends('layout.master')

@section('page-content')
<style>
.thumbitem{ min-height:445px; }
.riskcontent .offer-heading{ min-height:58px; }
.thumbitem{min-height:415px;}
    </style>
}
<div>
    <section class="common-page-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="banner-text-secion">
                        <h1>Most Selling Packages</h1>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="inner-bnr-sldr">
                        <div id="inner-banner" class="owl-carousel">
                            @foreach ($popular_package_slider_data as $banner_item)
                                <div class="offer-main">
                                    <div class="offers">
                                        <h3>{{ calPer($banner_item['healthian_price'], $banner_item['actual_price']) }}% Off</h3>
                                    </div>
                                    <div class="offer-content pro_mostselling">
                                        <div class="offer-heading head_off">
                                            <h4> <a href="<?php echo route("product.{$banner_item['product_type']}-detail", [   
                                                                    'city'          =>  $city_name,
                                                                    'link_rewrite'  =>  $banner_item['link_rewrite'] 
                                                                ]
                                            ) ?>">{{$banner_item['product_name']}} </a></h4>
                                        </div>
                                        <div class="offers-content contoff">
                                            @if (count($banner_item['test_includes']) > 0)
                                                <h5>Includes : <b>{{$banner_item['test_count']}}</b> 
                                                    @if ($banner_item['test_count'] == 1)
                                                        Parameter
                                                    @endif
                                                    @if ($banner_item['test_count'] > 1)
                                                        <b>Parameters</b>
                                                    @endif
                                                </h5>
                                                <ul class="itempara">
                                                    @foreach ($banner_item['test_includes'] as $key1 => $test1)
                                                        @if ($key1 < 3)
                                                                <li><a href="<?php echo route("product.{$test1['type']}-detail", [   
                                                                        'city'          =>  $city_name,
                                                                        'link_rewrite'  =>  $test1['link_rewrite'] 
                                                                    ]
                                                                ) ?>">{{ str_limit($test1['test_name'], 35) }}</a></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                                <a href="/{{$city_name}}/{{$banner_item['product_type']}}/{{$banner_item['link_rewrite']}}" class="know-more">+ Know More</a>

                                                <div class="pricebar">
                                                    <p class="slashedprice"><del><span class="rupeesign">₹</span> {{$banner_item['actual_price']}}</del></p>
                                                    <p class="healthiansprice"><span class="rupeesign">₹</span> {{$banner_item['healthian_price']}} </p>
                                                </div>
                                            @endif   
                                        </div>
                                    </div>
                                    {{-- <img class="img-responsive sldr-img" src="/img/slider-bg.jpg" style="opacity:0.2;" alt=""> --}}
                                    <div class="copy-page-cont">
                                        <div class="buy-book-btn bookmostselling">
                                            <a class="btn btn-danger" href="javascript:void(0);" onclick="click_to_cart('{{json_encode($banner_item)}}');">Book Now <img src="/img/left-icon-sml.png" class="images"></a>
                                        </div>

                                        {{-- <p>Use Code : <u id="demo">ONEPLUS3999</u></p>
                                        <img onclick="copy('demo')" src="/img/copy-img.jpg" alt="image"> --}}


                                    </div>
                                </div>
                            @endforeach   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="riskcontent">
        <div class="container">
            <div class="row">
                @foreach ($popular_package_data as $item)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <div class="offer-main thumbitem">
                            <div class="image-area">
                                {{-- <img class="img-responsive" src="/img/risk1.jpg" alt="images"> --}}
                                <div class="offers">
                                    <h3>{{ calPer($item['healthian_price'], $item['actual_price']) }}% Off</h3>
                                </div>
                            </div>                                
                            <div class="offer-content">
                                <div class="offer-heading">
                                    <h4><a href="<?php echo route("product.{$item['product_type']}-detail", [   
                                                                        'city'          =>  $city_name,
                                                                        'link_rewrite'  =>  $item['link_rewrite'] 
                                                                    ]
                                                                ) ?>">{{$item['product_name']}}</a></h4>
                                </div>
                                @if (count($item['test_includes']) > 0)
                                    <div class="offers-content">
                                        <h5>
                                            Includes : <b> {{$item['test_count']}} </b>
                                            @if ($item['test_count'] == 1)
                                                Parameter
                                            @endif
                                            @if ($item['test_count'] > 1)
                                                <b>Parameters</b>
                                            @endif 
                                        </h5>                                            
                                        <ul class="itempara">
                                            @foreach ($item['test_includes'] as $key => $test)
                                                @if ($key < 3)
                                                    <li><a href="<?php echo route("product.{$test['type']}-detail", [   
                                                                        'city'          =>  $city_name,
                                                                        'link_rewrite'  =>  $test['link_rewrite'] 
                                                                    ]
                                                                ) ?>">{{$test['test_name']}}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <a href="/{{$city_name}}/{{$item['product_type']}}/{{$item['link_rewrite']}}" class="know-more">+ Know More</a>

                    
                                        <div class="pricebar">
                                            <p class="slashedprice"><del><span class="rupeesign">₹</span> {{$item['actual_price']}}</del></p>
                                            <p class="healthiansprice"><span class="rupeesign">₹</span> {{$item['healthian_price']}} </p>
                                        </div>


                                        <div class="buy-book-btn bookmostsellinglist marbottom15">
                                            <a class="btn btn-danger" href="javascript:void(0);" onclick="click_to_cart('{{json_encode($item)}}');">Book Now <img src="/img/left-icon-sml.png" class=""></a>
                                            {{-- <a class="btn btn-danger" href="javascript:void(0);">Add to Cart <img class="added-to-cart" src="/img/cart-img.png" alt=""></a> --}}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

@endsection

@push('footer-scripts')
@endpush