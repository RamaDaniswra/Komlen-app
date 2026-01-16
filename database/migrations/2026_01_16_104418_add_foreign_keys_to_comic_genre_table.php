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
        Schema::table('comic_genre', function (Blueprint $table) {
            $table->foreign(['comic_id'], 'geco')->references(['id'])->on('comic')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['genre_id'], 'gege')->references(['id'])->on('genre')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comic_genre', function (Blueprint $table) {
            $table->dropForeign('geco');
            $table->dropForeign('gege');
        });
    }
};
