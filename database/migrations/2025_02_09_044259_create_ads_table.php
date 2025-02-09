<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Запуск миграции.
     */
    public function up(): void
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            // Привязка к пользователю (автору объявления)
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('title');              // Заголовок объявления
            $table->text('description');          // Описание объявления
            $table->string('photo_path')->nullable(); // Путь к фото объявления
            $table->string('city')->nullable();   // Город объявления (выбранный из таблицы users)
            $table->timestamp('posted_at')->nullable(); // Дата размещения объявления (при сохранении запишем текущее время)
            $table->timestamps();                 // created_at и updated_at
        });
    }

    /**
     * Откат миграции.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
