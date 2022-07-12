<?php

namespace App\Services;

use App\Http\Requests\CartAddRequest;
use App\Models\Cart;

interface CartService
{
    function add(CartAddRequest $request, ?int $owner) : Cart;
    function delete(int $id): void;
}
