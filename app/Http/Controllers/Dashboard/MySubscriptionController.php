<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;
use Exception;

class MySubscriptionController extends Controller
{
    /**
     * This is for My Subscription Page
     */
    
    public function __construct(Request $request)
    {   
        parent::__construct($request);        
        $this->middleware('auth');
    }
    
    public function index(){
        try {
            $request    = $this->request;
            $token_id   = auth()->user()->id;
            $token      = auth()->user()->token;
            $city_id    = $this->city_id;

            if(session()->has('auth_'.$token_id)){
                $userDetail = session()->get('auth_'.$token_id);
            }                
            else {
                throw new Exception("User id is missing");
            }

            return view('dashboard.my_subscription', ['userDetail' => $userDetail]); 
        } catch (Exception $ex) {
            return new Exception($ex->getMessage());
        }
    }
}