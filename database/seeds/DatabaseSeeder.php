<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);


//        $admin= new \App\models\auth\User();
//        $admin->username="admin";
//        $admin->password=bcrypt("admin");
//        $admin->save();
//
//        $user= new \App\models\auth\User();
//        $user->username="user";
//        $user->password=bcrypt("user");
//        $user->save();
//
//        factory(App\models\auth\User::class, 10)->create();
//        $this->call(AuthSeed::class);


        factory(App\models\Personal::class,10)->create();

        $this->call(AuthSeed::class);

        factory(App\models\Unit::class,5)->create();

        factory(\App\models\ActivityType::class,5)
            ->create()
            ->each(
                function(\App\models\ActivityType $type){
                    for($i=0;$i<3;$i++){

                        $activity=factory(\App\models\Activity::class,1)->make()->first();

                        $type->activities()->save($activity);
                    }
                }
            );






    }
}
