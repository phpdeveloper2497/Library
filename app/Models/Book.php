<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;

class Book extends Model
{
    use HasFactory, HasTranslations, SoftDeletes,Notifiable;

    protected $fillable = ['category_id','name','author','quantity'];

    public $translatable = ['name', 'author'];

//    protected $casts = [];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function category():belongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function bookings(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function photo(): MorphOne
    {
        return $this->morphOne(Photo::class,'photoable');
    }


}
