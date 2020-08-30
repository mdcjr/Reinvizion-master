<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubSection extends Model
{
  protected $table = 'sub_sections';
  protected $fillable = [
    'section_id', 'name', 'video_url'
  ]; 

  public function section()
  {
    return $this->belongsTo('App\CourseSection');
  }
  public function comments()
  {
    return $this->hasMany('App\CourseComment');
  }
}
