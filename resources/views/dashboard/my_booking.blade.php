@extends('layout.master')

@section('page-content')

    <!-- dashbord my booking start here -->
    <section class="faimly-friendwraper">

        <div class="fixed-bar">
                <i class="fa fa-bars" aria-hidden="true"></i>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="asidenavdiv text-left">
                        @include('section.left-dashboard', ['userDetail' => $userDetail])
                    </div>	
                </div>

                <!------aside-end -->
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="Family-headingdiv text-left">
                        <h3>My Bookings</h3>	
                    </div>
                    <div class="Retake-Healthkarmadiv f-div">
                        @if(!empty($booking_list))

                            @foreach ($booking_list as $item)
                                <!-- informatio Box end -->
                                <div class="add-box">
                                    <div class="row">
                                    <div class="col-sm-6">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="bod" colspan="2"> {{ $item['billing_name'] }} </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="db_titlecaption"> Booking ID : </td>
                                                            <td class="db_titleinfo"> {{$item['booking_id'] }} </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="db_titlecaption"> Order Status :</td>
                                                            <td class="db_titleinfo"> {{$item['booking_status'] }} </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="db_titlecaption"> Order Date :</td>
                                                            <td class="db_titleinfo"> {{ convertUserVisibleDateFormat($item['booking_date']) }} </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="db_titlecaption"> Sample Collection Date :</td>
                                                            <td class="db_titleinfo"> {{ convertUserVisibleDateTimeFormat($item['collection_time']) }} </td>
                                                        </tr>                                                    
                                                        <tr>
                                                            <td class="db_titlecaption"> Order Price :</td>
                                                            <td class="db_titleinfo"> <span class="rupeesign">₹</span>{{ (int) $item['total_price'] }} </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="smart-section">
                                            <div class="orderdtl">
                                            <a href="/orderDetails/{{$item['booking_id'] }}" style="text-decoration:none;">
                                                    <!--<img src="img/viewdetailicon.png">-->
                                                    <h3> Order Detail </h3>
                                                </a>
                                            </div>
                                            <div class="myrprt">
                                                <a href="{{ route('myReports') }}" style="text-decoration: none;">
                                                    <!--<img src="img/reporticon.png">-->
                                                    <h3> View Report </h3>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h4><label class="alert alert-info">No Booking Found..!!</label></h4>
                        @endif
                    </div>
                </div>	
            </div>
        </div>
    </section>
    <!-- dashbord my booking ends here -->
@endsection
@push('footer-scripts')