@extends('adminlte::page')

@section('title', 'Mis Reservas')

@section('content_header')
    @include('partials.alerts')

    <div class="d-flex justify-content-between align-items-center">
        <h1>Mis Reservas</h1>
        <a href="{{ route('reservations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Crear Reserva
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sala</th>
                        <th>Hora de Inicio</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->room->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($reservation->start_time)->format('d/m/Y H:i') }}</td>
                            <td>
                                @switch($reservation->status)
                                    @case('Pendiente')
                                        <span class="badge badge-warning">Pendiente</span>
                                        @break
                                    @case('Aceptado')
                                        <span class="badge badge-success">Aceptado</span>
                                        @break
                                    @default
                                        <span class="badge badge-danger">Rechazado</span>
                                @endswitch
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No tienes reservas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
