<?php

namespace Tests\Feature\Services;

use App\Exceptions\InvariantException;
use App\Http\Requests\CartAddRequest;
use App\Models\Cart;
use App\Models\Equipment;
use App\Models\User;
use App\Services\CartService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartServiceTest extends TestCase
{
    use RefreshDatabase;

    private CartService $cartService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->cartService = $this->app->make(CartService::class);

    }

    public function test_provider_cart()
    {
        self::assertTrue(true);
    }

    public function test_add_menu_cart_with_empty_menu()
    {
        $owner = User::factory()->create()->id;
        $equipment = Equipment::factory()->create();
        $request = new CartAddRequest([
            'menu_id' => $equipment->id,
            'quantity' => 1,
        ]);

        $this->cartService->add($request, $owner);

        $this->assertDatabaseCount('carts', 1);

        $this->assertDatabaseHas('carts', [
            'equipment_id' => $equipment->id,
            'owner' => $owner,
            'quantity' => 1
        ]);
    }

    public function test_add_menu_cart_with_exist_menu()
    {
        $user = User::factory()->create();
        $equipment = Equipment::factory()->create();

        Cart::factory()->create([
            'equipment_id' => $equipment->id,
            'owner' => $user->id,
            'quantity' => 1,
        ]);

        $request = new CartAddRequest([
            'equipment_id' => $equipment->id,
            'quantity' => 1,
        ]);

        $this->assertDatabaseCount('carts', 1);

        $this->cartService->add($request, $user->id);

        $this->assertDatabaseCount('carts', 1);

        $this->assertDatabaseHas('carts', [
            'equipment_id' => $equipment->id,
            'owner' => $user->id,
            'quantity' => 2
        ]);

        $request = new CartAddRequest([
            'equipment_id' => $equipment->id,
            'quantity' => 2,
        ]);

        $this->cartService->add($request, $user->id);

        $this->assertDatabaseCount('carts', 1);
        $this->assertDatabaseHas('carts', [
            'quantity' => 4
        ]);
    }

    public function test_add_menu_cart_with_empty_user()
    {
        $this->expectException(InvariantException::class);
        $equpiment = Equipment::factory()->create();

        $request = new CartAddRequest([
            'equipment_id' => $equpiment->id,
            'quantity' => 1,
        ]);

        $this->cartService->add($request, null);

        $this->assertDatabaseCount('carts', 0);
    }

    public function test_delete_menu_cart_with_quantity_than_more_one()
    {
        $cart = Cart::factory()->create(['quantity' => 2]);

        $this->cartService->delete($cart->id);

        $this->assertDatabaseCount('carts', 1);
        $this->assertDatabaseHas('carts',[
            'quantity' => 1
        ]);
    }

    public function test_delete_menu_cart_with_quantity_is_one()
    {
        $cart = Cart::factory()->create(['quantity' => 1]);

        $this->assertDatabaseCount('carts', 1);

        $this->cartService->delete($cart->id);

        $this->assertDatabaseCount('carts', 0);

    }
}
