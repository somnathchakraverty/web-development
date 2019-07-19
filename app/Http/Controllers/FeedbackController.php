<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Exception;

class FeedbackController extends Controller
{
    /**
     * This is for Feedback Pages for all feedback pages
     */
    
    public function __construct(Request $request)
    {       
        parent::__construct($request);

        $route = request()->route()->getName();
        $this->seoDataProcess($route);
    }
    

    public function csat($csat_id){
        /**
         * This is for csat page
         */
        try {
            $request    = $this->request;

            if (empty($csat_id)) {
                throw new Exception("CSAT id is missing");
            }
            
            $csat_reasons_url       =   env('API_URL'). config('constants.CSATReasons');
            
            $csat_reasons_detail    =   handleGuzzleCurlRequest($csat_reasons_url, 'GET');
            if($csat_reasons_detail['status'] && isset($csat_reasons_detail['data'])){
                $data   = [
                    "csat_id"       =>  $csat_id, 
                    "source"        =>  'web',
                    'csat_reasons'   =>  $csat_reasons_detail['data']
                ];
            }
            
            return view('feedback.csat_survey', $data);
        
        } catch (Exception $ex) {
            return view('404_error');
        }
    }
    
    public function saveCSAT($csat_id){
        try {
            $request    = $this->request;

            if (empty($csat_id)) {
                throw new Exception("CSAT id is missing");
            }
            
            $request_data   =   $request->only(['source', 'csat_reasons', 'description', 'rating_val']);
            $validator = Validator::make($request_data, [
                'source'        =>  'required|in:web,mobile',
                'csat_reasons'  =>  'required|string',
                'rating_val'    =>  'required|string'
            ]);
            if ($validator->fails()) {
                return response()->json([
                        'status'    =>  false,
                        'message'   =>  $validator->errors()->first()
                    ], 433); // Status code here
            }
            if(!isset($request_data['description']))
                $request_data['description']    =   "";
                $data['data'] = [
                            'ucid'      =>  $csat_id, 
                            'source'    =>  $request_data['source'], 
                            'cs_reason' =>  $request_data['csat_reasons'], 
                            'remarks'   =>  $request_data['description'], 
                            'rating'    =>  $request_data['rating_val'],
                            'guid'      => !empty($_COOKIE["guid"]) ? md5($_COOKIE["guid"]): '',
                        ];
            
            $csat_reasons_url       =   env('API_URL'). config('constants.saveCSAT');
            $csat_reasons_detail    =   handleGuzzleCurlRequest($csat_reasons_url, 'POST', null, $data); // API issue
          
            if(isset($csat_reasons_detail['status']) && $csat_reasons_detail['status'] && isset($csat_reasons_detail['message']))
                return response()->json([
                            'status'    =>  $csat_reasons_detail['status'],
                            'message'   =>  $csat_reasons_detail['message']
                        ], 200); 
            elseif(isset($csat_reasons_detail['message']))
                return response()->json([
                            'status'    =>  false,
                            'message'   =>  $csat_reasons_detail['message']
                        ], 433);
            else
                return response()->json([
                            'status'    =>  false,
                            'message'   =>  'Server seems busy. Please try again'
                        ], 433);        
        } catch (Exception $ex) {
            return response()->json([
                            'status'    =>  false,
                            'message'   =>  $ex->getMessage()
                        ], 500);  
        }
    }


    public function nps(){
        try {
            $data                   =   [];
            $request                =   $this->request;
            $data['booking_id']     =   $booking_id     =   $request->query('booking_id');
            $data['mobile']         =   $mobile         =   $request->query('mobile');
            $data['click_source']   =   $click_source   =   $request->query('click_source');

            if(empty($booking_id))
                throw new Exception("Booking id is missing");
            if(empty($mobile))
                throw new Exception("Mobile is missing");
            if(empty($click_source))
                throw new Exception("Click Source is missing");
            
            return view('feedback.nps_survey', $data);
        
        } catch (Exception $ex) {
            return view('404_error');
        }
    }
    
