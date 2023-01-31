<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function auth(Request $request){
        $user = DB::table('users')->where('email', $request->input('email'))->get()->first();
        if(Hash::check($request->input('password'), $user->password)){
            DB::table('users')->where('email', $request->input('email'))->update([
                'token'=>Str::random(40)
            ]);
            $user = DB::table('users')->where('email', $request->input('email'))->get()->first();
            return response()->json([
                'message'=>'ok',
                'user_token' => $user->token,
        ]);
        }
        else{
            return response(json_encode([
                'message '=> 'Неудачный вход',
                'code' => 401
            ], JSON_UNESCAPED_UNICODE), 401);
        }

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
