<?php

namespace App\Services\Elequent;

use App\Exceptions\InvariantException;
use App\Http\Requests\CartAddRequest;
use App\Models\Cart;
use App\Models\Equipment;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;

class CartServiceImpl implements CartService
{

    function add(CartAddRequest $request, ?int $owner): Cart
    {
        $quantity = $request->input('quantity');
        $equipmentId = $request->input('equipment_id');

        if ($owner == null) {
            throw new InvariantException('Gagal menambah keranjang, belum melakukan login');
        }

        if ($equipmentId == null) {
            throw new InvariantException('Gagal menambah keranjang, belum memilih peralatan');
        }

        // cek id menu sudah dimasukan
        $cart = Cart::where('equipment_id', $equipmentId)->where('owner' , $owner)->first();

        if ($cart != null) {
            // jika sudah dimasukan ubah quantity
            $cart->quantity += $quantity;
            $cart->save();
        }else {
            // masukan data cart
            try {
                DB::beginTransaction();
                $cart = new Cart([
                    'owner' => $owner,
                    'equipment_id' => $equipmentId,
                    'quantity' => $quantity,
                ]);

                $cart->save();
                DB::commit();
            }catch (\Exception $exception) {
                DB::rollBack();
                throw new InvariantException($exception->getMessage());
            }

        }

        return $cart;
    }

    function delete(int $id): void
    {
        $cart = Cart::find($id);

        if ($cart->quantity == 1) {
            try {
                $cart->delete();
            }catch (\Exception $exception){
                throw new InvariantException($exception->getMessage());
            }
        }else {
            $cart->quantity -= 1;
            $cart->save();
        }
    }
}
