<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Auth;
use Log;
use DB;
use App\Lib\Geocode;

class FeedController extends Controller
{
    public function getLocal(Request $req)
    {
      $user = Auth::user();
      $favorites = $user->favorites()->get(['to_id']);

      $feed = DB::select("SELECT 
          u.id as id,
          u.name as name,
          u.avatar as avatar,
          u.about as about,
          IF(u.sex = 'm', 'male', 'female') AS sex,
          TIMESTAMPDIFF(YEAR, u.birth_date, CURDATE()) AS age,
          ROUND(((st_distance(u.location, ST_GeomFromText(?)) * 111195) / 1000), 0) as distance,
          GROUP_CONCAT(img.path) as images,
          IF(GROUP_CONCAT(f.id) IS NOT NULL, true, false) as fav
        FROM users AS u
        LEFT JOIN user_images AS img on img.user_id = u.id
        LEFT JOIN blocks AS blk ON (blk.from_user_id = ? AND blk.to_user_id = u.id)
         OR (blk.to_user_id = ? AND blk.from_user_id = u.id)
        LEFT JOIN favorites AS f ON f.owner_id = ? AND f.to_id = u.id
        WHERE (u.id != ?)
          AND (? = 'b' OR ? = u.sex)
          AND (u.updated_at >= '2019-05-22 22:00:00')
          AND ( u.interest = 'b' OR ? = u.interest)
          AND blk.id is null
        GROUP BY u.id
        HAVING distance <= ?
        ORDER BY distance",
        [
          $user->location->toWkt(),
          $user->id, $user->id, $user->id, $user->id,
          $user->interest, $user->interest,
          $user->sex,
          500
        ]
      );

      foreach ($feed as $u) {
        if ($u->images != null) {
          $u->images = explode(',', $u->images);
        } else {
          $u->images = [];
        }
      }

      return response()->json($feed, 200);
    }

    public function getSearch(Request $req)
    {
      $user = Auth::user();
      $point = Geocode::getPointFromAddress($req->address);
      $search = DB::select(
        "SELECT 
          u.id AS id,
          u.name AS name,
          u.avatar AS avatar,
          u.about AS about,
          IF(u.sex = 'm', 'male', 'female') AS sex,
          TIMESTAMPDIFF(YEAR, u.birth_date, CURDATE()) AS age,
          ROUND(((st_distance(u.location, ST_GeomFromText(?)) * 111195) / 1000), 0) as distance,
          GROUP_CONCAT(img.path) as images,
          IF(GROUP_CONCAT(f.id) IS NOT NULL, true, false) as fav
        FROM users AS u
        LEFT JOIN user_images AS img on img.user_id = u.id
        LEFT JOIN blocks AS blk ON (blk.from_user_id = ? AND blk.to_user_id = u.id)
         OR (blk.to_user_id = ? AND blk.from_user_id = u.id)
        LEFT JOIN favorites AS f ON f.owner_id = ? AND f.to_id = u.id
        WHERE (u.id != ?)
        AND (? = 'b' OR ? = u.sex)
        AND (u.updated_at >= '2019-05-22 22:00:00')
        AND ( u.interest = 'b' OR ? = u.interest)
        AND (blk.id IS NULL)
        GROUP BY u.id
        ORDER BY distance"
      , [
        $point->toWKT(),
        $user->id, $user->id, $user->id, $user->id,
        $user->interest, $user->interest,
        $user->sex
      ]);
      foreach ($search as $u) {
        if ($u->images != null) {
          $u->images = explode(',', $u->images);
        } else {
          $u->images = [];
        }
      }

      return response()->json($search, 200);
    }

    public function getFavorites()
    {
      $user = Auth::user();
      $favUsers = DB::select("SELECT
        u.id as id,
        u.name as name, 
        u.avatar as avatar,
        u.about as about,
        IF(u.sex = 'f', 'female', 'male') as sex,
        TIMESTAMPDIFF(YEAR, u.birth_date, CURDATE()) AS age,
        ROUND(((st_distance(u.location, ST_GeomFromText(?)) * 111195) / 1000), 0) as distance,
        GROUP_CONCAT(img.path) as images
        FROM users as u
        LEFT JOIN user_images AS img on img.user_id = u.id
        LEFT JOIN blocks AS blk ON (blk.from_user_id = ? AND blk.to_user_id = u.id)
         OR (blk.to_user_id = ? AND blk.from_user_id = u.id)
        LEFT JOIN favorites AS f ON f.owner_id = ? AND f.to_id = u.id   
        WHERE (u.id != ?)
        AND (u.updated_at >= '2019-05-22 22:00:00')
        AND f.id IS NOT NULL
        GROUP BY u.id
        ORDER BY u.id
      ", [
        $user->location->toWkt(),
        $user->id, $user->id, $user->id, $user->id
      ]);
      foreach($favUsers as $u){
          $u->fav = true;
        if ($u->images != null) {
          $u->images = explode(',', $u->images);
        } else {
          $u->images = [];
        }
      }
      return response()->json($favUsers, 200);
    }
    public function test(Request $req)
    {
      $user = Auth::user();
      $conf = $user->notify();
      return $conf;
    }
}
