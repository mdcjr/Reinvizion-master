<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $table = 'messages';

  protected $fillable = [
    'sender_id', 'receiver_id', 'conversation_id', 'user_id_b', 'body'
  ]; 

  public function sender()
  {
    return $this->belongsTo('App\User', 'sender_id');
  }
  public function receiver()
  {
    return $this->belongsTo('App\User', 'receiver_id');
  }
  public function conversation()
  {
    return $this->belongsTo('App\Conversation');
  }
}
