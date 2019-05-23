<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserImage;
use App\Lib\Geocode;
use Auth;
use DB;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Support\Facades\Storage;


use Validator;
use Exception;

class UserController extends Controller
{
	private function saveUserImage($base64)
	{
		$img = preg_replace('#data:image/[^;]+;base64,#', '', $base64);
  }
	public function register(Request $req) 
	{
    $messages = [
      'email.required' => 'Insira um email',
      'email.email' => 'Email inválido',
      'email.unique' => 'Email já registrado',
      'email.max' => 'Email muito grande',

      'name.required' => 'Seu nome deve ser preenchido',
      'name.string' => 'Nome inválido',
      'name.max' => 'Seu nome é muito grande',

      'about.required'=> 'O campo Sobre não deve ser nulo',
      
      'password.required' => 'A senha deve ter entre 6 e 21 caracteres',
      
      'sex.required' => 'Você deve selecionar seu sexo',
      
      'interest.required' => 'Você deve definir seu interesse',
      
      'birthDate.required' => 'Você deve incerir sua Data de nascimento',
      'birthDate.date' => 'A data incerida não é reconhecida'
    ];
    $valid = [
      'name' => 'required|string|max:225',
      'email' => 'required|email|unique:users|max:120',
      'password' => 'required',
      'about' => 'required',
      'avatar' => 'nullable',
      'sex' => 'required',
      'interest' => 'required',
      'birthDate' => 'required|date'
    ];
    $validator = Validator::make($req->all(), $valid, $messages);

    if ($validator->fails()) {
      $errors = array_merge(['fields' => $validator->errors()], 
                            ['error' => 'Não foi possível validar os campos preenchidos']);
      return response()->json($errors, 422);
    }

    if ($req->avatar) {
      $avatar = $this->saveUserImage($req->avatar);
    } else {
      $avatar = $req->sex == 'm' ? 
      asset('storage/images/defaults/male.png'):
      asset('storage/images/defaults/female.png');
    }
    
    $user = new User();
    $user->name = $req->name;
    $user->email = $req->email;
    $user->password = Hash::make($req->password);
    $user->about = $req->about;
    $user->avatar = $avatar;
    $user->sex = $req->sex;
    $user->interest = $req->interest;
    $user->location = new Point($req->location['lat'], $req->location['lng']);
    $user->birth_date = date_create($req->birthDate);
    $user->save();
    $userAuth = User::authenticate($user->email, $req->password);
    
    $userAuth->apiToken = $userAuth->createApiToken();
    //$userAuth->accountConfirm();

    return response()->json([
      'authenticated' => true,
      'user' => $userAuth->toAppJson(),
      'apiToken' => $userAuth->apiToken,
    ], 200);
  }
  
