<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SitemapGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Dynamic Sitemap';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        try{
            $islocal  =   env('SITEMAP_LOCAL');
            // Get Active city list
            $api_url = env('API_URL');
            $url = $api_url.''.config('constants.city_detail');
          
            $n_city_details = handleGuzzleCurlRequest($url, 'GET');

            $n_city_details = $n_city_details['data'];
            $city_details = [];
            foreach($n_city_details as $city){
                $city_details[$city['id']] = $city['name'];
            }

            $path           =   public_path().'/sitemap';
            if(!\Illuminate\Support\Facades\File::exists($path)) 
                $makeDirectory  = \Illuminate\Support\Facades\File::makeDirectory($path, $mode = 0777, true);
            else
                $makeDirectory  =   true;
            
            if($makeDirectory || !$islocal){            
              
                $url    =   route('home');
              
                // Start Profile Sitemap Generator
                $return_profile     =   [];
                foreach($city_details as $key => $city_detail){
                    $profile   =   \DB::select("select * from vw_profile_search_v1 where isactive = 1 and city_id = $key and price > 0 and channel_type = 0 and b2b_channel_partner_id = 0");

                    $return_profile[$city_detail]   =   $profile;            
                }

                $view   =   view('sitemap.posts', [
                                'packages'      =>  $return_profile,
                                'live_url'      =>  $url,
                                'ptype'         =>  'profile'
                            ]);


                $xmlString      =   $view->render();
                
                if($islocal){
                    $dom            =   new \DOMDocument;
                    $dom->preserveWhiteSpace = True;
                    $dom->loadXML($xmlString);

                    //Save XML as a file
                    $file_name  =   $path.'/health-profiles-sitemap.xml';
                    $dom->save($file_name);
                    $permission =   chmod($file_name,0777);
                }else{
                    $s3             =   \Storage::disk('s3');
                    $filePath       =   '/sitemap/health-profiles-sitemap.xml';
                    $s3->put($filePath, $xmlString, 'public');                
                }
                // End Profile Sitemap Generator
                
                // Start Package Sitemap Generator
                
                $return_package     =   [];
                foreach($city_details as $key => $city_detail){

                    $packages   =   \DB::select("select * from vw_package_search_v1 where isactive = 1 and city_id = $key and price > 0  and channel_type = 0 and b2b_channel_partner_id = 0");

                    $return_package[$city_detail]   =   $packages;

                }
                $view   =   view('sitemap.posts', [
                                'packages'      =>  $return_package,
                                'live_url'      =>  $url,
                                'ptype'         =>  'package',
                                'city_list'     =>  $n_city_details
                            ]);
                $xmlString      =   $view->render();
                
                if($islocal){
                    $dom            =   new \DOMDocument;
                    $dom->preserveWhiteSpace = True;
                    $dom->loadXML($xmlString);

                    //Save XML as a file
                    $file_name  =   $path.'/health-packages-sitemap.xml';
                    $dom->save($file_name);
                    $permission =   chmod($file_name,0777);
                }else{
                    $s3             =   \Storage::disk('s3');
                    $filePath       =   '/sitemap/health-packages-sitemap.xml';
                    $s3->put($filePath, $xmlString, 'public');                
                }
        
                // End Package Sitemap Generator
                
                // Start Parameters Sitemap Generator
                
                $return_parameter   =   [];
                foreach($city_details as $key => $city_detail){
                    $parameter =   \DB::select("select * from vw_parameter_search_v1 where isactive = 1 and city_id = $key and price > 0 and channel_type = 0 and b2b_channel_partner_id = 0");

                    $return_parameter[$city_detail]   =   $parameter;

                }
                
                $view   =   view('sitemap.posts', [
                                'packages'      =>  $return_parameter,
                                'live_url'      =>  $url,
                                'ptype'         =>  'parameter'
                            ]);


                $xmlString      =   $view->render();
                if($islocal){
                    $dom            =   new \DOMDocument;
                    $dom->preserveWhiteSpace = True;
                    $dom->loadXML($xmlString);

                    //Save XML as a file
                    $file_name  =   $path.'/health-parameters-sitemap.xml';
                    $dom->save($file_name);
                    $permission =   chmod($file_name,0777);
                }else{
                    $s3             =   \Storage::disk('s3');
                    $filePath       =   '/sitemap/health-parameters-sitemap.xml';
                    $s3->put($filePath, $xmlString, 'public'); 
                }
                // End Parameters Sitemap Generator
               
                // Start Habit and Risk Sitemap Generator
                
                $risk_detail        =   $habit_detail   =   [];
                $this->api_url      =   env('API_URL');
                $url                =   $this->api_url.config('constants.getriskParameter');
                $risk_list_details  =   handleGuzzleCurlRequest($url, 'GET');
               

                $this->api_url      =   env('API_URL');
                $url                =   $this->api_url.config('constants.gethabitParameter');
                $habit_list_details =   handleGuzzleCurlRequest($url, 'GET');

                if(!empty($risk_list_details['data'])) {
                    $risk_list_details  =   $risk_list_details['data'];
                }

                if(!empty($habit_list_details['data'])) {
                    $habit_detail   =   $habit_list_details['data'];
                }
                $url    =   route('home');
                $view   =   view('sitemap.habitrisk', [
                                'risk_list_details'     =>  $risk_list_details,
                                'habit_details'         =>  $habit_detail,
                                'live_url'              =>  $url
                            ]);
                
                $xmlString  =   $view->render();
                
                if($islocal){
                    $dom    =   new \DOMDocument;
                    $dom->preserveWhiteSpace = True;
                    $dom->loadXML($xmlString);

                    //Save XML as a file
                    $file_name  =   $path.'/health-habit-risks-sitemap.xml';

                    $dom->save($file_name);
                    $permission     =   chmod($file_name,0777);
                }else{
                    $s3             =   \Storage::disk('s3');
                    $filePath       =   '/sitemap/health-habit-risks-sitemap.xml';
                    $s3->put($filePath, $xmlString, 'public'); 
                }
                
                if(!$islocal){
                    $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
                    $images = [];
                    $files = Storage::disk('s3')->files('sitemap');
                    foreach ($files as $file) {
                        $images[] =  $url . $file;
                    }
                    // End Habit and Risk Sitemap Generator
                    if(count($images) == 4)
                        $this->info("Sitemap Generated successfully");
                    else
                        $this->info("Something went wrong with S3 bucket");
                }else
                    $this->info("Sitemap Generated successfully");
                    
            }
        }catch(\Exception $e){
            $this->info($e->getMessage());
        }
    }
}
