App.controller('healthcheckupController', healthcheckupController);
healthcheckupController.$inject = ['$scope', '$timeout', '$rootScope', '$location', '$http', '$stateParams', 'ConstConfig', 'HomeService', '$window', '$analytics', '$interval', '$state', '$sce'];

function healthcheckupController(scope, $timeout, $rootScope, $location, $http, $stateParams, ConstConfig, HomeService, $window, $analytics, $interval, $state, $sce) {
    
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

    var widgetIdHealthCheckupWEB;
    var widgetIdHealthCheckupMOB;

    scope.setMetaTags = function(metadetails) {
        $rootScope.title = metadetails.meta_title;
        $rootScope.description = metadetails.meta_desc;
        $rootScope.keyword = metadetails.meta_keyword;
        $rootScope.meta_footer = metadetails.meta_footer;

        scope.descp = metadetails.description;

        if(metadetails.canonical_url !== '') {
            $rootScope.meta_canonical = metadetails.canonical_url;
        }
        else {
            $rootScope.meta_canonical = "https://www.healthians.com"+$location.$$url;
        }

        var robot = '';

        if (metadetails.robot_index == 1) {
            robot += 'index, ';
        }
        else {
            robot += 'noindex, ';
        }

        if (metadetails.robot_follow == 1) {
            robot += 'follow';
        }
        else {
            robot += 'nofollow';
        }

        $rootScope.meta_robots = robot;
    }

    scope.stateParms = $stateParams;
    scope.ga_category = 'web-health-checkup-campaign';

    scope.hideDeskForm = true;
    scope.hideMobForm = true;
    scope.hideDeskCallBtn = false;

    if (isMobile.any()) {
        scope.hideDeskCallBtn = true;
        scope.hideDeskForm = false;
    }

    scope.showDeskLeadForm = function() {
        scope.hideDeskForm = !scope.hideDeskForm;
        $window.scrollTo(0, 100);
    }

    scope.showMobLeadForm = function() {
        scope.hideMobForm = !scope.hideMobForm;
    }

    scope.trustAsHtml = function(html) {
      return $sce.trustAsHtml(html);
    }

    if (scope.stateParms) {
        if(scope.stateParms.link_rewrite) {
                     
            var requestPayload = {
                "link_rewrite": scope.stateParms.link_rewrite,
                "source": "web"
            }

            var seoDetailURL = ConstConfig.serverUrl+"commonservice/lead_page_management";

            $http({
                method: "GET",
                url: seoDetailURL,
                params: requestPayload,
            }).success(function(data) {
                if (data.status == true) {
                    scope.display_name = data.data.product_name;
                    scope.main_html = data.data.html;
                    if(data.data.meta_details) {
                        scope.setMetaTags(data.data.meta_details);
                    }                   

                    // $timeout(function() {
                    //     if(typeof grecaptcha !== 'undefined') {                            
                    //         if(widgetIdHealthCheckupWEB == 0) {
                    //             grecaptcha.reset(widgetIdHealthCheckupWEB);
                    //             if($('#capt_landing').length) {
                    //                 widgetIdHealthCheckupWEB = grecaptcha.render('capt_landing', {'sitekey' : $rootScope.gCatchaKey});
                    //             }
                    //         }
                    //         else {
                    //             if($('#capt_landing').length) {
                    //                 widgetIdHealthCheckupWEB = grecaptcha.render('capt_landing', {'sitekey' : $rootScope.gCatchaKey});
                    //             }
                    //         }


                    //         if(widgetIdHealthCheckupMOB == 0) {
                    //             grecaptcha.reset(widgetIdHealthCheckupMOB);
                    //             if($('#capt_mobile_landing_page').length) {
                    //                 widgetIdHealthCheckupMOB = grecaptcha.render('capt_mobile_landing_page', {'sitekey' : $rootScope.gCatchaKey});
                    //             }
                    //         }
                    //         else {
                    //             if($('#capt_mobile_landing_page').length) {
                    //                 widgetIdHealthCheckupMOB = grecaptcha.render('capt_mobile_landing_page', {'sitekey' : $rootScope.gCatchaKey});
                    //             }
                    //         }
                    //     }
                    // }, 3000);

                } else {
                    scope.loading = false;
                    scope.errorPkg = true;
                    scope.errorPkgMsg = "Something went wrong.";
                    $state.go('home');
                }
            }).error(function(){
                scope.loading = false;
                scope.errorPkg = true;
                scope.errorPkgMsg = "Something went wrong.";
                $state.go('home');
            });
        }
        else {
            $state.go('home');
        }
        scope.utmid = scope.stateParms.utmid;

        if(typeof scope.stateParms.email !== 'undefined') {
            scope.customerEmail = scope.stateParms.email
        }
        if(typeof scope.stateParms.name !== 'undefined') {
            scope.customerName = scope.stateParms.name;
        }
        if(typeof scope.stateParms.mobile !== 'undefined') {
            scope.customerNo = scope.stateParms.mobile;
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

    //service call for get city 
    scope.getCityList = function() {
        HomeService.getCityDetail(function(data) {
            if (data.status == 'success') {
                scope.cityList = data.data;
            }
        });
    };

    scope.getCityList();

    scope.sendDetails = function() {
        //var g_recaptcha_response = grecaptcha.getResponse(widgetIdHealthCheckupWEB);
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

        // if(g_recaptcha_response.length == 0) {
        //     $window.alert("Please check Captcha Checkbox");
        //     return false;
        // }

        if (scope.stateParms) {
            scope.utmid = scope.stateParms.utmid;

            if(scope.utmid === '') {
               scope.utmid = 'web-health-checkup-campaign'            
            }

            if(scope.utmid !== '') {
                var requestData = {
                    "data":  {
                        "utm_id": scope.utmid,
                        "name":scope.customerName,
                        "email":scope.customerEmail,
                        "mobile":scope.customerNo,
                        "city":scope.City,
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

                requestData['data']['message'] = 'Customer search for : '+ scope.display_name;

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
                                    $state.go('home');
                                }, 15000);

                            });  

                                             
                        }
                        else {
                            $timeout(function() {
                                $('.modal-backdrop').remove();
                                $('.modal.in').find('button.close').click();
                                $state.go('home');
                            }, 10000);
                        }
                    } else {
                        alert(data.message);
                    }
                    //grecaptcha.reset(widgetIdHealthCheckupWEB);
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
        scope.addLeadFormSubmitted = false;

        //var g_recaptcha_response = grecaptcha.getResponse(widgetIdHealthCheckupMOB);

        if (scope.customerNo === undefined || scope.customerNo === '') {
            scope.addLeadFormMobile.customerno.$dirty = true;
            scope.addLeadFormMobile.customerno.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Mobile No. not enter' });
            return false;
        } 
        
        if (scope.customerName === undefined || scope.customerName === '') {
            scope.addLeadFormMobile.name.$dirty = true;
            scope.addLeadFormMobile.name.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Name not enter' });
            return false;
        } 

        if (scope.City === undefined || scope.City === '') {
            scope.addLeadFormMobile.city.$dirty = true;
            scope.addLeadFormMobile.city.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'City not select' });
            return false;
        }

        if (scope.addLeadFormMobile.email.$invalid) {
            scope.addLeadFormMobile.email.$dirty = true;
            scope.addLeadFormMobile.email.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Email not enter' });
            return false;
        }

        // if(g_recaptcha_response.length == 0) {
        //     $window.alert("Please check Captcha Checkbox");
        //     return false;
        // }

        if (scope.stateParms) {
            scope.utmid = scope.stateParms.utmid;

            if(scope.utmid === '') {
               scope.utmid = 'web-health-checkup-campaign'            
            }

            if(scope.utmid !== '') {
                var requestData = {
                    "data":  {
                        "utm_id": scope.utmid,
                        "name":scope.customerName,
                        "mobile":scope.customerNo,
                        "email":scope.custEmail,
                        "city":scope.City,
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
                        scope.customerEmail = '';

                        scope.addLeadFormMobile.name.$dirty = false;
                        scope.addLeadFormMobile.customerno.$dirty = false;
                        scope.addLeadFormMobile.email.$dirty = false;

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
                                    $state.go('home');
                                }, 15000);

                            }); 
                                                    
                        }
                        else {
                            $timeout(function() {
                                $('.modal-backdrop').remove();
                                $('.modal.in').find('button.close').click();
                                $state.go('home');
                            }, 10000);
                        }
                    } else {
                        alert(data.message);
                    }
                    //grecaptcha.reset(widgetIdHealthCheckupMOB);
                });
            }
        }

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
