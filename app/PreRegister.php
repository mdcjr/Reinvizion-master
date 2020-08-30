<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreRegister extends Model
{
  protected $table = 'pre_register';

  protected $fillable = [
    'user_type', 'user_signature', 'user_occupation'
  ]; 
}
