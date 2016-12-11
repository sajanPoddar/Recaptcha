<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;

class TestController extends Controller
{
    //
    public function form()
    {
    	return view('layouts.form');
    }
    public function postform(Request $request)
    {
    	$name = $request->name;
    	$gender = $request->gender;
    	$token = $request->input('g-recaptcha-response');
    	if($token)
    	{	
    		// SERVER IMPLEMENTATION
    		$client = new Client();
    		$response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
    			'form_params' => array(
    					'secret' => '6LcGYA4UAAAAAPz4Y4V4Oy6pu_RENlld_TlqdX8N',
    					'response' => $token
    				)
    			]);
    		// body httprequest and get data contents as json
    		$results = json_decode($response->getBody()->getContents());
    		if($results->success)
    		{	
    			// dd($results);
    			Session::flash('success', 'yes, know you are human');
    			return view('layouts.name')->withName($name)->withGender($gender);

    		}
    		else
    		{
    			// $results->error_codes
    			Session::flash('error', 'you are not human');
    			return redirect('/');
    		}
    		
    	}
    	else
    	{
    		return redirect('/');
    	}

    }
}
