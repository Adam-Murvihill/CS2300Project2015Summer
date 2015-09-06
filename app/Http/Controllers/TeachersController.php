<?php

namespace App\Http\Controllers;

use Request;
use App\teachers;
use App\teachcourse;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TeachersController extends Controller
{
	//returns the view using the tables teachers, and teachcoursedb
        public function teachers($department_name, $department_number, $coursenumber)
		{
			//joins the tables and filters based on the variables passed into this function
			$teachertable = teachers:: join('teachcoursedb', 'TID', '=', 'teachcoursedb.TeID')->where('dept_numb', '=', $department_number)->where('department_name', '=', $department_name)->where('coursenumber', '=', $coursenumber)->get();
			$message = "";//required for view
            //Tells user if logged in or not
			if (\Auth::check()) {
				$name = \Auth::user()->name;
			}
			else{$name = "Guest";}
		    // returns the teachers view. passes the teachertable, department_name, department_number, coursenumber, message, and name into the teachers view
			return view('teachers', compact('teachertable'), compact('department_name','department_number','coursenumber','message','name'));
	}

	//adds new teacher tuple, and/or teachcourse tuple
	public function store ($department_name, $department_number, $coursenumber)
	{
		//Checks if user is authorised to add tuple
		if (\Auth::check()) {
			$newname = Request::get('name'); //gets name from the view teacher
			$newemail = Request::get('email');// gets email from the view teacher
			$newrmpurl = Request::get('rmpurl');//gets rmpurl from the view teacher

			//creates a variable to compare against when checking for empty
			$newvar = teachers::where('name', '=', $newname) -> where('email', '=', $newemail)->get();
			//checks if teacher is in teachers table.
			if($newvar->isEmpty())
			{
				//Adds new teacher tuple if it does not exist. It also puts TID (it is auto incremented) into variable for use later
				$newTID = teachers::insertGetId(['name' => $newname, 'email' => $newemail, 'RMPURL' => $newrmpurl]);
			}
			else
			{
				//If teacher already exists it gets the TID for use in insert
				$newTID = teachers::where('name', '=', $newname) -> where('email', '=', $newemail) ->value('TID');
			}
 				//Adds tuple into teachcourse. Teachcourse is an intermediary between courses and teachers
				teachcourse::insert(['department_name' => $department_name, 'dept_numb' => $department_number, 'TeID' => $newTID, 'coursenumber' => $coursenumber]);

				$message = "Add Teacher: Success!";//tells user if successful in adding tuple
		}
		else{$message = "Add Teacher: Failed";}// tells user if failure in adding tuple
		//joins the tables and filters based on the variables passed into this function. Includes new tuple if successful
		$teachertable = teachers:: join('teachcoursedb', 'TID', '=', 'teachcoursedb.TeID')->where('dept_numb', '=', $department_number)->where('department_name', '=', $department_name)->where('coursenumber', '=', $coursenumber)->get();
		//Tells user if logged in or not
		if (\Auth::check()) {
			$name = \Auth::user()->name;
		}
		else{$name = "Guest";}
		// returns the teachers view. passes the teachertable, department_name, department_number, coursenumber, message, and name into the teachers view
		return view('teachers', compact('teachertable'), compact('department_name','department_number','coursenumber','message', 'name'));
	}
}
