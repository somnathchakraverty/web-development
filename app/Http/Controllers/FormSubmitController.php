<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Exception;

class FormSubmitController extends Controller
{
    // this controller is used for All Form Submit

    public function __construct(Request $request) {
        parent::__construct($request);
    }

    public function saveContactUs(Request $request, MessageBag $message_bag) {
        /**
         * This is to Save Contact Us Form Details
         */
        
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email_id'  => 'required|email|max:255',
            'contact_no'=> 'required|digits:10',
            'company'   => 'required|string|max:255',
            'message'   => 'nullable|max:512'
        ]);
        
        if ($validator->fails()) {
            return redirect('contact-us')->withErrors($validator->messages())->withInput();
        }
        
        /* Prepare Request Data */
        $request_data = [
            "full_name" => $request->input('name'),
            "email_id"  => $request->input('email_id'),
            "mobile"    => $request->input('contact_no'),
            "company"   => $request->input('company'),
            "message"   => $request->input('message'), 
            'guid'      => !empty($_COOKIE["guid"]) ? md5($_COOKIE["guid"]): '',
        ];

        // Hit Contact Us Request 
        $contactUs_url  = env('CRM_URL').''.config()->get('constants.saveContactUs');
        $req_response   = handleGuzzleCurlRequest($contactUs_url, 'POST', null, $request_data, []);

        if(!empty($req_response)) {
            if(isset($req_response['status'])) {
                if($req_response['status']) {
                    $request->session()->flash('form_submit_success', true);
                }
                else {
                    $request->session()->flash('form_submit_error', true);
                }
            }
            else {
                $request->session()->flash('form_submit_error', true);
            }
        }
        else {
            $request->session()->flash('form_submit_error', true);
        }

        return redirect('contact-us');
    }

    public function saveLabVisit(Request $request) {
        /**
         * This is to Save Lab Visit Form Details
         */
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email_id'  => 'required|email|max:255',
            'contact_no'=> 'required|digits:10',
            'message'   => 'nullable|max:512'
        ]);
        
        if ($validator->fails()) {
            return redirect('labs')->withErrors($validator->messages())->withInput();
        }

        /* Prepare Request Data */
        $request_data   =  [
            "data"      => [
                "name"              => $request->input('name'),
                "email"             => $request->input('email_id'),
                "contact_number"    => $request->input('contact_no'),
                "message"           => $request->input('message'),
                "source"            => 'web',
                'guid'              => !empty($_COOKIE["guid"]) ? md5($_COOKIE["guid"]): '',
            ]
        ];

        // Hit Lab Visit Request 
        $saveLabVisit_url   = env('API_URL').''.config()->get('constants.saveLabVisit');
        $req_response       = handleGuzzleCurlRequest($saveLabVisit_url, 'POST', null, $request_data, []);

        if(!empty($req_response)) {
            if(isset($req_response['status'])) {
                if($req_response['status']) {
                    
                    $event_data     =   [
                        'action'    =>  'Lab visit Request',
                        'category'  =>  'Lab visit',
                        'label'     =>  $request->input('email_id'),
                        'value'     =>  $request->input('contact_no')
                    ];
                    $this->createGAEvent($request,   $event_data);
                    
                    $request->session()->flash('form_submit_success', true);
                }
                else {
                    $request->session()->flash('form_submit_error', true);
                }
            }
            else {
                $request->session()->flash('form_submit_error', true);
            }
        }
        else {
            $request->session()->flash('form_submit_error', true);
        }

        return redirect('labs');
    }

    public function saveCareer(Request $request) {
        /**
         * This is to Save Career Form Details
         */

        $base64_extension_mapping = [
            'doc' => 'data:application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'pdf' => 'application/pdf'
        ];

        $validator = Validator::make($request->all(), [
            'name'                  => 'required|string|max:255',
            'email_id'              => 'required|email|max:255',
            'contact_no'            => 'required|digits:10',
            'post_applied'          => 'required|max:100',
            'experience'            => 'required|numeric',
            'current_organization'  => 'required|max:255',
            'current_designation'   => 'required|max:255',
            'notice_period'         => 'required|max:100',
            'address'               => 'required|max:512',
            'resume'                => 'nullable|mimes:doc,docx,pdf'
        ]);
        
        if ($validator->fails()) {
            return redirect('career')->withErrors($validator->messages())->withInput();
        }

        /* Prepare Request Data */
        $request_data = [
            "full_name"             => $request->input('name'),
            "email_id"              => $request->input('email_id'),
            "mobile"                => $request->input('contact_no'),
            "post_applied"          => $request->input('post_applied'),
            "experience"            => $request->input('experience'), 
            "current_organization"  => $request->input('current_organization'),
            "current_designation"   => $request->input('current_designation'), 
            "notice_period"         => $request->input('notice_period'), 
            "address"               => $request->input('address'),
            'guid'                  => !empty($_COOKIE["guid"]) ? md5($_COOKIE["guid"]): '',
        ];

        /* Check attachment */
        if ($request->hasFile('resume')) {
            $file                       = $request->file('resume');
            $request_data["file_name"]  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $data = file_get_contents($file);
            $request_data["file"] = 'data:'. $base64_extension_mapping[$extension].';base64,' . base64_encode($data);
        }


        // Hit Career API Request 
        $careerApi_url = env('CRM_URL').''.config()->get('constants.saveCareer');
        $req_response = handleGuzzleCurlRequest($careerApi_url, 'POST', null, $request_data, []);

        if(!empty($req_response)) {
            if(isset($req_response['status'])) {
                if($req_response['status']) {
                    $request->session()->flash('form_submit_success', true);
                }
                else {
                    $request->session()->flash('form_submit_error', true);
                }
            }
            else {
                $request->session()->flash('form_submit_error', true);
            }
        }
        else {
            $request->session()->flash('form_submit_error', true);
        }

        return redirect('career');
    }


    public function saveFeedback(Request $request, MessageBag $message_bag) {
        /**
         * This is to Save Feedback Form Details
         * @todo Pending Work : If user login then send user id 
         */

        $rule = [
            'name'       => 'required|string|max:255',
            'email_id'   => 'required|email|max:255',
            'contact_no' => 'required|digits:10',
            'issue_type' => 'required',
            'message'    => 'nullable|max:512',
            'booking_id' => 'nullable|max:15'
        ];

        /* Find Booking id is required or not for Specific Booking ID */
        $booking_required   = false;
        $issue_type_details = $request->input('issue_type');
        
        if(empty($issue_type_details)) {
            $message_bag->add('issue_type', 'Query Type is required. Please select');
        }

        /* To get issue type id, we have to explode because issue type is combination of issue_type_id and department ID */
        $issue_type = explode("_", $issue_type_details);


        /* Booking Required Logic - Starts */
        $issue_type_booking = [1,2,3,4,12,22,23,25,26,27,55,78];
        if(in_array((int)$issue_type[0], $issue_type_booking)) {
            $booking_required = true;
        }
        
        if ($booking_required) {
            $booking_id = $request->input('booking_id');

            if(empty($booking_id)) {
                $message_bag->add('booking_id', 'Booking id is required. Please enter');
                return redirect('/feedback')->withErrors($message_bag)->withInput();
            }   
            
            $rule['booking_id'] = 'required|max:15';
        }
        /* Booking Required Logic - End */

        $validator = Validator::make($request->all(), $rule);
        
        if ($validator->fails()) {
            return redirect('feedback')->withErrors($validator->messages())->withInput();
        }

        /* Prepare Request Data */
        $request_data = [
            "customer_name"         => $request->input('name'),
            "email_id"              => $request->input('email_id'),
            "phone_number"          => $request->input('contact_no'),
            "internal"              => 0,
            "booking_id"            => '',
            "create_ticket_type"    => 1,
            "issue_type"            => $issue_type[0],
            "department"            => $issue_type[1],
            "ticket_priority_name"  => "medium",
            "ticket_priority_id"    => 2,
            "status"                => "1",
            "ticket_category"       => "1",
            "subject"               => "Ticket from Web",
            "format"                => "string",
            "message"               => $request->input('message'),
            "source"                => "web",
            'guid'                  => !empty($_COOKIE["guid"]) ? md5($_COOKIE["guid"]): '',
        ];

        if($issue_type[0] == 12) {
            $request_data["create_ticket_type"] =  4;
        }

        if($booking_required) {
            $request_data["booking_required"] = 1;
            $request_data["booking_id"] = (int)$booking_id;
        }
        else {
            $request_data["booking_required"] = 0;
        }

        // Hit Create Ticket Request 
        $ticketApi_url = env('CRM_URL').config()->get('constants.createTicket');
        $req_response = handleGuzzleCurlRequest($ticketApi_url, 'POST', null, $request_data, []);
        
        if(!empty($req_response)) {
            if(isset($req_response['status'])) {
                if($req_response['status']) {
                    // event fire
                    $event_data     =   [
                        'action'    =>  'Send Feedback',
                        'category'  =>  'Feedback',
                        'label'     =>  null
                    ];
                    $this->createGAEvent($request,   $event_data);
                    $request->session()->flash('form_submit_success', true);
                }
                else {
                    $request->session()->flash('form_submit_error', true);
                }
            }
            else {
                $request->session()->flash('form_submit_error', true);
            }
        }
        else {
            $request->session()->flash('form_submit_error', true);
        }

        return redirect('feedback');
    }

    
    public function savePixelFire(Request $request){
        try{
            $request_data   =   $request->only(['vendor_code', 'booking_id', 'transaction_amount', 'page_source']);
            $request_data['page_source']    =   'booking';
            $validator = Validator::make($request_data, [
                'vendor_code'           =>  'required|string|max:255',
                'booking_id'            =>  'required|numeric',
                'transaction_amount'    =>  'required|numeric',
                'page_source'           =>  'required|string'
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                        'status'    =>  false,
                        'message'   =>  $validator->errors()->first()
                    ], 433); // Status code here
            }
            $vendor_url  = env('CRM_URL').config()->get('constants.vendorPixel');
           
            $req_response = handleCurlRequest($vendor_url, 'POST', $request_data);         
            
            return $req_response;
                
        } catch (Exception $ex) {
            return response()->json([
                        'status'    =>  false,
                        'message'   =>  $ex->getMessage()
                    ], 500); // Status code here
        }
    }
    
    public function saveLead(Request $request) {
        try{
            $input_field    =   $request->all();
            if(auth()->check()){
                $token_id = auth()->user()->id;
                $token = auth()->user()->token;

                if(session()->has('auth_'.$token_id)){
                    $user_info                  =   session()->get('auth_'.$token_id);
                    $input_field['name']        =   $user_info['name'];
                    $input_field['contact_no']  =   $user_info['mobile'];
                }
            }
            /**
             * This is to Save Contact Us Form Details
             */
            $validator = Validator::make($input_field, [
                'name' => 'required|string|max:255',
                'contact_no'=> 'required|digits:10',
                'utm_id' => 'required|string|max:50',
                'source' => 'required|string|max:50'
            ]);
            if ($validator->fails()) {
                return response()->json([
                        'status'    =>  false,
                        'message'   =>  $validator->errors()->first()
                    ], 433); // Status code here
            }

            $request_data = $request->only(['vendor_code', 'name', 'contact_no', 'utm_id', 'source', 'utm_source', 'utm_campaign', 'utm_medium']);
            $request_data['mobile'] = $request_data['contact_no'];

            $request_data['ip']     = $request->ip();
            $request_data['guid']   = !empty($_COOKIE["guid"]) ? md5($_COOKIE["guid"]): '';

            $data['data'] = $request_data;
            $compaign_url = env('API_URL').config()->get('constants.saveEmailCompaignData');
            
            $req_response = handleCurlRequest($compaign_url, 'POST', $data);
            
            if(isset($req_response['new_lead']) && $req_response['new_lead'] && isset($request_data['vendor_code']) && !empty($request_data['vendor_code'])){
                $vendor_url  = env('CRM_URL').config()->get('constants.vendorPixel');
                $data = [
                    "vendor_code"   =>  $request_data['vendor_code'],
                    "page_source"   =>  "landing",
                    "lead_id"       =>  $req_response['lead_id'],
                    'guid'          =>  !empty($_COOKIE["guid"]) ? md5($_COOKIE["guid"]): '',
                    'ip'            =>  $request->ip()
                ];
                $vendor_response = handleCurlRequest($vendor_url, 'POST', $data);    
                if($vendor_response['status'] ){
                    $req_response['data'] = $vendor_response['data'];            
                    return $req_response;
                }else{
                    return $req_response;
                }
            }elseif($req_response['status'])
                return $req_response;
            else
                throw new Exception("something went wrong");
        
        } catch (Exception $ex) {
            return response()->json([
                        'status'    =>  false,
                        'message'   =>  $ex->getMessage()
                    ], 500); // Status code here
        }
    }

    public function saveEmailSubscription(Request $request) {
        try{
            /**
             * This is to Save Contact Us Form Details
             */
            $validator = Validator::make($request->all(), [
                'email_id' => 'required|email|max:255'
            ]);

            if ($validator->fails()) {
                return $this->getHTTPresponse($validator->errors(), 433);
            }

            $email_id       = $request->input('email_id');

            /* Prepare API Request Data */
            $request_data   =  [
                'email'     => $email_id,
                'guid'      => !empty($_COOKIE["guid"]) ? md5($_COOKIE["guid"]): '',
                'ip'        => $request->ip()
            ];            

            // Hit subscribeNewsLetter API Request 
            $subscribeNewsLetter_url    = env('CRM_URL').config()->get('constants.saveSubscribeNewsLetter');
            $req_response               = handleGuzzleCurlRequest($subscribeNewsLetter_url, 'POST', null, $request_data, []);
            
            if(!empty($req_response)) {
                return $req_response;
            }
            else {
                throw new Exception("Something went wrong.");
            }
        } catch (Exception $ex) {
            return response()->json($ex->getMessage(), 500);
        }
    }
    
    public function emailUnSubscription($email) {
        $request  =   $this->request;
        
        try{
            $request_data['data_value']     =   $email;
            $request_data['type']           =   !empty($request->query('type')) ? $request->query('type') : 'email';
            $request_data['source']         =   !empty($request->query('source')) ? $request->query('source') : 'web';
            
            $data = [
                'message' => 'You have been successfully Unsubscribed'
            ];

            /**
             * This is to Save Contact Us Form Details
             */
            $validator = Validator::make($request_data, [
                'data_value'    =>  'required|email|max:255'
            ]);

            if ($validator->fails()) {
                return view('404_error');
            }

            // Hit subscribeNewsLetter API Request 
            $unSubscribe_url    =   env('CRM_URL').config()->get('constants.emailUnSubscribe');
            $req_response       =   handleGuzzleCurlRequest($unSubscribe_url, 'POST', null, $request_data);

            if(!empty($req_response)) {
                if(isset($req_response['status'])) {
                    if($req_response['status']) {
                        $data['message'] = $req_response['message'];
                        return view('internal.unsubscription', $data);
                    }
                    else {
                        $data['error_message'] = $req_response['message'];
                        return view('404_error', $data);
                    }
                }
                else {                    
                    $data['error_message'] = $req_response['message'];
                    return view('404_error', $data);
                }                
            }
            else {
                throw new Exception("Something went wrong.");
            }
        } catch (Exception $ex) {
            return view('404_error');
        }
    }

    /**
     * This is to Save Landing Page Lead Details
     */
    public function saveLandingPageLead(Request $request) {
        try{
            $input_field    =   $request->all();
            
            if(!empty($request->input('source'))) {
                if($request->input('source') == 'web') {
                    $validator  = Validator::make($input_field, [
                        'name'          => 'required|string|max:255',
                        'contact_no'    => 'required|digits:10',
                        'email_id'      => 'nullable|email|max:255',
                        'utm_id'        => 'required|string|max:50',
                        'city'          => 'required|string|max:50',
                        'source'        => 'required|string|max:50',
                        'message'       => 'nullable|string|max:255',
                        'utm_source'    => 'nullable|string|max:255',
                        'utm_campaign'  => 'nullable|string|max:255',
                        'utm_medium'    => 'nullable|string|max:255',
                        'publisher_id'  => 'nullable|string|max:255'
                    ]);
                }
                else {
                    /** Mobile form validation */
                    $validator  = Validator::make($input_field, [
                        'customer_name'     => 'required|string|max:255',
                        'customer_mobile'   => 'required|digits:10',
                        'customer_email'    => 'nullable|email|max:255',
                        'utm_id'            => 'required|string|max:50',
                        'customer_city'     => 'required|string|max:50',
                        'source'            => 'required|string|max:50',
                        'message'           => 'nullable|string|max:255',
                        'utm_source'        => 'nullable|string|max:255',
                        'utm_campaign'      => 'nullable|string|max:255',
                        'utm_medium'        => 'nullable|string|max:255',
                        'publisher_id'      => 'nullable|string|max:255'
                    ]);
                }                
            }
            else {
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  "Source is required"
                ], 433);
            }

            if ($validator->fails()) {
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  implode(" <br> ",$validator->messages()->all())
                ], 433);
            }

            $request_data = [];

            if($request->input('source') == 'web') {
                if(!empty($request->input('name'))) {
                    $request_data['name']   = $request->input('name');
                }
                else {
                    throw new Exception("Name is required.");
                }

                if(!empty($request->input('contact_no'))) {
                    $request_data['mobile'] = $request->input('contact_no');
                }
                else {
                    throw new Exception("Mobile No. is required.");
                }

                if(!empty($request->input('email_id'))) {
                    $request_data['email'] = $request->input('email_id');
                }
    
                if(!empty($request->input('city'))) {
                    $request_data['city'] = $request->input('city');
                }
            }
            else {
                if(!empty($request->input('customer_name'))) {
                    $request_data['name']   = $request->input('customer_name');
                }
                else {
                    throw new Exception("Name is required.");
                }

                if(!empty($request->input('customer_mobile'))) {
                    $request_data['mobile'] = $request->input('customer_mobile');
                }
                else {
                    throw new Exception("Mobile No. is required.");
                }

                if(!empty($request->input('customer_email'))) {
                    $request_data['email'] = $request->input('customer_email');
                }
    
                if(!empty($request->input('customer_city'))) {
                    $request_data['city'] = $request->input('customer_city');
                }
            }

            if(!empty($request->input('utm_id'))) {
                $request_data['utm_id'] = $request->input('utm_id');
            }
            else {
                throw new Exception("UTM ID is required.");
            }            

            $request_data['source'] = 'web';
            
            if(!empty($request->input('message'))) {
                $request_data['message'] = $request->input('message');
            }

            if(!empty($request->input('utm_source'))) {
                $request_data['utm_source'] = $request->input('utm_source');
            }

            if(!empty($request->input('utm_campaign'))) {
                $request_data['utm_campaign'] = $request->input('utm_campaign');
            }
            
            if(!empty($request->input('utm_medium'))) {
                $request_data['utm_medium'] = $request->input('utm_medium');
            }
            
            if(!empty($request->input('publisher_id'))) {
                $request_data['publisher_id'] = $request->input('publisher_id');
            }

            $request_data['ip']   = $request->ip();
            $request_data['guid'] = !empty($_COOKIE["guid"]) ? md5($_COOKIE["guid"]): '';

            $final_request_data['data'] = $request_data;
            $compaign_url               = env('API_URL').config()->get('constants.saveEmailCompaignData');
            $req_response               = handleCurlRequest($compaign_url, 'POST', $final_request_data);

            if(isset($req_response['new_lead']) && $req_response['new_lead'] && isset($request_data['utm_id']) && !empty($request_data['utm_id'])){
                $vendor_url         = env('CRM_URL').config()->get('constants.vendorPixel');
                $data               = [
                    "vendor_code"   =>  $request_data['utm_id'],
                    "page_source"   =>  "landing",
                    "lead_id"       =>  $req_response['lead_id']
                ];
                $vendor_response    = handleCurlRequest($vendor_url, 'POST', $data);    
                
                if($vendor_response['status']) {
                    if(!empty($vendor_response['data'])) {
                        $req_response['data'] = $vendor_response['data'];        
                    }                        
                    return $req_response;
                }
                else {
                    return $req_response;
                }
            }
            elseif ($req_response['status']) {
                return $req_response;
            }                
            else {
                throw new Exception($req_response['message']);
            }                
        } catch (Exception $ex) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  $ex->getMessage()
            ], 500); // Status code here
        }
    }
}
