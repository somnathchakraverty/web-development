<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Exception;

class MyAddressController extends Controller
{
    /**
     * This is for My Address Page
     */
    
    public function __construct(Request $request)
    {       
        parent::__construct($request);
        $this->middleware('auth');        
    }
    
    public function index(){
        /**
         * This is for My Address Page
         */
        try {
            $request    = $this->request;
            $token_id   = auth()->user()->id;
            $token      = auth()->user()->token;
            $city_id    = $this->city_id;

            $data = [
                'userDetail'    => [], 
            ];

            if(session()->has('auth_'.$token_id)){
                $userDetail             = session()->get('auth_'.$token_id);
                $user_id                = $userDetail['user_id'];

                $data['userDetail']     = $userDetail;
                
                $request_data['data']   = [
                    'user_id' => $user_id, 
                    'city_id' => $city_id
                ];
            }                
            else {
                throw new Exception("User id is missing");
            }
                
            return view('dashboard.my_address', $data);
        } catch (Exception $ex) {
            return new Exception($ex->getMessage());
        }
    }

    public function deleteAddress(Request $request, $address_id){
        /**
         * This is for delete Address
         */
        try {
            $request    = $this->request;

            $validator  = Validator::make(['address_id' => $address_id], [
                'address_id'    =>  'required|numeric',
            ]);

            if ($validator->fails()) {
                $error_response = [
                    "status"    => false,
                    "message"   => implode(" <br> ",$validator->messages()->all())
                ];

                return response()->json($error_response, 400);
            }

            $token_id   = auth()->user()->id;
            $token      = auth()->user()->token;

            if(session()->has('auth_'.$token_id)){
                $userDetail             = session()->get('auth_'.$token_id);
                $user_id                = $userDetail['user_id'];
                
                $request_data['data']   = [
                    'user_id'           => $user_id, 
                    "address_id"        => $address_id,
                    "source"            => 'web'
                ];
                
                $addressDeleteUrl       = env('API_URL').config()->get('constants.delete_address');
                $addressDeleteDetail    = handleGuzzleCurlRequest($addressDeleteUrl, 'POST', $token, $request_data);

                if(isset($addressDeleteDetail['status'])) {
                    return response()->json($addressDeleteDetail, 200);
                }
                else {
                    throw new Exception("something went wrong");
                }
            }                
            else {
                throw new Exception("User id is missing");
            }
            
        } catch (Exception $ex) {
            return response()->json(["status" => false, "message" => $ex->getMessage()], 500);
        }
    }

    public function getLocalityID(Request $request){
        /**
         * This is to get locality ID and check sub-locality serviceable or not
         */
        try {
            $request    = $this->request;

            $validator  = Validator::make($request->all(), [
                'lat'   =>  'required|numeric',
                'long'  =>  'required|numeric',
            ]);

            if ($validator->fails()) {
                $error_response = [
                    "status"    => false,
                    "message"   => implode(" <br> ",$validator->messages()->all())
                ];

                return response()->json($error_response, 400);
            }

            $token_id   = auth()->user()->id;
            $token      = auth()->user()->token;

            if(session()->has('auth_'.$token_id)){
                $userDetail             = session()->get('auth_'.$token_id);
                $user_id                = $userDetail['user_id'];
                
                $request_data           = [
                    'log_user_id'       => $user_id, 
                    "lat"               => $request->input('lat'),
                    "long"              => $request->input('long'),
                    "source"            => 'web'
                ];
                
                $getLocalityIDUrl       = env('CRM_URL').config()->get('constants.getnearestlocality');
                $getLocalityIDDetail    = handleGuzzleCurlRequest($getLocalityIDUrl, 'POST', $token, $request_data);

                if(isset($getLocalityIDDetail['status'])) {
                    return response()->json($getLocalityIDDetail, 200);
                }
                else {
                    throw new Exception("something went wrong");
                }
            }                
            else {
                throw new Exception("User id is missing");
            }
            
        } catch (Exception $ex) {
            return response()->json(["status" => false, "message" => $ex->getMessage()], 500);
        }
    }

    public function saveNewAddress(Request $request){
        /**
         * This is to save New Address
         */
        try {
            $request    = $this->request;

            $validator  = Validator::make($request->all(), [
                'house_number'  =>  'required|string|max:512',
                'pincode'       =>  'required|digits:6',
                'locality_id'   =>  'required|numeric',
                'city_id'       =>  'required|numeric',
                'state_id'      =>  'required|numeric',
                'sub_locality'  =>  'required|string|max:1000',
                'state_name'    =>  'required|string|max:512',
                'city'          =>  'required|string|max:512',
                'lon'           =>  'required|numeric',
                'lat'           =>  'required|numeric'
            ]);

            if ($validator->fails()) {
                $error_response = [
                    "status"    => false,
                    "message"   => implode(" <br> ",$validator->messages()->all())
                ];

                return response()->json($error_response, 400);
            }

            $request_data = $request->only([
                'house_number', 'pincode', 'locality_id', 'city_id', 
                'state_id', 'sub_locality', 'state_name', 'city', 'default_status',
                'lon', 'lat', 'device_source'
            ]);
            
            $token_id   = auth()->user()->id;
            $token      = auth()->user()->token;

            if(session()->has('auth_'.$token_id)){
                $userDetail             = session()->get('auth_'.$token_id);
                $user_id                = $userDetail['user_id'];

                $default_address = !empty($request_data['default_status']) ? 1 : 0;
                $device_source = !empty($request_data['device_source']) ? $request_data['device_source'] : 'web';

                $api_request_data['data']   = [
                    'user_id'           => $user_id,
                    'log_user_id'       => $user_id, 
                    "source"            => 'web',
                    "default_status"    => $default_address,
                    "house_number"      => $request_data['house_number'],
                    "lon"               => $request_data['lon'],
                    "lat"               => $request_data['lat'],
                    "locality_id"       => $request_data['locality_id'],
                    "sub_locality"      => $request_data['sub_locality'],
                    "pincode"           => $request_data['pincode'],                   
                    "state_id"          => $request_data['state_id'],
                    "state_name"        => $request_data['state_name'],
                    "city"              => $request_data['city'],
                    "city_id"           => $request_data['city_id'],
                    "device_source"     => $device_source
                ];

                $addressSaveUrl       = env('API_URL').config()->get('constants.add_address');
                $addressSaveDetail    = handleGuzzleCurlRequest($addressSaveUrl, 'POST', $token, $api_request_data);
                
                if(isset($addressSaveDetail['status'])) {
                    return response()->json($addressSaveDetail, 200);
                }
                else {
                    throw new Exception("something went wrong");
                }
            }                
            else {
                throw new Exception("User id is missing");
            }
            
        } catch (Exception $ex) {
            return response()->json(["status" => false, "message" => $ex->getMessage()], 500);
        }
    }


