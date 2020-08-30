<?php

	namespace App;
	use Illuminate\Database\Eloquent\Model;
	use App\Review;

	class Business extends Model
	{
	  protected $table = 'businesses';
	  protected $fillable = ['name','industry','city','state','company_size', 'website', 'about_us', 'user_id'];
	  
	  public function user()
	  {
	    return $this->belongsTo('App\User');
	  }

	  public function customers()
	  {
	    return $this->hasMany('App\Customer');
	  }

	  public function reviews()
	  {
	    return $this->hasMany('App\Review');
	  }

	  public function images()
	  {
	    return $this->hasMany('App\BusinessImages');
	  }

	  public function isUserCustomer($user_id){
	  	return $this->customers()->where('user_id', '=', $user_id)->first() != null;
	  }

	  public function isReviewedByUser($user_id) {
	  	return Review::where('business_id', $this->id)
	  		->where('reviewer_id', $user_id)
	  		->first() != null;
	  }
	}

?>