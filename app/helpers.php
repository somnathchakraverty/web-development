<?php

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

function ywt_get_first_char($str) {
    if($str)
        return strtoupper(substr(trim($str), 0, 1));
 
    return false;
}

function newSignupValidation($userInfo){
    if((isset($userInfo['signUp']) && $userInfo['signUp']) || empty($userInfo['name']) || empty($userInfo['email']) || empty($userInfo['age']) || empty($userInfo['gender'])){
        return true;
    }else
        return false;
}

function getPageJsFile()
{
    $route = request()->route()->getName();
    
    switch ($route)
    {
        case ("home" || "product.listing"):
           
            return mix('/js/v2/app.js');
        break;
        default:
           
            return mix('/js/v2/main.js');
        break;
    }
}

function getPageCssLibraryFile()
{
    $route = request()->route()->getName();
    $file_name  =   'app.css';
    if($route   ==  'product.listing')
        $file_name  =   'search.css';
    
    try {
        $css_file   =   mix('/css/v2/' . $file);
    }
    catch (\Exception $e) {
        $css_file   =   '/css/backup/build/' . $file;
    }
    return  mix($css_file);    
}

function getPageJsLibraryFile()
{
    $route = request()->route()->getName();
   
    switch ($route)
    {
        case "home":
           
            return '/js/jquery.min.js';
        break;
        default:
           
            return '/js/jquery.min.js';
        break;
    }
}

function getWebPageSeo($unique_page_title) {

    $queryParam = [
        "title" => $unique_page_title,
        "source" => "web"
    ];

    $curl_url = env('CRM_URL').config('constants.get_seo_content');

    $response_data = handleGuzzleCurlRequest($curl_url, 'Get', null, [], $queryParam, 'application/x-www-form-urlencoded');
    
    return $response_data;
}

function getWebPageCMSContent($slug) {
    $queryParam = [
        "slug" => $slug,
        "source" => "web"
    ];
    $curl_url = env('CRM_URL').config('constants.get_cms_page_content');

    $response_data = handleGuzzleCurlRequest($curl_url, 'Get', null, [], $queryParam, 'application/x-www-form-urlencoded');
    
    return $response_data;
}

function handleGuzzleCurlRequest($url, $request_method = 'Get', $auth = null, $bodyParam = [], $queryParam = [] , $content_type='application/json'){
    try{
        $client = new Client();

        $headerParams = [
            'Content-type' => $content_type
        ];

        if($auth != null)
            $headerParams['X-API-TOKEN'] = $auth ;
        
        $parameter = [
            'query' => $queryParam,
            'connect_timeout' => 30,
            'http_errors' => TRUE,
            'headers' => $headerParams,
            'protocols'       => ['http', 'https'],
            'verify' => true
        ];
        
        if($content_type === 'application/json' && count($bodyParam) > 0) {
            $bodyParam['ip'] = getRealIpAddr();
            $parameter['json'] = $bodyParam;
        }

        if($content_type === 'application/x-www-form-urlencoded' && count($bodyParam) > 0) {
            $bodyParam['ip'] = getRealIpAddr();
            $parameter['form_params'] = $bodyParam;
        }
        
        // Create a PSR-7 request object to send
        $response  = $client->request($request_method, $url, 
                $parameter
            );
        
        $content    =   (string) ($response->getBody());
        
        $APIData    =   (array)json_decode($content, true);
    
        return $APIData;
    } catch (\GuzzleHttp\Exception\ClientException $exception) {
        logGenerate($exception->getMessage());
        // var_dump(get_class_methods($exception->getResponse()->getBody()));exit;
        return (array)json_decode((string)$exception->getResponse()->getBody(), true);
        /*
        $error_response = json_decode($exception->getMessage(), true);
        unset($error_response['data']);
        $error_response['code'] = 500;
        return $error_response;
        */
    }catch (\Exception $exception) {
        logGenerate($exception->getMessage());
        return $exception->getMessage();
        /*
        $error_response = json_decode($exception->getMessage(), true);
        unset($error_response['data']);
        $error_response['code'] = 500;
        return $error_response;
        */
    }

}

