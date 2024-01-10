<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Model
{
    use HasFactory,HasApiTokens,Notifiable,SoftDeletes,HasRoles;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
