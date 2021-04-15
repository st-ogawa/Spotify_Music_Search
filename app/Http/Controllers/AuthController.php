<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function userRegister(Request $request){
    //    $request->validate(
    //     [
    //        'name' =>'required|string|unique:users.name',
    //        'email' => 'required|unique:users.email',
    //        'password' => 'required|min:8',
    //    ],
    //    [
    //        'name.required' => '名前は必須です',
    //        'email.required' => 'メールは必須です',
    //        'name.required' => 'パスワードは必須です'
    //    ]
    // );

        $users = new User;
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->input("password"));
        $users->save();
    }
}