function handleCurlRequest($url, $request_method = 'Get', $parameter = []){
    $curl = curl_init();

    $curl_parameter = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_TIMEOUT => 300000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_HTTPHEADER => array(
            // Set Here Your Requesred Headers
            'Content-Type: application/json',
        )
    );
    switch ($request_method) {
        case 'POST':
            $curl_parameter[CURLOPT_POST] = 1;
            $curl_parameter[CURLOPT_POSTFIELDS] = json_encode($parameter);
            break;
        case 'PUT':
            $curl_parameter[CURLOPT_CUSTOMREQUEST] = 'PUT';
            break;
        default:
            $curl_parameter[CURLOPT_CUSTOMREQUEST] = 'GET';
    }
    curl_setopt_array($curl, $curl_parameter);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        return $err;
    } else {
        return json_decode($response, true);
    }
}

function calPer($dis_val, $mrp_val){
    if($mrp_val > 0)
        return number_format((($mrp_val - $dis_val) / $mrp_val ) * 100,0);
    else
        return 0;
}

function sumArraykey($data, $price_key) {
    /**
     * get calculate sum from list of assciative array using defined key
     */
    $sum = 0;

    foreach ($data as $test) {
        $sum = $sum + (int)$test[$price_key];
    }
    return $sum;
}
/*
function checkFirstTimePopDisplay() {
    
    $data = \DB::table('config_master')
                ->where(["module" => 'web'])
                ->where(["key" => 'first_tym_popup'])->first();
    return $data;
}
*/
/**
  * @author Pawan Kumar
  * @param type $userUniqueSalt
  * @return type
  */
function encryptUserSalt($userId) {
    
    $data = \App\Models\DealUserManagement::getUserDetailByUserId($userUniqueEncryptSalt, ['user_id', 'unique_salt']);
    
    if(empty($data->unique_salt)) {
        $unique_salt = unique_salt();
        $data = \DB::table('deal_user_management')
                    ->where(["user_id" => $userId])
                    ->update(['unique_salt' => $unique_salt]);
        
        return md5($unique_salt.$userId);
    }

    return md5($data->unique_salt.$userId);
}

/**
  * @param type $userUniqueEncryptSalt
  * @return type
  */

function decryptUserSalt($userUniqueEncryptSalt) {

    $decodeUniqueEncrypt = $userUniqueEncryptSalt;
    $data = \App\Models\DealUserManagement::getUserDetailByEncyUserId($userUniqueEncryptSalt, ['user_id', 'unique_salt']);
    
    //echo $CI->db->last_query(); exit();
    if(isset($data->user_id)) {
        return $data->user_id;
    }
    else {
        return null;
    }    
}

function getAuthUserIDByToken($token_id){
    $user_id = null;
    if(session()->has('auth_'.$token_id)){
        $user_id = session()->get('auth_'.$token_id);
    }else{
        
    }
    return $user_id;
}

/**
 * Display Date Format Display Utility
 */
function convertUserVisibleDateFormat($date_string) {
    if(!empty($date_string)) {
        if($date_string != '0000-00-00') {
            return  date('d M, Y',strtotime($date_string));
        }
        else {
            return '-';
        }
    }
    else {
        return '-';
    }
}

function convertUserVisibleDateTimeFormat($date_string) {
    if(!empty($date_string)) {
        if($date_string != '0000-00-00 00:00:00') {
            $d_t = explode(" ", $date_string);    
            return  date('d M, Y',strtotime($d_t[0]));
        }
        else {
            return '-';
        }
        
    }
    else {
        return '-';
    }
    
}

function convertUserVisibleDateWithDayFormat($date_string) {
    if(!empty($date_string)) {
        if($date_string != '0000-00-00 00:00:00') {
            return  date('D, d M Y',strtotime($date_string));
        }
        else {
            return '-';
        }
    }
    else {
        return '-';
    }
}

function calPackageCount($cart_detail){
    $cart_count     =   0;
    if($cart_detail['customer_detail'] && is_array($cart_detail['customer_detail'])){
        foreach($cart_detail['customer_detail'] as $customer_detail){
            $cart_count     +=   count($customer_detail['deals']);
        }
    }
    return $cart_count;
}

function mapPackageCustomer($cart_detail){
    $map_array     =   [];
    if($cart_detail['customer_detail'] && is_array($cart_detail['customer_detail'])){
        foreach($cart_detail['customer_detail'] as $customer_detail){
            foreach($customer_detail['deals'] as $deal)
                $map_array[]    =   $deal['id'] .'_' .$customer_detail['customer_id'];
        }
    }
    return $map_array;
}

