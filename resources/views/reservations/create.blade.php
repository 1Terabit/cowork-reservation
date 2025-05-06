@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Nueva Reservación</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('reservations.store') }}">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">

                        <div class="mb-3">
                            <label class="form-label">Sala Seleccionada</label>
                            <input type="text" 
                                   class="form-control" 
                                   value="{{ $room->name }}" 
                                   readonly>
                        </div>

                        <div class="mb-3">
                            <label for="reservation_date" class="form-label">Fecha</label>
                            <input type="date" 
                                   class="form-control @error('reservation_date') is-invalid @enderror" 
                                   id="reservation_date" 
                                   name="reservation_date" 
                                   value="{{ old('reservation_date', date('Y-m-d')) }}" 
                                   min="{{ date('Y-m-d') }}" 
                                   required>
                            @error('reservation_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="reservation_time" class="form-label">Hora</label>
                            <select class="form-select @error('reservation_time') is-invalid @enderror" 
                                    id="reservation_time" 
                                    name="reservation_time" 
                                    required>
                                <option value="">Selecciona una hora</option>
                                @for($hour = 8; $hour < 20; $hour++)
                                    <option value="{{ sprintf('%02d:00', $hour) }}" 
                                            {{ old('reservation_time') === sprintf('%02d:00', $hour) ? 'selected' : '' }}>
                                        {{ sprintf('%02d:00', $hour) }}
                                    </option>
                                @endfor
                            </select>
                            @error('reservation_time')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Crear Reservación</button>
                        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection