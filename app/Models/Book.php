<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Book extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

//    protected $primaryKey = 'order_id';
    protected $guarded = [];
//    protected $fillable = ['book_id','name','author','quantity'];

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

    public function orders(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }


}
