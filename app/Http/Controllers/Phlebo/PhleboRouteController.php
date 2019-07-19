<?php

namespace App\Http\Controllers\Phlebo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhleboRouteController extends Controller
{
    //
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
    
    public function index(){
        try{
            $data               =   [];
            $data['crm_api']    =   env('CRM_URL');
            $data['ht_api']     =   env('API_URL');
            return view('phlebo.route', $data);
            
        } catch (Exception $ex) {
            report($ex);
            return redirect()->back()->withErrors($ex->getMessage());
            return false;
        }
    }
    
}
