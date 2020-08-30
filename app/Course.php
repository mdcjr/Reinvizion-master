<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  protected $table = 'courses';

  protected $fillable = [
    'name', 'summary'
  ]; 

  public function user_courses()
  {
    return $this->hasMany('App\UserCourse');
  }
  public function course_comments()
  {
    return $this->hasMany('App\CourseComment');
  }
  public function user_course_videos()
  {
    return $this->hasMany('App\UserCourseVideo');
  }
  public function sections()
  {
    return $this->hasMany('App\CourseSection');
  }
}
