<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class PageController extends Controller
{
    public function check(){
    	$agent = new Agent();
    	// $languages = $agent->languages();
    	// $device = $agent->device();
    	// $platform = $agent->platform();
    	// $version_p = $agent->version($platform);
    	// $browser = $agent->browser();
    	// $version_b = $agent->version($browser);
    	// $robot = $agent->robot();
    	// return response()->json([
    	// 	'languages'=>$languages,
    	// 	'device'=> $device,
    	// 	'platform'=>$platform,
    	// 	'platform_version'=>$version_p,
    	// 	'browser'=>$browser,
    	// 	'browser_version'=>$version_b,
    	// 	'robot'=>$robot,
    	// 	'is_android'=>$agent->isAndroidOS(),
    	// 	'is_ios'=>$agent->is('OS X')
    	// ]);
    	if($agent->is('OS X')){
    		return view('page.android');
    	}else{
			return view('page.android');
    	}

    }
}
