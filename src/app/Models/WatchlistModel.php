<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchlistModel extends Model
{
    protected $fillable = [
        'movie_id',
        'user_id',
        
    ];
    use HasFactory;
}
