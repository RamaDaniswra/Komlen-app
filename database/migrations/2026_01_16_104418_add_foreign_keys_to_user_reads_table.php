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
        Schema::table('user_reads', function (Blueprint $table) {
            $table->foreign(['chapter_id'], 'uscha')->references(['id'])->on('chapters')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['user_id'], 'usus')->references(['id'])->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_reads', function (Blueprint $table) {
            $table->dropForeign('uscha');
            $table->dropForeign('usus');
        });
    }
};
