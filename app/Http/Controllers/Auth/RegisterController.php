<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(){
        return view('/register');
    }

    public function create(Request $request){
        $arr_error = [
            'passwrod_confirnation'=>'Пароли не совпадают',
            'email'=>'Неправильный адрес электронный почты',
            'name'=>'Напишите свое имя',
        ];
        $arr_input_error = [];
        if($request->input('password') !== $request->input('password_confirmation')){
            if(!str_contains($request->input('email'),'@')){
                if(!$request->input('name'))
                {

                    //  DB::table('users')->insert([
                    // 'email'=>$request->input('email'),
                    // 'name'=>$request->input('name'),
                    // 'password'=>Hash::make($request->input('password')),
                    // 'role'=>'user',
                    // 'token'=> 'null',
                    // ]);
                    // DB::table('users')->where('email', $request->input('email'))->update([
                    //     'token'=>Str::random(40)
                    // ]);
                    // $user = DB::table('users')->where('email', $request->input('email'))->get()->first();
                    return response(json_encode([
                        'message' => "Несоответсвие требованиям",
                        'code' => 422,
                        'warnings' => $arr_error,
                        // 'user_token' => $user->token,
                    ], JSON_UNESCAPED_UNICODE), 422);
                }
                else {
                    unset($arr_error['name']);
                    // array_pop($arr_error);
                    return response(json_encode([
                        'message' => "Несоответсвие требованиям",
                        'code' => 422,
                        'warnings' => $arr_error,
                    ], JSON_UNESCAPED_UNICODE), 422);
                }
            }
            else{
                unset($arr_error['email']);
                    return response(json_encode([
                        'message' => "Несоответсвие требованиям",
                        'code' => 422,
                        'warnings' => $arr_error,
                    ], JSON_UNESCAPED_UNICODE), 422);
            }
        }
        else{
            DB::table('users')->insert([
            'email'=>$request->input('email'),
            'name'=>$request->input('name'),
            'password'=>Hash::make($request->input('password')),
            'role'=>'user',
            'token'=> 'null',
            ]);
            DB::table('users')->where('email', $request->input('email'))->update([
                'token'=>Str::random(40)
                ]);
            $user = DB::table('users')->where('email', $request->input('email'))->get()->first();
            return response(json_encode([
                'message' => "Аккаунт успешно создан",
                'user_token' => $user->token,
            ], JSON_UNESCAPED_UNICODE));
        }
    }
}
