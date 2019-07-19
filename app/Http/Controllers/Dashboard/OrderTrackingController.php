<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Exception;

class OrderTrackingController extends Controller
{
    /**
     * This is for Booking Details / Order Tracking
     */
    
    public function __construct(Request $request)
    {      
        parent::__construct($request);        
        $this->middleware('auth');
    }
    
    public function index($order_id = null){
        try {
            $request    = $this->request;
            
            if(empty($order_id)) {
                return redirect('/dashboard');
            }
            
            $token_id   = auth()->user()->id;
            $token      = auth()->user()->token;

            $data = [
                'userDetail'        => [], 
                'booking_details'   => [],
                'hard_copy_price'   => 50,
                'total_suborder'    => 0,
                'coupon_notice_div' => false
            ];

            if(session()->has('auth_'.$token_id)){
                $userDetail         = session()->get('auth_'.$token_id);
                $user_id            = $userDetail['user_id'];
                $data['userDetail'] = $userDetail;

                $request_data   = [
                    'user_id'   => $user_id, 
                    'source'    => 'web',
                    "order_id"  => (int)$order_id,
                ];

                $bookingInfoUrl     = env('CRM_URL').config()->get('constants.order_tracking');
                $bookingInfoDetail  = handleGuzzleCurlRequest($bookingInfoUrl, 'POST', $token, $request_data);

                if(isset($bookingInfoDetail['status'])) {
                    if(!empty($bookingInfoDetail['data']) && $bookingInfoDetail['status'] == true) {
                        $data['booking_details']    = $bookingInfoDetail['data'];
                        $data['total_suborder']     = $this->getPackageTotal($bookingInfoDetail['data']['suborders']);
                    }
                }
                else {
                    throw new Exception(print_r($bookingInfoDetail, true));
                }                    
                
                $hardCopyFeeUrl     = env('API_URL').config()->get('constants.hard_copy_price');
                $hardCopyFeeDetail  = handleGuzzleCurlRequest($hardCopyFeeUrl, 'GET', $token);

                if(!empty($hardCopyFeeDetail['data'])){
                    $data['hard_copy_price'] = $hardCopyFeeDetail['data']['price'];
                }

                $donationUrl        = env('API_URL').config()->get('constants.donation_online_discount_coupon_info');
                $donationFeeDetail  = handleGuzzleCurlRequest($donationUrl, 'GET', $token);

                if(isset($donationFeeDetail['status'])) {
                    if(!empty($donationFeeDetail['data']) && $donationFeeDetail['status'] == true) {
                        $donation_details           = $donationFeeDetail['data'];
                        $data['donation_details']   = $donation_details['donation_info'];

                        $coupon_notice              = json_decode($donation_details['coupon_discount_addon_config']);
                        
                        if($coupon_notice->status !== 'off') {
                            $data['coupon_notice_msg']  = $coupon_notice->msg;
                            $data['coupon_notice_div']  = true;
                        }

                    } 
                    else {
                        throw new Exception(print_r($donationFeeDetail, true));
                    }
                }
                else {
                    throw new Exception(print_r($donationFeeDetail, true));
                }

            }                
            else {
                throw new Exception("User id is missing");
            }
            
            //dd($data);

            return view('dashboard.order_details', $data); 
        } catch (Exception $ex) {
            return new Exception($ex->getMessage());
        }
    }

    public function getPackageTotal($order_data) {
        $total_price = 0;

        foreach($order_data as $item) {
            foreach($item['orders'] as $it) {
                $total_price += (int)$it['healthians_price'];
            }
        }

        return $total_price;
    }
}