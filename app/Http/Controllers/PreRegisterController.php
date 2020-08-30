<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreRegisterController extends Controller
{
	// public function __construct(){
	//  $this->middleware('auth');
	// }

	public function addPreRegisterUser(Request $request){

		if(Request::ajax()){
				$pre_register = new PreRegister;

				$pre_register->user_type = $request->user_type;
				$pre_register->user_occupation = $request->user_occupation;
				$pre_register->user_signature = $request->user_signature;

				$pre_register.save();
				return response()->json('Successfully updated user.', 200);
		}
	}
}
