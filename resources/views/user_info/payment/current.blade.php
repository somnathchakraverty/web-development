@extends('layout.master')

@section('page-content')
<!-- Product Detail -->
<section class="cart-section">
    <div class="container">

        <div class="booking_timer">
            <h6>Your selected time slot <span id="slot_time_detail"></span> will expire in 15 minutes.</h6>
            <p>Please complete the booking within the given timeframe: 
            <span class="timercountdown" id="timercountdown"></span></p>
        </div>
        <!-- <div class="blog-breadcumbs"></div> -->
        <div class="row">
            <form action="{{ url('payment') }}" id="payment_form" name="payment_form" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="cart_id" value="{{ $cart_id }}">
                <input type="hidden" name="order_amount" value="{{ $limited_price }}">
                <input type="hidden" name="collection_date" value="{{ $collection_date }}">
                <input type="hidden" name="address_id" value="{{ $address_id }}">
                <input type="hidden" name="time_slot_id" id="time_slot_id" value="{{ $slot_id }}">
                <input type="checkbox" name="yuvraj_foundation" style="display:none;" value="{{ $yuvraj_foundation['donation_amt'] }}" checked>
            </form>
            
            
            <input type="hidden" name="coupon_id" value="0">
            <input type="hidden" name="discount" value="0" >
            <input type="hidden" name="new_coupon" value="0" >
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="clear"></div>
                
                <input type="hidden" name="customer_count" value="{{ count($cart_data['customer_detail']) }}">
                
                <!--Customer Info Section -->        
                <div class="cart-div">
                    <div class="heading">Customer Details</div>
                    @foreach($cart_data['customer_detail'] as $customer)
                        @if(count($customer['deals']) == 0)
                            @continue
                        @endif
                        <div class="customercartinfo"><h6>{{ ucfirst($customer['customer_name']) }}, {{ $customer['relation']}}</h6></div>
          
                        <div class="package-rptdiv">
                            @foreach($customer['deals'] as $deal)
                                <div class="cartuserinfo">
                                    <div class="cartusername">
                                        <h5>{{ ucfirst($deal['name']) }}</h5>
                                        <p>Tests Included: {{ $deal['parameterCount'] }}</p>
                                    </div>
                                    <div class="cartpackageinfo">
                                        <div class="pkginfocolumn"> <span>You Save</span>
                                          <p class="blocklabel dscnt">{{ calPer($deal['healthians_price'], $deal['actual_price']) }}% off</p>
                                        </div>
                                        <div class="pkginfocolumn"> <span>Healthians Price</span>
                                          <p class="blocklabel slash"><strike><span class="rupeesign" style="display:inline-block;">₹</span> {{ $deal['actual_price'] }}</strike></p>
                                        </div>
                                        <div class="pkginfocolumn"> <span>Limited Time Offer</span>
                                          <p class="blocklabel mainprice"><span class="rupeesign" style="display:inline-block;">₹</span> {{ $deal['healthians_price'] }}</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <?php $healthians_price += $deal['actual_price']; ?>
                            @endforeach
                            <div class="clear"></div>
                        </div>
                        <div class="clearfix"></div>
                    @endforeach
                </div>
        
        <!--Customer Info Section-->
        
        <!-- <p>&nbsp;</p> -->
        <div class="cart-div">
          <div class="heading">Price Details</div>
          
          <!-- Order Amount -->
          <div class="amount-area pricedtl">
            <div class="col-md-6 col-sm-6">Order Amount</div>
            <div class="col-md-6 col-sm-6 text-right">
              <div class="price"><span class="off">{{ calPer($limited_price, $healthians_price) }}% off</span><strike><span class="rupeesign">₹</span> {{$healthians_price}}</strike> ₹{{ $limited_price }} 
                
                </div>
            </div>
          </div>
          
          {{-- <!-- Sub-Total -->
          <!-- <div class="amount-area pricedtl">
            <div class="col-md-6">Sub-Total</div>
            <div class="col-md-6 text-right">
              <div class="total">₹ {{ $limited_price }}</div>
            </div>
          </div> --> --}}
          
          <!-- Collection Charges -->
         @if($convenience_fee_detail['convenience_fee'] > 0)
                <div class="amount-area pricedtl" id="convenience_fees_div">
                    <div class="col-md-6">Collection Charges <a data-toggle="modal" data-target="#collection_fees_visible">
                        <img class="astrek" src="/img/astrek.png"></a></div>
                    <div class="col-md-6 text-right">
                        <div class="total" id="collection_charges_amt"><span class='rupeesign'>₹</span> {{ $convenience_fee_detail['convenience_fee'] }}</div>
                    </div>
                </div>
            @else 
                <div class="amount-area pricedtl" id="convenience_fees_div" style="display:none;">
                    <div class="col-md-6">Collection Charges <a data-toggle="modal" data-target="#collection_fees_visible">
                        <img class="astrek" src="/img/astrek.png"></a></div>
                    <div class="col-md-6 text-right">
                        <div class="total" id="collection_charges_amt"><span class='rupeesign'>₹</span> </div>
                    </div>
                </div>
            @endif

          <input type="hidden" name="convenience_fee" id="convenience_fee" value="{{ $convenience_fee_detail['convenience_fee'] }}">
          
          <!--Need Hardcopy -->
          <div class="amount-area-panel harcopyrow row no-padding">
                <div class="col-md-6 col-sm-8 col-xs-8">
                    <div class="checkbox checkbox-info checkbox-circle hrdcopyradio">
                  <input id="hard_copy_check" type="checkbox" name="hard_copy" value="{{ $hard_copy_detail['price'] }}">
                    <label class="hard_copytext" for="hard_copy_check">Need a hard copy of report?</label>
                  </div>
                </div>
                <div class="col-md-6 col-sm-4 col-xs-4 text-right">
                    <div class="hardcopyamnt">+ <span class="rupeesign">₹</span> 0</div>
                </div>
            </div>
            <!--Need Hardcopy -->

            <hr class="hr_separate">
          
          <!-- Amount Payable -->
          <div class="amount-area pricedtl padding-bot martoplast">
            <div class="col-md-6">Amount Payable</div>
            <div class="col-md-6 text-right">
              <div class="total payable_amt_before_dis"><span class="rupeesign">₹</span> {{ $payable_amount }}</div>
            </div>
          </div>
        </div>
        
        <!-- Coupon -->
        @if(!empty($coupon_detail))
            <div class="detail-div payment"> 
                <div class="couponapplyopt">
                    <div class="coupontxt" id="coupontxt"><img src="/img/coupon-card.png"> {{ $coupon_detail['coupon_text'] }}</div>
                    <div class="cpninput dark">
                        <input type="text" name="coupon_code" autocomplete="off" >                   

                        <input type="submit" class="addcoupon" value="Add" id="cal_coupon">
                        <input type="submit" class="removecoupon hidden" value="Remove" id="remove_coupon">
                    </div>
                    <div class="coupon_amtdisplay" id="dis_coupon_amt"></div>
                </div>
                <span class="clearfix"></span>

                <div class="row">
                    <div class="col-md-12 col-lg-12" id="coupon_display_message" style="display:none;text-align: right;color: #41a5b8;"></div>
                </div>

                <span class="clearfix"></span>
                <div class="row">
                    <div class="col-md-4">&nbsp;</div>
                    <div class="col-md-5 col-lg-5">
                        @if($cart_data['restrict_coupon'])
                            <div>
                                <span>Coupon does not applicable on selected package</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="detail-div">
                
                <div class="couponapplyopt">

                    <div class="coupontxt" id="coupontxt"><img src="/img/coupon-card.png"> Apply Coupon here</div>

                    <div class="cpninput dark">
                        <input type="text" name="coupon_code" autocomplete="off" >
                        <!-- <input type="submit" value="Apply" id="cal_coupon"> -->

                        <input type="submit" class="addcoupon" value="Add" id="cal_coupon">
                        <input type="submit" class="removecoupon hidden" value="Remove" id="remove_coupon">

                    </div>
                    <div class="coupon_amtdisplay" id="dis_coupon_amt"></div>

                </div>
                <span class="clearfix"></span>

                <div class="row">
                    <div class="col-md-12 col-lg-12" id="coupon_display_message" style="display:none;text-align: right;color: #41a5b8;"></div>
                </div>

                <span class="clearfix"></span>
                
                <div class="row">
                    <div class="col-md-4">&nbsp;</div>
                    <div class="col-md-5 col-lg-5">
                        @if($cart_data['restrict_coupon'])
                            <div>
                                <span>Coupon does not applicable on selected package</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        <input type="hidden" name='coupon_discount' value="0">
        <!-- Gift Coupon -->
