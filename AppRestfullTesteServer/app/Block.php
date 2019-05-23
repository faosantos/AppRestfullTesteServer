<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
  protected $fillable = ['from_user_id','to_user_id', 'created_at', 'updated_at'];

  public function owner()
  {
    return $this->belongsTo('App\User', 'from_user_id', 'id');
  }
  public function blocked()
  {
    return $this->belongsTo('App\User', 'to_user_id', 'id');
  }
}
