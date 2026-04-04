<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['id', 'name'];

    public function articles() {
        return $this->hasMany(Article::class, 'tags_id');
    }
}
