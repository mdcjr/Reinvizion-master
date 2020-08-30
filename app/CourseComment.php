<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseComment extends Model
{
  protected $table = 'course_comments';
  protected $fillable = [
      'body', 'course_id','reply_id', 'user_id', 'is_reply', 'sub_section_id'
  ]; 

  public function user()
  {
      return $this->belongsTo('App\User');
  }

  public function course()
  {
      return $this->belongsTo('App\Course');
  }

  public function sub_section()
  {
      return $this->belongsTo('App\SubSection');
  }

  public function replies()
  {
      return $this->course->course_comments->Where('reply_id', '=', $this->id);
  }
}
