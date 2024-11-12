@extends('adminlte::page')

@section('title', 'Salas')

@section('content_header')
    @include('partials.alerts')

    <div class="d-flex justify-content-between align-items-center">
        <h1>Salas</h1>
        <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Crear Sala
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                        <tr>
                            <td>{{ $room->name }}</td>
                            <td>{{ $room->description }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-info btn-sm">Editar</a>
                                <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No hay salas creadas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
