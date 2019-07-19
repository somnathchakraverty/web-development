App.controller('homeController', homeController);
homeController.$inject = ['$scope', '$rootScope', '$anchorScroll', '$state', '$window', 'HomeService', '$anchorScroll', '$http', '$location', 'searchDetail', '$timeout', 'dataShare', '$localStorage', '$sessionStorage', '$q', '$remember', 'ConstConfig', '$analytics', 'Facebook', 'cartService', '$document', 'focus','BookOrderService'];

function homeController(scope, $rootScope, $anchorScroll, $state, $window, HomeService, $anchorScroll, $http, $location, searchDetail, $timeout, dataShare, $localStorage, $sessionStorage, $q, $remember, ConstConfig, $analytics, Facebook, cartService, $document, focus, BookOrderService) {
    scope.forgotPwdModal = false;
    scope.signupModal = false;
    scope.changePwdModal = false;
    scope.forgotPwdOtpModal = false;
    $rootScope.loggedin = false;
    scope.popularPackageList = false;
    scope.recommendedPkg = false;
    scope.signupmsg = false;
    scope.packageList = [];
    scope.ageRange = [];
    scope.ageRange1 = [];
    //scope.riskArea = [];
    scope.cityObj = [];
    scope.cityList = [];
    scope.googleApiCity = '';
    localStorage.removeItem("booking_id");
    //cartService.setSelectedPatient('', '');
    scope.partialSignUpModal = false;
    scope.callbackMobileModal = false;

    scope.$emit('userLoggedInSuccess');
    
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

    if (isMobile.Android()) {
        if (cartService.getAppDivmobile()) {
            scope.appdivmobile = cartService.getAppDivmobile();
        }
    }

    // scope.closeMobileExitPopup = function() {
    //     $analytics.eventTrack('Exit Popup - Mobile', { category: 'Exit Pop up - Mobile' });

    //     var now = new Date();
    //     var exp = new Date(now.getTime() + (1 * 24 * 60 * 60 * 1000));
    //     document.cookie = 'ExpirationCookieTest=1; expires=' + exp.toUTCString();
    // }

    scope.closeAppDivMobile = function() {
        cartService.setAppDivmobile(false);
        scope.appdivmobile = cartService.getAppDivmobile();
    }

    scope.closeLoginModal = function() {
        scope.loginfail = false;
        scope.signupError = false;
        angular.element('#login_signup_modal').modal('hide');
    }



    var cityArray = JSON.parse(localStorage.getItem("cityID"));
    if (cityArray === null) {
        scope.cityObj = [{ "city_id": "23", "city_name": "Gurgaon" }];
        localStorage.setItem("cityID", JSON.stringify([{ "city_id": "23", "city_name": "Gurgaon" }]));
        scope.searchCity = "Gurgaon";
    } else {
        scope.cityObj = cityArray;
        scope.searchCity = scope.cityObj[0].city_name;
    }

    /* Login/Signup New - Start */
    scope.loginModal = false;
    // scope.loginTab = true;
    // scope.signupText = "Sign Up";

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
        scope.emailLogin = false;
        scope.$broadcast('getCountryList');
    };

    scope.hideLoginForm = function() {
        //scope.loginTab = true;
        scope.loginModal = false;
    };

    scope.showSignupForm = function() {
        scope.loginTab = false;
        scope.loginModal = true;
        if (scope.signupText !== "Continue to Cart") {
            scope.signupText = "Sign Up";
        } else {
            scope.signupText = "Continue to Cart";
        }
    };

    scope.showSignUpSuccess = function() {
        scope.signupmsg = true;
    }
    /* Login/Signup New - End */

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


    if (localStorage.getItem("isLogin") == 'true') {
        $rootScope.loggedin = true;
        var name = JSON.parse(localStorage.getItem("user")).name;
        var email = JSON.parse(localStorage.getItem("user")).email;
        var age = JSON.parse(localStorage.getItem("user")).age;
        var gender = JSON.parse(localStorage.getItem("user")).gender;
        var mobile = JSON.parse(localStorage.getItem("user")).mobile;

        $rootScope.user_id = JSON.parse(localStorage.getItem("user")).user_id;
        var firstName = name.split(" ");
        $rootScope.user = firstName[0].charAt(0).toUpperCase().concat(firstName[0].substr(1));

        if (localStorage.getItem("token") === null) {
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
            localStorage.removeItem("signUpCase");

            $rootScope.loggedin = false;
            Facebook.getLoginStatus(function(response) {
                if (response.status == 'connected') {
                    Facebook.logout(function(response) {});
                }
            });
        }

        if (name === '' || email === null || email === '' || age === '' || gender === '' || mobile === '' || mobile === null || age === '0' || gender === null) {
            scope.showPartialSignupForm();
            scope.$broadcast('showPreviousUserDetailsCheck');
        }

        HomeService.cartCount();

    } else {
        if (localStorage.getItem("showLoginDialog") !== null) {
            if (localStorage.getItem("showLoginDialog") == 'true') {
                scope.showLoginForm();
                localStorage.removeItem("showLoginDialog");
            }
        }
    }


    scope.$on('showPreviousUserDetails', function(event, data) {
        scope.$broadcast('showPreviousUserDetailsCheck');
    });


    angular.element('.modal-open').find('.modal-backdrop').remove();

    //scroll to top page
    if ($state.current.name == 'home') {
        $window.scrollTo(0, angular.element(document.getElementById('topdiv')).offsetTop);
    };

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

    scope.showHomeHealthkarma = function() {
        if (isMobile.any()) {
            scope.hide_healthkarma_popup = false;
        }
    }

    scope.pkglisting = function() {
        scope.popularPackageList = true;
        $anchorScroll('top-search');
        if (isMobile.any()) {
            scope.hide_healthkarma_popup = true;
        }
    };
    scope.pkglisting1 = function() {
        scope.popularPackageList1 = true;
        scope.popularPackageList = false;
        if (isMobile.any()) {
            scope.hide_healthkarma_popup = true;
        }
    };

    scope.pkgPopularAnchor = function() {
        $anchorScroll('popular-pkg');
    };

    scope.labHealthiansAnchor = function() {
        $anchorScroll('labs-healthians');
    };

    scope.closePopularList = function() {
        scope.popularPackageList = false;
        scope.hide_healthkarma_popup = false;
    };

    scope.closePopularList1 = function() {
        scope.popularPackageList1 = false;
        scope.hide_healthkarma_popup = false;
    };

    scope.showLoginModal = function() {
        scope.loginModal = true;
        scope.forgotPwdModal = false;
    }

    //function for getting current city using google api
    scope.getAddress = function() {
        var deferred = $q.defer();
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + pos.lat + "," + pos.lng;
            doGet($http, url, function(data) {
                if (data.results) {
                    if (data.results.length > 0) {
                        var addComponents = data.results[0].address_components;
                        addComponents.forEach(function(ele, index) {
                            if (ele.types[0] == 'locality') {
                                scope.googleApiCity = ele.long_name;
                                $analytics.eventTrack('Google Location of Website', { category: 'Website_location', label: scope.googleApiCity });
                                deferred.resolve(scope.googleApiCity);
                            }
                        });
                    }
                }
            });
        });
        return deferred.promise;
    };

    //service call for get city 
    scope.getCityList = function() {
        HomeService.getCityDetail(function(data) {
            if (data.status == 'success') {
                scope.cityList = data.data;
            }
        });
    };

    // listing city
    scope.findCityDetail = function(obj) {
        scope.searchCity = obj;
        scope.cityId();
    };


    scope.loadchat = function() {
        HomeService.chatwcp();
    }


    scope.cityId = function() {
        scope.cityObj = [];
        for (var i = 0; i < scope.cityList.length; i++) {
            if (scope.searchCity === scope.cityList[i].city_name) {
                scope.cityObj.push(scope.cityList[i]);
                localStorage.setItem("cityID", JSON.stringify(scope.cityObj));
                scope.getPopularPackagesList();
                scope.getPopularTestsList();

            }
        }
    };

    var promise = scope.getAddress().then(function(response) {
        $http({
            method: "GET",
            url: ConstConfig.serverUrl + "commonservice/city_detail",
            params: {
                "city_name": scope.googleApiCity
            },
        }).success(function(data) {
            if (data.data) {
                scope.cityObj = [];
                scope.searchCity = data.data[0].city_name;
                $analytics.eventTrack('Healthians Location of Website', { category: 'Website_location', label: data.data });
                scope.cityObj.push(data.data[0]);
                localStorage.setItem("cityID", JSON.stringify(scope.cityObj));
            }
        });
        // doPost($http, ConstConfig.serverUrl + "commonservice/city_detail", { "city_name": scope.googleApiCity }, "", function(data) {
        //     scope.searchCity = data.data[0].city_name;
        //     scope.cityObj.push(data.data[0]);
        //     localStorage.setItem("cityID", JSON.stringify(scope.cityObj));
        // });
    });

    scope.getCityList();

    // Search test suggestion service
    scope.tags = [];

    scope.loadTags = function(query) {

        return $http({
            method: "GET",
            url: ConstConfig.couponUrl + "webv1/web_api/packageSuggestion",
            params: { "keyword": query, "city_id": JSON.parse(localStorage.getItem("cityID"))[0].city_id },
            headers: { "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8" }
            // headers : { "Content-Type" : "application/json; charset=UTF-8"}
        }).success(function(data) {
            if (data.data == null) {
                if (isMobile.any()) {
                    scope.hide_healthkarma_popup = true;
                }

                return data.data;
                $analytics.eventTrack('Received Zero Suggestions from Auto-suggestor', { category: 'Search', label: query });
            }

            if (isMobile.any()) {
                scope.closePopularList();
                scope.hide_healthkarma_popup = true;
            }           
            
            return data.data;
        });
    };

    //Search button event function
    scope.searchResult = function() {
        if (scope.tags.length !== 0) {
            searchDetail.setSearchPackages(scope.tags);
            //$location.path('/orderbook');
            if (typeof($window.fbq) !== 'undefined') {
                // console.log(scope.tags);
                var searchLength=scope.tags.length;
                var content_ids=[];
                var content_name=[];
                var content_type='product';
                scope.tags.forEach(function(ele, ind) {
                    content_ids.push(ele['id']);
                    content_name.push(ele['text']);
                });
                var fbData=[];
                fbData['content_ids']=content_ids;
                fbData['content_type']=content_type;
                fbData['content_name']=content_name;
                fbData['content_category']='Search > Home Page';
                $window.fbq('track', 'Search', fbData);
            }

            $analytics.eventTrack('Search From Home Page', { category: 'Search', label: scope.tags });
            $timeout(function() {
                $state.go('orderbook');
            }, 500);
        }
    };

    scope.findIndex = function(tagValue, call) {
        var index = -1;

        scope.tags.forEach(function(ele, ind) {
            if (ele["text"] === tagValue)
                index = ind;
        });
        call(index);
    };


    scope.checkSelection = function($event) {

        var tagValue = $($event.target).find("a").text() || $($event.target).text();
        var tagId = $($event.target).find("a").attr('id') || $($event.target).attr('id');
        var selectedClass = $($event.target).closest("li").hasClass("selectedtest");
        if (selectedClass) {
            scope.findIndex(tagValue, function(index) {
                if (index !== -1)
                    scope.tags.splice(index, 1);
                $($event.target).closest("li").removeClass("selectedtest");
            });

        } else {
            var obj = { "text": tagValue, "id": tagId };
            scope.tags.push(obj);
            $($event.target).closest("li").addClass("selectedtest");
        }
    };

    $rootScope.addTags = function(item) {};


    $rootScope.removeTag = function(item) {};

    scope.getPopularPackagesList = function() {
        $http({
            method: "GET",
            url: ConstConfig.couponUrl + "webv1/web_api/getPopularPackages",
            params: {
                "city": JSON.parse(localStorage.getItem("cityID"))[0].city_name
            },
        }).success(function(data) {
            if (data.data) {
                scope.popularPackages1 = data.data;
                scope.packageList = scope.popularPackages1;
                scope.ini();
            }
        });
    }
    scope.getPopularPackagesList();

    // doPost($http, ConstConfig.serverUrl + "commonservice/getPopularPackages", { "city": JSON.parse(localStorage.getItem("cityID"))[0].city_name }, "", function(data) {
    //     scope.popularPackages1 = data.data;
    //     scope.packageList = scope.popularPackages1;
    //     scope.ini();
    // });

    scope.getPopularTestsList = function() {

        $http({
            method: "GET",
            url: ConstConfig.couponUrl + "webv1/web_api/getPopulerTests",
            params: {
                "city": JSON.parse(localStorage.getItem("cityID"))[0].city_name
            },
        }).success(function(data) {
            if (data.data) {
                scope.popularTest1 = data.data;
            }
        });
    }
    scope.getPopularTestsList();

    scope.downloadreport = function() {
        $location.path('/download-file');
    }

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
                localStorage.removeItem("signUpCase");
                $location.path('/');
                $rootScope.loggedin = false;
                $rootScope.user = '';

                Facebook.getLoginStatus(function(response) {
                    if (response.status == 'connected') {
                        Facebook.logout(function(response) {});
                    }
                });
            }
        });
    };

    // scope.pkgGender = "null";
    // //service for filter package based on age + risk + gender
    // scope.filterPkg = function() {
    //     if (scope.pkgGender === "null") {
    //         scope.pkgSearchError = "Please select gender";
    //     } else if (scope.pkgAge === undefined || scope.pkgAge == null) {
    //         scope.pkgSearchError = "Please select age";
    //     } else if (scope.pkgRisk === undefined || scope.pkgRisk == null) {
    //         scope.pkgSearchError = "Please select risk area";
    //     } else {
    //         var opts = {
    //             "city": JSON.parse(localStorage.getItem("cityID"))[0].city_name,
    //             "gender": scope.pkgGender,
    //             "age": scope.pkgAge.value,
    //             "risk": scope.pkgRisk,
    //         }
    //     }
    // };

    //function call from package search from package list
    scope.pkgSearch = function(obj) {
        scope.tags[0] = { "id": obj.package_id, "text": obj.package_name };
        searchDetail.setSearchPackages(scope.tags);
        $location.path('/orderbook');
    };


    scope.myBooking = function() {
        $location.path('/dashboard');
        $location.hash('mybooking');
    };

    scope.ini = function() {
        setTimeout(function() {
            if (isMobile.any()) {
                $('.slider_package').slick({
                    dots: false,
                    infinite: true,
                    autoplay:true,
                    arrows:true,
                    autoplaySpeed:3000,
                    speed:800,
                    slidesToShow: 1,
                    adaptiveHeight: false,
                    lazyLoad: 'ondemand',
                });

            } else {
                $('.slider_package').slick({
                    dots: false,
                    infinite: true,
                    autoplay:true,
                    arrows:true,
                    autoplaySpeed:3000,					
                    speed:800,
                    slidesToShow: 3,
                    adaptiveHeight: false,
                    lazyLoad: 'ondemand',
                });
            }           

        }, 70);

        setTimeout(function() {
            $('.slider_package').slick('refresh');
        },300);
    };

    /* Call Back Phone */
    scope.callbackmsg = false;
    scope.callBackPhone = function() {
        if (localStorage.getItem("isLogin") == 'true') {
            var user = JSON.parse(localStorage.getItem("user"));
            var mobile_no = user.mobile;

            var request_data = {
                "data": {
                    "customer_mobile": mobile_no,
                    "app_version": "46",
                    "source": "web"
                }
            }

            $http({
                method: "POST",
                url: ConstConfig.couponUrl + "customer/account/clickToCallUrl",
                data: request_data,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded; charset=utf-8"
                }
            }).success(function(data) {
                if (data.status) {
                    scope.callbackmsg = true;
                    $timeout(function() {
                        scope.callbackmsg = false;
                        $('.modal.in').find('button.close').click();
                    }, 9000);
                }
            });
        } else {
            scope.callbackMobileModal = true;
            $rootScope.$broadcast("open_callbackpopup");
            /* Call Back Code  ---- Starts */
            scope.callbackopt_error = false;
            scope.mobile_read_only = false;
            scope.callbackSuccess = false;
        }
    }

    scope.$on('openSignupModalCallback', function(event, args) {
        scope.showSignupForm();
    });

    // Reset Coupon data local storage
    scope.coupondata = {};
    localStorage.setItem("coupondata", JSON.stringify(scope.coupondata));

    scope.getCartTotalTest = function() {
        if (localStorage.getItem("isLogin") == 'true') {
            scope.cartData = cartService.getCartDetails();
            $rootScope.totalCartTest = 0;
            scope.cartData.forEach(function(ele, index) {
                if (ele.hasOwnProperty("newpkg")) {
                    $rootScope.totalCartTest += ele.newpkg.length;
                }
            });
        }
    }

    scope.getCartTotalTest();

    scope.couponcopy = function() {
        $window.alert("Coupon code copied.");
    }

    if ($location.search().vendor_code) {
        localStorage.setItem("vendor_code", $location.search().vendor_code);
    }

    if ($location.search().admitad_uid) {
        localStorage.setItem("admitad_uid", $location.search().admitad_uid);
    }

    /* Exit Popup - Start */
    scope.exitError = false;
    var oldY = 0;

    scope.mobileExitPopupDiv = false;

    if (isMobile.any()) {
        scope.mobileview = true;
        var restrictPopupPage = ['cart', 'final_checkout', 'orderbook', 'package', 'profile', 'parameter', 'user_selection_cart', 'csat', 'healthkarma', 'healthkarma-v2', 'phlebo-route', 'paytm'];
        
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
                    //     var widgetId2;
                    //     if(widgetId2 == 0) {
                    //         grecaptcha.reset(widgetId2)
                    //         if($('#capt_exitpopup_home_mobile').length) {
                    //             widgetId2 = grecaptcha.render('capt_exitpopup_home_mobile', {'sitekey' : $rootScope.gCatchaKey});
                    //         }
                    //     }
                    //     else {
                    //         if($('#capt_exitpopup_home_mobile').length) {
                    //             widgetId2 = grecaptcha.render('capt_exitpopup_home_mobile', {'sitekey' : $rootScope.gCatchaKey});
                    //         }
                    //     }
                    // }                    
                }
            }
        }, 40000);
    } else {
        scope.mobileview = false;
        angular.element(document).mousemove(function(e) {
            scope.exitError = false;
            angular.element('#exitpopup').css('left', ($window.innerWidth / 2 - $('#exitpopup').width() / 2));
            angular.element('#exitpopup').css('top', ($window.innerHeight / 3 - $('#exitpopup').height() / 2));

            //if(e.pageY <= 5) {
            if ((e.clientY <= 5) || (e.pageY < oldY)) {
                if (document.cookie && document.cookie.indexOf('ExpirationCookieTest=1') != -1) {
                    /* Cookie present - nothing to do */
                } else {
                    $timeout(function() {
                        // Show the exit popup
                        localStorage.setItem("isLeadCaptured", false);
                        angular.element('#exitpopup_bg').fadeIn(100);
                        angular.element('#exitpopup').fadeIn(100);
                        $analytics.eventTrack('Exit Popup - View', { category: 'Exit Pop up' });

                        angular.element("#customerno").focus();
                        oldY = e.pageY;
                    }, 10000);

                    // if(typeof grecaptcha !== 'undefined') {
                    //     if($("#exit_home_web").length ==0) {
                    //         var widgetId1;
                    //         $('#capt_exitpopup_home_web').html("");
                    //         $('<div/>', {id: 'exit_home_web'}).appendTo('#capt_exitpopup_home_web');

                    //         if(widgetId1 == 0) {
                    //             grecaptcha.reset(widgetId1);
                    //             if($('#exit_home_web').length) {
                    //                 widgetId1 = grecaptcha.render('exit_home_web', {'sitekey' : $rootScope.gCatchaKey});
                    //             }
                    //         }
                    //         else {
                    //             if($('#exit_home_web').length) {
                    //                 widgetId1 = grecaptcha.render('exit_home_web', {'sitekey' : $rootScope.gCatchaKey});
                    //             }
                    //         }
                    //     }                                
                    // }
                }
            }
        });
    }

    scope.closeMobileExitPopup = function() {
        $analytics.eventTrack('Close', { category: 'Mobile Exit Pop up' });
        scope.mobileExitPopupDiv = false;
        var now = new Date();
        var exp = new Date(now.getTime() + (1 * 24 * 60 * 60 * 1000));
        document.cookie = 'ExitPopupMobileCookie=1; expires=' + exp.toUTCString();
    }

    scope.closeExitPopup = function() {
        angular.element('#exitpopup_bg').fadeOut(0);
        angular.element('#exitpopup').slideUp(0);

        $analytics.eventTrack('Close', { category: 'Exit Pop up' });

        var now = new Date();
        var exp = new Date(now.getTime() + (1 * 24 * 60 * 60 * 1000));
        document.cookie = 'ExpirationCookieTest=1; expires=' + exp.toUTCString();
    }

    angular.element('#exitpopup_bg').click(function() {
        scope.closeExitPopup();
    });

    // angular.element('#closemodal').click(function() {
    //     scope.closeExitPopup();
    // });

    angular.element('#closemodal2').click(function() {
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
        //var g_recaptcha_response = grecaptcha.getResponse(widgetId1);
        scope.addLeadFormSubmitted = false;

        if (scope.customerNo === undefined || scope.customerNo === '') {
            scope.addLeadForm.customerno.$dirty = true;
            scope.addLeadForm.customerno.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: 'Exit Pop up', label: 'Mobile no. not enter' });
            return false;
        }

        if (isNaN(scope.customerNo)) {
            scope.mobile_valid_error = true;
            scope.mobile_valid_msg = "Enter valid Mobile number";
            $analytics.eventTrack('Validation Fail', { category: 'Exit Pop up', label: 'Not a number' });

            $timeout(function() {
                scope.mobile_valid_error = false;
            }, 4000);
            return false;
        }
        if (scope.customerNo.length !== 10) {
            scope.mobile_valid_error = true;
            scope.mobile_valid_msg = "Mobile number should be of 10 digits";
            $analytics.eventTrack('Validation Fail', { category: 'Exit Pop up', label: 'Not 10 digits' });

            $timeout(function() {
                scope.mobile_valid_error = false;
            }, 4000);
            return false;
        }

        // if(g_recaptcha_response.length == 0) {
        //     $window.alert("Please check Captcha Checkbox");
        //     return false;
        // }

        var requestData = {
            "data": {
                "utm_id": 'exitpopup',
                "name": scope.customerName,
                "mobile": scope.customerNo,
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
                 /* Pixel Fire in case of new number */
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
        //var g_recaptcha_response = grecaptcha.getResponse(widgetId2);
        scope.addLeadFormSubmitted = false;

        if (scope.exmcustomerNo === undefined || scope.exmcustomerNo === '') {
            scope.addMobileExitPopupLeadForm.exmcustomerno.$dirty = true;
            scope.addMobileExitPopupLeadForm.exmcustomerno.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: 'Mobile Exit Pop up', label: 'Mobile no. not enter' });
            return false;
        }

        if (isNaN(scope.exmcustomerNo)) {
            scope.mobile_valid_error = true;
            scope.mobile_valid_msg = "Enter valid Mobile number";
            $analytics.eventTrack('Validation Fail', { category: 'Mobile Exit Pop up', label: 'Not a number' });

            $timeout(function() {
                scope.mobile_valid_error = false;
            }, 4000);
            return false;
        }
        if (scope.exmcustomerNo.length !== 10) {
            scope.mobile_valid_error = true;
            scope.mobile_valid_msg = "Mobile number should be of 10 digits";
            $analytics.eventTrack('Validation Fail', { category: 'Mobile Exit Pop up', label: 'Not 10 digits' });

            $timeout(function() {
                scope.mobile_valid_error = false;
            }, 4000);
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
                "source": "web"
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


    /* Habit and Risk - Slider - Start */
    scope.habitRisk = function(){
        //Here your view content is fully loaded !!
        BookOrderService.getAllHabitsDetails(function(data) {
            if (data.status === true) {
                scope.habitList = data.data;
                if (isMobile.any()) {
                    $('.habit-list').slick({
                        dots: false,
                        infinite: true,
                        autoplay:true,
						arrows:true,
                        autoplaySpeed:3000,
                        speed: 800,
                        slidesToShow: 2,
                        adaptiveHeight: true,
                        lazyLoad: 'ondemand',
                    });

                }
                else {
                    $('.habit-list').slick({
                        dots: false,
                        infinite: true,
                        autoplay:true,
                        autoplaySpeed:5000,
                        speed:500,
                        slidesToShow: 5,
                        adaptiveHeight: true,
                        lazyLoad: 'ondemand',
                    });
                }
                
                setTimeout(function() {
                    $('.habit-list').slick('refresh');
                },300);
                
            }
        });

        BookOrderService.getAllRiskDetails(function(data) {
            if (data.status === true) {
                scope.riskgroups = data.data;
                if (isMobile.any()) {
                    $('.riskarea-list').slick({
                        dots: false,
                        infinite: true,
                        autoplay:true,
						arrows:true,
                        autoplaySpeed:3000,
                        speed:800,
                        slidesToShow: 2,
                        adaptiveHeight: true,
                        lazyLoad: 'ondemand',
                    });

                }
                else {
                    $('.riskarea-list').slick({
                        dots: false,
                        infinite: true,
                        autoplay:true,
                        autoplaySpeed:5000,
                        speed: 300,
                        slidesToShow: 5,
                        adaptiveHeight: true,
                        lazyLoad: 'ondemand',
                    });
                }
                
                setTimeout(function() {
                    $('.riskarea-list').slick('refresh');
                },300);


            }
        });
    };

    

    scope.riskDetails = function(id,name, alias) {
        $analytics.eventTrack('Click on Risk', {
            category: 'Browse By Risk',
            label: name,
        });
        
        $window.open('/risk/'+alias.toLowerCase(), '_blank');
    }

    scope.habitDetails = function(id,name, alias) {

        $analytics.eventTrack('Click on Habit', {
            category: 'Browse By Habit',
            label: name,
        });

        $window.open('/habit/'+alias.toLowerCase(), '_blank');
    }

    /* Habit and Risk - Slider - End*/

}




