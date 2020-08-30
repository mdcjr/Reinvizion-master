<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
  protected $table = 'user_settings';
  protected $fillable = [
    'user_id', 'direct', 'feedback', 'comment', 'connect', 'classmate'
  ]; 

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
