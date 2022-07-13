<?php

namespace App\Services\Elequent;

use App\Exceptions\InvariantException;
use App\Http\Requests\OrderAddRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Support\Facades\DB;

class OrderServiceImpl implements OrderService
{

    function add(OrderAddRequest $request): Order
    {
        $owner = $request->input('owner');
        $rentalStart = $request->input('rental_start');
        $rentalEnd = $request->input('rental_end');
        $equipmentId = $request->input('equipment_id');
        $quantity = $request->input('quantity');

        try {
            DB::beginTransaction();

            $order = new Order([
                'owner' => $owner,
                'rental_start' => $rentalStart,
                'rental_end' => $rentalEnd,
            ]);

            for($i = 0; $i < count($equipmentId); $i++){
                $order->menus()->attach($equipmentId[$i],['quantity' => $quantity[$i]]);
            }

            DB::table('carts')->delete();

            DB::commit();
        }catch (\Exception $exception) {
            DB::rollBack();
            throw new InvariantException($exception->getMessage());
        }

        return $order;
    }

    function paid(int $id): Order
    {
        $order = Order::find($id);
        try {
            $order->status = 'paid';
            $order->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }
        return $order;
    }
}
