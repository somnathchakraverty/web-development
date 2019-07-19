<?php

namespace App\Http\Controllers\CustomerInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Exception;

class PaymentController extends Controller
{
    
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth', ['except' => ['paymentSummary', 'paymentFailure']]);
    }
        
    public function index(){
        try{
            $token_id = auth()->user()->id;
            $token = auth()->user()->token;
            $userProfileInfoDetail = null;
            if(session()->has('auth_'.$token_id)){
                $userProfileInfoDetail = session()->get('auth_'.$token_id);
            }
            if(!empty($userProfileInfoDetail)){
                return view('dashboard.index', ['user_detail' => $userProfileInfoDetail]);
            }
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
    
    public function paymentValidation(){
        try{
            $payment_details = config()->get('payment.payment_methods');
            $request = $this->request;
            $token_id = auth()->user()->id;
            $token = auth()->user()->token;
            $request_input = $request->only([
                                        'collection_date',
                                        'address_id', 
                                        'time_slot_id',
                                        'donation_amount', 
                                        'eCashAmount', 
                                        'hard_copy', 
                                        'payment_mode',
                                        'hard_copy',
                                        'txnAmount',
                                        'cart_id',
                                        'source',
                                        'coupon_id',
                                        'discount',
                                        'new_coupon',
                                        'coupon_code'
                                    ]);
            
            $today = \Carbon\Carbon::now()->format('d-m-Y');
            $validator = Validator::make($request_input, [
                    'donation_amount'   =>  'numeric',
                    'time_slot_id'      =>  'required|max:50',
                    'txnAmount'         =>  'required|numeric|min:0',
                    'hard_copy'         =>  'required|in:yes,no',
                    'address_id'        =>  'required|max:50',
                    'eCashAmount'       =>  'numeric|min:0',
                    'coupon_id'         =>  'numeric',
                    'discount'          =>  'numeric|min:0',                    
                    'new_coupon'        =>  'numeric',
                    'source'            =>  'required|in:web,mobile',
                    'collection_date'   =>  'required|date_format:d-m-Y|after:'. $today,
                    'payment_mode'      =>  'required|in:'.implode(",", array_keys($payment_details)),
                ]);
            if ($validator->fails()) {  
                return back()->withErrors($validator->errors()->first())->withInput([
                    'slot_id'           =>  $request_input['time_slot_id'],
                    'collection_date'   =>  $request_input['collection_date'],
                    'address_id'        =>  $request_input['address_id'],
                ]);
            }
            
            if(!isset($request_input['donation_amount']))
                $request_input['donation_amount']   =   0;
            
            if(session()->has('auth_'.$token_id)){
                $user_detail = session()->get('auth_'.$token_id);
                $user_id = session()->get('auth_'.$token_id)['user_id'];
            }else
                throw new Exception("User id is missing");
            $bookingDetail  =[
                    'app_version'   =>  '103',
                    'user_id'   =>  $user_id, 
                    'data' => [
                        'user_id'           =>  $user_id, 
                        'address_id'        =>  $request_input['address_id'],
                        'date'              =>  $request_input['collection_date'],
                        'time_slot_id'      =>  $request_input['time_slot_id'],
                        'donation_amount'   =>  $request_input['donation_amount'],
                        'eCashAmount'       =>  $request_input['eCashAmount'],
                        'hard_copy'         =>  $request_input['hard_copy'],
                        'city_id'           =>  $this->city_id,
                        'app_version'       =>  '103',
                        'payment_type'      =>  $payment_details[$request_input['payment_mode']]['is_online'] ? 'online' : 'offline',
                        'source'            =>  $request_input['source']
                    ]
                ];
            
            if(isset($request_input['coupon_code']) && isset($request_input['coupon_id']) && isset($request_input['discount']) ){
                
                if(!isset($request_input['new_coupon']))
                    $request_input['new_coupon']    =   0;
                
                $bookingDetail  =[
                    'app_version'   =>  '103',
                    'user_id'   =>  $user_id, 
                    'data' => [
                        'user_id'           =>  $user_id, 
                        'address_id'        =>  $request_input['address_id'],
                        'date'              =>  $request_input['collection_date'],
                        'time_slot_id'      =>  $request_input['time_slot_id'],
                        'donation_amount'   =>  $request_input['donation_amount'],
                        'eCashAmount'       =>  $request_input['eCashAmount'],
                        'hard_copy'         =>  $request_input['hard_copy'],
                        'city_id'           =>  $this->city_id,
                        'app_version'       =>  '103',
                        'payment_type'      =>  $payment_details[$request_input['payment_mode']]['is_online'] ? 'online' : 'offline',
                        'source'            =>  $request_input['source'],
                        'coupon_id'         =>  $request_input['coupon_id'],
                        'discount'          =>  $request_input['discount'],
                        'new_coupon'        =>  $request_input['new_coupon'],
                        'coupon_code'       =>  $request_input['coupon_code']
                    ]
                ];
            }
          

            $createBookingInfoUrl   =   config()->get('constants.api_url').config()->get('constants.book_order');
            $bookingInfoDetail      =   handleGuzzleCurlRequest($createBookingInfoUrl, 'POST', $token, $bookingDetail);
            
            if($bookingInfoDetail['status'] && isset($bookingInfoDetail['data'])){
                
                $paymentParameterDetail = [
                                'custEmail'     =>  $user_detail['email'],
                                'custName'      =>  $user_detail['name'],
                                'custMobile'    =>  $user_detail['mobile'],
                                'txnAmount'     =>  $request_input['txnAmount'],
                                'booking_id'    =>  $bookingInfoDetail['data']['booking_id'],
                                'stm_id'        =>  $request_input['time_slot_id']
                            ];
                //  dd($paymentParameterDetail);
                $request->session()->put('booking_id', $bookingInfoDetail['data']['booking_id']);
                cookie()->queue('isNewBooking', true, 1440,'/', null, false, false);
                cookie()->queue('cust_mobile', $user_detail['mobile'], 1440,'/', null, false, false);
                cookie()->queue('booking_id', $bookingInfoDetail['data']['booking_id'], 1440,'/', null, false, false);
                $event_data     =   [
                    'action'    =>  'Order Booked Successfully',
                    'category'  =>  'Make Payment',
                    'label'     =>  'Online',
                    'value'     =>  $request_input['txnAmount']
                ];  
                
                if($request_input['payment_mode'] == 'payu'){                    
                    $payuInfoUrl = env('CRM_URL').config()->get('constants.payupayment'); 
                }elseif($request_input['payment_mode'] == 'mobiKwik'){
                    $payuInfoUrl = env('CRM_URL').config()->get('constants.mobikwikpayment');       

                }elseif($request_input['payment_mode'] == 'paytm'){
                    $paymentParameterDetail['user_id']  =  $user_id;

                    $payuInfoUrl = config()->get('constants.crm_url').config()->get('constants.paytmpayment');
                }else{                    
                    $event_data['label']    =   'Cash on delivery';
                    $cashInfoUrl = config()->get('constants.crm_url').config()->get('constants.update_payment_type');
                    $data   =   [
                        'booking_id'        =>  $bookingInfoDetail['data']['booking_id'],
                        'payment_type'      =>  'Cash on delivery',
                        'term_condition'    =>  true,
                        'user_id'           =>  $user_id,
                        'log_user_id'       =>  $user_id,
                    ];
                    $paymentInfoDetail = handleGuzzleCurlRequest($cashInfoUrl, 'POST', $token, $data);
                    if($paymentInfoDetail['status']){
                        return redirect()->route('user.paymentsummary',[
                            'booking_id'    =>  $bookingInfoDetail['data']['booking_id'],
                            'user_id'       =>  $user_id, 
                            'mobile'        =>  session()->get('auth_'.$token_id)['mobile']])->with(['booking_id'  => $bookingInfoDetail['data']['booking_id']]);
                    }else
                        return redirect('select-slot')->withErrors($bookingInfoDetail['message']);
                }
                
                $this->createGAEvent($this->request,   $event_data);
                return view('user_info.payment.payment_page', compact('paymentParameterDetail', 'payuInfoUrl'));   
            }elseif(isset($bookingInfoDetail['message']) && !$bookingInfoDetail['status']){
                $message    =   $bookingInfoDetail['message']; 
                if(strpos($message, 'Please update your cart') !== false)
                    return redirect()->route('user.cart')->withErrors($bookingInfoDetail['message']);
                else
                    return redirect('select-slot')->withErrors($bookingInfoDetail['message']);
            }else{
                return back()->withErrors($bookingInfoDetail)->with([
                                        'slot_id' => $request_input['time_slot_id'],
                                        'collection_date' => $request_input['collection_date'],
                                        'address_id' => $request_input['address_id'],
                                    ]);
            }
            
        } catch (Exception $ex) {
            return back()->withErrors($ex->getMessage())->with([
                                        'slot_id' => $request_input['time_slot_id'], 
                                        'collection_date' => $request_input['collection_date'],
                                        'address_id' => $request_input['address_id']
                                    ]);
        }
    }
    public function beforePaymentGet()
    {
        return redirect()->back();
    }

    public function beforePayment(){
        try{
            $request = $this->request;

            $token_id = auth()->user()->id;
            $token = auth()->user()->token;
            $request_input = $request->only('slot_id', 'collection_date', 'address_id', 'device_source');

            $today = \Carbon\Carbon::now()->format('d-m-Y');
            $validator = Validator::make($request_input, [
                    'slot_id'           =>  'required|min:1|max:50',
                    'address_id'        =>  'required|min:1|max:50',
                    'collection_date'   =>  'required|date_format:d-m-Y|after:'. $today,
                    'device_source'     =>  'required|min:1|max:50'
                ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors()->first())->withInput();
            }
            if(session()->has('auth_'.$token_id)){
                $userProfileInfoDetail = session()->get('auth_'.$token_id);
                $user_id = session()->get('auth_'.$token_id)['user_id'];
            }else
                throw new Exception("User id is missing");
            $freezSlotData['data'] = [
                        'user_id'   =>  $user_id, 
                        'slot_id'   =>  $request_input['slot_id'] , 
                        "source"    =>  $request_input['device_source']
                    ];

            $freezSlotInfoUrl = config()->get('constants.api_url').config()->get('constants.freeze_slot');
            
            $slotPickerInfoDetail = handleGuzzleCurlRequest($freezSlotInfoUrl, 'POST', $token, $freezSlotData);
            //  dd($slotPickerInfoDetail);
            if($slotPickerInfoDetail['status'] && isset($slotPickerInfoDetail['data']))
                return redirect('checkout')->with([
                                        'slot_id'           =>  $request_input['slot_id'],
                                        'collection_date'   =>  $request_input['collection_date'],
                                        'address_id'        =>  $request_input['address_id'],
                                        'device_source'     =>  $request_input['device_source']
                                    ]);
            elseif(isset($slotPickerInfoDetail['message']))
                return back()->withErrors($slotPickerInfoDetail['message'])->with(['slot_id' => $request_input['slot_id']]);
            else
                return back()->withErrors("Something went wrong")->with(['slot_id' => $request_input['slot_id']]); 
            
        } catch (Exception $ex) {
            return back()->withErrors($ex->getMessage())->with(['slot_id' => $request_input['slot_id']]);
        }
    }

    public function curPaymentDetail(){
        try{      
            $route  =   request()->route()->getName(); 
            $this->seoDataProcess($route);
            
            //  $slot_id = '1661751'; $collection_date = '27-04-2019'; $address_id = '284769'; $device_source='web';
            
            if(session()->has('slot_id') && session()->has('device_source') && session()->has('collection_date') && session()->has('address_id')){
                $slot_id            =   session()->get('slot_id');
                $collection_date    =   session()->get('collection_date');
                $address_id         =   session()->get('address_id');
                $device_source      =   'web';
            }else{
                return redirect('select-slot')->withErrors(["Select slot first"]); 
            }
            /*
            echo "<pre>";
            print_r($slot_id);
            echo "<pre>";
            print_r($device_source);
            echo "<pre>";
            print_r($collection_date);
            echo "<pre>";
            print_r($address_id);
            die;
            */
            $request            =   $this->request;
            $token_id           =   auth()->user()->id;
            $token              =   auth()->user()->token;
            $payment_options    =   config()->get('payment.payment_methods');
            $yuvraj_foundation  =   config()->get('payment.donation_method.yuvraj_foundation');
            
            $cartInfoUrl        =   env('API_URL').config()->get('constants.fetch_cart_detail');
            $convenienceFeeUrl  =   env('API_URL').config()->get('constants.getConvenienceFee');
            $getUserEwalletUrl  =   env('API_URL').config()->get('constants.getUserEwallet');
            $couponAPIUrl       =   env('API_URL').config()->get('constants.customerActiveCoupon');
            
            $city_id            =   $this->city_id;
            
            if(session()->has('auth_'.$token_id))
                $user_id    =   session()->get('auth_'.$token_id)['user_id'];
            else{
                $url        =   str_replace(' ', '_',$request->cookie('sLocation'))."/orderbook";
                return redirect($url);
            }
            
            $data['data'] = [
                        'user_id'   =>  $user_id, 
                        'city_id'   =>  $city_id , 
                        'source'    =>  $device_source // toDo
                    ];
                     
            $couponInfoDetail       =   handleGuzzleCurlRequest($couponAPIUrl, 'POST', $token, $data);
            $cartInfoDetail         =   handleGuzzleCurlRequest($cartInfoUrl, 'POST', $token, $data);
            
            $userEwalletDetail      =   handleGuzzleCurlRequest($getUserEwalletUrl, 'POST', $token, $data);
            
            if($couponInfoDetail['message']     ==   'No Coupon'){
                $couponInfoDetail['status']    =   true;
            }
            if(isset($couponInfoDetail['status']) && isset($cartInfoDetail['status']) && isset($userEwalletDetail['status'])) {
                if($couponInfoDetail['status'] && $cartInfoDetail['status'] && $userEwalletDetail['status']){
                    $coupon_detail      =   $best_coupon_code   =   $active_coupon_info =   $best_payment_mode  =   null;
                    
                    if(isset($couponInfoDetail['data']) && is_array($couponInfoDetail['data'])){                   
                        $active_coupon_info     =   $couponInfoDetail['data'];
                        if(!empty($couponInfoDetail['data']['paytm'])){
                            $firstValue         =   $couponInfoDetail['data']['paytm'];
                            $coupon_detail      =   $firstValue;
                            $best_payment_mode  =   'paytm';
                            $best_coupon_code   =   $firstValue['coupon_code'];
                            $coupon_detail['coupon_text']   =   'Copy Coupon '.$firstValue['coupon_code'].' to get '.$firstValue['discountAmount'].' discount valid on PayTM mode';
                        }else{
                            $firstValue         =   reset($couponInfoDetail['data']);
                            $best_payment_mode  =   key($couponInfoDetail['data']);
                            $best_coupon_code   =   $firstValue['coupon_code'];
                            foreach ($couponInfoDetail['data'] as $key => $f_payment_type){
                                if($firstValue['discountAmount'] < $f_payment_type['discountAmount']){
                                    $firstValue         =   $f_payment_type;
                                    $best_payment_mode  =   $key;
                                    $best_coupon_code   =   $firstValue['coupon_code'];
                                }
                            }
                            if($firstValue['couponId']){
                                $coupon_detail                  =   $firstValue;
                                $coupon_detail['coupon_text']   =   'Copy Coupon '.$firstValue['coupon_code'].' to get '.$firstValue['discountAmount'].' discount valid on '.$best_payment_mode;
                            }
                        }                    
                    }
                    if(!$cartInfoDetail['data']['allow_to_proceed'])
                        return redirect()->route('user.cart')->withErrors($cartInfoDetail['data']['allow_to_proceed']['allow_to_proceed_message']);
                    $orderAmount    =   $cartInfoDetail['data']['total_price'];
                    $ecashAmount    =   \App\Http\Repository\PaymentRepository::calHcashLimitByOrder($orderAmount, $userEwalletDetail['data']);
                    $convenienceFeeData['data'] = [ 
                                    "city_id"           =>  $city_id,
                                    "is_b2c"            =>  "1",
                                    "source"            =>  "web",
                                    "orderAmount"       =>  $cartInfoDetail['data']['total_price'],
                                    "is_subscription"   =>  "0",
                                    "sample_available"  =>  "0",
                                    "slot_id"           =>  $slot_id,
                                    "user_id"           =>  $user_id
                                ];
                    $hardCopyFeeUrl = env('API_URL').config()->get('constants.hard_copy_price');
                    $hardCopyFeeDetail = handleGuzzleCurlRequest($hardCopyFeeUrl, 'GET', $token);

                    $convenienceFeeDetail = handleGuzzleCurlRequest($convenienceFeeUrl, 'POST', $token, $convenienceFeeData);
                    
                    if(isset($convenienceFeeDetail['data']) && isset($hardCopyFeeDetail['data'])){
                        $payable_amount     =   $convenienceFeeDetail['data']['convenience_fee'] + $cartInfoDetail['data']['total_price'];
                        
                        $fb_pixel_data      = [];

                        if(!empty($cartInfoDetail)) {
                            /* For FB pixel */
                            $fb_contents = [];
                            $packages_ids = [];

                            foreach($cartInfoDetail['data']['customer_detail'] as $val) {
                                if(!empty($val['deals'])) {
                                    foreach($val['deals'] as $p) {                        
                                        if(!in_array($p['id'], $packages_ids)) {
                                            array_push($packages_ids, $p['id']);
                                        }

                                        $fb_content_json = [
                                            'id'            => $p['id'], 
                                            'quantity'      => 1, 
                                            'item_price'    => $p['healthians_price']
                                        ];

                                        if(count($fb_contents) > 0) {
                                            $checkAlreadyAdd = false;
                                            
                                            foreach($fb_contents as $k => $v) {  
                                                if($v['id'] == $p['id']) {
                                                    $checkAlreadyAdd = true;
                                                    $fb_contents[$k]['quantity'] += 1; 
                                                }
                                            }                                    
                                            if(!$checkAlreadyAdd) {
                                                array_push($fb_contents, $fb_content_json);
                                            }
                                        }
                                        else {
                                            array_push($fb_contents, $fb_content_json);
                                        }
                                    }
                                }
                            }

                            /* For Facebook Pixel */
                            $fb_pixel_data = [
                                'value'         => $cartInfoDetail['data']['total_price'],
                                'currency'      => 'INR', 
                                'content_type'  => 'Final Checkout',
                                'content_ids'   => $packages_ids,
                                'contents'      => $fb_contents
                            ];                        
                        }
                        
                        return view('user_info.payment.current', [
                            'collection_date'           =>      $collection_date,
                            'address_id'                =>      $address_id,
                            'slot_id'                   =>      $slot_id,
                            'cart_id'                   =>      $cartInfoDetail['data']['cart_id']['id'],
                            'cart_data'                 =>      $cartInfoDetail['data'],
                            'convenience_fee_detail'    =>      $convenienceFeeDetail['data'],
                            'yuvraj_foundation'         =>      $yuvraj_foundation,
                            'payment_options'           =>      $payment_options ,
                            'healthians_price'          =>      0,
                            'limited_price'             =>      $cartInfoDetail['data']['total_price'],
                            'ecashAmount'               =>      $ecashAmount,
                            'ecashAmountType'           =>      isset($userEwalletDetail['data']['wallet_point_type']) ? $userEwalletDetail['data']['wallet_point_type'] : '',                            
                            'userEwallet'               =>      $userEwalletDetail['data'],
                            'available_wallet_point'    =>      $userEwalletDetail['data']['walletPoint'],
                            'payable_amount'            =>      $payable_amount,
                            'coupon_detail'             =>      $coupon_detail,
                            'hard_copy_detail'          =>      $hardCopyFeeDetail['data'],
                            'fb_pixel'                  =>      $fb_pixel_data,
                            'coupon_info_detail'        =>      $couponInfoDetail,
                            'active_coupon_info'        =>      $active_coupon_info,
                            'best_payment_mode'         =>      $best_payment_mode
                        ]);  
                    }
                } else {
                    if(!$couponInfoDetail['status'])
                        throw new Exception($couponInfoDetail['message']);
                    else if(!$cartInfoDetail['status'])
                        throw new Exception($cartInfoDetail['message']);
                    else if($userEwalletDetail['status'])
                        throw new Exception($userEwalletDetail['message']);
                    else
                        throw new Exception("something went wrong");  
                }
            }
            else {
                throw new Exception("Something went wrong. Please contact to Customer Care.");
            }    
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }
    
    public function userCouponValidation(){
        try{
            $payment_details    =   config()->get('payment.payment_methods');
            $request            =   $this->request;
            $token_id           =   auth()->user()->id;
            $token              =   auth()->user()->token;
            $couponInfoUrl      =   env('API_URL').config()->get('constants.applyCoupon');
            $city_id            =   $this->city_id;
            
            if(session()->has('auth_'.$token_id)){
                $user_detail = session()->get('auth_'.$token_id);
                $user_id = session()->get('auth_'.$token_id)['user_id'];
            }else
                throw new Exception("User id is missing");
            
            $request_input = $request->only([ 'cart_id', 'payment_gateway', 'total_customer', 'payment_amount', 'couponCode', 'device_source' ]);
            
            $validator = Validator::make($request_input, [
                    'cart_id'           =>  'required|max:566',
                    'payment_gateway'   =>  'in:'.implode(",", array_keys($payment_details)),
                    'total_customer'    =>  'required',
                    'payment_amount'    =>  'required',
                    'couponCode'        =>  'required',
                    'device_source'     =>  'required'
                ]);
            if ($validator->fails()) {
                return response()->json([ 'status' => false, 'message' => $validator->errors()->first()], 433);
            }
            $data['data'] = [
                        'user_id'           =>      $user_id, 
                        'city_id'           =>      $city_id, 
                        'platform'          =>      $request_input['device_source'],
                        'app_version'       =>      '89', // To Do
                        'coupon'            =>      $request_input['couponCode'],                 
                        'customer_mobile'   =>      $user_detail['mobile'], 
                        'customer_email'    =>      $user_detail['email'],
                        'cart_id'           =>      $request_input['cart_id'],
                        'no_of_customer'    =>      $request_input['total_customer'],
                        'billing_amount'    =>      $request_input['payment_amount']
                    ];
            if(isset($request_input['payment_gateway'])){
                $data['data']['payment_gateway']   =    $request_input['payment_gateway'];
                $data['data']['is_online']         =    $payment_details[$request_input['payment_gateway']]['is_online'];
            }else{
                $data['data']['is_online']         =    0;
            }
            $userProfileInfoDetail  =   handleGuzzleCurlRequest($couponInfoUrl, 'POST', $token, $data);
            
            if($userProfileInfoDetail['status'])
                return response()->json([ 'status' => true, 'data' => $userProfileInfoDetail['data'], 'message' =>  $userProfileInfoDetail['message']], 200);   
            elseif(isset($userProfileInfoDetail['message']))
                throw new Exception($userProfileInfoDetail['message']);
            else
                throw new Exception("something went wrong");
            
        } catch (Exception $ex) {
            return response()->json(['status' => false,'message' => $ex->getMessage()], 500);
        }
    }
    
    /**
     * Payment Fail for Booking
     */
    public function paymentFailure(){
        try {
            $request = $this->request;

            $route = request()->route()->getName();
            $this->seoDataProcess($route);
            
            cookie()->queue(
                        \Cookie::forget('isNewBooking')
                    );
            
            $data = [
                'retry_url' => ''
            ];
            
            $mobile     = $request->cookie('cust_mobile');
            $booking_id = $request->cookie('booking_id');

            if(!empty($mobile) && !empty($booking_id)) {
                $retry_url          = 'makepayment?booking_id='.$booking_id.'&mobile='.$mobile;
                $data['retry_url']  = url($retry_url);
            }

            return view('user_info.payment.failure', $data);
        } catch (Exception $ex) {
            return view('404_error');
        }
    }
    
    public function paymentSummary(){
        try{
            $request        =   $this->request;
            $isNewBooking   =   false;
            if($request->hasCookie('isNewBooking'))
                $isNewBooking   =   $request->cookie('isNewBooking');
                            
            $route = request()->route()->getName();
            $this->seoDataProcess($route);
            
            $booking_id = $request->query('booking_id');
            $user_id    = $request->query('user_id');
            $mobile     = $request->query('mobile');
            
            if(empty($booking_id)) {
                throw new Exception("Booking id is missing");
            }
            
            $data = [
                'order_id'          =>  $booking_id
            ];
            
            if(auth()->check()){
                $token_id   = auth()->user()->id;
                $token      = auth()->user()->token;
                $city_id    = $this->city_id;
                
                if(session()->has('auth_'.$token_id)) {
                    $user_detail    = session()->get('auth_'.$token_id);
                    $user_id        = session()->get('auth_'.$token_id)['user_id'];
                  
                    if(empty($mobile)) {
                        $data['mobile']     = $user_detail['mobile'];
                    }
                }
                else {
                    throw new Exception("User id is missing");
                }
                
                if($isNewBooking){
                    $deleteCartUrl = env('API_URL').config()->get('constants.delete_cart');

                    $deletData['data']  = [
                        'user_id'       =>  $user_id,
                        'city_id'       => $city_id
                    ];
                    $deleteDetail       =   handleGuzzleCurlRequest($deleteCartUrl, 'POST', $token, $deletData);


                    cookie()->queue(
                            \Cookie::forget('cart_count')
                        );
                    cookie()->queue(
                                \Cookie::forget('isNewBooking')
                            );
                    session()->forget('cart_count');
                }
            }
            
            if(!empty($mobile)) {
                $data['mobile'] = $mobile;
            }
            else {
                if(!empty($request->cookie('cust_mobile'))) {
                    $data['mobile'] = $request->cookie('cust_mobile');
                }                    
            }

            if(empty($data['mobile'])) {
                throw new Exception("Mobile no. is missing");
            }

            $paymentInfoUrl     = env('CRM_URL').config()->get('constants.payment_summary');
            
            $paymentInfoDetail  = handleGuzzleCurlRequest($paymentInfoUrl, 'POST', null, $data);
            //dd($paymentInfoDetail);
            if($paymentInfoDetail['status']){
                cookie()->queue(
                    \Cookie::forget('booking_id')
                );
                cookie()->queue(
                    \Cookie::forget('cust_mobile')
                );

                $paymentDetail = $paymentInfoDetail['data'];
                $paymentDetail['hard_copy_price']   =   config()->get('payment.extra_features.hard_copy.donation_amt');
                
                if($isNewBooking){
                    $event_data     =   [
                        'action'    =>  'Order completion success',
                        'category'  =>  'Payment summary',
                        'label'     =>  'booking_id',
                        'value'     =>  $booking_id
                    ];
                    $this->createGAEvent($this->request,   $event_data);
                }
                if(!empty($request->query('merTxnId'))) {
                    $paymentDetail['transactionId'] = $request->query('merTxnId');
                }
                    
                if(!empty($request->query('cardType'))) {
                    $paymentDetail['card_type'] = $request->query('cardType');
                }
                    
                if(!empty($request->query('cardClassificationType'))) {
                    $paymentDetail['cardClassificationType'] = $request->query('cardClassificationType');
                }                    

                $fb_contents = [];
                $packages_ids = [];

                foreach($paymentDetail['orderDetail'] as $val) {
                    if(!empty($val['package'])) {
                        foreach($val['package'] as $p) {                        
                            if(!in_array($p['package_id'], $packages_ids)) {
                                array_push($packages_ids, $p['package_id']);
                            }

                            $fb_content_json = [
                                'id'            => $p['package_id'], 
                                'quantity'      => 1, 
                                'item_price'    => $p['healthians_price']
                            ];

                            if(count($fb_contents) > 0) {
                                $checkAlreadyAdd = false;
                                
                                foreach($fb_contents as $k => $v) {  
                                    if($v['id'] == $p['package_id']) {
                                        $checkAlreadyAdd = true;
                                        $fb_contents[$k]['quantity'] += 1; 
                                    }
                                }
                                
                                if(!$checkAlreadyAdd) {
                                    array_push($fb_contents, $fb_content_json);
                                }
                            }
                            else {
                                array_push($fb_contents, $fb_content_json);
                            }
                        }
                    }
                }

                /* For Facebook Pixel */
                $fb_pixel_data = [
                    'value'         => $paymentDetail['order_price'],
                    'currency'      => 'INR', 
                    'booking_id'    => $paymentDetail['booking_id'],
                    'content_type'  => 'product',
                    'content_ids'   => $packages_ids,
                    'contents'      => $fb_contents
                ];
                $paymentDetail['fb_pixel'] = $fb_pixel_data;

                return view('user_info.payment.summary', $paymentDetail);
            }
            else if(isset($paymentInfoDetail['message']))
                throw new Exception($paymentInfoDetail['message']);
            else
                throw new Exception("something went wrong");
        } catch (Exception $ex) {
            return view('404_error')->withErrors($ex->getMessage());
//            return response()->json(['status' => false,'message' => $ex->getMessage()], 500);
        }
    }

    public function getConvenienceFee() {
        /**
         * This is to get convenience fees calculation
         */
        try {
            $request    = $this->request;

            $validator  = Validator::make($request->all(), [
                'order_amount'   =>  'required|numeric',
                'time_slot_id'   =>  'required|numeric',
            ]);

            if ($validator->fails()) {
                $error_response = [
                    "status"    => false,
                    "message"   => implode(" <br> ",$validator->messages()->all())
                ];

                return response()->json($error_response, 400);
            }

            $token_id   =   auth()->user()->id;
            $city_id    =   $this->city_id;

            if(session()->has('auth_'.$token_id)){
                $user_id        =   session()->get('auth_'.$token_id)['user_id'];
            }
            else {
                throw new Exception("User id is missing");
            }

            if(session()->has('slot_id')){
                $slot_id            =   session()->get('slot_id');          
                $device_source      =   'web';
            }
            
            $convenienceFeeUrl      =   config()->get('constants.api_url').config()->get('constants.getConvenienceFee');

            $request_data['data'] = [ 
                "city_id"           =>  $city_id,
                "is_b2c"            =>  "1",
                "source"            =>  "web",
                "orderAmount"       =>  $request['order_amount'],
                "is_subscription"   =>  "0",
                "sample_available"  =>  "0",
                "slot_id"           =>  $request['time_slot_id'],
                "user_id"           =>  $user_id,
                'guid'              =>  !empty($_COOKIE["guid"]) ? md5($_COOKIE["guid"]): '',
                'ip'                =>  $request->ip()
            ];
          
            $convenienceFeeDetail  = handleGuzzleCurlRequest($convenienceFeeUrl, 'POST', null, $request_data);

            if(isset($convenienceFeeDetail['status'])) {
                if($convenienceFeeDetail['status']) {
                    return response()->json($convenienceFeeDetail, 200);
                }
                else {
                    throw new Exception("Something went wrong");
                }
            }
            else {
                throw new Exception("User id is missing");
            }            
        } catch (Exception $ex) {
            return response()->json(["status" => false, "message" => $ex->getMessage()], 500);
        }
    }
}