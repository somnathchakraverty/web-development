@extends('layout.master')

@section('page-content')
<!--Cart Page New Starts-->
<section class="cart-section-area">
    <!--Cart User Info-->
    <div class="container carttopopt">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-md-12 col-xs-12">
                <div class="cart-top-info">
                    <ul>
                        <li>Total Price: <span class="rupeecolor"><span class="rupeesign">₹</span> {{ $total_price }}/-</span></li>
                        <li>Selected Packages: <span class="rupeecolor selectedpackage" ></span></li>
                        <li>Total Members: <span class="rupeecolor totalmember" ></span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center checkoutbtn">
                @if($allow_to_proceed)
                    <a class="btn btn-danger" href="{{ url('select-slot') }}" onclick="pushGaEvent('My Cart', 'Click on Checkout Button', '{{session()->get('auth_'.auth()->user()->id)['user_id']}}')">Checkout</a>
                @else
                    <a class="btn btn-danger" href="javascript:void(0)" onclick='alert("{{$allow_to_proceed_message}}")'>Checkout</a>
                @endif
            </div>
        </div>
    </div>
    <!--Cart User Info-->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 cust_pkgopt">
                
                @php( $accordian_array = \Config('constants.collapse_array'))
                @php($i = 1)
                @foreach($customer_detail as $customer)
                    @if(count($customer['deals']) == 0)
                        @continue
                    @endif
                    <?php $totalmember += 1 ?>
                    <div class="checkbox" data-packagecount="{{count($customer['deals'])}}">
                        <div class="cart-div topspaceremove">
                            <div class="step-div cart-sec">
                                <div class="col-md-12">
                                    <h2>{{ $customer['customer_name'] }}, {{ $customer['relation'] }}</h2>
                                    <div class="ageuser"> 
                                        @if($customer['customer_gender'] == 'M')
                                            Male
                                        @elseif($customer['customer_gender'] == 'F')
                                            Female
                                        @else
                                            {{ $customer['customer_gender'] }}
                                        @endif, {{ $customer['customer_age'] }} years
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($customer['deals'] as $deal)
                            <?php $selectedpackage +=1 ?>
                            <div class="cart-block cart-width">							
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-7 col-md-7 col-xs-12">
                                        <div class="cartpackage-list">
                                            <div class="packagename">{{ $deal['name'] }}</div>
                                            <div class="included">Parameters Included: {{ $deal['parameterCount'] }}</div>
                                            <div class="remove-package"><a href="javascript:void(0);" data-price="{{$deal['healthians_price']}}" data-cusid="{{ $customer['customer_id'] }}" data-groupid="{{ $deal['id']}}" class="remove_package"><img src="img/del-icon.png"> Remove </a></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <div class="cartpricedisplay">
                                            <div class="hprice">Healthians Price: <span class="rupeesign">₹</span> <strike>{{ $deal['actual_price'] }}</strike></div>
                                            <h2 class="limitedprice">Limited Time Offer: <span class="rupeesign">₹</span> {{ $deal['healthians_price'] }}/-</h2>
                                            <div class="hdiscount">Save {{ calPer($deal['healthians_price'], $deal['actual_price']) }}%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        @endforeach                        
                    </div>
                    <div class="clearfix"></div>
                    @php($i += 1)
                @endforeach

                <div class="row mt10">
                    <div class="col-md-12 text-center checkoutbtn">
                        @if($allow_to_proceed)
                            <a class="btn btn-danger" href="{{ url('select-slot') }}">Checkout</a>
                        @else
                            <a class="btn btn-danger" href="javascript:void(0)" onclick='alert("{{$allow_to_proceed_message}}")'>Checkout</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php session()->put('cart_count', $selectedpackage); ?> 
<!--Cart New Page Ends-->
@endsection
@push('footer-scripts')
    <script type="text/javascript" src="/js/bootbox.js"> </script>
    <script type="text/javascript">
        
        var selectedpackage = "{{$selectedpackage}}";
        var totalmember = "{{$totalmember}}";
        $(document).ready(function(){
            $("span.selectedpackage").text(selectedpackage);
            $("span.totalmember").text(totalmember);
            $(".remove_package").click( function(){
                var remove_ele  =   $(this);
                bootbox.confirm({ 
                    size        :   "small",
                    message     :   "Are you sure, you want to delete this item ?", 
                    buttons: {
                        'cancel': {
                            label       :   'No',
                            className   :   'btn btn-default btn_whtcolor'
                        },
                        'confirm': {
                            label       :   'Yes',
                            className   :   'btn btn-danger btn_cmncolor'
                        }
                    },
                    callback    :   function(result){
                        if(result){
                            var customer_id = remove_ele.data('cusid');
                            var group_id = remove_ele.data('groupid');

                            if(customer_id === undefined || customer_id === null || group_id === undefined || group_id === null) {
                                showStrError("error", "Something went wrong. Please try again after some time.");
                            }else{
                                var removeDiv = remove_ele.parent().parent().parent().parent().parent();
                                var cusDiv = removeDiv.parent();
                                var values = { 'group_id': group_id, 'customer_id' : customer_id, '_token' : '{{csrf_token()}}' };
                                if(cusDiv.data('packagecount') == 1)
                                    values.isCustomerDelete = true;
                                else
                                    values.isCustomerDelete = false;
                                var url = "{{ url('cart') }}";
                                $.ajax({
                                    url: url,
                                    type: 'delete',
                                    data: values ,
                                    dataType: "json",
                                    beforeSend: function() {
                                        $("#ajax-loader").show();
                                    },
                                    success: function (response) {
                                        $("#ajax-loader").hide();
                                        if(response.status){
                                            removeDiv.remove();
                                            selectedpackage = selectedpackage - 1;
                                            $("span.selectedpackage").text(selectedpackage);

                                            if(cusDiv.data('packagecount') == 1){
                                                cusDiv.remove();
                                                totalmember = totalmember - 1;
                                                $("span.totalmember").text(totalmember);
                                            }
                                            var packagecount    =   cusDiv.data('packagecount') - 1;
                                            cusDiv.data('packagecount', packagecount);
                                            pushGaEvent('My Cart', 'Remove Item from cart', remove_ele.data('price'))
                                            $("span.has-badge").attr("data-count", selectedpackage);
                                            if(totalmember == 0 || response.hasOwnProperty('url'))
                                                window.location = "{{url('cart')}}"
                                        }else
                                            response.message
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        var jsonResponseText = $.parseJSON(jqXHR.responseText);
                                        var error_html = null;
                                        $.each(jsonResponseText, function(i, item) {
                                            error_html += item +', ';
                                        });
                                        return { 'status' : false, 'error' :error_html };
                                        $("#ajax-loader").hide();
                                        return false;
                                    }
                                });
                            }
                        }
                    }
                });                
            });
        });
    </script>
@endpush