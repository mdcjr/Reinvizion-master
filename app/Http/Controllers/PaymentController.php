<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use App\User;
use App\Subscription;
use Mail;
use Auth;
use Carbon\Carbon;
class PaymentController extends Controller
{
	  public function __construct()
    {
        $this->middleware('auth');
    }
		public function monthly(Request $request){
	    \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));
	    try 
	    {
	    	$email = $request->user()->email;
		    $token = $request->input('stripeToken');
		    //Create Stripe Customer
	    	$customer = \Stripe\Customer::create(array(
			      'email' => $email,
			      'source'  => $token,
			  ));

			  $subscriptions = $request->user()->subscriptions; //Request for field coupon
			  $coupon = $subscriptions->coupon;
			  if($coupon === 1)
			  {
			  	try{
				  	$stripeSub = \Stripe\Subscription::create(array(
					  "customer" => $customer->id,
					  "plan" => "monthly_with_trail",
					  "tax_percent" => 8.25,
						));
						//$user->trail_ends_at = Carbon::now()->addDays(14);
						//$user->save();		  		
			  	}catch(\Stripe\Error\Card $e){
			  		//Card was declined
			  		$e_json = $e->getJsonBody();
			  		$error = $e_json['error'];
			  		Session::flash ( 'stripe-fail-message', $error['message'] );
	        	return Redirect::back ();
			  	}catch(\Stripe\Error\InvalidRequest $e){
			  		//Something bad happen from dev
			  		$e_json = $e->getJsonBody();
			  		$error = $e_json['error'];
			  		Session::flash ( 'stripe-fail-message', $error['message'] );
	        	return Redirect::back ();
			  	}catch(\Stripe\Error\Api $e){
			  		//Stripe server is down
			  		$e_json = $e->getJsonBody();
			  		$error = $e_json['error'];
			  		Session::flash ( 'stripe-fail-message', $error['message'] );
	        	return Redirect::back ();
			  	}catch(\Stripe\Error\ApiConnection $e){
			  		//Network problem, try again
			  		//
			  		$e_json = $e->getJsonBody();
			  		$error = $e_json['error'];
			  		Session::flash ( 'stripe-fail-message', $error['message'] );
	        	return Redirect::back ();
			  	}
			  }else
			  {
					try{
				  	$stripeSub = \Stripe\Subscription::create(array(
					  "customer" => $customer->id,
					  "plan" => "monthly",
					  "tax_percent" => 8.25,
						));			  		
			  	}catch(\Stripe\Error\Card $e){
			  		//Card was declined
			  		$e_json = $e->getJsonBody();
			  		$error = $e_json['error'];
			  		Session::flash ( 'stripe-fail-message', $error['message'] );
	        	return Redirect::back ();
			  	}catch(\Stripe\Error\InvalidRequest $e){
			  		//Something bad happen from dev
			  		$e_json = $e->getJsonBody();
			  		$error = $e_json['error'];
			  		Session::flash ( 'stripe-fail-message', $error['message'] );
	        	return Redirect::back ();
			  	}catch(\Stripe\Error\Api $e){
			  		//Stripe server is down
			  		$e_json = $e->getJsonBody();
			  		$error = $e_json['error'];
			  		Session::flash ( 'stripe-fail-message', $error['message'] );
	        	return Redirect::back ();
			  	}catch(\Stripe\Error\ApiConnection $e){
			  		//Network problem, try again
			  		//
			  		$e_json = $e->getJsonBody();
			  		$error = $e_json['error'];
			  		Session::flash ( 'stripe-fail-message', $error['message'] );
	        	return Redirect::back ();
			  	}			
			  }

		 		//Save to database
			  $user = Auth::user();
			  $subscription = Subscription::firstOrNew(array('email' => $user->email));
			  $subscription->email = $user->email;
			  $subscription->stripe_id = $customer->id;
			  $subscription->stripe_token = $token;
			  $subscription->stripe_plan = "monthly";
			  $subscription->coupon = $coupon;
			  $subscription->name = $user->name;
			  $subscription->user_id = $user->id;
			  $subscription->save();

			  $user->stripe_id = $customer->id;
			  $user->stripe_sub = $stripeSub->id;
				$user->subscriber = true;	//set to true
				$user->subscription_type = "monthly";
				$user->save();
				$emailData = ['user'=>$user];
				Mail::send('emails.payment-success',$emailData, function($message) use($user) {
			    $message->to($user->email, $user->name)
			        ->subject('Payment Monthly Subscription');
		    });

			 	Session::flash ( 'stripe-payment-success', 'Payment done successfully !' );
	      return Redirect::back ();

	    }catch (\Stripe\Error\Card $e ) 
	    {
	        Session::flash ( 'stripe-fail-message', $e->getMessage() );
	        return Redirect::back ();
	    }
	 }

	 public function yearly(Request $request){
	    \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));
	    try 
	    {
	    	$token  = $request->input('stripeToken');
	    	$email = $request->user()->email;

	    	$customer = \Stripe\Customer::create(array(
			      'email' => $email,
			      'source'  => $token
			  ));

			  $subscriptions = $request->user()->subscriptions; //Request for field coupon
			  $coupon = $subscriptions->coupon;
			  if($coupon === 1)
			  {
					try{
				  	$stripeSub = \Stripe\Subscription::create(array(
					  "customer" => $customer->id,
					  "plan" => "yearly_with_trail",
					  "tax_percent" => 8.25,
						));
						//$user->trail_ends_at = Carbon::now()->addDays(14);
						//$user->save();			  		
			  	}catch(\Stripe\Error\Card $e){
			  		//Card was declined
			  		$e_json = $e->getJsonBody();
			  		$error = $e_json['error'];
			  		Session::flash ( 'stripe-fail-message', $error['message'] );
	        	return Redirect::back ();
			  	}catch(\Stripe\Error\InvalidRequest $e){
			  		//Something bad happen from dev
			  		$e_json = $e->getJsonBody();
			  		$error = $e_json['error'];
			  		Session::flash ( 'stripe-fail-message', $error['message'] );
	        	return Redirect::back ();
			  	}catch(\Stripe\Error\Api $e){
			  		//Stripe server is down
			  		$e_json = $e->getJsonBody();
			  		$error = $e_json['error'];
			  		Session::flash ( 'stripe-fail-message', $error['message'] );
	        	return Redirect::back ();
			  	}catch(\Stripe\Error\ApiConnection $e){
			  		//Network problem, try again
			  		//
			  		$e_json = $e->getJsonBody();
			  		$error = $e_json['error'];
			  		Session::flash ( 'stripe-fail-message', $error['message'] );
	        	return Redirect::back ();
			  	}		
			  }else{
					try{
				  	$stripeSub = \Stripe\Subscription::create(array(
					  "customer" => $customer->id,
					  "plan" => "yearly",
					  "tax_percent" => 8.25,
						)); 		
			  	}catch(\Stripe\Error\Card $e){
			  		//Card was declined
			  		$e_json = $e->getJsonBody();
			  		$error = $e_json['error'];
			  		Session::flash ( 'stripe-fail-message', $error['message'] );
	        	return Redirect::back ();
			  	}catch(\Stripe\Error\InvalidRequest $e){
			  		//Something bad happen from dev
			  		$e_json = $e->getJsonBody();
			  		$error = $e_json['error'];
			  		Session::flash ( 'stripe-fail-message', $error['message'] );
	        	return Redirect::back ();
			  	}catch(\Stripe\Error\Api $e){
			  		//Stripe server is down
			  		$e_json = $e->getJsonBody();
			  		$error = $e_json['error'];
			  		Session::flash ( 'stripe-fail-message', $error['message'] );
	        	return Redirect::back ();
			  	}catch(\Stripe\Error\ApiConnection $e){
			  		//Network problem, try again
			  		//
			  		$e_json = $e->getJsonBody();
			  		$error = $e_json['error'];
			  		Session::flash ( 'stripe-fail-message', $error['message'] );
	        	return Redirect::back ();
			  	}				
			  }
			  //Save to database
			  $user = Auth::user();
			  $subscription = Subscription::firstOrNew(array('email' => $user->email));
			  $subscription->email = $user->email;
			  $subscription->stripe_id = $customer->id;
			  $subscription->stripe_token = $token;
			  $subscription->stripe_plan = "yearly";
			  $subscription->coupon = $coupon;
			  $subscription->name = $user->name;
			  $subscription->user_id = $user->id;
			  $subscription->save();
			  
			  $user->stripe_id = $customer->id;
			  $user->stripe_sub = $stripeSub->id;
				$user->subscriber = 1;	//set to true
				$user->subscription_type = "yearly";
				$user->save();

				//Send Email for payment
				$emailData = ['user'=>$user];
				Mail::send('emails.payment-success',$emailData, function($message) use($user) {
			    $message->to($user->email, $user->name)
			        ->subject('Payment Yearly Subscription');
		    });
     				
	      Session::flash ( 'stripe-payment-success', 'Payment done successfully !' );
	      return Redirect::back();
	    } catch ( \Stripe\Error\Card $e ) 
	    {
	        Session::flash ( 'stripe-fail-message', "Error! Please Try again." );
	        return Redirect::back ();
	    }
	 }
	 public function webhook(){

	 }
	 public function updateCoupon(Request $request){
	 	if(isset($request->coupon)){
	 	 	$subscriptions = $request->user()->subscriptions;
	 		
	 		if($subscriptions == null){
	 			$user = Auth::user();
			  $sub = Subscription::firstOrNew(array('email' => $user->email));
			  $sub->coupon = $request->coupon;
			  $sub->user_id = $user->id;
			  $sub->save();
	 		}else{
	 			$subscriptions->coupon = $request->coupon;
	 			$subscriptions->save();
	 		}

	 	}

	 	return response()->json('Successfully updated subscription coupon.', 200);
	 }

	 public function cancellation(Request $request){
 		\Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));

 		try {
 			$user = Auth::user();	
 	  	$customer = $user->stripe_sub;
	 		$stripeSub = \Stripe\Subscription::retrieve($customer);	//Get the subsriber
			$stripeSub->cancel();
			$stripeSub->save();
			$emailData = ['user'=>$user];
			
			if($user->subscription_type == "monthly")
			{
				Mail::send('emails.payment-cancellation',$emailData, function($message) use($user) {
		    $message->to($user->email, $user->name)
		        ->subject('Monthly Subscription Cancellation');
	    	});
			}else if($user->subscription_type == "yearly"){
				Mail::send('emails.payment-cancellation',$emailData, function($message) use($user) {
		    $message->to($user->email, $user->name)
		        ->subject('Yearly Subscription Cancellation');
	    	});				
			}

			$user->subscriber = 0; // Set to false
			$user->save();
			if($user->subscriber == 0){
				Session::flash ('stripe-cancel-success', 'Cancellation successfully !' );
	    	return Redirect::back();
			} else
			{
				Session::flash ('stripe-cancel-fail', 'Cancellation fail!' );
	    	return Redirect::back();
			}
			
 		}
 		catch(\Stripe\Error\InvalidRequest $e){
  		//Something bad happen from dev
  		$e_json = $e->getJsonBody();
  		$error = $e_json['error'];
  		Session::flash ( 'stripe-fail-message', $error['message'] );
    	return Redirect::back ();
		}catch(\Stripe\Error\Api $e){
  		//Stripe server is down
  		$e_json = $e->getJsonBody();
  		$error = $e_json['error'];
  		Session::flash ( 'stripe-fail-message', $error['message'] );
    	return Redirect::back ();
  	}catch(\Stripe\Error\ApiConnection $e){
  		//Network problem, try again
  		//
  		$e_json = $e->getJsonBody();
  		$error = $e_json['error'];
  		Session::flash ( 'stripe-fail-message', $error['message'] );
    	return Redirect::back ();
  	}
	}



}
