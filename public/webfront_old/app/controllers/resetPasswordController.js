App.controller('resetPasswordController', resetPasswordController);
resetPasswordController.$inject = ['$scope','$rootScope','focus', 'HomeService','$http','$location','searchDetail','$timeout','dataShare','$localStorage','$sessionStorage', '$q', '$stateParams', 'ConstConfig'];
function resetPasswordController (scope,$rootScope,focus,HomeService,$http,$location,searchDetail,$timeout,dataShare,$localStorage,$sessionStorage,$q,$stateParams,ConstConfig) {
    scope.passwordnotmatched = false;
    scope.resetSucess = false;
    scope.userHash = $stateParams;
    scope.linkexpired = false;
    //console.log(scope.userId);

// call for reset password
    scope.reset = function () {
        scope.resetPwdFormSubmitted = false;
        if (scope.resetPwdForm.userPwd === undefined || scope.resetPwdForm.userPwd === '') {
            scope.resetPwdForm.userpwd.$dirty = true;
            scope.resetPwdForm.userpwd.$invalid = true;
            scope.resetPwdForm.userpwd.$error.required = true;
            focus('userpwd');
            return false;
        } else if (scope.resetPwdForm.userConfmPwd === undefined || scope.resetPwdForm.userConfmPwd === '') {
            scope.resetPwdForm.userconfmpwd.$dirty = true;
            scope.resetPwdForm.userconfmpwd.$invalid = true;
            scope.resetPwdForm.userconfmpwd.$error.required = true;
            focus('userconfmpwd');
            return false;
        }

        if (scope.resetPwdForm.userPwd !== scope.resetPwdForm.userConfmPwd) {
            scope.passwordnotmatched = true;
        } else if (scope.resetPwdForm.userPwd === scope.resetPwdForm.userConfmPwd) {
            scope.passwordnotmatched = false;
            
            //var opts = {user_id: scope.userId, password: scope.resetPwdForm.userPwd};
            doPostJson($http,ConstConfig.serverUrl + "commonservice/resetPassword",{"hash" : scope.userHash.id, "password" : scope.resetPwdForm.userPwd}, "",function(data){
                if (data.status == true){
                    scope.resetSucess = true;
                } else {
                    scope.linkexpired = true;
                    scope.errorMsg = data.message;
                }
            });
        }
    };

    scope.showLoginForm = function() {
        localStorage.setItem("showLoginDialog", "true");
        $location.path('/');
    };   
};

App.controller('paymentFailController', paymentFailController);

paymentFailController.$inject = ['$scope', '$rootScope', '$location', '$state' , 'cartService'];

function paymentFailController(scope, $rootScope, $location, $state, cartService) {
    var booking_id = localStorage.getItem("booking_id");
    var mobile = "";
    if(localStorage.getItem("userDetail") !== null) {
        mobile = JSON.parse(localStorage.getItem("userDetail")).mobile;
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
    } 

    if (localStorage.getItem("isLogin") == 'true') {
        var user = JSON.parse(localStorage.getItem("user"));
        mobile = user.mobile;
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
    }

    cartService.setSelectedPatient('', '');
    localStorage.removeItem("tempCart");
    localStorage.removeItem("tempPkg");

    scope.tryAgain = function() {
        $state.go('makepayment', {
            action:'Get', 
            booking_id:booking_id, 
            mobile:mobile
        });
    }
   
}

App.controller('subscriptionPaymentFailController', subscriptionPaymentFailController);

subscriptionPaymentFailController.$inject = ['$scope', '$rootScope', '$location', '$state' , 'cartService'];

function subscriptionPaymentFailController(scope, $rootScope, $location, $state, cartService) {

    scope.tryAgain = function() {
        if(localStorage.getItem("subscription_id") !== null && localStorage.getItem("subscription_mobile") !== null) {
            var subscription_id = localStorage.getItem("subscription_id");
            var mobile = localStorage.getItem("subscription_mobile");
            
        
            $state.go('makepayment', {
                action:'Get', 
                subscription_id:subscription_id,
                mobile:mobile,
                source: 'crm',
                payment_type_source: 'subscription'
            });
        }
    };
}

App.controller('servicePaymentFailController', servicePaymentFailController);

servicePaymentFailController.$inject = ['$scope', '$rootScope', '$location', '$state' , 'cartService'];

function servicePaymentFailController(scope, $rootScope, $location, $state, cartService) {

    scope.tryAgain = function() {
        if(localStorage.getItem("service_booking_id") !== null && localStorage.getItem("service_mobile") !== null) {
            var service_booking_id = localStorage.getItem("service_booking_id");
            var mobile = localStorage.getItem("service_mobile");
            
        
            $state.go('makepayment', {
                action:'Get', 
                'mobile':mobile,
                'service_booking_id':service_booking_id,
                'payment_type_source': 'service'
            });
        }
    };
}

App.controller('bookingServicePaymentFailController', bookingServicePaymentFailController);

bookingServicePaymentFailController.$inject = ['$scope', '$rootScope', '$location', '$state' , 'cartService'];

function bookingServicePaymentFailController(scope, $rootScope, $location, $state, cartService) {

    scope.tryAgain = function() {
        if(localStorage.getItem("booking_id") !== null && localStorage.getItem("service_booking_id") !== null && localStorage.getItem("service_mobile") !== null) {
            var service_booking_id = localStorage.getItem("service_booking_id");
            var mobile = localStorage.getItem("service_mobile");
            var booking_id = localStorage.getItem("booking_id");
        
            $state.go('makebookingservicepayment', {
                action:'Get', 
                'booking_id':booking_id,
                'mobile':mobile,
                'service_booking_id':service_booking_id
            });
        }
    };
}