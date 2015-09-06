<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use App\department;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
	//Displays departments. Requires the variable $school_name to filter results
        public function department($school_name)
	{
		//Filters the department table based on the school name
		$departmenttable= department::where('school_name', '=', $school_name)-> get();
		$message = ""; //Required for the view
		//Needed to tell the user if logged in or not
		if (\Auth::check()) {
			$name = \Auth::user()->name;
		}
		else{$name = "Guest";}
		//returns the view department. It passes the department table, school_name, message, and name to the view
		return view('department', compact('departmenttable'), compact('school_name','message','name'));
	}

	//adds new department. It requires $school_name in order to create the tuple and update the view
	public function store ($school_name)
	{
		//Checks if user is authorised to add a new tuple
		if (\Auth::check()) {
			$newdepartmentname = Request::get('departmentname'); //gets the department name from the department view
			$newdepartmenturl = Request::get('departmentURL');   //gets the department url from the department view
			//adds a new tuple to the department table. Note department number is an auto incremented integer.
			department::insert(['department_name' => $newdepartmentname, 'dept_url' => $newdepartmenturl, 'school_name' => $school_name]);
		$message = "Department Added: Success!";// indicates that the tuple was added
		}
		else{$message = " Department Added: Failed";} // indicates that the new tuple was not added
		//filters department table based on $school_name, which was passed into function. It includes new Tuple if successful
			$departmenttable= department::where('school_name', '=', $school_name)-> get();
		//Tells user if logged in or not in view
		if (\Auth::check()) {
			$name = \Auth::user()->name;
		}
		else{$name = "Guest";}
		//returns the view department. It passes the departmenttable, school_name, message, and name to the view
		return view('department', compact('departmenttable'), compact('school_name','message','name'));
	}
}
