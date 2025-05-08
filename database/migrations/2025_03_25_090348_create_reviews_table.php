<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            // Привязка отзыва к заказу
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            // Идентификатор заказчика, который оставляет отзыв или является объектом отзыва
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            // Идентификатор исполнителя, которому оставляется отзыв или является объектом отзыва
            $table->foreignId('executor_id')->constrained('users')->onDelete('cascade');
            // Указываем, кто оставил отзыв: "customer" или "executor"
            $table->string('review_by');
            // Оценка отзыва (например, от 1 до 5)
            $table->unsignedTinyInteger('rating');
            // Комментарий (необязательное поле)
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
}
