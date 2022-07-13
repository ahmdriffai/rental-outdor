<?php

namespace App\Services;

use App\Http\Requests\OrderAddRequest;
use App\Models\Order;

interface OrderService
{
    function add(OrderAddRequest $request): Order;
    function paid(int $id): Order;
}
