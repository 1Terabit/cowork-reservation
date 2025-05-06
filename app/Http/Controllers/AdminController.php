<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Exports\ReservationsExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $totalRooms = Room::count();
        $totalReservations = Reservation::count();
        $pendingReservations = Reservation::where('status', 'pending')->count();

        return view('admin.dashboard', compact('totalRooms', 'totalReservations', 'pendingReservations'));
    }

    public function exportReservations()
    {
        return Excel::download(new ReservationsExport, 'reservaciones.xlsx');
    }
}
