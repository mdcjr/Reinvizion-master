<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Http\Controllers\WebhookController as BaseController;
use App\User;
use Mail as Mailer;
use Auth;
class StripeController extends BaseController
{
		protected $mailer;
  	public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
    //
    public function handleOrderPaymentSucceeded(array $payload){
    	$user = Auth::user();
    	$emailData = [$payload,'user'=>$user];
    	Mail::send('emails.payment-success',$emailData, function($message) use($user){
    		$message->to($user->email, $user->name)
          ->subject('Subscriber Payment Succeeded!');
      });
    	return new Response('Webhook Handled');
    }

    public function handleSubscriptionCancellation($payload){
    	$emailData = ['confirmation_code' => $user->confirmation_code];
      Mail::send('emails.send',$emailData, function($message) {

      $message->to(Input::get('email'), Input::get('name'))
          ->subject('Verify your email address');
      });
    }

    public function handleInvoicePaymentFailed($payload){
    	// $billable = $this->getBillable($payload['data']['object']['customer']);

     //  if ($this->userIsSubscribedWithoutACard($billable)) {
     //      $billable->subscription->cancel(false);
     //  }
    	// $user = Auth::user();
    	// $emailData = [$payload,'user'=>$user];
    	// Mail::send('emails.payment-success',$emailData, function($message) use($user){
    	// 	$message->to($user->email, $user->name)
     //      ->subject('Subscriber Payment Failed!');
     //  });
     //  return response('Webhook Handled');
     //  
        $user = $this->getUserByStripeId($payload['data']['object']['customer']);

        $this->mailer->failedPayment($user, $payload);

        return new Response('Webhook Handled', 200);
    }
}
