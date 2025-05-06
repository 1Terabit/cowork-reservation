@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h1 class="display-4 text-primary">Bienvenido al Sistema de Reservas</h1>
                        <p class="lead text-muted">Gestiona tus espacios de trabajo de manera eficiente</p>
                    </div>

                    @if (Route::has('login'))
                        <div class="text-center">
                            @auth
                                <a href="{{ route('rooms.index') }}" 
                                   class="btn btn-primary btn-lg px-5 me-3">
                                    <i class="fas fa-door-open me-2"></i>Ver Salas
                                </a>
                            @else
                                <div class="d-grid gap-3 col-lg-6 mx-auto">
                                    <a href="{{ route('login') }}" 
                                       class="btn btn-primary btn-lg">
                                        <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                                    </a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" 
                                           class="btn btn-outline-primary btn-lg">
                                            <i class="fas fa-user-plus me-2"></i>Registrarse
                                        </a>
                                    @endif
                                </div>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection