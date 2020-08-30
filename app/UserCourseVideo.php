<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCourseVideo extends Model
{
  protected $table = 'user_course_videos';
  protected $fillable = [
      'course_id', 'user_id', 'video_url'
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
