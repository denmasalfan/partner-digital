<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Photo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bersihkan Folder Foto Lama (Opsional, biar harddisk gak penuh)
        // Storage::disk('public')->deleteDirectory('photos');
        // Storage::disk('public')->deleteDirectory('thumbnails');

        // 2. Buat 4 Kategori Utama (Biar kelihatan profesional di Filter)
        $categories = [
            'Wedding & Event',
            'Nature & Landscape',
            'Street Photography',
            'Commercial Product'
        ];

        foreach ($categories as $catName) {
            Category::factory()->create([
                'name' => $catName,
                'slug' => \Illuminate\Support\Str::slug($catName)
            ]);
        }

        // 3. Generate 30 Foto Random
        // Factory akan otomatis mengambil ID dari kategori di atas secara acak
        Photo::factory(30)->create();
    }
}