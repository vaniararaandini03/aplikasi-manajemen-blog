<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'content',
        'thumbnail',
        'is_editor_choice'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
