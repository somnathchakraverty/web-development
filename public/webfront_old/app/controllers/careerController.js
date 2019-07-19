App.controller('careerController', careerController);
careerController.$inject = ['$scope', 'dataShare', 'dataShare1', '$localStorage', '$sessionStorage', '$timeout', '$rootScope', '$location', '$http', '$q', 'BookOrderService', '$state', '$stateParams', 'ConstConfig', '$anchorScroll', '$window'];

function careerController(scope, dataShare, dataShare1, $localStorage, $sessionStorage, $timeout, $rootScope, $location, $http, $q, BookOrderService, $state, $stateParams, ConstConfig, $anchorScroll, $window) {

    scope.addAddressForm = {};

    scope.noticPeriodList = [{ name: "15 Days" }, { name: "30 Days" },{ name: "45 Days" }, { name: "2 Months" }, { name: "3 Months" }];

    scope.notice = scope.noticPeriodList[0];

    scope.postList = [
        {
            "name": "Executive Customer Service"
        },
        {
            "name": "Executive Outbound - Sales"
        },
        {
            "name": "Phlebotomist"
        },
        {
            "name": "Senior Manager Sales"
        }
    ];

    scope.post = scope.postList[0];

    scope.carrerAnchor = function() {
        $anchorScroll('careerAnchore');
    };

    scope.oneAtATime = true;
    scope.status = {
        first: false,
        second: false,
        third: false,
        fourth: false,
        fifth: false,
        six: false,
        seven: false,
        eight: false,
        nine: false
    };

    scope.toggleOpen = function(ic) {
        _.map(scope.status, function(val, key) {
            if (key === ic) {
                scope.status[ic] = !scope.status[ic];
            } else {
                scope.status[key] = false;
            }
        });
    }

    scope.verifyAddress = function() {

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
        } else if (scope.addAddressForm.Exp === undefined || scope.addAddressForm.Exp === '') {
            scope.addAddressForm.customerexp.$dirty = true;
            scope.addAddressForm.customerexp.$invalid = true;
            scope.addAddressForm.customerexp.$error.required = true;
            return false;
        } else if (scope.addAddressForm.currentOrg === undefined || scope.addAddressForm.currentOrg === '') {
            scope.addAddressForm.currentorg.$dirty = true;
            scope.addAddressForm.currentorg.$invalid = true;
            scope.addAddressForm.currentorg.$error.required = true;
            return false;
        } else if (scope.addAddressForm.currentDes === undefined || scope.addAddressForm.currentDes === '') {
            scope.addAddressForm.currentdes.$dirty = true;
            scope.addAddressForm.currentdes.$invalid = true;
            scope.addAddressForm.currentdes.$error.required = true;
            return false;
        }

        var g_recaptcha_response = grecaptcha.getResponse(widgetIdCareer);
        
        if(g_recaptcha_response.length == 0) {
            $window.alert("Please check Captcha Checkbox");
            return false;
        }

        var detail = {
            full_name: scope.addAddressForm.Name,
            email_id: scope.addAddressForm.customerEmail,
            mobile: scope.addAddressForm.No,
            post_applied: scope.post.name,
            experience: scope.addAddressForm.Exp,
            current_organization: scope.addAddressForm.currentOrg,
            current_designation: scope.addAddressForm.currentDes,
            notice_period: scope.notice.name,
            address: scope.addAddressForm.Address,
            file_name: '',
            file: '',
            g_recaptcha_response: g_recaptcha_response
        }

        if (typeof scope.opts !== 'undefined') {
            detail.file_name = scope.opts.name;
            detail.file = scope.opts.doc;
        }
        //console.log(JSON.stringify(detail));
        doPostImage($http, ConstConfig.serverUrl + "commonservice/workWithUs", detail, "", function(data) {
            if (data.status == true) {
                alert(data.message);
                scope.addAddressForm.Name = "";
                scope.addAddressForm.customerEmail = "";
                scope.addAddressForm.No = "";
                scope.post.name = "";
                scope.addAddressForm.Exp = "";
                scope.addAddressForm.currentOrg = "";
                scope.addAddressForm.currentDes = "";
                scope.notice.name = "";
                scope.addAddressForm.Address = "";

                scope.addAddressForm.name.$dirty = false;
                scope.addAddressForm.customeremail.$dirty = false;
                scope.addAddressForm.customerno.$dirty = false;
                scope.addAddressForm.customerexp.$dirty = false;
                scope.addAddressForm.currentorg.$dirty = false;
                scope.addAddressForm.currentdes.$dirty = false;
            } else {
                alert(data.message);
            }
            grecaptcha.reset(widgetIdCareer);
        });
    };


    
    // scope.getCareerData = function(category_id) {
    //     $http({
    //         method: "GET",
    //         url: 'https://blog.healthians.com/wp-json/wp/v2/posts?categories='+category_id,
    //     }).success(function(data) {
    //         if(data) {
    //            scope.career_data = data;
    //         }
    //     });
    // }

    // scope.getCareerData('452');
}
