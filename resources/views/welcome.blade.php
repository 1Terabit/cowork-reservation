@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenido a Sistema de Reservas</div>

                <div class="card-body">
                    @if (Route::has('login'))
                        <div class="text-center">
                            @auth
                                <a href="{{ route('rooms.index') }}" class="btn btn-primary">Ver Salas Disponibles</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-secondary">Registrarse</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection