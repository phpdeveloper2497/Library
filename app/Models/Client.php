<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['full_name','library_card_id','phone_number'];

//    public function __construct()
//    {
//        return $this->middleware("auth:sanctum");
//    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function photo(): MorphOne
    {
        return $this->morphOne(Photo::class,"photoable");
    }
}
