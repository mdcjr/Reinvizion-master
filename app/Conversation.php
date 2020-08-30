<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
  protected $table = 'conversations';

  protected $fillable = [
    'user_id_a', 'user_id_b', 'is_read'
  ]; 

  public function user_a()
  {
    return $this->belongsTo('App\User', 'user_id_a');
  }

  public function user_b()
  {
    return $this->belongsTo('App\User', 'user_id_b');
  }

  public function messages()
  {
    return $this->hasMany('App\Message');
  }

  public function inbox($user_id)
  {
    return $this->messages->Where('sender_id', '!=', $user_id)->Where('is_read', '=', false);
  }
}
