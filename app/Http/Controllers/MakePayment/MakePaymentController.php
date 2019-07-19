<?php

namespace App\Http\Controllers\MakePayment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Exception;

class MakePaymentController extends Controller
{
    /**
     * This is for Make Payment Controller Page
     * Route /makepayment?mobile&booking_id&source&pid&subscription_id&payment_type_source&service_booking_id
     */
    
    public function __construct(Request $request)
    {       
        parent::__construct($request);
    }
    
    /**
     * This is for Make Payment
     */
    public function index(){
       
        try {

            $request    = $this->request;

            $route = request()->route()->getName();
            $this->seoDataProcess($route);
            
            $data = [
                'detail'                    => [],
                'booking_section'           => false,
                'subscription_section'      => false,
                'service_section'           => false,
                'payment_section'           => false,
                'type'                      => '',
                'online_discount'           => false,
                'online_discount_amount'    => 0,
                'paytm_payment_url'         => env('CRM_URL').'paytmpayment',
                'payu_payment_url'          => env('CRM_URL').'payupayment',
                'mobikwik_payment_url'      => env('CRM_URL').'mobikwikpayment'
            ];

            // Payment gateway Options
            $payment_details            =   config()->get('payment.payment_methods');
            unset($payment_details['cash']);
            $data['payment_options']    =   $payment_details;

            // Get Query Strings
            $booking_id         = $request->query('booking_id');
            $mobile             = $request->query('mobile');
            $source             = $request->query('source');
            $subscription_id    = $request->query('subscription_id');
            $service_booking_id = $request->query('service_booking_id');
            $pid                = $request->query('pid');

            if(!empty($booking_id) && !empty($mobile)) {

                /* Check Online Discount Active or not */
                $donationUrl            = env('API_URL').config()->get('constants.donation_online_discount_coupon_info');
                $donationFeeDetail      = handleGuzzleCurlRequest($donationUrl, 'GET', null);
                $online_discount_active = false;

                if(isset($donationFeeDetail['status'])) {
                    if(!empty($donationFeeDetail['data']) && $donationFeeDetail['status'] == true) {
                        $donation_details           = $donationFeeDetail['data'];
                        if(!empty($donation_details['online_discount'])) {
                            if($donation_details['online_discount']['active'] == 'on') {
                                if(in_array('web', $donation_details['online_discount']['source'])) {
                                    $online_discount_active         = true;
                                    $online_discount_amount         = (int)$donation_details['online_discount']['amount'];
                                    $online_discount_mimimum_amount = (int)$donation_details['online_discount']['minimum_booking_amount'];
                                }
                            }
                        }
                    }
                }

                $message = '';

                // For make payment using CRM generated Link
                if(!empty($source) && !empty($pid)) {
                    $booking_details = $this->getBookingCrmLinkDetails($booking_id, $mobile, $pid);
                    $message         = $booking_details['message'];
                    $booking_details = $booking_details['data'];
                    if(!empty($booking_details)) {
                        $booking_details['payable_amount'] =  $booking_details['payatcollection'];
                    }
                }
                else {
                    $booking_details = $this->getBookingDetails($booking_id, $mobile);
                    $message         = $booking_details['message'];
                    $booking_details = $booking_details['data'];
                }

                if(!empty($booking_details)) {
                    $data['detail']             = $booking_details;
                    $data['booking_section']    = true;

                    cookie()->queue('cust_mobile', $mobile, 1440,'/', null, false, false);
                    cookie()->queue('booking_id', $booking_id, 1440,'/', null, false, false);
                    
                    if(in_array((int)$booking_details['delivery_status'], [2,5])) {
                        if(!$booking_details['online_discount_applied']) {
                            if($online_discount_active) {
                                if((int)$booking_details['payatcollection'] >= $online_discount_mimimum_amount) {
                                    if(((int)$booking_details['payatcollection'] - $online_discount_amount) > 0 ) {
                                        $data['online_discount']        = true;
                                        $data['online_discount_amount'] = $online_discount_amount;
                                    }
                                }
                            }
                        }
                    }

                    if(($booking_details['payable_amount'] - $data['online_discount_amount']) > 0) {
                        $data['payment_section'] = true;
                    }
                }
                else {
                    return view('404_error',['error_message' => $message]);
                }
               
            }
            elseif(!empty($subscription_id) && !empty($mobile)) {
                $booking_details = $this->getSubscriptionDetails($subscription_id, $mobile);
                //dd($booking_details);
                if(!empty($booking_details)) {
                    $data['detail']                 = $booking_details;
                    $data['subscription_section']        = true;
                    
                    // Set cookie for summary and payment failed
                    cookie()->queue('subscription_mobile', $mobile, 1440,'/', null, false, false);
                    cookie()->queue('subscription_id', $subscription_id, 1440,'/', null, false, false);

                    if(!empty($booking_details['payment_details'])) {                       
                        $total_received_amount = 0;

                        foreach($booking_details['payment_details'] as $item) {
                            $total_received_amount += $item['recieved_amount'];
                        }
                        
                        $subscription_amount = (int)($booking_details['price'] - $total_received_amount);
                    }
                    else {
                        $subscription_amount = $booking_details['price'];
                    }

                    $data['subscription_amount']   = $subscription_amount;

                    if($subscription_amount > 0) {
                        $data['payment_section'] = true;
                    }
                    else {
                        $data['payment_section'] = false;
                    }
                    
                }
                else {
                    throw new Exception("Data not found.");
                }
            }
            elseif(!empty($service_booking_id) && !empty($mobile)) {
                $booking_details = $this->getServiceDetails($service_booking_id, $mobile);
                //dd($booking_details);
                if(!empty($booking_details)) {
                    $data['detail']                 = $booking_details;
                    $data['service_section']        = true;
                    
                    // Set cookie for summary and payment failed
                    cookie()->queue('service_mobile', $mobile, 1440,'/', null, false, false);
                    cookie()->queue('service_booking_id', $service_booking_id, 1440,'/', null, false, false);

                        if(!empty($booking_details['payment_details'])) {                       
                            $total_received_amount = 0;

                            foreach($booking_details['payment_details'] as $item) {
                                $total_received_amount += $item['recieved_amount'];
                            }
                            
                            $service_amount = (int)($booking_details['order_price'] - $total_received_amount);
                        }
                        else {
                            $service_amount = $booking_details['order_price'];
                        }

                        $data['service_amount']   = $service_amount;

                        if($service_amount > 0) {
                            $data['payment_section'] = true;
                        }
                        else {
                            $data['payment_section'] = false;
                        }

                        if($booking_details['service_status'] == 1) {
                            $data['payment_section'] = false;
                        }
                        
                }
                else {
                    throw new Exception("Data not found.");
                }
            }
            else {
                return view('404_error');
            }
            
            return view('makepayment.makepayment', $data);
        } catch (Exception $ex) {
            return view('404_error');
        }
    }