function memcacheServers()
{
    if (env('APP_ENV') == 'development') {
        return [
            ['host' => env('MEMCACHED_HOST_1', 'localhost'), 'port' => env('MEMCACHED_PORT_1', '11211'), 'weight' => 100],
            ['host' => env('MEMCACHED_HOST_2', 'localhost'), 'port' => env('MEMCACHED_PORT_2', '11211'), 'weight' => 100],
        ];
    }else
    {
        return [
            ['host' => env('MEMCACHED_HOST_1', 'localhost'), 'port' => env('MEMCACHED_PORT_1', '11211'), 'weight' => 100],
        ];
    }
}

function nameInitials($name)
{
    $words = explode(" ", $name);
    $words = array_filter($words);
    
    $acronym = "";

    foreach ($words as $w) {
        $acronym .= $w[0];
    }

    $return = (!empty($acronym)) ? $acronym : $name[0];

    return strtoupper($return);
}

function authLogGenerate($message, $user_id)
{
    $route_name     =   request()->route()->getName();
    $host_name      =   gethostname();
    \Log::error("{{$route_name}} | Host name :: {{$host_name}} | Error:: {{ $message }} - User Id - {{$user_id}}");
}

function logGenerate($message)
{
    $route_name     =   request()->route()->getName();
    $host_name      =   gethostname();
    if(auth()->check()){
        $token_id   =   auth()->user()->id;
        if(session()->has('auth_'.$token_id) && isset(session()->get('auth_'.$token_id)['user_id'])){
            $user_id    =   session()->get('auth_'.$token_id)['user_id'];
            \Log::error("{{$route_name}} | Host name :: {{$host_name}} | Error:: {{ $message }} - User Id - {{$user_id}}");
        }
    }else
        \Log::error("{{$route_name}} | Host name :: {{$host_name}} | Error:: {{ $message }}");
}

function replaceCityName($text)
{
    $city_name = (!empty(\Cookie::get('sLocation'))) ? \Cookie::get('sLocation') : 'Gurgaon';

    return preg_replace("/{CITY_NAME}/", $city_name, $text);
}

function isMobile()
{
    $a = (new Jenssegers\Agent\Agent());
    $return = ($a->isMobile() || $a->isPhone()) ? true : false;
    return $return;
}

function create_slug($string)
{
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', trim($string));
    $slug = strtolower($slug);
    $slug = str_replace("---", "-", $slug);
    $slug = str_replace("--", "-", $slug);
    $slug = trim($slug, "-");
    return $slug;
}

function getCityNameFromCookies(){
    $city_name      =   request()->cookie('sLocation');
    if(empty($city_name))
        return config()->get('constants.default_city');
    else{
        $city_name      =   str_replace('_', ' ', strtolower($city_name));
        return  $city_name;
    }
}

function getCityIdFromCookies(){
    $city_id      =   request()->cookie('sLocationID');
    if(empty($city_id))
    {
        return config()->get('constants.default_city_id');
    }
    else
    {
        return  $city_id;
    }
}


function getUrlCityName(){
    $city_name      =   request()->cookie('sLocation');
    if(empty($city_name))
        return config()->get('constants.default_city');
    else{
        $city_name      =   str_replace(' ', '_', strtolower($city_name));
        return  $city_name;
    }
}

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function urlsafe_b64encode($string) {
    $data = base64_encode($string);
    $data = str_replace(array('+','/','='),array('-','_',''),$data);
    return $data;
}

function urlsafe_b64decode($string) {
    $data = str_replace(array('-','_'),array('+','/'),$string);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    return base64_decode($data);
}

function encryptString($string){
    $encryption_key     =   env('ENCRYPT_KEY');
    $cipher             =   "AES-128-CBC";
    $iv                 =   config('constants.openssl_iv');

    $ciphertext_raw     =   openssl_encrypt($string, $cipher, $encryption_key, $options=OPENSSL_RAW_DATA, $iv);
    $ciphertext_raw     =   urlsafe_b64encode($ciphertext_raw);
    return $ciphertext_raw;
}

