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
                            <p>Your Booking ID is 
                                <a href="javascript:void(0);">{{ $booking_id }}</a>
                                @if(!empty($service_details))        
                                    & Service ID is <a href="javascript:void(0);">{{ strtoupper($service_details['service_booking_id']) }}</a>
                                @endif
                            </p>
                            <p>We have sent you an email confirmation at : <a href="mailto:{{ $email_address }}">{{ $email_address }}</a></p>
                            <h5>In case of any questions, please call us at : <a href="tel:{{ config('constants.ht_number') }}">{{ config('constants.ht_number') }}</a></h5>
                    </div>

                    <div class="summery-cart">
                        <div class="summery-border">
                            <div class="row">
                                <div class="">
                                    <div class="col-lg-9 col-md-8 col-sm-7 col-xs-5">
                                        <h2>Booking & Service Summary </h2>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-5 col-xs-7">
                                    <button class="booking-id">Booking ID: {{$booking_id}}</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="summery-content">
                            @if(!empty($transactionId))
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                        <h3>Transaction ID:</h3>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <h4>{{$transactionId}}</h4>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <h3>Booking Date</h3>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <h4>{{  convertUserVisibleDateFormat($order_date) }}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <h3>Sample Collection Date:</h3>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <h4>{{  convertUserVisibleDateFormat($slot_date) }}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <h3>Sample Collection Time :</h3>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <h4>{{ $slot_start_time }} - {{ $slot_end_time }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="summery-content">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <h3>Billing Name:</h3>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <h4>{{ ucwords($customer_name) }}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <h3>Registered Mobile no.:</h3>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <h4>(+{{$country_code}}) {{$contact_number}}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <h3>Billing Address:</h3>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <h4>{{$address}}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <h3>Email ID:</h3>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <h4>{{$email_address}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summery-cart">
                        <div class="summery-border">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h2>Order Details</h2>
                                </div>
                            </div>
                        </div>
                        @foreach($orderDetail as $order)
                            <div class="summery-pakage">
                                <div class="odpkg">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 nomarnopadd">
                                    <h5 class="cusnameinfos">
                                        {{ ucwords($order['cust_name']) }} <br>
                                        ({{$order['cust_age']}} Years / {{$order['cust_gender']}}) 
                                        </h5>
                                    </div>


                                    
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 nomarnopadd">
                                        
                                            <div class="col-lg-4 col-md-4 col-md-4 col-xs-5 nomarnopadd">
                                                
                                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 total_pkg_test_head">
                                                        <h6><b>Test Package</b></h6>
                                               
                                                    
                                                </div>
                                            </div>        
                                            <div class="col-lg-4 col-md-4 col-md-4 col-xs-4 nomarnopadd">
                                                
                                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 total_mktprice_head">
                                                        <h6><b>Market Price</b></h6>
                                                    </div>                                                    
                                                
                                            </div>        
                                            <div class="col-lg-4 col-md-4 col-md-4 col-xs-3 nomarnopadd">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 total_price_head">
                                                        <h6><b>Our Price</b></h6>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                    

                                        @if(!empty($order['Package']))
                                            @foreach($order['Package'] as $package)
                                                <!-- loop area start -->
                                              
                                                <div class="col-lg-4 col-md-4 col-md-4 col-xs-6 total_pkg_test">
                                                        
                                                            <div class="col-lg-12 col-md-12 col-md-12 col-xs-12 nomarnopadd">
                                                                <h6>{{$package['display_name']}} ({{count($package['test_detail'])}} Test)
                                                                </h6>
                                                            </div>
                                                        
                                                    </div>
                
                                                 <div class="col-lg-4 col-md-4 col-md-4 col-xs-3 total_mktprice">
                                                        
                                                            <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 nomarnopadd">
                                                                <h6>
                                                                    <del><span class="rupeesign">₹</span> {{ $package['actaul_price']}}</del>                                                                
                                                                </h6>
                                                            
                                                        </div>
                                                    </div>
                
                                                    <div class="col-lg-4 col-md-4 col-md-4 col-xs-3 total_price">
                                                      
                                                            <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 nomarnopadd">
                                                                <h6><span class="rupeesign">₹</span> {{ $package['healthians_price']}}</h6>
                                                            </div>
                                                        
                                                    </div>
                                    
                                                <!-- loop area end -->
                                                <div class="clearfix"></div>
                                            @endforeach
                                        
                                            <!-- total price area -->
                                            <div class="row ">
                                                <div class="col-12 col-md-12 col-sm-12 col-xs-12 col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-xs-offset-0 mr0">

                                    <div class="col-md-6 col-sm-6 col-xs-6 finalprices">Total Price</div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 finalprices lftprice">
                                        <span class="rupeesign">₹</span>{{ sumArraykey($order['Package'], "healthians_price") }}
                                                        </span>
                                    </div>



                                                   <!--  <h4>
                                                        <span class="total">
                                                            Total 
                                                            <span class="rupeesign">₹</span>{{ sumArraykey($order['Package'], "healthians_price") }}
                                                        </span>
                                                    </h4> -->
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                               </div>
                            </div>
                        @endforeach
                    </div>

                    @if(!empty($service_details))
                        <div class="summery-cart payment-table mrngbtm">
                            <div class="summery-border">
                                <div class="row">
                                    <div class="col-lg-9 col-md-8 col-sm-7 col-xs-6">
                                        <h2>Service Details</h2>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-5 col-xs-6">
                                        <button class="booking-id">Service ID: {{ strtoupper($service_details['service_booking_id']) }}</button>
                                    </div>
                                </div>
                            </div>
                            @if(!empty($service_details['customer_details']))
                                @foreach($service_details['customer_details'] as $p)
                                    <div class="summery-content">
                                        <div class="row">
                                            <div class="col-xs-12 servicesec">
                                                <h5 class="cust_nme"> {{  strtoupper($p['customer_name']) }} </h5>
                                            </div>
                                        </div>
                                        @foreach($p['service'] as $ser)
                                            <div class="row servicesec">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3">
                                                    <h3>Service Name:</h3>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                    <h4 class="servname">{{ $ser['service_name'] }}</h4>
                                                </div>

                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                                    <div class="pricerightser">
                                                            <strong><span class="rupeesign">₹</span> {{  (int)$ser['order_price']  }} </strong>
                                                        </div>
                                                </div>


                                            </div>
                                            <div class="row servicesec">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                    <h3>Service Validity:</h3>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                    <h4>{{convertUserVisibleDateFormat($ser['service_valid_till']) }}</h4>
                                                </div>
                                            </div>
                                            <div class="row servicesec ml350">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 serviceincl">
                                                    <h3 class="">Service Included:</h3>
                                                </div>                                                
                                            </div>
                                            <div class="row mrgntp ml350">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 servicesec">
                                                    
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <h3>Service Details</h3>
                                                        </div>                                                        
                                                   
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 servicesec">
                                                    
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <h3>Frequency</h3>
                                                        </div>                                                        
                                                   
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 servicesec">
                                                    
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <h3>Validity</h3>
                                                        </div>                                                            
                                                   
                                                </div>
                                            </div>

                                            @foreach($ser['microservice'] as $inc)
                                                <div class="row ml350">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 servicesec">
                                                                                                                
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <h4>{{  $inc['microservice_name'] }}</h4>
                                                            </div>
                                                      
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 servicesec">
                                                                                                               
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <h4>{{  $inc['count']  }} times</h4>
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
                            @endif 
                            <div class="summery-content brdrtop totalsec">
                        @if(strtolower($hard_copy) =='yes') 
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-0">
                                    <h6>Hard Copy Amount</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                    <h6 class="colorgreen">+ <span class="rupeesign">₹</span> {{$hard_copy_price}}</h6>
                                </div>
                            </div>
                        @endif

                        @if(!empty($coupon_code))
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="ccol-lg-3 col-md-3 col-sm-3 col-xs-6 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-0">
                                    <h6>Discount Applied (<span>{{ $coupon_code }}</span>)</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                    <h6 class="colordef">- <span class="rupeesign">₹</span> {{$discounted_amount}}</h6>
                                </div>
                            </div>
                        @endif

                        @if(strtolower($convenience_fee) =='yes') 
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-0">
                                    <h6 class="">Convenience Fees</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                    <h6 class="colordef">- <span class="rupeesign">₹</span> {{$convenience_amount}}</h6>
                                </div>
                            </div>
                        @endif
                        
                        @if(isset($wallet_amount_used)) 
                            @if($wallet_amount_used > 0)
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-0">
                                        <h6>HCash Amount</h6>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                        <h6 class="colordef">- <span class="rupeesign">₹</span> {{$wallet_amount_used}}</h6>
                                    </div>
                                </div>                                
                            @endif
                        @endif

                        @if(isset($online_discount_amount)) 
                            @if($online_discount_amount > 0)
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-0">
                                        <h6>>Online Discount</h6>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                        <h6 class="colordef">- <span class="rupeesign">₹</span> {{$online_discount_amount}}</h6>
                                    </div>
                                </div>
                            @endif
                        @endif

                        @if(isset($donation_amount)) 
                            @if($donation_amount > 0) 
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-0">
                                        <h6>Donation Amount <span class="yuvrajsingh">(Yuvraj Singh Foundation)</span></h6>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                                        <h6 class="colorgreen">+ <span class="rupeesign">₹</span> {{$donation_amount}} </h6>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>                          
                        </div>
                    @endif




                    

                    <div class="summery-total">
                       
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 align-right">
                            <div class="col-md-8 col-xs-7">Total Amount </div>
                            <h3 class="totlamnt"><span class="rupeesign">₹</span>{{ $total_booking_service_order_price }}</h3>
                    </div>

                       

                    </div>
                </div>                   
            </div>

            <div class="summery-cart payment-table">
                <div class="summery-border">
                    
                        
                            <h2>Payment Summary</h2>
                       
                
                </div>
                <div class="summery-content">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                                    <h4>
                                        @if(strtolower($order_type) == 'online')
                                            @if((int)$total_booking_service_amount > 0)
                                                Payment Date
                                            @else
                                                Payment Due Date
                                            @endif
                                        @else
                                            Payment Due Date
                                        @endif

                                    </h4>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                                    <h5>{{ convertUserVisibleDateFormat($payment_details[0]['created_at']) }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                                    <h4>Mode of payment </h4>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                                    <h5>
                                        @if(strtolower($order_type) == 'online')
                                            {{ ucwords($order_type) }}
                                        @else
                                            Cash on Sample Collection
                                        @endif
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                                    <h4>Payment Via</h4>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                                    <h5>
                                        @if(!empty($card_type))
                                            {{ ucwords($card_type) }}
                                        @else
                                            -
                                        @endif
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                                    <h4>Total Amount</h4>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                                    <h5><b><span class="rupeesign">₹</span> {{$total_booking_service_amount}}</b></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if((int)$payatcollection > 0)
                        <div class="row paymentdue">Payment Due Amount :  <span class="rupeesign">₹</span> {{ $payatcollection }}</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
<!-- subscribe section start here -->
@endsection

@push('footer-scripts')
@endpush