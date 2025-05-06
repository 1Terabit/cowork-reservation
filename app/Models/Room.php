<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function isAvailable($date, $time)
    {
        return !$this->reservations()
            ->where('reservation_date', $date)
            ->where('reservation_time', $time)
            ->exists();
    }
}
