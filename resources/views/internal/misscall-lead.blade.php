
@extends('layout.master')

@section('page-content')
<style>
/*Missed Call Section */
.missedcall-wrap{ width:auto;font-family: 'Lato', sans-serif !important;}
.missedcall-wrap h1, h2, h3, h4, h5 {font-family: 'Lato', sans-serif;}
.missed-call-panel{background: #fff;border-radius: 5px; border: 1px solid #eaeaea; min-height: 400px; max-width: 978px; margin:45px auto 50px; padding: 30px;}
.missed-call-panel .cc-executive{ float: left; height:336px;width:366px;}
.missed-call-panel .right-msg{ float:right; font-family:'GothamNarrow-Book'; max-width:510px; margin:85px 0px 0px 0px;}

.missed-call-panel .right-msg h3{text-transform: capitalize; margin: 0px; letter-spacing:0px; text-align:left; font-size:30px; color: #00a0a8;}
.missed-call-panel .right-msg h5{ text-align: left; font-size: 18px;color: #6d6d6d; line-height:27px;}
.missed-call-panel .right-msg h5 strong{ color:#333;}
.missed-call-panel .right-msg hr{ border:none; border-bottom:2px solid #f1f1f1;  margin:10px 0px 15px 0px;}    
/*Missed Call Section Ends*/

@media only screen and (max-width: 768px) {
.missed-call-panel{ max-width: 100%; margin: 20px auto;padding:15px 10px;}
.missed-call-panel .cc-executive{float: none; height:auto;width:100%;}
.missed-call-panel .cc-executive img{ max-width: 100%;}
.missed-call-panel .right-msg{ display:block; float:none;margin:5px 0px 0px 0px;}
.missed-call-panel .right-msg h3{ text-align:center; font-size:24px;}
.missed-call-panel .right-msg h5{ text-align:center;}
}
</style>

<section class="cart-section pagenot-found">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="missedcall-wrap">
                        <div class="missed-call-panel">
                            <div class="cc-executive"><img src="/img/customer-care-executive.png"></div>
                            <div class="right-msg">          
                                <h3>Thank you for contacting us</h3>
                                <hr>
                                <div class="clear"></div>            
                                <h5>Our <strong>Customer Care Executive will get in contact</strong> with you and would help you choose the <strong>most suitable health package</strong></h5>
                               
                            </div>
                        </div>   
                    </div>
			</div>
		</div>
	</div>
</section>
<style type="text/css">
.bv_title{ font-size:28px !important; }
.bv_booking{ font-size:24px !important; margin-top:20px; }
.cart-cont{ padding:15px 0px; }
</style>

@endsection

@push('footer-scripts')
@endpush

