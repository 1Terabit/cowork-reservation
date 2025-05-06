<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReservationsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Reservation::with(['user', 'room'])->get();
    }

    public function headings(): array
    {
        return [
            'Cliente',
            'Sala',
            'Fecha',
            'Hora',
            'Estado',
        ];
    }

    public function map($reservation): array
    {
        return [
            $reservation->user->name,
            $reservation->room->name,
            $reservation->reservation_date,
            $reservation->reservation_time,
            $reservation->status,
        ];
    }
}
