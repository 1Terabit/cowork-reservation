@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Salas de Coworking</h2>
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('rooms.create') }}" class="btn btn-primary">Crear Nueva Sala</a>
                    @endif
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <div class="row">
                        @foreach($rooms as $room)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $room->name }}</h5>
                                    <p class="card-text">{{ $room->description }}</p>
                                    <a href="{{ route('reservations.create', ['room' => $room->id]) }}" 
                                       class="btn btn-success">Reservar</a>
                                    @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('rooms.edit', $room) }}" 
                                       class="btn btn-warning">Editar</a>
                                    <form action="{{ route('rooms.destroy', $room) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger" 
                                                onclick="return confirm('¿Estás seguro?')">
                                            Eliminar
                                        </button>
                                    </form>
                                    @endif
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