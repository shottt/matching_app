<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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
        // 'password' => Hash::make('password'),
        'occupation' => Str::random(10),
        'profile_header' => Str::random(10),
        'profile_detail' => $faker->paragraph(),
        'birthday' => $faker->date(),
        'location' => Str::random(20),
        'review' => Str::random(20),        
        'remember_token' => Str::random(10),
    ];
});
$factory->state(User::class, 'upper', function(Faker $faker){
    return [
        'name' => strtoupper($faker->name()),
    ];
});

$factory->state(User::class, 'lower', function(Faker $faker){
    return [
        'name' => strtolower($faker->name()),
    ];
});

//ファクトリーでレコード生成に関連のコールバック処理
$factory->afterMaking(User::class, function (User $user, $faker) {
    $user->name .= ' [making]';
    $user->save();
});

$factory->afterCreating(User::class, function (User $user, $faker) {
    $user->name .= ' [creating]';
    $user->save();
});

$factory->afterMakingState(User::class, 'uppeer', function (User $user, Faker $faker) {
    $user->name .= ' [making state]';
    $user->save();
});

$factory->afterCreatingState(User::class, 'lower', function (User $user, Faker $faker) {
    $user->name .= ' [creating state]';
    $user->save();
});


