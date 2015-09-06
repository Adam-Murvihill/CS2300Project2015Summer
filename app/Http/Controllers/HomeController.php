<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	//To return the view of home for display
    public function Home()
	{
		//To tell the user if logged in or Not
		if (\Auth::check()) {
			$name = \Auth::user()->name;
		}
		else{$name = "Guest";}//Not logged in
		//returns home view and passes the name to the view
		return view('home',compact('name'));
	}
}
