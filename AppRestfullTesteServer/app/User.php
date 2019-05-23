<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use App\Notifications\AccountConfirm;

use App\Lib\Geocode;

use Auth;
use DateTime;
use Log;
use DB;

class User extends Authenticatable
{
	use HasApiTokens, Notifiable, SpatialTrait;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
    'name', 'email', 'password', 'sex', 'interest', 'avatar', 'birth_date', 'about',
    'feed_max_distance'
	];
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
  ];
  
  protected $spatialFields = [
    'location'
  ];

  
  public function images() 
  {
    return $this->hasMany('App\UserImage', 'user_id');
  }

  public function toAppJson()
  {
    $images = [];
   
    $imgObjs = $this->images;

    foreach ($imgObjs as $img) {
      array_push($images, $img->path);
    }

		$jsonObj = [
			'id' => $this->id,
			'name' => $this->name,
			'age' => date_diff(date_create($this->birth_date), date_create('today'))->y,
			'sex' => $this->sex == 'm' ? 'male' : 'female',
			'avatar' => $this->avatar,
      'about' => $this->about,
      'images' => $images
		];

		if (Auth::user()->id == $this->id) {
			$additionalInfo = [
				'email' => $this->email,
				'interest' => $this->interest,
				'feedMaxDistance'=> $this->feed_max_distance
			];

			$jsonObj = array_merge($jsonObj, $additionalInfo);
		}

		return $jsonObj;

  }
	
	public function createApiToken() 
	{
		$this->tokens()->delete();
		return $this->createToken('api_token')->accessToken;
	}
  

	public static function authenticate($email, $password)
	{
		if(Auth::attempt(['email' => $email, 'password' => $password])) {
			return Auth::user();
		} else {
			return false;
		}
  }
	
	public function accountConfirm()
	{
		$notification = $this->notify(new AccountConfirm);
		return $notification;
	}

	public function routeNotificationForMail($notification)
	{
			return $this->email;
	}
	//relações entre tabelas users e blocks
	public function blocks()
	{
		return $this->hasMany('App\Block', 'from_user_id', 'id');
	}	
	public function favorites(){
		return $this->hasMany('App\Favorite', 'owner_id', 'id');
	}
	public function confirmOldPass($pass)
	{
		$base =  base64_encode(md5($pass, true));
		$hex = md5($base);
		return $this->password;
    return ["u"=> $hex == $this->password];
	}
	public function notify($title = "Nova mensagem", $msg = "Nova Mensagem recebida"){
		$token = $this->exp_token;
		$url = "https://exp.host/--/api/v2/push/send";
		$message = [
			"to"=> $token,
			"title" => $title,
			"body" => $msg,
			"subtitle" => "CLUB99"
		];
		$client = new \GuzzleHttp\Client();
		$res = $client->request('POST', $url, [
			'form_params' => $message
		]);
		return $res;
	}
}
