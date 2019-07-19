<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Exception;

class MyReportsController extends Controller
{
    /**
     * This is for My Reports Page
     */
    
    public function __construct(Request $request)
    {
        parent::__construct($request);        
        $this->middleware('auth'); 
            
    }
    
    public function index($cust_id = null){
        try {
            $request    = $this->request;
            $token_id   = auth()->user()->id;
            $token      = auth()->user()->token;
            $city_id    = $this->city_id;

            $data = [
                'userDetail'        => [], 
                'report_list'       => [],
                'family_list'       => [],
                'userName'          => '',
                'cust_id'           => $cust_id,
                'downloadReportAPI' => env('API_URL').config()->get('constants.downloadReports')
            ];

            if(session()->has('auth_'.$token_id)){
                $userDetail         = session()->get('auth_'.$token_id);
                $user_id            = $userDetail['user_id'];
                $data['userDetail'] = $userDetail;
                $data['userName']   = $userDetail['name'];

                $request_data['data']   = [
                    'user_id'       => $user_id, 
                    'source'        => 'web',
                ];

                // get all family members to show slider
                $customerInfoUrl        = env('API_URL').config()->get('constants.URL_CUSTOMER_LIST');
                $customerInfoDetail     = handleGuzzleCurlRequest($customerInfoUrl, 'POST', $token, $request_data);

                if(isset($customerInfoDetail['status'])) {
                    if(!empty($customerInfoDetail['data']) && $customerInfoDetail['status'] == true) {
                        $data['family_list']    = $customerInfoDetail['data'];
                    } 
                }
                else {
                    throw new Exception("something went wrong");
                }

                // get all reports of all members and filter self user data
                $reportInfoUrl     = env('API_URL').config()->get('constants.getMyReports');
                $reportInfoDetail  = handleGuzzleCurlRequest($reportInfoUrl, 'POST', $token, $request_data);

                if(isset($reportInfoDetail['status'])) {
                    if(!empty($reportInfoDetail['data']) && $reportInfoDetail['status'] == true) {
                        if(empty($cust_id)) {
                            $cust_id            = $user_id;
                            $data['cust_id']    = $cust_id;
                        }
                        $getFilterData          = $this->getReportByCustomer($reportInfoDetail['data'], $cust_id);
                        $data['report_list']    = $getFilterData;

                        if(!empty($getFilterData[0]['customer_name'])) {
                            $data['userName']   = $getFilterData[0]['customer_name'];
                        }
                        else {
                            foreach($customerInfoDetail['data'] as $cd) {
                                if($cd['customer_id'] == $cust_id) {
                                    $data['userName'] = $cd['customer_name'];
                                }
                            }
                        }
                    }
                }
                else {
                    throw new Exception("something went wrong");
                }

            }                
            else {
                throw new Exception("User id is missing");
            }

            return view('dashboard.my_reports', $data); 
        } catch (Exception $ex) {
            return new Exception($ex->getMessage());
        }
    }

    
    public function getReportByCustomer($data, $customer_id) {
        /**
         * Filter particular user data from all reports data
         */
        //dd($customer_id);

        $response = [];

        foreach($data as $i) {
            if($i['customer_id'] == $customer_id) {  
                array_push($response, $i);
            }
        }

        return $response;
    }
} 