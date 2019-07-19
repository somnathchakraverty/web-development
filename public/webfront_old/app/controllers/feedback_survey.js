App.controller('phelboFeedbackController', phelboFeedbackController);
phelboFeedbackController.$inject = ['$scope', '$timeout', '$rootScope', '$location', '$http', '$stateParams', 'ConstConfig', '$analytics', '$window'];

function phelboFeedbackController(scope, $timeout, $rootScope, $location, $http, $stateParams, ConstConfig, $analytics, $window) {

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

    $rootScope.meta_robots = "noindex, nofollow";

    scope.totalQuestion = 5;

    scope.quest = {};
    for (var i=1; i<=scope.totalQuestion; i++) {
        if(i === 1) {
            scope.quest['q'+i] = true;
             scope.current = 1;
        }
        else {
            scope.quest['q'+i] = false;
        }
        scope.quest['q'+i+'_select'] = '';   
    }

	scope.datasuccess = false;
    scope.stateParms = $stateParams;

    if($location.search().booking_id && $location.search().mobile) {
        if(scope.stateParms.mobile !== 'undefined') {
    		scope.mobile = scope.stateParms.mobile;
    	}

    	if(scope.stateParms.booking_id !== 'undefined') {
    		scope.booking_id = scope.stateParms.booking_id;
    	}

        if(scope.stateParms.click_source !== 'undefined') {
            scope.click_source = scope.stateParms.click_source;
        }
        else {
            scope.click_source = '';
        }
    }
    else {
    	$window.location.href = "/";
    }

    scope.submit_feedback = function() {
        if (scope.on_time_blood_collection === undefined || scope.on_time_blood_collection === '') {
            scope.phelboForm.blood_collection.$dirty = true;
            scope.phelboForm.blood_collection.$invalid = true;
            return false;
        }  else if (scope.add_on_status === undefined || scope.add_on_status === '') {
            scope.phelboForm.add_on.$dirty = true;
            scope.phelboForm.add_on.$invalid = true;
            return false;
        }  else if (scope.sample_collection_experience === undefined || scope.sample_collection_experience === '') {
            scope.phelboForm.sample_satisfied.$dirty = true;
            scope.phelboForm.sample_satisfied.$invalid = true;
            return false;
        }  else if (scope.future_discount_status === undefined || scope.future_discount_status === '') {
            scope.phelboForm.discount_booking.$dirty = true;
            scope.phelboForm.discount_booking.$invalid = true;
            return false;
        }  else if (scope.rating_info === undefined || scope.rating_info === '') {
            scope.phelboForm.rating.$dirty = true;
            scope.phelboForm.rating.$invalid = true;
            return false;
        }

        var ratinfo = scope.rating_info;

        if (isMobile.any()) {
            var source = 'mobile';
        }
        else {
            var source = 'web';
        }

        var requestData = {
			"data": {
				"booking_id" : scope.booking_id,
				"mobile" : scope.mobile,
				"source" : source,
				"on_time_blood_collection" : scope.on_time_blood_collection,
				"properly_dressed" : scope.add_on_status,
				"informed_sealed_kit" : scope.sample_collection_experience,
				"show_tech_process_video" : scope.future_discount_status,
                "rating": scope.rating_info,
                "click_source": scope.click_source
			}
		}

		var url = ConstConfig.couponUrl + "webv1/web_api/phelboFeedback";

        doPostWithOutToken($http, url, requestData, "", function(data) {
            if (data.status) {
            	scope.datasuccess = true;
            	
            	scope.on_time_blood_collection = "";
            	scope.add_on_status = "";
            	scope.sample_collection_experience = "";
            	scope.future_discount_status = "";
            	scope.tollfree_contact_info = "";
                scope.rating_info = "";

                $timeout(function() {
                    if(parseInt(ratinfo) <=4) {
                        $window.location.href = "feedback";
                    }
                    else {
                        $window.location.href = "https://www.google.co.in/search?q=healthians&rlz=1C1CHZL_enIN755IN755&oq=healthians&aqs=chrome..69i57j69i60l5.2969j0j1&sourceid=chrome&ie=UTF-8#lrd=0x390d181ccee9abed:0x52c074ac3118ef36,3";
                    }
                }, 3000);


            } else {
                alert(data.message);
            }
        });
    }



    scope.clickRadio = function(ques, option) {
        scope.current = ques;
        if(ques === 5) {
            //angular.element('#q'+ques+'_div').fadeOut();
            scope.quest['q'+ques+'_select'] = option;
            scope.submit_feedback();
        }
        else {
            scope.quest['q'+ques+'_select'] = option; 
            angular.element('#q'+ques+'_div').fadeOut();

            $timeout(function() {
                scope.quest['q'+ques] = false;
                var nextquest = parseInt(ques)+1;

                angular.element('#q'+nextquest+'_div').fadeIn();
                scope.quest['q'+nextquest] = true;
                
                scope.current = nextquest;
                angular.element('#next_q'+ques).css('display', 'block');       
            }, 500);
        }
        
    }

    scope.showPrevious = function() {
        var prev_ques = parseInt(scope.current)-1;
        // scope.current = prev_ques;
        var cur_quest = parseInt(scope.current);
        angular.element('#q'+cur_quest+'_div').fadeOut();
        scope.quest['q'+cur_quest] = false;

        angular.element('#q'+prev_ques+'_div').fadeIn();
        scope.quest['q'+prev_ques] = true;    
        scope.current = prev_ques;    
    }

    scope.showNext = function() {
        var next_ques = parseInt(scope.current)+1;
        // scope.current = prev_ques;
        var cur_quest = parseInt(scope.current);
        angular.element('#q'+cur_quest+'_div').fadeOut();
        scope.quest['q'+cur_quest] = false;

        angular.element('#q'+next_ques+'_div').fadeIn();
        scope.quest['q'+next_ques] = true;    
        scope.current = next_ques;    
    }
}

