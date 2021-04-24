<?php

use App\Role;
use App\RoleUser;
use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       $admin_role= Role::create([
            'role_name'=>'admin'
        ]);
        Role::create([
            'role_name'=>'data_entrant'
        ]);
        //
       $user= User::create([
            'name'=>"Marvin Kiseka",
            'email'=>"admin@marvin.com",
            'password' => Hash::make('admin'),
        ]);

        RoleUser::create([
            'role_id'=>$admin_role->id,
            'user_id'=>$user->id
        ]);
        
    }
}
