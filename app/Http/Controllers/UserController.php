<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\RoleUser;
use App\User;
class UserController extends Controller
{
    //
    public function index(){
        $users = User::paginate(7);
        return view('users',[
            'users'=>$users
        ]);
    }


    public function storeUser(){
        $user =User::create([
            'name'=> request('name'), 
            'email'=> request('email'), 
            'password'=> Hash::make( request('password') ),
        ]);
        $role_id = Role::where('role_name','admin')->first()->id;
        RoleUser::create([
            'role_id'=> $role_id,
            'user_id'=>$user->id
        ]);
        return redirect()->back()->with("success","User Aded Successfully");
    }

}
