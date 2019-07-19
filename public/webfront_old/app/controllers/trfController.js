App.controller('trfController', trfController);
trfController.$inject = ['$scope', '$rootScope', '$location', 'BookOrderService', '$timeout', '$window', 'ConstConfig', '$http', '$state', '$analytics', '$stateParams'];

function trfController(scope, $rootScope, $location,  BookOrderService, $timeout, $window, ConstConfig, $http, $state, $analytics, $stateParams) {
    
    scope.stateParms = $stateParams; 
    scope.loaderVar = true;

    scope.getPaymentSummaryDetails = function (booking_id, mobile) {

        var opts = {
            "order_id": booking_id,
            "mobile": mobile
        };

        var url = ConstConfig.serverUrl + "commonservice/makeTrfPdf";
        $http({
            method: "POST",
            url: url,
            data: opts,
            responseType: "blob"
        }).success(function(response) {
            if(response.size !== 0 && response.type === 'application/pdf') {
                var fileName = 'trf';
                var a = document.createElement("a");
                document.body.appendChild(a);
                a.style = "display: none";
                var file = new Blob([response], {type: 'application/pdf'});
                var fileURL = window.URL.createObjectURL(file);
                a.href = fileURL;
                a.download = fileName;
                a.click();
                scope.loaderVar = false;
                $timeout(function() {
                    $window.location.href = "/";
                }, 3000);
                
            }
            else {
                $window.alert('Something wrong. Please contact to customer care');
                $timeout(function() {
                    $window.location.href = "/";
                }, 2000);

            }   

        });

    };

    if($location.search().booking_id && $location.search().mobile) {
        var booking_id = scope.stateParms.booking_id;
        var mobile = scope.stateParms.mobile;
        
        scope.getPaymentSummaryDetails(booking_id, mobile);
    }
}
