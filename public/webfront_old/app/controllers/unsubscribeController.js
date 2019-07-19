App.controller('unsubscribeController', unsubscribeController);
unsubscribeController.$inject = ['$scope', '$localStorage', '$sessionStorage', '$timeout', '$rootScope', '$location','$http', '$q', 'BookOrderService', '$state', '$stateParams', 'ConstConfig', 'searchDetail','$stateParams' ];
function unsubscribeController (scope, $localStorage, $sessionStorage, $timeout, $rootScope, $location ,$http ,$q ,BookOrderService ,$state ,$stateParams,ConstConfig,searchDetail,$stateParams) {
    
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

    if (isMobile.any()) {
        scope.mobileview = true;
    }
    else {
        scope.mobileview = false;
    }
    
    scope.stateParms = $stateParams;

    if (scope.stateParms ) {
        if(scope.stateParms.email) {
            scope.email = scope.stateParms.email;
            var requestData = {
                "data_value": scope.email
            };

            if(typeof scope.stateParms.type !== 'undefined') {
                requestData['type'] = scope.stateParms.type;
            }
            else {
                requestData['type'] = "email";
            }

            if (scope.mobileview) {
                requestData['source'] = 'mobile';
            } else {
                requestData['source'] = 'web';
            }

            var url = ConstConfig.serverUrl + "commonservice/unSubscribe"
            doPostWithOutToken($http, url, requestData, "", function(data) {
                if (data.status) {
                    scope.api_message = data.message;
                }
                else {
                    scope.api_message = data.message;
                }
            });
        }
        else {
            $state.go('home');
        }
    }

    // $timeout(function(){
    //     scope.getPopularPackages();
    // },1000);
 }

App.controller('promoteHealthKarmaController', promoteHealthKarmaController);
promoteHealthKarmaController.$inject = ['$scope', '$localStorage', '$sessionStorage', '$timeout', '$rootScope', '$location','$http', '$q', 'HomeService', '$state', '$stateParams', 'ConstConfig', 'searchDetail','$stateParams' ];
function promoteHealthKarmaController (scope, $localStorage, $sessionStorage, $timeout, $rootScope, $location ,$http ,$q ,HomeService ,$state ,$stateParams,ConstConfig,searchDetail,$stateParams) {
    
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
        scope.mobileview = true;
    }
    else {
        scope.mobileview = false;
    }

    var cityArray = JSON.parse(localStorage.getItem("cityID"));
    if (cityArray === null) {
        localStorage.setItem("cityID", JSON.stringify([{ "city_id": "23", "city_name": "Gurgaon" }]));
    }

    //service call for get city 
    scope.getCityList = function() {
        HomeService.getCityDetail(function(data) {
            if (data.status == 'success') {
                scope.cityList = data.data;
                localStorage.setItem("cityList", JSON.stringify(scope.cityList));
            }
        });
    };

    scope.getCityList();
    
   
 }