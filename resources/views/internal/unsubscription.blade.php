@extends('layout.master')

@section('page-content')
<style>
/*unsubscribe-area page*/
body { background-color: #fff !important;}
.add-address-box { padding: 20px 20px;}
.add-address-box h2{display: block;padding: 0px;margin: 0px;font-weight: 600;font-family: 'Open Sans',sans-serif;font-size: 28px;color: #ffffff;}
.padding-section {padding: 20px 0px 30px;}
.make-payment .add-address-box::before{content: '';position: absolute;top: 0px;right: 0px;background-image: url(/img/recomondation-bg.png);width: 100%;height: 100%;background-repeat: no-repeat;background-position: right top;background-size: 50px;}
.unsubscribe-area{text-align: center;}
.unsubscribe-area p{font-size: 20px; color: #1a2332; padding-top: 25px;}
.unsubscribe-area p span{display: block; font-size: 16px; color: #1f1e1e; font-weight: 600; padding-top: 15px; margin-top: 0px; line-height: 17px;}
.cart-section { background-color: #fff !important; }
.overall-feedback h2{text-align: center;}
@media only screen and (max-width: 767px) {
    .unsubscribe-area {padding-top: 20px;}
    .new-member-form{box-shadow: 0 6px 10px rgba(148, 148, 148, 0.3);padding: 15px;background: #ffffff;float: left;}
}

</style>
<div class="inner-pages cart-pge add-address overall-feedback">
<!-- book your test -->
<section class="cart-section padding-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12 col-xs-12 add-btn">
		     	<div class="new-member-form col-md-12 col-xs-12 col-sm-12 col-lg-12 mar-top select-member-option make-payment">
		     		<div class="add-address-box">
                        <h2>{{$message}}</h2>
		     		</div>
		     		<div class="address-cont unsubscribe-area">
		     			<img src="/img/unsubscribe-icon.jpg" alt="Icon">
		     			<p>Please note that you may continue to receive emails for a short time while our system updates your request. <span>Nevertheless, We will miss you</span></p>
		     		</div>
				</div>
		     </div>
		</div>
	</div>
</section>
</div>

@endsection

@push('footer-scripts')
@endpush