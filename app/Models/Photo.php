<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // PENTING 1: Panggil fitur Soft Delete

class Photo extends Model
{
    use HasFactory, SoftDeletes; // PENTING 2: Aktifkan fitur di model ini

    /**
     * The attributes that are mass assignable.
     * (Keamanan: Hanya kolom ini yang boleh diisi lewat formulir)
     */
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'image_path',
        'thumbnail_path',
        'alt_text',
        'description',
        'sort_order',
        'is_active',
        'published_at',
    ];

    /**
     * The attributes that should be cast.
     * (Konversi Data Otomatis: 1/0 di database jadi True/False di PHP)
     */
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'published_at' => 'datetime',
    ];
    // Tambahkan 'category_id' ke dalam $fillable di bagian atas file

// Relasi: Foto ini MILIK Satu Kategori
public function category()
{
    return $this->belongsTo(Category::class);
}
}