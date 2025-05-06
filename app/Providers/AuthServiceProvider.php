<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Reservation;
use App\Models\Room;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-access', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-rooms', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-reservations', function ($user, Reservation $reservation) {
            return $user->role === 'admin' || $user->id === $reservation->user_id;
        });

        Gate::define('create-reservation', function ($user) {
            return true; 
        });
    }
}
