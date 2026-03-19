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
<<<<<<< HEAD
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
=======
                <th>Nombre Huesped</th>
                <th>Fecha Ingreso</th>
                <th>Fecha Fin</th>
                <th>Num Habitación</th>
                <th>Metodo Pago</th>
                <th>EstadoContrato</th>
                <th>Servicios</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hoteles as $reservacion)
>>>>>>> 03cda0964b7002b6c12349988b92b5ffea6492f6
                <tr>
                    <td>{{ $reservacion->id }}</td>
                    <td>{{ $reservacion->nombrehuesped }}</td>
                    <td>{{ $reservacion->fechaingreso }}</td>
                    <td>{{ $reservacion->fechafin }}</td>
                    <td>{{ $reservacion->numhabitacion }}</td>
                    <td>{{ $reservacion->metodopago }}</td>
                    <td>{{ $reservacion->estadocontrato }}</td>
                    <td>{{ $reservacion->servicios }}</td>
<<<<<<< HEAD
=======
                    @if(auth()->user()->role === 'cliente' || auth()->user()->role === 'administrador')
                        <td>
                            <a href="{{ route('hoteles.edit', $reservacion) }}" class="btn btn-warning">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('hoteles.destroy', $reservacion) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('¿Eliminar el registro?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    @endif
>>>>>>> 03cda0964b7002b6c12349988b92b5ffea6492f6
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No hay reservaciones registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
