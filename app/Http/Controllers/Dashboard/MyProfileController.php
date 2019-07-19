<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Exception;

class MyProfileController extends Controller
{
    /**
     * This is for My Profile Page
     */
    
    public function __construct(Request $request)
    {        
        parent::__construct($request);        
        $this->middleware('auth'); 
    }
    
    public function index(){
        $route = request()->route()->getName();

        try {
            $request    = $this->request;
            $token_id   = auth()->user()->id;
            $token      = auth()->user()->token;
            $city_id    = $this->city_id;

            if(session()->has('auth_'.$token_id)){
                $userDetail = session()->get('auth_'.$token_id);
                
                $user_id    = $userDetail['user_id'];

                $api_request_data['data']   = [
                    'user_id'           => $user_id,
                    "source"            => 'web'
                ];

                $profileUrl     = env('API_URL').config()->get('constants.show_profile');
                $profileDetail  = handleGuzzleCurlRequest($profileUrl, 'POST', $token, $api_request_data);
                
                if(isset($profileDetail['status'])) {
                    $userDetail        =  $profileDetail['data'];
                    $request->session()->put('auth_'.$token_id, $userDetail);

                    $dob_date                   = date_create($userDetail['dob']);
                    $dob                        = date_format($dob_date,"d-m-Y");
                    $userDetail['display_dob']  = $dob;
                }                
            }                
            else {
                throw new Exception("User id is missing");
            }

            return view('dashboard.my_profile', ['userDetail' => $userDetail, 'route_name' => $route]); 
        } catch (Exception $ex) {
            return new Exception($ex->getMessage());
        }
    }

    public function editProfile(){
        try {
            $request        = $this->request;

            $request_data   = $request->only(['name', 'age', 'dob', 'gender']);
                
            $validator      = Validator::make($request_data, [
                'name'      =>  'required|string|max:512|min:1',
                'age'       =>  'required|numeric|min:1',
                'dob'       =>  'required|min:1',
                'gender'    =>  'required|string|max:10|min:1',
            ]);

            if ($validator->fails()) {
                $error_response = [
                    "status"    => false,
                    "message"   => implode(" <br> ",$validator->messages()->all())
                ];

                return response()->json($error_response, 400);
            }

            $token_id   = auth()->user()->id;
            $token      = auth()->user()->token;

            if(session()->has('auth_'.$token_id)){
                $userDetail         = session()->get('auth_'.$token_id);
                $user_id            = $userDetail['user_id'];
                
                //convert DOB to nysql format
                if(!empty($request_data['dob'])) {
                    $dob_date           = date_create($request_data['dob']);
                    $dob                = date_format($dob_date,"Y-m-d");
                }  

                $api_request_data['data']   = [
                    'user_id'           => $user_id,
                    "source"            => 'web',
                    "age"               => $request_data['age'],
                    "dob"               => $dob,
                    "name"              => $request_data['name'],                   
                    "gender"            => $request_data['gender'],
                    "app_version"       => "101"
                ];

                $profileSaveUrl       = env('API_URL').config()->get('constants.update_profile');
                $profileSaveDetail    = handleGuzzleCurlRequest($profileSaveUrl, 'POST', $token, $api_request_data);

                if(isset($profileSaveDetail['status'])) {
                    $userDetail['name']         =  $profileSaveDetail['data']['name'];
                    $userDetail['age']          =  $profileSaveDetail['data']['age'];
                    $userDetail['dob']          =  $profileSaveDetail['data']['dob'];
                    $userDetail['gender']       =  $profileSaveDetail['data']['gender'];
                    $userDetail['image_path']   =  $profileSaveDetail['data']['image_path'];

                    $request->session()->put('auth_'.$token_id, $userDetail);
                    return response()->json($profileSaveDetail, 200);
                }
                else {
                    throw new Exception("something went wrong");
                }
            }                
            else {
                throw new Exception("User id is missing");
            }
        } catch (Exception $ex) {
            return response()->json(["status" => false, "message" => $ex->getMessage()], 500);
        }
    }

    public function updateProfilePic(){
        try {
            $request        = $this->request;

            if(!empty($_FILES['my_pics'])) {
                if($_FILES['my_pics']['size'] == 0) {
                    $response = [
                        "status"    => false, 
                        "message"   => "Image size is more than 2 Mb. Please upload small size image."
                    ];
                    return response()->json($response, 400);
                }
            }
            
            $validator      = Validator::make($request->only('my_pics'), [
                'my_pics'   =>  'required|image|mimes:png,PNG,jpg,JPG,jpeg,JPEG,gif,GIF',                
            ]);
            
            if ($validator->fails()) {
                
                $error_response = [
                    "status"    => false,
                    "message"   => "Please upload a jpg, jpef, gif or png file."
                ];

                return response()->json($error_response, 400);
            }

            $request_data = [];

            /* Check attachment */
            if ($this->request->hasFile('my_pics')) {               
                $file    = $this->request->file('my_pics');
                $size    = $file->getSize();

                $size_mb = number_format($size / 1048576, 2);

                if($size_mb > 2) {
                    $response = [
                        "status"    => false, 
                        "message"   => "Image size is more than 2 Mb. Please upload small size image."
                    ];
                    return response()->json($response, 400);
                }
                
                $mimetype               = $file->getMimeType();

                $request_data["name"]   = $file->getClientOriginalName();            
                $file_data              = file_get_contents($file);
                $request_data["image"]  = 'data:'. $mimetype.';base64,' . base64_encode($file_data);

                $token_id               = auth()->user()->id;
                $token                  = auth()->user()->token;

                if(session()->has('auth_'.$token_id)){
                    $userDetail                 = session()->get('auth_'.$token_id);
                    $request_data["user_id"]    = $userDetail['user_id'];

                    $profilePicSaveUrl          = env('CRM_URL').config()->get('constants.update_profile_pic');
                    $profilePicSaveDetail       = handleGuzzleCurlRequest($profilePicSaveUrl, 'POST', $token, $request_data);
                    
                    if(isset($profilePicSaveDetail['status'])) {
                        $userDetail['image_path'] = $profilePicSaveDetail['data']['image'];

                        $request->session()->put('auth_'.$token_id, $userDetail);
                        return response()->json($profilePicSaveDetail, 200);
                    }
                    else {
                        throw new Exception("Something went wrong.");
                    }
                }
                else {
                    throw new Exception("User id is missing");
                }
            }
            else {
                $response = [
                    "status"    => false, 
                    "message"   => "Please upload image."
                ];
                return response()->json($response, 400);
            }
        } catch (Exception $ex) {
            return response()->json(["status" => false, "message" => $ex->getMessage()], 500);
        }
    }
}