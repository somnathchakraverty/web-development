<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Exception;

class ReferEarnController extends Controller
{
    /**
     * This is for Refer & Earn Page
     */
    
    public function __construct(Request $request)
    {       
        parent::__construct($request); 
        
    }
    
    public function index(){
        $this->middleware('auth');
        try {
            $request    = $this->request;
            $token_id   = auth()->user()->id;
            $token      = auth()->user()->token;
            $city_id    = $this->city_id;

            $data = [
                'userDetail'    => [], 
                'refer_details' => []
            ];

            if(session()->has('auth_'.$token_id)){
                $userDetail = session()->get('auth_'.$token_id);
                $user_id                = $userDetail['user_id'];
                $data['userDetail']     = $userDetail;

                $request_data['data']   = [
                    'user_id'           => $user_id,
                    'source'            => 'web'
                ];

                $addressInfoUrl         = env('API_URL').config()->get('constants.getReferList');
                $userReferralInfoDetail  = handleGuzzleCurlRequest($addressInfoUrl, 'POST', $token, $request_data);

                if(isset($userReferralInfoDetail['status'])) {
                    if(!empty($userReferralInfoDetail['data']) && $userReferralInfoDetail['status'] == true) {
                        $data['refer_details'] = $userReferralInfoDetail['data'];
                    } 
                    else {
                        throw new Exception("something went wrong");
                    }
                }
                else {
                    throw new Exception("something went wrong");
                }
            }                
            else {
                throw new Exception("User id is missing");
            }
                
            return view('dashboard.refer_earn', $data); 
        } catch (Exception $ex) {
            return view('404_error');
        }
    }

    public function referAndEarn($user_id){
        try {

            $data = [
                'refer_details' => []
            ];

            if(!empty($user_id)){

                $request_data['data']   = [
                    'user_id'           => $user_id,
                    'source'            => 'web'
                ];

                $addressInfoUrl         = env('API_URL').config()->get('constants.getReferList');
                $userReferralInfoDetail  = handleGuzzleCurlRequest($addressInfoUrl, 'POST', null, $request_data);

                if(isset($userReferralInfoDetail['status'])) {
                    if(!empty($userReferralInfoDetail['data']) && $userReferralInfoDetail['status'] == true) {
                        $data['refer_details'] = $userReferralInfoDetail['data'];
                    } 
                    else {
                        throw new Exception("something went wrong");
                    }
                }
                else {
                    throw new Exception("something went wrong");
                }
            }                
            else {
                throw new Exception("User id is missing");
            }
                
            return view('internal/refer_earn_guest', $data); 
        } catch (Exception $ex) {
            return view('404_error');
        }
    }
}