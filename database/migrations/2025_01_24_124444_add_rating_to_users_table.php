<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

     public function up()
{
    // Проверяем, существует ли уже столбец 'rating'
    if (!Schema::hasColumn('users', 'rating')) {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('rating')->default(0); // добавляем столбец, если его нет
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
