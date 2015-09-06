<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use App\course;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CoursesController extends Controller
{
	//Returns the view
        public function courses($department_name, $department_number)
	{
		//filtering results in coursetable, based on department_name and department_number as passed in from department.blade
		$coursetable= course::where('dept_num', '=', $department_number)->where('department_name', '=', $department_name)->orderBy('sectionnumber','asc') ->get();
		$message = "";//needed for the view
		//Tells user if logged in or not.
		if (\Auth::check()) {
			$name = \Auth::user()->name;
		}
		else{$name = "Guest";}
		//returns the view courses. It passes coursetable, department_name, department_number, message, and name to the view
		return view('courses', compact('coursetable'), compact('department_name','department_number','message','name'));
	}
    //Adds a new tuple to courses
	public function store ($department_name, $department_number)
	{
		//Checks if user is Authorised
		if (\Auth::check()) {
			$newdescription = Request::get('description');//gets description from courses view
			$newcoursenumber = Request::get('sectionnumber');//gets section number from courses view
			//creates the new tuple
			course::insert(['department_name' => $department_name, 'dept_num' => $department_number, 'Description' => $newdescription, 'sectionnumber' => $newcoursenumber]);
		$message = "Add Course: Success";//tells user that it was a success
		}
		else{$message = "Add Course: Failed";}//tells user if it was a failure
		// filters results based on variables passed in to function to display desired courses. It will contain new tuple if successful
			$coursetable= course::where('dept_num', '=', $department_number)->where('department_name', '=', $department_name) ->orderBy('sectionnumber','asc') ->get();
		//tells user if logged in or not
		if (\Auth::check()) {
			$name = \Auth::user()->name;
		}
		else{$name = "Guest";}
		//returns the view courses. It passes coursetable, department_name, department_number, message, and name to the view
		return view('courses', compact('coursetable'), compact('department_name','department_number','message','name'));
	}
}
