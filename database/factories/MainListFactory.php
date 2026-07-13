<?php

namespace Database\Factories;

use App\Helpers\Config;
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
            'round_number' => Config::DEFAULT_ROUND_NUMBER,
        ];
    }
}
