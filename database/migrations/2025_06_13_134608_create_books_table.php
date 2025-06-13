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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en')->nullable();
            $table->string('slug')->unique();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->text('excerpt_ar')->nullable();
            $table->text('excerpt_en')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('author_ar')->nullable();
            $table->string('author_en')->nullable();
            $table->string('publisher_ar')->nullable();
            $table->string('publisher_en')->nullable();
            $table->year('publication_year')->nullable();
            $table->string('isbn')->nullable();
            $table->integer('pages')->nullable();
            $table->string('language')->default('ar'); // ar, en, both
            $table->integer('download_count')->default(0);
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
        Schema::dropIfExists('books');
    }
};
