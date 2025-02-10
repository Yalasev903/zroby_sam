<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Запуск миграций.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            // Идентификатор пользователя, оставившего комментарий.
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Полиморфные поля: commentable_id и commentable_type.
            $table->morphs('commentable');

            // Текст комментария.
            $table->text('content');

            $table->timestamps();
        });
    }

    /**
     * Откат миграций.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
