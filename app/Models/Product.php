<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $fillable = ['name','author'];

    public $tranlatable = ['name', 'author'];

//    protected $casts = [];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function categories():belongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

}
