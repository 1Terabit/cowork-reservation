@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center min-vh-100 bg-white">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Dashboard de Administrador</h2>
                    <a href="{{ route('admin.export-reservations') }}" class="btn btn-success">
                        <i class="fas fa-file-excel"></i> Exportar Reservaciones
                    </a>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white h-100">
                                <div class="card-body text-center">
                                    <h3 class="card-title">Total de Salas</h3>
                                    <p class="display-1 mb-0">{{ $totalRooms }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white h-100">
                                <div class="card-body text-center">
                                    <h3 class="card-title">Total de Reservaciones</h3>
                                    <p class="display-1 mb-0">{{ $totalReservations }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning text-white h-100">
                                <div class="card-body text-center">
                                    <h3 class="card-title">Reservaciones Pendientes</h3>
                                    <p class="display-1 mb-0">{{ $pendingReservations }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection