<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LogoutController extends Controller
{
    public function logout(Request $request){

        return DB::table('users')->where('token', '!=', null)->update([
            'token'=> 'null'
        ]);
    }
    // public function signUp(Request $request){
    //     $one_password = $request->input('password');
    //     $two_password = $request->input('passwordTwo');
    //     if($one_password !== $two_password){
    //         return response()->json([
    //             'message' => 'Пароли не совпадают',
    //             'code' => 403,
    //         ]);
    //     }
    //     $user = User::create([
    //         'name' => $request->input('name'),
    //         'email' => $request->input('email'),
    //         'password' => Hash::make($request->input('password')),
    //         'token' => Str::random(40),
    //     ]);
    //     return response()->json([
    //         'user_token' => $user->token
    //     ]);
    // }

    // public function logout(){

    // }

    // public function signIn(Request $request){
    //     $email = $request->input('email');
    //     $password = Hash::male($request->input('password'));
    // }
}