<!--        <div class="detail-div payment"> <img src="/img/gift-card.png"> Enter  Refer Code to get 1000 rs  discount on your first Booking
          <div class="coupon">
            <form method="post" class="dark">
                <input type="text" placeholder="RAJU7572808">
                <input type="submit" value="Apply">
            </form>
          </div>
        </div>-->
           
      

        <!-- Hcash options -->
        <div class="detail-div hcashpayment  amount-area pricedtl padding-bot martoplast">
            <div class="divider row">
                <div class="col-sm-6 col-xs-6 col-md-6">
                      <div class="checkbox checkbox-info checkbox-circle">
                        <input id="hcash_field_detail" type="checkbox" name="hcash_value" value="{{$ecashAmount}}">
                        <label class="hcash_val" for="hcash_field_detail"> </label>
                        HCASH Amount <a data-toggle="modal" data-target="#modal_visible" title="Hcash Usage Rule" id="hcash_modal"><img class="astrek1" src="/img/astrek.png"></a><br>
                        <span class="availablewallet">(Available Balance <span class="rupeesign">₹</span> {{ $available_wallet_point }}) </span> 
                    </div>  
                    @if($cart_data['restrict_hcash'])
                        <div>
                            <span>{{$cart_data['restrict_hcash_message']}}</span>
                        </div>
                    @endif
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="text-right rght">
                        <div class="total" id="ecashAmount"></div>    
                    </div>
                </div>
            </div>
            <div class="amount-area padding-bot amount-pay">
                <div class="col-md-6">Total Amount</div>
                <div class="col-md-6 text-right">                
                    <div class="total amt_after_discount"><span class="rupeesign">₹</span> {{ $payable_amount }}</div>
                </div>
            </div>            
        </div>

        <div class="detail-div ">
            @if(isset($convenience_fee_detail['onlineDiscountAmount']) && ($convenience_fee_detail['onlineDiscountAmount'] > 0))
                <div class="amount-area pricedtl" id="online_discount_div">
                  <div class="col-md-6 no-padding">Online Discount
                  </div>
                  <div class="col-md-6 text-right">                  
                      <div class="total">
                          <span id="online_discount_amt_detail"> - <span class="rupeesign">₹</span> {{ $convenience_fee_detail['onlineDiscountAmount'] }} <br>
                          </span>
                      </div>
                  </div>
                </div>
                <input type="hidden" name="online_discount" id="online_discount_detail" value="{{ $convenience_fee_detail['onlineDiscountAmount'] }}">
            @else
                <input type="hidden" name="online_discount" id="online_discount_detail" value="0">
            @endif
            <div class="amount-area pricedtl">
              <div class="col-md-6 col-sm-6 col-xs-6 no-padding">Make a Change <a data-toggle="modal" data-target="#modal_visible" title="Yuvraj Foundation" id="donation_modal"><img class="astrek" src="/img/astrek.png"></a>

                <p>{{ $yuvraj_foundation['label'] }}</p>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                  <div class="total">
                      <span id="donation_amt_detail"> <span class="rupeesign">₹</span> {{ $yuvraj_foundation['donation_amt'] }} <br>
                        <p class="removes remove_yuvraj_foundation" style="cursor:pointer;">Remove</p>
                      </span>
                  </div>
              </div>
            </div>
        </div>


        <!--Total payable amount-->
        <div class="detail-div-main mar-bot">
            <div class="amount-area pricedtlamnt">
                <div class="col-md-6 no-padding" style="color:#fff;">Total Payable Amount</div>
                <div class="col-md-6 text-right">                
                    <div class="total payblamnt final_payable_amt" id="final_payable_amt"><span class="rupeesign">₹</span> {{ $payable_amount }}</div>
                </div>
            </div>                 
            <input type="hidden" name="payable_amount" value="{{ $payable_amount }}">  
         </div>
         <!--Total payable amount ends-->




        <!-- Payment options -->
        <div class="detail-div payment">
            <h3 class="black">Payment Options</h3>
            @php($i = 0)
            <?php // dd($payment_options); ?>
            @foreach($payment_options as $key => $payment_option)
                <div class="cart-width-payment">
                    <div class="block">
                        <div class="row">
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="col-md-1 col-sm-2 col-xs-3 no-padding">
                                    <div class="payment-div">
                                        <img class="right-space img-responsive" src="{{ $payment_option['img'] }}">
                                    </div>
                                </div>
                                <div class="col-md-11 col-sm-10 col-xs-9 no-padding">
                                <label class="labelpayment"
                                       for="{{ $payment_option['id'] }}">{{ $payment_option['label'] }} </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <div class="pull-right-radio" style="position:relative;bottom:10px;">
                                    @if($key == 'paytm')
                                        <input type="radio" id="{{ $payment_option['id'] }}" name="payment_mode"
                                               value="{{ $key }}" data-couponcode="{{ $payment_option['coupon_code'] }}" checked>
                                    @else
                                        <input type="radio" id="{{ $payment_option['id'] }}" name="payment_mode"
                                               value="{{ $key }}" data-couponcode="{{ $payment_option['coupon_code'] }}">
                                    @endif
                                    <label for="{{ $payment_option['id'] }}"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <span class="clearfix"></span>
            <br/>
            <div class="col-md-12">
                <div class="acceptterms">
                    <input type="radio" id="terms" name="term_check" checked="true" disabled="true">
                    <label class="acceptpaymentterm" for="terms">I accept the <a style="margin:0px;" class="link-otp" href="{{ url('terms-condition') }}" target="_blank">Terms &amp; Conditions, Disclaimer and Privacy Policy.</a></label>
                </div>
            </div>
            <div class="col-md-12 text-left completeorder">
                <a href="javascript:void(0)" class="btn btn btn-danger btn_cmncolor" id="payment_out">Complete Order <img class="lazy-loaded" data-src="/img/left-icon-sml.png" src="/img/left-icon-sml.png"></a>
            </div>
        </div> 
      </div>
    </div>
  </div>
  </div>
