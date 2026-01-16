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
        Schema::create('comic', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('title');
            $table->string('author');
            $table->text('description');
            $table->unsignedInteger('views_count')->default(0);
            $table->string('cover_image')->nullable();
            $table->bigInteger('uploaded_by')->index('cou');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->string('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comic');
    }
};
