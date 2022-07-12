<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'equipment_id' => Equipment::factory()->create()->id,
            'owner' => User::factory()->create()->id,
            'quantity' => 0,
        ];
    }
}
