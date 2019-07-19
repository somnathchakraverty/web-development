<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class CrudLandingController extends Controller
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
   
    public function healthCheckup($link_rewrite, $utm_id = null){
        /**
         * This is to get locality ID and check sub-locality serviceable or not
         * eg : https://www.healthians.com/health-checkup/thyroid-profile/google
         */
        try {
            $request                  =   $this->request;

            if (empty($link_rewrite)) {
                throw new Exception("Link Rewrite is missing");
            }
     
            $data = [
                'city_detail'           => $this->city_detail,
                'utm_id'                => $utm_id,
                'ga_category'           => 'web-health-checkup-campaign',
                'ga_mobile_category'    => 'web-health-checkup-campaign-mob'
            ];

            $data['email_id']       =   $request->query('email');
            $data['name']           =   $request->query('name');
            $data['contact_no']     =   $request->query('mobile');
            $data['comment']        =   $request->query('comment');
            $data['utm_source']     =   $request->query('utm_source');
            $data['utm_campaign']   =   $request->query('utm_campaign');
            $data['utm_medium']     =   $request->query('utm_medium');
            $data['publisher_id']   =   $request->query('publisher_id');
            $data['source']         =   'web';

            if(empty($utm_id)) {
                $data['utm_id']  = 'web-health-checkup-campaign';         
            }

            if(!empty($link_rewrite)) {

                $requestParam = [
                    'link_rewrite'  => $link_rewrite,
                    'source'        => 'web'
                ];

                $lead_page_url      = env('CRM_URL').config()->get('constants.lead_page_management');
                $lead_page_details  = handleGuzzleCurlRequest($lead_page_url, 'GET', null, [], $requestParam);

                if(isset($lead_page_details['status'])) {
                    if($lead_page_details['status']) {
                        $html = str_replace("assets/images","/img",$lead_page_details['data']['html']);
                        
                        if(in_array($lead_page_details['data']['template_id'], [5,6])) {
                            $city_html = '<div style="text-transform: capitalize;">';
                            if(!empty($this->city_detail)) {
                                $count_temp = 1;
                                $city_count = count($this->city_detail);
                                foreach($this->city_detail as $key => $ct) {
                                    $city_html .= "<span style='padding-left: 5px;'> ".$ct;
                                    
                                    if($count_temp < $city_count ) {
                                        $city_html .= " <span>|</span> ";
                                    }
                                    $city_html .= "</span>";
                                    $count_temp++;
                                }
                            }
                            $city_html .= "</div>";

                            $html = str_replace('[city_detail]', $city_html, $html);
                        }
                        
                        $feedback_form_view = view('landing_pages.callback_form')->with($data)->render();
                        
                        $html = str_replace('[lead_form_html]', $feedback_form_view, $html);
                        
                        $data['html']  = $html;

                        if($lead_page_details['data']['meta_details']) {
                            $meta_details = $lead_page_details['data']['meta_details'];
                            $this->seoDataProcessLanding($meta_details['meta_title'],$meta_details['meta_keyword'],$meta_details['meta_desc'],$meta_details['canonical_url'],(int)$meta_details['robot_index'],(int)$meta_details['robot_follow']);
                        }
                    }
                    else {
                        throw new Exception("Something went wrong");
                    }
                }
            }
            else {
                return view('404_error');
            }
            
            //$data['message'] = 'Customer search for : '.$data['display_name'];

            return view('landing_pages.health-checkup', $data);
            
        } catch (Exception $ex) {
            return view('404_error');
        }
    }
}