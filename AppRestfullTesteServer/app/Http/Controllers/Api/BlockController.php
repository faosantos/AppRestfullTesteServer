<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Block;
use Auth;
use DB;

class BlockController extends Controller
{
    public function blockUser($id)
    {
        $user = Auth::user();
        $favorite = DB::select(
            'SELECT f.id, COUNT(f.id) as num
            FROM favorites as f
            WHERE (owner_id = ? AND to_id = ?) 
            OR (owner_id = ? AND to_id = ?) GROUP BY id'
        , [
            $id, $user->id, $user->id, $id
        ]);
        if(array_key_exists(0, $favorite) && $favorite[0]->num > 0){
            $remFavorite = DB::select('DELETE FROM favorites WHERE id = ?', [$favorite[0]->id]);
        }
        $block = Block::where('from_user_id', $user->id)->where('to_user_id', $id);
        $exist = $block->exists();
        if(!$exist)
            $block = $block->create(['from_user_id' => $user->id,'to_user_id' => $id]);
        return ['success'=>true];
    }
    public function unblockUser($id)
    {
        $user = Auth::user();
        $block = Block::where('from_user_id', $user->id)
        ->where('to_user_id', $id);
        $exist = $block->exists();
        if($exist)
            $unblock = $block->delete();
        return ['success'=>true];
    }
}
