<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
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
    public function store(OrderRequest $orderRequest)
    {
        $generator = new BarcodeGenerator(BarcodeType::TYPE_CODE_128, BarcodeRender::RENDER_JPG);
        $orderData = $orderRequest->validated();
        // Сгенегируем баркод
        do {
            $barcode = $generator->generate('012345678');

            $bookOrder = $this->orderApiService->bookOrder($orderData, $barcode);
        } while (isset($bookOrder['error']) && $bookOrder['error'] === 'barcode already exists');

        if ($bookOrder['message'] === 'order successfully booked') {
            $approveOrder = $this->orderApiService->approveOrder($barcode);
            if (isset($approveOrder['message']) && $approveOrder['message' === 'order successfully approved']) {
                return $this->orderService->createOrder($orderData['event_id'],  $orderData['event_date'], $orderData['ticket_adult_price'], $orderData['ticket_adult_quantity'], $orderData['ticket_kid_price'], $orderData['ticket_kid_quantity'],   $barcode);
            } else {
                throw new \Exception("Order approval failed: " . ($approveOrder['error'] ?? 'unknown error'));
            }
        } else {
            throw new \Exception("Booking failed: " . ($bookOrder['error'] ?? 'unknown error'));
        }    
    }
}
