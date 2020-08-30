<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubSection extends Model
{
  protected $table = 'user_sub_sections';
  protected $fillable = [
    'sub_section_id', 'user_id', 'is_finished'
  ]; 

  public function sub_section()
  {
    return $this->belongsTo('App\SubSection');
  }
  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
