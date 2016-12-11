<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    		return view('layouts.name')->withName($name)->withGender($gender);
    	}
    	else
    	{
    		return redirect('/');
    	}

    }
}
