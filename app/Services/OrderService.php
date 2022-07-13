<?php

namespace App\Services;

use App\Http\Requests\OrderAddRequest;
use App\Models\Order;

interface OrderService
{
    function add(OrderAddRequest $request, ?int $owner): Order;
    function paid(int $id): Order;
}
