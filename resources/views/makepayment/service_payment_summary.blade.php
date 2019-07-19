@extends('layout.master')

@section('page-content')
<!-- book your test -->
<section class="cart-section payment-summery">
	<div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cart-block cart-width cart-cont add-btn cart-empty payment-box">
                    <i class="fa fa-check" aria-hidden="true"></i>
                    <h2>Thank You For Your Order</h2>
                    <p>Your Service Booking ID is <a >{{ strtoupper($service_booking_id) }}</a></p>
                    <p>
                        We have sent you an email confirmation at : 
                        <a href="mailto:{{ $email_address }}">{{ $email_address }}</a>
                    </p>
                    <h5>
                        In case of any questions, please call us at : 
                        <a href="tel:{{ config('constants.ht_number') }}">{{ config('constants.ht_number') }}</a>
                    </h5>
                </div>

                <div class="summery-cart">
                    <div class="summery-border">
                        <div class="row">
                            <div class="col-lg-9 col-md-8 col-sm-7 col-xs-6">
                                <h2>Service Summary</h2>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-5 col-xs-6">
                                <button class="booking-id">Booking ID: {{ strtoupper($service_booking_id) }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="summery-content">
                        @if(!empty($transactionId))
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <h3>Transaction ID:</h3>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                                    <h4>{{$transactionId}}</h4>
                                </div>
                            </div>
                        @endif
                        @if(!empty($transactionAmount))
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <h3>Transaction Amount:</h3>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                                    <h4><span class="rupeesign">₹</span> {{$transactionAmount}}</h4>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="summery-content">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <h3>Billing Name:</h3>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                                <h4>{{ ucwords($customer_name) }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <h3>Registered Mobile no.:</h3>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                                <h4>(+{{$country_code}}) {{$contact_number}}</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <h3>Email ID:</h3>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                                <h4>{{$email_address}}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="summery-cart payment-table mrngbtm">
                    <div class="summery-border">
                        <div class="row">
                            <div class="col-xs-12">
                                <h2>Service Details</h2>
                            </div>
                        </div>
                    </div>
                    @foreach($customer_details as $order)
                        <div class="summery-content summery-pakage">
                            <div class="row">
                                <div class="col-xs-12 servicesec">
                                    <h5> {{ ucwords($order['customer_name']) }} </h5>
                                </div>
                            </div>
                            @foreach($order['service'] as $ser)
                                <div class="row servicesec sp_area">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <h3>Service Name:</h3>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5">
                                        <h4> 
                                            {{ $ser['service_name'] }} 
                                           
                                        </h4>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                    <div class="pricerightser">
                                         <strong><span class="rupeesign">₹</span> {{ (int)$ser['order_price'] }}
                                            </strong>
                                    </div>
                                </div>


                                </div>
                                <div class="row servicesec">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                        <h3>Service Validity:</h3>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                                        <h4>
                                            {{ convertUserVisibleDateFormat($ser['service_valid_till']) }}
                                        </h4>
                                    </div>
                                </div>
                                <div class="row servicesec">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h3>Service Included:</h3>
                                    </div>
                                </div>
                                <div class="row mrgntp ml350">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 nomarnopadd">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 total_pkg_test_head">
                                            <h6><b>Service Details</b></h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 nomarnopadd">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 total_mktprice_head">
                                            <h6><b>Frequency</b></h6>
                                        </div>									
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 nomarnopadd">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 total_price_head">
                                            <h6><b>Validity</b></h6>
                                        </div>									
                                    </div>
                                </div>
                                @foreach($ser['microservice'] as $inc)
                                    <div class="row mrgntp ml350">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 servicesec">									
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 microservice">
                                                <h4>{{ $inc['microservice_name'] }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 servicesec">									
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <h4>{{ $inc['count'] }} times</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 servicesec">									
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <h4>{{ convertUserVisibleDateFormat($inc['microservice_valid_till']) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    @endforeach
                </div> 
            </div>
        </div>
	</div>
</section>
<!-- subscribe section start here -->
@endsection

@push('footer-scripts')
@endpush