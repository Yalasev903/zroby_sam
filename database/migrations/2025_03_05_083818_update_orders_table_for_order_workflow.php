<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Удаляем колонку безопасно (через try)
            if (Schema::hasColumn('orders', 'category')) {
                try {
                    $table->dropColumn('category');
                } catch (\Throwable $e) {
                    // Laravel может ругаться, если dropColumn применяется до создания таблицы
                    // Поэтому в раннем деплое можно просто пропустить
                }
            }

            if (!Schema::hasColumn('orders', 'ad_id')) {
                $table->foreignId('ad_id')
                    ->nullable()
                    ->constrained('ads')
                    ->onDelete('cascade');
            }

            if (!Schema::hasColumn('orders', 'executor_id')) {
                $table->foreignId('executor_id')
                    ->nullable()
                    ->constrained('users')
                    ->onDelete('cascade');
            }

            if (!Schema::hasColumn('orders', 'status')) {
                $table->enum('status', ['new', 'waiting', 'in_progress', 'pending_confirmation', 'completed', 'cancelled'])
                    ->default('new');
            }

            if (!Schema::hasColumn('orders', 'services_category_id')) {
                $table->foreignId('services_category_id')
                    ->nullable()
                    ->constrained('services_category')
                    ->onDelete('set null');
            }

            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();

            $table->text('cancellation_reason')->nullable();
            $table->string('cancelled_by')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            $table->enum('payment_type', ['none', 'guarantee', 'no_guarantee'])->nullable()->default('none');
            $table->decimal('guarantee_amount', 10, 2)->nullable();
            $table->string('guarantee_card_number')->nullable();

            $table->enum('guarantee_payment_status', ['pending', 'paid', 'transferring', 'transferred'])
                ->nullable()
                ->default('pending');
            $table->timestamp('guarantee_paid_at')->nullable();
            $table->timestamp('guarantee_transferred_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['ad_id']);
            $table->dropColumn('ad_id');

            $table->dropForeign(['executor_id']);
            $table->dropColumn('executor_id');

            $table->dropForeign(['services_category_id']);
            $table->dropColumn('services_category_id');

            $table->dropColumn([
                'status',
                'start_time',
                'end_time',
                'cancellation_reason',
                'cancelled_by',
                'cancelled_at',
                'payment_type',
                'guarantee_amount',
                'guarantee_card_number',
                'guarantee_payment_status',
                'guarantee_paid_at',
                'guarantee_transferred_at',
            ]);
        });
    }
};
