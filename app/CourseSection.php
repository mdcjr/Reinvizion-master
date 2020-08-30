<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{
  protected $table = 'course_sections';
  protected $fillable = [
    'course_id', 'name', 'video_url'
  ]; 

  public function course()
  {
    return $this->belongsTo('App\Course');
  }
  public function user_course_sections()
  {
    return $this->hasMany('App\UserCourseSection');
  }
  public function sub_sections()
  {
    return $this->hasMany('App\SubSection', 'section_id');
  }
}
