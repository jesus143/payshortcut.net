<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/



use App\Member;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Member::class, function (Faker\Generator $faker) {

    return [
        'first_name'=>$faker->firstName,
        'last_name'=>$faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'telephone'=>$faker->phoneNumber,
        'country'=>$faker->country,
        'post_code'=>rand(1000,100000),
        'address'=>$faker->address,
        'look_up'=>$faker->name,
        'uniform_number'=>rand(1000,100000)
     ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
    $date = new dateTime();
    return [
        'member_id'=> rand(1, Member::count()),
        'status'=> 'success',
        'merchant_id'=> rand(100000,10000000),
        'version'=> '1.1',
        'response_type'=> 'String',
        'check_value'=> rand(99999,999999999999),
        'time_stamp'=> date("Y-m-d h:i:s"),
        'merchant_order_no'=> rand(9999999999,999999999999),
        'amt'=> rand(100,1000),
        'hash_key'=> rand(999,99999),
        'hash_iv'=>  rand(999,99999),
        'trade_no'=>  rand(999,99999),
        'token_value'=>  rand(999,99999),
        'token_life'=>  rand(999,99999)

    ];
});