App.controller('generalFeedbackController', generalFeedbackController);
generalFeedbackController.$inject = ['$scope', '$timeout', '$rootScope', '$location', '$http', '$stateParams', 'ConstConfig', '$analytics', '$window'];

function generalFeedbackController(scope, $timeout, $rootScope, $location, $http, $stateParams, ConstConfig, $analytics, $window) {

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

    $rootScope.meta_robots = "noindex, nofollow";

    scope.datasuccess = false;
    scope.stateParms = $stateParams;

    if($location.search().booking_id && $location.search().mobile && $location.search().click_source) {
        if(scope.stateParms.mobile !== 'undefined') {
            scope.mobile = scope.stateParms.mobile;
        }

        if(scope.stateParms.booking_id !== 'undefined') {
            scope.booking_id = scope.stateParms.booking_id;
        }

        if(scope.stateParms.click_source !== 'undefined') {
            scope.click_source = scope.stateParms.click_source;
        }
    }
    else {
        $window.location.href = "/";
    }

    scope.totalCategory = 4;

    scope.answers = [];

    scope.options = {};

    scope.quest = {
        'category': false,
        'rating': true,
        'bad_feedback': false,
        'good_feedback': false
    };

    for (var i=1; i<=scope.totalCategory; i++) {
        scope.quest['good_cat'+i] = false;
        scope.quest['bad_cat'+i] = false;
    }

    scope.showRating = function() {
        scope.quest['rating'] = true;
        scope.quest['category'] = false;
    }

    scope.clickRating = function() {
        $window.scrollTo(0, 0);
        scope.quest['rating'] = false;
        scope.quest['category'] = true;

        if(scope.rating_info < 4) {
            scope.rating = 'bad';
        }
        else {
            scope.rating = 'good';
        }
    }

    scope.clickRadio = function(value, v1) {
        if(scope.options[v1]) {
            var findExist = _.indexOf(scope.answers, value); 
            if(findExist < 0) {
                scope.answers.push(value);
            }            
        }
        else {
            var findExist = _.indexOf(scope.answers, value);
            if(findExist > -1) {
                scope.answers.splice(findExist, 1);
            }            
        }
    }
    scope.clickCategoryDiv = function(val1) {
        if(val1 === 'Order Booking Process') {
            scope.category = 'Order Booking Process';
        }
        else if(val1 === 'Sample Collection') {
            scope.category = 'Sample Collection';
        }
        else if(val1 === 'Test Reports') {
            scope.category = 'Test Reports';
        }
        else {
            scope.category = 'Doctor Consultation';
        }
        scope.clickCategory();
    }

    scope.clickCategory = function() {
        $window.scrollTo(0, 0);
        
        $timeout(function() {
            scope.quest['category'] = false;
        }, 400);

        if(scope.category === 'Order Booking Process') {
            scope.cat = 'cat1';
        }
        else if(scope.category === 'Sample Collection') {
            scope.cat = 'cat2';
        }
        else if(scope.category === 'Test Reports') {
            scope.cat = 'cat3';
        }
        else {
            scope.cat = 'cat4';
        }

        $.each(scope.options, function(index, value) {
            scope.options[index] = false;
        });

        $timeout(function() {
            angular.element('#'+scope.rating + '_' +scope.cat).fadeIn();
            scope.quest[scope.rating + '_' +scope.cat] = true;
        }, 500);
    }

    scope.clickSubmit = function() {

        $window.scrollTo(0, 0);
        angular.element('#'+scope.rating + '_' +scope.cat).fadeOut();

        $timeout(function() {
            scope.quest[scope.rating + '_' +scope.cat] = false;
            angular.element('#next_'+scope.rating+'_'+scope.cat).css('display', 'block');
            
            if(scope.rating === 'bad') {
                angular.element('#bad_feedback').fadeIn();
                scope.quest['bad_feedback'] = true;
            }
            else {
                angular.element('#good_feedback').fadeIn();
                scope.quest['good_feedback'] = true;
            }            
        }, 500);
        
    }

    scope.showCategory = function() {
        scope.answers = [];
        angular.element('#'+scope.rating + '_' +scope.cat).fadeOut();
        $timeout(function() {
            scope.quest[scope.rating + '_' +scope.cat] = false;
            scope.quest['category'] = true;            
        }, 500);
    }

    scope.showPrevious = function() {
        if(scope.rating === 'bad') {
            angular.element('#bad_feedback').fadeOut();

            $timeout(function() {
                scope.quest['bad_feedback'] = false;
                scope.quest[scope.rating + '_' +scope.cat] = true;
                angular.element('#'+scope.rating + '_' +scope.cat).fadeIn();
            }, 500);
        }
        else {
            angular.element('#good_feedback').fadeOut();
            
            $timeout(function() {
                scope.quest['good_feedback'] = false;
                scope.quest[scope.rating + '_' +scope.cat] = true;
                angular.element('#'+scope.rating + '_' +scope.cat).fadeIn();
            }, 500);
        }
    }

    scope.submit_feedback = function() {
        
        var requestData = {
			"data": {
				"booking_id" : scope.booking_id,
				"mobile" : scope.mobile,
				"source" : "web",
				"click_source": scope.click_source,
				"rating" : scope.rating_info,
                "category": scope.category,
				"feedback_answers" : scope.answers.join()				
			}
		}

        if(scope.rating === 'bad') {
            requestData["data"]["message"] = scope.improvement_msg;
            scope.quest.bad_feedback = false;
        }
        else {
            requestData["data"]["message"] = scope.feedback_msg;
            scope.quest.good_feedback = false;
        }

		var url = ConstConfig.couponUrl + "webv1/web_api/generalFeedback";

        doPostWithOutToken($http, url, requestData, "", function(data) {
            $window.scrollTo(0, 0);
            if (data.status) {
            	scope.datasuccess = true;
                if(scope.rating === 'bad') {                    
                    scope.thankyou_improved = true;
                }
                else {                    
                    scope.thankyou_good = true;
                    $timeout(function() {
                        if(scope.rating_info == 5) {
                            $window.location.href = "https://www.google.co.in/search?q=healthians&rlz=1C1CHZL_enIN755IN755&oq=healthians&aqs=chrome..69i57j69i60l5.2969j0j1&sourceid=chrome&ie=UTF-8#lrd=0x390d181ccee9abed:0x52c074ac3118ef36,3";
                        }                        
                    }, 3000);
                }
            } else {
                alert(data.message);
            }
        });
    }
}

