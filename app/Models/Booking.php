<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];


    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function client() :BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function book():HasOne
    {
        return $this->hasOne(Book::class);
    }

}
