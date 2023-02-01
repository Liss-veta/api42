<?php

namespace App\Http\Controllers;

use App\Http\Resources\Cart as ResourcesCart;
use App\Models\Cart;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add($product_id){
        $user = User::where('token', '!=', null)->first();
        $price = Post::where('id', $product_id)->first();
        $count = 1;
        $repeat = Cart::where('id_product', $product_id)->WHERE('id_user', $user->id)->first();
        if($repeat){
            $count += $repeat->count;
            $sum_price = $price->price + $repeat->price;
            Cart::where('id_product', $product_id)->WHERE('id_user', $user->id)->update([
                'price' => $sum_price,
                'count' => $count
            ]);
        }
        else{
            Cart::create([
                'id_user' => $user->id,
                'id_product' => $product_id,
                'price' => $price->price,
                'count' => $count
            ]);
        }
        return response(json_encode([
            'message' => "Товар в корзине"
        ], JSON_UNESCAPED_UNICODE));
    }
    public function show(){
        $user = User::where('token', '!=', null)->first();
        return response()->json([
            'content' => ResourcesCart::collection(Cart::all()->where('id_user', $user->id))
        ]);
    }
    public function delete(){
        
    }
}
