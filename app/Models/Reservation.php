<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'reservation_date',
        'reservation_time',
        'status',
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'reservation_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function getStatusColorAttribute()
    {
        return [
            'pending' => 'warning',
            'accepted' => 'success',
            'rejected' => 'danger',
        ][$this->status] ?? 'secondary';
    }

    public function getStatusTextAttribute()
    {
        return [
            'pending' => 'Pendiente',
            'accepted' => 'Aceptada',
            'rejected' => 'Rechazada',
        ][$this->status] ?? 'Desconocido';
    }
}
