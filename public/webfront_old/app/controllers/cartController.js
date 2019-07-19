App.controller('cartController', cartController);
cartController.$inject = ['$scope', 'dataShare', 'dataShare1', '$localStorage', '$sessionStorage', '$timeout', '$rootScope', '$location', '$http', '$q', 'BookOrderService', '$state', '$stateParams', 'cartService', '$analytics','$window', 'ConstConfig', '$interval'];

function cartController(scope, dataShare, dataShare1, $localStorage, $sessionStorage, $timeout, $rootScope, $location, $http, $q, BookOrderService, $state, $stateParams, cartService, $analytics, $window, ConstConfig, $interval) {
    
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
        scope.device = 'mobile';
    }
    else {
        scope.device = 'web';
    }

    // Token
    var token = localStorage.getItem("token");

    scope.fetchCart = function() {
        var fetchCartURL = ConstConfig.couponUrl + "customer/account/fetch_cart_v2";
        var requestPayloadFetchCart = {
            "data" : {
                "user_id" : scope.userId,
                "city_id" : scope.city_id,
                "source" : "web"
            }
        };

        scope.healthiansamount = 0;

        doPost($http, fetchCartURL, requestPayloadFetchCart, token, function(data) {
            if(data.status) {
                if (data.status === "error") {
                    if(data.code == 'TOKEN_EXPIRED' || data.code == 'INVALID_TOKEN' || data.code == 'AUTH_FAILED') {
                        $rootScope.$broadcast('tokenExpired');
                    }
                }
                else {
                    scope.cartData = data.data;
                    scope.total_member = scope.cartData.customer_detail.length;
                    scope.total_cart_amount = scope.cartData.total_price;

                    if(scope.cartData.customer_detail.length > 0) {
                        $rootScope.totalCartTest = 0;
                        scope.cartData.customer_detail.forEach(function(ele, index) {
                            $rootScope.totalCartTest += ele.deals.length;
                            
                            ele.deals.forEach(function(element, ind) {
                                scope.healthiansamount += parseInt(element.actual_price);                   
                            });
                        });
                    }
                }                
            }
            else {
                $rootScope.totalCartTest = 0;
                scope.total_member = 0;
                scope.total_cart_amount = 0;
                scope.cartData = {};
            }
        });
    }
    
    if (localStorage.getItem("isLogin") == 'true') {
        scope.userId = JSON.parse(localStorage.getItem("user")).user_id;
        scope.city_id = JSON.parse(localStorage.getItem("cityID"))[0].city_id;

        if(scope.userId && scope.city_id) {
            scope.fetchCart();
        }
    
    } else {
        $state.go('orderbook');
    }

    scope.deletePkg = {};
    scope.package_delete_confirmation = function(cust_id, pkg_id, pkg_name, pkg_price) {
        scope.deletePkg = {
            "customer_id" : cust_id,
            "pkg_id" : pkg_id,
            "pkg_name": pkg_name,
            "pkg_price": pkg_price
        };
        scope.package_delete_visible = true;
    }

    scope.removeItemFromCart = function(deletePkg) {
        var total_count = scope.getPackgeCountOfCustomer(deletePkg);
        if(total_count-1 <= 0) {
            var isCustomerDelete = true;
        }
        else {
            var isCustomerDelete = false;
        }

        var removeItemCartURL = ConstConfig.couponUrl + "customer/account/delete_item_from_cart";
        var requestPayloadRemoveItemCart = {
            "data" : { 
                "customer_id" : deletePkg.customer_id,
                "group_id" : deletePkg.pkg_id,
                "isCustomerDelete" : isCustomerDelete,
                "user_id" : scope.userId,
                "source" : scope.device
            }
        };

        $analytics.eventTrack('Remove Item from cart', { category: 'My Cart', label: deletePkg.pkg_name, value: deletePkg.pkg_price });

        doPost($http, removeItemCartURL, requestPayloadRemoveItemCart, token, function(data) {
            if(data.status) {
                if (data.status === "error") {
                    if(data.code == 'TOKEN_EXPIRED' || data.code == 'INVALID_TOKEN' || data.code == 'AUTH_FAILED') {
                        $rootScope.$broadcast('tokenExpired');
                    }
                }
                else {
                    scope.fetchCart();
                }   
            }
            else {
                alert(data.message);
            }
        });
    }
    
    scope.getPackgeCountOfCustomer = function(deletePkg) {
        var pkgCount = 0;
        if(scope.cartData.customer_detail.length > 0) {
            scope.cartData.customer_detail.forEach(function(ele, index) {
                if(ele.customer_id == deletePkg.customer_id) {
                    pkgCount = ele.deals.length;
                }
            });
        }
        
        return pkgCount;
    }

    scope.checkout = function() {
        if(scope.cartData.allow_to_proceed) {
            if($rootScope.totalCartTest > 0) {
                $state.go('final_checkout');
            }
            else {
                $state.go('orderbook');
            }   
        }
        else {
            $window.alert(scope.cartData.allow_to_proceed_message);
            $state.go('user_selection_cart');
        }             
    }

    angular.element('.modal-backdrop').remove();
    angular.element('body').css("padding-right", "0px");
}
