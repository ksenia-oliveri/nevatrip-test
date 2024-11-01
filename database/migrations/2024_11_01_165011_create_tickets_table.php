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
        //создаём отдельную таблицу где будет содержаться информация о каждом билете а именно его тип, его баркод, он будет привязан к айдишнику заказа
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Связь с таблицей orders
            $table->foreignId('ticket_type_id')->constrained('ticket_types')->onDelete('restrict'); // Связь с таблицей ticket_types
            $table->string('barcode', 120)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
