<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 
        'slug', 
        'content', 
        'seo_title', 
        'seo_description', 
        'status', 
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    protected static function booted()
    {
        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    public function media() {
        return $this->morphMany(Media::class, 'model');
    }
}
