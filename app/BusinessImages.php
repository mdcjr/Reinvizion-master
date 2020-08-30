<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BusinessImageLike;
use App\BusinessImageComment;
use App\Stack;

class BusinessImages extends Model
{
    protected $table = 'business_images';
	  protected $fillable = ['business_id','link', 'caption'];
	  
	  public function business()
	  {
	    return $this->belongsTo('App\Business');
	  }

	  public function stacks(){
	  	return $this->hasMany('App\Stack');
	  }

	  public function likes(){
	  	return $this->hasMany('App\BusinessImageLike', 'business_image_id', 'id');
	  }

	  public function like($user_id){	  	
	  	$success = BusinessImageLike::create([
  			'business_image_id' => $this->id,
  			'user_id' => $user_id
  		]);

  		if ($success != true) {
  			$success = false;
  		}

		  return $success;
	  }

	  public function unlike($user_id){
	  	$success = BusinessImageLike::where('business_image_id', '=', $this->id)
  			->where('user_id', '=', $user_id)
  			->first()
  			->delete();

  		if ($success != true) {
  			$success = false;
  		}

  		return $success;
	  }

	  public function is_liked_by_user($user_id) {
	  	return BusinessImageLike::where('business_image_id', '=', $this->id)
	  		->where('user_id', '=', $user_id)->first() != null;
	  }

	  public function comments(){
	  	return $this->hasMany('App\BusinessImageComment', 'business_image_id', 'id');
	  }

	  public function comment($comment, $user_id) {
	  	$success = BusinessImageComment::create([
	  		'business_image_id' => $this->id,
	  		'user_id' => $user_id,
	  		'comment' => $comment
	  	]);

	  	if ($success != true) {
	  		$success = false;
	  	} else {
	  		$success = true;
	  	}

	  	return $success;
	  }

	  public function is_stacked_by_user($user_id) {
	  	return Stack::where('user_id', $user_id)
	  		->where('business_image_id', $this->id)
	  		->first() != null;
	  }
}
