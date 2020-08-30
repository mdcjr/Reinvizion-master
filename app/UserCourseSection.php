<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCourseSection extends Model
{
  protected $table = 'user_course_sections';
  protected $fillable = [
    'course_section_id', 'user_id', 'is_finished'
  ]; 

  public function course_section()
  {
    return $this->belongsTo('App\CourseSection');
  }
  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
