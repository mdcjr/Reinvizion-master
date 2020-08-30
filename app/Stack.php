<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stack extends Model
{
    protected $table = 'stacks';
	  protected $fillable = ['user_id','business_image_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function business_images(){
    	return $this->belongsTo('App\BusinessImages', 'business_image_id');
    }
}
