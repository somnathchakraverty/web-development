App.controller('subscriptionPaymentSummaryController', subscriptionPaymentSummaryController);
subscriptionPaymentSummaryController.$inject = ['$scope', '$localStorage', '$sessionStorage', '$timeout', '$rootScope', '$location','$http', '$state', '$stateParams', '$window', '$analytics', 'ConstConfig'];
function subscriptionPaymentSummaryController(scope, $localStorage, $sessionStorage, $timeout, $rootScope, $location ,$http ,$state ,$stateParams, $window, $analytics, ConstConfig) {
 

	scope.stateParms = $stateParams ; 

    scope.getPaymentSummaryDetails = function () {
    	
        var requestPayload = {
            "user_subscription_id" : $location.search().subscription_id,
            "user_mobile" : $location.search().mobile
        }

        var apiURL = ConstConfig.serverUrl + "subscription_management/get_subscription_detail_for_payment";
        
        doPostWithOutToken($http,apiURL,requestPayload,"",function(data){
            if (data.status == true) {
                scope.payment_data =  data.data;
                scope.total_received_amount = 0;

                if(scope.payment_data.payment_details.length > 0) {
                    scope.payment_data.payment_details.forEach(function(ele, index) {
                        scope.total_received_amount += parseInt(ele.recieved_amount);
                    });                      
                }


                localStorage.removeItem("subscription_id");
                localStorage.removeItem("subscription_mobile");
            }
            else {
                scope.payment_api_error = data.message;
            }
        });
    };

    if($location.search().subscription_id && $location.search().mobile) {
    	scope.getPaymentSummaryDetails();
    }
 }