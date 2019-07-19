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
                        <p>Your Booking ID is <a >{{ $booking_id }}</a></p>
                        <p>We have sent you an email confirmation at : <a href="mailto:{{ $email_address }}">{{ $email_address }}</a></p>
                        <h5>In case of any questions, please call us at : <a class="telno" href="tel:{{ config('constants.ht_number') }}">{{ config('constants.ht_number') }}</a></h5>
                    </div>

                    <div class="summery-cart">
                        <div class="summery-border mb0">
                            <div class="row">
                                <div class="col-lg-9 col-md-8 col-sm-7 col-xs-6">
                                    <h2>Booking Summary</h2>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-5 col-xs-6">
                                    <button class="booking-id">Booking ID: {{ $booking_id }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="summery-content">
                            @if(isset($transactionId))
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                        <h3>Transaction ID:</h3>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                                        <h4>{{$transactionId}}</h4>
                                    </div>
                                </div>
                            @endif
                    
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <h3>Booking Date:</h3>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                                    <h4>{{  convertUserVisibleDateFormat($order_date) }}</h4>
                                </div>
                            </div>
                            @if(empty($slot_date))
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                        <h3>Sample Collection Date:</h3>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                                        <h4>{{  convertUserVisibleDateFormat($order_date) }}</h4>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                        <h3>Sample Collection Date:</h3>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                                        <h4>{{  convertUserVisibleDateFormat($slot_date) }}</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                        <h3>Sample Collection Time :</h3>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                                        <h4>{{ $slot_start_time }} - {{ $slot_end_time }}</h4>
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
                                    <h3>Registered Mobile No.:</h3>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                                    <h4>(+{{$country_code}}) {{$contact_number}}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <h3>Billing Address:</h3>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                                    <h4>{{$address}}</h4>
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

                    <div class="summery-cart pakage-cart">
                        <div class="summery-border">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h2>Order Summary</h2>
                                </div>
                            </div>
                        </div>
                        <div class="summery-pakage">
                            @foreach($orderDetail as $order)
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                        <h5 class="cusnameinfo">
                                            {{ ucwords($order['cust_name']) }} 
                                            <br>{{$order['cust_age']}}  Years / {{$order['cust_gender']}}
                                        </h5>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                                        <h6 class="fastingfo">
                                        @if($order['fasting_required'] > 0)
                                            Fasting required <br>For {{ $order['fasting_time'] }} hours
                                        @else
                                            Fasting not required
                                        @endif
                                    </h6>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <!-- loop area start -->
                                        <div class="row mr0">
                    
                                            <div class="col-lg-4 col-md-4 col-md-4 col-xs-4 nomarnopadd">
                                                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 total_pkg_test_head">
                                                    <h6><b>Test Package</b></h6>
                                                </div>
                                            </div>
                    
                                            <div class="col-lg-4 col-md-4 col-md-4 col-xs-4 nomarnopadd">
                                                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 total_mktprice_head">
                                                    <h6><b>Market Price</b></h6>
                                                </div>                                
                                            </div>
                    
                                            <div class="col-lg-4 col-md-4 col-md-4 col-xs-4 nomarnopadd">
                                                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 total_price_head">
                                                    <h6><b>Our Price</b></h6>
                                                </div>                               
                                            </div>
                                        </div>
                    
                                        @foreach($order['package'] as $package)
                                            <div class="row mr0">
                                                <div class="col-lg-4 col-md-4 col-md-4 col-xs-6 nomarnopadd">                                
                                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 total_pkg_test">
                                                        <h6>
                                                            {{$package['display_name']}} ({{count($package['test_detail'])}}) Test
                                                        </h6>
                                                    </div>
                                                </div>
                    
                                                <div class="col-lg-4 col-md-4 col-md-4 col-xs-3 nomarnopadd">                                
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 total_mktprice">
                                                        <h6><del><span class="rupeesign">₹</span> {{ $package['actaul_price']}}</del></h6>
                                                    </div>
                                                </div>
                    
                                                <div class="col-lg-4 col-md-4 col-md-4 col-xs-3 nomarnopadd">                                
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 total_price">
                                                        <h6><span class="rupeesign">₹</span> {{ $package['healthians_price']}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    
                                        <!-- loop area end -->
                                        <!-- total price area -->
                                        <div class="row total-border">
                                            <div class="col-12 col-md-12 col-sm-12 col-xs-12 col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-xs-offset-0 nomarnopadd mr0">
                                                <div class="col-md-6 col-sm-6 col-xs-6 finalprices">Total Price</div>
                                                <div class="col-md-6 col-sm-6 col-xs-6 finalprices lftprice"><span class="rupeesign">₹</span> {{ sumArraykey($order['package'], "healthians_price") }}</div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            @endforeach
                    
                            <!-- order-details -->
                            <div class="row">
                                @if(strtolower($hard_copy) =='yes') 
                                    <div class="col-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-0">
                                            <h6 class="subcharges">Hard Copy</h6>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            <h6 class="subcharges colorgreen">+ <span class="rupeesign">₹</span> {{$hard_copy_price}}</h6>
                                        </div>
                                    </div>                                    
                                @endif
                            
                                @if(!empty($coupon_code))
                                    <div class="col-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-0">
                                            <h6 class="subcharges">Discount Applied <span class="pay_summary_coupon">( {{ strtoupper($coupon_code) }} )</span></h6>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            <h6 class="subcharges colordef">- <span class="rupeesign">₹</span> {{$discounted_amount}}</h6>
                                        </div>
                                    </div>
                                @endif

                                @if(strtolower($convenience_fee) =='yes') 
                                    <div class="col-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-0">
                                            <h6 class="subcharges">Convenience Fees</h6>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            <h6 class="subcharges colorgreen">+ <span class="rupeesign">₹</span> {{$convenience_amount}}</h6>
                                        </div>
                                    </div>
                                @endif

                                @if(isset($wallet_amount_used))                                    
                                    @if($wallet_amount_used > 0) 
                                        <div class="col-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-0">
                                                <h6 class="subcharges">HCash Amount</h6>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                                <h6 class="subcharges colordef">- <span class="rupeesign">₹</span> {{$wallet_amount_used}}</h6>
                                            </div>     
                                        </div>                                   
                                    @endif
                                @endif

                                @if(isset($online_discount_amount)) 
                                    @if($online_discount_amount > 0)
                                        <div class="col-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-0">
                                                <h6 class="subcharges">Online Discount</h6>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                                <h6 class="subcharges colordef">- <span class="rupeesign">₹</span> {{$online_discount_amount}}</h6>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                @if(isset($donation_amount)) 
                                    @if($donation_amount > 0)
                                        <div class="col-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-0">
                                                <h6 class="subcharges">Donation Amount<br> <span><i style="clear:both;">(Yuvraj Singh Foundation)</i></span></h6>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                                <h6 class="subcharges colorgreen">+ <span class="rupeesign">₹</span> {{$donation_amount}}</h6>
                                            </div>  
                                        </div>                                      
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="summery-total-green">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><h3 class="ttlprice">Total Amount</div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><h3 class="odrprice">   
                        <span class="rupeesign">₹</span> {{ $order_price }}</h3>
                    </div>

                    </div>

                    <p class="note-tble">Note: Coupon will not be applicable on disount/addon products</p>

                    <div class="summery-cart payment-table">
                        <div class="summery-border">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h2>Payment Summary</h2>
                                </div>
                            </div>
                        </div>
                        <div class="summery-content">
                            <div class="row ">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                                            <h4>
                                                @if(strtolower($order_type) == 'online')
                                                    @if((int)$payed_amount > 0)
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
                                            <h5>{{ convertUserVisibleDateFormat($slot_date) }}</h5>
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
                                            <h5><b><span class="rupeesign">₹</span> {{$payed_amount}}</b></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if((int)$payatcollection > 0)
                            <div class="summery-content">
                                <div class="paymentprc alert alert-danger text-center">
                                    Payment Due Amount :  <span class="rupeesign">₹</span> {{ $payatcollection }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
	    </div>
    </section>
<!-- subscribe section start here -->
@endsection
<?php //dd($fb_pixel); ?>
@push('footer-scripts')
    <script type="text/javascript">
        if (typeof(fbq) !== 'undefined') {
            var fb_data = <?php echo json_encode($fb_pixel) ?>;
            fbq('track', 'Purchase', fb_data);
        }

        if(localStorage.getItem("vendor_code") != null){
            var vendor_code     =   localStorage.vendor_code;
            var url             =   "{{ url('pixel-fire') }}";
            var booking_id      =   "{{ $booking_id }}";
            var txn_amt         =   "{{ $payed_amount}}";
            var values          =   { 'vendor_code' : vendor_code, 'booking_id' : booking_id, 'transaction_amount' : txn_amt, '_token' : '{{ csrf_token() }}' };
            
            $.ajax({
                url     :   url,
                type    :   'Post',
                data    :   values ,
                dataType:   "json",
                beforeSend: function() {
                    $("#ajax-loader").show();
                },
                success: function (response) {
                    if(response.status){
                        pushGaEvent('Affiliate', 'Vendor Order', vendor_code, txn_amt);
                    }
                    $("#ajax-loader").hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                }
            });
            localStorage.removeItem('vendor_code');
        }
    </script>
@endpush