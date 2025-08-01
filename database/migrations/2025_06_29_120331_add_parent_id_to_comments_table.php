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
    Schema::table('comments', function (Blueprint $table) {
        // Tambahkan kolom parent_id setelah kolom post_id
        // Kolom ini bisa kosong (nullable) karena komentar utama tidak punya induk
        $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade')->after('post_id');
    });
}

    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::table('comments', function (Blueprint $table) {
        $table->dropForeign(['parent_id']);
        $table->dropColumn('parent_id');
    });
}
};
