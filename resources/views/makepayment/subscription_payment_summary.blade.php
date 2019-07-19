@extends('layout.master')

@section('page-content')
<!-- book your test -->
<section class="cart-section payment-summery subscription-summary">
	<div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cart-block cart-width cart-cont add-btn cart-empty payment-box">
                    <i class="fa fa-check" aria-hidden="true"></i>
                    <h2>Thank You For Your Order</h2>
                    <p>Your Subscription ID is <a >{{ strtoupper($user_subscribe_id) }}</a></p>
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
                            <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
                                <h2>Subscription Summary</h2>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
                                <button class="booking-id">Subscription ID: {{ strtoupper($user_subscribe_id) }}</button>
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

                <div class="summery-cart">
                    <div class="summery-border">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h2>Subscription Details</h2>
                            </div>
                        </div>
                    </div>
                    @foreach($customer_details as $sub)
                        <div class="summery-content">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <h3>Customer Subscription Id:</h3>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                                    <h4>{{ $sub['customer_subscribe_id'] }}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <h3>Customer Name:</h3>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                                    <h4>{{ $sub['customer_name'] }}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <h3>Subscription Name:</h3>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                                 <h4>{{ $sub['name'] }}  (Covered {{ $sub['total_parameters'] }} Parameter)</h4>
                                    <br>
                                    <em class="parametercounts">
                                        Below subscription includes all tests {{ $sub['count'] }} times
                                    </em>
                                </div>
                            </div>
                        </div>
                        <div class="summery-border">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h2>Subscription Included</h2>
                                </div>
                            </div>
                        </div>
                        <div class="summery-content text-section">
                            <div class="row">
                                @foreach($sub['deal_detail'] as $inc)
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h3>{{ $inc['name'] }} 
                                            ({{ $inc['total_param'] }} 
                                            @if($inc['total_param'] > 1)
                                                Tests Included
                                            @else
                                                Test Included
                                            @endif
                                            )
                                        </h3>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                
                        @if(!empty($sub['service_booking_details']['customer_details']))
                            <div class="summery-border">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h2>Service Included</h2>
                                    </div>
                                </div>
                            </div>
                            @if(count($sub['service_booking_details']['customer_details']) > 0)
                                <div class="summery-content">
                                    <div class="row">
                                        @foreach($sub['service_booking_details']['customer_details'][0]['service'] as $serv)
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <h3>{{ $serv['service_name'] }}
                                                    @foreach($serv['microservice'] as $mserv)
                                                        <em class="parametercounts">
                                                            {{ $mserv['microservice_name'] }}
                                                        </em>
                                                    @endforeach
                                                </h3>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
	</div>
</section>
<!-- subscribe section start here -->
@endsection

@push('footer-scripts')
    <script type="text/javascript">
    </script>
@endpush