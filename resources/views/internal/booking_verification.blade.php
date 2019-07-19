
@extends('layout.master')

@section('page-content')

<section class="cart-section pagenot-found">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="cart-block cart-width cart-cont add-btn cart-empty payment-box">
					<h2 class="bv_title">{{ $message }}</h2>
						
					<p class="bv_booking"><b>Booking ID</b> : {{ $booking_id }}</p>
					<br><br>
					<strong class="strongclass">Try one of these instead:</strong>
					<ul class="errorpage">
						<li>
							<a href="/" class="btn btn-danger pay-btn">Home</a>
						</li>
						<li>
							<a href="/contact-us" class="btn btn-danger pay-btn">Contact Us</a>
						</li>
					</ul>
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

