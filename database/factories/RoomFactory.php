<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => 'Sala ' . fake()->word(),
            'description' => fake()->sentence(),
        ];
    }
}