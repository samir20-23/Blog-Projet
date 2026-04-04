<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['id', 'content', 'user_id' , 'article_id'];
    public function category()  {
return $this->belongsTo(Category::class);
    }
    public function user(){
return $this->belongsTo(User::class);
    }
}
