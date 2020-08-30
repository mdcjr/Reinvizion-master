<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessServiceController extends Controller
{
    //
  public function getBusiness(Request $request){
    return view('business.viewbusiness');
  }
 
}
