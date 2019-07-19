@extends('layout.master')

@section('page-content')

{!! $content !!}


{{-- <!-- Refund Policy area -->
<section class="Wlcm-Healthians">
 	<div class="container">
		<!-- page heading -->
		<div class="text-center">
			<h2>Money Refund Policy</h2>
			<p></p>
			<img src="images/underline.png" class="underline-img" alt="" >
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 ol-sm-12 col-xs-12">
				<div class="condition-cont">
					<ol>
						<li>
							1. To claim a refund, kindly support it with related documents/ reports 
						</li>
						<li>
							In normal cases, any report comparisons beyond 7 days will not be considered.
						</li>
						<li>
							In the case of chronic diseases, an exception can be made up to 15 days, only after approval from our Quality team. 
						</li>
						<li>
							In the case of Thyroid, TSH values can vary due to various factors like time of sample collection and fasting status. Only significant variations in TSH levels will be considered. 
						</li>
						<li>
							Any variation in Lipid profile will not be considered. 
						</li>
						<li>
							In the case of any discrepancy in test results, a free re-sample will be collected and send to 2 labs. 1 sample will be sent to our lab and another to a standard lab. If a variation is found in the results, we will refund the entire test amount. 
						</li>
						<li>
							Our quality team reserves the right to make the final decision. 
						</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section> --}}


<style>
.condition-cont ol{ padding: 0px 30px; margin: 0px;}
.condition-cont ol li {  counter-increment: list; list-style-type: none; position: relative; padding: 0px 0px 15px;
    font-size: 16px;  color: #848484;}
.condition-cont ol li:before {    color: #f37d26;
    content: counter(list) ".";
    left: -32px;
    position: absolute;
    text-align: right;
    width: 26px;
    font-weight: 600;
    padding-right: 20px;}
</style>


@endsection

@push('footer-scripts')
@endpush