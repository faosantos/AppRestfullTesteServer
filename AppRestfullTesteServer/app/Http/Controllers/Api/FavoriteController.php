<?php

namespace App\Http\Controllers\Api;

use App\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Log;

class FavoriteController extends Controller
{
  public function rmFavorite($id)
  {
    $user = Auth::user();
    $exist = Favorite::where('to_id', $id)->where('owner_id', $user->id)->exists();
    if($exist){
      Favorite::Where('owner_id', $user->id)
      ->Where('to_id', $id)
      ->delete();
    }
    return ['success'=>true];
  }
  public function addFavorite($id)
  {
    $user = Auth::user();
    $exist = Favorite::where('to_id', $id)->where('owner_id', $user->id)->exists();
    if(!$exist){
      $favorite = Favorite::create([
        'to_id'=> $id,
        'owner_id'=> $user->id,
      ]);
    }
    return ['success'=>true];
  }
}
