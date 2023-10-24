<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieModel extends Model
{
    protected $fillable = [
        'title',
        'description',
        'genre',
        'release_date',
        'director',
        'cast',
        'rating',
        'image',
        'trailer',
    ];
    use HasFactory;
}
