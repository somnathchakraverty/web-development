<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class AppNavigationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        //$this->middleware('auth');
    }

    public static function systemInfo()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform    = "Unknown OS Platform";
        $os_array       = array('/windows phone 8/i'    =>  'Windows Phone 8',
                                '/windows phone os 7/i' =>  'Windows Phone 7',
                                '/windows nt 6.3/i'     =>  'Windows 8.1',
                                '/windows nt 6.2/i'     =>  'Windows 8',
                                '/windows nt 6.1/i'     =>  'Windows 7',
                                '/windows nt 6.0/i'     =>  'Windows Vista',
                                '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                                '/windows nt 5.1/i'     =>  'Windows XP',
                                '/windows xp/i'         =>  'Windows XP',
                                '/windows nt 5.0/i'     =>  'Windows 2000',
                                '/windows me/i'         =>  'Windows ME',
                                '/win98/i'              =>  'Windows 98',
                                '/win95/i'              =>  'Windows 95',
                                '/win16/i'              =>  'Windows 3.11',
                                '/macintosh|mac os x/i' =>  'Mac OS X',
                                '/mac_powerpc/i'        =>  'Mac OS 9',
                                '/linux/i'              =>  'Linux',
                                '/ubuntu/i'             =>  'Ubuntu',
                                '/iphone/i'             =>  'iPhone',
                                '/ipod/i'               =>  'iPod',
                                '/ipad/i'               =>  'iPad',
                                '/android/i'            =>  'Android',
                                '/blackberry/i'         =>  'BlackBerry',
                                '/webos/i'              =>  'Mobile');
        $found = false;
        $device = '';
        foreach ($os_array as $regex => $value) 
        { 
            if($found)
             break;
            else if (preg_match($regex, $user_agent)) 
            {
                $os_platform    =   $value;
                $device = !preg_match('/(windows|mac|linux|ubuntu)/i',$os_platform)
                          ?'MOBILE':(preg_match('/phone/i', $os_platform)?'MOBILE':'SYSTEM');
            }
        }
        $device = !$device? 'SYSTEM':$device;
        return array('os'=>$os_platform,'device'=>$device);
    }

     public static function browser() 
     {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $browser        =   "Unknown Browser";

        $browser_array  = array('/msie/i'       =>  'Internet Explorer',
                                '/firefox/i'    =>  'Firefox',
                                '/safari/i'     =>  'Safari',
                                '/chrome/i'     =>  'Chrome',
                                '/opera/i'      =>  'Opera',
                                '/netscape/i'   =>  'Netscape',
                                '/maxthon/i'    =>  'Maxthon',
                                '/konqueror/i'  =>  'Konqueror',
                                '/mobile/i'     =>  'Handheld Browser');

        foreach ($browser_array as $regex => $value) 
        { 
            if($found)
             break;
            else if (preg_match($regex, $user_agent,$result)) 
            {
                $browser    =   $value;
            }
        }
        return $browser;
     }

    public function appDownload()
    {
        $url = env('FRONT_URL');
        $detail = self::systemInfo();
        $scheme = 'healthians';
        if($detail['device'] == "SYSTEM")
        {
            header("Location: ".$url);
        }
        elseif ($detail['device'] == "MOBILE") 
        {
            if($detail['os'] == "Android")
            {

                if(self::browser() == "Chrome")
                {
                    //header("Location: https://play.google.com/store/apps/details?id=com.healthians.main.healthians&hl=en_IN");
                    header("Location: intent://scan/#Intent;scheme=healthians;package=com.healthians.main.healthians;end");
                }
                else
                {
                     header("Location: market://details?id=com.healthians.main.healthians");
                }
                
                return;
            }
            elseif ($detail['os'] == "iPhone" || $detail['os'] == "iPad") 
            { 
                header("Location: itms://itunes.apple.com/in/app/healthians/id1453011241?mt=8");
                //header("Location: ".$scheme . "://view?id=1453011241");
                return;
            }
        }
        else
        {
            header("Location: ".$url);
        }
    }

}
