@extends('layout.master')

@section('page-content')
<div>
    <section class="common-page-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="banner-text-secion">
                        <h1>Popular Subscriptions</h1>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="inner-bnr-sldr">
                        <div id="inner-banner" class="owl-carousel">
                            @foreach ($subscription_banner_data as $banner_item)
                                <div class="offer-main">
                                    <div class="offers">
                                        <h3>{{ calPer($banner_item['price'], (sumArraykey($banner_item['deal_detail'], "price") * $banner_item['count'])) }}% Off</h3>
                                    </div>
                                    <div class="offer-content">
                                        <div class="offer-heading">
                                            <h4> {{$banner_item['name']}} </h4>
                                            <p> {{ $banner_item['frequencyMessage'] }} </p>
                                        </div>
                                        <div class="offers-content">
                                            <h5>Includes : <b>{{$banner_item['total_parameters']}}</b> 
                                                @if ($banner_item['total_parameters'] == 1)
                                                    Parameter
                                                @endif
                                                @if ($banner_item['total_parameters'] > 1)
                                                    Parameters
                                                @endif
                                            </h5>
                                            <ul>
                                                @foreach ($banner_item['deal_detail'] as $key1 => $test1)
                                                    @if ($key1 < 3)
                                                        <li>{{$test1['name']}}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <img class="img-responsive sldr-img" src="/img/slider-bg.jpg" alt="images">
                                    <div class="copy-page-cont">
                                        <div class="buy-book-btn">
                                            <a class="btn btn-danger" href="javascript:void(0);">Subscribe <img src="/img/left-icon-sml.png" class="images"></a>
                                            {{-- <a class="btn btn-danger" href="#">Add to Cart <img class="added-to-cart" src="images/cart-img.png" alt="images"></a> --}}
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
                @foreach ($subscription_list as $item)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <div class="offer-main">
                            <div class="image-area">
                                <div class="offers">
                                    <h3>{{ calPer($item['price'], (sumArraykey($item['deal_detail'], "price") * $item['count'])) }}% Off</h3>
                                </div>
                            </div>                             
                            <div class="offer-content">
                                <div class="offer-heading">
                                    <h4>{{ $item['name'] }}</h4>
                                    <p>{{ $item['frequencyMessage'] }}</p>
                                </div>
                                @if (count($item['deal_detail']) > 0)
                                    <div class="offers-content">
                                        <h5>
                                            Includes : <b> {{$item['total_parameters']}} </b>
                                            @if ($item['total_parameters'] == 1)
                                                Parameter
                                            @endif
                                            @if ($item['total_parameters'] > 1)
                                                Parameters
                                            @endif 
                                        </h5>                                            
                                        <ul>
                                            @foreach ($item['deal_detail'] as $key => $test)
                                                @if ($key < 3)
                                                    <li>{{$test['name']}}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <a href="javascript:void(0);" class="know-more" target="_blank">+ Know More</a>
                                        <div class="ruree">
                                                <del>{{sumArraykey($item['deal_detail'], "price") * $item['count']}}/-</del> {{$item['price']}}/-
                                            </div>
                                        <div class="buy-book-btn">
                                            <a class="btn btn-danger" href="javascript:void(0);">Subscribe <img src="/img/left-icon-sml.png" class="images"></a>
                                            {{-- <a class="btn btn-danger" href="javascript:void(0);">Add to Cart <img class="added-to-cart" src="/img/cart-img.png" alt="images"></a> --}}
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