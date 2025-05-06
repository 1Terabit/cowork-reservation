@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center min-vh-100 bg-white">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h2 class="mb-0">Mis Reservaciones</h2>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.export-reservations') }}" class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Exportar a Excel
                        </a>
                    @endif
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(auth()->user()->role === 'admin')
                    <div class="mb-4">
                        <form method="GET" action="{{ route('reservations.index') }}" class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label class="form-label">Filtrar por Sala</label>
                                <select name="room" class="form-select">
                                    <option value="">Todas las salas</option>
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}" 
                                                {{ request('room') == $room->id ? 'selected' : '' }}>
                                            {{ $room->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter"></i> Filtrar
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Sala</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Estado</th>
                                    @if(auth()->user()->role === 'admin')
                                    <th>Cliente</th>
                                    @endif
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->room->name }}</td>
                                    <td>{{ $reservation->reservation_date }}</td>
                                    <td>{{ $reservation->reservation_time }}</td>
                                    <td>
                                        <span class="badge bg-{{ $reservation->status_color }}">
                                            {{ $reservation->status_text }}
                                        </span>
                                    </td>
                                    @if(auth()->user()->role === 'admin')
                                    <td>{{ $reservation->user->name }}</td>
                                    <td>
                                        <form action="{{ route('admin.reservations.update-status', $reservation) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" 
                                                    class="form-select form-select-sm d-inline-block w-auto" 
                                                    onchange="this.form.submit()">
                                                <option value="pending" 
                                                        {{ $reservation->status === 'pending' ? 'selected' : '' }}>
                                                    Pendiente
                                                </option>
                                                <option value="accepted" 
                                                        {{ $reservation->status === 'accepted' ? 'selected' : '' }}>
                                                    Aceptada
                                                </option>
                                                <option value="rejected" 
                                                        {{ $reservation->status === 'rejected' ? 'selected' : '' }}>
                                                    Rechazada
                                                </option>
                                            </select>
                                        </form>
                                    </td>
                                    @else
                                    <td>
                                        @if($reservation->status === 'pending')
                                        <form action="{{ route('reservations.destroy', $reservation) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('¿Estás seguro?')">
                                                <i class="fas fa-times"></i> Cancelar
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection