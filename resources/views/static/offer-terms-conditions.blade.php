@extends('layout.master')

@section('page-content')

<style>
.mid_panel {
    max-width: 1140px;
    margin: 0px auto;
}
.terms-conditions{ margin:0px; padding:0px 10px; font-size:13px; font-family: 'Lato', sans-serif; color:#676767;  line-height:18px;}
.terms-conditions p{ margin:0px; padding:0 0 5px 0px; text-align:justify; font-family: 'Lato', sans-serif;  }
.terms-conditions p strong{ font-weight:normal; font-weight:bold; color:#585858;}
.terms-conditions ol li{margin:0px; padding:0 0 5px 0px; text-align:justify; list-style-type:square;}
.terms-conditions ol{ margin:0px; padding:0px 0px 0px 15px;}
.terms-conditions h3{ margin:7px 0px 10px 0px;  font-weight:bold; color:#404040; padding:0px; font-size:14px;}
.terms-conditions h1{ margin:27px 0px 10px 0px; color:#00a0a8; font-weight:normal;font-family: 'Lato', sans-serif; font-size:22px;}
</style>

{!! $content !!}

{{-- <div class="clear"></div>
<section class="about-content">
   <div class="mid_panel">
      <section class="terms-conditions">
         <div class="terms-conditions">
            <h1>Offer Term & Conditions</h1>
            <ul>
               <li style="font-size:14px; padding-bottom:7px;"> - Flat 20% off on all online test bookings using code - HEALTH20 on the payment page.</li>
               <li style="font-size:14px; padding-bottom:7px;"> - Only one promo code is applicable per booking.</li>
               <li style="font-size:14px; padding-bottom:7px;"> - The offer is valid till for fixed period of time and is applicable for all cities</li>
               <li style="font-size:14px; padding-bottom:7px;"> - HEALTH20 is applicable on minimum cart value of <span class="rupeesign">₹</span>1000</li>
               <li style="font-size:14px; padding-bottom:7px;"> - The offer is applicable only on bookings via website and app.</li>
               <li style="font-size:14px; padding-bottom:7px;"> - Offer valid till <b>31st March, 2019</b>.</li>
               <li style="font-size:14px; padding-bottom:7px;"> - Minimum order value <b><span class="rupeesign">₹</span>1000</b></li>
            </ul>
            <br>
            <img src="/img/deals-banner-option1.jpg" style="width:100%;" />
            <p>&nbsp;</p>
            <p>&nbsp;</p>
         </div>
         <div class="clear"></div>
      </section>
   </div>
   <div class="clear"></div>
</section> --}}

@endsection

@push('footer-scripts')
@endpush