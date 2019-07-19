<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class SmartReportController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth');
    }
    
    public function index($booking_id, $customer_id) {
        try {
            $token_id   =   auth()->user()->id;
            $token      = auth()->user()->token;

            if(session()->has('auth_'.$token_id)){
                $user_detail    =   session()->get('auth_'.$token_id);
                $user_id        =   session()->get('auth_'.$token_id)['user_id'];
            }else
                throw new Exception("User id is missing");
       
            $data['data']       =   [
                'user_id'       =>  $user_id,
                'source'        =>  'consumer_app',
                'customer_id'   =>  $customer_id,
                'booking_id'    =>  $booking_id
            ];

            $getCustomersHealthScoreURL =   env('API_URL').config()->get('constants.getCustomersHealthScore');
            $healthScore_details        =   handleGuzzleCurlRequest($getCustomersHealthScoreURL, 'POST', $token, $data);
            $result_detail              =   [];
            
            //dd($healthScore_details);
            if(!empty($healthScore_details['status']) && $healthScore_details['status'] && !empty($healthScore_details['status'])){
                $result_detail['healthScore_details'] = $healthScore_details['data'];
                $result_detail['healthScore_details']['customer_id'] = $customer_id;
            }
            else {
                throw new Exception("something went wrong");
            } 
            return view('report.smart-report', $result_detail['healthScore_details']);

        } catch (Exception $ex) {
            return new Exception($ex->getMessage());
        }
    }
    
    public function getGraphData() {
        /**
         * This is to get Graph Data for parameter of particular customer
         */
        try {
            $request    = $this->request;

            $validator  = Validator::make($request->all(), [
                'parameterId'   =>  'required|numeric',
                'customerId'    =>  'required'
            ]);

            if ($validator->fails()) {
                $error_response = [
                    "status"    => false,
                    "message"   => implode(" <br> ",$validator->messages()->all())
                ];

                return response()->json($error_response, 400);
            }

            $token_id   =   auth()->user()->id;
            $token      = auth()->user()->token;

            if(session()->has('auth_'.$token_id)){
                $user_id        =   session()->get('auth_'.$token_id)['user_id'];
            }
            else {
                throw new Exception("User id is missing");
            }

            $request_data['data']   = [
                'user_id'           => $user_id, 
                "parameterId"       => $request['parameterId'],
                "customerId"        => $request['customerId'],
                "source"            => 'web',
                'guid'              =>  !empty($_COOKIE["guid"]) ? md5($_COOKIE["guid"]): '',
                'ip'                =>  $request->ip()
            ];
            
            $graphDataUrl     = config()->get('constants.api_url').config()->get('constants.getSmartReportGraphData');
            $graphDataDetail  = handleGuzzleCurlRequest($graphDataUrl, 'POST', $token, $request_data);

            if(isset($graphDataDetail['status'])) {
                if($graphDataDetail['status']) {
                    return response()->json($graphDataDetail, 200);
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