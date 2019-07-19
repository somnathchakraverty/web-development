<?php

namespace App\Http\Controllers\HabitRisk;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Exception;

class HabitRiskController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct($request); 

        $route      = request()->route()->getName();

        $seo_data   = [];
        $allow_url  = ['habits-list', 'risk-area-list'];

        if(in_array($route, $allow_url)){
            $this->seoDataProcess($route);
        }        
    }
    
    public function habitList(Request $request) {
        /**
         * This is for habit List page
         */

        $data = [
            'habit_list'    => []
        ];

        $data['habit_list'] = $this->getHabitRiskAPIData('habit');

        return view('habit_risk.habit_list', $data);
    }
    
    public function riskList(Request $request){
        /**
         * This is for Risk List page
         */

        $data = [
            'risk_list'    => []
        ];

        $data['risk_list'] = $this->getHabitRiskAPIData('risk');

        return view('habit_risk.risk_area_list', $data);
    }
    
    public function habitDetail(Request $request, $link_rewrite){
        /**
         * This is for Habit Detail page
         */

        $data = [
            'habit_package_data' => [],
            'habit_title'        => '',
            'habit_banner_data'  => [],
            'packg_habit_descp'  => []
        ];

        if(!empty($link_rewrite)) {

            $habit_list     = $this->getHabitRiskAPIData('habit');
            $habitTests     = [];
            //print_r($habit_list);die;
            /* Get All test_ids for search habit */
            foreach($habit_list as $value) {
                if(strtolower($value['alias']) == strtolower($link_rewrite)) {
                    $data['habit_title'] = $value['Name'];
                    $data['habit_description'] = $value['description'];

                    if(!empty($value['meta_title'])) {
                        $this->seo->setTitle($value['meta_title']);
                    }
                    else {
                        $this->seo->setTitle(config()->get('constants.default_meta_title'));
                    }
        
                    if(!empty($value['meta_keyword'])) {
                        $this->seo->setKeywords($value['meta_keyword']);
                    }
                    else {
                        $this->seo->setKeywords(config()->get('constants.default_meta_keyword'));
                    }
        
                    if(!empty($value['meta_desc'])) {
                        $this->seo->setDescription($value['meta_desc']);
                    }
                    else {
                        $this->seo->setDescription(config()->get('constants.default_meta_description'));
                    }
                    
                    $this->seo->setCanonicalUrl(request()->url());

                    foreach($value['tests'] as $v) { 
                        if(!empty($v['habit_package_descp'])) {
                            $data['packg_habit_descp'][$v['test_id']] = $v['habit_package_descp'];    
                        } 
                        else {
                            $data['packg_habit_descp'][$v['test_id']] = '';    
                        }
                                     
                        array_push($habitTests, $v['test_id']);
                    }
                }               
            }
            
            /* Get Selected City ID */
            $city_id        = $request->cookie('sLocationID');            
            if(empty($city_id)) {
                $city_id    = 23;    
            }

            /* Get Selected City Name */
            $data['city_name']      =   getCityNameFromCookies();
            
            /* Prepare Request for Detail API */
            if(!empty($habitTests)) {
                $request_data       = [ 
                    "data"          => [
                        "city"      => $city_id,
                        "resource_type"    => "web",
                        "id"        => implode(',', $habitTests)
                    ]
                ];

                $data['habit_package_data']     = $this->getHabitRiskPackage($request_data);

                if(!empty($data['habit_package_data'])) {
                    // Top 3 lowest price package in banner slider
                    $data['habit_banner_data']  = $this->habit_risk_banner_data($data['habit_package_data'], 'healthian_price');
                }                
            }
            else {
                return view('404_error');
            }
        }

        return view('habit_risk.habit_detail', $data);
    }  

    public function riskDetail(Request $request, $link_rewrite){
        /**
         * This is for Risk Detail page
         */
        
        $data = [
            'risk_package_data' => [],
            'risk_title'        => '',
            'risk_banner_data'  => [],
            'packg_risk_descp'  => []
        ];

        if(!empty($link_rewrite)) {

            $risk_list = $this->getHabitRiskAPIData('risk');

            $riskTests = [];

            /* Get All test_ids for search habit */
            foreach($risk_list as $value) {
                if(strtolower($value['alias']) == strtolower($link_rewrite)) {
                    $data['risk_title'] = $value['Name'];
                    $data['risk_description'] = $value['description'];

                    if(!empty($value['meta_title'])) {
                        $this->seo->setTitle($value['meta_title']);
                    }
                    else {
                        $this->seo->setTitle(config()->get('constants.default_meta_title'));
                    }
        
                    if(!empty($value['meta_keyword'])) {
                        $this->seo->setKeywords($value['meta_keyword']);
                    }
                    else {
                        $this->seo->setKeywords(config()->get('constants.default_meta_keyword'));
                    }
        
                    if(!empty($value['meta_desc'])) {
                        $this->seo->setDescription($value['meta_desc']);
                    }
                    else {
                        $this->seo->setDescription(config()->get('constants.default_meta_description'));
                    }
                    
                    $this->seo->setCanonicalUrl(request()->url());

                    foreach($value['tests'] as $v) {
                        if(!empty($v['habit_package_descp'])) {
                            $data['packg_risk_descp'][$v['test_id']] = $v['habit_package_descp'];    
                        } 
                        else {
                            $data['packg_risk_descp'][$v['test_id']] = '';    
                        }                        
                        array_push($riskTests, $v['test_id']);
                    }
                }               
            }
            
            /* Get Selected City ID */
            $city_id        = $request->cookie('sLocationID');            
            if(empty($city_id)) {
                $city_id    = 23;    
            }

            /* Get Selected City Name */
            $data['city_name']      = getCityNameFromCookies();
            
            /* Prepare Request for Detail API */
            if(!empty($riskTests)) {
                $request_data       = [ 
                    "data"          => [
                        "city"      => $city_id,
                        "resource_type"    => "web",
                        "id"        => implode(',', $riskTests)
                    ]
                ];

                $data['risk_package_data']     = $this->getHabitRiskPackage($request_data);

                if(!empty($data['risk_package_data'])) {
                    // Top 3 lowest price package in banner slider
                    $data['risk_banner_data']  = $this->habit_risk_banner_data($data['risk_package_data'], 'healthian_price');
                }                
            }
            else {
                return view('404_error');
            }
        }

        return view('habit_risk.risk_detail', $data);
    } 

    public function getHabitSlider(Request $request) {
        /**
         * This is for habit List JSON Response
         */

        $data = [
            'html_data'     => ''
        ];

        $habit_list         = $this->getHabitRiskAPIData('habit');

        $slider_html = '';

        foreach($habit_list as $item) {
            $slider_html    .=  '<div class="popular-slide" >
                                    <div class="teamcontent1" onclick="pushGaEvent(\'Browse By Habit\', \'Click on Habit\', \''. $item['Name'] .'\')">
                                        <a href="/habit/'.strtolower($item['alias']).'"><img src="'.$item['image'].'" alt="'. $item['Name'] .'"/></a>
                                        <h3><a href="/habit/'.strtolower($item['alias']).'">'.$item['Name'].'</a></h3>
                                        <p>'.str_limit($item['description'],100).'</p>
                                        <a href="/habit/'.strtolower($item['alias']).'" title="'.$item['Name'].'" class="viewriskhabit">View More</a>

                                    </div>
                                </div>';
        }
        $data['html_data']  = $slider_html;
        
        return response()->json($data, 200);
    }
    
    public function getRiskSlider(Request $request){
        /**
         * This is for Risk Area List JSON Response
         */

        //Lazy Loading Reference : https://github.com/ressio/lazy-load-xt

        $data = [
            'html_data'    => ''
        ];

        $risk_list = $this->getHabitRiskAPIData('risk');

        $slider_html = '';

        foreach($risk_list as $item) {
            $slider_html    .=  '<div class="popular-slide" onclick="pushGaEvent(\'Browse By Risk\', \'Click on Risk\',\''.$item['Name'].'\')">
                                    <div class="teamcontent1" >
                                        <a href="/risk/'.strtolower($item['alias']).'"><img src="'.$item['image'].'" alt="'.$item['Name'].'"/></a>
                                        <h3><a href="/risk/'.strtolower($item['alias']).'">'.$item['Name'].'</a></h3>
                                        <p>'.str_limit($item['description'],100).'</p>
                                        <a href="/risk/'.strtolower($item['alias']).'" title="'.$item['Name'].'" class="viewriskhabit">View More</a>
                                    </div>
                                </div>';
        }
        $data['html_data']  = $slider_html;
        //dd($slider_html);

        return response()->json($data, 200);
    }

    public function getHabitRiskAPIData($type = 'habit') {
        /**
         * This is for to get Habit & Risk Area API Response
         */

        $data = [];
        $queryParam = [
               'source' => 'web'
            ];

        if($type == 'habit') {
            $this->api_url      = env('API_URL');
            $url                = $this->api_url.config('constants.gethabitParameter');
            $habit_list_details = handleGuzzleCurlRequest($url, 'GET', null, [], $queryParam);

            if(!empty($habit_list_details['data'])) {
                $data           = $habit_list_details['data'];
            }
        }

        if($type == 'risk') {
            $this->api_url      = env('API_URL');
            $url                = $this->api_url.config('constants.getriskParameter');
            $risk_list_details  = handleGuzzleCurlRequest($url, 'GET', null, [], $queryParam);
            
            if(!empty($risk_list_details['data'])) {
                $data           = $risk_list_details['data'];
            }
        }

        return $data;
    }

    public function getHabitRiskPackage($request_data) {
        /**
         * This is for to get Habit & Risk Package List of particular Habit/Risk
         */

        $response_data  = [];

        $this->api_url  = env('API_URL');
        $url            = $this->api_url.config('constants.getRiskHabitSearch');
        $details        = handleGuzzleCurlRequest($url, 'POST', null, $request_data, []);
        // echo "<pre>";
        // print_r($details);die;
        if(!empty($details['data'])) {
            $response_data = $details['data'];
        }

        return $response_data;
    }

    private function habit_risk_banner_data($data, $key = 'healthian_price', $limit = 3) {
        /**
         * This is for to filter Habit & Risk Package Data for Banner Listing
         */

        $temp_data = $data;
        array_multisort(array_column($temp_data, $key), SORT_ASC, $temp_data);
        $temp_data = array_slice($temp_data,0,$limit);
        
        return $temp_data;
    }
}
