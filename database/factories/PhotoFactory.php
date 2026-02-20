<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage; // PENTING: Untuk simpan file
use Illuminate\Support\Str;

class PhotoFactory extends Factory
{
    public function definition(): array
    {
        // 1. Siapkan nama file unik
        $filename = 'photos/' . Str::random(10) . '.jpg';
        $thumbName = 'thumbnails/' . Str::random(10) . '.jpg';

        // 2. Download Gambar HD (800x600) dari internet
        // Kita pakai try-catch biar kalau internet putus tidak error
        try {
            $imageContent = file_get_contents('https://picsum.photos/800/600');
            $thumbContent = file_get_contents('https://picsum.photos/300/200');

            // 3. Simpan ke folder storage laptop Bapak (Disk Public)
            Storage::disk('public')->put($filename, $imageContent);
            Storage::disk('public')->put($thumbName, $thumbContent);
        } catch (\Exception $e) {
            // Kalau gagal download, pakai null dulu
            $filename = null;
            $thumbName = null;
        }

        return [
            'title' => fake()->sentence(3),
            'slug' => fake()->slug(),
            'image_path' => $filename, // Path asli di storage
            'thumbnail_path' => $thumbName,
            'alt_text' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'sort_order' => fake()->numberBetween(1, 100),
            'is_active' => true,
        ];
    }
}