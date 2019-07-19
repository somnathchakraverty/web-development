App.controller('uploadPrescriptionController', uploadPrescriptionController);
uploadPrescriptionController.$inject = ['$scope', '$rootScope', '$location', '$anchorScroll', 'DashboardService', 'BookOrderService', '$timeout', '$window', 'cartService', 'ConstConfig', '$http', '$state', '$analytics'];

function uploadPrescriptionController(scope, $rootScope, $location, $anchorScroll, DashboardService, BookOrderService, $timeout, $window, cartService, ConstConfig, $http, $state, $analytics) {
    
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

    scope.uploadSuccess = false;
    scope.files = [];
    
    scope.cust_id = '';

    scope.checkLogin = function() {
        if (localStorage.getItem("isLogin") == 'true') {
            var user = JSON.parse(localStorage.getItem("user"));
            var mobile_no = user.mobile;

            if ($state.current.name === 'feedback'){
                scope.customerName = user.name;
                scope.customerNo = mobile_no;
                scope.customerEmail = user.email;

                scope.cust_id = user.user_id;
            }
            else {
                scope.customerName = user.name;
                scope.customerNo = mobile_no;
                scope.cust_id = user.user_id;
            }
            
        }
    }

    scope.onLoad = function (e, reader, file, fileList, fileOjects, fileObj) {
        var sizeErrorExists = false;
        
        if(scope.files.length <=3) {
            angular.forEach(scope.files, function (item, key) {
                if(!sizeErrorExists) {
                    if((item.filesize / 1000) < 2048) {
                        scope.files[key]['image'] = 'data:' + item.filetype + ';base64,' + item.base64;
                    } 
                    else {
                        scope.files = [];
                        sizeErrorExists = true;
                        $window.alert("Image size should not be exceeded 2 MB");
                    }
                }
            });
        }
        else {
            scope.files = scope.files.slice(0,3);
            angular.forEach(scope.files, function (item, key) {
                if(!sizeErrorExists) {
                    if((item.filesize / 1000) < 2048) {
                        scope.files[key]['image'] = 'data:' + item.filetype + ';base64,' + item.base64;
                    } 
                    else {
                        scope.files = [];
                        sizeErrorExists = true;
                        $window.alert("Image size should not be exceeded 2 MB");                        
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


    scope.showOTP = false;
    scope.submitPrescription = function() {
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
            scope.showOTP = false;
            return false;
        }
        else {
            scope.showOTP = true;
        }

        if(typeof scope.userOTP === 'undefined' && scope.showOTP) {
            /* OTP Generation */
            var opts = {
                mobile_number: scope.customerNo,
                template : 'prescription'
            };

            /* For Analytics - Upload Prescription */
            $analytics.eventTrack('Request OTP', {
                category: 'Upload Prescription',
                label: scope.customerNo,
                value: scope.customerName
            });

            var generateOTPURL  = ConstConfig.serverUrl + "commonservice/generate_otp_for_callback";
            doPostWithOutToken($http, generateOTPURL, opts, "", function(data) {
                if (data.status == true) {
                    scope.callbackopt_success = true;
                    scope.callbackopt_error = false;
                    scope.callbackopt_success_message = "OTP has been sent to your above mobile number.";             
                } else {
                    scope.callbackopt_error = true;
                    scope.callbackopt_success = false;
                    scope.callbackopt_message = data.message;
                }

                $timeout(function() {
                    scope.callbackopt_error = false;
                    scope.callbackopt_success = false;
                    scope.callbackopt_message = '';
                    scope.callbackopt_success_message = '';
                }, 3000);
            });
        }
        else {

            if (scope.userOTP === undefined || scope.userOTP === '') {
                scope.perscriptionForm.userotp.$dirty = true;
                scope.perscriptionForm.userotp.$invalid = true;
                return false;
            } 

            var opts = {
                mobile_number: scope.customerNo,
                otp: scope.userOTP
            };

            var validateOTPURL  = ConstConfig.serverUrl + "commonservice/validate_otp_for_callback";
            doPostWithOutToken($http, validateOTPURL, opts, "", function(data) {
                if (data.status == true) {
                    var requestData = {
                        "name":scope.customerName,
                        "mobile":scope.customerNo, 
                        "source": "web"   
                    };

                    angular.forEach(scope.files, function (item, key) {
                        requestData['image'+(key+1)] = encodeURIComponent(item['image']);
                    });
                    
                    var prescriptionURL  = ConstConfig.paymentUrl + "service/LeadActionController/uploadDoctorPrescription";

                    doPostWithOutToken($http, prescriptionURL, requestData, "", function(data) {
                        if (data.status) {
                            /* For Analytics - Upload Prescription */
                            $analytics.eventTrack('Upload Prescription Successfully', {
                                category: 'Upload Prescription',
                                label: scope.customerNo,
                                value: scope.customerName
                            });


                            $window.scrollTo(0, 0);
                            scope.files = [];
                            scope.customerName = '';
                            scope.customerNo = '';
                            scope.userOTP = undefined;

                            scope.perscriptionForm.name.$dirty = false;
                            scope.perscriptionForm.customerno.$dirty = false;
                            scope.perscriptionForm.files.$dirty = false;
                            scope.perscriptionForm.userotp.$dirty = false;

                            scope.showOTP = false;
                            scope.uploadSuccess = true;

                            $timeout(function() {
                                scope.uploadSuccess = false;
                            }, 9000);
                        }
                        else {
                            $window.alert("Something Wrong. Try Again.");
                        }
                    });
                }
                else {
                    scope.userOTP = '';
                    scope.callbackopt_error = true;
                    scope.callbackopt_success = false;
                    scope.callbackopt_message = data.message;

                    $timeout(function() {
                        scope.callbackopt_error = false;
                        scope.callbackopt_success = false;
                        scope.callbackopt_message = '';
                        scope.callbackopt_success_message = '';
                    }, 3000);
                }
            });
        }        
    }

    scope.hideOTP = function() {
        scope.showOTP = false;
    }

    scope.resend_callback_opt = function() {
        if (scope.customerNo === undefined || scope.customerNo === '') {
            scope.perscriptionForm.customerno.$dirty = true;
            scope.perscriptionForm.customerno.$invalid = true;
            scope.showOTP = false;
            return false;
        }

        if(scope.customerNo) {
            var opts = {
                mobile_number: scope.customerNo,
                template : 'prescription'
            };

            /* For Analytics - Upload Prescription */
            $analytics.eventTrack('Resend OTP', {
                category: 'Upload Prescription',
                label: scope.customerNo
            });

            var resendOTPURL  = ConstConfig.serverUrl + "commonservice/resend_otp_for_callback";
            doPostWithOutToken($http, resendOTPURL, opts, "", function(data) {
                if (data.status == true) {
                    scope.callbackopt_success = true;
                    scope.callbackopt_success_message = data.message;

                    scope.userOTP = undefined;
                    scope.perscriptionForm.userotp.$dirty = false;

                    $timeout(function() {
                        scope.callbackopt_error = false;
                        scope.callbackopt_message = '';
                        scope.callbackopt_success = false;
                        scope.callbackopt_success_message = '';
                    }, 3000);
                }
                else {
                    scope.callbackopt_error = true;
                    scope.callbackopt_message = data.message;

                    $timeout(function() {
                        scope.callbackopt_error = false;
                        scope.callbackopt_message = '';
                    }, 3000);
                }
            });
        }        
    }
    
    scope.addAnotherPrescription = function() {
        scope.uploadSuccess = false;
    }

    scope.checkLogin();

    // For File Upload
    //http://embed.plnkr.co/MTzfQASN8ZVeocAq7VcM/preview
    scope.labVisitError = false;
    scope.labVisitSuccess = false;

    scope.sendDetails = function() {

        var g_recaptcha_response = grecaptcha.getResponse(widgetIdLAB);

        scope.addLeadFormSubmitted = false;

        if (scope.addLeadForm.customerName === undefined || scope.addLeadForm.customerName === '') {
            scope.addLeadForm.name.$dirty = true;
            scope.addLeadForm.name.$invalid = true;
            //scope.addLeadForm.name.$error.required = true;
            return false;
        } else if (scope.addLeadForm.customerEmail === undefined || scope.addLeadForm.customerEmail === '') {
            scope.addLeadForm.customeremail.$dirty = true;
            scope.addLeadForm.customeremail.$invalid = true;
            //scope.addLeadForm.customeremail.$error.required = true;
            return false;
        } else if (scope.addLeadForm.customerNo === undefined || scope.addLeadForm.customerNo === '') {
            scope.addLeadForm.customerno.$dirty = true;
            scope.addLeadForm.customerno.$invalid = true;
            //scope.addLeadForm.customerno.$error.required = true;
            return false;
        }  

        if(g_recaptcha_response.length == 0) {
            $window.alert("Please check Captcha Checkbox");
            return false;
        }
        
        scope.labVisitError = false;
        scope.labVisitSuccess = false;

        var requestData = {
            "data":  {               
                "name":scope.addLeadForm.customerName,
                "email":scope.addLeadForm.customerEmail,
                "contact_number":scope.addLeadForm.customerNo,
                "message": scope.addLeadForm.Message,
                "source": "web",
                "g_recaptcha_response": g_recaptcha_response
            }
        };

        if (isMobile.any()) {
            requestData["data"]["source"] = "mobile";
        }

        /* For Analytics - Lab visit */
        $analytics.eventTrack('Lab visit Request', {
            category: 'Lab visit',
            label: scope.addLeadForm.customerEmail,
            value: scope.addLeadForm.customerNo
        });

        var url = ConstConfig.couponUrl + "webv1/web_api/saveLabVisitRequestData";

        doPostWithOutToken($http, url, requestData, "", function(data) {
            if (data.status) {
                if (isMobile.any()) {
                    $window.scrollTo(0, 0);
                }
                scope.addLeadForm.customerName = '';
                scope.addLeadForm.customerEmail = '';
                scope.addLeadForm.customerNo = '';
                scope.addLeadForm.Message = '';

                scope.addLeadForm.name.$dirty = false;
                scope.addLeadForm.customerno.$dirty = false;
                scope.addLeadForm.customeremail.$dirty = false;

                scope.labVisitError = false;
                scope.labVisitSuccess = true;
            }
            else {
                scope.labVisitError = true;
                scope.labVisitSuccess = false;
            }

            grecaptcha.reset(widgetIdLAB);

            $timeout(function() {
                scope.labVisitError = false;
                scope.labVisitSuccess = false;
            }, 6000);

        });        
    }


    /* Feedback Starts */
    scope.feedbackError = false;
    scope.feedbackSuccess = false;

    scope.sendFeedbackDetails = function() {

        var g_recaptcha_response = grecaptcha.getResponse(widgetIdFeedback);

        scope.addFeedbackFormSubmitted = false;

        if (scope.customerName === undefined || scope.customerName === '') {
            scope.addFeedbackForm.name.$dirty = true;
            scope.addFeedbackForm.name.$invalid = true;
            return false;
        }  else if (scope.customerNo === undefined || scope.customerNo === '') {
            scope.addFeedbackForm.customerno.$dirty = true;
            scope.addFeedbackForm.customerno.$invalid = true;
            return false;
        } 
        else if (scope.customerEmail === undefined || scope.customerEmail === '') {
            scope.addFeedbackForm.customeremail.$dirty = true;
            scope.addFeedbackForm.customeremail.$invalid = true;
            return false;
        }
        else if (scope.issuetype === undefined || scope.issuetype === '') {
            scope.addFeedbackForm.issue_type.$dirty = true;
            scope.addFeedbackForm.issue_type.$invalid = true;
            return false;
        } 
        else if (scope.Message === undefined || scope.Message === '') {
            scope.addFeedbackForm.message.$dirty = true;
            scope.addFeedbackForm.message.$invalid = true;
            return false;
        }

        if(scope.show_booking) {
            if (scope.booking_id === undefined || scope.booking_id === '') {
                scope.addFeedbackForm.bookingid.$dirty = true;
                scope.addFeedbackForm.bookingid.$invalid = true;
                return false;
            }
        }

        if(g_recaptcha_response.length == 0) {
            $window.alert("Please check Captcha Checkbox");
            return false;
        }

        scope.feedbackError = false;
        scope.feedbackSuccess = false;

        var issue_dept = scope.issuetype.split("_");

        var requestData = {                   
            "internal": 0,
            "booking_id": '',
            "cust_id": scope.cust_id,
            "customer_name": scope.customerName,
            "email_id": scope.customerEmail,
            "phone_number": scope.customerNo,
            "create_ticket_type": 1,
            "issue_type": issue_dept[0],
            "department": issue_dept[1],
            "ticket_priority_name": "medium",
            "ticket_priority_id": 2,
            "status": "1",
            "ticket_category": "1",
            "subject": "Ticket from Web",
            "format": "string",
            "message": scope.Message,
            "source": "web",
            "g_recaptcha_response": g_recaptcha_response
        }

        if(scope.show_booking) {
            requestData["booking_id"] = scope.booking_id;
            requestData["booking_required"] = 1;
        }
        else {
            requestData["booking_required"] = 0;
        }

        if(issue_dept[0] == 12) {
            requestData["create_ticket_type"] =  4;
        }

        /* For Analytics - Feedback */
        $analytics.eventTrack('Send Feedback', {
            category: 'Feedback',
            label: scope.customerNo,
            value: scope.customerEmail
        });

        var url = ConstConfig.paymentUrl + "service/ticket_management/createTicket";

        doPostWithOutToken($http, url, requestData, "", function(data) {
            if (data.status) {
                $window.scrollTo(0, 0);
                scope.customerName = '';
                scope.customerEmail = '';
                scope.customerNo = '';
                scope.Message = '';
                
                scope.issuetype = '';

                scope.addFeedbackForm.name.$dirty = false;
                scope.addFeedbackForm.customerno.$dirty = false;
                scope.addFeedbackForm.customeremail.$dirty = false;
                scope.addFeedbackForm.issue_type.$dirty = false;
                scope.addFeedbackForm.message.$dirty = false;

                if(scope.show_booking) {
                    scope.booking_id = '';
                    scope.addFeedbackForm.bookingid.$dirty = false;
                    scope.show_booking = false;
                }

                scope.feedbackError = false;
                scope.feedbackSuccess = true;
            }
            else {
                scope.feedbackErrorMsg = data.message;
                scope.feedbackError = true;
                scope.feedbackSuccess = false;
            }

            grecaptcha.reset(widgetIdFeedback);

            $timeout(function() {
                scope.feedbackError = false;
                scope.feedbackSuccess = false;
            }, 6000);

        });        
    }
    scope.issuetype_list = [];

    if ($state.current.name === 'feedback'){
        /* Get Issue Type */
        var url = ConstConfig.paymentUrl + "service/ticket_management/getIssueTypes";
        doGet($http, url, function(data) {
            if(data.status) {
                scope.issuetype_list = data.data;
            }
        });

    }

    scope.show_booking = false;

    scope.change_query = function() {

        if(scope.issuetype !== undefined || scope.issuetype !== '') {
            var issue_dept = scope.issuetype.split("_");
            
            if(_.contains([10, 19, 20, 21, 24], parseInt(issue_dept[0]))) {
                scope.show_booking = false;
            }
            else {
                scope.show_booking = true;
            }
        }
        else {
            scope.show_booking = false;
        }
    }

    scope.$on('showUserInfoFeedback', function(event, data) {        
        scope.checkLogin();
    });
}
