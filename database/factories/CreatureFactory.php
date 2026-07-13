<?php

namespace Database\Factories;

use App\Enums\CreatureType;
use App\Models\Creature;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Creature>
 */
class CreatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'       => fake()->firstName(),
            'type'       => CreatureType::NON_PLAYABLE,
            'initiative' => rand(1, 23),
        ];
    }
}
