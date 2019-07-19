App.controller('headerController', headerController);
headerController.$inject = ['$http', '$window', '$scope', 'HomeService', '$localStorage', '$sessionStorage', '$location', '$timeout', '$state', '$rootScope', '$remember', '$q', 'ConstConfig', 'Facebook', 'cartService', '$analytics'];

function headerController($http, $window, scope, HomeService, $localStorage, $sessionStorage, $location, $timeout, $state, $rootScope, $remember, $q, ConstConfig, Facebook, cartService, $analytics) {
    scope.forgotPwdModal = false;
    scope.changePwdModal = false;
    scope.mobileModal = false;
    $rootScope.loggedin = false;
    $rootScope.user = "";
    scope.signupmsg = false;
    scope.partialSignUpModal = false;
    scope.callbackMobileModal = false;

    scope.$emit('userLoggedInSuccess');

    //scope.cityList = [];

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


    scope.time_slot = localStorage.getItem("time_slot");
    scope.tempUser = JSON.parse(localStorage.getItem("tempUser"));

    var cityArray = JSON.parse(localStorage.getItem("cityID"));
    if (cityArray === null) {
        localStorage.setItem("cityID", JSON.stringify([{ "city_id": "23", "city_name": "Gurgaon" }]));
    }

    /* Login/Signup New - Start */
    scope.loginModal = false;
    //scope.loginTab = true;

    scope.signupText = "Sign Up";

    scope.showLoginForm = function() {
        //scope.loginTab = true;
        scope.loginModal = true;
    };

    scope.hideLoginForm = function() {
        //scope.loginTab = true;
        scope.loginModal = false;
    };

    scope.showSignupForm = function() {
        scope.loginTab = false;
        scope.loginModal = true;
        if(scope.signupText !== "Continue to Cart") {
            scope.signupText = "Sign Up";
        }
        else {
            scope.signupText = "Continue to Cart";
        }
        
    };

    scope.emailLogin = false;

    scope.showEmailLogin = function() {
        scope.emailLogin = true;
    }

    scope.showMobileLogin = function() {
        scope.emailLogin = false;
    }

    scope.showLoginForm = function() {
        //scope.loginTab = true;
        scope.loginModal = true;
    };
    
    scope.showPartialSignupForm = function() {
        scope.partialSignUpModal = true;
    };

    scope.hidePartialSignupForm = function() {
        scope.partialSignUpModal = false;
    };

    scope.backToLoginPartialSignupForm = function() {
        scope.partialSignUpModal = false;
        scope.showLoginForm();
    };
    
    scope.showSignUpSuccess = function() {
        scope.signupmsg = true;
    }
    /* Login/Signup New - END */

    if ($state.current.name == 'pick-time' || $state.current.name == 'payment-summary' || $state.current.name == 'orderbook' || $state.current.name == 'confirm-address' || $state.current.name == 'make-payment' || $state.current.name == 'order-summary' || $state.current.name == 'payment-fail') {
        if ((scope.time_slot == null || scope.time_slot == "" || scope.time_slot == undefined) && $state.current.name != 'pick-time') {
        }

        if ((scope.tempUser == undefined || scope.tempUser == null) && $state.current.name == 'pick-time') {
            window.location.href = '/orderbook';
        }
    }

    //scroll to top page
    if ($state.current.name == 'about-us' || $state.current.name == 'healthians-media' || $state.current.name == 'career' || $state.current.name == 'contact-us' || $state.current.name == 'healthians-investors' || $state.current.name == 'orderbook' || $state.current.name == 'pick-time' || $state.current.name == 'make-payment' || $state.current.name == 'confirm-address' || $state.current.name == 'Support-Help') {
        $window.scrollTo(0, angular.element(document.getElementById('topdiv')).offsetTop);
    };

    //condition for page for logged in user
    if ($state.current.name == 'dashboard') {
        if (localStorage.getItem("isLogin") !== 'true') {
            window.location.href = '/';
        }
    }
    if ($state.current.name == 'download-file') {
        if (localStorage.getItem("isLogin") == 'true') {
            window.location.href = '/';
        }
    }

    //function for getting current city using google api
    scope.getAddress = function() {
        var deferred = $q.defer();
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + pos.lat + "," + pos.lng + "&sensor=false";
            doGet($http, url, function(data) {
                if(data.results) {
                    if (data.results.length > 0) {
                        var addComponents = data.results[0].address_components;
                        addComponents.forEach(function(ele, index) {
                            if (ele.types[0] == 'locality') {
                                scope.googleApiCity = ele.long_name;
                                deferred.resolve(scope.googleApiCity);
                            }
                        });
                    }
                }                
            });
        });
        return deferred.promise;
    };


    if ($state.current.name == 'package' || $state.current.name == 'profile' || $state.current.name == 'parameter' || $state.current.name == 'unsubscribe') {
        if (cityArray === null) {
            scope.cityObj = [{ "city_id": "23", "city_name": "Gurgaon" }];
            localStorage.setItem("cityID", JSON.stringify(scope.cityObj));
            scope.searchCity = 'Gurgaon';
        }
        else {
            scope.cityObj = JSON.parse(localStorage.getItem("cityID"));
            scope.searchCity = JSON.parse(localStorage.getItem("cityID"))[0].city_name;
        }

        var promise = scope.getAddress().then(function(response) {
            $http({
                method: "GET",
                url: ConstConfig.serverUrl + "commonservice/city_detail",
                params: {
                    "city_name": scope.googleApiCity
                },
            }).success(function(data) {
                if(data.data) {
                    scope.searchCity = data.data[0].city_name;
                    scope.cityObj.push(data.data[0]);
                    localStorage.setItem("cityID", JSON.stringify(scope.cityObj));
                }
            });
        });

    } else {
        scope.searchCity = JSON.parse(localStorage.getItem("cityID"))[0].city_name;
    }

    scope.setHeader = function() {
    	if (localStorage.getItem("isLogin") == 'true') {
            $rootScope.loggedin = true;
            var name = JSON.parse(localStorage.getItem("user")).name;

            var firstName = name.split(" ");
            $rootScope.user = firstName[0].charAt(0).toUpperCase().concat(firstName[0].substr(1));
            $rootScope.user_id = JSON.parse(localStorage.getItem("user")).user_id;

            scope.userLoginDetails = JSON.parse(localStorage.getItem("user"));
            var email = scope.userLoginDetails.email;
            var age = scope.userLoginDetails.age;
            var gender = scope.userLoginDetails.gender;
            var mobile = scope.userLoginDetails.mobile;

            if (localStorage.getItem("isSocialLogin") == 'true') {
                if (scope.userLoginDetails.mobile === "") {
                    scope.mobileModal = true;
                } else {
                    scope.mobileModal = false;
                }
            }

            if(localStorage.getItem("token") === null){
                localStorage.setItem("showLoginDialog", "true");
            }

             if (name === '' || email === null || email === '' || age === '' || gender === '' || mobile === '' || mobile === null || age === '0' || gender === null) {
                scope.showPartialSignupForm();
                scope.$broadcast('showPreviousUserDetailsCheck');
            }

        }
    }

    scope.setHeader();

    scope.$on('showPreviousUserDetails', function(event, data) {
        scope.$broadcast('showPreviousUserDetailsCheck');
    });

    scope.showLoginModal = function() {
        scope.loginModal = true;
        scope.forgotPwdModal = false;
    }

    scope.showForgotPwdForm = function() {
        scope.loginModal = false;
        scope.forgotPwdModal = !scope.forgotPwdModal;
    };

    scope.showChangePwdForm = function() {
        scope.changePwdModal = !scope.changePwdModal;
    };

    scope.showForgotPwdOtpForm = function() {
        scope.forgotPwdOtpModal = !scope.forgotPwdOtpModal;
    };


    //service call for get city 
    scope.getCityList = function() {
        HomeService.getCityDetail(function(data) {
            if (data.status == 'success') {
                scope.cityList = data.data;
                localStorage.setItem("cityList", JSON.stringify(scope.cityList));
            }
        });
    };

    scope.$on('cityDropdownRefresh', function(event, data) {
        scope.searchCity = JSON.parse(localStorage.getItem("cityID"))[0].city_name;
    });

    scope.sigOut = function() {
        var user_id = JSON.parse(localStorage.getItem("user")).user_id;
        HomeService.logout({"source":"web", "user_id": user_id}, function(data) {
            if (data.status) {
                localStorage.setItem("isLogin", "false");
         
                localStorage.removeItem("token");
                localStorage.removeItem("customerDetails");
                localStorage.removeItem("sample_date");
                localStorage.removeItem("user");
                localStorage.removeItem("coupondata");
                localStorage.removeItem("type_of_payment");
                localStorage.removeItem("total_amount");
                localStorage.removeItem("amountfinal");
                localStorage.removeItem("userDetail");
                localStorage.removeItem("Detailscustomer");
                localStorage.removeItem("houseno");
                localStorage.removeItem("landmark");
                localStorage.removeItem("postal_code");
                localStorage.removeItem("address");
                localStorage.removeItem("isSocialLogin");
                localStorage.removeItem("booking_id");
                localStorage.removeItem("makepayment_to_summary");
                localStorage.removeItem("tempUser");
                localStorage.removeItem("time_slot");
                localStorage.removeItem("showLoginDialog");

                localStorage.removeItem("tempCart");
                localStorage.removeItem("tempPkg");
                localStorage.removeItem("selectPatient");
                
                $location.path('/');
                $rootScope.loggedin = false;

                Facebook.getLoginStatus(function(response) {
                    if (response.status == 'connected') {
                        Facebook.logout(function(response) {});
                    }
                });
            }
        });
    };


    scope.selectCity = function(obj) {
        scope.cityObj = [];
        scope.searchCity = obj;
        for (var i = 0; i < scope.cityList.length; i++) {
            if (scope.searchCity === scope.cityList[i].city_name) {
                scope.cityObj.push(scope.cityList[i]);
                localStorage.setItem("cityID", JSON.stringify(scope.cityObj));
                scope.$emit('changeCityDropown');
            }
        }
    };

    scope.listCity = function() {
        if ($state.current.name != 'order-summary' && $state.current.name != 'pick-time' && $state.current.name != 'confirm-address' && $state.current.name != 'make-payment') {
            scope.cityListShow = true;
        }
    };

    scope.downloadreport = function() {
        $location.path('/download-file');
    }

    scope.myBooking = function() {
        $location.path('/dashboard');
        $location.hash('mybooking');
        $rootScope.$broadcast('my-booking');
    };

    scope.getCityList();
    
    scope.$on('tokenExpired', function(event, data) {
        localStorage.setItem("isLogin", "false");
 
        localStorage.removeItem("token");
        localStorage.removeItem("customerDetails");
        localStorage.removeItem("sample_date");
        localStorage.removeItem("user");
        localStorage.removeItem("coupondata");
        localStorage.removeItem("type_of_payment");
        localStorage.removeItem("total_amount");
        localStorage.removeItem("amountfinal");
        localStorage.removeItem("userDetail");
        localStorage.removeItem("Detailscustomer");
        localStorage.removeItem("houseno");
        localStorage.removeItem("landmark");
        localStorage.removeItem("postal_code");
        localStorage.removeItem("address");
        localStorage.removeItem("isSocialLogin");
        localStorage.removeItem("booking_id");
        localStorage.removeItem("makepayment_to_summary");
        localStorage.removeItem("tempUser");
        localStorage.removeItem("time_slot");

        localStorage.removeItem("tempCart");
        localStorage.removeItem("tempPkg");
        localStorage.setItem("showLoginDialog", "true");
        $rootScope.loggedin = false;

        Facebook.getLoginStatus(function(response) {
            if (response.status == 'connected') {
                Facebook.logout(function(response) {});
            }
        });
        $location.path('/');
    });

    scope.ini = function() {
        $(document).on('click', 'body', function(e) {
            if ($state.current.name != 'order-summary' && $state.current.name != 'pick-time' && $state.current.name != 'confirm-address' && $state.current.name != 'make-payment' && $state.current.name != 'payment-summary') {
                if($state.current.name === 'final_checkout') {
                    if(scope.sublocalityDropDownSelected) {
                        $('.detect-drop-down').hide();
                    }
                    else {
                        if ($(e.target).closest('ul.locationHeader').length > 0 && $(e.target).prop('tagName').toUpperCase() == 'A') {
                            $('.detect-drop-down').show(50);
                        } else {
                            $('.detect-drop-down').hide();
                        }
                    }
                }
                else {
                    if ($(e.target).closest('ul.locationHeader').length > 0 && $(e.target).prop('tagName').toUpperCase() == 'A') {
                        $('.detect-drop-down').show(50);
                    } else {
                        $('.detect-drop-down').hide();
                    }
                }
            }
        });
    };

    scope.ini();

    // If logged in user has not encrypted user id in relatives
    if (localStorage.getItem("isLogin") == 'true') {
        scope.member = JSON.parse(localStorage.getItem("user")).relatives;
        if(scope.member.length > 0) {
            var user_id = scope.member[0].user_id;
            if (user_id.length > 15) {
            }
            else {
                $rootScope.$broadcast('tokenExpired');
            }
           
        }
        var cartPages = ["cart", "final_checkout"];
        if(!_.contains(cartPages, $state.current.name)) {
            if($rootScope.totalCartTest <=0) {
                HomeService.cartCount();
            }            
        }       
    }

    

    /* Exit Popup - Start */
    scope.exitError = false;
    var oldY = 0;
    scope.mobileExitPopupDiv = false;

    var restrictPopupPage = ['cart', 'final_checkout', 'orderbook', 'package', 'profile', 'parameter', 'habit', 'risk', 'user_selection_cart', 'csat', 'healthkarma', 'healthkarma-v2', 'phlebo-route', 'paytm'];

    if (isMobile.any()) {
        scope.mobileview = true;
    
        /* Open Mobile exit popup */
        $timeout(function() {
            if (!_.contains(restrictPopupPage, $state.current.name)) {
                if (document.cookie && document.cookie.indexOf('ExitPopupMobileCookie=1') != -1) {
                    /* Cookie present - nothing to do */
                } 
                else {
                    scope.mobileExitPopupDiv = true;
                    localStorage.setItem("isLeadCaptured", false);
                    
                    // if(typeof grecaptcha !== 'undefined') {
                    //     var widgetId4;
                    //     if(widgetId4 == 0) {
                    //         grecaptcha.reset(widgetId4)
                    //         if($('#capt_exit_header_mob').length) {
                    //             widgetId4 = grecaptcha.render('capt_exit_header_mob', {'sitekey' : $rootScope.gCatchaKey});
                    //         }
                    //     }
                    //     else {
                    //         if($('#capt_exit_header_mob').length) {
                    //             widgetId4 = grecaptcha.render('capt_exit_header_mob', {'sitekey' : $rootScope.gCatchaKey});
                    //         }
                    //     }
                    // }
                }
            }
        }, 40000);
    }
    else {
        scope.mobileview = false;
        angular.element(document).mousemove(function(e) {
            scope.exitError = false;
            angular.element('#exitpopup').css('left', ($window.innerWidth/2 - $('#exitpopup').width()/2));
            angular.element('#exitpopup').css('top', ($window.innerHeight/3 - $('#exitpopup').height()/2));
        
            //if(e.pageY <= 5) {
            if( (e.clientY <= 5) || (e.pageY < oldY) ) {
                if (document.cookie && document.cookie.indexOf('ExpirationCookieTest=1') != -1)  {
                    /* Cookie present - nothing to do */
                }
                else {
                    if (!_.contains(restrictPopupPage, $state.current.name)) {
                        
                        // Show the exit popup
                        localStorage.setItem("isLeadCaptured", false);
                        angular.element('#exitpopup_bg').fadeIn(100);
                        angular.element('#exitpopup').fadeIn(100);
                        $analytics.eventTrack('Exit Popup - View', { category: 'Exit Pop up' });

                        angular.element("#customerno").focus();
                        oldY = e.pageY;

                        // if(typeof grecaptcha !== 'undefined') {
                        //     if($("#exit_header_web").length ==0) {
                        //         var widgetId3;
                        //         $('#capt_exit_header_web').html("");
                        //         $('<div/>', {id: 'exit_header_web'}).appendTo('#capt_exit_header_web');

                        //         if(widgetId3 == 0) {
                        //             grecaptcha.reset(widgetId3);
                        //             if($('#exit_header_web').length) {
                        //                 widgetId3 = grecaptcha.render('exit_header_web', {'sitekey' : $rootScope.gCatchaKey});
                        //             }
                        //         }
                        //         else {
                        //             if($('#exit_header_web').length) {
                        //                 widgetId3 = grecaptcha.render('exit_header_web', {'sitekey' : $rootScope.gCatchaKey});
                        //             }
                        //         }
                        //     }                                
                        // }
                    }
                }
            }
        });
    }
    
    scope.closeMobileExitPopup = function() {
        $analytics.eventTrack('Mobile Exit Popup - Close', { category: 'Mobile Exit Pop up' });
        scope.mobileExitPopupDiv = false;
        var now = new Date();
        var exp = new Date(now.getTime() + (1 * 24 * 60 * 60 * 1000));
        document.cookie = 'ExitPopupMobileCookie=1; expires=' + exp.toUTCString();
    }

    scope.closeExitPopup = function() {
        angular.element('#exitpopup_bg').fadeOut(0);
        angular.element('#exitpopup').slideUp(0);

        $analytics.eventTrack('Exit Popup - Close', { category: 'Exit Pop up' });
        
        var now = new Date();
        var exp = new Date(now.getTime() + (1*24*60*60*1000));
        document.cookie = 'ExpirationCookieTest=1; expires='+exp.toUTCString();
    }

    angular.element('#exitpopup_bg').click(function(){
        scope.closeExitPopup();
    });

    angular.element('#closemodal').click(function(){
        scope.closeExitPopup();
    });

    angular.element('#closemodal2').click(function(){
        scope.closeExitPopup();
    });
    
    scope.changeExitPopupButtonColor = function() {
        if(scope.customerNo) {
            if (scope.customerNo.length !== 10 || isNaN(scope.customerNo) || scope.customerNo === undefined || scope.customerNo === '') {
                angular.element("#exitpopupsubmitbtn").css('background','#b7b7b7');
                angular.element("#exitpopupsubmitbtn").css('border-bottom', '1px solid #cecece');
                angular.element("#exitpopupsubmitbtn").css('background-image','linear-gradient(to bottom, #b7b7b7 0%, #cecece 100%)');
            }
            else {
                angular.element("#exitpopupsubmitbtn").css('background','#e1530d');
                angular.element("#exitpopupsubmitbtn").css('border-bottom', '1px solid #eaeaea');
                angular.element("#exitpopupsubmitbtn").css('background-image','linear-gradient(to bottom, #ff7632 0%, #e1530d 100%)');
            }   
        }     
    }

    scope.sendDetails = function() {
        //var g_recaptcha_response = grecaptcha.getResponse(widgetId3);

        scope.addLeadFormSubmitted = false;

        if (scope.customerNo === undefined || scope.customerNo === '') {
            scope.addLeadForm.customerno.$dirty = true;
            scope.addLeadForm.customerno.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: 'Exit Pop up', label: 'Validation Fail : Mobile no. not enter' });
            return false;
        }  

        if(isNaN(scope.customerNo)) {
            scope.mobile_valid_error = true;
            scope.mobile_valid_msg = "Enter valid Mobile number";
            $analytics.eventTrack('Validation Fail', { category: 'Exit Pop up', label: 'Validation Fail : Not a number' });

            $timeout(function() {
                scope.mobile_valid_error = false;
            }, 2000);
            return false;
        }
        if(scope.customerNo.length !== 10) {
            scope.mobile_valid_error = true;
            scope.mobile_valid_msg = "Mobile number should be of 10 digits";
            $analytics.eventTrack('Validation Fail', { category: 'Exit Pop up', label: 'Validation Fail : Not 10 digits' });

            $timeout(function() {
                scope.mobile_valid_error = false;
            }, 2000);
            return false;
        }

        // if(g_recaptcha_response.length == 0) {
        //     $window.alert("Please check Captcha Checkbox");
        //     return false;
        // }

        var requestData = {
            "data":  {
                "utm_id": 'exitpopup',
                "name":scope.customerName,
                "mobile":scope.customerNo,
                "originator": "home",
                "source": "web"
            }
        };

        if(localStorage.getItem("guid")) {
            requestData['data']['guid'] = localStorage.getItem("guid");
        }

        var url = ConstConfig.couponUrl + "webv1/web_api/saveEmailCompaignData";
        doPostWithOutToken($http, url, requestData, "", function(data) {
            if (data.status) {
                scope.exitError = true;
                if(data.message === 'Lead successfully inserted') {
                    /* For Analytics - Payment Mode */
                    $analytics.eventTrack('Lead Captured', {
                        category: 'Exit Form',
                        label: scope.customerNo,
                    });

                    if(typeof($window.fbq) !== 'undefined') {
                        $window.fbq('track', 'Lead', requestData);
                    }                    
                }

                scope.customerName = '';
                scope.customerNo = '';   
                scope.Message = '';
                scope.addLeadForm.name.$dirty = false;
                scope.addLeadForm.customerno.$dirty = false;

                $timeout(function() {
                    scope.exitError = false;
                    scope.closeExitPopup();
                }, 4000);
            } else {
                //grecaptcha.reset();
                $window.alert(data.message);
            }
        });
    }

    scope.changeMobileExitPopupButtonColor = function() {
        if(scope.exmcustomerNo) {
            if (scope.exmcustomerNo.length !== 10 || isNaN(scope.exmcustomerNo) || scope.exmcustomerNo === undefined || scope.exmcustomerNo === '') {
                angular.element("#exitmobilepopupsubmitbtn").css('background','#b7b7b7');
                angular.element("#exitmobilepopupsubmitbtn").css('border-bottom', '1px solid #cecece');
                angular.element("#exitmobilepopupsubmitbtn").css('background-image','linear-gradient(to bottom, #b7b7b7 0%, #cecece 100%)');
            }
            else {
                angular.element("#exitmobilepopupsubmitbtn").css('background','#e1530d');
                angular.element("#exitmobilepopupsubmitbtn").css('border-bottom', '1px solid #eaeaea');
                angular.element("#exitmobilepopupsubmitbtn").css('background-image','linear-gradient(to bottom, #ff7632 0%, #e1530d 100%)');
            }
        }
    }

    scope.exitMobileError = false;
    scope.sendMobileExitPopupDetails = function() {
        //var g_recaptcha_response = grecaptcha.getResponse(widgetId4);
        scope.addLeadFormSubmitted = false;

        if (scope.exmcustomerNo === undefined || scope.exmcustomerNo === '') {
            scope.addMobileExitPopupLeadForm.exmcustomerno.$dirty = true;
            scope.addMobileExitPopupLeadForm.exmcustomerno.$invalid = true;
            $analytics.eventTrack('Mobile Exit Pop - Get a Callback Now', { category: 'Mobile Exit Pop up', label: 'Validation Fail : Mobile no. not enter' });
            return false;
        }

        if (isNaN(scope.exmcustomerNo)) {
            scope.mobile_valid_error = true;
            scope.mobile_valid_msg = "Enter valid Mobile number";
            $analytics.eventTrack('Mobile Exit Pop - Get a Callback Now', { category: 'Mobile Exit Pop up', label: 'Validation Fail : Not a number' });

            $timeout(function() {
                scope.mobile_valid_error = false;
            }, 2000);
            return false;
        }
        if (scope.exmcustomerNo.length !== 10) {
            scope.mobile_valid_error = true;
            scope.mobile_valid_msg = "Mobile number should be of 10 digits";
            $analytics.eventTrack('Mobile Exit Pop - Get a Callback Now', { category: 'Mobile Exit Pop up', label: 'Validation Fail : Not 10 digits' });

            $timeout(function() {
                scope.mobile_valid_error = false;
            }, 2000);
            return false;
        }

        // if(g_recaptcha_response.length == 0) {
        //     $window.alert("Please check Captcha Checkbox");
        //     return false;
        // }

        var requestData = {
            "data": {
                "utm_id": 'mobileexitpopup',
                "name": scope.exmcustomerName,
                "mobile": scope.exmcustomerNo,
                "originator": "home",
                "source": "mobile"
            }
        };

        if(localStorage.getItem("guid")) {
            requestData['data']['guid'] = localStorage.getItem("guid");
        }

        var url = ConstConfig.couponUrl + "webv1/web_api/saveEmailCompaignData";
        doPostWithOutToken($http, url, requestData, "", function(data) {
            if (data.status) {
                scope.exitMobileError = true;
                 /* Pixel Fire in case of new number */
                if(data.message === 'Lead successfully inserted') {
                    /* For Analytics - Payment Mode */
                    $analytics.eventTrack('Lead Captured', {
                        category: 'Mobile Exit Form',
                        label: scope.exmcustomerNo,
                    });

                    if(typeof($window.fbq) !== 'undefined') {
                        $window.fbq('track', 'Lead', requestData);
                    }                    
                }

                scope.exmcustomerName = '';
                scope.exmcustomerNo = '';
                scope.addMobileExitPopupLeadForm.exmname.$dirty = false;
                scope.addMobileExitPopupLeadForm.exmcustomerno.$dirty = false;

                $timeout(function() {
                    scope.exitMobileError = false;
                    scope.closeMobileExitPopup();
                }, 4000);
            } else {
                //grecaptcha.reset();
                $window.alert(data.message);
            }
        });
    }

    /* Exit Popup - End */
}
