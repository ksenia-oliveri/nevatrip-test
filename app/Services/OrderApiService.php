<?php

namespace App\Services;

use Http;

class OrderApiService
{
    public function bookOrder($event_id, $event_date, $ticket_adult_price, $ticket_adult_quantity, $ticket_kid_price, $ticket_kid_quantity, $barcode)
    {
        //$response = Http::get("https://api.site.com/book");

        $response = [
            ['message' => 'order successfully booked'],
            ['error' => 'barcode already exists']
        ];
        return $response[array_rand($response)];
    }

    public function approveOrder($barcode)
    {
        //$response = Http::get("https://api.site.com/approve");

        $response = [
            ['message' => 'order successfully approved'],
            ['error' => 'event cancelled'],
            ['error' => 'no tickets'],
            ['error' => 'no seats'],
            ['error' => 'fan removed']
        ];
        return $response[array_rand($response)];
    }
}