App.controller('homeControllerLogin', homeControllerLogin);

homeControllerLogin.$inject = ['$scope', '$rootScope', 'focus', 'HomeService', '$http', '$location', 'searchDetail', '$timeout', 'dataShare', '$localStorage', '$sessionStorage', '$q', '$window', '$remember', 'ConstConfig', '$state', 'Facebook', 'GooglePlus', '$analytics', 'fbService'];

function homeControllerLogin(scope, $rootScope, focus, HomeService, $http, $location, searchDetail, $timeout, dataShare, $localStorage, $sessionStorage, $q, $window, $remember, ConstConfig, $state, Facebook, GooglePlus, $analytics, fbService) {

    scope.loginfail = false;
    $rootScope.signupmsgnotverified = false;
    scope.signupError = false;
    scope.signupErrorMsg = "";
    scope.loginOTPButton = false;
    scope.social_login_info = {};

    scope.showLoginLoader = false;

    /* Check mobile or desktop */
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

    scope.checkBasicMandatoryUserInfo = function() {
        var name = JSON.parse(localStorage.getItem("user")).name;
        var email = JSON.parse(localStorage.getItem("user")).email;
        var age = JSON.parse(localStorage.getItem("user")).age;
        var gender = JSON.parse(localStorage.getItem("user")).gender;
        var mobile = JSON.parse(localStorage.getItem("user")).mobile;

        scope.closeLoginModal();

        if (name === '' || email === null || email === '' || age === '' || gender === '' || mobile === '' || mobile === null || age === "0" || gender === null) {
            scope.$parent.showPartialSignupForm();
            scope.$emit('showPreviousUserDetails');
        } else {
            if ($state.current.name === 'orderbook' || $state.current.name === 'package' || $state.current.name === 'parameter' || $state.current.name === 'profile' || $state.current.name === 'risk' || $state.current.name === 'habit') {
                scope.$emit('showPatientDialog');
            } else if ($state.current.name === 'feedback') {
                scope.$emit('showUserInfoFeedback');
            } else if ($state.current.name === 'reset_password') {
                $location.path('/');
            }
        }
    }

    scope.selected_countryCode = {
        "countries_name": "India",
        "countries_isd_code": "91",
        "image_path": "https://helma.healthians.com/stationery/flags/in.png"
    };

    scope.getCountryList = function() {
        if(typeof scope.country_list === 'undefined') {
            $http({
                method: "GET",
                url: ConstConfig.couponUrl + "webv1/web_api/getCountryCode",
            }).success(function(data) {
                if (data.status) {
                    scope.country_list = data.data;
                }
            }); 
        }        
    }

    scope.setCountryCode = function(isdcode, image_path) {
        scope.selected_countryCode = {
            "countries_name": "India",
            "countries_isd_code": isdcode,
            "image_path": image_path
        };
    }

    scope.$on('getCountryList', function(event, args) {
        scope.getCountryList();
    });

    

    //call for login
    scope.login = function() {
        scope.loginFormSubmitted = false;
        scope.loginfail = false;
        if (scope.loginForm.userEmail === undefined || scope.loginForm.userEmail === '') {
            scope.loginForm.useremail.$dirty = true;
            scope.loginForm.useremail.$invalid = true;
            scope.loginForm.useremail.$error.required = true;
            focus('useremail');
            return false;
        } else if (scope.loginForm.userPwd === undefined || scope.loginForm.userPwd === '') {
            scope.loginForm.userpwd.$dirty = true;
            scope.loginForm.userpwd.$invalid = true;
            scope.loginForm.userpwd.$error.required = true;
            focus('userpwd');
            return false;
        }

        // set data for remember me
        if (scope.loginForm.remember) {
            $remember('useremail', scope.loginForm.userEmail);
            $remember('userpwd', scope.loginForm.userPwd);
        } else {
            $remember('useremail', '');
            $remember('userpwd', '');
            scope.loginForm.remember = false;
        }
        $rootScope.email = scope.loginForm.userEmail;
        $rootScope.password = scope.loginForm.userPwd;

        var opts = {
            email_or_mobile: scope.loginForm.userEmail,
            password: scope.loginForm.userPwd,
            source: 'web'
        };

        if (isMobile.any()) {
            opts['device_source'] = 'mobile';
        } else {
            opts['device_source'] = 'web';
        }

        var requestData = {
            data: opts
        };
        scope.showLoginLoader = true;
        HomeService.userLogin(requestData, function(data) {
            scope.$emit('userLoggedInSuccess');
            if (data.status === true) {
                //Set user_id in GA for logged in sessions
                $analytics.setUserProperties({ 'userId': data.data.user_id });

                /* Push people info to Webengage */
                // $window.webengage.user.login(data.data.email);
                // $window.webengage.user.setAttribute({
                //     "we_first_name": data.data.name,
                //     "we_email": data.data.email,
                //     "we_phone": "+91" + data.data.mobile
                // });

                localStorage.setItem("user", JSON.stringify(data.data));
                localStorage.setItem("isLogin", "true");
                $rootScope.loggedin = true;
                localStorage.setItem("token",data.data.token);
                var name = JSON.parse(localStorage.getItem("user")).name;
                var firstName = name.split(" ");
                $rootScope.user = firstName[0];
                $rootScope.user_id = JSON.parse(localStorage.getItem("user")).user_id;
                angular.element('#login_signup_modal').modal('hide');
                angular.element('body').removeClass('modal-open');
                angular.element('body').css("padding-right", "0px");
                localStorage.removeItem("showLoginDialog");
                if ($state.current.name === 'orderbook' || $state.current.name === 'package' || $state.current.name === 'parameter' || $state.current.name === 'profile' || $state.current.name === 'risk' || $state.current.name === 'habit') {
                    scope.$emit('showPatientDialog');
                } 
                else if ($state.current.name === 'feedback') {
                    scope.$emit('showUserInfoFeedback');
                } 
                else if ($state.current.name === 'reset_password') {
                    $location.path('/');
                }

                scope.checkBasicMandatoryUserInfo();
            } else {
                scope.loginfail = true;
                $analytics.eventTrack('Showed Error Invalid Credentials', { category: 'Login' });
            }
            scope.showLoginLoader = false;
            // if (data.data.status == "not_verified") {
            //     angular.element('#login_signup_modal').modal('hide');
            //     $rootScope.signupmsgnotverified = true;
            // }

            $timeout(function() {
                scope.loginfail = false;
            }, 8000);
        });
    };

    // set the value for login and password for remember me
    scope.rememberMe = function() {
        if (($remember('useremail') !== null && $remember('userpwd') !== null) && ($remember('useremail') !== '' && $remember('userpwd') !== '')) {
            scope.loginForm.remember = true;
            scope.loginForm.userEmail = $remember('useremail');
            scope.loginForm.userPwd = $remember('userpwd');
        }
    };

    //service call for re-send verification link
    scope.sendVerificationLink = function() {
        doPostWithOutToken($http, ConstConfig.serverUrl + "commonservice/accountActivationLink", { email: $rootScope.email, password: $rootScope.password }, "", function(data) {});
        $('.modal.in').find('button.close').click();
    };

    //call for sign up
    scope.sigup = function() {
        scope.signupError = false;
        scope.signupFormSubmitted = false;
        if (scope.signupForm.userName === undefined || scope.signupForm.userName === '') {
            scope.signupForm.username.$dirty = true;
            scope.signupForm.username.$invalid = true;
            scope.signupForm.username.$error.required = true;
            $analytics.eventTrack('Showed Error for Validation Failure', { category: 'Signup', label: 'Name' });
            focus('username');
            return false;
        } else if (scope.signupForm.userEmail === undefined || scope.signupForm.userEmail === '') {
            scope.signupForm.useremail.$dirty = true;
            scope.signupForm.useremail.$invalid = true;
            scope.signupForm.useremail.$error.required = true;
            $analytics.eventTrack('Showed Error for Validation Failure', { category: 'Signup', label: 'Email' });
            focus('useremail');
            return false;
        } else if (scope.signupForm.userPhone === undefined || scope.signupForm.userPhone === '') {
            scope.signupForm.userphone.$dirty = true;
            scope.signupForm.userphone.$invalid = true;
            scope.signupForm.userphone.$error.required = true;
            $analytics.eventTrack('Showed Error for Validation Failure', { category: 'Signup', label: 'Phone' });
            focus('userphone');
            return false;
        }
        // else if (scope.signupForm.userPwd === undefined || scope.signupForm.userPwd === '') {
        //     scope.signupForm.userpwd.$dirty = true;
        //     scope.signupForm.userpwd.$invalid = true;
        //     scope.signupForm.userpwd.$error.required = true;
        //     $analytics.eventTrack('Showed Error for Validation Failure', { category: 'Signup' });
        //     focus('userpwd');
        //     return false;
        // } 
        else if (scope.signupForm.userAge === undefined || scope.signupForm.userAge === '') {
            scope.signupForm.userage.$dirty = true;
            scope.signupForm.userage.$invalid = true;
            scope.signupForm.userage.$error.required = true;
            $analytics.eventTrack('Showed Error for Validation Failure', { category: 'Signup', label: 'Age' });
            focus('userage');
            return false;
        } else if (scope.signupForm.userGender === undefined || scope.signupForm.userGender === '') {
            scope.signupForm.usergender.$dirty = true;
            scope.signupForm.usergender.$invalid = true;
            scope.signupForm.usergender.$error.required = true;
            $analytics.eventTrack('Showed Error for Validation Failure', { category: 'Signup', label: 'Gender' });
            focus('usergender');
            return false;
        }

        var opts = {
            name: scope.signupForm.userName,
            email: scope.signupForm.userEmail,
            //password: scope.signupForm.userPwd,
            contact_number: scope.signupForm.userPhone,
            age: scope.signupForm.userAge,
            gender: scope.signupForm.userGender,
            dob: scope.signupForm.userDOB
        };

        if (isMobile.any()) {
            opts['source'] = 'mobile';
        } else {
            opts['source'] = 'web';
        }

        if (_.isEmpty(scope.social_login_info)) {

        } else {
            opts = _.extend(opts, scope.social_login_info);
        }

        if (typeof($window.fbq) !== 'undefined') {
            $window.fbq('track', 'CompleteRegistration', opts);
        }


        HomeService.userSignup(opts, function(data) {
            if (data.data.status == 'success') {
                //Set user_id in GA for logged in sessions
                $analytics.setUserProperties({ 'userId': data.data.data.user_id });

                /* Push people info to Webengage */
                // $window.webengage.user.login(data.data.data.email);
                // $window.webengage.user.setAttribute({
                //     "we_first_name": opts.name,
                //     "we_email": opts.email,
                //     "we_phone": "+91" + opts.contact_number,
                //     "we_gender": opts.gender
                // });

                localStorage.setItem("user", JSON.stringify(data.data.data));
                localStorage.setItem("isLogin", "true");
                localStorage.setItem("token", data.data.data.token);
                $rootScope.loggedin = true;
                var name = JSON.parse(localStorage.getItem("user")).name;
                var firstName = name.split(" ");
                $rootScope.user = firstName[0];
                $rootScope.user_id = JSON.parse(localStorage.getItem("user")).user_id;
                angular.element('body').removeClass('modal-open');
                angular.element('body').css("padding-right", "0px");
                scope.closeLoginModal();

                if ($state.current.name === 'orderbook' || $state.current.name === 'package' || $state.current.name === 'parameter' || $state.current.name === 'profile' || $state.current.name === 'risk' || $state.current.name === 'habit') {
                    scope.$parent.setHeader();
                    scope.$emit('showPatientDialog');
                } else {
                    scope.signupmsg = true;
                    scope.$parent.showSignUpSuccess();
                }
            }
            if (data.data.status == 'failed') {
                $analytics.eventTrack('Showed Error for Validation Failure', { category: 'Signup' });
                scope.signupError = true;
                scope.signupErrorMsg = data.data.message;
            }
            $timeout(function() {
                scope.signupError = false;
                scope.signupErrorMsg = "";
            }, 8000);
        });
    };

    /* Facebook Login Code - Starts */

    /* Watch for Facebook to be ready. */
    scope.$watch(
        function() {
            return Facebook.isReady();
        },
        function(newVal) {
            if (newVal) {
                scope.facebookReady = true;
            }
        }
    );

    scope.social_login_error = false;

    /* FB Login */
    scope.FBLogin = function() {
        $remember('useremail', '');
        $remember('userpwd', '');
        var fbpromise = HomeService.fblogin();
        fbpromise.then(function(response) {
            if (typeof response.email !== 'undefined') {
                if (response.gender === 'male') {
                    response.gender = 'M';
                } else {
                    response.gender = 'F';
                }
                scope.sociallogin(response);
            }
        });
    };

    /* Facebook Login Code - Ends */

    scope.sociallogin = function(opts) {
        scope.showLoginLoader = true;
        var request_data = {
            "data": opts
        }

        request_data['data']['source'] = 'web';

        if (isMobile.any()) {
            request_data['data']['device_source'] = 'mobile';
        } else {
            request_data['data']['device_source'] = 'web';
        }

        $http({
            method: "POST",
            url: ConstConfig.couponUrl + "customer/account/checkLogin",
            data: request_data,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded; charset=utf-8"
            }
        }).success(function(data) {
            if (data.status) {
                scope.$emit('userLoggedInSuccess');

                if (data.signUp === false) {
                    localStorage.setItem("signUpCase", "false");

                    $analytics.setUserProperties({ 'userId': data.data.user_id });

                    // if(typeof($window.webengage) !== 'undefined') {
                    //     $window.webengage.user.login(data.data.email);
                    //     $window.webengage.user.setAttribute({
                    //         "we_first_name": data.data.name,
                    //         "we_email": data.data.email,
                    //         "we_phone": "+91" + data.data.mobile
                    //     });
                    // }

                    localStorage.setItem("user", JSON.stringify(data.data));
                    localStorage.setItem("isLogin", "true");
                    $rootScope.loggedin = true;
                    localStorage.setItem("token", data.data.token);
                    var name = JSON.parse(localStorage.getItem("user")).name;
                    var firstName = name.split(" ");
                    $rootScope.user = firstName[0];
                    $rootScope.user_id = JSON.parse(localStorage.getItem("user")).user_id;
                    angular.element('#login_signup_modal').modal('hide');
                    angular.element('body').removeClass('modal-open');
                    angular.element('body').css("padding-right", "0px");

                    localStorage.removeItem("showLoginDialog");


                    scope.checkBasicMandatoryUserInfo();
                } else {
                    /* Sign Up Case - New Case */
                    $analytics.setUserProperties({ 'userId': data.data.user_id });

                    // $window.webengage.user.login(data.data.email);
                    // $window.webengage.user.setAttribute({
                    //     "we_first_name": data.data.name,
                    //     "we_email": data.data.email,
                    //     "we_phone": "+91" + data.data.mobile
                    // });

                    localStorage.setItem("user", JSON.stringify(data.data));
                    localStorage.setItem("isLogin", "true");
                    localStorage.setItem("signUpCase", "true");

                    $rootScope.loggedin = true;
                    localStorage.setItem("token", data.data.token);
                    var name = JSON.parse(localStorage.getItem("user")).name;
                    var firstName = name.split(" ");
                    $rootScope.user = firstName[0];
                    $rootScope.user_id = JSON.parse(localStorage.getItem("user")).user_id;

                    angular.element('#login_signup_modal').modal('hide');
                    angular.element('body').removeClass('modal-open');
                    angular.element('body').css("padding-right", "0px");
                    localStorage.removeItem("showLoginDialog");

                    scope.checkBasicMandatoryUserInfo();
                }
                scope.showLoginLoader = false;
            }
        });
    };

    //calculate age 
    scope.calculateAge = function(dob) {

        var mm = moment(dob, 'DD/MM/YYYY').format('M');
        var dd = moment(dob, 'DD/MM/YYYY').format('D');
        var yy = moment(dob, 'DD/MM/YYYY').format('Y');
        var currentmonth = moment().month() + 1;
        var today = new Date();
        var birthDate = new Date(dob);
        var age = today.getFullYear() - yy;
        var m = today.getMonth() - birthDate.getMonth();
        if (age > 0) {
            if (currentmonth >= mm) {
                scope.signupForm.userAge = age;
            } else {
                scope.signupForm.userAge = age - 1;
            }
        }
        angular.element("#userage").val(scope.signupForm.userAge);
    };

    //calculate DOB
    scope.getDOB = function(yrs, name) {
        var today = moment().subtract(yrs, 'years').format('DD/MM/YYYY');
        scope.signupForm.userDOB = today;

        angular.element('#userdob').datepicker({
                endDate: '-182d',
            })
            .datepicker('update', scope.signupForm.userDOB)
            .on('changeDate', function() {
                scope.calculateAge(scope.signupForm.userDOB);
            });

        scope.type = "estimated";
        if (scope.loggedin === true) {
            var local = JSON.parse(localStorage.getItem("user"));
            local.relatives.forEach(function(ele, index) {
                if (ele.name === name) {
                    ele.age = yrs;
                    ele.dob = scope.signupForm.userDOB;
                }
            });
            localStorage.setItem("user", JSON.stringify(local));
        }
    };

    scope.closeLoginModal = function() {
        scope.showLoginLoader = false;
        scope.loginfail = false;
        scope.signupError = false;
        scope.hideOTP();
        angular.element('#login_signup_modal').modal('hide');
        angular.element('#userdob').val('').datepicker('update');
        scope.loginForm.userEmail = '';
        scope.loginForm.userPwd = '';
        scope.loginForm.useremail.$dirty = false;
        scope.loginForm.userpwd.$dirty = false;

        scope.selected_countryCode = {
            "countries_name": "India",
            "countries_isd_code": "91",
            "image_path": "https://helma.healthians.com/stationery/flags/in.png"
        };

        // scope.signupForm.userName = '';
        // scope.signupForm.userEmail = '';
        // scope.signupForm.userPhone = '';
        // //scope.signupForm.userPwd = '';
        // scope.signupForm.userAge = '';
        // scope.signupForm.userDOB = '';
        // scope.signupForm.userGender = '';
        // scope.signupForm.userphone.$dirty = false;
        // scope.signupForm.username.$dirty = false;
        // scope.signupForm.useremail.$dirty = false;
        // //scope.signupForm.userpwd.$dirty = false;
        // scope.signupForm.userage.$dirty = false;
        // scope.signupForm.userdob.$dirty = false;
        // scope.signupForm.usergender.$dirty = false;
    }

    // login callback
    scope.showOTP = false;
    scope.loginFormSubmitted = false;

    scope.hideOTP = function() {
        scope.showOTP = false;
        scope.loginOTPButton = false;
        scope.loginMobileForm.userOTP = '';
        scope.loginMobileForm.userotp.$dirty = false;
    }


    scope.resend_callback_opt = function() {

        scope.callbackopt_error = false;
        scope.callbackopt_message = '';
        scope.callbackopt_success = false;
        scope.callbackopt_success_message = '';

        if (scope.loginMobileForm.customerNo === undefined || scope.loginMobileForm.customerNo === '') {
            scope.loginMobileForm.customerno.$dirty = true;
            scope.loginMobileForm.customerno.$invalid = true;
            scope.showOTP = false;
            return false;
        }

        if (scope.loginMobileForm.customerNo && scope.showOTP) {
            var opts = {
                mobile_number: scope.loginMobileForm.customerNo,
                template: 'login',
                countryCode: scope.selected_countryCode.countries_isd_code
            };

            /* For Analytics - Upload Prescription */
            $analytics.eventTrack('Resend OTP', {
                category: 'Login',
                label: scope.loginMobileForm.customerNo
            });

            var resendOTPURL = ConstConfig.serverUrl + "commonservice/resend_otp_for_callback";
            doPostWithOutToken($http, resendOTPURL, opts, "", function(data) {
                if (data.status == true) {
                    scope.callbackopt_success = true;
                    scope.callbackopt_success_message = data.message;

                    scope.loginMobileForm.userOTP = '';
                    scope.loginMobileForm.userotp.$dirty = false;
                    
                    focus('userotp');

                    $timeout(function() {
                        scope.callbackopt_error = false;
                        scope.callbackopt_message = '';
                        scope.callbackopt_success = false;
                        scope.callbackopt_success_message = '';
                    }, 3000);
                } else {
                    scope.callbackopt_error = true;
                    scope.callbackopt_message = data.message;

                    $timeout(function() {
                        scope.callbackopt_error = false;
                        scope.callbackopt_message = '';
                    }, 3000);
                }
            });
        }
    }

    scope.loginWithMobile = function() {

        if (scope.loginMobileForm.customerNo === undefined || scope.loginMobileForm.customerNo === '') {
            scope.loginFormSubmitted = true;
            scope.loginMobileForm.customerno.$dirty = true;
            scope.loginMobileForm.customerno.$invalid = true;
            scope.showOTP = false;
            return false;
        }

        if(scope.selected_countryCode.countries_isd_code == '91') {
            if(scope.loginMobileForm.customerNo.length != 10) {
                scope.showOTP = false;
                $window.alert("Please enter valid mobile number");
                return false;
            }
            else {
                scope.loginOTPButton = false;
                scope.showOTP = true;
            } 
        }
        else {
            scope.loginOTPButton = false;
            scope.showOTP = true;
        }

            /* OTP Generation */
            var opts = {
                mobile_number: scope.loginMobileForm.customerNo,
                template: 'login',
                countryCode: scope.selected_countryCode.countries_isd_code
            };

            /* For Analytics - Upload Prescription */
            $analytics.eventTrack('Request OTP', {
                category: 'Login',
                label: scope.loginMobileForm.customerNo
            });

            var generateOTPURL = ConstConfig.serverUrl + "commonservice/generate_otp_for_callback";
            doPostWithOutToken($http, generateOTPURL, opts, "", function(data) {
                if (data.status == true) {
                    scope.callbackopt_success = true;
                    scope.callbackopt_error = false;
                    scope.callbackopt_success_message = "OTP has been sent to your above mobile number.";
                } else {
                    scope.callbackopt_error = true;
                    scope.callbackopt_success = false;
                    scope.callbackopt_message = data.message;
                }
                
                focus('userotp');

                $timeout(function() {
                    scope.callbackopt_error = false;
                    scope.callbackopt_success = false;
                    scope.callbackopt_message = '';
                    scope.callbackopt_success_message = '';
                }, 4000);
            });

        //scope.showLoginLoader = true; 
    }


    scope.loginWithOTPMobile = function() {
        if (scope.loginMobileForm.userOTP === undefined || scope.loginMobileForm.userOTP === '') {
            scope.loginMobileForm.userotp.$dirty = true;
            scope.loginMobileForm.userotp.$invalid = true;
            return false;
        }
        scope.loginOTPButton = true;

        var request_data = {
            "data": {
                "mobileNumber": scope.loginMobileForm.customerNo,
                "source": "web",
                "device_source": '',
                "countryCode": scope.selected_countryCode.countries_isd_code,
                "otp": scope.loginMobileForm.userOTP
            }
        }

        if (isMobile.any()) {
            request_data['data']['device_source'] = 'mobile';
        } else {
            request_data['data']['device_source'] = 'web';
        }


        $http({
            method: "POST",
            url: ConstConfig.couponUrl + "customer/account/checkLogin",
            data: request_data,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded; charset=utf-8"
            }
        }).success(function(data) {
            if (data.status) {
                scope.$emit('userLoggedInSuccess');
                scope.loginMobileForm.customerNo = '';
                scope.loginMobileForm.customerno.$dirty = false;
                scope.loginMobileForm.userOTP = '';
                scope.loginMobileForm.userotp.$dirty = false;
                scope.showOTP = false;

                if (data.signUp === false) {
                    localStorage.setItem("signUpCase", "false");
                    //Set user_id in GA for logged in sessions
                    $analytics.setUserProperties({ 'userId': data.data.user_id });

                    /* Push people info to Webengage */
                    // if(typeof($window.webengage) !== 'undefined') {
                    //     $window.webengage.user.login(data.data.email);
                    //     $window.webengage.user.setAttribute({
                    //         "we_first_name": data.data.name,
                    //         "we_email": data.data.email,
                    //         "we_phone": "+91" + data.data.mobile
                    //     });
                    // }

                    if(typeof($window.clevertap) !== 'undefined') {
                        $window.clevertap.profile.push({
                            "Site": {
                                 "Name": data.data.name,
                                 "Identity": data.data.user_id,
                                 "Email": data.data.email,
                                 "Phone": "+91"+data.data.mobile,
                                 "MSG-email": true,
                                 "MSG-push": true
                            }
                        });
                    }


                    localStorage.setItem("user", JSON.stringify(data.data));
                    localStorage.setItem("isLogin", "true");
                    $rootScope.loggedin = true;
                    localStorage.setItem("token", data.data.token);
                    var name = JSON.parse(localStorage.getItem("user")).name;
                    var firstName = name.split(" ");
                    $rootScope.user = firstName[0];
                    $rootScope.user_id = JSON.parse(localStorage.getItem("user")).user_id;
                    angular.element('#login_signup_modal').modal('hide');
                    angular.element('body').removeClass('modal-open');
                    angular.element('body').css("padding-right", "0px");
                    localStorage.removeItem("showLoginDialog");
                    scope.loginOTPButton = false;
                    if($rootScope.totalCartTest <= 0) {
                        HomeService.cartCount();
                    }
                    scope.checkBasicMandatoryUserInfo();
                } else {
                    /* Sign Up Case - New Case */
                    //Set user_id in GA for logged in sessions
                    $analytics.setUserProperties({ 'userId': data.data.user_id });

                    /* Push people info to Webengage */
                    // if(typeof($window.webengage) !== 'undefined') {
                    //     $window.webengage.user.login(data.data.email);
                    //     $window.webengage.user.setAttribute({
                    //         "we_first_name": data.data.name,
                    //         "we_email": data.data.email,
                    //         "we_phone": data.countryCode + data.data.mobile
                    //     });
                    // }

                    localStorage.setItem("user", JSON.stringify(data.data));
                    localStorage.setItem("isLogin", "true");
                    localStorage.setItem("signUpCase", "true");

                    $rootScope.loggedin = true;
                    localStorage.setItem("token", data.data.token);
                    var name = JSON.parse(localStorage.getItem("user")).name;
                    var firstName = name.split(" ");
                    $rootScope.user = firstName[0];
                    $rootScope.user_id = JSON.parse(localStorage.getItem("user")).user_id;
                    angular.element('#login_signup_modal').modal('hide');
                    angular.element('body').removeClass('modal-open');
                    angular.element('body').css("padding-right", "0px");
                    localStorage.removeItem("showLoginDialog");
                    scope.loginOTPButton = false;
                    scope.checkBasicMandatoryUserInfo();
                }
            } else {
                scope.loginMobileForm.userOTP = '';
                scope.callbackopt_error = true;
                scope.callbackopt_success = false;
                scope.callbackopt_message = data.message;
                scope.loginOTPButton = false;

                focus('userotp');

                $timeout(function() {
                    scope.callbackopt_error = false;
                    scope.callbackopt_success = false;
                    scope.callbackopt_message = '';
                    scope.callbackopt_success_message = '';
                }, 5000);
            }
            scope.showLoginLoader = false;
            scope.loginOTPButton = false;
        }).error(function(data) {
            scope.loginMobileForm.userOTP = '';
            scope.callbackopt_error = true;
            scope.callbackopt_success = false;
            scope.callbackopt_message = data.message;
            scope.loginOTPButton = false;

            focus('userotp');

            $timeout(function() {
                scope.callbackopt_error = false;
                scope.callbackopt_success = false;
                scope.callbackopt_message = '';
                scope.callbackopt_success_message = '';
            }, 5000);
        });
    }
};

