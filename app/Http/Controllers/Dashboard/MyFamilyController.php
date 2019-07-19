<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\MessageBag;
use Exception;

class MyFamilyController extends Controller
{
    /**
     * This is for My Family Page
     */
   
    public function __construct(Request $request)
    {        
        parent::__construct($request);        
        $this->middleware('auth');
    }
    
    public function index(){
        try {
            $request    = $this->request;
            $token_id   = auth()->user()->id;
            $token      = auth()->user()->token;
            $city_id    = $this->city_id;

            $data = [
                'userDetail'    => []
            ];

            if(session()->has('auth_'.$token_id)){
                $userDetail             = session()->get('auth_'.$token_id);
                $user_id                = $userDetail['user_id'];
                $data['userDetail']     = $userDetail;
            }                
            else {
                throw new Exception("User id is missing");
            }
                
            return view('dashboard.my_family', $data); 
        } catch (Exception $ex) {
            return new Exception($ex->getMessage());
        }
    }

    public function addFamilyMember(MessageBag $message_bag){
        try {
            $request    = $this->request;
            $request_data = $request->only([
                'username', 'relation', 'age', 'dob', 
                'gender', 'mobile', 'email', 'device_source'
            ]);
            
            if(empty($request_data['email'])) {
                unset($request_data['email']);
            }
                
            if(empty($request_data['mobile'])) {
                unset($request_data['mobile']);
            }
                
            $validator  = Validator::make($request_data, [
                'username'      =>  'required|string|max:512',
                'relation'      =>  'required|string',
                'age'           =>  'required|numeric',
                'dob'           =>  'required',
                'gender'        =>  'required|string|max:10',
                'mobile'        =>  'numeric',
                'email'         =>  'email|max:512'
            ]);

            if ($validator->fails()) {
                $error_response = [
                    "status"    => false,
                    "message"   => implode(" <br> ",$validator->messages()->all())
                ];

                return response()->json($error_response, 400);
            }

            if(!empty($request_data['relation'])) {
                if(strtolower($request_data['relation']) === 'self') {
                    return response()->json(["status" => false, "message" => "You can not update self user."], 400);
                }
            }

            $token_id   = auth()->user()->id;
            $token      = auth()->user()->token;

            if(session()->has('auth_'.$token_id)){
                $userDetail         = session()->get('auth_'.$token_id);
                $user_id            = $userDetail['user_id'];

                //convert DOB to nysql format
                if(!empty($request_data['dob'])) {
                    $dob_date           = date_create($request_data['dob']);
                    $dob                = date_format($dob_date,"Y-m-d");
                }               

                $api_request_data['data']   = [
                    'user_id'           => $user_id,
                    "source"            => 'web',
                    "device_source"     => $request_data['device_source'],
                    "alternate_email"   => '',
                    "alternate_mobile"  => '',
                    "dob_type"          => 'estimated',
                    "age"               => $request_data['age'],
                    "relation"          => $request_data['relation'],
                    "dob"               => $dob,
                    "mobile"            => !empty($request_data['mobile']) ? $request_data['mobile'] : '',
                    "email"             => !empty($request_data['email']) ? $request_data['email'] : '',
                    "name"              => $request_data['username'],                   
                    "gender"            => $request_data['gender']
                ];

                $familySaveUrl       = env('API_URL').config()->get('constants.URL_NEW_MEMBER');
                $familySaveDetail    = handleGuzzleCurlRequest($familySaveUrl, 'POST', $token, $api_request_data);

                if(isset($familySaveDetail['status'])) {
                    return response()->json($familySaveDetail, 200);
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

    public function editFamilyMember(){
        try {
            $request    = $this->request;
            $request_data = $request->only([
                'username', 'relation', 'age', 'dob', 
                'gender', 'mobile', 'email', 'device_source', 'customer_id'
            ]);
            
            if(empty($request_data['email'])) {
                unset($request_data['email']);
            }
                
            if(empty($request_data['mobile'])) {
                unset($request_data['mobile']);
            }
                
            $validator  = Validator::make($request_data, [
                'username'      =>  'required|string|max:512',
                'relation'      =>  'required|string',
                'age'           =>  'required|numeric',
                'dob'           =>  'required',
                'gender'        =>  'required|string|max:10',
                'mobile'        =>  'numeric',
                'email'         =>  'email|max:512',
                'customer_id'   =>  'required|alpha_num'
            ]);

            if ($validator->fails()) {
                $error_response = [
                    "status"    => false,
                    "message"   => implode(" <br> ",$validator->messages()->all())
                ];

                return response()->json($error_response, 400);
            }

            if(!empty($request_data['relation'])) {
                if(strtolower($request_data['relation']) === 'self') {
                    return response()->json(["status" => false, "message" => "You can not update self user."], 400);
                }
            }

            $token_id   = auth()->user()->id;
            $token      = auth()->user()->token;

            if(session()->has('auth_'.$token_id)){
                $userDetail         = session()->get('auth_'.$token_id);
                $user_id            = $userDetail['user_id'];
                
                //convert DOB to nysql format
                if(!empty($request_data['dob'])) {
                    $dob_date           = date_create($request_data['dob']);
                    $dob                = date_format($dob_date,"Y-m-d");
                }  

                $api_request_data['data']   = [
                    'user_id'           => $user_id,
                    "source"            => 'web',
                    "device_source"     => $request_data['device_source'],
                    "customer_id"       => $request_data['customer_id'],
                    "alternate_email"   => '',
                    "alternate_mobile"  => '',
                    "dob_type"          => 'estimated',
                    "age"               => $request_data['age'],
                    "relation"          => $request_data['relation'],
                    "dob"               => $dob,
                    "mobile"            => !empty($request_data['mobile']) ? $request_data['mobile'] : '',
                    "email"             => !empty($request_data['email']) ? $request_data['email'] : '',
                    "name"              => $request_data['username'],                   
                    "gender"            => $request_data['gender']
                ];

                $familySaveUrl       = env('API_URL').config()->get('constants.URL_UPDATE_MEMBER');
                $familySaveDetail    = handleGuzzleCurlRequest($familySaveUrl, 'POST', $token, $api_request_data);

                if(isset($familySaveDetail['status'])) {
                    return response()->json($familySaveDetail, 200);
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

    public function getFamilyList() {
        try {
            $request    = $this->request;
            $token_id   = auth()->user()->id;
            $token      = auth()->user()->token;

            if(session()->has('auth_'.$token_id)){
                $userDetail             = session()->get('auth_'.$token_id);
                $user_id                = $userDetail['user_id'];
                $data['userDetail']     = $userDetail;

                $request_data['data']   = [
                    'user_id'           => $user_id, 
                    'source'            => 'web'
                ];

                $customerInfoUrl        = env('API_URL').config()->get('constants.URL_CUSTOMER_LIST');
                $customerInfoDetail     = handleGuzzleCurlRequest($customerInfoUrl, 'POST', $token, $request_data);

                if(isset($customerInfoDetail['status'])) {
                    if(!empty($customerInfoDetail['data']) && $customerInfoDetail['status'] == true) {
                        return response()->json($customerInfoDetail['data'], 200);
                    } 
                    else {
                        throw new Exception("Something went wrong");
                    }
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

    public function getRelationship() {
        try {
            $request    = $this->request;
            $token_id   = auth()->user()->id;
            $token      = auth()->user()->token;

            if(session()->has('auth_'.$token_id)){
                $userDetail             = session()->get('auth_'.$token_id);
                $user_id                = $userDetail['user_id'];
                $data['userDetail']     = $userDetail;

                $relationshipInfoUrl        = env('API_URL').config()->get('constants.URL_RELATION');
                $relationshipInfoDetail     = handleGuzzleCurlRequest($relationshipInfoUrl, 'GET', $token);

                if(isset($relationshipInfoDetail['status'])) {
                    if(!empty($relationshipInfoDetail['data']) && $relationshipInfoDetail['status'] == true) {
                        return response()->json($relationshipInfoDetail['data'], 200);
                    } 
                    else {
                        throw new Exception("Something went wrong");
                    }
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