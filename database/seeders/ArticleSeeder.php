<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $category = Category::first();

        if (!$user || !$category) {
            return;
        }

        DB::table('articles')->insert([
            'title' => 'Artikel Pertama',
            'content' => 'Ini adalah contoh isi artikel yang dibuat melalui database seeder Laravel.',
            'category_id' => $category->id,
            'user_id' => $user->id,
            'status' => 'published',
            'is_editor_choice' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
