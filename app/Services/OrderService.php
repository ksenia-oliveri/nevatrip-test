<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function createOrder($event_id, $event_date, $ticket_adult_price, $ticket_adult_quantity, $ticket_kid_price, $ticket_kid_quantity, $barcode)
    {
        // Вычисление общей стоимости заказа
        $equal_price = ($ticket_adult_price * $ticket_adult_quantity) + ($ticket_kid_price * $ticket_kid_quantity);

        return Order::create([
            'event_id' => $event_id,
            'event_date' => $event_date,
            'ticket_adult_price' => $ticket_adult_price,
            'ticket_adult_quantity' => $ticket_adult_quantity,
            'ticket_kid_price' => $ticket_kid_price,
            'ticket_kid_quantity' => $ticket_kid_quantity,
            'barcode' => $barcode,
            'equal_price' => $equal_price,
        ]);
    }       
}
