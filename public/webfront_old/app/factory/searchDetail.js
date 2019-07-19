App.factory('searchDetail', function() {
    var _searchPackages = [];
    return {
        getSearchPackages: function() {
            return _searchPackages;
        },

        setSearchPackages: function(searchTag) {
            _searchPackages = searchTag;
        }
    };
});

App.factory('dataShare', function($rootScope, $timeout, $location) {
    var service = {};
    service.data = false;
    service.sendData = function(data) {
        this.data = data;
        $timeout(function() {
            $rootScope.$broadcast('data_shared');

        }, 800);
        $location.path('/orderbook');
    };
    service.getData = function() {
        return this.data;
    };
    return service;
});


App.factory('dataShare1', function($rootScope, $timeout, $location,$state) {
    var service = {};
    service.data = false;
    service.sendData1 = function(data) {
        this.data = data;
        $timeout(function() {
            $rootScope.$broadcast('data_shared1');
        }, 800);
        $state.go('final_checkout');
        //$location.path('/final_checkout');
    };
    service.getData = function() {
        return this.data;
    };
    return service;
});

App.factory('$remember', function() {
    function fetchValue(name) {
        var gCookieVal = document.cookie.split("; ");
        for (var i = 0; i < gCookieVal.length; i++) {
            // a name/value pair (a crumb) is separated by an equal sign
            var gCrumb = gCookieVal[i].split("=");
            if (name === gCrumb[0]) {
                var value = '';
                try {
                    value = angular.fromJson(gCrumb[1]);
                } catch (e) {
                    value = unescape(gCrumb[1]);
                }
                return value;
            }
        }
        // a cookie with the requested name does not exist
        return null;
    }
    return function(name, values) {
        if (arguments.length === 1) return fetchValue(name);
        var cookie = name + '=';
        if (typeof values === 'object') {
            var expires = '';
            cookie += (typeof values.value === 'object') ? angular.toJson(values.value) + ';' : values.value + ';';
            if (values.expires) {
                var date = new Date();
                date.setTime(date.getTime() + (values.expires * 24 * 60 * 60 * 1000));
                expires = date.toGMTString();
            }
            cookie += (!values.session) ? 'expires=' + expires + ';' : '';
            cookie += (values.path) ? 'path=' + values.path + ';' : '';
            cookie += (values.secure) ? 'secure;' : '';
        } else {
            cookie += values + ';';
        }
        document.cookie = cookie;
    }
});

App.factory('focus', function($timeout) {
    return function(id) {
        $timeout(function() {
            var element = document.getElementById(id);
            if (element) {
                element.focus();
            }
        }, 400);
    };
});

App.factory('fbService', function($rootScope) {
    var user = {
        name: "",
        email: "",
        gender: "",
        social_response: ""
    };

    return {

        getFBDetails: function() {
            return user;
        },

        setFBDetails: function(data) {
            user.name = data.name;
            user.email = data.email;
            user.gender = data.gender;
            user.social_response = data.social_response;
        },

        checkLoggedIn: function() {
            if (localStorage.getItem("isLogin") == 'true') {
                $rootScope.loggedin = true;
                if($rootScope.loggedin && JSON.parse(localStorage.getItem("user")) !== 'null') {
                    return true;
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }
    }
});

App.service('cartService', function() {
    this.cart = [];

    this.selectedPatient = {
        'name': '',
        'phone': ''
    };
    
    this.tempPackage = {};

    this.clearSearch = false;

    this.setCartDetails = function(data) {
        // this.cart = data;
        localStorage.setItem("tempCart", JSON.stringify(data));
        //console.log(this.cart);
    };

    this.getCartDetails = function() {
        var cartDetails = JSON.parse(localStorage.getItem("tempCart"));
        if(cartDetails == null) {
            return [];
        }
        else {
            return cartDetails;
        }
    };

    this.setSelectedPatient = function(name,phone) {
        this.selectedPatient.name = name;
        this.selectedPatient.phone = phone;
        localStorage.setItem("selectPatient", JSON.stringify(this.selectedPatient));
    };

    this.getSelectedPatient = function() {
        var selectPatientDetails = JSON.parse(localStorage.getItem("selectPatient"));
        if(selectPatientDetails == null) {
            return { 'name': '','phone': ''};
        }
        else {
            return selectPatientDetails;
        }
        //return this.selectedPatient;
    };

    this.setTempPackage = function(pkg) {
        localStorage.setItem("tempPkg", JSON.stringify(pkg));
    };

    this.getTempPackage = function() {
        var tmpPkgDetails = JSON.parse(localStorage.getItem("tempPkg"));
        if(tmpPkgDetails == null) {
            return null;
        }
        else {
            return tmpPkgDetails;
        }
    };

    this.setClearSearch = function(val) {
        this.clearSearch = val;
    }

    this.getClearSearch = function(val) {
        return this.clearSearch;
    }

    /* For Mobile */
    this.appdivmobile = true;
    this.mobileAppPromotional = true;

    this.getAppDivmobile = function() {
        return this.appdivmobile;
    }

    this.setAppDivmobile = function(val) {
        this.appdivmobile = val;
    }

    this.getMobileAppPromotional = function() {
        var appdivmobile = localStorage.getItem("mobilebanner");
        if(appdivmobile == null) {
            return true;
        }
        else {
            return appdivmobile;
        }
    }

    this.setMobileAppPromotional = function(val) {
        localStorage.setItem("mobilebanner", val);
    }
});

App.factory('companyinfo', function($rootScope, $timeout, $location, $http, ConstConfig, $localStorage, $location) {
  
    return {
        getCompanyInfo: function(callback){
            return $http({
                method: "GET",
                url: ConstConfig.couponUrl + "webv1/web_api/getCompanyInfo"
            }).success(callback);
        },

        sendIdleLeadInfo: function(callback){

            var token = localStorage.getItem("token");
            var userId = JSON.parse(localStorage.getItem("user")).user_id;
            var remarks = $location.absUrl();

            var request_data = {
                "data": {
                    "user_id" : userId,
                    "source": "web",
                    "remarks": remarks,
                    "utm_id": "web_idle"
                }
            }

            if(localStorage.getItem("guid")) {
                request_data['data']['guid'] = localStorage.getItem("guid");
            }

            return $http({
                method: "POST",
                url: ConstConfig.couponUrl + "webv1/web_api/sendLoggedInLeadInfo",
                data: request_data,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded; charset=utf-8",
                    "X-API-TOKEN" : token
                }
            }).success(callback);
        }
    }
});
