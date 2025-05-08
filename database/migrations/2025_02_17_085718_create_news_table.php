<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Запуск миграции.
     */
    public function up(): void
    {
        // Включаем поддержку внешних ключей для SQLite
     //    DB::statement('PRAGMA foreign_keys = ON;');

        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title', 500);
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->unsignedBigInteger('news_category_id'); // Исправлено для SQLite
            $table->string('image_url')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            // SQLite требует явного указания внешних ключей через raw SQL
            $table->foreign('news_category_id')
                  ->references('id')
                  ->on('news_categories')
                  ->onDelete('cascade');
        });
    }

    /**
     * Откат миграции.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
