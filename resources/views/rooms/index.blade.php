@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center min-vh-100 bg-white">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Salas de Coworking</h2>
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('rooms.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Crear Nueva Sala
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
                    
                    <div class="row">
                        @foreach($rooms as $room)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <i class="fas fa-door-open display-4 text-primary"></i>
                                    </div>
                                    <h3 class="card-title text-center">{{ $room->name }}</h3>
                                    <p class="card-text text-muted text-center">{{ $room->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <a href="{{ route('reservations.create', ['room' => $room->id]) }}" 
                                           class="btn btn-success">
                                           <i class="fas fa-calendar-plus"></i> Reservar
                                        </a>
                                        @if(auth()->user()->role === 'admin')
                                        <div>
                                            <a href="{{ route('rooms.edit', $room) }}" 
                                               class="btn btn-warning">
                                               <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route('rooms.destroy', $room) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-danger" 
                                                        onclick="return confirm('¿Estás seguro de que deseas eliminar esta sala?')">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection