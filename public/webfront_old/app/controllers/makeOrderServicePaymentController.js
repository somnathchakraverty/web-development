App.controller('makeOrderServicePaymentController', makeOrderServicePaymentController);
makeOrderServicePaymentController.$inject = ['$scope', 'dataShare','dataShare1', '$localStorage', '$sessionStorage', '$timeout', '$rootScope', '$location','$http', '$q', 'BookOrderService', '$state', '$stateParams','ConstConfig','$sce'];
function makeOrderServicePaymentController (scope, dataShare,dataShare1, $localStorage, $sessionStorage, $timeout, $rootScope, $location ,$http ,$q ,BookOrderService ,$state ,$stateParams,ConstConfig,$sce) {
 	scope.detail = {};
    scope.error = false;
    
    //scope.date = new Date();
    scope.coupondata = {} ;
    scope.coupondata.applied = false;
    scope.coupondata.hard_copy = false;
    scope.termsCondition = true;
    scope.termError = false;
    scope.payradio = "paytm";
    $rootScope.meta_robots = "noindex, nofollow";

    scope.onlineDiscount = 0;
    scope.service_amount = 0;
    scope.payatcollection = 0;
    scope.total_booking_service_amount = 0;

    var paymentUrl = ConstConfig.paymentUrl;
    scope.payuAction = $sce.trustAsResourceUrl(paymentUrl+'payupayment');
    scope.mobikwikAction = $sce.trustAsResourceUrl(paymentUrl+'mobikwikpayment');
    scope.payzappAction = $sce.trustAsResourceUrl(paymentUrl+'payzapppayment');
    scope.paytmAction = $sce.trustAsResourceUrl(paymentUrl+'paytmpayment');

    scope.getBookingServiceDetails = function(booking_id, mobile, service_booking_id) {
        
        var requestPayload = {
            "service_booking_id" : service_booking_id,
            "mobile" : mobile,
            "order_id" : booking_id
        }

        localStorage.setItem("booking_service_mobile", mobile);
        
        var apiURL = ConstConfig.paymentUrl + "webv1/commonservice/get_booking_service_detail_for_payment";
        doPostWithOutToken($http,apiURL,requestPayload,"",function(data){
            if (data.status == true) {
                scope.detail = data.data;
                scope.payatcollection = scope.detail.payatcollection;

                if(scope.detail.service_details) {
                    var total_service_received_amount = 0;
                    if(scope.detail.service_details.payment_details) {
                        scope.detail.service_details.payment_details.forEach(function(ele,index){
                            total_service_received_amount += parseInt(ele.recieved_amount);
                        });

                        scope.service_amount = scope.detail.service_details.order_price - total_service_received_amount;
                    }                    
                }

                scope.total_booking_service_amount = scope.payatcollection + scope.service_amount; 
            }
            else {
                $state.go('home');
            }
        });
    };

    if ($location.search().booking_id && $location.search().service_booking_id && $location.search().mobile){
        scope.booking_id = $location.search().booking_id;
        scope.mobile = $location.search().mobile; 
        scope.service_booking_id = $location.search().service_booking_id;
        scope.getBookingServiceDetails(scope.booking_id, scope.mobile, scope.service_booking_id);
    }
    else {
       $state.go('home');
    }

    scope.termsConditionCheck = function () {
        scope.termsCondition == true;
        scope.termError = false;
    };
    
    scope.makeBookingServiceFinalPayment = function() {
        if (scope.termsCondition === undefined || scope.termsCondition === false) {
            scope.termError = true;
            focus('userterms');
            return false;
        }

        if(scope.payradio == 'payu') {            
            var $form = $('#paymentForm');
            $form.find('[name=booking_id]').val(scope.booking_id);
            $form.find('[name=service_booking_id]').val(scope.service_booking_id);
            $form.find('[name=txnAmount]').val(scope.total_booking_service_amount);
            $form.find('[name=custMobile]').val(scope.mobile);               
            $form.submit();   
        }

        if(scope.payradio == 'mobikwik') {            
            var $form = $('#paymentForm3');
            $form.find('[name=booking_id]').val(scope.booking_id);
            $form.find('[name=service_booking_id]').val(scope.service_booking_id);
            $form.find('[name=txnAmount]').val(scope.total_booking_service_amount);
            $form.find('[name=custMobile]').val(scope.mobile);
        
            $form.submit();
        }

        if(scope.payradio == 'paytm') {            
            var $form = $('#paymentForm2');
            $form.find('[name=booking_id]').val(scope.booking_id);
            $form.find('[name=service_booking_id]').val(scope.service_booking_id);
            $form.find('[name=txnAmount]').val(scope.total_booking_service_amount);
            $form.find('[name=custMobile]').val(scope.mobile);

            $form.submit();
        }

    }
 }


