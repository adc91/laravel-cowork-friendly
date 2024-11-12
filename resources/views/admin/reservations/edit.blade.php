@extends('adminlte::page')

@section('title', 'Editar Reserva')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Editar Reserva</h1>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="status">Estado</label>
                            <select name="status" id="status" class="form-control select2" required>
                                <option value="">Por favor, seleccione un estado</option>
                                <option value="Aceptado" {{ $reservation->status === 'Aceptado' ? 'selected' : '' }}>Aceptado</option>
                                <option value="Rechazado" {{ $reservation->status === 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                            </select>
                        </div>
                        @include('partials.alerts')
                        <button type="submit" class="btn btn-primary">Actualizar Estado</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
