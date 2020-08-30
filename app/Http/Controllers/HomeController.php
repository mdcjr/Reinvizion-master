<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     //   $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $image_url = $_SERVER['HTTP_HOST'] .'/images/learning-hub.jpeg';
        // $host = "" .$_SERVER['HTTP_HOST'];
        // $host = "http://54.245.60.112";
        // $emailData = ['host' => $host, 'confirmation_code' => 'asdas'];
        // Mail::send('emails.payment-fail',$emailData, function($message) {

        //   $message->to('', '')
        //       ->subject('Payment Fail');
        //   });
        return view('landing.home');
    }
    public function coming_soon(Request $request)
    {
        return view('landing.coming_soon');
    }
    public function error(Request $request)
    {
        return view('landing.error');
    }
    public function forgot_password(Request $request) {
        return view('emails.reset_password_page');
    }
    public function getAlternateLearningHub(Request $request){
        return view('landing.alternatelearninghub');
    }
    public function getBusinessAcademy(Requuest $request){
        return view('landing.businessacademy');
    }
}
