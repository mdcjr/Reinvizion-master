<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	  protected $table = 'customers';
	  protected $fillable = ['user_id','business_id'];
	  
	  public function user()
	  {
	    return $this->belongsTo('App\User');
	  }

	  public function business()
	  {
	  	return $this->belongsTo('App\Business');
	  }
}
