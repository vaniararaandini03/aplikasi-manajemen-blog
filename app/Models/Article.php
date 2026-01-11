<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;

class Article extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'image',
        'status',
        'is_editor_choice',
    ];

    // RELASI KE USER (PENULIS)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // RELASI KE CATEGORY
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
