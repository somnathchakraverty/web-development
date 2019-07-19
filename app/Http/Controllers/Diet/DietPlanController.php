<?php

namespace App\Http\Controllers\Diet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Exception;

class DietPlanController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request) {
        parent::__construct($request);
        $this->middleware('auth');
    }
   
    public function displayDiet(){
        /**
         * This is to show Diet Plan page
         */
        try {
            $request    = $this->request;
            $token_id   =   auth()->user()->id;
            $token      = auth()->user()->token;
            //print_r(session()->get('auth_'.$token_id));die;
            if(session()->has('auth_'.$token_id)){
                $user_detail    =   session()->get('auth_'.$token_id);
                $user_id        =   session()->get('auth_'.$token_id)['user_id'];
                $name      =   session()->get('auth_'.$token_id)['name'];
            }
            else {
                throw new Exception("User id is missing");
            }
            

           
            
            $data = [
                'city_detail'           => $this->city_detail,
                'ga_category'           => 'diet',
                'ga_mobile_category'    => 'diet-mob',
                'name'             => $name,
                'savedDietDisease' => [],
                'diseases_list' => [],
                'savedDietPreference' => []
            ];

            $data['diet_plans'] = [];
            $data['calories']= [];
            $requestParam['data']   =   [
                'user_id'           =>  $user_id,
                'source'            =>  'web',
            ];
            


            $getSavedDietPreferenceUrl  = config()->get('constants.api_url').config()->get('constants.getSavedDietPreference'); 
            $getSavedDietPreferenceDetails   = handleGuzzleCurlRequest($getSavedDietPreferenceUrl, 'POST', $token, $requestParam);
            //dd($getSavedDietPreferenceDetails);
            if(isset($getSavedDietPreferenceDetails['status']) && $getSavedDietPreferenceDetails['status']) 
            {
                if(isset($getSavedDietPreferenceDetails['data']) && $getSavedDietPreferenceDetails['data'])
                {
                    $data['savedDietPreference'] = $getSavedDietPreferenceDetails['data'];
                    $data['savedDietDisease'] = ($getSavedDietPreferenceDetails['data']['disease']) ? json_decode($getSavedDietPreferenceDetails['data']['disease'], true) : [];
                }
               
            }

            if($request->input('edit') != true)
            {
                if($data['savedDietPreference'] && $data['savedDietPreference'])
                {
                  return redirect('diet/recommended');
                }
            }
            

            $disease_list_url       = config()->get('constants.api_url').config()->get('constants.getAllDiseaseList');
            $disease_list_details   = handleGuzzleCurlRequest($disease_list_url, 'POST', $token, $requestParam);
            //dd($disease_list_details);
            if(isset($disease_list_details['status'])) {
                if($disease_list_details['status']) {
                    if(!empty($disease_list_details['data']['diseases'])) {
                        $data['diseases_list'] = $disease_list_details['data']['diseases'];
                    }
                    else {
                        throw new Exception("Something went wrong");
                    }                    
                }
                else {
                    throw new Exception("Something went wrong");
                }
            }

            $get_calorie_and_food_type_url  = config()->get('constants.api_url').config()->get('constants.getCalorieAndFoodType');
            $food_type_details              = handleGuzzleCurlRequest($get_calorie_and_food_type_url, 'POST', $token, $requestParam);
            //dd($food_type_details);
            if(isset($food_type_details['status'])) {
                if($food_type_details['status']) {
                    if(!empty($food_type_details['data']['diet_plans'])) {
                        $data['diet_plans'] = $food_type_details['data']['diet_plans'];
                        $data['calories'] = $food_type_details['data']['calories'];
                    }
                    else {
                        throw new Exception("Something went wrong");
                    }                    
                }
                else {
                    throw new Exception("Something went wrong");
                }
            }

            
   
            return view('diet.diet_plan', $data);
            
        } catch (Exception $ex) {
            //echo $ex->getMessage(); die;
            return view('404_error');
        }
    }


    public function saveDietPlan()
    {
        /**
         * This is to Save Contact Us Form Details
         */
        try {
            $request    = $this->request;

            $validator  = Validator::make($request->all(), [
                'food_type'   =>  'required|numeric',
                'calorie'  =>  'required|numeric',
                'notification_status' => 'required'
                // 'disease' => 'required|array'
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
                $userDetail             = session()->get('auth_'.$token_id);
                $user_id                = $userDetail['user_id'];
                
                $request_data['data']   = [
                    'user_id'           => $user_id, 
                    "food_type_id"      => $request->input('food_type'),
                    "calorie_plan_id"   => $request->input('calorie'),
                    "disease_list"      => "",
                    "notification_status" =>$request->input('notification_status'),
                    "source"            => 'web'
                ];

                if(!empty($request->input('disease')))
                {
                    $request_data['data']['disease_list'] = json_encode($request->input('disease'));
                }

                //echo json_encode($request_data);die;
                $saveDietPlanUrl       = config()->get('constants.api_url').config()->get('constants.saveDietPlan');
                $saveDietPlanDetails    = handleGuzzleCurlRequest($saveDietPlanUrl, 'POST', $token, $request_data);
                
                if(isset($saveDietPlanDetails['status'])) {
                    return response()->json($saveDietPlanDetails, 200);
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

    public function recommended()
    {
        /**
        * This is to show Diet Plan page
        */
        try {

            $data = [];
            $data['active'] = 0;
            $data['id_active'] = "";
            $data['reasonData']= [];
            $data['food_type_image']= "";
            $data['disease_str'] = "";
            $data['savedDietPreference'] = [];
            $data['savedDietDisease'] = [];
            $request = $this->request;
            
            $token_id   =   auth()->user()->id;
            $token      = auth()->user()->token;

            if(session()->has('auth_'.$token_id)){
                $user_detail    =   session()->get('auth_'.$token_id);
                $user_id        =   session()->get('auth_'.$token_id)['user_id'];
            }
            else {
                throw new Exception("User id is missing");
            }
            
            $requestData['data'] =[
                'user_id' =>  $user_id,
                'source' =>"web"
            ];
            $getSavedDietPreferenceUrl  = config()->get('constants.api_url').config()->get('constants.getSavedDietPreference'); 
            $getSavedDietPreferenceDetails   = handleGuzzleCurlRequest($getSavedDietPreferenceUrl, 'POST', $token, $requestData);
            //dd($getSavedDietPreferenceDetails);
            if(isset($getSavedDietPreferenceDetails['status']) && $getSavedDietPreferenceDetails['status']) 
            {
                if(isset($getSavedDietPreferenceDetails['data']) && $getSavedDietPreferenceDetails['data'])
                {
                    $data['savedDietPreference'] = $getSavedDietPreferenceDetails['data'];
                    $data['savedDietDisease'] = ($getSavedDietPreferenceDetails['data']['disease']) ? json_decode($getSavedDietPreferenceDetails['data']['disease'], true) : [];
                }
               
            }
            if($data['savedDietPreference'])
            {
                $request['food_type_val'] = $data['savedDietPreference']['food_type_value'];
                $request['food_type'] = $data['savedDietPreference']['food_type_id'];
                $request['calorie_id'] = $data['savedDietPreference']['calorie_plan_id'];
                $request['calorie_val'] = $data['savedDietPreference']['calorie_plan_value'];
                $request['disease_all'] = json_decode($data['savedDietPreference']['disease'], true);
            }  
            
            $data['food_type_val'] = $request->input('food_type_val');
            $data['food_type'] = $request->input('food_type');
            $data['calorie_plans_id'] = $request->input('calorie_id');
            $data['calorie_plans'] = $request->input('calorie_val');
            $data['disease'] = $request->input('disease_all');
            //print_r($data['disease']);die;
            if($data['disease']){

                $data['disease_str'] = implode(', ', array_column($data['disease'],'disease_name'));
            }   
           
            switch ($data['food_type']) 
            {
                case '1':
                    $data['food_type_image'] = "Recommended-img.png";
                    break;
                case '2':
                    $data['food_type_image'] = "Recommended-img_nonveg.png";
                    break;
                case '3':
                    $data['food_type_image'] = "Recommended-img_egg.png";
                    break;                
            }


            $requestParam['data'] =[
                'user_id' =>  $user_id
            ];
            
            $dietDislikeReasonsURL  = config()->get('constants.api_url').config()->get('constants.getDietDislikeReasons');
            $dietDislikeReasonsDetails              = handleGuzzleCurlRequest($dietDislikeReasonsURL, 'GET', $token, $requestParam);
            //dd($dietDislikeReasonsDetails);
            if(isset($dietDislikeReasonsDetails['status'])) {
                if($dietDislikeReasonsDetails['status']) {
                    if(!empty($dietDislikeReasonsDetails['data'])) {
                        $data['reasonData'] = $dietDislikeReasonsDetails['data'];
                    }
                }
            }

            $requestParam   =   [

                'user_id'           => $user_id,
                'food_type'         => $request->input('food_type'),
                'disease_list'      => json_encode($request->input('disease_all')),
                'calorie_plans'     => $request->input('calorie_id'),
                'source' => "web"

            ];
            
            //echo json_encode($requestParam);die;


            $getDietPlansURL  = config()->get('constants.crm_url').config()->get('constants.getDietPlans');
            $getDietPlansDetails              = handleGuzzleCurlRequest($getDietPlansURL, 'POST', $token, $requestParam);
            //dd($getDietPlansDetails);
            if(isset($getDietPlansDetails['status'])) {
                if($getDietPlansDetails['status']) {
                    if(!empty($getDietPlansDetails['data'])) {
                        $data['diet_today'] = (isset($getDietPlansDetails['data'][0])) ? $getDietPlansDetails['data'][0] : [];
                        $data['diet_tomorrow'] = (isset($getDietPlansDetails['data'][1])) ? $getDietPlansDetails['data'][1] : [];
                        
                    }
                    else {
                        throw new Exception("Something went wrong");
                    }  

                $data['like_dislike_exist'] = (isset($getDietPlansDetails['like_dislike_exist'])) ? $getDietPlansDetails['like_dislike_exist'] : false;                  
                }
                else {
                    throw new Exception("Something went wrong");
                }
            }


           
            return view('diet.recommended', $data);
            
        } catch (Exception $ex) {
            echo $ex->getMessage().$ex->getLine();die;
            return view('404_error');
        }
    }


    public function likeDietPlan()
    {
        /**
         * This is to Save Contact Us Form Details
         */
        try {
            $request    = $this->request;
            $validator  = Validator::make($request->all(), [
                'doctor_diet_detail' => 'required'
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
                $userDetail             = session()->get('auth_'.$token_id);
                $user_id                = $userDetail['user_id'];
                
                $request_data['data']   = [
                    'user_id'           => $user_id, 
                    "customer_id"       => $user_id, 
                    "diet_like"         => 1,
                    "doctor_diet_detail" => str_replace("&quot;",'"', $request->input('doctor_diet_detail')),
                    "source"            => 'web'
                ];

                $likeDietPlanURL       = config()->get('constants.api_url').config()->get('constants.likeDietPlan');
                $likeDietPlanDetails    = handleGuzzleCurlRequest($likeDietPlanURL, 'POST', $token, $request_data);
                
                if(isset($likeDietPlanDetails['status'])) {
                    return response()->json($likeDietPlanDetails, 200);
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

    public function dislikeDietPlan()
    {
        /**
         * This is to Save Contact Us Form Details
         */
        try {
            $request    = $this->request;

            $validator  = Validator::make($request->all(), [
                'doctor_diet_detail' => 'required',
                'dislike_reason_id' => 'required'
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
                $userDetail             = session()->get('auth_'.$token_id);
                $user_id                = $userDetail['user_id'];
                
                $request_data['data']   = [
                    'user_id'           => $user_id, 
                    "customer_id"       => $user_id, 
                    "diet_like"         => 0,
                    "doctor_diet_detail" => str_replace("&quot;",'"', $request->input('doctor_diet_detail')),
                    "dislike_reason_id" => json_encode($request->input('dislike_reason_id')),
                    "source"            => 'web'
                ];

                $likeDietPlanURL       = config()->get('constants.api_url').config()->get('constants.likeDietPlan');
                $likeDietPlanDetails    = handleGuzzleCurlRequest($likeDietPlanURL, 'POST', $token, $request_data);
                
                if(isset($likeDietPlanDetails['status'])) {
                    return response()->json($likeDietPlanDetails, 200);
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

    public function getAlterDietPlan()
    {
        /**
         * This is to Save Contact Us Form Details
         */
        try {
            $request    = $this->request;

            $validator  = Validator::make($request->all(), [
                'slot_id' => 'required',
                'calorie_plans' => 'required',
                'food_type' => "required",
                'combo_id' => "required"
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
                $userDetail             = session()->get('auth_'.$token_id);
                $user_id                = $userDetail['user_id'];
                
                $request_data   = [
                    'user_id'           => $user_id, 
                    "slot_id"       => $request->input('slot_id'), 
                    "calorie_plans"   => $request->input('calorie_plans'),
                    "food_type" => $request->input('food_type'),
                    "combo_id" => $request->input('combo_id'),
                    "source"            => 'web'
                ];

                $getAltDietUrl       = config()->get('constants.crm_url').config()->get('constants.getDietPlans');
                $getAltDietDetails    = handleGuzzleCurlRequest($getAltDietUrl, 'POST', $token, $request_data);
                
                if(isset($getAltDietDetails['status'])) 
                {
                    return response()->json($getAltDietDetails, 200);
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
    
}