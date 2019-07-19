@extends('layout.master')
<style>.datepicker { color: #080808 !important;z-index: 999999;}
    .datepicker-days .table-condensed{ width:100%; }</style>
@section('page-content')
    @include('section.addFamilyMemberForm', [
                'customer_count'    =>  $customer_count,
                'gender_type'       =>  $gender_type,
                'map_array'         =>  $map_array,
                'test_id'           =>  $product_detail['testId']
            ])

    <!-- book your test -->
    <section class="cart-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="selectmemberpanel">
<!--                        <input id="checkbox1" class="styled" type="checkbox">-->
                       
                        <div class="cart-div">
                            <div class="step-div cart-sec">
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                    <h2 class="big-h2">{{ $product_detail['display_name'] }}</h2>
                                </div>

                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 text-right">
                                    <div class="price">Healthians Price: <span class="rupeesign">₹</span> <strike>{{ $product_detail['actual_price'] }}</strike></div>
                                    <h2>Limited Time Offer: <span class="rupeesign">₹</span> {{ $product_detail['healthian_price'] }}/-</h2>
                                    <div class="discount">Save {{ calPer($product_detail['healthian_price'], $product_detail['actual_price']) }}%</div>
                                    <input type="hidden" name="group_id" value="{{ $product_detail['testId'] }}">
                                </div>
                            </div>
                        </div>
                        <div id="existing_member_list">
                            @foreach($customer_details as $customer)
                                @php($selected_package  =   $product_detail['testId'] .'_'.$customer['customer_id'])

                                <div class="cart-block memberinfo col-lg-4 col-md-4 col-sm-4 cart-box">
                                    <strong>{{ $customer['customer_name'] }},</strong> <span>{{ $customer['relation'] }}</span>
                                    <p>
                                        @if($customer['customer_gender'] == 'M')
                                            Male
                                        @elseif($customer['customer_gender'] == 'F')
                                            Female
                                        @endif
                                        , {{ $customer['customer_age'] }} yrs.
                                    </p>	

                                    <div class="checkbox checkbox-info checkbox-circle">
                                        @if(in_array($selected_package, $map_array) || ( $gender_type != 'B' && $gender_type != $customer['customer_gender']))
                                            <input name="cus_ids" id="{{ $customer['customer_id'] }}" value="{{ $customer['customer_id'] }}" title='Already selected' type="checkbox" disabled>
                                        @else
                                            <input name="cus_ids" id="{{ $customer['customer_id'] }}" value="{{ $customer['customer_id'] }}" type="checkbox">
                                        @endif
                                        <label for="{{ $customer['customer_id'] }}"> </label>
                                    </div>	
                                </div>  
                            @endforeach
                        </div>
                         
                         <div class="col-md-12 col-lg-12 col-xs-12 add-btn addcart-familybtn">
                            <ul>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#addFamilyM" class="btn btn-default addmember" onclick="pushGaEvent('My Cart', 'Click on Add family member', '{{session()->get('auth_'.auth()->user()->id)['user_id']}}')">Add a Family Member</a>

                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="btn btn-danger" id='add_to_cart'>Add to Cart</a>
                                </li>
                                
                            </ul>
                            
                            <div class="t-member">
                                <h3>Total Members: <span id="customer_count">{{ count($customer_details) }}</span></h3>
                                
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>        
    </section>
    <!-- subscribe section start here -->
@endsection

@push('footer-scripts')
    <script type="text/javascript" src="/js/bootbox.js"></script>
    <script type="text/javascript">
        
        $(document).ready(function(){
            $('#myModal').on('shown.bs.modal', function() {
                $("#dp2").keypress(function(event) { console.log(helo); event.preventDefault();});
                $('#dp2').datepicker({
                    format          : "dd/mm/yy",
                    startDate       : "01-01-1940",
                    endDate         : new Date(),
                    todayBtn        : "linked",
                    autoclose       : true,
                    todayHighlight  : true,
                    container       : '#myModal modal-body'
                })
                .on('changeDate', ageCalculator);
            });
            
            $("#add_to_cart").click( function(){
                var customer_id     =   [];
                var group_id        =   $("input[name='group_id']").val();
                $('input[name="cus_ids"]:checked').each(function() {         
                    customer_id.push($(this).val());
                });
                if (customer_id.length === 0){
                    toastr.error( 'Please select atleast one user', 'Error!', {timeOut: 5000} );
                }else if(group_id === undefined || group_id === null) {
                    toastr.error("Something went wrong! Select Package again", 'Error!', {timeOut: 5000} );
                }else{
                    var values = { 'group_id': group_id, 'customer_id' : customer_id.toString(), '_token' : '{{csrf_token()}}' };
                    var url = "{{ url('cart') }}";
                    
                    if(typeof(fbq) !== 'undefined') {
                        var addToCartFB = { 
                            "content_type"      : 'product',
                            "content_ids"       : [group_id],
                            "value"             : '{{$product_detail["healthian_price"]}}',
                            "currency"          : 'INR',
                            "content_category"  : "user_selection_cart"
                        };
                        fbq('track', 'AddToCart', addToCartFB);
                    }

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: values ,
                        dataType: "json",
                        beforeSend: function() {
                            $("#ajax-loader").show();
                        },
                        success: function (response) {
                            if(response.status){
                                pushGaEvent('My Cart', 'Add to cart', '{{session()->get('auth_'.auth()->user()->id)['user_id']}}')
                                window.location = "{{url('cart')}}";
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
            });
        });        
    </script>
    
@endpush