    /**
     * This is for Service Payment Summary
     */
    public function servicePaymentSummary() {
        try{

            $request            = $this->request;

            $route = request()->route()->getName();
            $this->seoDataProcess($route);

            $mobile             = $request->query('mobile');
            $service_booking_id = $request->query('service_booking_id');

            if(empty($service_booking_id)) {
                throw new Exception("Booking id is missing");
            }
            
            if(empty($mobile)) {
                if(!empty($request->cookie('service_mobile'))) {
                    $mobile   = $request->cookie('service_mobile');
                }                
                else if(auth()->check()) {
                    // find mobile no. if user Logged In
                    $token_id   = auth()->user()->id;
                    $token      = auth()->user()->token;
                    
                    if(session()->has('auth_'.$token_id)){
                        $user_detail    = session()->get('auth_'.$token_id);
                        $user_id        = session()->get('auth_'.$token_id)['user_id'];
                        $mobile         = $user_detail['mobile'];
                    }
                }
            }

            if(empty($mobile)) {
                throw new Exception("Mobile No. is missing");
            }

            $service_details = $this->getServiceDetails($service_booking_id, $mobile);            

            if(!empty($service_details)) {
                
                cookie()->queue(
                    \Cookie::forget('service_mobile')
                );
                cookie()->queue(
                    \Cookie::forget('service_booking_id')
                );

                if(!empty($request->query('merTxnId'))) {
                    $service_details['transactionId'] = $request->query('merTxnId');
                }
                
                if(!empty($service_details['payment_details'])) {
                    $total_received_amount = 0;

                    foreach($service_details['payment_details'] as $item) {
                        $total_received_amount += $item['recieved_amount'];
                    }
                    
                    $service_amount = $total_received_amount;
                    $service_details['transactionAmount']   = $service_amount;
                }
                
                $service_details['country_code'] = '91';

                return view('makepayment.service_payment_summary', $service_details);
            }
            else {
                throw new Exception("Something went wrong.");
            }                
        } catch (Exception $ex) {
            return view('404_error');
        }
    }

