<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Room;
use App\Models\Reservation;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        User::factory(5)->create();

        Room::factory(3)->create();

        Reservation::factory(10)->create([
            'user_id' => User::where('role', 'client')->inRandomOrder()->first()->id,
            'room_id' => Room::inRandomOrder()->first()->id,
        ]);
    }
}
