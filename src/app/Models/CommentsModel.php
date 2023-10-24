<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentsModel extends Model
{
    protected $fillable = [
        'comment'
    ];
    use HasFactory;
}