	public function login(Request $req)
	{ 
    $u = User::where('email', $req->email)->first();
    if($u != null && strlen($u->password) < 50){
      if($u->confirmOldPass($req->password)){
        $u->password = Hash::make($req->password);
        $u->save();
      }
    }else if($u == null){
      return response()->json(['error'=>'Não foi possível encontrar este usuário'], 422);
    }
    $user = User::authenticate($req->email, $req->password);
    if ($user != false) {
      return response()->json([
        'authenticated' => true,
        'user' => $user->toAppJson(),
        'apiToken' => $user->createApiToken()
      ], 200);
    } else {
      return response()->json(['error'=>'Email e/ou senha incorretos'], 422); 
    }
  }
	public function apiTokenCheck(Request $req) 
	{
		return response()->json([
		'authenticated' => true,
		'user' => Auth::user()->toAppJson()
		], 200);
  }
  public function setLocation(Request $req)
  {
    $user = Auth::user();

    if (isset($req->lat) && isset($req->lng)) {
      $user->location = new Point($req->lat, $req->lng);
    } else if (isset($req->address)) {
      $user->location = Geocode::getPointFromAddress($req->address);
    }
    
    if ($user->update()) {
      return response()->json([], 200);
    } else {
      return response()->json([], 500);
    }

  }
  public function uploadImage(Request $req)
  {
    $user = Auth::user();
    $nameFile = null;
    $appurl = env("APP_URL", "http://localhost");
    $retpath = "";

    if (!empty($req->image64) && !empty($req->extension)) {

      $extension = $req->extension;
      $image = base64_decode($req->image64);
      $name = uniqid(date('HisYmd'));
      $nameFile = "{$name}.{$extension}";

      if (!$req->isAvatar) {

        Storage::put('public/images/'.$nameFile, $image);
        
        $userimage = new UserImage();
        $userimage->user_id = $user->id;
        $userimage->path =  $appurl . "/storage/images/" . $nameFile;
        $userimage->save();
        $retpath = $userimage->path;
      } else {
        
        $currname = substr($user->avatar, strlen($appurl) + strlen("/storage/images/"));

        if ($currname != "defaults/male.png" && $currname != "defaults/female.png") {
          Storage::delete('public/images/' . $currname);
        }

        Storage::put('public/images/' . $nameFile, $image);

        $user->avatar = $appurl . '/storage/images/' . $nameFile;
        $user->save();

        $retpath = $user->avatar;
      }

      return response()->json([
        "newImagePath" => $retpath
      ], 200);

    } else {
      return response()->json([], 500);
    }
  
  }
  public function deleteImage(Request $req) {
    $user = Auth::user();

    if (!empty($req->path)) {
      Log::info($req->path);
      $img = $user->images->where('path', '=', $req->path)->first();
      Log::info($img);
      if (!empty($img)) {
        Log::info($img);
        $basename = substr(substr($img->path, strpos($img->path, 'storage/images/')), 15);
        Log::info("WILL DELETE: " . $basename);
        Storage::delete('public/images' . $basename);
        $img->delete();
      }
    }

    return response()->json([], 200);
  }
  public function confirm()
  {
    if(Auth::check()){
      $user = Auth::user();
      $user->email_verified_at = time();
      $resp = $user->save();
      return ['success'=>$resp];
    }else{
      return ['success'=>false];
    }
  }
  public function setExpoToken(Request $req)
  {
    $user = Auth::user();
    $user->exp_token = $req->token;
    $confirm = $user->save();
    return ['success'=> $confirm];
  }
  public function editData(Request $req)
  {
    $user = Auth::user();
    $user->name = $req->name;
    $user->email = $req->email;
    $user->about = $req->about;
    $user->feed_max_distance = $req->distance;
    $conf = $user->save();
    return ["success"=>$conf];
  }
  public function confirmPassword(Request $req)
  {
    $user = Auth::user();
    return ['success'=>Hash::check($req->password, $user->password)];
  }
  public function redefPassword(Request $req)
  {
    $user = Auth::user();
    $user->password = Hash::make($req->password);
    $conf = $user->save();
    return ['success'=>$conf];
  }
  public function getUserInfo(Request $req)
  {
    Log::info('Users: '. implode(', ', array_map('intval', $req->users)));
    
    $user = Auth::user();

    $users = DB::select("SELECT
        u.id as id,
        u.name as name,
        u.avatar as avatar,
        u.about as about,
        IF(u.sex = 'f', 'female', 'male') as sex,
        TIMESTAMPDIFF(YEAR, u.birth_date, CURDATE()) AS age,
        GROUP_CONCAT(img.path) as images,
        IF(GROUP_CONCAT(f.id) IS NOT NULL, true, false) as fav
      FROM users AS u
      LEFT JOIN user_images AS img on img.user_id = u.id
      LEFT JOIN blocks AS blk ON (blk.from_user_id = ? AND blk.to_user_id = u.id)
        OR (blk.to_user_id = ? AND blk.from_user_id = u.id)
      LEFT JOIN favorites AS f ON f.owner_id = ? AND f.to_id = u.id
      WHERE u.id IN (?)
      AND u.id != ?
      AND blk.id IS NULL
      GROUP BY u.id
    ", [
      $user->id, $user->id, $user->id,
      implode(',', array_map('intval', $req->users)),
      $user->id
    ]);

    foreach($users as $u){
      if ($u->images != null) {
        $u->images = explode(',', $u->images);
      } else {
        $u->images = [];
      }
    }
    return $users;
  }
  public function share(){
    return redirect('/#download');
  }
}
