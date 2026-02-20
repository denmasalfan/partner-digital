<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Bikin nama kategori acak, misal: "Digital Marketing"
        $name = fake()->unique()->words(2, true); 
        
        return [
            'name' => ucfirst($name), // Huruf depan besar
            'slug' => Str::slug($name), // Jadi url: digital-marketing
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}