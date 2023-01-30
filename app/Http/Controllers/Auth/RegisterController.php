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
        DB::table('users')->insert([
            'email'=>$request->input('email'),
            'name'=>$request->input('name'),
            'password'=>Hash::make($request->input('password')),
            'role'=>'user',
            'token'=> 'null',
        ]);
    }
}
