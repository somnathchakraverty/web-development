
    <div class="dash-left">
        <div class="user-area">
            <div class="namerdiv">{{ywt_get_first_char($userDetail['name'])}}</div>	
            <strong>{{$userDetail['name']}}</strong>
            <p>{{$userDetail['email']}}</p>
            <p>Phone: +91 {{$userDetail['mobile']}}</p>
            @if(!empty($route_name))
                @if($route_name !== 'my-profile')
                    <a href="{{route('myProfile')}}" class="btn btn-danger">Edit info</a>
                @endif
            @else
                <a href="{{route('myProfile')}}" class="btn btn-danger">Edit info</a>
            @endif
        </div>
        <ul class="dashbordul">
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="{{ route('myProfile')}}" class="{{ request()->is('myProfile') ? 'active' : '' }}">My Profile</a></li>
            <li><a href="{{ route('healthkarma-new') }}">Health Karma</a></li>
            {{-- <li><a href="{{route('mySubscription')}}">My Subscription</a></li> --}}
          
            @if(request()->is('orderDetails/*'))
                <li><a href="{{route('myBooking')}}" class="active">My Booking</a></li>
            @else
                <li><a href="{{route('myBooking')}}" class="{{ request()->is('myBooking') ? 'active' : '' }}">My Booking</a></li>
            @endif
            
            <li><a href="{{route('myReports')}}" class="{{ request()->is('myReports') ? 'active' : '' }}">My Reports</a></li>
            {{-- <li><a href="{{route('myReminders')}}">My Reminder</a></li> --}}
            <li><a href="{{route('myFamily')}}" class="{{ request()->is('myFamily') ? 'active' : '' }}">My Family & Friends</a></li>
            <li><a href="{{route('myAddress')}}" class="{{ request()->is('myAddress') ? 'active' : '' }}">Manage Addresses</a></li>
            {{-- <li><a href="{{route('hCash')}}">H Cash</a></li> --}}
            <li><a href="{{route('feedback')}}">Help & Feedback</a></li>
            <li><a href="{{route('referral')}}" class="{{ request()->is('referral') ? 'active' : '' }}">Refer & Earn</a></li>	
        </ul>		
    </div>	
