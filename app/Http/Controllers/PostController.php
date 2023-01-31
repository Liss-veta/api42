<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function show(){
        return response()->json(Post::all());
    }
    public function create(Request $request){
        Post::insert([
            'title'=>$request->input('title'),
            'body'=>$request->input('body'),
            'price'=>$request->input('price'),
        ]);
        $product = Post::where('title', $request->input('title'))->first();
        return response()->json([
            'message' => "Товар добавлен",
            'id' => $product->id,
        ], JSON_UNESCAPED_UNICODE);
    }
    public function update(Request $request, $id){
        Post::where('id', $id)->update([
            'title'=>$request->input('title'),
            'body'=>$request->input('body'),
            'price'=>$request->input('price'),
        ]);
        $product = Post::where('id', $id)->first();
        return response()->json([
            'message' => "Данные обновлены",
            $product
        ], JSON_UNESCAPED_UNICODE);
    }
    public function delete($id){
        Post::where('id', $id)->delete();
        return response()->json([
            'message' => "Товар уадлен",
        ], JSON_UNESCAPED_UNICODE);
    }

}
