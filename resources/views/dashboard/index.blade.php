@extends('layout.master')

@section('page-content')
    <!-- image hover effect section  -->
    <section class="mydashbordiv text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                <h1>My Dashboard</h1><img src="/img/underline.png"></div>
            </div>
            <div class="img-sectiondiv">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-extra-xs text-center">
                            <div class="box first-box">
                                <div class="imgboxdiv"><img alt="" class="img-responsive" src="/img/other-icon1.png"></div>
                                <p>Health Karma</p>
                                <div class="box-content">
                                    <div class="rdiv" style="border-radius: 0%;">
                                        @if(empty($user_detail['image_path']))
                                            {{ strtoupper($user_detail['name'][0]) }}
                                        @else 
                                            <img src="{{ $user_detail['image_path'] }}" width="48" height="48">
                                        @endif
                                    </div>
                                    <h3 class="title">{{ $user_detail['name'] }}</h3>
                                    <p class="post">{{ $user_detail['email'] }}</p>
                                    <p>Phone: +91 {{ $user_detail['mobile'] }}</p>
                                    <div class="icon">
                                        <a class="btn btn-danger" href="/myProfile">EDIT INFO</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-extra-xs text-center">
                            <div class="box">
                                <a class="anchore" href="{{ route('healthkarma-new') }}"></a>
                                <div class="imgboxdiv"><img alt="" class="img-responsive" src="/img/other-icon1.png"></div>
                          
                                <a href="{{ route('healthkarma-new') }}"><b>Health Karma</b></a>
                            </div>
                        </div>
                        {{-- <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-extra-xs text-center">
                            <div class="box">
                                 <a class="anchore" href="{{ route('mySubscription') }}"></a>
                                <div class="imgboxdiv"><img alt="" class="img-responsive" src="/img/my-subscription.png"></div>
                                <a href="{{ route('mySubscription') }}"><b>My Subscription</b></a>
                            </div>
                        </div> --}}
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-extra-xs text-center">
                            <div class="box">
                                <a class="anchore" href="{{ route('myBooking') }}"></a>
                                <div class="imgboxdiv"><img alt="" class="img-responsive" src="/img/my-booking.png"></div>
                                <a href="{{ route('myBooking') }}"><b>My Booking</b></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-extra-xs text-center">
                            <div class="box">
                                <a class="anchore" href="{{ route('myReports') }}"></a>
                                <div class="imgboxdiv"><img alt="" class="img-responsive" src="/img/report_icon.png"></div>
                                <a href="{{ route('myReports') }}"><b>My Reports</b></a>
                            </div>
                        </div>
                    
                        {{-- <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-extra-xs text-center">
                            <div class="box">
                                <a class="anchore" href="{{ route('myReminders') }}"></a>
                                <div class="imgboxdiv"><img alt="" class="img-responsive" src="/img/my-remider.png"></div>
                                <a href="{{ route('myReminders') }}"><b>My Reminders</b></a>
                            </div>
                        </div> --}}
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-extra-xs text-center">
                            <div class="box">
                                <a class="anchore" href="{{route('myFamily')}}"></a>
                                <div class="imgboxdiv"><img alt="" class="img-responsive" src="/img/my-faimly.png"></div>
                               <a href="{{route('myFamily')}}"><b>My Family & Friends</b></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-extra-xs text-center">
                            <div class="box">
                                <a class="anchore" href="{{route('myAddress')}}"></a>
                                <div class="imgboxdiv"><img alt="" class="img-responsive" src="/img/mange-adress.png"></div>
                                <a href="{{route('myAddress')}}"><b>Manage Addresses</b></a>
                            </div>
                        </div>
                        {{-- <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-extra-xs text-center">
                            <div class="box">
                                <a class="anchore" href="{{ route('hCash') }}"></a>
                                <div class="imgboxdiv"><img alt="" class="img-responsive" src="/img/h-cash.png"></div>
                                <a href="{{ route('hCash') }}"><b>H Cash</b></a>
                            </div>
                        </div> --}}
                        
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-extra-xs text-center">
                            <div class="box">
                                <a class="anchore" href="{{route('mydietplan')}}"></a>
                                <div class="imgboxdiv"><img alt="" class="img-responsive" src="/img/db_diet.jpg"></div>
                               <a href="/diet"><b>Diet Planner <img src="/img/newfeat.png" class="imglocations"></b></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-extra-xs text-center">
                            <div class="box">
                                <a class="anchore" href="{{route('feedback')}}"></a>
                                <div class="imgboxdiv"><img alt="" class="img-responsive" src="/img/help-feed.png"></div>
                                <a href="{{route('feedback')}}"><b>Help & Feedback</b></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-extra-xs text-center">
                            <div class="box">
                                <a class="anchore" href="{{route('referral')}}"></a>
                                <div class="imgboxdiv"><img alt="" class="img-responsive" src="/img/refer-earn.png"></div>
                               <a href="{{route('referral')}}"><b>Refer & Earn</b></a>
                            </div>
                        </div>





                        @if($user_detail['phlebo_detail'] && isset($user_detail['booking_id']))
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-extra-xs text-center">
                                <div class="box">
                                    <a class="anchore" href="/phlebo-route?booking_id={{$user_detail['booking_id']}}&user_id={{$user_detail['decrypt_user_id']}}" target="_blank"></a>
                                    <div class="imgboxdiv"><img alt="" class="img-responsive" src="/img/phlebo_location_track.png"></div>
                                    <a href="/phlebo-route?booking_id=835815621&user_id=570829" target="_blank"><b>Phlebo Tracker</b></a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- subscribe section start here -->    
@endsection

@push('footer-scripts')

@endpush