    public function saveNPS(){
        try {
            $request        =   $this->request;
            $request_data   =   $request->only([
                                        'source',
                                        'booking_id',
                                        'mobile', 
                                        'rating_val', 
                                        'click_source', 
                                        'odbookingprocess', 
                                        'catoption', 
                                        'improvement_msg'
                                    ]);
            $catoptions     =   $request_data['catoption'];
            if(is_array($catoptions) && count($catoptions) > 0){
                $request_data['categoryoptions']     =    implode(',', $catoptions);
            }
            
            $validator = Validator::make($request_data, [
                'source'            =>  'required|in:web,mobile',
                'booking_id'        =>  'required|string',
                'mobile'            =>  'required|string',
                'rating_val'        =>  'required|string',
                'click_source'      =>  'required|string',
                'odbookingprocess'  =>  'required|string',
                'categoryoptions'   =>  'required|string'               
            ]);
            if ($validator->fails()) 
                return response()->json([
                            'status'    =>  FALSE,
                            'message'   =>  $validator->errors()->first()
                        ], 433); 
            
            if(!isset($request_data['improvement_msg']))
                $request_data['improvement_msg']    =   null;
            
            $data['data'] = [
                            'booking_id'        =>  $request_data['booking_id'], 
                            'source'            =>  $request_data['source'], 
                            'mobile'            =>  $request_data['mobile'], 
                            'rating'            =>  $request_data['rating_val'],
                            'click_source'      =>  $request_data['click_source'],
                            'category'          =>  $request_data['odbookingprocess'],
                            'message'           =>  $request_data['improvement_msg'],
                            'feedback_answers'  =>  $request_data['categoryoptions'],
                            'guid'              => !empty($_COOKIE["guid"]) ? md5($_COOKIE["guid"]): '',
                        ];
            $csat_reasons_url       =   env('API_URL').config('constants.saveNPS');            
            $csat_reasons_detail    =   handleGuzzleCurlRequest($csat_reasons_url, 'POST', null, $data);
            
            if(isset($csat_reasons_detail['status']) && $csat_reasons_detail['status'] && isset($csat_reasons_detail['message']))
                return response()->json([
                            'status'    =>  true,
                            'message'   =>  $csat_reasons_detail['message']
                        ], 200); 
            elseif(isset($csat_reasons_detail['message']))
                return response()->json([
                            'status'    =>  false,
                            'message'   =>  $csat_reasons_detail['message']
                        ], 500); 
            else
                return response()->json([
                            'status'    =>  false,
                            'message'   =>  'Server busy. Please try after sometime!'
                        ], 433);        
        } catch (Exception $ex) {
            return response()->json([
                            'status'    =>  false,
                            'message'   =>  $ex->getMessage()
                        ], 500);  
        }
    }

    /**
     * This is to view Sample Collection Feedback Form
     */
    public function sampleCollectionFeedback(){
        try {
            $data                   =   [];
            $request                =   $this->request;
            $data['booking_id']     =   $booking_id     =   $request->query('booking_id');
            $data['mobile']         =   $mobile         =   $request->query('mobile');
            $data['click_source']   =   $click_source   =   $request->query('click_source');

            if(empty($booking_id))
                throw new Exception("Booking id is missing");
            if(empty($mobile))
                throw new Exception("Mobile is missing");
            if(empty($click_source))
                throw new Exception("Click Source is missing");
            
            return view('feedback.sample_collection_feedback', $data);
        
        } catch (Exception $ex) {
            return view('404_error');
        }
    }

    /**
     * This is to Save Sample Collection Feedback Form
     */
    public function saveSampleCollectionFeedback(){
        try {
            $request        =   $this->request;
            $request_data   =   $request->only([
                'source',
                'booking_id',
                'mobile', 
                'rating_val', 
                'click_source', 
                'reach_time', 
                'properly_dressed', 
                'sealed_kit',
                'tech_video'
            ]);
            
            $validator = Validator::make($request_data, [
                'source'            =>  'required|in:web,mobile',
                'booking_id'        =>  'required|string',
                'mobile'            =>  'required|string',
                'click_source'      =>  'required|string|max:20',
                'rating_val'        =>  'required|digits:1',
                'reach_time'        =>  'required|string|max:1',
                'properly_dressed'  =>  'required|string|max:1',
                'sealed_kit'        =>  'required|string|max:1',
                'tech_video'        =>  'required|string|max:1' 

            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  implode(" <br> ",$validator->messages()->all())
                ], 433);
            }
            
            $request_data['data']           =   [
                'booking_id'                =>  $request_data['booking_id'], 
                'source'                    =>  $request_data['source'], 
                'mobile'                    =>  $request_data['mobile'], 
                'click_source'              =>  $request_data['click_source'],
                'rating'                    =>  $request_data['rating_val'],
                'on_time_blood_collection'  =>  $request_data['reach_time'],
                'properly_dressed'          =>  $request_data['properly_dressed'],
                'informed_sealed_kit'       =>  $request_data['sealed_kit'],
                'show_tech_process_video'   =>  $request_data['tech_video'],
                'guid'                      => !empty($_COOKIE["guid"]) ? md5($_COOKIE["guid"]): '',
            ];
            
            $save_url       =   env('API_URL'). config('constants.saveSampleCollection');            
            $req_response   =   handleGuzzleCurlRequest($save_url, 'POST', null, $request_data);
                 
            if(!empty($req_response)) {
                if(isset($req_response['status'])) {
                    if($req_response['status']) {
                        return response()->json([
                            'status'    =>  true,
                            'message'   =>  $req_response['message']
                        ], 200);
                    }
                    else {
                        return response()->json([
                            'status'    =>  false,
                            'message'   =>  $req_response['message']
                        ], 400);
                    }
                }
                else {                    
                    return response()->json([
                        'status'    =>  false,
                        'message'   =>  $req_response['message']
                    ], 400);
                }                
            }
            else {
                throw new Exception("Something went wrong.");
            }
        } catch (Exception $ex) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  $ex->getMessage()
            ], 500);  
        }
    }
}