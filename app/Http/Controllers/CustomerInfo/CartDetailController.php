<?php

namespace App\Http\Controllers\CustomerInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Exception;

class CartDetailController extends Controller
{
    
    public function __construct(Request $request)
    {
        parent::__construct($request);        
        $this->middleware('auth');
        
        $route = request()->route()->getName();    
        $this->seoDataProcess($route);
    }
         
    public function selectMember(){
        try{
            $request = $this->request;
            if(session()->has('selectedObj'))
                $productDetail = json_decode(session()->get('selectedObj'), true);
            else
                $productDetail = json_decode($request->cookie('selectedObj'), true);
                    
            $route = request()->route()->getName();
            $this->seoDataProcess($route);

            $city_id = $this->city_id;
            $token_id = auth()->user()->id;
            $token = auth()->user()->token;
            
            if(session()->has('auth_'.$token_id))
                $user_id = session()->get('auth_'.$token_id)['user_id'];
            else
                throw new Exception("User id is missing");

            if(isset($productDetail['display_name'])){

                $data = [];                
                $cartInfoUrl = config()->get('constants.api_url').config()->get('constants.fetch_cart_detail');
                $user_list_url = $this->api_url.config()->get('constants.URL_CUSTOMER_LIST');
                $data['data'] = ['user_id' => $user_id, 'city_id' => $city_id];

                $customer_details = handleGuzzleCurlRequest($user_list_url, 'POST', $token, $data);
                $cartInfoDetail = handleGuzzleCurlRequest($cartInfoUrl, 'POST', $token, $data);
                $map_array  =   [];

                if(isset($cartInfoDetail['status'])) {
                    if($cartInfoDetail['status'] && isset($cartInfoDetail['data'])) {
                        $map_array = mapPackageCustomer($cartInfoDetail['data']);
                    }                        
                }            
                
                // event fire
                $event_data     =   [
                    'action'    =>  'Book to cart',
                    'category'  =>  'My Cart',
                    'label'     =>  $productDetail['display_name'],
                    'value'     =>  $productDetail['healthian_price']
                ];
                $this->createGAEvent($this->request,   $event_data);
            
                
                if(isset($productDetail['gender'])){
                    $gender = preg_replace("/\s/", '', $productDetail['gender']);
                    $gender = (explode(',', $gender));
                    if(in_array('Male', $gender) && in_array('Female', $gender))
                        $gender_type    =   'B';
                    elseif(in_array('Male', $gender))
                        $gender_type    =   'M';
                    elseif(in_array('Female', $gender))
                        $gender_type    =   'F';
                }else
                    $gender_type    =   'B';
              
                if(isset($customer_details['data'])){
                    return view('user_info.cart_detail.select_member', [ 
                            'customer_count'    =>  count($customer_details['data']),
                            'product_detail'    =>  $productDetail,
                            'customer_details'  =>  $customer_details['data'],
                            'map_array'         =>  $map_array,
                            'gender_type'       =>  $gender_type
                        ]);  
                }elseif(isset($customer_details['message']))
                    throw new Exception($customer_details['message']);
                else{
                    throw new Exception("something went wrong");
                }
            }else{
                $url = $this->city_detail[$city_id]."/orderbook";
                return redirect($url)->withErrors("Please select the package first");
            }
        } catch (Exception $ex) {
            return new Exception($ex->getMessage());
        }
    }
    
    public function index(){
        try{
            $errors = session()->get('errors');
            $request = $this->request;

            $route = request()->route()->getName();
            $this->seoDataProcess($route);

            $token_id = auth()->user()->id;
            $token = auth()->user()->token;
            $cartInfoUrl = env('API_URL').config()->get('constants.fetch_cart_detail');
            $city_id = $this->city_id;
            if(session()->has('auth_'.$token_id))
                $user_id = session()->get('auth_'.$token_id)['user_id'];
            else
                throw new Exception("User id is missing");
            
            $data['data'] = ['user_id' => $user_id, 'city_id' => $city_id];
          
            $cartInfoDetail = handleGuzzleCurlRequest($cartInfoUrl, 'POST', $token, $data);

            if(isset($cartInfoDetail['data'])){         
                $packageCount = calPackageCount($cartInfoDetail['data']); 
                if($packageCount == 0){
                    $deleteCartUrl = env('API_URL').config()->get('constants.delete_cart');

                    $deletData['data']  = [
                        'user_id'       =>  $user_id,
                        'city_id'       =>  $city_id
                    ];
                    $deleteDetail       =   handleGuzzleCurlRequest($deleteCartUrl, 'POST', $token, $deletData);
                    $data['url'] = $this->city_detail[$city_id]."/orderbook";
                    return view('user_info.cart_detail.empty', $data); 
                }
                $cartInfoDetail['data']['selectedpackage']   =   0;
                $cartInfoDetail['data']['totalmember']       =   0;
                view()->share('session_error', $errors);
                return view('user_info.cart_detail.index', $cartInfoDetail['data']);   
            }
            elseif(isset($cartInfoDetail['message']) && ($cartInfoDetail['message'] == 'Records not Found.')){
                $data['url'] = url('deals');
                return view('user_info.cart_detail.empty', $data); 
            }   
            else{
                throw new Exception("something went wrong");
            }
            
        } catch (Exception $ex) {
            return new Exception($ex->getMessage());
        }
    }
    
