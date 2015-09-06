<?php

namespace App\Http\Controllers;
use App\contentfolder;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContentFolderController extends Controller
{
    //returns a view of the contentfolder table
    public function contentfolder($TID, $CID)
    {
        $message ="";//required for view
        //filters table based on TID and CID. kantfolder is a philosophical variable, if you will it.
        $kantfolder = contentfolder::where('TuID', '=', $TID) -> where('CIDe', '=', $CID) -> get();
        //tells user if logged in or not
        if (\Auth::check()) {
            $name = \Auth::user()->name;
        }
        else{$name = "Guest";}
        //returns the contentfolder view. It passes kantfolder, TID, CID, message, and name to contentfolder view
        return view('contentfolder', compact('kantfolder'), compact('TID','CID','message','name'));
    }
    //Adds new tuple to contentfolder table
    public function store ($TID, $CID)
    {
        //checks if user is authorised
        if (\Auth::check()) {
            $newfiletype = Request::get('filetype');//gets file type from contentfolder view
            //inserts new tuple to contentfoldertable
            contentfolder::insert(['TuID' => $TID, 'CIDe' => $CID, 'filename' => $newfiletype]);
            $message = "Add Content Folder: Sucess!";//tells user addition was successful
        }
        else
        {
            $message = "Add Content: Failure";// tells user that addition was a failure
        }
        //tells user if logged in or not
        if (\Auth::check()) {
            $name = \Auth::user()->name;
        }
        else{$name = "Guest";}
        //filters table based on TID and CID. kantfolder is a philosophical variable, if you will it.
        $kantfolder = contentfolder::where('TuID', '=', $TID) -> where('CIDe', '=', $CID) -> get();
        //returns the contentfolder view. It passes kantfolder, TID, CID, message, and name to contentfolder view
        return view('contentfolder', compact('kantfolder'), compact('TID', 'CID','message','name'));
    }
}
