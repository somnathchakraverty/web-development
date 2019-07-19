App.controller('footerController', footerController);
footerController.$inject = ['$scope', 'dataShare','dataShare1', '$localStorage', '$sessionStorage', '$timeout', '$rootScope', '$location','$http', '$q', 'BookOrderService', '$state', '$stateParams', 'ConstConfig','$analytics'];
function footerController (scope, dataShare,dataShare1, $localStorage, $sessionStorage, $timeout, $rootScope, $location ,$http ,$q ,BookOrderService ,$state ,$stateParams,ConstConfig,$analytics) {
 	
 	scope.subscriber = function()
 	{
        var emailId;
        //console.log("emailId",scope.addAddressForm.customerEmail);
        if (scope.addAddressForm.customerEmail === undefined || scope.addAddressForm.customerEmail === '') {
            scope.addAddressForm.customeremail.$dirty = true;
            scope.addAddressForm.customeremail.$invalid = true;
            scope.addAddressForm.customeremail.$error.required = true;
            $analytics.eventTrack('Failed Email Validation in Subscription Form', {category: 'Footer'});
            return false;
        }
        emailId = scope.addAddressForm.customerEmail;
        scope.addAddressForm.customerEmail = '';
        scope.addAddressForm.customeremail.$dirty = false;
 		doPostWithOutToken($http,ConstConfig.serverUrl + "commonservice/subscribeNewsLetter/",{"email" : emailId},"",function(data){
        	//console.log("data",data);
            if(data.status == true)
        	{
                $analytics.eventTrack('Subscribed Sucessfully', {category: 'Footer'});
        		alert(data.message);
        	}
        	else
        	{
        		alert(data.data.email);
        	}
        	 
    	});	
 	}
    scope.cpelem = {
        "c1": "copy",
        "c2": "copy",
        "c3": "copy",
        "c4": "copy",
        "c5": "copy",
        "c6": "copy",
    }
    
    scope.copyToClipboard =  function(text, elcp) {
        
        var copyFrom = document.createElement("textarea");
        copyFrom.textContent = text;
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(copyFrom);
        copyFrom.select();
        document.execCommand('copy');
        body.removeChild(copyFrom);
        $analytics.eventTrack('Click on copy on deal', { category: 'Deals', label: text });
        if(typeof elcp !== 'undefined') {
            if(elcp !== '') {
                scope.cpelem[elcp] = "Copied";
                $timeout(function(){
                    scope.cpelem[elcp] = "copy";
                },2000);
            }
        }
        
    }

 }