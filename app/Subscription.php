<?php

namespace App;
use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
	use Billable;
  protected $table = 'subscriptions';
  protected $fillable = ['email','stripe_token','stripe_id','coupon','stripe_plan'];
  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
