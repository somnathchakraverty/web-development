App.controller('uploadPrescriptionVendorController', uploadPrescriptionVendorController);
uploadPrescriptionVendorController.$inject = ['$scope', '$rootScope', '$location', '$anchorScroll', '$timeout', '$window', 'ConstConfig', '$http', '$state', '$analytics', '$stateParams'];

function uploadPrescriptionVendorController(scope, $rootScope, $location, $anchorScroll, $timeout, $window, ConstConfig, $http, $state, $analytics, $stateParams) {
    
    scope.stateParms = $stateParams; 
    scope.uploadSuccess = false;
    scope.files = [];
    scope.loaderVar = false;
    
    if($location.search().utmid) {
        scope.utmid = scope.stateParms.utmid;
    }
    else {
        $window.location.href = "/";
    }


    scope.cust_id = '';

    scope.onLoad = function (e, reader, file, fileList, fileOjects, fileObj) {
        var sizeErrorExists = false;
        
        if(scope.files.length <=3) {
            angular.forEach(scope.files, function (item, key) {
                if(!sizeErrorExists) {
                    if((item.filesize / 1000) < 5120) {
                        scope.files[key]['image'] = 'data:' + item.filetype + ';base64,' + item.base64;
                    } 
                    else {
                        scope.files = [];
                        sizeErrorExists = true;
                        $window.alert("Image size should not be exceeded 5 MB");
                    }
                }
            });
        }
        else {
            scope.files = scope.files.slice(0,3);
            angular.forEach(scope.files, function (item, key) {
                if(!sizeErrorExists) {
                    if((item.filesize / 1000) < 5120) {
                        scope.files[key]['image'] = 'data:' + item.filetype + ';base64,' + item.base64;
                    } 
                    else {
                        scope.files = [];
                        sizeErrorExists = true;
                        $window.alert("Image size should not be exceeded 5 MB");                        
                    }
                }                
            });
        }
    };

    scope.removeImage = function(index) {
        if (index > -1) {
            scope.files.splice(index, 1);
            if(scope.files.length == 0) {
                scope.perscriptionForm.files.$dirty = true;
                scope.perscriptionForm.files.$invalid = true;
            }
        }
    }


    scope.submitPrescription = function() {
        $window.scrollTo(0, 0);
        scope.perscriptionFormSubmitted = false;

        if (scope.files === undefined || scope.files === '' || scope.files.length == 0) {
            scope.perscriptionForm.files.$dirty = true;
            scope.perscriptionForm.files.$invalid = true;
            return false;
        }  else if (scope.customerName === undefined || scope.customerName === '') {
            scope.perscriptionForm.name.$dirty = true;
            scope.perscriptionForm.name.$invalid = true;
            return false;
        }  else if (scope.customerNo === undefined || scope.customerNo === '') {
            scope.perscriptionForm.customerno.$dirty = true;
            scope.perscriptionForm.customerno.$invalid = true;
            return false;
        }
  
        var requestData = {
            "name":scope.customerName,
            "mobile":scope.customerNo, 
            "source": "web",
            "utmid" : scope.utmid
        };

        angular.forEach(scope.files, function (item, key) {
            requestData['image'+(key+1)] = encodeURIComponent(item['image']);
        });
        
        scope.loaderVar = true;
        var prescriptionURL  = ConstConfig.paymentUrl + "service/LeadActionController/uploadDoctorPrescription";

        doPostWithOutToken($http, prescriptionURL, requestData, "", function(data) {
            if (data.status) {
                scope.loaderVar = false;
                /* For Analytics - Upload Prescription */
                $analytics.eventTrack('Upload Prescription Successfully for '+scope.utmid, {
                    category: 'Upload Prescription',
                    label: scope.customerNo,
                    value: scope.customerName
                });

                $window.scrollTo(0, 0);
                scope.files = [];
                scope.customerName = '';
                scope.customerNo = '';

                scope.perscriptionForm.name.$dirty = false;
                scope.perscriptionForm.customerno.$dirty = false;
                scope.perscriptionForm.files.$dirty = false;

                scope.uploadSuccess = true;

                $timeout(function() {
                    scope.uploadSuccess = false;
                }, 9000);
            }
            else {
                scope.loaderVar = false;
                $window.alert("Something Wrong. Try Again.");
            }
        });
    }

    scope.addAnotherPrescription = function() {
        scope.uploadSuccess = false;
    }

}
