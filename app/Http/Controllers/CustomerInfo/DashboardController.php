<?php

namespace App\Http\Controllers\CustomerInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Exception;

class DashboardController extends Controller
{
    /**
     * This is for Dashboard Page
     */

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth');
    }
    
    public function index() {
        try {
            $token_id               = auth()->user()->id;
            $token                  = auth()->user()->token;
            $userProfileInfoDetail  = null;
            
            if(session()->has('auth_'.$token_id)){
                $userProfileInfoDetail = session()->get('auth_'.$token_id);
                $userProfileInfoDetail['phlebo_detail']    =   FALSE;
                $user_id    =   session()->get('auth_'.$token_id)['user_id'];
                
                $deal_user_management   =   \App\Models\DealUserManagement::getUserDetailByEncyUserId($user_id, ['user_id']);
                $phleboData =   [
                    'data'  =>  [
                        'user_id'   =>  $user_id,
                        'source'    =>  'consumer_app'
                    ]
                ];
                 
                $phleboUrl          =   $this->api_url.''.config('constants.getPhleboInfo');
                $phlebo_details     =   handleGuzzleCurlRequest($phleboUrl, 'POST', $token, $phleboData);
                if(isset($phlebo_details['status']) && $phlebo_details['status'] && isset($phlebo_details['data']['booking_id'])){
                    $userProfileInfoDetail['phlebo_detail']    =   TRUE;
                    $userProfileInfoDetail['booking_id']       =   $phlebo_details['data']['booking_id'];
                }
                $userProfileInfoDetail['decrypt_user_id']    =   $deal_user_management->user_id;
            }
            
            if(!empty($userProfileInfoDetail)){
                return view('dashboard.index', ['user_detail' => $userProfileInfoDetail]);
            }
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}