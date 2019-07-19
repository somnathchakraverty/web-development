<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Exception;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('guest', ['except' => ['loginInfo', 'logout', 'updateLoginInfo']]);
        $this->middleware('auth', ['only' => ['loginInfo', 'logout', 'updateLoginInfo']]);
    }
    
    public function loginDetail(){
        try{

            $route = request()->route()->getName();
            $this->seoDataProcess($route);

            $generate_url = env('API_URL').config()->get('constants.country_code');
            $rq_response = handleGuzzleCurlRequest($generate_url, 'GET');
            
            if(isset($rq_response['status']) && ($rq_response['status'] == 'success') && isset($rq_response['data'])){
                $country_list = $rq_response['data'];
                $default_country_code = config()->get('constants.default_country_code');

                $key    =   array_search($default_country_code, array_column($country_list, 'countries_isd_code'));

                $india_detail   =   $country_list[$key];
                $country_list   =   $country_list;
                
                /* For Analytics - Upload Prescription */
                $event_data     =   [
                    'action'    =>  'Clicked Login',
                    'category'  =>  'Login',
                    'label'     =>  'Header'
                ];
                $this->createGAEvent($this->request,   $event_data);
                                
                $data_value = [
                    'country_list' => $country_list, 
                    'india_country' => $india_detail
                ];
                return view('auth.login', $data_value);
            }
            throw new Exception($rq_response);
        } catch (Exception $ex) {
            return new Exception($ex->getMessage());
        }
    }
    
    public function submitLoginDetail(Request $request){
        try{
            $request_input = $request->only('mobile_number', 'template', 'countryCode');
            if(!isset($request_input['template']))
                $request_input['template'] = 'login';
            $validator = Validator::make($request_input, [
                    'mobile_number' => 'required|digits:10',
                    'template' => 'required|in:login',
                    'countryCode' => 'required',
                ]);
            if ($validator->fails()) {
                if($request->ajax())
                   return response()->json(['status' => false, 'error' => implode(", ",$validator->messages()->all())]);
                else
                    return redirect('login')->withErrors($validator->errors())->withInput();
            }
            
            $generate_url = env('CRM_URL').config()->get('constants.generateOTP');
            $rq_response = handleCurlRequest($generate_url, 'POST', $request_input);
            
            if($rq_response['status'] == true && $rq_response['message'] == 'OTP generated'){
                
                
                /* For Analytics - Upload Prescription */
                $event_data     =   [
                    'action'    =>  'Request OTP',
                    'category'  =>  'Login',
                    'label'     =>  $request_input['countryCode'].''.$request_input['mobile_number']
                ];
                $this->createGAEvent($this->request,   $event_data);
                
                if($request->ajax()){
                    return response()->json(['status' => true]); 
                }
                return redirect('otp')->with(['mobile_number' => $request_input['mobile_number'], 'template' => $request_input['template'], 'countryCode' => $request_input['countryCode'] ]);
            }elseif(!$rq_response['status'] && isset($rq_response['message'])){
                throw new Exception($rq_response['message']);
            }else{
                throw new Exception('Otp not generated. Try again');
            }
            
        } catch (Exception $ex) {
            if($request->ajax()){
                return response()->json(['status' => false, 'error' => $ex->getMessage()]); 
            }
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }
    
    public function otpDetail(Request $request){
        try{

            $route = request()->route()->getName();
            $this->seoDataProcess($route);
            
//            $data['mobile_number']  =   '9643055880';
//            $data['template']       =   'login';
//            $data['countryCode']    =   '91';
            
            $data['mobile_number']  =   session()->get('mobile_number');
            $data['template']       =   session()->get('template');
            $data['countryCode']    =   session()->get('countryCode');
            
            if(empty($data['mobile_number']) || (strlen($data['mobile_number']) != 10)){
                return redirect('login')->withErrors("Mobile number must be required");
            }
            return view('auth.otp', $data);            
        } catch (Exception $ex) {
            return new Exception($ex->getMessage());
        }
    }
    
    public function submitOtpDetail(Request $request){
        try{
            $request_input = $request->only('mobileNumber', 'otp', 'countryCode', 'source', 'device_source');
            $request_input['source'] = 'web';
            if(empty($request_input['device_source']))
                $request_input['device_source'] = 'web';
            
            $validator = Validator::make($request_input, [
                    'mobileNumber' => 'required|digits:10',
                    'otp' => 'required|digits:6',
                    'countryCode' => 'required',
                    'source' => 'required|in:web',
                    'device_source' => 'required|in:web,mobile',
                ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 433);
            }
            $data['data'] = $request_input;
            $updateLoginInfo = env('API_URL').config()->get('constants.checkLogin');
            $response_detail = handleGuzzleCurlRequest($updateLoginInfo, 'POST', null, $data);
            if(isset($response_detail['status']) && $response_detail['status'] && isset($response_detail['data']['user_id'])){
                
                
                $user_id = decryptUserSalt($response_detail['data']['user_id']);
                if($user_id){
                    
                    $credential = ['user_id' => $user_id, 'token' => $response_detail['data']['token'], 'source' => 'WEB' ];
                    $token_detail = \App\Models\ApiTokens::getIdByCondi($credential);
                    if($token_detail->id){
                        if(auth()->guard('token')->loginUsingId($token_detail->id)){
                            
                            $userProfileInfoUrl = env('API_URL').config()->get('constants.show_profile');
                            $n_data = ['user_id' => $response_detail['data']['user_id']];

                            $userProfileInfoDetail = handleGuzzleCurlRequest($userProfileInfoUrl, 'POST', $token_detail->token, $n_data, [], 'application/x-www-form-urlencoded');
                            
                            if(isset($userProfileInfoDetail['data']) && auth()->check()){ 
                                $userProfileInfoDetail['data']['countryCode'] = $request_input['countryCode'];
                                $userProfileInfoDetail['data']['signUp'] = $response_detail['signUp'];
                                $is_new_user = newSignupValidation($userProfileInfoDetail['data']);
                                $request->session()->put('auth_'.$token_detail->id, $userProfileInfoDetail['data']);
                                
                                /* For Analytics - Upload Prescription */
                                $event_data     =   [
                                    'action'    =>  'Login With Mobile',
                                    'category'  =>  'Login',
                                    'label'     =>  $request_input['countryCode'].''.$request_input['mobileNumber']
                                ];
                                $this->createGAEvent($this->request,   $event_data);

                                /* For Clever Tap Integration - Event */
                                $user_data = [];
                
                                if(!$is_new_user && !$response_detail['signUp']){   
                                    if(!empty($response_detail['data']['name']) && !empty($response_detail['data']['email']) && !empty($response_detail['data']['mobile'])) {
                                        $user_data['name']      = $response_detail['data']['name'];
                                        $user_data['email']     = $response_detail['data']['email'];
                                        $user_data['mobile']    = $response_detail['data']['mobile'];
                                        $user_data['user_id']   = $response_detail['data']['user_id'];
                                    }

                                    $city_id        =   $this->city_id;
                                    $cartInfoUrl    =   env('API_URL').config()->get('constants.fetch_cart_detail');
                                    $data['data']   =   ['user_id' => $response_detail['data']['user_id'], 'city_id' => $city_id];
                                    $cartInfoDetail =   handleGuzzleCurlRequest($cartInfoUrl, 'POST', $response_detail['data']['token'], $data);
                                    $cart_count     =   0;
                                    if(isset($cartInfoDetail['data']))
                                        $cart_count     =   calPackageCount($cartInfoDetail['data']);
                                    $request->session()->put('cart_count', $cart_count);
                                    $session_url    =   session()->get('url.intended');
                                    if(strpos($session_url, 'logout')) 
                                        return response()->json(['status' => true, 'data' => $user_data, 'url' => url('dashboard')]);
                                    
                                    return response()->json(['status' => true, 'data' => $user_data, 'url' => session()->get('url.intended', url('dashboard'))]);
                                }else{
                                    return response()->json(['status' => true, 'url' => url('profile-info')]);
                                }
                            }
                            auth()->logout();
                            return response()->json(['status' => false]); 
                        }
                    }
                }
            }
            return response()->json(['status' => false]);
        } catch (ModelNotFoundException $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        } catch (Exception $ex) {
            if(auth()->check())
                auth()->logout();
            return response()->json(['status' => false, 'message' => $ex->getMessage()], 500);
        }
    }
    
    public function loginInfo(Request $request){
        try{
            $token_id = auth()->user()->id;
            $token = auth()->user()->token;
            $userProfileInfoDetail = null;
            if(session()->has('auth_'.$token_id)){
                $userProfileInfoDetail = session()->get('auth_'.$token_id);
                $user_id = session()->get('auth_'.$token_id)['user_id'];
            }else
                throw new Exception("User id is missing");
            if(!isset($userProfileInfoDetail['signUp']))
                $userProfileInfoDetail['signUp']    =   false;
//            dd($userProfileInfoDetail);
            return view('auth.updateLoginInfo', $userProfileInfoDetail);            
        } catch (Exception $ex) {
            return new Exception($ex->getMessage());
        }
    }
    
    public function updateLoginInfo(Request $request){
        try{
            $request_input = $request->only('name', 'age', 'gender', 'email', 'referCode', 'source');
            $token_id = auth()->user()->id;
            $token = auth()->user()->token;
            $userProfileInfoDetail = null;
            if(session()->has('auth_'.$token_id)){
                $userProfileInfoDetail = session()->get('auth_'.$token_id);
                $user_id = session()->get('auth_'.$token_id)['user_id'];
            }else
                throw new Exception("User id is missing");
            $request_input['userId'] = $user_id;
            $request_input['mobileNumber'] = $userProfileInfoDetail['mobile'];
            if(isset($userProfileInfoDetail['countryCode']))
                $request_input['countryCode']   =   $userProfileInfoDetail['countryCode']; 
            else
                $request_input['countryCode']   =   config()->get('constants.default_country_code');
            
            $validator = Validator::make($request_input, [
                    'name'          =>      'required|max:256',
                    'age'           =>      'required|integer|between:5,121',
                    'gender'        =>      'required|in:M,F',
                    'email'         =>      'required|email',
                    'mobileNumber'  =>      'required|digits:10',
                    'countryCode'   =>      'required',
                    'referCode'     =>      'max:256',
                    'source'        =>      'required|in:web,mobile'                
                ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->messages())->withInput();
            }
            
            
            $request_input['deviceId'] = $request_input['source'];
            $request_input['source'] = 'web';

            $updateLoginInfoUrl = env('API_URL').config()->get('constants.updateLoginInfo');
            $updateLoginInfoDetail = handleGuzzleCurlRequest($updateLoginInfoUrl, 'POST', $token, $request_input, [], 'application/x-www-form-urlencoded');
    
            if($updateLoginInfoDetail['status'] && isset($updateLoginInfoDetail['data'])){
                $request->session()->put('auth_'.$token_id, $updateLoginInfoDetail['data']);
//                $redirect_url = session()->get('url.intended', url('/dashboard'));
                if(!empty($request->cookie('landing_redirect'))) {
                    cookie()->queue(
                        \Cookie::forget('landing_redirect')
                    );
                    return redirect('/user_selection_cart');
                } 

                return redirect('/dashboard');
            }elseif(isset($updateLoginInfoDetail['message'])){
                return redirect('profile-info')->withErrors($updateLoginInfoDetail['message']);
            }else{
                return redirect('profile-info')->withErrors('something went wrong');
            }
        } catch (ModelNotFoundException $ex) {
            return redirect('profile-info')->withError($ex->getMessage());
        } catch (Exception $ex) {
            return redirect('profile-info')->withError($ex->getMessage());
        }
    }
    
    
    public function logout(){
        try{
            auth()->logout();
            request()->session()->flush();
            request()->session()->regenerate();
            if(auth()->check())
                return redirect('/');
            else
                return redirect('/');
        } catch (ModelNotFoundException $ex) {
            return back()->withError($ex->getMessage());
        } catch (Exception $ex) {
            return back()->withError($ex->getMessage());
        }
    }

}