<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingsModel extends Model
{
    protected $fillable = [
        'rating'
    ];
    use HasFactory;
}
