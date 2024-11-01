<?php

namespace App\Http\Controllers;

use App\Services\OrderApiService;
use App\Services\OrderService;

class OrderController extends Controller
{
    private OrderService $orderService;
    private OrderApiService $orderApiService;
    public function __construct(OrderService $orderService, OrderApiService $orderApiService)
    {
        $this->orderService = $orderService;
        $this->orderApiService = $orderApiService;
    }
    public function store($event_id, $event_date, $ticket_adult_price, $ticket_adult_quantity, $ticket_kid_price, $ticket_kid_quantity)
    {
        $generator = new BarcodeGenerator(BarcodeType::TYPE_CODE_128, BarcodeRender::RENDER_JPG);

        // Сгенегируем баркод
        do {
            $barcode = $generator->generate('012345678');

            $bookOrder = $this->orderApiService->bookOrder($event_id, $event_date, $ticket_adult_price, $ticket_adult_quantity, $ticket_kid_price, $ticket_kid_quantity, $barcode);
        } while (isset($bookOrder['error']) && $bookOrder['error'] === 'barcode already exists');

        if ($bookOrder['message'] === 'order successfully booked') {
            $approveOrder = $this->orderApiService->approveOrder($barcode);
            if (isset($approveOrder['message']) && $approveOrder['message' === 'order successfully approved']) {
                return $this->orderService->createOrder($event_id, $event_date, $ticket_adult_price, $ticket_adult_quantity, $ticket_kid_price, $ticket_kid_quantity, $barcode);
            } else {
                throw new \Exception("Order approval failed: " . ($approveOrder['error'] ?? 'unknown error'));
            }
        } else {
            throw new \Exception("Booking failed: " . ($bookOrder['error'] ?? 'unknown error'));
        }    
    }
}
