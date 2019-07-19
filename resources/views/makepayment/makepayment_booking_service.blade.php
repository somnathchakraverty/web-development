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

                    <input type="hidden" name="booking_id" value="{{ $detail['booking_id'] }}" />
                    <input type="hidden" name="service_booking_id" value="{{ $service_booking_id }}" />
                    <input type="hidden" name="txnAmount" value="{{ $total_booking_service_amount }}" />
                    <input type="hidden" name="payment_type_source" value="booking_service">
                </form>

                <!-- Booking + Service Section -->
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
                                    <tr>
                                        <td class="makepaytitle">Booking Date:</td>
                                        <td class="makepayobject">{{ convertUserVisibleDateFormat($detail['order_date']) }}</td>     
                                    </tr>
                                    @if(!empty($detail['orderDetail']))
                                       
                                        <tr>
                                        <td colspan="2" class="oddtl">
                                            <div class="ordertitle"> Order Details : </div></td>
                                    </tr>
                                        
                                        @if($payatcollection > 0)
                                            <tr>
                                                <td class="makepaytitle">
                                                    Order Total Price :                                                 
                                                </td>
                                                <td class="makepayobject">                                               
                                                    <span>
                                                        <b><span class="rupeesign">₹</span> {{ $payatcollection }}</b>
                                                    </span>                                                
                                                </td>
                                            </tr>
                                        @endif

                                        @foreach($detail['orderDetail'] as $item)
                                            <tr>
                                                <td class="makepaytitle">
                                                    <b class="pl30">{{ ucwords($item['cust_name']) }}</b>
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
                                    
                                    @if(!empty($detail['service_details']))
                                      

                                        <tr>
                                            <td colspan="2" class="oddtl">
                                                <div class="ordertitle"> Service Details : </div>
                                            </td>
                                        </tr>

                                        @if($service_amount > 0)
                                            <tr>
                                                <td colspan="2" class="makepaytitle">
                                                    Total Service Price :
                                                </td>
                                                <td class="makepayobject">                                                
                                                    <span>
                                                        <b><span class="rupeesign">₹</span> {{ $service_amount }}</b>
                                                    </span>                                               
                                                </td>
                                            </tr>
                                        @endif
                                        
                                        <tr>
                                            <td class="makepaytitle">Service ID:</td>
                                            <td class="makepayobject">{{ strtoupper($detail['service_details']['service_booking_id']) }}</td>  
                                        </tr>
                                        
                                        @if(!empty($detail['service_details']['customer_details']))
                                            @foreach($detail['service_details']['customer_details'] as $item)
                                                <tr>
                                                    <td class="makepaytitle">
                                                        <b class="pl30">{{ ucwords($item['customer_name']) }}</b>
                                                    </td>
                                                    <td class="makepayobject">        
                                                        @if(!empty($item['service']))                                    
                                                            @foreach($item['service'] as $key => $pck)
                                                                {{ $pck['service_name'] }}  
                                                                <div class="priceright">₹ {{ (int)$pck['order_price'] }}</div>
                                                                @if($key < (count($item['service'])-1))
                                                                    <br>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </td>     
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endif
                                    @if(isset($service_amount) && isset($payatcollection))
                                        @if(($service_amount == 0) && ($payatcollection == 0))
                                            <tr>
                                                <td class="payabletitle">Payable Amount:</td>
                                                <td class=""><div class="payabletitle floatright"><span class="rupeesign">₹</span> {{ $total_booking_service_amount }} </div></td>     
                                            </tr>
                                        @endif
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                @endif
                <!-- Booking + Service Section  -->

                <!-- Payment Section -->
                @if($payment_section)
                    <div class="new-member-form col-md-12 col-xs-12 col-sm-12 col-lg-12 mar-top select-member-option make-payment" id="payment_section">
                        <div class="add-address-box">
                            <h2>
                                Total Payable Amount : <span class="rupeesign">₹</span>

                                @if($booking_section)
                                    {{ $total_booking_service_amount }}
                                @endif
                            </h2>
                        </div>
                        <div class="address-cont boking-make-payment" id="payment_section">
                            <div class="left-booking">
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
                                <div class="acceptterms" style="padding-left:0px;">
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