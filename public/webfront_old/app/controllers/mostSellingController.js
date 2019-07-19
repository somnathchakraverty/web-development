App.controller('mostSellingController', mostSellingController);
mostSellingController.$inject = ['$scope', '$timeout', '$rootScope', '$location','$http', 'ConstConfig','$analytics', '$localStorage'];
function mostSellingController(scope, $timeout, $rootScope, $location ,$http, ConstConfig, $analytics, $localStorage) {
    var cityArray = JSON.parse(localStorage.getItem("cityID"));
    if (cityArray === null) {
        localStorage.setItem("cityID", JSON.stringify([{ "city_id": "23", "city_name": "Gurgaon" }]));
    }
 	scope.getPopularPackagesList = function() {
        $http({
            method: "GET",
            url: ConstConfig.couponUrl + "webv1/web_api/getPopularPackages",
            params: {
                "city": JSON.parse(localStorage.getItem("cityID"))[0].city_name
            },
        }).success(function(data) {
            if(data.data) {
                scope.packageList = data.data;
            }
        });
    }
    scope.getPopularPackagesList();

    if($location.search().vendor_code) {
        localStorage.setItem("vendor_code",$location.search().vendor_code);
    }

    if($location.search().admitad_uid) {
        localStorage.setItem("admitad_uid",$location.search().admitad_uid);
    }
    
 }