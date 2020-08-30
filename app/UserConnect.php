<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserConnect extends Model
{
  protected $table = 'user_connects';

  protected $fillable = [
    'user_id_a', 'user_id_b'
  ]; 

  public function user_a()
  {
    return $this->belongsTo('App\User', 'user_id_a');
  }

  public function user_b()
  {
    return $this->belongsTo('App\User', 'user_id_b');
  }
}
