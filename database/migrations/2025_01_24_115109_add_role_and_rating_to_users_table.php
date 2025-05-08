<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Добавляем роль admin к допустимым значениям
            $table->enum('role', ['customer', 'executor', 'admin'])->default('customer')->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Восстановление без admin — не обязательно, но можно
            $table->enum('role', ['customer', 'executor'])->nullable()->change();
        });
    }
};
