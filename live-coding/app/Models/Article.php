<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id','category_id','comment_id','tags_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comment() {
        return $this->belongsTo(Comment::class);
    }
    
    public function tag() {
        return $this->belongsTo(Tag::class);
    }
    
    
}
