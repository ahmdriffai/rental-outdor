<?php

namespace Tests\Feature\Services;

use App\Http\Requests\OrderAddRequest;
use App\Models\Cart;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    private OrderService $orderService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->orderService = $this->app->make(OrderService::class);
    }


    public function test_provider_order()
    {
        self::assertTrue(true);
    }

    public function test_add_order_success()
    {
        $cart = Cart::factory(2)->create();
        $user = User::factory()->create();

        $request = new OrderAddRequest([
            'rental_start' => '2020-01-01',
            'rental_end' => '2020-01-01',
            'equipment_id' => [$cart[0]->equipment->id, $cart[1]->equipment->id],
            'quantity' => [1, 3]
        ]);


        $this->orderService->add($request, $user->id);

        $this->assertDatabaseCount('orders', 1);
        $this->assertDatabaseCount('equipment_order', 2);
        $this->assertDatabaseHas('equipment_order', [
            'equipment_id' => $cart[0]->equipment->id,
            'quantity' => 1
        ]);
        $this->assertDatabaseHas('equipment_order', [
            'equipment_id' => $cart[1]->equipment->id,
            'quantity' => 3
        ]);

        $this->assertDatabaseHas('orders', [
            'rental_start' => $request->rental_start,
            'rental_end' => $request->rental_end,
            'status' => 'process',
        ]);

        $this->assertDatabaseCount('carts', 0);

    }
}
