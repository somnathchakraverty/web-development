<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Exception;

class ProductController extends Controller
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

    public function packageDetail($city, $link_rewrite){
        try {
            $link_rewrite   =   preg_replace('/[^A-Za-z0-9\-_]/', '', $link_rewrite);
            $city = str_replace('_', ' ', $city);
            $request = $this->request;
            $queryParams = $request->query();
            if(in_array(strtolower($city), array_map('strtolower', $this->city_detail)))
                $city_id = array_search(strtolower($city), array_map('strtolower', $this->city_detail));
            else
                throw new Exception("city notfound");

            $inputs = [
                'link_rewrite' => $link_rewrite,
                'city' => $city_id
            ];
            $validator = Validator::make($inputs, [
                    'link_rewrite' => 'required|max:255',
                    'city' => 'required',
                ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }

            cookie()->queue('sLocation', $this->city_detail[$city_id], 600,'/', null, false, false);
            view()->share('select_city_name', str_replace(' ', '_',strtolower($this->city_detail[$city_id])));
            
            // product detail page
            $productQueryParam = [
                'city' => $city_id,
                'deal_type' => 'package',
                'link_rewrite' => $link_rewrite,
                'resource_type' => 'web'
            ];
            $curl_url = $this->api_url.config()->get('constants.product_url');
            $product_details = handleGuzzleCurlRequest($curl_url, 'GET', null, [], $productQueryParam);

            // product detail page
            $productQueryParam = [
                'city' => $city_id,
                'link_rewrite' => $link_rewrite,
                'ptype' => 'package',
                'resource_type' => 'web'
            ];
            $package_url = $this->api_url.''.config()->get('constants.popular_package_url');

            $popular_package_details = handleGuzzleCurlRequest($package_url, 'GET', null, [], $productQueryParam);
            $data['city'] = strtolower($city);
            $data['city_name']  =   str_replace(' ', '_', strtolower($city));
            if(isset($product_details['data']) && isset($popular_package_details['data'])){
                $product_details['data']['link_rewrite'] = isset($product_details['data']['link_rewrite']) ? $product_details['data']['link_rewrite']: $link_rewrite;
                $data['product_detail'] = $product_details['data'];

                $event_data     =   [
                    'action'    =>  'Clicked View Details of Product',
                    'category'  =>  'Search',
                    'label'     =>  $data['product_detail']['name']
                ];
                $this->createGAEvent($this->request,   $event_data);

                $this->updateSEOData($data['product_detail']);

                $data['popular_package_details'] = $popular_package_details['data'];
                if(auth()->check()){
                    $token_id = auth()->user()->id;
                    if(session()->has('auth_'.$token_id))
                        $data['logged_user'] = session()->get('auth_'.$token_id);
                }else
                    $data['logged_user'] = [];
                $data['logged_user']['ptype']  =  $product_details['data']['deal_type'] ;
                return view('product.detail', $data);
            }else{
                throw new Exception("something went wrong");
            }
        } catch (Exception $ex) {
            return redirect()->route('404-error',[], 301);
            return false;
        }
    }

    public function profileDetail($city, $link_rewrite){ 
        try {
            $link_rewrite   =   preg_replace('/[^A-Za-z0-9\-_]/', '', $link_rewrite);
            $city = str_replace('_', ' ', $city);
            $request = $this->request;
            $queryParams = $request->query();
            if(in_array(strtolower($city), array_map('strtolower', $this->city_detail)))
                $city_id = array_search(strtolower($city), array_map('strtolower', $this->city_detail));
            else
                throw new Exception("city notfound");
            cookie()->queue('sLocation', $this->city_detail[$city_id], 600,'/', null, false, false);
            view()->share('select_city_name', str_replace(' ', '_',strtolower($this->city_detail[$city_id])));
            
            $inputs = [
                'link_rewrite' => $link_rewrite,
                'city' => $city_id
            ];
            $validator = Validator::make($inputs, [
                    'link_rewrite' => 'required|max:255',
                    'city' => 'required|exists:deal_city,city_id',
                ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }

            // product detail page
            $productQueryParam = [
                'city' => $city_id,
                'deal_type' => 'profile',
                'link_rewrite' => $link_rewrite,
                'resource_type' => 'web'
            ];
            $curl_url = $this->api_url.''.config()->get('constants.product_url');
            $product_details = handleGuzzleCurlRequest($curl_url, 'GET', null, [], $productQueryParam);
            //print_r($product_details);die;

            // product detail page
            $productQueryParam = [
                'city' => $city_id,
                'link_rewrite' => $link_rewrite,
                'ptype' => 'profile',
                'resource_type' => 'web'
            ];
            $package_url = $this->api_url.''.config()->get('constants.popular_package_url');
            $data['city'] = strtolower($city);
            $data['city_name']  =   str_replace(' ', '_', strtolower($city));
            $popular_profile_details = handleGuzzleCurlRequest($package_url, 'GET', null, [], $productQueryParam);

            if(isset($product_details['data']) && isset($popular_profile_details['data'])){
                $product_details['data']['link_rewrite'] = isset($product_details['data']['link_rewrite']) ? $product_details['data']['link_rewrite']: $link_rewrite;
                $data['product_detail'] = $product_details['data'];

                $this->updateSEOData($data['product_detail']);

                $data['popular_package_details'] = $popular_profile_details['data'];

                $event_data     =   [
                    'action'    =>  'Clicked View Details of Product',
                    'category'  =>  'Search',
                    'label'     =>  $data['product_detail']['name']
                ];
                $this->createGAEvent($this->request,   $event_data);
                if(auth()->check()){
                    $token_id = auth()->user()->id;
                    if(session()->has('auth_'.$token_id))
                        $data['logged_user'] = session()->get('auth_'.$token_id);
                }else
                    $data['logged_user'] = [];
                $data['logged_user']['ptype']  =  'profile';
                return view('product.detail', $data);
            }else{
                throw new Exception("something went wrong");
            }
        } catch (Exception $ex) {
            return redirect()->route('404-error',[], 301);
        }
    }

    public function parameterDetail($city, $link_rewrite){
        try {
            $link_rewrite   =   preg_replace('/[^A-Za-z0-9\-_]/', '', $link_rewrite);
            $city           =   str_replace('_', ' ', $city);
            $request        =   $this->request;
            $queryParams    =   $request->query();
            if(in_array(strtolower($city), array_map('strtolower', $this->city_detail)))
                $city_id = array_search(strtolower($city), array_map('strtolower', $this->city_detail));
            else
                throw new Exception("city notfound");
            cookie()->queue('sLocation', $this->city_detail[$city_id], 600,'/', null, false, false);
            view()->share('select_city_name', str_replace(' ', '_',strtolower($this->city_detail[$city_id])));
            
            $inputs = [
                'link_rewrite' => $link_rewrite,
                'city' => $city_id
            ];
            $validator = Validator::make($inputs, [
                    'link_rewrite' => 'required|max:255',
                    'city' => 'required|exists:deal_city,city_id',
                ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }

            // product detail page
            $productQueryParam = [
                'city'          =>  $city_id,
                'deal_type'     =>  'parameter',
                'link_rewrite'  =>  $link_rewrite,
                'resource_type' => 'web'
            ];
            $curl_url = $this->api_url.''.config()->get('constants.product_url');

            $product_details = handleGuzzleCurlRequest($curl_url, 'GET', null, [], $productQueryParam);

            // product detail page
            $productQueryParam = [
                'city' => $city_id,
                'link_rewrite' => $link_rewrite,
                'ptype' => 'parameter',
                'resource_type' => 'web'
            ];
            $package_url = $this->api_url.''.config()->get('constants.popular_package_url');

            $popular_parameter_details = handleGuzzleCurlRequest($package_url, 'GET', null, [], $productQueryParam);
            $data['city']       =   strtolower($city);
            $data['city_name']  =   str_replace(' ', '_', strtolower($city));
            if(isset($product_details['data']) && isset($popular_parameter_details['data'])){
                $product_details['data']['link_rewrite'] = isset($product_details['data']['link_rewrite']) ? $product_details['data']['link_rewrite']: $link_rewrite;
                $data['product_detail'] = $product_details['data'];

                $this->updateSEOData($data['product_detail']);

                $data['popular_package_details'] = $popular_parameter_details['data'];

                $event_data     =   [
                    'action'    =>  'Clicked View Details of Product',
                    'category'  =>  'Search',
                    'label'     =>  $data['product_detail']['name']
                ];
                $this->createGAEvent($this->request,   $event_data);
                if(auth()->check()){
                    $token_id = auth()->user()->id;
                    if(session()->has('auth_'.$token_id))
                        $data['logged_user'] = session()->get('auth_'.$token_id);
                }else
                    $data['logged_user'] = [];
                $data['logged_user']['ptype']  =  'parameter';
                return view('product.detail', $data);
            }else{
                throw new Exception("something went wrong");
            }
        } catch (Exception $ex) {
            return redirect()->route('404-error',[], 301);
        }
    }

    protected function updateSEOData(&$data)
    {
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $data[ $key ] = replaceCityName($value);
            }
        }

        $data[ 'meta_footer' ] = replaceCityName($data[ 'meta_footer' ]);

        $this->seo->setTitle($data[ 'page_title' ]);
        $this->seo->setKeywords($data[ 'meta_keyword' ]);
        $this->seo->setDescription($data[ 'meta_description' ]);
        $this->seo->setCanonicalUrl(strtolower($data[ 'canonical_url' ]));
        $this->seo->setMetaFooter($data[ 'meta_footer' ]);
        $this->seo->setRobots($data[ 'robots' ]);
    }
}
