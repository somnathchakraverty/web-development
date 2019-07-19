App.controller('compaignController', compaignController);
compaignController.$inject = ['$scope', '$timeout', '$rootScope', '$location', '$http', '$stateParams', 'ConstConfig', 'HomeService', '$window', '$analytics', '$interval', '$state'];

function compaignController(scope, $timeout, $rootScope, $location, $http, $stateParams, ConstConfig, HomeService, $window, $analytics, $interval, $state) {

    $rootScope.meta_robots = 'noindex, nofollow';
    
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

    if($state.current.name === 'dengue') {
        scope.ga_category = 'Dengue';
    }
    else if($state.current.name === 'web-campaign') {
        scope.ga_category = 'Landing';
    }
    else if($state.current.name === "health-se-milegi-wealth-ki-chaabi-lucky-draw") {
        scope.ga_category = 'Diwali-Campaign-2017';
    }
    else if($state.current.name === "web-campaign-health-checkup" || $state.current.name === "web-campaign-health-checkup-book-now" || $state.current.name === "web-campaign-health-checkup-free-call") {
        scope.ga_category = 'New Landing Yuvraaj';
        scope.display_order_price = '2700/';
        scope.display_healthians_price = '999/-';
        scope.display_saving = '63%';
        scope.display_package = '(Kidney, Liver, Thyroid, Sugar, Lipid/Cholesterol, Blood, Urine)';
        scope.display_doc = 'DOCTOR CONSULTATION';
        scope.display_doc_text = 'Professional consultation.';
        scope.display_parameter_count = '74';
    }
    else if($state.current.name === "web-campaign-health-checkup-599") {
        scope.ga_category = 'Health Checkup - 599';
        scope.display_order_price = '2430/';
        scope.display_healthians_price = '599/-';
        scope.display_saving = '75%';
        scope.display_package = '(Kidney, Liver, Sugar, Lipid/Cholesterol, CBC)';
        scope.display_doc = 'FREE HEALTH COUNSELLING';
        scope.display_doc_text = 'Professional Health Counselling.';
        scope.display_parameter_count = '57';
    }
    else if($state.current.name === "web-campaign-family") {
        scope.ga_category = 'New Landing Family';
    }
    else if($state.current.name === "web-campaign-one-plus-one-full-body-checkup") {
        scope.ga_category = 'One Plus One Landing';
        scope.display_order_price = '2550/';
        scope.display_healthians_price = '1299/-';
        scope.display_saving = '49%';
        scope.display_package = '(Kidney, Liver, Thyroid, Lipid/Cholesterol, Complete Hemogram, Glucose)';
        scope.display_doc = 'FREE HEALTH COUNSELLING';
        scope.display_doc_text = 'Professional Health Counselling.';
        scope.display_package_name = 'One Plus One Full Body Checkup';
        scope.display_parameter_count = '60';
    }
    else if($state.current.name === "web-campaign-healthians-summer-special-package") {
        scope.ga_category = 'Summer Special Package Landing';
        scope.display_order_price = '5350/';
        scope.display_healthians_price = '1999/-';
        scope.display_saving = '63%';
        scope.display_package = '(Kidney, Liver, Thyroid, Lipid/Cholesterol, Complete Hemogram, Glucose, Vitamin B12, Vitamin D, Urine Routine)';
        scope.display_doc = 'FREE HEALTH COUNSELLING';
        scope.display_doc_text = 'Professional Health Counselling.';
        scope.display_package_name = 'Healthians Summer Special Package';
        scope.display_parameter_count = '76';
    }
    else if($state.current.name === "web-campaign-adwords") {
        scope.ga_category = 'Adword Campaign';
    }
    else if($state.current.name === "web-campaign-facebook-leads") {
        scope.ga_category = 'Facebook Lead Campaign';
    }
    else if($state.current.name === "web-campaign-health-checkup-1099") {
        scope.ga_category = 'Health Checkup - 1099';
        scope.display_order_price = '2700/';
        scope.display_healthians_price = '1099/-';
        scope.display_saving = '59%';
        scope.display_package = '(Kidney, Liver, Thyroid, Sugar, Lipid/Cholesterol, Blood, Urine)';
        scope.display_doc = 'FREE DOCTOR CONSULTATION';
        scope.display_doc_text = 'Professional consultation.';
        scope.display_parameter_count = '74';
    }
    else if($state.current.name === "web-campaign-health-checkup-999") {
        scope.ga_category = 'Health Checkup - 999';
        scope.display_order_price = '2700/';
        scope.display_healthians_price = '999/-';
        scope.display_saving = '63%';
        scope.display_package = '(Kidney, Thyroid, Sugar, Lipid/Cholesterol, Blood, Urine)';
        scope.display_doc = 'FREE DOCTOR CONSULTATION';
        scope.display_doc_text = 'Professional consultation.';
        scope.display_parameter_count = '62';
    }
    else if($state.current.name === "lead-campaign-health-checkup") {
        scope.ga_category = 'Lead Campaign Health Checkup';
        scope.City = "1610";
    }

    /* Right now we are not using this function of URL param because of Recaptcha */
    scope.sendDirectLeadDetails = function() {   
        if (scope.stateParms) {
            scope.utmid = scope.stateParms.utmid;

            if(scope.utmid === '') {
                if($state.current.name === "web-campaign-health-checkup" || $state.current.name === "web-campaign-health-checkup-book-now" || $state.current.name === "web-campaign-health-checkup-free-call") {
                    scope.utmid = "web-campaign-health-checkup";
                }
                else if($state.current.name === "web-campaign-one-plus-one-full-body-checkup") {
                    scope.utmid = "web-campaign-one-plus-one-full-body-checkup";
                }
                else if($state.current.name === "web-campaign-healthians-summer-special-package") {
                    scope.utmid = "web-campaign-healthians-summer-special-package";
                }
                else if($state.current.name === "web-campaign-adwords") {
                    scope.utmid = "web-campaign-adwords";
                }
                else if($state.current.name === "web-campaign-facebook-leads") {
                    scope.utmid = "web-campaign-facebook-leads";
                }
                else if($state.current.name === "web-campaign-health-checkup-599") {
                    scope.utmid = "web-campaign-health-checkup-599";
                }
            }

            if(scope.utmid !== '' && typeof scope.customerNo !== 'undefined') {
                var requestData = {
                    "data":  {
                        "utm_id": scope.utmid,
                        "mobile":scope.customerNo,
                        "source": "web"
                    }
                };

                if(typeof scope.customerName !== 'undefined') {
                    requestData['data']['name'] = scope.customerName;
                }

                if(typeof scope.City !== 'undefined') {
                    requestData['data']['city'] = scope.City;
                }

                if(typeof scope.stateParms.utm_source !== 'undefined') {
                    requestData['data']['utm_source'] = scope.stateParms.utm_source;
                }

                /* Capture Utm Parameters */
                if(typeof scope.stateParms.utm_source !== 'undefined') {
                    requestData['data']['utm_source'] = scope.stateParms.utm_source;
                }
                if(typeof scope.stateParms.utm_campaign !== 'undefined') {
                    requestData['data']['utm_campaign'] = scope.stateParms.utm_campaign;
                }
                if(typeof scope.stateParms.utm_medium !== 'undefined') {
                    requestData['data']['utm_medium'] = scope.stateParms.utm_medium;
                }

                if(localStorage.getItem("guid")) {
                    requestData['data']['guid'] = localStorage.getItem("guid");
                }   

                var url = ConstConfig.couponUrl + "webv1/web_api/saveEmailCompaignData";

                doPostWithOutToken($http, url, requestData, "", function(data) {
                    if (data.status) {
                        var cphone = scope.customerNo;
                        scope.customerName = '';
                        scope.customerNo = '';
                        scope.Message = '';

                        scope.compaignmsg = true;
                        scope.showLeadMobileForm = false;

                        /* Pixel Fire in case of new number */
                        if(data.message === 'Lead successfully inserted') {
                            scope.gtag_report_conversion($window.location.href);   

                            /* For Analytics - Payment Mode */
                            $analytics.eventTrack('Lead Captured', {
                                category: scope.ga_category,
                                label: cphone
                            });

                            if(typeof($window.fbq) !== 'undefined') {
                                $window.fbq('track', 'Lead', requestData);
                            }    

                            if(scope.utmid === 'ucb') {
                                if(typeof($window.utq) !== 'undefined') {
                                    $window.utq("trackCustom", "GenerateLead");
                                }
                            }

                            if(scope.utmid === 'quora') {
                                if(typeof($window.qp) !== 'undefined') {
                                    $window.qp('track', 'GenerateLead');
                                }
                            }                     

                            var pixelUrl = ConstConfig.serverUrl + "commonservice/getVendorPixel";

                            var pixelrequest = {
                                "vendor_code": scope.utmid,
                                "page_source":"landing",
                                "lead_id": data.lead_id
                            }                    

                            doPostWithOutToken($http, pixelUrl, pixelrequest,"",function(data){                            
                                
                                if(data.status) {
                                    angular.element("footer").append(data.data);

                                    /* For Analytics - Pixel */
                                    if(typeof scope.stateParms.publisher_id !== 'undefined') {
                                        $analytics.eventTrack('Vendor Publisher Pixel', {
                                            category: scope.utmid,
                                            label: scope.stateParms.publisher_id
                                        });                                        
                                    }
                                    else {
                                        $analytics.eventTrack('Vendor Pixel', {
                                            category: scope.utmid                                        
                                        });
                                    }
                                } 

                                $timeout(function() {
                                    $('.modal-backdrop').remove();
                                    $('.modal.in').find('button.close').click();
                                    $window.location.href = "package/healthians-full-body-checkup-with-thyroid-and-cbc";
                                }, 15000);

                            });                                               
                        }
                        else {
                            $timeout(function() {
                                $('.modal-backdrop').remove();
                                $('.modal.in').find('button.close').click();
                                $window.location.href = "package/healthians-full-body-checkup-with-thyroid-and-cbc";
                            }, 10000);
                        }
                    } else {
                        alert(data.message);
                    }
                });
            }
        }

    }

    scope.stateParms = $stateParams;
    scope.timeTickerFlag = false;

    if (scope.stateParms) {
        scope.utmid = scope.stateParms.utmid;

        if(typeof scope.stateParms.email !== 'undefined') {
            scope.customerEmail = scope.stateParms.email
        }
        if(typeof scope.stateParms.name !== 'undefined') {
            scope.customerName = scope.stateParms.name;
        }
        if(typeof scope.stateParms.mobile !== 'undefined') {
            scope.customerNo = scope.stateParms.mobile;
            //scope.sendDirectLeadDetails();
        }
        if(typeof scope.stateParms.comment !== 'undefined') {
            scope.Message = scope.stateParms.comment;
        }

        if(scope.utmid == 'ucb') {
            var newScript = document.createElement('script');
            newScript.type = 'text/javascript';
            newScript.id = 'ucb_id';
            document.getElementsByTagName("head")[0].append(newScript);

            angular.element("#ucb_id").append('(function(w, d, t, s, q, m, n) { if (w.utq) return; q = w.utq = function() { q.process ? q.process(arguments) : q.queue.push(arguments); }; q.queue = []; m = d.getElementsByTagName(t)[0]; n = d.createElement(t); n.src = s; n.async = true; m.parentNode.insertBefore(n, m); })(window, document, "script", "https://pixel-insight.ucweb.com/ucads/utracking.js");utq("init", "43282752605257935");utq("set", "trackurl", "pixel-insight.ucweb.com/intl_utrace");utq("track", "PageView");');
        }

        if(scope.utmid == 'quora') {
            var newScript = document.createElement('script');
            newScript.type = 'text/javascript';
            newScript.id = 'quora_id';
            document.getElementsByTagName("head")[0].append(newScript);

            var newScript1 = document.createElement('noscript');
            newScript1.type = 'text/javascript';
            newScript1.id = 'noscript_quora_id';
            document.getElementsByTagName("head")[0].append(newScript1);

            angular.element("#quora_id").append('!function(q,e,v,n,t,s){if(q.qp) return; n=q.qp=function(){n.qp?n.qp.apply(n,arguments):n.queue.push(arguments);}; n.queue=[];t=document.createElement(e);t.async=!0;t.src=v; s=document.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t,s);}(window, "script", "https://a.quora.com/qevents.js");qp("init", "bb9ba203758241a094941b86a559f3fe");qp("track", "ViewContent");');
            angular.element("#noscript_quora_id").append('<img height="1" width="1" style="display:none" src="https://q.quora.com/_/ad/bb9ba203758241a094941b86a559f3fe/pixel?tag=ViewContent&noscript=1"/>');
        }
    }

    scope.package_info = '';
    scope.booknow = false;
    scope.compaignmsg = false;

    scope.setPackageInfo = function(pkg_id) {
        scope.package_info = pkg_id;
        if($state.current.name === "lead-campaign-health-checkup") {
            angular.element("#customerno").focus();
        }
        else {
            angular.element("#name").focus();
        }        
        $window.scrollTo(0, 0);
    }

    //service call for get city 
    scope.getCityList = function() {
        HomeService.getCityDetail(function(data) {
            if (data.status == 'success') {
                scope.cityList = data.data;
                if($state.current.name === "lead-campaign-health-checkup") {
                    scope.ga_category = 'Lead Campaign Health Checkup';
                    scope.City = "1610";
                }
    
            }
        });
    };

    scope.getCityList();

    scope.sendDetails = function() {
        //var g_recaptcha_response = grecaptcha.getResponse(widgetId5);
        
        scope.addLeadFormSubmitted = false;

        if (scope.customerNo === undefined || scope.customerNo === '') {
            scope.addLeadForm.customerno.$dirty = true;
            scope.addLeadForm.customerno.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Mobile No. not enter' });
            return false;
        }
        else if (scope.customerName === undefined || scope.customerName === '') {
            scope.addLeadForm.name.$dirty = true;
            scope.addLeadForm.name.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Name not enter' });
            return false;
        } else if (scope.customerEmail === undefined || scope.customerEmail === '') {
            scope.addLeadForm.customeremail.$dirty = true;
            scope.addLeadForm.customeremail.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Email not enter' });
            return false;
        }  
        else if (scope.City === undefined || scope.City === '') {
            scope.addLeadForm.city.$dirty = true;
            scope.addLeadForm.city.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'City not select' });
            return false;
        }

        // if(g_recaptcha_response.length == 0) {
        //     $window.alert("Please check Captcha Checkbox");
        //     return false;
        // }

        if (scope.stateParms) {
            scope.utmid = scope.stateParms.utmid;

            if($state.current.name === "health-se-milegi-wealth-ki-chaabi-lucky-draw") {
                scope.utmid = "diwali-campaign-2017";
            }

            if(scope.utmid === '') {
                if($state.current.name === "web-campaign-family") {
                    scope.utmid = "web-campaign-family";
                }
                
                if($state.current.name === "web-campaign-health-checkup" || $state.current.name === "web-campaign-health-checkup-book-now" || $state.current.name === "web-campaign-health-checkup-free-call") {
                    scope.utmid = "web-campaign-health-checkup";
                }
                else if($state.current.name === "web-campaign-health-checkup-599") {
                    scope.utmid = "web-campaign-health-checkup-599";
                }
                else if($state.current.name === "web-campaign-one-plus-one-full-body-checkup") {
                    scope.utmid = "web-campaign-one-plus-one-full-body-checkup";
                }
                else if($state.current.name === "web-campaign-healthians-summer-special-package") {
                    scope.utmid = "web-campaign-healthians-summer-special-package";
                }
                else if($state.current.name === "web-campaign-adwords") {
                    scope.utmid = "web-campaign-adwords";
                }
                else if($state.current.name === "web-campaign-facebook-leads") {
                    scope.utmid = "web-campaign-facebook-leads";
                }
                else {
                    scope.utmid = 1;
                }                
            }

            if(scope.utmid !== '') {
                var requestData = {
                    "data":  {
                        "utm_id": scope.utmid,
                        "name":scope.customerName,
                        "email":scope.customerEmail,
                        "mobile":scope.customerNo,
                        "city":scope.City,
                        "message": scope.Message,
                        "source": "web"                        
                    }
                };

                /* Capture Utm Parameters */
                if(typeof scope.stateParms.utm_source !== 'undefined') {
                    requestData['data']['utm_source'] = scope.stateParms.utm_source;
                }
                if(typeof scope.stateParms.utm_campaign !== 'undefined') {
                    requestData['data']['utm_campaign'] = scope.stateParms.utm_campaign;
                }
                if(typeof scope.stateParms.utm_medium !== 'undefined') {
                    requestData['data']['utm_medium'] = scope.stateParms.utm_medium;
                }

                if(scope.addLeadForm.customerLastName) {
                    requestData.data['last_name'] = scope.addLeadForm.customerLastName;
                }

                if(localStorage.getItem("guid")) {
                    requestData['data']['guid'] = localStorage.getItem("guid");
                }

                var url = ConstConfig.couponUrl + "webv1/web_api/saveEmailCompaignData";

                doPostWithOutToken($http, url, requestData, "", function(data) {
                    if (data.status) {
                        var cphone = scope.customerNo;
                        scope.customerName = '';
                        scope.customerEmail = '';
                        scope.customerNo = '';
                        scope.Message = '';

                        scope.addLeadForm.name.$dirty = false;
                        scope.addLeadForm.customerno.$dirty = false;
                        scope.addLeadForm.customeremail.$dirty = false;

                        scope.compaignmsg = true;

                        /* Expire Exit Popup */
                        var now = new Date();
                        var exp = new Date(now.getTime() + (1 * 24 * 60 * 60 * 1000));
                        if (isMobile.any()) {
                            document.cookie = 'ExitPopupMobileCookie=1; expires=' + exp.toUTCString();
                            localStorage.setItem("isLeadCaptured", true);
                        }
                        else {
                            document.cookie = 'ExpirationCookieTest=1; expires=' + exp.toUTCString();
                            localStorage.setItem("isLeadCaptured", true);
                        }


                        /* Pixel Fire in case of new number */
                        if(data.message === 'Lead successfully inserted') {
                            scope.gtag_report_conversion($window.location.href);   

                            /* For Analytics - Payment Mode */
                            $analytics.eventTrack('Lead Captured', {
                                category: scope.ga_category,
                                label: cphone
                            });

                            if(typeof($window.fbq) !== 'undefined') {
                                $window.fbq('track', 'Lead', requestData);
                            }         

                            if(scope.utmid === 'ucb') {
                                if(typeof($window.utq) !== 'undefined') {
                                    $window.utq("trackCustom", "GenerateLead");
                                }
                            }

                            if(scope.utmid === 'quora') {
                                if(typeof($window.qp) !== 'undefined') {
                                    $window.qp('track', 'GenerateLead');
                                }
                            }         

                            var pixelUrl = ConstConfig.serverUrl + "commonservice/getVendorPixel";

                            var pixelrequest = {
                                "vendor_code": scope.utmid,
                                "page_source":"landing",
                                "lead_id": data.lead_id
                            }                    

                            doPostWithOutToken($http, pixelUrl, pixelrequest,"",function(data){                            
                                
                                if(data.status) {
                                    angular.element("footer").append(data.data);
                                    /* For Analytics - Pixel */
                                    if(typeof scope.stateParms.publisher_id !== 'undefined') {
                                        $analytics.eventTrack('Vendor Publisher Pixel', {
                                            category: scope.utmid,
                                            label: scope.stateParms.publisher_id
                                        });                                        
                                    }
                                    else {
                                        $analytics.eventTrack('Vendor Pixel', {
                                            category: scope.utmid                                        
                                        });
                                    }
                                } 

                                $timeout(function() {
                                    $('.modal-backdrop').remove();
                                    $('.modal.in').find('button.close').click();
                                    $window.location.href = "package/healthians-full-body-checkup-with-thyroid-and-cbc";
                                }, 15000);

                            });
                                             
                        }
                        else {
                            $timeout(function() {
                                $('.modal-backdrop').remove();
                                $('.modal.in').find('button.close').click();
                                $window.location.href = "package/healthians-full-body-checkup-with-thyroid-and-cbc";
                            }, 10000);
                        }
                    } else {
                        //grecaptcha.reset();
                        alert(data.message);
                    }
                });
            }
        }

    }

    scope.getPopularPackagesList = function(city_name) {
        $http({
            method: "GET",
            url: ConstConfig.couponUrl + "webv1/web_api/getPopularPackages?city="+city_name,
        }).success(function(data) {
            if(data.data) {
                scope.popularPackages1 = data.data;
                scope.packageList = scope.popularPackages1;
            }
        });
    }
    if($state.current.name === "lead-campaign-health-checkup") {
        //scope.getPopularPackagesList('Bengaluru');
        scope.getPopularPackagesList('Gurgaon');        
    }

    scope.clock = function(countDownDate) {
        if(document.getElementById("timeticker")) {
            document.getElementById("timeticker").style.display = 'block';
        }
        // Update the count down every 1 second
        var x = $interval(function() {

            // Get todays date and time
            var now = new Date().getTime();
            
            // Find the distance between now an the count down date
            var distance = parseInt(countDownDate) - now;
            
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            // Output the result
            scope.timeTicker = days + "d " + hours + "h "+ minutes + "m " + seconds + "s ";
            if(document.getElementById("timeticker")) {
                document.getElementById("timeticker").innerHTML = 'Offer expires in : ' + scope.timeTicker;
            }

            if (distance < 0) {
                if(document.getElementById("timeticker")) {
                    document.getElementById("timeticker").style.display = 'none';              
                    document.getElementById("timeticker").innerHTML = "";
                }
                $interval.cancel(x);
            }
            else {
                if(document.getElementById("timeticker")) {
                    document.getElementById("timeticker").style.display = 'block';
                }
            }
        }, 1000);
    }

    scope.startTicker = function () {
        if(localStorage.getItem("timeTicker") === null){
            var days = 2;
            var countDownDate = new Date(Date.now() + days*24*60*60*1000).getTime();
            //var countDownDate = new Date(Date.now() + 60*1000).getTime();
            
            localStorage.setItem("timeTicker", countDownDate);
            scope.clock(countDownDate);
        }
        else {
            var countDownDate = localStorage.getItem("timeTicker");
            scope.clock(countDownDate);
        }
    }


    scope.sendLandingDetails = function() {

        //var g_recaptcha_response = grecaptcha.getResponse(widgetId5);
        scope.addLeadFormSubmitted = false;

        if($state.current.name === "web-campaign-adwords") {
            if (scope.PackageList === undefined || scope.PackageList === '') {
                scope.addLeadForm.package.$dirty = true;
                scope.addLeadForm.package.$invalid = true;
                $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Package not select by user' });
                return false;
            }
        } 

        if (scope.customerNo === undefined || scope.customerNo === '') {
            scope.addLeadForm.customerno.$dirty = true;
            scope.addLeadForm.customerno.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Mobile No. not enter' });
            return false;
        }

        if($state.current.name === "web-campaign-facebook-leads") {
            if (scope.customerName === undefined || scope.customerName === '') {
                scope.addLeadForm.name.$dirty = true;
                scope.addLeadForm.name.$invalid = true;
                $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Name not enter' });
                return false;
            }
            // else if (scope.City === undefined || scope.City === '') {
            //     scope.addLeadForm.city.$dirty = true;
            //     scope.addLeadForm.city.$invalid = true;
            //     $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'City not select' });
            //     return false;
            // }
        }

        if($state.current.name === "lead-campaign-health-checkup") {
            if (scope.customerName === undefined || scope.customerName === '') {
                scope.addLeadForm.name.$dirty = true;
                scope.addLeadForm.name.$invalid = true;
                $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Name not enter' });
                return false;
            } 
            else if (scope.City === undefined || scope.City === '') {
                scope.addLeadForm.city.$dirty = true;
                scope.addLeadForm.city.$invalid = true;
                $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'City not select' });
                return false;
            }

            if (scope.addLeadForm.customeremail.$invalid) {
                    scope.addLeadForm.customeremail.$dirty = true;
                    scope.addLeadForm.customeremail.$invalid = true;
                    $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Email not enter' });
                    return false;

            }

        }
        
        // if(g_recaptcha_response.length == 0) {
        //     $window.alert("Please check Captcha Checkbox");
        //     return false;
        // }

        if (scope.stateParms) {
            scope.utmid = scope.stateParms.utmid;

            if(scope.utmid === '') {
                if($state.current.name === "web-campaign-health-checkup" || $state.current.name === "web-campaign-health-checkup-book-now" || $state.current.name === "web-campaign-health-checkup-free-call") {
                    scope.utmid = "web-campaign-health-checkup";
                }
                else if($state.current.name === "web-campaign-health-checkup-599") {
                    scope.utmid = "web-campaign-health-checkup-599";
                }
                else if($state.current.name === "web-campaign-one-plus-one-full-body-checkup") {
                    scope.utmid = "web-campaign-one-plus-one-full-body-checkup";
                }
                else if($state.current.name === "web-campaign-healthians-summer-special-package") {
                    scope.utmid = "web-campaign-healthians-summer-special-package";
                }
                else if($state.current.name === "web-campaign-adwords") {
                    scope.utmid = "web-campaign-adwords";
                }
                else if($state.current.name === "web-campaign-facebook-leads") {
                    scope.utmid = "web-campaign-facebook-leads";
                }
                else {
                    scope.utmid = "1";
                }
            }

            if(scope.utmid !== '') {
                var requestData = {
                    "data":  {
                        "utm_id": scope.utmid,
                        "name":scope.customerName,
                        "mobile":scope.customerNo,
                        "city":scope.City,
                        "email":scope.customerEmail,
                        "source": "web"
                    }
                };

                /* Capture Utm Parameters */
                if(typeof scope.stateParms.utm_source !== 'undefined') {
                    requestData['data']['utm_source'] = scope.stateParms.utm_source;
                }
                if(typeof scope.stateParms.utm_campaign !== 'undefined') {
                    requestData['data']['utm_campaign'] = scope.stateParms.utm_campaign;
                }
                if(typeof scope.stateParms.utm_medium !== 'undefined') {
                    requestData['data']['utm_medium'] = scope.stateParms.utm_medium;
                }

                if(localStorage.getItem("guid")) {
                    requestData['data']['guid'] = localStorage.getItem("guid");
                }

                if($state.current.name === "web-campaign-adwords") {
                    requestData['data']['message'] = 'Customer search for : '+ scope.PackageList;
                    /* For Analytics - Payment Mode */
                    $analytics.eventTrack('Package Details', {
                        category: scope.ga_category,
                        label: scope.PackageList
                    });
                }

                if($state.current.name === "lead-campaign-health-checkup") {
                    if(scope.package_info !== '') {
                        requestData['data']['message'] = 'Customer search for : '+ scope.package_info;
                        /* For Analytics - Payment Mode */
                        $analytics.eventTrack('Package Details', {
                            category: scope.ga_category,
                            label: scope.package_info
                        });
                    }                    
                }

                var url = ConstConfig.couponUrl + "webv1/web_api/saveEmailCompaignData";

                doPostWithOutToken($http, url, requestData, "", function(data) {
                    if (data.status) {
                        var cphone = scope.customerNo;
                        scope.customerName = '';
                        scope.customerNo = '';
                        scope.Message = '';

                        if(scope.customerEmail) {
                            if(scope.customerEmail !== '') {
                                scope.customerEmail = '';
                                scope.addLeadForm.customeremail.$dirty = false;
                            }
                        }

                        scope.addLeadForm.name.$dirty = false;
                        scope.addLeadForm.customerno.$dirty = false;

                        scope.compaignmsg = true;


                        /* Pixel Fire in case of new number */
                        if(data.message === 'Lead successfully inserted') {

                            scope.gtag_report_conversion($window.location.href);

                            /* For Analytics - Payment Mode */
                            $analytics.eventTrack('Lead Captured', {
                                category: scope.ga_category,
                                label: cphone
                            });

                            if(typeof($window.fbq) !== 'undefined') {
                                $window.fbq('track', 'Lead', requestData);
                            }                         

                            if(scope.utmid === 'ucb') {
                                if(typeof($window.utq) !== 'undefined') {
                                    $window.utq("trackCustom", "GenerateLead");
                                }
                            }

                            if(scope.utmid === 'quora') {
                                if(typeof($window.qp) !== 'undefined') {
                                    $window.qp('track', 'GenerateLead');
                                }
                            }  

                            var pixelUrl = ConstConfig.serverUrl + "commonservice/getVendorPixel";

                            var pixelrequest = {
                                "vendor_code": scope.utmid,
                                "page_source":"landing",
                                "lead_id": data.lead_id
                            }                    

                            doPostWithOutToken($http, pixelUrl, pixelrequest,"",function(data){                            
                                
                                if(data.status) {
                                    angular.element("footer").append(data.data);

                                    /* For Analytics - Pixel */
                                    if(typeof scope.stateParms.publisher_id !== 'undefined') {
                                        $analytics.eventTrack('Vendor Publisher Pixel', {
                                            category: scope.utmid,
                                            label: scope.stateParms.publisher_id
                                        });                                        
                                    }
                                    else {
                                        $analytics.eventTrack('Vendor Pixel', {
                                            category: scope.utmid                                        
                                        });
                                    }
                                } 

                                $timeout(function() {
                                    $('.modal-backdrop').remove();
                                    $('.modal.in').find('button.close').click();
                                    if($state.current.name === "lead-campaign-health-checkup") {
                                        $window.location.href = "home";
                                    }
                                    else {
                                        $window.location.href = "package/healthians-full-body-checkup-with-thyroid-and-cbc";
                                    }
                                    
                                }, 15000);

                            });    

                                               
                        }
                        else {
                            $timeout(function() {
                                $('.modal-backdrop').remove();
                                $('.modal.in').find('button.close').click();
                                if($state.current.name === "lead-campaign-health-checkup") {
                                    $window.location.href = "home";
                                }
                                else {
                                    $window.location.href = "package/healthians-full-body-checkup-with-thyroid-and-cbc";
                                }                                
                            }, 10000);
                        }
                    } else {
                        //grecaptcha.reset();
                        alert(data.message);
                    }
                });
            }
        }

    }


    scope.showLeadMobileForm = false; 

    scope.tabOnMobileLead = function() {
        scope.showLeadMobileForm = true;
    }

    scope.hideTabOnMobileLead = function() {
        scope.showLeadMobileForm = false;
        scope.customerName = '';
        scope.customerNo = '';

        scope.addLeadFormMobile.name.$dirty = false;
        scope.addLeadFormMobile.customerno.$dirty = false;
    }

    scope.sendLandingMobileDetails = function() {
        //var g_recaptcha_response = grecaptcha.getResponse(widgetId6);

        scope.addLeadFormSubmitted = false;

        if (scope.customerNo === undefined || scope.customerNo === '') {
            scope.addLeadFormMobile.customerno.$dirty = true;
            scope.addLeadFormMobile.customerno.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Mobile No. not enter' });
            return false;
        } 
        if($state.current.name !== "web-campaign-facebook-leads") {
            if (scope.customerName === undefined || scope.customerName === '') {
                scope.addLeadFormMobile.name.$dirty = true;
                scope.addLeadFormMobile.name.$invalid = true;
                $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Name not enter' });
                return false;
            } 
            else if (scope.City === undefined || scope.City === '') {
                scope.addLeadFormMobile.city.$dirty = true;
                scope.addLeadFormMobile.city.$invalid = true;
                $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'City not select' });
                return false;
            }
        }

        if($state.current.name === "web-campaign-adwords") {
            if (scope.PackageList === undefined || scope.PackageList === '') {
                scope.addLeadFormMobile.package.$dirty = true;
                scope.addLeadFormMobile.package.$invalid = true;
                $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Package not select by user' });
                return false;
            }
        } 
        
        // if(g_recaptcha_response.length == 0) {
        //     $window.alert("Please check Captcha Checkbox");
        //     return false;
        // }

        if (scope.stateParms) {
            scope.utmid = scope.stateParms.utmid;

            if(scope.utmid === '') {
                if($state.current.name === "web-campaign-health-checkup" || $state.current.name === "web-campaign-health-checkup-book-now" || $state.current.name === "web-campaign-health-checkup-free-call") {
                    scope.utmid = "web-campaign-health-checkup";
                }
                else if($state.current.name === "web-campaign-health-checkup-599") {
                    scope.utmid = "web-campaign-health-checkup-599";
                }
                else if($state.current.name === "web-campaign-one-plus-one-full-body-checkup") {
                    scope.utmid = "web-campaign-one-plus-one-full-body-checkup";
                }
                else if($state.current.name === "web-campaign-healthians-summer-special-package") {
                    scope.utmid = "web-campaign-healthians-summer-special-package";
                }
                else if($state.current.name === "web-campaign-adwords") {
                    scope.utmid = "web-campaign-adwords";
                }
                else if($state.current.name === "web-campaign-facebook-leads") {
                    scope.utmid = "web-campaign-facebook-leads";
                }
                else {
                    scope.utmid = "1";
                }
            }

            if($state.current.name === "web-campaign-adwords") {
                /* For Analytics - Payment Mode */
                $analytics.eventTrack('Package Details - Mobile', {
                    category: scope.ga_category,
                    label: scope.PackageList
                });
            }

            if(scope.utmid !== '') {
                var requestData = {
                    "data":  {
                        "utm_id": scope.utmid,
                        "name":scope.customerName,
                        "mobile":scope.customerNo,
                        "city":scope.City,
                        "email":scope.customerEmail,
                        "source": "web"                        
                    }
                };

                if($state.current.name === "web-campaign-adwords") {
                    requestData['data']['message'] = 'Customer search for : '+ scope.PackageList;
                }

                /* Capture Utm Parameters */
                if(typeof scope.stateParms.utm_source !== 'undefined') {
                    requestData['data']['utm_source'] = scope.stateParms.utm_source;
                }
                if(typeof scope.stateParms.utm_campaign !== 'undefined') {
                    requestData['data']['utm_campaign'] = scope.stateParms.utm_campaign;
                }
                if(typeof scope.stateParms.utm_medium !== 'undefined') {
                    requestData['data']['utm_medium'] = scope.stateParms.utm_medium;
                }
                if(localStorage.getItem("guid")) {
                    requestData['data']['guid'] = localStorage.getItem("guid");
                }

                var url = ConstConfig.couponUrl + "webv1/web_api/saveEmailCompaignData";

                doPostWithOutToken($http, url, requestData, "", function(data) {
                    if (data.status) {
                        var cphone = scope.customerNo;
                        scope.customerName = '';
                        scope.customerNo = '';
                        scope.Message = '';

                        if(scope.customerEmail) {
                            if(scope.customerEmail !== '') {
                                scope.customerEmail = '';
                                scope.addLeadFormMobile.customeremail.$dirty = false;
                            }
                        }

                        scope.addLeadFormMobile.name.$dirty = false;
                        scope.addLeadFormMobile.customerno.$dirty = false;

                        scope.compaignmsg = true;
                        scope.showLeadMobileForm = false;

                        /* Pixel Fire in case of new number */
                        if(data.message === 'Lead successfully inserted') {
                            scope.gtag_report_conversion($window.location.href);

                            /* For Analytics - Payment Mode */
                            $analytics.eventTrack('Lead Captured', {
                                category: scope.ga_category,
                                label: cphone
                            });

                            if(typeof($window.fbq) !== 'undefined') {
                                $window.fbq('track', 'Lead', requestData);
                            }    

                            if(scope.utmid === 'ucb') {
                                if(typeof($window.utq) !== 'undefined') {
                                    $window.utq("trackCustom", "GenerateLead");
                                }
                            }

                            if(scope.utmid === 'quora') {
                                if(typeof($window.qp) !== 'undefined') {
                                    $window.qp('track', 'GenerateLead');
                                }
                            }                     

                            var pixelUrl = ConstConfig.serverUrl + "commonservice/getVendorPixel";

                            var pixelrequest = {
                                "vendor_code": scope.utmid,
                                "page_source":"landing",
                                "lead_id": data.lead_id
                            }                    

                            doPostWithOutToken($http, pixelUrl, pixelrequest,"",function(data){                            
                                
                                if(data.status) {
                                    angular.element("footer").append(data.data);

                                    /* For Analytics - Pixel */
                                    if(typeof scope.stateParms.publisher_id !== 'undefined') {
                                        $analytics.eventTrack('Vendor Publisher Pixel', {
                                            category: scope.utmid,
                                            label: scope.stateParms.publisher_id
                                        });                                        
                                    }
                                    else {
                                        $analytics.eventTrack('Vendor Pixel', {
                                            category: scope.utmid                                        
                                        });
                                    }
                                } 

                                $timeout(function() {
                                    $('.modal-backdrop').remove();
                                    $('.modal.in').find('button.close').click();
                                    $window.location.href = "package/healthians-full-body-checkup-with-thyroid-and-cbc";
                                }, 15000);

                            });    

                                                
                        }
                        else {
                            $timeout(function() {
                                $('.modal-backdrop').remove();
                                $('.modal.in').find('button.close').click();
                                $window.location.href = "package/healthians-full-body-checkup-with-thyroid-and-cbc";
                            }, 10000);
                        }
                    } else {
                        //grecaptcha.reset();
                        alert(data.message);
                    }
                });
            }
        }

    }

    if($state.current.name === "web-campaign") {
        scope.startTicker();
    }

    var callback = function () {
        if (typeof(url) != 'undefined') {
          $window.location = url;
        }
    };

    scope.gtag_report_conversion = function(url) {
        if(typeof gtag == 'function') {
            gtag('event', 'conversion', {
              'send_to': 'AW-929610874/kgHcCP-t048BEPr4orsD',
              'event_callback': callback
            });
        }
        
        return false;
    }
}
