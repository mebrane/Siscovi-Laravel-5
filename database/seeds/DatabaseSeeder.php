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






    }
}
