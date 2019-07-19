App.controller('missedcallController', missedcallController);
missedcallController.$inject = ['$scope', '$timeout', '$rootScope', '$location', '$http', '$stateParams', 'ConstConfig', '$analytics'];

function missedcallController(scope, $timeout, $rootScope, $location, $http, $stateParams, ConstConfig, $analytics) {

    scope.stateParms = $stateParams;
    $rootScope.meta_robots = "noindex, nofollow";
    
    if (scope.stateParms) {
    	if(scope.stateParms.phone_number !== 'undefined') {
    		scope.phone_number = scope.stateParms.phone_number;

	        var requestData = {
	            "data": {
	                "mobile": scope.phone_number,
	                "source": "web"
	            }
	        };
	        
	        var url = ConstConfig.couponUrl + "webv1/web_api/saveMissedCallCompaignData";

	        doPostWithOutToken($http, url, requestData, "", function(data) {
	            if (data.status) {
	            	if(data.mobile !== 'undefined') {
	            		/* For Analytics - Misscall */
				        $analytics.eventTrack('Misscall Captured', {
				            category: 'Misscall',
				            label: "phone",
				            value: data.mobile
				        });
	            	}            	
	            } else {
	                alert(data.message);
	            }
	        });
    	}
        

    }
}

App.controller('lifestyleController', lifestyleController);
lifestyleController.$inject = ['$scope', '$timeout', '$rootScope', '$location', '$http', '$stateParams', 'ConstConfig', '$analytics'];

function lifestyleController(scope, $timeout, $rootScope, $location, $http, $stateParams, ConstConfig, $analytics) {

    scope.stateParms = $stateParams;
    if (scope.stateParms) {
    	if(scope.stateParms.id !== 'undefined') {

    		scope.id = scope.stateParms.id;
	        $rootScope.og_url = "https://goo.gl/deRpjb";

	        var url = ConstConfig.serverUrl + "commonservice/getLifestylePath";
	        var requestData = {	            
	            "id": scope.id	           
	        };

	        doPostWithOutToken($http, url, requestData, "", function(data) {
	            if (data.status) {
	            	scope.image_path = data.data;
	            	$rootScope.og_image = scope.image_path;
	            } else {
	                alert(data.message);
	            }
	        });
    	}
        

    }
}


App.controller('technicalVideoController', technicalVideoController);
technicalVideoController.$inject = ['$scope', '$timeout', '$rootScope', '$location', '$http', '$stateParams', 'ConstConfig', '$analytics', '$sce'];

function technicalVideoController(scope, $timeout, $rootScope, $location, $http, $stateParams, ConstConfig, $analytics, $sce) {
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

	var url = ConstConfig.couponUrl + "webv1/web_api/getTechVideo";
    
    doGet($http, url, function(data) {
        if (data.status) {
        	scope.videoURL = $sce.trustAsResourceUrl(data.data);
        } else {
            alert(data.message);
        }
    });

    if($location.search().booking_id && $location.search().mobile) {
        var booking_id = $stateParams.booking_id;
        var mobile = $stateParams.mobile;
        var d = new Date();
    	var currentDate = moment().format("YYYY-MM-DD");

    	if (isMobile.any()) {
            var source = 'mobile';
        }
        else {
            var source = 'web';
        }

        var url = ConstConfig.couponUrl + "Video_tracking/trackVideoDisplay";
        var requestData = {
			"data": 
			  {
				"booking_id": booking_id,
				"mobile": mobile,
				"video_start_time": currentDate +' '+ d.toLocaleTimeString(),
				"video_end_time": "null",
				"source": source,
				"video_duration": "",
				"video_seen": "1"
			  }
		};

        doPostWithOutToken($http, url, requestData, "", function(data) {});        
    }

}


App.controller('maternalSerumController', maternalSerumController);
maternalSerumController.$inject = ['$scope', '$timeout', '$rootScope', '$location', '$http', '$stateParams', 'ConstConfig', '$analytics','$window'];

