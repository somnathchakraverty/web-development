App.controller('myAddressController', myAddressController);
myAddressController.$inject = ['$scope', '$rootScope', '$location', '$anchorScroll', 'DashboardService', 'BookOrderService', '$timeout', '$window', 'cartService', 'ConstConfig', '$http'];

function myAddressController(scope, $rootScope, $location, $anchorScroll, DashboardService, BookOrderService, $timeout, $window, cartService, ConstConfig, $http) {
    
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

    // Token
    var token = localStorage.getItem("token");

    scope.modifyAddressFlag = {};
    scope.editAddressFormModel = {};
    scope.editAddressForm = {};
    scope.distanceError = {};
    scope.sublocalityDropDownSelected = {};
    scope.editAddressFormSubmitted = false;
    scope.addAddressErrorAll = {};
    scope.addAddressErrorMsgAll = {};

    scope.sublocalityDropDownSelectedSeperate = false;
    scope.distanceErrorSeperate = false;

    scope.editCheck = false;

    scope.addNewAddressFlag = false;
    scope.showAddNewAddress = function() {
        scope.addNewAddressFlag = !scope.addNewAddressFlag;
    }

    scope.backMyAddress = function() {
        scope.addNewAddressFlag = false;
        scope.editCheck = false;

        _.each(scope.modifyAddressFlag, function(value,key) { 
            scope.modifyAddressFlag[key] = false;
        });
    }

    scope.modifyAddress = function(address_id, locality, houseno, landmark, postal_code) {
        $window.scrollTo(0, 0);
        scope.editCheck = true;
        scope.modifyAddressFlag[address_id] = !scope.modifyAddressFlag[address_id];
        scope.sublocalityDropDownSelected[address_id] = true;
        scope.editAddressFormModel[address_id] = {};

        scope.editAddressFormModel[address_id].locality = locality;
        scope.editAddressFormModel[address_id].houseno = houseno;
        scope.editAddressFormModel[address_id].landmark = landmark;
        scope.editAddressFormModel[address_id].postal_code = postal_code;
    }

    scope.cancelEditingAddress = function(address_id) {
        scope.editCheck = false;
        scope.modifyAddressFlag[address_id] = !scope.modifyAddressFlag[address_id];
        scope.resetSubLocality(address_id);
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

        doPost($http, markAddressToDefaultURL, requestPayload, token, function(data) {
            if(data.status) {
                var user = JSON.parse(localStorage.getItem("user"));
                scope.getAddressesByUserId(user.user_id);
                
                scope.address_msg_visible = true;
                scope.address_message = '"' + address.address +'" marked as your default address.';
            }
            else {
                var user = JSON.parse(localStorage.getItem("user"));
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

        doPost($http, markAddressToDefaultURL, requestPayload, token, function(data) {
            if(data.status) {
                var user = JSON.parse(localStorage.getItem("user"));
                scope.getAddressesByUserId(user.user_id);
                scope.address_msg_visible = true;
                scope.address_message = "Address deleted successfully.";
            }
            else {
                var user = JSON.parse(localStorage.getItem("user"));
                scope.getAddressesByUserId(user.user_id);

                scope.address_msg_visible = true;
                scope.address_message = data.message;
            }
        });
    };

    scope.getAddressesByUserId = function(user_id){
        scope.editCheck = false;
        //scope.useAddressPresent = false;
        /* Get All Address of User */
        var city_name = JSON.parse(localStorage.getItem("cityID"))[0].city_name;

        var getUserAddressURL = ConstConfig.serverUrl + "commonservice/getAddressesByUserId";
        var addressPayload = {
            "user_id": user_id,
            "log_user_id": user_id
            //"city_name": city_name
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
                        scope.modifyAddressFlag[value.address_id] = false;
                        scope.distanceError[value.address_id] = false;
                        scope.sublocalityDropDownSelected[value.address_id] = false;
                        scope.addAddressErrorAll[value.address_id] = false;

                        if (parseInt(value.default_status) === 1) {
                            scope.existingaddress = parseInt(value.address_id);
                            scope.defaultExistingAddressObject = value;
                            // scope.selectListedAdd(value);
                        }
                    });

                    if(_.isEmpty(scope.defaultExistingAddressObject)) {
                        scope.defaultExistingAddressObject = scope.addressList[0];
                        scope.addressList[0].default_status = 1;
                        // scope.selectListedAdd(scope.defaultExistingAddressObject);
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

    scope.getLocalityUsingLatLong = function() {
        
        var user = JSON.parse(localStorage.getItem("user"));
        var log_user_id = user.user_id;

        scope.distanceError[scope.selected_address_id] = false;
        var getLocalityURL = ConstConfig.serverUrl + "commonservice/getnearestlocality";
        var requestData = {
            "lat": $rootScope.sep_sub_lat,
            "long": $rootScope.sep_sub_long,
            "log_user_id": log_user_id
        };

        doPost($http, getLocalityURL, requestData, token, function(response) {
            if (response.status == true) {
                scope.editAddressFormModel[scope.selected_address_id].new_locality = response.data.locality_id;
                scope.editAddressFormModel[scope.selected_address_id].locality_city = response.data.city_name;

                scope.editAddressFormModel[scope.selected_address_id].postal_code = scope.postal_code;
                scope.sublocalityDropDownSelected[scope.selected_address_id] = true;
            } else {
                if (response.status === "error") {
                    if(response.code == 'TOKEN_EXPIRED' || response.code == 'INVALID_TOKEN' || response.code == 'AUTH_FAILED') {
                        $rootScope.$broadcast('tokenExpired');
                    }
                }
                else {
                    scope.distanceError[scope.selected_address_id] = true;
                    scope.sublocalityDropDownSelected[scope.selected_address_id] = false;
                    scope.distanceErrorMsg = response.message;
                    scope.editAddressFormModel[scope.selected_address_id].locality = "";
                    //scope.addAddressForm.pacinput.$dirty = false;
                    scope.locality_id = "";
                    $rootScope.sep_sub_lat = "";
                    $rootScope.sep_sub_long = "";
                    scope.sep_sub_lat = "";
                    scope.sep_sub_long = "";

                    $timeout(function() {
                        scope.distanceError[scope.selected_address_id] = false;
                        scope.distanceErrorMsg = "";
                    }, 3000);

                }
            }
        });
    }

    scope.getLocalityUsingLatLongSeperate = function() {
        var user = JSON.parse(localStorage.getItem("user"));
        var log_user_id = user.user_id;

        scope.distanceErrorSeperate = false;
        var getLocalityURL = ConstConfig.serverUrl + "commonservice/getnearestlocality";
        var requestData = {
            "lat": scope.sub_lat,
            "long": scope.sub_long,
            "log_user_id": log_user_id
        };

        doPost($http, getLocalityURL, requestData, token, function(response) {
            if (response.status == true) {
                scope.new_locality = response.data.locality_id;
                scope.locality_city = response.data.city_name;

                scope.postal_code_new = scope.postal_code;
                scope.sublocalityDropDownSelectedSeperate = true;
            } else {
                if (response.status === "error") {
                    if(response.code == 'TOKEN_EXPIRED' || response.code == 'INVALID_TOKEN' || response.code == 'AUTH_FAILED') {
                        $rootScope.$broadcast('tokenExpired');
                    }
                }
                else {
                    scope.distanceErrorSeperate = true;
                    scope.sublocalityDropDownSelectedSeperate = false;
                    scope.distanceErrorMsg = response.message;
                    scope.chosenPlace = "";
                    scope.new_locality = "";
                    scope.addAddressForm.pacinput.$dirty = false;
                    
                    $timeout(function() {
                        scope.distanceErrorSeperate = false;
                        scope.distanceErrorMsg = "";
                    }, 3000);
                    
                }
            }
        });
    }

    /* Reset Sub-locality */
    scope.resetSubLocality = function(address_id) {
        scope.postal_code = "";
        $rootScope.postal_code = "";
        
        $rootScope.sep_sub_lat = "";
        $rootScope.sep_sub_long = "";
        scope.sep_sub_lat = "";
        scope.sep_sub_long = "";
        
        scope.sublocalityDropDownSelected[address_id] = false;
        scope.editAddressFormModel[address_id].locality = "";
        scope.editAddressForm[address_id]['pacinput'+'_'+address_id].$dirty = false;
        scope.editAddressFormModel[address_id].postal_code = "";
        scope.editAddressForm[address_id].postal_code.$dirty = false;
    }

    scope.updateAddressDetails = function(address_id, locality_id, city_name){

        //scope.loaderVar = true;
        scope.editAddressFormSubmitted = false;

        if (scope.editAddressFormModel[address_id].locality === undefined || scope.editAddressFormModel[address_id].locality === '') {
            scope.editAddressForm[address_id]['pacinput'+'_'+address_id].$dirty = true;
            scope.editAddressForm[address_id]['pacinput'+'_'+address_id].$invalid = true;
            scope.editAddressForm[address_id]['pacinput'+'_'+address_id].$error.required = true;
            scope.loaderVar = false;
            return false;
        } else if (scope.editAddressFormModel[address_id].houseno === undefined || scope.editAddressFormModel[address_id].houseno === '') {
            scope.editAddressForm[address_id].houseno.$dirty = true;
            scope.editAddressForm[address_id].houseno.$invalid = true;
            scope.editAddressForm[address_id].houseno.$error.required = true;
            scope.loaderVar = false;
            return false;
        }  else if (scope.editAddressFormModel[address_id].postal_code === undefined || scope.editAddressFormModel[address_id].postal_code === '') {
            scope.editAddressForm[address_id].postal_code.$dirty = true;
            scope.editAddressForm[address_id].postal_code.$invalid = true;
            scope.editAddressForm[address_id].postal_code.$error.required = true;
            scope.loaderVar = false;
            return false;
        } 
        
        if (isMobile.any()) {
            scope.device = 'mobile';
        }
        else {
            scope.device = 'web';
        }

        var user = JSON.parse(localStorage.getItem("user"));

        var new_locality = '';
        var new_city = '';
        if(scope.editAddressFormModel[address_id].new_locality) {
            new_locality = scope.editAddressFormModel[address_id].new_locality;
            new_city = scope.editAddressFormModel[address_id].locality_city;
        } else {
            new_locality = locality_id;
            new_city = city_name;
        }

        var search = _.where(scope.addressList, { address_id: address_id});

        if(search.length > 0) {
            if(search[0].sub_locality === scope.editAddressFormModel[address_id].locality)  {

            }
            else {
                if(($rootScope.sep_sub_lat === undefined || $rootScope.sep_sub_lat ==="") && ($rootScope.sep_sub_long === undefined || $rootScope.sep_sub_long === "")) {
                    scope.addAddressErrorAll[address_id] = true;
                    scope.editAddressFormModel[address_id].locality = '';
                    scope.addAddressErrorMsgAll[address_id] = "Please select location from google dropdown";
                    
                    $timeout(function() {
                        scope.addAddressErrorAll[address_id] = false;
                        scope.addAddressErrorMsgAll[address_id] = "";
                    }, 6000);

                    return false;
                }
            }
        }
        

        var obj = {
            user_id: user.user_id,
            log_user_id: user.user_id,
            locality_id: new_locality,
            city : new_city,
            address_id: address_id,
            house_number: scope.editAddressFormModel[address_id].houseno,
            landmark: scope.editAddressFormModel[address_id].landmark,
            pincode: scope.editAddressFormModel[address_id].postal_code,
            source: 'web',
            device_source : scope.device,
            sub_locality : scope.editAddressFormModel[address_id].locality
        };

        if(($rootScope.sep_sub_lat !== undefined && $rootScope.sep_sub_lat !=="") && ($rootScope.sep_sub_long !== undefined && $rootScope.sep_sub_long !== "")) {
            obj['lat'] =  $rootScope.sep_sub_lat;
            obj['lon'] =  $rootScope.sep_sub_long;
          
        }

        var requestData = {
            "data":  obj
        };

        var url = ConstConfig.couponUrl + "customer/account/update_address";

        doPost($http, url, requestData, token, function(data) {
            if (data.status) {
                scope.editCheck = false;
                var user = JSON.parse(localStorage.getItem("user"));
                scope.getAddressesByUserId(user.user_id);
                scope.addAddressErrorAll[address_id] = false;
                scope.addAddressErrorMsgAll[address_id] = '';

                scope.postal_code = "";
                $rootScope.postal_code = "";
                
                $rootScope.sep_sub_lat = "";
                $rootScope.sep_sub_long = "";
                scope.sep_sub_lat = "";
                scope.sep_sub_long = "";

            }
            else {
                scope.addAddressErrorAll[address_id] = true;
                scope.addAddressErrorMsgAll[address_id] = data.message;
            }
        });
    }


    /* Reset Sub-locality for Add new Address */
    scope.resetSubLocalitySeperate = function() {
        scope.sublocalityDropDownSelectedSeperate = false;
        scope.chosenPlace = "";
        scope.locality_id = "";
        scope.postal_code_new = "";
        scope.postal_code = "";
        $rootScope.postal_code = "";
        scope.new_locality = "";
        scope.locality_city = "";
        scope.sub_lat = "";
        scope.sub_long = "";

        scope.addAddressForm.pacinput.$dirty = false;
        scope.addAddressForm.postal_code.$dirty = false;
    }

    scope.showLoginLoader = false;
    
    scope.sendNewAddressDetails = function() {
        if (scope.chosenPlace === undefined || scope.chosenPlace === '') {
            scope.addAddressForm.pacinput.$dirty = true;
            scope.addAddressForm.pacinput.$invalid = true;
            scope.addAddressForm.pacinput.$error.required = true;
            focus('pacinput');
            return false;
        } else if (scope.houseno === undefined || scope.houseno === '') {
            scope.addAddressForm.shouseno.$dirty = true;
            scope.addAddressForm.shouseno.$invalid = true;
            scope.addAddressForm.shouseno.$error.required = true;
            focus('shouseno');
            return false;
        } else if (scope.postal_code_new === undefined || scope.postal_code_new === '') {
            scope.addAddressForm.s_postal_code.$dirty = true;
            scope.addAddressForm.s_postal_code.$invalid = true;
            scope.addAddressForm.s_postal_code.$error.required = true;
            focus('s_postal_code');
            return false;
        }

        if (isMobile.any()) {
            scope.device = 'mobile';
        }
        else {
            scope.device = 'web';
        }

        if(scope.new_locality === undefined || scope.locality_city === undefined || scope.new_locality === "" || scope.locality_city === "") {
            scope.addAddressError = true;
            scope.chosenPlace = '';
            focus('pacinput');
            scope.addAddressErrorMsg = "Please select the location from google dropdown.";
            
            $timeout(function() {
                scope.addAddressError = false;
                scope.addAddressErrorMsg = "";
            }, 4000);

            return false;
        }

        scope.showLoginLoader = true;
        var user = JSON.parse(localStorage.getItem("user"));

        var obj = {
            user_id: user.user_id,
            log_user_id: user.user_id,
            locality_id: scope.new_locality,
            city : scope.locality_city,
            sub_locality: scope.chosenPlace,
            house_number: scope.houseno,
            landmark: scope.landmark,
            pincode: scope.postal_code_new,
            lat: scope.sub_lat,
            lon: scope.sub_long,
            source: 'web',
            device_source : scope.device
        };

        var requestData = {
            "data":  obj
        };

        var url = ConstConfig.couponUrl + "customer/account/add_address";

        doPost($http, url, requestData, token, function(data) {
            if (data.status) {
                var user = JSON.parse(localStorage.getItem("user"));
                scope.getAddressesByUserId(user.user_id);
                scope.sublocalityDropDownSelectedSeperate = false;
                
                scope.chosenPlace = "";
                scope.addAddressForm.pacinput.$dirty = false;

                scope.postal_code_new = "";
                scope.addAddressForm.s_postal_code.$dirty = false;
                scope.locality_id = "";

                scope.houseno = "";
                scope.addAddressForm.shouseno.$dirty = false;
                scope.landmark = "";
                scope.addAddressForm.landmark.$dirty = false;

                scope.addAddressError = false;
                scope.addAddressErrorMsg = '';
                scope.backMyAddress();
            }
            else {
                scope.addAddressError = true;
                scope.addAddressErrorMsg = data.message;
            }
            scope.showLoginLoader = false;
        });

    }


    if (localStorage.getItem("isLogin") == 'true') {
        var user = JSON.parse(localStorage.getItem("user"));
        scope.getAddressesByUserId(user.user_id);
    }
}