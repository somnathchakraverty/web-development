<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class IndexController extends Controller
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
    
    public function homePage() {
        $request    =   $this->request;
        /**
         * This is for Home page
         */
        $route = request()->route()->getName();
        $this->seoDataProcess($route);
        $data = [
            'popular_package_data'      =>  [],
            'propular_package_detail'   =>  [],
            'city_name'                 =>  '',
            'healthians_blog_url'       =>  config()->get('constants.healthians_blog_url')
        ];

        /* Get Selected City Name */
        $city_name              =   getCityIdFromCookies();//getCityNameFromCookies();
        $url_city_name          =   getUrlCityName();
        $data['city_name']      =   $city_name;
        $data['city_name_url']  =   $url_city_name;
        // Popular Tests
        $popular_test_url = env('API_URL'). config('constants.popular_test_url');
        $popularTestQueryParam  =   [
            'cityId'  => $city_name,
            'resource_type' =>'web'
        ];
        $propular_test_detail = handleGuzzleCurlRequest($popular_test_url, 'GET', null, [], $popularTestQueryParam);
        // echo "<pre>";
        // print_r($propular_test_detail);die;
         // Popular package API
        $popularPackageQueryParam  =   [
            'city'  => $city_name,
            'resource_type' => 'web'
        ];
        $popularPackage_url        = $this->api_url.''.config()->get('constants.popular_package_url');        
        $popular_package_details   = handleGuzzleCurlRequest($popularPackage_url, 'GET', null, [], $popularPackageQueryParam);
        //dd($popular_package_details);
        if(!empty($popular_package_details['data'])) {
            $data['popular_package_data'] = $popular_package_details['data'];
            $data['propular_package_detail'] = $data['popular_package_data'];
        }
        
        if(!empty($propular_test_detail['data'])) {
            $data['propular_test_detail'] = $propular_test_detail['data'];
        }
        $this->middleware('guest', ['except' => ['homePage']]);
        $data['packageSuggestionURL']    =   config('constants.api_url').config('constants.packageSuggestion').'?city_id='.$this->city_id;
        //dd($popular_package_details);
        return view('home.index', $data);
    }

    public function getBlogSlider(Request $request) {
        /**
         * This is to for Blog Slider HTML on Home Page
         */

        $data = [
            'html_data'    => ''
        ];

        $blog_list_html = '';

        /* Hit Api */
        $this->api_url  = env('API_URL');
        $url            = $this->api_url.config('constants.getBlogList');
        $details        = handleGuzzleCurlRequest($url, 'POST', null, [], []);

        if(!empty($details['data'])) {
            foreach($details['data'] as $item) {
                $blog_list_html .= '<div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="thumbnail">
                            <img class="img-responsive" src="'.$item['imageUrl'].'" alt="">
                            <div class="caption">'.$item['title'].'</div>
                        </div>
                        <a href="'.$item['link'].'" class="readmore" target="_blank"> Read More </a>
                    </div>';
            }
        }

        $data['html_data'] = $blog_list_html;

        return response()->json($data, 200);
    }

    public function getPopularPackagePage(Request $request) {
        /**
         * This is for Get Popular Package Page
         */

        $route = request()->route()->getName();
        $this->seoDataProcess($route);
        
        $data = [
            'popular_package_data'  => [],
            'city_name' => '',
            'popular_package_slider_data'=> []
        ];

        /* Get Selected City Name */
        $city_name          =   getCityNameFromCookies();
        $city_id         =   getCityIdFromCookies();

        $data['city_name']  = $city_name;
        
         // Popular package API
        $popularPackageQueryParam  =   [
            'city'  => $city_id,
            'resource_type' => 'web'
        ];
        $popularPackage_url        = $this->api_url.''.config()->get('constants.popular_package_url');        
        $popular_package_details   = handleGuzzleCurlRequest($popularPackage_url, 'GET', null, [], $popularPackageQueryParam);
        //dd($popularPackage_url);
        if(!empty($popular_package_details['data'])) {
            $data['popular_package_data'] = $popular_package_details['data'];
        }

        if(!empty($data['popular_package_data'])) {
            // Top 3 lowest price package in slider
            $data['popular_package_slider_data']  = $this->getLowestSortKeyData($data['popular_package_data'], 'healthian_price');
        }

        return view('product.most_selling', $data);
    }
    

    private function getLowestSortKeyData(array $data, $key = 'healthian_price', $limit = 3) {
        /**
         * This is for to filter Data according to Key : Get Lowest Top 3 price data
         */

        $temp_data = $data;
        array_multisort(array_column($temp_data, $key), SORT_ASC, $temp_data);
        $temp_data = array_slice($temp_data,0,$limit);
        
        return $temp_data;
    }


    public function display_404() {
        $route = request()->route()->getName();
        $this->seoDataProcess($route);
        return view('404_error');
    }
}