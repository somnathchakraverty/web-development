
@extends('layout.master')

@section('page-content')

<section class="cart-section pagenot-found">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="cart-block cart-width cart-cont add-btn cart-empty payment-box">
					<img class="img-responsive center-block" src="/img/404.jpg" alt="404-error">
					@if(!empty($error_message))
						<h2 style="padding: 20px;">{{$error_message}}</h2>
					@else
						<h1>404</h1>
						<h2>Page Not Found</h2>
						<p>Looks like something went completely wrong!<br>
							But don’t worry! it can happen to the best of us & it just happened to you.
						</p>
					@endif
					
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


@endsection

@push('footer-scripts')
@endpush

