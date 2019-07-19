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
        @if(!empty(app('seo')->getRobots()))
            <meta name="robots" content="{{ app('seo')->getRobots() }}" />
        @endif
        @if(!empty(app('seo')->getCanonicalUrl()))
            <link rel="canonical" href="{{ app('seo')->getCanonicalUrl() }}">

        @endif
        <link href="/img/favicon.png" rel="icon" type="image/x-icon" />

        <link rel="manifest" href="/manifest.json">
        
        <meta property="og:title" content="{{ app('seo')->getOgTitle() }}">
        <meta property="og:description" content="{{ app('seo')->getOgDescription() }}">
        <meta property="og:image" content="{{  app('seo')->getOgImage() }}">
        <meta property="og:url" content="{{ app('seo')->getOgURL() }}">
        <meta property="og:site_name" content="healthians">
        <meta property="og:type" content="health">


        <!-- Styles -->
        
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Ubuntu:300,300i,400,400i,500,500i,700,700i|Hind:400" rel="stylesheet">
        <link href="/css/t2/font-awesome.min.css" rel="stylesheet">
        <link href="{{mix('css/v2/head.css')}}" rel="stylesheet">
        <link href="/css/t2/toastr.min.css" rel="stylesheet">
        <!-- Google Tag Manager 
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-5NR5NQT');</script>
        End Google Tag Manager -->

        <script type="text/javascript">
            /* To get Device */
            var isMobile = {
                Android: function() {
                    return navigator.userAgent.match(/Android/i);
                },
                BlackBerry: function() {
                    return navigator.userAgent.match(/BlackBerry/i);
                },
                iOS: function() {
                    return navigator.userAgent.match(/iPhone|iPad|iPod/i);
                },
                Opera: function() {
                    return navigator.userAgent.match(/Opera Mini/i);
                },
                Windows: function() {
                    return navigator.userAgent.match(/IEMobile/i);
                },
                any: function() {
                    return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
                }
            };

            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
            
            ga("create", "{{env('GA_ID')}}", "auto");
            ga("send", "pageview");


            function pushGaEvent(category, action, label = null, value = null){
                if(label == null)
                    ga('send', 'event', category, action);
                else
                    ga('send', 'event', category, action, label, value);
            }
        </script>
        <noscript>
            <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{env('FACEBOOK_PIXEL')}}&ev=PageView&noscript=1"/>
        </noscript>
        @stack('header-scripts')
    </head>
    
    <body>
        <!-- go bottom to top -->
        <a href="javascript:" id="return-to-top" onclick="pushGaEvent('Footer', 'Clicked Scroll-to-top image')">
            <i class="fa fa-angle-up" aria-hidden="true"></i>
        </a>    

        <!-- header -->
        <header>
            @include('layout.header')
        </header>
        
        @yield('page-content')
    
        <!-- footer section start here -->
        @include('layout.footer')
       
        
    </body>
    <!-- Google Tag Manager (noscript)
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5NR5NQT"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    End Google Tag Manager (noscript) -->
    <!-- Scripts -->
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script src="/js/jquery.validate.min.js" type="text/javascript"></script>

    
    <script src="/js/select2.min.js"></script>
    <script src="/js/jquery.matchHeight.js" defer></script>  
    <script>

        /*Common function for AJAX Call - Promise*/
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

        /*Common function for AJAX - Callback*/
        function ajaxCall(api_url, method, request_data, callback) {
            $.ajax({
                url         : api_url,
                type        : method,
                data        : request_data,
                beforeSend  : function() {
                    $("#ajax-loader").show();
                },
                success: callback,
                error : function (reason, xhr) {
                    $("#ajax-loader").hide();
                    showStrError("error", "Something went wrong. Please try again after some time.");
                    console.log("Error in processing your request", reason);                   
                }
            });
        }
    </script>

    <script type="text/javascript" src="{{ getPageJsFile() }}" defer></script>
    <script type="text/javascript" src="/js/toastr.min.js" async ></script>
    <link href="{{mix('css/v2/footer.css')}}" rel="stylesheet">
    @stack('footer-scripts')

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwIM2NYrelVv93Uk8av4TF4YgPlyLi1cw&libraries=geometry,places" async></script>

    <script>
        <?php if(!empty($session_error)) { ?>
                var session_error = <?php echo $session_error; ?>;
                setTimeout(function(){ 
                    toastr.error( session_error, 'Error!', {timeOut: 5000} );
                } , 500);
        <?php }?>
        /*Read a page's GET URL variables and return them as an associative array.*/
        function setUrlVars(values)
        {
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for(var i = 0; i < hashes.length; i++)
            {
                hash = hashes[i].split('=');
                vars[hash[0]] = hash[1];
                values += '&'+hash[0]+'='+hash[1];
            }
            return values;
        }
        
        /*Start Location tracker*/

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(showPosition);
            } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            var sub_lat     =   position.coords.latitude;
            var sub_long    =   position.coords.longitude;

            var requestData = {
                    "lat"       : sub_lat,
                    "long"      : sub_long
                };

            $.ajax({
                url         : "{{url('getLocalityID')}}",
                type        : "GET",
                data        : requestData,
                beforeSend  : function() {
                    $("#ajax-loader").show();
                },
                success     : function (response) {
                    if(response) {
                        if(response.status) {
                            setCookie('sLocation', response.data.city_name);
                            setCookie('sLocationID', response.data.city_id);
                            localStorage.location_set   =   true;
                        }
                    }
                    $("#ajax-loader").hide();
                }
            });
        }

        var selected_city   =   getCookie("sLocation");
        if(localStorage.getItem("location_set") == null || selected_city == null){
            getLocation();
        }
        /*getLocation();
        End Location Tracker*/

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

        function getUrlVars(values)
        {
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for(var i = 0; i < hashes.length; i++)
            {
                hash = hashes[i].split('=');
                vars[hash[0]] = hash[1];
            }
            return vars;
        }

        function ajaxCall(api_url, method, request_data, callback) {
            $.ajax({
                url         : api_url,
                type        : method,
                data        : request_data,
                beforeSend  : function() {
                    $("#ajax-loader").show();
                },
                success: callback,
                error : function (reason, xhr) {
                    $("#ajax-loader").hide();
                    alert("Some thing went wrong. Please try again after some time.");
                    console.log("error in processing your request", reason);                   
                }
            });
        }
        
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

        window.onload = function() {
            window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
                        d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
                _.push(o)};z._=[];z.set._=[];$.async=1;$.setAttribute("charset","utf-8");
                    $.src="https://v2.zopim.com/?4VDQzvdO5Qa6IFPHOepmNOV5mY9fBYPa";z.t=+new Date;$.
                            type="text/javascript";$.defer='defer';e.parentNode.insertBefore($,e)})(document,"script");

            !function(f,b,e,v,n,t,s) {if(f.fbq)return;n=f.fbq=function(){n.callMethod? n.callMethod.apply(n,arguments):n.queue.push(arguments)}; if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0'; n.queue=[];t=b.createElement(e);t.async=1;t.defer='defer';t.src=v;s=b.getElementsByTagName(e)[0]; 
            s.parentNode.insertBefore(t,s)}(window,document,'script', 'https://connect.facebook.net/en_US/fbevents.js'); 
            fbq('init', "{{env('FACEBOOK_PIXEL')}}"); 
            fbq('track', 'PageView');

            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:976997,hjsv:6};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;r.defer='defer';
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        };

        var clevertap = {event:[], profile:[], account:[], onUserLogin:[], notifications:[], privacy:[]};
        clevertap.account.push({"id": "{{env('CLEVER_TAP_ID')}}" });
        clevertap.privacy.push({optOut: false});
        clevertap.privacy.push({useIP: false});
        (function () {
            var wzrk = document.createElement('script');
            wzrk.type = 'text/javascript';
            wzrk.async = true;
            wzrk.src = ('https:' == document.location.protocol ? 'https://d2r1yp2w7bby2u.cloudfront.net' : 'http://static.clevertap.com') + '/js/a.js';
                    var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wzrk, s);
        })();

        setTimeout(function(){ 
            if(typeof(clevertap) !== 'undefined') {
                clevertap.notifications.push({
                    "titleText"             :'Would you like to receive Push Notifications?',
                    "bodyText"              :'We promise to only send you relevant content and give you updates on your transactions',
                    "okButtonText"          :'Sign me up!',
                    "rejectButtonText"      :'No thanks',
                    "okButtonColor"         :'#00a0a8',
                    "askAgainTimeInSeconds" : 60,
                });
            }
        },3000);
        

        <!-- Google Analytics -->

        /*GA async code snippet here.*/

     
        @if (isset($send_ga_event) && isset($send_ga_event['category']) && isset($send_ga_event['action']) && isset($send_ga_event['label']) && isset($send_ga_event['value']))
            ga('send', {
                hitType: 'event',
                eventCategory: '{{ $send_ga_event['category'] }}',
                eventAction: '{{ $send_ga_event['action'] }}',
                eventLabel: '{{ $send_ga_event['label'] }}',
                eventValue: '{{ $send_ga_event['value'] }}'
            });
        @elseif (isset($send_ga_event) && isset($send_ga_event['category']) && isset($send_ga_event['action']) && isset($send_ga_event['label']))
            ga('send', {
                hitType: 'event',
                eventCategory: '{{ $send_ga_event['category'] }}',
                eventAction: '{{ $send_ga_event['action'] }}',
                eventLabel: '{{ $send_ga_event['label'] }}'
            });
        @endif
 
    </script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-929610874"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'AW-929610874');
               
    </script>

    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "legalName": "Healthians",
      "url": "https://www.healthians.com/",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Gurgaon, Haryana, India",
        "postalCode": "122001",
        "streetAddress": "A Wing, Floor I, A-26, Omega Center, Sector 34, Info City"
      },
      "email": "cs@healthians.com",
      "contactPoint": [
        {
          "@type": "ContactPoint",
          "telephone": "+91-9998880005",
          "contactType": "customer service",
          "contactOption": "TollFree",
          "areaServed": "IN"
        }
      ],
      "logo": "https://www.healthians.com/assets/images/campaign/healthians-logo-campaign.png",
      "sameAs": [
        "https://www.facebook.com/Healthians",
        "https://twitter.com/healthians",
        "https://www.linkedin.com/company/healthians-com",
        "https://www.youtube.com/user/Healthians"
      ]
    }
    </script>
</html>