<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //здесь я создала миграцию которая удаляет ненужные столбцы из первой таблицы, а именно баркод и столбцы с информацией о билетах, их я вынесла в отельную таблицу
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['ticket_adult_price', 'ticket_adult_quantity', 'ticket_kid_price', 'ticket_kid_quantity', 'barcode']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('ticket_adult_price');
            $table->integer('ticket_adult_quantity');
            $table->integer('ticket_kid_price');
            $table->integer('ticket_kid_quantity');
            $table->string('barcode', 120)->unique();
        });
    }
};
