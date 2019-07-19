<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Exception;

class MyBookingController extends Controller
{
    /**
     * This is for My Booking Page
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
                'userDetail'    => [], 
                'booking_list'  => []
            ];

            if(session()->has('auth_'.$token_id)){
                $userDetail         = session()->get('auth_'.$token_id);
                $user_id            = $userDetail['user_id'];
                $data['userDetail'] = $userDetail;

                $request_data['data']   = [
                    'user_id'       => $user_id, 
                    'source'        => 'web',
                    "app_version"   => "84",
                ];

                $bookingInfoUrl     = env('API_URL').config()->get('constants.getMyBooking');
                $bookingInfoDetail  = handleGuzzleCurlRequest($bookingInfoUrl, 'POST', $token, $request_data);
                
                // \Log::error(print_r($bookingInfoDetail['data'],true));

                if(isset($bookingInfoDetail['status'])) {
                    if(!empty($bookingInfoDetail['data']) && $bookingInfoDetail['status'] == true) {
                        $data['booking_list'] = $bookingInfoDetail['data'];
                    }
                }
                else {
                    throw new Exception("something went wrong");
                }

            }                
            else {
                throw new Exception("User id is missing");
            }

            return view('dashboard.my_booking', $data); 
        } catch (Exception $ex) {
            return new Exception($ex->getMessage());
        }
    }
}