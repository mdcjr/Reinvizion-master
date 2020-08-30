<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseModuleServiceController extends Controller
{
    //
  	public function index(Request $request){
	//Call the view page
    if($request->user()->admin == 1){
      return view('coursemodule.createcoursemodule');
    }	
    else
    {
      return view('coursemodule.viewcoursemodule');
    }
  }
  public function addCourseModule(Request $request){
  	return view('coursemodule.createcoursemodule');
  }
  public function getCourseModule(Request $request){
  	return view('coursemodule.viewcoursemodule');
  }

}
