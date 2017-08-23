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



/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\models\auth\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->unique()->userName,
       // 'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
//        'personal_id'=>\App\models\Personal::all()->random()->id
    ];
});

$factory->define(App\models\Personal::class, function (Faker\Generator $faker) {
    static $password;

    $gender= $faker->randomElement(['M','F']);
    $firstNameGender = $gender == 'M' ? 'male' : 'female';

    return [
        'name' => $faker->firstName($firstNameGender),
        'lastName' => $faker->lastName,

        'DNI' => $faker->unique()->numerify('########'),
        'birthDate' => $faker->dateTimeBetween('-30 years','-18 years'),
        'contractDate' => $faker->dateTimeBetween('-10 years','-1 months'),
        'salary' => $faker->numberBetween(600,1600),
        'gender' => $gender,

        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->email
    ];
});

$factory->define(App\models\Activity::class, function (Faker\Generator $faker) {
    return [
        'item' => $faker->unique()->numerify('######'),
        'name' => $faker->unique()->sentence,
        'unit_id'=> \App\models\Unit::all()->random()->id,
        'type_id' => \App\models\ActivityType::all()->random()->id
   ];
});

$factory->define(App\models\ActivityType::class, function (Faker\Generator $faker) {
    return [
        'name' => 'AT-'.$faker->unique()->word,
    ];
});

$factory->define(App\models\Unit::class, function (Faker\Generator $faker) {
    return [
        'name' => 'U-'.$faker->unique()->word,
        'description' => $faker->sentence,
        'type' => $faker->randomElement(['A','B','C']),
    ];
});