    /**
     * This is for Subscription Payment Summary
     */
    public function subscriptionPaymentSummary() {
        try{

            $request            = $this->request;

            $route = request()->route()->getName();
            $this->seoDataProcess($route);

            $mobile             = $request->query('mobile');
            $subscription_id    = $request->query('subscription_id');

            if(empty($subscription_id)) {
                throw new Exception("Subscription ID is missing");
            }
            
            if(empty($mobile)) {
                // find mobile no. in cookie
                if(!empty($request->cookie('subscription_mobile'))) {
                    $mobile   = $request->cookie('subscription_mobile');
                } 
                elseif(auth()->check()){
                    // find mobile no. if user Logged In
                    $token_id   = auth()->user()->id;
                    $token      = auth()->user()->token;
                    
                    if(session()->has('auth_'.$token_id)){
                        $user_detail    = session()->get('auth_'.$token_id);
                        $user_id        = session()->get('auth_'.$token_id)['user_id'];
                        $mobile         = $user_detail['mobile'];
                    }
                }
            }

            if(empty($mobile)) {
                throw new Exception("Mobile No. is missing");
            }

            $subscription_details = $this->getSubscriptionDetails($subscription_id, $mobile);            

            if(!empty($subscription_details)) {

                cookie()->queue(
                    \Cookie::forget('subscription_mobile')
                );
                cookie()->queue(
                    \Cookie::forget('subscription_id')
                );
                
                if(!empty($request->query('merTxnId'))) {
                    $subscription_details['transactionId'] = $request->query('merTxnId');
                }
                
                if(!empty($subscription_details['payment_details'])) {
                    $total_received_amount = 0;

                    foreach($subscription_details['payment_details'] as $item) {
                        $total_received_amount += $item['recieved_amount'];
                    }
                    
                    $subscription_amount = $total_received_amount;
                    $subscription_details['transactionAmount']   = $subscription_amount;
                }
                
                $subscription_details['country_code'] = '91';
                
                return view('makepayment.subscription_payment_summary', $subscription_details);
            }
            else {
                throw new Exception("Something went wrong.");
            }                
        } catch (Exception $ex) {
            return view('404_error');
        }
    }

    /**
     * This is get Booking Details for Make Payment
     */
    private function getBookingDetails($booking_id, $mobile){
        try {
            
            $request_data = [
                'order_id'          => $booking_id, 
                "mobile"            => $mobile,
                "source"            => 'web'
            ];
            
            $bookingDetailUrl = env('CRM_URL').config()->get('constants.make_payment_booking_details');
            $bookingDetail    = handleGuzzleCurlRequest($bookingDetailUrl, 'POST', null, $request_data);        
            return $bookingDetail;
            
        } catch (Exception $ex) {
            //dd($ex->getMessage());
            return [];
        }
    }

