App.controller('myBookingController', myBookingController);
myBookingController.$inject = ['$scope', '$rootScope', '$location', '$anchorScroll', 'DashboardService', 'BookOrderService', '$timeout', '$window', 'cartService', 'ConstConfig', '$http'];

function myBookingController(scope, $rootScope, $location, $anchorScroll, DashboardService, BookOrderService, $timeout, $window, cartService, ConstConfig, $http) {
   	scope.mybookingList = [];
   	scope.loaderVar = true;
   	scope.nodataBooking = false;
    scope.showOrderDetail = true;

    if(localStorage.getItem("user") !== null) {
        scope.userContact = JSON.parse(localStorage.getItem("user")).mobile;
    }

    
   	//service for mybooking details
    scope.myBooking = function() {
        // scope.loaderVar1 = false;
        if (localStorage.getItem("isLogin") == 'true') {
            var user_id = JSON.parse(localStorage.getItem("user")).user_id;
            var opt = {
                "user_id": user_id,
                "log_user_id": user_id
            };
        } else {
            var opt = {
                "user_id": ""
            };
        }

        DashboardService.myBookings(opt, function(data) {
            if (data.status == true) {
                scope.loaderVar = false;
                scope.mybookingList = data.data;
                if (scope.mybookingList.length == 0) {
                    scope.loaderVar = false;
                    scope.nodataBooking = true;
                }
            } else {
                scope.loaderVar = false;
                scope.nodataBooking = true;
            }
        });
    };
    scope.myBooking();

    //open order detail
    scope.order = {};

    scope.hardcopy = false;
    scope.getBookingOrderDetail = function(bookingId) {
        scope.order = {};
        var user_id = JSON.parse(localStorage.getItem("user")).user_id;

        var request_data = {
            "booking_id": bookingId,
            "user_id": user_id,
            "log_user_id": user_id
        };
        scope.orderDetail = true;
        scope.loaderVar1 = true;
        scope.showOrderDetail = false;

        //scope.discount=false;
        scope.hardcopy = false;
        scope.mybookingList.forEach(function(ele, index) {
            if (bookingId === ele.booking_id) {
                scope.order = ele;                

                var suborderurl = ConstConfig.serverUrl + "commonservice/myBookingSuborder";
                var token = localStorage.getItem("token");

                doPost($http, suborderurl, request_data, token, function(data) {
                    if(data.status) {
                        scope.order.suborders = data.data;                        
                        scope.showOrderDetail = true;
                        scope.loaderVar1 = false;
                    }
                });

                //if (ele.discounted_amount!='0'){scope.discount=true;};
                if (ele.hard_copy == 'yes') {
                    scope.hardcopy = true;
                };
                //console.log(JSON.stringify(ele));
            }
        });
    };

    //close order detail
    scope.closeBookingOrderDetail = function() {
        scope.orderDetail = false;
        scope.showOrderDetail = false;
        scope.loaderVar1 = false;
        scope.order = {};
    };

}