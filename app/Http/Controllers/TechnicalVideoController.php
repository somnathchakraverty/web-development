<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Exception;

class TechnicalVideoController extends Controller
{
    /**
     * This is for Technical Video Page
     */
    
    public function __construct(Request $request)
    {       
        parent::__construct($request);

        $route = request()->route()->getName();
        $this->seoDataProcess($route);
    }
    
    public function index(){
        /**
         * This is for Technical Video Page
         */
        try {
            $request    = $this->request;
            $data = [
                'video_url' => 'https://www.youtube.com/embed/NVR-Fynj8PM'
            ];

            // get Technical Video URL
            $video_url      = env('API_URL'). config('constants.getTechVideo');
            $video_detail   = handleGuzzleCurlRequest($video_url, 'GET', null, []);

            if(isset($video_detail['status'])) {
                if(!empty($video_detail['data']) && $video_detail['status'] == 'success') {
                    $data['video_url'] = $video_detail['data'];                    
                }
            }
            
            return view('technical_video', $data);
        } catch (Exception $ex) {
            return new Exception($ex->getMessage());
        }
    }

    public function trackVideoInfo(){
        /**
         * This is for track Video Info
         */
        try {
            $request    = $this->request;

            $validator  = Validator::make($request->all(), [
                'booking_id'    =>  'required|numeric|min:1',
                'mobile'        =>  'required|digits:10',
                'source'        =>  'required|string|min:1|max:20'
            ]);

            if ($validator->fails()) {
                $error_response = [
                    "status"    => false,
                    "message"   => implode(" <br> ",$validator->messages()->all())
                ];

                return response()->json($error_response, 400);
            }

            $request_data['data']   = [
                'booking_id'        => $request['booking_id'], 
                "mobile"            => $request['mobile'],
                "source"            => 'web',
                "video_start_time"  => date("Y-m-d h:i:s"),
                "video_end_time"    => "null",
                "video_duration"    => "",
				"video_seen"        => "1"
            ];
            
            $trackVideoUrl       = env('API_URL').config()->get('constants.trackVideo');
            
            $trackVideoDetail    = handleGuzzleCurlRequest($trackVideoUrl, 'POST', null, $request_data);

            if(isset($trackVideoDetail['status'])) {
                return response()->json($trackVideoDetail, 200);
            }
            else {
                throw new Exception("Something went wrong");
            }
        } catch (Exception $ex) {
            return response()->json(["status" => false, "message" => $ex->getMessage()], 500);
        }
    }


}