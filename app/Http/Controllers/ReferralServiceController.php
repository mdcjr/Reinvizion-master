<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReferralServiceController extends Controller
{
    //
  public function getReferral(Request $request){
    return view('referral.referral');
  }
}
