App.controller('habitRiskDetailsController', habitRiskDetailsController);
habitRiskDetailsController.$inject = ['$scope', '$timeout', '$rootScope', '$location', '$http', '$stateParams', 'ConstConfig', 'HomeService', '$window', '$analytics', '$interval', '$state', 'cartService', 'BookOrderService'];

function habitRiskDetailsController(scope, $timeout, $rootScope, $location, $http, $stateParams, ConstConfig, HomeService, $window, $analytics, $interval, $state, cartService, BookOrderService) {
    scope.stateParms = $stateParams;
    scope.loaderVar = true;

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

    var widgetIdCTBHabitWEB;
    var widgetIdCTBHabitMOB;

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

    scope.habitRiskDetails = function(habitRiskDetails) {
        var requestData = {
            "data":  {
                "id": habitRiskDetails,
                "city":JSON.parse(localStorage.getItem("cityID"))[0].city_id,
                "source": "web"
            }
        };

        var url = ConstConfig.couponUrl + "customer/RiskHabitManagement/getRiskHabitSearch";

        doPostWithOutToken($http, url, requestData, "", function(data) {
            if(data.status) {
                scope.riskHabitDetailsList = data.data;
                scope.loaderVar = false;
            }
        });
    }

    if (scope.stateParms) {
        if(scope.stateParms.search_name) {
            var search_name = scope.stateParms.search_name;
            scope.title_name = scope.stateParms.search_name + ' Tests';

            /* If customer land directly on this page then */
            if($state.current.name === 'risk') {
                BookOrderService.getAllRiskDetails(function(data) {
                    if (data.status === true) {
                        var riskgroups = data.data;

                        scope.riskIndividualDetail = {};
                        scope.riskTests = [];
                        riskgroups.forEach(function(ele, index) {
                            if(ele.alias.toLowerCase() === search_name) {
                                scope.title_name = ele.Name + ' Tests';
                                scope.riskIndividualDetail = ele;
                                ele.tests.forEach(function(ele1, index1) {
                                    scope.riskTests.push(ele1.test_id);
                                });
                            }                                
                        });

                        if(scope.riskTests.length > 0) {                                
                            scope.riskIndividualDetail.tests = scope.riskTests.join(',');

                            scope.habitRiskDetails(scope.riskIndividualDetail.tests);
                            scope.setMetaTags(scope.riskIndividualDetail);
                        }
                        else {
                            $location.path('/'); 
                        }
                    }
                });
            }
            if($state.current.name === 'habit') {
                BookOrderService.getAllHabitsDetails(function(data) {
                    if (data.status === true) {
                        var habitList = data.data;
                        scope.habitTests = [];
                        scope.habitIndividualDetail = {};

                        habitList.forEach(function(ele, index) {
                            if(ele.alias.toLowerCase() === search_name) {
                                scope.title_name = ele.Name + ' Tests';
                                scope.habitIndividualDetail = ele;
                                ele.tests.forEach(function(ele1, index1) {
                                    scope.habitTests.push(ele1.test_id);
                                });
                            }
                        });
                        if(scope.habitTests.length > 0) {
                            var habitTestsIDs = scope.habitTests.join(',');
                            scope.habitRiskDetails(habitTestsIDs);
                            scope.setMetaTags(scope.habitIndividualDetail);
                        }
                        else {
                            $location.path('/'); 
                        }
                    }
                });
            }
        }
        
    }

    scope.addToCart =  function(details) {

        scope.pkgDetail = {};
        scope.pkgDetail = angular.copy(details);
        scope.pkgDetail.package_name = scope.pkgDetail.name;
        scope.pkgDetail.package_id = scope.pkgDetail.id;
        scope.pkgDetail.testId = scope.pkgDetail.id;
        scope.pkgDetail.display_name = scope.pkgDetail.name;
        scope.pkgDetail.test_packages = [{
            testId: scope.pkgDetail.id,
            display_name: scope.pkgDetail.name,
            healthians_price: scope.pkgDetail.healthians_price,
            healthian_price: scope.pkgDetail.healthians_price,
            actual_price: scope.pkgDetail.actual_price,
            tcategory_id: scope.pkgDetail.id
        }];
        scope.pkgDetail.test_details = scope.pkgDetail.include_tests;
        scope.pkgDetail.include_tests = [];
        scope.pkgDetail.also_include_tests = [];
        scope.pkgDetail.test_details.forEach(function(ele, index) {
            ele.tcategory_name = ele.test_name;
            ele.ptype = ele.type;
            scope.pkgDetail.include_tests.push(ele);
        });

        scope.cartclicked = true;

        scope.searchedCartPackage = scope.pkgDetail;
        var tempPkg = angular.copy(scope.searchedCartPackage);
        cartService.setTempPackage(tempPkg);

        if (localStorage.getItem("isLogin") == 'true') {

            scope.member = JSON.parse(localStorage.getItem("user")).relatives;
            if (scope.member.length !== 0 && ($rootScope.count === 0 || typeof $rootScope.count === "undefined")) {
                scope.tempUser = scope.member;
                localStorage.setItem("tempUser", JSON.stringify(scope.tempUser));
            } else {
                scope.tempUser = JSON.parse(localStorage.getItem("tempUser"));
            }
            scope.addToCartModal = true;

            $state.go('user_selection_cart');
        } else {
            scope.$$childHead.loginModal = !scope.$$childHead.loginModal;
            scope.$$childHead.signupModal = false;
            scope.$$childHead.loginTab = false;
            scope.$$childHead.signupText = "Continue to Cart";
            scope.$$childHead.showSignupForm();
        }

        scope.temp = scope.searchedCartPackage;

    }

    scope.$on('showPatientDialog', function(event, data) {
        if (scope.cartclicked) {
            scope.addToCartModal = true;
        } else {
            scope.addToCartModal = false;
        }

        if (localStorage.getItem("isLogin") == 'true') {
            $rootScope.loggedin = true;
            var name = JSON.parse(localStorage.getItem("user")).name;
            var firstName = name.split(" ");
            $rootScope.user = firstName[0].charAt(0).toUpperCase().concat(firstName[0].substr(1));

            scope.userLoginDetails = JSON.parse(localStorage.getItem("user"));
            if (localStorage.getItem("isSocialLogin") == 'true') {
                if (scope.userLoginDetails.mobile === "") {
                    scope.mobileModal = true;
                } else {
                    scope.mobileModal = false;
                }
            }

            var tempSelectedPackage = cartService.getTempPackage();
            scope.addToCart(tempSelectedPackage);

            scope.member = JSON.parse(localStorage.getItem("user")).relatives;
        }
    });

    scope.closeMobileCallToBookPopup = function() {
        $analytics.eventTrack('Mobile - Call To Book Pop up - Close', { category: $state.current.name+' - Mobile Call To Book Pop up' });
        scope.mobileCallToBookPopupDiv = false;
    }
    
    angular.element('#mobileCallToBook_bg').click(function(){
        scope.closeMobileCallToBookPopup();
    });

    scope.closeCallToBookPopup = function() {
        angular.element('#callToBook_bg').fadeOut(0);
        angular.element('#callToBookPopup').slideUp(0);

        $analytics.eventTrack('Call To Book Pop up - Close', { category: $state.current.name+' - Call To Book Pop up' });
    }

    angular.element('#callToBook_bg').click(function(){
        scope.closeCallToBookPopup();
    });

    angular.element('#closeCallToBookmodal').click(function(){
        scope.closeCallToBookPopup();
    });

    scope.exitCallToBookError = false;
    scope.mobileCallToBookPopupDiv = false;
    scope.callToBookMobileError = false;
    
    scope.callToBook = function(pkg_name) {
        scope.clickedPackage  = pkg_name;

        if (localStorage.getItem("isLogin") == 'true') {
            var userId = JSON.parse(localStorage.getItem("user")).user_id;

            var requestData = {
                "data":  {
                    "utm_id": $state.current.name+'-web-call-to-book',
                    "user_id" : userId,
                    "originator": "habit_risk",
                    "source": "web"
                }
            };

            requestData['data']['message'] = 'Customer search for : '+ scope.clickedPackage;

            if (isMobile.any()) {
                requestData['data']['utm_id'] = $state.current.name+'-mob-call-to-book';
                requestData['data']['source'] = 'mobile';
                scope.sendDirectDetailsMobile(requestData);
            }
            else {
                scope.sendDirectDetailsDesktop(requestData);
            }
        }
        else {
            if (isMobile.any()) {
                scope.mobileCallToBookPopupDiv = true;

                // if(typeof grecaptcha !== 'undefined') {
                //     if($("#ctb_habit_mob").length ==0) {
                //         $('#habit_ctb_mob').html("");
                //         $('<div/>', {id: 'ctb_habit_mob'}).appendTo('#habit_ctb_mob');

                //         if(widgetIdCTBHabitMOB == 0) {
                //             grecaptcha.reset(widgetIdCTBHabitMOB);
                //             if($('#ctb_habit_mob').length) {
                //                 widgetIdCTBHabitMOB = grecaptcha.render('ctb_habit_mob', {'sitekey' : $rootScope.gCatchaKey});
                //             }
                //         }
                //         else {
                //             if($('#ctb_habit_mob').length) {
                //                 widgetIdCTBHabitMOB = grecaptcha.render('ctb_habit_mob', {'sitekey' : $rootScope.gCatchaKey});
                //             }
                //         }
                //     }                                
                // }

            }
            else {
                angular.element('#callToBookPopup').css('left', ($window.innerWidth/2 - $('#callToBookPopup').width()/2));
                angular.element('#callToBookPopup').css('top', ($window.innerHeight/3 - $('#callToBookPopup').height()/2));

                angular.element('#callToBook_bg').fadeIn(100);
                angular.element('#callToBookPopup').fadeIn(100);
                angular.element("#customerno123").focus();

                // if(typeof grecaptcha !== 'undefined') {
                //     if($("#ctb_habit_web").length ==0) {
                        
                //         $('#habit_ctb_web').html("");
                //         $('<div/>', {id: 'ctb_habit_web'}).appendTo('#habit_ctb_web');

                //         if(widgetIdCTBHabitWEB == 0) {
                //             grecaptcha.reset(widgetIdCTBHabitWEB);
                //             if($('#ctb_habit_web').length) {
                //                 widgetIdCTBHabitWEB = grecaptcha.render('ctb_habit_web', {'sitekey' : $rootScope.gCatchaKey});
                //             }
                //         }
                //         else {
                //             if($('#ctb_habit_web').length) {
                //                 widgetIdCTBHabitWEB = grecaptcha.render('ctb_habit_web', {'sitekey' : $rootScope.gCatchaKey});
                //             }
                //         }
                //     }                                
                // }
            }
        }
        
    }

    scope.changeCallToBookDetailsPopupButtonColor = function() {
        if(scope.customerctbNo) {
            if (scope.customerctbNo.length !== 10 || isNaN(scope.customerctbNo) || scope.customerctbNo === undefined || scope.customerctbNo === '') {
                angular.element("#callToBooksubmitbtn").css('background','#b7b7b7');
                angular.element("#callToBooksubmitbtn").css('border', '1px solid #cecece');
                angular.element("#callToBooksubmitbtn").css('background-image','linear-gradient(to bottom, #b7b7b7 0%, #cecece 100%)');
            }
            else {
                angular.element("#callToBooksubmitbtn").css('background','#e1530d');
                angular.element("#callToBooksubmitbtn").css('border', '1px solid #eaeaea');
                angular.element("#callToBooksubmitbtn").css('background-image','linear-gradient(to bottom, #ff7632 0%, #e1530d 100%)');
            }
        }
    }

    scope.sendCallToBookDetails = function() {
        //var g_recaptcha_response = grecaptcha.getResponse(widgetIdCTBHabitWEB);

        scope.addLeadFormSubmitted = false;

        if (scope.customerctbNo === undefined || scope.customerctbNo === '') {
            scope.addCallToBookLeadForm.customerno123.$dirty = true;
            scope.addCallToBookLeadForm.customerno123.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: $state.current.name +' - Call To Book Pop up', label: 'Validation Fail : Mobile no. not enter' });
            return false;
        }  

        if(isNaN(scope.customerctbNo)) {
            scope.ctb_mobile_valid_error = true;
            scope.ctb_mobile_valid_msg = "Enter valid Mobile number";
            $analytics.eventTrack('Validation Fail', { category: $state.current.name +' - Call To Book Pop up', label: 'Validation Fail : Not a number' });

            $timeout(function() {
                scope.mobile_valid_error = false;
            }, 2000);
            return false;
        }
        if(scope.customerctbNo.length !== 10) {
            scope.ctb_mobile_valid_error = true;
            scope.ctb_mobile_valid_msg = "Mobile number should be of 10 digits";
            $analytics.eventTrack('Validation Fail', { category: $state.current.name +' - Call To Book Pop up', label: 'Validation Fail : Not 10 digits' });

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
                "utm_id": $state.current.name+'-web-call-to-book',
                "name":scope.customerctbName,
                "mobile":scope.customerctbNo,
                "originator": "habit_risk",
                "source": "web"
            }
        };

        requestData['data']['message'] = 'Customer search for : '+ scope.clickedPackage;

        if(localStorage.getItem("guid")) {
            requestData['data']['guid'] = localStorage.getItem("guid");
        }

        var url = ConstConfig.couponUrl + "webv1/web_api/saveEmailCompaignData";
        doPostWithOutToken($http, url, requestData, "", function(data) {
            if (data.status) {
                scope.exitCallToBookError = true;
                if(data.message === 'Lead successfully inserted') {
                    /* For Analytics - Payment Mode */
                    scope.clickedPackage = '';
                    $analytics.eventTrack('Lead Captured', {
                        category: $state.current.name +' - Call To Book Pop up',
                        label: scope.customerctbNo,
                    });

                    if(typeof($window.fbq) !== 'undefined') {
                        $window.fbq('track', 'Lead', requestData);
                    }                    
                }

                scope.customerctbName = '';
                scope.customerctbNo = '';   
                scope.Message = '';
                scope.addCallToBookLeadForm.name123.$dirty = false;
                scope.addCallToBookLeadForm.customerno123.$dirty = false;
                scope.ctb_mob_valid_error = false;

                $timeout(function() {
                    scope.exitCallToBookError = false;
                    scope.closeCallToBookPopup();
                }, 4000);
            } else {
                alert(data.message);
            }
            //grecaptcha.reset(widgetIdCTBHabitWEB);
        });
    }

    scope.sendDirectDetailsDesktop = function(requestData) {
        var url = ConstConfig.couponUrl + "webv1/web_api/sendLoggedInLeadInfo";
        doPostWithOutToken($http, url, requestData, "", function(data) {
            if (data.status) {
                scope.exitCallToBookError = true;
                if(data.message === 'Lead successfully inserted') {
                    /* For Analytics - Payment Mode */
                    scope.clickedPackage = '';
                    $analytics.eventTrack('Lead Captured', {
                        category: $state.current.name +' - Call To Book Pop up',
                        label: scope.customerctbNo,
                    });

                    if(typeof($window.fbq) !== 'undefined') {
                        $window.fbq('track', 'Lead', requestData);
                    } 
                }
                scope.Message = '';

                angular.element('#callToBookPopup').css('left', ($window.innerWidth/2 - $('#callToBookPopup').width()/2));
                angular.element('#callToBookPopup').css('top', ($window.innerHeight/3 - $('#callToBookPopup').height()/2));

                angular.element('#callToBook_bg').fadeIn(100);
                angular.element('#callToBookPopup').fadeIn(100);
                angular.element("#customerno123").focus();

                $timeout(function() {
                    scope.exitCallToBookError = false;
                    scope.closeCallToBookPopup();
                }, 4000);

            } else {
                alert(data.message);
            }
        });

    }

    scope.changeMobileCallToBookPopupButtonColor = function() {
        if(scope.ctbcustomerNo) {
            if (scope.ctbcustomerNo.length !== 10 || isNaN(scope.ctbcustomerNo) || scope.ctbcustomerNo === undefined || scope.ctbcustomerNo === '') {
                angular.element("#ctbmobilepopupsubmitbtn").css('background','#b7b7b7');
                angular.element("#ctbmobilepopupsubmitbtn").css('border', '1px solid #cecece');
                angular.element("#ctbmobilepopupsubmitbtn").css('background-image','linear-gradient(to bottom, #b7b7b7 0%, #cecece 100%)');
                
            }
            else {
                angular.element("#ctbmobilepopupsubmitbtn").css('background','#e1530d');
                angular.element("#ctbmobilepopupsubmitbtn").css('border', '1px solid #eaeaea');
                angular.element("#ctbmobilepopupsubmitbtn").css('background-image','linear-gradient(to bottom, #ff7632 0%, #e1530d 100%)');
            }
        }
    }

    scope.sendDirectDetailsMobile = function(requestData) {
        var url = ConstConfig.couponUrl + "webv1/web_api/sendLoggedInLeadInfo";
        doPostWithOutToken($http, url, requestData, "", function(data) {
            if (data.status) {
                scope.callToBookMobileError = true;
                if(data.message === 'Lead successfully inserted') {
                    /* For Analytics - Payment Mode */
                    scope.clickedPackage = '';
                    $analytics.eventTrack('Lead Captured', {
                        category: $state.current.name +' - Mobile Call To Book Pop up',
                        label: scope.customerctbNo,
                    });

                    if(typeof($window.fbq) !== 'undefined') {
                        $window.fbq('track', 'Lead', requestData);
                    } 
                }
                scope.Message = '';
                scope.mobileCallToBookPopupDiv = true;

                $timeout(function() {
                    scope.callToBookMobileError = false;
                    scope.closeMobileCallToBookPopup();
                }, 4000);

            } else {
                alert(data.message);
            }
        });

    }

    scope.sendMobileCTBPopupDetails = function() {
        //var g_recaptcha_response = grecaptcha.getResponse(widgetIdCTBHabitMOB);

        scope.addLeadFormSubmitted = false;

        if (scope.ctbcustomerNo === undefined || scope.ctbcustomerNo === '') {
            scope.addMobileCTBPopupLeadForm.ctbcustomerno.$dirty = true;
            scope.addMobileCTBPopupLeadForm.ctbcustomerno.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: $state.current.name +' - Mobile Call To Book Pop up', label: 'Validation Fail : Mobile no. not enter' });
            return false;
        }

        if (isNaN(scope.ctbcustomerNo)) {
            scope.ctb_mob_valid_error = true;
            scope.ctb_mob_valid_msg = "Enter valid Mobile number";
            $analytics.eventTrack('Validation Fail', { category: $state.current.name +' - Mobile Call To Book Pop up', label: 'Validation Fail : Not a number' });

            $timeout(function() {
                scope.ctb_mob_valid_error = false;
            }, 2000);
            return false;
        }
        if (scope.ctbcustomerNo.length !== 10) {
            scope.ctb_mob_valid_error = true;
            scope.ctb_mob_valid_msg = "Mobile number should be of 10 digits";
            $analytics.eventTrack('Validation Fail', { category: $state.current.name +' - Mobile Call To Book Pop up', label: 'Validation Fail : Not 10 digits' });

            $timeout(function() {
                scope.ctb_mob_valid_error = false;
            }, 2000);
            return false;
        }

        // if(g_recaptcha_response.length == 0) {
        //     $window.alert("Please check Captcha Checkbox");
        //     return false;
        // }

        var requestData = {
            "data": {
                "utm_id": $state.current.name+'-mob-call-to-book',
                "name": scope.ctbcustomerName,
                "mobile": scope.ctbcustomerNo,
                "originator": "habit_risk",
                "source": "mobile"
            }
        };

        requestData['data']['message'] = 'Customer search for : '+ scope.clickedPackage;

        if(localStorage.getItem("guid")) {
            requestData['data']['guid'] = localStorage.getItem("guid");
        }

        var url = ConstConfig.couponUrl + "webv1/web_api/saveEmailCompaignData";
        doPostWithOutToken($http, url, requestData, "", function(data) {
            if (data.status) {
                scope.callToBookMobileError = true;
                 /* Pixel Fire in case of new number */
                if(data.message === 'Lead successfully inserted') {
                    scope.clickedPackage = '';
                    /* For Analytics - Payment Mode */
                    $analytics.eventTrack('Lead Captured', {
                        category: $state.current.name +' - Mobile Call To Book Pop up',
                        label: scope.ctbcustomerNo,
                    });

                    if(typeof($window.fbq) !== 'undefined') {
                        $window.fbq('track', 'Lead', requestData);
                    }                    
                }

                scope.ctbcustomerName = '';
                scope.ctbcustomerNo = '';
                scope.addMobileCTBPopupLeadForm.ctbname.$dirty = false;
                scope.addMobileCTBPopupLeadForm.ctbcustomerno.$dirty = false;

                $timeout(function() {
                    scope.callToBookMobileError = false;
                    scope.closeMobileCallToBookPopup();
                }, 4000);
            } else {                
                alert(data.message);
            }
            //grecaptcha.reset(widgetIdCTBHabitMOB);
        });
    }
}