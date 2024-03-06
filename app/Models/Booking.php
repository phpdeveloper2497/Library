<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Booking extends Model
{
    use HasFactory,HasTranslations,SoftDeletes;
    protected $guarded = [];

//    protected $fillable = ['book_id', 'client_id','status_id','to'];
    public  array $translatable = ["name","author"];


    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function client() :BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function book():BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

}
