<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
  protected $table = 'reviews';
  protected $fillable = [
    'user_id', 'reviewer_id', 'business_id', 'rating', 'message'
  ]; 

  public function user()
  {
    return $this->belongsTo('App\User')->first();
  }

  public function business()
  {
    return $this->belongsTo('App\Business')->first();
  }

  public function reviewer()
  {
    return User::where('id', $this->reviewer_id)->first();
  }
}