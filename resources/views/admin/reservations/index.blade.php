@extends('adminlte::page')

@section('title', 'Reservaciones')

@section('content_header')
    @include('partials.alerts')

    <div class="d-flex justify-content-between align-items-center">
        <h1>Reservaciones</h1>
    </div>
@stop

@section('content')
    <form method="GET" action="{{ route('admin.reservations.index') }}" class="mb-3 row g-3">
        <div class="col-md-3">
            <select name="room_id" class="form-control select2">
                <option value="">Todas las salas</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-secondary">Filtrar</button>
            @if (request('room_id'))
                <a role="button" type="button" class="btn btn-primary ml-2" href="{{ route('admin.reservations.index') }}">Limpiar</a>
            @endif
        </div>
    </form>
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sala</th>
                        <th>Cliente</th>
                        <th>Hora de Inicio</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->room->name }}</td>
                            <td>{{ $reservation->user->name }}</td>
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
                            <td class="text-center">
                                <a href="{{ route('admin.reservations.edit', $reservation) }}" class="btn btn-info btn-sm">Cambiar Estado</a>
                                <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay reservas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $reservations->links() }}
@stop