App.controller('csatFeedbackController', csatFeedbackController);
csatFeedbackController.$inject = ['$scope', '$timeout', '$rootScope', '$location', '$http', '$stateParams', 'ConstConfig', '$analytics', '$window'];

function csatFeedbackController(scope, $timeout, $rootScope, $location, $http, $stateParams, ConstConfig, $analytics, $window) {

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

    $rootScope.meta_robots = "noindex, nofollow";
    scope.stateParms = $stateParams;

    if(scope.stateParms.csid !== 'undefined') {
        scope.csid = scope.stateParms.csid;
    }
    else {
        $window.location.href = "/";
    }    

    scope.feedback_success = false;
    scope.clickRating = function() {

        if(scope.rating_info < 4) {
            scope.rating = 'bad';
        }
        else {
            scope.rating = 'good';
        }
    }

    scope.getReasons = function() {
        /* Get Issue Type */
        var url = ConstConfig.couponUrl + "webv1/web_api/getCSATReasons";
        doGet($http, url, function(data) {
            if(data.status) {
                scope.reasons_list = data.data;
            }
        });
    }

    scope.getReasons();

    scope.save_survey = function() {

        if (scope.rating_info === undefined || scope.rating_info === '') {
            scope.addCSATForm.rating.$dirty = true;
            scope.addCSATForm.rating.$invalid = true;
            return false;
        }  else if (scope.reason === undefined || scope.reason === '') {
            scope.addCSATForm.reason.$dirty = true;
            scope.addCSATForm.reason.$invalid = true;
            return false;
        } 

        scope.feedback_success = true;
        var ratinfo = scope.rating_info;

        if (isMobile.any()) {
            var source = 'mobile';
        }
        else {
            var source = 'web';
        }

        var requestData = {
            "data": {
                "ucid" : scope.csid,
                "source" : source,
                "cs_reason" : scope.reason,
                "remarks" : scope.remarks,
                "rating": scope.rating_info
            }
        }

        var url = ConstConfig.couponUrl + "webv1/web_api/saveCSAT";

        doPostWithOutToken($http, url, requestData, "", function(data) {
            if (data.status) {
                scope.feedback_success = true;
                
                scope.remarks = "";
                scope.reason = "";
                scope.rating_info = "";

                scope.addCSATForm.rating.$dirty = false;
                scope.addCSATForm.reason.$dirty = false;
                scope.addCSATForm.remarks.$dirty = false;

                $timeout(function() {
                    scope.feedback_success = false;
                }, 5000);
            } else {
                scope.feedback_success = false;
                alert(data.message);
            }
        });
    }    
}