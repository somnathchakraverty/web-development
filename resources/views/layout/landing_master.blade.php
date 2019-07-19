<!DOCTYPE HTML>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    <title>{{ app('seo')->getTitle() }}  </title>
    <meta name="description" content="{{ app('seo')->getDescription() }}" />
    <meta name="keywords" content="{{ app('seo')->getKeywords() }}" />
    <link rel="canonical" href="{{ app('seo')->getCanonicalUrl() }}">
    <link href="/img/favicon.png" rel="icon" type="image/x-icon" />

    <meta name="robots" content="{{ app('seo')->getRobots() }}" />
    
    <link href="/img/favicon.png" rel="icon" type="image/x-icon" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/t2/bootstrap.css" rel="stylesheet"> 
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

   <!--  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
        
        ga("create", "{{env('GA_ID')}}", "auto");
        ga("send", "pageview");


        function pushGaEvent(category, action, label = null, value = null){
            // This function reports an event to Google Analytics servers.
            if(label == null)
                ga('send', 'event', category, action);
            else
                ga('send', 'event', category, action, label, value);
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

    </script>
    <link href="/css/landing/landing.css" rel="stylesheet"> 
    @stack('header-scripts')
</head>

<body>
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

    @yield('page-content')
</body>

<script type="text/javascript" src="/js/jquery.min.js"></script>

<script src="/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="/js/jquery.lazyloadxt.min.js"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=AW-929610874"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'AW-929610874');

    window.onload = function() {
        !function(f,b,e,v,n,t,s) {if(f.fbq)return;n=f.fbq=function(){n.callMethod? n.callMethod.apply(n,arguments):n.queue.push(arguments)}; if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0'; n.queue=[];t=b.createElement(e);t.async=1;t.defer='defer';t.src=v;s=b.getElementsByTagName(e)[0]; 
        s.parentNode.insertBefore(t,s)}(window,document,'script', 'https://connect.facebook.net/en_US/fbevents.js'); 
        fbq('init', "{{env('FACEBOOK_PIXEL')}}"); 
        fbq('track', 'PageView');
    }
</script>

<script>

var saves_api_url      = "{{url('saveLandingPageLead')}}";
var popular_pkg_api = "{{url('getPopularPackage')}}";

function gtag_report_conversion(url) {
    var callback = function () {
        if (typeof(url) != 'undefined') {
            window.location = url;
        }
    };
    if(typeof gtag == 'function') {
        gtag('event', 'conversion', {
            'send_to': 'AW-929610874/kgHcCP-t048BEPr4orsD',
            'event_callback': callback
        });
    }
    return false;
}

function getPopularPackage() {
    var city_id = $("#city").val();
    ajaxCallPromise(popular_pkg_api, "GET", {"city_id": city_id}).then(popularPkgSuccessHandler, popularPkgErrorHandler);
}

$(document).ready(function(){
    $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[A-Za-z\s]+$/i.test(value);
    });
});

// Common function for AJAX Call - Promise
function ajaxCallPromise(api_url, method, request_data) {
    var promiseObj = new Promise(function(resolve, reject) {
        $.ajax({
            url         : api_url,
            type        : method,
            data        : request_data,
            beforeSend  : function() {
                $("#ajax-loader").show();
            },
            success: resolve,
            error : reject
        });
    });
    return promiseObj;
}

// Read a page's GET URL variables and return them as an associative array.
function getUrlVars(values) {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function showStrError(type, message){
    switch(type) {
        case 'success':
            toastr.success( message, 'success!', {timeOut: 5000} );
            break;
        case 'info':
            toastr.info( message, 'Info!', {timeOut: 5000} );
            break;
        case 'error':
            toastr.error( message, 'Error!', {timeOut: 5000} );
            break;
        case 'warning':
            toastr.warning( message, 'Warning!', {timeOut: 5000} );
            break;
        default:
            toastr.info( message, 'Info!', {timeOut: 5000} );
    }
}
</script>

@stack('footer-scripts')

<style type="text/css">
.zopim { display: none !important;}
</style>