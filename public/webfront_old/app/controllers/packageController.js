App.controller('packageController', packageController);
packageController.$inject = ['$scope', 'dataShare', 'dataShare1', '$localStorage', '$sessionStorage', '$timeout', '$rootScope', '$location', '$http', '$q', 'BookOrderService', '$state', '$stateParams', 'ConstConfig', 'searchDetail', 'BookOrderService', '$analytics', 'cartService', 'HomeService', "$window"];

function packageController(scope, dataShare, dataShare1, $localStorage, $sessionStorage, $timeout, $rootScope, $location, $http, $q, BookOrderService, $state, $stateParams, ConstConfig, searchDetail, BookOrderService, $analytics, cartService, HomeService, $window) {

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

    $window.scrollTo(0, 0);
    
    
    if($location.search().vendor_code) {
        localStorage.setItem("vendor_code",$location.search().vendor_code);
    }
    
    scope.packageList = [];
    scope.tags = [];
    scope.pkgDetail = [];
    scope.loading = true;
    scope.also_consider_loading = true;
    scope.stateParms = $stateParams;

    scope.addToCartModal = false;
    scope.disableName = false;
    scope.disableRelation = false;
    scope.disablePhone = false;
    scope.disableGender = false;
    scope.viewPkgbox = false;
    scope.customerDetails = [];
    scope.searchedCartPackage = "";
    scope.customerIndex = undefined;
    scope.addfield = true;
    scope.rel = false;
    scope.RelationShip = [];
    scope.RelationShipwithoutSelf = [];
    scope.samepkg = false;
    scope.addhide = false;
    scope.addNewPatient = false;
    scope.addNewPatientSocial = false;
    scope.tempUser = [];
    scope.temp = "";
    scope.errorPkg = false;
    scope.errorPkgMsg = "";

    scope.packageDetailsPage = true;

    var widgetIdCTBSEOWEB;
    var widgetIdCTBSEOMOB;
    var widgetId7;

    //service call for get city 
    scope.getCityList = function() {
        HomeService.getCityDetail(function(data) {
            if (data.status == 'success') {
                scope.cityList = data.data;
            }
        });
    };

    scope.getCityList();


    scope.callVendorPixel = function(lead_id) {
        if($location.search().vendor_code) {
            var pixelUrl = ConstConfig.serverUrl + "commonservice/getVendorPixel";

            var pixelrequest = {
                "vendor_code": $location.search().vendor_code,
                "page_source":"landing",
                "lead_id": lead_id
            }                    

            doPostWithOutToken($http, pixelUrl, pixelrequest,"",function(data){                            
                
                if(data.status) {
                    angular.element("footer").append(data.data);

                    /* For Analytics - Pixel */
                    if(typeof scope.stateParms.publisher_id !== 'undefined') {
                        $analytics.eventTrack('Vendor Publisher Pixel', {
                            category: $location.search().vendor_code,
                            label: scope.stateParms.publisher_id
                        });                                        
                    }
                    else {
                        $analytics.eventTrack('Vendor Pixel', {
                            category: $location.search().vendor_code,
                            label: lead_id                                      
                        });
                    }
                }
            });
        }
    }

    scope.sendLeadDetails = function() {
        //var g_recaptcha_response = grecaptcha.getResponse(widgetId7);

        scope.addLeadFormSubmitted = false;

        if (scope.customerNo === undefined || scope.customerNo === '') {
            scope.addLeadForm.customerno.$dirty = true;
            scope.addLeadForm.customerno.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: 'SEO Page - Lead Form', label: 'Mobile no. not enter' });
            return false;
        }
        else if (scope.customerName === undefined || scope.customerName === '') {
            scope.addLeadForm.name.$dirty = true;
            scope.addLeadForm.name.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: 'SEO Page - Lead Form', label: 'Name not enter' });
            return false;
        }

        // if(g_recaptcha_response.length == 0) {
        //     $window.alert("Please check Captcha Checkbox");
        //     return false;
        // }
                
        var requestData = {
            "data":  {
                "utm_id": 'seoPageLead',
                "name":scope.customerName,
                "mobile":scope.customerNo,
                "source": "web"
                //"city":scope.City,
            }
        };

        if($location.search().vendor_code) {
            requestData['data']['utm_id'] = $location.search().vendor_code;
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
               
                scope.addLeadForm.name.$dirty = false;
                scope.addLeadForm.customerno.$dirty = false;
              
                scope.compaignmsg = true;

                /* Pixel Fire in case of new number */
                if(data.message === 'Lead successfully inserted') {
                    /* For Analytics - Payment Mode */
                    $analytics.eventTrack('Lead Captured', {
                        category: 'SEO Page - Lead Form',
                        label: cphone
                    });

                    if(typeof($window.fbq) !== 'undefined') {
                        $window.fbq('track', 'Lead', requestData);
                    }

                    scope.callVendorPixel(data.lead_id);

                    $timeout(function() {
                        scope.compaignmsg = false;
                        $('.modal-backdrop').remove();
                        $('.modal.in').find('button.close').click();
                    }, 10000);          
                }
                else {
                    $timeout(function() {
                        scope.compaignmsg = false;
                        $('.modal-backdrop').remove();
                        $('.modal.in').find('button.close').click();
                    }, 10000);
                }
            } else {
                $window.alert(data.message);
            }
            //grecaptcha.reset(widgetId7);
        });
    }

    // if (scope.stateParms) {
    //     if($state.current.name  === "diwali2016"){
    //         scope.pkgID = 196;
    //     }
    //     else {
    //         scope.pkgID = scope.stateParms.test.split("_");
    //         scope.pkgID = scope.pkgID[scope.pkgID.length - 1];
    //     }
    // }

    scope.getDetails = function() {
        if (scope.stateParms) {
            scope.deal_type = $state.current.name;
            scope.link_rewrite = scope.stateParms.link_rewrite;

            // if(scope.link_rewrite == "healthians-one-plus-one-offer-999") {
            //     window.location.href = 'package/oneplusone-basic-package-1199';
            // }

            // if(scope.link_rewrite == "one-plus-one-full-body-checkup-2199") {
            //     window.location.href = 'package/oneplusone-full-body-extended-check-2999';
            // }

            // if(scope.link_rewrite == "healthians-couple-package-paytm") {
            //     window.location.href = 'package/oneplusone-extended-1899';
            // }

            // if(scope.link_rewrite == "one-plus-one-healthy-couple-package") {
            //     window.location.href = 'package/oneplusone-extended-1899';
            // }

            // if(scope.link_rewrite == "oneplusone-low-energy-checkup") {
            //     window.location.href = 'package/oneplusone-extended-with-vit-b12-hba1c-2199';
            // }

            // if(scope.link_rewrite == "oneplusone-basic-screening-package-with-vitamin-b12") {
            //     window.location.href = 'package/oneplusone-extended-with-vit-b12-hba1c-2199';
            // }

            // if(scope.link_rewrite == "healthian-oneplusone-extended-package-with-vit-d") {
            //     window.location.href = 'package/oneplusone-extended-with-vitamin-d-2199';
            // }

            // var full_cbc = ['healthians-full-body-checkup', 'healthians-full-body-checkup-with-thyroid-profile' , 'healthians-advanced-full-body-checkup-male'
            // , 'healthians-advanced-full-body-checkup', 'healthians-full-body-checkup-with-iron-studies', 'healthians-full-body-extended-checkup-with-hba1c', 
            // 'healthians-full-body-extended-checkup-with-tft', 'one-plus-one-full-body-checkup-1299', 'oneplusone-full-body-checkup-with-thyroid-and-cbc'];

            // if(full_cbc.includes(scope.link_rewrite)) {
            //     window.location.href = 'package/healthians-full-body-checkup-with-thyroid-and-cbc';
            // }

            // var full_thyroid = ['healthians-summer-special-package-1', 'healthians-basic-screening-package-plus-vitamin-b12' , 'basic-female-hormones'
            // , 'advance-senior-male-package', 'basic-antenatal-care', 'female-extended-package', 
            // 'healthians-nfc-package', 'oneplusone-world-heart-day-package', 'advanced-screening-package', 
            // 'healthians-friendship-package', 'healthians-good-health-package-female', 'oneplusone-extended-package-1499', 
            // 'healthians-rakhi-special-package', 'healthians-freedom-celebration-package', 'female-preventive-package', 
            // 'oneplusone-summer-special-package-1', 'oneplusone-diwali-dhamaka-package', 'comprehensive-heart-care', 'oneplusone-extended-low-energy-checkup'];

            // if(full_thyroid.includes(scope.link_rewrite)) {
            //     window.location.href = 'package/healthians-full-body-checkup-with-thyroid-profile';
            // }

            // if(scope.link_rewrite == "oneplusone-summer-special-package-1") {
            //     window.location.href = 'web-campaign/1';
            // }

            // if(scope.link_rewrite == "healthians-extended-screening-package-with-vit-b12") {
            //     window.location.href = 'package/healthians-basic-screening-package-plus-vitamin-b12';
            // }

            // if(scope.link_rewrite == "hiv-preventive-package") {
            //     window.location.href = 'package/std-detection-package';
            // }

            // if(scope.link_rewrite == "healthians-extended-low-energy-checkup") {
            //     window.location.href = 'package/healthians-fever-package';
            // }

            var cityArray = JSON.parse(localStorage.getItem("cityID"));
            if (cityArray === null) {
                scope.city_id = 23;
                localStorage.setItem("cityID", JSON.stringify([{ "city_id": "23", "city_name": "Gurgaon" }]));
            } else {
                scope.city_id = cityArray[0].city_id;
            }
            /* For Analytics */
            $analytics.eventTrack('SEO Page', {
                category: scope.deal_type.toUpperCase(),
                label: scope.link_rewrite,
            });

            /* OrderBook Page does not book marketing package because search api not return any response of marketing packages.
            Now by using this page marketing packages are booked.
            */

            //function call for getting package details bashed on url package ID
            var requestPayload = {
                "deal_type": scope.deal_type,
                "link_rewrite": scope.link_rewrite,
                "city": scope.city_id,
                "source": "web"
            }

            var dealDetailURL = ConstConfig.couponUrl+"webv1/web_api/get_deal_details_for_seo";

            $http({
                method: "GET",
                url: dealDetailURL,
                params: requestPayload,
            }).success(function(data) {
                if (data.status == true) {
                    scope.loading = false;
                    scope.errorPkg = false;
                    scope.pkgDetail = [];
                    scope.pkgDetail = data.data;
                    scope.pkgDetail.package_name = scope.pkgDetail.name;
                    scope.pkgDetail.package_id = scope.pkgDetail.deal_type+'_'+scope.pkgDetail.id;
                    scope.pkgDetail.healthian_price = scope.pkgDetail.healthians_price;
                    scope.pkgDetail.actual_price = scope.pkgDetail.mrp;
                    scope.pkgDetail.test_count = scope.pkgDetail.tests.length;
                    scope.pkgDetail.testId = scope.pkgDetail.deal_type+'_'+scope.pkgDetail.id;
                    scope.pkgDetail.display_name = scope.pkgDetail.name;
                    scope.pkgDetail.test_packages = [{
                        testId: scope.pkgDetail.deal_type+'_'+scope.pkgDetail.id,
                        display_name: scope.pkgDetail.name,
                        healthians_price: scope.pkgDetail.healthians_price,
                        healthian_price: scope.pkgDetail.healthians_price,
                        actual_price: scope.pkgDetail.mrp,
                        tcategory_id: scope.pkgDetail.deal_type+'_'+scope.pkgDetail.id
                    }];
                    scope.pkgDetail.test_details = scope.pkgDetail.tests;
                    scope.pkgDetail.include_tests = [];
                    scope.pkgDetail.also_include_tests = [];
                    scope.pkgDetail.tests.forEach(function(ele, index) {
                        ele.tcategory_name = ele.name;
                        ele.ptype = ele.deal_type;
                        scope.pkgDetail.include_tests.push(ele);
                    });
                    $rootScope.title = scope.pkgDetail.page_title;
                    $rootScope.description = scope.pkgDetail.meta_description;
                    $rootScope.keyword = scope.pkgDetail.meta_keyword;
                    $rootScope.meta_footer = scope.pkgDetail.meta_footer;
                    
                    if(scope.pkgDetail.canonical_url !== '') {
                        $rootScope.meta_canonical = scope.pkgDetail.canonical_url;
                    }
                    else {
                        $rootScope.meta_canonical = "https://www.healthians.com"+$location.$$url;
                    }

                    if (typeof scope.pkgDetail.robots !== 'undefined') {
                        $rootScope.meta_robots = scope.pkgDetail.robots;
                    }

                    // $timeout(function() {
                    //     if($("#seo_top_seo").length ==0) {
                            
                    //         $('#seo_top').html("");
                    //         $('<div/>', {id: 'seo_top_seo'}).appendTo('#seo_top');

                    //         if(widgetId7 == 0) {
                    //             grecaptcha.reset(widgetId7);
                    //             if($('#seo_top_seo').length) {
                    //                 widgetId7 = grecaptcha.render('seo_top_seo', {'sitekey' : $rootScope.gCatchaKey});
                    //             }
                    //         }
                    //         else {
                    //             if($('#seo_top_seo').length) {
                    //                 widgetId7 = grecaptcha.render('seo_top_seo', {'sitekey' : $rootScope.gCatchaKey});
                    //             }
                    //         }
                    //     }
                    // }, 500);
                    
                    $timeout(function() {
                        console.log("data - track - out", typeof($window.fbq));
                        if(typeof($window.fbq) !== 'undefined') {
                            var fbData=[];
                            fbData['content_ids']=[scope.pkgDetail.package_id];
                            fbData['contents']= [{'id': scope.pkgDetail.package_id , 'quantity': 1, 'item_price':scope.pkgDetail.healthian_price}];
                            fbData['content_type']='product';
                            fbData['content_category']='SEO Pages';
                            fbData['value']=scope.pkgDetail.healthian_price;
                            fbData['currency']='INR';
                            fbData['content_name']=scope.pkgDetail.package_name;
                            $timeout(function() {
                                $window.fbq('track', 'ViewContent', fbData);
                            }, 500);
                        }
                        else {
                            $timeout(function() {
                                if(typeof($window.fbq) !== 'undefined') {
                                    console.log("data - track - enter",typeof($window.fbq));
                                    var fbData=[];
                                    fbData['content_ids']=[scope.pkgDetail.package_id];
                                    fbData['contents']= [{'id': scope.pkgDetail.package_id , 'quantity': 1, 'item_price':scope.pkgDetail.healthian_price}];
                                    fbData['content_type']='product';
                                    fbData['content_category']='SEO Pages';
                                    fbData['value']=scope.pkgDetail.healthian_price;
                                    fbData['currency']='INR';
                                    fbData['content_name']=scope.pkgDetail.package_name;
                                    $window.fbq('track', 'ViewContent', fbData);
                                }
                                else {
                                    $timeout(function() {
                                        if(typeof($window.fbq) !== 'undefined') {
                                            console.log("data - track - enter",typeof($window.fbq));
                                            var fbData=[];
                                            fbData['content_ids']=[scope.pkgDetail.package_id];
                                            fbData['contents']= [{'id': scope.pkgDetail.package_id , 'quantity': 1, 'item_price':scope.pkgDetail.healthian_price}];
                                            fbData['content_type']='product';
                                            fbData['content_category']='SEO Pages';
                                            fbData['value']=scope.pkgDetail.healthian_price;
                                            fbData['currency']='INR';
                                            fbData['content_name']=scope.pkgDetail.package_name;
                                            $window.fbq('track', 'ViewContent', fbData);
                                        }
                                    }, 2000);
                                }
                            }, 2000);
                        }
                    }, 2000);
                    

                } else {
                    scope.pkgDetail = {};
                    scope.loading = false;
                    scope.errorPkg = true;
                    scope.errorPkgMsg = "Something went wrong.";
                    window.location.href = "web-campaign/1";
                    //$location.url('/404-error');
                }
            }).error(function(){
                scope.pkgDetail = {};
                scope.loading = false;
                scope.errorPkg = true;
                scope.errorPkgMsg = "Something went wrong.";
                window.location.href = "web-campaign/1";
            });
        }
    }
   
    scope.getDetails();

    //function call for listing popular packages
    scope.getPopularPackages = function(remove_package) {
        if (scope.deal_type == 'package') {
            var popularPayload = {
                "city": JSON.parse(localStorage.getItem("cityID"))[0].city_name,
                "ptype": scope.deal_type,
                "link_rewrite": scope.link_rewrite
            };

        } else {
            var popularPayload = {
                "city": JSON.parse(localStorage.getItem("cityID"))[0].city_name,
                "ptype": scope.deal_type,
                "link_rewrite": scope.link_rewrite
            };
        }
        
        $http({
            method: "GET",
            url: ConstConfig.couponUrl + "webv1/web_api/getPopularPackages",
            params: popularPayload,
        }).success(function(data) {
            if(data.data) {
                scope.packageList = [];
                var packageListTemp = data.data;
                scope.also_consider_loading = false;
                packageListTemp.forEach(function(ele, index) {
                    if(typeof remove_package !== 'undefined') {
                        if(ele.package_id !== remove_package) {
                            scope.packageList.push(ele);
                        }  
                    } else {
                        scope.packageList.push(ele);
                    }                    
                });
                scope.packageList = _.shuffle(scope.packageList);
            }
        });
    };

    scope.getPopularPackages(scope.pkgDetail.package_id);

    // scope.$on('data_shared', function() {
    //     scope.customerDetails = dataShare.getData();
    //     if (scope.customerDetails[0].pkg.healthian_price !== 0) {
    //         scope.orderList = true;
    //         $rootScope.count++;
    //         if (localStorage.getItem("isLogin") != 'true') {
    //             scope.tempUser = JSON.parse(localStorage.getItem("tempUser"));
    //         }
    //         scope.getcustomerForm.sampledate = scope.customerDetails[0].date;
    //         scope.getcustomerForm.location = scope.customerDetails[0].location;
    //         scope.getcustomerForm.sampletime = scope.customerDetails[0].time_slot;
    //         scope.totalAmount();
    //     }
    //     scope.collectiontimeflag = true;
    // });

    scope.$on('changeCityDropown', function(event, data) {
        scope.getDetails();
    });

    //function call from package search from package list
    scope.pkgSearch = function(obj) {
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

        /* Old Logic - Redirection 
            scope.tags[0] = {"id":obj.package_id,"text":obj.package_name};
            searchDetail.setSearchPackages(scope.tags);
            $location.path('/orderbook');
        */
    };

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
            scope.pkgSearch(tempSelectedPackage);

            scope.member = JSON.parse(localStorage.getItem("user")).relatives;
        }
    });

    //subscribe in footer
    scope.subscriber = function(emailId) {
        if (scope.addAddressForm.customerEmail === undefined || scope.addAddressForm.customerEmail === '') {
            scope.addAddressForm.customeremail.$dirty = true;
            scope.addAddressForm.customeremail.$invalid = true;
            scope.addAddressForm.customeremail.$error.required = true;
            return false;
        }

        doPost($http, ConstConfig.serverUrl + "commonservice/subscribeNewsLetter/", { "email": emailId, "source": "web" }, "", function(data) {
            if (data.status == true) {
                alert(data.message);
            } else {
                alert(data.data.email);
            }
        });
    };

    /* Function to calculate total amount */
    scope.totalAmount = function() {
        scope.amount = 0;
        scope.customerDetails.forEach(function(ele, index) {
            ele.newpkg.forEach(function(ele1, index) {
                scope.amount += parseInt(ele1.healthians_price);
            });
        });
        if (scope.amount == 0) {
            scope.orderList = false;
            scope.addToCartModal = false;
        }
        localStorage.setItem("amountfinal", scope.amount);
    };

    /* Function to calculate sub-total amount */
    scope.getSubTotal = function(obj, $index) {
        scope.subtotal = 0;
        obj.forEach(function(ele, index) {
            scope.subtotal += parseInt(ele.healthians_price);
        });
        return scope.subtotal;
    };

    /* Count no. of package count */
    scope.getPkgCount = function(obj, $index) {
        scope.testCount = 0;
        obj.newpkg.forEach(function(ele, index) {
            scope.testCount++;
        });
        return scope.testCount;
    };

    
    /* To book order after user and package addition */
    scope.confirmBook = function() {
        $rootScope.total = scope.amount;
        dataShare1.sendData1(scope.customerDetails);
        localStorage.setItem("Detailscustomer", JSON.stringify(scope.customerDetails));
    };


    // Reset Coupon data local storage
    scope.coupondata = {};
    localStorage.setItem("coupondata", JSON.stringify(scope.coupondata));

    if($location.search().vendor_code) {
        localStorage.setItem("vendor_code",$location.search().vendor_code);
    }

    if($location.search().admitad_uid) {
        localStorage.setItem("admitad_uid",$location.search().admitad_uid);
    }

    scope.isLeadCaptured = localStorage.getItem("isLeadCaptured");
    if(scope.isLeadCaptured === null) {
        
    }
    else {
        if(scope.isLeadCaptured == "true") {
            /* Expire Exit Popup */
            var now = new Date();
            var exp = new Date(now.getTime() + (1 * 24 * 60 * 60 * 1000));

            if (isMobile.any()) {
                document.cookie = 'ExitPopupMobileCookie=1; expires=' + exp.toUTCString();
            }
            else {
                document.cookie = 'ExpirationCookieTest=1; expires=' + exp.toUTCString();
            }
        }
    }


    /* Get A Call Back Now - Button for Mobile and Desktop */
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
                    "utm_id": 'seo-web-get-a-call-back',
                    "user_id" : userId,
                    "originator": $state.current.name,
                    "source": "web"
                }
            };

            if($location.search().vendor_code) {
                requestData['data']['utm_id'] = $location.search().vendor_code;
            }

            requestData['data']['message'] = $state.current.name + ' Page :: Customer search for : '+ scope.clickedPackage;

            if (isMobile.any()) {
                requestData['data']['utm_id'] = 'seo-mob-get-a-call-back';
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
                //     if($("#seo_ctb_orderbook_mob").length ==0) {
                //         $('#seo_ctb_mob').html("");
                //         $('<div/>', {id: 'seo_ctb_seopage_mob'}).appendTo('#seo_ctb_mob');

                //         if(widgetIdCTBSEOMOB == 0) {
                //             grecaptcha.reset(widgetIdCTBSEOMOB);
                //             if($('#seo_ctb_seopage_mob').length) {
                //                 widgetIdCTBSEOMOB = grecaptcha.render('seo_ctb_seopage_mob', {'sitekey' : $rootScope.gCatchaKey});
                //             }
                //         }
                //         else {
                //             if($('#seo_ctb_seopage_mob').length) {
                //                 widgetIdCTBSEOMOB = grecaptcha.render('seo_ctb_seopage_mob', {'sitekey' : $rootScope.gCatchaKey});
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
                //     if($("#seo_ctb_seopage_web").length ==0) {
                        
                //         $('#seo_ctb_web').html("");
                //         $('<div/>', {id: 'seo_ctb_seopage_web'}).appendTo('#seo_ctb_web');

                //         if(widgetIdCTBSEOWEB == 0) {
                //             grecaptcha.reset(widgetIdCTBSEOWEB);
                //             if($('#seo_ctb_seopage_web').length) {
                //                 widgetIdCTBSEOWEB = grecaptcha.render('seo_ctb_seopage_web', {'sitekey' : $rootScope.gCatchaKey});
                //             }
                //         }
                //         else {
                //             if($('#seo_ctb_seopage_web').length) {
                //                 widgetIdCTBSEOWEB = grecaptcha.render('seo_ctb_seopage_web', {'sitekey' : $rootScope.gCatchaKey});
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

        //var g_recaptcha_response = grecaptcha.getResponse(widgetIdCTBSEOWEB);

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
                "utm_id": 'seo-web-get-a-call-back',
                "name":scope.customerctbName,
                "mobile":scope.customerctbNo,
                "originator": $state.current.name,
                "source": "web"
            }
        };

        if($location.search().vendor_code) {
            requestData['data']['utm_id'] = $location.search().vendor_code;
        }

        requestData['data']['message'] = $state.current.name + ' Page :: Customer search for : '+ scope.clickedPackage;
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

                    scope.callVendorPixel(data.lead_id);               
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
            //grecaptcha.reset(widgetIdCTBSEOWEB);
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

                    scope.callVendorPixel(data.lead_id);

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

                    scope.callVendorPixel(data.lead_id);

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
        //var g_recaptcha_response = grecaptcha.getResponse(widgetIdCTBSEOMOB);

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
                "utm_id": 'seo-mob-get-a-call-back',
                "name": scope.ctbcustomerName,
                "mobile": scope.ctbcustomerNo,
                "originator": $state.current.name,
                "source": "mobile"
            }
        };

        if($location.search().vendor_code) {
            requestData['data']['utm_id'] = $location.search().vendor_code;
        }

        requestData['data']['message'] = $state.current.name + ' Page :: Customer search for : '+ scope.clickedPackage;
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

                    scope.callVendorPixel(data.lead_id);

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
            //grecaptcha.reset(widgetIdCTBSEOMOB);
        });
    }
    /* Get A Call Back Now - Button for Mobile and Desktop */


}