    public function add(){
        try{
            $request = $this->request;
            $token_id = auth()->user()->id;
            $token = auth()->user()->token;
            $cartInfoUrl = env('API_URL').config()->get('constants.add_item_in_cart');
            $city_id = $this->city_id;
            if(session()->has('auth_'.$token_id))
                $user_id = session()->get('auth_'.$token_id)['user_id'];
            else
                throw new Exception("User id is missing");
            
            $request_input = $request->only([ 'customer_id', 'group_id' ]);
            $validator = Validator::make($request_input, [
                    'customer_id' => 'required|max:566',
                    'group_id' => 'required|max:256'
                ]);
            if ($validator->fails()) {
                return $this->getHTTPresponse($validator->errors(), 433);
            }
            
            $data['data'] = [
                        'user_id' => $user_id, 
                        'customer_id' => $request_input['customer_id'], 
                        'group_id' => $request_input['group_id'] ,
                        'city_id' => $city_id, 
                        'source' => 'web'
                    ];
//            dd($data);
            $cartInfoDetail = handleGuzzleCurlRequest($cartInfoUrl, 'POST', $token, $data);
            if($cartInfoDetail['status']){              
                cookie()->queue(
                    \Cookie::forget('selectedObj')
                );
                $request->session()->forget('selectedObj');
                return response()->json($cartInfoDetail, 200);   
            }elseif(isset($cartInfoDetail['message']))
                throw new Exception($cartInfoDetail['message']);
            else{
                throw new Exception("something went wrong");
            }
            
        } catch (Exception $ex) {
            return response()->json(['status' => false,'message' => $ex->getMessage()], 500);
        }
    }
    
    public function delete(){
        try{
            $request = $this->request;
            $token_id = auth()->user()->id;
            $token = auth()->user()->token;
            $cartInfoUrl = env('API_URL').config()->get('constants.delete_user_cart');
            $city_id = $this->city_id;
            if(session()->has('auth_'.$token_id))
                $user_id = session()->get('auth_'.$token_id)['user_id'];
            else
                throw new Exception("User id is missing");
            
            $request_input = $request->only([ 'customer_id', 'group_id', 'isCustomerDelete' ]);
            $validator = Validator::make($request_input, [
                    'customer_id' => 'required|max:566',
                    'group_id' => 'required|max:256'
                ]);
            if ($validator->fails()) {
                return response()->json([ 'status' => false, 'message' => $validator->errors()->first()], 433);
            }
            $data['data'] = [
                        'user_id' => $user_id, 
                        'customer_id' => $request_input['customer_id'], 
                        'group_id' => $request_input['group_id'] ,
                        'city_id' => $city_id, 
                        'isCustomerDelete' => ($request_input['isCustomerDelete'] === 'true')? true: false,
                        'source' => 'web'
                    ];
            $cartInfoDetail = handleGuzzleCurlRequest($cartInfoUrl, 'POST', $token, $data);
            if($cartInfoDetail['status']){
                $selectedpackage = $request->session()->get('cart_count') - 1;
                $request->session()->put('cart_count', $selectedpackage);
                if($selectedpackage ==  0){
                    return response()->json([ 'status' => true, 'message' => $cartInfoDetail['message'], 'url' => redirect()->route('user.cart')], 200);
                }
                return response()->json([ 'status' => true, 'message' => $cartInfoDetail['message']], 200);   
            }elseif(isset($cartInfoDetail['message']))
                throw new Exception($cartInfoDetail['message']);
            else{
                throw new Exception("something went wrong");
            }
            
        } catch (Exception $ex) {
            return response()->json(['status' => false,'message' => $ex->getMessage()], 500);
        }
    }
    
