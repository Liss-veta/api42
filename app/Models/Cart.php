<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function users(){
        return $this->belongsTo(User::class, 'id_user', 'id'); 
    }
    public function posts(){
        return $this->belongsTo(Post::class, 'id_product', 'id'); 
    }
}
