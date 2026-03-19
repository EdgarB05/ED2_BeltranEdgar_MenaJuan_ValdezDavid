@extends('layouts.app')

@section('content')
    <h1>HOTEL LUNA INN</h1>
    <p><strong>Usuario:</strong> {{ auth()->user()->name }} | <strong>Rol:</strong> {{ ucfirst(auth()->user()->role) }}</p>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="d-flex justify-content-end mb-2 gap-2">
        @if(auth()->user()->role === 'administrador')
            <a href="{{ route('registro') }}" class="btn btn-secondary mb-3 me-3">
                Registrar nuevo usuario
            </a>
        @endif

        <form action="{{ route('cerrar') }}" method="POST">
            @csrf
            <button class="btn btn-danger me-2"><i class="fa-solid fa-arrow-right-to-bracket"></i> Cerrar sesión</button>
        </form>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Huésped</th>
                <th>Ingreso</th>
                <th>Salida</th>
                <th>Habitación</th>
                <th>Método de pago</th>
                <th>Estado</th>
                <th>Servicios</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservaciones as $reservacion)
                <tr>
                    <td>{{ $reservacion->id }}</td>
                    <td>{{ $reservacion->nombrehuesped }}</td>
                    <td>{{ $reservacion->fechaingreso }}</td>
                    <td>{{ $reservacion->fechafin }}</td>
                    <td>{{ $reservacion->numhabitacion }}</td>
                    <td>{{ $reservacion->metodopago }}</td>
                    <td>{{ $reservacion->estadocontrato }}</td>
                    <td>{{ $reservacion->servicios }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No hay reservaciones registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
