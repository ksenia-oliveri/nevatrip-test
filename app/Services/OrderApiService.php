<?php

namespace App\Services;

use Http;

class OrderApiService
{
    public function bookOrder($orderData, $barcode)
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