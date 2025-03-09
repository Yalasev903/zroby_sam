<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTableForOrderWorkflow extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Если ранее существовал столбец category, удаляем его
            if (Schema::hasColumn('orders', 'category')) {
                $table->dropColumn('category');
            }

            // Привязка заказа к объявлению
            $table->foreignId('ad_id')
                  ->nullable()
                  ->constrained('ads')
                  ->onDelete('cascade');

            // Привязка заказа к исполнителю
            $table->foreignId('executor_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('cascade');

            // Статус заказа
            $table->enum('status', ['new', 'waiting', 'in_progress', 'pending_confirmation', 'completed'])
                  ->default('new');

            // Добавляем связь с категорией услуг
            $table->foreignId('services_category_id')
                  ->nullable()
                  ->constrained('services_category')
                  ->onDelete('set null');

            // Время начала и окончания заказа
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Удаляем внешние ключи и столбцы, добавленные в up()
            $table->dropForeign(['ad_id']);
            $table->dropColumn('ad_id');

            $table->dropForeign(['executor_id']);
            $table->dropColumn('executor_id');

            $table->dropForeign(['services_category_id']);
            $table->dropColumn('services_category_id');

            $table->dropColumn(['status', 'start_time', 'end_time']);
        });
    }
}
