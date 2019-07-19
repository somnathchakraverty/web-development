@extends('layout.master')

@section('page-content')

<div class="common-pages common-risk">
    <section class="common-page-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="banner-text-secion">
                        <h1>{{$risk_title}}</h1>
                        <p>{{$risk_description}}</p>
                    </div>
                </div>
    
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="inner-bnr-sldr">
                        <div id="inner-banner" class="owl-carousel">
                            @foreach ($risk_banner_data as $banner_item)
                                <div class="offer-main">
                                    <div class="offers">
                                        <h3>{{ calPer($banner_item['healthian_price'], $banner_item['actual_price']) }}% Off</h3>
                                    </div>
                                    <div class="offer-content">
                                        <div class="offer-heading">
                                            <h4> {{$banner_item['product_name']}} </h4>
                                            <p>{{str_limit($packg_risk_descp[$banner_item['product_id']], 85)}}</p>
                                        </div>
                                        <div class="offers-content">
                                            <h5>
                                                Includes : <b> {{$banner_item['test_count']}} </b> 
                                                @if ($banner_item['test_count'] == 1)
                                                    Parameter
                                                @endif
                                                @if ($banner_item['test_count'] > 1)
                                                    Parameters
                                                @endif
                                            </h5>
                                            <ul>
                                                @foreach ($banner_item['test_includes'] as $key1 => $test1)
                                                    @if ($key1 < 3)
                                                        <li>{{$test1['test_name']}}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            <a href="/{{$city_name}}/{{$banner_item['product_type']}}/{{$banner_item['link_rewrite']}}" class="know-more">+ Know More</a>

                                            <div class="pricebar">
                                                <p class="slashedprice"><del><span class="rupeesign">₹</span> {{$banner_item['actual_price']}}</del></p>
                                                <p class="healthiansprice"><span class="rupeesign">₹</span> {{$banner_item['healthian_price']}} </p>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <img class="img-responsive sldr-img" src="/img/slider-bg.jpg" alt="images"> --}}
                                    <div class="copy-page-cont">
                                        <div class="buy-book-btn bookmostselling">
                                            <a class="btn btn-danger" href="javascript:void(0);" onclick="click_to_cart('{{json_encode($banner_item)}}');">Book Now <img src="/img/left-icon-sml.png" class="images"></a>
                                            {{-- <a class="btn btn-danger" href="#">Add to Cart <img class="added-to-cart" src="/img/cart-img.png" alt="images"></a> --}}
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
    <!-- riskcontent area -->
    <section class="riskcontent">
        <div class="container">
            <div class="row">
                @foreach ($risk_package_data as $item)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <div class="offer-main">
                            <div class="image-area">
                                {{-- <img class="img-responsive" src="/img/risk1.jpg" alt="images"> --}}
                                <div class="offers">
                                    <h3>{{ calPer($item['healthian_price'], $item['actual_price']) }}% Off</h3>
                                </div>
                            </div>
                            
                            <div class="offer-content">
                                <div class="offer-heading">
                                    <h4>{{$item['product_name']}}</h4>
                                    <p>{{str_limit($packg_risk_descp[$item['product_id']], 85)}}</p>
                                </div>
                                @if (count($item['test_includes']) > 0)
                                    <div class="offers-content">
                                        <h5>
                                            Includes : <b> {{$item['test_count']}} </b>
                                            @if ($item['test_count'] == 1)
                                                Parameter
                                            @endif
                                            @if ($item['test_count'] > 1)
                                                Parameters
                                            @endif
                                        </h5>
                                        <ul>
                                            @foreach ($item['test_includes'] as $key => $test)
                                                @if ($key < 3)
                                                    <li>{{$test['test_name']}}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <a href="/{{$city_name}}/{{$item['product_type']}}/{{$item['link_rewrite']}}" class="know-more">+ Know More</a>
                                        <div class="ruree">
                                            <del>{{$item['actual_price']}}/-</del> {{$item['healthian_price']}}/-
                                        </div>
                                        <div class="buy-book-btn">
                                            <a class="btn btn-danger" href="javascript:void(0);" onclick="click_to_cart('{{json_encode($item)}}');">Book Now <img src="/img/left-icon-sml.png" class="images"></a>
                                            {{-- <a class="btn btn-danger" href="#">Add to Cart <img class="added-to-cart" src="/img/cart-img.png" alt="images"></a> --}}
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