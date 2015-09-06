<?php

namespace App\Http\Controllers;

use Request;
use App\school;
use App\content;
use App\raters;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{

	//returns the normal content view
    public function content($FileID)
	{
		//filter results by FileID which was passed into function
		$contentvar = content::where('FileeID', '=', $FileID) -> get();
		$messagee = "";//needed for view file
		//Tells user if logged in or not
		if (\Auth::check()) {
			$name = \Auth::user()->name;
		}
		else{$name = "Guest";}
		//return the content view. Passes the contentvar, FileID, messagee, and name to the content view
		return view('content', compact('contentvar'), compact('FileID', 'messagee', 'name'));
	}

	//returns the content view for the search function on the homepage
	public function altcontent()
	{
		$name = Request::get('name'); //gets the name from the home view
		//filters by requested user
		$contentvar = content::where('name', '=', $name) -> get();
		$messagee = "";//required for view
		//Tells user if logged in or not
		if (\Auth::check()) {
			$name = \Auth::user()->name;
		}
		else{$name = "Guest";}
		//return the altcontent view. Passes the contentvar, FileID, messagee, and name to the content view
		return view('altcontent', compact('contentvar'), compact('messagee', 'name'));
	}

	//allows authorised users to delete THEIR files
	public function delete($filenumber, $name)
	{
		//checks if user is authorised
		if(\Auth::check()) {
			//checks if user posted the content
			if ((\Auth::user()->name) == $name) {
				//finds the tuple and deletes it
				content::where('filenumber', '=', $filenumber)->delete();
				//deletes the records with file number from raters
				raters::where('filenumber', '=', $filenumber) -> delete();
				$message = "Delete Successful";//tells user delete was successful
			}
		}
		else{$message = "Delete failure";}//tells user if delete was a failure
		//tells user if logged in or not
		if (\Auth::check()) {
			$name = \Auth::user()->name;
		}
		else{$name = "Guest";}
		//gets the school table
		$schooltable = school::all();
		//redirects to school so that user can see message
		return view('school', compact('schooltable'),compact( 'message', 'name'));
	}

    //Allows the user to add new files to the contentdb
	public function store($FileID)
	{
		    //checks if user is authorised
			if (\Auth::check()) {
			$newfile = Request::get('file');//gets file from content view
			$newfileuser = \Auth::user()->name;//gets the user name who is adding the file
			$newcontentlink = Request::get('contentlink'); //getting the content link from the content view
			//Adds new tuple to the table
			content::insert(['contentname' => $newfile, 'FileeID' => $FileID, 'name' => $newfileuser, 'contentlink' => $newcontentlink, 'NetRating' => 0]);
			$messagee = "Success!, File Added";//Tells user the addition was successful
			}
		else{
			$messagee = "Authentication failed, File not added!";//Tells user the addition was a failure
		}
		//filter results by FileID which was passed into function
			$contentvar = content::where('FileeID', '=', $FileID) -> get();
		//tells user if logged in or not
		if (\Auth::check()) {
			$name = \Auth::user()->name;
		}
		else{$name = "Guest";}
		//return the content view. Passes the contentvar, FileID, messagee, and name to the content view
		return view('content', compact('contentvar'), compact('FileID', 'messagee','name'));
	}

	public function vote($FileID)
	{
		//checks if user is authorised
		if (\Auth::check()) {
		$newfile = Request::get('filenumber');//gets filenumber from content view
		$newvotes = Request::get('vote');//gets vote between 1 and 10 from content view
		$newfileuser = \Auth::user()->name; // gets username to keep track of who voted
		//adds vote to the raters table
		raters::insert(['filenumber'=>$newfile ,'name' =>$newfileuser, 'rating' => $newvotes]);
			//gets the average of the votes from raters table
		$newavg = raters::where('filenumber', '=', $newfile) -> avg('rating');
			//takes the average and updates the Netrating in contentdb table. Syntax nessessary!
        DB::table('contentdb')->where('filenumber', '=', $newfile) -> update(['NetRating' => $newavg]);
		$messagee = "Success!, Vote Added";//tells user addition was successful
	}

		else
		 {
         $messagee = "Authentication failed, Vote not added!";//tells user if addition was a failure
         }
		//filter results by FileID which was passed into function
		$contentvar = content::where('FileeID', '=', $FileID) -> get();
		//tells user if logged in or not
		if (\Auth::check()) {
			$name = \Auth::user()->name;
		}
		else{$name = "Guest";}
		//return the content view. Passes the contentvar, FileID, messagee, and name to the content view
		return view('content', compact('contentvar'), compact('FileID', 'messagee','name'));
	}

}
