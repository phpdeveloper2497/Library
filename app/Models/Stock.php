<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Stock extends Model
{
    use HasFactory;

//    protected $fillable = [''];


//    public function books() :BelongsToMany
//    {
//        return $this->BelongsToMany(Book::class);
//    }
}
