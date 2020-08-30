<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Exceptions\InvalidConfirmationCodeException;
use Illuminate\Support\Facades\Input;
use Session;
use Validator;
use Mail;
class EmailController extends Controller
{

  public function confirm($confirmation_code)
  {
    if( ! $confirmation_code)
    {
     // throw new InvalidConfirmationCodeException;
    }

    $user = User::whereConfirmationCode($confirmation_code)->first();

    if ( ! $user)
    {
      //throw new InvalidConfirmationCodeException;
    }

    $user->confirmed = 1;
    $user->confirmation_code = null;
    $user->save();

    return Redirect::to('/email/success');
  }
  public function success(Request $request){
    return view("emails.verify_success");
  }
  
  public function sendWebService(Request $request){
      //Web Service Email
    $rules = [
        'fname' => 'required',
        'lname' => 'required',
        'email' => 'required|email',
        'information' => 'required'
    ];
    $input = Input::only(
      'fname',
      'lname',
      'company',
      'email',
      'phone',
      'contact_type',
      'city',
      'state_type',
      'zipcode',
      'information'
    );
    $validator = Validator::make($input,$rules);
    if($validator->fails()){
      return Redirect::back()->withErrors($validator);
    }
    $emailData = [
        'fname' => $request->fname,
        'lname' => $request->lname,
        'company' => $request->company,
        'email' => $request->email,
        'phone' => $request->phone,
        'contact_type' => $request->contact_type,
        'city' => $request->city,
        'state_type' => $request->state_type,
        'zipcode' => $request->zipcode,
        'information' => $request->information];
    Mail::send('emails.contact',$emailData, function($m) use ($emailData){
      $m->from($emailData['email']);
      $m->to('webdesign@reinvizion.com')
        ->subject('Web Service Department Request');
    });
  }

  public function sendApparelService(Request $request){
    $rules = [
        'fname' => 'required',
        'lname' => 'required',
        'email' => 'required|email',
        'information' => 'required'
    ];
    $input = Input::only(
      'fname',
      'lname',
      'company',
      'email',
      'phone',
      'contact_type',
      'city',
      'state_type',
      'zipcode',
      'information'
    );
    $validator = Validator::make($input,$rules);
    if($validator->fails()){
      return Redirect::back()->withErrors($validator);
    }
    $emailData = [
        'fname' => $request->fname,
        'lname' => $request->lname,
        'company' => $request->company,
        'email' => $request->email,
        'phone' => $request->phone,
        'contact_type' => $request->contact_type,
        'city' => $request->city,
        'state_type' => $request->state_type,
        'zipcode' => $request->zipcode,
        'information' => $request->information];
    Mail::send('emails.contact',$emailData, function($m) use ($emailData){
      $m->from($emailData['email']);
      $m->to('apparel@reinvizion.com')
        ->subject('Apparel Service Department Request');
    });

  }

  public function sendSocialMediaService(Request $request){
    $rules = [
        'fname' => 'required',
        'lname' => 'required',
        'email' => 'required|email',
        'information' => 'required'
    ];
    $input = Input::only(
      'fname',
      'lname',
      'company',
      'email',
      'phone',
      'contact_type',
      'city',
      'state_type',
      'zipcode',
      'information'
    );
    $validator = Validator::make($input,$rules);
    if($validator->fails()){
      return Redirect::back()->withErrors($validator);
    }
    $emailData = [
        'fname' => $request->fname,
        'lname' => $request->lname,
        'company' => $request->company,
        'email' => $request->email,
        'phone' => $request->phone,
        'contact_type' => $request->contact_type,
        'city' => $request->city,
        'state_type' => $request->state_type,
        'zipcode' => $request->zipcode,
        'information' => $request->information];
    Mail::send('emails.contact',$emailData, function($m) use($emailData) {
      $m->from($emailData['email']);
      $m->to('socialmarketing@reinvizion.com')
        ->subject('Social Marketing Service Department Request');
    });
  }
  public function sendBusinessService(Request $request){ 
    $rules = [
        'fname' => 'required',
        'lname' => 'required',
        'email' => 'required|email',
        'information' => 'required'
    ];
    $input = Input::only(
      'fname',
      'lname',
      'company',
      'email',
      'phone',
      'contact_type',
      'city',
      'state_type',
      'zipcode',
      'information'
    );
    $validator = Validator::make($input,$rules);
    if($validator->fails()){
      return Redirect::back()->withErrors($validator);
    }
    $emailData = [
        'fname' => $request->fname,
        'lname' => $request->lname,
        'company' => $request->company,
        'email' => $request->email,
        'phone' => $request->phone,
        'contact_type' => $request->contact_type,
        'city' => $request->city,
        'state_type' => $request->state_type,
        'zipcode' => $request->zipcode,
        'information' => $request->information];
    Mail::send('emails.contact',$emailData, function($m) use($emailData) {
      $m->from($emailData['email']);
      $m->to('businessaccelerator@reinvizion.com')
        ->subject('Business Accelerator Service Department Request');
    });
    Session::flash('message', "Mail has been sent successfully");
    return Redirect::back();
  }

  public function send(Request $request){
    $emailData = [
      'message' => $request->message
    ];

    $user = Auth::user();

    Mail::send('emails.sendemail',$emailData, function($message){
      $message->from($user->email);
      $message->to($request->email, $emailData)
              ->subject($request->subject);
    });
  }
}
