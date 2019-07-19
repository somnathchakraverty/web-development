<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $crm_url;
    
    protected $api_url;
    
    protected $city_id;
        
    protected $request;
    
    protected $city_detail;
       
    /* @var \App\Support\SEO\SeoData */
    protected $seo;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($request = null)
    {
        // Get Active city list
        $this->api_url  =   env('API_URL');
        $url            =   $this->api_url.''.config('constants.city_detail');
        
        if(empty($request->cookie('guid'))) {
            $guid = GUID();
            cookie()->queue('guid', $guid, 1440,'/', null, false, false);
        }
        

        $city_details = handleGuzzleCurlRequest($url, 'GET');
        
        $city_details = $city_details['data'];
        $city_detail = [];
        $header_city_detail  =   [];
        foreach($city_details as $city){
            $city_detail[$city['id']] = $city['name'];
            if($city['is_metro'] == '0')
                $header_city_detail['non_metro'][$city['id']] = $city['name'];
            else
                $header_city_detail['metro'][$city['id']] = $city['name'];
        }
        $this->city_detail = $city_detail;
        view()->share('city_details', $city_detail);
        view()->share('header_city_detail', $header_city_detail);
        // Get selected City detail by customer
        if($request instanceof Request){            
            $this->request = $request;
            if($request->cookie('sLocation') && in_array(str_replace('_', ' ',strtolower($request->cookie('sLocation'))), array_map('strtolower', $this->city_detail))){
                $default_city  = str_replace('_', ' ',$request->cookie('sLocation'));
                $city_id = array_search(strtolower($default_city), array_map('strtolower', $this->city_detail)); 
                cookie()->queue('sLocationID', $city_id, 600,'/', null, false, false);
            }else{
                $default_city =  config()->get('constants.default_city');
                $city_id = array_search(strtolower($default_city), array_map('strtolower', $this->city_detail)); 
                cookie()->queue('sLocation', $this->city_detail[$city_id], 600,'/', null, false, false);
                cookie()->queue('sLocationID', $city_id, 600,'/', null, false, false);
            }
            view()->share('select_city_name', str_replace(' ', '_',strtolower($default_city)));
            if(!$city_id)
                throw new Exception("selected city not defined");
            else
                $this->city_id = $city_id;
        }
        
        if(!session()->has('cart_count'))
            session()->put('cart_count', 0);
        $this->seo      =       app('seo');
        
        $this->seo->setOgURL($request->fullUrl());
        $this->seo->setOgImage('https://cdn1.healthians.com/assets/images/logo.png');
        
        /*
        $return_detail =   checkFirstTimePopDisplay();
        if(isset($return_detail->value) && $return_detail->value == '1')
            view()->share('is_first_popup', true);
        else
            view()->share('is_first_popup', false);
         * 
         */
    }
    
    protected function createGAEvent($request, $value, $key = 'send_ga_event'){
        $request->session()->flash($key, $value);
    }

    protected function getErrors(){
        $errors     =   session()->get('errors');
        view()->share('session_error', $errors);
    } 
    
    public function getHTTPresponse($data = [], $code = 200){
        if($code != 200)
            return redirect('/');
        else
            return  response()->json($data, $code);
    }
    
    public function setRobotIndex($value){
        if(is_string($value)) {
            $this->seo->setRobots($value);
        }        
    }

    /** 
     * SEO DATA Process
    */
    protected function seoDataProcess($route) {
        if(!empty($route)) {
            $seo_data = getWebPageSeo($route);
            if(!empty($seo_data['data']['content']['meta_title'])) {
                $this->seo->setTitle($seo_data['data']['content']['meta_title']);
            }
            else {
                $this->seo->setTitle(config()->get('constants.default_meta_title'));
            }
    
            if(!empty($seo_data['data']['content']['meta_keyword'])) {
                $this->seo->setKeywords($seo_data['data']['content']['meta_keyword']);
            }
            else {
                $this->seo->setKeywords(config()->get('constants.default_meta_keyword'));
            }
    
            if(!empty($seo_data['data']['content']['meta_desc'])) {
                $this->seo->setDescription($seo_data['data']['content']['meta_desc']);
            }
            else {
                $this->seo->setDescription(config()->get('constants.default_meta_description'));
            }
    
            if(!empty($seo_data['data']['content']['canonical_url'])) {
                $this->seo->setCanonicalUrl($seo_data['data']['content']['canonical_url']);
            }
            else {
                $this->seo->setCanonicalUrl(request()->url());
            }

            $robots = '';
            if(isset($seo_data['data']['content']['robot_index'])) {
                if($seo_data['data']['content']['robot_index'] == 1) {
                    $robots .= 'index, ';
                }
                else {
                    $robots .= 'noindex, ';
                }
            }
            else {
                $robots .= 'noindex, ';
            }
            
            if(isset($seo_data['data']['content']['robot_follow'])) {
                if($seo_data['data']['content']['robot_follow'] == 1) {
                    $robots .= 'follow';
                }
                else {
                    $robots .= 'nofollow';
                }
            }
            else {
                $robots .= 'nofollow';
            }
            
            $this->seo->setRobots($robots);
        }  
        else {
            $this->seo->setTitle(config()->get('constants.default_meta_title'));
            $this->seo->setKeywords(config()->get('constants.default_meta_keyword'));
            $this->seo->setDescription(config()->get('constants.default_meta_description'));
            $this->seo->setCanonicalUrl(request()->url());
            $this->setRobots('noindex,nofollow');

        }   
    }

    /** 
     * SEO DATA Process for Landing Pages
    */
    protected function seoDataProcessLanding($meta_title = null, $meta_keyword = null, $meta_desc = null, $canonical_url = null, $robot_index = 0,  $robot_follow = 0) {
        
        if(!empty($meta_title)) {
            $this->seo->setTitle($meta_title);
        }
        else {
            $this->seo->setTitle(config()->get('constants.default_meta_title'));
        }

        if(!empty($meta_keyword)) {
            $this->seo->setKeywords($meta_keyword);
        }
        else {
            $this->seo->setKeywords(config()->get('constants.default_meta_keyword'));
        }

        if(!empty($meta_desc)) {
            $this->seo->setDescription($meta_desc);
        }
        else {
            $this->seo->setDescription(config()->get('constants.default_meta_description'));
        }

        if(!empty($canonical_url)) {
            $this->seo->setCanonicalUrl($canonical_url);
        }
        else {
            $this->seo->setCanonicalUrl(request()->url());
        }

        $robots = '';
        if($robot_index == 1) {
            $robots .= 'index, ';
        }
        else {
            $robots .= 'noindex, ';
        }        
    
        if($robot_follow == 1) {
            $robots .= 'follow';
        }
        else {
            $robots .= 'nofollow';
        }            

        $this->seo->setRobots($robots);          
    }
}
