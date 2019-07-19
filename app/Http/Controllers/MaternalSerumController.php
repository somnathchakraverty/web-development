<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Exception;

class MaternalSerumController extends Controller
{
    /**
     * Controller for maternal serum
     */

    public function __construct(Request $request)
    {
        parent::__construct($request);

        $route = request()->route()->getName();
        $this->seoDataProcess($route);
    }


    public function maternal_serum() {
        try {
            $request        =   $this->request;
            $booking_id     = $request->query('booking_id');
            $customer_id    = decryptUserSalt($request->query('customer_id'));
 
            if (!empty($booking_id) && !empty($customer_id) ) {
                $data['data']         = [
                    'booking_id'      =>  $booking_id,
                    'customer_id'     =>  $customer_id,
                    'ip'              =>  $this->request->ip()
                ];

                $api_url     = env('API_URL').config('constants.maternalFormValidate');
                $return_data = handleGuzzleCurlRequest($api_url, 'POST', null, $data);

                if(isset($return_data['status'])) {
                    if ($return_data['status']) {
                        $gender                         = $return_data['data']['gender'] == 'F' ? 'Female' : 'Male';
                        $return_data['data']['gender']  = $gender;
                        $data = [
                            'user_data'     => $return_data['data'],
                            'booking_id'    => $booking_id,
                            'customer_id'   => $request->query('customer_id')
                        ];
                        return view('maternal_serum', $data);
                    } else {
                        return view('404_error');
                    }
                }
                else {
                    throw new Exception("Something went wrong.");
                }
                
            } else {
                return view('404_error');
            }
        } catch (Exception $ex) {
            dd($ex);
            return view('404_error');
        }
    }


    public function saveMaternalData() {
        $input_field    =   $this->request->all();

        $validator      = Validator::make($input_field, [
            'tos'               => 'required|string|max:100',
            'ultrasound_date'   => 'required|max:255',
            'usg_by_week'       => 'required|numeric',
            'usg_by_day'        => 'required|numeric',
            'edd'               => 'required',
            'lmp'               => 'required',
            'ivf_pregnancy'     => 'required|numeric',
            'pregnancy_type'    => 'required|string|max:20',
            'racial_origin'     => 'required|string|max:200',
            'weight'            => 'required|numeric',  
            'height'            => 'required',          
            'dob'               => 'required',
            'diabetic'          => 'required|numeric',
            'smoking'           => 'required|numeric',
            'ntd'               => 'required|numeric',
            'ds'                => 'required|numeric',
            'scga_by_week'      => 'required',
            'scga_by_day'       => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  implode(" <br> ", $validator->messages()->all())
            ], 433);
        }

        $request_data                   = [];
        $request_data['data']           = $input_field;
        $request_data['data']['source'] = 'web';

        if($this->request->hasFile('ultrasounds')){
            $files                  =   $this->request->file('ultrasounds');
            $allowedfileExtension   =   ['pdf','jpg','jpeg' ,'png','docx'];
            
            $i              =   1;
            foreach($files as $file){
                $filename   =   $file->getClientOriginalName();
                $extension  =   $file->getClientOriginalExtension();
                $check      =   in_array($extension,$allowedfileExtension);
                
                if($check) {
                    $request_data['data']['image'.$i]  =   'data:image/' . $extension . ';base64,'.base64_encode(file_get_contents($file->path()));                  
                    $i++;
                }
            }
        }

        unset($request_data['data']['ultrasounds']);
        $request_data['data']['ip']     = $this->request->ip();
        $request_data['data']['guid']   = !empty($_COOKIE["guid"]) ? md5($_COOKIE["guid"]): '';

        try {
            $h_q_url        = env('API_URL').config()->get('constants.saveMaternalForm');
            $details        = handleCurlRequest($h_q_url, 'POST', $request_data);
     
            if(!empty($details)) {
                if(!empty($details['data']) && $details['status']) {
                    return $this->getHTTPresponse($details, 200);
                }
                else {
                    return response()->json($details, 500);
                }
            }
            else {
                throw new Exception("Something went wrong.");
            }
        } catch (Exception $ex) {
            return response()->json(["status" => false, "message" => $ex->getMessage()], 500);
        }
    }
}