App.controller('homeControllerForgotpwd', homeControllerForgotpwd);
homeControllerForgotpwd.$inject = ['$scope', '$rootScope', '$window', 'ConstConfig', 'focus', 'HomeService', '$http', '$location', 'searchDetail', '$timeout', 'dataShare', '$localStorage', '$sessionStorage', '$q', '$uibModal'];

function homeControllerForgotpwd(scope, $rootScope, $window, ConstConfig, focus, HomeService, $http, $location, searchDetail, $timeout, dataShare, $localStorage, $sessionStorage, $q, $uibModal) {
    scope.forgotdata = false;
    scope.forgotdataInvalidEmail = false;
    scope.loaderVar = false;
    scope.hideContinue = true;
    $rootScope.mobile;

    // call for forgot password
    scope.forgotPassword = function() {
        scope.forgotpwdFormSubmitted = false;
        scope.forgotdataInvalidEmail = false;

        if (scope.forgotpwdForm.userEmail === undefined || scope.forgotpwdForm.userEmail === '') {
            scope.forgotpwdForm.useremail.$dirty = true;
            scope.forgotpwdForm.useremail.$invalid = true;
            focus('useremail');
            return false;
        }

        var opts = {
            email: scope.forgotpwdForm.userEmail
        };
        scope.hideContinue = false;
        scope.loaderVar = true;

        $rootScope.mobile = scope.forgotpwdForm.userEmail;
        HomeService.userForgotPwd(opts, function(data) {

            if (data.status === true) {
                if (data.message == 'Otp send successfully') {
                    scope.forgotpwdForm.userEmail = "";
                    scope.forgotpwdForm.useremail.$dirty = false;
                    scope.forgotdata = false;
                    scope.forgotdataInvalidEmail = false;
                    //$('.modal.in').find('button.close').click();
                    scope.showForgotPwdForm();
                    scope.showForgotPwdOtpForm();
                } else {
                    scope.forgotdata = true;
                    scope.msg = data.message;
                    scope.forgotdataInvalidEmail = false;
                    scope.close();
                }
            } else {
                scope.forgotdataInvalidEmail = true;
                scope.forgotdata = false;
            }
            scope.loaderVar = false;
            scope.hideContinue = true;
            $timeout(function() {
                scope.forgotdata = false;
                scope.forgotdataInvalidEmail = false;
            }, 3000);
        });
    };

    scope.close = function() {
        $timeout(function() {
            scope.forgotdata = false;
            scope.forgotdataInvalidEmail = false;
            scope.forgotpwdForm.userEmail = "";
            scope.forgotpwdForm.useremail.$dirty = false;
            scope.msg = "";
            $('.modal.in').find('button.close').click();
            angular.element('.modal.in').find('#closemodal').click();
        }, 6000);
    };

    scope.otpVerify = function() {
        scope.otpFormSubmitted = false;

        if (scope.otpForm.userOTP === undefined || scope.otpForm.userOTP === '') {
            scope.otpForm.userotp.$dirty = true;
            scope.otpForm.userotp.$invalid = true;
            scope.otpForm.userotp.$error.required = true;
            focus('userotp');
            return false;
        }

        doPostWithOutToken($http, ConstConfig.serverUrl + "commonservice/otp_validate", { "mobile": $rootScope.mobile, "otp": scope.otpForm.userOTP }, "", function(data) {
            if (data.status == true) {
                var userid = data.data.hash;
                if (userid) {
                    window.location.href = '/reset_password/' + userid;
                }
            } else {
                scope.forgotdataInvalidEmail = true;
                scope.close();
            }
        });
    };

    /* Call Back Code  ---- Starts */
    scope.callbackopt_error = false;
    scope.mobile_read_only = false;
    scope.callbackSuccess = false;
    scope.callbackopt_success = false;
    scope.tempMobileNo = '';

    scope.$on('open_callbackpopup', function(event, args) {
        if(scope.mobileCallbackForm !== undefined) {
            scope.mobileCallbackForm.userPhone = '';
            scope.mobileCallbackForm.userphone.$dirty = false;
        }
    });

    scope.backToMobile = function() {
        scope.mobile_read_only = false;
        scope.callbackopt_error = false;
    }

    scope.submitCallback = function() {
        scope.mobileCallbackFormSubmitted = false;

        if (scope.mobileCallbackForm.userPhone === undefined || scope.mobileCallbackForm.userPhone === '') {
            scope.mobileCallbackForm.userphone.$dirty = true;
            scope.mobileCallbackForm.userphone.$invalid = true;
            scope.mobileCallbackForm.userphone.$error.required = true;
            focus('userphone');
            return false;
        }

        if (scope.mobileCallbackForm.userPhone) {

            var opts = {
                mobile_number: scope.mobileCallbackForm.userPhone,
                template: 'callback'
            };

            var generateOTPURL = ConstConfig.serverUrl + "commonservice/generate_otp_for_callback";
            doPostWithOutToken($http, generateOTPURL, opts, "", function(data) {
                if (data.status == true) {
                    scope.mobile_read_only = true;
                    scope.callbackopt_error = false;

                } else {
                    scope.callbackopt_error = true;
                    scope.callbackopt_message = data.message;

                    $timeout(function() {
                        scope.callbackopt_error = false;
                        scope.callbackopt_message = '';
                    }, 3000);
                }
            });
        }
    }

    scope.verify_callback_otp = function() {
        scope.mobileCallbackFormSubmitted = false;

        if (scope.mobileCallbackForm.userOTP === undefined || scope.mobileCallbackForm.userOTP === '') {
            scope.mobileCallbackForm.userotp.$dirty = true;
            scope.mobileCallbackForm.userotp.$invalid = true;
            scope.mobileCallbackForm.userotp.$error.required = true;
            focus('userotp');
            return false;
        }

        if (scope.mobileCallbackForm.userPhone) {
            var opts = {
                mobile_number: scope.mobileCallbackForm.userPhone,
                otp: scope.mobileCallbackForm.userOTP
            };

            var validateOTPURL = ConstConfig.serverUrl + "commonservice/validate_otp_for_callback";
            doPostWithOutToken($http, validateOTPURL, opts, "", function(data) {
                if (data.status == true) {
                    /* Call Click to Call API */
                    var request_data = {
                        "data": {
                            "customer_mobile": opts.mobile_number,
                            "app_version": "46",
                            "source": "web"
                        }
                    }

                    $http({
                        method: "POST",
                        url: ConstConfig.couponUrl + "customer/account/clickToCallUrl",
                        data: request_data,
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded; charset=utf-8"
                        }
                    }).success(function(data) {
                        if (data.status) {
                            scope.tempMobileNo = opts.mobile_number;
                            scope.callbackSuccess = true;

                            scope.callbackMobileModal = false;
                            scope.mobile_read_only = false;
                            scope.callbackopt_error = false;
                            scope.mobileCallbackFormSubmitted = false;

                            scope.mobileCallbackForm.userPhone = "";
                            scope.mobileCallbackForm.userotp.$dirty = false;
                            scope.mobileCallbackForm.userOTP = "";
                            scope.mobileCallbackForm.userotp.$dirty = false;
                            $timeout(function() {
                                scope.callbackSuccess = false;
                                $('.modal.in').find('button.close').click();
                            }, 9000);

                        } else {
                            scope.callbackopt_error = true;
                            scope.callbackopt_message = data.message;

                            $timeout(function() {
                                scope.callbackopt_error = false;
                                scope.callbackopt_message = '';
                            }, 3000);
                        }
                    });

                } else {
                    scope.callbackopt_error = true;
                    scope.callbackopt_message = data.message;

                    $timeout(function() {
                        scope.callbackopt_error = false;
                        scope.callbackopt_message = '';
                    }, 3000);
                }
            });
        }
    }

    scope.resend_callback_opt = function() {
        if (scope.mobileCallbackForm.userPhone) {
            var opts = {
                mobile_number: scope.mobileCallbackForm.userPhone,
                template: 'callback'
            };

            var resendOTPURL = ConstConfig.serverUrl + "commonservice/resend_otp_for_callback";
            doPostWithOutToken($http, resendOTPURL, opts, "", function(data) {
                if (data.status == true) {
                    scope.callbackopt_success = true;
                    scope.callbackopt_success_message = data.message;

                    $timeout(function() {
                        scope.callbackopt_error = false;
                        scope.callbackopt_message = '';
                        scope.callbackopt_success = false;
                        scope.callbackopt_success_message = '';
                    }, 3000);
                } else {
                    scope.callbackopt_error = true;
                    scope.callbackopt_message = data.message;

                    $timeout(function() {
                        scope.callbackopt_error = false;
                        scope.callbackopt_message = '';
                    }, 3000);
                }
            });
        }
    }

    // scope.openSignUp = function(){
    //     scope.callbackSuccess = false;
    //     angular.element('.modal.in').find('button.close').click();
    //     $timeout(function() {
    //        scope.$emit('openSignupModalCallback', { message: scope.tempMobileNo });
    //     }, 3000);        
    // }
    /* Call Back Code  ---- Ends */

};

