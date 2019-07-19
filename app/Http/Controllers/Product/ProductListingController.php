<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class ProductListingController extends Controller
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
    
    
    public function setSelectedSessionDetail(){
        try{
            $request = $this->request;
            if(isset($request->selectedObj)){
                $request->session()->put('selectedObj', $request->selectedObj);
                $data['status']     =   true;
                return response()->json($data, 200);
            }else{
                $data['message']    =   "select Object Missing";
                $data['status']     =   true;
                return response()->json($data, 200);
            }
        } catch (Exception $ex) {
            $data['message']    =   $ex->getMessage();
            $data['status']     =   false;
            return response()->json($data, 500);
        }
    }
    
    public function productListDetail($city){
        try {
            $city   =   str_replace('_', ' ', $city);
            $route  =   request()->route()->getName();
            $this->seoDataProcess($route);

            $request        =   $this->request;
            $search_values  =   [];
            $filter_values  =   $request->query('f');
            if(!empty($filter_values) && is_array($filter_values) && count($filter_values) > 0){
                $i = 0;
                foreach($filter_values as $key => $filter_value){
                    $search_values[$i]['id'] = $key;
                    $search_values[$i]['text'] = $filter_value;
                    $i++;
                }
            }
            $city_id = null;
            if(in_array(strtolower($city), array_map('strtolower', $this->city_detail)))
                $city_id = array_search(strtolower($city), array_map('strtolower', $this->city_detail));
            else
                throw new Exception("city not found");
            cookie()->queue('sLocation', $this->city_detail[$city_id], 600,'/', null, false, false);
            view()->share('select_city_name', str_replace(' ', '_',strtolower($this->city_detail[$city_id])));
            
            $popular_test_url = env('API_URL'). config('constants.popular_test_url');
            $popular_package_url = env('API_URL') . config('constants.popular_package_url');
            $search_page_url = env('CRM_URL') . config('constants.search_page');
            
            $get_risk_url = env('API_URL') . config('constants.risk_parameter_url');
            $get_habit_url = env('API_URL') . config('constants.habit_parameter_url');
            
            $bodyParams  =  [
                    "filters"=>[
                        "suggested_test" => [],
                        "cities" => [
                            "city_id" => $city_id
                        ],
                        'source' => 'web'
                    ],
                    "searchValue" => $search_values
                ];
            
            $queryParam = [
                'city' => $city,
                'source' => 'web'
            ];

            /* Get Selected City Name */
            $city_name          =   getCityNameFromCookies();
            $s_city_id         =   getCityIdFromCookies();

            $data['city_name']  =   str_replace(' ', '_', $city_name);

            // Popular Tests
            $popular_test_url = env('API_URL'). config('constants.popular_test_url');
            $popularTestQueryParam  =   [
                'cityId'  => $s_city_id,
                'resource_type' => 'web'
            ];
            $propular_test_detail = handleGuzzleCurlRequest($popular_test_url, 'GET', null, [], $popularTestQueryParam);
            //print_r($propular_test_detail);die;
            
            // Popular package API
            $popularPackageQueryParam  =   [
                'city'  => $s_city_id,
                'resource_type' => 'web'
            ];
            $popularPackage_url        = $this->api_url.''.config()->get('constants.popular_package_url');
            $popular_package_details   = handleGuzzleCurlRequest($popularPackage_url, 'GET', null, [], $popularPackageQueryParam);

            if(!empty($popular_package_details['data'])) {
                $data['popular_package_data'] = $popular_package_details['data'];
                $data['propular_package_detail'] = $data['popular_package_data'];
            }

            if(!empty($propular_test_detail['data'])) {
                $data['propular_test_detail'] = $propular_test_detail['data'];
            }
            $getTestByHabit = handleGuzzleCurlRequest($get_habit_url, 'GET', null, [], $queryParam);
            $getTestByRisk = handleGuzzleCurlRequest($get_risk_url, 'GET', null, [], $queryParam);
            //print_r($getTestByRisk);die;
            $search_lists = handleCurlRequest($search_page_url, 'POST', $bodyParams);
            
            if(isset($getTestByRisk['data']) && isset($getTestByHabit['data']) && isset($search_lists['data'])){
                
                $data['testByRisks'] = $getTestByRisk['data'];
                $data['testByHabits'] = $getTestByHabit['data'];
                $data['search_lists'] = $search_lists['data'];
                $data['city'] = strtolower($city);
                $data['search_values'] = $filter_values;
                if(auth()->check()){
                    $token_id = auth()->user()->id;
                    if(session()->has('auth_'.$token_id))
                        $data['logged_user'] = session()->get('auth_'.$token_id);                    
                }else
                    $data['logged_user'] = [];
                /*
                if(isset($search_lists['data']['pathology']['healthian_package'][0]['healthian_price']) && ($search_lists['data']['pathology']['healthian_package'][0]['healthian_price'] == 0)){
                    return redirect()->route('product.listing');
                }
                */
                /* For Google Analytics */
                if(count($search_values) > 0){
                    $event_data     =   [
                        'action'    =>  'Search From Home Page',
                        'category'  =>  'Search',
                        'label'     =>  json_encode($search_values)
                    ];
                    $this->createGAEvent($this->request,   $event_data);
                }

                $data['packageSuggestionURL']    =   config('constants.api_url').config('constants.packageSuggestion').'?city_id='.$this->city_id;

                return view('product.listing', $data);
            }else{
                throw new Exception("something went wrong");
            }
        } catch (Exception $ex) {
            return redirect()->route('404-error',[], 301);
        }
    }
    
    public function ajaxProductListDetail($city){
        try{
            $city       =   str_replace('_', ' ', $city);
            $request    =   $this->request;
            $city_id    =   null;
            
            if(in_array(strtolower($city), array_map('strtolower', $this->city_detail)))
                $city_id = array_search(strtolower($city), array_map('strtolower', $this->city_detail));
            else
                throw new Exception("city not found");
            $search_page_url = env('CRM_URL') . config('constants.search_page');
            
            if($request->has('search_val') && is_array($request->search_val) && (count($request->search_val) > 0))
                $search_val     =   $request->search_val;
            else
                $search_val     =   [];
            
            if($request->has('suggested_test') && is_array($request->suggested_test) && (count($request->suggested_test) > 0))
                $suggested_test     =   $request->suggested_test;
            else
                $suggested_test     =   [];
            
            $bodyParams  =  [ 
                    "filters"=>[
                        "suggested_test" => $suggested_test,
                        "cities" => [
                            "city_id" => $city_id
                        ],
                        'source' => 'web'
                    ],
                    "searchValue" => $search_val
                ];
            $search_lists = handleCurlRequest($search_page_url, 'POST', $bodyParams);
            if(isset($search_lists['data'])){
                
                /* For Google Analytics */
                $event_data     =   [
                    'action'    =>  'Search From Orderbook Page',
                    'category'  =>  'Search',
                    'label'     =>  json_encode($search_val)
                ];
                $this->createGAEvent($this->request,   $event_data);
                
                $data['status'] = true;
                if(isset($search_lists['data']['pathology']['healthian_package']))
                    $data['search_lists'] = $search_lists['data']['pathology']['healthian_package'];
                else
                    $data['search_lists'] = [];
            }else{
                throw new Exception("something went wrong");
            }
            return $this->getHTTPresponse($data, 200);
        } catch (Exception $ex) {
            return redirect()->route('404-error',[], 301);
        }
    }
    
    public function cityPackageDetail($city){
        try {
            $request    =   $this->request;

            if(empty($request->query('page_no')) || is_numeric($request->query('page_no')) || $request->query('page_no') < 1 )
                $page_no    =   1;
            else
                $page_no    =   $request->query('page_no');
                
            $offset     =   $page_no * config()->get('constants.display_page_limit');
            
            $city   =   str_replace('_', ' ', $city);
            $this->updateSEOData($city);

            $city_id = null;
            if(in_array(strtolower($city), array_map('strtolower', $this->city_detail)))
                $city_id = array_search(strtolower($city), array_map('strtolower', $this->city_detail));
            else
                throw new Exception("city not found");
            cookie()->queue('sLocation', $this->city_detail[$city_id], 600,'/', null, false, false);
            view()->share('select_city_name', str_replace(' ', '_',strtolower($this->city_detail[$city_id])));
            
            $queryString    =   [
                                'city_id'      =>  $city_id,
                                'limit'     =>  config()->get('constants.display_page_limit'),
                                'offset'    =>  $offset,
                                'source' => 'web'
                            ];
            $package_city_url   =   $this->api_url.config()->get('constants.getPackageCityWise');
            //print_r($package_city_url);die;
            $package_details    =   handleGuzzleCurlRequest($package_city_url, 'GET', null, [], $queryString);
//            dd($package_details);
            if($package_details['data'] && $package_details['data']){                
                $data['city']       =   strtolower($city);
                $data['page_limit'] =   config()->get('constants.display_page_limit');
                $data['city_name']  =   str_replace(' ', '_', strtolower($city));
                $data['city_package_details']  =   $package_details['data'];
                $data['product_detail_list']   =   $package_details['data'];
                $data['status']     =   true;
                $data['offset']     =   $offset;
                if($request->ajax())
                    return response()->json($data, 200);
                else
                    return view('product.city_package', $data);
            }else{
                throw new Exception("Package by {$city} not found");
            }
            
        } catch (Exception $ex) {
            $data['status']     =   false;
            $data['message']    =   $ex->getMessage();
            if($request->ajax()){
                return response()->json($data, 500);
            }else
                throw new Exception($ex->getMessage());
        }
    }
    
    protected function updateSEOData($city_name)
    {
        $title          =   "Health Checkup Packages in {$city_name}: Blood Test, Full Body Checkup | Healthians";
        $Description    =   "Book Online Health Test, Blood Test, Body Checkup and other Health Checkup Packages in {$city_name} with Free Sample Collection at Home. Also, get your Health Report online within 24 hours and Free Doctor Consultation.";
        $Keywords       =   "health checkup in {$city_name}, health checkup packages in {$city_name}, health test in {$city_name}, blood test in {$city_name}, full body checkup in {$city_name}";
        $og_title       =   "Health Checkup Packages in {$city_name}: Blood Test, Full Body Checkup | Healthians";
        $og_description =   "Book Online Health Test, Blood Test, Body Checkup and other Health Checkup Packages in {$city_name} with Free Sample Collection at Home. Also, get your Health Report online within 24 hours and Free Doctor Consultation.";


        $this->seo->setTitle($title);
        $this->seo->setKeywords($Keywords);
        $this->seo->setDescription($Description);
        $this->seo->setOgTitle($og_title);
        $this->seo->setOgDescription($og_description);
    }
        
    public function ajaxCityPackageDetail($city, $offset){
        try {
            $city   =   str_replace('_', ' ', $city);
            
            $city_id = null;
            if(in_array(strtolower($city), array_map('strtolower', $this->city_detail)))
            {
                $city_id = array_search(strtolower($city), array_map('strtolower', $this->city_detail));
            }
           

            if(!is_numeric($offset))
                throw new Exception("Offset should be numeric");
            
            $queryString    =   [
                                'city_id'      =>  $city_id,
                                'limit'     =>  config()->get('constants.display_page_limit'),
                                'offset'    =>  $offset,
                            ];
            $package_city_url   =   $this->api_url.config()->get('constants.getPackageCityWise');

            $package_details    =   handleGuzzleCurlRequest($package_city_url, 'GET', null, [], $queryString);
            if($package_details['data'] && $package_details['data']){
                
                $data['status']     =   true;
                $data['city']       =   strtolower($city);
                $data['city_name']  =   str_replace(' ', '_', strtolower($city));
                $data['product_detail_list']   =   $package_details['data'];
                return $this->getHTTPresponse($data, 200);
            }else{
                throw new Exception("Package by {$city} not found");
            }
            
        } catch (Exception $ex) {
            $data['status']     =   true;
            $data['message']    =   $ex->getMessage();
            return $this->getHTTPresponse($data, 433);
        }
    }
}