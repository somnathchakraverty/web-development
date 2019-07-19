App.controller('orderTrackingController', orderTrackingController);
orderTrackingController.$inject = ['$scope', '$timeout', '$rootScope', '$location', '$http', '$q', '$state', '$stateParams', 'ConstConfig', 'BookOrderService'];

function orderTrackingController(scope, $timeout, $rootScope, $location, $http, $q, $state, $stateParams, ConstConfig, BookOrderService) {

    scope.packageList = [];
    scope.tags = [];
    scope.pkgDetail = [];
    scope.loading = true;
    scope.stateParms = $stateParams;

    var opts = {
        "order_id": scope.stateParms.booking_id,
        "user_id": JSON.parse(localStorage.getItem("user")).user_id,
        "log_user_id": JSON.parse(localStorage.getItem("user")).user_id
    };

    $rootScope.meta_robots = "noindex, nofollow";

    /* Order status Ids 
    -1 incomplete
    0 pending
    1 process
    2 Order Booked
    3 cancelled
    4 out of area
    5 sample collector assign
    6 sample collector reached home
    7 sample collected
    8 sample submitted to merchant
    9 report generated
    10 delay in report
    11 Customer not answered
    12 Consultation Done
    13 Reschedule
    14 Order Upgrade
    15 Report Sent to Customer
    16 Report Uploaded in other order
    17 reports Cancelled
    18 Resample
    20 Consultation Done
    22 sent for resample
    25 Refund
    100 All
    101 All Stages
    */

    scope.allowedStatus = ['2','5','7','9','12','15','20','102','8','3','13'];

    BookOrderService.getOrderTrackingDetails(opts, function(data) {
        if (data.status) {
            scope.bookingDetail = data.data;
            var discounted_amount = 0;
            if(scope.bookingDetail.discounted_amount !== null) {
                discounted_amount = parseInt(scope.bookingDetail.discounted_amount);
            }
            
            if(scope.bookingDetail.hard_copy === 'yes') {
                scope.total_amount = parseInt(scope.bookingDetail.total_amount) - 50;
            }
            else {
                scope.total_amount = parseInt(scope.bookingDetail.total_amount);
            }

            if(scope.bookingDetail.coupon_code !== null) {
                scope.total_amount = parseInt(scope.total_amount) + parseInt(scope.bookingDetail.discounted_amount);
            }

            if(scope.bookingDetail.convenience_fee !== null) {
                if(scope.bookingDetail.convenience_fee === 'yes') {
                    scope.total_amount = parseInt(scope.total_amount) - parseInt(scope.bookingDetail.convenience_amount);
                }
            }

            if(scope.bookingDetail.donation_amount > 0) {
                scope.total_amount = parseInt(scope.total_amount) - scope.bookingDetail.donation_amount;
            }

            if(scope.bookingDetail.wallet_amount_used > 0) {
                scope.total_amount = parseInt(scope.total_amount) + scope.bookingDetail.wallet_amount_used;
            }

            if(typeof scope.bookingDetail.online_discount !== 'undefined') {
                if(scope.bookingDetail.online_discount) {
                    scope.total_amount = parseInt(scope.total_amount) + scope.bookingDetail.online_discount;
                }
            }
            
        }
        else {
            $location.path('/dashboard');
        }
    });

    // scope.bookingDetail = {
    //   "booking_id": "142888",
    //   "customer_name": "preeti",
    //   "contact_number": "8130583557",
    //   "email_address": "ababa@healthians.com",
    //   "address": "12, test",
    //   "total_amount": "4910.00",
    //   "coupon_code": null,
    //   "discounted_percent": null,
    //   "discounted_amount": null,
    //   "hard_copy": "yes",
    //   "amount_paid": "",
    //   "order_type": "cash on delivery",
    //   "payment_date": null,
    //   "suborders": [
    //     {
    //       "cust_id": "3897",
    //       "customer_name": "preeti",
    //       "customer_age": "25",
    //       "customer_gender": "F",
    //       "fasting_required": "1",
    //       "fasting_time": "12",
    //       "orders": [
    //         {
    //           "display_name": "Complete Hemogram, Lipid Profile-Extended",
    //           "healthians_price": "620",
    //           "actaul_price": "1780"
    //         }
    //       ],
    //       "order_status": [
    //         {
    //           "id": "2",
    //           "status": "Order Booked",
    //           "date": "2016-09-05",
    //           "time": "14:54",
    //           "payment_status": "cash on delivery",
    //           "flag": "true"
    //         },
    //         {
    //           "id": "3",
    //           "status": "Cancelled",
    //           "date": "2016-09-09",
    //           "flag": "true"
    //         }
    //       ]
    //     },
    //     {
    //       "cust_id": "3897",
    //       "customer_name": "preeti",
    //       "customer_age": "25",
    //       "customer_gender": "F",
    //       "fasting_required": "0",
    //       "fasting_time": "0",
    //       "orders": [
    //         {
    //           "display_name": "Liver Function Test",
    //           "healthians_price": "160",
    //           "actaul_price": "950"
    //         }
    //       ],
    //       "order_status": [
    //         {
    //           "id": "2",
    //           "status": "Order Booked",
    //           "date": "2016-09-05",
    //           "time": "14:54",
    //           "payment_status": "cash on delivery",
    //           "flag": "true"
    //         },
    //         {
    //           "id": "5",
    //           "status": "sample collector assign",
    //           "date": "2016-09-05",
    //           "time": "15:35",
    //           "flag": "true"
    //         }
    //       ]
    //     }
    //   ]
    // };

    //function for total order value
    scope.getorderValue = function(obj) {
        return obj.healthians_price;
    };

    scope.convenience_fees_visible = false;
    scope.showConvenienceFeesDialog = function() {
        scope.convenience_fees_visible = true;
    }

    scope.getConfigInfo = function(){
        var getDonationInfoURL = ConstConfig.couponUrl + "webv1/web_api/getDonationInfo";
        
        doGet($http, getDonationInfoURL, function(data) {
            if (data.status === "success") {
                scope.config_details = data.data;
               
                scope.coupon_notice = JSON.parse(scope.config_details.coupon_discount_addon_config);
                if(scope.coupon_notice.status !== 'off') {
                    scope.coupon_notice_msg = scope.coupon_notice.msg;
                    scope.coupon_notice_div = true;
                }
                
            }
        });
    }

    scope.getConfigInfo();
    
}
