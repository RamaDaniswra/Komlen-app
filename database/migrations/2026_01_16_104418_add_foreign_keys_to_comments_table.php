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
            $table->foreign(['chapter_id'], 'comcha')->references(['id'])->on('chapters')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['user_id'], 'comus')->references(['id'])->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['parent_id'], 'paco')->references(['id'])->on('comments')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comcha');
            $table->dropForeign('comus');
            $table->dropForeign('paco');
        });
    }
};
