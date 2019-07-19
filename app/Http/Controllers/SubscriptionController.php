<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Exception;

class SubscriptionController extends Controller
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
    
    public function getSubscriptionSlider(Request $request) {
        /**
         * This is for Subscription Slider HTML on Home Page
         */

        $data = [
            'html_data'    => ''
        ];

        $subscription_list = $this->getSubscriptionBundleList();
        $subscription_slider_html = '';
        
        if(!empty($subscription_list)) {

            foreach($subscription_list as $item) {
                $subscription_slider_html .= '<div class="recomendation-area">
                    <div class="recomendation-upper">
                        <h4><a href="/subscriptionDetail/'.$item['id'].'" class="know-more" target="_blank">'.$item['name'].'</a></h4>
                        <p>'.$item['frequencyMessage'].'</p>
                    </div>
                    <div class="recomendation-bottom">';

                    if(isset($item['deal_detail']) && count($item['deal_detail']) > 0) {
                        $subscription_slider_html .= '<h5>Includes : <b>'.$item['total_parameters'];

                        if((int) $item['total_parameters'] == 1) {
                            $subscription_slider_html .= ' Parameter';
                        }
                        else {
                            $subscription_slider_html .= ' Parameters';
                        }
                        
                        $subscription_slider_html .= '</b></h5><ul>';
                        foreach($item['deal_detail'] as $key1 => $test1) {
                            if ($key1 < 3) {
                                $subscription_slider_html .= '<li>'.$test1['name'].'</li>';
                            }
                        }
                        $subscription_slider_html .= '</ul>';
                    }

                    $subscription_slider_html .= '<a href="/subscriptionDetail/'.$item['id'].'" class="know-more" target="_blank">+ Know More</a>
                                <div class="subscriptionprice"><span>₹</span>'.$item['price'].' </div>
                            </div>
                        </div>';
            }
        }

        $data['html_data'] = $subscription_slider_html;

        return response()->json($data, 200);
    }

    public function subscriptionList(Request $request) {
        /**
         * Subscription List Page
         */
        
        $data = [
            'subscription_list'         => [],
            'subscription_banner_data'  => []
        ];

        $data['subscription_list']      = $this->getSubscriptionBundleList();

        if(!empty($data['subscription_list'])) {
            // Top 3 lowest price package in banner slider
            $data['subscription_banner_data']  = $this->subscription_top_data($data['subscription_list'], 'price');
        }

        return view('subscription.subscription_list', $data);
    }

    public function subscriptionDetail(Request $request, $id) {
        /**
         * Subscription Details Page
         */

        $data = [
            'subscription_list'    => []
        ];

        $data['subscription_list'] = $this->getSubscriptionBundleList();

        return view('subscription.subscription_details', $data);
    }

    public function getSubscriptionBundleList() {
        /**
         * Get Data from Subscription Bundle List API
         */
        $response_data = [];

        /* Hit Api */
        $request_data   = [];
        $this->api_url  = env('API_URL');
        $url            = $this->api_url.config('constants.getSubscriptionBundleList');
        $details        = handleGuzzleCurlRequest($url, 'POST', null, $request_data, []);

        if(!empty($details['data'])) {
            $response_data = $details['data'];
        }

        return $response_data;
    }

    private function subscription_top_data($data, $key = 'healthian_price', $limit = 3) {
        /**
         * This is for Top 3 lowest price package in banner slider
         */

        $temp_data = $data;
        array_multisort(array_column($temp_data, $key), SORT_ASC, $temp_data);
        $temp_data = array_slice($temp_data,0,$limit);
        
        return $temp_data;
    }

}
