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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en')->nullable();
            $table->string('slug')->unique();
            $table->text('content_ar');
            $table->text('content_en')->nullable();
            $table->text('excerpt_ar')->nullable();
            $table->text('excerpt_en')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->date('published_at')->nullable();
            $table->string('author_name')->nullable();
            $table->integer('reading_time')->nullable(); // in minutes
            $table->integer('sort_order')->default(0);
            $table->json('tags')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
