<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the reservations.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $reservations = auth()->user()->role === 'admin' 
            ? Reservation::with(['user', 'room'])->latest()->get()
            : auth()->user()->reservations()->with('room')->latest()->get();
    
        // Agregamos la colección de salas para el filtro
        $rooms = Room::all();
    
        return view('reservations.index', compact('reservations', 'rooms'));
    }

    public function create()
    {
        $rooms = Room::all();
        return view('reservations.create', compact('rooms'));
    }

    /**
     * Store a newly created reservation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'reservation_date' => 'required|date|after:today',
            'reservation_time' => 'required|date_format:H:i'
        ]);

        // Verificar disponibilidad
        $existingReservation = Reservation::where('room_id', $request->room_id)
            ->where('reservation_date', $request->reservation_date)
            ->where('reservation_time', $request->reservation_time)
            ->exists();

        if ($existingReservation) {
            return back()->withErrors(['message' => 'La sala ya está reservada para ese horario.']);
        }

        /** @var User $user */
        $user = auth()->user();
        $reservation = $user->reservations()->create($validated);
        
        return redirect()->route('reservations.index')->with('success', 'Reserva creada exitosamente.');
    }

    /**
     * Update the status of a reservation.
     *
     * @param  \App\Models\Reservation  $reservation
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Reservation $reservation, Request $request)
    {
        /** @var \App\Models\User|null $user */
        $user = auth()->user();
        if (!$user || !$user->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,accepted,rejected'
        ]);

        $reservation->update($validated);
        return redirect()->back()->with('success', 'Estado de la reserva actualizado.');
    }
}
