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
    Schema::table('posts', function (Blueprint $table) {
        // Tambahkan kolom 'views_count' setelah kolom 'image'
        // 'unsignedInteger' artinya angka positif, 'default(0)' artinya nilai awalnya 0
        $table->unsignedInteger('views_count')->default(0)->after('image');
    });
}

    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::table('posts', function (Blueprint $table) {
        $table->dropColumn('views_count');
    });
}
};
