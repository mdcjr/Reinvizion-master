<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
  // $table->integer('user_id');
  //           $table->integer('course_id');
  //           $table->string('notif_type');
  //           $table->boolean('is_read')->default(false);

  protected $table = 'notifications';

  protected $fillable = [
    'user_id', 'course_id', 'notif_type', 'is_read', 'conversation_id'
  ]; 

  public function user()
  {
    return $this->belongsTo('App\User');
  }
  public function course()
  {
    return $this->belongsTo('App\Course');
  }
}
