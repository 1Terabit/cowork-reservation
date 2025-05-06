<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Reservation;

class CheckRoomAvailability
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('post') || $request->isMethod('put')) {
            $roomId = $request->input('room_id');
            $date = $request->input('reservation_date');
            $time = $request->input('reservation_time');

            $existingReservation = Reservation::where('room_id', $roomId)
                ->where('reservation_date', $date)
                ->where('reservation_time', $time)
                ->where('status', '!=', 'rejected')
                ->exists();

            if ($existingReservation) {
                return back()
                    ->withInput()
                    ->withErrors(['availability' => 'La sala no está disponible en el horario seleccionado.']);
            }
        }

        return $next($request);
    }
}