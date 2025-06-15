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
        // Fix fatwas table
        Schema::table('fatwas', function (Blueprint $table) {
            // Make fatwa_date nullable since it's optional in Filament
            $table->date('fatwa_date')->nullable()->change();
            // Make slug nullable since it's auto-generated in Filament
            $table->string('slug')->nullable()->change();
        });

        // Fix books table
        Schema::table('books', function (Blueprint $table) {
            // Make description_ar required since it's required in Filament
            $table->text('description_ar')->nullable(false)->change();
            // Make slug nullable since it's auto-generated in Filament
            $table->string('slug')->nullable()->change();
        });

        // Fix articles table
        Schema::table('articles', function (Blueprint $table) {
            // Make slug nullable since it's auto-generated in Filament
            $table->string('slug')->nullable()->change();
        });

        // Fix audio_lectures table
        Schema::table('audio_lectures', function (Blueprint $table) {
            // Make description_ar required since it's required in Filament
            $table->text('description_ar')->nullable(false)->change();
            // Make slug nullable since it's auto-generated in Filament
            $table->string('slug')->nullable()->change();
        });

        // Fix categories table
        Schema::table('categories', function (Blueprint $table) {
            // Make slug nullable since it's auto-generated in Filament
            $table->string('slug')->nullable()->change();
            // Type is already required with default, which is correct
        });

        // Fix audio_series table
        Schema::table('audio_series', function (Blueprint $table) {
            // Make slug nullable since it's auto-generated in Filament
            $table->string('slug')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse fatwas table changes
        Schema::table('fatwas', function (Blueprint $table) {
            $table->date('fatwa_date')->nullable(false)->change();
            $table->string('slug')->nullable(false)->change();
        });

        // Reverse books table changes
        Schema::table('books', function (Blueprint $table) {
            $table->text('description_ar')->nullable()->change();
            $table->string('slug')->nullable(false)->change();
        });

        // Reverse articles table changes
        Schema::table('articles', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
        });

        // Reverse audio_lectures table changes
        Schema::table('audio_lectures', function (Blueprint $table) {
            $table->text('description_ar')->nullable()->change();
            $table->string('slug')->nullable(false)->change();
        });

        // Reverse categories table changes
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
        });

        // Reverse audio_series table changes
        Schema::table('audio_series', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
        });
    }
};
