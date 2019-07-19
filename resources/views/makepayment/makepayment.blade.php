@extends('layout.master')

@section('page-content')

<!-- Health Karma -->
<section class="cart-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12 col-xs-12 add-btn">
                <!-- Booking Section  -->

                <form action="{{$paytm_payment_url}}" id="payment_form" name="payment_form" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                    
                    <input type="hidden" name="custName" value="{{$detail['customer_name']}}" />
                    <input type="hidden" name="custMobile" value="{{ $detail['contact_number'] }}" />
                    <input type="hidden" name="custEmail" value="{{ $detail['email_address'] }}" />
                    
                    @if($subscription_section)
                        <input type="hidden" name="payment_type_source" value="subscription">
                        <input type="hidden" name="booking_id" value="{{ $detail['user_subscribe_id'] }}">
                        <input type="hidden" name="txnAmount" value="{{$subscription_amount}}"> 
                    @endif

                    @if($service_section)
                        <input type="hidden" name="payment_type_source" value="service">
                        <input type="hidden" name="booking_id" value="{{ $detail['service_booking_id'] }}"> 
                        <input type="hidden" name="txnAmount" value="{{$service_amount}}">    
                    @endif

                    @if($booking_section)
                        <input type="hidden" name="booking_id" value="{{ $detail['booking_id'] }}">
                        @if($online_discount)
                            <input type="hidden" name="makePaymentOnlineDiscount" value="yes">
                            <input type="hidden" name="txnAmount" value="{{$detail['payable_amount'] - $online_discount_amount}}">
                        @else
                            <input type="hidden" name="txnAmount" value="{{$detail['payable_amount'] }}">
                        @endif
                    @endif
                </form>

                <!-- Booking Section -->
                @if(!empty($detail) && $booking_section)
                    <div class="new-member-form col-md-12 col-xs-12 col-sm-12 col-lg-12 mar-top select-member-option make-payment">
                        <div class="add-address-box">
                            <h2>Order Detail</h2>
                        </div>
                        <div class="address-cont boking-make-payment">
                            <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td class="makepaytitle">Booking ID:</td>
                                    <td class="makepayobject">{{ $detail['booking_id'] }}</td>
                                </tr>
                                <tr>
                                    <td class="makepaytitle">Customer Name:</td>
                                    <td class="makepayobject">{{ ucwords($detail['customer_name']) }}</td>
                                </tr>
                                <tr>
                                    <td class="makepaytitle">Mobile:</td>
                                    <td class="makepayobject">{{ $detail['contact_number'] }}</td>
                                </tr>
                                <tr>
                                    <td class="makepaytitle">Email:</td>
                                    <td class="makepayobject">{{ $detail['email_address'] }}</td>     
                                </tr>
                                
                                @if(!empty($detail['order_date']))
                                    <tr>
                                        <td class="makepaytitle">Booking Date:</td>
                                        <td class="makepayobject">{{ convertUserVisibleDateFormat($detail['order_date']) }}</td>     
                                    </tr>
                                @endif

                                @if(!empty($detail['orderDetail']))
                                    <tr>
                                        <td colspan="2" class="oddtl"><div class="ordertitle"> Order Details :</ </td>
                                    </tr>
                                    @foreach($detail['orderDetail'] as $item)
                                        <tr>
                                            <td class="makepaytitle">
                                                <b>{{ ucwords($item['cust_name']) }}</b>
                                            </td>
                                            <td class="makepayobject">        
                                                @if(!empty($item['Package']))                                    
                                                    @foreach($item['Package'] as $key => $pck)
                                                        {{ $pck['display_name'] }}
                                                        @if($key < (count($item['Package'])-1))
                                                            ,
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>     
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                @endif
                <!-- Booking Section  -->
                
                <!-- Service Detail Section -->
                @if(!empty($detail) && $service_section)
                    <div class="new-member-form col-md-12 col-xs-12 col-sm-12 col-lg-12 mar-top select-member-option make-payment">
                        <div class="add-address-box">
                            <h2>Service Detail</h2>
                        </div>
                        <div class="address-cont boking-make-payment">
                            <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td class="makepaytitle">Service ID:</td>
                                    <td class="makepayobject">{{ strtoupper($detail['service_booking_id']) }}</td>
                                </tr>
                                <tr>
                                    <td class="makepaytitle">Customer Name:</td>
                                    <td class="makepayobject">{{ ucwords($detail['customer_name']) }}</td>
                                </tr>
                                <tr>
                                    <td class="makepaytitle">Mobile:</td>
                                    <td class="makepayobject">{{ $detail['contact_number'] }}</td>
                                </tr>
                                <tr>
                                    <td class="makepaytitle">Email:</td>
                                    <td class="makepayobject">{{ $detail['email_address'] }}</td>     
                                </tr>
                                <tr>
                                    <td class="makepaytitle">Service Order Date:</td>
                                    <td class="makepayobject">{{ convertUserVisibleDateFormat($detail['service_date']) }}</td>     
                                </tr>
                                @if(!empty($detail['customer_details']))
                                    <tr>
                                        <td colspan="2" class="oddtl"><div class="ordertitle"> Service Details :</td>
                                    </tr>


                                   
                                    @foreach($detail['customer_details'] as $item)
                                        <tr>
                                            <td class="makepaytitle pl30">
                                                <b>{{ ucwords($item['customer_name']) }}</b>
                                            </td>
                                            <td class="makepayservice">        
                                                @if(!empty($item['service']))                                    
                                                    @foreach($item['service'] as $key => $pck)
                                                        {{ $pck['service_name'] }} 

                                                            <div class="priceright"><span class="rupeesign">₹</span> {{ (int)$pck['order_price'] }}</div>
                                                        
                                                        
                                                        @if($key < (count($item['service'])-1))
                                                            <br>                                                       
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>     
                                        </tr>

                                    @endforeach
                                @endif
                                @if(isset($service_amount))
                                    @if($service_amount == 0)
                                        <tr>
                                            <td class="payabletitle">Payable Amount:</td>
                                            <td class="">
                                                <div class="payabletitle floatright"><span class="rupeesign">₹</span> {{ $service_amount }} </div></td>     
                                        </tr>
                                    @endif
                                @endif
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                @endif
                <!-- Service Detail Section -->

                <!-- Subscription Detail Section -->
                @if(!empty($detail) && $subscription_section)
                    <div class="new-member-form col-md-12 col-xs-12 col-sm-12 col-lg-12 mar-top select-member-option make-payment">
                        <div class="add-address-box">
                            <h2>Subscription Detail</h2>
                        </div>
                        <div class="address-cont boking-make-payment">
                            <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td class="makepaytitle">Subscription ID:</td>
                                    <td class="makepayobject">{{ strtoupper($detail['user_subscribe_id']) }}</td>
                                </tr>
                                <tr>
                                    <td class="makepaytitle">Customer Name:</td>
                                    <td class="makepayobject">{{ ucwords($detail['customer_name']) }}</td>
                                </tr>
                                <tr>
                                    <td class="makepaytitle">Mobile:</td>
                                    <td class="makepayobject">{{ $detail['contact_number'] }}</td>
                                </tr>
                                <tr>
                                    <td class="makepaytitle">Email:</td>
                                    <td class="makepayobject">{{ $detail['email_address'] }}</td>     
                                </tr>
                                @if(!empty($detail['customer_details']))
                                   
                                    <tr>
                                        <td colspan="2" class="oddtl"><div class="ordertitle"> Subscription Details : </td>
                                    </tr>

                                    @foreach($detail['customer_details'] as $item)
                                        <tr>
                                            <td class="makepaytitle">
                                                <b>{{ ucwords($item['customer_name']) }}</b>
                                            </td>
                                            <td class="makepayservice">        
                                                @if(!empty($item['name']))                                    
                                                    {{ $item['name'] }} 
                                                    <span>
                                                        ({{ $item['total_parameters'] }} Parameters covered)
                                                    </span>
                                                    <div class="priceright">
                                                        <span class="rupeesign">₹</span> {{ (int)$item['price'] }}
                                                    </div>
                                                @endif
                                            </td>     
                                        </tr>
                                    @endforeach
                                @endif
                                @if(isset($subscription_amount))
                                    @if($subscription_amount == 0)
                                        <tr>
                                            <td class="payabletitle">Payable Amount:</td>
                                            <td><div class="payabletitle floatright"><span class="rupeesign">₹</span> {{ (int)$subscription_amount }} </div></td>     
                                        </tr>
                                    @endif
                                @endif
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                @endif
                <!-- Subscription Detail Section -->

                <!-- Payment Section -->
                @if($payment_section)
                    <div class="new-member-form col-md-12 col-xs-12 col-sm-12 col-lg-12 mar-top select-member-option make-payment" id="payment_section">
                        <div class="add-address-box">
                            <h2>
                                Total Payable Amount : <span class="rupeesign">₹</span>

                                @if($booking_section)
                                    @if($online_discount)
                                        {{(int)$detail['payable_amount'] - (int)$online_discount_amount}} <span style="font-size:14px;">(with Online Discount)</span>
                                    @else
                                        {{(int)$detail['payable_amount']}}
                                    @endif
                                @endif

                                @if($service_section)
                                    {{(int)$service_amount}}
                                @endif

                                @if($subscription_section)
                                    {{(int)$subscription_amount}}
                                @endif
                            </h2>
                        </div>
                        <div class="address-cont boking-make-payment" id="payment_section">
                            <div class="bookingmode">
                                <h3>How would you like to pay?</h3>
                                @foreach($payment_options as $key => $payment_option)
                                    <div class="cart-width-payment">
                                        <div class="block">
                                            <div class="payment-div">
                                                <img class="right-space" src="{{ $payment_option['img'] }}">
                                            </div>
                                            <label class="labelpayment" for="{{ $payment_option['id'] }}">
                                                {{ $payment_option['label'] }} 
                                            </label>
                                            <div class="pull-right-radio">
                                                @if($key == 'paytm')
                                                    <input type="radio" id="{{ $payment_option['id'] }}" name="payment_mode" value="{{ $key }}" checked>
                                                @else
                                                    <input type="radio" id="{{ $payment_option['id'] }}" name="payment_mode" value="{{ $key }}">
                                                @endif
                                                <label for="{{ $payment_option['id'] }}"></label>  
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="acceptterms">
                                    <input type="radio" id="terms" name="radio-group" checked>
                                    <label class="acceptpaymentterm" for="terms">I accept the <a style="margin:0px;" class="link-otp" href="{{ url('terms-condition') }}" target="_blank">Terms &amp; Conditions, Disclaimer and Privacy Policy.</a></label>
                                </div>   
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @if($payment_section)
                <div class="col-md-12 col-lg-12 col-xs-12 add-btn add-btns" id="payment_out">
                    <ul>
                        <li>
                            <a href="javascript:void(0);" class="btn btn-danger">Pay Now</a>
                        </li>
                    </ul>
                </div>
            @endif
		</div>
	</div>
</section>
@endsection

@push('footer-scripts')

<script>
    $(document).ready(function(){
        $("#payment_out").click(function(e){
            var payment_mode    = $("input[name='payment_mode']:checked").val();
            var payment_amt     = parseFloat($("input[name='txnAmount']").val());
            if(payment_amt != '' && payment_mode != '') {
                
                pushGaEvent('Make Payment', 'Make Payment Clicks on Complete Order', payment_mode , payment_amt);
                $('<input />').attr('type', 'hidden')
                        .attr('name', "payment_mode")
                        .attr('value', payment_mode)
                        .appendTo('#payment_form');

                if(payment_mode == 'paytm') {
                    $("#payment_form").attr("action", "{{$paytm_payment_url}}");
                }

                if(payment_mode == 'mobikwik') {
                    $("#payment_form").attr("action", "{{$mobikwik_payment_url}}");
                }

                if(payment_mode == 'payu') {
                    $("#payment_form").attr("action", "{{$payu_payment_url}}");
                }
                
                $("#payment_form").submit();
            }
        });
    });
</script>
@endpush