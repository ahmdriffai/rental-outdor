<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\CartAddRequest;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function store(CartAddRequest $request)
    {
        $user = Auth::user();
        try {
            $this->cartService->add($request, $user->id);
            return redirect()->back()->with('success', 'Berhasil Memasukan keranjang');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }

    }

    public function delete($id)
    {
        try {
            $this->cartService->delete($id);
            return redirect()->back();
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', 'Gagal menghapus peralatan pada keranjang');
        }
    }


}
