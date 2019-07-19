App.controller('finalCheckoutController', finalCheckoutController);
finalCheckoutController.$inject = ['$scope', 'dataShare', 'dataShare1', '$localStorage', '$sessionStorage', '$timeout', '$rootScope', '$location', '$http', '$q', 'BookOrderService', 'ConstConfig', '$analytics', '$sce', '$state', 'HomeService', '$window', '$interval'];

function finalCheckoutController(scope, dataShare, dataShare1, $localStorage, $sessionStorage, $timeout, $rootScope, $location, $http, $q, BookOrderService, ConstConfig, $analytics, $sce, $state, HomeService, $window, $interval) {
    
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

    scope.$on('$destroy', function() {
      $interval.cancel(x);
    });

    if (isMobile.any()) {
        scope.device = 'mobile';
    }
    else {
        scope.device = 'web';
    }

    /* New Variable Initialization */
    /* For Tab Activation */
    scope.pickTabActive = true;
    scope.paymentTabActive = false;

    scope.bookingTimeTickerExpire = false;

    /*Address Form*/
    scope.sublocalityDropDownSelected = false;
    scope.collectiontimeflag = false;
    scope.chosenPlace = "";
    scope.locality_id = "";

    /* Hard Copy Function */
    scope.hardcopyPrice = 0;
    scope.hardCopy = false;
    $rootScope.hard_copyFlag = false;

    // Coupons
    scope.invalidCoupon = false;
    scope.coupondata = {};
    scope.coupondata.applied = false;
    scope.coupondata.hard_copy = false;
    scope.couponShow = false;
    scope.couponApplied = false;
    $rootScope.couponCode = "";
    $rootScope.couponAmount = "";
    scope.allow_with_wallet = false;

    scope.discountamount = 0;
    
    scope.onlineDiscountApplicable = false;
    scope.onlineDiscountActive = false;
    scope.onlineDiscountApplied = false;


    // Payment Form 
    scope.onlineDiscount = 0;
    scope.payradio = "paytm";
    var paymentUrl = ConstConfig.paymentUrl;
    scope.payuAction = $sce.trustAsResourceUrl(paymentUrl + 'payupayment');
    scope.mobikwikAction = $sce.trustAsResourceUrl(paymentUrl + 'mobikwikpayment');
    scope.payzappAction = $sce.trustAsResourceUrl(paymentUrl + 'payzapppayment');
    scope.paytmAction = $sce.trustAsResourceUrl(paymentUrl + 'paytmpayment');

    // Address Present
    scope.useAddressPresent = true;
    scope.existingaddress = '';
    scope.modifyAddressFlag = {};
    scope.defaultExistingAddressObject = {};

    // Token
    var token = localStorage.getItem("token");

    // Booking Loader
    scope.showBookingLoader = false;

    // Address spinner
    scope.loaderVarAddress = true;

    scope.popularPackageList = false;
    scope.firstPageList = [];
    scope.orderList = false;
    scope.userId = null;
    scope.selection = [];
    scope.addToCartModal = false;
    scope.btnshow = false;
    scope.rel = true;
    scope.addNewAddress = false;
    scope.newlocation = false;
    scope.hideSuggestedLocation = false;
    scope.relative = false;
    scope.guestUser = false;
    scope.alertDiv = false;
    scope.samepkg = false;
    scope.loggedin = false;
    scope.addfield = true;
    scope.loc_id = '';
    scope.customSearchVal = "";
    scope.suggestPackageList = [];
    scope.localityList = [];

    scope.filters = {};
    scope.filters.suggested_test = [];
    scope.searchValue = [];
    $rootScope.selectData = [];
    scope.cityList = [];
    scope.temp = [];
    scope.member = [];
    scope.noTimeSlot = false;
    scope.subtotal = 0;
    scope.displayData = {};
    scope.habitListCheckbox = {};
    scope.displayList = false;
    $rootScope.count = 0;

    scope.customerIndex = undefined;
    scope.loading = true;
    scope.arrayList = [];
    scope.accordionList = [];
    scope.userDetail = {};
    scope.booking_id = "";
    scope.userDetail.address = {};
    scope.tempUser = [];
    scope.addNewPatient = false;
    scope.hideContinue = true;
    scope.postal_code = "";
    scope.detailCustomer = true;

    scope.ignoreGeoCodeLocality = false;
    scope.distanceError = false;
    scope.tempsublocality = "";
    scope.refresh_slider = false;

    scope.isHardCopyDisabled = false;
    scope.isCouponDisabled = false;
    scope.isCouponRemoveDisabled = false;
    scope.ecashcheck = false;
    scope.ecash_amount = '';
    scope.eCashApplied = false;
    scope.disabledHcash = false;

    scope.getAddressesByUserId = function(user_id){
        //scope.useAddressPresent = false;
        /* Get All Address of User */
        var city_name = JSON.parse(localStorage.getItem("cityID"))[0].city_name;

        var getUserAddressURL = ConstConfig.serverUrl + "commonservice/getAddressesByUserId";
        var addressPayload = {
            "user_id": user_id,
            "log_user_id": user_id,
            "city_name": city_name
        };

        doPost($http, getUserAddressURL, addressPayload, token, function(address_data) {
            if(address_data.data) {
                scope.noOfAdd = address_data.data.length;
                scope.addressList = [];
                if (scope.noOfAdd > 0) {
                    scope.useAddressPresent = true;
                    scope.loaderVarAddress = false;
                    scope.addressList = address_data.data;
                    scope.addressList.forEach(function(value, index) {
                        //scope.modifyAddressFlag[value.address_id] = false;
                        if (parseInt(value.default_status) === 1) {
                            scope.existingaddress = parseInt(value.address_id);
                            scope.defaultExistingAddressObject = value;
                            scope.selectListedAdd(value);
                        }
                    });

                    if(_.isEmpty(scope.defaultExistingAddressObject)) {
                        scope.defaultExistingAddressObject = scope.addressList[0];
                        scope.addressList[0].default_status = 1;
                        scope.selectListedAdd(scope.defaultExistingAddressObject);
                    }

                } else {
                    scope.useAddressPresent = false;
                    scope.loaderVarAddress = false;
                    scope.addressList = [];
                }
            }
            else {                
                if(address_data.status === "error") {
                    if(address_data.code == 'TOKEN_EXPIRED' || address_data.code == 'INVALID_TOKEN' || address_data.code == 'AUTH_FAILED') {
                        $rootScope.$broadcast('tokenExpired');
                    }
                }
            }
        });
    }

    scope.donation = true;
    scope.coupon_notice_div = false;
    scope.donationFees = 0;

    scope.getDonationInfo = function(){
        var getDonationInfoURL = ConstConfig.couponUrl + "webv1/web_api/getDonationInfo";
        
        doGet($http, getDonationInfoURL, function(data) {
            if (data.status === "success") {
                scope.donation_details = data.data;
                if(scope.donation_details.apply_donation_amount == 'yes') {
                    scope.donationcheck = true;
                    scope.donationFees = scope.donation_details.donation_amount;
                    scope.donationInfo = scope.donation_details.donation_info;
                }
                else {
                    scope.donationcheck = false;
                    scope.donationFees = 0;
                }

                scope.online_discount_config = scope.donation_details.online_discount;

                if(scope.online_discount_config.active == 'on') {
                    if(scope.online_discount_config.source.includes('web')) {
                        scope.onlineDiscountActive = true;
                        scope.online_discount_amount = parseInt(scope.online_discount_config.amount);
                        scope.online_discount_mimimum_amount = scope.online_discount_config.minimum_booking_amount;
                    }
                    else {
                        scope.onlineDiscountActive = false;
                    }
                }
                else {
                    scope.onlineDiscountActive = false;
                }

                scope.coupon_notice = JSON.parse(scope.donation_details.coupon_discount_addon_config);
                if(scope.coupon_notice.status !== 'off') {
                    scope.coupon_notice_msg = scope.coupon_notice.msg;
                    scope.coupon_notice_div = true;
                }
                
            }
        });
    }

    scope.getDonationInfo();

    scope.checkInactivePackage = function(data_value) {
        var billing_user_id = scope.userDetail.user_id;
        
        if(data_value.length > 0) {
            var checkInactiveURL = ConstConfig.serverUrl + "commonservice/checkInactiveProduct";
            var requestPayload = {            
                "source": "web",
                "data_value": data_value,
                "log_user_id": billing_user_id          
            };

            doPost($http, checkInactiveURL, requestPayload, token, function(data) {
                if(data.status) {
                    if(data.status === 'error') {
                        if(data.code == 'TOKEN_EXPIRED' || data.code == 'INVALID_TOKEN' || data.code == 'AUTH_FAILED') {
                            $rootScope.$broadcast('tokenExpired');
                        }
                    }
                }
                else {
                    alert(data.message);
                    $state.go('cart');
                }
            });
        }       
    }

    scope.fetchCart = function(user_id) {
        var data_value = [];
        scope.healthiansamount = 0;

        var fetchCartURL = ConstConfig.couponUrl + "customer/account/fetch_cart_v2";
        var requestPayloadFetchCart = {
            "data" : {
                "user_id" : user_id,
                "city_id" : JSON.parse(localStorage.getItem("cityID"))[0].city_id,
                "source" : "web"
            }
        };

        doPost($http, fetchCartURL, requestPayloadFetchCart, token, function(data) {
            if(data.status) {
                if(data.status === 'error') {
                    if(data.code == 'TOKEN_EXPIRED' || data.code == 'INVALID_TOKEN' || data.code == 'AUTH_FAILED') {
                        $rootScope.$broadcast('tokenExpired');
                    }
                }
                else {
                    scope.cartData = data.data;

                    if(scope.cartData.allow_to_proceed) {

                    }
                    else {
                        $window.alert(scope.cartData.allow_to_proceed_message);
                        $state.go('user_selection_cart');
                    }

                    scope.cartTotalAmount = isNaN(scope.cartData.total_price) ? 0 : parseInt(scope.cartData.total_price);
                    scope.discountamount = scope.cartTotalAmount;
                    $rootScope.totalCartTest = 0;
                    //scope.checkInactivePackage();

                    if(scope.cartData.customer_detail.length > 0) {
                        scope.cartData.customer_detail.forEach(function(ele, index) {
                            $rootScope.totalCartTest += ele.deals.length;
                            ele.deals.forEach(function(element, ind) {
                                scope.healthiansamount += parseInt(element.actual_price);                               
                                if(!_.contains(data_value, element.id)) {
                                    data_value.push(element.id);
                                }                    
                            });
                        });
                    }
                }                
            }
            else {
                $state.go('orderbook');
            }
        });
    }

    if (localStorage.getItem("isLogin") == 'true') {
        var user = JSON.parse(localStorage.getItem("user"));
        scope.userDetail.user_id = user.user_id;
        scope.userDetail.name = user.name;
        scope.userDetail.email = user.email;
        scope.userDetail.mobile = user.mobile;
        scope.loggedin = true;

        if (localStorage.getItem("coupondata") !== null) {
            var checkhardcopy = JSON.parse(localStorage.getItem("coupondata")).hard_copy;
            if(checkhardcopy) {
                scope.hardCopy = checkhardcopy;
                scope.coupondata = {};
                scope.coupondata.hard_copy = true;
                localStorage.setItem("coupondata", JSON.stringify(scope.coupondata));
            }
        }
        else {
            scope.coupondata = {};
            scope.coupondata.applied = false;
            scope.coupondata.hard_copy = false;
            scope.couponApplied = false;
            localStorage.setItem("coupondata", JSON.stringify(scope.coupondata));
        }
        
        scope.getAddressesByUserId(user.user_id);
        scope.fetchCart(user.user_id);
    }

    // for showing front page search result
    scope.frontPageSearchInt = function() {
        scope.tags = searchDetail.getSearchPackages();
        scope.tags.forEach(function(ele, ind) {
            scope.searchValue.push({ "text": ele.text, "id": ele.id });
        });
        scope.createSearchRequest();
    };


    scope.addNewLocation = function(location) {
        var opts = { locality_name: location, city_id: JSON.parse(localStorage.getItem("cityID"))[0].city_id };
        BookOrderService.addNewLocality(opts, function(data) {
            if (data.message == 'SUGGESTED_LOCALITY_ADDED') {
                scope.newlocation = true;
            }
        });
    };


    function startTimer(duration, display) {
        var timer = duration,
            minutes, seconds;
        if ($rootScope.counterVal != undefined) {
            clearInterval($rootScope.counterVal);
        }

        $rootScope.counterVal = setInterval(function() {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            if (minutes === 0 && seconds === 0) {
                clearInterval($rootScope.counterVal);
                localStorage.setItem("time_slot", "");
                display.hide();
                window.location.href = '/pick-time';
            } else {
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                display.text(minutes + ":" + seconds);
            }

            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

    scope.gettimer = function(slotId) {
        var freeztime;
        var deferred = $q.defer();
        BookOrderService.getFreezDateBySlotId(slotId, function(data) {
            freeztime = data.data[0];
            deferred.resolve(freeztime);
        });
        return deferred.promise;
    };

    scope.counter = function(slotId) {
        var freeztime = scope.gettimer(slotId);
        var promise = scope.gettimer(slotId).then(function(response) {
            var utc = moment(response.expiryDate, "YYYY-MM-DD HH:mm:ss").diff(moment(response.nowDate, "YYYY-MM-DD HH:mm:ss"));
            if (utc > 0) {
                var _time = moment.utc(utc);
                var min = _time.format('mm');
                var sec = _time.format("ss");
                var seconds = (60 * min) + parseInt(sec);
                display = $('#counter');
                startTimer(seconds, display);
            }
        });
    };

    // service for getting user_id
    scope.freezeSlot = function(opt) {
        var deferred = $q.defer();
        var user = scope.generateUserId(opt);
        deferred.resolve(user);
        return deferred.promise;
    };

    scope.setSlotCalender = function(slot_days) {
        // enable date for collection 
        var time = new Date();
        var hour = time.getHours();
        var minute = time.getMinutes();
        // if (hour >= 8 && hour <= 11) {
        //     $('#collectiondate').datepicker({
        //         startDate: '+d',
        //         endDate: '+3d',
        //     });
        // } else if (hour >= 20 || hour <= 7) {
        //     var today = moment().add(3, 'days').format('DD-MM-YYYY');
        //     $('#collectiondate').datepicker({
        //         startDate: '+2d',
        //         endDate: '+4d',
        //     });
        // } else {
        //     $('#collectiondate').datepicker({
        //         startDate: '+1d',
        //         endDate: '+3d',
        //         disabledDates: ['2016-04-18']
        //     });
        // }
        $('#collectiondate').datepicker({
            startDate: '+d',
            endDate: '+'+(parseInt(slot_days))+'d',
            showTodayButton:  false,
            showClear: false,
        });

        // if (hour >= 0 && hour <= 7) {
        //     $('#collectiondate').datepicker({
        //         startDate: '+d',
        //         endDate: '+'+(slot_days+1)+'d',
        //         showTodayButton:  false,
        //         showClear: false,
        //     });
        // }
        // else {

        //     $('#collectiondate').datepicker({
        //         startDate: '+0d',
        //         endDate: '+'+slot_days+'d',
        //         showTodayButton:  false,
        //         showClear: false,
        //     });
        // }
    };

    var slotDaysUrl = ConstConfig.couponUrl + "webv1/web_api/getSlotDays"

    doGet($http, slotDaysUrl, function(data) {
        if(data) {
            if(data.data) {
                if(data.data.name > 0) {
                    scope.setSlotCalender(data.data.name);
                }
                else {
                    scope.setSlotCalender(3);
                }                
            }
            else {
                scope.setSlotCalender(3);
            }      
        }
    });    

    // service for getting time slots when collection date is changed
    scope.getTimeSlots = function(date) {
        if(scope.locality_id === ''){
            $window.alert("Please select address");
            /* Reset Sample date and time */
            scope.sampledate = undefined;
            scope.sampletime = undefined;

            if(scope.addAddressForm.collectiondate !== undefined) {
                scope.addAddressForm.collectiondate.$dirty = false;
            }
            if(scope.addAddressForm.collectiontime !== undefined) {
                scope.addAddressForm.collectiontime.$dirty = false;
            }
            /* Reset Sample date and time */
            return false;
        }

        scope.showLoader = true;
        var deferred = $q.defer();
        var log_user_id = JSON.parse(localStorage.getItem("user")).user_id;
        BookOrderService.getTimeSlots(scope.locality_id, date, JSON.parse(localStorage.getItem("amountfinal")),log_user_id, function(data) {
            if (data.status == 'success') {
                if (data.data == null) {
                    $analytics.eventTrack('Got "No Time Slot Avaliable" message', { category: 'Timeslot Selection' });
                    scope.noTimeSlot = true;
                } else {
                    scope.noTimeSlot = false;
                    scope.slots = data.data;
                }
                scope.showLoader = false;
                deferred.resolve(scope.slots);
            } else {
                if (data.status === "error") {
                    if(data.code == 'TOKEN_EXPIRED' || data.code == 'INVALID_TOKEN' || data.code == 'AUTH_FAILED') {
                        $rootScope.$broadcast('tokenExpired');
                    }
                }
                scope.showLoader = false;
            }
        });
        return deferred.promise;
    };


    /* Address Selection of User Listed Address */
    scope.selectListedAdd = function(address) {
        /* Reset Sample date and time */
        scope.slots = [];
        scope.locality_id = '';
        scope.sampledate = undefined;
        scope.sampletime = undefined;

        if(scope.addAddressForm) {
            if(scope.addAddressForm.collectiondate !== undefined) {
                scope.addAddressForm.collectiondate.$dirty = false;
                //scope.addAddressForm.collectiondate = undefined;
            }
            if(scope.addAddressForm.collectiontime !== undefined) {
                scope.addAddressForm.collectiontime.$dirty = false;
                //scope.addAddressForm.collectiontime = undefined;
            }
        }
        
        /* Reset Sample date and time */

        scope.existingaddress = parseInt(address.address_id);
        var add_comp = address.address.split(",");

        // scope.addAddressForm.houseno = add_comp[0];
        // scope.addAddressForm.landmark = add_comp[1];
        // scope.addAddressForm.sublocality = scope.addAddressForm.sublocality;
        // scope.addAddressForm.pincode = address.pincode;
        scope.userDetail.address.address_id = address.address_id;
        scope.userDetail.address.address = address.address;
        scope.userDetail.address.lat = address.lat;
        scope.userDetail.address.long = address.long;
        scope.userDetail.address.state_id = address.state_id;
        scope.userDetail.address.state_name = address.state_name;
        scope.userDetail.address.city = address.city;
        scope.userDetail.address.locality_id = address.locality_id;
        scope.userDetail.address.pincode = address.pincode;

        scope.locality_id = address.locality_id;

        localStorage.setItem("userDetail", JSON.stringify(scope.userDetail));

        localStorage.setItem("houseno", add_comp[0]);
        localStorage.setItem("landmark", add_comp[1]);
        localStorage.setItem("postal_code", address.pincode);
        localStorage.setItem("address", address.address);
        /* Edit Address
        angular.forEach(scope.modifyAddressFlag, function(value, key) {
            scope.modifyAddressFlag[key] = false;
        });
        */

    };

    scope.modifyExistingAddress = function(address_id) {
        scope.modifyAddressFlag[address_id] = !scope.modifyAddressFlag[address_id];
    }

    scope.addNewAddress = function() {
        scope.userDetail.address = {};
        scope.useAddressPresent = false;
        scope.loaderVarAddress = false;

        /* Reset Sample date and time */
        scope.slots = [];
        scope.locality_id = '';
        scope.sampledate = undefined;
        scope.sampletime = undefined;

        if(scope.addAddressForm.collectiondate !== undefined) {
            scope.addAddressForm.collectiondate.$dirty = false;
            //scope.addAddressForm.collectiondate = undefined;
        }
        if(scope.addAddressForm.collectiontime !== undefined) {
            scope.addAddressForm.collectiontime.$dirty = false;
            //scope.addAddressForm.collectiontime = undefined;
        }
        /* Reset Sample date and time */

        scope.resetSubLocality();
    }

    scope.viewExistingAddress = function() {

        scope.useAddressPresent = true;
        scope.loaderVarAddress = false;

        /* Reset Sample date and time */
        scope.slots = [];
        scope.locality_id = '';
        scope.chosenPlace = "";
        scope.sampledate = undefined;
        scope.sampletime = undefined;
        
        if(scope.addAddressForm.collectiondate !== undefined) {
            scope.addAddressForm.collectiondate.$dirty = false;
            //scope.addAddressForm.collectiondate = undefined;
        }
        if(scope.addAddressForm.collectiontime !== undefined) {
            scope.addAddressForm.collectiontime.$dirty = false;
            //scope.addAddressForm.collectiontime = undefined;
        }
        /* Reset Sample date and time */

        // Select Address 
        scope.addressList.forEach(function(value, index) {
            if (value.default_status == 1) {
                scope.existingaddress = parseInt(value.address_id);
                scope.defaultExistingAddressObject = value;
                scope.selectListedAdd(value);
            }
        });

        if(_.isEmpty(scope.defaultExistingAddressObject)) {
            scope.defaultExistingAddressObject = scope.addressList[0];
            scope.addressList[0].default_status = 1;
            scope.selectListedAdd(scope.defaultExistingAddressObject);
        } 
        else {
            scope.selectListedAdd(scope.defaultExistingAddressObject);
        }
    }

    /* Set this address to Default */
    scope.setDefaultAddress = function(address) {
        scope.useAddressPresent = false;
        scope.loaderVarAddress = true;
        var address_id = parseInt(address.address_id);

        var user = JSON.parse(localStorage.getItem("user"));
        var user_id = user.user_id;

         /* Get All Address of User */
        var markAddressToDefaultURL = ConstConfig.serverUrl + "commonservice/markAddressToDefault";
        var requestPayload = {            
            "user_id": user_id,
            "address_id": address_id,
            "log_user_id": user_id          
        };

        angular.element('.slider').slick('destroy');
        angular.element('.slick-slide').remove();

        doPost($http, markAddressToDefaultURL, requestPayload, token, function(data) {
            if(data.status) {
                scope.getAddressesByUserId(user.user_id);
                scope.address_msg_visible = true;
                scope.address_message = '"' + address.address +'" marked as your default address.';
            }
            else {
                scope.getAddressesByUserId(user.user_id);
                scope.address_msg_visible = true;
                scope.address_message = data.message;
            }
        });
    };

    scope.address_delete_confirmation = function(address) {
        scope.deleteaddress = address;
        scope.address_delete_visible = true;
    }

    /* Delete this address */
    scope.deleteUserAddress = function(address) {
        scope.useAddressPresent = false;
        scope.loaderVarAddress = true;
        var address_id = parseInt(address.address_id);

        var user = JSON.parse(localStorage.getItem("user"));
        var user_id = user.user_id;

         /* Get All Address of User */
        var markAddressToDefaultURL = ConstConfig.serverUrl + "commonservice/deleteUserAddress";
        var requestPayload = {            
            "user_id": user_id,
            "address_id": address_id,
            "log_user_id": user_id           
        };

        angular.element('.slider').slick('destroy');
        angular.element('.slick-slide').remove();

        doPost($http, markAddressToDefaultURL, requestPayload, token, function(data) {
            if(data.status) {
                scope.getAddressesByUserId(user.user_id);
                scope.address_msg_visible = true;
                scope.address_message = "Address deleted successfully.";
            }
            else {
                scope.getAddressesByUserId(user.user_id);
                scope.address_msg_visible = true;
                scope.address_message = data.message;
            }
        });
    };


    var x = '';
    scope.clock = function(countDownDate) {
        // document.getElementById("bookingtimeticker").style.display = 'block';
        // Update the count down every 1 second
        scope.bookingTimeTickerDisplay = true;

        x = $interval(function() {

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
            scope.timeTicker =  minutes + "m " + seconds + "s ";
            if(document.getElementById("bookingtimeticker")) {
                document.getElementById("bookingtimeticker").innerHTML = scope.timeTicker;
            }
            if (distance < 0) {
                scope.timeTicker = "0m 0s";
                if(document.getElementById("bookingtimeticker")) {
                    document.getElementById("bookingtimeticker").innerHTML = scope.timeTicker;
                }
                scope.bookingTimeTickerExpire = true;
                $interval.cancel(x);
            }
            else {
                scope.bookingTimeTickerDisplay = true;
            }
        }, 1000);
    }

    scope.stopClock = function() {
        $interval.cancel(x);
    }

    /* Book/Freeze Slot */
    scope.bookSlot = function() {

        scope.ecashcheck = false;
        scope.ecash_amount = '';
        scope.isCouponDisabled = false;
        scope.isHardCopyDisabled = false;
        scope.isCouponRemoveDisabled = false;
        scope.showEcashdiv = false;
       
        //Remove E-Cash
        scope.eCashApplied = false;
        scope.isECashDisabled = false;
        scope.onConfirmECash = false;
        scope.ecashAmount = '';
        scope.disabledHcash = false;

        document.getElementById("bookingtimeticker").innerHTML = "";
        scope.stopClock();

        scope.slotFreezeError = false;
        var log_user_id = JSON.parse(localStorage.getItem("user")).user_id;
        scope.addAddressFormSubmitted = false;
        scope.loaderVar = true;
        scope.distanceError = false;
        if (!scope.useAddressPresent) {
            if (scope.chosenPlace === undefined || scope.chosenPlace === '') {
                scope.addAddressForm.pacinput.$dirty = true;
                scope.addAddressForm.pacinput.$invalid = true;
                scope.addAddressForm.pacinput.$error.required = true;
                scope.loaderVar = false;
                focus('pacinput');
                return false;
            } else if (scope.houseno === undefined || scope.houseno === '') {
                scope.addAddressForm.houseno.$dirty = true;
                scope.addAddressForm.houseno.$invalid = true;
                scope.addAddressForm.houseno.$error.required = true;
                scope.loaderVar = false;
                $analytics.eventTrack('Validation Faliure on Address Form Submit', { category: 'Confirm Address', label: 'Customer House No.' });
                focus('houseno');
                return false;
            } else if (scope.landmark === undefined || scope.landmark === '') {
                scope.addAddressForm.landmark.$dirty = true;
                scope.addAddressForm.landmark.$invalid = true;
                scope.addAddressForm.landmark.$error.required = true;
                scope.loaderVar = false;
                $analytics.eventTrack('Validation Faliure on Address Form Submit', { category: 'Confirm Address', label: 'Customer Landmark' });
                focus('landmark');
                return false;
            } else if (scope.postal_code === undefined || scope.postal_code === '') {
                if (scope.postal_code_new === undefined || scope.postal_code_new === '') {
                    scope.addAddressForm.postal_code.$dirty = true;
                    scope.addAddressForm.postal_code.$invalid = true;
                    scope.addAddressForm.postal_code.$error.required = true;
                    scope.loaderVar = false;
                    $analytics.eventTrack('Validation Faliure on Address Form Submit', { category: 'Confirm Address', label: 'Customer Pincode' });
                    focus('pincode');
                    return false;
                }
            }
        }
        /* it is used when user has multiple address */
        else if (scope.existingaddress === undefined) {
            scope.addAddressForm.useraddress.$dirty = true;
            scope.addAddressForm.useraddress.$invalid = true;
            scope.addAddressForm.useraddress.$error.required = true;
            scope.loaderVar = false;
            return false;
        }

        if (scope.sampledate === undefined || scope.sampledate === '') {
            scope.addAddressForm.collectiondate.$dirty = true;
            scope.addAddressForm.collectiondate.$invalid = true;
            scope.addAddressForm.collectiondate.$error.required = true;
            scope.loaderVar = false;
            $analytics.eventTrack('Validation Faliure on Address Form Submit', { category: 'Confirm Address', label: 'Sample Collection Date' });
            focus('sampledate');
            return false;
        } else if (scope.sampletime === undefined || scope.sampletime === '') {
            scope.addAddressForm.collectiontime.$dirty = true;
            scope.addAddressForm.collectiontime.$invalid = true;
            scope.addAddressForm.collectiontime.$error.required = true;
            scope.loaderVar = false;
            $analytics.eventTrack('Validation Faliure on Address Form Submit', { category: 'Confirm Address', label: 'Sample Collection Time' });
            focus('sampletime');
            return false;
        }

        if (!scope.useAddressPresent) {
            scope.userDetail.address.lat = scope.sub_lat;
            scope.userDetail.address.long = scope.sub_long;
            if (scope.postal_code === undefined || scope.postal_code === '') {
                if (scope.postal_code_new !== undefined || scope.postal_code_new !== '') {
                    scope.userDetail.address.pincode = scope.postal_code_new;
                    localStorage.setItem("postal_code", scope.postal_code_new);
                }
            } else {
                scope.userDetail.address.pincode = scope.postal_code;
                localStorage.setItem("postal_code", scope.postal_code);
            }


            if (scope.defaultaddress !== undefined) {
                scope.userDetail.address.defaultaddress = scope.defaultaddress;
            }

            if (scope.noOfAdd === 0) {
                scope.userDetail.address.defaultaddress = true;
            }

            scope.userDetail.address.houseno = scope.houseno;
            scope.userDetail.address.landmark = scope.landmark;

            /* HARD CODE LOCALITY ID */
            scope.userDetail.address.locality_id = scope.locality_id;
            //scope.userDetail.address.location_name = scope.localityObj.location_name;

            scope.city = JSON.parse(localStorage.getItem("cityID"))[0];
            var user = JSON.parse(localStorage.getItem("user"));
            var user_id = user.user_id;

            var stateDetailsURL = ConstConfig.serverUrl + "commonservice/getStateByCityId";
            doPost($http, stateDetailsURL, { "city_id": scope.city.city_id, 'log_user_id':user_id }, token, function(countryData) {
                scope.userDetail.address.state_id = countryData.data[0].state_id;
                scope.userDetail.address.state_name = countryData.data[0].state_name;
                scope.userDetail.address.country_id = countryData.data[0].country_id;
                scope.userDetail.address.country_name = countryData.data[0].country_name;
                scope.userDetail.address.city = scope.city.city_name;
                scope.userDetail.address.city_id = scope.city.city_id;
                scope.userDetail.address.address_id = -1;
                localStorage.setItem("userDetail", JSON.stringify(scope.userDetail));
            });
            localStorage.setItem("houseno", scope.houseno);
            localStorage.setItem("landmark", scope.landmark);
            localStorage.setItem("address", scope.chosenPlace);
        }

        scope.hideContinue = false;
        if(typeof($window.fbq) !== 'undefined') {
            $window.fbq('track', 'Continue to checkout from checkout page', {"slot_id":scope.sampletime.slot_id});
        }
        /* Freeze Slot */
        var freezeSlotUrl = ConstConfig.serverUrl + "commonservice/freezeSlotBySlotId";
        doPost($http, freezeSlotUrl, { "slot_id": scope.sampletime.slot_id, "log_user_id": log_user_id, "source": "web"}, token, function(freezDate) {
            if (freezDate.status == true) {
                localStorage.setItem("time_slot", JSON.stringify(scope.sampletime));
                scope.time_slot = JSON.parse(localStorage.getItem("time_slot"));
                localStorage.setItem("sample_date", scope.sampledate);

                var slotmin = 15;
                scope.bookingTimeTickerDisplay = true;
                scope.bookingTimeTickerExpire = false;
                if(document.getElementById("slotExpireMsg")) {
                    document.getElementById("slotExpireMsg").innerHTML = '';
                    var displaySlotTime = scope.sampletime.start_time + ' - ' + scope.sampletime.end_time;
                    document.getElementById("slotExpireMsg").innerHTML =  'Your selected time slot <b>'+ displaySlotTime +'</b> will expire in 15 minutes.<br>'; 
                }
                
                var countDownDate = new Date(Date.now() + slotmin*60*1000).getTime();                
                scope.clock(countDownDate);
                scope.calculateCovenienceFees();

                scope.loaderVar = false;
                //scope.counter(scope.sampletime.slot_id);
                scope.pickTabActive = false;
                scope.paymentTabActive = true;

                if(scope.cartData.restrict_coupon) {
                    scope.isCouponDisabled = true;
                    scope.isCouponRemoveDisabled = true;
                }

                if(scope.cartData.restrict_hcash) {
                    scope.disabledHcash = true;
                    scope.restrict_hcash_message = scope.cartData.restrict_hcash_message;
                }

                scope.checkPaymentMode();
            }
            else {
                if (freezDate.status === "error") {
                    if(freezDate.code == 'TOKEN_EXPIRED' || freezDate.code == 'INVALID_TOKEN' || freezDate.code == 'AUTH_FAILED') {
                        $rootScope.$broadcast('tokenExpired');
                    }
                }
                if(freezDate.message == 'Slot already freezed.') {
                    scope.slotFreezeError = true;
                    scope.slotFreezeErrorMsg = freezDate.message;

                    scope.getTimeSlots(scope.sampledate);

                    $timeout(function() {
                        scope.slotFreezeError = false;
                    }, 5000);

                }
            }
            
        });
    }

    /* Reset Sub-locality */
    scope.resetSubLocality = function() {
        scope.sublocalityDropDownSelected = false;
        scope.chosenPlace = "";
        scope.locality_id = "";
        scope.slots = [];
        scope.sampledate = undefined
        scope.sampletime = undefined
        if(scope.addAddressForm.collectiondate !== undefined) {
            scope.addAddressForm.collectiondate.$dirty = false;
            //scope.addAddressForm.collectiondate = undefined;
        }
        if(scope.addAddressForm.collectiontime !== undefined) {
            scope.addAddressForm.collectiontime.$dirty = false;
            //scope.addAddressForm.collectiontime = undefined;
        }
        
        focus('pacinput');
    }

    /* Clear Sub locality */
    scope.clearSubLocality = function() {
        scope.chosenPlace = "";
        angular.element("#pacinput").val("");
        scope.slots = [];
        scope.sampledate = undefined
        scope.sampletime = undefined
        if(scope.addAddressForm.collectiondate !== undefined) {
            scope.addAddressForm.collectiondate.$dirty = false;
            //scope.addAddressForm.collectiondate = undefined;
        }
        if(scope.addAddressForm.collectiontime !== undefined) {
            scope.addAddressForm.collectiontime.$dirty = false;
            //scope.addAddressForm.collectiontime = undefined;
        }
        scope.addAddressForm.pacinput.$dirty = false;
    }

    /* Edit Pick Tab */
    scope.editPickTab = function() {
        //scope.pickTabActive = !scope.pickTabActive;
        scope.pickTabActive = true;
        $timeout(function() {
            angular.element("#collapse1").addClass('panel-collapse collapse in');
        }, 100);
        angular.element("#collapse1").addClass('panel-collapse collapse in');
        scope.paymentTabActive = false;

        angular.element('.slider').slick('refresh');
        scope.totalAmount();
    }

    /* Hard Copy  - Start */

    //service call for hardcopy price 
    scope.getHardcopyPrice = function() {
        BookOrderService.getHardcopyPrice(function(data) {
            if (data.status == true) {
                scope.hardcopyPrice = data.data.price;
            }
        });
    };

    scope.getHardcopyPrice();

    scope.hardCopyFunc = function(items) {
            var totalPackageAmount = scope.getTotalPackageWithCouponAmount();
            scope.coupondata.hard_copy = scope.hardCopy;
            if (scope.hardCopy == true) {
                $analytics.eventTrack('Checked Hard Copy', { category: 'Order Summary' });
                $rootScope.hard_copyFlag = true;
                scope.calculateCovenienceFees();
            } else {
                $rootScope.hard_copyFlag = false;
                scope.calculateCovenienceFees();
            }
            localStorage.setItem("coupondata", JSON.stringify(scope.coupondata));
        }
        /* Hard Copy - End */

    /* Coupon Code - Start */
    scope.verifyCoupon = function(coupon) {
        scope.invalidCoupon = false;
        scope.isDisabled=true;
        if (coupon !== undefined && coupon !== '') {
        
            var coupon_package = [];
            var coupon_profile = [];
            var coupon_parameter = [];

            if(scope.cartData.customer_detail.length > 0) {
                scope.cartData.customer_detail.forEach(function(ele, index) {
                    ele.deals.forEach(function(element, ind) {
                        if(element.ptype == 'package') {
                            if(!_.contains(coupon_package, element.id)) {
                                coupon_package.push(element.deal_type_id);
                            } 
                        }

                        if(element.ptype == 'profile') {
                            if(!_.contains(coupon_profile, element.id)) {
                                coupon_profile.push(element.deal_type_id);
                            } 
                        }

                        if(element.ptype == 'parameter') {
                            if(!_.contains(coupon_parameter, element.id)) {
                                coupon_parameter.push(element.deal_type_id);
                            } 
                        }                                           
                    });
                });
            }

            var ftest = {};
            
            if(coupon_package.length > 0) {
                ftest["package"] = coupon_package.join(",");
            }

            if(coupon_profile.length > 0) {
                ftest["profile"] = coupon_profile.join(",");
            }

            if(coupon_parameter.length > 0) {
                ftest["parameter"] = coupon_parameter.join(",");
            }
            
            // Get city id for coupon apply
            var cityList = JSON.parse(localStorage.getItem("cityList"));
            var city_id = '';
            cityList.forEach(function(ele, index) {
                if(ele.city_name === scope.userDetail.address.city) {
                    city_id = ele.city_id;
                }
            });

            /* Total package price with hardcopy exclude convenience fees */
            //var totalPackageWithHardCopyAmount = scope.getTotalPackageWithHardCopyAmount();
            var totalPackageAmount = scope.getTotalPackageAmount();
            var log_user_id = JSON.parse(localStorage.getItem("user")).user_id;

            var cpostdata = {
                "data": {
                    "coupon_code": coupon,
                    "customer_id": scope.userDetail.user_id,
                    "city_id": city_id,
                    "source": "web",
                    "platform": "web",
                    "billing_amount": totalPackageAmount,
                    "no_of_customer": scope.cartData.customer_detail.length,
                    "package": ftest['package'] ? ftest['package'] : '',
                    "profile": ftest['profile'] ? ftest['profile'] : '',
                    "parameter": ftest['parameter'] ? ftest['parameter'] : '',
                    "is_online": scope.payradio == 'cash' ? 0 : 1,
                    "payment_gateway": scope.payradio,
                    "customer_mobile": scope.userDetail.mobile,
                    "customer_email": scope.userDetail.email,
                    "apply_discount":0,
                    "sample_date": scope.sampledate,
                    "user_id": log_user_id
                }
            };

            $http({
                method: "POST",
                url: ConstConfig.couponUrl + "Coupon_engine_api/CouponApply",
                data : cpostdata,
                headers : { 
                    "Content-Type" : "application/x-www-form-urlencoded; charset=utf-8"
                }
            })
            .success(function(coupondata){
                if(coupondata.status) {
                    if (coupondata.data.hasOwnProperty("discount")) {
                        $rootScope.couponCode = coupon;
                        $rootScope.couponAmount = coupondata.data.discount;
                        scope.invalidCoupon = false;
                        scope.onConfirm = true;
                        scope.couponAmount = coupondata.data.discount;
                        scope.coupondata.percentage = scope.couponAmount / totalPackageAmount * 100;
                        scope.coupondata.coupon = coupon;
                        scope.coupondata.discount = coupondata.data.discount;
                        scope.coupondata.applied = true;
                        scope.couponApplied = true;

                        if(coupondata.data.allow_with_wallet == 1) {
                            scope.allow_with_wallet = true;
                        }
                        else {
                            scope.allow_with_wallet = false;
                        }
                        
                        localStorage.setItem("coupondata", JSON.stringify(scope.coupondata));
                        $analytics.eventTrack('Successfully Applied Coupon', { category: 'Make Payment', label: coupon, value: coupondata.data.discount });
                        scope.calculateCovenienceFees();
                    }
                    else {
                        scope.couponApplied = false;
                        scope.coupondata.applied = false;
                        scope.invalidCoupon = true;
                        scope.couponErrorMsg = coupondata.message;//"Invalid coupon";
                        scope.coupon = "";
                        scope.isDisabled=false;
                        $analytics.eventTrack('Failed to Apply Coupon ', { category: 'Make Payment', label: coupon });
                    }
                }
                else {
                    scope.couponApplied = false;
                    scope.coupondata.applied = false;
                    scope.invalidCoupon = true;
                    scope.couponErrorMsg = coupondata.message;//"Invalid coupon";
                    scope.coupon = "";
                    scope.isDisabled=false;
                    $analytics.eventTrack('Failed to Apply Coupon ', { category: 'Make Payment', label: coupon });
                }
            })
            .error(function(){
        
            });
        } else {
            scope.invalidCoupon = true;
            scope.isDisabled=false;
            scope.couponErrorMsg = "Please enter coupon";
        }
    };

    scope.removeCoupon = function() {

            /* Total package price with hardcopy exclude convenience fees */
            scope.coupondata = {};
            scope.coupondata.applied = false;
            scope.coupondata.hard_copy = scope.hardCopy;
            scope.couponShow = false;
            scope.couponApplied = false;
            scope.onConfirm = false;
            $rootScope.couponCode = "";
            $rootScope.couponAmount = "";
            scope.coupon = "";
            scope.isDisabled=false;
            scope.allow_with_wallet = false;
            localStorage.setItem("coupondata", JSON.stringify(scope.coupondata));
            scope.calculateCovenienceFees();
        }
        /* Coupon Code - End */

    scope.calculateCovenienceFees = function() {
        var log_user_id = JSON.parse(localStorage.getItem("user")).user_id;
        var convenienceURL = ConstConfig.couponUrl + "Common_api/getConvenienceFee";
        
        var totalPackageWithHardCopyCouponAmount = scope.getTotalPackageWithHardCopyCouponAmount();

        var conveniencePayload = {
            "data":{
                "city_id": JSON.parse(localStorage.getItem("cityID"))[0].city_id,
                "is_b2c": "1",
                "is_subscription": "0",
                "slot_id": scope.sampletime.slot_id,
                "source": "web",
                "sample_available": "0",
                "orderAmount": totalPackageWithHardCopyCouponAmount,
                "user_id": log_user_id
            }
        };

        doPostWithOutToken($http, convenienceURL, conveniencePayload, "", function(data) {
            if(data.status) {
                if(data.data.convenience_fee) {
                    
                    scope.convenience_fee = parseInt(data.data.convenience_fee);
                    if(scope.convenience_fee) {
                        scope.calculatePrice();
                    }
                }
                else {
                    /* Do some code */
                    scope.convenience_fee = 0;
                    if(scope.convenience_fee == 0) {
                        scope.calculatePrice();
                    }
                }
            }
        });
    }
    /* Booking Creation : - START
        STEP 1 : Create Booking of Pending Status using create order id
        STEP 2 : If Booking Id is created then Submit Payment Form else show error
    */

    /* Make Payment */
    scope.makePayment = function(order_price) {
        scope.showBookingLoader = true;
        localStorage.setItem("type_of_payment", (scope.payradio == 'cash' ? "Cash on delivery" : "Online"));

        /* For Analytics - Payment Mode */
        $analytics.eventTrack('Order Booked Successfully', {
            category: 'Make Payment',
            label: (scope.payradio == 'cash' ? "Cash on delivery" : "Online"),
            value: order_price
        });

        scope.loaderVar = true;
        if (scope.payradio == 'cash') {
            /* Update Payment Type in case of COD */
            /* To Do : Update payment type in non-cod in payment gateway code */
            var codURL = ConstConfig.serverUrl + "commonservice/update_payment_type";
            var codpayload = {
                "booking_id": scope.booking_id,
                "payment_type": (scope.payradio == 'cash' ? "Cash on delivery" : "Online"),
                "term_condition": true,
                "user_id": scope.userDetail.user_id,
                "log_user_id": scope.userDetail.user_id
            }

            doPost($http, codURL, codpayload, "", function(data) {
                scope.loaderVar = false;
                if(data.status) {
                    $state.go('payment-summary', {
                        action:'Get', 
                        booking_id:scope.booking_id, 
                        mobile:scope.userDetail.mobile,
                        user_id:scope.userDetail.user_id
                    });
                }
            });

        } else if (scope.payradio == 'payu') {

            localStorage.setItem("makepayment_to_summary", "true");
            var $form = $('#payuForm');
            $form.find('[name=booking_id]').val(scope.booking_id);
            $form.find('[name=txnAmount]').val(order_price - scope.onlineDiscount);
            $form.find('[name=custName]').val(scope.userDetail.name);
            $form.find('[name=custMobile]').val(scope.userDetail.mobile);
            $form.find('[name=custEmail]').val(scope.userDetail.email);
            $form.find('[name=stm_id]').val(scope.time_slot.slot_id);

            localStorage.removeItem("tempCart");
            localStorage.removeItem("tempPkg");
            localStorage.removeItem("address");
            localStorage.removeItem("amountfinal");
            localStorage.removeItem("coupondata");
            localStorage.removeItem("customerDetails");
            localStorage.removeItem("houseno");
            localStorage.removeItem("landmark");
            localStorage.removeItem("postal_code");
            localStorage.removeItem("sample_date");
            localStorage.removeItem("time_slot");
            localStorage.removeItem("total_amount");
            localStorage.removeItem("type_of_payment");
            localStorage.removeItem("Detailscustomer");

            $form.submit();
        } else if (scope.payradio == 'paytm') {
            localStorage.setItem("makepayment_to_summary", "true");
            var $form = $('#paytmForm');
            $form.find('[name=booking_id]').val(scope.booking_id);
            $form.find('[name=txnAmount]').val(order_price - scope.onlineDiscount);
            $form.find('[name=custName]').val(scope.userDetail.name);
            $form.find('[name=custMobile]').val(scope.userDetail.mobile);
            $form.find('[name=custEmail]').val(scope.userDetail.email);
            $form.find('[name=user_id]').val(scope.userDetail.user_id);
            $form.find('[name=stm_id]').val(scope.time_slot.slot_id);

            localStorage.removeItem("tempCart");
            localStorage.removeItem("tempPkg");
            localStorage.removeItem("address");
            localStorage.removeItem("amountfinal");
            localStorage.removeItem("coupondata");
            localStorage.removeItem("customerDetails");
            localStorage.removeItem("houseno");
            localStorage.removeItem("landmark");
            localStorage.removeItem("postal_code");
            localStorage.removeItem("sample_date");
            localStorage.removeItem("time_slot");
            localStorage.removeItem("total_amount");
            localStorage.removeItem("type_of_payment");
            localStorage.removeItem("Detailscustomer");

            $form.submit();
        } else if (scope.payradio == 'mobikwik') {
            localStorage.setItem("makepayment_to_summary", "true");
            var $form = $('#mobikwikForm');
            $form.find('[name=booking_id]').val(scope.booking_id);
            $form.find('[name=txnAmount]').val(order_price - scope.onlineDiscount);
            $form.find('[name=custName]').val(scope.userDetail.name);
            $form.find('[name=custMobile]').val(scope.userDetail.mobile);
            $form.find('[name=custEmail]').val(scope.userDetail.email);
            $form.find('[name=stm_id]').val(scope.time_slot.slot_id);

            localStorage.removeItem("tempCart");
            localStorage.removeItem("tempPkg");
            localStorage.removeItem("address");
            localStorage.removeItem("amountfinal");
            localStorage.removeItem("coupondata");
            localStorage.removeItem("customerDetails");
            localStorage.removeItem("houseno");
            localStorage.removeItem("landmark");
            localStorage.removeItem("postal_code");
            localStorage.removeItem("sample_date");
            localStorage.removeItem("time_slot");
            localStorage.removeItem("total_amount");
            localStorage.removeItem("type_of_payment");
            localStorage.removeItem("Detailscustomer");
            
            $form.submit();
        } else if (scope.payradio == 'payzapp') {
            localStorage.setItem("makepayment_to_summary", "true");
            var $form = $('#payzappForm');
            $form.find('[name=booking_id]').val(scope.booking_id);
            $form.find('[name=txnAmount]').val(order_price - scope.onlineDiscount);
            $form.find('[name=custName]').val(scope.userDetail.name);
            $form.find('[name=custMobile]').val(scope.userDetail.mobile);
            $form.find('[name=custEmail]').val(scope.userDetail.email);
            $form.find('[name=stm_id]').val(scope.time_slot.slot_id);
            $form.submit();
        }

        scope.hideContinue = false;
    };

    /* Create booking of pending status - called after address verification */
    scope.createOrderId = function() {
        
        /* For Analytics - Payment Mode */
        if(scope.discountamount > 0) {
            $analytics.eventTrack('Make Payment Clicks on Complete Order', {
                category: 'Make Payment',
                label: scope.payradio,
                value: scope.discountamount
            });
        }
        

        scope.showBookingLoader = true;
        var billing_user_id = scope.userDetail.user_id;
        var orderDetail = [];

        if (!scope.useAddressPresent) {
            scope.userDetail.address.sublocality = localStorage.getItem("address");
            var addressDetail = scope.houseno + ',' + scope.landmark + ',' + localStorage.getItem("address");
            scope.userDetail.address.address = addressDetail;
            localStorage.setItem("userDetail", JSON.stringify(scope.userDetail));
        }

        var allTestIds = [];

        var fetchCartURL = ConstConfig.couponUrl + "customer/account/fetch_cart_v2";
        var requestPayloadFetchCart = {
            "data" : {
                "user_id" : billing_user_id,
                "city_id" : JSON.parse(localStorage.getItem("cityID"))[0].city_id,
                "source" : "web"
            }
        };

        doPost($http, fetchCartURL, requestPayloadFetchCart, token, function(data) {
            if(data.status) {
                if(data.status === 'error') {
                    if(data.code == 'TOKEN_EXPIRED' || data.code == 'INVALID_TOKEN' || data.code == 'AUTH_FAILED') {
                        $rootScope.$broadcast('tokenExpired');
                    }
                }
                else {
                    scope.cartData = data.data;
                    if(scope.cartData.customer_detail.length > 0) {
                        scope.cartData.customer_detail.forEach(function(ele, index) {
                            var obj = {};
                            obj.user_id = ele.customer_id;
                            obj.package = [];

                            ele.deals.forEach(function(element, ind) {
                                //for custom package like p_1,p_2
                                var content_ids = element.id.split(",");
                                allTestIds.push.apply(allTestIds,content_ids);

                                obj.package.push({
                                    "tcategory_id": element.id,
                                    "healthians_price": element.healthians_price,
                                    "actaul_price": element.actual_price,
                                });                   
                            });

                            orderDetail.push(obj);
                        });

                        if(typeof($window.fbq) !== 'undefined') {
                            var checkout_data = {
                                "value":scope.discountamount,
                                "content_ids": _.uniq(allTestIds),
                                "content_type": "product",
                                "currency": 'INR',
                                "content_category": "Final Checkout"
                            };
                            if(scope.discountamount > 0) {
                                checkout_data["payment_type"] = scope.payradio
                            }
                            $window.fbq('track', 'InitiateCheckout', checkout_data);
                        }

                        if ($rootScope.hard_copyFlag == true) {
                            var hard_copy = "yes";
                        } else {
                            var hard_copy = "no";
                        }
                        if (localStorage.getItem("isLogin") == 'true') {
                            billing_user_id = JSON.parse(localStorage.getItem("user")).user_id;
                        }

                        var orderBookURL = ConstConfig.serverUrl + "commonservice/bookOrder";
                        var requestData = {
                            "billing_user_id": billing_user_id,
                            "log_user_id": billing_user_id,
                            "hard_copy": hard_copy,
                            "address": scope.userDetail.address,
                            "deal_price": scope.discountamount,
                            "order_detail": orderDetail,
                            "time_slot": scope.sampletime,
                            "coupon": $rootScope.couponCode,
                            "discount": $rootScope.couponAmount,
                            "email": scope.userDetail.email,
                            "webbooking_type": "normal_booking",
                            "booked_from": scope.device,
                            "convenience_fees": scope.convenience_fee,
                            "city_id": JSON.parse(localStorage.getItem("cityID"))[0].city_id,
                            "cart_id": scope.cartData.cart_id.id,
                            "payment_mode": scope.payradio
                        };

                        if(scope.donation) {
                            requestData['donation_amount'] = scope.donationFees;
                        }
                        else {
                            requestData['donation_amount'] = 0;
                        }

                        if(scope.eCashApplied) {
                            requestData['eCashAmount'] = scope.ecashAmount;
                        }
                        else {
                            requestData['eCashAmount'] = 0;
                        }

                        if(scope.onlineDiscountApplied) {
                            requestData['onlineDiscountApplied'] = "yes";
                        }

                        localStorage.setItem("total_amount", scope.discountamount);

                        doPost($http, orderBookURL, requestData, token, function(order_data) {
                            $interval.cancel(x);
                            if (order_data.status == true) {
                                //console.log("order_data",order_data);
                                scope.booking_id = order_data.data.booking_id;

                                if(typeof($window.fbq) !== 'undefined') {
                                    $window.fbq('track', 'Booking : Booking created Successfully', {"booking_id": scope.booking_id});
                                }

                                localStorage.setItem("booking_id", order_data.data.booking_id);

                                if(order_data.data.order_price == 0 && order_data.data.delivery_status == 2) {
                                    localStorage.removeItem("tempCart");
                                    localStorage.removeItem("tempPkg");
                                    localStorage.removeItem("address");
                                    localStorage.removeItem("amountfinal");
                                    localStorage.removeItem("coupondata");
                                    localStorage.removeItem("customerDetails");
                                    localStorage.removeItem("houseno");
                                    localStorage.removeItem("landmark");
                                    localStorage.removeItem("postal_code");
                                    localStorage.removeItem("sample_date");
                                    localStorage.removeItem("time_slot");
                                    localStorage.removeItem("total_amount");
                                    localStorage.removeItem("type_of_payment");
                                    localStorage.removeItem("Detailscustomer");
                                    scope.hideContinue = false;
                                    $state.go('payment-summary', {
                                        action:'Get', 
                                        booking_id: order_data.data.booking_id, 
                                        mobile: scope.userDetail.mobile,
                                        user_id: billing_user_id
                                    });

                                    //scope.payradio = 'cash';
                                    //scope.makePayment(order_data.data.order_price);
                                }
                                else {
                                    scope.makePayment(order_data.data.order_price);
                                }
                            } else {
                                if (order_data.status === "error") {
                                    if(order_data.code == 'TOKEN_EXPIRED' || order_data.code == 'INVALID_TOKEN' || order_data.code == 'AUTH_FAILED') {
                                        $rootScope.$broadcast('tokenExpired');
                                    }
                                }
                                else {
                                    if(typeof order_data.slot_error === "undefined") {
                                        alert(order_data.message);
                                    }
                                    else {
                                        /* Slot Error */
                                        scope.bookingCreationMsg = true;
                                        scope.bookingCreationErrorMessage = order_data.message;
                                        
                                        scope.editPickTab();
                                        scope.sampledate = undefined;
                                        scope.sampletime = undefined;
                                        if(scope.addAddressForm.collectiondate !== undefined) {
                                            scope.addAddressForm.collectiondate.$dirty = false;
                                        }
                                        if(scope.addAddressForm.collectiontime !== undefined) {
                                            scope.addAddressForm.collectiontime.$dirty = false;
                                        }
                                    }
                                    
                                }
                                scope.showBookingLoader = false;  
                            }
                        });
                    }                    
                }                
            }
            else {
                $state.go('orderbook');
            }
        });
    };

    /* Booking Creation : END */

    /* Handle Refresh Page - Start 
    var houseno = localStorage.getItem("houseno");
    if (houseno !== null) {
        scope.houseno = houseno;
    }

    var landmark = localStorage.getItem("landmark");
    if (landmark !== null) {
        scope.landmark = landmark;
    }
    /* Handle Refresh Page - End */

    scope.getLocalityUsingLatLong = function() {
        $rootScope.$broadcast('cityDropdownRefresh');
        scope.sampledate = undefined;
        scope.sampletime = undefined;
        
        if(scope.addAddressForm.collectiondate !== undefined) {
            scope.addAddressForm.collectiondate.$dirty = false;
            //scope.addAddressForm.collectiondate = undefined;
        }
        if(scope.addAddressForm.collectiontime !== undefined) {
            scope.addAddressForm.collectiontime.$dirty = false;
            //scope.addAddressForm.collectiontime = undefined;
        }

        var getLocalityURL = ConstConfig.serverUrl + "commonservice/getnearestlocality";
        var requestData = {
            "lat": scope.sub_lat,
            "long": scope.sub_long,
            "log_user_id": JSON.parse(localStorage.getItem("user")).user_id
        };

        doPost($http, getLocalityURL, requestData, token, function(response) {
            if (response.status == true) {
                scope.locality_id = response.data.locality_id;
            } else {
                if (response.status === "error") {
                    if(response.code == 'TOKEN_EXPIRED' || response.code == 'INVALID_TOKEN' || response.code == 'AUTH_FAILED') {
                        $rootScope.$broadcast('tokenExpired');
                    }
                }
                else {
                    scope.distanceError = true;
                    scope.sublocalityDropDownSelected = false;
                    scope.distanceErrorMsg = response.message;
                    scope.chosenPlace = "";
                    scope.addAddressForm.pacinput.$dirty = false;
                    scope.locality_id = "";
                }
            }
        });
    }

    scope.editbooking = function() {
        dataShare.sendData(scope.customerDetails);
    };

    scope.myFunction = function(val) {
        document.getElementById('pacinput').value = val;
        document.getElementById('pacinput').focus();
        scope.chosenPlace = val;
    }

    function MyCtrl(scope) {
        scope.gPlace;
    }

    scope.breakpoints = [{
        breakpoint: 768,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1
        }
    }, {
        breakpoint: 480,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1
        }
    }];

    /* Wallet Code */
    scope.showEcashdiv = false;
    scope.walletAmount = 0;

    scope.getWalletCashInfo = function(){
        var getWalletCashInfoURL = ConstConfig.couponUrl + "wallet_api/getuserWebWallet";
        
        var log_user_id = JSON.parse(localStorage.getItem("user")).user_id;      
        var walletPayLoad = {
            "data":{
                "source": "web",
                "user_id": log_user_id
            }
        };

        $http({
            method: "POST",
            url: getWalletCashInfoURL,
            data : walletPayLoad,
            headers : { 
                "Content-Type" : "application/x-www-form-urlencoded; charset=utf-8"
            }
        })
        .success(function(data){
            if(data.status) {
                if(data.data.walletPoint) {
                    scope.walletAmount = parseInt(data.data.walletPoint);
                    // For e-Cash / Wallet
                    scope.wallet_max_used_point = parseInt(data.data.max_used_point);
                }
                if(data.data.walletTnC) {
                    scope.walletTC = data.data.walletTnC;
                }
            }
            else {
                scope.walletAmount = 0;
            }
        })
        .error(function(){
            scope.walletAmount = 0;
        });
    }

    scope.getWalletCashInfo();


    scope.showECash = function() {
        if(scope.ecashcheck) {
            
            /* Coupon Check */
            var couponDataInfo = JSON.parse(localStorage.getItem("coupondata"));
            if(couponDataInfo !== null) {
                if(typeof couponDataInfo.coupon !== 'undefined') {
                    if(couponDataInfo.coupon) {
                        if(scope.allow_with_wallet) {
                            //its Ok       
                        }
                        else {
                            scope.ecashcheck = false;
                            alert("You can not use e-Cash with this coupon.");
                            return false;
                        }
                    }
                }
            }
            scope.verifyECash();
        }
        else {
            // Enable hard copy and Coupon
            scope.isCouponDisabled = false;
            scope.isHardCopyDisabled = false;
            scope.isCouponRemoveDisabled = false;
            scope.showEcashdiv = false;
            scope.removeECash();
        }    
    }

    scope.eCashCouponCheck = false;
    scope.eCashApplied = false;

    scope.verifyECash = function() {
        var orderpricewithoutDonation = scope.getTotalPackageWithHardCopyCouponConvenienceAmount();
        scope.ecashAmount = parseInt(scope.ecashAmount);

        if(scope.walletAmount>0) {
            if(scope.wallet_max_used_point >= orderpricewithoutDonation) {
                if(orderpricewithoutDonation >= scope.walletAmount) {
                    if(scope.walletAmount >= scope.wallet_max_used_point) {
                        scope.ecashAmount = scope.wallet_max_used_point;
                    }
                    else {
                        scope.ecashAmount = scope.walletAmount;
                    }             
                }
                else {
                    scope.ecashAmount = orderpricewithoutDonation;
                }
            }
            else {
                if(scope.walletAmount >= scope.wallet_max_used_point) {
                    scope.ecashAmount = scope.wallet_max_used_point;
                }
                else {
                    scope.ecashAmount = scope.walletAmount;
                }
            }
        } else {
            scope.ecashcheck = false;
            alert("Insufficient Balance");
            return false;
        }     


        if(scope.ecashAmount == '' || typeof scope.ecashAmount == 'undefined') {
            //case 1 : Check Amount is not equal to or less than 0
            alert("Please enter HCash Amount");
            angular.element("#ecash_amount").focus();
            return false;
        }
        else if(!Number.isInteger(parseInt(scope.ecashAmount))) {
            //case 1 : Check Amount is not equal to or less than 0
            alert("Please enter HCash Amount in Numeric");
            scope.ecashAmount = '';
            angular.element("#ecash_amount").focus();
            return false;
        }        
        else if(parseInt(scope.ecashAmount) <= 0) {
            //case 1 : Check Amount is not equal to or less than 0
            alert("Entered HCash Amount must be greater than 0");
            scope.ecashAmount = '';
            angular.element("#ecash_amount").focus();
            return false;
        }
        else if(parseInt(scope.ecashAmount)>scope.wallet_max_used_point) {
            var ecasherror = "You can use only maximum Rs."+scope.wallet_max_used_point+" HCash in a booking.";
            alert(ecasherror);
            return false;
        }
        else if(parseInt(scope.ecashAmount)>scope.walletAmount) {
            //case 2 : Check Amount is not greater than wallet amount
            alert("Entered HCash Amount should not be greater than Wallet available amount.");
            return false;
        }
        else if(parseInt(scope.ecashAmount)>orderpricewithoutDonation) {
            //case 3 : Check Amount is not greater than order price without Donation
            alert("Entered HCash Amount should not be greater than Sub-total Amount");
            return false;
        }
        //You can use only maximumm 100 e-Cash in a booking 
        
        var couponDataInfo = JSON.parse(localStorage.getItem("coupondata"));

        if(couponDataInfo !== null) {
            /* Coupon Calculation */
            if(typeof couponDataInfo.coupon !== 'undefined') {
                if(couponDataInfo.coupon) {
                    if(scope.allow_with_wallet) {
                        scope.eCashCouponCheck = true;
                    }
                    else {
                        scope.eCashCouponCheck = false;
                        alert("You can not use HCash with this coupon.");
                        return false;
                    }
                }
                else {
                    scope.eCashCouponCheck = true;
                }
            }
            else {
                scope.eCashCouponCheck = true;
            }
        }
        

        if(scope.eCashCouponCheck){
            // Now apply E-Cash
            // Disable hard copy and Coupon
            scope.isCouponDisabled = true;
            scope.isCouponRemoveDisabled = true;
            scope.isHardCopyDisabled = true;
            scope.showEcashdiv = true;

            scope.eCashApplied = true;
            scope.isECashDisabled = true;
            scope.onConfirmECash = true;
            scope.calculatePrice();
        }
    }

    scope.removeECash = function() {
        // Remove E-Cash
        scope.eCashApplied = false;
        scope.isECashDisabled = false;
        scope.onConfirmECash = false;
        scope.ecashAmount = '';
        scope.calculatePrice();
    }

    scope.totalAmount = function() {
        scope.amount = scope.cartTotalAmount;
        
        scope.hardCopy = false;
        $rootScope.hard_copyFlag = false;

        scope.discountamount = scope.amount;
        scope.coupondata = {};
        scope.coupondata.applied = false;
        scope.couponShow = false;
        scope.couponApplied = false;
        scope.onConfirm = false;
        $rootScope.couponCode = "";
        $rootScope.couponAmount = "";
        scope.coupon = "";
        scope.isDisabled=false;
        
        localStorage.setItem("coupondata", JSON.stringify(scope.coupondata));
    };

    scope.getTotalPackageAmount = function() {
        scope.amount = scope.cartTotalAmount;                        
        return scope.amount;
    };

    scope.getTotalPackageWithCouponAmount = function() {
        scope.amount = scope.cartTotalAmount;
        
        var couponDataInfo = JSON.parse(localStorage.getItem("coupondata"));

        if(couponDataInfo !== null) {
            if(typeof couponDataInfo.coupon !== 'undefined') {
                if(couponDataInfo.coupon) {
                    scope.amount = scope.amount - parseInt(couponDataInfo.discount);
                }
            }  
        }              
                        
        return scope.amount;
    };

    scope.getTotalPackageWithHardCopyAmount = function() {
        scope.amount = scope.cartTotalAmount;
        
        if (scope.hardCopy == true) {
            scope.amount = scope.amount + parseInt(scope.hardcopyPrice);
        }
                        
        return scope.amount;
    };

    scope.getTotalPackageWithHardCopyCouponAmount = function() {
        scope.amount = scope.cartTotalAmount;
    
        if (scope.hardCopy == true) {
            scope.amount = scope.amount + parseInt(scope.hardcopyPrice);
        }

        var couponDataInfo = JSON.parse(localStorage.getItem("coupondata"));

        if(couponDataInfo !== null) {
            if(typeof couponDataInfo.coupon !== 'undefined') {
                if(couponDataInfo.coupon) {
                    scope.amount = scope.amount - parseInt(couponDataInfo.discount);
                }
            }
        }      
                        
        return scope.amount;
    };

    if(scope.discountamount === null) {
        //scope.totalAmount();
    }
    else {
        //scope.totalAmount();
    }

    if(scope.customerDetails === null) {
        //$state.go("home");
    }
    else {
        var previous_booking_id = localStorage.getItem("booking_id");
        if(previous_booking_id !== null) {
            if (localStorage.getItem("isLogin") == 'true') {
                var user = JSON.parse(localStorage.getItem("user"));
                $state.go('makepayment', {
                    action:'Get', 
                    booking_id: previous_booking_id, 
                    mobile: user.mobile
                });
            }
        }
    }


    var cityList = localStorage.getItem("cityList");
    if(cityList === null) {
        HomeService.getCityDetail(function(data) {
            if (data.status == 'success') {
                scope.cityList = data.data;
                localStorage.setItem("cityList", JSON.stringify(scope.cityList));
            }
        });
    }

    scope.$on('changeCityDropown', function(event, data) {
        var user = JSON.parse(localStorage.getItem("user"));
        var user_id = user.user_id;
        scope.getAddressesByUserId(user_id);
    });

    scope.convenience_fees_visible = false;
    scope.showConvenienceFeesDialog = function() {
        scope.convenience_fees_visible = true;
    }

    scope.applyDonation = function() {
        if(scope.donation) {
            scope.calculatePrice();
        }
        else {
            scope.calculatePrice();
        }
    }

    scope.calculatePrice = function() {
        scope.amount = parseInt(scope.cartTotalAmount);
        
        /* Hardcopy Calculation */
        if (scope.hardCopy == true) {
            scope.amount = scope.amount + parseInt(scope.hardcopyPrice);
        }

        var couponDataInfo = JSON.parse(localStorage.getItem("coupondata"));

        /* Coupon Calculation */
        if(couponDataInfo !== null) {
            if(typeof couponDataInfo.coupon !== 'undefined') {
                if(couponDataInfo.coupon) {
                    scope.amount = scope.amount - parseInt(couponDataInfo.discount);
                }
            }
        }

        scope.amount += parseInt(scope.convenience_fee);

        scope.subTotal = scope.amount;

        if(scope.eCashApplied) {
            scope.amount -= parseInt(scope.ecashAmount);
        }

        if(scope.onlineDiscountApplicable) {
            if(scope.amount  >= scope.online_discount_mimimum_amount) {
                scope.amount -=  scope.online_discount_amount;
                scope.onlineDiscountApplied = true;
            }
        }

        if(scope.amount < 0) {
            scope.amount = 0;
        }

        /* Donation Calculation */
        if(scope.donation) {
            scope.amount = scope.amount + parseInt(scope.donationFees);
        }

        scope.discountamount = scope.amount;
        localStorage.setItem("total_amount", scope.discountamount);
        
    };

    scope.getTotalPackageWithHardCopyCouponConvenienceAmount = function() {
        scope.amount = scope.cartTotalAmount;
 
        /* Hardcopy Calculation */
        if (scope.hardCopy == true) {
            scope.amount = scope.amount + parseInt(scope.hardcopyPrice);
        }

        var couponDataInfo = JSON.parse(localStorage.getItem("coupondata"));

        /* Coupon Calculation */
        if(couponDataInfo !== null) {
            if(typeof couponDataInfo.coupon !== 'undefined') {
                if(couponDataInfo.coupon) {
                    scope.amount = scope.amount - parseInt(couponDataInfo.discount);
                }
            }
        }

        scope.amount += parseInt(scope.convenience_fee);

        return scope.amount;        
    };

    scope.youwecan_visible = false;
    scope.showYuvWeCan = function() {
        scope.youwecan_visible = true;
    }

    scope.hcash_message_visible = false;
    scope.showHCashTC = function() {
        scope.hcash_message_visible = true;
    }

    scope.checkPaymentMode = function() {
        if(scope.payradio !== 'cash') {
            if(scope.onlineDiscountActive) {
                scope.onlineDiscountApplicable = true;
            }
            else {
                scope.onlineDiscountApplicable = false;
                scope.onlineDiscountApplied = false;
            }
        }
        else {
            scope.onlineDiscountApplicable = false;
            scope.onlineDiscountApplied = false;
        }
        scope.calculatePrice();
    }

    //scope.subTotal = scope.getTotalPackageWithHardCopyCouponConvenienceAmount();
}
