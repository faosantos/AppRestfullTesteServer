<?php
use Illuminate\Http\Request;
use Carbon\Traits\Rounding;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');
Route::get('/share', 'Api\UserController@share');

Route::group(['middleware' => 'auth:api'], function(){
  Route::patch('setLocation', 'Api\UserController@setLocation');
  Route::patch('setFavorite', 'Api\UserController@setFavorite');
  
  Route::post('uploadImage', 'Api\UserController@uploadImage');
  Route::post('setExpoToken', 'Api\UserController@setExpoToken');
  Route::post('editData', 'Api\UserController@editData');
  Route::post('confirmPassword', 'Api\UserController@confirmPassword');
  Route::post('redefPassword', 'Api\UserController@redefPassword');
  
  Route::delete('deleteImage', 'Api\UserController@deleteImage');

  Route::get('apiTokenCheck', 'Api\UserController@apiTokenCheck');
  Route::get('localFeed', 'Api\FeedController@getLocal');
  Route::get('searchFeed', 'Api\FeedController@getSearch');
  Route::get('/favoritesFeed', 'Api\FeedController@getFavorites');
  Route::get('/fav/add/{id}', 'Api\FavoriteController@addFavorite');
  Route::get('/fav/remove/{id}', 'Api\FavoriteController@rmFavorite');
  Route::get('/block/add/{id}', 'Api\BlockController@blockUser');
  Route::get('/block/remove/{id}', 'Api\BlockController@unblockUser');
  /**
   *  modelo:
   *  http://localhost:8000/api/getUserInfo?users[]=1&users[]=2&users[]=3&users[]=4
   *  */
  Route::get('/getUserInfo', 'Api\UserController@getUserInfo');
});





//parte original
// use Illuminate\Http\Request;

// /*
// |--------------------------------------------------------------------------
// | API Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register API routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | is assigned the "api" middleware group. Enjoy building your API!
// |
// */

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
