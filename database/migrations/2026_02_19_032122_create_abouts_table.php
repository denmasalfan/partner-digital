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
    Schema::create('abouts', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Judul Besar
        $table->text('content'); // Isi Cerita (Bisa tebal/miring)
        $table->string('image')->nullable(); // Foto Profil
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
