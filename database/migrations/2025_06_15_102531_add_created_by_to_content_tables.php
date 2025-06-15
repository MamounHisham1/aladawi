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
        // Add created_by to fatwas table
        Schema::table('fatwas', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('id')->constrained('users')->onDelete('set null');
        });

        // Add created_by to audio_lectures table
        Schema::table('audio_lectures', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('id')->constrained('users')->onDelete('set null');
        });

        // Add created_by to books table
        Schema::table('books', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('id')->constrained('users')->onDelete('set null');
        });

        // Add created_by to articles table
        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('id')->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fatwas', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });

        Schema::table('audio_lectures', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });

        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });
    }
};
