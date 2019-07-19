App.controller('paymentSummaryController', paymentSummaryController);
paymentSummaryController.$inject = ['$scope', 'dataShare','dataShare1', '$localStorage', '$sessionStorage', '$timeout', '$rootScope', '$location','$http', '$q', 'BookOrderService', '$state', '$stateParams', 'cartService', '$window', '$analytics', 'ConstConfig'];
function paymentSummaryController (scope, dataShare,dataShare1, $localStorage, $sessionStorage, $timeout, $rootScope, $location ,$http ,$q ,BookOrderService ,$state ,$stateParams, cartService, $window, $analytics, ConstConfig) {
 
	scope.booking_id = localStorage.getItem("booking_id");
	scope.stateParms = $stateParams; 
	scope.onlineDiscount = 50;
    $rootScope.meta_robots = "noindex, nofollow";

	/* Calculate total no of test for cart notification */
    scope.getCartTotalTest = function() {
        if (localStorage.getItem("isLogin") == 'true') {
            scope.cartData = cartService.getCartDetails();
            $rootScope.totalCartTest = 0;
            scope.cartData.forEach(function(ele, index) {
                if(ele.hasOwnProperty("newpkg")) {
                    $rootScope.totalCartTest += ele.newpkg.length;
                }
            });
        }
    }

	scope.stringToInt = function(val)
	{	
		return parseInt(val);
	}

	//service call for hardcopy price 
    scope.getHardcopyPrice = function () {
        BookOrderService.getHardcopyPrice (function (data) {
            if (data.status == true) {
                scope.hardcopyPrice = data.data.price;
            }
        });
    };

    scope.getHardcopyPrice();

    scope.getPaymentSummaryDetails = function (booking_id, user_id, mobile) {
    	var opts = {
	        "order_id": booking_id
	    };

	    if(user_id) {
	    	opts["user_id"] = user_id;
	    }
	    
	    if(mobile) {
	    	opts["mobile"] = mobile;
	    }

        BookOrderService.getPaymentSummaryDetails(opts,function (data) {
            if (data.status == true) {
                scope.payment_data = data.data;
                if(typeof scope.stateParms.source === 'undefined') {

                    var vendor_code = localStorage.getItem("vendor_code");

                    if(vendor_code) {
                        var pixelUrl = ConstConfig.serverUrl + "commonservice/getVendorPixel";

                        var pixelrequest = {
                            "vendor_code": vendor_code,
                            "page_source":"booking",
                            "booking_id": booking_id,
                            "transaction_amount": scope.payment_data.order_price
                        };

                        if(vendor_code === 'admitad') {
                            pixelrequest['admitad_uid'] = localStorage.getItem("admitad_uid")
                        }

                        $analytics.eventTrack('Vendor Order', {
                            category: 'Affiliate',
                            label: vendor_code,
                            value: scope.payment_data.order_price
                        });


                        doPostWithOutToken($http, pixelUrl, pixelrequest,"",function(data){
                            if(data.status) {
                                angular.element("footer").append(data.data);
                                localStorage.removeItem("vendor_code");
                                if(vendor_code === 'admitad') {
                                    localStorage.removeItem("admitad_uid");
                                }
                            }                            
                        });
                    }                    

                    $analytics.eventTrack('Order completion success', {
                        category: 'Payment summary',
                        label: 'booking_id',
                        value: booking_id
                    });

                    if(typeof($window.ga) !== 'undefined') {
                        if(scope.payment_data.booked_from.toLowerCase() === 'web' || scope.payment_data.booked_from.toLowerCase() === 'mobile') {

                            $window.ga('ecommerce:addTransaction', {
                              'id': booking_id,
                              'revenue': scope.payment_data.order_price,
                            });

                            scope.payment_data.orderDetail.forEach(function(ele, index) {
                                if(ele.hasOwnProperty("package")) {
                                    ele.package.forEach(function(ele1, index1) {
                                        if(ele1.hasOwnProperty("package_id")) {
                                            var category = ele1.package_id.split("_");
                                            $window.ga('ecommerce:addItem', {
                                              'id': booking_id,
                                              'revenue': scope.payment_data.order_price,
                                              'name': ele1.display_name,    
                                              'sku': ele1.package_id,                 
                                              'category': category[0],        
                                              'price': ele1.healthians_price,                
                                              'quantity': 1
                                            });
                                        }
                                    });
                                }
                            });

                            $window.ga('ecommerce:send');
                        }
                    }

                    if(typeof($window.fbq) !== 'undefined') {
                        var all_package_ids = [];
                        var fb_contents = [];

                        scope.payment_data.orderDetail.forEach(function(ele, index) {
                            if(ele.hasOwnProperty("package")) {
                                ele.package.forEach(function(ele1, index1) {
                                    if(ele1.hasOwnProperty("package_id")) {
                                        if(!_.contains(all_package_ids, ele1.package_id)) {
                                            all_package_ids.push(ele1.package_id);
                                        }
                                       
                                        var fb_content_json = {
                                            'id': ele1.package_id, 
                                            'quantity': 1, 
                                            'item_price': ele1.healthians_price
                                        }

                                        if(fb_contents.length > 0) {
                                            var checkAlreadyAdd = false;
                                            fb_contents.forEach(function(ele2, index2) {
                                                if(ele2.id == ele1.package_id) {
                                                    checkAlreadyAdd = true;
                                                    fb_contents[index2]['quantity'] = fb_contents[index2]['quantity'] + 1;
                                                }
                                            });

                                            if(!checkAlreadyAdd) {
                                                fb_contents.push(fb_content_json);
                                            }
                                        }
                                        else {
                                           fb_contents.push(fb_content_json); 
                                        }
                                    }
                                });
                            }
                        });

                        if(all_package_ids) {
                            $window.fbq('track', 'Purchase', {
                                value: scope.payment_data.order_price, 
                                currency: 'INR', 
                                'booking_id':booking_id,
                                'content_type': 'product',
                                'content_ids': all_package_ids,
                                'contents':  fb_contents
                            });  
                        }

                        
                    }
                }

                localStorage.removeItem("booking_id");  
                cartService.setSelectedPatient('', '');
                localStorage.removeItem("tempCart");
                localStorage.removeItem("tempPkg");
	            localStorage.removeItem("address");
	            localStorage.removeItem("amountfinal");
	            localStorage.removeItem("coupondata");
	            localStorage.removeItem("customerDetails");
	            localStorage.removeItem("houseno");
	            localStorage.removeItem("landmark");
	            localStorage.removeItem("postal_code");
	            localStorage.removeItem("sample_date");
	            localStorage.removeItem("time_slot");
	            localStorage.removeItem("total_amount");
	            localStorage.removeItem("type_of_payment");
	            localStorage.removeItem("Detailscustomer");
	            scope.getCartTotalTest();
            }
            else {
            	scope.payment_api_error = data.message;
            }
        });
    };

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

    if($location.search().booking_id) {
    	var booking_id = scope.stateParms.booking_id;
    	var user_id = "";
    	var mobile = "";
    	
    	if(scope.stateParms.mobile) {
    		mobile = scope.stateParms.mobile;
    	}
        else {
            if(localStorage.getItem("userDetail") !== null) {
                mobile = JSON.parse(localStorage.getItem("userDetail")).mobile;
            }
        }

        if(mobile === '') {
            if(scope.stateParms.user_id) {
                user_id = scope.stateParms.user_id;
            }
            else if(localStorage.getItem("user") !== null) {
                user_id = JSON.parse(localStorage.getItem("user")).user_id;
            }
        }
    	 
    	scope.getPaymentSummaryDetails(booking_id, user_id, mobile);
    }

    scope.convenience_fees_visible = false;
    scope.showConvenienceFeesDialog = function() {
        scope.convenience_fees_visible = true;
    }
    
 }