    /**
     * This is get Subscription Details for Make Payment
     */
    public function getSubscriptionDetails($subscription_id, $mobile){
        try {
  
            $request_data = [
                'user_subscription_id'  => $subscription_id, 
                "user_mobile"           => $mobile,
                "source"                => 'web'
            ];

            $bookingDetailUrl = env('CRM_URL').config()->get('constants.make_payment_subscription_details');
            $bookingDetail    = handleGuzzleCurlRequest($bookingDetailUrl, 'POST', null, $request_data);

            if(isset($bookingDetail['status'])) {
                if(!empty($bookingDetail['data'])) {
                    return $bookingDetail['data'];
                }
            }
            
            return [];
            
        } catch (Exception $ex) {
            return [];
        }
    }

    /**
     * This is get Service Details for Make Payment
     */
    public function getServiceDetails($service_booking_id, $mobile){
        try {
  
            $request_data = [
                'service_booking_id'    => $service_booking_id, 
                "user_mobile"           => $mobile,
                "source"                => 'web'
            ];
            
            $bookingDetailUrl = env('CRM_URL').config()->get('constants.make_payment_crm_service_details');
            $bookingDetail    = handleGuzzleCurlRequest($bookingDetailUrl, 'POST', null, $request_data);

            if(isset($bookingDetail['status'])) {
                if(!empty($bookingDetail['data'])) {
                    return $bookingDetail['data'];
                }
            }
            
            return [];
            
        } catch (Exception $ex) {
            return [];
        }
    }

    /**
     * This is for Make Payment for ( Booking + Service )
     */
    public function bookingServicePayment(){
       
        try {
            $request    = $this->request;
            
            $route = request()->route()->getName();
            $this->seoDataProcess($route);

            $data = [
                'detail'                    => [],
                'booking_section'           => false,
                'payment_section'           => false,
                'paytm_payment_url'         => env('CRM_URL').'paytmpayment',
                'payu_payment_url'          => env('CRM_URL').'payupayment',
                'mobikwik_payment_url'      => env('CRM_URL').'mobikwikpayment'
            ];

            // Payment gateway Options
            $payment_details            =   config()->get('payment.payment_methods');
            unset($payment_details['cash']);
            $data['payment_options']    =   $payment_details;

            // Get Query Strings
            $booking_id         = $request->query('booking_id');
            $mobile             = $request->query('mobile');
            $source             = $request->query('source');
            $service_booking_id = $request->query('service_booking_id');

            if(!empty($booking_id) && !empty($mobile) && !empty($service_booking_id)) {
                
                $booking_details = $this->getBookingServiceDetails($booking_id, $service_booking_id, $mobile);
                //dd($booking_details);
                if(!empty($booking_details)) {
                    $data['detail']             = $booking_details;
                    $data['booking_section']    = true;
                    $data['service_booking_id'] = $service_booking_id;
                    
                    $total_booking_service_amount   = 0;
                    $service_amount                 = 0;
                    $payatcollection                = $booking_details['payatcollection'];

                    if(!empty($booking_details['service_details'])) {
                        $total_service_received_amount = 0;
                        
                        if($booking_details['service_details']['payment_details']) {

                            foreach($booking_details['service_details']['payment_details'] as $item) {
                                $total_service_received_amount += $item['recieved_amount'];
                            }

                            $service_amount = (int)($booking_details['service_details']['order_price'] - $total_service_received_amount);
                        }
                        else {
                            $service_amount = (int)$booking_details['service_details']['order_price'];
                        }                    
                    }

                    $total_booking_service_amount           = $payatcollection + $service_amount;
                    $data['total_booking_service_amount']   = $total_booking_service_amount;
                    $data['service_amount']                 = $service_amount;
                    $data['payatcollection']                = $payatcollection;

                    cookie()->queue('cust_mobile', $mobile, 1440,'/', null, false, false);
                    cookie()->queue('booking_id', $booking_id, 1440,'/', null, false, false);
                    cookie()->queue('service_booking_id', $service_booking_id, 1440,'/', null, false, false);

                    if((int)$booking_details['payable_amount'] > 0) {
                        $data['payment_section'] = true;
                    }
                }
                else {
                    throw new Exception("Data not found.");
                }              
            }
            else {
                return view('404_error');
            }

            return view('makepayment.makepayment_booking_service', $data);
        } catch (Exception $ex) {
            return view('404_error');
        }
    }

