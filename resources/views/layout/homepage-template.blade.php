@extends('layout.master')
@section('page-content')

    <!-- banner div start here -->
        <div class="bannerdiv">
            @include('section.home-banner')
        </div>
        
        <!-- search section start here -->
        <div class="search-section">
            @include('section.search')
        </div>
        
        <!-- my dashboard -->
        <div class="about-section">
            @include('section.dashboard')
        </div>
        
        <!-- getcloser section start here -->
        <div class="getcloser-section">
            @include('section.get-closer')
        </div>
        
        <!-- My Subscriptions section start here -->
        <div class="mysubscriptions-section">
            @include('section.subscriptions')
        </div>
        
        <!-- recomendation area -->
        <div class="commonrisk-section">
            @include('section.recomendation-area')
        </div>
        
        <!-- common risk section start here -->
        <div class="commonrisk-section rish-area">
            @include('section.risk-area')
        </div>
        
        <!-- special offer area -->
        <div class="special-offer">
            @include('section.special-area')
        </div>
    
        <!-- popular section start here -->
        <div class="popular-section">
            @include('section.popular-detail')
        </div>
        
        <!-- yourhealth section start here -->
        <div class="yourhealth-section">
            @include('section.your-health')
        </div>
        
        <!-- downloadapp section start here -->
        <div class="downloadapp-section">
            @include('section.download-app')
        </div>
        
        <!-- why choose us -->
        <div class="choose-us">
            @include('section.contact-us')
        </div>
    
        <!-- subscribe section start here -->
        <div class="subscribe-section">
            @include('section.subscribe')
        </div>
        
@endsection