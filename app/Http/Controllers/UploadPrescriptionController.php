<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class UploadPrescriptionController extends Controller
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
    
    public function getOTPDetail(){
        try{
            $request        =   $this->request;
            $request_input  =   $request->only('mobile_number', 'template');
            $validator = Validator::make($request_input, [
                'mobile_number' => 'required|digits:10'
            ]);
            $request_input['template']  =   'prescription';
            if ($validator->fails()) {
                return response()->json(['status' => false, 'error' => implode(", ",$validator->messages()->all())]);
            }
            
            $generate_url = env('CRM_URL').config()->get('constants.generateOTP');
            
            $rq_response = handleCurlRequest($generate_url, 'POST', $request_input);
           
            if($rq_response['status'] == true && $rq_response['message'] == 'OTP generated'){
                
                
                /* For Analytics - Upload Prescription */
                $event_data     =   [
                    'action'    =>  'Request OTP',
                    'category'  =>  'Upload Prescription',
                    'label'     =>  $request_input['mobile_number']
                ];
                $this->createGAEvent($this->request,   $event_data);
                
                return response()->json(['status' => true]); 
            }elseif(!$rq_response['status'] && isset($rq_response['message'])){
                throw new Exception($rq_response['message']);
            }else{
                throw new Exception('Otp not generated. Try again');
            }
        } catch (Exception $ex) {
            return response()->json(['status' => false, 'error' => $ex->getMessage()]);
        }
    }
    
    public function uploadPrescription(){
        try{            
            $request    =   $this->request;
            $request_input  =   $request->only('name', 'mobile_number', 'files', 'source', 'token');
            if(auth()->check()){
                $token_id   =   auth()->user()->id;
                $request_input['token'] = auth()->user()->token;
                if(session()->has('auth_'.$token_id)) {
                    $user_detail    =   session()->get('auth_'.$token_id);
                    $request_input['name']          =   $user_detail['name'];
                    $request_input['mobile_number'] =   $user_detail['mobile'];
                }
            }
            
            $validator  =   Validator::make($request_input, [
                'name'          =>  'required',
                'mobile_number' =>  'required|digits:10',
                'files'         =>  'required',
                'source'        =>  'required',
                'token'         =>  'required|string'
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'error' => implode(", ",$validator->messages()->all())]);
            }
            if(count($request->file('files')) > 3){
                return response()->json(['status' => false, 'data' => 'Maximum 3 prescription can be uploaded']);
            }elseif(count($request->file('files')) == 0){
                return response()->json(['status' => false, 'data' => 'Minimum 1 prescription can be uploaded']);
            }
            
            $generate_url   =   env('CRM_URL').config()->get('constants.upload_prescription');
//            $generate_url   =   'http://demo.crm.com/'.config()->get('constants.upload_prescription');
            $data['name']   =   $request_input['name'];
            $data['source'] =   $request_input['source'];
            $data['mobile'] =   $request_input['mobile_number'];
            if($request->hasFile('files')){
                $allowedfileExtension   =   ['pdf','jpg','jpeg' ,'png','docx'];
                $files          =   $request->file('files');
                $i  =   1;
                foreach($files as $file){
                    $filename   =   $file->getClientOriginalName();
                    $extension  =   $file->getClientOriginalExtension();
                    $check      =   in_array($extension,$allowedfileExtension);

                    if($check){
                        $data['image'.$i]  =   'data:image/' . $extension . ';base64,'.base64_encode(file_get_contents($file->path()));
                        $i++;
                    }
                }
            }
            $rq_response    =   handleGuzzleCurlRequest($generate_url, 'POST', null, $data);
            if(isset($rq_response['status']) && $rq_response['status']){
                $request->session()->flash('prescription_uploaded', 'success');
                return response()->json([
                                    'status'    =>  true,
                                    'message'   =>  $rq_response['status'],
                                    'url'       =>  route('prescription-thanku')
                                ], 200);
            }elseif(isset($rq_response['message'])){
                return response()->json([
                                    'status'    =>  false,
                                    'message'   =>  $rq_response['message']
                                ], 500);
            }else{
                return response()->json([
                                    'status'    =>  false,
                                    'message'   =>  'Server seems busy. Please Try after sometime!'
                                ], 500);
            }
          
        } catch (Exception $ex) {
            return response()->json([
                                    'status'    =>  false,
                                    'message'   =>  $ex->getMessage()
                                ], 500);
        }
    }
    
    public function prescription(){
        try{      
            $data['is_loggedin']    =   false;
            if(auth()->check()){
                $token_id = auth()->user()->id;
                if(session()->has('auth_'.$token_id)){
                    $data    =   session()->get('auth_'.$token_id);
                    $data['is_loggedin']    =   true;
                }
            }
            return view('common.upload-prescription', $data);  
        } catch (Exception $ex) {
            return back()->withErrors($ex->getMessage());
        }
    }
    
    public function thankyouPage(){
        try{
            if(!session()->has('prescription_uploaded')){
                return redirect()->route('prescription'); 
            }elseif(session()->get('prescription_uploaded') == 'success'){
                return view('common.thankyou-page');  
            }else{
                return redirect()->redirect('prescription'); 
            }
        } catch (Exception $ex) {
            return back()->withErrors($ex->getMessage());
        }
    }
}