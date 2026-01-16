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
        Schema::table('page', function (Blueprint $table) {
            $table->foreign(['chapter_id'], 'paer')->references(['id'])->on('chapters')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('page', function (Blueprint $table) {
            $table->dropForeign('paer');
        });
    }
};
