App.controller('servicePaymentSummaryController', servicePaymentSummaryController);
servicePaymentSummaryController.$inject = ['$scope', '$localStorage', '$sessionStorage', '$timeout', '$rootScope', '$location','$http', '$state', '$stateParams', '$window', '$analytics', 'ConstConfig'];
function servicePaymentSummaryController(scope, $localStorage, $sessionStorage, $timeout, $rootScope, $location ,$http ,$state ,$stateParams, $window, $analytics, ConstConfig) {
 

	scope.stateParms = $stateParams ; 
    $rootScope.meta_robots = "noindex, nofollow";

    scope.getPaymentSummaryDetails = function () {
    	
        var requestPayload = {
            "service_booking_id" : $location.search().service_booking_id,
            "user_mobile" : $location.search().mobile
        }

        var apiURL = ConstConfig.paymentUrl + "service/healthians_service/get_service_detail_for_payment";
        
        doPostWithOutToken($http,apiURL,requestPayload,"",function(data){
            if (data.status == true) {
                scope.payment_data =  data.data;
                scope.total_received_amount = 0;

                if(scope.payment_data.payment_details.length > 0) {
                    scope.payment_data.payment_details.forEach(function(ele, index) {
                        scope.total_received_amount += parseInt(ele.recieved_amount);
                    });                      
                }


                localStorage.removeItem("service_booking_id");
                localStorage.removeItem("service_mobile");
            }
            else {
                scope.payment_api_error = true;
            }
        });
    };

    if($location.search().service_booking_id && $location.search().mobile) {
    	scope.getPaymentSummaryDetails();
    }
 }