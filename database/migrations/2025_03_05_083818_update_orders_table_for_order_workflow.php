<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTableForOrderWorkflow extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'category')) {
                $table->dropColumn('category');
            }

            $table->foreignId('ad_id')
                ->nullable()
                ->constrained('ads')
                ->onDelete('cascade');

            $table->foreignId('executor_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');

            $table->enum('status', ['new', 'waiting', 'in_progress', 'pending_confirmation', 'completed', 'cancelled'])
                ->default('new');

            $table->foreignId('services_category_id')
                ->nullable()
                ->constrained('services_category')
                ->onDelete('set null');

            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();

            $table->text('cancellation_reason')->nullable();
            $table->string('cancelled_by')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            // ✅ Добавили 'no_guarantee' в список значений ENUM
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
}
