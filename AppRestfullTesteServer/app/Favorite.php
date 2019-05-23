<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
  protected $table = 'favorites';
  protected $fillable = ['to_id','owner_id', 'created_at', 'updated_at'];
  public function owner()
  {
    return $this->hasOne('App\User', 'id', 'owner_id');
  }
  public function favorite()
  {
    return $this->hasOne('App\User', 'id', 'to_id');
  }
}
