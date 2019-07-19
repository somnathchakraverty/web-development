App.controller('accountActivationController', accountActivationController);
accountActivationController.$inject = ['$scope','$rootScope','focus', 'HomeService','$http','$location','searchDetail','$timeout','dataShare','$localStorage','$sessionStorage', '$q', '$stateParams', 'ConstConfig'];
function accountActivationController (scope,$rootScope,focus,HomeService,$http,$location,searchDetail,$timeout,dataShare,$localStorage,$sessionStorage,$q,$stateParams,ConstConfig) {
    scope.verified = false
    scope.urlParam = $stateParams ; 
    //console.log(scope.urlParam);

// call for reset password
    scope.verifyAccount = function () {
            // var opts = {user_id: scope.urlParam.id, verification_number: scope.urlParam.key};
            // console.log("opts",opts);
            // scope.verified = true;
            doPost($http,ConstConfig.serverUrl + "commonservice/activateUserAccount",{"user_id": scope.urlParam.id, "verification_number": scope.urlParam.key}, "",function(data){
                if (data.status == true){
                    scope.verified = true;
                }
            });
    };

    scope.verifyAccount();
    
};