<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::post('/add', [OrderController::class, 'store'])->name('add.order');
