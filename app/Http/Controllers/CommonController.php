<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class CommonController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
    
    public function getCallBack(){
        $this->seo->setTitle("Hello");
        return view('home.index');
    }
    
    public function getLocalityID(Request $request){
        /**
         * This is to get locality ID and check sub-locality serviceable or not
         */
        try {
            $request                  =   $this->request;
            $request_data['lat']      =   $request->query('lat');
            $request_data['long']     =   $request->query('long');
            $request_data['source']   =   'web';
            $validator  = Validator::make($request_data, [
                'lat'   =>  'required|numeric',
                'long'  =>  'required|numeric'
            ]);

            if ($validator->fails()) {
                $error_response = [
                    "status"    => false,
                    "message"   => implode(" <br> ",$validator->messages()->all())
                ];

                return response()->json($error_response, 400);
            }

            $getLocalityIDUrl       =   env('CRM_URL').config()->get('constants.getnearestlocality');
            $getLocalityIDDetail    =   handleGuzzleCurlRequest($getLocalityIDUrl, 'POST', null, $request_data);

            if(isset($getLocalityIDDetail['status'])) {
                return response()->json($getLocalityIDDetail, 200);
            }
            else {
                throw new Exception("something went wrong");
            }
            
        } catch (Exception $ex) {
            return response()->json(["status" => false, "message" => $ex->getMessage()], 500);
        }
    }
}