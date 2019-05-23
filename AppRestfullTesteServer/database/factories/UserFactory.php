<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Log;
use Grimzy\LaravelMysqlSpatial\Types\Point;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
  return [
      'name' => $faker->name,
      'email' => $faker->unique()->safeEmail,
      'email_verified_at' => now(),
      'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
      'avatar' =>  asset('storage/images/' . $faker->image(public_path('storage/images'), 480, 720, null, false)),
      'sex' => ['m', 'f'][array_rand(['m', 'f'])],
      'interest' => ['m', 'f', 'b'][array_rand(['m', 'f', 'b'])],
      'location' => new Point($faker->latitude(-34.5350970450045, -25.5341969549955), $faker->longitude(-56.405873276704085, -46.02944472329591)),
      'feed_max_distance'=> 5.302,
      'about'=> $faker->text(127),
      'birth_date' => $faker->dateTime('2000-01-01 08:37:17', 'America/Sao_Paulo'),
      'remember_token' => Str::random(10)
  ];
});
