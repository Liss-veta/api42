<?php

namespace App\Http\Controllers;

use App\Http\Resources\Cart;
use App\Http\Resources\OrderResource;
use App\Models\Cart as ModelsCart;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function create(){
        $user = User::whereNotNull('token')->first();
        $arr = DB::table('carts')->where('id_user', $user->id)->pluck('id_product');
        $summ = [];
        foreach($arr as $index){
            array_push($summ, DB::table('posts')->where('id', $index)->value('price'));
        }
        $order = Order::create([
            'products' => json_encode($arr),
            'order_price' => array_sum($summ),
            'id_user' => $user->id
        ])->first();
        ModelsCart::where('id_user', $user->id)->delete();
        return response(json_encode([
            'order_id' => $order->id,
            'message'=>'Заказ оформлен'
        ], JSON_UNESCAPED_UNICODE));
    }

    public function show(){
        $user = User::whereNotNull('token')->first();
        return response()->json([
            'content' => OrderResource::collection(Order::all()->where('id_user', $user->id))
        ]);
    }
}