App.controller('homeControllerChangepwd', homeControllerChangepwd);
homeControllerChangepwd.$inject = ['$scope', '$rootScope', 'focus', 'HomeService', '$http', '$location', 'searchDetail', '$timeout', 'dataShare', '$localStorage', '$sessionStorage', '$q', '$uibModal', 'DashboardService', '$analytics', 'ConstConfig', '$state'];

function homeControllerChangepwd(scope, $rootScope, focus, HomeService, $http, $location, searchDetail, $timeout, dataShare, $localStorage, $sessionStorage, $q, $uibModal, DashboardService, $analytics, ConstConfig, $state) {
    scope.confirmpwdmsg = false;
    scope.invalidmsg = false;
    scope.setpwdmsg = false;
    scope.setpwdmsgerror = false;

    // call for forgot password
    scope.setPassword = function() {
        scope.changepwdFormSubmitted = false;
        if (scope.changepwdForm.userOldPwd === undefined || scope.changepwdForm.userOldPwd === '') {
            scope.changepwdForm.useroldpwd.$dirty = true;
            scope.changepwdForm.useroldpwd.$invalid = true;
            scope.changepwdForm.useroldpwd.$error.required = true;
            focus('useroldpwd');
            return false;
        } else if (scope.changepwdForm.userEmail === undefined || scope.changepwdForm.userEmail === '') {
            scope.changepwdForm.useremail.$dirty = true;
            scope.changepwdForm.useremail.$invalid = true;
            scope.changepwdForm.useremail.$error.required = true;
            focus('useremail');
            return false;
        } else if (scope.changepwdForm.userConfmEmail === undefined || scope.changepwdForm.userConfmEmail === '') {
            scope.changepwdForm.usereconfrmmail.$dirty = true;
            scope.changepwdForm.usereconfrmmail.$invalid = true;
            scope.changepwdForm.usereconfrmmail.$error.required = true;
            focus('usereconfrmmail');
            return false;
        }


        if (scope.changepwdForm.userEmail !== scope.changepwdForm.userConfmEmail) {
            scope.confirmpwdmsg = true;
        } else {
            scope.setnewPassword();
        }
        $timeout(function() {
            scope.confirmpwdmsg = false;
        }, 5000);
    };

    scope.setnewPassword = function() {
        var opts = {
            email: JSON.parse(localStorage.getItem("user")).email,
            old_password: scope.changepwdForm.userOldPwd,
            password: scope.changepwdForm.userEmail,
            user_id: JSON.parse(localStorage.getItem("user")).user_id
        };

        HomeService.userSetNewPwd(opts, function(data) {
            if (data.status === "success") {
                if (data.data.status === false) {
                    scope.invalidmsg = true;
                }
                if (data.data.status === true) {
                    scope.setpwdmsg = true;
                }

            } else {
                scope.setpwdmsgerror = true;
            }
            $timeout(function() {
                scope.setpwdmsg = false;
                scope.setpwdmsgerror = false;
                scope.invalidmsg = false;
                scope.changepwdFormSubmitted = false;
                scope.changepwdForm.userOldPwd = "";
                scope.changepwdForm.useroldpwd.$dirty = false;
                scope.changepwdForm.userEmail = "";
                scope.changepwdForm.useremail.$dirty = false;
                scope.changepwdForm.userConfmEmail = "";
                scope.changepwdForm.usereconfrmmail.$dirty = false;
                $('.modal.in').find('button.close').click();
            }, 4000);
        });
    };


};


