@extends('layout.master')

@section('page-content')
<?php session()->put('cart_count', 0); ?> 
<!--Cart Page New Starts-->
<section class="cart-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="cart-block cart-width cart-cont add-btn cart-empty payment-box">
                    <img class="img-responsive center-block" src="/img/empty-cart.png" alt="Empty cart">
                    <h3 class="payment-failh3 empty-cart">Looks like you haven't selected any test yet.</h3>
                    <ul>
                        <li>
                            <a href="{{$url}}" class="btn btn-danger pay-btn" onclick="pushGaEvent('My Cart', 'Click on Book a Test Now button', '{{session()->get('auth_'.auth()->user()->id)['user_id']}}')">Book A Test Now</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Cart New Page Ends-->
@endsection