    /**
     * This is for Booking + Service Payment Summary
     */
    public function bookingServicePaymentSummary() {
        try{

            $request            = $this->request;

            $route = request()->route()->getName();
            $this->seoDataProcess($route);

            $mobile             = $request->query('mobile');
            $booking_id         = $request->query('booking_id');
            $service_booking_id = $request->query('service_booking_id');

            if(empty($booking_id)) {
                throw new Exception("Booking id is missing");
            }

            if(empty($service_booking_id)) {
                throw new Exception("Service Booking ID is missing");
            }
            
            if(empty($mobile)) {
                if(!empty($request->cookie('cust_mobile'))) {
                    $mobile   = $request->cookie('cust_mobile');
                }
                else if(auth()->check()){
                    // find mobile no. if user Logged In
                    $token_id   = auth()->user()->id;
                    $token      = auth()->user()->token;
                    
                    if(session()->has('auth_'.$token_id)){
                        $user_detail    = session()->get('auth_'.$token_id);
                        $user_id        = session()->get('auth_'.$token_id)['user_id'];
                        $mobile         = $user_detail['mobile'];
                    }
                }
            }

            if(empty($mobile)) {
                throw new Exception("Mobile No. is missing");
            }

            $booking_service_details = $this->getBookingServiceDetails($booking_id, $service_booking_id, $mobile);            
            //dd($booking_service_details);
            if(!empty($booking_service_details)) {
                
                cookie()->queue(
                    \Cookie::forget('cust_mobile')
                );
                cookie()->queue(
                    \Cookie::forget('booking_id')
                );
                cookie()->queue(
                    \Cookie::forget('service_booking_id')
                );

                if(!empty($request->query('merTxnId'))) {
                    $booking_service_details['transactionId'] = $request->query('merTxnId');
                }
               
                if(!empty($request->query('cardType'))) {
                    $booking_service_details['card_type'] = $request->query('cardType');
                }
                    
                if(!empty($request->query('cardClassificationType'))) {
                    $booking_service_details['cardClassificationType'] = $request->query('cardClassificationType');
                }
                    
                $booking_service_details['hard_copy_price']   = 50;
                
                $total_booking_service_amount   = 0;
                $total_service_received_amount  = 0;
                $total_booking_received_amount  = 0;

                if(!empty($booking_service_details['service_details'])) {                    
                    if($booking_service_details['service_details']['payment_details']) {
                        foreach($booking_service_details['service_details']['payment_details'] as $item) {
                            $total_service_received_amount += $item['recieved_amount'];
                        }
                    }                   
                }

                if(!empty($booking_service_details['payment_details'])) {                    
                    if($booking_service_details['payment_details']) {
                        foreach($booking_service_details['payment_details'] as $item) {
                            $total_booking_received_amount += $item['recieved_amount'];
                        }
                    }                   
                }

                $total_booking_service_order_price = (int)$booking_service_details['order_price'] + (int)$booking_service_details['service_details']['order_price'];

                $total_booking_service_amount                                   = $total_booking_received_amount + $total_service_received_amount;
                $booking_service_details['total_booking_service_amount']        = $total_booking_service_amount;
                $booking_service_details['total_booking_service_order_price']   = $total_booking_service_order_price;
                $booking_service_details['country_code']                        = '91';

                return view('makepayment.booking_service_payment_summary', $booking_service_details);
            }
            else {
                throw new Exception("Something went wrong.");
            }                
        } catch (Exception $ex) {
            return view('404_error');
        }
    }

