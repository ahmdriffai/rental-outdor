<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\OrderAddRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request) {
        $key = $request->query('key') ?? '';
        $data = $this->orderService->list($key, 10);
        return view('orders.index', compact('data'));
    }

    public function store(OrderAddRequest $request)
    {
        $user = Auth::user();
        try {
            $this->orderService->add($request, $user->id);
            return redirect()->route('guest.index')->with('success', 'Berhasil Membuat Pesanan Rental, Untuk pembayaran silahkan dibayar pada saat pengambilan barang');
        }catch (InvariantException $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
