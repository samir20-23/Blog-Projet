<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'avatar', 
        'bio', 
        'social_links'
    ];

    protected $casts = [
        'social_links' => 'json'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
