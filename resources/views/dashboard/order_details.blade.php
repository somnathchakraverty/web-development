@extends('layout.master')

@section('page-content')


    <!-- dashbord fairiend wraper---start----mly &f start here -->
    <section class="faimly-friendwraper">

        <div class="fixed-bar">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="asidenavdiv text-left">
                        @include('section.left-dashboard', ['userDetail' => $userDetail])
                    </div>	
                </div>

                <!------aside-end -->
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="Family-headingdiv text-left">
                        <h3>Booking Detail</h3>
                    </div>
                    <div class="Retake-Healthkarmadiv f-div">
                        <!-- informatio Box start -->
                        <div class="row mar-bot toppaneldivide">
                            <div class="col-md-4 col-xs-6 text-center devide infor">
                                <h3><p>Booking ID</p> {{ $booking_details['booking_id'] }}</h3>
                            </div>
                            <div class="col-md-4 col-xs-6 text-center devide infor">
                                <h3><p>Patients</p> {{ count($booking_details['suborders']) }}</h3>
                            </div>
                            <div class="col-md-4 col-xs-12 text-center infor mt_10">
                                <h3><p>Grand Total</p> <span class="rupeesign">₹</span> {{ (int)$booking_details['total_amount'] }}</h3>
                            </div>
                        </div>

                        @foreach ($booking_details['suborders'] as $item)
                            <div class="test_addbox">
                                <div class="row">
                                    <div class="col-sm-12">
                                        
                                        <div class="userinfobar"> 
                                            <strong>{{ ucwords($item['customer_name']) }},</strong>
                                            @if($item['customer_gender'] == 'M')
                                                Male
                                            @elseif($item['customer_gender'] == 'F')
                                                Female
                                            @endif
                                             {{ $item['customer_age'] }} yrs. <br>
                                            <p class="odfastinginfo">Fasting : 
                                            @if((int)$item['fasting_required'] == 1) 
                                                Required, {{$item['fasting_time']}} hours
                                            @else
                                                Not Required 
                                            @endif
                                            </p>                                        
                                        </div>
                                        @foreach ($item['orders'] as $od)
                                            <div class="testdetailinformation">
                                                <h4>{{ $od['display_name'] }}</h4>
                                            <div class="testprices">

                                                <div class="slashedprice">
                                                    <del><span class="rupeesign">₹</span>{{ $od['actaul_price'] }}</del>
                                                </div>
                                                
                                                <div class="healthiansprice">
                                                    <span class="rupeesign">₹</span>{{ $od['healthians_price'] }}
                                                </div>
                                                

                                            </div>
                                            <div class="clearfix"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        <div class="row">
                            <div class="col-md-12">
                            <h3 class="black pdleft20">Track Test Details</h3>
                            <div class="row">
                                <div class="timeline">
                                    <ul>
                                        @foreach ($item['order_status'] as $ot)
                                            @if($ot['flag'])
                                                @if( ($ot['terminal']) &&  in_array($ot['status_id'], [3,13,18]))
                                                    <li class="terminal">
                                                @else
                                                    <li>
                                                @endif
                                            @else
                                                <li class="inprocess">
                                            @endif
                                                
                                            <b> {{ $ot['status_name'] }} </b> 
                                            @if(!empty($ot['date']) && !empty($ot['flag']) && !empty($ot['status_id']))
                                                @if($ot['flag'])
                                                    {{ convertUserVisibleDateWithDayFormat($ot['date']) }}
                                                    @if($ot['status_id'] == 5 || $ot['status_id'] == 7)
                                                        @if(!empty($item['phlebo_name']) && !empty($item['phlebo_mobile']))
                                                            <br>{{ $item['phlebo_name'] }} &nbsp;&nbsp;&nbsp; +91-{{ $item['phlebo_mobile'] }}
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                            </li>                                        
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        </div>


                        @endforeach


                        <div class="address-sample">
                            <h3 class="black pdleft20">Sample Collection Address</h3>
                            <p class="pdleft20 locationwdth"><img src="/img/location.jpg"> {{ ucwords($booking_details['address']) }}</p>
                        </div>
                        <div class="address-sample">
                            <h3 class="black pdleft20">Payment By</h3>

                            <p class="pdleft20 orderpaidstatus">
                                @if(strtolower($booking_details['order_type']) == "cash on delivery")
                                    Cash on Sample Collection
                                @else
                                    Paid {{  ucwords($booking_details['order_type']) }}
                                @endif
                            </p>

                            
                            <div class="clearfix"></div>

                            <div class="amount-area pricedtl">
                                
                                <div class="col-md-6 col-xs-6 lt25">Order Amount</div>
                                <div class="col-md-6 col-xs-6 lt25 text-right"><span class="rupeesign">₹</span> {{ $total_suborder }}</div>
                                <hr class="hr_separate_mar">

                                @if(!empty($booking_details['coupon_code'])) 
                                    <div>
                                        <div class="col-md-6 col-xs-6 lt25">Discount Applied (<span>{{ $booking_details['coupon_code'] }}</span>)</div>
                                        <div class="col-md-6 col-xs-6 lt25 text-right">
                                            - <span class="rupeesign">₹</span> <span>{{ $booking_details['discounted_amount'] }}</span>
                                        </div>
                                    </div>
                                    <hr class="hr_separate_mar">
                                    <div class="clearfix"></div>
                                    
                                @endif

                                @if(strtolower($booking_details['hard_copy']) =='yes') 
                                    <div>
                                        <div class="col-md-6 col-xs-6 lt25">Hard Copy</div>
                                        <div class="col-md-6 col-xs-6 lt25 text-right">
                                            + <span class="rupeesign">₹</span> <span>{{ $hard_copy_price }}</span>
                                        </div>
                                    </div>
                                    <hr class="hr_separate_mar">
                                    <div class="clearfix"></div>
                                @endif

                                @if(strtolower($booking_details['convenience_fee']) =='yes') 
                                    <div>
                                        <div class="col-md-6 col-xs-6 lt25">Convenience Fee</div>
                                        <div class="col-md-6 col-xs-6 lt25 text-right">
                                            + <span class="rupeesign">₹</span> <span>{{ $booking_details['convenience_amount'] }}</span>
                                        </div>
                                    </div>
                                    <hr class="hr_separate_mar">
                                    <div class="clearfix"></div>
                                @endif

                                @if(isset($booking_details['wallet_amount_used'])) 
                                    @if($booking_details['wallet_amount_used'] > 0) 
                                        <div>
                                            <div class="col-md-6 col-xs-6 lt25 ryt-tab">HCash Amount</div>
                                            <div class="col-md-6 col-xs-6 lt25 text-right">
                                                - <span class="rupeesign">₹</span> {{ $booking_details['wallet_amount_used'] }}
                                            </div>
                                        </div>
                                        <hr class="hr_separate_mar">
                                        <div class="clearfix"></div>
                                    @endif
                                @endif

                                @if(isset($booking_details['online_discount'])) 
                                    @if($booking_details['online_discount'] > 0) 
                                        <div>
                                            <div class="col-md-6 col-xs-6 lt25 ryt-tab">Online Discount</div>
                                            <div class="col-md-6 col-xs-6 lt25 text-right">
                                                - <span class="rupeesign">₹</span> {{ $booking_details['online_discount'] }}
                                            </div>
                                        </div>
                                        <hr class="hr_separate_mar">
                                        <div class="clearfix"></div>
                                    @endif
                                @endif
                                
                                @if(isset($booking_details['donation_amount'])) 
                                    @if($booking_details['donation_amount'] > 0) 
                                        <div>
                                            <div class="col-md-6 col-xs-6 lt25 ryt-tab mobheight">Donation Amount<a data-toggle="modal" data-target="#youwecan_visible"><span class="ywctext">(Yuvraj Singh Foundation)</span></a></div>

                                            <div class="col-md-6 col-xs-6 lt25 text-right">
                                                + <span class="rupeesign">₹</span> {{ $booking_details['donation_amount'] }}
                                            </div>
                                        </div>
                                        <hr class="hr_separate_mar">
                                        <div class="clearfix"></div>
                                    @endif
                                @endif

                                
                                <div>
                                    <div class="col-md-6 lt25 col-xs-6 total-pay">Total Billing Amount</div>
                                    <div class="col-md-6 lt25 col-xs-6 total-pay text-right">  <span class="rupeesign">₹</span> {{ (int)$booking_details['total_amount'] }}</div>
                                </div>
                                <hr class="hr_separate_mar">
                                <div class="clearfix"></div>

                                <div>
                                    <div class="col-md-6 lt25 col-xs-6 total-pay">Total Paid Amount</div>
                                    <div class="col-md-6 lt25 col-xs-6 total-pay text-right">  <span class="rupeesign">₹</span> {{ (int)$booking_details['amount_paid'] }}</div>
                                </div>
                                <hr class="hr_separate_mar">
                                <div class="clearfix"></div>
                                
                                <div>
                                    <div class="total-pay lt25 col-xs-6 col-md-6" style="border-bottom:none;">Total Payable</div>
                                    <div class="total-pay lt25 col-xs-6 col-md-6 text-right" style="border-bottom:none;">
                                        <span>  <span class="rupeesign">₹</span> {{ (int)$booking_details['total_amount'] - (int)$booking_details['amount_paid'] }} </span>
                                    </div>
                                </div>
                                <hr class="hr_separate_mar">
                                <div class="clearfix"></div>
                            </div>
                            
                            @if($coupon_notice_div)
                                <div class="pdleft20">
                                    Note : Coupon will not be applicable on discounted/addon product
                                </div>
                            @endif
                        </div>
                         <hr class="hr_separate_mar" style="border:none;">
                                <div class="clearfix"></div>
                    </div>
                </div>	
            </div>
        </div>
    </section>

    <div class="modal fade" id="youwecan_visible" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="ysf_section">
                        <img src="/img/you-we-can-logo.png" class="ysflogo" />
                        <div class="donationInfo">  {!! $donation_details !!}    </div>
                        <p><a class="web-ysf" href="https://www.youwecan.org/" target="_blank">www.youwecan.org</a></p>
                        <div style="margin:0px auto;text-align: center;">
                        </div>
                    </div>
                </div>                  
            </div>
        </div>
    </div>

@endsection
@push('footer-scripts')