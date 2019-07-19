<!-- Preloader -->
<div id="ajax-loader" class="overlay_loader" style="display: none;">
    <div class="sk-circle">
        <div class="sk-circle1 sk-child"></div>
        <div class="sk-circle2 sk-child"></div>
        <div class="sk-circle3 sk-child"></div>
        <div class="sk-circle4 sk-child"></div>
        <div class="sk-circle5 sk-child"></div>
        <div class="sk-circle6 sk-child"></div>
        <div class="sk-circle7 sk-child"></div>
        <div class="sk-circle8 sk-child"></div>
        <div class="sk-circle9 sk-child"></div>
        <div class="sk-circle10 sk-child"></div>
        <div class="sk-circle11 sk-child"></div>
        <div class="sk-circle12 sk-child"></div>
    </div>
</div>
<!-- Preloader CSS -->

<!-- logo Ends -->
<div class="container">
    <div class="row">
        <!-- logo -->
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mobile-logo">
            <div class="main-logo">
                <a href="/" onclick="pushGaEvent('HomePage', 'Clicked Logo')">
                    <img src="/img/healthians-anniversary-logo.jpg" class="img-responsive">
                    <!-- <img src="/img/logo.png" class="img-responsive"> -->
                </a>
            </div>
        </div>


        <!-- header info area -->
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 menu-mobile-nw">
            <!-- header user information -->
            <div class="header-top-information">
                <div class="header-information">
                    <div class="headerrightdiv-content">
                        <img src="/img/login-icon.png" alt="Icon">
                        <ul class="nav navbar-nav">
                        @if(auth()->check() && session()->has('auth_'.auth()->user()->id) && isset(session()->get('auth_'.auth()->user()->id)['name']))
                            @php($username = ucwords(session()->get('auth_'.auth()->user()->id)['name']))
                            <!-- <li class="dropdown"> -->

                                <li class="btn-group welcomeuser_top">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-hover="dropdown"
                                       data-toggle="dropdown"><span>Welcome </span> {{ $username }} 
                                       <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu logindropdownitems">
                                        <li>
                                            <a href="{{ route('user.dashboard') }}"
                                               onclick="homepageGaEventFire('My Account')"> My Account </a></li>
                                        <li>
                                            <a href="{{ route('healthkarma-new') }}"
                                               onclick="homepageGaEventFire('Health Karma')"> Health Karma </a></li>
                                        <li>
                                            <a href="{{ route('myBooking') }}"
                                               onclick="homepageGaEventFire('My Booking')"> My Booking </a></li>
                                        <li>
                                            <a href="{{ route('myReports') }}"
                                               onclick="homepageGaEventFire('My Report')"> My Report <img src="/img/newfeat.png" class="imglocations"></a>

                                        </li>
                                        <li>
                                            <a href="{{ route('myFamily') }}"
                                               onclick="homepageGaEventFire('My Family & Friends')"> My Family &
                                                Friends </a></li>
                                        <li>
                                            <a href="{{ route('myAddress') }}"
                                               onclick="homepageGaEventFire('Manage Addresses')"> Manage Addresses </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('mydietplan') }}"
                                               onclick="homepageGaEventFire('Diet Planer')"> Diet Planner <img src="/img/newfeat.png" class="imglocations"></a>

                                        </li>
                                        <li>
                                            <a href="{{ route('feedback') }}"
                                               onclick="homepageGaEventFire('Help & Feedback')"> Help & Feedback </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('referral') }}"
                                               onclick="homepageGaEventFire('Refer & Earn')"> Refer & Earn </a></li>
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="homepageGaEventFire('Sign Out')">
                                                Sign Out </a>
                                        </li>
                                    </ul>
                                </li>



                            @else
                                <li>
                                    <a href="{{url('login')}}"><!-- <span>Dashboard </span> --> Login/Sign Up</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="headerrightdiv-content prright location-dropdown"> 
                    <img src="/img/location-icon.png" class="locationplace" alt="">                      
                        <ul class="nav navbar-nav">
                            <li class="btn-group" id="location_dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- <span>Location </span> -->
                                    Gurgaon <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    @if(count($header_city_detail['metro']) > 0)
                                    <div class="citylabel">Metro Cities</div>
                                    
                                    <div class="citydatadropdwn">
                                        @php( $i = 1 )
                                        @php($per_page = ceil(count($header_city_detail['metro'])/3) )
                                        @foreach($header_city_detail['metro'] as $key => $city_name)
                                            @if($i ==  1)
                                                <ul>
                                            @endif
                                                    <li><a href="javascript:void(0);" class="city_drop_down_value"
                                                           data-id='{{$key}}'> {{ $city_name }} </a></li>
                                            @if($i == $per_page)
                                                </ul>
                                                @php( $i = 0 )
                                            @endif
                                            @php( $i++ )
                                        @endforeach
                                    </div>
                                    
                                    
                                    <div class="dividerdrop" style="clear: both; display: block; width:100%;"></div>
                                    
                                    @endif
                                    <div class="citylabel">Other Cities</div>
                                    <div class="citydatadropdwn">
                                        @php( $i = 1 )
                                        @php($per_page = ceil(count($header_city_detail['non_metro'])/3) )
                                        @foreach($header_city_detail['non_metro'] as $key => $city_name)
                                            @if($i ==  1)
                                                <ul>
                                            @endif
                                                    <li><a href="javascript:void(0);" class="city_drop_down_value"
                                                           data-id='{{$key}}'> {{ $city_name }} </a></li>
                                            @if($i == $per_page)
                                                </ul>
                                                @php( $i = 0 )
                                            @endif
                                            @php( $i++ )
                                        @endforeach
                                    </div>
                                </ul>
                            </li>
                        </ul>
                       
                    </div>

                    <div class="headerrightdiv-content locarea">
                        <img src="/img/callus-icon.png" alt="Icon">
                        <ul>
                            <li>
                                <a id="ht_number" href="tel:{{ \Config::get('constants.ht_number') }}"
                                   onclick="pushGaEvent('HomePage', 'Clicked Telephone No.')">
                                    <!-- <span> Call us</span> --> {{ \Config::get('constants.ht_number') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header menu -->
            <div class="header-main-menu">
                <!-- navigation -->
                <nav id="navigation" class="navbar navbar-default" role="navigation">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <span class="cart_data visible-xs">
                            @php($cart_count = session()->get('cart_count'))
                            @if($cart_count > 0 && auth()->check() && session()->has('auth_'.auth()->user()->id))
                                <div class="topheaderCart">
                                    <div id="cartHealth">
                                        <a href="{{ route('user.cart') }}" onclick="pushGaEvent('My Cart', 'Click on Add to Cart button', '{{session()->get('auth_'.auth()->user()->id)['user_id']}}')">
                                            <span class="p1 fa-stack fa-2x has-badge" data-count="{{$cart_count}}" id="cart_count_id">
                                                @if($cart_count > 0)
                                                  <i class="p3 customcart_color glyphicon glyphicon-shopping-cart fa-stack-1x xfa-inverse"></i>
                                                @else
                                                  <i class="p3 customcart_fade glyphicon glyphicon-shopping-cart fa-stack-1x xfa-inverse"></i>
                                                @endif
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </span>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav nv-left">
                            <li>
                                <a href="{{ url('deals') }}" onclick="MenuOptionEventFire('Offers')"
                                   class="{{ request()->is('deals') ? 'active' : '' }}"> Health Deals </a>
                            </li>
                            <li>
                                <a href="/labs"
                                   onclick="MenuOptionEventFire('Labs'); pushGaEvent('HomePage', 'A Tour of Our Labs')"
                                   class="{{ request()->is('labs') ? 'active' : '' }}"> Labs </a>
                            </li>
                            <li>
                                <a href="https://blog.healthians.com/" onclick="MenuOptionEventFire('Blog')"> Blog </a>
                            </li>
                            <li>
                                <a href="/contact-us" onclick="MenuOptionEventFire('Contact Us')"
                                   class="{{ request()->is('contact-us') ? 'active' : '' }}"> Contact Us </a>
                            </li>

                             <li class="nav navbar-nav navbar-right">
                                <a style="margin-left:0px;" href="{{route('upload-prescription')}}" class="btn btn-danger uploadpres">
                                <i class="fa fa-upload" aria-hidden="true"></i> &nbsp; Upload Prescription </a>
                            </li>
                        </ul>
                        

                        
                        <!--Cart-->

                        @php($cart_count = session()->get('cart_count'))
                        @if($cart_count > 0 && auth()->check() && session()->has('auth_'.auth()->user()->id))
                            <div class="topheaderCart hidden-xs">
                                <div id="cartHealth">
                                    <a href="{{ route('user.cart') }}"
                                       onclick="pushGaEvent('My Cart', 'Click on Add to Cart button', '{{session()->get('auth_'.auth()->user()->id)['user_id']}}')"><span
                                                class="p1 fa-stack fa-2x has-badge" data-count="{{$cart_count}}">
                                    @if($cart_count > 0)
                                                <i class="p3 customcart_color glyphicon glyphicon-shopping-cart fa-stack-1x xfa-inverse"></i>
                                            @else
                                                <i class="p3 customcart_fade glyphicon glyphicon-shopping-cart fa-stack-1x xfa-inverse"></i>
                                            @endif
                                  </span>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div><!-- /.navbar-collapse -->
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Popup Dialog -->
<!-- Modal -->
<!-- <div id="myModalhomeDialog" class="modal fade" role="dialog">
    <div class="modal-dialog">        
        <div class="modal-content">
            <div class="modal-header" style="display:inline;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="margin:0px; padding:0px;">
                <div class="row">
                    <div class="col-lg-12"><img src="/img/mobile-animation.gif" class="img-responsive" /></div>
                </div>
            </div>
        </div>
    </div>
</div> -->

@push('footer-scripts')
    <!-- <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>  -->

    <script type="text/javascript">
        window.scrollTo(0, 0);

        function homepageGaEventFire(label) {
            pushGaEvent('HomePage', 'Clicked A Menu Option', label);
        }

        function MenuOptionEventFire(label) {
            pushGaEvent('Menuoption', 'Clicked A Menu Option', label);
        }

        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
        
        function getBookingDetail(selectedObj) {
            var passvariable = {};

            if (selectedObj.hasOwnProperty('actual_price') && selectedObj.hasOwnProperty('display_name') && selectedObj.hasOwnProperty('testId') && selectedObj.hasOwnProperty('healthian_price')) {
                passvariable.actual_price = selectedObj.actual_price;
                passvariable.display_name = selectedObj.display_name;
                passvariable.testId = selectedObj.testId;
                passvariable.healthian_price = selectedObj.healthian_price;
                if(selectedObj.hasOwnProperty('gender'))
                    passvariable.gender =   selectedObj.gender;
                else
                    passvariable.gender = 'Male, Female';
                setCookie('selectedObj', JSON.stringify(passvariable));
                values = { 'selectedObj' : JSON.stringify(passvariable) , '_token' : '{{csrf_token()}}'};
                $.ajax({
                    url: '/setsession',
                    type: "post",
                    data: values ,
                    beforeSend: function() {
                        $("#ajax-loader").show();
                    },
                    success: function (response) {
                        if(response.status)
                            window.location = "{{url('user_selection_cart')}}";
                        else
                            return false;
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $("#ajax-loader").hide();
                       return false;
                    }
                });
                
            }
        }

        var product_url = "{{ request()->route()->getName() }}";
        var arr = product_url.split('.');
        /*To check device source*/
        if (!isMobile.any()) {
            $("#ht_number").attr("href", "javascript:void(0)");
            $("#ht_number").removeAttr("target");
            
            $("#call_to_phlebo").attr("href", "javascript:void(0)");
            $("#call_to_phlebo").removeAttr("target");
        }


        $(document).ready(function () {

            $.fn.isInViewport = function () {
                if (typeof $(this).offset() == 'undefined') return false;
                var elementTop = $(this).offset().top;
                var elementBottom = elementTop + $(this).outerHeight();
                var viewportTop = $(window).scrollTop();
                var viewportBottom = viewportTop + $(window).height();
                return elementBottom > viewportTop && elementTop < viewportBottom;
            };

            $("#ajax-loader").hide();
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelector('main').className += 'loaded';
            });
            var url = $(location).attr('href');
            var selected_city = getCookie("sLocation");
            selected_city = selected_city.trim();

            if (typeof selected_city !== 'undefined' && selected_city != '')
                $("#location_dropdown a.dropdown-toggle").html('<span></span>' + selected_city + '<b class="caret"></b>');
            else
                setCookie('sLocation', selected_city);

            $('#location_dropdown .city_drop_down_value').on("click", function (e) {
                var menu_this = $(this);

                if (arr[0] == 'product') {

                    $("#location_dropdown a.dropdown-toggle").html('<span> </span>' + menu_this.text() + '<b class="caret"></b>');
                    $('#location_dropdown ul.dropdown-menu').css("display", "none");

                    var change_city = menu_this.text().trim();
                    setCookie('sLocation',  menu_this.text());
                    setCookie('sLocationID', menu_this.attr('data-id'));
                    
                    var url_change_city     =   change_city.replace(/ /g,"_");
                    var url_selected_city   =   selected_city.replace(/ /g,"_");
                    
                    window.location = url.replace(url_selected_city.toLowerCase(), url_change_city.toLowerCase());
                }                    
                else if(arr[1] == 'cart' || arr[1] == 'select-slot' || arr[1] == 'payment' || arr[1] == 'user_selection_cart') {
                    bootbox.confirm({ 
                        size        :   "small",
                        message     :   "<b>Are you sure, you want to change city</b> ? <br><br>Changing sample collection city will also delete items in your cart.", 
                        buttons: {
                            'cancel': {
                                label       :   'Cancel',
                                className   :   'btn btn-default btn_whtcolor'
                            },
                            'confirm': {
                                label       :   'OK',
                                className   :   'btn btn-danger btn_cmncolor'
                            }
                        },
                        callback    :   function(result){
                            if(result) {

                                $("#location_dropdown a.dropdown-toggle").html('<span> </span>' + menu_this.text() + '<b class="caret"></b>');
                                $('#location_dropdown ul.dropdown-menu').css("display", "none");

                                var change_city = menu_this.text().trim();
                                setCookie('sLocation', menu_this.text());
                                setCookie('sLocationID', menu_this.attr('data-id'));
                                
                                var url_change_city     =   change_city.replace(/ /g,"_");
                                var url_selected_city   =   selected_city.replace(/ /g,"_");

                                var url     = "{{ url('deleteCompleteCart') }}";
                                var values  = { '_token' : '{{csrf_token()}}' };
                                $.ajax({
                                    url         : url,
                                    type        : 'post',
                                    data        : values ,
                                    dataType    : "json",
                                    beforeSend  : function() {
                                        $("#ajax-loader").show();
                                    },
                                    success     : function (response) {
                                        $("#ajax-loader").hide();
                                        window.location.href = "/";
                                    },
                                    error: function(response) {
                                        $("#ajax-loader").hide();
                                        window.location.href = "/";
                                    }
                                });
                            }                          
                        }
                    });
                }
                else {
                    var change_city = menu_this.text().trim();
                    setCookie('sLocation', menu_this.text());
                    setCookie('sLocationID', menu_this.attr('data-id'));
                    
                    var url_change_city     =   change_city.replace(/ /g,"_");
                    var url_selected_city   =   selected_city.replace(/ /g,"_");

                    window.location         = url.replace(url_selected_city.toLowerCase(), url_change_city.toLowerCase());
                }

                /*This function reports an event to Google Analytics servers.*/
                ga('send', 'event', 'Search', 'Picked City from dropdown', 'HomePage');

                e.preventDefault();
                return false;
            });
              
            $(window).on('load', function(){
                var is_visted   =   getCookie('is_visited');
                if (is_visted == ''){       
                        $("#myModalhomeDialog").delay(5000).modal('show');
                        setTimeout(function(){ $("#myModalhomeDialog").modal('hide') }, 20000);
                        setCookie('is_visited', true, 1);
                }
            });
        });
                 
        function click_to_cart(php_data) {
            var dataObj = JSON.parse(php_data);

            if (dataObj.hasOwnProperty('id') && dataObj.hasOwnProperty('name')) {
                dataObj.testId = dataObj.id;
                dataObj.display_name = dataObj.name;
                getBookingDetail(dataObj);
            }
            else if (dataObj.hasOwnProperty('product_id') && dataObj.hasOwnProperty('product_name')) {
                dataObj.testId = dataObj.product_id;
                dataObj.display_name = dataObj.product_name;
                getBookingDetail(dataObj);
            }
            else if (dataObj.hasOwnProperty('actual_price') && dataObj.hasOwnProperty('display_name') && dataObj.hasOwnProperty('testId') && dataObj.hasOwnProperty('healthian_price')) {
                getBookingDetail(dataObj);
            }
        }
    </script>


@endpush