    /**
     * This is get Service Details for Make Payment
     */
    public function getBookingServiceDetails($booking_id, $service_booking_id, $mobile){
        try {
  
            $request_data = [
                'order_id'              => $booking_id,
                'service_booking_id'    => $service_booking_id, 
                "mobile"                => $mobile,
                "source"                => 'web'
            ];
            
            $bookingDetailUrl = env('CRM_URL').config()->get('constants.make_payment_booking_service_details');
            $bookingDetail    = handleGuzzleCurlRequest($bookingDetailUrl, 'POST', null, $request_data);

            if(isset($bookingDetail['status'])) {
                if(!empty($bookingDetail['data'])) {
                    return $bookingDetail['data'];
                }
            }
            
            return [];
            
        } catch (Exception $ex) {
            return [];
        }
    }

    /**
     * This is get Booking Details for Make Payment using CRM Payment Link
     */
    private function getBookingCrmLinkDetails($booking_id, $mobile, $pid){
        try {
  
            $request_data = [
                'order_id'          => $booking_id, 
                "mobile"            => $mobile,
                "pid"               => $pid,
                "source"            => 'web'
            ];
            
            $bookingDetailUrl = env('CRM_URL').config()->get('constants.make_payment_crm_booking_payment_details');
            $bookingDetail    = handleGuzzleCurlRequest($bookingDetailUrl, 'POST', null, $request_data);

            return $bookingDetail;
            
        } catch (Exception $ex) {
            return [];
        }
    }

    /** Payment Fail - Functions - End */
    public function subscriptionPaymentFail() {
        try {
            $request    = $this->request;

            $route = request()->route()->getName();
            $this->seoDataProcess($route);
            
            $data       = [
                'retry_url' => ''
            ];
            
            $mobile     = $request->cookie('subscription_mobile');
            $booking_id = $request->cookie('subscription_id');

            if(!empty($mobile) && !empty($booking_id)) {
                $retry_url          = 'makepayment?subscription_id='.$booking_id.'&mobile='.$mobile;
                $data['retry_url']  = url($retry_url);
            }

            return view('user_info.payment.failure', $data);
        } catch (Exception $ex) {
            return view('404_error');
        }
    }

    public function servicePaymentFail() {
        try {
            $request    = $this->request;
            
            $route = request()->route()->getName();
            $this->seoDataProcess($route);

            $data       = [
                'retry_url' => ''
            ];
            
            $mobile     = $request->cookie('service_mobile');
            $booking_id = $request->cookie('service_booking_id');

            if(!empty($mobile) && !empty($booking_id)) {
                $retry_url          = 'makepayment?service_booking_id='.$booking_id.'&mobile='.$mobile;
                $data['retry_url']  = url($retry_url);
            }

            return view('user_info.payment.failure', $data);
        } catch (Exception $ex) {
            return view('404_error');
        }
    }

    public function bookingServicePaymentFail() {
        try {
            $request    = $this->request;
            
            $route = request()->route()->getName();
            $this->seoDataProcess($route);

            $data       = [
                'retry_url' => ''
            ];
            
            $mobile     = $request->cookie('cust_mobile');
            $booking_id = $request->cookie('booking_id');
            $service_booking_id = $request->cookie('service_booking_id');

            if(!empty($mobile) && !empty($booking_id)) {
                $retry_url          = 'makebookingservicepayment?booking_id='.$booking_id.'&mobile='.$mobile.'&service_booking_id='.$service_booking_id;
                $data['retry_url']  = url($retry_url);
            }

            return view('user_info.payment.failure', $data);
        } catch (Exception $ex) {
            return view('404_error');
        }
    }
    /** Payment Fail - Functions - End */
}