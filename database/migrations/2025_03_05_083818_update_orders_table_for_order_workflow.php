<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTableForOrderWorkflow extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('ad_id')
                  ->nullable()
                  ->constrained('ads')
                  ->onDelete('cascade');
            $table->foreignId('executor_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->enum('status', ['new', 'waiting', 'in_progress', 'pending_confirmation', 'completed'])
                  ->default('new');
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['ad_id']);
            $table->dropColumn('ad_id');
            $table->dropForeign(['executor_id']);
            $table->dropColumn(['executor_id', 'status', 'start_time', 'end_time']);
        });
    }
}
