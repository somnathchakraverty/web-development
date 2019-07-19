App.controller('referralController', referralController);
referralController.$inject = ['$scope', '$timeout', '$rootScope', '$location', '$http', '$stateParams', 'ConstConfig', '$analytics'];

function referralController(scope, $timeout, $rootScope, $location, $http, $stateParams, ConstConfig, $analytics) {

    scope.stateParms = $stateParams;
    var token = localStorage.getItem("token");
    $rootScope.meta_robots = "noindex, nofollow";

    if (scope.stateParms) {
        scope.user_id = scope.stateParms.user_id;
        
        // GET referral code using user id
        var referralURL = ConstConfig.couponUrl + "customer/account/getReferList_v2";
        var requestPayload = {
            "data": {
                "user_id": scope.user_id,
                "platform": "web",
                "source": "web"
            }
        }        

        $http({
            method: "POST",
            url: referralURL,
            data: requestPayload,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                "X-API-TOKEN" : token
            }
        }).success(function(data) {
            if(data.status){
                scope.total_refer_amount = 1299;
                scope.referral_code = data.data.referCode;
                scope.earn_amount = data.data.earnAmount;
                scope.appTerm = data.data.appTerm;
                scope.sharingtext = "A preventive test in 90 day keeps a doctor away! Happy to share "+data.data.refererPercentAmount+" coupon "+ scope.referral_code +" for booking your health checkup with Healthians.com Call "+$rootScope.companyphone.display_no;
            }
        });

        if(scope.user_id) {
            // SEND referral code in SMS
            var sendSMSURL = ConstConfig.serverUrl + "commonservice/send_referral_sms?user_id="+scope.user_id;

            setTimeout(function() {
                doPostWithOutToken($http,ConstConfig.serverUrl + "commonservice/send_referral_sms", { "user_id": scope.user_id }, "", function(data) {
                   
                });
            },300);
        }
    }
}


App.controller('bookingVerificationController', bookingVerificationController);
bookingVerificationController.$inject = ['$scope', '$timeout', '$rootScope', '$location', '$http', '$stateParams', 'ConstConfig', '$analytics', '$window'];

function bookingVerificationController(scope, $timeout, $rootScope, $location, $http, $stateParams, ConstConfig, $analytics, $window) {

    scope.stateParms = $stateParams;
    $rootScope.meta_robots = "noindex, nofollow";

    if (scope.stateParms) {
        scope.booking_id = scope.stateParms.booking_id;
        scope.mobile = scope.stateParms.mobile;
        
        if(scope.booking_id && scope.mobile) {
            var verifyURL = ConstConfig.couponUrl + "webv1/web_api/booking_verification";
            var requestPayload = {
                "data": {
                    "booking_id": scope.booking_id,
                    "mobile": scope.mobile,
                    "source": "web"
                }
            }

            doPostWithOutToken($http, verifyURL, requestPayload, "", function(data) {
                $window.scrollTo(0, 0);
                if (data.status) {
                    scope.message = data.message;
                } else {
                    scope.message = data.message;
                }
            });
        }
        else {
            $window.location.href = "/";
        }        
    }
}


App.controller('phleboRouteController', phleboRouteController);
phleboRouteController.$inject = ['$scope', '$timeout', '$rootScope', '$location', '$http', '$stateParams', 'ConstConfig', '$analytics', '$window'];

function phleboRouteController(scope, $timeout, $rootScope, $location, $http, $stateParams, ConstConfig, $analytics, $window) {

    scope.stateParms = $stateParams;
    $rootScope.meta_robots = "noindex, nofollow";

    scope.callToPhlebo = function() {
        if (scope.stateParms) {
            scope.booking_id = scope.stateParms.booking_id;
            scope.user_id = scope.stateParms.user_id;
            
            if(scope.booking_id && scope.user_id) {
                var verifyURL = ConstConfig.couponUrl + "webv1/web_api/callToPhlebo";
                var requestPayload = {
                    "data": {
                        "booking_id": scope.booking_id,
                        "user_id": scope.user_id,
                        "source": "web"
                    }
                }

                if(localStorage.getItem("guid")) {
                    requestPayload['data']['guid'] = localStorage.getItem("guid");
                }

                doPostWithOutToken($http, verifyURL, requestPayload, "", function(data) {
                    if(data) {
                        if (data.status) {
                            scope.compaignmsg = true;
                            scope.message = "<h6>You are getting connected to your assigned phlebo.</h6> <p> You will receive a callback in a few minutes.</p>";
                        } else {
                            scope.compaignmsg = true;
                            scope.message = "<h6>There must be issue with the operator.</h6> <p> Our phlebo will connect you shortly.</p>";
                        }
                    }
                    else {
                        scope.compaignmsg = true;
                        scope.message = "<h6>There must be issue with the operator.</h6> <p> Our phlebo will connect you shortly.</p>";
                    }

                    $timeout(function() {
                        scope.compaignmsg = false;
                    }, 15000);

                });
            }
            else {
                $window.location.href = "/";
            }        
        }
    }

}