App.service("HomeService",['$http','$injector','ConstConfig','Facebook','$timeout','$q', '$rootScope', function($http, $injector, ConstConfig,Facebook,$timeout,$q, $rootScope) {
	var userIsConnected = false;

	return {
		getCityDetail: function(callback) {
			
			var url = ConstConfig.couponUrl + "webv1/web_api/getNcrCityList";
			doGet($http, url, function(data) {
				callback(data);
			});
		},

		userSignup : function (opt, callback) {
			var url = ConstConfig.serverUrl + 'commonservice/signUp';
			//var url = '//172.19.1.57/newcrm/index.php/commonservice/signUp';
			doPostWithOutToken($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		userLogin : function (opt, callback) {
			//var url = ConstConfig.serverUrl + 'commonservice/login';
			var url = ConstConfig.couponUrl + 'customer/account/login';
			doPostWithOutToken($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		userForgotPwd : function (opt, callback) {
			var url = ConstConfig.serverUrl + 'commonservice/forgot_password';
			doPostWithOutToken($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		userSetNewPwd : function (opt, callback) {
			var url = ConstConfig.serverUrl + 'commonservice/changePassword';
			doPost($http, url, opt, "", function(data) {
				callback(data);
			});
		},

		getRiskAreas: function(callback) {
			var url = ConstConfig.serverUrl + 'commonservice/getRiskAreas';
			//var url = '//172.19.1.207/newcrm/index.php/commonservice/getRiskAreas';
			doGet($http, url, function(data) {
				callback(data);
			});
		},

		getAgeArray: function(callback) {
			var url = ConstConfig.serverUrl + 'commonservice/getAgeArray';
			//var url = '//172.19.1.207/newcrm/index.php/commonservice/getAgeArray';
			doGet($http, url, function(data) {
				callback(data);
			});
		},
		userSocialLogin : function (opt, callback) {
			var url = ConstConfig.serverUrl + 'commonservice/sociallogin';
			//var url = '//172.19.1.57/newcrm/index.php/commonservice/sociallogin';
			doPostWithOutToken($http, url, opt, "", function(data) {
				callback(data);
			});
		},
		getFBLoginStatus : function() {
	        Facebook.getLoginStatus(function(response) {
	            if (response.status == 'connected') {
	                userIsConnected = true;
	            }
	            else if (response.status === 'not_authorized') {
	                userIsConnected = false;
	            }
	            else {
	                userIsConnected = false;
	            }
	        });
	        return userIsConnected;
	    },
	    fbloginme : function() {
	    	var deferred = $q.defer();
	    	Facebook.login(function(response) {
			    Facebook.api('/me', { fields: 'email,name,gender' }, function(response) {
		            var opts = {
		                name: response.name,
		                email: response.email,
		                termscond: "1",
		                social_login: "facebook",
		                social_response: response,
		                gender: response.gender,
		                image_path: encodeURIComponent('http://graph.facebook.com/'+response.id+'/picture?width=300&height=300')
		            };
		            deferred.resolve(opts);
		        });	
			}, {scope: 'email'});
			return deferred.promise;
	    },
	    fbme :function() {
	    	var deferred = $q.defer();
	    	Facebook.api('/me', { fields: 'email,name,gender' }, function(response) {
	            var opts = {
	                name: response.name,
	                email: response.email,
	                termscond: "1",
	                social_login: "facebook",
	                social_response: response,
	                gender: response.gender,
	                image_path: encodeURIComponent('http://graph.facebook.com/'+response.id+'/picture?width=300&height=300')
	            };
	           
	            deferred.resolve(opts);
	        });	
	        return deferred.promise;
	    },
		fblogin : function (callback) {
			var deferred = $q.defer();
			var userIsConnected = this.getFBLoginStatus();
			if(!userIsConnected) {
				var promise = this.fbloginme();
				return promise;
			}
			else {
		    	var promise = this.fbme();
		    	return promise;
			}
		},
		logout : function(opt, callback) {
			var url = ConstConfig.serverUrl + 'commonservice/logout';
			doPost($http, url, opt, "", function(data) {
				callback(data);
			});
		},
		chatwcp : function (callback) {
			window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
				d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
			_.push(o)};z._=[];z.set._=[];$.async=1;$.setAttribute("charset","utf-8");
				$.src="https://v2.zopim.com/?4VDQzvdO5Qa6IFPHOepmNOV5mY9fBYPa";z.t=+new Date;$.
					type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
		},
		cartCount : function(opt, callback) {
			$rootScope.totalCartTest = 0;
			
        	var city_id = JSON.parse(localStorage.getItem("cityID"))[0].city_id;
			var user_id = JSON.parse(localStorage.getItem("user")).user_id;
            var token = localStorage.getItem("token");

            var fetchCartURL = ConstConfig.couponUrl + "customer/account/fetch_cart_v2";
            var requestPayloadFetchCart = {
                "data" : {
                    "user_id" : user_id,
                    "city_id" : city_id,
                    "source" : "web"
                }
            };

            doPost($http, fetchCartURL, requestPayloadFetchCart, token, function(data) {
                if(data.status) {
                	if (data.status === "error") {
	                    if(data.code == 'TOKEN_EXPIRED' || data.code == 'INVALID_TOKEN' || data.code == 'AUTH_FAILED') {
	                        $rootScope.$broadcast('tokenExpired');
	                    }
	                }
	                else {
	                	var cartData = data.data;
	                    if(cartData.customer_detail.length > 0) {
	                        cartData.customer_detail.forEach(function(ele, index) {
	                            $rootScope.totalCartTest += ele.deals.length;
	                        });
	                    }
	                }                    
                }
            });
		},
	}
}]);