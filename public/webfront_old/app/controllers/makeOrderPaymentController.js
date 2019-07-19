App.controller('makeOrderPaymentController', makeOrderPaymentController);
makeOrderPaymentController.$inject = ['$scope', 'dataShare','dataShare1', '$localStorage', '$sessionStorage', '$timeout', '$rootScope', '$location','$http', '$q', 'BookOrderService', '$state', '$stateParams','ConstConfig','$sce'];
function makeOrderPaymentController (scope, dataShare,dataShare1, $localStorage, $sessionStorage, $timeout, $rootScope, $location ,$http ,$q ,BookOrderService ,$state ,$stateParams,ConstConfig,$sce) {
 	scope.detail = {};
    scope.error = false;
    scope.wholediv = true;
    //scope.date = new Date();
    scope.coupondata = {} ;
    scope.coupondata.applied = false;
    scope.coupondata.hard_copy = false;
    scope.termsCondition = true;
    scope.termError = false;
    scope.payradio = "paytm";

    scope.onlineDiscount = 0;
    scope.onlineDiscountActive = false;
    scope.onlineDiscountApplied = false;
    $rootScope.meta_robots = "noindex, nofollow";

    var paymentUrl = ConstConfig.paymentUrl;
    scope.payuAction = $sce.trustAsResourceUrl(paymentUrl+'payupayment');
    scope.mobikwikAction = $sce.trustAsResourceUrl(paymentUrl+'mobikwikpayment');
    scope.payzappAction = $sce.trustAsResourceUrl(paymentUrl+'payzapppayment');
    scope.paytmAction = $sce.trustAsResourceUrl(paymentUrl+'paytmpayment');

    scope.getDonationInfo = function(){
        var getDonationInfoURL = ConstConfig.couponUrl + "webv1/web_api/getDonationInfo";
        
        doGet($http, getDonationInfoURL, function(data) {
            if (data.status === "success") {
                scope.donation_details = data.data;
                scope.online_discount_config = scope.donation_details.online_discount;

                if(scope.online_discount_config.active == 'on') {
                    if(scope.online_discount_config.source.includes('web')) {
                        scope.onlineDiscountActive = true;
                        scope.online_discount_amount = parseInt(scope.online_discount_config.amount);
                        scope.online_discount_mimimum_amount = parseInt(scope.online_discount_config.minimum_booking_amount);
                    }
                    else {
                        scope.onlineDiscountActive = false;
                    }
                }
                else {
                    scope.onlineDiscountActive = false;
                }
            }
        });
    }

    scope.getDonationInfo();


    scope.sendOtpFunction = function(source) {
        //console.log("odrderPayment",scope.odrderPayment);
        //console.log("odrderMobilePayment",scope.odrderMobilePayment);
        if (scope.odrderPayment == undefined || scope.odrderPayment == "") {
            scope.sendOrderError = true ;
        } 
        else if (scope.odrderMobilePayment == undefined || scope.odrderMobilePayment == "") {
            scope.sendMobileError = true ;
        } 
        else { 
            
            if(source === '') {
                doPostWithOutToken($http,ConstConfig.serverUrl + "commonservice/genrate_payment_link",{"order_id" : scope.odrderPayment,"mobile" : scope.odrderMobilePayment},"",function(data){
                    if (data.status == true) {
                        scope.detail = data.data;
                        scope.bookingdetail = true;
                        scope.booking_id = scope.detail.booking_id;
                        scope.discountamount = scope.detail.payable_amount;
                        scope.total_booking_amount = scope.detail.order_price;
                        scope.payatcollection = scope.detail.payatcollection;
                        scope.name = scope.detail.customer_name;
                        scope.mobile = scope.detail.contact_number;
                        scope.email = scope.detail.email_address;
                        //scope.slot_id = scope.detail.slot_id;
                        var address = {"address":scope.detail.address};
                        var timeSlot = {"start_time" : scope.detail.slot_start_time, "end_time" : scope.detail.slot_end_time};
                        var userDetail = {"name":scope.detail.customer_name, "mobile":scope.detail.contact_number, "email":scope.detail.email_address, "address":address};
                        var customerDetail = [];
                        var order = [];
                        var testString = '';
                        var fasting ;
                        scope.detail.orderDetail.forEach(function(ele,index){
                            var order = [];
                            var testString = '';
                            ele.Package.forEach(function(ele1,index1){
                                fasting = {"fasting" : ele1.fasting, "fasting_time" : ele1.fasting_time};
                                ele1.test_detail.forEach(function(ele2,index2){
                                    testString += ele2.name;
                                    testString += ',';
                                });
                                order.push({"display_name" : ele1.display_name, "actual_price" : ele1.actaul_price, "healthian_price" : ele1.healthians_price, "all_package_StringName" : testString, "all_package_name" : ele1.test_detail});
                            });
                            customerDetail.push({"name" : ele.cust_name, "age" : ele.cust_age, "gender" : ele.cust_gender, "pkg" : fasting, "newpkg" : order});
                        });
                        //console.log(JSON.stringify(customerDetail));
                        if (scope.detail.hard_copy === 'yes') {
                            scope.coupondata.hard_copy = true ;
                        }

                        if (scope.detail.coupon_code) {
                            scope.coupondata.applied = true ;
                            scope.coupondata.discount = scope.detail.discounted_amount;
                        }

                        if([2,5].includes(parseInt(scope.detail.delivery_status))) {
                            if(!scope.detail.online_discount_applied) {
                                if(scope.onlineDiscountActive) {
                                    if(parseInt(scope.detail.payatcollection) >= scope.online_discount_mimimum_amount) {
                                        if((parseInt(scope.detail.payatcollection)-scope.online_discount_amount) > 0) {
                                            console.log("Online Discount Applied");
                                            scope.onlineDiscountApplied = true;
                                            scope.onlineDiscount = scope.online_discount_amount;
                                        }                                       
                                    }
                                }
                            }                          
                        }
                        else {
                            scope.onlineDiscountApplied = false;
                        }

                        localStorage.setItem("booking_id",scope.detail.booking_id);
                        localStorage.setItem("coupondata",scope.detail.booking_id);
                        localStorage.setItem("userDetail",JSON.stringify(userDetail));
                        localStorage.setItem("sample_date",scope.detail.order_date);
                        
                        if(localStorage.getItem("type_of_payment") !== 'Cash on delivery') {
                            localStorage.setItem("type_of_payment","Online");
                        }        
                        
                        localStorage.setItem("customerDetails",JSON.stringify(customerDetail));
                        localStorage.setItem("time_slot",JSON.stringify(timeSlot));
                        localStorage.setItem("total_amount",scope.detail.payable_amount);
                        localStorage.setItem("coupondata",JSON.stringify(scope.coupondata));

                        scope.bookingdetail = false;
                        scope.paymentsection = true;
                        scope.subscriptionsection = false;

                    } else {
                        scope.error = true;
                        scope.errorMsg = data.message;
                        scope.bookingdetail = true;
                        scope.paymentsection = false;
                    }
                }); 
            }

            if(source === 'crm') {
                var requestPayload = {
                    "order_id" : scope.odrderPayment,
                    "mobile" : scope.odrderMobilePayment, 
                    "pid": $location.search().pid
                }
                var apiURL = ConstConfig.serverUrl + "commonservice/generate_crm_payment_link";
                doPostWithOutToken($http,apiURL,requestPayload,"",function(data){
                    if (data.status == true) {
                        scope.details = data.data;
                        
                        scope.bookingdetail = false;
                        scope.paymentsection = true;
                        scope.subscriptionsection = false;

                        scope.booking_id = scope.details.booking_id;
                        scope.discountamount = scope.details.requested_amount;
                        scope.total_booking_amount = scope.details.order_price;
                        scope.payatcollection = scope.details.payatcollection;
                        scope.mobile = scope.details.contact_number;
                        scope.email = scope.details.email_address;
                        //scope.slot_id = scope.details.slot_id;
                        scope.detail = {
                            "booking_id": scope.booking_id,
                            "contact_number": scope.details.contact_number,
                            "email_address": scope.details.email_address,
                            "customer_name": scope.details.customer_name
                        }

                        if([2,5].includes(parseInt(scope.details.delivery_status))) {
                            if(!scope.details.online_discount_applied) {
                                if(scope.onlineDiscountActive) {
                                    if(parseInt(scope.details.payatcollection) >= parseInt(scope.online_discount_mimimum_amount)) {

                                        if((parseInt(scope.details.payatcollection)-scope.online_discount_amount) > 0) {
                                            console.log("Online Discount Applied");
                                            scope.onlineDiscountApplied = true;
                                            scope.onlineDiscount = scope.online_discount_amount;
                                        }                                        
                                    }
                                }
                            }                            
                        }

                        localStorage.setItem("booking_id",scope.detail.booking_id);
                    }
                    else {
                        scope.error = true;
                        scope.errorMsg = data.message;
                        
                        scope.bookingdetail = true;
                        scope.paymentsection = false;
                        scope.subscriptionsection = false;
                    }
                });
            }

            if(source === 'subscription') {
                var requestPayload = {
                    "user_subscription_id" : $location.search().subscription_id,
                    "user_mobile" : $location.search().mobile
                }
                scope.mobile = $location.search().mobile;
                
                localStorage.setItem("subscription_id", $location.search().subscription_id);
                localStorage.setItem("subscription_mobile", $location.search().mobile);

                var apiURL = ConstConfig.serverUrl + "subscription_management/get_subscription_detail_for_payment";
                doPostWithOutToken($http,apiURL,requestPayload,"",function(data){
                    if (data.status == true) {
                        scope.details = data.data;

                        if(scope.details.payment_details.length > 0) {
                            scope.total_received_amount = 0;

                            scope.details.payment_details.forEach(function(ele, index) {
                                scope.total_received_amount+= ele.recieved_amount;
                            });

                            scope.subscription_amount = parseInt(scope.details.price - scope.total_received_amount);
                            if(scope.subscription_amount <= 0) {
                                scope.payment_pending = false;
                            } 
                            else {
                                scope.payment_pending = true;
                            }                            
                        }
                        else {
                            scope.subscription_amount = scope.details.price;
                            scope.payment_pending = true;
                        }

                        scope.bookingdetail = false;
                        scope.paymentsection = true;
                        scope.subscriptionsection = true;

                        scope.subscription_id = scope.details.user_subscribe_id;
                    }
                    else {
                        scope.error = true;
                        scope.errorMsg = data.message;
                        scope.bookingdetail = true;
                        scope.paymentsection = false;
                        scope.subscriptionsection = false;
                    }
                });
            }


            if(source === 'service') {
                var requestPayload = {
                    "service_booking_id" : $location.search().service_booking_id,
                    "user_mobile" : $location.search().mobile
                }
                scope.mobile = $location.search().mobile;
                
                localStorage.setItem("service_booking_id", $location.search().service_booking_id);
                localStorage.setItem("service_mobile", $location.search().mobile);

                var apiURL = ConstConfig.paymentUrl + "service/healthians_service/get_service_detail_for_payment";
                doPostWithOutToken($http,apiURL,requestPayload,"",function(data){
                    if (data.status == true) {
                        scope.details = data.data;

                        if(scope.details.payment_details.length > 0) {
                            scope.total_received_amount = 0;

                            scope.details.payment_details.forEach(function(ele, index) {
                                scope.total_received_amount+= ele.recieved_amount;
                            });

                            scope.service_amount = parseInt(scope.details.order_price - scope.total_received_amount);
                            if(scope.service_amount <= 0) {
                                scope.payment_pending = false;
                            } 
                            else {
                                scope.payment_pending = true;
                            }                            
                        }
                        else {
                            scope.service_amount = scope.details.order_price;
                            scope.payment_pending = true;
                        }

                        scope.bookingdetail = false;
                        scope.paymentsection = true;
                        scope.subscriptionsection = false;
                        scope.servicesection = true;

                        scope.service_booking_id = scope.details.service_booking_id;
                    }
                    else {
                        scope.error = true;
                        scope.errorMsg = data.message;
                        scope.bookingdetail = true;
                        scope.paymentsection = false;
                        scope.subscriptionsection = false;
                    }
                });
            }
              
        }
        $timeout(function(){
             scope.sendOrderError = false;
             scope.sendMobileError = false;
             scope.error = false;
        },3000);
        
    };

    if($location.search().booking_id && $location.search().mobile) {
        scope.odrderPayment = $location.search().booking_id;
        scope.odrderMobilePayment = $location.search().mobile; 

        if($location.search().source === 'crm') {
            scope.sendOtpFunction('crm');
        }
        else {
            scope.sendOtpFunction('');
        }
        
    }
    else if ($location.search().subscription_id && $location.search().mobile){
        scope.odrderPayment = $location.search().subscription_id;
        scope.odrderMobilePayment = $location.search().mobile; 
        if($location.search().payment_type_source === 'subscription') {
            scope.sendOtpFunction('subscription');
        }
    }
    else if ($location.search().service_booking_id && $location.search().mobile){
        scope.odrderPayment = $location.search().service_booking_id;
        scope.odrderMobilePayment = $location.search().mobile; 
        if($location.search().payment_type_source === 'service') {
            scope.sendOtpFunction('service');
        }
    }
    else {
        if($location.search().booking_id) {
            scope.odrderPayment = $location.search().booking_id;
        }
        scope.bookingdetail = true;
        scope.paymentsection = false;
    }

    
    
    scope.sendDetailFunction = function() {
        //console.log("434324");
        //console.log("odrderPayment",scope.odrderPayment);
        //console.log("odrderMobilePayment",scope.odrderMobilePayment);
        if (scope.orderPayment == undefined || scope.orderPayment == "") {
            scope.sendBookingError = true ;
            //return false ;
        } else if (scope.orderReferencePayment == undefined || scope.orderReferencePayment == "") {
            scope.sendReferenceError = true ;
        } else { 
            //console.log("order_id" , scope.orderPayment,"reference_number" , scope.orderReferencePayment);
            // doPost($http,"//crm2.healthians.com/commonservice/send_mobile_otp",{"mobile_number" : scope.sendOtpNo},"",function(data){
            doPost($http,ConstConfig.serverUrl + "commonservice/varify_payment_reference_number",{"order_id" : scope.orderPayment,"reference_number" : scope.orderReferencePayment},"",function(data){
                if (data.status == true) {
                    scope.detail = data.data;
                    scope.bookingdetail = true;
                    scope.booking_id = scope.detail.booking_id;
                    scope.discountamount = scope.detail.payable_amount;
                    scope.total_booking_amount = scope.detail.order_price;
                    scope.payatcollection = scope.detail.payatcollection;
                    scope.name = scope.detail.customer_name;
                    scope.mobile = scope.detail.contact_number;
                    scope.email = scope.detail.email_address;
                    //scope.slot_id = scope.detail.slot_id;
                    var address = {"address":scope.detail.address};
                    var timeSlot = {"start_time" : scope.detail.slot_start_time, "end_time" : scope.detail.slot_end_time};
                    var userDetail = {"name":scope.detail.customer_name, "mobile":scope.detail.contact_number, "email":scope.detail.email_address, "address":address};
                    var customerDetail = [];
                    var order = [];
                    var testString = '';
                    var fasting ;
                    scope.detail.orderDetail.forEach(function(ele,index){
                        ele.Package.forEach(function(ele1,index1){
                            fasting = {"fasting" : ele1.fasting, "fasting_time" : ele1.fasting_time};
                            ele1.test_detail.forEach(function(ele2,index2){
                                testString += ele2.name;
                                testString += ',';
                            });
                            order.push({"display_name" : ele1.display_name, "actual_price" : ele1.actaul_price, "healthian_price" : ele1.healthians_price, "all_package_StringName" : testString, "all_package_name" : ele1.test_detail});
                        });
                        customerDetail.push({"name" : ele.cust_name, "age" : ele.cust_age, "gender" : ele.cust_gender, "pkg" : fasting, "newpkg" : order});
                    });
                    //console.log(customerDetail);
                    if (scope.detail.hard_copy === 'yes') {
                        scope.coupondata.hard_copy = true ;
                    }

                    if (scope.detail.coupon_code) {
                        scope.coupondata.applied = true ;
                        scope.coupondata.discount = scope.detail.discounted_amount;
                    }

                    scope.payatcollection = scope.detail.payatcollection;

                    localStorage.setItem("booking_id",scope.detail.booking_id);
                    localStorage.setItem("userDetail",JSON.stringify(userDetail));
                    localStorage.setItem("sample_date",scope.date);
                    
                    if(localStorage.getItem("type_of_payment") !== 'Cash on delivery') {
                        localStorage.setItem("type_of_payment","Online");
                    }
                    
                    localStorage.setItem("customerDetails",JSON.stringify(customerDetail));
                    localStorage.setItem("time_slot",JSON.stringify(timeSlot));
                    localStorage.setItem("total_amount",scope.detail.payable_amount);
                    localStorage.setItem("coupondata",JSON.stringify(scope.coupondata));
                    scope.bookingdetail = false;
                    scope.paymentsection = true;

                } else {
                    scope.error = true;
                    scope.errorMsg = data.message;
                    scope.bookingdetail = true;
                    scope.paymentsection = false;
                }
            });
            
            //$location.path('/makepayment_process');
        }
        $timeout(function(){
             scope.sendBookingError = false ;
             scope.sendReferenceError = false ;
             scope.error = false;
        },3000);
        
    };

    // console.log(localStorage.getItem("booking_id"));
    // console.log(localStorage.getItem("userDetail"));
    // console.log(localStorage.getItem("sample_date"));
    // console.log(localStorage.getItem("type_of_payment"));
    // console.log(localStorage.getItem("customerDetails"));
    // console.log(localStorage.getItem("time_slot"));
    // console.log(localStorage.getItem("type_of_payment"));
    // console.log(localStorage.getItem("type_of_payment"));

    scope.termsConditionCheck = function () {
        scope.termsCondition == true;
        scope.termError = false;
    };
    
    
    scope.payFunction = function() {   
        scope.paymentsection = true;
        scope.bookingdetail = false;
    };

    scope.makeFinalPayment = function() {
        if (scope.termsCondition === undefined || scope.termsCondition === false) {
            scope.termError = true;
            focus('userterms');
            return false;
        }

        localStorage.setItem("type_of_payment",(scope.payradio == 'cash' ? "Cash on delivery" : "Online"));

        if (scope.payradio == 'cash') {
            /* Update Payment Type in case of COD */
            /* To Do : Update payment type in non-cod in payment gateway code */
            var codURL = ConstConfig.serverUrl + "commonservice/update_payment_type";
            var codpayload = {
                "booking_id": scope.booking_id,
                "payment_type": (scope.payradio == 'cash' ? "Cash on delivery" : "Online"),
                "term_condition": true
            }

            doPost($http, codURL, codpayload, "", function(data) {
                scope.loaderVar = false;
                if(data.status) {
                    $state.go('payment-summary', {
                        action:'Get', 
                        booking_id:scope.booking_id, 
                        mobile:scope.mobile
                    });
                }
            });

        }

        if(scope.payradio == 'payu')
        {
            localStorage.setItem("makepayment_to_summary","true") ;
            var $form = $('#paymentForm');
            $form.find('[name=booking_id]').val(scope.booking_id) ;
            if(scope.onlineDiscountApplied) {
                $form.find('[name=txnAmount]').val(scope.discountamount-scope.onlineDiscount);
                $form.find('[name=makePaymentOnlineDiscount]').val("yes");
            }
            else {
                $form.find('[name=txnAmount]').val(scope.discountamount);
            }
            
            $form.find('[name=custName]').val(scope.name) ;
            $form.find('[name=custMobile]').val(scope.mobile);
            $form.find('[name=custEmail]').val(scope.email) ;
            //$form.find('[name=stm_id]').val(scope.slot_id) ;       
            $form.submit();   
        }

        if(scope.payradio == 'mobikwik')
        {
            localStorage.setItem("makepayment_to_summary","true");
            var $form = $('#paymentForm3');
            $form.find('[name=booking_id]').val(scope.booking_id);
            
            if(scope.onlineDiscountApplied) {
                $form.find('[name=txnAmount]').val(scope.discountamount-scope.onlineDiscount);
                $form.find('[name=makePaymentOnlineDiscount]').val("yes");
            }
            else {
                $form.find('[name=txnAmount]').val(scope.discountamount);
            }

            $form.find('[name=custName]').val(scope.name);
            $form.find('[name=custMobile]').val(scope.mobile);
            $form.find('[name=custEmail]').val(scope.email);
            //$form.find('[name=stm_id]').val(scope.slot_id);        
            $form.submit();
        }

        if(scope.payradio == 'paytm')
        {
            //alert("paytm form");
            localStorage.setItem("makepayment_to_summary","true") ;
            var $form = $('#paymentForm2');
            $form.find('[name=booking_id]').val(scope.booking_id);

            if(scope.onlineDiscountApplied) {
                $form.find('[name=txnAmount]').val(scope.discountamount-scope.onlineDiscount);
                $form.find('[name=makePaymentOnlineDiscount]').val("yes");
            }
            else {
                $form.find('[name=txnAmount]').val(scope.discountamount);
            }
            
            $form.find('[name=custName]').val(scope.name);
            $form.find('[name=custMobile]').val(scope.mobile);
            $form.find('[name=custEmail]').val(scope.email);
            $form.find('[name=user_id]').val(scope.booking_id) ;
            //$form.find('[name=stm_id]').val(scope.slot_id) ;
            $form.submit();
        }

    }

    scope.makeSubscriptionFinalPayment = function() {
        if (scope.termsCondition === undefined || scope.termsCondition === false) {
            scope.termError = true;
            focus('userterms');
            return false;
        }

        if(scope.payradio == 'payu') {            
            var $form = $('#paymentForm');
            $form.find('[name=booking_id]').val(scope.subscription_id);
            $form.find('[name=txnAmount]').val(scope.subscription_amount);
            $form.find('[name=custMobile]').val(scope.mobile);           
            $form.find('[name=payment_type_source]').val('subscription');
               
            $form.submit();   
        }

        if(scope.payradio == 'mobikwik') {            
            var $form = $('#paymentForm3');
            $form.find('[name=booking_id]').val(scope.subscription_id);
            $form.find('[name=txnAmount]').val(scope.subscription_amount);
            $form.find('[name=payment_type_source]').val('subscription') ;         
            $form.submit();
        }

        if(scope.payradio == 'paytm') {            
            var $form = $('#paymentForm2');
            $form.find('[name=booking_id]').val(scope.subscription_id);
            $form.find('[name=txnAmount]').val(scope.subscription_amount);
            $form.find('[name=payment_type_source]').val('subscription');
            $form.submit();
        }

    }


    scope.makeServiceFinalPayment = function() {
        if (scope.termsCondition === undefined || scope.termsCondition === false) {
            scope.termError = true;
            focus('userterms');
            return false;
        }

        if(scope.payradio == 'payu') {            
            var $form = $('#paymentForm');
            $form.find('[name=booking_id]').val(scope.service_booking_id);
            $form.find('[name=txnAmount]').val(scope.service_amount);
            $form.find('[name=custMobile]').val(scope.mobile);           
            $form.find('[name=payment_type_source]').val('service');
               
            $form.submit();   
        }

        if(scope.payradio == 'mobikwik') {            
            var $form = $('#paymentForm3');
            $form.find('[name=booking_id]').val(scope.service_booking_id);
            $form.find('[name=txnAmount]').val(scope.service_amount);
            $form.find('[name=payment_type_source]').val('service') ;         
            $form.submit();
        }

        if(scope.payradio == 'paytm') {            
            var $form = $('#paymentForm2');
            $form.find('[name=booking_id]').val(scope.service_booking_id);
            $form.find('[name=txnAmount]').val(scope.service_amount);
            $form.find('[name=payment_type_source]').val('service');
            $form.submit();
        }

    }

    scope.clickPaymentMode = function(payment_mode) {
        scope.payradio = payment_mode;

        if(scope.payradio === 'cash') {
            scope.onlineDiscountApplied = false;
        }
    }
 }