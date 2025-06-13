<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // ID unik untuk setiap postingan
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Siapa yang posting
            $table->string('title'); // Judul berita (teks singkat)
            $table->string('slug')->unique(); // Untuk URL yang rapi
            $table->text('content'); // Isi berita (teks panjang)
            $table->string('image')->nullable(); // Nama file gambar (bisa kosong)
            $table->timestamps(); // Kolom created_at dan updated_at otomatis
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};