App.controller('homeControllerUpdateUserDetails', homeControllerUpdateUserDetails);
homeControllerUpdateUserDetails.$inject = ['$scope', '$rootScope', 'focus', 'HomeService', '$http', '$location', 'searchDetail', '$timeout', 'dataShare', '$localStorage', '$sessionStorage', '$q', '$uibModal', 'DashboardService', '$analytics', 'ConstConfig', '$state', 'fbService', '$window', 'Facebook'];

function homeControllerUpdateUserDetails(scope, $rootScope, focus, HomeService, $http, $location, searchDetail, $timeout, dataShare, $localStorage, $sessionStorage, $q, $uibModal, DashboardService, $analytics, ConstConfig, $state, fbService, $window, Facebook) {
    scope.showLoginLoader = false;

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

    scope.getCountryList = function() {
        if(typeof scope.country_list === 'undefined') {
            $http({
                method: "GET",
                url: ConstConfig.couponUrl + "webv1/web_api/getCountryCode",
            }).success(function(data) {
                if (data.status) {
                    scope.country_list = data.data;
                }
            });
        }
    }
 
    

    scope.setCountryCode = function(isdcode, image_path) {
        scope.selected_countryCode = {
            "countries_name": "India",
            "countries_isd_code": isdcode,
            "image_path": image_path
        };

        scope.showUpdateOTP = false;
    }

    scope.updateMobile = function() {
        if (scope.mobileForm.userPhone === undefined || scope.mobileForm.userPhone === '') {
            scope.mobileForm.userphone.$dirty = true;
            scope.mobileForm.userphone.$invalid = true;
            scope.mobileForm.userphone.$error.required = true;
            focus('userphone');
            return false;
        } else {
            scope.userLoginDetails = JSON.parse(localStorage.getItem("user"));

            var opts = {
                "userId": scope.userLoginDetails.user_id,
                "email": scope.userLoginDetails.email,
                "mobile": scope.mobileForm.userPhone,
                "log_user_id": scope.userLoginDetails.user_id
            };

            DashboardService.updateProfile(opts, function(data) {
                if (data.status === true) {
                    scope.userLoginDetails.mobile = scope.mobileForm.userPhone;
                    scope.userLoginDetails.relatives[0].contact_number = scope.mobileForm.userPhone;
                    localStorage.setItem("user", JSON.stringify(scope.userLoginDetails));
                    scope.mobileModal = false;
                    $rootScope.$broadcast("update_mobile");
                    $('.modal.in').find('button.close').click();
                }
            });
        }
    };

    scope.showReferCode = false;

    scope.checkPreviousDetails = function() {
        if (localStorage.getItem("isLogin") == 'true' && scope.$parent.partialSignUpModal) {
            var name = JSON.parse(localStorage.getItem("user")).name;
            var email = JSON.parse(localStorage.getItem("user")).email;
            var age = JSON.parse(localStorage.getItem("user")).age;
            var gender = JSON.parse(localStorage.getItem("user")).gender;
            var mobile = JSON.parse(localStorage.getItem("user")).mobile;
            scope.checkPreviousDetailsFlag = true;

            if (name !== '') {
                scope.puserName = name;
            }

            if (email !== null) {
                if (email !== '') {
                    scope.puseremail = email;
                    scope.showEmail = false;
                } else {
                    scope.puseremail = '';
                    scope.showEmail = true;
                }
            } else {
                scope.puseremail = '';
                scope.showEmail = true;
            }

            if (localStorage.getItem("signUpCase") == 'true') {
                scope.showReferCode = true;
            } else {
                scope.showReferCode = false;
            }

            if (age !== '') {
                scope.puserAge = age;
            }

            if (gender != '') {
                scope.puserGender = gender;
            }

            if (mobile !== null) {
                if (mobile !== '') {
                    scope.puserPhone = mobile;
                    scope.showPhone = false;
                    var countryCode = JSON.parse(localStorage.getItem("user")).countryCode;
                    
                    var searchCountry = _.where(scope.country_list, {
                        countries_isd_code: countryCode
                    });
                    if(searchCountry.length > 0){
                        scope.selected_countryCode = searchCountry[0];
                    }
                    else {
                        scope.selected_countryCode = {
                            "countries_name": "India",
                            "countries_isd_code": "91",
                            "image_path": "https://helma.healthians.com/stationery/flags/in.png"
                        };
                    }

                } else {
                    scope.showPhone = true;
                    scope.puserPhone = '';

                    scope.selected_countryCode = {
                        "countries_name": "India",
                        "countries_isd_code": "91",
                        "image_path": "https://helma.healthians.com/stationery/flags/in.png"
                    };

                }
            } else {
                scope.showPhone = true;
                scope.puserPhone = '';

                scope.selected_countryCode = {
                    "countries_name": "India",
                    "countries_isd_code": "91",
                    "image_path": "https://helma.healthians.com/stationery/flags/in.png"
                };

            }
        }
    }

    if (localStorage.getItem("isLogin") == 'true' && scope.$parent.partialSignUpModal) {
        scope.getCountryList();
        scope.checkPreviousDetails();
    }

    scope.$on('showPreviousUserDetailsCheck', function(event, data) {
        scope.getCountryList();
        scope.checkPreviousDetails();
    });


    scope.updateUserDetailsError = false;
    scope.showUpdateOTP = false;

    scope.hideOTP = function() {
        scope.showUpdateOTP = false;
        scope.loginOTPButton = false;
    }

    scope.resend_callback_opt = function() {

        if (scope.showPhone) {
            if (scope.puserPhone === undefined || scope.puserPhone === '') {
                scope.partialSignupForm.puserphone.$dirty = true;
                scope.partialSignupForm.puserphone.$invalid = true;
                scope.partialSignupForm.puserphone.$error.required = true;
                scope.showUpdateOTP = false;
                focus('puseremail');
                return false;
            }

            if (scope.puserPhone && scope.showUpdateOTP) {
                var opts = {
                    mobile_number: scope.puserPhone,
                    template: 'login',
                    countryCode: scope.selected_countryCode.countries_isd_code
                };

                /* For Analytics - Upload Prescription */
                $analytics.eventTrack('Resend OTP', {
                    category: 'Login',
                    label: scope.puserPhone
                });

                var resendOTPURL = ConstConfig.serverUrl + "commonservice/resend_otp_for_callback";
                doPostWithOutToken($http, resendOTPURL, opts, "", function(data) {
                    if (data.status == true) {
                        scope.callbackopt_success = true;
                        scope.callbackopt_success_message = data.message;

                        $timeout(function() {
                            scope.callbackopt_error = false;
                            scope.callbackopt_message = '';
                            scope.callbackopt_success = false;
                            scope.callbackopt_success_message = '';
                        }, 3000);
                    } else {
                        scope.callbackopt_error = true;
                        scope.callbackopt_message = data.message;

                        $timeout(function() {
                            scope.callbackopt_error = false;
                            scope.callbackopt_message = '';
                        }, 3000);
                    }
                });
            }
        }
    }

    scope.submitPartialUpdate = function() {
        scope.signupError = false;
        scope.signupFormSubmitted = true;
        if (scope.puserName === undefined || scope.puserName === '') {
            scope.partialSignupForm.puserName.$dirty = true;
            scope.partialSignupForm.puserName.$invalid = true;
            scope.partialSignupForm.puserName.$error.required = true;
            $analytics.eventTrack('Showed Error for Validation Failure', { category: 'Update User Popup', label: 'Name' });
            focus('puserName');
            return false;
        }

        if (scope.showEmail) {
            if (scope.puseremail === undefined || scope.puseremail === '') {
                scope.partialSignupForm.puseremail.$dirty = true;
                scope.partialSignupForm.puseremail.$invalid = true;
                scope.partialSignupForm.puseremail.$error.required = true;
                $analytics.eventTrack('Showed Error for Validation Failure', { category: 'Update User Popup', label: 'Email' });
                focus('puseremail');
                return false;
            }
        }

        if (scope.showPhone) {
            if (scope.puserPhone === undefined || scope.puserPhone === '') {
                scope.partialSignupForm.puserphone.$dirty = true;
                scope.partialSignupForm.puserphone.$invalid = true;
                scope.partialSignupForm.puserphone.$error.required = true;
                $analytics.eventTrack('Showed Error for Validation Failure', { category: 'Update User Popup', label: 'Phone' });
                focus('puseremail');
                return false;
            }
        }

        if (scope.puserGender === undefined || scope.puserGender === '' || scope.puserGender === null) {
            scope.partialSignupForm.pusergender.$dirty = true;
            scope.partialSignupForm.pusergender.$invalid = true;
            scope.partialSignupForm.pusergender.$error.required = true;
            $analytics.eventTrack('Showed Error for Validation Failure', { category: 'Update User Popup', label: 'Gender' });
            focus('pusergender');
            return false;
        } else if (scope.puserAge === undefined || scope.puserAge === '') {
            scope.partialSignupForm.puserage.$dirty = true;
            scope.partialSignupForm.puserage.$invalid = true;
            scope.partialSignupForm.puserage.$error.required = true;
            $analytics.eventTrack('Showed Error for Validation Failure', { category: 'Update User Popup', label: 'Age' });
            focus('puserage');
            return false;
        }

        if (parseInt(scope.puserAge) < 5 || parseInt(scope.puserAge) > 120 || parseInt(scope.puserAge) <= 0) {
            focus('puserage');
            scope.partialSignupForm.puserage.$dirty = true;
            scope.partialSignupForm.puserage.$invalid = true;
            scope.partialSignupForm.puserage.$error.pattern = true;
            scope.loaderVar = false;
            $analytics.eventTrack('Validation Faliure on Add Patient detail pop-up', { category: 'Update User Popup', label: 'Age' });

            return false;
        }

        scope.userLoginDetails = JSON.parse(localStorage.getItem("user"));

        var opts = {
            name: scope.puserName,
            email: scope.puseremail,
            age: scope.puserAge,
            gender: scope.puserGender,
            mobileNumber: scope.puserPhone,
            userId: scope.userLoginDetails.user_id,
            countryCode: scope.selected_countryCode.countries_isd_code,
            source: 'web',
        };

        if (isMobile.any()) {
            opts['device_source'] = 'mobile';
        } else {
            opts['device_source'] = 'web';
        }

        if (scope.showEmail || scope.showReferCode) {
            if (scope.referCode) {
                opts['referCode'] = scope.referCode;
            } else {
                if (localStorage.getItem("signUpCase") == 'true') {
                    opts['referCode'] = '';
                }
            }
        }

        scope.request_data = {
            "data": opts
        }

        if (scope.showPhone) {


            if ((typeof scope.puserOTP === 'undefined' || scope.puserOTP === '') && !scope.showUpdateOTP) {
                scope.showUpdateOTP = true;
                /* OTP Generation */
                var opts = {
                    mobile_number: scope.puserPhone,
                    template: 'login',
                    countryCode: scope.selected_countryCode.countries_isd_code
                };

                /* For Analytics - Upload Prescription */
                $analytics.eventTrack('Request OTP', {
                    category: 'Login',
                    label: scope.puserPhone
                });

                var generateOTPURL = ConstConfig.serverUrl + "commonservice/generate_otp_for_callback";
                doPostWithOutToken($http, generateOTPURL, opts, "", function(data) {
                    if (data.status == true) {
                        scope.callbackopt_success = true;
                        scope.callbackopt_error = false;
                        scope.callbackopt_success_message = "OTP has been sent to your above mobile number.";
                    } else {
                        scope.callbackopt_error = true;
                        scope.callbackopt_success = false;
                        scope.callbackopt_message = data.message;
                        scope.showUpdateOTP = false;
                        scope.puserPhone = '';
                        scope.partialSignupForm.puserphone.$dirty = false;
                    }

                    $timeout(function() {
                        scope.callbackopt_error = false;
                        scope.callbackopt_success = false;
                        scope.callbackopt_message = '';
                        scope.callbackopt_success_message = '';
                    }, 6000);
                });
            } else {

                if (scope.puserOTP === undefined || scope.puserOTP === '') {
                    scope.partialSignupForm.puserotp.$dirty = true;
                    scope.partialSignupForm.puserotp.$invalid = true;
                    focus('puserotp');
                    return false;
                }

                var opts = {
                    mobile_number: scope.puserPhone,
                    otp: scope.puserOTP,
                    countryCode: scope.selected_countryCode.countries_isd_code
                };

                var validateOTPURL = ConstConfig.serverUrl + "commonservice/validate_otp_for_callback";
                doPostWithOutToken($http, validateOTPURL, opts, "", function(data) {
                    if (data.status == true) {
                        scope.puserOTP = '';
                        scope.partialSignupForm.puserotp.$dirty = false;
                        scope.showUpdateOTP = false;

                        scope.updateInfo(scope.request_data);
                    } else {
                        scope.puserOTP = '';
                        scope.partialSignupForm.puserotp.$dirty = false;
                        //scope.showUpdateOTP = false;

                        scope.callbackopt_error = true;
                        scope.callbackopt_success = false;
                        scope.callbackopt_message = data.message;

                        $timeout(function() {
                            scope.callbackopt_error = false;
                            scope.callbackopt_success = false;
                            scope.callbackopt_message = '';
                            scope.callbackopt_success_message = '';
                        }, 8000);
                    }
                });
            }
        } else {
            scope.showLoginLoader = true;
            scope.updateInfo(scope.request_data);
        }
    }


    scope.updateInfo = function(request_data) {
        var token = localStorage.getItem("token");

        $http({
            method: "POST",
            url: ConstConfig.couponUrl + "customer/account/updateLoginInfo",
            data: request_data,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded; charset=utf-8",
                "X-API-TOKEN" : token
            }
        }).success(function(data) {
            if (data.status) {
                scope.userLoginDetails['email'] = data.data.email;
                scope.userLoginDetails['name'] = data.data.name;
                scope.userLoginDetails['age'] = data.data.age;
                scope.userLoginDetails['gender'] = data.data.gender;
                scope.userLoginDetails['dob'] = data.data.dob;
                scope.userLoginDetails['mobile'] = data.data.mobile;
                scope.userLoginDetails['relatives'] = data.data.relatives;
                scope.userLoginDetails['countryCode'] = request_data["data"]["countryCode"];

                var firstName = scope.puserName.split(" ");
                $rootScope.user = firstName[0];
                localStorage.setItem("user", JSON.stringify(scope.userLoginDetails));
                localStorage.setItem("signUpCase", "false");
                scope.showReferCode = false;

                scope.$parent.hidePartialSignupForm();

                scope.puserName = "";
                scope.partialSignupForm.puserName.$dirty = false;
                scope.puseremail = "";
                scope.partialSignupForm.puseremail.$dirty = false;
                scope.puserAge = "";
                scope.partialSignupForm.puserage.$dirty = false;
                scope.puserGender = "";
                scope.partialSignupForm.pusergender.$dirty = false;
                scope.referCode = "";
                scope.partialSignupForm.referCode.$dirty = false;

                if ($state.current.name === 'orderbook' || $state.current.name === 'package' || $state.current.name === 'parameter' || $state.current.name === 'profile') {
                    scope.$emit('showPatientDialog');
                } else if ($state.current.name === 'feedback') {
                    scope.$emit('showUserInfoFeedback');
                } else if ($state.current.name === 'reset_password') {
                    $location.path('/');
                }

            } else {
                scope.updateUserDetailsError = true;
                scope.updateUserDetailsErrorMessage = data.message;
                $timeout(function() {
                    scope.updateUserDetailsError = false;
                    scope.updateUserDetailsErrorMessage = '';
                }, 8000);
            }
            scope.showLoginLoader = false;
        });
    }

    scope.backToLogin = function() {
        HomeService.logout({}, function(data) {
            if (data.status) {
                scope.loginOTPButton = false;
                scope.$parent.backToLoginPartialSignupForm();
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
                localStorage.removeItem("signUpCase");
                $location.path('/');
                $rootScope.loggedin = false;
                $rootScope.user = '';

                Facebook.getLoginStatus(function(response) {
                    if (response.status == 'connected') {
                        Facebook.logout(function(response) {});
                    }
                });
            }
        });
    }
}
