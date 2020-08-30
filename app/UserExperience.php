<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExperience extends Model
{
  protected $table = 'user_experiences';
  protected $fillable = [
    'user_id', 'title', 'field', 'comp_name', 'start_date', 'end_date', 'is_current'
  ]; 

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
