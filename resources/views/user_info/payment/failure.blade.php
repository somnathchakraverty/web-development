@extends('layout.master')

@section('page-content')
<!-- book your test -->
<section class="cart-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cart-block cart-width cart-cont add-btn cart-empty payment-box">
                    <img class="img-responsive center-block" src="/img/payment-fail.jpg" alt="Empty cart">
                    <h2 class="payment-fail">Payment Failed</h2>
                    @if(!empty($retry_url))
                        <ul>
                            <li>
                                <a href="{{ $retry_url }}" class="btn btn-danger pay-btn">Retry</a>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('footer-scripts')
    <script type="text/javascript">
        
    </script>
@endpush