function maternalSerumController(scope, $timeout, $rootScope, $location, $http, $stateParams, ConstConfig, $analytics,$window) {

		scope.stateParms = $stateParams;
		// scope.ivf_pregnancy = 'Yes';
		// scope.diabetic = 'Yes';
		// scope.smoking = 'Smoker';
		// scope.ntd = 'Yes';
		// scope.ds = 'Yes';
		scope.edd_type="lmp";
		scope.pregnancy_type="single";
		scope.booking_id = scope.stateParms.booking_id;
		scope.cust_id = scope.stateParms.customer_id;
		scope.preTestDataSuccess = false;
		scope.loaderVar=false;
		// console.log(scope.files);
		


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
                        $window.alert("Report size should not be exceeded 5 MB");
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
                        $window.alert("Report size should not be exceeded 5 MB");                        
                    }
                }                
            });
        }
    	};



		 var rData = {
			 	'data': {
			 		'booking_id':scope.booking_id,
			 		'customer_id':scope.cust_id,
			 		"source": "web"
	                }
	            }

		var userInfo  = ConstConfig.couponUrl + "webv1/web_api/getOrderCustomerDetails";
        doPostWithOutToken($http, userInfo, rData, "", function(data) { 
            	if (data.status == true) {
                    scope.name = data.data.name;
                    scope.age = data.data.age;
                    if(data.data.gender=='m' || data.data.gender=='M')
                    	scope.gender = "Male";  
                    if(data.data.gender=='f' || data.data.gender=='F')
                    	scope.gender = "Female";  
                }
            });


		scope.addMaternalSerumData = function() {

			// scope.loaderVar=true;
			// scope.preTestDataSuccess = false;


			 scope.maternalFormSubmitted = false;

			if (scope.ultrasound_date === undefined || scope.ultrasound_date === '' || scope.ultrasound_date.length == 0) {
	            scope.maternalserumForm.ultrasound_date.$dirty = true;
	            scope.maternalserumForm.ultrasound_date.$invalid = true;
	            return false;
	        }  else if (scope.usg_by_week === undefined || scope.usg_by_week === '') {
	            scope.maternalserumForm.usg_by_week.$dirty = true;
	            scope.maternalserumForm.usg_by_week.$invalid = true;
	            return false;
	        }  else if (scope.usg_by_day === undefined || scope.usg_by_day === '') {
	            scope.maternalserumForm.usg_by_day.$dirty = true;
	            scope.maternalserumForm.usg_by_day.$invalid = true;
	            return false;
	        }  else if (scope.edd === undefined || scope.edd === '') {
	            scope.maternalserumForm.edd.$dirty = true;
	            scope.maternalserumForm.edd.$invalid = true;
	            return false;
	        }  else if (scope.lmp === undefined || scope.lmp === '') {
	            scope.maternalserumForm.lmp.$dirty = true;
	            scope.maternalserumForm.lmp.$invalid = true;
	            return false;
	        } else if (scope.ivf_pregnancy === undefined || scope.ivf_pregnancy === '') {
	            scope.maternalserumForm.ivf_pregnancy.$dirty = true;
	            scope.maternalserumForm.ivf_pregnancy.$invalid = true;
	            return false;
	        } else if (scope.racial_origin === undefined || scope.racial_origin === '') {
	            scope.maternalserumForm.racial_origin.$dirty = true;
	            scope.maternalserumForm.racial_origin.$invalid = true;
	            return false;
	        } else if (scope.weight === undefined || scope.weight === '') {
	            scope.maternalserumForm.weight.$dirty = true;
	            scope.maternalserumForm.weight.$invalid = true;
	            return false;
	        } else if (scope.dob === undefined || scope.dob === '') {
	            scope.maternalserumForm.dob.$dirty = true;
	            scope.maternalserumForm.dob.$invalid = true;
	            return false;
	        } else if (scope.diabetic === undefined || scope.diabetic === '') {
	            scope.maternalserumForm.diabetic.$dirty = true;
	            scope.maternalserumForm.diabetic.$invalid = true;
	            return false;
	        } else if (scope.smoking === undefined || scope.smoking === '') {
	            scope.maternalserumForm.smoking.$dirty = true;
	            scope.maternalserumForm.smoking.$invalid = true;
	            return false;
	        } else if (scope.ntd === undefined || scope.ntd === '') {
	            scope.maternalserumForm.ntd.$dirty = true;
	            scope.maternalserumForm.ntd.$invalid = true;
	            return false;
	        } else if (scope.ds === undefined || scope.ds === '') {
	            scope.maternalserumForm.ds.$dirty = true;
	            scope.maternalserumForm.ds.$invalid = true;
	            return false;
	        } else if (scope.files === undefined || scope.files === '') {
	            scope.maternalserumForm.files.$dirty = true;
	            scope.maternalserumForm.files.$invalid = true;
	            return false;
	        } 

	        if(typeof scope.files === 'undefined'){
				scope.imagePath='';
			}else{
				scope.imagePath=scope.files["0"].image;
			}

	        // console.log(scope.files["0"].image);



			 var requestData = {
			 	'data': {
			 		'booking_id':scope.booking_id,
			 		'cust_id':scope.cust_id,
	                'ultrasound_date':scope.ultrasound_date,
	                'usg_by_week':scope.usg_by_week,
	                'usg_by_day':scope.usg_by_day,
	                'edd':scope.edd,
	                'edd_type' : scope.edd_type,
	                'lmp': scope.lmp,
	                'ivf_pregnancy' : scope.ivf_pregnancy,
	                'pregnancy_type': scope.pregnancy_type,
	                'racial_origin': scope.racial_origin,
	                'weight': scope.weight,
	                'diabetic': scope.diabetic,
	                'smoking':scope.smoking,
	                'ntd':scope.ntd,
	                'ds':scope.ds,
	                'source':'web',
	                'dob':scope.dob,
	                'image1':encodeURIComponent(scope.imagePath)
	            }
            };

            // angular.forEach(scope.files, function (item, key) {
            //             requestData['data']['image'+(key+1)] = encodeURIComponent(item['image']);
            // });

            scope.loaderVar=true;
            scope.maternalForm=true;
           	var savepreTestData  = ConstConfig.couponUrl + "webv1/web_api/setCustomerPretestInfo";
            doPostWithOutToken($http, savepreTestData, requestData, "", function(data) {
            	
                if (data.status == true) {
                	scope.loaderVar=false;
                	scope.preTestDataSuccess = true;
                	$timeout(function() {
	                    $window.location.href = "/";
	                }, 3000);

                    // scope.callbackopt_success = true;
                    // scope.callbackopt_error = false;
                    // scope.callbackopt_success_message = data.message;             
                } else {
                	scope.loaderVar=false;
                	scope.preTestDataSuccess = false;
                	scope.maternalForm=false;
                	$window.alert(data.message);
                    // scope.callbackopt_error = true;
                    // scope.callbackopt_success = false;
                    // scope.callbackopt_message = data.message;
                }

                
            });
		}
        

 }

