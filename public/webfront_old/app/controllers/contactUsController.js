App.controller('contactUsController', contactUsController);
contactUsController.$inject = ['$scope', 'dataShare','dataShare1', '$localStorage', '$sessionStorage', '$timeout', '$rootScope', '$location','$http', '$q', 'BookOrderService', '$state', '$stateParams','ConstConfig'];
function contactUsController (scope, dataShare,dataShare1, $localStorage, $sessionStorage, $timeout, $rootScope, $location ,$http ,$q ,BookOrderService ,$state ,$stateParams,ConstConfig) {

	scope.verifyAddress = function () {

            scope.addAddressFormSubmitted = false;

             if (scope.addAddressForm.Name === undefined || scope.addAddressForm.Name === '') {
                scope.addAddressForm.name.$dirty = true;
                scope.addAddressForm.name.$invalid = true;
                scope.addAddressForm.name.$error.required = true;
                return false;
            } else if (scope.addAddressForm.customerEmail === undefined || scope.addAddressForm.customerEmail === '') {
                scope.addAddressForm.customeremail.$dirty = true;
                scope.addAddressForm.customeremail.$invalid = true;
                scope.addAddressForm.customeremail.$error.required = true;
                return false;
           	 } else if (scope.addAddressForm.No === undefined || scope.addAddressForm.No === '') {
                scope.addAddressForm.customerno.$dirty = true;
                scope.addAddressForm.customerno.$invalid = true;
                scope.addAddressForm.customerno.$error.required = true;
                return false;
            } else if (scope.addAddressForm.customerComp === undefined || scope.addAddressForm.customerComp === '') {
                scope.addAddressForm.customercomp.$dirty = true;
                scope.addAddressForm.customercomp.$invalid = true;
                scope.addAddressForm.customercomp.$error.required = true;
                return false;
           	} 

            var g_recaptcha_response = grecaptcha.getResponse(widgetIdContact);
        
            if(g_recaptcha_response.length == 0) {
                $window.alert("Please check Captcha Checkbox");
                return false;
            }

            var detail = { 
                "full_name":scope.addAddressForm.Name,
                "email_id":scope.addAddressForm.customerEmail,
                "mobile":scope.addAddressForm.No,
                "company":scope.addAddressForm.customerComp,
                "message":scope.message, 
                "g_recaptcha_response": g_recaptcha_response 
            }

            doPost($http,ConstConfig.serverUrl + "commonservice/contactUs",detail,"",function(data){
                if(data.status == true) {   
                    scope.addAddressForm.Name = '';
                    scope.addAddressForm.name.$dirty = false;
                    scope.addAddressForm.customerEmail = '';
                    scope.addAddressForm.customeremail.$dirty = false;
                    scope.addAddressForm.No = '';
                    scope.addAddressForm.customerno.$dirty = false;
                    scope.addAddressForm.customerComp = '';
                    scope.addAddressForm.customercomp.$dirty = false;
                    scope.message = '';
                    scope.addAddressForm.message.$dirty = false;

                    alert(data.message);
                }
                else {
                    alert(data.message);
                }
                grecaptcha.reset(widgetIdContact);
            }); 
    };

 }