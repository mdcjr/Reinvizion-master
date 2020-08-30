<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Routing\Controller;

class UserServicesController extends Controller
{
    //Contructor
	public function __construct(){
     //will have to add a middleware to this ontroller to ensure it is not accessible unless logged in
	 $this->middleware('auth');
	}

	//Index function to call index page
	public function index(Request $request){
	//Call the view page	
    return view('profile.userservices');
  }

  // public function getProfile(Request $request){
  // 	if ($request->user())
  //   {

  //           // Auth::user() returns an instance of the authenticated user...
  //   }
  // }
  // public function updateProfile(Request $request){
  //   return view('pages.profile');
  // }
  
}
