<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'request_user_id',
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

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getParagraphsAttribute()
    {
        return collect([
            $this->paragraph_1, 
            $this->paragraph_2,
            $this->paragraph_3,
            $this->paragraph_4,
            $this->paragraph_5,
            $this->paragraph_6
            ])->filter();
    }
}
