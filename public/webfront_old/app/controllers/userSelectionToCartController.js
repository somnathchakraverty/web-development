App.controller('userSelectionToCartController', userSelectionToCartController);
userSelectionToCartController.$inject = ['$scope', 'dataShare', 'dataShare1', '$localStorage', '$sessionStorage', '$timeout', '$rootScope', '$location', '$http', '$q', 'BookOrderService', '$state', '$stateParams', 'cartService', '$analytics','$window', 'ConstConfig', '$interval'];

function userSelectionToCartController(scope, dataShare, dataShare1, $localStorage, $sessionStorage, $timeout, $rootScope, $location, $http, $q, BookOrderService, $state, $stateParams, cartService, $analytics, $window, ConstConfig, $interval) {
    
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

    if (isMobile.any()) {
        scope.device = 'mobile';
    }
    else {
        scope.device = 'web';
    }

    // Token
    var token = localStorage.getItem("token");
    
    scope.userCheckBox = {};
    scope.userEdit = {};
    scope.familyCountError = false;
    scope.familyCountErrorMsg = "Selection of maximum numbers (10) of family members per booking achieved. Please do another booking";
    scope.editCustomerForm = {};
    scope.editCustomerFormModel = {};

    scope.load_wait = false;

    if (localStorage.getItem("isLogin") == 'true') {
        scope.userId = JSON.parse(localStorage.getItem("user")).user_id;
        scope.member = JSON.parse(localStorage.getItem("user")).relatives;
        if (scope.member.length !== 0 && ($rootScope.count === 0 || typeof $rootScope.count === "undefined")) {
            scope.tempUser = scope.member;
            localStorage.setItem("tempUser", JSON.stringify(scope.tempUser));
            scope.tempUser = JSON.parse(localStorage.getItem("tempUser"));
        } else {
            scope.tempUser = JSON.parse(localStorage.getItem("tempUser"));
        }
      
        scope.tmpPackage = cartService.getTempPackage();

        var checkInactiveURL = ConstConfig.serverUrl + "commonservice/checkInactiveProduct";
        var requestPayload = {            
            "source": "web",
            "data_value": [scope.tmpPackage.testId],
            "log_user_id": scope.userId,   
        };

        doPost($http, checkInactiveURL, requestPayload, token, function(data) {
            if(data.status) {
                // it's ok - package active
                if(data.status === 'error') {
                    if(data.code == 'TOKEN_EXPIRED' || data.code == 'INVALID_TOKEN' || data.code == 'AUTH_FAILED') {
                        $rootScope.$broadcast('tokenExpired');
                    }
                }
            }
            else {
                alert(data.message);
                $state.go('orderbook');
            }
        });

    } else {
        $state.go('orderbook');
    }

    scope.selectUserCheckBox = function(name, phone, user_id) {
        scope.tmpPkg = angular.copy(scope.tmpPackage);        
    }

    /* To book order after user and package addition */
    scope.confirmAddToCart = function() {
        scope.load_wait = true;
        scope.selected_user_ids = [];

        for (var key in scope.userCheckBox) {
            if (scope.userCheckBox.hasOwnProperty(key)) {
                if(scope.userCheckBox[key]) {
                    scope.selected_user_ids.push(key);
                }
            }
        }

        if(scope.selected_user_ids.length > 0) {
            var checkInactiveURL = ConstConfig.serverUrl + "commonservice/checkInactiveProduct";
            
            var requestPayload = {            
                "source": "web",
                "data_value": [scope.tmpPackage.testId],
                "log_user_id": scope.userId,   
            };

            doPost($http, checkInactiveURL, requestPayload, token, function(data) {
                if(data.status) {
                    // it's ok - package active
                    if (data.status === "error") {
                        if(data.code == 'TOKEN_EXPIRED' || data.code == 'INVALID_TOKEN' || data.code == 'AUTH_FAILED') {
                            $rootScope.$broadcast('tokenExpired');
                        }
                    }
                    else {
                        // FB Event
                        if(typeof($window.fbq) !== 'undefined') {
                            var content_ids = scope.tmpPackage.testId.split(",");
                            var addToCartFB = { 
                                "content_type": 'product',
                                "content_ids": _.uniq(content_ids),
                                "value": scope.tmpPackage.healthian_price,
                                "currency": 'INR',
                                "content_category": "user_selection_cart"
                            };
                            
                            $window.fbq('track', 'AddToCart', addToCartFB);
                        }

                        $analytics.eventTrack('Add to cart', { category: 'My Cart', label: scope.tmpPackage.display_name, value: scope.tmpPackage.healthian_price });

                        var addToCartURL = ConstConfig.couponUrl + "customer/account/add_item_in_cart";
                        var requestPayloadAddCart = {
                            "data" : {
                                "user_id" : scope.userId,
                                "customer_id" : scope.selected_user_ids.join(","),
                                "group_id" : scope.tmpPackage.testId,
                                "source" : scope.device
                            }
                        };

                        if(scope.tmpPackage.display_name === 'Your Customized Package') {
                            requestPayloadAddCart["data"]["isCustomized"] = 1;
                        }

                        doPost($http, addToCartURL, requestPayloadAddCart, token, function(data) {
                            if(data.status) {
                                // Test added to cart successfully.
                                $state.go('cart');
                            }
                            else {
                                alert(data.message);
                            }

                            scope.load_wait = false;
                        });
                    }                    
                }
                else {
                    scope.load_wait = false;
                    alert(data.message);
                    $state.go('orderbook');
                }
            });
        }
        else {
            $window.alert("Please select atleast one user");
            scope.load_wait = false;
        }
    };


    scope.addMemberDiv = false;

    scope.showAddMemberForm = function() {
        scope.getcustomerFormModel = {};
        scope.addMemberDiv = true;
        scope.getcustomerForm.selectrelation.$dirty = false;
        scope.getcustomerForm.customername.$dirty = false;
        scope.getcustomerForm.customerphone.$dirty = false;
        scope.getcustomerForm.customerage.$dirty = false;
        scope.getcustomerForm.customergender.$dirty = false;
        scope.getcustomerForm.userdob.$dirty = false;
    }

    scope.hideAddMemberForm = function() {
        scope.getcustomerFormModel = {};
        scope.addMemberDiv = false;
        scope.getcustomerForm.selectrelation.$dirty = false;
        scope.getcustomerForm.customername.$dirty = false;
        scope.getcustomerForm.customerphone.$dirty = false;
        scope.getcustomerForm.customerage.$dirty = false;
        scope.getcustomerForm.customergender.$dirty = false;
        scope.getcustomerForm.userdob.$dirty = false;
    }

    scope.addFamilyMember = function() {

        scope.loaderVar = true;
        scope.getcustomerFormSubmitted = false;


        if (scope.getcustomerFormModel.name === undefined || scope.getcustomerFormModel.name === '') {
            scope.getcustomerForm.customername.$dirty = true;
            scope.getcustomerForm.customername.$invalid = true;
            scope.getcustomerForm.customername.$error.required = true;
            scope.loaderVar = false;
            $analytics.eventTrack('Validation Faliure on Add Patient detail pop-up', { category: 'Add Patient Popup', label: 'Name' });
            focus('customername');
            return false;
        } else if (scope.getcustomerFormModel.relation === undefined || scope.getcustomerFormModel.relation === '') {
            scope.getcustomerForm.selectrelation.$dirty = true;
            scope.getcustomerForm.selectrelation.$invalid = true;
            scope.getcustomerForm.selectrelation.$error.required = true;
            scope.loaderVar = false;
            $analytics.eventTrack('Validation Faliure on Add Patient detail pop-up', { category: 'Add Patient Popup', label: 'Relation' });
            focus('selectrelation');
            return false;
        } 
        else if (scope.getcustomerFormModel.age === undefined || scope.getcustomerFormModel.age === '') {
            scope.getcustomerForm.customerage.$dirty = true;
            scope.getcustomerForm.customerage.$invalid = true;
            scope.getcustomerForm.customerage.$error.required = true;
            scope.loaderVar = false;
            $analytics.eventTrack('Validation Faliure on Add Patient detail pop-up', { category: 'Add Patient Popup', label: 'Age' });
            focus('customerage');
            return false;
        } else if (scope.getcustomerFormModel.gender === undefined || scope.getcustomerFormModel.gender === '') {
            scope.getcustomerForm.customergender.$dirty = true;
            scope.getcustomerForm.customergender.$invalid = true;
            scope.getcustomerForm.customergender.$error.required = true;
            scope.loaderVar = false;
            $analytics.eventTrack('Validation Faliure on Add Patient detail pop-up', { category: 'Add Patient Popup', label: 'Gender' });
            focus('customergender');
            return false;
        }

        if (scope.getcustomerFormModel.age <5 || scope.getcustomerFormModel.age > 120 || scope.getcustomerFormModel.age <= 0) {
            scope.getcustomerForm.customerage.$dirty = true;
            scope.getcustomerForm.customerage.$invalid = true;
            scope.getcustomerForm.customerage.$error.pattern = true;
            scope.loaderVar = false;
            $analytics.eventTrack('Validation Faliure on Add Patient detail pop-up', { category: 'Add Patient Popup', label: 'Age' });
            focus('customerage');
            return false;
        }

        if (scope.getcustomerFormModel.phone !== undefined) {
            if(scope.getcustomerFormModel.phone !== '') {
                if(isNaN(scope.getcustomerFormModel.phone)) {
                    scope.getcustomerForm.customerphone.$dirty = true;
                    scope.getcustomerForm.customerphone.$invalid = true;
                    scope.getcustomerForm.customerphone.$error.pattern = true;
                    scope.loaderVar = false;
                    $analytics.eventTrack('Validation Faliure on Add Patient detail pop-up', { category: 'Add Patient Popup', label: 'Contact No.' });
                    focus('customerphone');
                    return false;
                }
                if(scope.getcustomerFormModel.phone.length !== 10) {
                    scope.getcustomerForm.customerphone.$dirty = true;
                    scope.getcustomerForm.customerphone.$invalid = true;
                    scope.getcustomerForm.customerphone.$error.pattern = true;
                    scope.loaderVar = false;
                    $analytics.eventTrack('Validation Faliure on Add Patient detail pop-up', { category: 'Add Patient Popup', label: 'Contact No.' });
                    focus('customerphone');
                    return false;
                }
            }
        }

        var obj = {
            log_user_id: scope.userId,
            family_head: scope.userId,
            cust_name: scope.getcustomerFormModel.name,
            age: scope.getcustomerFormModel.age,
            birth_date: scope.getcustomerFormModel.userDOB,
            phone: scope.getcustomerFormModel.phone,
            gender: scope.getcustomerFormModel.gender,
            relationship: scope.getcustomerFormModel.relation,
            dob_type: scope.type,
            source: 'web'
        };

        if (isMobile.any()) {
            obj['device_source'] = 'mobile';
        } else {
            obj['device_source'] = 'web';
        }

        BookOrderService.insertNewUserInFamily(obj, function(data) {
            if (data.status === "error") {
                if (data.code == 'TOKEN_EXPIRED' || data.code == 'INVALID_TOKEN' || data.code == 'AUTH_FAILED') {
                    $rootScope.$broadcast('tokenExpired');
                }
            } else {
                if(data.status) {
                    // Add new menber to cart
                    scope.addMemberDiv = false;
                    scope.loaderVar = false;
                    var usrId = data.data[0];
                    var newobj = {
                      user_id: usrId.user_id,
                      name: scope.getcustomerFormModel.name,
                      email_address:"",
                      age: scope.getcustomerFormModel.age,
                      dob: scope.getcustomerFormModel.userDOB,
                      contact_number: scope.getcustomerFormModel.phone,
                      gender: scope.getcustomerFormModel.gender,
                      relationship: scope.getcustomerFormModel.relation,
                      dob_type: scope.type
                    };
                    
                    // Add new member to user relatives
                    var userDetails =  JSON.parse(localStorage.getItem("user"));
                    userDetails.relatives.push(newobj);
                    localStorage.setItem("user", JSON.stringify(userDetails));

                    localStorage.setItem("tempUser", JSON.stringify(userDetails.relatives));
                    scope.tempUser = JSON.parse(localStorage.getItem("tempUser"));

                    scope.getcustomerFormSubmitted = false;
                    scope.hideAddMemberForm(); 
                }
                else {
                    scope.loaderVar = false;
                    window.alert(data.message);
                }
            }

        });
    };

    //service call for get relationship without self
    scope.getRealtionwithoutself = function() {
        BookOrderService.getRealtionwithoutself(function(data) {
            if (data.status === true) {
                scope.RelationShip = data.data;
            }
        });
    };

    scope.getRealtionwithoutself();

    //calculate age 
    scope.calculateAge = function(dob) {
        var mm = moment(dob, 'DD/MM/YYYY').format('M');
        var dd = moment(dob, 'DD/MM/YYYY').format('D');
        var yy = moment(dob, 'DD/MM/YYYY').format('Y');
        var currentmonth = moment().month() + 1;
        var today = new Date();
        var birthDate = new Date(dob);
        var age = today.getFullYear() - yy;
        var m = today.getMonth() - birthDate.getMonth();
        if (currentmonth >= mm) {
            scope.getcustomerFormModel.age = age;
        } else {
            scope.getcustomerFormModel.age = age - 1;
        }
        angular.element("#customerage").val(scope.getcustomerFormModel.age);
    };

    //function for calander showing upto previous six month
    angular.element('#usepdob').datepicker({
        endDate: '-182d',
        onSelect: function(dateText, inst) {
            scope.calculateAge(scope.getcustomerFormModel.userDOB);
        }
    });

    //calculate DOB
    scope.getDOB = function(yrs, name) {
        if(yrs === undefined) {
            yrs = 0;
        }
        var today = moment().subtract(yrs, 'years').format('DD/MM/YYYY');
        scope.getcustomerFormModel.userDOB = today;

        angular.element('#usepdob').datepicker({
                endDate: '-182d',
            })
            .datepicker('update', scope.getcustomerFormModel.userDOB)
            .on('changeDate', function() {
                scope.calculateAge(scope.getcustomerFormModel.userDOB);
            });

        scope.type = "estimated";
    };

    //calculate age 
    scope.calculateAgeEditUser = function(dob, user_id) {
        var mm = moment(dob, 'DD/MM/YYYY').format('M');
        var dd = moment(dob, 'DD/MM/YYYY').format('D');
        var yy = moment(dob, 'DD/MM/YYYY').format('Y');
        var currentmonth = moment().month() + 1;
        var today = new Date();
        var birthDate = new Date(dob);
        var age = today.getFullYear() - yy;
        var m = today.getMonth() - birthDate.getMonth();
        if (currentmonth >= mm) {
            scope.editCustomerFormModel[user_id].age = age;
        } else {
            scope.editCustomerFormModel[user_id].age = age - 1;
        }
        angular.element("#customerage_"+user_id).val(scope.editCustomerFormModel[user_id].age);
    };

    //calculate DOB
    scope.getDOBEditUser = function(yrs, user_id) {
        var today = moment().subtract(yrs, 'years').format('DD/MM/YYYY');
        scope.editCustomerFormModel[user_id].userDOB = today;

        angular.element('#userdob_'+user_id).datepicker({
            endDate: '-182d',
        })
        .datepicker('update', scope.editCustomerFormModel[user_id].userDOB)
        .on('changeDate', function() {
            scope.calculateAge(scope.editCustomerFormModel[user_id].userDOB, user_id);
        });

        scope.type = "estimated";
    };

    scope.editUser = function(user_id, name, age, gender, relationship, contact_number, dob) {
        scope.userEdit[user_id] = !scope.userEdit[user_id];
        scope.editCustomerFormModel[user_id] = {};

        scope.editCustomerFormModel[user_id].name = name;
        scope.editCustomerFormModel[user_id].age = age;
        scope.editCustomerFormModel[user_id].relation = relationship;
        scope.editCustomerFormModel[user_id].gender = gender;
        scope.editCustomerFormModel[user_id].phone = contact_number;
        scope.editCustomerFormModel[user_id].userDOB = dob;

        angular.element('#userdob_'+user_id).datepicker({
            endDate: '-182d',
        })
        .datepicker('update', dob)
        .on('changeDate', function() {
            scope.calculateAge(dob);
        });
    }

    scope.cancelEditUser = function(user_id) {
        scope.userEdit[user_id] = !scope.userEdit[user_id];
    }

    scope.updateUserDetails = function(user_id){

        scope.loaderVar = true;
        scope.editCustomerFormSubmitted = false;
        if (scope.editCustomerFormModel[user_id].name === undefined || scope.editCustomerFormModel[user_id].name === '') {
            scope.editCustomerForm[user_id].customername.$dirty = true;
            scope.editCustomerForm[user_id].customername.$invalid = true;
            scope.editCustomerForm[user_id].customername.$error.required = true;
            scope.loaderVar = false;
            $analytics.eventTrack('Validation Faliure on Add Patient detail pop-up', { category: 'Add Patient Popup', label: 'Name' });
            focus('customername');
            return false;
        } else if (scope.editCustomerFormModel[user_id].relation === undefined || scope.editCustomerFormModel[user_id].relation === '') {
            scope.editCustomerForm[user_id].selectrelation.$dirty = true;
            scope.editCustomerForm[user_id].selectrelation.$invalid = true;
            scope.editCustomerForm[user_id].selectrelation.$error.required = true;
            scope.loaderVar = false;
            $analytics.eventTrack('Validation Faliure on Add Patient detail pop-up', { category: 'Add Patient Popup', label: 'Relation' });
            focus('selectrelation');
            return false;
        } 
        else if (scope.editCustomerFormModel[user_id].age === undefined || scope.editCustomerFormModel[user_id].age === '') {
            scope.editCustomerForm[user_id].customerage.$dirty = true;
            scope.editCustomerForm[user_id].customerage.$invalid = true;
            scope.editCustomerForm[user_id].customerage.$error.required = true;
            scope.loaderVar = false;
            $analytics.eventTrack('Validation Faliure on Add Patient detail pop-up', { category: 'Add Patient Popup', label: 'Age' });
            focus('customerage');
            return false;
        } else if (scope.editCustomerFormModel[user_id].gender === undefined || scope.editCustomerFormModel[user_id].gender === '') {
            scope.editCustomerForm[user_id].customergender.$dirty = true;
            scope.editCustomerForm[user_id].customergender.$invalid = true;
            scope.editCustomerForm[user_id].customergender.$error.required = true;
            scope.loaderVar = false;
            $analytics.eventTrack('Validation Faliure on Add Patient detail pop-up', { category: 'Add Patient Popup', label: 'Gender' });
            focus('customergender');
            return false;
        }

        if (scope.editCustomerFormModel[user_id].age < 5 || scope.editCustomerFormModel[user_id].age > 120 || scope.editCustomerFormModel[user_id].age <= 0) {
            scope.editCustomerForm[user_id].customerage.$dirty = true;
            scope.editCustomerForm[user_id].customerage.$invalid = true;
            scope.editCustomerForm[user_id].customerage.$error.pattern = true;
            scope.loaderVar = false;
            $analytics.eventTrack('Validation Faliure on Add Patient detail pop-up', { category: 'Add Patient Popup', label: 'Age' });
            focus('customerage');
            return false;
        }

        if (scope.editCustomerFormModel[user_id].phone !== undefined && scope.editCustomerFormModel[user_id].phone !== null) {
            if(scope.editCustomerFormModel[user_id].phone !== '') {
                if(isNaN(scope.editCustomerFormModel[user_id].phone)) {
                    scope.editCustomerForm[user_id].customerphone.$dirty = true;
                    scope.editCustomerForm[user_id].customerphone.$invalid = true;
                    scope.editCustomerForm[user_id].customerphone.$error.pattern = true;
                    scope.loaderVar = false;
                    $analytics.eventTrack('Validation Faliure on Add Patient detail pop-up', { category: 'Add Patient Popup', label: 'Contact No.' });
                    focus('customerphone');
                    return false;
                }
                if(scope.editCustomerFormModel[user_id].phone.length !== 10) {
                    scope.editCustomerForm[user_id].customerphone.$dirty = true;
                    scope.editCustomerForm[user_id].customerphone.$invalid = true;
                    scope.editCustomerForm[user_id].customerphone.$error.pattern = true;
                    scope.loaderVar = false;
                    $analytics.eventTrack('Validation Faliure on Add Patient detail pop-up', { category: 'Add Patient Popup', label: 'Contact No.' });
                    focus('customerphone');
                    return false;
                }
            }            
        }


        var obj = {
            log_user_id: scope.userId,
            user_id: user_id,
            cust_name: scope.editCustomerFormModel[user_id].name,
            age: scope.editCustomerFormModel[user_id].age,
            birth_date: scope.editCustomerFormModel[user_id].userDOB,
            phone: scope.editCustomerFormModel[user_id].phone,
            gender: scope.editCustomerFormModel[user_id].gender,
            relationship: scope.editCustomerFormModel[user_id].relation,
            dob_type: scope.type,
            source: "web"
        };

        BookOrderService.updateUserDetail(obj, function(data) {
            if(data.status === "error") {
                if(data.code == 'TOKEN_EXPIRED' || data.code == 'INVALID_TOKEN' || data.code == 'AUTH_FAILED') {
                    $rootScope.$broadcast('tokenExpired');
                }
            }
            else {
                if(data.status){
                    scope.userEdit[user_id] = !scope.userEdit[user_id];

                    // update menber details to user relatives
                    var userDetails =  JSON.parse(localStorage.getItem("user"));
                    userDetails.relatives.forEach(function(ele, index) {
                        if(ele.user_id === user_id) {
                            userDetails.relatives[index].name = obj.cust_name;
                            userDetails.relatives[index].contact_number = obj.phone;
                            userDetails.relatives[index].gender = obj.gender;
                            userDetails.relatives[index].age = obj.age;
                            userDetails.relatives[index].relationship = obj.relationship;
                            userDetails.relatives[index].dob = obj.birth_date;
                            userDetails.relatives[index].dob_type = obj.type;
                        }
                    });
                    localStorage.setItem("user", JSON.stringify(userDetails));

                    localStorage.setItem("tempUser", JSON.stringify(userDetails.relatives));
                    scope.tempUser = JSON.parse(localStorage.getItem("tempUser"));

                }
                else {
                    window.alert(data.message);
                }
            }
            scope.loaderVar = false;
        });

    }

    $timeout(function() {
        scope.familyCountError = false;
    }, 6000);

    //scope.totalAmount();

    //scope.getCartTotalTest();

    angular.element('.modal-backdrop').remove();
    angular.element('body').css("padding-right", "0px");
}
