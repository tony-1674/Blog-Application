<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'post', 'category_id'];
    
    
    // public function comments(){
    //     return $this->hasMany(Comment::class, 'post_id', 'id');
    // }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
