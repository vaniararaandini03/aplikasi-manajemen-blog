<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Category;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'image',
        'status',
        'is_editor_choice',
    ];

    /**
     * Default values (AMAN untuk server)
     */
    protected $attributes = [
        'status' => 'published',
        'is_editor_choice' => 0,
    ];

    /**
     * Casting kolom
     */
    protected $casts = [
        'is_editor_choice' => 'boolean',
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
