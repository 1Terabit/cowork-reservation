<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'room_id' => Room::factory(),
            'reservation_date' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'reservation_time' => fake()->time('H:00:00'),
            'status' => fake()->randomElement(['pending', 'accepted', 'rejected']),
        ];
    }
}