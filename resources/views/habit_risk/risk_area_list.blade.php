@extends('layout.master')

@section('page-content')

<!-- Common Risk listing Area -->
<section class="investor-area common-risk-list meet-us">
    <div class="container">
        <h2>Common Risk Areas</h2>
        <img class="center-block" src="/img/underline.png" alt="Icon">
        <div class="row mar-top">

            @foreach ($risk_list as $item)
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-extra-xs">
                    <div class="common-risk-cont">
                        <img src="{{$item['image']}}" alt="{{$item['image']}}" title="{{$item['image']}}">
                        <h2> {{$item['Name']}} </h2>
                        <div class="mar-bot">
                            <p>{{ str_limit($item['description'], 200) }}</p>
                        </div>
                    <a href="/risk/{{ strtolower($item['alias']) }}" class="btn btn-default call-def"> 
                            View Test <img src="/img/arrow-icon.png" width="20px;">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('footer-scripts')
@endpush