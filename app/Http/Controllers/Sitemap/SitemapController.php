<?php

namespace App\Http\Controllers\Sitemap;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Storage;

class SitemapController extends Controller
{
    //
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
    
    public function index(){
        try{
           
            return response()->view('sitemap.index')->header('Content-Type', 'text/xml');
            
        } catch (Exception $ex) {
            report($ex);
            return redirect()->back()->withErrors($ex->getMessage());
            return false;
        }
    }
    
    public function generateSitemap($token){
        try{
            if($token   ===   env('SITEMAP_TOKEN')){              
                $return_artisan =   \Artisan::call("sitemap:generator");
                
                $return_artisan =    \Illuminate\Support\Facades\Artisan::output();
                if($return_artisan == "Sitemap Generated successfully\n"){
                    return response()->json([
                        'status'    =>  true,
                        'message'   =>  'Sitemap generated successfully'
                    ], 200); // Status code here
                }else
                    throw new Exception($return_artisan);
            }else{
                 throw new Exception("Authentication fail");
            }
            
        } catch (Exception $ex) {
            report($ex);
            return response()->json([
                        'status'    =>  false,
                        'message'   =>  'Sitemap generated successfully'
                    ], 404); // Status code here
        }
    }
    
    public function healthPackages(){
        try{
            $islocal  =   env('SITEMAP_LOCAL');
            $file_name  =   'sitemap/health-packages-sitemap.xml';
            $file_dir = null;
            if($islocal){
                $file_dir   =   route('home').'/sitemap/health-packages-sitemap.xml';
            }else{
                $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
                $files = Storage::disk('s3')->files('sitemap');
                foreach ($files as $file) {
                    if($file  ==    $file_name){
                        $file_dir   =   $url . $file;
                    }
                }
            }
            
            if(!empty($file_dir)){
                $file_headers   =   @get_headers($file_dir);
                if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
                    throw new Exception("File not found fail");
                }else{
                    return response(file_get_contents($file_dir), 200, [
                        'Content-Type' => 'application/xml'
                    ]);
                } 
            }else
                throw new Exception("File not found fail");
        } catch (Exception $ex) {
            report($ex);
            return redirect()->route('404-error',[], 301);
        }
    }
    
    public function healthParameters(){
        try{
            $islocal  =   env('SITEMAP_LOCAL');
            $file_name  =   'sitemap/health-parameters-sitemap.xml';
            $file_dir = null;
            if($islocal){
                $file_dir   =   route('home').'/sitemap/health-parameters-sitemap.xml';
            }else{
                $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
                $files = Storage::disk('s3')->files('sitemap');
                foreach ($files as $file) {
                    if($file  ==    $file_name){
                        $file_dir   =   $url . $file;
                    }
                }
            }
            if(!empty($file_dir)){
                $file_headers   =   @get_headers($file_dir);
                if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
                    throw new Exception("File not found fail");
                }else{
                    return response(file_get_contents($file_dir), 200, [
                        'Content-Type' => 'application/xml'
                    ]);
                } 
            }else
                throw new Exception("File not found fail");
            
        } catch (Exception $ex) {
            report($ex);
            return redirect()->route('404-error',[], 301);
        }
    }
    
    public function healthProfiles(){
        try{
            $islocal  =   env('SITEMAP_LOCAL');
            $file_name  =   'sitemap/health-profiles-sitemap.xml';
            $file_dir = null;
            if($islocal){
                $file_dir   =   route('home').'/sitemap/health-profiles-sitemap.xml';
            }else{
                $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
                $files = Storage::disk('s3')->files('sitemap');
                foreach ($files as $file) {
                    if($file  ==    $file_name){
                        $file_dir   =   $url . $file;
                    }
                }
            }
            if(!empty($file_dir)){
                $file_headers   =   @get_headers($file_dir);
                if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
                    throw new Exception("File not found fail");
                }else{
                    return response(file_get_contents($file_dir), 200, [
                        'Content-Type' => 'application/xml'
                    ]);
                } 
            }else
                throw new Exception("File not found fail");
            
        } catch (Exception $ex) {
            report($ex);
            return redirect()->route('404-error',[], 301);
        }
    }
    
    public function healthHabitRisk(){
        try{
            $islocal  =   env('SITEMAP_LOCAL');
            $file_name  =   'sitemap/health-habit-risks-sitemap.xml';
            $file_dir = null;
            if($islocal){
                $file_dir   =   route('home').'/sitemap/health-habit-risks-sitemap.xml';
            }else{
                $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
                $files = Storage::disk('s3')->files('sitemap');
                foreach ($files as $file) {
                    if($file  ==    $file_name){
                        $file_dir   =   $url . $file;
                    }
                }
            }
            if(!empty($file_dir)){
                $file_headers   =   @get_headers($file_dir);
                if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
                    throw new Exception("File not found fail");
                }else{
                    return response(file_get_contents($file_dir), 200, [
                        'Content-Type' => 'application/xml'
                    ]);
                } 
            }else
                throw new Exception("File not found fail");
        } catch (Exception $ex) {
            report($ex);
            return redirect()->route('404-error',[], 301);
        }
    }
}
