<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\LandingCrudMaster;
use Exception;

class LandingController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request) {
        parent::__construct($request);
    }

    public function getLandingPageDetail($link_rewrite, $utm_id = null) {
        try{
            $request                        =   $this->request;
            $landingMaster                      =   LandingCrudMaster::where([
                                                    'link_rewrite'  =>  $link_rewrite,
                                                    'status'        =>  true
                                                ])->firstOrFail();
            $data                           =   $landingMaster->toArray();
            $data['city_detail']            =   $this->city_detail;
            $data['utm_id']                 =   $utm_id;
            $data['ga_category']            =   'web-health-test-campaign';
            $data['ga_mobile_category']     =   'web-health-test-campaign';
            
            $data['email_id']       =   $request->query('email');
            $data['name']           =   $request->query('name');
            $data['contact_no']     =   $request->query('mobile');
            $data['comment']        =   $request->query('comment');
            $data['utm_source']     =   $request->query('utm_source');
            $data['utm_campaign']   =   $request->query('utm_campaign');
            $data['utm_medium']     =   $request->query('utm_medium');
            $data['publisher_id']   =   $request->query('publisher_id');
            $data['source']         =   'web';
            
            $data['description']    =   str_replace("[site_url]",   route('home'),   str_replace('\"', '"' , str_replace("\'", "'" , $data['description'])));
            
            $robots     =   '';
            if(isset($data['robot_index'])) {
                if($data['robot_index'] == 1) {
                    $robots     .=  'index, ';
                }
                else {
                    $robots     .=  'noindex, ';
                }
            }
            else {
                $robots         .=  'noindex, ';
            }
            
            if(isset($data['robot_follow'])) {
                if($data['robot_follow'] == 1) {
                    $robots     .=  'follow';
                }
                else {
                    $robots     .=  'nofollow';
                }
            }
            else {
                $robots         .=  'nofollow';
            }
            $data['robots']     =   $robots;
            return view('landing_pages.dynamic_landing', $data);
        } catch (Exception $ex) {
            return view('404_error');
        }
    }

}
