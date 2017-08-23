<?php

use Illuminate\Database\Seeder;
use App\models\auth\User;
use App\models\auth\Role;
use App\models\auth\Permission;

class AuthSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $admin = new  Role();
        $admin->name = 'admin';
        $admin->display_name = 'Admin'; // optional
        $admin->description = 'User is an admin'; // optional
        $admin->save();

        $role1 = new  Role();
        $role1->name = 'employee';
        $role1->display_name = 'Employee'; // optional
        $role1->description = 'User is an employee'; // optional
        $role1->save();

        $createPersonal = new App\models\auth\Permission();
        $createPersonal->name = 'create-personal';
        $createPersonal->display_name = 'Create Personals'; // optional
// Allow a user to...
        $createPersonal->description = 'Create new personals'; // optional
        $createPersonal->save();

        $editPersonal = new Permission();
        $editPersonal->name = 'edit-personal';
        $editPersonal->display_name = 'Edit Personals'; // optional
// Allow a user to...
        $editPersonal->description = 'Edit existing personal'; // optional
        $editPersonal->save();

        $admin->attachPermissions(array($createPersonal, $editPersonal));

        \App\models\Personal::find(1)
            ->user()->save(factory(User::class,1)->make()->first());

        \App\models\Personal::find(2)
            ->user()->save(factory(User::class,1)->make()->first());

        \App\models\Personal::find(3)
            ->user()->save(factory(User::class,1)->make()->first());

        \App\models\Personal::find(4)
            ->user()->save(factory(User::class,1)->make()->first());

        \App\models\Personal::find(5)
            ->user()->save(factory(User::class,1)->make()->first());

        \App\models\Personal::find(1)->user->attachRole($admin);
        \App\models\Personal::find(2)->user->attachRole($role1);
//        factory(User::class,5)->create();
//        User::find(1)->attachRole($admin);
//        User::find(2)->attachRole($admin);
//
//        User::find(3)->attachRole($role1);
//        User::find(4)->attachRole($role1);
//        User::find(5)->attachRole($role1);




    }
}
