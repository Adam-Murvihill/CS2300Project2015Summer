<?php

namespace App\Http\Controllers;
//use Illuminate\Http\Request;
use App\school;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;

class SchoolController extends Controller
{
	//Displays school
        public function school()
	{
		$schooltable = school::all(); //call the table from the model school. all() selects all
		$message = ""; //Satifies the $message variable on the view
		//Tells user if logged in or not
		if (\Auth::check()) {
			$name = \Auth::user()->name;
		}
		else{$name = "Guest";}
		//returns the view school, and passes the table with the selected schools, the message, and the user name to the view
		return view('school', compact('schooltable', 'message','name'));
	}

	//Adds tuples to the schools table
	public function store ()
	{
		//checks if the user is authorised to add school
		if (\Auth::check()) {
			$newschoolname = Request::get('schoolname'); // calls the school name from the school view file
			$newschoolurl = Request::get('schoolURL'); // calls the school url from the school view file
			school::insert(['school_name' => $newschoolname, 'school_url' => $newschoolurl]); //inserts the new data into a new tuple
			$message = "School Added: Success";// indicates success to the user
		}
		else{$message = "School Added: Failed";}// indicates failure to the user
		$schooltable = school::all(); //calls the schools from the model school. all() selects all, included the new entry
		//Tells user if logged in or not. necessary for the view
		if (\Auth::check()) {
			$name = \Auth::user()->name;
		}
		else{$name = "Guest";}
		//returns the school view, and passes the schooltable, the message, and user name to the view
		return view('school', compact('schooltable', 'message','name'));
	}

}