    public function getSlotByDate(){
        try{
            $request = $this->request;
            $request_input['collection_date']   =   $request->query('collection_date');
            $request_input['locality_id']       =   $request->query('locality_id');
            $request_input['order_price']       =   $request->query('order_price');
            $request_input['source']            =   $request->query('source');
            $token_id       =   auth()->user()->id;
            $token          =   auth()->user()->token;
            $slotpickerInfoUrl = env('CRM_URL').config()->get('constants.getAlltimeSlot');
            $city_id = $this->city_id;
            if(session()->has('auth_'.$token_id))
                $user_id = session()->get('auth_'.$token_id)['user_id'];
            else
                throw new Exception("User id is missing");
            $validator = Validator::make($request_input, [
                    'locality_id' => 'required|max:50',
                    'collection_date' => 'required|date_format:"Y-m-d"',
                    'order_price' => 'required|regex:/^\d*(\.\d{1,2})?$/'
                ]);
            if ($validator->fails()) {
                return response()->json([ 'status' => false, 'message' => $validator->errors()->first()], 433);
            }
            $data = [
                        'user_id'           =>  $user_id, 
                        'collection_date'   =>  $request_input['collection_date'], 
                        'locality_id'       =>  $request_input['locality_id'] ,
                        'order_price'       =>  $request_input['order_price'], 
                        'source'            =>  $request_input['source']  // 'consumer_app'
                    ];
            $slotPickerInfoDetail = handleGuzzleCurlRequest($slotpickerInfoUrl, 'POST', $token, $data);
            if($slotPickerInfoDetail['status'] && isset($slotPickerInfoDetail['data']))
                return response()->json([ 'status' => true, 'data' => $slotPickerInfoDetail['data']], 200);   
            elseif(isset($slotPickerInfoDetail['message']))
                return response()->json([ 'status' => false, 'message' => $slotPickerInfoDetail['message']], 500); 
            else{
                return response()->json([ 'status' => false, 'message' => 'something went wrong'], 500); 
            }
            
        } catch (Exception $ex) {
            return response()->json(['status' => false,'message' => $ex->getMessage()], 500);
        }
    }
    
    public function selectSlot(){
        try{
            $request = $this->request;

            $route = request()->route()->getName();
            $this->seoDataProcess($route);
            
            $token_id = auth()->user()->id;
            $token = auth()->user()->token;
            $cartInfoUrl = env('API_URL').config()->get('constants.fetch_cart_detail');
            $addressInfoUrl = env('API_URL').config()->get('constants.getAddress');
            $city_id = $this->city_id;
            if(session()->has('auth_'.$token_id))
                $user_id = session()->get('auth_'.$token_id)['user_id'];
            else
                throw new Exception("User id is missing");
            $data['data'] = ['user_id' => $user_id, 'city_id' => $city_id];
            
            $userCartInfoDetail = handleGuzzleCurlRequest($cartInfoUrl, 'POST', $token, $data);
            
            $useraddressInfoDetail = handleGuzzleCurlRequest($addressInfoUrl, 'POST', $token, $data);
           
            if($userCartInfoDetail['status'] && $useraddressInfoDetail['status'] && isset($userCartInfoDetail['data']) && isset($useraddressInfoDetail['data'])){                
                $userCartInfoDetail['data']['selectedpackage'] = 0;
                $userCartInfoDetail['data']['totalmember'] = 0;
                $default_address = null;
                $cartdetail = $userCartInfoDetail['data'];
                $addressLists = $useraddressInfoDetail['data'];
                $userinfo = session()->get('auth_'.$token_id);

                /* For FB pixel */
                $fb_contents = [];
                $packages_ids = [];

                foreach($cartdetail['customer_detail'] as $val) {
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
                    'value'         => $cartdetail['total_price'],
                    'currency'      => 'INR', 
                    'content_type'  => 'Final Checkout',
                    'content_ids'   => $packages_ids,
                    'contents'      => $fb_contents
                ];
                $cartdetail['fb_pixel'] = $fb_pixel_data;

                return view('user_info.cart_detail.select_slot', compact('cartdetail', 'userinfo', 'addressLists', 'default_address'));   
            }elseif(isset($userCartInfoDetail['message']) && ($userCartInfoDetail['message'] == 'Records not Found.')){
                return redirect()->route('user.cart')->withErrors($userCartInfoDetail['message']);
            }else{
                throw new Exception("something went wrong");
            }
            
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function deleteCompleteCart() {
        try{
            $request    = $this->request;
            $route      = request()->route()->getName();
            
            $token_id   = auth()->user()->id;
            $token      = auth()->user()->token;

            $city_id    = $this->city_id;
            if(session()->has('auth_'.$token_id)) {
                $user_id = session()->get('auth_'.$token_id)['user_id'];
            }                
            else {
                throw new Exception("User id is missing");
            }              
            
            $deleteCartUrl = env('API_URL').config()->get('constants.delete_cart');
            $deletData['data']  = [
                'user_id'       =>  $user_id,
                'city_id'       =>  $city_id
            ];
            $deleteDetail       =   handleGuzzleCurlRequest($deleteCartUrl, 'POST', $token, $deletData);
    
            
            if(isset($deleteDetail['status'])) {
                if($deleteDetail['status']) {
                    $package_count  = 0;
                    $request->session()->put('cart_count', $package_count);

                    return response()->json($deleteDetail, 200);   
                }
                else {
                    return response()->json([ 'status' => false, 'message' => $deleteDetail['message']], 500); 
                }
            }                
            elseif(isset($deleteDetail['message'])) {
                return response()->json([ 'status' => false, 'message' => $deleteDetail['message']], 500); 
            }
        } catch (Exception $ex) {
            return new Exception($ex->getMessage());
        }
    }
}