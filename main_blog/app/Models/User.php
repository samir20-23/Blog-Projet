<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    public function profile() {
        return $this->hasOne(Profile::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function articles() {
        return $this->hasMany(Article::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function hasRole($role) {
        if (is_string($role)) {
            return $this->roles->contains('slug', $role);
        }
        return !! $role->intersect($this->roles)->count();
    }

    public function activities() {
        return $this->hasMany(ActivityLog::class);
    }
}
