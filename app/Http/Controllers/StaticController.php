<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StaticController extends Controller
{
    // this controller is used for all static pages

    public function __construct(Request $request) {
        parent::__construct($request);

        $route = request()->route()->getName();
        $this->seoDataProcess($route);
    }

    public function aboutUsPage(Request $request) {
        /**
         * This is for About US page
         */
        $data = ['content' => ''];

        $route = request()->route()->getName();
        $content_data = getWebPageCMSContent($route);

        if(!empty($content_data)) {
            if($content_data['status'] == 1) {
                if(!empty($content_data['data']['content'])) {
                    $data['content'] = $content_data['data']['content'];
                }
            }
        }

        return view('static.about_us', $data);
    }

    public function mediaPage(Request $request) {
        /**
         * This is for Media page
         */

        $data = ['content' => ''];

        $route = request()->route()->getName();
        $content_data = getWebPageCMSContent($route);

        if(!empty($content_data)) {
            if($content_data['status'] == 1) {
                if(!empty($content_data['data']['content'])) {
                    $data['content'] = $content_data['data']['content'];
                }
            }
        }

        return view('static.media', $data);
    }

    public function careerPage(Request $request) {
        /**
         * This is for Career page
         */

        $data = ['content' => '', 'form_submit_success' => false, 'form_submit_error' => false];

        $route = request()->route()->getName();
        $content_data = getWebPageCMSContent($route);

        if(!empty($content_data)) {
            if($content_data['status'] == 1) {
                if(!empty($content_data['data']['content'])) {
                    $data['content'] = $content_data['data']['content'];
                }
            }
        }

        /* To Show - Form Success Message */
        if ($request->session()->exists('form_submit_success')) {
            $data['form_submit_success'] = true;
        }

        /* To Show - Form Submit Error Message */
        if ($request->session()->exists('form_submit_error')) {
            $data['form_submit_error'] = true;
        }

        /* For Rendering Contact Us Form using template */
        $pos = strpos($data['content'], '[career_form]');

        if ($pos !== true) {
            // assign template render html to a variable
            $template_render_data = ['form_submit_success' => $data['form_submit_success'], 'form_submit_error' => $data['form_submit_error']];
            $career_form_view = view('form_template.career_form')->with($template_render_data)->render();

            // Replace render html variable to html variable
            $data['content'] = str_replace('[career_form]', $career_form_view, $data['content']);
        }

        return view('static.career', $data);
    }

    public function termsConditionPage(Request $request) {
        /**
         * This is for Terms Condition page
         */

        $data = ['content' => ''];

        $route = request()->route()->getName();
        $content_data = getWebPageCMSContent($route);

        if(!empty($content_data)) {
            if($content_data['status'] == 1) {
                if(!empty($content_data['data']['content'])) {
                    $data['content'] = $content_data['data']['content'];
                }
            }
        }

        return view('static.terms_condition', $data);
    }

    public function refundPolicyPage(Request $request) {
        /**
         * This is for Refund Policy page
         */

        $data = ['content' => ''];

        $route = request()->route()->getName();
        $content_data = getWebPageCMSContent($route);

        if(!empty($content_data)) {
            if($content_data['status'] == 1) {
                if(!empty($content_data['data']['content'])) {
                    $data['content'] = $content_data['data']['content'];
                }
            }
        }
        
        return view('static.refund_policy', $data);
    }

    public function labsPage(Request $request) {
        /**
         * This is for Labs page
         */

        $data = ['content' => '', 'form_submit_success' => false, 'form_submit_error' => false];
        
        $route = request()->route()->getName();
        $content_data = getWebPageCMSContent($route);
        
        if(!empty($content_data)) {
            if($content_data['status'] == 1) {
                if(!empty($content_data['data']['content'])) {
                    $data['content'] = $content_data['data']['content'];
                }
            }
        }

        /* To Show - Form Success Message */
        if ($request->session()->exists('form_submit_success')) {
            $data['form_submit_success'] = true;
        }

        /* To Show - Form Submit Error Message */
        if ($request->session()->exists('form_submit_error')) {
            $data['form_submit_error'] = true;
        }

        /* For Rendering Contact Us Form using template */
        $pos = strpos($data['content'], '[lab_visit_form]');

        if ($pos !== true) {
            // assign template render html to a variable
            $template_render_data = [
                'form_submit_success'   => $data['form_submit_success'], 
                'form_submit_error'     => $data['form_submit_error']
            ];
            $lab_visit_view = view('form_template.lab_visit_form')->with($template_render_data)->render();

            // Replace render html variable to html variable
            $data['content'] = str_replace('[lab_visit_form]', $lab_visit_view, $data['content']);
        }

        return view('static.labs', $data);
    }

    public function healthiansInvestorsPage(Request $request) {
        /**
         * This is for Healthians Investors page
         */

        $data = ['content' => ''];

        $route = request()->route()->getName();
        $content_data = getWebPageCMSContent($route);

        if(!empty($content_data)) {
            if($content_data['status'] == 1) {
                if(!empty($content_data['data']['content'])) {
                    $data['content'] = $content_data['data']['content'];
                }
            }
        }
        
        return view('static.investors', $data);
    }

    public function contactUsPage(Request $request) {
        /**
         * This is for Contact Us page
         */

        $data = ['content' => '', 'form_submit_success' => false, 'form_submit_error' => false];

        $route = request()->route()->getName();
        $content_data = getWebPageCMSContent($route);

        if(!empty($content_data)) {
            if($content_data['status'] == 1) {
                if(!empty($content_data['data']['content'])) {
                    $data['content'] = $content_data['data']['content'];
                }
            }
        }

        /* To Show - Form Success Message */
        if ($request->session()->exists('form_submit_success')) {
            $data['form_submit_success'] = true;
        }

        /* To Show - Form Submit Error Message */
        if ($request->session()->exists('form_submit_error')) {
            $data['form_submit_error'] = true;
        }

        /* For Rendering Contact Us Form using template */
        $pos = strpos($data['content'], '[contact_us_form]');

        if ($pos !== true) {
            // assign template render html to a variable
            $template_render_data = [
                'form_submit_success' => $data['form_submit_success'], 
                'form_submit_error' => $data['form_submit_error']
            ];
            $contact_us_view = view('form_template.contact_us_form')->with($template_render_data)->render();

            // Replace render html variable to html variable
            $data['content'] = str_replace('[contact_us_form]', $contact_us_view, $data['content']);
        }

        return view('static.contact_us', $data);
    }

    public function dealsPage(Request $request) {
        /**
         * This is for Deals page
         */

        $data       = ['content' => ''];
        $deals_list = [];     

        /* Get Default City */
        $city_name  = getCityNameFromCookies();

        if(!empty($city_name)) {
            $data['city_name'] = strtolower($city_name);
        }

        /* Get Deals List from API */
        $this->crm_url      = env('CRM_URL');
        $queryParam         = [
            "source" => "web"
        ];
        $url                = $this->crm_url.config('constants.get_website_deal_offers');
        $deals_list_data    = handleGuzzleCurlRequest($url, 'GET', null, [], $queryParam, 'application/x-www-form-urlencoded');

        if(!empty($deals_list_data['data']['content'])) {
            $deals_list = $deals_list_data['data']['content'];
        }

        /* Get CMS content for Deals page */
        $route          = request()->route()->getName();
        $content_data   = getWebPageCMSContent($route);

        if(!empty($content_data)) {
            if($content_data['status'] == 1) {
                if(!empty($content_data['data']['content'])) {
                    $data['content'] = $content_data['data']['content'];
                }
            }
        }

        /* For Rendering Deals List using template */
        $pos = strpos($data['content'], '[deal_listing]');

        if ($pos !== true) {
            // assign template render html to a variable
            $template_render_data   = ['deals_list' => $deals_list, 'city_name' => $data['city_name']];
            $deal_list_view         = view('listing_template.deals_list')->with($template_render_data)->render();

            // Replace render html variable to html variable
            $data['content']        = str_replace('[deal_listing]', $deal_list_view, $data['content']);
        }
        
        return view('static.deals', $data);
    }

    public function feedbackPage(Request $request) {
        /**
         * This is for Feedabck page
         */

        $this->crm_url = env('CRM_URL');
        $url = $this->crm_url.config('constants.getIssueTypes');
        $issue_details = handleGuzzleCurlRequest($url, 'GET');

        $data = ['content' => '', 'form_submit_success' => false, 'form_submit_error' => false];

        $data['query_type'] = $issue_details['data'];

        $route = request()->route()->getName();
        $content_data = getWebPageCMSContent($route);

        if(!empty($content_data)) {
            if($content_data['status'] == 1) {
                if(!empty($content_data['data']['content'])) {
                    $data['content'] = $content_data['data']['content'];
                }
            }
        }

        /* To Show - Form Success Message */
        if ($request->session()->exists('form_submit_success')) {
            $data['form_submit_success'] = true;
        }

        /* To Show - Form Submit Error Message */
        if ($request->session()->exists('form_submit_error')) {
            $data['form_submit_error'] = true;
        }

        /* For Rendering Contact Us Form using template */
        $pos = strpos($data['content'], '[feedback_form]');

        if ($pos !== true) {
            // assign template render html to a variable
            $template_render_data = [
                'form_submit_success'   => $data['form_submit_success'], 
                'form_submit_error'     => $data['form_submit_error'], 
                'query_type'            => $data['query_type']
            ];
            $feedback_form_view = view('form_template.feedback_form')->with($template_render_data)->render();

            // Replace render html variable to html variable
            $data['content'] = str_replace('[feedback_form]', $feedback_form_view, $data['content']);
        }
        
        return view('static.feedback', $data);
    }

    /**
     * This is for Offers/deal Terms and condition page
     */
    public function offerTermsConditionPage(Request $request) {
        
        $data = ['content' => ''];

        $route = request()->route()->getName();
        $content_data = getWebPageCMSContent($route);

        if(!empty($content_data)) {
            if($content_data['status'] == 1) {
                if(!empty($content_data['data']['content'])) {
                    $data['content'] = $content_data['data']['content'];
                }
            }
        }

        $this->seo->setRobots('index, follow');        

        return view('static.offer-terms-conditions', $data);
    }

    
    /**
     * This is for wellness page
     */
    public function wellnessProgramPage(Request $request) {
        
        $data = ['content' => ''];

        $route = request()->route()->getName();
        $content_data = getWebPageCMSContent($route);

        if(!empty($content_data)) {
            if($content_data['status'] == 1) {
                if(!empty($content_data['data']['content'])) {
                    $data['content'] = $content_data['data']['content'];
                }
            }
        }
        $this->seo->setRobots('index, follow');    
        
        return view('static.wellness-program', $data);
    }

    /**
     * This is for Promotion page for Health Karma
     */
    public function healthKarmaPromotionPage(Request $request) {
        
        $data = [
            'content'               => '',
            'city_detail'           =>  $this->city_detail,
            'utm_id'                =>  'business-development',
            'ga_category'           =>  'HDFC HarDostFit',
            'ga_mobile_category'    =>  'HDFC HarDostFit - Mobile'
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
        $data['message']        =   'Customer search for : HarDostFit';

        $city_html = '<p style="text-transform: capitalize;">';
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
        $city_html .= "</p>";

        $data['city_html'] = $city_html;

        $route = request()->route()->getName();
        $content_data = getWebPageCMSContent($route);

        if(!empty($content_data)) {
            if($content_data['status'] == 1) {
                if(!empty($content_data['data']['content'])) {
                    $data['content'] = $content_data['data']['content'];
                    $data['content'] = str_replace('[city_html]', $city_html, $data['content']);
                }
            }
        }
        
        return view('static.health-karma-promotion', $data);
    }

     /**
     * This is for Statutory Compliance Page
     */
    public function statutoryCompliancePage(Request $request) {
        
        $data = ['content' => ''];

        $route = request()->route()->getName();
        // $content_data = getWebPageCMSContent($route);

        // if(!empty($content_data)) {
        //     if($content_data['status'] == 1) {
        //         if(!empty($content_data['data']['content'])) {
        //             $data['content'] = $content_data['data']['content'];
        //         }
        //     }
        // }
        
        return view('static.statutory-compliance', $data);
    }


}
