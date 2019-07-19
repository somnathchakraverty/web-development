<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class HealthKarmaController extends Controller
{
    /**
     * This is for Health Karma
     */
    
    public function __construct(Request $request) {
        parent::__construct($request);
    }

    public function getHealthKarmaQuestion() {
        try {
            $request                  =   $this->request;

            $age        = $request->query('age');
            $gender     = $request->query('gender');

            if(!empty($age) && !empty($gender)) {
                $request_data       = [ 
                    "data"          => [
                        "age"       => $age,
                        "gender"    => $gender,
                        "source"    => "web",
                        "catId"     => "1"
                    ]
                ];

                $h_q_url        = env('API_URL').config()->get('constants.health_karma_question');
                $details        = handleCurlRequest($h_q_url, 'POST', $request_data);

                if(!empty($details)) {
                    if(!empty($details['data']) && $details['status']) {
                        return $this->getHTTPresponse($details['data'], 200);
                    }
                    else {
                        throw new Exception("Health Karma API fails");
                    }
                }
                else {
                    throw new Exception("Health Karma API fails");
                }
            }
        }
        catch (Exception $ex) {
            return response()->json(["status" => false, "message" => $ex->getMessage()], 500);
        }
    }

    
    public function healthkarma_new() {

        try {
            $request    =   $this->request;
            $route = request()->route()->getName();
            $this->seoDataProcess($route);
            
            $data = [];
            if(auth()->check()){
                $cur_user_id    =   $request->query('user_id');
                if(!empty($cur_user_id)){
                    $userProfileInfoUrl =   env('API_URL').config()->get('constants.URL_CUSTOMER_LIST');
                    $token_id = auth()->user()->id;
                    $token              =   auth()->user()->token;
                    if(session()->has('auth_'.$token_id)){
                        $getUserDetail  =   $request->session()->get('auth_'.$token_id); 
                        $user_id            =   $getUserDetail['user_id'];
                        $n_data['data']     =   ['user_id' => $user_id, 'source' => 'web'];
                        $userProfileInfoDetail = handleGuzzleCurlRequest($userProfileInfoUrl, 'POST', $token, $n_data);
                        if(isset($userProfileInfoDetail['status']) && $userProfileInfoDetail['status'] && isset($userProfileInfoDetail['data'])){
                            foreach($userProfileInfoDetail['data'] as $userDetail){
                                if($cur_user_id == $userDetail['customer_id']){
                                    $userDetail['gender']   =   $userDetail['customer_gender'];
                                    $userDetail['name']     =   $userDetail['customer_name'];
                                    $userDetail['mobile']   =   $userDetail['contact_number'];
                                    $userDetail['age']   =   $userDetail['customer_age'];
                                    $data['customer_detail']    =   $userDetail;
                                    break;
                                }
                            }
                        }
                    }
                    
                }else{
                    $token_id = auth()->user()->id;
                    if(session()->has('auth_'.$token_id)){
                        $data['customer_detail']    =  $request->session()->get('auth_'.$token_id);                
                    }
                }
                
            }
//            dd($data);
            return view('healthkarma_new', $data);

        } catch (Exception $ex) {
            return new Exception($ex->getMessage());
        }
    }

    public function saveHealthKarma() {
        try {
            $input_field    =   $this->request->all();
            
            $validator  = Validator::make($input_field, [
                'name'              => 'required|string|max:255',
                'contact_number'    => 'required|digits:10',
                'email'             => 'required|email|max:255',
                'age'               => 'required|numeric',
                'cityId'            => 'required|numeric',
                'gender'            => 'required|string',
                'height'            => 'required|numeric',
                'weight'            => 'required|numeric',
                'options'           => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  implode(" <br> ",$validator->messages()->all())
                ], 433);
            }
            $request_data = [];
            $request_data['data']           = $input_field;
            $request_data['data']['source'] = 'web';

            $health_karma_save_url = env('API_URL'). config('constants.health_karma_save');
            $health_karma_detail   = handleGuzzleCurlRequest($health_karma_save_url, 'POST', null, $request_data);

            if(!empty($health_karma_detail['status'])) {
                if($health_karma_detail['status']) {
                    return response()->json($health_karma_detail, 200);
                }
                else {
                    return response()->json($health_karma_detail, 400);
                }
            }
            else {
                throw new Exception("Something went wrong");
            }            
        }
        catch (Exception $ex) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  $ex->getMessage()
            ], 500);
        }
    }

    public function clickToCall() {
        try {
            $input_field    =   $this->request->all();
            
            $validator  = Validator::make($input_field, [
                'contact_number'    => 'required|digits:10',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  implode(" <br> ",$validator->messages()->all())
                ], 433);
            }

            $request_data                   = [
                'data' => [
                    'customer_mobile' =>    $input_field['contact_number'],
                    'source'          =>    "web",
                    'app_version'     =>    "46"
                ]
            ];

            $click_to_call_save_url = env('API_URL'). config('constants.click_to_call');
            $click_to_call_detail   = handleGuzzleCurlRequest($click_to_call_save_url, 'POST', null, $request_data);

            if(!empty($click_to_call_detail['status'])) {
                if($click_to_call_detail['status']) {
                    return response()->json($click_to_call_detail, 200);
                }
                else {
                    return response()->json($click_to_call_detail, 400);
                }
            }
            else {
                throw new Exception("Something went wrong".json_encode($click_to_call_detail));
            }            
        }
        catch (Exception $ex) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  $ex->getMessage()
            ], 500);
        }
    }
}