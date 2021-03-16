<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'request_id',
        'overview',
        'ingredients',
        'paragraph_1',
        'paragraph_2',
        'paragraph_3',
        'paragraph_4',
        'paragraph_5',
        'paragraph_6',
        'images',
    ];

    protected $casts = [
        'ingredients' => 'array'
    ];
}
