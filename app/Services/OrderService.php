<?php

namespace App\Services;

use App\Http\Requests\OrderAddRequest;
use App\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderService
{
    function add(OrderAddRequest $request, ?int $owner): Order;
    function paid(int $id): Order;
    function list(string $key = '', int $size = 10): LengthAwarePaginator;
}
