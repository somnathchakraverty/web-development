<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Exception;

class InternalWorkController extends Controller
{
    /**
     * This is for Internal Page
     */
    
    public function __construct(Request $request)
    {       
        parent::__construct($request);

        $route = request()->route()->getName();
        $this->seoDataProcess($route);
    }
    

    public function booking_verification(){
        /**
         * This is for booking_verification
         */
        try {
    
            $request    = $this->request;
            $data       = [];
            
            $booking_id = $request->query('booking_id');
            $mobile     = $request->query('mobile');

            $validator  = Validator::make(['booking_id'=>$booking_id, 'mobile'=>$mobile], [
                'booking_id'    =>  'required|numeric',
                'mobile'        =>  'required|digits:10'
            ]);

            if ($validator->fails()) {
                $error_response = [
                    "status"    => false,
                    "message"   => implode(" <br> ",$validator->messages()->all())
                ];

                throw new Exception("Booking id and Mobile is missing");
            }

            $request_data['data']   = [
                'booking_id'        => $booking_id, 
                "mobile"            => $mobile,
                "source"            => 'web',
                'guid'              =>  !empty($_COOKIE["guid"]) ? md5($_COOKIE["guid"]): '',
                'ip'                =>  $request->ip()
            ];
            
            $bookingVerificationUrl     = env('API_URL').config()->get('constants.booking_verification');
            $bookingVerificationDetail  = handleGuzzleCurlRequest($bookingVerificationUrl, 'POST', null, $request_data);
            
            if(!empty($bookingVerificationDetail)) {
                $data["message"]    =  $bookingVerificationDetail['message'];
                $data['booking_id'] = $request['booking_id'];
                return view('internal.booking_verification', $data);
            }            
        } catch (Exception $ex) {
            return view('404_error');
        }
    }

    public function misscall_lead($phone_number){
        /**
         * This is for misscall_lead
         * http://newweb.com/lead/missed-call/ODU4Nzk5MDU3MA==
         */
        try {
            $request    = $this->request;
            $data       = [];

            if (empty($phone_number)) {
                throw new Exception("Phone no. is missing");
            }

            $request_data['data']   = [
                "mobile"            => $phone_number,
                "source"            => 'web',
                'guid'              =>  !empty($_COOKIE["guid"]) ? md5($_COOKIE["guid"]): '',
                'ip'                =>  $request->ip()
            ];
            
            $missedCallCompaignUrl     = env('API_URL').config()->get('constants.misscall_lead');
            $missedCallCompaignDetail  = handleGuzzleCurlRequest($missedCallCompaignUrl, 'POST', null, $request_data);
                        
            if(!empty($missedCallCompaignDetail)) {
                if($missedCallCompaignDetail['status']) {
                    if(!empty($missedCallCompaignDetail['mobile'])) {
                        $event_data     =   [
                            'action'    =>  'Misscall Captured',
                            'category'  =>  'Misscall',
                            'label'     =>  $missedCallCompaignDetail['lead_id']
                        ];
                        $this->createGAEvent($this->request,   $event_data);
                    }
                    return view('internal.misscall-lead', $data);
                }
                else {
                    throw new Exception("Misscall Lead API - Lead not captured");
                }
            }       
            else {
                throw new Exception("Misscall Lead API - Data is missing");
            }     
        } catch (Exception $ex) {
            return view('404_error');
        }
    }

}