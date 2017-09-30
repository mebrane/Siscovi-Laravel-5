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
use Carbon\Carbon;
//Sofa\Eloquence\Model::unsetEventDispatcher();
//Sofa\Eloquence\Model::unsetEventDispatcher();
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
    $gender = $faker->randomElement(['M', 'F']);
    $firstNameGender = $gender == 'M' ? 'male' : 'female';
    return [
        'name' => $faker->firstName($firstNameGender),
        'lastName' => $faker->lastName,

        'DNI' => $faker->unique()->numerify('########'),
        'birthDate' => $faker->dateTimeBetween('-30 years', '-18 years'),
        'contractDate' => $faker->dateTimeBetween('-10 years', '-1 months'),
        'salary' => $faker->numberBetween(600, 1600),
        'gender' => $gender,

        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->email

//        'nombre' => $faker->firstName($firstNameGender),
//        'apellido' => $faker->lastName,
//
//        'DNI' => $faker->unique()->numerify('########'),
//        'nacimiento' => $faker->dateTimeBetween('-30 years', '-18 years'),
//        'contrato' => $faker->dateTimeBetween('-10 years', '-1 months'),
//        'sueldo' => $faker->numberBetween(600, 1600),
//        'sexo' => $gender,
//
//        'direccion' => $faker->address,
//        'telefono' => $faker->phoneNumber,
//        'correo' => $faker->unique()->email
    ];
});

$factory->define(App\models\Activity::class, function (Faker\Generator $faker) {
    return [
        'item' => $faker->unique()->numerify('######'),
        'name' => $faker->unique()->sentence,
        'unit_id' => \App\models\Unit::all()->random()->id,
        'type_id' => \App\models\ActivityType::all()->random()->id
    ];
});

$factory->define(App\models\ActivityType::class, function (Faker\Generator $faker) {
    return [
        'name' => strtoupper(
            'AT-' . $faker->unique()->word
        ),
    ];
});


$factory->define(App\models\Company::class, function (Faker\Generator $faker) {
    return [
        'RUC' => $faker->unique()->numerify('#############'),
        'legalName' => $faker->company,
        'address' => $faker->address,
        'type' => $faker->randomElement(\App\models\Company::TYPES),
        'phone' => $faker->phoneNumber,
        'email' => $faker->companyEmail,
        'website' => $faker->url,
    ];
});

$factory->define(App\models\Contract::class, function (Faker\Generator $faker) {

    $starts_at = Carbon::createFromTimestamp($faker->dateTimeBetween($startDate = '-1 year', $endDate = '+1 month')->getTimeStamp());

    $ends_at = Carbon::createFromFormat('Y-m-d H:i:s', $starts_at)->addMonths($faker->numberBetween(1, 8));

    $k = 1000;

    return [
        'name' => strtoupper(
                $faker->unique()->sentence
            ),
        'project' => $faker->sentences(2,true),
        'starts_at' => $starts_at,
        'ends_at' => $ends_at,
        'amount' => $faker->randomFloat(2, 50 * $k, 200 * $k),
        'signature' => $faker->sentence,
        'customer_id' => \App\models\Customer::all()->random()->id,
    ];
});

$factory->define(App\models\Department::class, function (Faker\Generator $faker) {

    return [
        'name' => strtoupper(
            'DEP-'
            . $faker->unique()->word
        ),
    ];
});

$factory->define(App\models\District::class, function (Faker\Generator $faker) {
    return [
        'name' => strtoupper(
            'DIS-'
            . $faker->unique()->word
        ),
        'ubigeo' => $faker->unique()->numerify('##########'),
        'province_id' => \App\models\Province::all()->random()->id,
    ];
});

$factory->define(App\models\Machine::class, function (Faker\Generator $faker) {
    return [
        'registry' => $faker->unique()->numerify('##########'),
        'name' => strtoupper('MACH-' . $faker->unique()->word),
        'cost_per_hour' => $faker->randomFloat(2, 1, 5),
        'brand' => $faker->words(2,true),
        'type' => $faker->randomElement(\App\models\Machine::TYPES),
        'provider_id' => \App\models\Provider::all()->random()->id
    ];
});

$factory->define(App\models\Material::class, function (Faker\Generator $faker) {
    return [
        'name' =>
            'MAT-' . strtoupper(
                    $faker->unique()->words($faker->numberBetween(1, 3),true)
            ),
        'description' => $faker->sentence,
        'price'=>$faker->randomFloat(2,100,1000),
        'stock'=>$faker->numberBetween(0,100),
        'brand'=>$faker->word,
        'unit_id'=>\App\models\Unit::all()->random()->id,
        'type_id'=>\App\models\MaterialType::all()->random()->id,
    ];
});

$factory->define(App\models\MaterialType::class, function (Faker\Generator $faker) {
    return [
        'name'=>$faker->unique()->word,
    ];
});

$factory->define(App\models\Parameter::class, function (Faker\Generator $faker) {
    return [

    ];
});

$factory->define(App\models\Province::class, function (Faker\Generator $faker) {
    return [
        'name'=>strtoupper('PROV-'.$faker->unique()->word),
        'department_id'=>\App\models\Department::all()->random()->id
    ];
});

$factory->define(App\models\Sector::class, function (Faker\Generator $faker) {
    return [
        'name'=>$faker->unique()->word,
        'tract_id'=>\App\models\Tract::all()->random()->id
    ];
});

$factory->define(App\models\Tract::class, function (Faker\Generator $faker) {
    $start_km=$faker->randomFloat(1,10,200);
    $interval_km=$faker->randomFloat(1,5,20);
    $end_km=$start_km+$interval_km;

    return [
        'name'=>$faker->unique()->word,
        'highway'=>$faker->words(2,true),
        'start_km'=>$start_km,
        'end_km'=>$end_km,
        //FK
        'district_id'=>\App\models\District::all()->random()->id,
    ];
});


$factory->define(App\models\Unit::class, function (Faker\Generator $faker) {
    return [
        'name' => 'U-' . $faker->unique()->word,
        'description' => $faker->sentence,
        'type' => $faker->randomElement(\App\models\Unit::TYPES),
    ];
});

