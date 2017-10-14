<?php

use Illuminate\Database\Seeder;

use \App\models\Activity;
use \App\models\ActivityType;
use \App\models\Company;
use \App\models\Contract;
use \App\models\Customer;
use \App\models\Department;
use \App\models\District;
use \App\models\Machine;
use \App\models\Material;
use \App\models\MaterialType;
use \App\models\Parameter;
use \App\models\Personal;
use \App\models\Provider;
use \App\models\Province;
use \App\models\Sector;
use \App\models\Tract;
use \App\models\Unit;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(\TestSeed2::class);
        // $this->call(UsersTableSeeder::class);
        factory(Personal::class, 10)->create();

        $this->call(\AuthSeed::class);

        factory(Unit::class, 5)->create();

        factory(ActivityType::class, 5)
            ->create()
            ->each(
                function (ActivityType $type) {
                    for ($i = 0; $i < 3; $i++) {

                        $type->activities()
                            ->save(
                                factory(Activity::class)->make()
                            );
                    }
                }
            );


        factory(Department::class,10)->create();
        factory(Province::class,20)->create();
        factory(District::class,40)->create();

        factory(Unit::class,5)->create();
        factory(Tract::class,5)->create();

        factory(ActivityType::class,5)->create();
        factory(MaterialType::class,5)->create();

        factory(Activity::class,30)->create();
        factory(Material::class,50)->create();

        factory(Company::class,50)->create();

        factory(Machine::class,30)->create();


        factory(Tract::class,10)->create();
        factory(Sector::class,20)->create();



        factory(Contract::class,30)->create();

    }
}
