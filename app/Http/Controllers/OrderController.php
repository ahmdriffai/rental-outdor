<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\OrderAddRequest;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(OrderAddRequest $request)
    {
        $user = Auth::user();
        try {
            $this->orderService->add($request, $user->id);
            return redirect()->route('gueste.index')->with('success', 'Berhasil Membuat Pesanan Rental');
        }catch (InvariantException $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
