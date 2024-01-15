<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['full_name'];

//    public function __construct()
//    {
//        return $this->middleware("auth:sanctum");
//    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