App.controller('paytmPromoteController', paytmPromoteController);
paytmPromoteController.$inject = ['$scope', '$timeout', '$rootScope', '$location', '$http', '$stateParams', 'ConstConfig', '$analytics', '$sce', '$window', '$state'];

function paytmPromoteController(scope, $timeout, $rootScope, $location, $http, $stateParams, ConstConfig, $analytics, $sce, $window, $state) {
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

    scope.stateParms = $stateParams;
    scope.compaignmsg = false;

    scope.sendDetails = function() {
        scope.addLeadFormSubmitted = false;

        if($state.current.name === 'paytm') {
            scope.ga_category = 'Paytm Diabetes';
            scope.utm_id = 'paytm-diabetes';
            scope.remark_message = 'Customer search for : Diabetes';
            scope.redirect_link = "profile/hba1c";
        }
        if($state.current.name === 'hdfc') {
            scope.ga_category = 'HDFC HarDostFit';
            scope.utm_id = 'business-development';
            scope.remark_message = 'Customer search for : HarDostFit';
            scope.redirect_link = "package/healthians-hardostfit-package";
        }

        

        if (scope.customerNo === undefined || scope.customerNo === '') {
            scope.addLeadForm.customerno.$dirty = true;
            scope.addLeadForm.customerno.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Mobile No. not enter' });
            return false;
        }

        if (scope.addLeadForm.name.$invalid) {
            scope.addLeadForm.name.$dirty = true;
            scope.addLeadForm.name.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Name invalid' });
            return false;
        }

        if (scope.addLeadForm.customeremail.$invalid) {
            scope.addLeadForm.customeremail.$dirty = true;
            scope.addLeadForm.customeremail.$invalid = true;
            $analytics.eventTrack('Validation Fail', { category: scope.ga_category, label: 'Email invalid' });
            return false;
        }

        var requestData = {
            "data":  {
                "utm_id": scope.utm_id,
                "mobile":scope.customerNo,
            }
        };

        if (isMobile.any()) {
            requestData['data']['source'] = 'mobile';
        }
        else {
            requestData['data']['source'] = 'web';
        }

        if(typeof scope.customerName !== 'undefined') {
        	if(scope.customerName !== '') {
        		requestData['data']['name'] = scope.customerName;
        	}                    
        }

        if(typeof scope.customerEmail !== 'undefined') {
        	if(scope.customerEmail !== '') {
            	requestData['data']['email'] = scope.customerEmail;
            }
        }

        /* Capture Utm Parameters */
        if(typeof scope.stateParms.utm_source !== 'undefined') {
            requestData['data']['utm_source'] = scope.stateParms.utm_source;
        }
        if(typeof scope.stateParms.utm_campaign !== 'undefined') {
            requestData['data']['utm_campaign'] = scope.stateParms.utm_campaign;
        }
        if(typeof scope.stateParms.utm_medium !== 'undefined') {
            requestData['data']['utm_medium'] = scope.stateParms.utm_medium;
        }

        requestData['data']['message'] = scope.remark_message;

        if(localStorage.getItem("guid")) {
            requestData['data']['guid'] = localStorage.getItem("guid");
        }

        var url = ConstConfig.couponUrl + "webv1/web_api/saveEmailCompaignData";

        doPostWithOutToken($http, url, requestData, "", function(data) {
            if (data.status) {
            	scope.compaignmsg = true;

                var cphone = scope.customerNo;
                scope.customerName = '';
                scope.customerEmail = '';
                scope.customerNo = '';

                scope.addLeadForm.name.$dirty = false;
                scope.addLeadForm.customerno.$dirty = false;
                scope.addLeadForm.customeremail.$dirty = false;

                /* Expire Exit Popup */
                var now = new Date();
                var exp = new Date(now.getTime() + (1 * 24 * 60 * 60 * 1000));
                if (isMobile.any()) {
                    document.cookie = 'ExitPopupMobileCookie=1; expires=' + exp.toUTCString();
                    localStorage.setItem("isLeadCaptured", true);
                }
                else {
                    document.cookie = 'ExpirationCookieTest=1; expires=' + exp.toUTCString();
                    localStorage.setItem("isLeadCaptured", true);
                }

                /* Pixel Fire in case of new number */
                if(data.message === 'Lead successfully inserted') {
                    /* For Analytics - Payment Mode */
                    $analytics.eventTrack('Lead Captured', {
                        category: scope.ga_category,
                        label: cphone
                    });

                    if(typeof($window.fbq) !== 'undefined') {
                        $window.fbq('track', 'Lead', requestData);
                    }
                }
                $timeout(function() {
                    $('.modal-backdrop').remove();
                    $('.modal.in').find('button.close').click();
                    $window.location.href = scope.redirect_link;
                }, 4000);

            } else {
                alert(data.message);
            }
        });            
    }
}