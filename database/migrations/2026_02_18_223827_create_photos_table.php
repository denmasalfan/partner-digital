<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('photos', function (Blueprint $table) {
        $table->id(); // ID Unik
        
        // --- INFORMASI UTAMA ---
        $table->string('title'); // Judul Foto
        $table->string('slug')->unique(); // URL Cantik (SEO). Contoh: website.com/foto-pemandangan-indah
        
        // --- FILE MANAGEMENT (NILAI JUAL TINGGI) ---
        $table->string('image_path'); // Lokasi file asli (High Res)
        $table->string('thumbnail_path')->nullable(); // Lokasi file kecil (biar loading cepat di HP)
        
        // --- SEO & ACCESSIBILITY ---
        $table->string('alt_text')->nullable(); // Wajib untuk Google Image Search
        $table->text('description')->nullable(); // Cerita dibalik foto
        
        // --- KONTROL TAMPILAN ---
        $table->integer('sort_order')->default(0); // Urutan (bisa di-drag & drop nanti)
        $table->boolean('is_active')->default(true); // Saklar On/Off (Sembunyikan tanpa menghapus)
        $table->timestamp('published_at')->nullable(); // Jadwal tayang (Opsional: Post sekarang, tampil besok)
        
        // --- STANDARD SYSTEM ---
        $table->softDeletes(); // FITUR MAHAL: Data dihapus masuk "Tong Sampah" dulu (bisa restore), tidak langsung hilang permanen.
        $table->timestamps(); // Mencatat kapan dibuat & diedit
        
        // --- OPTIMASI DATABASE ---
        $table->index(['is_active', 'sort_order']); // Agar query pengurutan super cepat meski ada ribuan foto
    });
}

    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
