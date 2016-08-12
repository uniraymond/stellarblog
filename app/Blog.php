<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Blog extends Model
{

  public function users()
  {
    return $this->belongsTo('App\User', 'user_id');
  }
}
