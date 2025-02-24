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
    Schema::table('users', function (Blueprint $table) {
        $table->enum('role', ['customer', 'executor'])->default('customer')->change(); // Задаємо значення за замовчуванням
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->enum('role', ['customer', 'executor'])->nullable()->change(); // Відновлюємо колишнє налаштування
    });
}


};