    public function getAddressList(){
        /**
         * This is to get Address List
         */
        try {
            $request    = $this->request;
            $token_id   = auth()->user()->id;
            $token      = auth()->user()->token;
            $city_id    = $this->city_id;

            if(session()->has('auth_'.$token_id)){
                $userDetail             = session()->get('auth_'.$token_id);
                $user_id                = $userDetail['user_id'];

                $data['userDetail']     = $userDetail;
                
                $request_data['data']   = [
                    'user_id' => $user_id, 
                    'city_id' => $city_id
                ];
                
                $addressInfoUrl         = env('API_URL').config()->get('constants.getAddress');
                $useraddressInfoDetail  = handleGuzzleCurlRequest($addressInfoUrl, 'POST', $token, $request_data);

                if(isset($useraddressInfoDetail['status'])) {
                    if(!empty($useraddressInfoDetail['data']) && $useraddressInfoDetail['status'] == true) {
                        return response()->json($useraddressInfoDetail['data'], 200);
                    } 
                    else {
                        return response()->json([], 200);
                    }
                }
                else {
                    throw new Exception("something went wrong");
                }
            }                
            else {
                throw new Exception("User id is missing");
            }            
        } catch (Exception $ex) {
            return response()->json(["status" => false, "message" => $ex->getMessage(), "data" => [] ], 500);
        }
    }

    public function updateAddress(Request $request){
        /**
         * This is to update particular Address using Address ID
         */
        try {
            $request    = $this->request;

            $validator  = Validator::make($request->all(), [
                'address_id'    =>  'required|numeric',
                'house_number'  =>  'required|string|max:512',
                'pincode'       =>  'required|digits:6',
                'locality_id'   =>  'required|numeric',
                'city_id'       =>  'required|numeric',
                'state_id'      =>  'required|numeric',
                'sub_locality'  =>  'required|string|max:1000',
                'state_name'    =>  'required|string|max:512',
                'city'          =>  'required|string|max:512',
                'lon'           =>  'required|numeric',
                'lat'           =>  'required|numeric'
            ]);

            if ($validator->fails()) {
                $error_response = [
                    "status"    => false,
                    "message"   => implode(" <br> ",$validator->messages()->all())
                ];

                return response()->json($error_response, 400);
            }

            $request_data = $request->only([
                'house_number', 'pincode', 'locality_id', 'city_id', 
                'state_id', 'sub_locality', 'state_name', 'city', 'default_status',
                'lon', 'lat', 'device_source', 'address_id'
            ]);
            
            $token_id   = auth()->user()->id;
            $token      = auth()->user()->token;

            if(session()->has('auth_'.$token_id)){
                $userDetail             = session()->get('auth_'.$token_id);
                $user_id                = $userDetail['user_id'];

                $default_address = !empty($request_data['default_status']) ? 1 : 0;
                $device_source = !empty($request_data['device_source']) ? $request_data['device_source'] : 'web';
                
                $api_request_data['data']   = [
                    "user_id"           => $user_id,
                    "log_user_id"       => $user_id, 
                    "address_id"        => $request_data['address_id'],
                    "source"            => 'web',
                    "default_status"    => $default_address,
                    "house_number"      => $request_data['house_number'],
                    "lon"               => $request_data['lon'],
                    "lat"               => $request_data['lat'],
                    "locality_id"       => $request_data['locality_id'],
                    "sub_locality"      => $request_data['sub_locality'],
                    "pincode"           => $request_data['pincode'],                   
                    "state_id"          => $request_data['state_id'],
                    "state_name"        => $request_data['state_name'],
                    "city"              => $request_data['city'],
                    "city_id"           => $request_data['city_id'],
                    "device_source"     => $device_source
                ];
                $api_request_data['user_id'] = $user_id;

                $addressUpdateUrl       = env('API_URL').config()->get('constants.update_address');
                $addressUpdateDetail    = handleGuzzleCurlRequest($addressUpdateUrl, 'POST', $token, $api_request_data);
                
                if(isset($addressUpdateDetail['status'])) {
                    return response()->json($addressUpdateDetail, 200);
                }
                else {
                    throw new Exception("Something went wrong.");
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