App.controller('orderServicePaymentSummaryController', orderServicePaymentSummaryController);
orderServicePaymentSummaryController.$inject = ['$scope', 'dataShare','dataShare1', '$localStorage', '$sessionStorage', '$timeout', '$rootScope', '$location','$http', '$q', 'BookOrderService', '$state', '$stateParams','ConstConfig','$sce', '$stateParams'];
function orderServicePaymentSummaryController (scope, dataShare,dataShare1, $localStorage, $sessionStorage, $timeout, $rootScope, $location ,$http ,$q ,BookOrderService ,$state ,$stateParams,ConstConfig,$sce,$stateParams) {
    scope.detail = {};
    scope.error = false;

    scope.stateParms = $stateParams;
    $rootScope.meta_robots = "noindex, nofollow"; 

    scope.service_amount = 0;
    scope.payatcollection = 0;
    scope.total_booking_service_amount = 0;

    scope.stringToInt = function(val) {   
        return parseInt(val);scope.stateParms = $stateParams ; 
    }

    //service call for hardcopy price 
    scope.getHardcopyPrice = function () {
        BookOrderService.getHardcopyPrice (function (data) {
            if (data.status == true) {
                scope.hardcopyPrice = data.data.price;
            }
        });
    };

    scope.getHardcopyPrice();

    var gateway_map = {
        "paytm_gateway": "PayTm",
        "payu_gateway": "PayU",
        "paytmqr": "Paytm QR",
        "mosambee": "Mosambee",
        "mobikwik_gateway": "Mobikwik",
        "payu" : "PayU",
        "Cash" : "Cash"
    }

    scope.getBookingServiceDetails = function(booking_id, mobile, service_booking_id) {
        
        var requestPayload = {
            "service_booking_id" : service_booking_id,
            "mobile" : mobile,
            "order_id" : booking_id
        }
        
        var apiURL = ConstConfig.paymentUrl + "webv1/commonservice/get_booking_service_detail_for_payment";
        doPostWithOutToken($http,apiURL,requestPayload,"",function(data){
            if (data.status == true) {
                scope.payment_data = data.data;
                var total_service_received_amount = 0;
                var total_booking_received_amount = 0;

                if(scope.payment_data.service_details) {                    
                    if(scope.payment_data.service_details.payment_details) {
                        scope.payment_data.service_details.payment_details.forEach(function(ele,index){
                            total_service_received_amount += parseInt(ele.recieved_amount);
                        });
                    }                    
                }

                if(scope.payment_data.payment_details) {
                    if(scope.payment_data.payment_details) {
                        scope.payment_data.payment_details.forEach(function(ele,index){
                            total_booking_received_amount += parseInt(ele.recieved_amount);
                        });
                    }                    
                }

                scope.total_booking_service_amount = total_booking_received_amount + total_service_received_amount; 
                scope.total_booking_service_order_price = parseInt(scope.payment_data.order_price) + parseInt(scope.payment_data.service_details.order_price);
            }
            else {
                scope.error = true;
                scope.payment_api_error = true;
                scope.errorMsg = data.message;
            }
        });
    };

    if ($location.search().booking_id && $location.search().service_booking_id){
        scope.booking_id = $location.search().booking_id;
        scope.service_booking_id = $location.search().service_booking_id;

        if($location.search().mobile) {
            scope.mobile = $location.search().mobile;
            localStorage.removeItem("booking_service_mobile");
        }
        else {
            if(localStorage.getItem("booking_service_mobile") !== null) {
                scope.mobile = localStorage.getItem("booking_service_mobile");
            }
        }

        scope.getBookingServiceDetails(scope.booking_id, scope.mobile, scope.service_booking_id);
    }
    else {
       $state.go('home');
    }


 }