function decryptString($encrypt_string){
    $encrypt_string     =   urlsafe_b64decode($encrypt_string);
    $encryption_key     =   'HEALTHIANS@#$20190301$#@COM';
    $cipher             =   "AES-128-CBC";
    $iv                 =   '2333DFGG45df%^sf';
    
    $decrypt_string     =   openssl_decrypt($encrypt_string, $cipher, $encryption_key, $options=OPENSSL_RAW_DATA, $iv);
    return $decrypt_string;
}

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function checkThreeDecimals($a) {
    if(is_float($a)) {
        $sd = explode('.', $a);
        if(!empty($sd[1])) {
            $len =  strlen((string)$sd[1]);
            if($len>2) {
                return true;
            }
        }
    }
    return false;
}

function getLineGraph($testValue, $startValue, $endValue) {
    
    $valArray = [
        "lineRange" => []
    ];

    $color_width = 0.2;

    if(checkThreeDecimals((float)$startValue) || checkThreeDecimals((float)$testValue) || checkThreeDecimals((float)$endValue)) {
        if($endValue-$startValue > 0) {
            $color_width = 0.02;
        }
    }

    // report value is low
    if($testValue < $startValue) {
        $minRange   =   $testValue  -   ($testValue * $color_width);
        $maxRange   =   $endValue   +   ($endValue * $color_width);
        $fullWidth  =   $maxRange   -   $minRange;
        $width1     =   ($startValue-$minRange) / $fullWidth * 95;
        $width2     =   ($endValue-$startValue)/$fullWidth * 95;
        $width3     =   ($maxRange-$endValue)/$fullWidth * 95;
        $valArray['lineRange'][] = [
            'start_range'       =>  $minRange,
            'end_range'         =>  $startValue,
            'color'             =>  "red",
            "backgroundColor"   =>  "#fba475",
            "width"             =>  round($width1,2)
        ];
        $valArray['lineRange'][] = [
            'start_range'       =>  $startValue,
            'end_range'         =>  $endValue,
            'color'             =>  "green",
            "backgroundColor"   =>  "#aafc5e",
            "width"             =>  round($width2,2)
        ];
        $valArray['lineRange'][] = [
            'start_range'       =>  $endValue,
            'end_range'         =>  $maxRange,
            'color'             =>  "red",
            "backgroundColor"   =>  "#fba475",
            "width"             =>  round($width3,2)
        ];

        $pointPosition              =   ($testValue-$minRange)/$fullWidth * 95;
        $valArray['pointPosition']  =   round($pointPosition,2);
        $valArray['bgColor']        =   "#fba475";
        $valArray['paramMsg']       =   "Borderline Result";
    }

    // report value is high
    if($testValue > $endValue) {
        $minRange   =   $startValue  - ($startValue * $color_width);
        $maxRange   =   $testValue   + ($testValue * $color_width);
        $fullWidth  =   $maxRange    - $startValue;
        if($startValue > 0) {
            $fullWidth  =   $maxRange - $minRange;
            $width1     =   ($startValue - $minRange)/$fullWidth * 95;
            $valArray['lineRange'][]  =   [
                'start_range'       =>  $minRange,
                'end_range'         =>  $startValue,
                'color'             =>  "red",
                "backgroundColor"   =>  "#fba475",
                "width"             =>  round($width1,2)
            ];
            $pointPosition              =   ($testValue-$minRange)/$fullWidth *95;
            $valArray['pointPosition']  =   round($pointPosition,2);
        }
        else {
            $minRange                   =   0;
            $pointPosition              =   ($testValue-$startValue)/$fullWidth *95;
            $valArray['pointPosition']  =   round($pointPosition,2);
        }
        $width2                     =   ($endValue-$startValue)/$fullWidth * 95;
        array_push($valArray['lineRange'],  [
            'start_range'       =>  $startValue,
            'end_range'         =>  $endValue,
            'color'             =>  "green",
            "backgroundColor"   =>  "#aafc5e",
            "width"             =>  round($width2,2)
        ]);
        $width3                     =   ($maxRange-$endValue)/$fullWidth * 95;
        array_push($valArray['lineRange'], [
            'start_range'       =>  $endValue,
            'end_range'         =>  $maxRange,
            'color'             =>  "red",
            "backgroundColor"   =>  "#fba475",
            "width"             =>  round($width3,2)
        ]);
        $valArray['bgColor']    =   "#fba475";
        $valArray['paramMsg']   =   "Borderline Result";
    }

    // report value is normal
    if(($testValue >= $startValue) && ($testValue <= $endValue)) {
       
        $minRange   =   $startValue - ($startValue * $color_width);
        $maxRange   =   $endValue   + ($endValue * $color_width);
        $fullWidth  =   $maxRange   - $startValue;
        if($startValue > 0) {
        
            $fullWidth                =   $maxRange - $minRange;
            $width1                   =   ($startValue-$minRange)/$fullWidth * 95;
            array_push($valArray['lineRange'], [
                'start_range'       =>  $minRange,
                'end_range'         =>  $startValue,
                'color'             =>  "red",
                "backgroundColor"   =>  "#fba475",
                "width"             =>  round($width1,2)
            ]);
            $pointPosition                = ($testValue - $minRange)/$fullWidth *95;
            $valArray['pointPosition']    =   round($pointPosition,2);
        }
        else {
            $minRange                     =   0;
            $pointPosition                =   ($testValue - $startValue)/$fullWidth *95;
            $valArray['pointPosition']    =   round($pointPosition,2);
        }

        $width2                   =   ($endValue - $startValue)/$fullWidth * 95;
        array_push($valArray['lineRange'],  [
            'start_range'       =>  $startValue,
            'end_range'         =>  $endValue,
            'color'             =>  "green",
            "backgroundColor"   =>  "#aafc5e",
            "width"             =>  round($width2,2)
        ]);
        $width3                   = ($maxRange-$endValue)/$fullWidth * 95;
        array_push($valArray['lineRange'],  [
            'start_range'       =>  $endValue,
            'end_range'         =>  $maxRange,
            'color'             =>  "red",
            "backgroundColor"   =>  "#fba475",
            "width"             =>  round($width3,2)
        ]);

        $valArray['bgColor']  =   "#8de33e";
        $valArray['paramMsg'] =   "Everything looks good";
    }

    $html = '<div class="parametermarker">';
    $html .= '  <div class="markerright">';
    $html .= '      <div class="clipgraph">';
    $html .= '          <div style="display:block; position:relative; margin-top:15px;">';
    $html .= '              <div style="position:absolute; width:3px; height:40px; background:#00a0a8; left:'.$valArray['pointPosition'].'%; top:-14px; font-size:82px; color:#00a0a8;">
                                <font style="margin-left:-8px; line-height: 30px; font-size: 30px;
    top: 2px; position: absolute; color: #000;">•</font>
                                    <p class="youpoint">You</p>
                            </div>';

    foreach ($valArray['lineRange'] as $key => $valueRange) {
        $html .= '<div style="display:inline-block;vertical-align:top;margin-right:3px;width:'.$valueRange['width'].'%; text-align:center;">';
        $html .= '<p style="background:'.$valueRange['backgroundColor'].';border-radius:10px; height:10px;">&nbsp;</p>';
        
        if($valueRange['color']=="green") {
            $html .= '<div style="display:block;">';
            $html .= '  <span style="width:100%; font-size:15px;">';
            $html .= '      <p style="display: inline-block; float:left;margin: 0; padding: 0;color: #000000;">'.$valueRange['start_range'].'</p>';
            $html .= '      <p style="display: inline-block; float:right;margin: 0; padding: 0;color: #000000;">'.$valueRange['end_range'].'</p>';
            $html .= '  </span> 
                    </div>';
        }
        $html .= '</div>';
    } 
    
    $html .= '</div></div></div></div>';

    return $html;
}

function getSmartReportGraphMessage($testValue, $startValue, $endValue, $isCritical) {

    if(($testValue >= $startValue) && ($testValue <= $endValue)) {
        return '<button type="button" class="btn btn-success-section positiveresult"> Everything looks good </button>';
    }
    else {
        if($isCritical == 1) {
            return '<button type="button" class="btn btn-success-section borderlineresult"> Some borderline results </button>';
        }
        else {
            return '<button type="button" class="btn btn-success-section correlateclinical"> Please Correlate Clinically </button>';
        }
    }
       
}

function check_critical_param($data) {
    $response  = false;
    foreach ($data as $prt) {
        if($prt['isCriticalParam'] == 1) {
            return true;
        }
    }

    return $response;
}

