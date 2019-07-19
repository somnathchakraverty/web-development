@extends('layout.master')

@section('page-content')

{!! $content !!}

 {{-- <!-- banner -->
<figure class="inner-banner">
    <img src="/img/deals-banner.jpg" alt="banner">
    <figcaption>
        <div class="container">
            <h1>Special Deals & <br> Discounts</h1>
            <p>Check out the best deals <br> and packages</p>
        </div>
    </figcaption>
</figure>

<!-- riskcontent area -->
<section class="riskcontent our-deals">
    <div class="container">
        <div class="special-offer text-center">
        <h2> Deals & Offers </h2>
        <img src="/img/underline.png" class="underline" alt="underline" />
        
        </div>
        <div class="row">
            [deal_listing]
        </div>
    </div>
</section>  --}}

@endsection

@push('footer-scripts')

<script>
    setTimeout(function(){ 
        if(typeof(clevertap) !== 'undefined') {
            clevertap.notifications.push({
                "titleText"         :'Would you like to receive Push Notifications?',
                "bodyText"          :'We promise to only send you relevant content and give you updates on your transactions',
                "okButtonText"      :'Sign me up!',
                "rejectButtonText"  :'No thanks',
                "okButtonColor"     :'#00a0a8'
            });
        }
    },3000);
</script>

@endpush