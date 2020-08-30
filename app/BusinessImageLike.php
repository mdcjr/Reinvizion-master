<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessImageLike extends Model
{
    protected $table = 'business_image_likes';
	  protected $fillable = ['business_image_id','user_id'];
	  
	  public function business_image()
	  {
	    return $this->belongsTo('App\BusinessImages');
	  }

	  public function user(){
	  	return $this->belongsTo('App\User');
	  }
}