</section>

<div class="modal fade" id="collection_fees_visible" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="ysf_section">
                    <div class="donationInfo"> {!! $convenience_fee_detail['convenienceFeeInfo'] !!} </div>
                    <div style="margin:0px auto;text-align: center;">
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<div class="modal fade" id="modal_visible" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="ysf_section donation_modal_Info hidden">
                    <img src="/img/you-we-can-logo.png" class="ysflogo" />
                    <div> {!! $convenience_fee_detail['donation_info'] !!} </div>
                    <p><a class="web-ysf" href="https://www.youwecan.org/" target="_blank">www.youwecan.org</a></p>
                    <div style="margin:0px auto;text-align: center;">
                    </div>
                </div>
                <div class="ysf_section hcash_modal_info hidden">
                    <!--Varun-->
                    <div> {!! $userEwallet['walletTnC'] !!} </div>       
                    <div style="margin:0px auto;text-align: center;">
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection
@push('footer-scripts')
    <script type="text/javascript" src="/js/bootbox.js"> </script>
    <script type="text/javascript">
        var best_payment_mode   =   "{{$best_payment_mode}}";
        var cart_amount         =   "{{ $limited_price }}";
        var active_coupon_info  =   <?php echo json_encode($active_coupon_info); ?>;
       
        
        if (localStorage.getItem('collection_time') != null) {
            $("#slot_time_detail").html(localStorage.getItem('collection_time'));
        }
        var restrict_hcash      =   0;
        var restrict_coupon     =   0;
        var allow_to_proceed    =   0;
        <?php if($cart_data['restrict_hcash']) {?> 
            restrict_hcash      =   1;
        <?php   } if($cart_data['restrict_coupon']) {?>
            restrict_coupon     =   1;
        <?php   } if($cart_data['allow_to_proceed']) {?>
            allow_to_proceed    =   1;
        <?php } ?>  
        // Timer calculation
        // 15 minutes from now
        var time_in_minutes =   15;
        var current_time    =   Date.parse(new Date());
        var deadline        =   new Date(current_time + time_in_minutes*60*1000);
        var max_hcash_value =   "{{$ecashAmount}}";
        var hcashType       =   "{{$ecashAmountType}}";
        var available_wallet_point = "{{$available_wallet_point}}";
        
        function time_remaining(endtime){
                var t = Date.parse(endtime) - Date.parse(new Date());
                var seconds = Math.floor( (t/1000) % 60 );
                var minutes = Math.floor( (t/1000/60) % 60 );
                var hours = Math.floor( (t/(1000*60*60)) % 24 );
                var days = Math.floor( t/(1000*60*60*24) );
                return {'total':t, 'days':days, 'hours':hours, 'minutes':minutes, 'seconds':seconds};
        }
        function run_clock(id,endtime){
                var clock = document.getElementById(id);
                function update_clock(){
                        var t = time_remaining(endtime);
                        clock.innerHTML = t.minutes+'m : '+t.seconds+'s';
                        if(t.total<=0){ $( "#payment_out" ).trigger( "click" ); clearInterval(timeinterval); }
                }
                update_clock(); // run function once at first to avoid delay
                var timeinterval = setInterval(update_clock,1000);
        }
        run_clock('timercountdown',deadline);
        // End Clock Time
        
        
        function calPayableAmount(){   
            var payment_mode        =   $("input[name='payment_mode']:checked").val();
            var online_discount     =   0;
            if(payment_mode != 'cash'){
                online_discount     =   parseFloat($("input[name='online_discount']").val());
                $('#online_discount_div').removeClass('hidden');
            }else{
                $('#online_discount_div').addClass('hidden');
            }
            var convenience_fee     =   parseFloat($("input[name='convenience_fee']").val());
            if($("input[name='yuvraj_foundation']").is(':checked'))
                var yuvraj_foundation = parseFloat($("input[name='yuvraj_foundation']").val());
            else
                var yuvraj_foundation = 0;
            var order_amount        =   parseFloat($("input[name='order_amount']").val());
            if($("input[name='hard_copy']").is(':checked'))
                var hard_copy = parseFloat($("input[name='hard_copy']").val());
            else
                var hard_copy = 0;
            $(".hardcopyamnt").html("+ <span class='rupeesign'>₹</span> "+hard_copy);
            
            var payable_amt_before_dis = convenience_fee + order_amount + hard_copy;
            
            $(".payable_amt_before_dis").html("<span class='rupeesign'>₹</span> "+payable_amt_before_dis);
            
            if(restrict_coupon){
                $("input[name='coupon_code']").val("");
                $("input[name='coupon_code']").attr("disabled", true);
                $("#cal_coupon").prop('disabled', false);
                $("#remove_coupon").prop('disabled', false);
                coupon_discount     =   0;
                $("input[name='coupon_discount']").val(coupon_discount);
            }
            
            var coupon_discount     =   parseFloat($("input[name='coupon_discount']").val());    
            var total_order_amt     =   hard_copy + convenience_fee + order_amount;
            var payable_amt         =   hard_copy + convenience_fee + order_amount;
            if(coupon_discount > payable_amt){
                coupon_discount =   payable_amt;
                $("input[name='coupon_discount']").val(coupon_discount);
                $("input[name='discount']").val(coupon_discount);
                $("#dis_coupon_amt").html("- <span class='rupeesign'>₹</span> "+coupon_discount);                                
            }
            payable_amt =   payable_amt -   coupon_discount;

            if($("input[name='hcash_value']").is(':checked')){
                var max_hcash = max_hcash_value;
                if(hcashType == 'percentage') {
                    max_hcash = Math.round((max_hcash/100) * payable_amt);
                }

                if(max_hcash > available_wallet_point) {
                    max_hcash =  available_wallet_point;
                }

                $("#hard_copy_check").attr('disabled',true);
                $("#cal_coupon").prop('disabled', true);
                $("#remove_coupon").prop('disabled', true);
                $("input[name='coupon_code']").attr("disabled", true);
                if($("input[name='coupon_discount']").val() == 0)
                    $("input[name='coupon_code']").val('');
                $("#ecashAmount").html("<div class='total'>- <span class='rupeesign'>₹</span> "+max_hcash+"</div><span class='maxapplicable'>*Maximum Applicable</span>");
                var hcash_value = parseFloat(max_hcash);
            }else{
                $("#hard_copy_check").attr("disabled", false);
                if($("input[name='coupon_discount']").val() > 0)
                    $("input[name='coupon_code']").attr("disabled", true);
                else
                    $("input[name='coupon_code']").attr("disabled", false);
                $("#cal_coupon").prop('disabled', false);
                $("#remove_coupon").prop('disabled', false);
                $("#ecashAmount").html("");
                var hcash_value = 0;
            }
            
            if(restrict_hcash){
                $("#hcash_field_detail").prop('disabled', true);
                hcash_value     =   0;
            }

            if(hcash_value > payable_amt){
                hcash_value         =   payable_amt;
                $("#ecashAmount").html("<div class='total'>- <span class='rupeesign'>₹</span> "+payable_amt+"</div><span class='maxapplicable'>*Maximum Application</span>");
                $("input[name='hcash_value']").val(hcash_value);
            }else{
                $("input[name='hcash_value']").val(hcash_value);
            }
            
            payable_amt =   payable_amt - hcash_value;

            if(payable_amt > 0 && online_discount > 0){
                $('#online_discount_div').removeClass('hidden');
                if(payable_amt > online_discount){
                    payable_amt =   payable_amt -   online_discount;
                    $("#online_discount_amt_detail").html(" - <span class='rupeesign'>₹</span> "+online_discount+ "<br>");
                }else{
                    online_discount =   payable_amt;
                    $("#online_discount_amt_detail").html(" - <span class='rupeesign'>₹</span> "+payable_amt+ "<br>");
                    payable_amt =   0;
                }
            }else{        
                online_discount =   0;
                $('#online_discount_div').addClass('hidden');
            }
            
            var final_payable_amt = hard_copy + convenience_fee + order_amount - coupon_discount - hcash_value;
            
            $(".amt_after_discount").html("<span class='rupeesign'>₹</span> "+final_payable_amt);
            final_payable_amt   =   final_payable_amt + yuvraj_foundation - online_discount;
            $("input[name='payable_amount']").val(final_payable_amt);
            $(".final_payable_amt").html("<span class='rupeesign'>₹</span> "+final_payable_amt+"/-");
            
            if(final_payable_amt == 0){
                $("input[value='cash']").prop('checked', true);
                $("input[name='payment_mode']:checked").val('cash');
                $("input[name='payment_mode']").prop('disabled', true);
            }else{
                $("input[name='payment_mode']").prop('disabled', false);
            }
        }
        
        function changeCouponCode(payment_mode, coupon_detail){   
            if(($.type(coupon_detail) == 'object') && coupon_detail.hasOwnProperty('couponId')){
                $("input[name='coupon_id']").val(coupon_detail.couponId);
                $("input[name='discount']").val(coupon_detail.discountAmount);
                $("input[name='new_coupon']").val(1);
                $("input[name='coupon_code']").val(coupon_detail.coupon_code.toUpperCase());
                
                $("input[name='coupon_discount']").val(coupon_detail.discountAmount);
                $("#cal_coupon").addClass('hidden');
                $("#remove_coupon").removeClass('hidden');
                $("input[name='coupon_code']").attr("disabled", true);
                $("#dis_coupon_amt").html("- <span class='rupeesign'>₹</span> "+coupon_detail.discountAmount);
                var coupontxt   = "Best Coupon <b>"+coupon_detail.coupon_code.toUpperCase()+"</b> is applied to get <b><span class='rupeesign'>₹</span>"+coupon_detail.discountAmount+"</b> discount on payment via <b>"+payment_mode.toUpperCase()+"</b>";
                $("#coupontxt").html('<img src="/img/coupon-card.png">  '+coupontxt);
            }else{
                $("input[name='coupon_discount']").val(0);
                $("#cal_coupon").removeClass('hidden');
                $("#remove_coupon").addClass('hidden');
                $("input[name='coupon_code']").attr("disabled", false);
                $("input[name='coupon_code']").val("");
                
                $("#dis_coupon_amt").html("");
                $("input[name='coupon_id']").val(0);
                $("input[name='discount']").val(0);
                $("input[name='new_coupon']").val(0);
                $("#coupontxt").html('<img src="/img/coupon-card.png"> Apply coupon here');
            }
            $("#coupon_display_message").hide();
        }

        $(document).ready(function(){
            
            $("#hcash_modal").click(function (e){
                $(".donation_modal_Info").addClass("hidden");
                $(".hcash_modal_info").removeClass("hidden");
            });
    
            $("#donation_modal").click(function (e){
                $(".hcash_modal_info").addClass("hidden");
                $(".donation_modal_Info").removeClass("hidden");
            });
            
            $("input[name='yuvraj_foundation']").prop('checked', true);
            
            $('input[name="coupon_code"]').keypress(function (e) {
                var key = e.which;
                if(key == 13)  // the enter key code
                {
                    $('#cal_coupon').click();
                    return false;  
                }
            }); 
            
            $("#payment_out").click(function(e){
                var hard_copy           =   'no';
                var yuvraj_foundation   =   0;
                var hcash_value         =   0;
                var term_check          =   0;
                var source_detail       =   'web';
                var coupon_id           =   $("input[name='coupon_id']").val();
                var discount            =   $("input[name='discount']").val();
                var new_coupon          =   $("input[name='new_coupon']").val();
                var coupon_code         =   $("input[name='coupon_code']").val();
                
                if (isMobile.any()) 
                  source_detail = 'mobile';

                if (typeof(fbq) !== 'undefined') {
                    var fb_data = <?php echo json_encode($fb_pixel) ?>;
                    if(fb_data !== '') {
                        fb_data['payment']  =   $("input[name='payment_mode']:checked").val();
                        fbq('track', 'AddPaymentInfo', fb_data);
                    }                    
                }

                if($("input[name='hcash_value']").is(':checked'))
                    hcash_value  =   $("input[name='hcash_value']").val();
                
                if($("input[name='yuvraj_foundation']").is(':checked'))
                    yuvraj_foundation   =   parseFloat($("input[name='yuvraj_foundation']").val());
                
                if($("input[name='hard_copy']").is(':checked'))
                    hard_copy = 'yes';
                
                if($("input[name='term_check']").is(':checked'))
                    term_check = 1;
                
                var payment_mode = $("input[name='payment_mode']:checked").val();
                var payment_amt = parseFloat($("input[name='payable_amount']").val());
                
                pushGaEvent('Make Payment', 'Clicks on Complete Order', payment_mode, payment_amt);
                
                if(payment_amt == undefined){
                    showStrError("warning" ,"Please accept our condition");
                }else if(payment_mode == '' || payment_mode == undefined){
                    showStrError("warning" ,"Payment amount should be required");
                }else if(term_check == 0){
                    showStrError("warning" ,"Please accept our condition");
                }else if(payment_amt != undefined && payment_mode != ''){
                    if(coupon_id != 0)
                        $('<input />').attr('type', 'hidden')
                            .attr('name', 'coupon_id')
                            .attr('value', coupon_id)
                            .appendTo('#payment_form');
                    if(discount != 0)
                        $('<input />').attr('type', 'hidden')
                            .attr('name', 'discount')
                            .attr('value', discount)
                            .appendTo('#payment_form');
                    if(new_coupon != 0)
                        $('<input />').attr('type', 'hidden')
                            .attr('name', 'new_coupon')
                            .attr('value', new_coupon)
                            .appendTo('#payment_form');
                    if(coupon_code !=  ''){
                        coupon_code =   coupon_code.toUpperCase();
                        $('<input />').attr('type', 'hidden')
                            .attr('name', 'coupon_code')
                            .attr('value', coupon_code)
                            .appendTo('#payment_form');
                    }
                    $('<input />').attr('type', 'hidden')
                            .attr('name', "payment_mode")
                            .attr('value', payment_mode)
                            .appendTo('#payment_form');
                    $('<input />').attr('type', 'hidden')
                            .attr('name', "hard_copy")
                            .attr('value', hard_copy)
                            .appendTo('#payment_form');
                    $('<input />').attr('type', 'hidden')
                            .attr('name', "donation_amount")
                            .attr('value', yuvraj_foundation)
                            .appendTo('#payment_form');
                    $('<input />').attr('type', 'hidden')
                            .attr('name', "txnAmount")
                            .attr('value', payment_amt)
                            .appendTo('#payment_form');                    
                    $('<input />').attr('type', 'hidden')
                            .attr('name', "eCashAmount")
                            .attr('value', hcash_value)
                            .appendTo('#payment_form');
                    $('<input />').attr('type', 'hidden')
                            .attr('name', "source")
                            .attr('value', source_detail)
                            .appendTo('#payment_form');

                    $("#payment_form").submit();
                }
            }); 
            
            $( "input[name='payment_mode']" ).change(function() {
                pushGaEvent('Make Payment', 'Selects '+$(this).val(), parseFloat($("input[name='payable_amount']").val()));
                var coupon_id    =   $(this).data("couponcode");
                if(($.type(active_coupon_info) == 'object') && active_coupon_info.hasOwnProperty(coupon_id)){
                    changeCouponCode($(this).data("couponcode"), active_coupon_info[coupon_id]);
                    getConvenienceAmount();
                } else{
                    if($("input[name='coupon_code']").val() != '')
                        $("#cal_coupon").trigger('click');
                    else{
                        getConvenienceAmount();
                    }
                }
            });
            
           
            if(($.type(active_coupon_info) == 'object') && (active_coupon_info.hasOwnProperty(best_payment_mode))){
                $("input:radio[data-couponcode='"+best_payment_mode+"']").prop("checked", true).trigger('change');
                changeCouponCode(best_payment_mode, active_coupon_info[best_payment_mode]);
                getConvenienceAmount();
            }
                        
            calPayableAmount();
            
            $(document).on("click",".remove_yuvraj_foundation",function() {
                var checkBoxes = $("input[name='yuvraj_foundation']");
                checkBoxes.prop("checked", !checkBoxes.prop("checked"));
                if(checkBoxes.is(':checked')){
                    var y_fHtml = "<span class='rupeesign'>₹</span> "+checkBoxes.val()+"/- <br><p class='removes remove_yuvraj_foundation' style='cursor:pointer;'>Remove</p>";
                    $("#donation_amt_detail").html(y_fHtml);
                }else{
                    var y_fHtml = "<span class='rupeesign'>₹</span> 0 <br><p class='add remove_yuvraj_foundation' style='cursor:pointer;'>Add</p>";
                    $("#donation_amt_detail").html(y_fHtml);

                }
                calPayableAmount();
            });
            
            $("#hcash_field_detail" ).click(function() {
                calPayableAmount();
            });
            
            $("#hard_copy_check" ).click(function() {
                getConvenienceAmount();
                if($("input[name='hard_copy']").is(':checked'))
                    pushGaEvent('Order Summary', 'Checked Hard Copy');
            });
            
                
            $("#remove_coupon").click( function(){
                pushGaEvent('Make Payment', 'Remove Coupon', $("input[name='coupon_code']").val());
                $("input[name='coupon_discount']").val(0);
                $("#cal_coupon").removeClass('hidden');
                $("#remove_coupon").addClass('hidden');
                $("input[name='coupon_code']").attr("disabled", false);
                $("input[name='coupon_code']").val("");
                $("#dis_coupon_amt").html("");
                $("input[name='coupon_id']").val(0);
                $("input[name='discount']").val(0);
                $("input[name='new_coupon']").val(0);
                $("#coupon_display_message").hide();
                getConvenienceAmount();
            });
            
            $("#cal_coupon").click( function(){
                var cart_id         =   $("input[name='cart_id']").val();
                var payment_gateway =   $("input[name='payment_mode']:checked").val();
                var total_customer  =   $("input[name='customer_count']").val();
                var payment_amount  =   $("input[name='order_amount']").val();
                var couponCode      =   $("input[name='coupon_code']").val();
                
                $("input[name='coupon_id']").removeAttr('value');
                $("input[name='discount']").removeAttr('value');
                $("input[name='new_coupon']").removeAttr('value');
                
                var device_source   =   'web';
                
                if(couponCode == undefined || couponCode == ''){
                    toastr.error( 'Coupon code is required', 'Error!', {timeOut: 2000} )
                }else{                    
                    pushGaEvent('Make Payment', 'Applied Coupon', couponCode);
                }
                if( (payment_gateway != undefined && payment_gateway != '') && (total_customer != undefined && total_customer != '') && (payment_amount != undefined && payment_amount != '') && (couponCode != undefined && couponCode != '')){
                    var url = "{{ url('check-coupon') }}";
                    var values = { 'cart_id' : cart_id, 'payment_gateway' : payment_gateway,  'total_customer' : total_customer, 'payment_amount' : payment_amount, 'couponCode' : couponCode, 'device_source' : device_source};
                    $.ajax({
                        url: url,
                        type: 'get',
                        data: values ,
                        dataType: "json",
                        beforeSend: function() {
                            $("#ajax-loader").show();
                            $("input[name='coupon_discount']").val(0);
                            $("#dis_coupon_amt").html("");
                        },
                        success: function (response) {
                            $("#ajax-loader").hide();
                            if(response.status){
                                $("input[name='coupon_id']").val(response.data.coupon_id);
                                $("input[name='discount']").val(response.data.discount);
                                $("input[name='new_coupon']").val(response.data.new_coupon);
                                
                                $("input[name='coupon_discount']").val(response.data.discount);
                                $("#cal_coupon").addClass('hidden');
                                $("#remove_coupon").removeClass('hidden');
                                $("input[name='coupon_code']").attr("disabled", true);
                                $("#dis_coupon_amt").html("- <span class='rupeesign'>₹</span> "+response.data.discount);
                                $("#coupon_display_message").show();
                                var coup_msg = response.message;                                
                                $("#coupon_display_message").html(coup_msg.charAt(0).toUpperCase() + coup_msg.slice(1));
                                getConvenienceAmount();
                                pushGaEvent('Make Payment', 'Successfully Applied Coupon', couponCode);
                            }else{
                                $("#coupon_display_message").hide();
                                pushGaEvent('Make Payment', 'Failed to Apply Coupon', couponCode);
                                response.message
                            }
                            
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            var jsonResponseText = $.parseJSON(jqXHR.responseText);
                            toastr.error( jsonResponseText.message, 'Error!', {timeOut: 5000} )
                            $("#ajax-loader").hide();
                            $("#coupon_display_message").hide();
                            getConvenienceAmount();
                            pushGaEvent('Make Payment', 'Failed to Apply Coupon', couponCode);
                            $("input[name='coupon_code']").val("");
                            return false;
                        }
                    });
                }                
            });
        });

        function getConvenienceAmount() {
            var order_amount = getTotalPackageWithHardCopyCouponAmount();
            var time_slot_id = $("#time_slot_id").val();
            if(order_amount > 0 && time_slot_id !== '') {
                var values  = { 'order_amount' : order_amount, 'time_slot_id' : time_slot_id };
                var url     = "{{ url('getConvenienceFee') }}";

                $.ajax({
                    url: url,
                    type: 'get',
                    data: values ,
                    dataType: "json",
                    beforeSend: function() {
                        $("#ajax-loader").show();
                    },
                    success: function (response) {
                        $("#ajax-loader").hide();
                        if(response) {
                            if(response.status){
                                var convenience_fees_data = response.data;
                                $("#convenience_fee").val(convenience_fees_data.convenience_fee);
                                if(convenience_fees_data.convenience_fee > 0) {
                                    $("#convenience_fees_div").show();                                    
                                    $("#collection_charges_amt").html("<span class='rupeesign'>₹</span> "+convenience_fees_data.convenience_fee);
                                }
                                else {
                                    $("#convenience_fees_div").hide();
                                }
                                calPayableAmount();
                            }
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var jsonResponseText = $.parseJSON(jqXHR.responseText);
                        $("#ajax-loader").hide();
                        calPayableAmount();
                        return false;
                    }
                });
            }            
        }

        function getTotalPackageWithHardCopyCouponAmount() {
            var total_amount    = parseFloat(cart_amount);
            var coupon_discount = 0;

            if($("input[name='hard_copy']").is(':checked'))
                var hard_copy = parseFloat($("input[name='hard_copy']").val());
            else
                var hard_copy = 0;
            
            total_amount      +=  hard_copy;
            
            
            if(restrict_coupon){
                coupon_discount     =   0;
            }
            
            coupon_discount     =   parseFloat($("input[name='coupon_discount']").val());    
            total_amount       -=   coupon_discount;
            return total_amount;
        }
        
    </script>
@endpush