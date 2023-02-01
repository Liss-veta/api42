<?php

namespace App\Http\Controllers;

use App\Http\Resources\Cart as ResourcesCart;
use App\Models\Cart;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add($product_id){
        $user = User::whereNotNull('token')->first();
        $price = Post::where('id', $product_id)->first();
        Cart::create([
            'id_user' => $user->id,
            'id_product' => $product_id,
            ]);
        return response(json_encode([
            'message' => "Товар в корзине"
        ], JSON_UNESCAPED_UNICODE));
    }
    public function show(){
        $user = User::whereNotNull('token')->first();
        // $arr = Cart::where('id_user', $user->id)->select('id_product');
        $arr = DB::table('carts')->where('id_user', $user->id)->pluck('id_product');
        // if(count($arr) == 0){
        //     return response(json_encode([
        //         'message'=>"Корзина пуста"
        //     ], JSON_UNESCAPED_UNICODE));
        // }
        // $arr = Cart::join('posts', 'carts.id_product', '=', 'id_product')->where('id_user', $user->id)->select('posts.*', 'carts.price')->get();
        // dd($arr);
        return response()->json([
            'content' => ResourcesCart::collection(Cart::all()->where('id_user', $user->id))
        ]);
    }
    public function delete($id){
        $user = User::whereNotNull('token')->first();
        Cart::where('id_user', $user->id)->where('id_product', $id)->first()->delete();
        return response(json_encode([
            'message' => "Позиция удалена из корзины"
        ], JSON_UNESCAPED_UNICODE));
    }
}
