<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessImageComment extends Model
{    
    protected $table = 'business_image_comments';
	  protected $fillable = ['business_image_id','user_id', 'comment'];
	  
	  public function business_image()
	  {
	    return $this->belongsTo('App\BusinessImages');
	  }

	  public function user()
	  {
	  	return $this->belongsTo('App\User');
	  }
}
