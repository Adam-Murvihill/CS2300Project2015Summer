<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Do not change order of Routes!!!!
Route::get('/', 'HomeController@Home');
Route::get('/home', 'HomeController@Home');
Route::post('/school', 'SchoolController@store');
Route::get('/school', 'SchoolController@school');
Route::post('/department/{school_name}','DepartmentController@store');
Route::get('/department/{school_name}','DepartmentController@department');
Route::post('/courses/{department_name}/{department_number}','CoursesController@store');
Route::get('/courses/{department_name}/{department_number}', 'CoursesController@courses');
Route::post('/teachers/{department_name}/{dept_num}/{coursename}', 'TeachersController@store');
Route::get('/teachers/{department_name}/{dept_num}/{coursename}', 'TeachersController@teachers');
Route::post('/contentfolder/{TID}/{CID}', 'ContentFolderController@store');
Route::get('/contentfolder/{TID}/{CID}', 'ContentFolderController@contentfolder');
Route::post('/content/','ContentController@altcontent');
Route::post('/content/vote/{FileID}', 'ContentController@vote');
Route::post('/content/{FileID}', 'ContentController@store');
//Route::post('/content/{cvar}', 'ContentController@vote');
Route::get('/content/{FileID}', 'ContentController@content');
Route::get('/content/{filenumber}/{name}/', 'ContentController@delete');

// Authentication routes...

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
