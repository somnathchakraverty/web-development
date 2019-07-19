App.controller('healthKarmaController', healthKarmaController);
healthKarmaController.$inject = ['$scope', '$timeout', '$rootScope', '$location', '$http', '$stateParams', 'ConstConfig', '$analytics', '$window', 'searchDetail', '$state', 'Facebook'];

function healthKarmaController(scope, $timeout, $rootScope, $location, $http, $stateParams, ConstConfig, $analytics, $window, searchDetail, $state, Facebook) {

    scope.stateParms = $stateParams;
    scope.showMobile = false;
    scope.showQuestion = false;
    scope.showResult = false;
    scope.lifeStyleScore = 0;
    $rootScope.meta_robots = "noindex, nofollow";

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
        scope.mobileDisplay = true;
    }
    else {
        scope.mobileDisplay = false;
    }

    // $timeout(function() {
    //      scope.lifeStyleScore = 80;
    // }, 200);

    if ($location.search().user_id) {
        scope.user_id = scope.stateParms.user_id;
    } else {
        scope.user_id = '';

        if ($location.search().mobile) {
            scope.showMobile = false;
            scope.huserphone = scope.stateParms.mobile;
        } else {
            scope.showMobile = true;
        }
    }

    scope.answer = {};
    scope.qdatasuccess = false;

    scope.getQuestionList = function() {

        if (scope.huserName === undefined || scope.huserName === '') {
            scope.healthKarmaForm.huserName.$dirty = true;
            scope.healthKarmaForm.huserName.$invalid = true;
            scope.healthKarmaForm.huserName.$error.required = true;
            focus('huserName');
            return false;
        }

        if (scope.huserAge === undefined || scope.huserAge === '') {
            scope.healthKarmaForm.huserAge.$dirty = true;
            scope.healthKarmaForm.huserAge.$invalid = true;
            scope.healthKarmaForm.huserAge.$error.required = true;
            focus('huserAge');
            return false;
        }

        if (parseInt(scope.huserAge) < 5 || parseInt(scope.huserAge) > 120 || parseInt(scope.huserAge) <= 0) {
            scope.healthKarmaForm.huserAge.$dirty = true;
            scope.healthKarmaForm.huserAge.$invalid = true;
            scope.healthKarmaForm.huserAge.$error.pattern = true;
            focus('huserAge');
            return false;
        }

        if (scope.showMobile) {
            if (scope.huserphone === undefined || scope.huserphone === '') {
                scope.healthKarmaForm.huserphone.$dirty = true;
                scope.healthKarmaForm.huserphone.$invalid = true;
                scope.healthKarmaForm.huserphone.$error.required = true;
                focus('huserphone');
                return false;
            }
        }

        if (scope.husergender === undefined || scope.husergender === '' || scope.husergender === null) {
            scope.healthKarmaForm.husergender.$dirty = true;
            scope.healthKarmaForm.husergender.$invalid = true;
            scope.healthKarmaForm.husergender.$error.required = true;
            focus('husergender');
            return false;
        }

        if (scope.userheight === undefined || scope.userheight === '') {
            scope.healthKarmaForm.userheight.$dirty = true;
            scope.healthKarmaForm.userheight.$invalid = true;
            scope.healthKarmaForm.userheight.$error.required = true;
            focus('userheight');
            return false;
        }

        if (scope.userWeight === undefined || scope.userWeight === '') {
            scope.healthKarmaForm.userWeight.$dirty = true;
            scope.healthKarmaForm.userWeight.$invalid = true;
            scope.healthKarmaForm.userWeight.$error.required = true;
            focus('userweight');
            return false;
        }

        var requestData = {
            "data": {
                "catId": "1",
                "age": scope.huserAge,
                "gender": scope.husergender,
                "source": "web"
            }
        }

        var url = ConstConfig.couponUrl + "customer/account/getQuestions";
        scope.qdatasuccess = true;
        doPostWithOutToken($http, url, requestData, "", function(data) {
            scope.qdatasuccess = false;
            if (data.status) {
                scope.questionList = data.data;
                scope.totalQuestion = data.data.length;

                scope.questionList.forEach(function(ele, index) {
                    if (ele.question_type == 1) {
                        scope.answer[ele.question_id] = {};

                        ele.options.forEach(function(ele1, index1) {
                            scope.answer[ele.question_id][ele1.option_id] = false;
                        });
                    }
                });

                scope.quest = {};

                for (var i = 1; i <= scope.totalQuestion; i++) {
                    if (i === 1) {
                        scope.quest['q' + i] = true;
                        scope.current = 1;
                    } else {
                        scope.quest['q' + i] = false;
                    }
                    // scope.quest['q'+i+'_select'] = '';   
                }
                scope.showQuestion = true;
                scope.progress = 1;
                $window.scrollTo(0, 0);

            } else {
                alert(data.message);
            }
        });
    }

    //scope.getQuestionList();


    scope.datasuccess = false;

    scope.submit_feedback = function() {

        scope.check_last_question = false;

        if(typeof scope.answer['22'] !== 'undefined') {
            if(_.isObject(scope.answer['22'])) {
                _.each(scope.answer['22'], function(value, key) {
                    if (value) {
                        scope.check_last_question = value;
                    }
                });  
            }            
        }

        if(!scope.check_last_question) {
            $window.alert("Please select atleast one checkbox.");
            return false;
        }


        if (scope.healthKarmaEmail === undefined || scope.healthKarmaEmail === '') {
            scope.questionForm.healthkarma_email.$dirty = true;
            scope.questionForm.healthkarma_email.$invalid = true;
            scope.questionForm.healthkarma_email.$error.required = true;
            focus('healthkarma_email');
            return false;
        }

        var source = 'web';

        var requestData = {
            "data": {
                "age": scope.huserAge,
                "options": [],
                "height": scope.userheight,
                "name":  scope.huserName,
                "gender": scope.husergender,
                "weight": scope.userWeight,
                "cityId": JSON.parse(localStorage.getItem("cityID"))[0].city_id,
                "source": source,
                "email": scope.healthKarmaEmail
            }
        };

        if(scope.user_id !== '') {
            requestData["data"]["userId"] = scope.user_id;
        }
        else {
            // If logged in user has not encrypted user id in relatives
            if (localStorage.getItem("isLogin") == 'true') {
                requestData["data"]["userId"] = JSON.parse(localStorage.getItem("user")).user_id
            }
        }

        if(scope.showMobile) {
            requestData["data"]["contact_number"] = scope.huserphone;
        }

        if ($location.search().lead_id) {
            requestData["data"]["lead_id"] = scope.stateParms.lead_id;
        }

        if ($location.search().mobile) {
            requestData["data"]["contact_number"] = scope.stateParms.mobile;
        }

        scope.option_final = [];

        _.each(scope.answer, function(value, key) {
            if (_.isObject(value)) {
                var opt_check = [];
                _.each(value, function(value1, key1) {
                    if (value1) {
                        opt_check.push(key1);
                    }
                });
                var tt = {
                    "question_id": key,
                    "option_id": opt_check.join(',')
                }
                scope.option_final.push(tt);
            } else {
                var tt = {
                    "question_id": key,
                    "option_id": value
                }
                scope.option_final.push(tt);
            }
        });

        requestData["data"]["options"] = JSON.stringify(scope.option_final);

        scope.datasuccess = true;

        var url = ConstConfig.couponUrl + "customer/account/getHealthAssessment";

        doPostWithOutToken($http, url, requestData, "", function(data) {
            scope.datasuccess = false;
            if (data.status) {
                scope.showQuestion = false;
                scope.showResult = true;
                scope.resultData = data.data;

                scope.sharingurl = scope.resultData.webURL;

                $rootScope.og_image = scope.sharingurl;
                $rootScope.og_url = scope.sharingurl;

                $timeout(function() {
                    scope.lifeStyleScore = scope.resultData.lifeStyleScore;
                }, 200);

                scope.peerscore = scope.resultData.peerscore;

                if(scope.resultData.recommendedTests) {
                    scope.recommendedTests = scope.resultData.recommendedTests;
                    scope.recommendedTests.forEach(function(ele, index) {
                        scope.answer[ele.id] = true;
                    });
                }

                $window.scrollTo(0, 0);  
            } else {
                scope.showQuestion = true;
                scope.showResult = false;
                alert(data.message);
            }
        });
    }



    scope.clickRadio = function(ques) {
        scope.current = ques;

        scope.progress = parseInt((scope.current/scope.totalQuestion)*100);

        if (ques === scope.totalQuestion) {
            if (isMobile.any()) {
                $window.scrollTo(0,200);  
            }
        } else {
            angular.element('#q' + ques + '_div').fadeOut();

            $timeout(function() {
                scope.quest['q' + ques] = false;
                var nextquest = parseInt(ques) + 1;

                angular.element('#q' + nextquest + '_div').fadeIn();
                scope.quest['q' + nextquest] = true;

                scope.current = nextquest;
                angular.element('#next_q' + ques).css('opacity', '1');
                angular.element('#next_q' + ques).removeAttr("disabled", "disabled");

            }, 500);
        }

    }

    scope.showPrevious = function() {
        var prev_ques = parseInt(scope.current) - 1;
        // scope.current = prev_ques;
        var cur_quest = parseInt(scope.current);
        angular.element('#q' + cur_quest + '_div').fadeOut();
        scope.quest['q' + cur_quest] = false;

        angular.element('#q' + prev_ques + '_div').fadeIn();
        scope.quest['q' + prev_ques] = true;
        scope.current = prev_ques;
    }

    scope.showNext = function() {
        var next_ques = parseInt(scope.current) + 1;
        // scope.current = prev_ques;
        var cur_quest = parseInt(scope.current);
        angular.element('#q' + cur_quest + '_div').fadeOut();
        scope.quest['q' + cur_quest] = false;

        angular.element('#q' + next_ques + '_div').fadeIn();
        scope.quest['q' + next_ques] = true;
        scope.current = next_ques;
    }

    /* Call Back Phone */
    scope.callbackmsg = false;
    scope.callBackPhone = function() {
        if (localStorage.getItem("isLogin") == 'true') {
            var user = JSON.parse(localStorage.getItem("user"));
            var mobile_no = user.mobile;

            var request_data = {
                "data": {
                    "customer_mobile": mobile_no,
                    "app_version": "46",
                    "source": "web"
                }
            }

            $http({
                method: "POST",
                url: ConstConfig.couponUrl + "customer/account/clickToCallUrl",
                data: request_data,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded; charset=utf-8"
                }
            }).success(function(data) {
                if (data.status) {
                    scope.callbackmsg = true;
                    $timeout(function() {
                        scope.callbackmsg = false;
                        $('.modal.in').find('button.close').click();
                    }, 9000);
                }
            });
        } else {
            scope.callbackMobileModal = true;
            /* Call Back Code  ---- Starts */
            scope.callbackopt_error = false;
            scope.mobile_read_only = false;
            scope.callbackSuccess = false;
        }
    }

    scope.getCookie = function(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' ') {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return "";
    }

    scope.answer = {};
    var final_search = [];
    scope.bookRecommendTest = function() {
        var favorite = {};
        var sLocation = JSON.parse(localStorage.getItem("cityID"))[0].city_name;

        if(sLocation === null) {
            sLocation = scope.getCookie('sLocation');
        }

        scope.recommendedTests.forEach(function(ele, index) {
            if(scope.answer[ele.id] == true) {
                var tt = {
                    "id": ele.type+'_'+ele.id,
                    "text": ele.name
                }
                final_search.push(tt);
                favorite[ele.type+'_'+ele.id] = ele.name;
            }
        });

        var search_query = Object.keys(favorite)
                .map(function(k) {
                    return 'f[' + escape(k) + ']' + '=' + escape(favorite[k]);
                }).join('&');

        if (scope.final_search !== 0) {
            searchDetail.setSearchPackages(final_search);

            $analytics.eventTrack('Search From Health Karma', { category: 'Search', label: final_search });
            $timeout(function() {
                //$state.go('orderbook');
                window.location = document.location.origin + '/' + sLocation.toLowerCase() + '/orderbook' + '?' + search_query;
            } , 500);
        }
    }

    scope.sharingtext = "This is my lifestyle score wanna check yours! Download Healhians app and get your lifestyle score now. https://goo.gl/deRpjb";

    scope.shareFacebook = function(post){
        Facebook.logout(function(response) {});
        Facebook.ui({
            method: 'feed',
            name: 'Health Karma | Predictive Health Risk Assessment | Get the impact of your lifestyle | Get Recommendations',
            link: scope.sharingurl,
            picture: scope.sharingurl,
            description: scope.sharingtext
        });
    }

    scope.age_error = false;
    scope.weight_error = false;

    scope.weightSlider = {
        value: 25,
        options: {
            "floor": 0,
            "ceil": 150,
            onChange: function() {
                if(!angular.element("#qq6").hasClass("active")) {
                    $(".hk_scrollForm-main").find(".individual-questions").removeClass("active");

                    $(".hk_scrollForm-main").find(".individual-questions input").each(function() {
                        $(this).blur();
                    });

                    angular.element("#qq6").addClass("active");
                }
                scope.lastSliderUpdated = scope.weightSlider.value;
                if(scope.lastSliderUpdated>0) {
                    scope.weight_error = false;
                }
            }
        }
    };

    scope.ageSlider = {
        value: 5,
        options: {
            "floor": 5,
            "ceil": 120,
            onChange: function() {

                if(!angular.element("#qq8").hasClass("active")) {
                    $(".hk_scrollForm-main").find(".individual-questions").removeClass("active");

                    $(".hk_scrollForm-main").find(".individual-questions input").each(function() {
                        $(this).blur();
                    });
                    
                    angular.element("#next_form").hide();
                    angular.element("#continue_last").show();
                    angular.element("#qq8").addClass("active");
                }

                scope.lastSliderUpdated = scope.ageSlider.value;
                if(scope.lastSliderUpdated>0) {
                    scope.age_error = false;
                }
            }
        }
    }

    scope.submit_feedback_new = function() {

        scope.check_last_question = false;

        if(typeof scope.answer['22'] !== 'undefined') {
            if(_.isObject(scope.answer['22'])) {
                _.each(scope.answer['22'], function(value, key) {
                    if (value) {
                        scope.check_last_question = value;
                    }
                });  
            }            
        }

        if(!scope.check_last_question) {
            $window.alert("Please select atleast one checkbox.");
            return false;
        }

        var source = 'web';

        var requestData = {
            "data": {
                "age": scope.ageSlider.value,
                "options": [],
                "height": scope.userheight,
                "name":  scope.huserName,
                "gender": scope.husergender,
                "weight": scope.weightSlider.value,
                "cityId": JSON.parse(localStorage.getItem("cityID"))[0].city_id,
                "source": source,
                "email": scope.healthKarmaEmail
            }
        };

        if(scope.user_id !== '') {
            requestData["data"]["userId"] = scope.user_id;
        }
        else {
            // If logged in user has not encrypted user id in relatives
            if (localStorage.getItem("isLogin") == 'true') {
                requestData["data"]["userId"] = JSON.parse(localStorage.getItem("user")).user_id
            }
        }

        if(scope.showMobile) {
            requestData["data"]["contact_number"] = scope.huserphone;
        }

        if ($location.search().lead_id) {
            requestData["data"]["lead_id"] = scope.stateParms.lead_id;
        }

        if ($location.search().mobile) {
            requestData["data"]["contact_number"] = scope.stateParms.mobile;
        }

        scope.option_final = [];

        _.each(scope.answer, function(value, key) {
            if (_.isObject(value)) {
                var opt_check = [];
                _.each(value, function(value1, key1) {
                    if (value1) {
                        opt_check.push(key1);
                    }
                });
                var tt = {
                    "question_id": key,
                    "option_id": opt_check.join(',')
                }
                scope.option_final.push(tt);
            } else {
                var tt = {
                    "question_id": key,
                    "option_id": value
                }
                scope.option_final.push(tt);
            }
        });

        requestData["data"]["options"] = JSON.stringify(scope.option_final);

        scope.datasuccess = true;

        var url = ConstConfig.couponUrl + "customer/account/getHealthAssessment";

        doPostWithOutToken($http, url, requestData, "", function(data) {
            scope.datasuccess = false;
            if (data.status) {
                scope.showQuestion = false;
                scope.showResult = true;
                scope.resultData = data.data;

                scope.sharingurl = scope.resultData.webURL;

                $rootScope.og_image = scope.sharingurl;
                $rootScope.og_url = scope.sharingurl;

                $timeout(function() {
                    scope.lifeStyleScore = scope.resultData.lifeStyleScore;
                }, 200);

                scope.peerscore = scope.resultData.peerscore;

                if(scope.resultData.recommendedTests) {
                    scope.answerRecomm = {};
                    scope.recommendedTests = scope.resultData.recommendedTests;
                    scope.recommendedTests.forEach(function(ele, index) {
                        scope.answerRecomm[ele.id] = true;
                    });
                }

                $window.scrollTo(0, 0);  
            } else {
                scope.showQuestion = true;
                scope.showResult = false;
                alert(data.message);
            }
        });
    }

    scope.getNewQuestionList = function() {
        if (scope.huserName === undefined || scope.huserName === '') {
            scope.healthKarmaForm.huserName.$dirty = true;
            scope.healthKarmaForm.huserName.$invalid = true;
            scope.healthKarmaForm.huserName.$error.required = true;

            var element = document.getElementById("huserName");
            element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
            element.click();
            element.focus();
            angular.element('#next_form').show();
            return false;
        }

        if (scope.huserLastName === undefined || scope.huserLastName === '') {
            scope.healthKarmaForm.huserLastName.$dirty = true;
            scope.healthKarmaForm.huserLastName.$invalid = true;
            scope.healthKarmaForm.huserLastName.$error.required = true;

            var element = document.getElementById("huserLastName");
            element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
            element.click();
            element.focus();
            angular.element('#next_form').show();
            return false;
        }

        if (scope.healthKarmaEmail === undefined || scope.healthKarmaEmail === '') {
            scope.healthKarmaForm.healthkarma_email.$dirty = true;
            scope.healthKarmaForm.healthkarma_email.$invalid = true;
            scope.healthKarmaForm.healthkarma_email.$error.required = true;
            var element = document.getElementById("healthkarma_email");
            element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
            element.click();
            element.focus();
            angular.element('#next_form').show();
            return false;
        }

        if (scope.userheight === undefined || scope.userheight === '') {
            scope.healthKarmaForm.userheight.$dirty = true;
            scope.healthKarmaForm.userheight.$invalid = true;
            scope.healthKarmaForm.userheight.$error.required = true;
            var element = document.getElementById("userheight");
            element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
            element.click();
            element.focus();
            angular.element('#next_form').show();
            return false;
        }

        if (scope.weightSlider.value == 0) {
            var element = document.getElementById("userWeight");
            element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
            element.click();
            scope.weight_error = true;
            angular.element('#next_form').show();
            return false;
        }
        else {
            scope.weight_error = false;
        }

        if (scope.husergender === undefined || scope.husergender === '' || scope.husergender === null) {
            scope.healthKarmaForm.husergender.$dirty = true;
            scope.healthKarmaForm.husergender.$invalid = true;
            scope.healthKarmaForm.husergender.$error.required = true;

            var element = document.getElementById("qq6");
            element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
            element.click();
            element.focus();
            angular.element('#next_form').show();
            return false;
        }

        if (scope.ageSlider.value == 0) {
            var element = document.getElementById("userAge");
            element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
            element.click();
            scope.age_error = true;
            angular.element('#next_form').show();
            return false;
        }
        else {
            scope.age_error = false;
        }

        if (parseInt(scope.ageSlider.value) < 5 || parseInt(scope.ageSlider.value) > 120 || parseInt(scope.ageSlider.value) <= 0) {
            var element = document.getElementById("userAge");
            element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
            scope.age_error = true;
            angular.element('#next_form').show();
            element.click();
            return false;
        }

        if (scope.showMobile) {
            if (scope.huserphone === undefined || scope.huserphone === '') {
                scope.healthKarmaForm.huserphone.$dirty = true;
                scope.healthKarmaForm.huserphone.$invalid = true;
                scope.healthKarmaForm.huserphone.$error.required = true;
                
                var element = document.getElementById("huserphone");
                element.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
                element.click();
                element.focus();
                angular.element('#next_form').show();
                return false;
            }
        }

        var requestData = {
            "data": {
                "catId": "1",
                "age": scope.ageSlider.value,
                "gender": scope.husergender,
                "source": "web"
            }
        }

        var url = ConstConfig.couponUrl + "customer/account/getQuestions";
        scope.qdatasuccess = true;
        doPostWithOutToken($http, url, requestData, "", function(data) {
            scope.qdatasuccess = false;
            if (data.status) {
                scope.questionList = data.data;
                scope.totalQuestion = data.data.length;

                scope.questionList.forEach(function(ele, index) {
                    if (ele.question_type == 1) {
                        scope.answer[ele.question_id] = {};

                        ele.options.forEach(function(ele1, index1) {
                            scope.answer[ele.question_id][ele1.option_id] = false;
                        });
                    }
                });

                scope.quest = {};
                for (var i = 1; i <= scope.totalQuestion; i++) {
                    if (i === 1) {
                        scope.quest['q' + i] = true;
                        scope.current = 1;
                    } else {
                        scope.quest['q' + i] = false;
                    }
                    // scope.quest['q'+i+'_select'] = '';   
                }
                scope.showQuestion = true;
                scope.progress = 1;
                if (isMobile.any()) {
                    $window.scrollTo(0, 0);
                    $.scrollTo($('.hk_formDetailBlock'), 1000);
                }

            } else {
                alert(data.message);
            }
        });
    }

    scope.clickNewRadio = function(ques) {
        if(ques === scope.totalQuestion) {
            return false;
        }

        scope.current = ques;

        if (ques === (scope.totalQuestion-1)) {
            angular.element('#q' + ques + '_div').fadeOut();

            $timeout(function() {

                scope.quest['q' + ques] = false;
                var nextquest = parseInt(ques) + 1;

                angular.element('#q' + nextquest + '_div').fadeIn();
                scope.quest['q' + nextquest] = true;

                scope.current = nextquest;
                angular.element('#next_q' + ques).css('opacity', '1');
                angular.element('#next_q' + ques).removeAttr("disabled", "disabled");


                angular.element('#next_q' + nextquest).css('opacity', '1');
                angular.element('#next_q' + nextquest).removeAttr("disabled", "disabled");
            }, 500);

            if (isMobile.any()) {
                $window.scrollTo(0,200);  
            }
        } else {
            angular.element('#q' + ques + '_div').fadeOut();

            $timeout(function() {
                scope.quest['q' + ques] = false;
                var nextquest = parseInt(ques) + 1;

                angular.element('#q' + nextquest + '_div').fadeIn();
                scope.quest['q' + nextquest] = true;

                scope.current = nextquest;
                angular.element('#next_q' + ques).css('opacity', '1');
                angular.element('#next_q' + ques).removeAttr("disabled", "disabled");
                if (isMobile.any()) {
                    $.scrollTo($('.hk_formDetailBlock'), 1000);
                }
            }, 500);
        }
    }

    scope.clickIndicator = function(ques) {
        if(ques < scope.current) {
            
            angular.element('#q' + scope.current + '_div').fadeOut();

            _.each(scope.quest, function(value1, key1) {
                if('q' + ques !== key1) {
                    scope.quest[key1] = false;
                }
                scope.quest['q' + ques] = true;
            });

            $timeout(function() {
                angular.element('#q' + ques + '_div').fadeIn();
                scope.quest['q' + ques] = true;
                // console.log("wwww",scope.quest);
                scope.current = ques;
                angular.element('#next_q' + ques).css('opacity', '1');
                angular.element('#next_q' + ques).removeAttr("disabled", "disabled");

            }, 500);
        }        
    }

    scope.showNewPrevious = function() {
        var prev_ques = parseInt(scope.current) - 1;

        var cur_quest = parseInt(scope.current);
        angular.element('#q' + cur_quest + '_div').fadeOut();
        scope.quest['q' + cur_quest] = false;

        angular.element('#q' + prev_ques + '_div').fadeIn();
        scope.quest['q' + prev_ques] = true;
        scope.current = prev_ques;
    }

    scope.showNewNext = function() {

        if (parseInt(scope.current) === scope.totalQuestion) {
            $analytics.eventTrack('Click on Final Submit', { category: 'HealthKarmaV2' });
            scope.submit_feedback_new();
        }
        else {
            var next_ques = parseInt(scope.current) + 1;

            var cur_quest = parseInt(scope.current);
            angular.element('#q' + cur_quest + '_div').fadeOut();
            scope.quest['q' + cur_quest] = false;

            angular.element('#q' + next_ques + '_div').fadeIn();
            scope.quest['q' + next_ques] = true;
            scope.current = next_ques;
        }        
    }

    scope.clickLastCheckbox = function(question_id, option_id) {
        if(option_id !== "98") {
            if(scope.answer[question_id]["98"]) {
                scope.answer[question_id]["98"] = false;
            }
            scope.answer[question_id][option_id] = ! scope.answer[question_id][option_id];   
        }
        else {
            for (var key in scope.answer[question_id]) {
                if (key != "98") {
                    scope.answer[question_id][key] = false;
                }
                else {
                    scope.answer[question_id][key] = true;
                }
            }           
        }        
    }

    scope.answerRecomm = {};
    scope.bookRecommendTestNew = function() {
        var final_search = [];
        var favorite = {};

        var sLocation = JSON.parse(localStorage.getItem("cityID"))[0].city_name;

        if(sLocation === null) {
            sLocation = scope.getCookie('sLocation');
        }

        scope.recommendedTests.forEach(function(ele, index) {
            if(scope.answerRecomm[ele.id] == true) {
                var tt = {
                    "id": ele.type+'_'+ele.id,
                    "text": ele.name
                }
                final_search.push(tt);
                favorite[ele.type+'_'+ele.id] = ele.name;
            }
        });

        var search_query = Object.keys(favorite)
                .map(function(k) {
                    return 'f[' + esc(k) + ']' + '=' + esc(favorite[k]);
                }).join('&');

        if (scope.final_search !== 0) {
            searchDetail.setSearchPackages(final_search);

            $analytics.eventTrack('Search From Health Karma', { category: 'Search', label: final_search });
            $timeout(function() {
                window.location = document.location.origin + '/' + sLocation.toLowerCase() + '/orderbook' + '?' + search_query;
                //$state.go('orderbook');
            } , 500);
        }
    }
}