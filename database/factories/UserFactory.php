<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ApiList;
use App\Models\Subscription;
use App\Models\Subtopic;
use App\Models\User as ModelsUser;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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
        'username' => $faker->name,
        'password' => Hash::make('password'),
        'lat' => rand(0.1,90.00),
        'lon' => rand(0.1,90.00),
        'token' => Str::random(10),
        'token_expire' =>$faker->dateTime( $max = 'now'),
        'last_access' => $faker->dateTime( $max = 'now'),
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Subscription::class, function (Faker $faker) {
    $user=ModelsUser::all()->pluck('user_id')->take(rand(1,5));
    return [
        'user_id' => $user[0],
        'topic' => $faker->sentence(),

    ];
});

$factory->define(Subtopic::class, function (Faker $faker) {
    $subscription=Subscription::all()->pluck('subscription_id')->take(rand(1,5));
    return [
        'subscription_id' => $subscription[0],
        'subtopic' => $faker->sentence(),
  
    ];
});

$factory->define(ApiList::class, function (Faker $faker) {
    $subscription=Subscription::all()->pluck('subscription_id')->take(5);
    return [
        'subscription_id' =>$subscription[0],
        'url' => $faker->url,
  
    ];
});